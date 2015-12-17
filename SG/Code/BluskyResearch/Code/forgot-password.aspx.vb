Imports PingCore.MySystem
Imports PingLibrary
Imports PingCore.MyData
Imports uic = PingCore.UserIdentityControl
Imports System.Data.SqlClient
Imports System.Data

Partial Class Account_forgot_password
    Inherits System.Web.UI.Page

#Region "LocalSiteInterface"
    Private _LocalSiteInterface As New Memo(Of LocalSiteInterface)(AddressOf GetLocalSiteInterface)
    ReadOnly Property LocalSiteInterface() As LocalSiteInterface
        Get
            Return _LocalSiteInterface.Value
        End Get
    End Property

    Function GetLocalSiteInterface() As LocalSiteInterface
        Return CType(Me.Page.Master, LocalSiteInterface)
    End Function
#End Region

#Region "CurrentUser"
    Protected ReadOnly Property CurrentUserID() As Integer
        Get

            If ViewState("CurrentUserID") Is Nothing Then
                ViewState("CurrentUserID") = GlobalMethods.CurrentUserID(LocalSiteInterface.IdentityControl)
            End If

            Return CType(ViewState("CurrentUserID"), Integer)

        End Get
    End Property
#End Region

    Sub Page_Init(ByVal sender As Object, ByVal e As EventArgs) Handles Me.Init
        regEmail.ValidationExpression = ConfigurationManager.AppSettings("EmailRegEx")
    End Sub

    Sub Page_Load(ByVal sender As Object, ByVal e As EventArgs) Handles Me.Load

        If Not IsPostBack AndAlso String.IsNullOrEmpty(txtEmail.Text) Then

            '# Pre-set email
            If Session("ForgotPasswordEmail") IsNot Nothing Then
                txtEmail.Text = Session("ForgotPasswordEmail")
            Else
                txtEmail.Text = DataFunctions.GetColumnFromDataRow(DataAccess.GetUserByID(CurrentUserID), "user_email")
            End If

        End If

    End Sub

    Sub btnConfirm_Click(ByVal sender As Object, ByVal e As EventArgs) Handles btnConfirm.Click
        If Page.IsValid Then

            '# Get email
            Dim UserEmail As Email = Email.FromString(txtEmail.Text)

            Try
                Dim res As uic.ITPResult = IssueTemporaryPassword(UserEmail)

                If res = uic.ITPResult.UserMissing Then
                    AppendValidationError("Can't find this email address. Please check and try again.<br />")

                ElseIf res And uic.ITPResult.Success Then

                    '# success, the mail was sent, show message
                    mvForgotPassword.ActiveViewIndex = 1
                    litSentEmail.Text = UserEmail.ToString()
                    Session("ForgotPasswordEmail") = UserEmail.ToString()

                Else
                    AppendValidationError("There was a problem trying to send your reset email. Please try again.<br />" & res.ToString())
                End If
            Catch ex As Exception
                AppendValidationError("There was a problem trying to send your reset email. Please try again.<br />" & ex.Message)
            End Try

        End If
    End Sub

    Protected Sub AppendValidationError(ByVal msg As String)

        Dim c As New CustomValidator()
        c.IsValid = False
        c.Text = "&nbsp;"
        c.ErrorMessage = "<div class='warning'><p>" & msg & "</p></div>"
        c.Text = "<div class='warning'><p>" & msg & "</p></div>"
        c.CssClass = "sf_row_faillist"
        c.Style("padding") = "10px 0 0 10px"
        c.Style("display") = "block"

        phForgotPasswordForm.Visible = True
        phForgotPasswordForm.Controls.Add(c)

    End Sub

#Region "Temporary Password"

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

        Dim sdb As PingLibrary.SqlDatabaseConnection = Data.Connect()

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
                Dim sdb As PingLibrary.SqlDatabaseConnection = Data.Connect()

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
                        success = EmailLibrary.SendEmail(SiteName & " - Password Reset", c, email.ToString)
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

            Dim sdb As PingLibrary.SqlDatabaseConnection = Data.Connect()

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

#End Region

End Class
