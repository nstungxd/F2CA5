Imports System.Data
Imports System.Data.SqlClient
Imports PingCore.MyData
Imports PingCore.MyContent
Imports PingCore.MySystem
Imports PingCore.MyControls
Imports PingCore
Imports uic = PingCore.UserIdentityControl

Partial Public Class Custom_SendTemporaryPassword_Behind
    Inherits SimplePage
#Region "TheIdentityControl"
    Private _theIdentityControl As UserIdentityControl
    Private ReadOnly Property TheIdentityControl() As UserIdentityControl
        Get
            If _theIdentityControl Is Nothing Then
                _theIdentityControl = New UserIdentityControl(HttpContext.Current)
            End If

            Return _theIdentityControl
        End Get
    End Property
#End Region

#Region "TheMaster"
    Private _theMaster As New Memo(Of IMaster)(AddressOf _GetTheMaster)
    Private ReadOnly Property TheMaster() As IMaster
        Get
            Return _theMaster.Value
        End Get
    End Property

    Function _GetTheMaster() As IMaster
        Return CType(Page.Master.Master, IMaster)
    End Function
#End Region

#Region "Local"

#Region "l_AdminID"
    Private _lAdminID As New Memo(Of Nullable(Of Integer))(AddressOf _GetLAdminID)
    ReadOnly Property l_AdminID() As Nullable(Of Integer)
        Get
            Return _lAdminID.Value
        End Get
    End Property

    Function _GetLAdminID() As Nullable(Of Integer)
        '# get the id of the logged in admin
        Dim i As Integer = 0
        With TheIdentityControl
            If .IsKnown AndAlso .IsConfirmed AndAlso Security.UType.IsAdmin(.Identity.UTypeID) Then
                '# this is an admin
                i = .Identity.ID
            End If
        End With

        If i > 0 Then
            Return i
        Else
            Return Nothing
        End If
    End Function
#End Region

#Region "l_TargetID"
    Private _lTargetID As New Memo(Of Nullable(Of Integer))(AddressOf _GetLTargetID)
    ReadOnly Property l_TargetID() As Nullable(Of Integer)
        Get
            Return _lTargetID.Value
        End Get
    End Property

    Function _GetLTargetID() As Nullable(Of Integer)
        '# get from querystring
        Dim s As String = Request.QueryString("id")
        If StringUtility.IsEffectivelyEmpty(s) Then s = Request.QueryString("key")
        Dim i As Integer = 0 : Int32.TryParse(s, i)

        If i > 0 Then
            Return i
        Else
            Return Nothing
        End If
    End Function
#End Region


    Overrides Sub Page_EarlyLocalLoad()
        '# ensure the user is logged in and is an admin
        If Not l_AdminID.HasValue Then
            '# not logged in or not an admin
            BackToUsers()
        End If

        pnlSuccess.Visible = False
        pnlMailError.Visible = False
        pnlMissingTemplate.Visible = False

    End Sub

    Overrides Sub Page_LateLocalLoad()

    End Sub

#End Region


#Region "Global"

#Region "g_AdminID"
    Property g_AdminID() As Integer
        Get
            Return DBFactory.FromViewState(Of Integer)(ViewState, "g_AdminID")
        End Get
        Set(ByVal value As Integer)
            ViewState("g_AdminID") = value
        End Set
    End Property
#End Region

#Region "g_TargetID"
    Property g_TargetID() As Integer
        Get
            Return DBFactory.FromViewState(Of Integer)(ViewState, "g_TargetID")
        End Get
        Set(ByVal value As Integer)
            ViewState("g_TargetID") = value
        End Set
    End Property
#End Region


    Overrides Sub Page_GlobalLoad()
        '# todo: runs on the first page load

        '# set global start values
        g_AdminID = l_AdminID

        If Not l_TargetID.HasValue Then
            BackToUsers()
        End If
        g_TargetID = l_TargetID


        '# issue it
        TryToIssueTemporaryPassword()
    End Sub

    Sub TryToIssueTemporaryPassword()
        '# we have the target, now get the email for this user
        Dim theEmail As Email = Nothing
        With "email"
            Dim sql As String = "select user_email from users where user_id = " & g_TargetID.ToString
            Dim s As String = DBFactory.DB.GetDataField(Of String)(sql)

            Try
                theEmail = Email.FromString(s)
            Catch
            End Try
        End With

        If theEmail Is Nothing Then
            '# the email could not be got, return
            BackToUsers()
        Else
            '# we have the email, now issue the temporary password
            Try
                Dim res As uic.ITPResult = IssueTemporaryPassword(theEmail)

                If res = uic.ITPResult.UserMissing Then
                    '# no user matches this email address
                    BackToUsers()
                ElseIf res = UserIdentityControl.ITPResult.NoTemplate Then
                    ShowNoTemplate()
                ElseIf res And uic.ITPResult.Success Then
                    '# success, the mail was sent, show success
                    ShowSuccess()
                Else
                    '# a mail error occurred, show mail error
                    ShowMailError()
                End If
            Catch ex As UserIdentityControl.TP_MailSendException
                'ShowMailError()
                Throw
            End Try
        End If
    End Sub

    Sub ShowSuccess()
        pnlSuccess.Visible = True
    End Sub

    Sub ShowMailError()
        pnlMailError.Visible = True
    End Sub

    Sub ShowNoTemplate()
        pnlMissingTemplate.Visible = True
    End Sub

#Region "Handlers"

    '# todo: place event handlers here

#End Region

#End Region

    Sub BackToUsers()
        Response.Redirect("/admin/sections/admin-users.aspx")
    End Sub


#Region "IssueTemporaryPassword"

    <Flags()> Public Enum ITPResult As Integer
        Success = 1
        MailSent = 3
        MailSentPrev = 5
        UserMissing = 8
        MailError = 16
        NoTemplate = 32
    End Enum

    Protected Function IssueTemporaryPassword(ByVal email As Email) As ITPResult

        '# generate temporary password, send the email to the user
        Dim tp As TemporaryPasswordResult = Nothing
        tp = SetNewTemporaryPassword(email)
        Try
        Catch ex As uic.TP_UserMissingException
            '# couldn't find the user
            Return ITPResult.UserMissing

            'AppendValidationError(EmailHolder, "No user matches this email address.")
        End Try

        If tp IsNot Nothing Then
            '# send mail
            Dim success As Boolean = False
            Try
                success = SendTemporaryPasswordMail(tp)
            Catch ex As uic.TP_NullContentException
                '# assume this was sent previously
                Return ITPResult.NoTemplate
            End Try

            If Not success Then
                Return ITPResult.MailError
            Else
                Return ITPResult.MailSent
            End If
        End If
    End Function

    Protected Function SetNewTemporaryPassword(ByVal email As Email) As TemporaryPasswordResult

        Dim sdb As PingLibrary.SqlDatabaseConnection = PingLibrary.Data.Connect()

        Dim result As TemporaryPasswordResult = Nothing

        '# get userid
        Dim uid As Integer
        With "uid"

            '# get user-id
            Dim sql As String = "select [user_id] from users where user_email = @EMAIL"
            Dim cmd As SqlCommand = sdb.GetCommand(sql)
            With cmd.Parameters
                .Add(sdb.NewParameter(Of String)("@EMAIL", SqlDbType.VarChar, email.ToString))
            End With

            uid = sdb.GetDataField(Of Integer)(cmd)
        End With

        If uid <= 0 Then
            '# missing email
            Throw New uic.TP_UserMissingException

        Else
            '# generate temporary password
            Dim pwd As NakedPassword = Generate()
            Dim salt As Salt = salt.Generate()
            Dim hash As Hash = hash.FromPassword(pwd, salt)

            Dim rows As Integer = 0

            '# update user record
            With "update user"
                Dim sql As String = String.Format(String.Concat( _
                  "update users {0}", _
                  "set user_temporary_hash = @HASH, {0}", _
                  "  user_temporary_salt = @SALT{0}", _
                  "where [user_id] = @UID"), _
                  vbCrLf)

                Dim cmd As SqlCommand = sdb.GetCommand(sql)
                With cmd.Parameters
                    .Add(sdb.NewParameter(Of Byte())("@HASH", SqlDbType.Binary, hash.Value))
                    .Add(sdb.NewParameter(Of Byte())("@SALT", SqlDbType.Binary, salt.Value))
                    .Add(sdb.NewParameter(Of Integer)("@UID", SqlDbType.BigInt, uid))
                End With

                rows = sdb.RunSQL(cmd)
            End With

            If rows > 0 Then
                '# the password was set
                result = New TemporaryPasswordResult(uid, pwd)
            Else
                '# no update was made
                Throw New uic.TP_NoRowsSetException
            End If
        End If

        Return result
    End Function

    Protected Function SendTemporaryPasswordMail(ByVal tp As TemporaryPasswordResult) As Boolean
        '# send mail to this user
        Dim success As Boolean = False

        If tp Is Nothing Then
            Throw New ArgumentNullException("tp")
        Else

            '# get email
            Dim email As Email = Nothing
            With "email"
                Dim sdb As PingLibrary.SqlDatabaseConnection = PingLibrary.Data.Connect()

                Dim sql As String = String.Format(String.Concat( _
                  "select user_email from users where [user_id] = @UID"), _
                  vbCrLf)

                Dim cmd As SqlCommand = sdb.GetCommand(sql)
                With cmd.Parameters
                    .Add(sdb.NewParameter(Of Integer)("@UID", SqlDbType.BigInt, tp.ID))
                End With

                email = email.FromStringOpt(sdb.GetDataField(Of String)(cmd))
            End With

            If email Is Nothing Then
                '# missing user record
                Throw New uic.TP_UserMissingException
            Else

                '# get mail content
                Dim c As String = GetUrl("~/account/mail/mail_TemporaryPassword.aspx", True)
                If c Is Nothing Then
                    Throw New uic.TP_NullContentException
                Else

                    '# we have the email and the content, now prepare the email for sending

                    c = c.Replace("<!-- secretcode -->", tp.TemporaryPassword.Value)
                    c = c.Replace("<!-- email -->", HttpContext.Current.Server.UrlEncode(email.ToString))

                    '# send the email
                    Try

                        'Dim mail As New MailMessage()

                        ''set the addresses
                        'mail.From = New MailAddress(Mailer.From)
                        'mail.To.Add(email.ToString)

                        ''set the content
                        Dim SiteName As String = System.Configuration.ConfigurationManager.AppSettings("site_name").ToString()
                        'mail.Subject = SiteName & " - Password Reset"
                        'mail.IsBodyHtml = True
                        'mail.Body = c

                        ''HttpContext.Current.Response.Write("Just about to send email")

                        'Dim smtp As SmtpClient = Mailer.Server
                        'smtp.Send(mail)

                        '# success
                        success = PingLibrary.EmailLibrary.SendEmail(SiteName & " - Password Reset", c, email.ToString)
                    Catch ex As Exception
                        Throw New uic.TP_MailSendException(ex)
                    End Try
                End If
            End If
        End If

        Return success
    End Function

    Protected Function GetUrl(ByVal u As String, Optional ByVal secure As Boolean = True) As String
        If secure Then

            Dim str3 As String = Guid.NewGuid.ToString

            Dim sdb As PingLibrary.SqlDatabaseConnection = PingLibrary.Data.Connect()

            Dim sql As String = String.Format(String.Concat(New String() {"insert into zz_admin_securewebrequests (guid) values(@GUID);"}), ChrW(13) & ChrW(10))

            Dim cmd As SqlCommand = DirectCast(sdb.GetCommand(sql), SqlCommand)

            cmd.Parameters.Add(sdb.NewParameter(Of String)("@GUID", SqlDbType.VarChar, str3))

            sdb.RunSQL(cmd)

            str3 = HttpContext.Current.Server.UrlEncode(str3)

            If (u.IndexOf("?"c) > -1) Then

                u = (u & "&guid=" & str3)

            Else

                u = (u & "?guid=" & str3)

            End If

        End If



        Dim request As HttpRequest = HttpContext.Current.Request

        Dim portAndHost As String = request.Url.Host

        If Not request.Url.Port = 80 AndAlso Not request.Url.Port = 443 Then

            portAndHost = portAndHost & ":" & request.Url.Port.ToString()

        End If

        u = String.Format("http://{0}{1}", portAndHost, New Control().ResolveUrl(u))

        request = Nothing

        Dim client As New System.Net.WebClient

        Dim str2 As String = Nothing

        'HttpContext.Current.Response.Write(u)
        'HttpContext.Current.Response.End()

        'str2 = client.DownloadString(u)
        Try
            'HttpContext.Current.Response.Write(u)


            str2 = client.DownloadString(u)

        Catch exception1 As Exception

            'HttpContext.Current.Response.Write(exception1.ToString())

            Microsoft.VisualBasic.CompilerServices.ProjectData.SetProjectError(exception1)

            Dim exception As Exception = exception1

            Microsoft.VisualBasic.CompilerServices.ProjectData.ClearProjectError()

        End Try

        Return str2
    End Function

    Protected Function Generate() As NakedPassword

        ''# generate a new password
        'Dim newPass As String
        'With Nothing
        '    Dim g As New CryptoPasswordGenerator.Password(False, True, False, True)
        '    g.MaximumLength = 10 : g.MinimumLength = 10
        '    newPass = g.Create()
        'End With

        Return NakedPassword.FromString(GetRandomStrUsingGUID(10))
    End Function

#End Region

    Public Class TemporaryPasswordResult

#Region "ID"
        Private _id As Integer
        Public ReadOnly Property ID() As Integer
            Get
                Return _id
            End Get
        End Property
#End Region

#Region "TemporaryPassword"
        Private _temporarypassword As NakedPassword
        Friend ReadOnly Property TemporaryPassword() As NakedPassword
            Get
                Return _temporarypassword
            End Get
        End Property
#End Region


#Region "Constructor"
        Friend Sub New(ByVal ID As Integer, ByVal TemporaryPassword As NakedPassword)
            _id = ID
            _temporarypassword = TemporaryPassword
        End Sub
#End Region

    End Class

    Protected Function GetRandomStrUsingGUID(ByVal length As Integer) As String
        'Get the GUID
        Dim guidResult As String = Guid.NewGuid().ToString()

        'Remove the hyphens
        guidResult = guidResult.Replace("-", String.Empty)

        'Make sure length is valid
        If length <= 0 OrElse length > guidResult.Length Then
            Throw New ArgumentException("Length must be between 1 and " & guidResult.Length)
        End If

        'Return the first length bytes
        Return guidResult.Substring(0, length)
    End Function

End Class