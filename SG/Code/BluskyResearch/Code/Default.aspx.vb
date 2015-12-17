Imports System.Data
Imports PingLibrary
Imports PingCore.MySystem
Imports PingSurveys
Imports System.Net
Imports System.Dynamic
Imports PingSurveys.SurveyLibrary

Partial Class _Default
    Inherits System.Web.UI.Page

#Region "IdentityControl"
    Public ReadOnly Property IdentityControl As PingLibrary.UserControl
        Get
            If Session("UserControl") Is Nothing Then Session("UserControl") = New PingLibrary.UserControl()

            '# Get the current survery control class
            Dim UserControl As PingLibrary.UserControl = CType(Session("UserControl"), PingLibrary.UserControl)

            Return UserControl
        End Get
    End Property
#End Region

#Region "CurrentSurveyControl"
    Public Property CurrentSurveyControl As SurveyControl
        Get
            If Session("CurrentSurveyControl") Is Nothing Then Session("CurrentSurveyControl") = New SurveyControl()

            '# Get the current survery control class
            Dim SurveyControl As SurveyControl = CType(Session("CurrentSurveyControl"), SurveyControl)

            Return SurveyControl
        End Get
        Set(value As SurveyControl)
            Session("CurrentSurveyControl") = value
        End Set
    End Property
#End Region

    Protected Sub Page_Init(sender As Object, e As EventArgs) Handles Me.Init
        If IdentityControl.UserLoggedIn() Then
            Response.Redirect("/surveys/", False)
        Else
            Response.Redirect("/SignIn.aspx", False)
        End If
    End Sub
End Class
