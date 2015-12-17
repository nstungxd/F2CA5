Imports Microsoft.VisualBasic
Imports PingCore
Imports PingCore.MyData
Imports System.Web.UI
Imports PingCore.SharedMethods
Imports PingCore.MyModule
Imports PingLibrary

Public Interface LocalSiteInterface
    ReadOnly Property IdentityControl As PingLibrary.UserControl
    Sub SetSEOData(ByVal Title As String, ByVal Keywords As String, ByVal Description As String)
    Property RequiresSSL() As Boolean
    Function UserLoggedIn() As Boolean
    Sub OverrideAnalytics()
    Property CurrentSurveyControl As PingSurveys.SurveyControl
End Interface
