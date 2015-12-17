Imports PingCore.MyContent
Imports System.Collections.Generic
Imports PingCore.MySystem
Imports PingCore.MyData
Imports System.Data
Imports mc = PingCore.MyControls
Imports PingCore
Imports PingLibrary

Partial Class MenuControl_Behind
    Inherits mc.MenuControl

#Region "TheMaster"
    Private _theMaster As New Memo(Of IMaster)(AddressOf GetTheMaster)
    ReadOnly Property TheMaster() As IMaster
        Get
            Return _theMaster.Value
        End Get
    End Property

    Function GetTheMaster() As IMaster
        Return CType(Page.Master, IMaster)
    End Function
#End Region

    Private _SectionName As String
    Public Property SectionName As String
        Get
            Return _SectionName
        End Get
        Set(ByVal value As String)
            _SectionName = value
        End Set
    End Property
    Private _SectionIntro As String
    Public Property SectionIntro As String
        Get
            Return _SectionIntro
        End Get
        Set(ByVal value As String)
            _SectionIntro = value
        End Set
    End Property

    Public ReadOnly Property SectionIconFileName As String
        Get
            If Not String.IsNullOrEmpty(_SectionName) Then
                Return "Icon_" & _SectionName.Replace(" ", "") & ".png"
            Else
                Return "Icon_Settings.png"
            End If
        End Get
    End Property

    Public Property UserLevel() As Integer
        Get
            Dim ul As Integer = 0

            Try
                If ViewState("UserLevel") IsNot Nothing Then ul = CInt(ViewState("UserLevel"))
            Catch ex As Exception
            End Try

            If ul <= 0 Then
                'Response.Redirect("/Default.aspx")
            End If

            Return ul

        End Get
        Set(ByVal value As Integer)
            ViewState("UserLevel") = value
        End Set
    End Property


    Dim CurrentSectionPath As String = ""
    Public Overrides Sub DataBind()
        '# bind the datasource to the repeater
        'With rptItems
        '	.DataSource = DataSource
        '	.DataBind()
        'End With

        '# We're going to not bind the menu as we did before and do it in a brand new stylee

        '# We now need to split this list into the various levels of page

        'Find out the admin section group....
        Dim PageFileName As String = DirectCast(Request.Url, System.Uri).LocalPath

        Do While PageFileName.Contains("/")
            PageFileName = Right(PageFileName, Len(PageFileName) - InStr(PageFileName, "/"))
        Loop

        Dim DBRow As DataRow = DBFactory.DB.GetDataRow("SELECT Top 1 groupdefaultsection.[admin_file_name] as SectionDefaultPage, admin_section_group_name, admin_section_group_description FROM  [zz_admin_sections] as thissection  LEFT JOIN zz_admin_section_groups ON    thissection.[admin_section_group_fk] = zz_admin_section_groups.[admin_section_group_id]  LEFT JOIN [zz_admin_sections] as groupdefaultsection ON groupdefaultsection.[admin_section_group_fk] = zz_admin_section_groups.[admin_section_group_id]   WHERE thissection.[admin_file_name]='" & PageFileName & "' AND groupdefaultsection.admin_section_isdeleted=0 order by groupdefaultsection.admin_section_menu_order")

        If Not DBRow Is Nothing Then
            CurrentSectionPath = DBFactory.FromDB(Of String)(DBRow("SectionDefaultPage"))
            SectionName = DBFactory.FromDB(Of String)(DBRow("admin_section_group_name"))
            SectionIntro = DBFactory.FromDB(Of String)(DBRow("admin_section_group_description"))
        End If

        'DBFactory.DB.GetDataField("")

        ''# Get top level items - superusers only

        'With rptItems
        '    .DataSource = SimbaAccess.GetAdminMenuItemsByUserType(UserLevel, 0)
        '    .DataBind()
        'End With

        'Response.Write(SelectedCode)

        '# Get 2nd level items - main pages
        With rptSecondLevel
            .DataSource = SimbaAccess.GetAdminMenuItemsByUserType(UserLevel, 2)
            .DataBind()
        End With

        If rptSecondLevel.Items.Count <= 1 Then
            rptSecondLevel.Visible = False
        End If

    End Sub



    'Protected Sub rptItems_ItemDataBound(ByVal sender As Object, ByVal e As System.Web.UI.WebControls.RepeaterItemEventArgs) Handles rptItems.ItemDataBound ', rptThirdLevel.ItemDataBound
    '    If String.IsNullOrEmpty(CurrentSectionPath) Then
    '        Return
    '    End If
    '    If e.Item.DataItem IsNot Nothing Then

    '        Dim mi As mc.MenuItem = CType(e.Item.DataItem, mc.MenuItem)
    '        Dim isClient As Boolean = (mi.Mode = mc.MenuItem.LinkModeEnum.Client)

    '        '# get multiview
    '        Dim mvLinkMode As MultiView = PageContent.MyFindControl(Of MultiView)("mvLinkMode", e.Item)
    '        If mvLinkMode IsNot Nothing Then

    '            '# show pertinent view
    '            mvLinkMode.ActiveViewIndex = mi.Mode

    '            If mi.Code.ToLower.Contains("video") Then
    '                Dim srt As String = 1
    '            End If

    '            '# if this is the alerts send page
    '            '# then check the mi.code for alert? 
    '            '# basically work out if this menu item is alert and select it as per below

    '            '# is this the selected item? 
    '            If mi.Code = SelectedCode Or mi.ClientLink.Contains(CurrentSectionPath) Then
    '                '# add the class to the link/linkbutton
    '                If isClient Then
    '                    Dim lnkItem As HyperLink = PageContent.MyFindControl(Of HyperLink)("lnkItem", e.Item)
    '                    lnkItem.CssClass = "selected"
    '                Else
    '                    Dim btnItem As LinkButton = PageContent.MyFindControl(Of LinkButton)("btnItem", e.Item)
    '                    btnItem.CssClass = "selected"
    '                End If
    '            End If
    '        End If
    '    End If
    'End Sub



    Protected Sub rptSecondLevel_ItemDataBound(ByVal sender As Object, ByVal e As System.Web.UI.WebControls.RepeaterItemEventArgs) Handles rptSecondLevel.ItemDataBound
        Select Case e.Item.ItemType
            Case ListItemType.Item, ListItemType.SelectedItem, ListItemType.AlternatingItem

                If e.Item.DataItem IsNot Nothing Then

                    '# Is this the selected item?
                    Dim dr As DataRow = CType(e.Item.DataItem, DataRowView).Row

                    If dr IsNot Nothing Then
                        If DirectCast(Request.Url, System.Uri).LocalPath.Contains(DataFunctions.GetColumnFromDataRow(dr, "filename")) Then
                            Dim lnkItem As HyperLink = PageContent.MyFindControl(Of HyperLink)("lnkItem", e.Item)
                            lnkItem.CssClass = "selected"
                        End If
                    End If
                End If
        End Select
    End Sub

    'Sub rptItems_ItemCommand(ByVal sender As Object, ByVal e As RepeaterCommandEventArgs) Handles rptItems.ItemCommand, rptSecondLevel.ItemCommand  ', rptThirdLevel.ItemCommand
    '    Me.FireClick(e.CommandName, e.CommandArgument)
    'End Sub

    Protected Sub Page_Init(ByVal sender As Object, ByVal e As System.EventArgs) Handles Me.Init
        '# set the template
        'rptItems.SeparatorTemplate = Me.SeparatorTemplate
        rptSecondLevel.SeparatorTemplate = Me.SeparatorTemplate
        'rptThirdLevel.SeparatorTemplate = Me.SeparatorTemplate
    End Sub

    Protected Sub Page_Load(ByVal sender As Object, ByVal e As System.EventArgs) Handles Me.Load
        'Find out the admin section group....
        Dim PageFileName As String = DirectCast(Request.Url, System.Uri).LocalPath
        Do While PageFileName.Contains("/")
            PageFileName = Right(PageFileName, Len(PageFileName) - InStr(PageFileName, "/"))
        Loop

        Dim DBRow As DataRow = DBFactory.DB.GetDataRow("SELECT Top 1 groupdefaultsection.[admin_file_name] as SectionDefaultPage, admin_section_group_name, admin_section_group_description FROM  [zz_admin_sections] as thissection  LEFT JOIN zz_admin_section_groups ON    thissection.[admin_section_group_fk] = zz_admin_section_groups.[admin_section_group_id]  LEFT JOIN [zz_admin_sections] as groupdefaultsection ON groupdefaultsection.[admin_section_group_fk] = zz_admin_section_groups.[admin_section_group_id]   WHERE thissection.[admin_file_name]='" & PageFileName & "' AND groupdefaultsection.admin_section_isdeleted=0 order by groupdefaultsection.admin_section_menu_order")
        If Not DBRow Is Nothing Then
            CurrentSectionPath = DBFactory.FromDB(Of String)(DBRow("SectionDefaultPage"))
            SectionName = DBFactory.FromDB(Of String)(DBRow("admin_section_group_name"))
            SectionIntro = DBFactory.FromDB(Of String)(DBRow("admin_section_group_description"))
        End If
    End Sub

    'Protected Sub Control_PreRender(ByVal sender As Object, ByVal e As System.EventArgs) Handles Me.PreRender
    '    '# decide whether to show the label
    '    If StringUtility.IsEffectivelyEmpty(LabelText) Then
    '        pnlLabel.Visible = False
    '    Else
    '        pnlLabel.Visible = True
    '        lblLabelText.Text = LabelText
    '    End If
    'End Sub

    Protected Sub Logout_Click(ByVal sender As Object, ByVal e As System.EventArgs)

        TheMaster.TheIdentityControl.Logout()

        Response.Redirect("/")
    End Sub

End Class
