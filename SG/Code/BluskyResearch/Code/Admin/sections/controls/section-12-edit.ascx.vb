Imports PingCore.MyContent
Imports System.Data
Imports PingCore.MyData
Imports PingCore
Imports Telerik.Web.UI
Partial Class AdminSection12Edit
Inherits PingCore.Controls.AdminSectionEditControl
Private Const SectionID as integer = 12

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

#Region "PrimaryKeyValue"
   Private Property PrimaryKeyValue() As Integer
        Get
            Return PageContent.MakeInt(Viewstate("PrimaryKeyValue"))
        End Get
        Set(ByVal value As Integer)
            Viewstate("PrimaryKeyValue") = value
        End Set
    End Property
 #End Region

			Dim m_EditandSendBack As Boolean

  Sub Page_Init(sender as object, e as eventargs) handles me.Init

    If Not TheMaster.TheIdentityControl.HasSectionAccess(SectionID) Then
      TheMaster.TheIdentityControl.LogoutWithAbort()
      Response.End
    End If

AddHandler me.DD_RebindAll, AddressOf input_admin_section_group_fk.RebindHandler





With TheManager.AjaxSettings

End With



if not TheMaster.TheIdentityControl.HasSectionAccess(12) then
input_admin_section_group_fk.DisableAddNew = true
end if


  End Sub

Friend Event DD_RebindAll as EventHandler
Public Sub TriggerRebindAll(sender as object, e as eventargs)
  RaiseEvent DD_RebindAll(Me, EventArgs.Empty)
End Sub


  Public Event RelationshipEvent as EventHandler(of AdminUtility.RelationshipEventArgs)
  Public Event CustomLinkEvent as EventHandler(of AdminUtility.CustomLinkEventArgs)
Public Event popevent_input_admin_section_group_fk As EventHandler
Protected Sub input_admin_section_group_fk_Init(sender as object, e as eventargs) handles input_admin_section_group_fk.Init
  dim c as MyControls.DependentDropdown.IDDLevel = CType(sender, MyControls.DependentDropdown.IDDLevel)
  c.Info = New MyControls.DependentDropdown.DDLevelTable(99, "Admin Menu Groups", MyControls.DependentDropdown.IDDLevelInfo.TypeEnum.Table, 0, "select admin_section_group_id as value, admin_section_group_name as text from zz_admin_section_groups  order by admin_section_group_order", "admin_section_group_name", "admin_section_group_id", 0, 0, "", "", "")
  c.NullText = ""
  c.DisableAddNew = true
End Sub





			Sub Page_Load(sender as object, e as eventargs) Handles Me.Load 
End Sub 
       Sub DisableField(byval fieldname as string) 
           MyContent.PageContent.FindControlandDisable(pnl_Edit, fieldname)
       End Sub
       Sub SetFieldandDisable(byval fieldname as string,byval value as string) 
           MyContent.PageContent.FindControlSetandDisable(pnl_Edit, fieldname, value)
       End Sub
       Sub SetControlByName(byval controlname as string,byval value as string)  
           MyContent.PageContent.FindControlSetandDisable(pnl_Edit, controlname, value)
       End Sub
       Sub SetDropDownbyTranslation(byval DropDownID AS integer, byval translationfieldname as string,byval value as string)  
           Dim strDropDownFieldName AS String = Nothing
           select case DropDownID
  case 99
    strDropDownFieldName = "admin_section_group_fk"

               case else
       TranslationError:            throw(new Exception(string.format("Translation Error: Missing dropdown {0}", dropdownid)))
           end select
           MyContent.PageContent.FindControlSetandDisable(pnl_Edit, strDropDownFieldName, value)
       End Sub
      Protected Overrides Sub OnLoadComplete(ByVal e as eventargs)
        With "Ajax Methods"
End With


      End Sub

'    Public Property EditandSendBack() As Boolean
'        Get
'            Return m_EditandSendBack
'        End Get
'        Set(ByVal value As Boolean)
'            m_EditandSendBack = value
'        End Set
'   End Property
	Public Sub EditView(ByVal intRecordID AS Integer)
  edittitle.Text = "Editing" 
 if intRecordID = 0 then: edittitle.Text = "Adding New Section" : end if
		SubmitBtn1.Visible = true
		SubmitBtn2.Visible = true
       MyContent.PageContent.FocusFirstControl(pnl_edit)
		if intRecordID <>  0 then
			PrimaryKeyValue =intRecordID
			Dim strSQL As String = "SELECT * FROM zz_admin_sections  WHERE  admin_section_id='" & PageContent.addSlashes(PrimaryKeyValue) & "'"
			Dim dt As DataTable = MyData.DBFactory.DB.GetDataTable(strSQL)
           Dim Row As DataRow = dt.Rows(0)
      
      
prechanges_admin_section_name.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_name"))
input_admin_section_name.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_name"))
      
prechanges_admin_section_item_name.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_item_name"))
input_admin_section_item_name.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_item_name"))
      
prechanges_admin_section_list_fields.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_list_fields"))
input_admin_section_list_fields.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_list_fields"))
      
prechanges_admin_section_list_tables.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_list_tables"))
input_admin_section_list_tables.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_list_tables"))
      
prechanges_admin_section_edit_table.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_edit_table"))
input_admin_section_edit_table.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_edit_table"))
      
prechanges_admin_file_name.Text = MyContent.PageContent.MakeStr(Row.Item("admin_file_name"))
input_admin_file_name.Text = MyContent.PageContent.MakeStr(Row.Item("admin_file_name"))
      
prechanges_admin_section_title_field.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_title_field"))
input_admin_section_title_field.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_title_field"))
      
prechanges_admin_section_never_add.Text =  MyContent.PageContent.dbBool(Row.Item("admin_section_never_add"))
input_admin_section_never_add.checked =  MyContent.PageContent.dbBool(Row.Item("admin_section_never_add"))
      
prechanges_admin_section_never_edit.Text =  MyContent.PageContent.dbBool(Row.Item("admin_section_never_edit"))
input_admin_section_never_edit.checked =  MyContent.PageContent.dbBool(Row.Item("admin_section_never_edit"))
      
prechanges_admin_section_never_delete.Text =  MyContent.PageContent.dbBool(Row.Item("admin_section_never_delete"))
input_admin_section_never_delete.checked =  MyContent.PageContent.dbBool(Row.Item("admin_section_never_delete"))
      
prechanges_admin_section_order_field.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_order_field"))
input_admin_section_order_field.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_order_field"))
      
prechanges_admin_section_isdeleted_field.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_isdeleted_field"))
input_admin_section_isdeleted_field.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_isdeleted_field"))
      
      
With "admin_section_group_fk"
  dim s as string = Row.Item("admin_section_group_fk").ToString()
  if s isnot nothing then
    prechanges_admin_section_group_fk.Text = s
    input_admin_section_group_fk.SelectedValue = s
  end if
end with

      
prechanges_admin_section_rewrite_name_field.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_rewrite_name_field"))
input_admin_section_rewrite_name_field.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_rewrite_name_field"))
      
prechanges_admin_section_iscustom.Text =  MyContent.PageContent.dbBool(Row.Item("admin_section_iscustom"))
input_admin_section_iscustom.checked =  MyContent.PageContent.dbBool(Row.Item("admin_section_iscustom"))
      
prechanges_admin_section_custom_list_control.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_custom_list_control"))
input_admin_section_custom_list_control.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_custom_list_control"))
      
prechanges_admin_section_custom_edit_control.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_custom_edit_control"))
input_admin_section_custom_edit_control.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_custom_edit_control"))
      
prechanges_admin_section_list_query.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_list_query"))
input_admin_section_list_query.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_list_query"))
      
prechanges_admin_section_after_add_new_func.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_after_add_new_func"))
input_admin_section_after_add_new_func.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_after_add_new_func"))
      
prechanges_admin_section_after_add_new.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_after_add_new"))
input_admin_section_after_add_new.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_after_add_new"))
      
prechanges_admin_section_after_update_func.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_after_update_func"))
input_admin_section_after_update_func.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_after_update_func"))
      
prechanges_admin_section_after_update.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_after_update"))
input_admin_section_after_update.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_after_update"))
      
input_admin_section_max_user_level.Text = MyContent.PageContent.MakeInt(Row.Item("admin_section_max_user_level"))
prechanges_admin_section_max_user_level.Text = MyContent.PageContent.MakeInt(Row.Item("admin_section_max_user_level"))
      
prechanges_admin_section_owner_field.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_owner_field"))
input_admin_section_owner_field.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_owner_field"))
      
prechanges_admin_section_owner_session_var.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_owner_session_var"))
input_admin_section_owner_session_var.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_owner_session_var"))
      
prechanges_admin_section_fixedWhere.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_fixedWhere"))
input_admin_section_fixedWhere.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_fixedWhere"))
      
prechanges_admin_section_orderby.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_orderby"))
input_admin_section_orderby.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_orderby"))
      
prechanges_admin_section_groupby.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_groupby"))
input_admin_section_groupby.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_groupby"))
      
prechanges_admin_section_add_before_edit.Text =  MyContent.PageContent.dbBool(Row.Item("admin_section_add_before_edit"))
input_admin_section_add_before_edit.checked =  MyContent.PageContent.dbBool(Row.Item("admin_section_add_before_edit"))
      
input_admin_section_never_add_user_level.Text = MyContent.PageContent.MakeInt(Row.Item("admin_section_never_add_user_level"))
prechanges_admin_section_never_add_user_level.Text = MyContent.PageContent.MakeInt(Row.Item("admin_section_never_add_user_level"))
      
input_admin_section_never_edit_user_level.Text = MyContent.PageContent.MakeInt(Row.Item("admin_section_never_edit_user_level"))
prechanges_admin_section_never_edit_user_level.Text = MyContent.PageContent.MakeInt(Row.Item("admin_section_never_edit_user_level"))
      
input_admin_section_never_delete_user_level.Text = MyContent.PageContent.MakeInt(Row.Item("admin_section_never_delete_user_level"))
prechanges_admin_section_never_delete_user_level.Text = MyContent.PageContent.MakeInt(Row.Item("admin_section_never_delete_user_level"))
      
prechanges_admin_section_order_groupby.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_order_groupby"))
input_admin_section_order_groupby.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_order_groupby"))
      
prechanges_admin_section_order_isreversed.Text =  MyContent.PageContent.dbBool(Row.Item("admin_section_order_isreversed"))
input_admin_section_order_isreversed.checked =  MyContent.PageContent.dbBool(Row.Item("admin_section_order_isreversed"))
      
input_admin_section_menu_id.Text = MyContent.PageContent.MakeInt(Row.Item("admin_section_menu_id"))
prechanges_admin_section_menu_id.Text = MyContent.PageContent.MakeInt(Row.Item("admin_section_menu_id"))
      
input_admin_section_menu_order.Text = MyContent.PageContent.MakeInt(Row.Item("admin_section_menu_order"))
prechanges_admin_section_menu_order.Text = MyContent.PageContent.MakeInt(Row.Item("admin_section_menu_order"))
      
prechanges_admin_section_conditional_display.Text =  MyContent.PageContent.dbBool(Row.Item("admin_section_conditional_display"))
input_admin_section_conditional_display.checked =  MyContent.PageContent.dbBool(Row.Item("admin_section_conditional_display"))
      
prechanges_admin_section_rowclassexpr.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_rowclassexpr"))
input_admin_section_rowclassexpr.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_rowclassexpr"))
      
prechanges_admin_section_show_duplicates.Text =  MyContent.PageContent.dbBool(Row.Item("admin_section_show_duplicates"))
input_admin_section_show_duplicates.checked =  MyContent.PageContent.dbBool(Row.Item("admin_section_show_duplicates"))
      
prechanges_admin_section_internal_hierarchy_field.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_internal_hierarchy_field"))
input_admin_section_internal_hierarchy_field.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_internal_hierarchy_field"))
      
prechanges_admin_section_Has_Paragraphs.Text =  MyContent.PageContent.dbBool(Row.Item("admin_section_Has_Paragraphs"))
input_admin_section_Has_Paragraphs.checked =  MyContent.PageContent.dbBool(Row.Item("admin_section_Has_Paragraphs"))
      
prechanges_admin_section_Has_Paragraphs_Position_After.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_Has_Paragraphs_Position_After"))
input_admin_section_Has_Paragraphs_Position_After.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_Has_Paragraphs_Position_After"))
      
prechanges_admin_section_Has_Paragraphs_DBTable.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_Has_Paragraphs_DBTable"))
input_admin_section_Has_Paragraphs_DBTable.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_Has_Paragraphs_DBTable"))
      
input_admin_section_MenuLevel.Text = MyContent.PageContent.MakeInt(Row.Item("admin_section_MenuLevel"))
prechanges_admin_section_MenuLevel.Text = MyContent.PageContent.MakeInt(Row.Item("admin_section_MenuLevel"))
           Row = Nothing
           dt = Nothing
		else
      
PrimaryKeyValue=0
      
input_admin_section_name.Text =  ""
      
input_admin_section_item_name.Text =  ""
      
input_admin_section_list_fields.Text =  ""
      
input_admin_section_list_tables.Text =  ""
      
input_admin_section_edit_table.Text =  ""
      
input_admin_file_name.Text =  ""
      
input_admin_section_title_field.Text =  ""
      
input_admin_section_never_add.checked =  false
      
input_admin_section_never_edit.checked =  false
      
input_admin_section_never_delete.checked =  false
      
input_admin_section_order_field.Text =  ""
      
input_admin_section_isdeleted_field.Text =  ""
      
      
      
input_admin_section_rewrite_name_field.Text =  ""
      
input_admin_section_iscustom.checked =  false
      
input_admin_section_custom_list_control.Text =  ""
      
input_admin_section_custom_edit_control.Text =  ""
      
input_admin_section_list_query.Text =  ""
      
input_admin_section_after_add_new_func.Text =  ""
      
input_admin_section_after_add_new.Text =  ""
      
input_admin_section_after_update_func.Text =  ""
      
input_admin_section_after_update.Text =  ""
      
input_admin_section_max_user_level.Text = ""
prechanges_admin_section_max_user_level.Text = ""
      
input_admin_section_owner_field.Text =  "skip"
      
input_admin_section_owner_session_var.Text =  ""
      
input_admin_section_fixedWhere.Text =  ""
      
input_admin_section_orderby.Text =  ""
      
input_admin_section_groupby.Text =  ""
      
input_admin_section_add_before_edit.checked =  false
      
input_admin_section_never_add_user_level.Text = ""
prechanges_admin_section_never_add_user_level.Text = ""
      
input_admin_section_never_edit_user_level.Text = ""
prechanges_admin_section_never_edit_user_level.Text = ""
      
input_admin_section_never_delete_user_level.Text = ""
prechanges_admin_section_never_delete_user_level.Text = ""
      
input_admin_section_order_groupby.Text =  ""
      
input_admin_section_order_isreversed.checked =  false
      
input_admin_section_menu_id.Text = ""
prechanges_admin_section_menu_id.Text = ""
      
input_admin_section_menu_order.Text = ""
prechanges_admin_section_menu_order.Text = ""
      
input_admin_section_conditional_display.checked =  false
      
input_admin_section_rowclassexpr.Text =  ""
      
input_admin_section_show_duplicates.checked =  false
      
input_admin_section_internal_hierarchy_field.Text =  ""
      
input_admin_section_Has_Paragraphs.checked =  false
      
input_admin_section_Has_Paragraphs_Position_After.Text =  ""
      
input_admin_section_Has_Paragraphs_DBTable.Text =  ""
      
input_admin_section_MenuLevel.Text = ""
prechanges_admin_section_MenuLevel.Text = ""
		end if
		page1.Visible = True
		currpage.Text=1
		PrevBtn1.Visible = False
		PrevBtn2.Visible = False
	End Sub
   Public Event DoneEditing(ByVal RecordID AS Integer)
   Public Event QuitEditing()
   Sub BackLink(ByVal sender As Object, ByVal e As System.EventArgs) Handles AbandonBtn1.Click, AbandonBtn2.Click
      RaiseEvent QuitEditing()
   end sub
  Sub ShowFile(sender as object, e as eventargs)
    dim b as linkbutton = CType(sender, linkbutton)
    if b.CommandArgument.EndsWith(".") then
      Throw new PreconditionException("Bad Upload in StreamUploadFile")
    End If
    MyContent.PageContent.StreamUploadFile(b.CommandArgument, Context)
  End Sub

Sub SubmitBtn_Click(sender as object, E as eventArgs)
if Page.isValid then
	Dim strPageUpdateString AS String = ""
	Dim strPageAddNewFields AS String = ""
	Dim strPageAddNewValues AS String = ""
	Dim strPageAddNewString AS String = ""
' Add/Update info for field admin_section_id

' Add/Update info for field admin_section_name
 strPageAddNewFields &= "admin_section_name,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_name.Text)) & "',"

 strPageUpdateString &=  "admin_section_name='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_name.Text)) & "',"

' Add/Update info for field admin_section_item_name
 strPageAddNewFields &= "admin_section_item_name,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_item_name.Text)) & "',"

 strPageUpdateString &=  "admin_section_item_name='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_item_name.Text)) & "',"

' Add/Update info for field admin_section_list_fields
 strPageAddNewFields &= "admin_section_list_fields,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_list_fields.Text)) & "',"

 strPageUpdateString &=  "admin_section_list_fields='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_list_fields.Text)) & "',"

' Add/Update info for field admin_section_list_tables
 strPageAddNewFields &= "admin_section_list_tables,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_list_tables.Text)) & "',"

 strPageUpdateString &=  "admin_section_list_tables='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_list_tables.Text)) & "',"

' Add/Update info for field admin_section_edit_table
 strPageAddNewFields &= "admin_section_edit_table,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_edit_table.Text)) & "',"

 strPageUpdateString &=  "admin_section_edit_table='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_edit_table.Text)) & "',"

' Add/Update info for field admin_file_name
 strPageAddNewFields &= "admin_file_name,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_file_name.Text)) & "',"

 strPageUpdateString &=  "admin_file_name='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_file_name.Text)) & "',"

' Add/Update info for field admin_section_title_field
 strPageAddNewFields &= "admin_section_title_field,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_title_field.Text)) & "',"

 strPageUpdateString &=  "admin_section_title_field='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_title_field.Text)) & "',"

' Add/Update info for field admin_section_never_add
 strPageAddNewFields &=  "admin_section_never_add,"
 strPageAddNewValues &=   MyContent.PageContent.dbBool(input_admin_section_never_add.checked) & ","


 strPageUpdateString &= "admin_section_never_add=" &  MyContent.PageContent.dbBool(input_admin_section_never_add.checked) & ","

' Add/Update info for field admin_section_never_edit
 strPageAddNewFields &=  "admin_section_never_edit,"
 strPageAddNewValues &=   MyContent.PageContent.dbBool(input_admin_section_never_edit.checked) & ","


 strPageUpdateString &= "admin_section_never_edit=" &  MyContent.PageContent.dbBool(input_admin_section_never_edit.checked) & ","

' Add/Update info for field admin_section_never_delete
 strPageAddNewFields &=  "admin_section_never_delete,"
 strPageAddNewValues &=   MyContent.PageContent.dbBool(input_admin_section_never_delete.checked) & ","


 strPageUpdateString &= "admin_section_never_delete=" &  MyContent.PageContent.dbBool(input_admin_section_never_delete.checked) & ","

' Add/Update info for field admin_section_order_field
 strPageAddNewFields &= "admin_section_order_field,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_order_field.Text)) & "',"

 strPageUpdateString &=  "admin_section_order_field='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_order_field.Text)) & "',"

' Add/Update info for field admin_section_isdeleted_field
 strPageAddNewFields &= "admin_section_isdeleted_field,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_isdeleted_field.Text)) & "',"

 strPageUpdateString &=  "admin_section_isdeleted_field='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_isdeleted_field.Text)) & "',"

' Add/Update info for field admin_section_isdeleted

' Add/Update info for field admin_section_group_fk
 strPageAddNewFields &= "admin_section_group_fk,"

 strPageAddNewValues &= MyContent.PageContent.MakeInt(input_admin_section_group_fk.SelectedValue) & ","

 strPageUpdateString &= "admin_section_group_fk=" & MyContent.PageContent.MakeInt(input_admin_section_group_fk.SelectedValue) & ","

' Add/Update info for field admin_section_rewrite_name_field
 strPageAddNewFields &= "admin_section_rewrite_name_field,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_rewrite_name_field.Text)) & "',"

 strPageUpdateString &=  "admin_section_rewrite_name_field='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_rewrite_name_field.Text)) & "',"

' Add/Update info for field admin_section_iscustom
 strPageAddNewFields &=  "admin_section_iscustom,"
 strPageAddNewValues &=   MyContent.PageContent.dbBool(input_admin_section_iscustom.checked) & ","


 strPageUpdateString &= "admin_section_iscustom=" &  MyContent.PageContent.dbBool(input_admin_section_iscustom.checked) & ","

' Add/Update info for field admin_section_custom_list_control
 strPageAddNewFields &= "admin_section_custom_list_control,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_custom_list_control.Text)) & "',"

 strPageUpdateString &=  "admin_section_custom_list_control='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_custom_list_control.Text)) & "',"

' Add/Update info for field admin_section_custom_edit_control
 strPageAddNewFields &= "admin_section_custom_edit_control,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_custom_edit_control.Text)) & "',"

 strPageUpdateString &=  "admin_section_custom_edit_control='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_custom_edit_control.Text)) & "',"

' Add/Update info for field admin_section_list_query
 strPageAddNewFields &= "admin_section_list_query,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_list_query.Text)) & "',"

 strPageUpdateString &=  "admin_section_list_query='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_list_query.Text)) & "',"

' Add/Update info for field admin_section_after_add_new_func
 strPageAddNewFields &= "admin_section_after_add_new_func,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_after_add_new_func.Text)) & "',"

 strPageUpdateString &=  "admin_section_after_add_new_func='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_after_add_new_func.Text)) & "',"

' Add/Update info for field admin_section_after_add_new
 strPageAddNewFields &= "admin_section_after_add_new,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_after_add_new.Text)) & "',"

 strPageUpdateString &=  "admin_section_after_add_new='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_after_add_new.Text)) & "',"

' Add/Update info for field admin_section_after_update_func
 strPageAddNewFields &= "admin_section_after_update_func,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_after_update_func.Text)) & "',"

 strPageUpdateString &=  "admin_section_after_update_func='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_after_update_func.Text)) & "',"

' Add/Update info for field admin_section_after_update
 strPageAddNewFields &= "admin_section_after_update,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_after_update.Text)) & "',"

 strPageUpdateString &=  "admin_section_after_update='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_after_update.Text)) & "',"

' Add/Update info for field admin_section_max_user_level
strPageAddNewFields &= "admin_section_max_user_level,"
strPageAddNewValues &= MyContent.PageContent.MakeInt(input_admin_section_max_user_level.Text) & ","

strPageUpdateString &= "admin_section_max_user_level=" & MyContent.PageContent.MakeInt(input_admin_section_max_user_level.Text) & ","


' Add/Update info for field admin_section_owner_field
 strPageAddNewFields &= "admin_section_owner_field,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_owner_field.Text)) & "',"

 strPageUpdateString &=  "admin_section_owner_field='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_owner_field.Text)) & "',"

' Add/Update info for field admin_section_owner_session_var
 strPageAddNewFields &= "admin_section_owner_session_var,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_owner_session_var.Text)) & "',"

 strPageUpdateString &=  "admin_section_owner_session_var='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_owner_session_var.Text)) & "',"

' Add/Update info for field admin_section_fixedWhere
 strPageAddNewFields &= "admin_section_fixedWhere,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_fixedWhere.Text)) & "',"

 strPageUpdateString &=  "admin_section_fixedWhere='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_fixedWhere.Text)) & "',"

' Add/Update info for field admin_section_orderby
 strPageAddNewFields &= "admin_section_orderby,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_orderby.Text)) & "',"

 strPageUpdateString &=  "admin_section_orderby='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_orderby.Text)) & "',"

' Add/Update info for field admin_section_groupby
 strPageAddNewFields &= "admin_section_groupby,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_groupby.Text)) & "',"

 strPageUpdateString &=  "admin_section_groupby='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_groupby.Text)) & "',"

' Add/Update info for field admin_section_add_before_edit
 strPageAddNewFields &=  "admin_section_add_before_edit,"
 strPageAddNewValues &=   MyContent.PageContent.dbBool(input_admin_section_add_before_edit.checked) & ","


 strPageUpdateString &= "admin_section_add_before_edit=" &  MyContent.PageContent.dbBool(input_admin_section_add_before_edit.checked) & ","

' Add/Update info for field admin_section_never_add_user_level
strPageAddNewFields &= "admin_section_never_add_user_level,"
strPageAddNewValues &= MyContent.PageContent.MakeInt(input_admin_section_never_add_user_level.Text) & ","

strPageUpdateString &= "admin_section_never_add_user_level=" & MyContent.PageContent.MakeInt(input_admin_section_never_add_user_level.Text) & ","


' Add/Update info for field admin_section_never_edit_user_level
strPageAddNewFields &= "admin_section_never_edit_user_level,"
strPageAddNewValues &= MyContent.PageContent.MakeInt(input_admin_section_never_edit_user_level.Text) & ","

strPageUpdateString &= "admin_section_never_edit_user_level=" & MyContent.PageContent.MakeInt(input_admin_section_never_edit_user_level.Text) & ","


' Add/Update info for field admin_section_never_delete_user_level
strPageAddNewFields &= "admin_section_never_delete_user_level,"
strPageAddNewValues &= MyContent.PageContent.MakeInt(input_admin_section_never_delete_user_level.Text) & ","

strPageUpdateString &= "admin_section_never_delete_user_level=" & MyContent.PageContent.MakeInt(input_admin_section_never_delete_user_level.Text) & ","


' Add/Update info for field admin_section_order_groupby
 strPageAddNewFields &= "admin_section_order_groupby,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_order_groupby.Text)) & "',"

 strPageUpdateString &=  "admin_section_order_groupby='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_order_groupby.Text)) & "',"

' Add/Update info for field admin_section_order_isreversed
 strPageAddNewFields &=  "admin_section_order_isreversed,"
 strPageAddNewValues &=   MyContent.PageContent.dbBool(input_admin_section_order_isreversed.checked) & ","


 strPageUpdateString &= "admin_section_order_isreversed=" &  MyContent.PageContent.dbBool(input_admin_section_order_isreversed.checked) & ","

' Add/Update info for field admin_section_menu_id
strPageAddNewFields &= "admin_section_menu_id,"
strPageAddNewValues &= MyContent.PageContent.MakeInt(input_admin_section_menu_id.Text) & ","

strPageUpdateString &= "admin_section_menu_id=" & MyContent.PageContent.MakeInt(input_admin_section_menu_id.Text) & ","


' Add/Update info for field admin_section_menu_order
strPageAddNewFields &= "admin_section_menu_order,"
strPageAddNewValues &= MyContent.PageContent.MakeInt(input_admin_section_menu_order.Text) & ","

strPageUpdateString &= "admin_section_menu_order=" & MyContent.PageContent.MakeInt(input_admin_section_menu_order.Text) & ","


' Add/Update info for field admin_section_conditional_display
 strPageAddNewFields &=  "admin_section_conditional_display,"
 strPageAddNewValues &=   MyContent.PageContent.dbBool(input_admin_section_conditional_display.checked) & ","


 strPageUpdateString &= "admin_section_conditional_display=" &  MyContent.PageContent.dbBool(input_admin_section_conditional_display.checked) & ","

' Add/Update info for field admin_section_rowclassexpr
 strPageAddNewFields &= "admin_section_rowclassexpr,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_rowclassexpr.Text)) & "',"

 strPageUpdateString &=  "admin_section_rowclassexpr='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_rowclassexpr.Text)) & "',"

' Add/Update info for field admin_section_show_duplicates
 strPageAddNewFields &=  "admin_section_show_duplicates,"
 strPageAddNewValues &=   MyContent.PageContent.dbBool(input_admin_section_show_duplicates.checked) & ","


 strPageUpdateString &= "admin_section_show_duplicates=" &  MyContent.PageContent.dbBool(input_admin_section_show_duplicates.checked) & ","

' Add/Update info for field admin_section_internal_hierarchy_field
 strPageAddNewFields &= "admin_section_internal_hierarchy_field,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_internal_hierarchy_field.Text)) & "',"

 strPageUpdateString &=  "admin_section_internal_hierarchy_field='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_internal_hierarchy_field.Text)) & "',"

' Add/Update info for field admin_section_Has_Paragraphs
 strPageAddNewFields &=  "admin_section_Has_Paragraphs,"
 strPageAddNewValues &=   MyContent.PageContent.dbBool(input_admin_section_Has_Paragraphs.checked) & ","


 strPageUpdateString &= "admin_section_Has_Paragraphs=" &  MyContent.PageContent.dbBool(input_admin_section_Has_Paragraphs.checked) & ","

' Add/Update info for field admin_section_Has_Paragraphs_Position_After
 strPageAddNewFields &= "admin_section_Has_Paragraphs_Position_After,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_Has_Paragraphs_Position_After.Text)) & "',"

 strPageUpdateString &=  "admin_section_Has_Paragraphs_Position_After='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_Has_Paragraphs_Position_After.Text)) & "',"

' Add/Update info for field admin_section_Has_Paragraphs_DBTable
 strPageAddNewFields &= "admin_section_Has_Paragraphs_DBTable,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_Has_Paragraphs_DBTable.Text)) & "',"

 strPageUpdateString &=  "admin_section_Has_Paragraphs_DBTable='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_Has_Paragraphs_DBTable.Text)) & "',"

' Add/Update info for field admin_section_MenuLevel
strPageAddNewFields &= "admin_section_MenuLevel,"
strPageAddNewValues &= MyContent.PageContent.MakeInt(input_admin_section_MenuLevel.Text) & ","

strPageUpdateString &= "admin_section_MenuLevel=" & MyContent.PageContent.MakeInt(input_admin_section_MenuLevel.Text) & ","


	strPageAddNewFields = left(strPageAddNewFields, len(strPageAddNewFields )-1)
	strPageAddNewValues = left(strPageAddNewValues, len(strPageAddNewValues )-1)
   strPageAddNewString = "INSERT INTO zz_admin_sections (" & strPageAddNewFields & ") values (" & strPageAddNewValues & ");"
	strPageUpdateString = "UPDATE zz_admin_sections SET " &  left(strPageUpdateString, len(strPageUpdateString )-1) & " WHERE  admin_section_id='" & PageContent.addSlashes(PrimaryKeyValue) & "'" & ";"    
Dim strSQL3 As String
Dim IsNewRecord As Boolean = False
If NOT PrimaryKeyValue > 0 Then 
 	strSQL3 = strPageAddNewString
   PrimaryKeyValue =  DBFactory.DB.GetDataField(Of Integer)(strSQL3 & "SELECT SCOPE_IDENTITY() AS NewID; ")
 	IsNewRecord = True
Else
 	strSQL3 = strPageUpdateString 
   DBFactory.DB.RunSQL(strSQL3)
End If
MyContent.PageContent.SetOrder(12)

'#After Save 
if NOT IsNewRecord then 

'#After Update Functions 
else

'#After Add New Functions 
end if
		RaiseEvent DoneEditing(PrimaryKeyValue)
end if
End Sub 
Sub PrevBtn_Click(sender As Object,e As EventArgs)
   if Page.isValid then
       If Not currpage.Text = 1 Then
           Select Case currpage.Text
           End Select
           NextBtn1.Visible=true
           NextBtn2.Visible=true
       End If
       End If
End Sub 
Sub NextBtn_Click(sender As Object,e As EventArgs)
   if Page.isValid then
       If Not currpage.Text >= maxpage.Text Then
           Select Case currpage.Text
               End Select
           PrevBtn1.Visible=true
           PrevBtn2.Visible=true
       End If
   End If
End Sub 
End Class
