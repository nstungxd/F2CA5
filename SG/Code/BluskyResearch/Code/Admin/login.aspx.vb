Imports PingCore.MySystem
Imports PingLibrary
Imports PingCore.MyData

Partial Class Admin_login
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

    Protected Sub Page_Init(ByVal sender As Object, ByVal e As System.EventArgs) Handles Me.Init
        regEmail.ValidationExpression = ConfigurationManager.AppSettings("EmailRegEx")
    End Sub

    Protected Sub btnSignIn_Click(ByVal sender As Object, ByVal e As System.EventArgs) Handles btnSignIn.Click
        If Page.IsValid Then

            '# attempt to log in
            Dim success As Boolean = LocalSiteInterface.IdentityControl.Login(Email.FromString(txtEmail.Text), NakedPassword.FromString(txtPassword.Text))

            If Not success Then

                Dim c As New CustomValidator()
                c.IsValid = False
                c.Text = "&nbsp;"
                c.ErrorMessage = "<span>There was a problem signing you in. Please check your email/password and try again.</span>"
                c.Text = "<span>There was a problem signing you in. Please check your email/password and try again.</span>"
                c.CssClass = "admin_form_fail"
                c.ForeColor = Drawing.Color.FromArgb(123, 4, 15)
                c.Style("display") = "block"

                phSignInForm.Visible = True
                phSignInForm.Controls.Add(c)

            Else

                '# Log login
                DataLogic.UpdateUserLoggedInformation(LocalSiteInterface.IdentityControl.Identity.ID)

                '# success
                If LocalSiteInterface.IdentityControl.Identity.UTypeID = 3 Then
                    Response.Redirect("/")
                Else
                    Response.Redirect("/admin/sections/")
                End If
            End If
        Else
            phSignInForm.Visible = False
            phSignInForm.Controls.Clear()
        End If
    End Sub

End Class
