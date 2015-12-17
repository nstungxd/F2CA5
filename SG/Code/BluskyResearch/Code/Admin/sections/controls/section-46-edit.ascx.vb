Imports PingCore.MyContent
Imports System.Data
Imports PingCore.MyData
Imports PingCore
Imports Telerik.Web.UI
Partial Class AdminSection46Edit
Inherits PingCore.Controls.AdminSectionEditControl
Private Const SectionID as integer = 46

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

AddHandler me.DD_RebindAll, AddressOf input_ddt_dropdownid.RebindHandler
AddHandler Me.DD_RebindAll, AddressOf input_ddt_dropdownid_AddEdit.TriggerRebindAll

if not TheMaster.TheIdentityControl.HasSectionAccess(46) then
input_ddt_dropdownid.DisableAddNew = true
end if






With TheManager.AjaxSettings

End With



if not TheMaster.TheIdentityControl.HasSectionAccess(46) then
input_ddt_dropdownid.DisableAddNew = true
end if


  End Sub

Friend Event DD_RebindAll as EventHandler
Public Sub TriggerRebindAll(sender as object, e as eventargs)
  RaiseEvent DD_RebindAll(Me, EventArgs.Empty)
End Sub


  Public Event RelationshipEvent as EventHandler(of AdminUtility.RelationshipEventArgs)
  Public Event CustomLinkEvent as EventHandler(of AdminUtility.CustomLinkEventArgs)
Public Event popevent_input_ddt_dropdownid As EventHandler
Protected Sub input_ddt_dropdownid_Init(sender as object, e as eventargs) handles input_ddt_dropdownid.Init
  dim c as MyControls.DependentDropdown.IDDLevel = CType(sender, MyControls.DependentDropdown.IDDLevel)
  c.Info = New MyControls.DependentDropdown.DDLevelTable(17, "All Dropdowns", MyControls.DependentDropdown.IDDLevelInfo.TypeEnum.Table, 7, "select DropDownID as value, DropDownName as text from zz_admin_Dropdowns  order by DropDownName", "DropDownName", "DropDownID", 0, 0, "", "", "")
  c.NullText = ""
  End Sub

Sub input_ddt_dropdownid_DoneEditing(ByVal intNewRecordID AS Integer) Handles input_ddt_dropdownid_AddEdit.DoneEditing
  '# set selected value, rebind dependent dropdown
  with input_ddt_dropdownid
    .SelectedValue = intNewRecordID
    TriggerRebindAll(Me, EventArgs.Empty)
  end with

  input_ddt_dropdownid_AddEdit.Visible = false
  pnl_Edit.Visible = true
End Sub

Sub input_ddt_dropdownid_QuitEditing() Handles input_ddt_dropdownid_AddEdit.QuitEditing
  '# nothing changed, so show the edit panel
  input_ddt_dropdownid_AddEdit.Visible = false
  pnl_Edit.Visible = true
End Sub

Sub input_ddt_dropdownid_AddingNew(byval sender as object, ByVal e as MyControls.DependentDropdown.AddNewEventArgs) Handles input_ddt_dropdownid.AddNew
  '# nothing changed, so show the edit panel
  With input_ddt_dropdownid_AddEdit
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

Protected Sub input_ddt_dropdownid_ValidateReq(sender as object, e as ServerValidateEventArgs)
  if string.isnullorempty(input_ddt_dropdownid.Text) then
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
  case 17
    strDropDownFieldName = "ddt_dropdownid"

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
 if intRecordID = 0 then: edittitle.Text = "Adding New Translation" : end if
		SubmitBtn1.Visible = true
		SubmitBtn2.Visible = true
       MyContent.PageContent.FocusFirstControl(pnl_edit)
		if intRecordID <>  0 then
			PrimaryKeyValue =intRecordID
			Dim strSQL As String = "SELECT * FROM zz_admin_dropdown_translations  WHERE  ddt_id='" & PageContent.addSlashes(PrimaryKeyValue) & "'"
			Dim dt As DataTable = MyData.DBFactory.DB.GetDataTable(strSQL)
           Dim Row As DataRow = dt.Rows(0)
      
      
With "ddt_dropdownid"
  dim s as string = Row.Item("ddt_dropdownid").ToString()
  if s isnot nothing then
    prechanges_ddt_dropdownid.Text = s
    input_ddt_dropdownid.SelectedValue = s
  end if
end with

      
prechanges_ddt_name.Text = MyContent.PageContent.MakeStr(Row.Item("ddt_name"))
input_ddt_name.Text = MyContent.PageContent.MakeStr(Row.Item("ddt_name"))
      
prechanges_ddt_query.Text = MyContent.PageContent.MakeStr(Row.Item("ddt_query"))
input_ddt_query.Text = MyContent.PageContent.MakeStr(Row.Item("ddt_query"))
           Row = Nothing
           dt = Nothing
		else
      
PrimaryKeyValue=0
      
      
input_ddt_name.Text =  ""
      
input_ddt_query.Text =  ""
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
' Add/Update info for field ddt_id

' Add/Update info for field ddt_dropdownid
 strPageAddNewFields &= "ddt_dropdownid,"

 strPageAddNewValues &= MyContent.PageContent.MakeInt(input_ddt_dropdownid.SelectedValue) & ","

 strPageUpdateString &= "ddt_dropdownid=" & MyContent.PageContent.MakeInt(input_ddt_dropdownid.SelectedValue) & ","

' Add/Update info for field ddt_name
 strPageAddNewFields &= "ddt_name,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_ddt_name.Text)) & "',"

 strPageUpdateString &=  "ddt_name='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_ddt_name.Text)) & "',"

' Add/Update info for field ddt_query
 strPageAddNewFields &= "ddt_query,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_ddt_query.Text)) & "',"

 strPageUpdateString &=  "ddt_query='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_ddt_query.Text)) & "',"

	strPageAddNewFields = left(strPageAddNewFields, len(strPageAddNewFields )-1)
	strPageAddNewValues = left(strPageAddNewValues, len(strPageAddNewValues )-1)
   strPageAddNewString = "INSERT INTO zz_admin_dropdown_translations (" & strPageAddNewFields & ") values (" & strPageAddNewValues & ");"
	strPageUpdateString = "UPDATE zz_admin_dropdown_translations SET " &  left(strPageUpdateString, len(strPageUpdateString )-1) & " WHERE  ddt_id='" & PageContent.addSlashes(PrimaryKeyValue) & "'" & ";"    
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
