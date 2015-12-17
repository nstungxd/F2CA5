Imports PingCore.MyData
Imports PingCore.MySystem
Imports PingLibrary
Imports System.Data
Imports PingSurveys

Partial Class SignIn
    Inherits System.Web.UI.Page

#Region "IdentityControl"
    Public ReadOnly Property IdentityControl() As PingLibrary.UserControl
        Get
            If Session("UserControl") Is Nothing Then Session("UserControl") = New PingLibrary.UserControl()

            '# Get the current survery control class
            Dim UserControl As PingLibrary.UserControl = CType(Session("UserControl"), PingLibrary.UserControl)

            Return UserControl
        End Get
    End Property
#End Region

#Region "CurrentSurveyControl"
    Public Property CurrentSurveyControl() As SurveyControl
        Get
            If Session("CurrentSurveyControl") Is Nothing Then Session("CurrentSurveyControl") = New SurveyControl()

            '# Get the current survery control class
            Dim SurveyControl As SurveyControl = CType(Session("CurrentSurveyControl"), SurveyControl)

            Return SurveyControl
        End Get
        Set(ByVal value As SurveyControl)
            Session("CurrentSurveyControl") = value
        End Set
    End Property
#End Region

    Protected Sub Page_Init(ByVal sender As Object, ByVal e As System.EventArgs) Handles Me.Init
        regEmail.ValidationExpression = ConfigurationManager.AppSettings("EmailRegEx")
    End Sub

#Region "Login"
    Protected Sub btnLogin_Click(ByVal sender As Object, ByVal e As EventArgs) Handles btnLogin.Click
        If Page.IsValid Then

            '# attempt to log in
            '# Test Creds: info@bluskymarketing.com & test123 - Permission Denied(getList)
            Dim success As Boolean = IdentityControl.Login(Email.FromString(txtEmail.Text), NakedPassword.FromString(txtPassword.Text))

            If Not success Then

                Dim c As New CustomValidator()
                c.IsValid = False
                c.Text = "&nbsp;"
                c.ErrorMessage = "<div class='warning'><p>There was a problem signing you in. Please check your email/password and try again.</p></div>"
                c.Text = "<div class='warning'><p>There was a problem signing you in. Please check your email/password and try again.</p></div>"
                c.CssClass = "sf_row_faillist"
                c.Style("padding") = "10px 0 0 10px"
                c.Style("display") = "block"

                phSignInForm.Visible = True
                phSignInForm.Controls.Add(c)

            Else
                '# Log login
                DataLogic.UpdateUserLoggedInformation(IdentityControl.Identity.ID)

                '# success
                Response.Redirect("/surveys/", False)
            End If
        Else
            phSignInForm.Visible = False
        End If

    End Sub
#End Region

End Class
