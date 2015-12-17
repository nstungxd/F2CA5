Imports Microsoft.VisualBasic
Imports PingCore.MyData
Imports System.Data
Imports System.Data.SqlClient
Imports PingCore.MyContent
Imports System.Net.Mail
Imports System.Management
Imports PingCore.Security
Imports System.Web
Imports System.Web.UI
Imports PingSurveys

Namespace PingLibrary

    Public NotInheritable Class UserIdentityClass

        Private Const KnownSession As String = "UserIdentity_Known"

#Region "ID"
        Private _id As Integer
        Public ReadOnly Property ID() As Integer
            Get
                Return _id
            End Get
        End Property
#End Region

#Region "ScreenName"
        Private _screenname As String
        Public ReadOnly Property ScreenName() As String
            Get
                Return _screenname
            End Get
        End Property
#End Region

#Region "EmailAddress"
        Private _emailaddress As String
        Public ReadOnly Property EmailAddress() As String
            Get
                Return _emailaddress
            End Get
        End Property
#End Region

#Region "Password"
        Private _Password As String
        Public ReadOnly Property Password() As String
            Get
                Return _Password
            End Get
        End Property
#End Region

#Region "UTypeID"
        Private _uTypeID As Integer
        Public ReadOnly Property UTypeID() As Integer
            Get
                Return _uTypeID
            End Get
        End Property
#End Region

#Region "UserAccountType"
        Private _UserAccountType As String
        Public ReadOnly Property UserAccountType() As String
            Get
                Return _UserAccountType
            End Get
        End Property
#End Region

#Region "VirtualID"
        Private _virtualID As Integer
        ReadOnly Property VirtualID() As Integer
            Get
                Return _virtualID
            End Get
        End Property
#End Region

#Region "VirtualScreenName"
        Private _virtualScreenName As String
        ReadOnly Property VirtualScreenName() As String
            Get
                Return _virtualScreenName
            End Get
        End Property
#End Region

#Region "VirtualUTypeID"
        Private _virtualutypeid As Integer
        Public ReadOnly Property VirtualUTypeID() As Integer
            Get
                Return _virtualutypeid
            End Get
        End Property
#End Region

#Region "CanViewAll"
        Private _CanViewAll As Boolean
        Public ReadOnly Property CanViewAll() As Boolean
            Get
                Return _CanViewAll
            End Get
        End Property
#End Region

#Region "Constructor"

        Private Sub New(ByVal ID As Integer, ByVal screenName As String, ByVal utypeid As Integer) 'ByVal State As StateEnum, , ByVal IsConfirmed As Boolean
            '_state = State
            _id = ID
            '_isconfirmed = IsConfirmed
            _screenname = screenName
            _uTypeID = utypeid

            SetVirtual()
        End Sub

        Private Sub New(ByVal ID As Integer, ByVal screenName As String, ByVal EmailAddress As String, ByVal Password As String, ByVal UserAccountType As String, CanViewAll As Boolean, Optional utypeid As Integer = 3)
            _id = ID
            _screenname = screenName
            _emailaddress = EmailAddress
            _Password = Password
            _UserAccountType = UserAccountType
            _uTypeID = utypeid
            _CanViewAll = CanViewAll

            SetVirtual()
        End Sub

        Private Sub SetVirtual()
            '# virtual particulars can be impersonated, default is to show the actual particulars
            _virtualID = _id
            _virtualScreenName = _screenname
            _virtualutypeid = _uTypeID

            Dim isAdmin As Boolean = UType.IsAdmin(_uTypeID)
            If isAdmin Then
                '# get the id and other details from the record for this user
                Dim sql As String = String.Format(String.Concat( _
                 "declare @impid int; {0}", _
                 "SELECT @impid = user_impersonating {0}", _
                 "FROM users {0}", _
                 "WHERE user_id = {1};{0}", _
                 "{0}", _
                 "if not (@impid is null) and not (@impid <= 0) {0}", _
                 "begin {0}", _
                 "  select user_id as id, user_screen_name as screenname, user_type_fk as utype {0}", _
                 "  from users {0}", _
                 "  where user_id = @impid;{0}", _
                 "end;"), _
                 vbCrLf, _id)

                Dim dr As DataRow = DBFactory.DB.GetDataRow(sql)
                If dr IsNot Nothing Then
                    _virtualID = DBFactory.FromDB(Of Integer)(dr("id"))
                    _virtualScreenName = DBFactory.FromDB(Of String)(dr("screenname"))
                    _virtualutypeid = DBFactory.FromDB(Of Integer)(dr("utype"))
                End If
            End If
        End Sub

#End Region


        Public Shared Function FromContext(ByVal c As HttpContext, ByVal KnownCookie As MyCookie(Of Integer)) As UserIdentityClass
            '# create user identity from the context of this web request
            Dim knownID As Integer

            Dim isKnown As Boolean ', isConfirmed As Boolean
            With "flags"
                '# known if cookie or session value present
                With "isKnown"

                    Dim knownFromCookie As Integer = 0 'KnownCookie.Value

                    Dim knownFromSession As Integer = 0
                    With "knownFromSession"
                        Dim o As Object = c.Session.Item(KnownSession)
                        If TypeOf o Is Integer Then
                            knownFromSession = CType(o, Integer)
                        End If
                    End With

                    If knownFromSession > 0 Then
                        knownID = knownFromSession
                    ElseIf knownFromCookie > 0 Then
                        knownID = knownFromCookie
                    Else
                        knownID = 0
                    End If

                    If knownID > 0 Then
                        isKnown = True
                        ''# correct the cookie if it holds the incorrect value
                        'If knownFromCookie <> knownID Then
                        '    '# replace value
                        '    c.Response.AppendCookie(New HttpCookie(knownFromCookie, knownID.ToString))
                        'End If
                    End If
                End With


            End With

            '# screenname
            Dim screenname As String = Nothing
            Dim UTypeID As Integer = 0
            If isKnown Then
                '# get screenname
                Dim sdb As SqlDatabaseConnection = Data.DBConnection
                Dim sql As String = "select user_screen_name as screen_name, user_type_fk as type_fk from users where user_id = @UID"
                Dim cmd As SqlCommand = sdb.GetCommand(sql)
                With cmd.Parameters
                    .Add(sdb.NewParameter(Of Integer)("@UID", SqlDbType.BigInt, knownID))
                End With

                Dim dr As DataRow = sdb.GetDataRow(cmd)
                If dr IsNot Nothing Then
                    screenname = DBFactory.FromDB(Of String)(dr("screen_name"))
                    UTypeID = DBFactory.FromDB(Of Integer)(dr("type_fk"))
                End If
            End If

            Dim ui As UserIdentityClass
            'If Not isKnown Then
            '    '# set unknown
            '    ui = New UserIdentityClass(StateEnum.Unknown, 0, False, screenname, UTypeID)

            '    'ElseIf Not isConfirmed Then
            '    '    '# set unconfirmed
            '    '    ui = New UserIdentityClass(StateEnum.Unconfirmed, knownID, False, screenname, UTypeID)

            'Else
            If isKnown Then
                ui = New UserIdentityClass(knownID, screenname, UTypeID)
            Else
                ui = Nothing
            End If

            Dim isLocal As Boolean = False
            With "isLocal"
                If HttpContext.Current.Request.Url.Host.Contains("localhost") Then

                    '# Check to see if we have a value set
                    Try
                        If Not StringUtility.IsNullOrEmpty(System.Configuration.ConfigurationManager.AppSettings("auto_logged_in")) Then
                            Dim IsAutoLoggedIn As String = System.Configuration.ConfigurationManager.AppSettings("auto_logged_in")
                            If IsAutoLoggedIn = "1" Then isLocal = True
                        End If
                    Catch ex As Exception
                    End Try
                End If
            End With

            If isLocal Then
                c.Session("UserIdentity_Confirmed") = True
                Return (New UserIdentityClass(12, "PM", UType.Named(UType.UTypes.SuperAdmin)))
            Else
                '# return this identity
                Return ui
            End If

        End Function

        Public Shared Function FromCredentials(ByVal email As Email, ByVal pwd As NakedPassword) As UserIdentityClass
            '# try to get the user matching these credentials, return nothing if it fails

            '# the plan will be:
            '# - get user record for this email, with hash and salt
            '# - hash local password with same salt, compare hashes
            '# - confirmed on success
            '# - return id or nothing

            If email Is Nothing OrElse pwd Is Nothing Then
                Throw New Exception("should not occur (null email or password)")
            End If

            Dim ui As UserIdentityClass = Nothing


            '# get user record
            Dim dr As DataRow
            With "dr"
                Dim sdb As SqlDatabaseConnection = Data.DBConnection

                Dim sql As String = String.Format(String.Concat( _
                  "select user_id AS id, {0}", _
                  "  user_password_hash AS hash, {0}", _
                  "  user_password_salt AS salt, {0}", _
                  "  user_type_fk AS type_fk, {0}", _
                  "  user_firstname AS firstname, {0}", _
                  "  user_surname AS surname, {0}", _
                  "  user_email AS email, {0}", _
                  "  user_allsurveys AS allsurveys, {0}", _
                  "  user_screen_name as screen_name{0}", _
                  "from users {0}", _
                  "where user_email = @EMAIL"), _
                  vbCrLf)

                Dim cmd = sdb.GetCommand(sql)
                With cmd.Parameters
                    .Add(sdb.NewParameter(Of String)("@EMAIL", SqlDbType.VarChar, email.ToString))
                End With

                dr = sdb.GetDataRow(cmd)
            End With

            If dr IsNot Nothing Then
                '# use local vars for convenience
                Dim id As Integer = DBFactory.FromDB(Of Integer)(dr("id"))
                Dim screenName As String = DBFactory.FromDB(Of String)(dr("screen_name"))
                Dim UTypeID As Integer = DBFactory.FromDB(Of Integer)(dr("type_fk"))
                Dim firstname As String = DBFactory.FromDB(Of String)(dr("firstname"))
                Dim surname As String = DBFactory.FromDB(Of String)(dr("surname"))
                Dim useremail As String = DBFactory.FromDB(Of String)(dr("email"))
                Dim allsurveys As Boolean = DBFactory.FromDB(Of Boolean)(dr("allsurveys"))


                Dim thehash As Hash = Hash.FromHashedBytesOpt(DBFactory.FromDB(Of Byte())(dr("hash")))
                Dim thesalt As Salt = Salt.FromBytesOpt(DBFactory.FromDB(Of Byte())(dr("salt")))

                If thehash IsNot Nothing And thesalt IsNot Nothing Then
                    '# check password
                    If thehash.Matches(pwd, thesalt) Then
                        '# password matches, this identity is valid
                        ui = New UserIdentityClass(id, firstname & " " & surname, useremail, "", "AccountUser", allsurveys, UTypeID)
                    End If
                End If

            End If

            Return ui
        End Function

        Public Shared Function FromXML(ByVal email As Email, ByVal pwd As NakedPassword) As UserIdentityClass
            '# try to get the user matching these credentials, return nothing if it fails

            '# the plan will be:
            '# - run survey query using this email and password as credentials
            '# - if result is returned - then get the details from that result set
            '# - confirmed on successful return of data
            '# - return class or nothing

            If email Is Nothing OrElse pwd Is Nothing Then
                Throw New Exception("should not occur (null email or password)")
            End If

            Dim ui As UserIdentityClass = Nothing

            '# Query API
            Dim ResponseXML As XElement = SurveyFunctions.MakeXMLRaw(email.Value(), pwd.Value(), "accountuser")

            If ResponseXML IsNot Nothing Then
                Dim ResultOk = (From dr In ResponseXML.Elements("result_ok") Select dr).FirstOrDefault()
                Dim Code = (From dr In ResponseXML.Elements("code") Select dr).FirstOrDefault()

                If ResultOk IsNot Nothing AndAlso Not String.IsNullOrEmpty(ResultOk.Value()) Then

                    '# Retrieve a list of the XML items from this response
                    Dim ResponseItems = (From dr In ResponseXML.Elements("data").Elements() Select dr).ToList()

                    If ResponseItems IsNot Nothing AndAlso ResponseItems.Count() > 0 Then
                        For Each ri As XElement In ResponseItems

                            With ri
                                '# use local vars for convenience
                                Dim EmailAddress As String = SurveyFunctions.FormatElement(.Element("email"))

                                If Not String.IsNullOrEmpty(EmailAddress) AndAlso EmailAddress.ToLower() = email.Value Then
                                    Dim id As Integer = SurveyFunctions.FormatElement(.Element("id"))
                                    Dim username As String = SurveyFunctions.FormatElement(.Element("username"))
                                    Dim AccountType As String = SurveyFunctions.FormatElement(.Element("_type"))
                                    Dim Password As String = pwd.Value()

                                    ui = New UserIdentityClass(id, username, EmailAddress, Password, AccountType, True)
                                End If
                            End With

                        Next

                    End If
                End If
            End If

            Return ui
        End Function

        <Flags()> _
        Friend Enum ToContextModeEnum As Integer
            Cookie = 1
            Session = 2
            Both = 4
        End Enum

        Friend Shared Sub ToContext(ByVal ui As UserIdentityClass, ByVal c As HttpContext, ByVal KnownCookie As MyCookie(Of Integer), ByVal mode As ToContextModeEnum)
            '# update the context with the details of this login

            If mode Then

                If mode = ToContextModeEnum.Session Then
                    If ui Is Nothing Then
                        c.Session(KnownSession) = Nothing
                    Else
                        c.Session(KnownSession) = ui.ID
                    End If
                Else
                    '# clear any previous value
                    c.Session(KnownSession) = Nothing
                End If

                If mode = ToContextModeEnum.Cookie Then
                    If ui Is Nothing Then
                        KnownCookie.Value = 0
                    Else
                        KnownCookie.Value = ui.ID
                    End If
                ElseIf KnownCookie IsNot Nothing Then
                    '# clear any previous value
                    KnownCookie.Value = 0
                End If

            End If

        End Sub

    End Class

    Public Class UserControl

        Private Const ConfirmedSession As String = "UserIdentity_Confirmed"

#Region "Identity"
        Private _identity As UserIdentityClass
        Public ReadOnly Property Identity() As UserIdentityClass
            Get
                Return _identity
            End Get
        End Property
#End Region

#Region "IsKnown"
        Public ReadOnly Property IsKnown() As Boolean
            Get
                Return (Identity IsNot Nothing)
            End Get
        End Property
#End Region

#Region "IsConfirmed"
        Private _isconfirmed As Boolean
        Public ReadOnly Property IsConfirmed() As Boolean
            Get
                Return _isconfirmed
            End Get
        End Property

        Private Sub SetIsConfirmed(ByVal c As HttpContext)
            _isconfirmed = True
            c.Session(ConfirmedSession) = True
        End Sub
#End Region

#Region "HasSectionAccess"
        Public Function HasSectionAccess(ByVal sid As Integer) As Boolean
            If Not IsKnown Then
                Return False
            ElseIf Not IsConfirmed Then
                Return False
            Else
                Return UType.HasSectionAccess(Identity.UTypeID, sid)
            End If
        End Function
#End Region

#Region "UserLoggedIn"
        Public Function UserLoggedIn() As Boolean
            If IsConfirmed AndAlso IsKnown Then
                Return True
            Else
                Return False
            End If
        End Function
#End Region

#Region "CurrentUserID"
        Public Function CurrentUserID() As Integer
            If Identity IsNot Nothing AndAlso UserLoggedIn() Then
                Return Identity.ID
            Else
                Return 0
            End If
        End Function
#End Region

#Region "CurrentUserTypeID"
        Public Function CurrentUserTypeID() As Integer
            If Identity IsNot Nothing AndAlso UserLoggedIn() Then
                Return Identity.UTypeID
            Else
                Return 0
            End If
        End Function
#End Region

        Private KnownCookie As MyCookie(Of Integer)

#Region "Constructor"
        Public Sub New(ByVal c As HttpContext)

            '# create cookie wrapper
            KnownCookie = New MyCookie(Of Integer)("UserIdentity_Known", c)

            '# get identity from context
            _identity = UserIdentityClass.FromContext(c, KnownCookie)
            _isconfirmed = DBFactory.FromContext(Of Boolean)(c.Session(ConfirmedSession))

        End Sub

        Public Sub New()
        End Sub
#End Region

        Public Function Login(ByVal email As Email, ByVal pwd As NakedPassword, Optional ByVal c As HttpContext = Nothing) As Boolean
            If c Is Nothing Then c = HttpContext.Current

            '# login using credentials
            If email Is Nothing OrElse pwd Is Nothing Then
                Throw New Exception("should not occur (null email or password)")
            End If

            Dim ui As UserIdentityClass = UserIdentityClass.FromCredentials(email, pwd)
            If ui Is Nothing Then
                '# login failed, 
                Logout(c)

                Return False
            Else
                '# login passed
                UserIdentityClass.ToContext(ui, c, KnownCookie, UserIdentityClass.ToContextModeEnum.Session)
                SetIsConfirmed(c)
                _identity = ui

                HttpContext.Current.Session("CurrentUserID") = ui.ID

                Return True
            End If
        End Function

        Public Function LoginFromXML(ByVal email As Email, ByVal pwd As NakedPassword, Optional ByVal c As HttpContext = Nothing) As Boolean

            If c Is Nothing Then c = HttpContext.Current

            '# login using credentials
            If email Is Nothing OrElse pwd Is Nothing Then
                Throw New Exception("should not occur (null email or password)")
            End If

            Dim ui As UserIdentityClass = UserIdentityClass.FromXML(email, pwd)
            If ui Is Nothing Then
                '# login failed, 
                Logout(c)

                Return False
            Else
                '# login passed
                UserIdentityClass.ToContext(ui, c, KnownCookie, UserIdentityClass.ToContextModeEnum.Session)
                SetIsConfirmed(c)
                _identity = ui

                HttpContext.Current.Session("CurrentUserID") = ui.ID

                Return True
            End If
        End Function

#Region "Logout"

        Public Event LoggedOut(ByVal sender As Object, ByVal e As EventArgs)

        Public Sub Logout(Optional ByVal c As HttpContext = Nothing)
            If c Is Nothing Then c = HttpContext.Current

            UserIdentityClass.ToContext(Nothing, c, KnownCookie, UserIdentityClass.ToContextModeEnum.Session)
            _identity = UserIdentityClass.FromContext(c, KnownCookie)

            '# we have logged out, now trigger any attendant actions
            RaiseEvent LoggedOut(Me, EventArgs.Empty)
        End Sub

#End Region

        Public Sub Impersonate(ByVal id As Integer)
            '# impersonate this user iff this is an admin
            If UType.IsAdmin(Me.Identity.UTypeID) Then
                '# update the database
                Dim sql As String = String.Format("update users set user_impersonating = {0} where user_id = {1}", id.ToString, Me.Identity.ID.ToString)
                DBFactory.DB.RunSQL(sql)
            End If
        End Sub

        Public Sub StopImpersonating()
            '# clear the relevant field
            Dim sql As String = "update users set user_impersonating = null where user_id = " & Me.Identity.ID.ToString
            DBFactory.DB.RunSQL(sql)
        End Sub

        Public ReadOnly Property IsImpersonating() As Boolean
            Get
                If IsKnown AndAlso IsConfirmed AndAlso Identity.ID <> Identity.VirtualID Then
                    Return True
                Else
                    Return False
                End If
            End Get
        End Property


        Public Sub LogoutWithAbort()
            Dim c As HttpContext = HttpContext.Current
            Logout(c)

            Dim url As String
            With "url"
                Dim o As New Control()
                url = o.ResolveClientUrl("~/")
            End With

            c.Response.Redirect(url)
        End Sub

#Region "TemporaryPassword"

#Region "Exceptions"

        Public Class TP_UserMissingException
            Inherits ApplicationException
        End Class

        Public Class TP_NullContentException
            Inherits ApplicationException
        End Class

        Public Class TP_NoRowsSetException
            Inherits ApplicationException
        End Class

        Public Class TP_MailSendException
            Inherits ApplicationException

            Public Sub New()
                MyBase.New()
            End Sub

            Public Sub New(ByVal ie As Exception)
                MyBase.New("mail error", ie)
            End Sub
        End Class

#End Region


        Private Const TmpLength As Integer = 10

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

        Private Shared Function Generate() As NakedPassword

            '# generate a new password
            Dim newPass As String = Guid.NewGuid().ToString()
            'With Nothing
            '    Dim g As New cpg.Password(False, True, False, True)
            '    g.MaximumLength = TmpLength : g.MinimumLength = TmpLength
            '    newPass = g.Create()
            'End With

            Return NakedPassword.FromString(newPass)
        End Function


#Region "IssueTemporaryPassword"

        <Flags()> Public Enum ITPResult As Integer
            Success = 1
            MailSent = 3
            MailSentPrev = 5
            UserMissing = 8
            MailError = 16
            NoTemplate = 32
        End Enum

        Public Shared Function IssueTemporaryPassword(ByVal email As PingCore.MyData.Email) As ITPResult

            '# generate temporary password, send the email to the user
            Dim tp As TemporaryPasswordResult = Nothing
            tp = UserControl.SetNewTemporaryPassword(email)
            Try
            Catch ex As UserControl.TP_UserMissingException
                '# couldn't find the user
                Return ITPResult.UserMissing

                'AppendValidationError(EmailHolder, "No user matches this email address.")
            End Try

            If tp IsNot Nothing Then
                '# send mail
                Dim success As Boolean = False
                Try
                    success = SendTemporaryPasswordMail(tp)
                Catch ex As TP_NullContentException
                    '# assume this was sent previously
                    Return ITPResult.NoTemplate
                End Try

                If Not success Then
                    Return ITPResult.MailError
                Else
                    Return ITPResult.MailSent
                End If
            Else
                Return ITPResult.NoTemplate
            End If
        End Function


        Public Shared Function SetNewTemporaryPassword(ByVal email As Email) As TemporaryPasswordResult 'returns the temporary password and the user id
            Dim sdb As SqlDatabaseConnection = Data.DBConnection
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
                Throw New TP_UserMissingException

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
                    Throw New TP_NoRowsSetException
                End If
            End If

            Return result
        End Function

        Public Shared Function SendTemporaryPasswordMail(ByVal tp As TemporaryPasswordResult) As Boolean
            '# send mail to this user
            Dim success As Boolean = False

            If tp Is Nothing Then
                Throw New ArgumentNullException("tp")
            Else

                '# get email
                Dim email As Email = Nothing
                With "email"
                    Dim sdb As SqlDatabaseConnection = Data.DBConnection

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
                    Throw New TP_UserMissingException
                Else

                    '# get mail content
                    Dim c As String = GetUrl("~/account/mail/mail_TemporaryPassword.aspx")
                    If c Is Nothing Then
                        Throw New TP_NullContentException
                    Else

                        '# we have the email and the content, now prepare the email for sending

                        c = c.Replace("<!-- secretcode -->", tp.TemporaryPassword.Value)
                        c = c.Replace("<!-- email -->", HttpContext.Current.Server.UrlEncode(email.ToString))

                        '# send the email
                        Try
                            Dim mail As New MailMessage()

                            'set the addresses
                            mail.From = New MailAddress(Mailer.From)
                            mail.To.Add(email.ToString)

                            'set the content
                            Dim SiteName As String = System.Configuration.ConfigurationManager.AppSettings("site_name").ToString()
                            mail.Subject = SiteName & " - Password Reset"
                            mail.IsBodyHtml = True
                            mail.Body = c

                            'HttpContext.Current.Response.Write("Just about to send email")

                            Dim smtp As SmtpClient = Mailer.Server
                            smtp.Credentials = New System.Net.NetworkCredential("mail@secureping", "P0pc0rn")
                            smtp.Send(mail)

                            '# success
                            success = True
                        Catch ex As Exception
                            Throw New TP_MailSendException(ex)
                        End Try
                    End If
                End If
            End If

            Return success
        End Function

        Public Shared Function GetUrl(ByVal u As String, Optional ByVal secure As Boolean = True) As String
            If secure Then

                Dim str3 As String = Guid.NewGuid.ToString

                Dim sqlDB As SqlDatabaseConnection = Data.DBConnection

                Dim sql As String = String.Format(String.Concat(New String() {"insert into zz_admin_securewebrequests (guid) values(@GUID);"}), ChrW(13) & ChrW(10))

                Dim cmd As SqlCommand = DirectCast(sqlDB.GetCommand(sql), SqlCommand)

                cmd.Parameters.Add(sqlDB.NewParameter(Of String)("@GUID", SqlDbType.VarChar, str3))

                sqlDB.RunSQL(cmd)

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



#End Region

#End Region




    End Class

End Namespace
