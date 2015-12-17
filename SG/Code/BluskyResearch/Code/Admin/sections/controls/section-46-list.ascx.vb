Imports PingCore.MyContent
Imports System.Data
Imports PingCore.MyData
Imports PingCore
Imports Telerik.Web.UI
Partial Class AdminSection46List
   Inherits PingCore.Controls.AdminSectionListControl
   Private Const SectionID as integer = 46

   Dim DS As DataSet = New DataSet
   Dim Row As DataRow
   Dim RecordID, i As Integer
   Dim FromEdit, bDelPopup As Boolean
   Dim pnlPanel As Panel
   Dim strPanelName As String
   Public CanAdd As Boolean = True
Dim MyUser As User
#Region "TheMaster"
  Private _theMaster As IMaster
  Private ReadOnly Property TheMaster() As IMaster
    Get
      If _theMaster Is Nothing Then
        Dim m As MasterPage = Me.Page.Master
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

Public Property HasParent() As Boolean
    Get
       Return MyData.DBFactory.FromViewState(of Boolean)(ViewState, "HasParent")
    End Get
    Set(ByVal value As Boolean)
       ViewState("HasParent") = value
    End Set
End Property

#Region "PageInfo"
  Private _spi as SectionPageInfo
  Public Property PageInfo as SectionPageInfo
    Friend Get
      Return _spi
    End Get
    Set (value as SectionPageInfo)
      _spi = value
    End Set
  End Property
#End Region


Dim _Title As String
    Public Property Title() As String
        Get
            Return _Title
        End Get
        Set(ByVal value As String)
            _Title = value
        End Set
   End Property
Dim _InstanceWhere As String
    Public Property InstanceWhere() As String
        Get
            Return _InstanceWhere
        End Get
        Set(ByVal value As String)
            _InstanceWhere = value
        End Set
   End Property
Dim _UserFixedWhere As String
    Public Property UserFixedWhere() As String
        Get
            Return _UserFixedWhere
        End Get
        Set(ByVal value As String)
            _UserFixedWhere = value
        End Set
   End Property
   Public Event AddNewRecordEvent()
   Sub AddNew(ByVal sender As Object, ByVal e As Web.UI.WebControls.CommandEventArgs)
       RaiseEvent AddNewRecordEvent()
   End Sub
   Public Event GoToParentEvent()
   Sub BackToParent(ByVal sender As Object, ByVal e As Web.UI.WebControls.CommandEventArgs)
       RaiseEvent GoToParentEvent()
   End Sub
   Public Event EditRecordEvent(ByVal RecordID AS Integer)
   Sub EditRecord(ByVal sender As Object, ByVal e As GridCommandEventArgs) Handles dg_TableList.EditCommand
       RaiseEvent EditRecordEvent(CType(dg_TableList.Items(e.Item.ItemIndex).GetDataKeyValue("ddt_id"), Integer))
   End Sub
   Protected Sub PageSize_SelectedIndexChanged(ByVal sender As Object, ByVal e As System.EventArgs) Handles PageSize.SelectedIndexChanged
           Response.Cookies.Add(new HttpCookie("PageSize",PageSize.SelectedValue))
           BindList()
   End Sub
   Sub Page_Init(sender as object, e as eventargs) handles me.Init
       If Not (IsPostBack OrElse Request.Cookies("PageSize") Is Nothing  OrElse String.IsNullOrEmpty(Request.Cookies("PageSize").Value)) Then
           PageSize.SelectedValue = CInt(Request.Cookies("PageSize").Value)
           Response.Cookies.Add(new HttpCookie("PageSize",PageSize.SelectedValue))
       End If
       If Not TheMaster.TheIdentityControl.HasSectionAccess(SectionID) Then
           TheMaster.TheIdentityControl.LogoutWithAbort()
           Response.End
       End If
       

   End Sub
			Sub Page_Load(sender as object, e as eventargs) Handles Me.load 
 				    lblJavaScript.Text=""
			End Sub
	Sub ListView()
       MyContent.PageContent.FocusFirstControl(pl_tablelist)
		BindList()
	End Sub

  Sub ChangeListPage(ByVal s As Object, ByVal e As DataGridPageChangedEventArgs)
    BindList()
  End Sub


  Sub ChangePage(ByVal NewPageNumber As Integer) Handles MyNumericPaging.PageChanged
    MyNumericPaging.PageNo = NewPageNumber
    BindList()
  End Sub


	Sub doFormSubmit(source As Object, e As GridCommandEventArgs) Handles dg_TableList.ItemCommand 
	          Select Case e.Item.ItemType 
	               Case GridItemType.Item, GridItemType.AlternatingItem, GridItemType.SelectedItem, GridItemType.EditItem 
	               Dim pkid as Integer = CType(dg_TableList.Items(e.Item.ItemIndex).GetDataKeyValue("ddt_id"), Integer)
	               If e.CommandName = "Delete" Then 
	                    Dim strSQL As String = "DELETE FROM zz_admin_dropdown_translations WHERE ddt_id = " & pkid 
	                    MyData.DBFactory.db.RunSQL(strSQL)
	                    ListView() 
		            ElseIf e.CommandName = "Relationship" then
		                RaiseEvent RelationshipEvent(Me, new AdminUtility.RelationshipEventArgs(pkid, e.CommandArgument))
		            ElseIf e.CommandName = "CustomLink" then
		                RaiseEvent CustomLinkEvent(Me, new AdminUtility.CustomLinkEventArgs(pkid, e.CommandArgument))
		            ElseIf e.CommandName = "Move_Up" then 
						MyContent.PageContent.MoveUp("46", pkid)
                       BindList()
			        ElseIf e.CommandName = "Move_Down" then 
						    MyContent.PageContent.MoveDown("46", pkid)
                       BindList()
			        ElseIf e.CommandName = "EditRecord" then 
						    RaiseEvent EditRecordEvent(pkid)
						    dg_TableList.Rebind()
	                End If 
	          end select 
	End Sub 
Public Event RelationshipEvent as EventHandler(of AdminUtility.RelationshipEventArgs)
Public Event CustomLinkEvent as EventHandler(of AdminUtility.CustomLinkEventArgs)
Friend Event DD_RebindAll as EventHandler
Public Sub TriggerRebindAll(sender as object, e as eventargs)
  RaiseEvent DD_RebindAll(Me, EventArgs.Empty)
End Sub


Sub perfSearch(sender As Object, e As System.EventArgs)     
  if Context.Items("perfSearch") <> "1" then
    Context.Items("perfSearch") = "1"
    MyNumericPaging.PageNo=1
    BindList()
  end if
End Sub     
Sub triggerSearch(sender As Object, e As System.EventArgs)     
  AddHandler me.Page.LoadComplete, AddressOf perfSearch
End Sub     
Protected Sub dg_TableList_SortCommand(ByVal source As Object, ByVal e As Telerik.Web.UI.GridSortCommandEventArgs)     
   If PageInfo.Sort = e.SortExpression Then 
       PageInfo.Sort = e.SortExpression & " DESC"
   Else
       PageInfo.Sort = e.SortExpression 
   End If 

   BindList()
End Sub 
Public Sub BindList()
'#Sorting Order
   Dim strListOrderBy AS String = "ddt_id"   
   if not PageInfo.Sort & "x"="x" then strListOrderBy = PageInfo.Sort

'#Define Fields and Tables to Display
Dim strSQL As String = "SELECT *, ROW_NUMBER() OVER (ORDER BY " & strListOrderBy & ") AS 'RowNumber'  FROM zz_admin_dropdown_translations"
Dim strSQLCount As String = "SELECT COUNT(*) FROM zz_admin_dropdown_translations"
Dim strWhere AS String = MyContent.PageContent.getWhereString(pnlSearchTable)  
       if not (InstanceWhere & "x"="x") then 
           MyContent.PageContent.appendToWhere(InstanceWhere, strWhere)  
       end if
       if not UserFixedWhere & "x"="x" then 
           MyContent.PageContent.appendToWhere(UserFixedWhere, strWhere) 
       end if

   if not strWhere & "x" = "x" then 
       strSQL &= "  WHERE  "  &  strWhere 
       strSQLCount &= "  WHERE  "  &  strWhere 
   end if
   '# GET RECORD COUNT
   Dim RecordCount = DBFactory.DB.GetDataField(Of Integer)(strSQLCount)
	RecordSummary.Text= RecordCount & " items listed"
   '# GET PAGING
       dg_TableList.PageSize = PageSize.SelectedValue
	    MyNumericPaging.PageCount = Math.Ceiling(RecordCount / dg_TableList.PageSize)
       MyNumericPaging.SetPage(MyNumericPaging.PageNo)
       Dim intStartRec As Integer = (MyNumericPaging.PageNo - 1) * PageSize.SelectedValue + 1
       Dim intEndRec As Integer = intStartRec + PageSize.SelectedValue - 1
   '# Build the Final SQL for this Page
   strSQL = "WITH TheTable AS ( " & strSQL & ")    SELECT *  FROM TheTable WHERE RowNumber BETWEEN " & intStartRec & " AND " & intEndRec & " ORDER BY RowNumber" 
	    dg_TableList.DataSource =  DBFactory.DB.GetDataTable(strSQL)
	    dg_TableList.DataBind()
	    pl_tablelist.Visible = True
	    if not ispostback() then 
	end if 
End Sub 
Sub Export(sender as object, e as EventArgs)
  Response.Redirect("custom-reports.aspx?id="&46)
End Sub

sub Page_PreRender(sender as Object, e as EventArgs) Handles Me.PreRender
  '# set the border color of the grid, it's silly but must be done this way
  Dim c As RadGrid = Me.FindControl("dg_TableList")
  If c IsNot Nothing Then
    '# add the attribute
    c.Attributes.Add("bordercolor", "#cococo")
  End If
End Sub
End Class
