Imports PingCore.MyContent
Imports System.Data
Imports PingCore.MyData
Imports PingCore
Imports Telerik.Web.UI
Partial Class AdminSection144Edit
Inherits PingCore.Controls.AdminSectionEditControl
Private Const SectionID as integer = 144

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


With TheManager.AjaxSettings

End With




  End Sub

Friend Event DD_RebindAll as EventHandler
Public Sub TriggerRebindAll(sender as object, e as eventargs)
  RaiseEvent DD_RebindAll(Me, EventArgs.Empty)
End Sub


  Public Event RelationshipEvent as EventHandler(of AdminUtility.RelationshipEventArgs)
  Public Event CustomLinkEvent as EventHandler(of AdminUtility.CustomLinkEventArgs)
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
		SubmitBtn1.Visible = true
		SubmitBtn2.Visible = true
       MyContent.PageContent.FocusFirstControl(pnl_edit)
		if intRecordID <>  0 then
			PrimaryKeyValue =intRecordID
			Dim strSQL As String = "SELECT * FROM EmailCopy  WHERE  EmailCopyID='" & PageContent.addSlashes(PrimaryKeyValue) & "'"
			Dim dt As DataTable = MyData.DBFactory.DB.GetDataTable(strSQL)
           Dim Row As DataRow = dt.Rows(0)
      
      
prechanges_Name.Text = MyContent.PageContent.MakeStr(Row.Item("Name"))
input_Name.Text = MyContent.PageContent.MakeStr(Row.Item("Name"))
      
prechanges_Subject.Text = MyContent.PageContent.MakeStr(Row.Item("Subject"))
input_Subject.Text = MyContent.PageContent.MakeStr(Row.Item("Subject"))
      
prechanges_BodyCopy.Text = MyContent.PageContent.MakeStr(Row.Item("BodyCopy"))
input_BodyCopy.Value = MyContent.PageContent.MakeStr(Row.Item("BodyCopy"))
      
prechanges_FooterCopy.Text = MyContent.PageContent.MakeStr(Row.Item("FooterCopy"))
input_FooterCopy.Value = MyContent.PageContent.MakeStr(Row.Item("FooterCopy"))
      
prechanges_SenderAddress.Text = MyContent.PageContent.MakeStr(Row.Item("SenderAddress"))
input_SenderAddress.Text = MyContent.PageContent.MakeStr(Row.Item("SenderAddress"))
      
prechanges_Recipients.Text = MyContent.PageContent.MakeStr(Row.Item("Recipients"))
input_Recipients.Text = MyContent.PageContent.MakeStr(Row.Item("Recipients"))
      
           Row = Nothing
           dt = Nothing
		else
      
PrimaryKeyValue=0
      
input_Name.Text =  ""
      
input_Subject.Text =  ""
      
input_BodyCopy.Value =  ""
      
input_FooterCopy.Value =  ""
      
input_SenderAddress.Text =  ""
      
input_Recipients.Text =  ""
      
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
' Add/Update info for field EmailCopyID

' Add/Update info for field Name

' Add/Update info for field Subject
 strPageAddNewFields &= "Subject,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_Subject.Text)) & "',"

 strPageUpdateString &=  "Subject='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_Subject.Text)) & "',"

' Add/Update info for field BodyCopy
 strPageAddNewFields &= "BodyCopy,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_BodyCopy.Value)) & "',"

 strPageUpdateString &=  "BodyCopy='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_BodyCopy.Value)) & "',"

' Add/Update info for field FooterCopy
 strPageAddNewFields &= "FooterCopy,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_FooterCopy.Value)) & "',"

 strPageUpdateString &=  "FooterCopy='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_FooterCopy.Value)) & "',"

' Add/Update info for field SenderAddress
 strPageAddNewFields &= "SenderAddress,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_SenderAddress.Text)) & "',"

 strPageUpdateString &=  "SenderAddress='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_SenderAddress.Text)) & "',"

' Add/Update info for field Recipients
 strPageAddNewFields &= "Recipients,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_Recipients.Text)) & "',"

 strPageUpdateString &=  "Recipients='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_Recipients.Text)) & "',"

' Add/Update info for field Active

	strPageAddNewFields = left(strPageAddNewFields, len(strPageAddNewFields )-1)
	strPageAddNewValues = left(strPageAddNewValues, len(strPageAddNewValues )-1)
   strPageAddNewString = "INSERT INTO EmailCopy (" & strPageAddNewFields & ") values (" & strPageAddNewValues & ");"
	strPageUpdateString = "UPDATE EmailCopy SET " &  left(strPageUpdateString, len(strPageUpdateString )-1) & " WHERE  EmailCopyID='" & PageContent.addSlashes(PrimaryKeyValue) & "'" & ";"    
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
