Imports PingCore.MyContent
Imports System.Data
Imports PingCore.MyData
Imports PingCore
Imports Telerik.Web.UI
Partial Class AdminSection7Edit
Inherits PingCore.Controls.AdminSectionEditControl
Private Const SectionID as integer = 7

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

AddHandler me.DD_RebindAll, AddressOf input_DownDownType.RebindHandler




AddHandler me.DD_RebindAll, AddressOf input_DropDownLinkedSectionID.RebindHandler
AddHandler Me.DD_RebindAll, AddressOf input_DropDownLinkedSectionID_AddEdit.TriggerRebindAll

if not TheMaster.TheIdentityControl.HasSectionAccess(7) then
input_DownDownType.DisableAddNew = true
input_DropDownLinkedSectionID.DisableAddNew = true
input_DropDownParent.DisableAddNew = true
input_DropDownTargetToDisable.DisableAddNew = true
end if





AddHandler me.DD_RebindAll, AddressOf input_DropDownParent.RebindHandler




AddHandler me.DD_RebindAll, AddressOf input_DropDownTargetToDisable.RebindHandler





With TheManager.AjaxSettings

End With



if not TheMaster.TheIdentityControl.HasSectionAccess(7) then
input_DownDownType.DisableAddNew = true
input_DropDownLinkedSectionID.DisableAddNew = true
input_DropDownParent.DisableAddNew = true
input_DropDownTargetToDisable.DisableAddNew = true
end if


  End Sub

Friend Event DD_RebindAll as EventHandler
Public Sub TriggerRebindAll(sender as object, e as eventargs)
  RaiseEvent DD_RebindAll(Me, EventArgs.Empty)
End Sub


  Public Event RelationshipEvent as EventHandler(of AdminUtility.RelationshipEventArgs)
  Public Event CustomLinkEvent as EventHandler(of AdminUtility.CustomLinkEventArgs)
Public Event popevent_input_DownDownType As EventHandler
Protected Sub input_DownDownType_Init(sender as object, e as eventargs) handles input_DownDownType.Init
  dim c as MyControls.DependentDropdown.IDDLevel = CType(sender, MyControls.DependentDropdown.IDDLevel)
  c.Info = New MyControls.DependentDropdown.DDLevelList(2, "Dropdown Type", MyControls.DependentDropdown.IDDLevelInfo.TypeEnum.List, "1,TABLE,2,LIST")
  c.NullText = ""
  c.DisableAddNew = true
End Sub

Protected Sub input_DownDownType_ValidateReq(sender as object, e as ServerValidateEventArgs)
  if string.isnullorempty(input_DownDownType.Text) then
    e.IsValid = false
  else
    e.IsValid = true
  end if
End Sub





Public Event popevent_input_DropDownLinkedSectionID As EventHandler
Protected Sub input_DropDownLinkedSectionID_Init(sender as object, e as eventargs) handles input_DropDownLinkedSectionID.Init
  dim c as MyControls.DependentDropdown.IDDLevel = CType(sender, MyControls.DependentDropdown.IDDLevel)
  c.Info = New MyControls.DependentDropdown.DDLevelTable(7, "Sections (Admin)", MyControls.DependentDropdown.IDDLevelInfo.TypeEnum.Table, 12, "select admin_section_id as value, admin_section_name as text from zz_admin_sections where admin_section_isdeleted = 0  order by admin_section_name", "admin_section_name", "admin_section_id", 0, 0, "", "", "")
  c.NullText = ""
  End Sub

Sub input_DropDownLinkedSectionID_DoneEditing(ByVal intNewRecordID AS Integer) Handles input_DropDownLinkedSectionID_AddEdit.DoneEditing
  '# set selected value, rebind dependent dropdown
  with input_DropDownLinkedSectionID
    .SelectedValue = intNewRecordID
    TriggerRebindAll(Me, EventArgs.Empty)
  end with

  input_DropDownLinkedSectionID_AddEdit.Visible = false
  pnl_Edit.Visible = true
End Sub

Sub input_DropDownLinkedSectionID_QuitEditing() Handles input_DropDownLinkedSectionID_AddEdit.QuitEditing
  '# nothing changed, so show the edit panel
  input_DropDownLinkedSectionID_AddEdit.Visible = false
  pnl_Edit.Visible = true
End Sub

Sub input_DropDownLinkedSectionID_AddingNew(byval sender as object, ByVal e as MyControls.DependentDropdown.AddNewEventArgs) Handles input_DropDownLinkedSectionID.AddNew
  '# nothing changed, so show the edit panel
  With input_DropDownLinkedSectionID_AddEdit
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





Public Event popevent_input_DropDownParent As EventHandler
Protected Sub input_DropDownParent_Init(sender as object, e as eventargs) handles input_DropDownParent.Init
  dim c as MyControls.DependentDropdown.IDDLevel = CType(sender, MyControls.DependentDropdown.IDDLevel)
  c.Info = New MyControls.DependentDropdown.DDLevelTable(17, "All Dropdowns", MyControls.DependentDropdown.IDDLevelInfo.TypeEnum.Table, 7, "select DropDownID as value, DropDownName as text from zz_admin_Dropdowns  order by DropDownName", "DropDownName", "DropDownID", 0, 0, "", "", "")
  c.NullText = ""
  c.DisableAddNew = true
End Sub





Public Event popevent_input_DropDownTargetToDisable As EventHandler
Protected Sub input_DropDownTargetToDisable_Init(sender as object, e as eventargs) handles input_DropDownTargetToDisable.Init
  dim c as MyControls.DependentDropdown.IDDLevel = CType(sender, MyControls.DependentDropdown.IDDLevel)
  c.Info = New MyControls.DependentDropdown.DDLevelTable(17, "All Dropdowns", MyControls.DependentDropdown.IDDLevelInfo.TypeEnum.Table, 7, "select DropDownID as value, DropDownName as text from zz_admin_Dropdowns  order by DropDownName", "DropDownName", "DropDownID", 0, 0, "", "", "")
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
  case 2
    strDropDownFieldName = "DownDownType"
  case 7
    strDropDownFieldName = "DropDownLinkedSectionID"
  case 17
    strDropDownFieldName = "DropDownParent"
  case 17
    strDropDownFieldName = "DropDownTargetToDisable"

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
 if intRecordID = 0 then: edittitle.Text = "Adding New Dropdown" : end if
		SubmitBtn1.Visible = true
		SubmitBtn2.Visible = true
       MyContent.PageContent.FocusFirstControl(pnl_edit)
		if intRecordID <>  0 then
			PrimaryKeyValue =intRecordID
			Dim strSQL As String = "SELECT * FROM zz_admin_dropdowns  WHERE  DropDownID='" & PageContent.addSlashes(PrimaryKeyValue) & "'"
			Dim dt As DataTable = MyData.DBFactory.DB.GetDataTable(strSQL)
           Dim Row As DataRow = dt.Rows(0)
      
      
prechanges_DropDownName.Text = MyContent.PageContent.MakeStr(Row.Item("DropDownName"))
input_DropDownName.Text = MyContent.PageContent.MakeStr(Row.Item("DropDownName"))
      
With "DownDownType"
  dim s as string = Row.Item("DownDownType").ToString()
  if s isnot nothing then
    prechanges_DownDownType.Text = s
    input_DownDownType.SelectedValue = s
  end if
end with

      
prechanges_DropDownListCSV.Text = MyContent.PageContent.MakeStr(Row.Item("DropDownListCSV"))
input_DropDownListCSV.Text = MyContent.PageContent.MakeStr(Row.Item("DropDownListCSV"))
      
prechanges_DropDownTableName.Text = MyContent.PageContent.MakeStr(Row.Item("DropDownTableName"))
input_DropDownTableName.Text = MyContent.PageContent.MakeStr(Row.Item("DropDownTableName"))
      
prechanges_DropDownValueField.Text = MyContent.PageContent.MakeStr(Row.Item("DropDownValueField"))
input_DropDownValueField.Text = MyContent.PageContent.MakeStr(Row.Item("DropDownValueField"))
      
prechanges_DropDownTextField.Text = MyContent.PageContent.MakeStr(Row.Item("DropDownTextField"))
input_DropDownTextField.Text = MyContent.PageContent.MakeStr(Row.Item("DropDownTextField"))
      
prechanges_DropDownOrderBy.Text = MyContent.PageContent.MakeStr(Row.Item("DropDownOrderBy"))
input_DropDownOrderBy.Text = MyContent.PageContent.MakeStr(Row.Item("DropDownOrderBy"))
      
With "DropDownLinkedSectionID"
  dim s as string = Row.Item("DropDownLinkedSectionID").ToString()
  if s isnot nothing then
    prechanges_DropDownLinkedSectionID.Text = s
    input_DropDownLinkedSectionID.SelectedValue = s
  end if
end with

      
With "DropDownParent"
  dim s as string = Row.Item("DropDownParent").ToString()
  if s isnot nothing then
    prechanges_DropDownParent.Text = s
    input_DropDownParent.SelectedValue = s
  end if
end with

      
prechanges_DropDownParentKeyField.Text = MyContent.PageContent.MakeStr(Row.Item("DropDownParentKeyField"))
input_DropDownParentKeyField.Text = MyContent.PageContent.MakeStr(Row.Item("DropDownParentKeyField"))
      
With "DropDownTargetToDisable"
  dim s as string = Row.Item("DropDownTargetToDisable").ToString()
  if s isnot nothing then
    prechanges_DropDownTargetToDisable.Text = s
    input_DropDownTargetToDisable.SelectedValue = s
  end if
end with

      
prechanges_DropDownSearchQuery.Text = MyContent.PageContent.MakeStr(Row.Item("DropDownSearchQuery"))
input_DropDownSearchQuery.Text = MyContent.PageContent.MakeStr(Row.Item("DropDownSearchQuery"))
      
prechanges_DropDownSearchField.Text = MyContent.PageContent.MakeStr(Row.Item("DropDownSearchField"))
input_DropDownSearchField.Text = MyContent.PageContent.MakeStr(Row.Item("DropDownSearchField"))
           Row = Nothing
           dt = Nothing
		else
      
PrimaryKeyValue=0
      
input_DropDownName.Text =  ""
      
      
input_DropDownListCSV.Text =  ""
      
input_DropDownTableName.Text =  ""
      
input_DropDownValueField.Text =  ""
      
input_DropDownTextField.Text =  ""
      
input_DropDownOrderBy.Text =  ""
      
      
      
input_DropDownParentKeyField.Text =  ""
      
      
input_DropDownSearchQuery.Text =  ""
      
input_DropDownSearchField.Text =  ""
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
' Add/Update info for field DropDownID

' Add/Update info for field DropDownName
 strPageAddNewFields &= "DropDownName,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_DropDownName.Text)) & "',"

 strPageUpdateString &=  "DropDownName='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_DropDownName.Text)) & "',"

' Add/Update info for field DownDownType
 strPageAddNewFields &= "DownDownType,"

 strPageAddNewValues &= MyContent.PageContent.MakeInt(input_DownDownType.SelectedValue) & ","

 strPageUpdateString &= "DownDownType=" & MyContent.PageContent.MakeInt(input_DownDownType.SelectedValue) & ","

' Add/Update info for field DropDownListCSV
 strPageAddNewFields &= "DropDownListCSV,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_DropDownListCSV.Text)) & "',"

 strPageUpdateString &=  "DropDownListCSV='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_DropDownListCSV.Text)) & "',"

' Add/Update info for field DropDownTableName
 strPageAddNewFields &= "DropDownTableName,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_DropDownTableName.Text)) & "',"

 strPageUpdateString &=  "DropDownTableName='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_DropDownTableName.Text)) & "',"

' Add/Update info for field DropDownValueField
 strPageAddNewFields &= "DropDownValueField,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_DropDownValueField.Text)) & "',"

 strPageUpdateString &=  "DropDownValueField='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_DropDownValueField.Text)) & "',"

' Add/Update info for field DropDownTextField
 strPageAddNewFields &= "DropDownTextField,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_DropDownTextField.Text)) & "',"

 strPageUpdateString &=  "DropDownTextField='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_DropDownTextField.Text)) & "',"

' Add/Update info for field DropDownOrderBy
 strPageAddNewFields &= "DropDownOrderBy,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_DropDownOrderBy.Text)) & "',"

 strPageUpdateString &=  "DropDownOrderBy='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_DropDownOrderBy.Text)) & "',"

' Add/Update info for field DropDownLinkedSectionID
 strPageAddNewFields &= "DropDownLinkedSectionID,"

 strPageAddNewValues &= MyContent.PageContent.MakeIntOrNull(input_DropDownLinkedSectionID.SelectedValue) & ","

 strPageUpdateString &= "DropDownLinkedSectionID=" & MyContent.PageContent.MakeIntOrNull(input_DropDownLinkedSectionID.SelectedValue) & ","

' Add/Update info for field DropDownParent
 strPageAddNewFields &= "DropDownParent,"

 strPageAddNewValues &= MyContent.PageContent.MakeIntOrNull(input_DropDownParent.SelectedValue) & ","

 strPageUpdateString &= "DropDownParent=" & MyContent.PageContent.MakeIntOrNull(input_DropDownParent.SelectedValue) & ","

' Add/Update info for field DropDownParentKeyField
 strPageAddNewFields &= "DropDownParentKeyField,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_DropDownParentKeyField.Text)) & "',"

 strPageUpdateString &=  "DropDownParentKeyField='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_DropDownParentKeyField.Text)) & "',"

' Add/Update info for field DropDownTargetToDisable
 strPageAddNewFields &= "DropDownTargetToDisable,"

 strPageAddNewValues &= MyContent.PageContent.MakeInt(input_DropDownTargetToDisable.SelectedValue) & ","

 strPageUpdateString &= "DropDownTargetToDisable=" & MyContent.PageContent.MakeInt(input_DropDownTargetToDisable.SelectedValue) & ","

' Add/Update info for field DropDownSearchQuery
 strPageAddNewFields &= "DropDownSearchQuery,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_DropDownSearchQuery.Text)) & "',"

 strPageUpdateString &=  "DropDownSearchQuery='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_DropDownSearchQuery.Text)) & "',"

' Add/Update info for field DropDownSearchField
 strPageAddNewFields &= "DropDownSearchField,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_DropDownSearchField.Text)) & "',"

 strPageUpdateString &=  "DropDownSearchField='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_DropDownSearchField.Text)) & "',"

	strPageAddNewFields = left(strPageAddNewFields, len(strPageAddNewFields )-1)
	strPageAddNewValues = left(strPageAddNewValues, len(strPageAddNewValues )-1)
   strPageAddNewString = "INSERT INTO zz_admin_dropdowns (" & strPageAddNewFields & ") values (" & strPageAddNewValues & ");"
	strPageUpdateString = "UPDATE zz_admin_dropdowns SET " &  left(strPageUpdateString, len(strPageUpdateString )-1) & " WHERE  DropDownID='" & PageContent.addSlashes(PrimaryKeyValue) & "'" & ";"    
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
