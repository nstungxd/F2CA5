Imports PingCore
Imports PingCore.MyData
Imports PingCore.GeneralStuff
Imports PingCore.MySystem
Imports PingLibrary
Imports System.Data
Imports PingSurveys

Partial Class Admin_admin
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
    End Sub
#End Region

#Region "UserLoggedIn"
    Public Function UserLoggedIn() As Boolean Implements LocalSiteInterface.UserLoggedIn
        If Not TheIdentityControl Is Nothing Then
            If TheIdentityControl.IsConfirmed AndAlso TheIdentityControl.IsKnown Then
                Return True
            Else
                Return False
            End If
        Else
            Return False
        End If
    End Function
#End Region
#End Region

#Region "UserTypeID"
    Public Property UserTypeID As Integer
#End Region

#Region "CurrentGroupID"
    Public Property CurrentGroupID As Integer
#End Region

#Region "CurrentPageID"
    Public Property CurrentPageID As Integer
#End Region

    Protected Sub Page_Init(ByVal sender As Object, ByVal e As System.EventArgs) Handles Me.Init
        If (IdentityControl Is Nothing OrElse Not IdentityControl.IsKnown OrElse Not IdentityControl.IsConfirmed) AndAlso Not Request.RawUrl.Contains("login.aspx") Then
            'IdentityControl.LogoutWithAbort()
            Response.Redirect("/admin/login.aspx")
        End If
    End Sub

    Protected Sub Page_Load(ByVal sender As Object, ByVal e As System.EventArgs) Handles Me.Load

        'Page.Header.Controls.Add(New LiteralControl(PageContent.ConstructCssLink(Me.ResolveClientUrl("~/Media/CSS/admin_style.css"))))

        With "overlib"
            Dim names As Cons(Of String) = New Cons(Of String)( _
                "overlib.js", _
                "overlib_anchor.js", _
                "overlib_centerpopup.js", _
                "overlib_crossframe.js", _
                "overlib_cssstyle.js", _
                "overlib_debug.js", _
                "overlib_exclusive.js", _
                "overlib_followscroll.js", _
                "overlib_hideform.js", _
                "overlib_setonoff.js", _
                "overlib_shadow.js")

            '# map to tags
            Dim tags As Cons(Of String) = Nothing : cons.Map(AddressOf MapNameToTag, names, tags)

            '# concat into one string
            Dim s As String = cons.FoldWithState(AddressOf Funcs.Join, Nothing, "", tags)

            '# place it
            Page.Header.Controls.Add(New LiteralControl(s))
        End With

        If Not IsPostBack Then
            LoadUserInfo()
            LoadNavigation()
        End If
    End Sub

    Function MapNameToTag(ByVal x As String) As String
        If x Is Nothing Then
            Return Nothing
        Else
            Return String.Format("<script type=""text/javascript"" src=""{1}""></script>{0}", vbCrLf, Me.ResolveClientUrl("overlib/" & x))
        End If
    End Function

    Protected Sub Logout_Click(ByVal sender As Object, ByVal e As System.EventArgs)

        If IdentityControl IsNot Nothing Then
            IdentityControl.Logout()
        End If

        Response.Redirect("/")
    End Sub

#Region "User Info"
    Protected Sub LoadUserInfo()

        If Request.RawUrl.Contains("login.aspx") Then
            '# do nothing else
        Else
            If IdentityControl IsNot Nothing Then
                With IdentityControl
                    If .IsKnown And .IsConfirmed Then
                        Dim UserRecord As DataRow = DataAccess.GetUserByID(.Identity.ID)
                        litUserName.Text = DataFunctions.GetColumnFromDataRow(UserRecord, "user_firstname") & " " & DataFunctions.GetColumnFromDataRow(UserRecord, "user_surname")

                        UserTypeID = .Identity.UTypeID

                        If UserTypeID = 3 Then
                            Response.Redirect("/")
                        End If

                    Else
                        'IdentityControl.LogoutWithAbort()
                        Response.Redirect("/admin/login.aspx")
                    End If
                End With
            Else
                'IdentityControl.LogoutWithAbort()
                Response.Redirect("/admin/login.aspx")
            End If
        End If

    End Sub
#End Region

#Region "Navigation"

    Protected Sub LoadNavigation()

        If UserTypeID <= 0 Then
            LoadUserInfo()
        End If


        If Request.RawUrl.Contains("login.aspx") Then
            div_body.Attributes.Add("class", "login")
            pnlAdminMenu.Visible = False
            span_dashboardlnk.Visible = False
            lnkLogoutUser.Visible = False
            litUserName.Visible = False
            SetBreadcrumbText()
        Else

            pnlAdminMenu.Visible = True
            span_dashboardlnk.Visible = True
            lnkLogoutUser.Visible = True

            '# Load Modular Navigation Groups
            With rptAdminSections
                .DataSource = SimbaAccess.GetAdminMenuItemsByUserType(UserTypeID, 0)
                .DataBind()
            End With

            Dim SecondLevelList As DataTable = SimbaAccess.GetAdminMenuItemsByUserType(UserTypeID, 2)
            If SecondLevelList IsNot Nothing AndAlso SecondLevelList.Rows.Count > 0 Then
                With rptSecondLevel
                    .DataSource = SecondLevelList
                    .DataBind()
                End With
            End If

            '# Set view
            SetGroupTab()
            SetBreadcrumbText()

            '# Load Static Navigation
            '# Users
            If IdentityControl.HasSectionAccess(6) Then
                li_view_users.Visible = True
                li_add_user.Visible = True
            Else
                li_view_users.Visible = False
                li_add_user.Visible = False
            End If

            '# Emails
            If IdentityControl.HasSectionAccess(144) Then
                li_emails.Visible = True
            Else
                li_emails.Visible = False
            End If

            '# (Super) Admin Sections
            If IdentityControl.HasSectionAccess(12) Then
                li_adminsections.Visible = True
            Else
                li_adminsections.Visible = False
            End If

        End If


    End Sub

    Protected Sub rptSecondLevel_ItemDataBound(ByVal sender As Object, ByVal e As System.Web.UI.WebControls.RepeaterItemEventArgs) Handles rptSecondLevel.ItemDataBound
        Select Case e.Item.ItemType
            Case ListItemType.Item, ListItemType.AlternatingItem, ListItemType.SelectedItem
                With e.Item
                    Dim DataItem As DataRow = CType(.DataItem, DataRowView).Row
                    Dim NeverAdd As Boolean = False

                    If DataItem IsNot Nothing Then
                        CurrentGroupID = DataFunctions.GetColumnFromDataRow(DataItem, "groupid")
                        NeverAdd = DataFunctions.GetColumnFromDataRow(Of Boolean)(DataItem, "NeverAdd")
                        'CurrentPageID = DataFunctions.GetColumnFromDataRow(DataItem, "id")
                    End If

                    Dim ul_secnav As HtmlControl = CType(.FindControl("ul_secnav"), HtmlControl)
                    If ul_secnav IsNot Nothing And Not NeverAdd Then
                        ul_secnav.Attributes.Add("class", "toggle")

                        '# If this page is the current one show the menu
                        Dim filename As String = System.IO.Path.GetFileName(HttpContext.Current.Request.FilePath).ToLower()

                        If filename = DataFunctions.GetColumnFromDataRow(DataItem, "filename") Then
                            ul_secnav.Attributes.Add("class", "toggleopen")
                        End If

                    End If

                    Dim li_addnew As HtmlControl = CType(.FindControl("li_addnew"), HtmlControl)
                    If li_addnew IsNot Nothing Then
                        If NeverAdd Then
                            li_addnew.Visible = False
                        End If
                    End If

                End With
        End Select
    End Sub

    Protected Sub SetGroupTab()

        '# Select group
        For Each ri As RepeaterItem In rptAdminSections.Items
            Dim li_tablink As HtmlControl = CType(ri.FindControl("li_tablink"), HtmlControl)
            Dim hdngid As HiddenField = CType(ri.FindControl("hdngid"), HiddenField)

            If li_tablink IsNot Nothing AndAlso hdngid IsNot Nothing Then
                If CurrentGroupID = CInt(hdngid.Value) Then
                    li_tablink.Attributes.Add("class", "active")
                End If
            End If
        Next
    End Sub

    Protected Sub SetBreadcrumbText()

        Dim SectionRecord As DataRow = SimbaAccess.GetCurrentAdminMenuItem()

        If SectionRecord IsNot Nothing Then

            Dim filename As String = System.IO.Path.GetFileName(HttpContext.Current.Request.FilePath).ToLower()

            If filename = DataFunctions.GetColumnFromDataRow(SectionRecord, "filename") Then
                Dim GroupName As String = DataFunctions.GetColumnFromDataRow(SectionRecord, "groupname")
                Dim SectionName As String = DataFunctions.GetColumnFromDataRow(SectionRecord, "name")

                If GroupName.ToLower() = "dashboard" Then
                    litBreadcrumb.Text = "<a class=""current"" title=""" & SectionName & """>" & SectionName & "</a>"
                ElseIf CurrentGroupID = 0 Then
                    litBreadcrumb.Text = "<a href=""/admin/sections/"" title=""Dashboard"">Dashboard</a> <div class=""breadcrumb_divider""></div> <a class=""current"" title=""" & SectionName & """>" & SectionName & "</a>"
                Else
                    litBreadcrumb.Text = "<a href=""/admin/sections/"" title=""Dashboard"">Dashboard</a> <div class=""breadcrumb_divider""></div><a href=""#"" title=""" & GroupName & """>" & GroupName & "</a> <div class=""breadcrumb_divider""></div> <a class=""current"" title=""" & SectionName & """>" & SectionName & "</a>"
                End If

                litPageTitle.Text = SectionName

            End If

        End If

        If Request.RawUrl.Contains("login.aspx") Then
            litPageTitle.Text = "Login"
            litBreadcrumb.Text = "<a class=""current"" title=""Admin Login"">Admin Login</a>"
        End If

    End Sub

#End Region

End Class
