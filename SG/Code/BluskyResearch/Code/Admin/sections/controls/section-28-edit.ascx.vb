Imports PingCore.MyContent
Imports System.Data
Imports PingCore.MyData
Imports PingCore
Imports Telerik.Web.UI
Partial Class AdminSection28Edit
Inherits PingCore.Controls.AdminSectionEditControl
Private Const SectionID as integer = 28

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

AddHandler me.DD_RebindAll, AddressOf input_df_section_id.RebindHandler
AddHandler Me.DD_RebindAll, AddressOf input_df_section_id_AddEdit.TriggerRebindAll

if not TheMaster.TheIdentityControl.HasSectionAccess(28) then
input_df_section_id.DisableAddNew = true
input_df_actionpanelnumber.DisableAddNew = true
input_df_actiongroupid.DisableAddNew = true
end if





AddHandler me.DD_RebindAll, AddressOf input_df_actionpanelnumber.RebindHandler




AddHandler me.DD_RebindAll, AddressOf input_df_actiongroupid.RebindHandler
AddHandler Me.DD_RebindAll, AddressOf input_df_actiongroupid_AddEdit.TriggerRebindAll

if not TheMaster.TheIdentityControl.HasSectionAccess(28) then
input_df_section_id.DisableAddNew = true
input_df_actionpanelnumber.DisableAddNew = true
input_df_actiongroupid.DisableAddNew = true
end if






With TheManager.AjaxSettings

End With



if not TheMaster.TheIdentityControl.HasSectionAccess(28) then
input_df_section_id.DisableAddNew = true
input_df_actionpanelnumber.DisableAddNew = true
input_df_actiongroupid.DisableAddNew = true
end if


  End Sub

Friend Event DD_RebindAll as EventHandler
Public Sub TriggerRebindAll(sender as object, e as eventargs)
  RaiseEvent DD_RebindAll(Me, EventArgs.Empty)
End Sub


  Public Event RelationshipEvent as EventHandler(of AdminUtility.RelationshipEventArgs)
  Public Event CustomLinkEvent as EventHandler(of AdminUtility.CustomLinkEventArgs)
Public Event popevent_input_df_section_id As EventHandler
Protected Sub input_df_section_id_Init(sender as object, e as eventargs) handles input_df_section_id.Init
  dim c as MyControls.DependentDropdown.IDDLevel = CType(sender, MyControls.DependentDropdown.IDDLevel)
  c.Info = New MyControls.DependentDropdown.DDLevelTable(7, "Sections (Admin)", MyControls.DependentDropdown.IDDLevelInfo.TypeEnum.Table, 12, "select admin_section_id as value, admin_section_name as text from zz_admin_sections where admin_section_isdeleted = 0  order by admin_section_name", "admin_section_name", "admin_section_id", 0, 0, "", "", "")
  c.NullText = ""
  End Sub

Sub input_df_section_id_DoneEditing(ByVal intNewRecordID AS Integer) Handles input_df_section_id_AddEdit.DoneEditing
  '# set selected value, rebind dependent dropdown
  with input_df_section_id
    .SelectedValue = intNewRecordID
    TriggerRebindAll(Me, EventArgs.Empty)
  end with

  input_df_section_id_AddEdit.Visible = false
  pnl_Edit.Visible = true
End Sub

Sub input_df_section_id_QuitEditing() Handles input_df_section_id_AddEdit.QuitEditing
  '# nothing changed, so show the edit panel
  input_df_section_id_AddEdit.Visible = false
  pnl_Edit.Visible = true
End Sub

Sub input_df_section_id_AddingNew(byval sender as object, ByVal e as MyControls.DependentDropdown.AddNewEventArgs) Handles input_df_section_id.AddNew
  '# nothing changed, so show the edit panel
  With input_df_section_id_AddEdit
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





Public Event popevent_input_df_actionpanelnumber As EventHandler
Protected Sub input_df_actionpanelnumber_Init(sender as object, e as eventargs) handles input_df_actionpanelnumber.Init
  dim c as MyControls.DependentDropdown.IDDLevel = CType(sender, MyControls.DependentDropdown.IDDLevel)
  c.Info = New MyControls.DependentDropdown.DDLevelList(68, "Section Panels", MyControls.DependentDropdown.IDDLevelInfo.TypeEnum.List, "1,1,2,2,3,3,4,4,5,5,6,6,7,7,8,8,9,9")
  c.NullText = ""
  c.DisableAddNew = true
End Sub





Public Event popevent_input_df_actiongroupid As EventHandler
Protected Sub input_df_actiongroupid_Init(sender as object, e as eventargs) handles input_df_actiongroupid.Init
  dim c as MyControls.DependentDropdown.IDDLevel = CType(sender, MyControls.DependentDropdown.IDDLevel)
  c.Info = New MyControls.DependentDropdown.DDLevelTable(69, "Section Groups", MyControls.DependentDropdown.IDDLevelInfo.TypeEnum.Table, 107, "select field_group_id as value, field_group_name as text from zz_admin_section_field_groups  order by field_group_name", "field_group_name", "field_group_id", 0, 0, "", "", "")
  c.NullText = ""
  End Sub

Sub input_df_actiongroupid_DoneEditing(ByVal intNewRecordID AS Integer) Handles input_df_actiongroupid_AddEdit.DoneEditing
  '# set selected value, rebind dependent dropdown
  with input_df_actiongroupid
    .SelectedValue = intNewRecordID
    TriggerRebindAll(Me, EventArgs.Empty)
  end with

  input_df_actiongroupid_AddEdit.Visible = false
  pnl_Edit.Visible = true
End Sub

Sub input_df_actiongroupid_QuitEditing() Handles input_df_actiongroupid_AddEdit.QuitEditing
  '# nothing changed, so show the edit panel
  input_df_actiongroupid_AddEdit.Visible = false
  pnl_Edit.Visible = true
End Sub

Sub input_df_actiongroupid_AddingNew(byval sender as object, ByVal e as MyControls.DependentDropdown.AddNewEventArgs) Handles input_df_actiongroupid.AddNew
  '# nothing changed, so show the edit panel
  With input_df_actiongroupid_AddEdit
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
  case 7
    strDropDownFieldName = "df_section_id"
  case 68
    strDropDownFieldName = "df_actionpanelnumber"
  case 69
    strDropDownFieldName = "df_actiongroupid"

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
 if intRecordID = 0 then: edittitle.Text = "Adding New Dependent Field" : end if
		SubmitBtn1.Visible = true
		SubmitBtn2.Visible = true
       MyContent.PageContent.FocusFirstControl(pnl_edit)
		if intRecordID <>  0 then
			PrimaryKeyValue =intRecordID
			Dim strSQL As String = "SELECT * FROM zz_admin_section_dependent_fields  WHERE  df_id='" & PageContent.addSlashes(PrimaryKeyValue) & "'"
			Dim dt As DataTable = MyData.DBFactory.DB.GetDataTable(strSQL)
           Dim Row As DataRow = dt.Rows(0)
      
prechanges_df_specifichtmlelement.Text = MyContent.PageContent.MakeStr(Row.Item("df_specifichtmlelement"))
input_df_specifichtmlelement.Text = MyContent.PageContent.MakeStr(Row.Item("df_specifichtmlelement"))
      
      
With "df_section_id"
  dim s as string = Row.Item("df_section_id").ToString()
  if s isnot nothing then
    prechanges_df_section_id.Text = s
    input_df_section_id.SelectedValue = s
  end if
end with

      
prechanges_df_desc.Text = MyContent.PageContent.MakeStr(Row.Item("df_desc"))
input_df_desc.Text = MyContent.PageContent.MakeStr(Row.Item("df_desc"))
      
With "df_actionpanelnumber"
  dim s as string = Row.Item("df_actionpanelnumber").ToString()
  if s isnot nothing then
    prechanges_df_actionpanelnumber.Text = s
    input_df_actionpanelnumber.SelectedValue = s
  end if
end with

      
With "df_actiongroupid"
  dim s as string = Row.Item("df_actiongroupid").ToString()
  if s isnot nothing then
    prechanges_df_actiongroupid.Text = s
    input_df_actiongroupid.SelectedValue = s
  end if
end with

      
prechanges_df_actionfield.Text = MyContent.PageContent.MakeStr(Row.Item("df_actionfield"))
input_df_actionfield.Text = MyContent.PageContent.MakeStr(Row.Item("df_actionfield"))
      
prechanges_df_conditionfield.Text = MyContent.PageContent.MakeStr(Row.Item("df_conditionfield"))
input_df_conditionfield.Text = MyContent.PageContent.MakeStr(Row.Item("df_conditionfield"))
      
prechanges_df_regex.Text = MyContent.PageContent.MakeStr(Row.Item("df_regex"))
input_df_regex.Text = MyContent.PageContent.MakeStr(Row.Item("df_regex"))
      
prechanges_df_matchclass.Text = MyContent.PageContent.MakeStr(Row.Item("df_matchclass"))
input_df_matchclass.Text = MyContent.PageContent.MakeStr(Row.Item("df_matchclass"))
      
prechanges_df_failclass.Text = MyContent.PageContent.MakeStr(Row.Item("df_failclass"))
input_df_failclass.Text = MyContent.PageContent.MakeStr(Row.Item("df_failclass"))
           Row = Nothing
           dt = Nothing
		else
      
input_df_specifichtmlelement.Text =  ""
      
PrimaryKeyValue=0
      
      
input_df_desc.Text =  ""
      
      
      
input_df_actionfield.Text =  ""
      
input_df_conditionfield.Text =  ""
      
input_df_regex.Text =  ""
      
input_df_matchclass.Text =  ""
      
input_df_failclass.Text =  ""
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
' Add/Update info for field df_specifichtmlelement
 strPageAddNewFields &= "df_specifichtmlelement,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_df_specifichtmlelement.Text)) & "',"

 strPageUpdateString &=  "df_specifichtmlelement='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_df_specifichtmlelement.Text)) & "',"

' Add/Update info for field df_id

' Add/Update info for field df_section_id
 strPageAddNewFields &= "df_section_id,"

 strPageAddNewValues &= MyContent.PageContent.MakeInt(input_df_section_id.SelectedValue) & ","

 strPageUpdateString &= "df_section_id=" & MyContent.PageContent.MakeInt(input_df_section_id.SelectedValue) & ","

' Add/Update info for field df_desc
 strPageAddNewFields &= "df_desc,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_df_desc.Text)) & "',"

 strPageUpdateString &=  "df_desc='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_df_desc.Text)) & "',"

' Add/Update info for field df_actionpanelnumber
 strPageAddNewFields &= "df_actionpanelnumber,"

 strPageAddNewValues &= MyContent.PageContent.MakeInt(input_df_actionpanelnumber.SelectedValue) & ","

 strPageUpdateString &= "df_actionpanelnumber=" & MyContent.PageContent.MakeInt(input_df_actionpanelnumber.SelectedValue) & ","

' Add/Update info for field df_actiongroupid
 strPageAddNewFields &= "df_actiongroupid,"

 strPageAddNewValues &= MyContent.PageContent.MakeInt(input_df_actiongroupid.SelectedValue) & ","

 strPageUpdateString &= "df_actiongroupid=" & MyContent.PageContent.MakeInt(input_df_actiongroupid.SelectedValue) & ","

' Add/Update info for field df_actionfield
 strPageAddNewFields &= "df_actionfield,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_df_actionfield.Text)) & "',"

 strPageUpdateString &=  "df_actionfield='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_df_actionfield.Text)) & "',"

' Add/Update info for field df_conditionfield
 strPageAddNewFields &= "df_conditionfield,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_df_conditionfield.Text)) & "',"

 strPageUpdateString &=  "df_conditionfield='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_df_conditionfield.Text)) & "',"

' Add/Update info for field df_regex
 strPageAddNewFields &= "df_regex,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_df_regex.Text)) & "',"

 strPageUpdateString &=  "df_regex='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_df_regex.Text)) & "',"

' Add/Update info for field df_matchclass
 strPageAddNewFields &= "df_matchclass,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_df_matchclass.Text)) & "',"

 strPageUpdateString &=  "df_matchclass='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_df_matchclass.Text)) & "',"

' Add/Update info for field df_failclass
 strPageAddNewFields &= "df_failclass,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_df_failclass.Text)) & "',"

 strPageUpdateString &=  "df_failclass='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_df_failclass.Text)) & "',"

	strPageAddNewFields = left(strPageAddNewFields, len(strPageAddNewFields )-1)
	strPageAddNewValues = left(strPageAddNewValues, len(strPageAddNewValues )-1)
   strPageAddNewString = "INSERT INTO zz_admin_section_dependent_fields (" & strPageAddNewFields & ") values (" & strPageAddNewValues & ");"
	strPageUpdateString = "UPDATE zz_admin_section_dependent_fields SET " &  left(strPageUpdateString, len(strPageUpdateString )-1) & " WHERE  df_id='" & PageContent.addSlashes(PrimaryKeyValue) & "'" & ";"    
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
