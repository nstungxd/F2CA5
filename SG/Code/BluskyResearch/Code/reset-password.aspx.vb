Imports PingCore.MyData
Imports PingCore
Imports System.Data
Imports System.Data.SqlClient
Imports PingCore.MyContent
Imports PingCore.MySystem
Imports PingLibrary

Partial Class Account_reset_password
    Inherits System.Web.UI.Page

#Region "LocalSiteInterface"
    Private _LocalSiteInterface As New Memo(Of LocalSiteInterface)(AddressOf GetLocalSiteInterface)
    ReadOnly Property LocalSiteInterface() As LocalSiteInterface
        Get
            Return _LocalSiteInterface.Value
        End Get
    End Property

    Function GetLocalSiteInterface() As LocalSiteInterface
        Return CType(Page.Master, LocalSiteInterface)
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

            '# Pre-set data
            If Not Request.QueryString Is Nothing Then
                If Not String.IsNullOrEmpty(Request.QueryString("email")) Then txtEmail.Text = Request.QueryString("email").ToString()
                If Not String.IsNullOrEmpty(Request.QueryString("code")) Then txtTempPassword.Text = Request.QueryString("code").ToString()
            Else
                If Session("ForgotPasswordEmail") IsNot Nothing Then
                    txtEmail.Text = Session("ForgotPasswordEmail")
                Else
                    txtEmail.Text = DataFunctions.GetColumnFromDataRow(DataAccess.GetUserByID(CurrentUserID), "user_email")
                End If
            End If

        End If
    End Sub

    Sub btnConfirm_Click(ByVal sender As Object, ByVal e As EventArgs) Handles btnConfirm.Click
        If Page.IsValid Then

            Dim CurrentEmail As Email = Email.FromString(txtEmail.Text)
            Dim TempPassword As NakedPassword = NakedPassword.FromString(txtTempPassword.Text)
            Dim NewPassword As NakedPassword = NakedPassword.FromString(txtNewPassword.Text)

            Try
                ResetPassword(CurrentEmail, TempPassword, NewPassword)
            Catch ex As RP_UserMissingException
                AppendValidationError("Can't find this email address. Please check and try again.<br />")
            Catch ex As RP_UnsetTemporaryException
                mvResetPassword.ActiveViewIndex = 1
            Catch ex As RP_TemporaryMismatchException
                AppendValidationError("Temporary password entered is incorrect. Please check your email.<br />")
            Catch ex As Exception
                AppendValidationError("There was a problem trying to reset your password. Please try again.<br />")
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

        phResetPasswordForm.Visible = True
        phResetPasswordForm.Controls.Add(c)

    End Sub

#Region "ResetPassword"

    Public Class RP_UserMissingException : Inherits ApplicationException : End Class
    Public Class RP_UnsetTemporaryException : Inherits ApplicationException : End Class
    Public Class RP_TemporaryMismatchException : Inherits ApplicationException : End Class

    Private Sub ResetPassword(ByVal EmailAddress As Email, ByVal TempPassword As NakedPassword, ByVal NewPassword As NakedPassword)

        If EmailAddress Is Nothing OrElse TempPassword Is Nothing OrElse NewPassword Is Nothing Then
            Throw New ArgumentNullException()
        Else

            Dim UserID As Integer = 0
            Dim TempSalt As Salt = Nothing
            Dim TempHash As Hash = Nothing

            Dim UserRecord As DataRow = DataAccess.GetUserByEmail(EmailAddress.ToString())

            If UserRecord IsNot Nothing Then
                UserID = DBFactory.FromDB(Of Integer)(UserRecord("user_id"))
                TempSalt = Salt.FromBytesOpt(DBFactory.FromDB(Of Byte())(UserRecord("user_temporary_salt")))
                TempHash = Hash.FromHashedBytesOpt(DBFactory.FromDB(Of Byte())(UserRecord("user_temporary_hash")))
            End If

            If UserID <= 0 Then
                Throw New RP_UserMissingException

            ElseIf TempSalt Is Nothing OrElse TempHash Is Nothing Then
                Throw New RP_UnsetTemporaryException

            Else

                Dim TempPasswordValid As Boolean = TempHash.Matches(TempPassword, TempSalt)

                If Not TempPasswordValid Then
                    Throw New RP_TemporaryMismatchException
                Else
                    Dim NewSalt As Salt = Salt.Generate
                    Dim NewHash As Hash = Hash.FromPassword(NewPassword, NewSalt)

                    Dim Result As Boolean = DataLogic.UpdateUserPassword(UserID, NewHash, NewSalt)

                    If Result Then
                        '# Login user
                        LocalSiteInterface.IdentityControl.Login(EmailAddress, NewPassword)

                        DataLogic.UpdateUserLoggedInformation(UserID)

                        '# Show success"
                        mvResetPassword.ActiveViewIndex = 2
                    Else
                        Throw New Exception()
                    End If

                End If
            End If
        End If
    End Sub

#End Region

End Class
