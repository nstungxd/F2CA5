Imports System
Imports PingCore

Partial Class MailTemporaryPassword_Behind
    Inherits MyData.SecureRequestPage
    Public ReadOnly Property HostName As String
        Get

            Dim WebSiteURL As String = ConfigurationManager.AppSettings("website_address")
            WebSiteURL = WebSiteURL.Replace("http://", "")

            If Request.Url.Host.ToLower.Contains("www") Then
                Return WebSiteURL
            ElseIf Request.Url.Host.ToLower.Contains("uat") Then
                Return WebSiteURL.Replace("www", "uat")
            ElseIf Request.Url.Host.ToLower.Contains("localhost") Then
                Return "localhost:" & Request.ServerVariables("SERVER_PORT")
            Else
                Return WebSiteURL
            End If
        End Get
    End Property
End Class
