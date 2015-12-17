Imports PingCore.MyContent
Imports System.Data
Imports PingCore.MyData
Imports PingCore
Imports Telerik.Web.UI
Partial Class AdminSection11Edit
Inherits PingCore.Controls.AdminSectionEditControl
Private Const SectionID as integer = 11

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

AddHandler me.DD_RebindAll, AddressOf input_admin_section_relationship_type.RebindHandler




AddHandler me.DD_RebindAll, AddressOf input_parent_section_id.RebindHandler
AddHandler Me.DD_RebindAll, AddressOf input_parent_section_id_AddEdit.TriggerRebindAll

if not TheMaster.TheIdentityControl.HasSectionAccess(11) then
input_admin_section_relationship_type.DisableAddNew = true
input_parent_section_id.DisableAddNew = true
input_child_section_id.DisableAddNew = true
end if





AddHandler me.DD_RebindAll, AddressOf input_child_section_id.RebindHandler
AddHandler Me.DD_RebindAll, AddressOf input_child_section_id_AddEdit.TriggerRebindAll

if not TheMaster.TheIdentityControl.HasSectionAccess(11) then
input_admin_section_relationship_type.DisableAddNew = true
input_parent_section_id.DisableAddNew = true
input_child_section_id.DisableAddNew = true
end if






With TheManager.AjaxSettings

End With



if not TheMaster.TheIdentityControl.HasSectionAccess(11) then
input_admin_section_relationship_type.DisableAddNew = true
input_parent_section_id.DisableAddNew = true
input_child_section_id.DisableAddNew = true
end if


  End Sub

Friend Event DD_RebindAll as EventHandler
Public Sub TriggerRebindAll(sender as object, e as eventargs)
  RaiseEvent DD_RebindAll(Me, EventArgs.Empty)
End Sub


  Public Event RelationshipEvent as EventHandler(of AdminUtility.RelationshipEventArgs)
  Public Event CustomLinkEvent as EventHandler(of AdminUtility.CustomLinkEventArgs)
Public Event popevent_input_admin_section_relationship_type As EventHandler
Protected Sub input_admin_section_relationship_type_Init(sender as object, e as eventargs) handles input_admin_section_relationship_type.Init
  dim c as MyControls.DependentDropdown.IDDLevel = CType(sender, MyControls.DependentDropdown.IDDLevel)
  c.Info = New MyControls.DependentDropdown.DDLevelList(5, "Relation Type", MyControls.DependentDropdown.IDDLevelInfo.TypeEnum.List, "1,one-many,2,after-edit")
  c.NullText = ""
  c.DisableAddNew = true
End Sub

Protected Sub input_admin_section_relationship_type_ValidateReq(sender as object, e as ServerValidateEventArgs)
  if string.isnullorempty(input_admin_section_relationship_type.Text) then
    e.IsValid = false
  else
    e.IsValid = true
  end if
End Sub





Public Event popevent_input_parent_section_id As EventHandler
Protected Sub input_parent_section_id_Init(sender as object, e as eventargs) handles input_parent_section_id.Init
  dim c as MyControls.DependentDropdown.IDDLevel = CType(sender, MyControls.DependentDropdown.IDDLevel)
  c.Info = New MyControls.DependentDropdown.DDLevelTable(7, "Sections (Admin)", MyControls.DependentDropdown.IDDLevelInfo.TypeEnum.Table, 12, "select admin_section_id as value, admin_section_name as text from zz_admin_sections where admin_section_isdeleted = 0  order by admin_section_name", "admin_section_name", "admin_section_id", 0, 0, "", "", "")
  c.NullText = ""
  End Sub

Sub input_parent_section_id_DoneEditing(ByVal intNewRecordID AS Integer) Handles input_parent_section_id_AddEdit.DoneEditing
  '# set selected value, rebind dependent dropdown
  with input_parent_section_id
    .SelectedValue = intNewRecordID
    TriggerRebindAll(Me, EventArgs.Empty)
  end with

  input_parent_section_id_AddEdit.Visible = false
  pnl_Edit.Visible = true
End Sub

Sub input_parent_section_id_QuitEditing() Handles input_parent_section_id_AddEdit.QuitEditing
  '# nothing changed, so show the edit panel
  input_parent_section_id_AddEdit.Visible = false
  pnl_Edit.Visible = true
End Sub

Sub input_parent_section_id_AddingNew(byval sender as object, ByVal e as MyControls.DependentDropdown.AddNewEventArgs) Handles input_parent_section_id.AddNew
  '# nothing changed, so show the edit panel
  With input_parent_section_id_AddEdit
    .Visible = true
    .EditView(0)
    if e.TargetDropdown > 0 Then
      .SetDropDownbyTranslation(e.TargetDropDown, e.ParentValueType, e.ParentValue)
    else
      .SetControlByName(e.ParentValueType, e.ParentValue)
    end if
  end with
  pnl_Edit.Visible = false
End Sub





Public Event popevent_input_child_section_id As EventHandler
Protected Sub input_child_section_id_Init(sender as object, e as eventargs) handles input_child_section_id.Init
  dim c as MyControls.DependentDropdown.IDDLevel = CType(sender, MyControls.DependentDropdown.IDDLevel)
  c.Info = New MyControls.DependentDropdown.DDLevelTable(7, "Sections (Admin)", MyControls.DependentDropdown.IDDLevelInfo.TypeEnum.Table, 12, "select admin_section_id as value, admin_section_name as text from zz_admin_sections where admin_section_isdeleted = 0  order by admin_section_name", "admin_section_name", "admin_section_id", 0, 0, "", "", "")
  c.NullText = ""
  End Sub

Sub input_child_section_id_DoneEditing(ByVal intNewRecordID AS Integer) Handles input_child_section_id_AddEdit.DoneEditing
  '# set selected value, rebind dependent dropdown
  with input_child_section_id
    .SelectedValue = intNewRecordID
    TriggerRebindAll(Me, EventArgs.Empty)
  end with

  input_child_section_id_AddEdit.Visible = false
  pnl_Edit.Visible = true
End Sub

Sub input_child_section_id_QuitEditing() Handles input_child_section_id_AddEdit.QuitEditing
  '# nothing changed, so show the edit panel
  input_child_section_id_AddEdit.Visible = false
  pnl_Edit.Visible = true
End Sub

Sub input_child_section_id_AddingNew(byval sender as object, ByVal e as MyControls.DependentDropdown.AddNewEventArgs) Handles input_child_section_id.AddNew
  '# nothing changed, so show the edit panel
  With input_child_section_id_AddEdit
    .Visible = true
    .EditView(0)
    if e.TargetDropdown > 0 Then
      .SetDropDownbyTranslation(e.TargetDropDown, e.ParentValueType, e.ParentValue)
    else
      .SetControlByName(e.ParentValueType, e.ParentValue)
    end if
  end with
  pnl_Edit.Visible = false
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
  case 5
    strDropDownFieldName = "admin_section_relationship_type"
  case 7
    strDropDownFieldName = "parent_section_id"
  case 7
    strDropDownFieldName = "child_section_id"

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
 if intRecordID = 0 then: edittitle.Text = "Adding New Relationship" : end if
		SubmitBtn1.Visible = true
		SubmitBtn2.Visible = true
       MyContent.PageContent.FocusFirstControl(pnl_edit)
		if intRecordID <>  0 then
			PrimaryKeyValue =intRecordID
			Dim strSQL As String = "SELECT * FROM zz_admin_section_relationships  WHERE  admin_section_relationship_id='" & PageContent.addSlashes(PrimaryKeyValue) & "'"
			Dim dt As DataTable = MyData.DBFactory.DB.GetDataTable(strSQL)
           Dim Row As DataRow = dt.Rows(0)
      
      
With "admin_section_relationship_type"
  dim s as string = Row.Item("admin_section_relationship_type").ToString()
  if s isnot nothing then
    prechanges_admin_section_relationship_type.Text = s
    input_admin_section_relationship_type.SelectedValue = s
  end if
end with

      
prechanges_admin_section_relationship_name.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_relationship_name"))
input_admin_section_relationship_name.Text = MyContent.PageContent.MakeStr(Row.Item("admin_section_relationship_name"))
      
With "parent_section_id"
  dim s as string = Row.Item("parent_section_id").ToString()
  if s isnot nothing then
    prechanges_parent_section_id.Text = s
    input_parent_section_id.SelectedValue = s
  end if
end with

      
prechanges_parent_relation_field.Text = MyContent.PageContent.MakeStr(Row.Item("parent_relation_field"))
input_parent_relation_field.Text = MyContent.PageContent.MakeStr(Row.Item("parent_relation_field"))
      
prechanges_parent_display_field.Text = MyContent.PageContent.MakeStr(Row.Item("parent_display_field"))
input_parent_display_field.Text = MyContent.PageContent.MakeStr(Row.Item("parent_display_field"))
      
With "child_section_id"
  dim s as string = Row.Item("child_section_id").ToString()
  if s isnot nothing then
    prechanges_child_section_id.Text = s
    input_child_section_id.SelectedValue = s
  end if
end with

      
prechanges_child_relation_field.Text = MyContent.PageContent.MakeStr(Row.Item("child_relation_field"))
input_child_relation_field.Text = MyContent.PageContent.MakeStr(Row.Item("child_relation_field"))
      
prechanges_type2_parent_relation_value.Text = MyContent.PageContent.MakeStr(Row.Item("type2_parent_relation_value"))
input_type2_parent_relation_value.Text = MyContent.PageContent.MakeStr(Row.Item("type2_parent_relation_value"))
      
prechanges_realtion_one_to_one.Text =  MyContent.PageContent.dbBool(Row.Item("realtion_one_to_one"))
input_realtion_one_to_one.checked =  MyContent.PageContent.dbBool(Row.Item("realtion_one_to_one"))
      
           Row = Nothing
           dt = Nothing
		else
      
PrimaryKeyValue=0
      
      
input_admin_section_relationship_name.Text =  ""
      
      
input_parent_relation_field.Text =  ""
      
input_parent_display_field.Text =  ""
      
      
input_child_relation_field.Text =  ""
      
input_type2_parent_relation_value.Text =  ""
      
input_realtion_one_to_one.checked =  false
      
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
' Add/Update info for field admin_section_relationship_id

' Add/Update info for field admin_section_relationship_type
 strPageAddNewFields &= "admin_section_relationship_type,"

 strPageAddNewValues &= MyContent.PageContent.MakeInt(input_admin_section_relationship_type.SelectedValue) & ","

 strPageUpdateString &= "admin_section_relationship_type=" & MyContent.PageContent.MakeInt(input_admin_section_relationship_type.SelectedValue) & ","

' Add/Update info for field admin_section_relationship_name
 strPageAddNewFields &= "admin_section_relationship_name,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_relationship_name.Text)) & "',"

 strPageUpdateString &=  "admin_section_relationship_name='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_admin_section_relationship_name.Text)) & "',"

' Add/Update info for field parent_section_id
 strPageAddNewFields &= "parent_section_id,"

 strPageAddNewValues &= MyContent.PageContent.MakeInt(input_parent_section_id.SelectedValue) & ","

 strPageUpdateString &= "parent_section_id=" & MyContent.PageContent.MakeInt(input_parent_section_id.SelectedValue) & ","

' Add/Update info for field parent_relation_field
 strPageAddNewFields &= "parent_relation_field,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_parent_relation_field.Text)) & "',"

 strPageUpdateString &=  "parent_relation_field='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_parent_relation_field.Text)) & "',"

' Add/Update info for field parent_display_field
 strPageAddNewFields &= "parent_display_field,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_parent_display_field.Text)) & "',"

 strPageUpdateString &=  "parent_display_field='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_parent_display_field.Text)) & "',"

' Add/Update info for field child_section_id
 strPageAddNewFields &= "child_section_id,"

 strPageAddNewValues &= MyContent.PageContent.MakeInt(input_child_section_id.SelectedValue) & ","

 strPageUpdateString &= "child_section_id=" & MyContent.PageContent.MakeInt(input_child_section_id.SelectedValue) & ","

' Add/Update info for field child_relation_field
 strPageAddNewFields &= "child_relation_field,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_child_relation_field.Text)) & "',"

 strPageUpdateString &=  "child_relation_field='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_child_relation_field.Text)) & "',"

' Add/Update info for field type2_parent_relation_value
 strPageAddNewFields &= "type2_parent_relation_value,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_type2_parent_relation_value.Text)) & "',"

 strPageUpdateString &=  "type2_parent_relation_value='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_type2_parent_relation_value.Text)) & "',"

' Add/Update info for field realtion_one_to_one
 strPageAddNewFields &=  "realtion_one_to_one,"
 strPageAddNewValues &=   MyContent.PageContent.dbBool(input_realtion_one_to_one.checked) & ","


 strPageUpdateString &= "realtion_one_to_one=" &  MyContent.PageContent.dbBool(input_realtion_one_to_one.checked) & ","

' Add/Update info for field relationship_isdeleted

	strPageAddNewFields = left(strPageAddNewFields, len(strPageAddNewFields )-1)
	strPageAddNewValues = left(strPageAddNewValues, len(strPageAddNewValues )-1)
   strPageAddNewString = "INSERT INTO zz_admin_section_relationships (" & strPageAddNewFields & ") values (" & strPageAddNewValues & ");"
	strPageUpdateString = "UPDATE zz_admin_section_relationships SET " &  left(strPageUpdateString, len(strPageUpdateString )-1) & " WHERE  admin_section_relationship_id='" & PageContent.addSlashes(PrimaryKeyValue) & "'" & ";"    
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
