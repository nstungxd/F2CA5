Imports PingCore.MyData
Imports System.Data
Imports System.Data.OLEDB
Imports PingCore
Imports Telerik.Web.UI
Partial Class AdminSection6MainPage
    Inherits System.Web.UI.Page
    Implements Controls.IAdminPage
    Public Property TheManager As Telerik.Web.UI.RadAjaxManager Implements Controls.IAdminPage.TheManager
        Get
            Return TheRadAjaxManager
        End Get
        Set(ByVal value As Telerik.Web.UI.RadAjaxManager)
            TheRadAjaxManager = value
        End Set
    End Property

    Private Const SectionID As Integer = 6

#Region "TheMaster"
    Private _theMaster As IMaster
    Private ReadOnly Property TheMaster() As IMaster Implements Controls.IAdminPage.TheMaster
        Get
            If _theMaster Is Nothing Then
                Dim m As MasterPage = Me.Master
                Do
                    If m.Master Is Nothing Then
                        _theMaster = CType(m, IMaster)
                        Exit Do
                    Else
                        m = m.Master
                    End If
                Loop
            End If

            Return _theMaster
        End Get
    End Property
#End Region

    Dim CmdStr, sAction As String
    Dim DS As DataSet = New DataSet
    Dim Row As DataRow
    Dim RecordID, i As Integer
    Dim FromEdit, bDelPopup As Boolean
    Dim pnlPanel As Panel
    Dim strPanelName As String
    Dim UserFixedWhere As String
    Dim MyUser As User
#Region "PageInfo"
    Friend Property PageInfo As SectionPageInfo
        Get
            Return MyData.DBFactory.FromViewState(Of SectionPageInfo)(ViewState, "PageInfo")
        End Get
        Set(ByVal value As SectionPageInfo)
            ViewState("PageInfo") = value
        End Set
    End Property
#End Region

#Region "EditAndSendBack"
    Friend Property EditAndSendBack As Boolean
        Get
            Return MyData.DBFactory.FromViewState(Of Boolean)(ViewState, "EditAndSendBack")
        End Get
        Set(ByVal value As Boolean)
            ViewState("EditAndSendBack") = value
        End Set
    End Property
#End Region

    Sub Page_Init(ByVal sender As Object, ByVal e As eventargs) Handles me.Init

        If Not TheMaster.TheIdentityControl.HasSectionAccess(SectionID) Then
            TheMaster.TheIdentityControl.LogoutWithAbort()
            Response.End()
        End If

        Header.Title &= " - Users"

        'With TheManager.AjaxSettings
        'Dim mysetting As New AjaxSetting("pnlUpdateArea")
        'mysetting.UpdatedControls.Add(New AjaxUpdatedControl("pnlUpdateArea", "RadAjaxLoadingPanel"))
        'mysetting.UpdatedControls.Add(New AjaxUpdatedControl("msg", "RadAjaxLoadingPanel"))
        '.Add(mysetting)
        'End With

    End Sub

    Sub Page_Load(ByVal sender As Object, ByVal e As eventargs) Handles me.Load
        '# page info
        If Not ispostback Then
            PageInfo = AdminUtility.InitPageInfo(request)
            If request("action") = "editandsendback" Then
                EditAndSendBack = True
            End If
        End If

        '# presets
        ListControl.InstanceWhere = AdminUtility.PresetWhere(PageInfo)
        ListControl.PageInfo = PageInfo

        If Not ispostback Then
            ListControl.HasParent = (Not StringUtility.IsEffectivelyEmpty(PageInfo.ParentUrl))

            If EditAndSendBack Then
                Dim intTheValue As Integer = MyData.DBFactory.DB.GetDataField(Of Integer)("SELECT user_id FROM users where " & adminutility.PresetWhere(pageinfo))
                EditView(intTheValue)
            Else
                MyContent.PageContent.FocusFirstControl(CType(ListControl.FindControl("pl_tablelist"), Panel))
                ListView()
            End If
        End If
    End Sub

    Sub Abandon() Handles EditControl.QuitEditing
        If PageInfo.HasParent AndAlso EditAndSendBack = True Then
            BackToParent()
        Else
            ListView()
        End If
    End Sub

    Sub BackToParent() Handles ListControl.GotoParentEvent
        If Not PageInfo.HasParent Then
            ListView()
        Else
            Dim url As String = MyContent.PageContent.AppendGetParam(PageInfo.ParentUrl, "info", PageInfo.ParentInfo)
            Response.Redirect(url)
        End If
    End Sub

    Sub BackToParent(ByVal sender As Object, ByVal e As System.Web.UI.WebControls.CommandEventArgs)
        BackToParent()
    End Sub

    Sub FollowRelationship(ByVal sender As Object, ByVal e As AdminUtility.RelationshipEventArgs) Handles ListControl.RelationshipEvent, EditControl.RelationshipEvent
        Dim id As Integer = e.RelID
        Dim childinfo As SectionPageInfo = PageInfo.GetChildInfo("admin-users.aspx")
        Dim url As String = Nothing

        Select Case id
        End Select

        If url IsNot Nothing Then
            url = MyContent.PageContent.AppendGetParam(url, "info", childinfo.Serialize)
            Response.Redirect(url)
        End If
    End Sub


    Sub FollowCustomLink(ByVal sender As Object, ByVal e As AdminUtility.CustomLinkEventArgs) Handles ListControl.CustomLinkEvent, EditControl.CustomLinkEvent
        Dim id As Integer = e.LinkID
        Dim url As String = Nothing

        Select Case id
            Case 5
                url = "../custom_sendtemporarypassword.aspx?id="

        End Select

        If url IsNot Nothing Then
            Response.Redirect(url & e.RowID)
        End If
    End Sub


    Sub DoneEditing(ByVal intRecordID As Integer) Handles EditControl.DoneEditing
        If PageInfo.HasParent AndAlso EditAndSendBack = True Then
            BackToParent()
        Else
            ListView()
        End If
    End Sub

    Sub ListView()
        EditControl.Visible = False
        ListControl.Visible = True
        ListControl.BindList()
    End Sub
    Sub EditView(ByVal intRecordID As Integer)
        EditControl.Visible = True
        EditControl.EditView(intRecordID)
        ListControl.Visible = False

        '# disable presets
        AdminUtility.PerPreset(PageInfo, AddressOf EditControl.SetFieldandDisable)
    End Sub

    Sub AddNew(ByVal sender As Object, ByVal e As System.Web.UI.WebControls.CommandEventArgs)
        EditView(0)
    End Sub
    Private Sub AddNewRecord() Handles ListControl.AddNewRecordEvent
        EditView(0)
    End Sub
    Private Sub EditRecordEvent(ByVal intRecordID As Integer) Handles ListControl.EditRecordEvent
        EditView(intRecordID)
    End Sub
End Class
