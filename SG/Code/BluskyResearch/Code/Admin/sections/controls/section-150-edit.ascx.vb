Imports PingCore.MyContent
Imports System.Data
Imports PingCore.MyData
Imports PingCore
Imports Telerik.Web.UI
Partial Class AdminSection150Edit
Inherits PingCore.Controls.AdminSectionEditControl
Private Const SectionID as integer = 150

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
			Dim strSQL As String = "SELECT * FROM Surveys  WHERE  SurveyID='" & PageContent.addSlashes(PrimaryKeyValue) & "'"
			Dim dt As DataTable = MyData.DBFactory.DB.GetDataTable(strSQL)
           Dim Row As DataRow = dt.Rows(0)
      
      
input_SurveyNumber.Text = MyContent.PageContent.MakeInt(Row.Item("SurveyNumber"))
prechanges_SurveyNumber.Text = MyContent.PageContent.MakeInt(Row.Item("SurveyNumber"))
      
prechanges_Name.Text = MyContent.PageContent.MakeStr(Row.Item("Name"))
input_Name.Text = MyContent.PageContent.MakeStr(Row.Item("Name"))
      
prechanges_Status.Text = MyContent.PageContent.MakeStr(Row.Item("Status"))
input_Status.Text = MyContent.PageContent.MakeStr(Row.Item("Status"))
      
      
      
prechanges_ViewDetails.Text =  MyContent.PageContent.dbBool(Row.Item("ViewDetails"))
input_ViewDetails.checked =  MyContent.PageContent.dbBool(Row.Item("ViewDetails"))
      
prechanges_QuestionsToHide.Text = MyContent.PageContent.MakeStr(Row.Item("QuestionsToHide"))
input_QuestionsToHide.Text = MyContent.PageContent.MakeStr(Row.Item("QuestionsToHide"))
      
input_MinimumResponsesAllowed.Text = MyContent.PageContent.MakeInt(Row.Item("MinimumResponsesAllowed"))
prechanges_MinimumResponsesAllowed.Text = MyContent.PageContent.MakeInt(Row.Item("MinimumResponsesAllowed"))
      
           Row = Nothing
           dt = Nothing
		else
      
PrimaryKeyValue=0
      
input_SurveyNumber.Text = ""
prechanges_SurveyNumber.Text = ""
      
input_Name.Text =  ""
      
input_Status.Text =  ""
      
      
      
input_ViewDetails.checked =  false
      
input_QuestionsToHide.Text =  ""
      
input_MinimumResponsesAllowed.Text = "0"
prechanges_MinimumResponsesAllowed.Text = "0"
      
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
' Add/Update info for field SurveyID

' Add/Update info for field SurveyNumber

' Add/Update info for field Name

' Add/Update info for field Status

' Add/Update info for field CreatedOn

' Add/Update info for field ModifiedOn

' Add/Update info for field ViewDetails
 strPageAddNewFields &=  "ViewDetails,"
 strPageAddNewValues &=   MyContent.PageContent.dbBool(input_ViewDetails.checked) & ","


 strPageUpdateString &= "ViewDetails=" &  MyContent.PageContent.dbBool(input_ViewDetails.checked) & ","

' Add/Update info for field QuestionsToHide
 strPageAddNewFields &= "QuestionsToHide,"
 strPageAddNewValues &= "'" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_QuestionsToHide.Text)) & "',"

 strPageUpdateString &=  "QuestionsToHide='" &  MyContent.PageContent.addSlashes(MyContent.PageContent.makeStr(input_QuestionsToHide.Text)) & "',"

' Add/Update info for field MinimumResponsesAllowed
strPageAddNewFields &= "MinimumResponsesAllowed,"
strPageAddNewValues &= MyContent.PageContent.MakeInt(input_MinimumResponsesAllowed.Text) & ","

strPageUpdateString &= "MinimumResponsesAllowed=" & MyContent.PageContent.MakeInt(input_MinimumResponsesAllowed.Text) & ","


' Add/Update info for field Deleted

	strPageAddNewFields = left(strPageAddNewFields, len(strPageAddNewFields )-1)
	strPageAddNewValues = left(strPageAddNewValues, len(strPageAddNewValues )-1)
   strPageAddNewString = "INSERT INTO Surveys (" & strPageAddNewFields & ") values (" & strPageAddNewValues & ");"
	strPageUpdateString = "UPDATE Surveys SET " &  left(strPageUpdateString, len(strPageUpdateString )-1) & " WHERE  SurveyID='" & PageContent.addSlashes(PrimaryKeyValue) & "'" & ";"    
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
