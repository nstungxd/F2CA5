Imports PingCore.MyContent
Imports System.Data
Imports PingCore.MyData
Imports PingCore
Imports Telerik.Web.UI
Partial Class AdminSection6List
   Inherits PingCore.Controls.AdminSectionListControl
   Private Const SectionID as integer = 6

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
       RaiseEvent EditRecordEvent(CType(dg_TableList.Items(e.Item.ItemIndex).GetDataKeyValue("user_id"), Integer))
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
	               Dim pkid as Integer = CType(dg_TableList.Items(e.Item.ItemIndex).GetDataKeyValue("user_id"), Integer)
	               If e.CommandName = "Delete" Then 
	                    Dim strSQL As String = "DELETE FROM users WHERE user_id = " & pkid 
	                    MyData.DBFactory.db.RunSQL(strSQL)
	                    ListView() 

                ElseIf e.CommandName = "toggle_user_allsurveys" Then
                    DBFactory.DB.RUnSQL("UPDATE users SET user_allsurveys=1 - ISNULL(user_allsurveys, 0) WHERE user_id= " & pkid)
                    ListView()

                ElseIf e.CommandName = "Relationship" Then
                    RaiseEvent RelationshipEvent(Me, New AdminUtility.RelationshipEventArgs(pkid, e.CommandArgument))
                ElseIf e.CommandName = "CustomLink" Then
                    RaiseEvent CustomLinkEvent(Me, New AdminUtility.CustomLinkEventArgs(pkid, e.CommandArgument))
                ElseIf e.CommandName = "Move_Up" Then
                    MyContent.PageContent.MoveUp("6", pkid)
                    BindList()
                ElseIf e.CommandName = "Move_Down" Then
                    MyContent.PageContent.MoveDown("6", pkid)
                    BindList()
                ElseIf e.CommandName = "EditRecord" Then
                    RaiseEvent EditRecordEvent(pkid)
                    dg_TableList.Rebind()
                End If
        End Select
    End Sub
    Public Event RelationshipEvent As EventHandler(Of AdminUtility.RelationshipEventArgs)
    Public Event CustomLinkEvent As EventHandler(Of AdminUtility.CustomLinkEventArgs)
    Friend Event DD_RebindAll As EventHandler
    Public Sub TriggerRebindAll(sender As Object, e As EventArgs)
        RaiseEvent DD_RebindAll(Me, EventArgs.Empty)
    End Sub


    Sub perfSearch(sender As Object, e As System.EventArgs)
        If Context.Items("perfSearch") <> "1" Then
            Context.Items("perfSearch") = "1"
            MyNumericPaging.PageNo = 1
            BindList()
        End If
    End Sub
    Sub triggerSearch(sender As Object, e As System.EventArgs)
        AddHandler Me.Page.LoadComplete, AddressOf perfSearch
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
        Dim strListOrderBy As String = "user_surname, user_firstname"
        If Not PageInfo.Sort & "x" = "x" Then strListOrderBy = PageInfo.Sort

        '#Define Fields and Tables to Display
        Dim strSQL As String = "SELECT *, ROW_NUMBER() OVER (ORDER BY " & strListOrderBy & ") AS 'RowNumber'  FROM users WHERE user_type_fk >= 2 "
        Dim strSQLCount As String = "SELECT COUNT(*) FROM users WHERE user_type_fk >= 2 "
        Dim strWhere As String = MyContent.PageContent.getWhereString(pnlSearchTable)
        If Not (InstanceWhere & "x" = "x") Then
            MyContent.PageContent.appendToWhere(InstanceWhere, strWhere)
        End If
        If Not UserFixedWhere & "x" = "x" Then
            MyContent.PageContent.appendToWhere(UserFixedWhere, strWhere)
        End If

        If Not strWhere & "x" = "x" Then
            strSQL &= "  AND  " & strWhere
            strSQLCount &= "  AND  " & strWhere
        End If
        '# GET RECORD COUNT
        Dim RecordCount = DBFactory.DB.GetDataField(Of Integer)(strSQLCount)
        RecordSummary.Text = RecordCount & " items listed"
        '# GET PAGING
        dg_TableList.PageSize = PageSize.SelectedValue
        MyNumericPaging.PageCount = Math.Ceiling(RecordCount / dg_TableList.PageSize)
        MyNumericPaging.SetPage(MyNumericPaging.PageNo)
        Dim intStartRec As Integer = (MyNumericPaging.PageNo - 1) * PageSize.SelectedValue + 1
        Dim intEndRec As Integer = intStartRec + PageSize.SelectedValue - 1
        '# Build the Final SQL for this Page
        strSQL = "WITH TheTable AS ( " & strSQL & ")    SELECT *  FROM TheTable WHERE RowNumber BETWEEN " & intStartRec & " AND " & intEndRec & " ORDER BY RowNumber"
        dg_TableList.DataSource = DBFactory.DB.GetDataTable(strSQL)
        dg_TableList.DataBind()
        pl_tablelist.Visible = True
        If Not ispostback() Then
        End If
    End Sub
    Sub Export(sender As Object, e As EventArgs)
        Response.Redirect("custom-reports.aspx?id=" & 6)
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
