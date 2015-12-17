Imports System.Data
Imports PingLibrary
Imports PingCore.MySystem
Imports PingCore.MyData

Partial Class Admin_sections_pm_users_add
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

#Region "Register"

    Protected Sub btnRegister_Click(ByVal sender As Object, ByVal e As System.EventArgs) Handles btnRegister.Click
        If Page.IsValid Then

            Dim msg As String = ""
            Dim EmailAddress As String = txtEmail.Text

            '# Check if user already exisits
            Dim UserExists As Boolean = DataLogic.CheckUserExists(EmailAddress)

            If Not UserExists Then

                Try

                    '# Register User
                    Dim FirstName As String = txtFirstName.Text
                    Dim Surname As String = txtSurname.Text

                    Dim UserID As Integer = DataLogic.AddUser(Title, FirstName, Surname, EmailAddress, NakedPassword.FromString(txtPassword.Text), ddlUserType.SelectedValue)

                    '# Check result
                    If UserID > 0 Then

                        '# Update user with extra information
                        DataLogic.UpdateUserExtraInformation(EmailAddress, "", False, "", "", "")

                        '# Handle results - redirect accordingly
                        Response.Redirect("/admin/sections/pm-users.aspx")

                    Else
                        ShowRegistrationFail("There was a problem with your registration email and/or password. Please try again.")
                    End If

                Catch ex As Exception
                    DataLogic.LogError(ex.Message, "btnRegister_Click()")
                    ShowRegistrationFail("There was a problem with your registration. Please try again.<br />" & ex.Message)
                End Try

            Else
                ShowRegistrationFail("This email address already exists. Please try another address.")
            End If

        End If
    End Sub

    Protected Sub ShowRegistrationFail(ByVal Msg As String)

        Dim c As New CustomValidator()
        c.IsValid = False
        c.Text = "&nbsp;"
        c.ErrorMessage = "<span>" & Msg & "</span>"
        c.Text = "<span>" & Msg & "</span>"
        c.CssClass = "admin_form_fail"
        c.ForeColor = Drawing.Color.FromArgb(123, 4, 15)
        c.Style("display") = "block"

        phRegisterForm.Visible = True
        phRegisterForm.Controls.Add(c)

    End Sub

#End Region

End Class
