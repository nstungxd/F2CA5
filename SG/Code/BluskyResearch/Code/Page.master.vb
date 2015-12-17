Imports PingCore.MyData
Imports PingCore.MySystem
Imports PingCore
Imports PingLibrary
Imports System.Data
Imports PingSurveys

Partial Class Page
    Inherits Controls.MasterPage
    Implements LocalSiteInterface

#Region "Master functions"

#Region "TheHTTPContext"
    Public Overrides Property TheHTTPContext As System.Web.HttpContext
        Get
            Return HttpContext.Current
        End Get
        Set(ByVal value As System.Web.HttpContext)
            HttpContext.Current = value
        End Set
    End Property
#End Region

#Region "IdentityControl"
    Public ReadOnly Property IdentityControl As PingLibrary.UserControl Implements LocalSiteInterface.IdentityControl
        Get
            If Session("UserControl") Is Nothing Then Session("UserControl") = New PingLibrary.UserControl()

            '# Get the current survery control class
            Dim UserControl As PingLibrary.UserControl = CType(Session("UserControl"), PingLibrary.UserControl)

            Return UserControl
        End Get
    End Property
#End Region

#Region "OverrideAnalytics"
    Public Sub OverrideAnalytics() Implements LocalSiteInterface.OverrideAnalytics
        phAnalyticsCode.Visible = False
    End Sub
#End Region

#Region "RequiresSSL"
    Private _RequiresSSL As Boolean = False
    Public Property RequiresSSL() As Boolean Implements LocalSiteInterface.RequiresSSL
        Get
            Return _RequiresSSL
        End Get
        Set(ByVal value As Boolean)
            _RequiresSSL = value
        End Set
    End Property
#End Region

#Region "SEO"
    Public Sub SetSEOData(ByVal Title As String, ByVal Keywords As String, ByVal Description As String) Implements LocalSiteInterface.SetSEOData

        '# Get SEO Info
        Dim TitleRow As DataRow = DataAccess.GetGlobalContentByID(1)
        Dim KeywordsRow As DataRow = DataAccess.GetGlobalContentByID(2)
        Dim DescriptionRow As DataRow = DataAccess.GetGlobalContentByID(3)

        Dim TitleDefault As String = ""
        If TitleRow IsNot Nothing Then
            TitleDefault = TitleRow.Item("Information")
        End If

        If DescriptionRow IsNot Nothing AndAlso String.IsNullOrEmpty(Description) Then
            Description = DescriptionRow.Item("Information")
        End If

        If KeywordsRow IsNot Nothing AndAlso String.IsNullOrEmpty(Keywords) Then
            Keywords = KeywordsRow.Item("Information")
        End If

        If Not String.IsNullOrEmpty(Title) Then
            Me.Page.Header.Title = Title
        Else
            Me.Page.Header.Title = TitleDefault
        End If

        '# Load the Meta Description
        If Not String.IsNullOrEmpty(Description) Then
            Dim metaDesc As HtmlMeta = New HtmlMeta
            With metaDesc
                .Name = "description"
                .Content = Description
                Me.Page.Header.Controls.Add(metaDesc)
            End With
        End If

        '# Load the Meta Keywords
        If Not String.IsNullOrEmpty(Keywords) Then
            Dim metaKey As HtmlMeta = New HtmlMeta
            With metaKey
                .Name = "keywords"
                .Content = Keywords
                Me.Page.Header.Controls.Add(metaKey)
            End With
        End If

    End Sub
#End Region

#Region "UserLoggedIn"
    Public Function UserLoggedIn() As Boolean Implements LocalSiteInterface.UserLoggedIn
        Return GlobalMethods.UserLoggedIn(IdentityControl)
    End Function
#End Region

#Region "CurrentSurveyControl"
    Public Property CurrentSurveyControl As SurveyControl Implements LocalSiteInterface.CurrentSurveyControl
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

#End Region

#Region "Page Methods"
    Protected Sub Page_Init(ByVal sender As Object, ByVal e As System.EventArgs) Handles Me.Init
        'WWWRedirect()
    End Sub

    Protected Sub Page_Load(ByVal sender As Object, ByVal e As System.EventArgs) Handles Me.Load
        If Not IsPostBack Then
            LoadGlobalContent()
            SetNavigation()
            CheckLoggedInStatus()
        End If
    End Sub
#End Region

#Region "WWW Redirect"
    Protected Sub WWWRedirect()

        '# Ensure we are on the www. version of the site
        Dim Builder As UriBuilder = New UriBuilder(Request.Url)

        If Not (Request.Url.Host.ToLower.StartsWith("www.") OrElse Request.Url.Host.ToLower.StartsWith("localhost") OrElse Request.Url.Host.ToLower.StartsWith("uat") OrElse Request.Url.Host.ToLower.StartsWith("login")) Then

            Builder.Host = "www." & Request.Url.Host

            If Request.RawUrl.Contains("?") Then
                Builder.Path = Left(Request.RawUrl, Request.RawUrl.ToString.IndexOf("?"))
            Else
                Builder.Path = Request.RawUrl
            End If

            Builder.Query = Request.QueryString().ToString
            'Redirect301(Builder.Uri.ToString().ToLower().Replace("/default.aspx", "/"))

        End If

    End Sub

    Private Sub Redirect301(ByVal redirectURL As String)
        Response.Status = "301 Moved Permanently"
        Response.AddHeader("Location", redirectURL)
    End Sub
#End Region

#Region "Navigation"

    Sub SetNavigation()

        '# Get current section
        Dim CurrentSection As String = String.Empty
        Dim CurrentURL As String = Request.RawUrl.ToLower()

        If Page.RouteData.Values("Section") IsNot Nothing Then
            CurrentSection = Page.RouteData.Values("Section")
        ElseIf CurrentURL.Contains("/news") Then
            CurrentSection = "news"
        End If

    End Sub

#End Region

#Region "Account/Log in/Logged in views"
    Protected Sub CheckLoggedInStatus()
        If UserLoggedIn() Then

        End If
    End Sub
#End Region

#Region "Global Content"
    Protected Sub LoadGlobalContent()
    End Sub
#End Region

End Class

