Imports PingCore.MyContent
Imports System.Data
Imports PingCore.MyData
Imports PingCore
Imports Telerik.Web.UI
Imports PingLibrary
Imports PingSurveys

Partial Class AdminSection6Edit
    Inherits PingCore.Controls.AdminSectionEditControl
    Private Const SectionID As Integer = 6

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
            Return PageContent.MakeInt(ViewState("PrimaryKeyValue"))
        End Get
        Set(ByVal value As Integer)
            ViewState("PrimaryKeyValue") = value
        End Set
    End Property
#End Region

    Dim m_EditandSendBack As Boolean

    Sub Page_Init(sender As Object, e As EventArgs) Handles Me.Init

        If Not TheMaster.TheIdentityControl.HasSectionAccess(SectionID) Then
            TheMaster.TheIdentityControl.LogoutWithAbort()
            Response.End()
        End If

        AddHandler Me.DD_RebindAll, AddressOf input_user_type_fk.RebindHandler





        With TheManager.AjaxSettings

        End With



        If Not TheMaster.TheIdentityControl.HasSectionAccess(6) Then
            input_user_type_fk.DisableAddNew = True
        End If


    End Sub

    Friend Event DD_RebindAll As EventHandler
    Public Sub TriggerRebindAll(sender As Object, e As EventArgs)
        RaiseEvent DD_RebindAll(Me, EventArgs.Empty)
    End Sub


    Public Event RelationshipEvent As EventHandler(Of AdminUtility.RelationshipEventArgs)
    Public Event CustomLinkEvent As EventHandler(Of AdminUtility.CustomLinkEventArgs)
    Public Event popevent_input_user_type_fk As EventHandler
    Protected Sub input_user_type_fk_Init(sender As Object, e As EventArgs) Handles input_user_type_fk.Init
        Dim c As MyControls.DependentDropdown.IDDLevel = CType(sender, MyControls.DependentDropdown.IDDLevel)
        c.Info = New MyControls.DependentDropdown.DDLevelTable(62, "Site UsersTypes", MyControls.DependentDropdown.IDDLevelInfo.TypeEnum.Table, 0, "select utype_id as value, utype_name as text from tbl_usertypes WHERE utype_id IN (2,3)  order by utype_name", "utype_name", "utype_id", 0, 0, "", "", "")
        c.NullText = ""
        c.DisableAddNew = True
    End Sub





    Sub Page_Load(sender As Object, e As EventArgs) Handles Me.Load
    End Sub
    Sub DisableField(ByVal fieldname As String)
        MyContent.PageContent.FindControlandDisable(pnl_Edit, fieldname)
    End Sub
    Sub SetFieldandDisable(ByVal fieldname As String, ByVal value As String)
        MyContent.PageContent.FindControlSetandDisable(pnl_Edit, fieldname, value)
    End Sub
    Sub SetControlByName(ByVal controlname As String, ByVal value As String)
        MyContent.PageContent.FindControlSetandDisable(pnl_Edit, controlname, value)
    End Sub
    Sub SetDropDownbyTranslation(ByVal DropDownID As Integer, ByVal translationfieldname As String, ByVal value As String)
        Dim strDropDownFieldName As String = Nothing
        Select Case DropDownID
            Case 62
                strDropDownFieldName = "user_type_fk"

            Case Else
TranslationError: Throw (New Exception(String.Format("Translation Error: Missing dropdown {0}", DropDownID)))
        End Select
        MyContent.PageContent.FindControlSetandDisable(pnl_Edit, strDropDownFieldName, value)
    End Sub
    Protected Overrides Sub OnLoadComplete(ByVal e As EventArgs)
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
    Public Sub EditView(ByVal intRecordID As Integer)
        edittitle.Text = "Editing"
        SubmitBtn1.Visible = True
        SubmitBtn2.Visible = True
        MyContent.PageContent.FocusFirstControl(pnl_Edit)
        If intRecordID <> 0 Then
            PrimaryKeyValue = intRecordID
            Dim strSQL As String = "SELECT * FROM users  WHERE  user_id='" & PageContent.addSlashes(PrimaryKeyValue) & "'"
            Dim dt As DataTable = MyData.DBFactory.DB.GetDataTable(strSQL)
            Dim Row As DataRow = dt.Rows(0)


            With "user_type_fk"
                Dim s As String = Row.Item("user_type_fk").ToString()
                If s IsNot Nothing Then
                    prechanges_user_type_fk.Text = s
                    input_user_type_fk.SelectedValue = s
                End If
            End With



            prechanges_user_firstname.Text = MyContent.PageContent.MakeStr(Row.Item("user_firstname"))
            input_user_firstname.Text = MyContent.PageContent.MakeStr(Row.Item("user_firstname"))

            prechanges_user_surname.Text = MyContent.PageContent.MakeStr(Row.Item("user_surname"))
            input_user_surname.Text = MyContent.PageContent.MakeStr(Row.Item("user_surname"))


            prechanges_user_email.Text = MyContent.PageContent.MakeStr(Row.Item("user_email"))
            input_user_email.Text = MyContent.PageContent.MakeStr(Row.Item("user_email"))
















            prechanges_user_allsurveys.Text = MyContent.PageContent.dbBool(Row.Item("user_allsurveys"))
            input_user_allsurveys.Checked = MyContent.PageContent.dbBool(Row.Item("user_allsurveys"))
            LoadSurveyList()
            Row = Nothing
            dt = Nothing
        Else

            PrimaryKeyValue = 0



            input_user_firstname.Text = ""

            input_user_surname.Text = ""


            input_user_email.Text = ""
















            input_user_allsurveys.Checked = False
        End If
        page1.Visible = True
        currpage.Text = 1
        PrevBtn1.Visible = False
        PrevBtn2.Visible = False
    End Sub
    Public Event DoneEditing(ByVal RecordID As Integer)
    Public Event QuitEditing()
    Sub BackLink(ByVal sender As Object, ByVal e As System.EventArgs) Handles AbandonBtn1.Click, AbandonBtn2.Click
        RaiseEvent QuitEditing()
    End Sub
    Sub ShowFile(sender As Object, e As EventArgs)
        Dim b As LinkButton = CType(sender, LinkButton)
        If b.CommandArgument.EndsWith(".") Then
            Throw New PreconditionException("Bad Upload in StreamUploadFile")
        End If
        MyContent.PageContent.StreamUploadFile(b.CommandArgument, Context)
    End Sub

    Sub SubmitBtn_Click(sender As Object, E As EventArgs)
        If Page.IsValid Then
            Dim strPageUpdateString As String = ""
            Dim strPageAddNewFields As String = ""
            Dim strPageAddNewValues As String = ""
            Dim strPageAddNewString As String = ""
            ' Add/Update info for field user_id

            ' Add/Update info for field user_type_fk
            strPageAddNewFields &= "user_type_fk,"

            strPageAddNewValues &= MyContent.PageContent.MakeInt(input_user_type_fk.SelectedValue) & ","

            strPageUpdateString &= "user_type_fk=" & MyContent.PageContent.MakeInt(input_user_type_fk.SelectedValue) & ","

            ' Add/Update info for field user_title

            ' Add/Update info for field user_firstname
            strPageAddNewFields &= "user_firstname,"
            strPageAddNewValues &= "'" & MyContent.PageContent.addSlashes(MyContent.PageContent.MakeStr(input_user_firstname.Text)) & "',"

            strPageUpdateString &= "user_firstname='" & MyContent.PageContent.addSlashes(MyContent.PageContent.MakeStr(input_user_firstname.Text)) & "',"

            ' Add/Update info for field user_surname
            strPageAddNewFields &= "user_surname,"
            strPageAddNewValues &= "'" & MyContent.PageContent.addSlashes(MyContent.PageContent.MakeStr(input_user_surname.Text)) & "',"

            strPageUpdateString &= "user_surname='" & MyContent.PageContent.addSlashes(MyContent.PageContent.MakeStr(input_user_surname.Text)) & "',"

            ' Add/Update info for field user_screen_name

            ' Add/Update info for field user_email
            strPageAddNewFields &= "user_email,"
            strPageAddNewValues &= "'" & MyContent.PageContent.addSlashes(MyContent.PageContent.MakeStr(input_user_email.Text)) & "',"

            strPageUpdateString &= "user_email='" & MyContent.PageContent.addSlashes(MyContent.PageContent.MakeStr(input_user_email.Text)) & "',"

            ' Add/Update info for field user_country_id

            ' Add/Update info for field user_password_hash

            ' Add/Update info for field user_password_salt

            ' Add/Update info for field user_temporary_hash

            ' Add/Update info for field user_temporary_salt

            ' Add/Update info for field user_phone1

            ' Add/Update info for field user_phone2

            ' Add/Update info for field user_twitter

            ' Add/Update info for field user_impersonating

            ' Add/Update info for field user_notes

            ' Add/Update info for field user_dob

            ' Add/Update info for field user_receivenewsletter

            ' Add/Update info for field user_giftaid

            ' Add/Update info for field user_last_login

            ' Add/Update info for field user_login_amount

            ' Add/Update info for field user_allsurveys
            strPageAddNewFields &= "user_allsurveys,"
            strPageAddNewValues &= MyContent.PageContent.dbBool(input_user_allsurveys.Checked) & ","


            strPageUpdateString &= "user_allsurveys=" & MyContent.PageContent.dbBool(input_user_allsurveys.Checked) & ","

            strPageAddNewFields = Left(strPageAddNewFields, Len(strPageAddNewFields) - 1)
            strPageAddNewValues = Left(strPageAddNewValues, Len(strPageAddNewValues) - 1)
            strPageAddNewString = "INSERT INTO users (" & strPageAddNewFields & ") values (" & strPageAddNewValues & ");"
            strPageUpdateString = "UPDATE users SET " & Left(strPageUpdateString, Len(strPageUpdateString) - 1) & " WHERE  user_id='" & PageContent.addSlashes(PrimaryKeyValue) & "'" & ";"
            Dim strSQL3 As String
            Dim IsNewRecord As Boolean = False
            If Not PrimaryKeyValue > 0 Then
                strSQL3 = strPageAddNewString
                PrimaryKeyValue = DBFactory.DB.GetDataField(Of Integer)(strSQL3 & "SELECT SCOPE_IDENTITY() AS NewID; ")
                IsNewRecord = True
            Else
                strSQL3 = strPageUpdateString
                DBFactory.DB.RunSQL(strSQL3)
            End If

            '#After Save 
            If Not IsNewRecord Then

                '#After Update Functions 
                SaveSurveyList()
            Else

                '#After Add New Functions 
                SaveSurveyList()
                Response.Redirect(PageContent.AppendGetParam("../custom_sendtemporarypassword.aspx", "key", PrimaryKeyValue))

            End If
            RaiseEvent DoneEditing(PrimaryKeyValue)
        End If
    End Sub
    Sub PrevBtn_Click(sender As Object, e As EventArgs)
        If Page.IsValid Then
            If Not currpage.Text = 1 Then
                Select Case currpage.Text
                End Select
                NextBtn1.Visible = True
                NextBtn2.Visible = True
            End If
        End If
    End Sub
    Sub NextBtn_Click(sender As Object, e As EventArgs)
        If Page.IsValid Then
            If Not currpage.Text >= maxpage.Text Then
                Select Case currpage.Text
                End Select
                PrevBtn1.Visible = True
                PrevBtn2.Visible = True
            End If
        End If
    End Sub

#Region "Surveys"
    Protected Sub LoadSurveyList()

        '# Get list of all surveys
        Dim SurveysList As List(Of SurveyLibrary.Survey) = (From dr In SurveyAccess.GetAllSurveys() Order By dr.Title Select dr).ToList()

        '# Bind to list
        With chkSurveyList
            .DataSource = SurveysList
            .DataValueField = "ID"
            .DataTextField = "Title"
            .DataBind()
        End With

        '# Set items
        For Each item As ListItem In chkSurveyList.Items
            item.Selected = False
        Next

        Dim UserSurveysList As DataTable = DataAccess.GetAllUserSurveys(PrimaryKeyValue)
        If UserSurveysList IsNot Nothing AndAlso UserSurveysList.Rows.Count() > 0 Then
            For Each dr As DataRow In UserSurveysList.Rows
                For Each item As ListItem In chkSurveyList.Items
                    If item.Value = DataFunctions.GetColumnFromDataRow(dr, "SurveyID") Then item.Selected = True
                Next
            Next
        End If

    End Sub

    Protected Sub SaveSurveyList()

        '# Database connection
        Dim dbc As PingLibrary.SqlDatabaseConnection = Data.DBConnection()

        '# check if there are any which are no longer selected!
        Dim MySelectedRelations As DataTable = DataAccess.GetAllUserSurveys(PrimaryKeyValue, dbc)

        For Each MyRow As DataRow In MySelectedRelations.Rows()
            Dim ItemFoundOnPage As Boolean = False
            Dim ItemSelectedOnPage As Boolean = False
            Dim SurveyID As Integer = DataFunctions.GetColumnFromDataRow(Of Integer)(MyRow, "SurveyID")

            For Each item As ListItem In chkSurveyList.Items
                If item.Value = SurveyID.ToString() Then
                    ItemFoundOnPage = True
                    If item.Selected Then ItemSelectedOnPage = True
                End If
            Next

            '# remove any unavailable options from the DB (clean up)
            '# or any record which are no-longer selected
            If Not (ItemFoundOnPage And ItemSelectedOnPage) Then
                DataLogic.DeleteUserSurvey(SurveyID, PrimaryKeyValue, dbc)
            End If
        Next

        '# ok, now add any new ones!
        For Each item As ListItem In chkSurveyList.Items
            If item.Selected Then
                Dim ItemInDB As Boolean = False
                For Each MyRow As DataRow In MySelectedRelations.Rows()
                    Dim SurveyID As Integer = DataFunctions.GetColumnFromDataRow(Of Integer)(MyRow, "SurveyID")
                    If item.Value = SurveyID.ToString Then ItemInDB = True
                Next

                '# Insert any options which aren't already there!
                If Not (ItemInDB) Then
                    DataLogic.AddUserSurvey(item.Value, PrimaryKeyValue, item.Text, dbc)
                End If
            End If
        Next

    End Sub
#End Region

End Class
