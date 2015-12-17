Imports System.Data
Imports PingLibrary
Imports PingCore.MySystem
Imports PingSurveys
Imports PingSurveys.SurveyLibrary
Imports System.IO
Imports PingUtilities
Imports iTextSharp.text.pdf
Imports PingUtilities.PDFBuilder

Partial Class Surveys_Default
    Inherits System.Web.UI.Page

#Region "LocalSiteInterface"
    Private _LocalSiteInterface As New Memo(Of LocalSiteInterface)(AddressOf GetLocalSiteInterface)
    ReadOnly Property LocalSiteInterface() As LocalSiteInterface
        Get
            Return _LocalSiteInterface.Value
        End Get
    End Property

    Function GetLocalSiteInterface() As LocalSiteInterface
        Return CType(Me.Page.Master, LocalSiteInterface)
    End Function
#End Region

#Region "SurveyID"
    Protected ReadOnly Property SurveyID() As Integer
        Get
            Return LocalSiteInterface.CurrentSurveyControl.SurveyID
        End Get
    End Property
#End Region

#Region "CurrentSurvey"
    Protected ReadOnly Property CurrentSurvey() As Survey
        Get
            Return LocalSiteInterface.CurrentSurveyControl.CurrentSurvey
        End Get
    End Property
#End Region

    '#Region "UnfilteredSurvey"
    '    Protected ReadOnly Property UnfilteredSurvey() As Survey
    '        Get
    '            Return LocalSiteInterface.CurrentSurveyControl.UnfilteredSurvey
    '        End Get
    '    End Property
    '#End Region

    Protected Sub Page_Init(ByVal sender As Object, ByVal e As System.EventArgs) Handles Me.Init
        CheckLoggedIn()
    End Sub

    Protected Sub Page_Load(ByVal sender As Object, ByVal e As System.EventArgs) Handles Me.Load
        If Not IsPostBack Then
            '# Set default view
            SetSurveyDetailsView(NotLoadedView)

            '# Load Surveys
            LoadSurveys()

            LoadPage()
        End If
    End Sub

#Region "Check User Logged In"
    Protected Sub CheckLoggedIn()
        Dim LoggedIn As Boolean = GlobalMethods.UserLoggedIn(LocalSiteInterface.IdentityControl)

        If Not LoggedIn Then
            Response.Redirect("/login.aspx")
        End If
    End Sub
#End Region

#Region "Load Data"
    Protected Sub LoadPage()

        '# Filtering
        SetFilteringDetails()

        '# Load current survey if we have one
        If SurveyID > 0 Then
            LoadSurveyDetails()
        End If

    End Sub
#End Region

#Region "Surveys"
    Protected Sub LoadSurveys()

        Try

            Dim UserID As Integer = LocalSiteInterface.IdentityControl.Identity.ID
            Dim CanViewAllSurveys As Boolean = LocalSiteInterface.IdentityControl.Identity.CanViewAll

            '# Bind list of surveys - checking if the user can view all or a filtered list
            If CanViewAllSurveys Then

                Dim SurveyList As List(Of Survey) = SurveyAccess.GetAllSurveys()

                '# Order by name
                Dim OrderedSurveyList = (From dr In SurveyList Order By dr.Title Select dr).ToList()

                If SurveyList IsNot Nothing AndAlso SurveyList.Count > 0 Then
                    With ddlSurveys
                        .DataSource = OrderedSurveyList
                        .DataValueField = "ID"
                        .DataTextField = "Title"
                        .DataBind()
                    End With
                End If

            Else

                Dim SurveyList As DataTable = DataAccess.GetAllUserSurveys(UserID)

                If SurveyList IsNot Nothing AndAlso SurveyList.Rows.Count > 0 Then
                    With ddlSurveys
                        .DataSource = SurveyList
                        .DataValueField = "SurveyID"
                        .DataTextField = "SurveyName"
                        .DataBind()
                    End With
                End If

            End If

            '# Set defaults
            With ddlSurveys
                .Items.Insert(0, New ListItem("Please select a survey", "0"))

                Try
                    If SurveyID > 0 Then
                        ddlSurveys.SelectedValue = SurveyID
                    End If
                Catch ex As Exception
                End Try
            End With

        Catch ex As Exception
            With ddlSurveys
                .Items.Insert(0, New ListItem("Please select a survey", "0"))
            End With
        End Try
    End Sub

    Protected Sub btnSelectSurvey_Click(sender As Object, e As EventArgs) Handles btnSelectSurvey.Click
        If Page.IsValid Then
            SelectSurvey()
        End If
    End Sub

    Protected Sub SelectSurvey()
        '# Get ID of selected survey
        Dim SurveyID As Integer = 0
        Int32.TryParse(ddlSurveys.SelectedValue, SurveyID)

        If SurveyID > 0 Then
            '# Set the Survey
            LocalSiteInterface.CurrentSurveyControl.SetSurvey(SurveyID)

            LoadPage() 'LoadSurveyDetails()
        Else
            ShowSelectSurveyFail("* Please select a Survey")
        End If
    End Sub

    Protected Sub ShowSelectSurveyFail(ByVal Msg As String)

        Dim c As New CustomValidator()
        c.IsValid = False
        c.Text = "&nbsp;"
        c.ErrorMessage = "<div class='ss_row'><div class='warning'><p>" & Msg & "</p></div></div>"
        c.Text = "<div class='warning'><p>" & Msg & "</p></div>"
        c.CssClass = "sf_row_faillist"
        c.Style("padding") = "10px 0"
        c.Style("display") = "block"

        phSurveys.Visible = True
        phSurveys.Controls.Add(c)

    End Sub

    Protected Sub ReLoadSurvey()
        '# Filtering
        SetFilteringDetails()

        '# Load current survey if we have one
        SelectSurvey()
    End Sub
#End Region

#Region "Survey Details"
    Protected Sub LoadSurveyDetails()

        If CurrentSurvey IsNot Nothing Then
            With CurrentSurvey

                '# Set view
                SetSurveyDetailsView(LoadedView)

                '# Set header
                If Not String.IsNullOrEmpty(.DecorativeHeaderImage) Then
                    imgHeaderBannerFull.ImageUrl = .DecorativeHeaderImage
                    imgHeaderBannerFull.AlternateText = .Title
                End If

                '# Set details
                litSurveyTitle.Text = .Title
                litCreatedTimeDate.Text = FormatDate(.CreatedOn)
                litModifiedTimeDate.Text = FormatDate(.ModifiedOn)

                '# Status
                Dim StatusClass As String = ""
                Select Case .Status
                    Case "In Design"
                        StatusClass = "blue"
                    Case "Launched"
                        StatusClass = "green"
                    Case "Closed"
                        StatusClass = "red"
                End Select

                litStatus.Text = "<span class='" & StatusClass & "'>" & .Status & "</span>"

                '# Set Totals
                Dim TotalResponses As Integer = 0
                Dim FilteredResponses As Integer = 0
                Dim ExcludedResponses As Integer = 0

                TotalResponses = .AllResponses.Count()

                'If TotalResponses <= 0 Then
                '    For Each stat As KeyValuePair(Of String, String) In UnfilteredSurvey.Statistics
                '        If stat.Value = "Complete" Then
                '            Int32.TryParse(stat.Value, TotalResponses)
                '        End If
                '    Next
                'End If

                '# Check for default
                Dim ResponsesAreFiltered As Boolean = True

                If LocalSiteInterface.CurrentSurveyControl.SurveyFilters.Count = 1 AndAlso LocalSiteInterface.CurrentSurveyControl.SurveyFilters(0).SurveyFilterType = SurveyFilterTypeEnum.Status AndAlso LocalSiteInterface.CurrentSurveyControl.SurveyFilters(0).FilterValue = "Deleted" Then
                    ResponsesAreFiltered = False
                ElseIf LocalSiteInterface.CurrentSurveyControl.SurveyFilters.Count = 2 Then

                    Dim NoDeletedDataPresent As Boolean = False
                    Dim NoTestDataPresent As Boolean = False

                    For Each sf As SurveyFilter In LocalSiteInterface.CurrentSurveyControl.SurveyFilters
                        If sf.SurveyFilterType = SurveyFilterTypeEnum.Status AndAlso sf.FilterValue = "Deleted" Then
                            NoDeletedDataPresent = True
                        End If
                    Next

                    For Each sf As SurveyFilter In LocalSiteInterface.CurrentSurveyControl.SurveyFilters
                        If sf.SurveyFilterType = SurveyFilterTypeEnum.General AndAlso sf.FieldValue = "istestdata" Then
                            NoTestDataPresent = True
                        End If
                    Next

                    If NoDeletedDataPresent AndAlso NoTestDataPresent Then
                        ResponsesAreFiltered = False
                    End If

                End If

                If Not ResponsesAreFiltered Then
                    FilteredResponses = 0
                    ExcludedResponses = 0
                Else
                    FilteredResponses = CurrentSurvey.Responses.Count()
                    ExcludedResponses = TotalResponses - FilteredResponses
                End If

                lblTotalResponses.Text = TotalResponses.ToString()
                lblFilteredResponses.Text = FilteredResponses.ToString()
                lblExcludedResponses.Text = ExcludedResponses.ToString()

                '# Check to see if the amount of responses is greater than the minimum allowed.
                Dim QuestionsList As List(Of SurveyQuestion) = (From dr In CurrentSurvey.Questions Where dr.Type = "SurveyQuestion" Select dr).ToList()
                Dim ResponsesTotalToCheck As Integer = TotalResponses
                If FilteredResponses > 0 Then ResponsesTotalToCheck = FilteredResponses

                If (CurrentSurvey.MinimumResponsesAllowed = 0 OrElse (CurrentSurvey.MinimumResponsesAllowed > 0 AndAlso ResponsesTotalToCheck > CurrentSurvey.MinimumResponsesAllowed)) Then

                    '# Load questions
                    With lvSurveyQuestions
                        .DataSource = QuestionsList
                        .DataBind()
                    End With

                    mvResponseList.ActiveViewIndex = 0

                Else
                    '# Hide results
                    mvResponseList.ActiveViewIndex = 1
                    '# PDF Export to be allowed regardless
                    'lnkPDFExport.Enabled = False
                    'lnkPDFExport.CssClass = "btn_site btn_site_grey"
                    'lnkPDFExport.Style("margin") = "0 0 0 -14px"
                End If

                If Not CurrentSurvey.ViewDetails Then
                    'lnkPDFExport.Enabled = False
                    lnkExport.Enabled = False
                    lnkViewIndividualDetails.Enabled = False

                    'lnkPDFExport.CssClass = "btn_site btn_site_grey"
                    'lnkPDFExport.Style("margin") = "0 0 0 -14px"
                    lnkExport.CssClass = "btn_site btn_site_grey"
                    lnkViewIndividualDetails.CssClass = "btn_site btn_site_grey"
                    lnkViewIndividualDetails.NavigateUrl = "#"

                End If

            End With
        Else
            SetSurveyDetailsView(CantLoadView)
        End If

    End Sub

    Protected Sub SetSurveyDetailsView(RequiredView As View)
        mvSurveyDetails.SetActiveView(RequiredView)
    End Sub

    Protected Sub lvSurveyQuestions_ItemDataBound(sender As Object, e As ListViewItemEventArgs) Handles lvSurveyQuestions.ItemDataBound
        Select Case e.Item.ItemType
            Case ListViewItemType.DataItem

                Dim sq As SurveyQuestion = CType(e.Item.DataItem, SurveyQuestion)
                Dim pmSurveyQuestion As Controls_SurveyQuestionControl = CType(e.Item.FindControl("pmSurveyQuestion"), Controls_SurveyQuestionControl)
                Dim hdnSQ As HiddenField = CType(e.Item.FindControl("hdnSQ"), HiddenField)

                If pmSurveyQuestion IsNot Nothing Then
                    If sq.Type = "SurveyQuestion" Then
                        If hdnSQ IsNot Nothing Then hdnSQ.Value = sq.ID
                        pmSurveyQuestion.CurrentSurveyQuestion = sq
                        pmSurveyQuestion.ItemCount = e.Item.DataItemIndex + 1
                        pmSurveyQuestion.LoadSurveyQuestion()
                    Else
                        pmSurveyQuestion.Visible = False
                    End If
                End If

        End Select
    End Sub

    Sub lvSurveyQuestions_OnFilterClicked(ByVal sender As Object, ByVal e As EventArgs)
        ReLoadSurvey()
    End Sub
#End Region

#Region "Filtering"
    Protected Sub SetFilteringDetails()

        '# Reset textboxes
        txtDateBefore.Text = ""
        txtDateAfter.Text = ""
        txtQuestionFiltersSearch.Text = ""
        li_FilterInfoDateBefore.Visible = False
        li_FilterInfoDateAfter.Visible = False

        Dim CurrentSurveyControl As SurveyControl = LocalSiteInterface.CurrentSurveyControl()
        Dim CustomFiltersPresent As Boolean = False

        If CurrentSurveyControl IsNot Nothing AndAlso CurrentSurveyControl.SurveyFilters IsNot Nothing AndAlso CurrentSurveyControl.SurveyFilters.Count() > 0 Then

            '# Set filter type
            If CurrentSurveyControl.QuestionFilterType = SurveyControl.QuestionFilterTypeEnum.AndFilter Then
                rbAndFilter.Checked = True
            Else
                rbOrFilter.Checked = True
            End If

            For Each sf As SurveyFilter In CurrentSurveyControl.SurveyFilters

                Select Case sf.SurveyFilterType
                    Case SurveyFilterTypeEnum.Status

                        li_FilterInfoStatus.Visible = True

                        Select Case sf.FilterValue
                            Case "Complete"
                                rblSurveyStatus.SelectedValue = "complete"
                                litFilterInfoStatus.Text = "Fully-Completed"
                            Case "Partial"
                                rblSurveyStatus.SelectedValue = "partial"
                                litFilterInfoStatus.Text = "Part-Completed"
                            Case Else
                                rblSurveyStatus.SelectedValue = "both"
                                litFilterInfoStatus.Text = "Fully & Part-Completed"
                        End Select

                    Case SurveyFilterTypeEnum.DateBefore

                        '# Get values
                        Dim DateStr As String = sf.FilterValue.Replace("+", " ")
                        Dim RealDate As New Date

                        '# Check this is a valid date
                        Dim DateOK As Boolean = Date.TryParse(DateStr, RealDate)

                        If DateOK Then

                            txtDateBefore.Text = RealDate.ToString("dd/MM/yyyy HH:mm tt")

                            li_FilterInfoDateBefore.Visible = True
                            litFilterInfoDateBefore.Text = RealDate.ToString("dd/MM/yyyy HH:mm tt")
                        Else
                            txtDateBefore.Text = ""
                            li_FilterInfoDateBefore.Visible = False
                        End If

                    Case SurveyFilterTypeEnum.DateAfter

                        '# Get values
                        Dim DateStr As String = sf.FilterValue.Replace("+", " ")
                        Dim RealDate As New Date

                        '# Check this is a valid date
                        Dim DateOK As Boolean = Date.TryParse(DateStr, RealDate)

                        If DateOK Then
                            txtDateAfter.Text = RealDate.ToString("dd/MM/yyyy HH:mm tt")

                            li_FilterInfoDateAfter.Visible = True
                            litFilterInfoDateAfter.Text = RealDate.ToString("dd/MM/yyyy HH:mm tt")
                        Else
                            txtDateAfter.Text = ""
                            li_FilterInfoDateAfter.Visible = False
                        End If

                    Case SurveyFilterTypeEnum.CustomDataText

                        txtData.Text = sf.FilterValue

                        li_FilterInfoAnswers.Visible = True
                        litFilterInfoAnswers.Text = sf.FilterValue

                    Case SurveyFilterTypeEnum.QuestionFilter
                        CustomFiltersPresent = True
                End Select

            Next

            '# Load custom filters
            Dim FiltersList As List(Of SurveyFilter) = (From dr In CurrentSurveyControl.SurveyFilters Where dr.SurveyFilterType = SurveyFilterTypeEnum.QuestionFilter Order By dr.QuestionIndex Select dr).ToList()

            With lvQuestionFilters
                .DataSource = FiltersList
                .DataBind()
            End With

            If FiltersList IsNot Nothing AndAlso FiltersList.Count() > 0 Then
                tr_filtertype_and.Visible = True
                tr_filtertype_or.Visible = True
            Else
                tr_filtertype_and.Visible = False
                tr_filtertype_or.Visible = False
            End If
        Else
            rblSurveyStatus.SelectedValue = "both"

            With lvQuestionFilters
                .DataSource = Nothing
                .DataBind()
            End With

            tr_filtertype_and.Visible = False
            tr_filtertype_or.Visible = False
        End If

        '# Don't show if we only have the default
        'If LocalSiteInterface.CurrentSurveyControl.SurveyFilters.Count = 1 AndAlso LocalSiteInterface.CurrentSurveyControl.SurveyFilters(0).SurveyFilterType = SurveyFilterTypeEnum.Status AndAlso LocalSiteInterface.CurrentSurveyControl.SurveyFilters(0).FilterValue = "Deleted" Then
        '    pnlGlobalFiltersInfo.Visible = False
        'End If

        '# Load saved searches
        LoadSavedSearches()

    End Sub

    Protected Sub LoadSavedSearches()

        '# Get a list of all saved searches
        Dim FileList As List(Of KeyValuePair(Of String, String)) = TextFileBuilder.GetSavedTextFiles(SurveyID)

        With ddlQuestionFiltersSaved
            .DataTextField = "Value"
            .DataValueField = "Key"
            .DataSource = FileList
            .DataBind()

            .Items.Insert(0, New ListItem("Load a saved filter set", ""))

            Try
                If CurrentSurveyControl IsNot Nothing AndAlso Not String.IsNullOrEmpty(CurrentSurveyControl.FilterSet) Then
                    'ddlQuestionFiltersSaved.SelectedValue = CurrentSurveyControl.FilterSet
                    txtQuestionFiltersSearch.Text = CurrentSurveyControl.FilterSet
                    'LoadSavedQuestionFilters(CurrentSurveyControl.FilterSet)
                End If
            Catch ex As Exception
            End Try
        End With

    End Sub

    Protected Sub lvQuestionFilters_ItemDataBound(sender As Object, e As ListViewItemEventArgs) Handles lvQuestionFilters.ItemDataBound
        Select Case e.Item.ItemType
            Case ListViewItemType.DataItem

                'Dim rbActive As RadioButton = CType(e.Item.FindControl("rbActive"), RadioButton)
                'Dim rbDelete As RadioButton = CType(e.Item.FindControl("rbDelete"), RadioButton)

                'If rbActive IsNot Nothing AndAlso rbDelete IsNot Nothing Then
                '    rbActive.GroupName = "rbQuestionFilter_" & e.Item.DataItemIndex.ToString()
                '    rbDelete.GroupName = "rbQuestionFilter_" & e.Item.DataItemIndex.ToString()

                '    rbActive.Checked = True
                'End If

                Dim sf As SurveyFilter = CType(e.Item.DataItem, SurveyFilter)
                Dim chkActive As CheckBox = CType(e.Item.FindControl("chkActive"), CheckBox)

                If sf IsNot Nothing AndAlso chkActive IsNot Nothing Then
                    chkActive.Checked = sf.Active
                End If

        End Select
    End Sub

    Protected Sub btnSurveyFiltering_Click(sender As Object, e As EventArgs) Handles btnSurveyFiltering.Click
        If Page.IsValid Then

            '# Remove status filters - clear them out
            LocalSiteInterface.CurrentSurveyControl.RemoveSurveyFilterByType(SurveyFilterTypeEnum.Status)
            LocalSiteInterface.CurrentSurveyControl.RemoveSurveyFilterByType(SurveyFilterTypeEnum.DateBefore)
            LocalSiteInterface.CurrentSurveyControl.RemoveSurveyFilterByType(SurveyFilterTypeEnum.DateAfter)

            '# Status
            Select Case rblSurveyStatus.SelectedValue
                Case "complete"
                    LocalSiteInterface.CurrentSurveyControl.AddSurveyFilter(SurveyFilterTypeEnum.Status, "status", "=", "Complete")
                Case "partial"
                    LocalSiteInterface.CurrentSurveyControl.AddSurveyFilter(SurveyFilterTypeEnum.Status, "status", "=", "Partial")
                Case Else
                    LocalSiteInterface.CurrentSurveyControl.AddSurveyFilter(SurveyFilterTypeEnum.Status, "status", "<>", "Deleted")
            End Select

            '# Dates

            '# Get values
            Dim DateBeforeStr As String = txtDateBefore.Text
            Dim DateAfterStr As String = txtDateAfter.Text
            Dim DateBefore As New Date
            Dim DateAfter As New Date

            '# Check these are valid dates
            Dim DateBeforeOK As Boolean = False
            Dim DateAfterOK As Boolean = False

            DateBeforeOK = Date.TryParse(DateBeforeStr, DateBefore)
            DateAfterOK = Date.TryParse(DateAfterStr, DateAfter)

            '# Remove status filters - clear them out

            If DateBeforeOK Then

                '# Format date
                DateBeforeStr = DateBefore.ToString("yyyy-MM-dd+HH:mm:ss")

                '# Add filter
                LocalSiteInterface.CurrentSurveyControl.AddSurveyFilter(SurveyFilterTypeEnum.DateBefore, "datesubmitted", ">=", DateBeforeStr)

            End If

            If DateAfterOK Then

                '# Format date
                DateAfterStr = DateAfter.ToString("yyyy-MM-dd+HH:mm:ss")

                '# Add filter
                LocalSiteInterface.CurrentSurveyControl.AddSurveyFilter(SurveyFilterTypeEnum.DateAfter, "datesubmitted", "<=", DateAfterStr)

            End If

            '# Custom Text
            Dim CustomTextValue As String = txtData.Text
            If Not String.IsNullOrEmpty(CustomTextValue) Then
                LocalSiteInterface.CurrentSurveyControl.RemoveSurveyFilterByType(SurveyFilterTypeEnum.CustomDataText)
                LocalSiteInterface.CurrentSurveyControl.AddSurveyFilter(SurveyFilterTypeEnum.CustomDataText, "", "=", CustomTextValue)
            End If

            SetFilteringDetails()
            SelectSurvey()
        End If
    End Sub

    Protected Sub btnUpdateQuestionFilters_Click(sender As Object, e As EventArgs) Handles btnUpdateQuestionFilters.Click
        If Page.IsValid Then

            '# Loop through Questions and remove ones that require deleting
            For Each li As ListViewDataItem In lvQuestionFilters.Items
                Dim hdnQuestionFilterValue As HiddenField = CType(li.FindControl("hdnQuestionFilterValue"), HiddenField)
                Dim chkDelete As CheckBox = CType(li.FindControl("chkDelete"), CheckBox)
                Dim chkActive As CheckBox = CType(li.FindControl("chkActive"), CheckBox)

                If hdnQuestionFilterValue IsNot Nothing AndAlso chkDelete IsNot Nothing AndAlso chkActive IsNot Nothing Then
                    If chkDelete.Checked Then
                        '# Delete
                        LocalSiteInterface.CurrentSurveyControl.RemoveSurveyFilterByFieldValue(hdnQuestionFilterValue.Value, SurveyFilterTypeEnum.QuestionFilter)
                    Else
                        '# Set active
                        LocalSiteInterface.CurrentSurveyControl.SetSurveyFilterActiveByFieldValue(hdnQuestionFilterValue.Value, chkActive.Checked, SurveyFilterTypeEnum.QuestionFilter)
                    End If
                End If
            Next

            If rbOrFilter.Checked Then
                CurrentSurveyControl.SetQuestionFilterType(SurveyControl.QuestionFilterTypeEnum.OrFilter)
            Else
                CurrentSurveyControl.SetQuestionFilterType(SurveyControl.QuestionFilterTypeEnum.AndFilter)
            End If

            ReLoadSurvey()

        End If
    End Sub

    Protected Sub QuestionFiltersSearch_Command(sender As Object, e As CommandEventArgs)
        If Page.IsValid Then
            Try

                Dim FileName As String = txtQuestionFiltersSearch.Text

                If Not String.IsNullOrEmpty(FileName) Then
                    Select Case e.CommandName
                        Case "save"
                            TextFileBuilder.SaveTextFile(SurveyID, FileName, CurrentSurveyControl.SurveyFilters)
                            CurrentSurveyControl.FilterSet = FileName
                        Case "delete"
                            TextFileBuilder.DeleteTextFile(SurveyID, FileName)
                            LoadSavedQuestionFilters("")
                        Case "clear"
                            LoadSavedQuestionFilters("")
                    End Select
                Else
                    ShowQuestionFiltersSearchFail("Problem with editing your saved searches - Saved result name missing")
                End If

            Catch ex As Exception
                ShowQuestionFiltersSearchFail("Problem with editing your saved searches - " & ex.Message)
            End Try

        End If
    End Sub

    Protected Sub ddlQuestionFiltersSaved_SelectedIndexChanged(sender As Object, e As EventArgs) Handles ddlQuestionFiltersSaved.SelectedIndexChanged

        Dim FileName As String = ddlQuestionFiltersSaved.SelectedValue
        LoadSavedQuestionFilters(FileName)

    End Sub

    Protected Sub LoadSavedQuestionFilters(FileName As String)

        '# Load saved results - if we have a selected set to load

        If Not String.IsNullOrEmpty(FileName) AndAlso FileName <> "0" Then

            Dim SavedContents As String = TextFileBuilder.GetTextFileContents(SurveyID, FileName)

            If Not String.IsNullOrEmpty(SavedContents) Then

                Dim SavedContentsList As String() = SavedContents.Split("|")

                If SavedContentsList IsNot Nothing AndAlso SavedContentsList.Count() > 0 Then

                    LocalSiteInterface.CurrentSurveyControl.RemoveAllSurveyFilters()

                    For Each SavedItem As String In SavedContentsList

                        If Not String.IsNullOrEmpty(SavedItem) AndAlso SavedItem.Length > 0 Then

                            '# Remove bookends
                            SavedItem = SavedItem.Replace("[", "").Replace("]", "")

                            '# Set value varibles
                            Dim FilterType As SurveyFilterTypeEnum = SurveyFilterTypeEnum.QuestionFilter
                            Dim QuestionID As String = ""
                            Dim QuestionTitle As String = ""
                            Dim OptionID As String = ""
                            Dim OptionTitle As String = ""
                            Dim OptionValue As String = ""
                            Dim QuestionIndex As String = ""
                            Dim OperatorValue As String = ""
                            Dim IsActive As Boolean = False

                            '# Get values
                            Dim FilterValues As String() = SavedItem.Split("~")
                            If FilterValues.Length > 0 Then
                                FilterType = CType(FilterValues(0), SurveyFilterTypeEnum)

                                'QuestionID = FilterValues(1)
                                Select Case FilterType
                                    Case SurveyFilterTypeEnum.QuestionFilter
                                        QuestionID = "[" & FilterValues(1) & "]"
                                    Case Else
                                        QuestionID = FilterValues(1)
                                End Select

                                QuestionTitle = FilterValues(2)
                                OptionID = FilterValues(3)
                                OptionTitle = FilterValues(4)
                                OptionValue = FilterValues(5)
                                QuestionIndex = FilterValues(6)
                                OperatorValue = FilterValues(7)
                                IsActive = CType(FilterValues(8), Boolean)
                            End If

                            LocalSiteInterface.CurrentSurveyControl.AddSurveyFilter(FilterType, QuestionID, OperatorValue, OptionValue, GlobalMethods.StripHTML(QuestionTitle), OptionID, GlobalMethods.StripHTML(OptionTitle), QuestionIndex, IsActive)

                        End If

                    Next

                End If

                txtQuestionFiltersSearch.Text = FileName
                CurrentSurveyControl.FilterSet = FileName
                ddlQuestionFiltersSaved.SelectedIndex = 0

                ReLoadSurvey()

            Else
                ShowQuestionFiltersSearchFail("Problem with loading your saved search - please check you have entered the correct saved reference")
            End If

        Else
            LocalSiteInterface.CurrentSurveyControl.RemoveAllSurveyFilters()
            txtQuestionFiltersSearch.Text = ""
            CurrentSurveyControl.FilterSet = ""
            ReLoadSurvey()
        End If

    End Sub

    Protected Sub ShowQuestionFiltersSearchFail(ByVal Msg As String)

        Dim c As New CustomValidator()
        c.IsValid = False
        c.Text = "&nbsp;"
        c.ErrorMessage = "<div class='ss_row'><div class='warning'><p>" & Msg & "</p></div></div>"
        c.Text = "<div class='warning'><p>" & Msg & "</p></div>"
        c.CssClass = "sf_row_faillist"
        c.Style("padding") = "10px 0"
        c.Style("display") = "block"

        phQuestionFiltersSearch.Visible = True
        phQuestionFiltersSearch.Controls.Add(c)

    End Sub
#End Region

#Region "Formatting"
    Protected Function FormatDate(InDate As Date) As String
        Return InDate.ToString("HH:mm d") & GlobalMethods.GetDateSuffix(InDate.Day) & " " & InDate.ToString("MMM yyyy")
    End Function
#End Region

#Region "Export"
    Protected Sub btnSurveyExport_Click(sender As Object, e As System.EventArgs) Handles btnSurveyExport.Click
        If Page.IsValid Then

            '# Note: Questionaire Coding taken out - nothing to suggest what it did on old site
            Dim ReturnResponse As KeyValuePair(Of Boolean, String) = ExportFileBuilder.BuildSurveyExport(CurrentSurvey, chkExportPlainResults.Checked)

            If ReturnResponse.Key = True Then
                litExportMsg.Text = "Export Successful"
            Else
                litExportMsg.Text = "Error: " & ReturnResponse.Value
            End If

        End If
    End Sub

    Protected Sub btnRawExport_Click(sender As Object, e As EventArgs) Handles btnRawExport.Click
        If Page.IsValid Then

            '# Note: Questionaire Coding taken out - nothing to suggest what it did on old site
            Dim ReturnResponse As KeyValuePair(Of Boolean, String) = ExportFileBuilder.BuildResponsesExport(CurrentSurvey)

            If ReturnResponse.Key = True Then
                litExportMsg.Text = "Export Successful"
            Else
                litExportMsg.Text = "Error: " & ReturnResponse.Value
            End If

        End If
    End Sub
#End Region

#Region "PDF Export"

    Const RootFolderPath As String = "/App_Data/PDFs/"

    Protected Sub btnExportPDF_Click(sender As Object, e As EventArgs) Handles btnExportPDF.Click
        If Page.IsValid Then

            '# save images
            For Each lv As ListViewDataItem In lvSurveyQuestions.Items
                Dim pmSurveyQuestion As Controls_SurveyQuestionControl = CType(lv.FindControl("pmSurveyQuestion"), Controls_SurveyQuestionControl)
                Dim hdnSQ As HiddenField = CType(lv.FindControl("hdnSQ"), HiddenField)
                If pmSurveyQuestion IsNot Nothing Then

                    Dim SurveyQuestionID As Integer = 0
                    If hdnSQ IsNot Nothing Then Int32.TryParse(hdnSQ.Value, SurveyQuestionID)

                    pmSurveyQuestion.SaveGraphImage(SurveyQuestionID)
                End If
            Next

            Try
                Dim PDFLocationURL As String = PDFBuilder.BuildResponsePage(CurrentSurvey, LocalSiteInterface.CurrentSurveyControl, chkExportIncludeComments.Checked)
                LoadPage()

                Response.AddHeader("Content-Type", "application/octet-stream")
                Response.AddHeader("Content-Transfer-Encoding", "Binary")
                Response.AddHeader("Content-disposition", "attachment; filename=""" & PDFLocationURL & """")
                Response.WriteFile(Server.MapPath("~" & RootFolderPath & CurrentSurvey.ID.ToString() & "/" & PDFLocationURL))
                Response.End()

            Catch ex As Exception
                litExportMsg.Text = "Error: Problem with export - " & ex.Message
            End Try

        End If
    End Sub
#End Region

    '#Region "Export"

    '    Public Shared Function BuildResponsePage(CurrentSurvey As Survey, CurrentSurveyControl As PingSurveys.SurveyControl, Optional IncludeComments As Boolean = True) As String

    '        '# Global variables
    '        Dim doc As New iTextSharp.text.Document(iTextSharp.text.PageSize.A4, 0, 0, 12, 36)

    '        Dim FileLocation As String = ""
    '        Dim PageFileName As String = ""

    '        Try

    '            If CurrentSurvey IsNot Nothing Then

    '                '# Get the filename info
    '                Dim PageFilePath As String = RootFolderPath & CurrentSurvey.ID.ToString() & "/"

    '                Dim FormattedTitle As String = CurrentSurvey.Title.Replace(" ", "").Replace("/", "").Replace(",", "")
    '                PageFileName = "ReportSummary_" & FormattedTitle & "_" & CurrentSurvey.ID

    '                '# Set filelocation
    '                FileLocation = PageFilePath & PageFileName & ".pdf"

    '                '# Check the folder exists- create folder if it doesn't
    '                CheckFolderExists(PageFilePath)

    '                '# Check the file exists- create file if it doesn't
    '                Dim IsNewFile As Boolean = True 'CheckFileExists(FileLocation)

    '                '# Only build if this is a new iTextSharp.text.Document
    '                If IsNewFile Then

    '                    Dim FolderPath As String = PageFilePath
    '                    If Not FolderPath.StartsWith("~") Then FolderPath = "~" & FolderPath

    '                    '# use a variable to let my code fit across the page...
    '                    Dim path As String = HttpContext.Current.Server.MapPath(FolderPath)

    '                    Dim pdfWrite As PdfWriter = PdfWriter.GetInstance(doc, New FileStream(path & PageFileName & ".pdf", FileMode.Create))

    '                    Dim ev As New itsEvents
    '                    pdfWrite.PageEvent = ev

    '                    doc.Open()

    '                    '# Logo
    '                    Dim Logo As iTextSharp.text.Image
    '                    Try
    '                        If Not String.IsNullOrEmpty(CurrentSurvey.DecorativeHeaderImage) Then

    '                            Dim url As String = CurrentSurvey.DecorativeHeaderImage
    '                            If Not url.StartsWith("http:") Then url = "http:" & url

    '                            Logo = iTextSharp.text.Image.GetInstance(New Uri(url))
    '                        Else
    '                            Logo = iTextSharp.text.Image.GetInstance(HttpContext.Current.Server.MapPath("~/Media/Images/header-default.jpg"))
    '                        End If
    '                    Catch ex As Exception
    '                        Logo = iTextSharp.text.Image.GetInstance(HttpContext.Current.Server.MapPath("~/Media/Images/header-default.jpg"))
    '                    End Try

    '                    Logo.ScaleToFit(400.0F, 100.0F)
    '                    Logo.Alignment = iTextSharp.text.Image.ALIGN_CENTER
    '                    doc.Add(Logo)

    '                    '# Spacer
    '                    Dim p As iTextSharp.text.Paragraph = New iTextSharp.text.Paragraph(" ")
    '                    doc.Add(p)

    '                    '# Add info
    '                    Dim InformationTable As PdfPTable = CreateInformationRow(CurrentSurvey, CurrentSurveyControl)
    '                    InformationTable.SplitLate = False
    '                    doc.Add(InformationTable)
    '                    'doc.Add(p)

    '                    '# Build HTML for the questions
    '                    Dim QuestionsList As List(Of SurveyQuestion) = (From dr In CurrentSurvey.Questions Where dr.Type = "SurveyQuestion" Select dr).ToList()
    '                    Dim QuestionCount As Integer = 1

    '                    Dim ResultListTable As New PdfPTable(1)
    '                    ResultListTable.SplitLate = False

    '                    For Each sq As SurveyQuestion In QuestionsList

    '                        Dim ResultTable As PdfPTable = CreateQuestionRow(sq, CurrentSurvey, QuestionCount, IncludeComments)
    '                        ResultTable.SplitLate = False

    '                        Dim ResultListCell As PdfPCell = New PdfPCell(ResultTable)
    '                        ResultListCell.BackgroundColor = iTextSharp.text.BaseColor.WHITE
    '                        'ResultListCell.Padding = 5
    '                        ResultListCell.BorderWidth = 0.0F

    '                        ResultListTable.AddCell(ResultListCell)

    '                        Dim SpacerCell As PdfPCell = New PdfPCell(p)
    '                        SpacerCell.BackgroundColor = iTextSharp.text.BaseColor.WHITE
    '                        'SpacerCell.Padding = 5
    '                        SpacerCell.BorderWidth = 0.0F

    '                        ResultListTable.AddCell(SpacerCell)

    '                        QuestionCount += 1
    '                    Next

    '                    doc.Add(ResultListTable)
    '                    doc.Add(p)

    '                    '# Footer
    '                    Dim Footer As New iTextSharp.text.Paragraph("")

    '                End If
    '            Else
    '                Throw New Exception("Deal information can't be accessed")
    '            End If

    '        Catch dex As iTextSharp.text.DocumentException
    '            Throw (dex)
    '        Catch ioex As IOException
    '            Throw (ioex)
    '        Catch ex As Exception
    '            Throw (ex)
    '        Finally
    '            doc.Close()
    '        End Try

    '        Return PageFileName & ".pdf"

    '    End Function

    '    Public Shared Function CreateInformationRow(CurrentSurvey As Survey, CurrentSurveyControl As PingSurveys.SurveyControl) As PdfPTable

    '        '# Set layout & styles
    '        Dim Table As PdfPTable = New PdfPTable(2)

    '        Dim Arial As iTextSharp.text.Font = iTextSharp.text.FontFactory.GetFont(iTextSharp.text.FontFactory.HELVETICA)
    '        Arial.Size = 8
    '        Arial.SetColor(21, 21, 21)

    '        Dim ArialLarge As iTextSharp.text.Font = iTextSharp.text.FontFactory.GetFont(iTextSharp.text.FontFactory.HELVETICA)
    '        ArialLarge.Size = 10
    '        ArialLarge.SetColor(21, 21, 21)

    '        '# Get Total information
    '        Dim TotalResponses As Integer = 0
    '        Dim FilteredResponses As Integer = 0
    '        Dim ExcludedResponses As Integer = 0

    '        TotalResponses = CurrentSurvey.AllResponses.Count()

    '        Dim ResponsesAreFiltered As Boolean = True

    '        If CurrentSurveyControl.SurveyFilters.Count = 1 AndAlso CurrentSurveyControl.SurveyFilters(0).SurveyFilterType = SurveyFilterTypeEnum.Status AndAlso CurrentSurveyControl.SurveyFilters(0).FilterValue = "Deleted" Then
    '            ResponsesAreFiltered = False
    '        ElseIf CurrentSurveyControl.SurveyFilters.Count = 2 Then

    '            Dim NoDeletedDataPresent As Boolean = False
    '            Dim NoTestDataPresent As Boolean = False

    '            For Each sf As SurveyFilter In CurrentSurveyControl.SurveyFilters
    '                If sf.SurveyFilterType = SurveyFilterTypeEnum.Status AndAlso sf.FilterValue = "Deleted" Then
    '                    NoDeletedDataPresent = True
    '                End If
    '            Next

    '            For Each sf As SurveyFilter In CurrentSurveyControl.SurveyFilters
    '                If sf.SurveyFilterType = SurveyFilterTypeEnum.General AndAlso sf.FieldValue = "istestdata" Then
    '                    NoTestDataPresent = True
    '                End If
    '            Next

    '            If NoDeletedDataPresent AndAlso NoTestDataPresent Then
    '                ResponsesAreFiltered = False
    '            End If

    '        End If
    '        If Not ResponsesAreFiltered Then
    '            FilteredResponses = 0
    '            ExcludedResponses = 0
    '        Else
    '            FilteredResponses = CurrentSurvey.Responses.Count()
    '            ExcludedResponses = TotalResponses - FilteredResponses
    '        End If

    '        '# Row 1

    '        '# Load date filters
    '        Dim DateFilterString As String = ""
    '        Dim HasBeforeDate As Boolean = False
    '        Dim BeforeDate As New Date
    '        Dim HasAfterDate As Boolean = False
    '        Dim AfterDate As New Date

    '        Dim FirstResponse As SurveyResponse = (From dr In CurrentSurvey.AllResponses Order By dr.DateSubmitted Select dr).FirstOrDefault()
    '        Dim LastResponse As SurveyResponse = (From dr In CurrentSurvey.AllResponses Order By dr.DateSubmitted Descending Select dr).FirstOrDefault()

    '        For Each sf As SurveyFilter In CurrentSurveyControl.SurveyFilters
    '            Select Case sf.SurveyFilterType

    '                Case SurveyFilterTypeEnum.DateBefore
    '                    '# Get values
    '                    Dim DateStr As String = sf.FilterValue.Replace("+", " ")

    '                    '# Check this is a valid date
    '                    Dim DateOK As Boolean = Date.TryParse(DateStr, BeforeDate)
    '                    HasBeforeDate = DateOK

    '                Case SurveyFilterTypeEnum.DateAfter
    '                    '# Get values
    '                    Dim DateStr As String = sf.FilterValue.Replace("+", " ")

    '                    '# Check this is a valid date
    '                    Dim DateOK As Boolean = Date.TryParse(DateStr, AfterDate)
    '                    HasAfterDate = DateOK
    '            End Select
    '        Next

    '        Dim LastDate As Date = LastResponse.DateSubmitted
    '        If LastDate > Now.Date Then
    '            LastDate = Now.Date
    '        End If

    '        If HasBeforeDate AndAlso HasAfterDate Then
    '            DateFilterString = " " & FormatExportDateFilter(BeforeDate) & " -" & FormatExportDateFilter(AfterDate)
    '        ElseIf HasAfterDate Then
    '            DateFilterString = " " & FormatExportDateFilter(FirstResponse.DateSubmitted) & " -" & FormatExportDateFilter(AfterDate)
    '        ElseIf HasBeforeDate Then
    '            DateFilterString = " " & FormatExportDateFilter(BeforeDate) & " -" & FormatExportDateFilter(LastDate)
    '        Else
    '            DateFilterString = " " & FormatExportDateFilter(Now.Date)  '" " & FormatExportDateFilter(FirstResponse.DateSubmitted) & " -" & FormatExportDateFilter(LastDate)
    '        End If

    '        Dim ReportTitle As String = "Report Summary"
    '        If Not String.IsNullOrEmpty(DateFilterString) Then ReportTitle = ReportTitle & " -" & DateFilterString

    '        Dim cell As PdfPCell = New PdfPCell(New iTextSharp.text.Phrase(ReportTitle, ArialLarge))
    '        cell.BackgroundColor = iTextSharp.text.BaseColor.WHITE
    '        cell.Padding = 5
    '        cell.Colspan = 2
    '        cell.BorderWidth = 0.0F
    '        Table.AddCell(cell)

    '        '# Info rows

    '        '# Survey
    '        cell = New PdfPCell(New iTextSharp.text.Phrase("Survey: " & CurrentSurvey.Title, Arial))
    '        cell.Padding = 5
    '        cell.BorderWidth = 0.0F
    '        cell.Colspan = 2
    '        Table.AddCell(cell)

    '        '# Status
    '        Dim StatusFont As iTextSharp.text.Font = iTextSharp.text.FontFactory.GetFont(iTextSharp.text.FontFactory.HELVETICA)
    '        StatusFont.Size = 8

    '        Dim StatusTitle As String = ""
    '        Select Case CurrentSurvey.Status
    '            Case "In Design"
    '                StatusFont.SetColor(0, 70, 122)
    '                StatusTitle = "In Design"
    '            Case "Launched"
    '                StatusFont.SetColor(156, 205, 68)
    '                StatusTitle = "Launched"
    '            Case "Closed"
    '                StatusFont.SetColor(198, 21, 28)
    '                StatusTitle = "Closed"
    '        End Select

    '        Dim TitleChunk As iTextSharp.text.Chunk = New iTextSharp.text.Chunk("Status: ", Arial)
    '        Dim InfoChunk As iTextSharp.text.Chunk = New iTextSharp.text.Chunk(StatusTitle, StatusFont)

    '        Dim StatusPhrase As iTextSharp.text.Phrase = New iTextSharp.text.Phrase(TitleChunk)
    '        StatusPhrase.Add(InfoChunk)

    '        cell = New PdfPCell(StatusPhrase)
    '        cell.Padding = 5
    '        cell.BorderWidth = 0.0F
    '        Table.AddCell(cell)

    '        '# Total Responses
    '        cell = New PdfPCell(New iTextSharp.text.Phrase("Total Responses: " & TotalResponses.ToString(), Arial))
    '        cell.Padding = 5
    '        cell.BorderWidth = 0.0F
    '        Table.AddCell(cell)

    '        '# Created Time/Date
    '        cell = New PdfPCell(New iTextSharp.text.Phrase("Created Time/Date: " & FormatExportDate(CurrentSurvey.CreatedOn, False), Arial))
    '        cell.Padding = 5
    '        cell.BorderWidth = 0.0F
    '        Table.AddCell(cell)

    '        '# Filtered Responses
    '        cell = New PdfPCell(New iTextSharp.text.Phrase("Filtered Responses: " & FilteredResponses.ToString(), Arial))
    '        cell.Padding = 5
    '        cell.BorderWidth = 0.0F
    '        Table.AddCell(cell)

    '        '# Modified Time/Date
    '        cell = New PdfPCell(New iTextSharp.text.Phrase("Modified Time/Date: " & FormatExportDate(CurrentSurvey.ModifiedOn, False), Arial))
    '        cell.Padding = 5
    '        cell.BorderWidth = 0.0F
    '        Table.AddCell(cell)

    '        '# Responses Excluded
    '        cell = New PdfPCell(New iTextSharp.text.Phrase("Responses Excluded: " & ExcludedResponses.ToString(), Arial))
    '        cell.Padding = 5
    '        cell.BorderWidth = 0.0F
    '        Table.AddCell(cell)

    '        '# Divider
    '        cell = New PdfPCell()
    '        cell.Padding = 5
    '        cell.Colspan = 2
    '        cell.BorderWidth = 0.0F
    '        cell.BorderWidthBottom = 1.0F
    '        cell.BorderColorBottom = New iTextSharp.text.BaseColor(0, 70, 122)
    '        Table.AddCell(cell)

    '        Table.SplitLate = False

    '        Return Table

    '    End Function

    '    Public Shared Function CreateQuestionRow(CurrentSurveyQuestion As SurveyQuestion, CurrentSurvey As Survey, QuestionNumber As Integer, IncludeComments As Boolean) As PdfPTable

    '        '# Set layout options
    '        Dim Arial As iTextSharp.text.Font = iTextSharp.text.FontFactory.GetFont(iTextSharp.text.FontFactory.HELVETICA)
    '        Arial.Size = 7
    '        Arial.SetColor(21, 21, 21)

    '        Dim ArialBold As iTextSharp.text.Font = iTextSharp.text.FontFactory.GetFont(iTextSharp.text.FontFactory.HELVETICA_BOLD)
    '        ArialBold.Size = 7
    '        ArialBold.SetColor(21, 21, 21)

    '        Dim ArialLarge As iTextSharp.text.Font = iTextSharp.text.FontFactory.GetFont(iTextSharp.text.FontFactory.HELVETICA)
    '        ArialLarge.Size = 9
    '        ArialLarge.SetColor(21, 21, 21)

    '        Dim ArialLargeBold As iTextSharp.text.Font = iTextSharp.text.FontFactory.GetFont(iTextSharp.text.FontFactory.HELVETICA_BOLD)
    '        ArialLargeBold.Size = 9
    '        ArialLargeBold.SetColor(21, 21, 21)

    '        Dim ArialSmall As iTextSharp.text.Font = iTextSharp.text.FontFactory.GetFont(iTextSharp.text.FontFactory.HELVETICA)
    '        ArialSmall.Size = 6
    '        ArialSmall.SetColor(21, 21, 21)

    '        '# Get basic info
    '        Dim CurrentSurveyQuestionID As Integer = 0
    '        Int32.TryParse(CurrentSurveyQuestion.ID, CurrentSurveyQuestionID)

    '        Dim CheckImageURL As String = HttpContext.Current.Server.MapPath("~/Media/Images/check.png")

    '        '# Get stats
    '        Dim StatisticItem As SurveyStatistic = CurrentSurveyQuestion.Statistics

    '        '# Options
    '        Dim OptionsList As List(Of SurveyOption) = CurrentSurveyQuestion.Options

    '        '# Get total click count
    '        Dim TotalClicks As Integer = 0
    '        Dim TotalResponses As Integer = 0

    '        If OptionsList.Count > 0 Then

    '            For Each so As SurveyOption In OptionsList
    '                For Each ri As SurveyResponse In CurrentSurvey.Responses
    '                    Dim ResultList = (From dr In ri.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.AnswerValue = so.Value Select dr).ToList()

    '                    If ResultList.Count() <= 0 AndAlso so.Value.ToLower.Contains("other") Then
    '                        Dim rqListID As New List(Of SurveyResponseQuestion)

    '                        If CurrentSurveyQuestion.SubType = "radio" Then
    '                            ResultList = (From dr In ri.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.OptionID = so.ID Select dr).ToList()
    '                            'rqListID = (From dr In ri.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.AnswerValue.ToLower.Contains("other") AndAlso dr.OptionID = so.ID Select dr).ToList()
    '                        Else
    '                            ResultList = (From dr In ri.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.AnswerValue.ToLower.Contains("other") AndAlso dr.OptionID = so.ID Select dr).ToList()
    '                        End If

    '                    End If

    '                    If ResultList.Count > 0 Then
    '                        TotalResponses += 1
    '                        TotalClicks += ResultList.Count()
    '                    End If
    '                Next
    '            Next
    '        Else

    '            For Each ri As SurveyResponse In CurrentSurvey.Responses
    '                '# Check this response has answers
    '                Dim ResultList = (From dr In ri.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestion.ID AndAlso Not String.IsNullOrEmpty(dr.AnswerValue) Select dr).ToList()

    '                If ResultList.Count > 0 Then
    '                    TotalResponses += 1
    '                    TotalClicks += ResultList.Count()
    '                End If
    '            Next

    '        End If

    '        '# Set layout
    '        Dim NumberOfColumns As Integer = 2
    '        Dim TitleWidth As Integer = 2

    '        Dim Table As PdfPTable = New PdfPTable(2)
    '        Table.SplitLate = True

    '        Select Case CurrentSurveyQuestion.SubType
    '            Case "table"
    '                '# Total options from the sub-questions
    '                Dim OptionsCount As Integer = 0
    '                For Each sq As SurveyQuestion In CurrentSurveyQuestion.SubQuestions
    '                    If CurrentSurveyQuestion.Options.Count() > OptionsCount Then
    '                        OptionsCount = CurrentSurveyQuestion.Options.Count()
    '                    End If
    '                Next

    '                NumberOfColumns = OptionsCount + 2
    '            Case "radio"
    '                NumberOfColumns = 2

    '                'Dim widths As Single() = New Single() {1.5F, 1.0F}
    '                Dim widths As Single() = New Single() {1.0F, 1.0F}
    '                Table.SetWidths(widths)
    '            Case "checkbox"
    '                NumberOfColumns = 2

    '                Dim widths As Single() = New Single() {1.0F, 1.0F}
    '                Table.SetWidths(widths)
    '            Case "menu"
    '                NumberOfColumns = 2

    '                Dim widths As Single() = New Single() {1.0F, 1.0F}
    '                Table.SetWidths(widths)
    '            Case "rank"
    '                NumberOfColumns = CurrentSurveyQuestion.Options.Count() + 1
    '            Case "multi_textbox"
    '                NumberOfColumns = CurrentSurveyQuestion.Options.Count() + 1
    '            Case Else
    '                NumberOfColumns = 1
    '                Table = New PdfPTable(3)
    '                'Dim widths As Single() = New Single() {0.5F, 2.0F}
    '                Dim widths As Single() = New Single() {1, 1, 7}
    '                Table.SetWidths(widths)
    '                TitleWidth = 3
    '        End Select

    '        Table.KeepTogether = True
    '        '# Row 1
    '        Dim Title As String = GlobalMethods.StripHTML(CurrentSurveyQuestion.Title)

    '        Dim QuestionChunk As iTextSharp.text.Chunk = New iTextSharp.text.Chunk("Question " & QuestionNumber & ": ", ArialLargeBold)
    '        Dim TitleChunk As iTextSharp.text.Chunk = New iTextSharp.text.Chunk(Title, ArialLarge)

    '        Dim QuestionTitlePhrase As iTextSharp.text.Phrase = New iTextSharp.text.Phrase(QuestionChunk)
    '        QuestionTitlePhrase.Add(TitleChunk)

    '        Dim cell As PdfPCell = New PdfPCell(QuestionTitlePhrase)
    '        cell.BackgroundColor = iTextSharp.text.BaseColor.WHITE
    '        cell.Padding = 5
    '        cell.BorderWidth = 0.0F
    '        cell.Colspan = TitleWidth
    '        Table.AddCell(cell)

    '        Select Case CurrentSurveyQuestion.SubType
    '            Case "radio", "checkbox", "menu"

    '                '# Load possible options
    '                Dim GraphValuesTable = New PdfPTable(2)
    '                GraphValuesTable.SplitLate = True
    '                GraphValuesTable.DefaultCell.Border = 0.0F

    '                '# Title Row
    '                cell = New PdfPCell(New iTextSharp.text.Phrase("Answers:", Arial))
    '                cell.Padding = 5
    '                cell.PaddingBottom = 8
    '                cell.BorderWidth = 0
    '                GraphValuesTable.AddCell(cell)

    '                cell = New PdfPCell(New iTextSharp.text.Phrase("Responses:", Arial))
    '                cell.Padding = 5
    '                cell.PaddingBottom = 8
    '                cell.BorderWidth = 0
    '                GraphValuesTable.AddCell(cell)

    '                Dim OptionCount As Integer = 0
    '                For Each so In CurrentSurveyQuestion.Options

    '                    '# Answer Option
    '                    cell = New PdfPCell(New iTextSharp.text.Phrase(so.Title, Arial))
    '                    cell.Padding = 5
    '                    cell.BorderWidth = 0
    '                    If (OptionCount Mod 2) <> 0 Then cell.BackgroundColor = New iTextSharp.text.BaseColor(237, 237, 237)
    '                    GraphValuesTable.AddCell(cell)

    '                    '# Answer Response
    '                    Dim ResponseValue As String = "0 / 0%"

    '                    Dim Count As Integer = 0
    '                    If so IsNot Nothing Then

    '                        '# Survey responses
    '                        For Each ri As SurveyResponse In CurrentSurvey.Responses

    '                            Dim rqList = (From dr In ri.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.AnswerValue = so.Value Select dr).ToList()

    '                            If rqList.Count() <= 0 AndAlso so.Value.ToLower.Contains("other") Then
    '                                Dim rqListID As New List(Of SurveyResponseQuestion)

    '                                If CurrentSurveyQuestion.SubType = "radio" Then
    '                                    rqListID = (From dr In ri.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.OptionID = so.ID Select dr).ToList()
    '                                Else
    '                                    rqListID = (From dr In ri.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.AnswerValue.ToLower.Contains("other") AndAlso dr.OptionID = so.ID Select dr).ToList()
    '                                End If

    '                                Count += rqListID.Count()
    '                            End If

    '                            Count += rqList.Count()
    '                        Next

    '                        Dim Percentage As Decimal = 0
    '                        If TotalClicks > 0 Then Percentage = Math.Round(((100 / TotalClicks) * Count), 1)
    '                        Dim WidthValue As Decimal = Percentage * 3

    '                        ResponseValue = Count.ToString() & " / " & Percentage.ToString() & "%"

    '                    End If

    '                    cell = New PdfPCell(New iTextSharp.text.Phrase(ResponseValue, Arial))
    '                    cell.Padding = 5
    '                    cell.BorderWidth = 0
    '                    If (OptionCount Mod 2) <> 0 Then cell.BackgroundColor = New iTextSharp.text.BaseColor(237, 237, 237)
    '                    GraphValuesTable.AddCell(cell)

    '                    '# Check to see if we need to show response answers (for 'other' questions)
    '                    If IncludeComments Then

    '                        If Count > 0 Then

    '                            Dim ShowResponseAnswers As Boolean = False
    '                            Dim OtherOptions = (From dr In so.Properties Where dr.Key.ToLower().Contains("other") AndAlso dr.Value = "1" Select dr).ToList()
    '                            If OtherOptions IsNot Nothing AndAlso OtherOptions.Count() > 0 Then ShowResponseAnswers = True

    '                            If ShowResponseAnswers Then
    '                                cell = New PdfPCell(GetResponseValuesTable(CurrentSurvey, CurrentSurveyQuestion, so.ID))
    '                                cell.Padding = 5
    '                                cell.BorderWidth = 0
    '                                cell.Colspan = 2
    '                                GraphValuesTable.AddCell(cell)
    '                            End If

    '                        End If
    '                    End If

    '                    OptionCount += 1

    '                Next

    '                '# Total clicks
    '                GraphValuesTable.AddCell(GetTotalValuesTitleCell("TOTAL CLICKS", 7))
    '                GraphValuesTable.AddCell(GetTotalValuesCell(TotalClicks, 7))

    '                '# Total clicks
    '                GraphValuesTable.AddCell(GetTotalValuesTitleCell("TOTAL RESPONSES"))
    '                GraphValuesTable.AddCell(GetTotalValuesCell(TotalResponses, 2))

    '                '# Add to page
    '                cell = New PdfPCell(GraphValuesTable)
    '                cell.Padding = 0.0F
    '                cell.BorderWidth = 0
    '                cell.BorderWidthRight = 1.0F
    '                cell.BorderColorRight = New iTextSharp.text.BaseColor(0, 70, 122)
    '                Table.AddCell(cell)

    '                '# Graph
    '                Dim PageFilePath As String = "~/App_Data/Img/" & CurrentSurvey.ID.ToString() & "/"
    '                Dim FileExists As Boolean = File.Exists(HttpContext.Current.Server.MapPath(PageFilePath & CurrentSurveyQuestionID & ".jpg"))

    '                If FileExists AndAlso TotalResponses > 0 Then
    '                    Dim GraphImage = iTextSharp.text.Image.GetInstance(HttpContext.Current.Server.MapPath(PageFilePath & CurrentSurveyQuestionID & ".jpg"))

    '                    Dim h As Single = GraphImage.Height
    '                    Dim w As Single = GraphImage.Width

    '                    'GraphImage.ScalePercent(80.0F)
    '                    Dim h1 As Single = GraphImage.ScaledHeight
    '                    Dim w1 As Single = GraphImage.ScaledWidth
    '                    'GraphImage.SetAbsolutePosition(27.0F, 535.0F)
    '                    'GraphImage.Border = iTextSharp.text.Rectangle.LEFT_BORDER
    '                    'GraphImage.BorderColor = New iTextSharp.text.BaseColor(0, 70, 122)
    '                    'GraphImage.BorderWidth = 1.0F
    '                    GraphImage.Alignment = iTextSharp.text.Image.ALIGN_JUSTIFIED
    '                    Dim d As Integer = GraphImage.DpiX
    '                    Dim e As Integer = GraphImage.DpiY
    '                    GraphImage.SetDpi(300, 300)
    '                    'GraphImage.ScaleToFit(100.0F, 100.0F)

    '                    'GraphImage.ScaleAbsolute(12.0F, 12.0F)
    '                    Dim GraphImageTable = New PdfPTable(1)
    '                    GraphImageTable.SplitLate = True
    '                    GraphImageTable.DefaultCell.Border = 0.0F

    '                    Dim ImageCell = New PdfPCell(GraphImage)
    '                    ImageCell.Padding = 2
    '                    ImageCell.BorderWidth = 0.0F
    '                    ImageCell.HorizontalAlignment = iTextSharp.text.Element.ALIGN_CENTER
    '                    GraphImageTable.AddCell(ImageCell)

    '                    '# Add to page
    '                    cell = New PdfPCell(GraphImageTable)
    '                    cell.Padding = 2
    '                    cell.BorderWidth = 0
    '                    Table.AddCell(cell)
    '                Else

    '                    Dim EmptyCell As PdfPCell = New PdfPCell(New iTextSharp.text.Phrase(" ", Arial))
    '                    EmptyCell.BorderWidth = 0
    '                    EmptyCell.Padding = 2

    '                    '# Add to page
    '                    cell = New PdfPCell(EmptyCell)
    '                    cell.Padding = 2
    '                    cell.BorderWidth = 0
    '                    Table.AddCell(cell)

    '                End If


    '            Case "table"

    '                '# Load possible options
    '                Dim TableValuesTable = New PdfPTable(CurrentSurveyQuestion.Options.Count() + 4)
    '                TableValuesTable.DefaultCell.Border = 0.0F
    '                TableValuesTable.SplitLate = True

    '                Dim TableCell As PdfPCell = New PdfPCell(New iTextSharp.text.Phrase(" ", Arial))
    '                TableCell.BorderWidth = 0
    '                TableCell.Padding = 5
    '                TableCell.Colspan = 2
    '                TableCell.HorizontalAlignment = iTextSharp.text.Element.ALIGN_CENTER
    '                TableValuesTable.AddCell(TableCell)

    '                For Each so As SurveyOption In CurrentSurveyQuestion.Options
    '                    TableCell = New PdfPCell(New iTextSharp.text.Phrase(so.Title, Arial))
    '                    TableCell.BorderWidth = 0
    '                    TableCell.Padding = 5
    '                    TableCell.HorizontalAlignment = iTextSharp.text.Element.ALIGN_CENTER
    '                    TableValuesTable.AddCell(TableCell)
    '                Next

    '                TableCell = New PdfPCell(New iTextSharp.text.Phrase("Total Responses", Arial))
    '                TableCell.BorderWidth = 0
    '                TableCell.Padding = 5
    '                TableCell.HorizontalAlignment = iTextSharp.text.Element.ALIGN_CENTER
    '                TableCell.BorderWidthLeft = 1.0F
    '                TableCell.BorderColorLeft = New iTextSharp.text.BaseColor(0, 70, 122)
    '                TableValuesTable.AddCell(TableCell)

    '                TableCell = New PdfPCell(New iTextSharp.text.Phrase("Not Answered", Arial))
    '                TableCell.BorderWidth = 0
    '                TableCell.Padding = 5
    '                TableCell.HorizontalAlignment = iTextSharp.text.Element.ALIGN_CENTER
    '                TableValuesTable.AddCell(TableCell)

    '                Dim RowCount As Integer = 0
    '                For Each sq As SurveyQuestion In CurrentSurveyQuestion.SubQuestions

    '                    '# Clear values
    '                    TotalResponses = 0
    '                    TotalClicks = 0

    '                    '# Answer Option
    '                    TableCell = New PdfPCell(New iTextSharp.text.Phrase(sq.Title, Arial))
    '                    TableCell.Padding = 5
    '                    TableCell.BorderWidth = 0
    '                    TableCell.Colspan = 2
    '                    If (RowCount Mod 2) <> 0 Then TableCell.BackgroundColor = New iTextSharp.text.BaseColor(237, 237, 237)
    '                    TableValuesTable.AddCell(TableCell)

    '                    Dim ResponseItems As List(Of SurveyResponse) = CurrentSurvey.Responses
    '                    Dim QuestionsResponses As New List(Of KeyValuePair(Of Integer, SurveyResponseQuestion))
    '                    For Each ri As SurveyResponse In ResponseItems
    '                        For Each rq As SurveyResponseQuestion In ri.ResponseQuestions
    '                            If rq.QuestionID = sq.ID Then
    '                                Dim Result As New KeyValuePair(Of Integer, SurveyResponseQuestion)(ri.ResponseID, rq)
    '                                QuestionsResponses.Add(Result)
    '                            End If
    '                        Next

    '                        Dim ResultList = (From dr In ri.ResponseQuestions Where dr.QuestionID = sq.ID AndAlso Not String.IsNullOrEmpty(dr.AnswerValue) Select dr).ToList()

    '                        If ResultList.Count > 0 Then
    '                            TotalResponses += 1
    '                            TotalClicks += ResultList.Count()
    '                        End If

    '                    Next

    '                    '# Answer Responses
    '                    For Each so As SurveyOption In sq.Options

    '                        Dim Count As Integer = 0

    '                        '# Survey responses
    '                        Dim SurveyResponseQuestions As New List(Of SurveyResponseQuestion)
    '                        For Each ri As SurveyResponse In ResponseItems
    '                            Dim rqList = (From dr In ri.ResponseQuestions Where dr.QuestionID = so.QuestionID AndAlso dr.AnswerValue = so.Value Select dr).ToList()

    '                            Dim OtherOption As SurveyOption = Nothing
    '                            Dim OtherOptions = (From dr In so.Properties Where dr.Key.ToLower().Contains("other") AndAlso dr.Value = "1" Select dr).ToList()
    '                            If OtherOptions IsNot Nothing AndAlso OtherOptions.Count() > 0 Then OtherOption = so

    '                            If rqList.Count() <= 0 AndAlso OtherOptions IsNot Nothing AndAlso OtherOptions.Count() > 0 Then

    '                                Dim rqListID = (From dr In ri.ResponseQuestions Where dr.QuestionID = so.QuestionID AndAlso dr.AnswerValue.ToLower.Contains("other") AndAlso dr.OptionID = so.ID Select dr).ToList()

    '                                Count += rqListID.Count()
    '                                For Each rq As SurveyResponseQuestion In ri.ResponseQuestions
    '                                    If rq.OptionID = so.ID Then
    '                                        SurveyResponseQuestions.Add(rq)
    '                                    End If
    '                                Next
    '                            End If

    '                            Count += rqList.Count()
    '                        Next

    '                        Dim Percentage As Decimal = 0
    '                        If TotalResponses > 0 Then Percentage = Math.Round(((100 / TotalResponses) * Count), 0)

    '                        Dim ResponseValue As String = Count.ToString() & " / " & Percentage.ToString() & "%"

    '                        TableCell = New PdfPCell(New iTextSharp.text.Phrase(ResponseValue, ArialBold))
    '                        TableCell.Padding = 5
    '                        TableCell.BorderWidth = 0
    '                        TableCell.HorizontalAlignment = iTextSharp.text.Element.ALIGN_CENTER
    '                        If (RowCount Mod 2) <> 0 Then TableCell.BackgroundColor = New iTextSharp.text.BaseColor(237, 237, 237)
    '                        TableValuesTable.AddCell(TableCell)

    '                    Next

    '                    '# Total Responses
    '                    TableCell = New PdfPCell(New iTextSharp.text.Phrase(TotalResponses.ToString(), Arial))
    '                    TableCell.Padding = 5
    '                    TableCell.BorderWidth = 0
    '                    TableCell.BorderWidthLeft = 1.0F
    '                    TableCell.BorderColorLeft = New iTextSharp.text.BaseColor(0, 70, 122)
    '                    TableCell.HorizontalAlignment = iTextSharp.text.Element.ALIGN_CENTER
    '                    If (RowCount Mod 2) <> 0 Then TableCell.BackgroundColor = New iTextSharp.text.BaseColor(237, 237, 237)
    '                    TableValuesTable.AddCell(TableCell)

    '                    '# Not Answered
    '                    TableCell = New PdfPCell(New iTextSharp.text.Phrase("0", Arial))
    '                    TableCell.Padding = 5
    '                    TableCell.BorderWidth = 0
    '                    TableCell.HorizontalAlignment = iTextSharp.text.Element.ALIGN_CENTER
    '                    If (RowCount Mod 2) <> 0 Then TableCell.BackgroundColor = New iTextSharp.text.BaseColor(237, 237, 237)
    '                    TableValuesTable.AddCell(TableCell)

    '                    RowCount += 1

    '                Next

    '                cell = New PdfPCell(TableValuesTable)
    '                'cell.BackgroundColor = New BaseColor(224, 224, 224)
    '                cell.Padding = 0.0F
    '                cell.Colspan = 2
    '                cell.BorderWidth = 0

    '                Table.AddCell(cell)


    '                'Case "rank"

    '                '        '# Load possible rankings
    '                '        'Dim RankValues As New List(Of Integer)
    '                '        Dim RankValuesTable = New PdfPTable(StatisticItem.Max + 2)
    '                '        RankValuesTable.DefaultCell.Border = 0.0F

    '                '        Dim RankCell As PdfPCell = New PdfPCell(New iTextSharp.text.Phrase(" ", New iTextSharp.text.Font(iTextSharp.text.Font.FontFamily.HELVETICA, 8)))
    '                '        RankCell.BackgroundColor = New iTextSharp.text.BaseColor(224, 224, 224)
    '                '        RankCell.BorderWidth = 0.0F
    '                '        RankCell.Padding = 5
    '                '        RankCell.Colspan = 2
    '                '        RankCell.HorizontalAlignment = iTextSharp.text.Element.ALIGN_CENTER

    '                '        RankValuesTable.AddCell(RankCell)

    '                '        For i As Integer = 1 To CInt(StatisticItem.Max)
    '                '            RankCell = New PdfPCell(New iTextSharp.text.Phrase(i.ToString(), New iTextSharp.text.Font(iTextSharp.text.Font.FontFamily.HELVETICA, 8)))
    '                '            RankCell.BackgroundColor = New iTextSharp.text.BaseColor(224, 224, 224)
    '                '            RankCell.BorderWidth = 1.0F
    '                '            RankCell.Padding = 5
    '                '            RankCell.HorizontalAlignment = iTextSharp.text.Element.ALIGN_CENTER

    '                '            RankValuesTable.AddCell(RankCell)
    '                '        Next

    '                '        '# Load actual responses
    '                '        For Each so In CurrentSurveyQuestion.Options

    '                '            '# Answer Option
    '                '            RankCell = New PdfPCell(New iTextSharp.text.Phrase(so.Title, New iTextSharp.text.Font(iTextSharp.text.Font.FontFamily.HELVETICA, 8)))
    '                '            RankCell.Padding = 5
    '                '            RankCell.BorderWidth = 1.0F
    '                '            RankCell.Colspan = 2
    '                '            RankValuesTable.AddCell(RankCell)

    '                '            '# Answer Response
    '                '            Dim ResponseID As Integer = 0
    '                '            Dim QuestionsResponses As New List(Of KeyValuePair(Of Integer, SurveyResponseQuestion))
    '                '            'For Each rq As SurveyResponseQuestion In CurrentSurveyResponse.ResponseQuestions
    '                '            '    If rq.QuestionID = CurrentSurveyQuestion.ID Then
    '                '            '        Dim Result As New KeyValuePair(Of Integer, SurveyResponseQuestion)(CurrentSurveyResponse.ResponseID, rq)
    '                '            '        QuestionsResponses.Add(Result)
    '                '            '    End If
    '                '            'Next

    '                '            Dim FilteredQuestionsResponses = (From dr In QuestionsResponses Where dr.Value.OptionID = so.ID And String.IsNullOrEmpty(dr.Value.AnswerValue) = False Select dr.Value.QuestionID, dr.Value.AnswerValue, CurrentResponseID = dr.Key).ToList()

    '                '            '# Load possible answers
    '                '            Dim RankValues As New List(Of KeyValuePair(Of Integer, Integer))

    '                '            If FilteredQuestionsResponses IsNot Nothing AndAlso FilteredQuestionsResponses.Count() > 0 Then
    '                '                For i As Integer = 1 To CInt(CurrentSurveyQuestion.Statistics.Max)
    '                '                    Dim ItemsRanked As Integer = (From dr In FilteredQuestionsResponses Where dr.AnswerValue = i.ToString() Select dr).Count()
    '                '                    Dim item As New KeyValuePair(Of Integer, Integer)(i, ItemsRanked)

    '                '                    RankValues.Add(item)
    '                '                Next
    '                '            End If

    '                '            For Each rv As KeyValuePair(Of Integer, Integer) In RankValues
    '                '                If rv.Value > 0 Then
    '                '                    Dim CheckImage = iTextSharp.text.Image.GetInstance(CheckImageURL)
    '                '                    CheckImage.ScaleAbsolute(12.0F, 12.0F)
    '                '                    Dim CheckedItemTable = New PdfPTable(1)
    '                '                    CheckedItemTable.DefaultCell.Border = 0.0F

    '                '                    Dim ImageCell = New PdfPCell(CheckImage)
    '                '                    ImageCell.BorderWidth = 0.0F
    '                '                    ImageCell.HorizontalAlignment = iTextSharp.text.Element.ALIGN_CENTER

    '                '                    CheckedItemTable.AddCell(ImageCell)

    '                '                    RankCell = New PdfPCell(CheckedItemTable)
    '                '                    RankCell.Padding = 5
    '                '                    RankCell.BorderWidth = 1.0F

    '                '                    RankValuesTable.AddCell(RankCell)

    '                '                Else
    '                '                    RankCell = New PdfPCell(New iTextSharp.text.Phrase(" ", New iTextSharp.text.Font(iTextSharp.text.Font.FontFamily.HELVETICA, 8)))
    '                '                    RankCell.Padding = 5
    '                '                    RankCell.BorderWidth = 1.0F
    '                '                    RankValuesTable.AddCell(RankCell)
    '                '                End If
    '                '            Next

    '                '        Next

    '                '        cell = New PdfPCell(RankValuesTable)
    '                '        'cell.BackgroundColor = New BaseColor(224, 224, 224)
    '                '        cell.Padding = 0.0F
    '                '        cell.Colspan = 2
    '                '        cell.BorderWidth = 1.0F

    '                '        Table.AddCell(cell)

    '            Case "multi_textbox"

    '                Dim MultiValuesTable = New PdfPTable(CurrentSurveyQuestion.Options.Count() + 2)
    '                MultiValuesTable.SplitLate = True
    '                MultiValuesTable.DefaultCell.Border = 0.0F

    '                Dim TableWidth As Single = MultiValuesTable.TotalWidth

    '                Dim WidthsList As New List(Of Single)
    '                WidthsList.Add(1)
    '                WidthsList.Add(1)

    '                Dim OptionsWidth As Decimal = (7 / CurrentSurveyQuestion.Options.Count())

    '                For Each so As SurveyOption In CurrentSurveyQuestion.Options
    '                    WidthsList.Add(OptionsWidth)
    '                Next

    '                Dim widths As Single() = WidthsList.ToArray()

    '                MultiValuesTable.SetWidths(widths)

    '                'Dim widths As Single() = New Single() {1.5F, 1.0F}
    '                'MultiValuesTable.SetWidths(widths)

    '                '# Title Row
    '                Dim TableCell As PdfPCell = New PdfPCell(New iTextSharp.text.Phrase("Result Set:", Arial))
    '                TableCell.Padding = 5
    '                TableCell.PaddingBottom = 8
    '                TableCell.BorderWidth = 0
    '                MultiValuesTable.AddCell(TableCell)

    '                TableCell = New PdfPCell(New iTextSharp.text.Phrase("Response ID:", Arial))
    '                TableCell.Padding = 5
    '                TableCell.PaddingBottom = 8
    '                TableCell.BorderWidth = 0
    '                MultiValuesTable.AddCell(TableCell)

    '                '# Bind options - question titles
    '                Dim Options = (From dr In CurrentSurveyQuestion.Options Order By dr.ID Select dr).ToList()
    '                For Each so As SurveyOption In Options
    '                    TableCell = New PdfPCell(New iTextSharp.text.Phrase(so.Value & ":", Arial))
    '                    TableCell.Padding = 5
    '                    TableCell.PaddingBottom = 8
    '                    TableCell.BorderWidth = 0
    '                    MultiValuesTable.AddCell(TableCell)
    '                Next

    '                '# Filter out the responses
    '                Dim ResponseItems As List(Of SurveyResponse) = CurrentSurvey.Responses
    '                Dim QuestionsResponses As New List(Of KeyValuePair(Of Integer, SurveyResponseQuestion))

    '                For Each ri As SurveyResponse In ResponseItems
    '                    '# Get the questions from the responses that match the current survey question
    '                    For Each rq As SurveyResponseQuestion In ri.ResponseQuestions
    '                        If rq.QuestionID = CurrentSurveyQuestion.ID Then
    '                            Dim Result As New KeyValuePair(Of Integer, SurveyResponseQuestion)(ri.ResponseID, rq)
    '                            QuestionsResponses.Add(Result)
    '                        End If
    '                    Next
    '                Next

    '                Dim FilteredQuestionsResponses = (From dr In QuestionsResponses Where String.IsNullOrEmpty(dr.Value.AnswerValue) = False Select New MultiTextBoxGroup(dr.Value.QuestionID, CurrentSurveyQuestion.Title, dr.Key)).Distinct.ToList()
    '                Dim FilteredQuestionsResponsesDistinct As New List(Of MultiTextBoxGroup)

    '                For Each mtg In FilteredQuestionsResponses
    '                    Dim FilterRecordMatch As MultiTextBoxGroup = (From dr In FilteredQuestionsResponsesDistinct Where dr.QuestionID = mtg.QuestionID AndAlso dr.CurrentResponseID = mtg.CurrentResponseID Select dr).FirstOrDefault()
    '                    If FilterRecordMatch Is Nothing Then FilteredQuestionsResponsesDistinct.Add(mtg)
    '                Next

    '                '# Now get each question within the response question
    '                For Each mtg In FilteredQuestionsResponsesDistinct
    '                    Dim MultiTextBoxAnswers = (From dr In QuestionsResponses Where dr.Key = mtg.CurrentResponseID AndAlso dr.Value.QuestionID = mtg.QuestionID Order By dr.Value.OptionID Select New MultiTextBoxValue(dr.Value.OptionID, GetOptionTitle(CurrentSurveyQuestion.Options, dr.Value.OptionID), dr.Value.AnswerValue)).ToList()
    '                    mtg.SetAnswerValues(MultiTextBoxAnswers)
    '                Next

    '                Dim OptionCount As Integer = 0
    '                For Each mtg In FilteredQuestionsResponsesDistinct

    '                    TableCell = New PdfPCell(New iTextSharp.text.Phrase(OptionCount + 1, Arial))
    '                    TableCell.Padding = 5
    '                    TableCell.BorderWidth = 0
    '                    If (OptionCount Mod 2) <> 0 Then TableCell.BackgroundColor = New iTextSharp.text.BaseColor(237, 237, 237)
    '                    MultiValuesTable.AddCell(TableCell)

    '                    TableCell = New PdfPCell(New iTextSharp.text.Phrase(mtg.CurrentResponseID, Arial))
    '                    TableCell.Padding = 5
    '                    TableCell.BorderWidth = 0
    '                    If (OptionCount Mod 2) <> 0 Then TableCell.BackgroundColor = New iTextSharp.text.BaseColor(237, 237, 237)
    '                    MultiValuesTable.AddCell(TableCell)

    '                    For Each av In mtg.AnswerValues
    '                        TableCell = New PdfPCell(New iTextSharp.text.Phrase(av.AnswerValue, Arial))
    '                        TableCell.Padding = 5
    '                        TableCell.BorderWidth = 0
    '                        If (OptionCount Mod 2) <> 0 Then TableCell.BackgroundColor = New iTextSharp.text.BaseColor(237, 237, 237)
    '                        MultiValuesTable.AddCell(TableCell)
    '                    Next

    '                    OptionCount += 1
    '                Next

    '                cell = New PdfPCell(MultiValuesTable)
    '                'cell.BackgroundColor = New BaseColor(224, 224, 224)
    '                cell.Padding = 0.0F
    '                cell.Colspan = 2
    '                cell.BorderWidth = 0

    '                Table.AddCell(cell)

    '            Case Else
    '                '# textbox, essay

    '                'Dim TextValuesTable = New PdfPTable(3)
    '                'TextValuesTable.SplitLate = True
    '                'TextValuesTable.DefaultCell.Border = 0.0F

    '                'Dim widths As Single() = New Single() {1, 1, 9.0F}
    '                'TextValuesTable.SetWidths(widths)

    '                'Dim TableWidth As Single = TextValuesTable.TotalWidth

    '                '# Answer Response
    '                Dim ResponseItems As List(Of SurveyResponse) = CurrentSurvey.Responses
    '                Dim QuestionsResponses As New List(Of KeyValuePair(Of Integer, SurveyResponseQuestion))

    '                For Each ri As SurveyResponse In ResponseItems
    '                    '# Get the questions from the responses that match the current survey question
    '                    For Each rq As SurveyResponseQuestion In ri.ResponseQuestions
    '                        If rq.QuestionID = CurrentSurveyQuestion.ID AndAlso Not String.IsNullOrEmpty(rq.AnswerValue) Then
    '                            Dim Result As New KeyValuePair(Of Integer, SurveyResponseQuestion)(ri.ResponseID, rq)
    '                            QuestionsResponses.Add(Result)
    '                        End If
    '                    Next
    '                Next

    '                Dim FilteredQuestionsResponses As New List(Of PlainTextValue)

    '                Select Case CurrentSurveyQuestion.SubType
    '                    Case "radio", "checkbox", "menu"
    '                        '# Filter to ones with answers
    '                        FilteredQuestionsResponses = (From dr In QuestionsResponses Where dr.Value.AnswerValue.Contains("Other") Select New PlainTextValue(dr.Value.QuestionID, CurrentSurveyQuestion.Title, dr.Value.AnswerValue.Replace("Other: ", ""), dr.Key)).ToList()
    '                    Case Else
    '                        '# Filter to ones with answers
    '                        FilteredQuestionsResponses = (From dr In QuestionsResponses Where String.IsNullOrEmpty(dr.Value.AnswerValue) = False Select New PlainTextValue(dr.Value.QuestionID, CurrentSurveyQuestion.Title, dr.Value.AnswerValue, dr.Key)).ToList()
    '                End Select

    '                If IncludeComments Then

    '                    '# Title Row
    '                    cell = New PdfPCell(New iTextSharp.text.Phrase("Result Set:", Arial))
    '                    cell.Padding = 5
    '                    cell.PaddingBottom = 8
    '                    cell.BorderWidth = 0
    '                    Table.AddCell(cell)

    '                    cell = New PdfPCell(New iTextSharp.text.Phrase("Response ID:", Arial))
    '                    cell.Padding = 5
    '                    cell.PaddingBottom = 8
    '                    cell.BorderWidth = 0
    '                    Table.AddCell(cell)

    '                    cell = New PdfPCell(New iTextSharp.text.Phrase("Answers:", Arial))
    '                    cell.Padding = 5
    '                    cell.PaddingBottom = 8
    '                    cell.BorderWidth = 0
    '                    Table.AddCell(cell)

    '                    Dim ResponsesOptionCount As Integer = 0
    '                    For Each FilteredQuestionsResponse In FilteredQuestionsResponses
    '                        With FilteredQuestionsResponse

    '                            cell = New PdfPCell(New iTextSharp.text.Phrase(ResponsesOptionCount + 1, Arial))
    '                            cell.Padding = 5
    '                            cell.BorderWidth = 0
    '                            If (ResponsesOptionCount Mod 2) <> 0 Then cell.BackgroundColor = New iTextSharp.text.BaseColor(237, 237, 237)
    '                            Table.AddCell(cell)

    '                            cell = New PdfPCell(New iTextSharp.text.Phrase(.CurrentResponseID, Arial))
    '                            cell.Padding = 5
    '                            cell.BorderWidth = 0
    '                            If (ResponsesOptionCount Mod 2) <> 0 Then cell.BackgroundColor = New iTextSharp.text.BaseColor(237, 237, 237)
    '                            Table.AddCell(cell)

    '                            cell = New PdfPCell(New iTextSharp.text.Phrase(.AnswerValue, Arial))
    '                            cell.Padding = 5
    '                            cell.BorderWidth = 0
    '                            If (ResponsesOptionCount Mod 2) <> 0 Then cell.BackgroundColor = New iTextSharp.text.BaseColor(237, 237, 237)
    '                            Table.AddCell(cell)

    '                            ResponsesOptionCount += 1
    '                        End With
    '                    Next

    '                End If

    '                'cell = New PdfPCell(TextValuesTable)
    '                ''cell.BackgroundColor = New BaseColor(224, 224, 224)
    '                'cell.Padding = 0.0F
    '                'cell.Colspan = 2
    '                'cell.BorderWidth = 0
    '                'Table.AddCell(cell)

    '                '# Total responses
    '                Table.AddCell(GetTotalValuesTitleCell("TOTAL RESPONSES", 3, 3))
    '                Table.AddCell(GetTotalValuesCell(FilteredQuestionsResponses.Count(), 3))

    '        End Select

    '        '# Divider
    '        cell = New PdfPCell()
    '        cell.Padding = 10
    '        cell.Colspan = TitleWidth
    '        cell.BorderWidth = 0.0F
    '        cell.BorderWidthBottom = 1.0F
    '        cell.BorderColorBottom = New iTextSharp.text.BaseColor(0, 70, 122)
    '        Table.AddCell(cell)

    '        Return Table

    '    End Function

    '    Public Shared Function GetTotalValuesTitleCell(Title As String, Optional TopPaddingAmount As Integer = 3, Optional Colspan As Integer = 1) As PdfPCell

    '        Dim ArialLargeBold As iTextSharp.text.Font = iTextSharp.text.FontFactory.GetFont(iTextSharp.text.FontFactory.HELVETICA_BOLD)
    '        ArialLargeBold.Size = 7
    '        ArialLargeBold.SetColor(21, 21, 21)

    '        Dim cell As PdfPCell = New PdfPCell(New iTextSharp.text.Phrase(Title, ArialLargeBold))
    '        cell.BackgroundColor = iTextSharp.text.BaseColor.WHITE
    '        cell.Padding = 5
    '        cell.PaddingTop = TopPaddingAmount
    '        cell.BorderWidth = 0.0F
    '        cell.Colspan = Colspan

    '        Return cell

    '    End Function

    '    Public Shared Function GetTotalValuesCell(ClickValue As Integer, Colspan As Integer, Optional TopPaddingAmount As Integer = 3) As PdfPCell

    '        Dim ArialLarge As iTextSharp.text.Font = iTextSharp.text.FontFactory.GetFont(iTextSharp.text.FontFactory.HELVETICA)
    '        ArialLarge.Size = 7
    '        ArialLarge.SetColor(21, 21, 21)

    '        Dim cell As PdfPCell = New PdfPCell(New iTextSharp.text.Phrase(ClickValue.ToString(), ArialLarge))
    '        cell.BackgroundColor = iTextSharp.text.BaseColor.WHITE
    '        cell.Padding = 5
    '        cell.Colspan = Colspan
    '        cell.PaddingTop = TopPaddingAmount
    '        cell.BorderWidth = 0.0F

    '        Return cell

    '    End Function

    '    Public Shared Function GetResponseValuesTable(CurrentSurvey As Survey, CurrentSurveyQuestion As SurveyQuestion, OptionID As String) As PdfPTable

    '        Dim Arial As iTextSharp.text.Font = iTextSharp.text.FontFactory.GetFont(iTextSharp.text.FontFactory.HELVETICA)
    '        Arial.Size = 7
    '        Arial.SetColor(21, 21, 21)

    '        '# View responses
    '        Dim ResponsesTable As PdfPTable = New PdfPTable(2)
    '        ResponsesTable.SplitLate = True

    '        '# Get responses
    '        Dim ResponseItems As List(Of SurveyResponse) = CurrentSurvey.Responses
    '        Dim QuestionsResponses As New List(Of KeyValuePair(Of Integer, SurveyResponseQuestion))

    '        For Each ri As SurveyResponse In ResponseItems
    '            '# Get the questions from the responses that match the current survey question
    '            For Each rq As SurveyResponseQuestion In ri.ResponseQuestions
    '                If rq.QuestionID = CurrentSurveyQuestion.ID AndAlso Not String.IsNullOrEmpty(rq.AnswerValue) Then
    '                    Dim Result As New KeyValuePair(Of Integer, SurveyResponseQuestion)(ri.ResponseID, rq)
    '                    QuestionsResponses.Add(Result)
    '                End If
    '            Next
    '        Next

    '        Dim FilteredQuestionsResponses = (From dr In QuestionsResponses Where dr.Value.AnswerValue.Contains("Other") AndAlso dr.Value.OptionID = OptionID Select AnswerValue = dr.Value.AnswerValue.Replace("Other: ", ""), CurrentResponseID = dr.Key).ToList()

    '        If FilteredQuestionsResponses IsNot Nothing AndAlso FilteredQuestionsResponses.Count > 0 Then

    '            '# Divider
    '            Dim cell As PdfPCell = New PdfPCell()
    '            cell.Padding = 2
    '            cell.Colspan = 2
    '            cell.BorderWidth = 0.0F
    '            cell.BorderWidthTop = 0.5F
    '            cell.BorderColorTop = New iTextSharp.text.BaseColor(0, 70, 122)
    '            ResponsesTable.AddCell(cell)

    '            '# Title Row
    '            cell = New PdfPCell(New iTextSharp.text.Phrase("Answers:", Arial))
    '            cell.Padding = 5
    '            cell.BorderWidth = 0
    '            ResponsesTable.AddCell(cell)

    '            cell = New PdfPCell(New iTextSharp.text.Phrase("Result Set:", Arial))
    '            cell.Padding = 5
    '            cell.BorderWidth = 0
    '            ResponsesTable.AddCell(cell)

    '            Dim ResponsesOptionCount As Integer = 0
    '            For Each FilteredQuestionsResponse In FilteredQuestionsResponses
    '                With FilteredQuestionsResponse
    '                    If Not String.IsNullOrEmpty(.AnswerValue) Then
    '                        cell = New PdfPCell(New iTextSharp.text.Phrase(.AnswerValue, Arial))
    '                        cell.Padding = 5
    '                        cell.BorderWidth = 0
    '                        If (ResponsesOptionCount Mod 2) <> 0 Then cell.BackgroundColor = New iTextSharp.text.BaseColor(237, 237, 237)
    '                        ResponsesTable.AddCell(cell)

    '                        cell = New PdfPCell(New iTextSharp.text.Phrase(.CurrentResponseID, Arial))
    '                        cell.Padding = 5
    '                        cell.BorderWidth = 0
    '                        If (ResponsesOptionCount Mod 2) <> 0 Then cell.BackgroundColor = New iTextSharp.text.BaseColor(237, 237, 237)
    '                        ResponsesTable.AddCell(cell)

    '                        ResponsesOptionCount += 1
    '                    End If
    '                End With
    '            Next

    '            '# Divider
    '            cell = New PdfPCell()
    '            cell.Padding = 2
    '            cell.Colspan = 2
    '            cell.BorderWidth = 0.0F
    '            cell.BorderWidthBottom = 0.5F
    '            cell.BorderColorBottom = New iTextSharp.text.BaseColor(0, 70, 122)
    '            ResponsesTable.AddCell(cell)

    '        End If

    '        Return ResponsesTable

    '    End Function

    '#Region "Formatting"
    '    Public Shared Function FormatExportDate(DateSubmitted As Date, Optional showtime As Boolean = False) As String
    '        Try
    '            Return GlobalMethods.FormatDateTime(DateSubmitted, "HH:mm d", True) & DateSubmitted.ToString(" MMM yyyy")
    '        Catch ex As Exception
    '            Return "empty"
    '        End Try
    '    End Function

    '    Public Shared Function FormatExportDateFilter(DateSubmitted As Date) As String
    '        Try
    '            Return GlobalMethods.FormatDateTime(DateSubmitted, " d", True) & DateSubmitted.ToString(" MMMM yyyy")
    '        Catch ex As Exception
    '            Return "empty"
    '        End Try
    '    End Function

    '    Public Shared Function GetOptionTitle(Options As List(Of SurveyOption), OptionID As String) As String
    '        Dim OptionTitle As String = (From dr In Options Where dr.ID = OptionID Select dr.Title).FirstOrDefault()
    '        If String.IsNullOrEmpty(OptionTitle) Then OptionTitle = "Question Answer"
    '        Return OptionTitle
    '    End Function
    '#End Region

    '#Region "Validation"
    '    Public Shared Sub CheckFolderExists(ByVal FolderPath As String)

    '        '# Check if we have a ~ in the folder path
    '        If Not FolderPath.StartsWith("~") Then FolderPath = "~" & FolderPath

    '        Try
    '            Dim di As New DirectoryInfo(HttpContext.Current.Server.MapPath(FolderPath))

    '            '# If we don't have the folder then create it
    '            If Not di.Exists Then di.Create()

    '        Catch ex As Exception
    '            Throw ex
    '        End Try

    '    End Sub

    '#End Region

    '#Region "Classes"
    '    Public Class PlainTextValue

    '#Region "QuestionID"
    '        Protected _QuestionID As String
    '        Public Property QuestionID As String
    '            Get
    '                Return _QuestionID
    '            End Get
    '            Set(value As String)
    '                _QuestionID = value
    '            End Set
    '        End Property
    '#End Region

    '#Region "QuestionTitle"
    '        Protected _QuestionTitle As String
    '        Public Property QuestionTitle As String
    '            Get
    '                Return _QuestionTitle
    '            End Get
    '            Set(value As String)
    '                _QuestionTitle = value
    '            End Set
    '        End Property
    '#End Region

    '#Region "AnswerValue"
    '        Protected _AnswerValue As String
    '        Public Property AnswerValue As String
    '            Get
    '                Return _AnswerValue
    '            End Get
    '            Set(value As String)
    '                _AnswerValue = value
    '            End Set
    '        End Property
    '#End Region

    '#Region "CurrentResponseID"
    '        Protected _CurrentResponseID As String
    '        Public Property CurrentResponseID As String
    '            Get
    '                Return _CurrentResponseID
    '            End Get
    '            Set(value As String)
    '                _CurrentResponseID = value
    '            End Set
    '        End Property
    '#End Region

    '        Public Sub New(QuestionID As String, QuestionTitle As String, AnswerValue As String, CurrentResponseID As String)

    '            _QuestionID = QuestionID
    '            _QuestionTitle = QuestionTitle
    '            _AnswerValue = AnswerValue
    '            _CurrentResponseID = CurrentResponseID

    '        End Sub

    '    End Class

    '    Public Class MultiTextBoxGroup

    '#Region "QuestionID"
    '        Protected _QuestionID As String
    '        Public Property QuestionID As String
    '            Get
    '                Return _QuestionID
    '            End Get
    '            Set(value As String)
    '                _QuestionID = value
    '            End Set
    '        End Property
    '#End Region

    '#Region "QuestionTitle"
    '        Protected _QuestionTitle As String
    '        Public Property QuestionTitle As String
    '            Get
    '                Return _QuestionTitle
    '            End Get
    '            Set(value As String)
    '                _QuestionTitle = value
    '            End Set
    '        End Property
    '#End Region

    '#Region "CurrentResponseID"
    '        Protected _CurrentResponseID As String
    '        Public Property CurrentResponseID As String
    '            Get
    '                Return _CurrentResponseID
    '            End Get
    '            Set(value As String)
    '                _CurrentResponseID = value
    '            End Set
    '        End Property
    '#End Region

    '#Region "AnswerValues"
    '        Protected _AnswerValues As List(Of MultiTextBoxValue)
    '        Public Property AnswerValues As List(Of MultiTextBoxValue)
    '            Get
    '                Return _AnswerValues
    '            End Get
    '            Set(value As List(Of MultiTextBoxValue))
    '                _AnswerValues = value
    '            End Set
    '        End Property
    '#End Region

    '        Public Sub New(QuestionID As String, QuestionTitle As String, CurrentResponseID As String, Optional AnswerValues As List(Of MultiTextBoxValue) = Nothing)
    '            _QuestionID = QuestionID
    '            _QuestionTitle = QuestionTitle
    '            _CurrentResponseID = CurrentResponseID
    '            _AnswerValues = AnswerValues
    '        End Sub

    '        Public Sub SetAnswerValues(AnswerValues As List(Of MultiTextBoxValue))
    '            _AnswerValues = AnswerValues
    '        End Sub

    '    End Class

    '    Public Class MultiTextBoxValue

    '#Region "OptionID"
    '        Protected _OptionID As String
    '        Public Property OptionID As String
    '            Get
    '                Return _OptionID
    '            End Get
    '            Set(value As String)
    '                _OptionID = value
    '            End Set
    '        End Property
    '#End Region

    '#Region "OptionTitle"
    '        Protected _OptionTitle As String
    '        Public Property OptionTitle As String
    '            Get
    '                Return _OptionTitle
    '            End Get
    '            Set(value As String)
    '                _OptionTitle = value
    '            End Set
    '        End Property
    '#End Region

    '#Region "AnswerValue"
    '        Protected _AnswerValue As String
    '        Public Property AnswerValue As String
    '            Get
    '                Return _AnswerValue
    '            End Get
    '            Set(value As String)
    '                _AnswerValue = value
    '            End Set
    '        End Property
    '#End Region

    '        Public Sub New(OptionID As String, OptionTitle As String, AnswerValue As String)
    '            _OptionID = OptionID
    '            _OptionTitle = OptionTitle
    '            _AnswerValue = AnswerValue
    '        End Sub

    '    End Class
    '#End Region

    '#End Region


    '    Public Class ExportFileBuilder

    '        Const RootFolderPath As String = "/App_Data/Exports/"

    '#Region "CurrentSurveyControl"
    '        Public Shared ReadOnly Property CurrentSurveyControl As SurveyControl
    '            Get
    '                If HttpContext.Current.Session("CurrentSurveyControl") Is Nothing Then HttpContext.Current.Session("CurrentSurveyControl") = New SurveyControl()

    '                '# Get the current survery control class
    '                Dim SurveyControl As SurveyControl = CType(HttpContext.Current.Session("CurrentSurveyControl"), SurveyControl)

    '                Return SurveyControl
    '            End Get
    '        End Property
    '#End Region

    '#Region "File Handing"
    '        Public Shared Sub ClearOldFiles(FileLocation As String)
    '            Try
    '                Dim ExportFileDirectory As DirectoryInfo = New DirectoryInfo(HttpContext.Current.Server.MapPath("~" & FileLocation))

    '                For Each fi As FileInfo In ExportFileDirectory.GetFiles()
    '                    fi.Delete()
    '                Next
    '            Catch ex As Exception
    '            End Try
    '        End Sub

    '        Private Const BUFFER_SIZE As Long = 4096

    '        Public Shared Sub ZipFiles(ZipFileName As String, FileLocation As String)
    '            Try
    '                Dim ExportFileDirectory As String = HttpContext.Current.Server.MapPath("~" & FileLocation)
    '                Dim fqFilenames As New List(Of String)(System.IO.Directory.GetFiles(ExportFileDirectory))
    '                Dim filenames As List(Of String) = fqFilenames.ConvertAll(Function(s) s.Replace(ExportFileDirectory & "\", ""))

    '                Dim filesToInclude As New System.Collections.Generic.List(Of String)()

    '                For Each filename As String In filenames
    '                    filesToInclude.Add(System.IO.Path.Combine(ExportFileDirectory, filename))
    '                Next

    '                HttpContext.Current.Response.Clear()
    '                HttpContext.Current.Response.BufferOutput = False

    '                Dim enc As Ionic.Zip.EncryptionAlgorithm = Ionic.Zip.EncryptionAlgorithm.None

    '                Dim archiveName As String = ZipFileName.Replace(".csv", "") & ".zip"
    '                HttpContext.Current.Response.ContentType = "application/zip"
    '                HttpContext.Current.Response.AddHeader("Content-Disposition", "inline; filename=" & Chr(34) & archiveName & Chr(34))

    '                Using zip As New Ionic.Zip.ZipFile()
    '                    zip.AddFiles(filesToInclude, "export")
    '                    zip.Save(HttpContext.Current.Response.OutputStream)
    '                End Using

    '                HttpContext.Current.Response.Close()

    '            Catch ex As Exception
    '            End Try
    '        End Sub

    '#End Region

    '#Region "Survey Export"
    '        Public Shared Function BuildSurveyExport(CurrentSurvey As Survey, SingleFile As Boolean) As KeyValuePair(Of Boolean, String)

    '            '# Create data set of tables containg the results of data is it appears in the survey results list (with filtering)
    '            '# Then save the data into a CSV & zip file(s)  - depending on the settings
    '            '# Show download link

    '            Dim ReturnResponse As New KeyValuePair(Of Boolean, String)(False, "New")

    '            Try
    '                If CurrentSurvey IsNot Nothing Then

    '                    '#########################
    '                    '# 1 - Get data
    '                    '#########################
    '                    Dim ResultsData = New DataSet()

    '                    '# Get max amount of response columns
    '                    Dim ResponseColumnCount As Integer = 2

    '                    Dim QuestionNumber As Integer = 1
    '                    For Each sq As SurveyQuestion In CurrentSurvey.Questions

    '                        Dim NumberQuestion As Boolean = IsNumberQuestion(QuestionNumber, CurrentSurvey.ID, sq)

    '                        Dim SubType As String = sq.SubType
    '                        If NumberQuestion Then SubType = "number"

    '                        '# Only for certain questions
    '                        If SubType = "rank" Then
    '                            If sq.Statistics IsNot Nothing Then
    '                                If CInt(sq.Statistics.Max()) > ResponseColumnCount Then
    '                                    ResponseColumnCount = CInt(sq.Statistics.Max())
    '                                End If
    '                            End If
    '                        ElseIf SubType = "table" Then
    '                            For Each sub_sq As SurveyQuestion In sq.SubQuestions
    '                                If sub_sq.Statistics IsNot Nothing Then
    '                                    If sub_sq.Options.Count() > ResponseColumnCount Then
    '                                        ResponseColumnCount = sub_sq.Options.Count()
    '                                    End If
    '                                End If
    '                            Next
    '                        ElseIf SubType = "multi_textbox" Then
    '                            If sq.Options IsNot Nothing Then
    '                                If CInt(sq.Options.Count()) > ResponseColumnCount Then
    '                                    ResponseColumnCount = CInt(sq.Options.Count())
    '                                End If
    '                            End If
    '                        End If

    '                        QuestionNumber += 1
    '                    Next

    '                    '# Get basic information
    '                    Dim BasicInformationTable As New DataTable("BasicInformationTable")

    '                    BasicInformationTable.Columns.Add("Question No.", GetType(String))
    '                    BasicInformationTable.Columns.Add("Title", GetType(String))

    '                    For i As Integer = 1 To ResponseColumnCount
    '                        BasicInformationTable.Columns.Add("Response" & i.ToString(), GetType(String))
    '                    Next

    '                    Dim BasicInformationRow As DataRow = BasicInformationTable.NewRow()

    '                    '# Set Totals
    '                    Dim TotalResponses As Integer = 0
    '                    Dim FilteredResponses As Integer = 0
    '                    Dim ExcludedResponses As Integer = 0

    '                    TotalResponses = CurrentSurveyControl.CurrentSurvey.AllResponses.Count()

    '                    'If TotalResponses <= 0 Then
    '                    '    For Each stat As KeyValuePair(Of String, String) In CurrentSurveyControl.UnfilteredSurvey.Statistics
    '                    '        If stat.Value = "Complete" Then
    '                    '            Int32.TryParse(stat.Value, TotalResponses)
    '                    '        End If
    '                    '    Next
    '                    'End If

    '                    '# Check for default
    '                    If CurrentSurveyControl.SurveyFilters.Count = 1 AndAlso CurrentSurveyControl.SurveyFilters(0).SurveyFilterType = SurveyFilterTypeEnum.Status AndAlso CurrentSurveyControl.SurveyFilters(0).FilterValue = "Deleted" Then
    '                        FilteredResponses = 0
    '                        ExcludedResponses = 0
    '                    Else
    '                        FilteredResponses = CurrentSurvey.Responses.Count()
    '                        ExcludedResponses = TotalResponses - FilteredResponses
    '                    End If

    '                    '# Created Time/Date
    '                    AddRowToTable(BasicInformationTable, "", "Created Time/Date:", FormatDate(CurrentSurvey.CreatedOn))

    '                    '# Modified Time/Date
    '                    AddRowToTable(BasicInformationTable, "", "Modified Time/Date:", FormatDate(CurrentSurvey.ModifiedOn))

    '                    '# Total Responses
    '                    AddRowToTable(BasicInformationTable, "", "Total Responses", TotalResponses.ToString())

    '                    '# Filtered Responses
    '                    AddRowToTable(BasicInformationTable, "", "Filtered Responses", FilteredResponses.ToString())

    '                    '# Responses Excluded
    '                    AddRowToTable(BasicInformationTable, "", "Responses Excluded", ExcludedResponses.ToString())

    '                    '# Survey Name
    '                    AddRowToTable(BasicInformationTable, "", "Survey Name", CurrentSurvey.Title)

    '                    '# Spacer
    '                    AddSpacerRowToTable(BasicInformationTable, ResponseColumnCount)

    '                    ResultsData.Tables.Add(BasicInformationTable)

    '                    '#########################
    '                    '# Get fiter information                     
    '                    '#########################
    '                    Dim FilterInformationTable As DataTable = GetFilterData(ResponseColumnCount)
    '                    If FilterInformationTable IsNot Nothing Then ResultsData.Tables.Add(FilterInformationTable)

    '                    '# Get question/response information
    '                    Dim QuestionResponsesTable As New DataTable("QuestionResponsesTable")
    '                    Dim QuestionResponsesRow As DataRow = QuestionResponsesTable.NewRow()

    '                    QuestionResponsesTable.Columns.Add("Question No.", GetType(String))
    '                    QuestionResponsesTable.Columns.Add("Title", GetType(String))

    '                    For i As Integer = 1 To ResponseColumnCount
    '                        QuestionResponsesTable.Columns.Add("Response" & i.ToString(), GetType(String))
    '                    Next

    '                    Dim QuestionCount As Integer = 1
    '                    For Each sq As SurveyQuestion In CurrentSurvey.Questions
    '                        If sq.Type = "SurveyQuestion" Then
    '                            '# Add question row
    '                            AddRowToTable(QuestionResponsesTable, QuestionCount.ToString(), sq.Title, "")

    '                            '# Get results
    '                            GetQuestionData(QuestionResponsesTable, CurrentSurvey, sq, ResponseColumnCount, QuestionCount)

    '                            '# Spacer
    '                            AddSpacerRowToTable(QuestionResponsesTable, ResponseColumnCount)

    '                            QuestionCount += 1
    '                        End If
    '                    Next

    '                    ResultsData.Tables.Add(QuestionResponsesTable)

    '                    '#########################
    '                    '# 2 - Save into file(s)
    '                    '#########################

    '                    '# Set file paths
    '                    Dim FinalFilePath As String = RootFolderPath & CurrentSurvey.ID.ToString() & "/"
    '                    Dim FileName As String = "results_" & Now.Year.ToString() & "_" & Now.Month.ToString() & "_" & Now.Day.ToString() & ".csv"

    '                    '# Check the folder exists- create folder if it doesn't
    '                    CheckFolderExists(FinalFilePath)

    '                    '# Remove old files
    '                    ClearOldFiles(FinalFilePath)

    '                    '# Generate complete CSV
    '                    Dim CSVLocation As String = ""
    '                    Try
    '                        Dim CSVBuilder As CSVBuilder = New CSVBuilder()
    '                        Dim FullPath As String = HttpContext.Current.Server.MapPath("~" & FinalFilePath)

    '                        CSVLocation = CSVBuilder.ConvertFromDataSet(ResultsData, FullPath, FileName)
    '                    Catch ex As Exception
    '                    End Try

    '                    '# Generate question CSV files - if required
    '                    If Not SingleFile Then
    '                        Dim MultiQuestionCount As Integer = 1
    '                        For Each sq As SurveyQuestion In CurrentSurvey.Questions
    '                            If sq.Type = "SurveyQuestion" Then

    '                                Try
    '                                    Dim MultiQuestionResponsesData As DataSet = ExportQuestionResponses(CurrentSurvey, sq, ResponseColumnCount, MultiQuestionCount)
    '                                    Dim CSVBuilder As CSVBuilder = New CSVBuilder()
    '                                    Dim FullPath As String = HttpContext.Current.Server.MapPath("~" & FinalFilePath)

    '                                    CSVBuilder.ConvertFromDataSet(MultiQuestionResponsesData, FullPath, "q_" & MultiQuestionCount.ToString() & ".csv")
    '                                Catch ex As Exception
    '                                End Try

    '                                MultiQuestionCount += 1
    '                            End If
    '                        Next
    '                    End If

    '                    '# Build Zip file
    '                    ZipFiles(FileName, FinalFilePath)

    '                    '# Open File
    '                    'HttpContext.Current.Response.ContentType = "text/csv"
    '                    'HttpContext.Current.Response.AddHeader("content-disposition", "attachment; filename=" & FileName)
    '                    'HttpContext.Current.Response.WriteFile(CSVLocation)
    '                    'HttpContext.Current.Response.End()

    '                Else
    '                    ReturnResponse = New KeyValuePair(Of Boolean, String)(False, "Problem creating export files - Current survey information is missing")
    '                End If

    '            Catch ex As Exception
    '                ReturnResponse = New KeyValuePair(Of Boolean, String)(False, "Problem creating export files - " & ex.Message)
    '            End Try

    '            '#########################
    '            '# 3 - Show return
    '            '#########################
    '            Return ReturnResponse

    '        End Function
    '#End Region

    '#Region "Questions"
    '        Public Shared Sub GetQuestionData(ByRef CurrentDataTable As DataTable, CurrentSurvey As Survey, CurrentSurveyQuestion As SurveyQuestion, ResponseColumnCount As Integer, QuestionNumber As Integer)

    '            If CurrentSurveyQuestion IsNot Nothing Then

    '                Dim sq As SurveyQuestion = CurrentSurveyQuestion
    '                Dim CurrentSurveyQuestionID As Integer = CInt(sq.ID)
    '                Dim Count As Integer = 0
    '                Dim TotalResponses As Integer = 0
    '                Dim TotalClicks As Integer = 0
    '                Dim NotAnswered As Integer = 0

    '                For Each ri As SurveyResponse In CurrentSurvey.Responses
    '                    Dim ResultList = (From dr In ri.ResponseQuestions Where dr.QuestionID = sq.ID AndAlso Not String.IsNullOrEmpty(dr.AnswerValue) Select dr).ToList()

    '                    If ResultList.Count > 0 Then
    '                        TotalResponses += 1
    '                        TotalClicks += ResultList.Count()
    '                    End If

    '                    Dim NotAnsweredResultList = (From dr In ri.ResponseQuestions Where dr.QuestionID = sq.ID AndAlso String.IsNullOrEmpty(dr.AnswerValue) Select dr).ToList()

    '                    If NotAnsweredResultList.Count > 0 Then
    '                        NotAnswered += 1
    '                    End If
    '                Next

    '                Dim NumberQuestion As Boolean = IsNumberQuestion(QuestionNumber, CurrentSurvey.ID, sq)

    '                Dim SubType As String = sq.SubType
    '                If NumberQuestion Then SubType = "number"

    '                Select Case SubType
    '                    Case "table"

    '                        '# Load options
    '                        Dim OptionList As New List(Of String)
    '                        For Each so As SurveyOption In sq.Options
    '                            OptionList.Add(so.Title)
    '                        Next

    '                        AddRowToTable(CurrentDataTable, "", "", ResponseColumnCount, OptionList)

    '                        '# Load Questions & Responses
    '                        Dim PercentageList As New List(Of String)
    '                        Dim ValueList As New List(Of String)
    '                        For Each sub_sq As SurveyQuestion In sq.SubQuestions

    '                            '# Clear values
    '                            PercentageList.Clear()
    '                            ValueList.Clear()

    '                            '# Calc temp total
    '                            For Each ri As SurveyResponse In CurrentSurvey.Responses
    '                                Dim ResultList = (From dr In ri.ResponseQuestions Where dr.QuestionID = sub_sq.ID AndAlso Not String.IsNullOrEmpty(dr.AnswerValue) Select dr).ToList()

    '                                If ResultList.Count > 0 Then
    '                                    TotalResponses += 1
    '                                    TotalClicks += ResultList.Count()
    '                                End If

    '                                Dim NotAnsweredResultList = (From dr In ri.ResponseQuestions Where dr.QuestionID = sub_sq.ID AndAlso String.IsNullOrEmpty(dr.AnswerValue) Select dr).ToList()

    '                                If NotAnsweredResultList.Count > 0 Then
    '                                    NotAnswered += 1
    '                                End If
    '                            Next

    '                            '# Get responses
    '                            If sub_sq IsNot Nothing Then

    '                                For Each sub_so As SurveyOption In sub_sq.Options

    '                                    Count = 0

    '                                    '# Survey responses
    '                                    Dim ResponseItems As List(Of SurveyResponse) = CurrentSurvey.Responses
    '                                    Dim QuestionsResponses As New List(Of SurveyResponseQuestion)
    '                                    For Each ri As SurveyResponse In ResponseItems

    '                                        Dim rqList = (From dr In ri.ResponseQuestions Where dr.QuestionID = sub_so.QuestionID AndAlso dr.AnswerValue = sub_so.Value Select dr).ToList()

    '                                        If rqList.Count() <= 0 AndAlso sub_so.Value.ToLower.Contains("other") Then

    '                                            Dim rqListID = (From dr In ri.ResponseQuestions Where dr.QuestionID = sub_so.QuestionID AndAlso dr.AnswerValue.ToLower.Contains("other") AndAlso dr.OptionID = sub_so.ID Select dr).ToList()

    '                                            Count += rqListID.Count()
    '                                            For Each rq As SurveyResponseQuestion In ri.ResponseQuestions
    '                                                If rq.OptionID = sub_so.ID Then
    '                                                    QuestionsResponses.Add(rq)
    '                                                End If
    '                                            Next
    '                                        End If

    '                                        Count += rqList.Count()
    '                                    Next

    '                                    Dim Percentage As Decimal = 0
    '                                    If TotalResponses > 0 Then Percentage = Math.Round(((100 / TotalResponses) * Count), 0)

    '                                    PercentageList.Add(Percentage.ToString() & "%")
    '                                    ValueList.Add(Count.ToString())

    '                                Next

    '                            End If

    '                            AddRowToTable(CurrentDataTable, "", sub_sq.Title, ResponseColumnCount, PercentageList)
    '                            AddRowToTable(CurrentDataTable, "", "", ResponseColumnCount, ValueList)
    '                        Next

    '                    Case "radio", "checkbox", "menu"
    '                        AddRowToTable(CurrentDataTable, "", "", "Responses", "Percent")

    '                        '# Get options/response
    '                        For Each so As SurveyOption In sq.Options
    '                            Count = 0

    '                            '# Survey responses
    '                            Dim ResponseItems As List(Of SurveyResponse) = CurrentSurvey.Responses
    '                            Dim QuestionsResponses As New List(Of SurveyResponseQuestion)
    '                            For Each ri As SurveyResponse In ResponseItems

    '                                Dim rqList = (From dr In ri.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.AnswerValue = so.Value Select dr).ToList()

    '                                If rqList.Count() <= 0 AndAlso so.Value.ToLower.Contains("other") Then

    '                                    Dim rqListID = (From dr In ri.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.AnswerValue.ToLower.Contains("other") AndAlso dr.OptionID = so.ID Select dr).ToList()

    '                                    Count += rqListID.Count()
    '                                    For Each rq As SurveyResponseQuestion In ri.ResponseQuestions
    '                                        If rq.OptionID = so.ID Then
    '                                            QuestionsResponses.Add(rq)
    '                                        End If
    '                                    Next
    '                                End If

    '                                Count += rqList.Count()
    '                            Next

    '                            Dim Percentage As Decimal = 0
    '                            If TotalResponses > 0 Then Percentage = Math.Round(((100 / TotalResponses) * Count), 1)

    '                            AddRowToTable(CurrentDataTable, "", so.Title, Count.ToString(), Percentage.ToString() & "%")
    '                        Next

    '                        '# Spacer
    '                        AddSpacerRowToTable(CurrentDataTable, ResponseColumnCount)

    '                        '# Totals
    '                        AddRowToTable(CurrentDataTable, "", "Total Clicks:", TotalClicks.ToString())
    '                        AddRowToTable(CurrentDataTable, "", "Total Responses:", TotalResponses.ToString())

    '                    Case "rank"

    '                        '# Load options
    '                        Dim OptionList As New List(Of String)
    '                        For i As Integer = 1 To CInt(sq.Statistics.Max())
    '                            OptionList.Add(i.ToString())
    '                        Next

    '                        AddRowToTable(CurrentDataTable, "", "", ResponseColumnCount, OptionList)

    '                        '# Load Responses
    '                        Dim PercentageList As New List(Of String)
    '                        Dim ValueList As New List(Of String)
    '                        For Each so As SurveyOption In sq.Options

    '                            '# Clear values
    '                            PercentageList.Clear()
    '                            ValueList.Clear()

    '                            Dim ResponseID As Integer = 0
    '                            Dim ResponseItems As List(Of SurveyResponse) = CurrentSurvey.Responses
    '                            Dim QuestionsResponses As New List(Of KeyValuePair(Of Integer, SurveyResponseQuestion))
    '                            For Each ri As SurveyResponse In ResponseItems
    '                                For Each rq As SurveyResponseQuestion In ri.ResponseQuestions
    '                                    If rq.QuestionID = CurrentSurveyQuestion.ID Then
    '                                        Dim Result As New KeyValuePair(Of Integer, SurveyResponseQuestion)(ri.ResponseID, rq)
    '                                        QuestionsResponses.Add(Result)
    '                                        ResponseID = ri.ResponseID
    '                                    End If
    '                                Next
    '                            Next

    '                            '# Filter to ones with answers
    '                            Dim FilteredQuestionsResponses = (From dr In QuestionsResponses Where dr.Value.OptionID = so.ID And String.IsNullOrEmpty(dr.Value.AnswerValue) = False Select dr.Value.QuestionID, dr.Value.AnswerValue, CurrentResponseID = dr.Key).ToList()

    '                            '# Load possible answers
    '                            If FilteredQuestionsResponses IsNot Nothing AndAlso FilteredQuestionsResponses.Count() > 0 Then
    '                                For i As Integer = 1 To CInt(CurrentSurveyQuestion.Statistics.Max)

    '                                    Dim ItemsRanked As Integer = (From dr In FilteredQuestionsResponses Where dr.AnswerValue = i.ToString() Select dr).Count()
    '                                    Dim ItemPercentage As Decimal = Math.Round(((100 / FilteredQuestionsResponses.Count()) * ItemsRanked), 0)

    '                                    PercentageList.Add(ItemPercentage.ToString() & "%")
    '                                    ValueList.Add(ItemsRanked)
    '                                Next
    '                            End If

    '                            AddRowToTable(CurrentDataTable, "", so.Title, ResponseColumnCount, PercentageList)
    '                            AddRowToTable(CurrentDataTable, "", "", ResponseColumnCount, ValueList)
    '                        Next

    '                    Case "multi_textbox"

    '                        '# Load options
    '                        Dim OptionList As New List(Of String)
    '                        For Each so As SurveyOption In sq.Options()
    '                            OptionList.Add(so.Value)
    '                        Next

    '                        AddRowToTable(CurrentDataTable, "", "", ResponseColumnCount, OptionList)

    '                        Dim ResponseItems As List(Of SurveyResponse) = CurrentSurvey.Responses
    '                        Dim QuestionsResponses As New List(Of KeyValuePair(Of Integer, SurveyResponseQuestion))

    '                        For Each ri As SurveyResponse In ResponseItems
    '                            '# Get the questions from the responses that match the current survey question
    '                            For Each rq As SurveyResponseQuestion In ri.ResponseQuestions
    '                                If rq.QuestionID = sq.ID Then
    '                                    Dim Result As New KeyValuePair(Of Integer, SurveyResponseQuestion)(ri.ResponseID, rq)
    '                                    QuestionsResponses.Add(Result)
    '                                End If
    '                            Next
    '                        Next

    '                        '# Filter out the responses
    '                        Dim FilteredQuestionsResponses = (From dr In QuestionsResponses Where String.IsNullOrEmpty(dr.Value.AnswerValue) = False Select New MultiTextBoxGroup(dr.Value.QuestionID, CurrentSurveyQuestion.Title, dr.Key)).Distinct.ToList()
    '                        Dim FilteredQuestionsResponsesDistinct As New List(Of MultiTextBoxGroup)

    '                        For Each mtg In FilteredQuestionsResponses
    '                            Dim FilterRecordMatch As MultiTextBoxGroup = (From dr In FilteredQuestionsResponsesDistinct Where dr.QuestionID = mtg.QuestionID AndAlso dr.CurrentResponseID = mtg.CurrentResponseID Select dr).FirstOrDefault()
    '                            If FilterRecordMatch Is Nothing Then FilteredQuestionsResponsesDistinct.Add(mtg)
    '                        Next

    '                        '# Now get each question within the response question
    '                        For Each mtg In FilteredQuestionsResponsesDistinct
    '                            Dim MultiTextBoxAnswers = (From dr In QuestionsResponses Where dr.Key = mtg.CurrentResponseID AndAlso dr.Value.QuestionID = mtg.QuestionID Order By dr.Value.OptionID Select New MultiTextBoxValue(dr.Value.OptionID, GetOptionTitle(sq.Options, dr.Value.OptionID), dr.Value.AnswerValue)).ToList()
    '                            mtg.SetAnswerValues(MultiTextBoxAnswers)
    '                        Next

    '                        For Each mtbg As MultiTextBoxGroup In FilteredQuestionsResponsesDistinct

    '                            Dim MultiTextBoxValueList As New List(Of String)
    '                            For Each mtbv As MultiTextBoxValue In mtbg.AnswerValues
    '                                MultiTextBoxValueList.Add(mtbv.AnswerValue)
    '                            Next
    '                            AddRowToTable(CurrentDataTable, "", "", ResponseColumnCount, MultiTextBoxValueList)
    '                        Next

    '                    Case Else

    '                        Dim QuestionsResponses As New List(Of KeyValuePair(Of Integer, SurveyResponseQuestion))
    '                        For Each ri As SurveyResponse In CurrentSurvey.Responses
    '                            For Each rq As SurveyResponseQuestion In ri.ResponseQuestions
    '                                If rq.QuestionID = sq.ID AndAlso Not String.IsNullOrEmpty(rq.AnswerValue) Then
    '                                    Dim Result As New KeyValuePair(Of Integer, SurveyResponseQuestion)(ri.ResponseID, rq)
    '                                    QuestionsResponses.Add(Result)
    '                                End If
    '                            Next
    '                        Next

    '                        If QuestionsResponses IsNot Nothing AndAlso QuestionsResponses.Count > 0 Then

    '                            '# Filter to ones with answers
    '                            Dim FilteredQuestionsResponses = (From dr In QuestionsResponses Where String.IsNullOrEmpty(dr.Value.AnswerValue) = False Select dr.Value.QuestionID, CurrentSurveyQuestion.Title, dr.Value.AnswerValue, dr.Key).ToList()

    '                            '# Not Answered count
    '                            Dim QuestionsResponsesUnanswered = (From dr In QuestionsResponses Where String.IsNullOrEmpty(dr.Value.AnswerValue) = True Select dr.Value.QuestionID).Count()

    '                            '# Totals
    '                            AddRowToTable(CurrentDataTable, "", "Total Responses:", FilteredQuestionsResponses.Count())
    '                            AddRowToTable(CurrentDataTable, "", "Not answered:", QuestionsResponsesUnanswered)

    '                            '# Spacer
    '                            AddSpacerRowToTable(CurrentDataTable, ResponseColumnCount)
    '                            AddRowToTable(CurrentDataTable, "", "----------------------", "")

    '                            '# Responses
    '                            For Each fi In FilteredQuestionsResponses
    '                                AddRowToTable(CurrentDataTable, "", fi.Key, fi.AnswerValue)
    '                            Next
    '                        Else
    '                            AddRowToTable(CurrentDataTable, "", "No results", "")
    '                        End If

    '                End Select

    '            End If

    '        End Sub

    '        Public Shared Function ExportQuestionResponses(CurrentSurvey As Survey, CurrentSurveyQuestion As SurveyQuestion, ResponseColumnCount As Integer, QuestionCount As Integer) As DataSet

    '            Dim ResultsData = New DataSet()

    '            '##################################################
    '            '# Get fiter information - if set to show
    '            '##################################################
    '            Dim FilterInformationTable As DataTable = GetFilterData(ResponseColumnCount)
    '            If FilterInformationTable IsNot Nothing Then ResultsData.Tables.Add(FilterInformationTable)

    '            '# Get question/response information
    '            Dim QuestionResponsesTable As New DataTable("QuestionResponsesTable")
    '            Dim QuestionResponsesRow As DataRow = QuestionResponsesTable.NewRow()

    '            QuestionResponsesTable.Columns.Add("Question No.", GetType(String))
    '            QuestionResponsesTable.Columns.Add("Title", GetType(String))

    '            For i As Integer = 1 To ResponseColumnCount
    '                QuestionResponsesTable.Columns.Add("Response" & i.ToString(), GetType(String))
    '            Next

    '            '# Add question row
    '            AddRowToTable(QuestionResponsesTable, QuestionCount.ToString(), CurrentSurveyQuestion.Title, "")

    '            '# Get results
    '            GetQuestionData(QuestionResponsesTable, CurrentSurvey, CurrentSurveyQuestion, ResponseColumnCount, QuestionCount)

    '            '# Spacer
    '            AddSpacerRowToTable(QuestionResponsesTable, ResponseColumnCount)

    '            QuestionCount += 1

    '            ResultsData.Tables.Add(QuestionResponsesTable)

    '            Return ResultsData

    '        End Function
    '#End Region

    '#Region "Responses Export"
    '        Public Shared Function BuildResponsesExport(CurrentSurvey As Survey) As KeyValuePair(Of Boolean, String)

    '            '# Create data set of tables containg the results of data is it appears in the survey results list (with filtering)
    '            '# Then save the data into a CSV & zip file(s)  - depending on the settings
    '            '# Show download link

    '            Dim ReturnResponse As New KeyValuePair(Of Boolean, String)(False, "New")

    '            Try
    '                If CurrentSurvey IsNot Nothing Then

    '                    '#########################
    '                    '# 1 - Get data
    '                    '#########################
    '                    Dim ResultsData = New DataSet()

    '                    '# Get amount of response columns => amount of questions + response ID/Status/Date Completed
    '                    Dim ResponseColumnCount As Integer = CurrentSurvey.Questions.Count() + 3

    '                    '# Table for data
    '                    Dim ResponseInformationTable As New DataTable("ResponseInformationTable")
    '                    Dim ResponseHeadersRow As DataRow = ResponseInformationTable.NewRow()

    '                    ResponseInformationTable.Columns.Add("Response ID", GetType(String))
    '                    ResponseHeadersRow(0) = "Response ID"
    '                    ResponseInformationTable.Columns.Add("Status", GetType(String))
    '                    ResponseHeadersRow(1) = "Status"
    '                    ResponseInformationTable.Columns.Add("Completed Date", GetType(String))
    '                    ResponseHeadersRow(2) = "Completed Date"

    '                    Dim Count As Integer = 1
    '                    Dim QuestionNumber As Integer = 1
    '                    For Each sq As SurveyQuestion In CurrentSurvey.Questions
    '                        If sq.Type = "SurveyQuestion" Then

    '                            Dim NumberQuestion As Boolean = IsNumberQuestion(QuestionNumber, CurrentSurvey.ID, sq)

    '                            Dim SubType As String = sq.SubType
    '                            If NumberQuestion Then SubType = "number"

    '                            Select Case SubType
    '                                Case "table"
    '                                    For Each subq As SurveyQuestion In sq.SubQuestions
    '                                        ResponseInformationTable.Columns.Add(Count.ToString() & ". " & GlobalMethods.StripHTML(subq.Title), GetType(String))
    '                                        ResponseHeadersRow(Count + 2) = Count.ToString() & ". " & GlobalMethods.StripHTML(subq.Title)
    '                                        Count += 1
    '                                    Next
    '                                Case "checkbox"

    '                                    For Each so As SurveyOption In sq.Options
    '                                        ResponseInformationTable.Columns.Add(Count.ToString() & ". " & GlobalMethods.StripHTML(sq.Title) & " - " & GlobalMethods.StripHTML(so.Title), GetType(String))
    '                                        ResponseHeadersRow(Count + 2) = Count.ToString() & ". " & GlobalMethods.StripHTML(sq.Title) & " - " & GlobalMethods.StripHTML(so.Title)
    '                                        Count += 1
    '                                    Next

    '                                Case "radio", "menu", "rank"
    '                                    ResponseInformationTable.Columns.Add(Count.ToString() & ". " & GlobalMethods.StripHTML(sq.Title), GetType(String))
    '                                    ResponseHeadersRow(Count + 2) = Count.ToString() & ". " & GlobalMethods.StripHTML(sq.Title)
    '                                    Count += 1

    '                                Case "multi_textbox"
    '                                    For Each so As SurveyOption In sq.Options
    '                                        ResponseInformationTable.Columns.Add(Count.ToString() & ". " & GlobalMethods.StripHTML(sq.Title) & " " & GlobalMethods.StripHTML(so.Value), GetType(String))
    '                                        ResponseHeadersRow(Count + 2) = Count.ToString() & ". " & GlobalMethods.StripHTML(sq.Title) & " " & GlobalMethods.StripHTML(so.Value)
    '                                        Count += 1
    '                                    Next

    '                                Case Else
    '                                    ResponseInformationTable.Columns.Add(Count.ToString() & ". " & GlobalMethods.StripHTML(sq.Title), GetType(String))
    '                                    ResponseHeadersRow(Count + 2) = Count.ToString() & ". " & GlobalMethods.StripHTML(sq.Title)
    '                                    Count += 1
    '                            End Select

    '                        End If

    '                        QuestionNumber += 1
    '                    Next

    '                    ResponseInformationTable.Rows.Add(ResponseHeadersRow)

    '                    '# Add rows of data to the table
    '                    For Each sr As SurveyResponse In CurrentSurvey.Responses
    '                        With sr
    '                            Dim CurrentDataRow As DataRow = ResponseInformationTable.NewRow()

    '                            '# Response Data
    '                            CurrentDataRow("Response ID") = sr.ResponseID
    '                            CurrentDataRow("Status") = GlobalMethods.StripHTML(sr.Status)
    '                            CurrentDataRow("Completed Date") = FormatDateSimple(sr.DateSubmitted)

    '                            '# Questions
    '                            Dim QuestionCount As Integer = 1
    '                            Dim QuestionNumberCount As Integer = 1
    '                            For Each sq As SurveyQuestion In CurrentSurvey.Questions
    '                                If sq.Type = "SurveyQuestion" Then

    '                                    Dim RowColumnName As String = ""
    '                                    Dim AnswerValue As String = ""
    '                                    Dim MatchingResponseQuestion As SurveyResponseQuestion = Nothing

    '                                    Dim NumberQuestion As Boolean = IsNumberQuestion(QuestionNumber, CurrentSurvey.ID, sq)

    '                                    Dim SubType As String = sq.SubType
    '                                    If NumberQuestion Then SubType = "number"

    '                                    Select Case SubType
    '                                        Case "table"
    '                                            For Each subq As SurveyQuestion In sq.SubQuestions

    '                                                RowColumnName = QuestionCount.ToString() & ". " & GlobalMethods.StripHTML(subq.Title)

    '                                                MatchingResponseQuestion = (From dr In sr.ResponseQuestions Where dr.QuestionID = subq.ID AndAlso Not String.IsNullOrEmpty(dr.AnswerValue) Select dr).FirstOrDefault()
    '                                                If MatchingResponseQuestion IsNot Nothing Then AnswerValue = MatchingResponseQuestion.AnswerValue

    '                                                '# Add data
    '                                                AddDataToRow(CurrentDataRow, RowColumnName, AnswerValue)
    '                                                QuestionCount += 1
    '                                                AnswerValue = ""

    '                                            Next
    '                                        Case "checkbox"

    '                                            For Each so As SurveyOption In sq.Options

    '                                                RowColumnName = QuestionCount.ToString() & ". " & GlobalMethods.StripHTML(sq.Title) & " - " & GlobalMethods.StripHTML(so.Title)

    '                                                MatchingResponseQuestion = (From dr In sr.ResponseQuestions Where dr.QuestionID = sq.ID AndAlso dr.OptionID = so.ID Select dr).FirstOrDefault()
    '                                                If MatchingResponseQuestion IsNot Nothing Then AnswerValue = MatchingResponseQuestion.AnswerValue

    '                                                '# Add data
    '                                                AddDataToRow(CurrentDataRow, RowColumnName, AnswerValue)

    '                                                QuestionCount += 1

    '                                                AnswerValue = ""

    '                                            Next

    '                                        Case "radio", "menu", "rank"

    '                                            RowColumnName = QuestionCount.ToString() & ". " & GlobalMethods.StripHTML(sq.Title)

    '                                            MatchingResponseQuestion = (From dr In sr.ResponseQuestions Where dr.QuestionID = sq.ID AndAlso Not String.IsNullOrEmpty(dr.AnswerValue) Select dr).FirstOrDefault()
    '                                            If MatchingResponseQuestion IsNot Nothing Then AnswerValue = MatchingResponseQuestion.AnswerValue

    '                                            '# Add data
    '                                            AddDataToRow(CurrentDataRow, RowColumnName, AnswerValue)
    '                                            QuestionCount += 1
    '                                            AnswerValue = ""

    '                                        Case "multi_textbox"

    '                                            For Each so As SurveyOption In sq.Options

    '                                                RowColumnName = QuestionCount.ToString() & ". " & GlobalMethods.StripHTML(sq.Title) & " " & GlobalMethods.StripHTML(so.Value)

    '                                                MatchingResponseQuestion = (From dr In sr.ResponseQuestions Where dr.QuestionID = sq.ID AndAlso dr.OptionID = so.ID Select dr).FirstOrDefault()

    '                                                AnswerValue = MatchingResponseQuestion.AnswerValue

    '                                                '# Add data
    '                                                AddDataToRow(CurrentDataRow, RowColumnName, AnswerValue)
    '                                                QuestionCount += 1
    '                                                AnswerValue = ""

    '                                            Next

    '                                        Case Else

    '                                            RowColumnName = QuestionCount.ToString() & ". " & GlobalMethods.StripHTML(sq.Title)

    '                                            MatchingResponseQuestion = (From dr In sr.ResponseQuestions Where dr.QuestionID = sq.ID Select dr).FirstOrDefault()
    '                                            If MatchingResponseQuestion IsNot Nothing Then AnswerValue = MatchingResponseQuestion.AnswerValue

    '                                            '# Add data
    '                                            AddDataToRow(CurrentDataRow, RowColumnName, AnswerValue)
    '                                            QuestionCount += 1
    '                                            AnswerValue = ""

    '                                    End Select

    '                                End If

    '                                QuestionNumberCount += 1
    '                            Next

    '                            ResponseInformationTable.Rows.Add(CurrentDataRow)
    '                        End With
    '                    Next

    '                    ResultsData.Tables.Add(ResponseInformationTable)

    '                    '#########################
    '                    '# 2 - Save into file(s)
    '                    '#########################

    '                    '# Set file paths
    '                    Dim FinalFilePath As String = RootFolderPath & CurrentSurvey.ID.ToString() & "/"
    '                    Dim FileName As String = "responses_" & Now.Year.ToString() & "_" & Now.Month.ToString() & "_" & Now.Day.ToString() & ".csv"

    '                    '# Check the folder exists- create folder if it doesn't
    '                    CheckFolderExists(FinalFilePath)

    '                    '# Remove old files
    '                    ClearOldFiles(FinalFilePath)

    '                    '# Generate complete CSV
    '                    Dim CSVLocation As String = ""
    '                    Try
    '                        Dim CSVBuilder As CSVBuilder = New CSVBuilder()
    '                        Dim FullPath As String = HttpContext.Current.Server.MapPath("~" & FinalFilePath)

    '                        CSVLocation = CSVBuilder.ConvertFromDataSet(ResultsData, FullPath, FileName)
    '                    Catch ex As Exception
    '                    End Try

    '                    '# Build Zip file
    '                    ZipFiles(FileName, FinalFilePath)

    '                Else
    '                    ReturnResponse = New KeyValuePair(Of Boolean, String)(False, "Problem creating export files - Current survey information is missing")
    '                End If

    '            Catch ex As Exception
    '                ReturnResponse = New KeyValuePair(Of Boolean, String)(False, "Problem creating export files - " & ex.Message)
    '            End Try

    '            '#########################
    '            '# 3 - Show return
    '            '#########################
    '            Return ReturnResponse

    '        End Function
    '#End Region

    '#Region "Filters"
    '        Public Shared Function GetFilterData(ResponseColumnCount As Integer) As DataTable

    '            If CurrentSurveyControl IsNot Nothing AndAlso CurrentSurveyControl.SurveyFilters IsNot Nothing AndAlso CurrentSurveyControl.SurveyFilters.Count > 0 Then

    '                Dim FilterInformationTable As New DataTable("FilterInformationTable")

    '                FilterInformationTable.Columns.Add("Question No.", GetType(String))
    '                FilterInformationTable.Columns.Add("Title", GetType(String))

    '                For i As Integer = 1 To ResponseColumnCount
    '                    FilterInformationTable.Columns.Add("Response" & i.ToString(), GetType(String))
    '                Next

    '                '# Add filter information
    '                AddRowToTable(FilterInformationTable, "", "Filters Applied", "")

    '                For Each sf As SurveyFilter In CurrentSurveyControl.SurveyFilters

    '                    Select Case sf.SurveyFilterType

    '                        Case SurveyFilterTypeEnum.Status
    '                            Select Case sf.FilterValue
    '                                Case "Complete"
    '                                    AddRowToTable(FilterInformationTable, "", "Status:", "Fully-Completed")
    '                                Case "Partial"
    '                                    AddRowToTable(FilterInformationTable, "", "Status:", "Part-Completed")
    '                                Case Else
    '                                    AddRowToTable(FilterInformationTable, "", "Status:", "Fully & Part-Completed")
    '                            End Select
    '                        Case SurveyFilterTypeEnum.DateBefore

    '                            '# Get values
    '                            Dim DateStr As String = sf.FilterValue.Replace("+", " ")
    '                            Dim RealDate As New Date

    '                            '# Check this is a valid date
    '                            Dim DateOK As Boolean = Date.TryParse(DateStr, RealDate)

    '                            If DateOK Then
    '                                AddRowToTable(FilterInformationTable, "", "Responses Before:", RealDate.ToString("dd/MM/yyyy HH:mm tt"))
    '                            End If

    '                        Case SurveyFilterTypeEnum.DateAfter

    '                            '# Get values
    '                            Dim DateStr As String = sf.FilterValue.Replace("+", " ")
    '                            Dim RealDate As New Date

    '                            '# Check this is a valid date
    '                            Dim DateOK As Boolean = Date.TryParse(DateStr, RealDate)

    '                            If DateOK Then
    '                                AddRowToTable(FilterInformationTable, "", "Responses After:", RealDate.ToString("dd/MM/yyyy HH:mm tt"))
    '                            End If

    '                        Case SurveyFilterTypeEnum.CustomDataText
    '                            AddRowToTable(FilterInformationTable, "", "Answers containing:", sf.FilterValue)
    '                        Case SurveyFilterTypeEnum.QuestionFilter
    '                            AddRowToTable(FilterInformationTable, "", "QuestionFilter:", "QUESTION " & sf.QuestionIndex.ToString() & ": " & sf.QuestionTitle & " -  ANSWER: " & sf.QuestionOptionTitle)
    '                    End Select
    '                Next

    '                '# Spacer
    '                AddSpacerRowToTable(FilterInformationTable, ResponseColumnCount)

    '                Return FilterInformationTable
    '            Else
    '                Return Nothing
    '            End If

    '        End Function
    '#End Region

    '#Region "Table Functions"
    '        Public Shared Sub AddRowToTable(ByRef CurrentDataTable As DataTable, ColumnOneValue As String, ColumnTwoValue As String, ColumnThreeValue As String)
    '            Dim CurrentDataRow As DataRow = CurrentDataTable.NewRow()
    '            CurrentDataRow("Question No.") = ColumnOneValue
    '            CurrentDataRow("Title") = GlobalMethods.StripHTML(ColumnTwoValue)
    '            CurrentDataRow("Response1") = ColumnThreeValue
    '            CurrentDataTable.Rows.Add(CurrentDataRow)
    '        End Sub

    '        Public Shared Sub AddRowToTable(ByRef CurrentDataTable As DataTable, ColumnOneValue As String, ColumnTwoValue As String, ColumnThreeValue As String, ColumnFourValue As String)
    '            Dim CurrentDataRow As DataRow = CurrentDataTable.NewRow()
    '            CurrentDataRow("Question No.") = ColumnOneValue
    '            CurrentDataRow("Title") = GlobalMethods.StripHTML(ColumnTwoValue)
    '            CurrentDataRow("Response1") = ColumnThreeValue
    '            CurrentDataRow("Response2") = ColumnFourValue
    '            CurrentDataTable.Rows.Add(CurrentDataRow)
    '        End Sub

    '        Public Shared Sub AddRowToTable(ByRef CurrentDataTable As DataTable, ColumnOneValue As String, ColumnTwoValue As String, ResponseColumnCount As Integer, ResponseList As List(Of String))
    '            Dim CurrentDataRow As DataRow = CurrentDataTable.NewRow()
    '            CurrentDataRow("Question No.") = ColumnOneValue
    '            CurrentDataRow("Title") = GlobalMethods.StripHTML(ColumnTwoValue)

    '            For i As Integer = 1 To ResponseColumnCount
    '                If i <= ResponseList.Count() Then
    '                    CurrentDataRow("Response" & i.ToString()) = ResponseList(i - 1)
    '                End If
    '            Next

    '            CurrentDataTable.Rows.Add(CurrentDataRow)
    '        End Sub

    '        Public Shared Sub AddSpacerRowToTable(ByRef CurrentDataTable As DataTable, ResponseColumnCount As Integer)
    '            Dim CurrentDataRow As DataRow = CurrentDataTable.NewRow()
    '            CurrentDataRow("Question No.") = ""
    '            CurrentDataRow("Title") = ""

    '            For i As Integer = 1 To ResponseColumnCount
    '                CurrentDataRow("Response" & i.ToString()) = ""
    '            Next
    '            CurrentDataTable.Rows.Add(CurrentDataRow)
    '        End Sub

    '        Public Shared Sub AddDataToRow(ByRef CurrentDataRow As DataRow, DataRowColumnName As String, Value As String)
    '            Try
    '                CurrentDataRow(DataRowColumnName) = Value
    '            Catch ex As Exception
    '                Dim x = 1
    '            End Try
    '        End Sub
    '#End Region

    '#Region "General Formatting and Functions"
    '        Public Shared Function FormatDate(InDate As Date) As String
    '            Return InDate.ToString("HH:mm d") & GlobalMethods.GetDateSuffix(InDate.Day).ToLower() & " " & InDate.ToString("MMM yyyy")
    '        End Function

    '        Public Shared Function FormatDateSimple(InDate As Date) As String
    '            Return InDate.ToString("dd/MM/yyyy HH:mm")
    '        End Function

    '        Public Shared Sub CheckFolderExists(ByVal FolderPath As String)

    '            '# Check if we have a ~ in the folder path
    '            If Not FolderPath.StartsWith("~") Then FolderPath = "~" & FolderPath

    '            Try
    '                Dim di As New DirectoryInfo(HttpContext.Current.Server.MapPath(FolderPath))

    '                '# If we don't have the folder then create it
    '                If Not di.Exists Then di.Create()

    '            Catch ex As Exception
    '                Throw ex
    '            End Try

    '        End Sub

    '        Public Shared Function IsNumberQuestion(QuestionNumber As Integer, CurrentSurveyID As Integer, CurrentSurveyQuestion As SurveyQuestion) As Boolean

    '            '# Check for Number questions
    '            Dim NumberQuestion As Boolean = False

    '            If CurrentSurveyID = "1541759" Then
    '                '# The 2014 RICS and Macdonald & Company UK Rewards and Attitudes Survey
    '                If QuestionNumber = 15 OrElse QuestionNumber = 16 OrElse QuestionNumber = 17 OrElse QuestionNumber = 20 OrElse QuestionNumber = 22 Then
    '                    NumberQuestion = True
    '                End If
    '            ElseIf CurrentSurveyID = "1541763" Then
    '                '# The 2014 RICS and Macdonald &amp; Company Middle East Rewards and Attitudes Survey
    '                If QuestionNumber = 17 OrElse QuestionNumber = 18 OrElse QuestionNumber = 19 OrElse QuestionNumber = 22 OrElse QuestionNumber = 24 Then
    '                    NumberQuestion = True
    '                End If
    '            ElseIf CurrentSurveyID = "1541784" Then
    '                '# The 2014 RICS and Macdonald &amp; Company Europe Rewards and Attitudes Survey
    '                If QuestionNumber = 15 OrElse QuestionNumber = 16 OrElse QuestionNumber = 17 OrElse QuestionNumber = 20 OrElse QuestionNumber = 22 Then
    '                    NumberQuestion = True
    '                End If
    '            ElseIf CurrentSurveyID = "1562646" Then
    '                '# The 2014 RICS and Macdonald &amp; Company Asia Rewards and Attitudes Survey
    '                If QuestionNumber = 19 OrElse QuestionNumber = 21 OrElse QuestionNumber = 22 OrElse QuestionNumber = 25 OrElse QuestionNumber = 27 Then
    '                    NumberQuestion = True
    '                End If
    '            Else
    '                '# Loop through properties to find the map_key
    '                For Each p In CurrentSurveyQuestion.Properties
    '                    If p.Key = "map_key" Then
    '                        If Not String.IsNullOrEmpty(p.Value) Then
    '                            If p.Value.ToLower() = "number" Then
    '                                NumberQuestion = True
    '                                Exit For
    '                            End If
    '                        End If
    '                    End If
    '                Next
    '            End If

    '        End Function

    '#End Region

    '    End Class

    '    Public Class ExportFileBuilder1

    '        Const RootFolderPath As String = "/App_Data/Exports/"

    '#Region "CurrentSurveyControl"
    '        Public Shared ReadOnly Property CurrentSurveyControl As SurveyControl
    '            Get
    '                If HttpContext.Current.Session("CurrentSurveyControl") Is Nothing Then HttpContext.Current.Session("CurrentSurveyControl") = New SurveyControl()

    '                '# Get the current survery control class
    '                Dim SurveyControl As SurveyControl = CType(HttpContext.Current.Session("CurrentSurveyControl"), SurveyControl)

    '                Return SurveyControl
    '            End Get
    '        End Property
    '#End Region

    '#Region "File Handing"
    '        Public Shared Sub ClearOldFiles(FileLocation As String)
    '            Try
    '                Dim ExportFileDirectory As DirectoryInfo = New DirectoryInfo(HttpContext.Current.Server.MapPath("~" & FileLocation))

    '                For Each fi As FileInfo In ExportFileDirectory.GetFiles()
    '                    fi.Delete()
    '                Next
    '            Catch ex As Exception
    '            End Try
    '        End Sub

    '        Private Const BUFFER_SIZE As Long = 4096

    '        Public Shared Sub ZipFiles(ZipFileName As String, FileLocation As String)
    '            Try
    '                Dim ExportFileDirectory As String = HttpContext.Current.Server.MapPath("~" & FileLocation)
    '                Dim fqFilenames As New List(Of String)(System.IO.Directory.GetFiles(ExportFileDirectory))
    '                Dim filenames As List(Of String) = fqFilenames.ConvertAll(Function(s) s.Replace(ExportFileDirectory & "\", ""))

    '                Dim filesToInclude As New System.Collections.Generic.List(Of String)()

    '                For Each filename As String In filenames
    '                    filesToInclude.Add(System.IO.Path.Combine(ExportFileDirectory, filename))
    '                Next

    '                HttpContext.Current.Response.Clear()
    '                HttpContext.Current.Response.BufferOutput = False

    '                Dim enc As Ionic.Zip.EncryptionAlgorithm = Ionic.Zip.EncryptionAlgorithm.None

    '                Dim archiveName As String = ZipFileName.Replace(".csv", "") & ".zip"
    '                HttpContext.Current.Response.ContentType = "application/zip"
    '                HttpContext.Current.Response.AddHeader("Content-Disposition", "inline; filename=" & Chr(34) & archiveName & Chr(34))

    '                Using zip As New Ionic.Zip.ZipFile()
    '                    zip.AddFiles(filesToInclude, "export")
    '                    zip.Save(HttpContext.Current.Response.OutputStream)
    '                End Using

    '                HttpContext.Current.Response.Close()

    '            Catch ex As Exception
    '            End Try
    '        End Sub

    '#End Region

    '#Region "Survey Export"
    '        Public Shared Function BuildSurveyExport(CurrentSurvey As Survey, SingleFile As Boolean) As KeyValuePair(Of Boolean, String)

    '            '# Create data set of tables containg the results of data is it appears in the survey results list (with filtering)
    '            '# Then save the data into a CSV & zip file(s)  - depending on the settings
    '            '# Show download link

    '            Dim ReturnResponse As New KeyValuePair(Of Boolean, String)(False, "New")

    '            Try
    '                If CurrentSurvey IsNot Nothing Then

    '                    '#########################
    '                    '# 1 - Get data
    '                    '#########################
    '                    Dim ResultsData = New DataSet()

    '                    '# Get max amount of response columns
    '                    Dim ResponseColumnCount As Integer = 2

    '                    Dim QuestionNumber As Integer = 1
    '                    For Each sq As SurveyQuestion In CurrentSurvey.Questions

    '                        Dim NumberQuestion As Boolean = IsNumberQuestion(QuestionNumber, CurrentSurvey.ID, sq)

    '                        Dim SubType As String = sq.SubType
    '                        If NumberQuestion Then SubType = "number"

    '                        '# Only for certain questions
    '                        If SubType = "rank" Then
    '                            If sq.Statistics IsNot Nothing Then
    '                                If CInt(sq.Statistics.Max()) > ResponseColumnCount Then
    '                                    ResponseColumnCount = CInt(sq.Statistics.Max())
    '                                End If
    '                            End If
    '                        ElseIf SubType = "table" Then
    '                            For Each sub_sq As SurveyQuestion In sq.SubQuestions
    '                                If sub_sq.Statistics IsNot Nothing Then
    '                                    If sub_sq.Options.Count() > ResponseColumnCount Then
    '                                        ResponseColumnCount = sub_sq.Options.Count()
    '                                    End If
    '                                End If
    '                            Next
    '                        ElseIf SubType = "multi_textbox" Then
    '                            If sq.Options IsNot Nothing Then
    '                                If CInt(sq.Options.Count()) > ResponseColumnCount Then
    '                                    ResponseColumnCount = CInt(sq.Options.Count())
    '                                End If
    '                            End If
    '                        End If

    '                        QuestionNumber += 1
    '                    Next

    '                    '# Get basic information
    '                    Dim BasicInformationTable As New DataTable("BasicInformationTable")

    '                    BasicInformationTable.Columns.Add("Question No.", GetType(String))
    '                    BasicInformationTable.Columns.Add("Title", GetType(String))

    '                    For i As Integer = 1 To ResponseColumnCount
    '                        BasicInformationTable.Columns.Add("Response" & i.ToString(), GetType(String))
    '                    Next

    '                    Dim BasicInformationRow As DataRow = BasicInformationTable.NewRow()

    '                    '# Set Totals
    '                    Dim TotalResponses As Integer = 0
    '                    Dim FilteredResponses As Integer = 0
    '                    Dim ExcludedResponses As Integer = 0

    '                    TotalResponses = CurrentSurveyControl.CurrentSurvey.AllResponses.Count()

    '                    'If TotalResponses <= 0 Then
    '                    '    For Each stat As KeyValuePair(Of String, String) In CurrentSurveyControl.UnfilteredSurvey.Statistics
    '                    '        If stat.Value = "Complete" Then
    '                    '            Int32.TryParse(stat.Value, TotalResponses)
    '                    '        End If
    '                    '    Next
    '                    'End If

    '                    '# Check for default
    '                    If CurrentSurveyControl.SurveyFilters.Count = 1 AndAlso CurrentSurveyControl.SurveyFilters(0).SurveyFilterType = SurveyFilterTypeEnum.Status AndAlso CurrentSurveyControl.SurveyFilters(0).FilterValue = "Deleted" Then
    '                        FilteredResponses = 0
    '                        ExcludedResponses = 0
    '                    Else
    '                        FilteredResponses = CurrentSurvey.Responses.Count()
    '                        ExcludedResponses = TotalResponses - FilteredResponses
    '                    End If

    '                    '# Created Time/Date
    '                    AddRowToTable(BasicInformationTable, "", "Created Time/Date:", FormatDate(CurrentSurvey.CreatedOn))

    '                    '# Modified Time/Date
    '                    AddRowToTable(BasicInformationTable, "", "Modified Time/Date:", FormatDate(CurrentSurvey.ModifiedOn))

    '                    '# Total Responses
    '                    AddRowToTable(BasicInformationTable, "", "Total Responses", TotalResponses.ToString())

    '                    '# Filtered Responses
    '                    AddRowToTable(BasicInformationTable, "", "Filtered Responses", FilteredResponses.ToString())

    '                    '# Responses Excluded
    '                    AddRowToTable(BasicInformationTable, "", "Responses Excluded", ExcludedResponses.ToString())

    '                    '# Survey Name
    '                    AddRowToTable(BasicInformationTable, "", "Survey Name", CurrentSurvey.Title)

    '                    '# Spacer
    '                    AddSpacerRowToTable(BasicInformationTable, ResponseColumnCount)

    '                    ResultsData.Tables.Add(BasicInformationTable)

    '                    '#########################
    '                    '# Get fiter information                     
    '                    '#########################
    '                    Dim FilterInformationTable As DataTable = GetFilterData(ResponseColumnCount)
    '                    If FilterInformationTable IsNot Nothing Then ResultsData.Tables.Add(FilterInformationTable)

    '                    '# Get question/response information
    '                    Dim QuestionResponsesTable As New DataTable("QuestionResponsesTable")
    '                    Dim QuestionResponsesRow As DataRow = QuestionResponsesTable.NewRow()

    '                    QuestionResponsesTable.Columns.Add("Question No.", GetType(String))
    '                    QuestionResponsesTable.Columns.Add("Title", GetType(String))

    '                    For i As Integer = 1 To ResponseColumnCount
    '                        QuestionResponsesTable.Columns.Add("Response" & i.ToString(), GetType(String))
    '                    Next

    '                    Dim QuestionCount As Integer = 1
    '                    For Each sq As SurveyQuestion In CurrentSurvey.Questions
    '                        If sq.Type = "SurveyQuestion" Then
    '                            '# Add question row
    '                            AddRowToTable(QuestionResponsesTable, QuestionCount.ToString(), sq.Title, "")

    '                            '# Get results
    '                            GetQuestionData(QuestionResponsesTable, CurrentSurvey, sq, ResponseColumnCount, QuestionCount)

    '                            '# Spacer
    '                            AddSpacerRowToTable(QuestionResponsesTable, ResponseColumnCount)

    '                            QuestionCount += 1
    '                        End If
    '                    Next

    '                    ResultsData.Tables.Add(QuestionResponsesTable)

    '                    '#########################
    '                    '# 2 - Save into file(s)
    '                    '#########################

    '                    '# Set file paths
    '                    Dim FinalFilePath As String = RootFolderPath & CurrentSurvey.ID.ToString() & "/"
    '                    Dim FileName As String = "results_" & Now.Year.ToString() & "_" & Now.Month.ToString() & "_" & Now.Day.ToString() & ".csv"

    '                    '# Check the folder exists- create folder if it doesn't
    '                    CheckFolderExists(FinalFilePath)

    '                    '# Remove old files
    '                    ClearOldFiles(FinalFilePath)

    '                    '# Generate complete CSV
    '                    Dim CSVLocation As String = ""
    '                    Try
    '                        Dim CSVBuilder As CSVBuilder = New CSVBuilder()
    '                        Dim FullPath As String = HttpContext.Current.Server.MapPath("~" & FinalFilePath)

    '                        CSVLocation = CSVBuilder.ConvertFromDataSet(ResultsData, FullPath, FileName)
    '                    Catch ex As Exception
    '                    End Try

    '                    '# Generate question CSV files - if required
    '                    If Not SingleFile Then
    '                        Dim MultiQuestionCount As Integer = 1
    '                        For Each sq As SurveyQuestion In CurrentSurvey.Questions
    '                            If sq.Type = "SurveyQuestion" Then

    '                                Try
    '                                    Dim MultiQuestionResponsesData As DataSet = ExportQuestionResponses(CurrentSurvey, sq, ResponseColumnCount, MultiQuestionCount)
    '                                    Dim CSVBuilder As CSVBuilder = New CSVBuilder()
    '                                    Dim FullPath As String = HttpContext.Current.Server.MapPath("~" & FinalFilePath)

    '                                    CSVBuilder.ConvertFromDataSet(MultiQuestionResponsesData, FullPath, "q_" & MultiQuestionCount.ToString() & ".csv")
    '                                Catch ex As Exception
    '                                End Try

    '                                MultiQuestionCount += 1
    '                            End If
    '                        Next
    '                    End If

    '                    '# Build Zip file
    '                    ZipFiles(FileName, FinalFilePath)

    '                    '# Open File
    '                    'HttpContext.Current.Response.ContentType = "text/csv"
    '                    'HttpContext.Current.Response.AddHeader("content-disposition", "attachment; filename=" & FileName)
    '                    'HttpContext.Current.Response.WriteFile(CSVLocation)
    '                    'HttpContext.Current.Response.End()

    '                Else
    '                    ReturnResponse = New KeyValuePair(Of Boolean, String)(False, "Problem creating export files - Current survey information is missing")
    '                End If

    '            Catch ex As Exception
    '                ReturnResponse = New KeyValuePair(Of Boolean, String)(False, "Problem creating export files - " & ex.Message)
    '            End Try

    '            '#########################
    '            '# 3 - Show return
    '            '#########################
    '            Return ReturnResponse

    '        End Function
    '#End Region

    '#Region "Questions"
    '        Public Shared Sub GetQuestionData(ByRef CurrentDataTable As DataTable, CurrentSurvey As Survey, CurrentSurveyQuestion As SurveyQuestion, ResponseColumnCount As Integer, QuestionNumber As Integer)

    '            If CurrentSurveyQuestion IsNot Nothing Then

    '                Dim sq As SurveyQuestion = CurrentSurveyQuestion
    '                Dim CurrentSurveyQuestionID As Integer = CInt(sq.ID)
    '                Dim Count As Integer = 0
    '                Dim TotalResponses As Integer = 0
    '                Dim TotalClicks As Integer = 0
    '                Dim NotAnswered As Integer = 0

    '                For Each ri As SurveyResponse In CurrentSurvey.Responses
    '                    Dim ResultList = (From dr In ri.ResponseQuestions Where dr.QuestionID = sq.ID AndAlso Not String.IsNullOrEmpty(dr.AnswerValue) Select dr).ToList()

    '                    If ResultList.Count > 0 Then
    '                        TotalResponses += 1
    '                        TotalClicks += ResultList.Count()
    '                    End If

    '                    Dim NotAnsweredResultList = (From dr In ri.ResponseQuestions Where dr.QuestionID = sq.ID AndAlso String.IsNullOrEmpty(dr.AnswerValue) Select dr).ToList()

    '                    If NotAnsweredResultList.Count > 0 Then
    '                        NotAnswered += 1
    '                    End If
    '                Next

    '                Dim NumberQuestion As Boolean = IsNumberQuestion(QuestionNumber, CurrentSurvey.ID, sq)

    '                Dim SubType As String = sq.SubType
    '                If NumberQuestion Then SubType = "number"

    '                Select Case SubType
    '                    Case "table"

    '                        '# Load options
    '                        Dim OptionList As New List(Of String)
    '                        For Each so As SurveyOption In sq.Options
    '                            OptionList.Add(so.Title)
    '                        Next

    '                        AddRowToTable(CurrentDataTable, "", "", ResponseColumnCount, OptionList)

    '                        '# Load Questions & Responses
    '                        Dim PercentageList As New List(Of String)
    '                        Dim ValueList As New List(Of String)
    '                        For Each sub_sq As SurveyQuestion In sq.SubQuestions

    '                            '# Clear values
    '                            PercentageList.Clear()
    '                            ValueList.Clear()

    '                            '# Calc temp total
    '                            For Each ri As SurveyResponse In CurrentSurvey.Responses
    '                                Dim ResultList = (From dr In ri.ResponseQuestions Where dr.QuestionID = sub_sq.ID AndAlso Not String.IsNullOrEmpty(dr.AnswerValue) Select dr).ToList()

    '                                If ResultList.Count > 0 Then
    '                                    TotalResponses += 1
    '                                    TotalClicks += ResultList.Count()
    '                                End If

    '                                Dim NotAnsweredResultList = (From dr In ri.ResponseQuestions Where dr.QuestionID = sub_sq.ID AndAlso String.IsNullOrEmpty(dr.AnswerValue) Select dr).ToList()

    '                                If NotAnsweredResultList.Count > 0 Then
    '                                    NotAnswered += 1
    '                                End If
    '                            Next

    '                            '# Get responses
    '                            If sub_sq IsNot Nothing Then

    '                                For Each sub_so As SurveyOption In sub_sq.Options

    '                                    Count = 0

    '                                    '# Survey responses
    '                                    Dim ResponseItems As List(Of SurveyResponse) = CurrentSurvey.Responses
    '                                    Dim QuestionsResponses As New List(Of SurveyResponseQuestion)
    '                                    For Each ri As SurveyResponse In ResponseItems

    '                                        Dim rqList = (From dr In ri.ResponseQuestions Where dr.QuestionID = sub_so.QuestionID AndAlso dr.AnswerValue = sub_so.Value Select dr).ToList()

    '                                        If rqList.Count() <= 0 AndAlso sub_so.Value.ToLower.Contains("other") Then

    '                                            Dim rqListID = (From dr In ri.ResponseQuestions Where dr.QuestionID = sub_so.QuestionID AndAlso dr.AnswerValue.ToLower.Contains("other") AndAlso dr.OptionID = sub_so.ID Select dr).ToList()

    '                                            Count += rqListID.Count()
    '                                            For Each rq As SurveyResponseQuestion In ri.ResponseQuestions
    '                                                If rq.OptionID = sub_so.ID Then
    '                                                    QuestionsResponses.Add(rq)
    '                                                End If
    '                                            Next
    '                                        End If

    '                                        Count += rqList.Count()
    '                                    Next

    '                                    Dim Percentage As Decimal = 0
    '                                    If TotalResponses > 0 Then Percentage = Math.Round(((100 / TotalResponses) * Count), 0)

    '                                    PercentageList.Add(Percentage.ToString() & "%")
    '                                    ValueList.Add(Count.ToString())

    '                                Next

    '                            End If

    '                            AddRowToTable(CurrentDataTable, "", sub_sq.Title, ResponseColumnCount, PercentageList)
    '                            AddRowToTable(CurrentDataTable, "", "", ResponseColumnCount, ValueList)
    '                        Next

    '                    Case "radio", "checkbox", "menu"
    '                        AddRowToTable(CurrentDataTable, "", "", "Responses", "Percent")

    '                        '# Get options/response
    '                        For Each so As SurveyOption In sq.Options
    '                            Count = 0

    '                            '# Survey responses
    '                            Dim ResponseItems As List(Of SurveyResponse) = CurrentSurvey.Responses
    '                            Dim QuestionsResponses As New List(Of SurveyResponseQuestion)
    '                            For Each ri As SurveyResponse In ResponseItems

    '                                Dim rqList = (From dr In ri.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.AnswerValue = so.Value Select dr).ToList()

    '                                If rqList.Count() <= 0 AndAlso so.Value.ToLower.Contains("other") Then

    '                                    Dim rqListID = (From dr In ri.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.AnswerValue.ToLower.Contains("other") AndAlso dr.OptionID = so.ID Select dr).ToList()

    '                                    Count += rqListID.Count()
    '                                    For Each rq As SurveyResponseQuestion In ri.ResponseQuestions
    '                                        If rq.OptionID = so.ID Then
    '                                            QuestionsResponses.Add(rq)
    '                                        End If
    '                                    Next
    '                                End If

    '                                Count += rqList.Count()
    '                            Next

    '                            Dim Percentage As Decimal = 0
    '                            If TotalResponses > 0 Then Percentage = Math.Round(((100 / TotalResponses) * Count), 1)

    '                            AddRowToTable(CurrentDataTable, "", so.Title, Count.ToString(), Percentage.ToString() & "%")
    '                        Next

    '                        '# Spacer
    '                        AddSpacerRowToTable(CurrentDataTable, ResponseColumnCount)

    '                        '# Totals
    '                        AddRowToTable(CurrentDataTable, "", "Total Clicks:", TotalClicks.ToString())
    '                        AddRowToTable(CurrentDataTable, "", "Total Responses:", TotalResponses.ToString())

    '                    Case "rank"

    '                        '# Load options
    '                        Dim OptionList As New List(Of String)
    '                        For i As Integer = 1 To CInt(sq.Statistics.Max())
    '                            OptionList.Add(i.ToString())
    '                        Next

    '                        AddRowToTable(CurrentDataTable, "", "", ResponseColumnCount, OptionList)

    '                        '# Load Responses
    '                        Dim PercentageList As New List(Of String)
    '                        Dim ValueList As New List(Of String)
    '                        For Each so As SurveyOption In sq.Options

    '                            '# Clear values
    '                            PercentageList.Clear()
    '                            ValueList.Clear()

    '                            Dim ResponseID As Integer = 0
    '                            Dim ResponseItems As List(Of SurveyResponse) = CurrentSurvey.Responses
    '                            Dim QuestionsResponses As New List(Of KeyValuePair(Of Integer, SurveyResponseQuestion))
    '                            For Each ri As SurveyResponse In ResponseItems
    '                                For Each rq As SurveyResponseQuestion In ri.ResponseQuestions
    '                                    If rq.QuestionID = CurrentSurveyQuestion.ID Then
    '                                        Dim Result As New KeyValuePair(Of Integer, SurveyResponseQuestion)(ri.ResponseID, rq)
    '                                        QuestionsResponses.Add(Result)
    '                                        ResponseID = ri.ResponseID
    '                                    End If
    '                                Next
    '                            Next

    '                            '# Filter to ones with answers
    '                            Dim FilteredQuestionsResponses = (From dr In QuestionsResponses Where dr.Value.OptionID = so.ID And String.IsNullOrEmpty(dr.Value.AnswerValue) = False Select dr.Value.QuestionID, dr.Value.AnswerValue, CurrentResponseID = dr.Key).ToList()

    '                            '# Load possible answers
    '                            If FilteredQuestionsResponses IsNot Nothing AndAlso FilteredQuestionsResponses.Count() > 0 Then
    '                                For i As Integer = 1 To CInt(CurrentSurveyQuestion.Statistics.Max)

    '                                    Dim ItemsRanked As Integer = (From dr In FilteredQuestionsResponses Where dr.AnswerValue = i.ToString() Select dr).Count()
    '                                    Dim ItemPercentage As Decimal = Math.Round(((100 / FilteredQuestionsResponses.Count()) * ItemsRanked), 0)

    '                                    PercentageList.Add(ItemPercentage.ToString() & "%")
    '                                    ValueList.Add(ItemsRanked)
    '                                Next
    '                            End If

    '                            AddRowToTable(CurrentDataTable, "", so.Title, ResponseColumnCount, PercentageList)
    '                            AddRowToTable(CurrentDataTable, "", "", ResponseColumnCount, ValueList)
    '                        Next

    '                    Case "multi_textbox"

    '                        '# Load options
    '                        Dim OptionList As New List(Of String)
    '                        For Each so As SurveyOption In sq.Options()
    '                            OptionList.Add(so.Value)
    '                        Next

    '                        AddRowToTable(CurrentDataTable, "", "", ResponseColumnCount, OptionList)

    '                        Dim ResponseItems As List(Of SurveyResponse) = CurrentSurvey.Responses
    '                        Dim QuestionsResponses As New List(Of KeyValuePair(Of Integer, SurveyResponseQuestion))

    '                        For Each ri As SurveyResponse In ResponseItems
    '                            '# Get the questions from the responses that match the current survey question
    '                            For Each rq As SurveyResponseQuestion In ri.ResponseQuestions
    '                                If rq.QuestionID = sq.ID Then
    '                                    Dim Result As New KeyValuePair(Of Integer, SurveyResponseQuestion)(ri.ResponseID, rq)
    '                                    QuestionsResponses.Add(Result)
    '                                End If
    '                            Next
    '                        Next

    '                        '# Filter out the responses
    '                        Dim FilteredQuestionsResponses = (From dr In QuestionsResponses Where String.IsNullOrEmpty(dr.Value.AnswerValue) = False Select New PDFBuilder.MultiTextBoxGroup(dr.Value.QuestionID, CurrentSurveyQuestion.Title, dr.Key)).Distinct.ToList()
    '                        Dim FilteredQuestionsResponsesDistinct As New List(Of PDFBuilder.MultiTextBoxGroup)

    '                        For Each mtg In FilteredQuestionsResponses
    '                            Dim FilterRecordMatch As PDFBuilder.MultiTextBoxGroup = (From dr In FilteredQuestionsResponsesDistinct Where dr.QuestionID = mtg.QuestionID AndAlso dr.CurrentResponseID = mtg.CurrentResponseID Select dr).FirstOrDefault()
    '                            If FilterRecordMatch Is Nothing Then FilteredQuestionsResponsesDistinct.Add(mtg)
    '                        Next

    '                        '# Now get each question within the response question
    '                        For Each mtg In FilteredQuestionsResponsesDistinct
    '                            Dim MultiTextBoxAnswers = (From dr In QuestionsResponses Where dr.Key = mtg.CurrentResponseID AndAlso dr.Value.QuestionID = mtg.QuestionID Order By dr.Value.OptionID Select New PDFBuilder.MultiTextBoxValue(dr.Value.OptionID, GetOptionTitle(sq.Options, dr.Value.OptionID), dr.Value.AnswerValue)).ToList()
    '                            mtg.SetAnswerValues(MultiTextBoxAnswers)
    '                        Next

    '                        For Each mtbg As PDFBuilder.MultiTextBoxGroup In FilteredQuestionsResponsesDistinct

    '                            Dim MultiTextBoxValueList As New List(Of String)
    '                            For Each mtbv As PDFBuilder.MultiTextBoxValue In mtbg.AnswerValues
    '                                If CurrentSurvey.CanViewQuestionDetails(QuestionNumber) Then
    '                                    MultiTextBoxValueList.Add(mtbv.AnswerValue)
    '                                Else
    '                                    MultiTextBoxValueList.Add("")
    '                                End If
    '                            Next
    '                            AddRowToTable(CurrentDataTable, "", "", ResponseColumnCount, MultiTextBoxValueList)
    '                        Next

    '                    Case Else

    '                        Dim QuestionsResponses As New List(Of KeyValuePair(Of Integer, SurveyResponseQuestion))
    '                        For Each ri As SurveyResponse In CurrentSurvey.Responses
    '                            For Each rq As SurveyResponseQuestion In ri.ResponseQuestions
    '                                If rq.QuestionID = sq.ID AndAlso Not String.IsNullOrEmpty(rq.AnswerValue) Then
    '                                    Dim Result As New KeyValuePair(Of Integer, SurveyResponseQuestion)(ri.ResponseID, rq)
    '                                    QuestionsResponses.Add(Result)
    '                                End If
    '                            Next
    '                        Next

    '                        If QuestionsResponses IsNot Nothing AndAlso QuestionsResponses.Count > 0 Then

    '                            '# Filter to ones with answers
    '                            Dim FilteredQuestionsResponses = (From dr In QuestionsResponses Where String.IsNullOrEmpty(dr.Value.AnswerValue) = False Select dr.Value.QuestionID, CurrentSurveyQuestion.Title, dr.Value.AnswerValue, dr.Key).ToList()

    '                            '# Not Answered count
    '                            Dim QuestionsResponsesUnanswered = (From dr In QuestionsResponses Where String.IsNullOrEmpty(dr.Value.AnswerValue) = True Select dr.Value.QuestionID).Count()

    '                            '# Totals
    '                            AddRowToTable(CurrentDataTable, "", "Total Responses:", FilteredQuestionsResponses.Count())
    '                            AddRowToTable(CurrentDataTable, "", "Not answered:", QuestionsResponsesUnanswered)

    '                            If CurrentSurvey.CanViewQuestionDetails(QuestionNumber) Then

    '                                '# Spacer
    '                                AddSpacerRowToTable(CurrentDataTable, ResponseColumnCount)
    '                                AddRowToTable(CurrentDataTable, "", "----------------------", "")

    '                                '# Responses
    '                                For Each fi In FilteredQuestionsResponses
    '                                    AddRowToTable(CurrentDataTable, "", fi.Key, fi.AnswerValue)
    '                                Next

    '                            End If

    '                        Else
    '                            AddRowToTable(CurrentDataTable, "", "No results", "")
    '                        End If

    '                End Select

    '            End If

    '        End Sub

    '        Public Shared Function ExportQuestionResponses(CurrentSurvey As Survey, CurrentSurveyQuestion As SurveyQuestion, ResponseColumnCount As Integer, QuestionCount As Integer) As DataSet

    '            Dim ResultsData = New DataSet()

    '            '##################################################
    '            '# Get fiter information - if set to show
    '            '##################################################
    '            Dim FilterInformationTable As DataTable = GetFilterData(ResponseColumnCount)
    '            If FilterInformationTable IsNot Nothing Then ResultsData.Tables.Add(FilterInformationTable)

    '            '# Get question/response information
    '            Dim QuestionResponsesTable As New DataTable("QuestionResponsesTable")
    '            Dim QuestionResponsesRow As DataRow = QuestionResponsesTable.NewRow()

    '            QuestionResponsesTable.Columns.Add("Question No.", GetType(String))
    '            QuestionResponsesTable.Columns.Add("Title", GetType(String))

    '            For i As Integer = 1 To ResponseColumnCount
    '                QuestionResponsesTable.Columns.Add("Response" & i.ToString(), GetType(String))
    '            Next

    '            '# Add question row
    '            AddRowToTable(QuestionResponsesTable, QuestionCount.ToString(), CurrentSurveyQuestion.Title, "")

    '            '# Get results
    '            GetQuestionData(QuestionResponsesTable, CurrentSurvey, CurrentSurveyQuestion, ResponseColumnCount, QuestionCount)

    '            '# Spacer
    '            AddSpacerRowToTable(QuestionResponsesTable, ResponseColumnCount)

    '            QuestionCount += 1

    '            ResultsData.Tables.Add(QuestionResponsesTable)

    '            Return ResultsData

    '        End Function
    '#End Region

    '#Region "Responses Export"
    '        Public Shared Function BuildResponsesExport(CurrentSurvey As Survey) As KeyValuePair(Of Boolean, String)

    '            '# Create data set of tables containg the results of data is it appears in the survey results list (with filtering)
    '            '# Then save the data into a CSV & zip file(s)  - depending on the settings
    '            '# Show download link

    '            Dim ReturnResponse As New KeyValuePair(Of Boolean, String)(False, "New")

    '            Try
    '                If CurrentSurvey IsNot Nothing Then

    '                    '#########################
    '                    '# 1 - Get data
    '                    '#########################
    '                    Dim ResultsData = New DataSet()

    '                    '# Get amount of response columns => amount of questions + response ID/Status/Date Completed
    '                    Dim ResponseColumnCount As Integer = CurrentSurvey.Questions.Count() + 3

    '                    '# Table for data
    '                    Dim ResponseInformationTable As New DataTable("ResponseInformationTable")
    '                    Dim ResponseHeadersRow As DataRow = ResponseInformationTable.NewRow()

    '                    ResponseInformationTable.Columns.Add("Response ID", GetType(String))
    '                    ResponseHeadersRow(0) = "Response ID"
    '                    ResponseInformationTable.Columns.Add("Status", GetType(String))
    '                    ResponseHeadersRow(1) = "Status"
    '                    ResponseInformationTable.Columns.Add("Completed Date", GetType(String))
    '                    ResponseHeadersRow(2) = "Completed Date"

    '                    Dim Count As Integer = 1
    '                    Dim QuestionNumber As Integer = 1
    '                    For Each sq As SurveyQuestion In CurrentSurvey.Questions
    '                        If sq.Type = "SurveyQuestion" Then

    '                            Dim NumberQuestion As Boolean = IsNumberQuestion(QuestionNumber, CurrentSurvey.ID, sq)

    '                            Dim SubType As String = sq.SubType
    '                            If NumberQuestion Then SubType = "number"

    '                            Select Case SubType
    '                                Case "table"
    '                                    For Each subq As SurveyQuestion In sq.SubQuestions
    '                                        ResponseInformationTable.Columns.Add(Count.ToString() & ". " & GlobalMethods.StripHTML(subq.Title), GetType(String))
    '                                        ResponseHeadersRow(Count + 2) = Count.ToString() & ". " & GlobalMethods.StripHTML(subq.Title)
    '                                        Count += 1
    '                                    Next
    '                                Case "checkbox"

    '                                    For Each so As SurveyOption In sq.Options
    '                                        ResponseInformationTable.Columns.Add(Count.ToString() & ". " & GlobalMethods.StripHTML(sq.Title) & " - " & GlobalMethods.StripHTML(so.Title), GetType(String))
    '                                        ResponseHeadersRow(Count + 2) = Count.ToString() & ". " & GlobalMethods.StripHTML(sq.Title) & " - " & GlobalMethods.StripHTML(so.Title)
    '                                        Count += 1
    '                                    Next

    '                                Case "radio", "menu", "rank"
    '                                    ResponseInformationTable.Columns.Add(Count.ToString() & ". " & GlobalMethods.StripHTML(sq.Title), GetType(String))
    '                                    ResponseHeadersRow(Count + 2) = Count.ToString() & ". " & GlobalMethods.StripHTML(sq.Title)
    '                                    Count += 1

    '                                Case "multi_textbox"
    '                                    For Each so As SurveyOption In sq.Options
    '                                        ResponseInformationTable.Columns.Add(Count.ToString() & ". " & GlobalMethods.StripHTML(sq.Title) & " " & GlobalMethods.StripHTML(so.Value), GetType(String))
    '                                        ResponseHeadersRow(Count + 2) = Count.ToString() & ". " & GlobalMethods.StripHTML(sq.Title) & " " & GlobalMethods.StripHTML(so.Value)
    '                                        Count += 1
    '                                    Next

    '                                Case Else
    '                                    ResponseInformationTable.Columns.Add(Count.ToString() & ". " & GlobalMethods.StripHTML(sq.Title), GetType(String))
    '                                    ResponseHeadersRow(Count + 2) = Count.ToString() & ". " & GlobalMethods.StripHTML(sq.Title)
    '                                    Count += 1
    '                            End Select

    '                        End If

    '                        QuestionNumber += 1
    '                    Next

    '                    ResponseInformationTable.Rows.Add(ResponseHeadersRow)

    '                    '# Add rows of data to the table
    '                    For Each sr As SurveyResponse In CurrentSurvey.Responses
    '                        With sr
    '                            Dim CurrentDataRow As DataRow = ResponseInformationTable.NewRow()

    '                            '# Response Data
    '                            CurrentDataRow("Response ID") = sr.ResponseID
    '                            CurrentDataRow("Status") = GlobalMethods.StripHTML(sr.Status)
    '                            CurrentDataRow("Completed Date") = FormatDateSimple(sr.DateSubmitted)

    '                            '# Questions
    '                            Dim QuestionCount As Integer = 1
    '                            Dim QuestionNumberCount As Integer = 1
    '                            For Each sq As SurveyQuestion In CurrentSurvey.Questions
    '                                If sq.Type = "SurveyQuestion" Then

    '                                    Dim RowColumnName As String = ""
    '                                    Dim AnswerValue As String = ""
    '                                    Dim MatchingResponseQuestion As SurveyResponseQuestion = Nothing

    '                                    Dim NumberQuestion As Boolean = IsNumberQuestion(QuestionNumber, CurrentSurvey.ID, sq)

    '                                    Dim SubType As String = sq.SubType
    '                                    If NumberQuestion Then SubType = "number"

    '                                    Select Case SubType
    '                                        Case "table"
    '                                            For Each subq As SurveyQuestion In sq.SubQuestions

    '                                                RowColumnName = QuestionCount.ToString() & ". " & GlobalMethods.StripHTML(subq.Title)

    '                                                MatchingResponseQuestion = (From dr In sr.ResponseQuestions Where dr.QuestionID = subq.ID AndAlso Not String.IsNullOrEmpty(dr.AnswerValue) Select dr).FirstOrDefault()
    '                                                If MatchingResponseQuestion IsNot Nothing Then AnswerValue = MatchingResponseQuestion.AnswerValue

    '                                                '# Add data                                                
    '                                                AddDataToRow(CurrentDataRow, RowColumnName, AnswerValue)
    '                                                QuestionCount += 1
    '                                                AnswerValue = ""

    '                                            Next
    '                                        Case "checkbox"

    '                                            For Each so As SurveyOption In sq.Options

    '                                                RowColumnName = QuestionCount.ToString() & ". " & GlobalMethods.StripHTML(sq.Title) & " - " & GlobalMethods.StripHTML(so.Title)

    '                                                MatchingResponseQuestion = (From dr In sr.ResponseQuestions Where dr.QuestionID = sq.ID AndAlso dr.OptionID = so.ID Select dr).FirstOrDefault()
    '                                                If MatchingResponseQuestion IsNot Nothing Then AnswerValue = MatchingResponseQuestion.AnswerValue

    '                                                '# Add data
    '                                                If Not CurrentSurvey.CanViewQuestionDetails(QuestionNumberCount - 1) AndAlso AnswerValue.ToLower().Contains("other") Then
    '                                                    AddDataToRow(CurrentDataRow, RowColumnName, "")
    '                                                Else
    '                                                    AddDataToRow(CurrentDataRow, RowColumnName, AnswerValue)
    '                                                End If

    '                                                QuestionCount += 1

    '                                                AnswerValue = ""

    '                                            Next

    '                                        Case "radio", "menu", "rank"

    '                                            RowColumnName = QuestionCount.ToString() & ". " & GlobalMethods.StripHTML(sq.Title)

    '                                            MatchingResponseQuestion = (From dr In sr.ResponseQuestions Where dr.QuestionID = sq.ID AndAlso Not String.IsNullOrEmpty(dr.AnswerValue) Select dr).FirstOrDefault()
    '                                            If MatchingResponseQuestion IsNot Nothing Then AnswerValue = MatchingResponseQuestion.AnswerValue

    '                                            '# Add data
    '                                            If Not CurrentSurvey.CanViewQuestionDetails(QuestionNumberCount - 1) AndAlso AnswerValue.ToLower().Contains("other") Then
    '                                                AddDataToRow(CurrentDataRow, RowColumnName, "")
    '                                            Else
    '                                                AddDataToRow(CurrentDataRow, RowColumnName, AnswerValue)
    '                                            End If

    '                                            QuestionCount += 1
    '                                            AnswerValue = ""

    '                                        Case "multi_textbox"

    '                                            For Each so As SurveyOption In sq.Options

    '                                                RowColumnName = QuestionCount.ToString() & ". " & GlobalMethods.StripHTML(sq.Title) & " " & GlobalMethods.StripHTML(so.Value)

    '                                                MatchingResponseQuestion = (From dr In sr.ResponseQuestions Where dr.QuestionID = sq.ID AndAlso dr.OptionID = so.ID Select dr).FirstOrDefault()

    '                                                AnswerValue = MatchingResponseQuestion.AnswerValue

    '                                                '# Add data
    '                                                If CurrentSurvey.CanViewQuestionDetails(QuestionNumberCount - 1) Then
    '                                                    AddDataToRow(CurrentDataRow, RowColumnName, AnswerValue)
    '                                                Else
    '                                                    AddDataToRow(CurrentDataRow, RowColumnName, "")
    '                                                End If
    '                                                QuestionCount += 1
    '                                                AnswerValue = ""

    '                                            Next

    '                                        Case Else

    '                                            RowColumnName = QuestionCount.ToString() & ". " & GlobalMethods.StripHTML(sq.Title)

    '                                            MatchingResponseQuestion = (From dr In sr.ResponseQuestions Where dr.QuestionID = sq.ID Select dr).FirstOrDefault()
    '                                            If MatchingResponseQuestion IsNot Nothing Then AnswerValue = MatchingResponseQuestion.AnswerValue

    '                                            '# Add data
    '                                            If CurrentSurvey.CanViewQuestionDetails(QuestionNumberCount - 1) Then
    '                                                AddDataToRow(CurrentDataRow, RowColumnName, AnswerValue)
    '                                            Else
    '                                                AddDataToRow(CurrentDataRow, RowColumnName, "")
    '                                            End If
    '                                            QuestionCount += 1
    '                                            AnswerValue = ""

    '                                    End Select

    '                                End If

    '                                QuestionNumberCount += 1
    '                            Next

    '                            ResponseInformationTable.Rows.Add(CurrentDataRow)
    '                        End With
    '                    Next

    '                    ResultsData.Tables.Add(ResponseInformationTable)

    '                    '#########################
    '                    '# 2 - Save into file(s)
    '                    '#########################

    '                    '# Set file paths
    '                    Dim FinalFilePath As String = RootFolderPath & CurrentSurvey.ID.ToString() & "/"
    '                    Dim FileName As String = "responses_" & Now.Year.ToString() & "_" & Now.Month.ToString() & "_" & Now.Day.ToString() & ".csv"

    '                    '# Check the folder exists- create folder if it doesn't
    '                    CheckFolderExists(FinalFilePath)

    '                    '# Remove old files
    '                    ClearOldFiles(FinalFilePath)

    '                    '# Generate complete CSV
    '                    Dim CSVLocation As String = ""
    '                    Try
    '                        Dim CSVBuilder As CSVBuilder = New CSVBuilder()
    '                        Dim FullPath As String = HttpContext.Current.Server.MapPath("~" & FinalFilePath)

    '                        CSVLocation = CSVBuilder.ConvertFromDataSet(ResultsData, FullPath, FileName)
    '                    Catch ex As Exception
    '                    End Try

    '                    '# Build Zip file
    '                    ZipFiles(FileName, FinalFilePath)

    '                Else
    '                    ReturnResponse = New KeyValuePair(Of Boolean, String)(False, "Problem creating export files - Current survey information is missing")
    '                End If

    '            Catch ex As Exception
    '                ReturnResponse = New KeyValuePair(Of Boolean, String)(False, "Problem creating export files - " & ex.Message)
    '            End Try

    '            '#########################
    '            '# 3 - Show return
    '            '#########################
    '            Return ReturnResponse

    '        End Function
    '#End Region

    '#Region "Filters"
    '        Public Shared Function GetFilterData(ResponseColumnCount As Integer) As DataTable

    '            If CurrentSurveyControl IsNot Nothing AndAlso CurrentSurveyControl.SurveyFilters IsNot Nothing AndAlso CurrentSurveyControl.SurveyFilters.Count > 0 Then

    '                Dim FilterInformationTable As New DataTable("FilterInformationTable")

    '                FilterInformationTable.Columns.Add("Question No.", GetType(String))
    '                FilterInformationTable.Columns.Add("Title", GetType(String))

    '                For i As Integer = 1 To ResponseColumnCount
    '                    FilterInformationTable.Columns.Add("Response" & i.ToString(), GetType(String))
    '                Next

    '                '# Add filter information
    '                AddRowToTable(FilterInformationTable, "", "Filters Applied", "")

    '                For Each sf As SurveyFilter In CurrentSurveyControl.SurveyFilters

    '                    Select Case sf.SurveyFilterType

    '                        Case SurveyFilterTypeEnum.Status
    '                            Select Case sf.FilterValue
    '                                Case "Complete"
    '                                    AddRowToTable(FilterInformationTable, "", "Status:", "Fully-Completed")
    '                                Case "Partial"
    '                                    AddRowToTable(FilterInformationTable, "", "Status:", "Part-Completed")
    '                                Case Else
    '                                    AddRowToTable(FilterInformationTable, "", "Status:", "Fully & Part-Completed")
    '                            End Select
    '                        Case SurveyFilterTypeEnum.DateBefore

    '                            '# Get values
    '                            Dim DateStr As String = sf.FilterValue.Replace("+", " ")
    '                            Dim RealDate As New Date

    '                            '# Check this is a valid date
    '                            Dim DateOK As Boolean = Date.TryParse(DateStr, RealDate)

    '                            If DateOK Then
    '                                AddRowToTable(FilterInformationTable, "", "Responses Before:", RealDate.ToString("dd/MM/yyyy HH:mm tt"))
    '                            End If

    '                        Case SurveyFilterTypeEnum.DateAfter

    '                            '# Get values
    '                            Dim DateStr As String = sf.FilterValue.Replace("+", " ")
    '                            Dim RealDate As New Date

    '                            '# Check this is a valid date
    '                            Dim DateOK As Boolean = Date.TryParse(DateStr, RealDate)

    '                            If DateOK Then
    '                                AddRowToTable(FilterInformationTable, "", "Responses After:", RealDate.ToString("dd/MM/yyyy HH:mm tt"))
    '                            End If

    '                        Case SurveyFilterTypeEnum.CustomDataText
    '                            AddRowToTable(FilterInformationTable, "", "Answers containing:", sf.FilterValue)
    '                        Case SurveyFilterTypeEnum.QuestionFilter
    '                            AddRowToTable(FilterInformationTable, "", "QuestionFilter:", "QUESTION " & sf.QuestionIndex.ToString() & ": " & sf.QuestionTitle & " -  ANSWER: " & sf.QuestionOptionTitle)
    '                    End Select
    '                Next

    '                '# Spacer
    '                AddSpacerRowToTable(FilterInformationTable, ResponseColumnCount)

    '                Return FilterInformationTable
    '            Else
    '                Return Nothing
    '            End If

    '        End Function
    '#End Region

    '#Region "Table Functions"
    '        Public Shared Sub AddRowToTable(ByRef CurrentDataTable As DataTable, ColumnOneValue As String, ColumnTwoValue As String, ColumnThreeValue As String)
    '            Dim CurrentDataRow As DataRow = CurrentDataTable.NewRow()
    '            CurrentDataRow("Question No.") = ColumnOneValue
    '            CurrentDataRow("Title") = GlobalMethods.StripHTML(ColumnTwoValue)
    '            CurrentDataRow("Response1") = ColumnThreeValue
    '            CurrentDataTable.Rows.Add(CurrentDataRow)
    '        End Sub

    '        Public Shared Sub AddRowToTable(ByRef CurrentDataTable As DataTable, ColumnOneValue As String, ColumnTwoValue As String, ColumnThreeValue As String, ColumnFourValue As String)
    '            Dim CurrentDataRow As DataRow = CurrentDataTable.NewRow()
    '            CurrentDataRow("Question No.") = ColumnOneValue
    '            CurrentDataRow("Title") = GlobalMethods.StripHTML(ColumnTwoValue)
    '            CurrentDataRow("Response1") = ColumnThreeValue
    '            CurrentDataRow("Response2") = ColumnFourValue
    '            CurrentDataTable.Rows.Add(CurrentDataRow)
    '        End Sub

    '        Public Shared Sub AddRowToTable(ByRef CurrentDataTable As DataTable, ColumnOneValue As String, ColumnTwoValue As String, ResponseColumnCount As Integer, ResponseList As List(Of String))
    '            Dim CurrentDataRow As DataRow = CurrentDataTable.NewRow()
    '            CurrentDataRow("Question No.") = ColumnOneValue
    '            CurrentDataRow("Title") = GlobalMethods.StripHTML(ColumnTwoValue)

    '            For i As Integer = 1 To ResponseColumnCount
    '                If i <= ResponseList.Count() Then
    '                    CurrentDataRow("Response" & i.ToString()) = ResponseList(i - 1)
    '                End If
    '            Next

    '            CurrentDataTable.Rows.Add(CurrentDataRow)
    '        End Sub

    '        Public Shared Sub AddSpacerRowToTable(ByRef CurrentDataTable As DataTable, ResponseColumnCount As Integer)
    '            Dim CurrentDataRow As DataRow = CurrentDataTable.NewRow()
    '            CurrentDataRow("Question No.") = ""
    '            CurrentDataRow("Title") = ""

    '            For i As Integer = 1 To ResponseColumnCount
    '                CurrentDataRow("Response" & i.ToString()) = ""
    '            Next
    '            CurrentDataTable.Rows.Add(CurrentDataRow)
    '        End Sub

    '        Public Shared Sub AddDataToRow(ByRef CurrentDataRow As DataRow, DataRowColumnName As String, Value As String)
    '            Try
    '                CurrentDataRow(DataRowColumnName) = Value
    '            Catch ex As Exception
    '                Dim x = 1
    '            End Try
    '        End Sub

    '        Public Shared Function GetOptionTitle(Options As List(Of SurveyOption), OptionID As String) As String
    '            Dim OptionTitle As String = (From dr In Options Where dr.ID = OptionID Select dr.Title).FirstOrDefault()
    '            If String.IsNullOrEmpty(OptionTitle) Then OptionTitle = "Question Answer"
    '            Return OptionTitle
    '        End Function
    '#End Region

    '#Region "General Formatting and Functions"
    '        Public Shared Function FormatDate(InDate As Date) As String
    '            Return InDate.ToString("HH:mm d") & GlobalMethods.GetDateSuffix(InDate.Day).ToLower() & " " & InDate.ToString("MMM yyyy")
    '        End Function

    '        Public Shared Function FormatDateSimple(InDate As Date) As String
    '            Return InDate.ToString("dd/MM/yyyy HH:mm")
    '        End Function

    '        Public Shared Sub CheckFolderExists(ByVal FolderPath As String)

    '            '# Check if we have a ~ in the folder path
    '            If Not FolderPath.StartsWith("~") Then FolderPath = "~" & FolderPath

    '            Try
    '                Dim di As New DirectoryInfo(HttpContext.Current.Server.MapPath(FolderPath))

    '                '# If we don't have the folder then create it
    '                If Not di.Exists Then di.Create()

    '            Catch ex As Exception
    '                Throw ex
    '            End Try

    '        End Sub

    '        Public Shared Function IsNumberQuestion(QuestionNumber As Integer, CurrentSurveyID As Integer, CurrentSurveyQuestion As SurveyQuestion) As Boolean

    '            '# Check for Number questions
    '            Dim NumberQuestion As Boolean = False

    '            If CurrentSurveyID = "1541759" Then
    '                '# The 2014 RICS and Macdonald & Company UK Rewards and Attitudes Survey
    '                If QuestionNumber = 15 OrElse QuestionNumber = 16 OrElse QuestionNumber = 17 OrElse QuestionNumber = 20 OrElse QuestionNumber = 22 Then
    '                    NumberQuestion = True
    '                End If
    '            ElseIf CurrentSurveyID = "1541763" Then
    '                '# The 2014 RICS and Macdonald &amp; Company Middle East Rewards and Attitudes Survey
    '                If QuestionNumber = 17 OrElse QuestionNumber = 18 OrElse QuestionNumber = 19 OrElse QuestionNumber = 22 OrElse QuestionNumber = 24 Then
    '                    NumberQuestion = True
    '                End If
    '            ElseIf CurrentSurveyID = "1541784" Then
    '                '# The 2014 RICS and Macdonald &amp; Company Europe Rewards and Attitudes Survey
    '                If QuestionNumber = 15 OrElse QuestionNumber = 16 OrElse QuestionNumber = 17 OrElse QuestionNumber = 20 OrElse QuestionNumber = 22 Then
    '                    NumberQuestion = True
    '                End If
    '            ElseIf CurrentSurveyID = "1562646" Then
    '                '# The 2014 RICS and Macdonald &amp; Company Asia Rewards and Attitudes Survey
    '                If QuestionNumber = 19 OrElse QuestionNumber = 21 OrElse QuestionNumber = 22 OrElse QuestionNumber = 25 OrElse QuestionNumber = 27 Then
    '                    NumberQuestion = True
    '                End If
    '            Else
    '                '# Loop through properties to find the map_key
    '                For Each p In CurrentSurveyQuestion.Properties
    '                    If p.Key = "map_key" Then
    '                        If Not String.IsNullOrEmpty(p.Value) Then
    '                            If p.Value.ToLower() = "number" Then
    '                                NumberQuestion = True
    '                                Exit For
    '                            End If
    '                        End If
    '                    End If
    '                Next
    '            End If

    '            Return NumberQuestion

    '        End Function

    '#End Region

    '    End Class


End Class
