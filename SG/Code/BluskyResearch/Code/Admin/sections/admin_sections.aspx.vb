Imports PingCore.MyContent
Imports PingCore.MyData
Imports System.Data
Imports System.Data.OLEDB
Imports PingCore
Imports Telerik.Web.UI
Partial Class AdminSection12MainPage
   Inherits System.Web.UI.Page
Implements PingCore.Controls.IAdminPage
 Public Property TheManager As Telerik.Web.UI.RadAjaxManager Implements PingCore.Controls.IAdminPage.TheManager
        Get
            Return TheRadAjaxManager
        End Get
        Set(ByVal value As Telerik.Web.UI.RadAjaxManager)
            TheRadAjaxManager=value
        End Set
    End Property

Private Const SectionID as integer = 12

#Region "TheMaster"
  Private _theMaster As IMaster
  Private ReadOnly Property TheMaster() As PingCore.IMaster Implements PingCore.Controls.IAdminPage.TheMaster
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
  Friend Property PageInfo as SectionPageInfo
    Get
      Return MyData.DBFactory.FromViewState(of SectionPageInfo)(ViewState, "PageInfo")
    End Get
    Set (value as SectionPageInfo)
      ViewState("PageInfo") = value
    End Set
  End Property
#End Region

#Region "EditAndSendBack"
  Friend Property EditAndSendBack as Boolean
    Get
      Return MyData.DBFactory.FromViewState(of Boolean)(ViewState, "EditAndSendBack")
    End Get
    Set (value as Boolean)
      ViewState("EditAndSendBack") = value
    End Set
  End Property
#End Region
#Region "AddFromNav"
  Friend Property AddFromNav as Boolean
    Get
      Return MyData.DBFactory.FromViewState(of Boolean)(ViewState, "AddFromNav")
    End Get
    Set (value as Boolean)
      ViewState("AddFromNav") = value
    End Set
  End Property
#End Region

  Sub Page_Init(sender as object, e as eventargs) handles me.Init

    If Not TheMaster.TheIdentityControl.HasSectionAccess(SectionID) Then
      TheMaster.TheIdentityControl.LogoutWithAbort()
      Response.End
    End If

    Header.Title &= " - A Sections"

    'With TheManager.AjaxSettings
    'Dim mysetting As New AjaxSetting("pnlUpdateArea")
    'mysetting.UpdatedControls.Add(New AjaxUpdatedControl("pnlUpdateArea", "RadAjaxLoadingPanel"))
    'mysetting.UpdatedControls.Add(New AjaxUpdatedControl("msg", "RadAjaxLoadingPanel"))
    '.Add(mysetting)
    'End With

  End Sub

  Sub Page_Load(sender as object, e as eventargs) handles me.Load
  '# page info
  if not ispostback then
    PageInfo = AdminUtility.InitPageInfo(request)
    if request("action") = "editandsendback" then
      EditAndSendBack = True
    end if
    If Not String.IsNullOrEmpty(Request.QueryString("add")) AndAlso Request.QueryString("add") = "1" Then
      AddFromNav = True
    End If
  end if

  '# presets
  ListControl.InstanceWhere = AdminUtility.PresetWhere(PageInfo)
  ListControl.PageInfo = PageInfo

  if not ispostback then
    ListControl.HasParent = (Not StringUtility.IsEffectivelyEmpty(PageInfo.ParentUrl))

    if EditAndSendBack then
      Dim intTheValue AS Integer = MyData.DBFactory.DB.GetDataField(Of Integer)("SELECT admin_section_id FROM zz_admin_sections where " & adminutility.PresetWhere(pageinfo))
      EditView(intTheValue)
    elseif AddFromNav 
      EditView(0) 
    else
      MyContent.PageContent.FocusFirstControl(CType(ListControl.FindControl("pl_tablelist"), Panel))
      ListView()
    end if
	 end if
end sub

Sub Abandon() Handles EditControl.QuitEditing 
  if PageInfo.HasParent AndAlso EditAndSendBack = true then
    BackToParent()
  else
    ListView()
  end if
End Sub

Sub BackToParent() Handles ListControl.GotoParentEvent
  if Not PageInfo.HasParent then
    ListView()
  else
    dim url as string = MyContent.PageContent.AppendGetParam(PageInfo.ParentUrl, "info", PageInfo.ParentInfo)
    Response.Redirect(url)
  end if
end sub

Sub BackToParent(ByVal sender As Object, ByVal e As System.Web.UI.WebControls.CommandEventArgs)
  BackToParent()
end sub

  Sub FollowRelationship(ByVal sender As Object, ByVal e As AdminUtility.RelationshipEventArgs) Handles ListControl.RelationshipEvent, EditControl.RelationshipEvent
    Dim id As Integer = e.RelID
    Dim childinfo As SectionPageInfo = PageInfo.GetChildInfo("admin_sections.aspx")
    Dim url As String = Nothing

    Select Case id
      Case 1
        url = "admin_list_fields.aspx"
        childinfo.Presets.Item("list_field_section_id") = e.RowID
      Case 2
        url = "admin_custom_links.aspx"
        childinfo.Presets.Item("admin_custom_link_section") = e.RowID
      Case 3
        url = "admin_section_relationships.aspx"
        childinfo.Presets.Item("parent_section_id") = e.RowID
      Case 13
        url = "admin_dependent_fields.aspx"
        childinfo.Presets.Item("df_section_id") = e.RowID
      Case 14
        url = "admin-section-filters.aspx"
        childinfo.Presets.Item("filter_admin_section") = e.RowID
      Case 19
        url = ""
        childinfo.Presets.Item("am_section_id") = e.RowID
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
      Case 1
        url = "../create-admin.aspx?section="
      Case 2
        url = "../create-admin.aspx?generateandreturn=1&section="
      Case 3
        url = "../create-admin.aspx?action=goto&section="

    End Select

    If url IsNot Nothing Then
      Response.Redirect(url & e.RowID)
    End If
  End Sub


  Sub DoneEditing(ByVal intRecordID AS Integer) Handles EditControl.DoneEditing
    if PageInfo.HasParent AndAlso EditAndSendBack = true then
      BackToParent()
    else
      ListView()
    end if
  End Sub

	Sub ListView()
		EditControl.Visible=false
		ListControl.Visible=true
		ListControl.BindList()
	End Sub
  sub EditView(ByVal intRecordID AS Integer)
    EditControl.Visible = true
    EditControl.EditView(intRecordID)
    ListControl.Visible = false

    '# disable presets
    AdminUtility.PerPreset(PageInfo, AddressOf EditControl.SetFieldandDisable)
  end sub

	sub AddNew(sender As Object, e As System.Web.UI.WebControls.CommandEventArgs) 
		EditView(0)
	end sub
Private Sub AddNewRecord() Handles ListControl.AddNewRecordEvent
    EditView(0)
End Sub
Private Sub EditRecordEvent(ByVal intRecordID AS Integer) Handles ListControl.EditRecordEvent
    EditView(intRecordID)
End Sub
End Class 
