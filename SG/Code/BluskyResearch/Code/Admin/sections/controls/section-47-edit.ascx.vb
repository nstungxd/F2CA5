Imports PingCore.MyContent
Imports System.Data
Imports PingCore.MyData
Imports PingCore
Imports Telerik.Web.UI
Partial Class AdminSection47Edit
Inherits PingCore.Controls.AdminSectionEditControl
Private Const SectionID as integer = 47

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

AddHandler me.DD_RebindAll, AddressOf input_postcode_lookup_section_id.RebindHandler
AddHandler Me.DD_RebindAll, AddressOf input_postcode_lookup_section_id_AddEdit.TriggerRebindAll

if not TheMaster.TheIdentityControl.HasSectionAccess(47) then
input_postcode_lookup_section_id.DisableAddNew = true
end if






With TheManager.AjaxSettings

End With



if not TheMaster.TheIdentityControl.HasSectionAccess(47) then
input_postcode_lookup_section_id.DisableAddNew = true
end if


  End Sub

Friend Event DD_RebindAll as EventHandler
Public Sub TriggerRebindAll(sender as object, e as eventargs)
  RaiseEvent DD_RebindAll(Me, EventArgs.Empty)
End Sub


  Public Event RelationshipEvent as EventHandler(of AdminUtility.RelationshipEventArgs)
  Public Event CustomLinkEvent as EventHandler(of AdminUtility.CustomLinkEventArgs)
Public Event popevent_input_postcode_lookup_section_id As EventHandler
Protected Sub input_postcode_lookup_section_id_Init(sender as object, e as eventargs) handles input_postcode_lookup_section_id.Init
  dim c as MyControls.DependentDropdown.IDDLevel = CType(sender, MyControls.DependentDropdown.IDDLevel)
  c.Info = New MyControls.DependentDropdown.DDLevelTable(7, "Sections (Admin)", MyControls.DependentDropdown.IDDLevelInfo.TypeEnum.Table, 12, "select admin_section_id as value, admin_section_name as text from zz_admin_sections where admin_section_isdeleted = 0  order by admin_section_name", "admin_section_name", "admin_section_id", 0, 0, "", "", "")
  c.NullText = ""
  End Sub

Sub input_postcode_lookup_section_id_DoneEditing(ByVal intNewRecordID AS Integer) Handles input_postcode_lookup_section_id_AddEdit.DoneEditing
  '# set selected value, rebind dependent dropdown
  with input_postcode_lookup_section_id
    .SelectedValue = intNewRecordID
    TriggerRebindAll(Me, EventArgs.Empty)
  end with

  input_postcode_lookup_section_id_AddEdit.Visible = false
  pnl_Edit.Visible = true
End Sub

Sub input_postcode_lookup_section_id_QuitEditing() Handles input_postcode_lookup_section_id_AddEdit.QuitEditing
  '# nothing changed, so show the edit panel
  input_postcode_lookup_section_id_AddEdit.Visible = false
  pnl_Edit.Visible = true
End Sub

Sub input_postcode_lookup_section_id_AddingNew(byval sender as object, ByVal e as MyControls.DependentDropdown.AddNewEventArgs) Handles input_postcode_lookup_section_id.AddNew
  '# nothing changed, so show the edit panel
  With input_postcode_lookup_section_id_AddEdit
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

Protected Sub input_postcode_lookup_section_id_ValidateReq(sender as object, e as ServerValidateEventArgs)
  if string.isnullorempty(input_postcode_lookup_section_id.Text) then
    e.IsValid = false
  else
    e.IsValid = true
  end if
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
    strDropDownFieldName = "postcode_lookup_section_id"

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
 if intRecordID = 0 then: edittitle.Text = "Adding New Lookup" : end if
		SubmitBtn1.Visible = true
		SubmitBtn2.Visible = true
       MyContent.PageContent.FocusFirstControl(pnl_edit)
		if intRecordID <>  0 then
			PrimaryKeyValue =intRecordID
			Dim strSQL As String = "SELECT * FROM zz_admin_postcode_lookups  WHERE  postcode_lookup_id='" & PageContent.addSlashes(PrimaryKeyValue) & "'"
			Dim dt As DataTable = MyData.DBFactory.DB.GetDataTable(strSQL)
           Dim Row As DataRow = dt.Rows(0)
      
      
With "postcode_lookup_section_id"
  dim s as string = Row.Item("postcode_lookup_section_id").ToString()
  if s isnot nothing then
    prechanges_postcode_lookup_section_id.Text = s
    input_postcode_lookup_section_id.SelectedValue = s
  end if
end with

      
prechanges_postcode_lookup_fields_postcode.Text = MyContent.PageContent.MakeStr(Row.Item("postcode_lookup_fields_postcode"))
input_postcode_lookup_fields_postcode.Text = MyContent.PageContent.MakeStr(Row.Item("postcode_lookup_fields_postcode"))
      
prechanges_postcode_lookup_fields_company_name.Text = MyContent.PageContent.MakeStr(Row.Item("postcode_lookup_fields_company_name"))
input_postcode_lookup_fields_company_name.Text = MyContent.PageContent.MakeStr(Row.Item("postcode_lookup_fields_company_name"))
      
prechanges_postcode_lookup_fields_line1.Text = MyContent.PageContent.MakeStr(Row.Item("postcode_lookup_fields_line1"))
input_postcode_lookup_fields_line1.Text = MyContent.PageContent.MakeStr(Row.Item("postcode_lookup_fields_line1"))
      
prechanges_postcode_lookup_fields_line2.Text = MyContent.PageContent.MakeStr(Row.Item("postcode_lookup_fields_line2"))
input_postcode_lookup_fields_line2.Text = MyContent.PageContent.MakeStr(Row.Item("postcode_lookup_fields_line2"))
      
prechanges_postcode_lookup_fields_line3.Text = MyContent.PageContent.MakeStr(Row.Item("postcode_lookup_fields_line3"))
input_postcode_lookup_fields_line3.Text = MyContent.PageContent.MakeStr(Row.Item("postcode_lookup_fields_line3"))
      
prechanges_postcode_lookup_fields_town.Text = MyContent.PageContent.MakeStr(Row.Item("postcode_lookup_fields_town"))
input_postcode_lookup_fields_town.Text = MyContent.PageContent.MakeStr(Row.Item("postcode_lookup_fields_town"))
      
prechanges_postcode_lookup_fields_county.Text = MyContent.PageContent.MakeStr(Row.Item("postcode_lookup_fields_county"))
input_postcode_lookup_fields_county.Text = MyContent.PageContent.MakeStr(Row.Item("postcode_lookup_fields_county"))
           Row = Nothing
           dt = Nothing
		else
      
PrimaryKeyValue=0
      
      
input_postcode_lookup_fields_postcode.Text =  ""
      
input_postcode_lookup_fields_company_name.Text =  ""
      
input_postcode_lookup_fields_line1.Text =  ""
      
input_postcode_lookup_fields_line2.Text =  ""
      
input_postcode_lookup_fields_line3.Text =  ""
      
input_postcode_lookup_fields_town.Text =  ""
      
input_postcode_lookup_fields_county.Text =  ""
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
' Add/Update info for field postcode_lookup_id

' Add/Update info for field postcode_lookup_section_id
 strPageAddNewFields &= "postcode_lookup_section_id,"

 strPageAddNewValues &= MyContent.PageContent.MakeInt(input_postcode_lookup_section_id.SelectedValue) & ","

 strPageUpdateString &= "postcode_lookup_section_id=" & MyContent.PageContent.MakeInt(input_postcode_lookup_section_id.SelectedValue) & ","

' Add/Update info for field postcode_lookup_fields_postcode
 strPageAddNewFields &= "postcode_lookup_fields_postcode,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_postcode_lookup_fields_postcode.Text)) & "',"

 strPageUpdateString &=  "postcode_lookup_fields_postcode='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_postcode_lookup_fields_postcode.Text)) & "',"

' Add/Update info for field postcode_lookup_fields_company_name
 strPageAddNewFields &= "postcode_lookup_fields_company_name,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_postcode_lookup_fields_company_name.Text)) & "',"

 strPageUpdateString &=  "postcode_lookup_fields_company_name='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_postcode_lookup_fields_company_name.Text)) & "',"

' Add/Update info for field postcode_lookup_fields_line1
 strPageAddNewFields &= "postcode_lookup_fields_line1,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_postcode_lookup_fields_line1.Text)) & "',"

 strPageUpdateString &=  "postcode_lookup_fields_line1='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_postcode_lookup_fields_line1.Text)) & "',"

' Add/Update info for field postcode_lookup_fields_line2
 strPageAddNewFields &= "postcode_lookup_fields_line2,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_postcode_lookup_fields_line2.Text)) & "',"

 strPageUpdateString &=  "postcode_lookup_fields_line2='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_postcode_lookup_fields_line2.Text)) & "',"

' Add/Update info for field postcode_lookup_fields_line3
 strPageAddNewFields &= "postcode_lookup_fields_line3,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_postcode_lookup_fields_line3.Text)) & "',"

 strPageUpdateString &=  "postcode_lookup_fields_line3='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_postcode_lookup_fields_line3.Text)) & "',"

' Add/Update info for field postcode_lookup_fields_town
 strPageAddNewFields &= "postcode_lookup_fields_town,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_postcode_lookup_fields_town.Text)) & "',"

 strPageUpdateString &=  "postcode_lookup_fields_town='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_postcode_lookup_fields_town.Text)) & "',"

' Add/Update info for field postcode_lookup_fields_county
 strPageAddNewFields &= "postcode_lookup_fields_county,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_postcode_lookup_fields_county.Text)) & "',"

 strPageUpdateString &=  "postcode_lookup_fields_county='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_postcode_lookup_fields_county.Text)) & "',"

	strPageAddNewFields = left(strPageAddNewFields, len(strPageAddNewFields )-1)
	strPageAddNewValues = left(strPageAddNewValues, len(strPageAddNewValues )-1)
   strPageAddNewString = "INSERT INTO zz_admin_postcode_lookups (" & strPageAddNewFields & ") values (" & strPageAddNewValues & ");"
	strPageUpdateString = "UPDATE zz_admin_postcode_lookups SET " &  left(strPageUpdateString, len(strPageUpdateString )-1) & " WHERE  postcode_lookup_id='" & PageContent.addSlashes(PrimaryKeyValue) & "'" & ";"    
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
