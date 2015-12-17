Imports System.Data
Imports PingLibrary
Imports PingCore.MySystem
Imports PingSurveys
Imports PingSurveys.SurveyLibrary
Imports System.IO

Imports System.Xml
Imports iTextSharp.text
Imports iTextSharp.text.pdf
Imports PingUtilities

Partial Class Surveys_single
    Inherits System.Web.UI.Page

    Const RootFolderPath As String = "/App_Data/PDFs/"


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

#Region "SurveyResponseID"
    Protected Property SurveyResponseID() As Integer
        Get
            Dim _SurveyResponseID As Integer = 0
            Int32.TryParse(ViewState("SurveyResponseID"), _SurveyResponseID)
            Return _SurveyResponseID
        End Get
        Set(value As Integer)
            ViewState("SurveyResponseID") = value
        End Set
    End Property
#End Region

#Region "SurveyResponse"
    Protected Property CurrentSurveyResponse() As SurveyResponse
        Get
            Dim _CurrentSurveyResponse As SurveyResponse = Nothing

            Try
                If Session("CurrentSurveyResponse") IsNot Nothing Then
                    _CurrentSurveyResponse = CType(Session("CurrentSurveyResponse"), SurveyResponse)
                End If
            Catch ex As Exception
            End Try

            Return _CurrentSurveyResponse
        End Get
        Set(value As SurveyResponse)
            Session("CurrentSurveyResponse") = value
        End Set
    End Property
#End Region

#Region "CurrentPage"
    Protected ReadOnly Property CurrentPage() As Integer
        Get
            Dim _CurrentPage As Integer = 1

            If Request.QueryString("p") IsNot Nothing AndAlso Not String.IsNullOrEmpty(Request.QueryString("p")) Then
                Int32.TryParse(Request.QueryString("p"), _CurrentPage)
            End If

            If _CurrentPage > 0 Then
                Return _CurrentPage
            Else
                Return 1
            End If
        End Get
    End Property
#End Region

#Region "CurrentSelectedQuestion"
    Protected ReadOnly Property CurrentSelectedQuestion() As Integer
        Get
            Dim _CurrentSelectedQuestion As Integer = 0

            If Request.QueryString("q") IsNot Nothing AndAlso Not String.IsNullOrEmpty(Request.QueryString("q")) Then
                Int32.TryParse(Request.QueryString("q"), _CurrentSelectedQuestion)
            End If

            If _CurrentSelectedQuestion > 0 Then
                Return _CurrentSelectedQuestion
            Else
                Return 0
            End If
        End Get
    End Property
#End Region

    Protected Sub Page_Init(sender As Object, e As EventArgs) Handles Me.Init

        CheckLoggedIn()

        If Not IsPostBack Then
            SurveyResponseID = 0
            CurrentSurveyResponse = Nothing
        End If
    End Sub

    Protected Sub Page_Load(ByVal sender As Object, ByVal e As System.EventArgs) Handles Me.Load
        If Not IsPostBack Then
            LoadPage()
        End If
    End Sub

#Region "Check User Logged In"
    Protected Sub CheckLoggedIn()
        Dim LoggedIn As Boolean = GlobalMethods.UserLoggedIn(LocalSiteInterface.IdentityControl)

        If Not LoggedIn Then
            Response.Redirect("/SignIn.aspx")
        End If
    End Sub
#End Region

#Region "Load Data"
    Protected Sub LoadPage()

        '# Set default view
        SetSurveyDetailsView(NotLoadedView)

        '# Load Survey Responses
        LoadSurveyResponses()

        '# Load current survey if we have one
        'If SurveyID > 0 Then
        '    LoadSurveyResponseDetails()
        'End If

    End Sub
#End Region

#Region "Survey Responses"
    Protected Sub LoadSurveyResponses()

        If CurrentSurvey IsNot Nothing Then

            '# Set header
            If Not String.IsNullOrEmpty(CurrentSurvey.DecorativeHeaderImage) Then
                imgHeaderBannerFull.ImageUrl = CurrentSurvey.DecorativeHeaderImage
                imgHeaderBannerFull.AlternateText = CurrentSurvey.Title
            End If

            Dim SurveyResponsesList As List(Of SurveyResponse) = CurrentSurvey.Responses()

            If SurveyResponsesList IsNot Nothing AndAlso SurveyResponsesList.Count > 0 AndAlso CurrentSurvey.ViewDetails AndAlso (CurrentSurvey.MinimumResponsesAllowed = 0 OrElse (CurrentSurvey.MinimumResponsesAllowed > 0 AndAlso SurveyResponsesList.Count() > CurrentSurvey.MinimumResponsesAllowed)) Then
                SelectSurveyResponse()

                With lvSurveyResponses
                    .DataSource = SurveyResponsesList
                    .DataBind()
                End With

            Else

                With lvSurveyResponses
                    .DataSource = Nothing
                    .DataBind()
                End With

                btnDownloadResults.Visible = False
            End If
        Else
            SetSurveyDetailsView(CantLoadView)
        End If

    End Sub

    Protected Sub SelectSurveyResponse(Optional SurveyResponseRecordID As Integer = 0, Optional SurveyResponseRecord As SurveyResponse = Nothing)
        If CurrentSurvey IsNot Nothing Then
            Dim SurveyResponsesList As List(Of SurveyResponse) = CurrentSurvey.Responses()

            If SurveyResponseRecord IsNot Nothing Then
                CurrentSurveyResponse = SurveyResponseRecord
            ElseIf SurveyResponseRecordID > 0 Then

                If SurveyResponsesList IsNot Nothing AndAlso SurveyResponsesList.Count > 0 Then
                    For Each sr As SurveyResponse In SurveyResponsesList
                        If sr.ID = SurveyResponseID Then
                            CurrentSurveyResponse = sr
                        End If
                    Next
                End If
            Else
                If SurveyResponsesList IsNot Nothing AndAlso SurveyResponsesList.Count > 0 Then
                    CurrentSurveyResponse = SurveyResponsesList(CurrentPage - 1)
                End If
            End If

            '# Get ID of selected survey
            Int32.TryParse(CurrentSurveyResponse.ID, SurveyResponseID)

            If SurveyResponseID > 0 Then
                LoadSurveyResponseDetails()
            Else
                SetSurveyDetailsView(NotLoadedView)
            End If
        Else
            SetSurveyDetailsView(CantLoadView)
        End If
    End Sub
#End Region

#Region "Survey Response Details"
    Protected Sub LoadSurveyResponseDetails()

        If CurrentSurveyResponse IsNot Nothing Then
            With CurrentSurveyResponse

                '# Set view
                SetSurveyDetailsView(LoadedView)
                pnlDetails.Visible = True

                '# Set details
                litResponseDetailsCompleted.Text = CompletedStatus(.Status)
                litResponseDetailsDate.Text = FormatDate(.DateSubmitted)
                litResponseDetailsID.Text = .ID

                '# Response excluded?
                Dim ResponseExcluded As Boolean = DataAccess.GetExcludedResponseByResponseID(.ID)
                chkExcludeFromExport.Checked = ResponseExcluded

                '# Questions
                Dim QuestionsList As List(Of SurveyQuestion) = (From dr In CurrentSurvey.Questions Where dr.Type = "SurveyQuestion" Select dr).ToList()

                With ddlResponseQuestions
                    .DataSource = QuestionsList
                    .DataTextField = "Title"
                    .DataValueField = "ID"
                    .DataBind()

                    .Items.Insert(0, New System.Web.UI.WebControls.ListItem("Show all questions", "0"))

                    Try
                        If CurrentSelectedQuestion > 0 Then
                            ddlResponseQuestions.SelectedValue = CurrentSelectedQuestion.ToString()
                        End If
                    Catch ex As Exception
                    End Try
                End With


                '        '# Status
                '        Dim StatusClass As String = ""
                '        Select Case .Status
                '            Case "In Design"
                '                StatusClass = "blue"
                '            Case "Launched"
                '                StatusClass = "green"
                '            Case "Closed"
                '                StatusClass = "red"
                '        End Select

                '        litStatus.Text = "<span class='" & StatusClass & "'>" & .Status & "</span>"

                '        '# Set Totals
                '        Dim TotalResponses As Integer = 0
                '        Dim FilteredResponses As Integer = 0
                '        Dim ExcludedResponses As Integer = 0

                '        TotalResponses = UnfilteredSurvey.Responses.Count()

                '        If TotalResponses <= 0 Then
                '            For Each stat As KeyValuePair(Of String, String) In UnfilteredSurvey.Statistics
                '                If stat.Value = "Complete" Then
                '                    Int32.TryParse(stat.Value, TotalResponses)
                '                End If
                '            Next
                '        End If

                '        '# Check for default
                '        If LocalSiteInterface.CurrentSurveyControl.SurveyFilters.Count = 1 AndAlso LocalSiteInterface.CurrentSurveyControl.SurveyFilters(0).SurveyFilterType = SurveyFilterTypeEnum.Status AndAlso LocalSiteInterface.CurrentSurveyControl.SurveyFilters(0).FilterValue = "Deleted" Then
                '            FilteredResponses = 0
                '            ExcludedResponses = 0
                '        Else
                '            FilteredResponses = CurrentSurvey.Responses.Count()
                '            ExcludedResponses = TotalResponses - FilteredResponses
                '        End If

                '        lblTotalResponses.Text = TotalResponses.ToString()
                '        lblFilteredResponses.Text = FilteredResponses.ToString()
                '        lblExcludedResponses.Text = ExcludedResponses.ToString()

                '        '# Load questions
                '        With lvSurveyQuestions
                '            .DataSource = CurrentSurvey.Questions
                '            .DataBind()
                '        End With

            End With
        Else
            SetSurveyDetailsView(CantLoadView)
        End If

    End Sub

    Protected Sub SetSurveyDetailsView(RequiredView As View)
        mvSurveyDetails.SetActiveView(RequiredView)
    End Sub

    Protected Function CompletedStatus(Status As String) As String
        Select Case Status
            Case "Complete"
                Return "Yes"
            Case Else
                Return "No"
        End Select
    End Function

    Protected Function FormatDate(DateSubmitted As Date) As String
        Try
            Return GlobalMethods.FormatDateTime(DateSubmitted, "HH:mm d", True) & DateSubmitted.ToString(" MMM yyyy")
        Catch ex As Exception
            Return "empty"
        End Try
    End Function

    Protected Sub lvSurveyResponses_ItemDataBound(sender As Object, e As ListViewItemEventArgs) Handles lvSurveyResponses.ItemDataBound
        Select Case e.Item.ItemType
            Case ListViewItemType.DataItem

                Dim rptQuestions As Repeater = CType(e.Item.FindControl("rptQuestions"), Repeater)

                Dim CurrentQuestions As New List(Of SurveyQuestion)

                'If CurrentSelectedQuestion <= 0 Then
                '    CurrentQuestions = CurrentSurvey.Questions
                'Else
                '    CurrentQuestions = (From dr In CurrentSurvey.Questions Where dr.ID = CurrentSelectedQuestion Select dr).ToList()
                'End If

                Dim QuestionsList As List(Of SurveyQuestion) = (From dr In CurrentSurvey.Questions Where dr.Type = "SurveyQuestion" Select dr).ToList()

                With rptQuestions
                    .DataSource = QuestionsList
                    .DataBind()
                End With

        End Select
    End Sub

    Protected Sub rptQuestions_ItemDataBound(sender As Object, e As RepeaterItemEventArgs)
        Select Case e.Item.ItemType
            Case ListItemType.Item, ListItemType.AlternatingItem, ListItemType.SelectedItem

                Dim sq As SurveyQuestion = CType(e.Item.DataItem, SurveyQuestion)
                Dim pmSurveyQuestionDetails As Controls_SurveyQuestionDetailsControl = CType(e.Item.FindControl("pmSurveyQuestionDetails"), Controls_SurveyQuestionDetailsControl)

                If pmSurveyQuestionDetails IsNot Nothing Then
                    pmSurveyQuestionDetails.ItemCount = e.Item.ItemIndex + 1

                    If CurrentSelectedQuestion > 0 AndAlso sq.ID <> CurrentSelectedQuestion Then
                        pmSurveyQuestionDetails.HideSurveyQuestion()
                    Else
                        pmSurveyQuestionDetails.CurrentSurveyQuestion = sq
                        pmSurveyQuestionDetails.CurrentSurveyResponse = CurrentSurveyResponse
                        pmSurveyQuestionDetails.LoadSurveyQuestion()
                    End If

                End If

        End Select
    End Sub
#End Region

#Region "Search"
    Protected Sub btnSearchRecordID_Click(sender As Object, e As EventArgs) Handles btnSearchRecordID.Click
        If Page.IsValid Then

            '# Get Search ID
            Dim SearchResponseID As Integer = 0
            Int32.TryParse(txtSearchRecordID.Text, SearchResponseID)

            If SearchResponseID > 0 Then

                '# Find the response in the list
                If CurrentSurvey IsNot Nothing Then

                    Dim PageCount As Integer = 1
                    Dim FoundSurvey As Boolean = False
                    Dim SearchRecord As SurveyResponse = Nothing
                    Dim SurveyResponsesList As List(Of SurveyResponse) = CurrentSurvey.Responses()

                    If SurveyResponsesList IsNot Nothing AndAlso SurveyResponsesList.Count > 0 Then
                        For Each sr As SurveyResponse In SurveyResponsesList
                            If sr.ID = SearchResponseID Then
                                'SelectSurveyResponse(0, sr)
                                SearchRecord = sr
                                FoundSurvey = True
                                Exit For
                            End If

                            PageCount += 1
                        Next
                    End If

                    If FoundSurvey AndAlso SearchRecord IsNot Nothing Then
                        '# redirect to the page with this response
                        Response.Redirect("/surveys/single.aspx?p=" & PageCount.ToString(), False)
                    ElseIf Not FoundSurvey Then
                        ShowSearchFail(phSearchRecordID, "No matching Survey Response Record could be found, <br />please check the ID and try again")
                    End If

                Else
                    ShowSearchFail(phSearchRecordID, "No matching Survey Response Record could be found, <br />please check the ID and try again")
                End If

            Else
                ShowSearchFail(phSearchRecordID, "Please enter a valid Survey Response Record ID")
            End If

        End If
    End Sub

    Protected Sub btnSearchRecordJump_Click(sender As Object, e As EventArgs) Handles btnSearchRecordJump.Click
        If Page.IsValid Then

            '# Get Page
            Dim SearchPage As Integer = 0
            Int32.TryParse(txtSearchRecordJump.Text, SearchPage)

            If SearchPage > 0 Then

                '# Find the response in the list
                If CurrentSurvey IsNot Nothing Then

                    '# Total records
                    Dim TotalRecords As Integer = CurrentSurvey.Responses.Count()

                    If SearchPage <= TotalRecords Then

                        Dim SearchRecord As SurveyResponse = CurrentSurvey.Responses(SearchPage - 1)

                        If SearchRecord IsNot Nothing Then
                            Response.Redirect("/surveys/single.aspx?p=" & SearchPage.ToString(), False)
                        Else
                            ShowSearchFail(phSearchRecordJump, "No Record could be found, <br />please check the number entered and try again")
                        End If

                    Else
                        ShowSearchFail(phSearchRecordJump, "Please enter a valid Record Page number <br />There are only " & TotalRecords.ToString() & " response records available")
                    End If

                Else
                    ShowSearchFail(phSearchRecordJump, "No Record could be found, <br />please check the number entered and try again")
                End If

            Else
                ShowSearchFail(phSearchRecordJump, "Please enter a valid Record Page number")
            End If

        End If
    End Sub

    Protected Sub ShowSearchFail(phSearchPlaceholder As PlaceHolder, Msg As String)

        Dim c As New CustomValidator()
        c.IsValid = False
        c.Text = "&nbsp;"
        c.ErrorMessage = "<div class='ss_row'><div class='warning'><p>" & Msg & "</p></div></div>"
        c.Text = "<div class='warning'><p>" & Msg & "</p></div>"
        c.CssClass = "sf_row_faillist"
        c.Style("padding") = "10px 0"
        c.Style("display") = "block"

        phSearchPlaceholder.Visible = True
        phSearchPlaceholder.Controls.Add(c)

    End Sub
#End Region

#Region "Event Handlers"
    Protected Sub ddlResponseQuestions_SelectedIndexChanged(sender As Object, e As EventArgs) Handles ddlResponseQuestions.SelectedIndexChanged
        Dim SelectedQuestion As Integer = 0
        Int32.TryParse(ddlResponseQuestions.SelectedValue, SelectedQuestion)

        If SelectedQuestion > 0 Then
            Response.Redirect("/surveys/single.aspx?p=" & CurrentPage.ToString() & "&q=" & SelectedQuestion.ToString(), True)
        Else
            Response.Redirect("/surveys/single.aspx?p=" & CurrentPage.ToString(), True)
        End If
    End Sub

    Protected Sub btnDownloadResults_Click(sender As Object, e As EventArgs) Handles btnDownloadResults.Click
        If Page.IsValid Then
            Try
                Dim PDFLocationURL As String = PDFBuilder.BuildResponsePage(CurrentSurvey, CurrentSurveyResponse, CurrentSelectedQuestion)
                LoadPage()

                Response.AddHeader("Content-Type", "application/octet-stream")
                Response.AddHeader("Content-Transfer-Encoding", "Binary")
                Response.AddHeader("Content-disposition", "attachment; filename=""" & PDFLocationURL & """")
                Response.WriteFile(Server.MapPath("~" & RootFolderPath & CurrentSurvey.ID.ToString() & "/" & PDFLocationURL))
                Response.End()

            Catch ex As Exception
                ShowSearchFail(phDownloadResults, "Problem with download - " & ex.Message)
            End Try
        End If
    End Sub

    Protected Sub chkExcludeFromExport_CheckedChanged(sender As Object, e As EventArgs) Handles chkExcludeFromExport.CheckedChanged
        '# Add/Remove item from excluded list
        DataLogic.AddEditExcludedResponse(CurrentSurveyResponse.ID, CurrentSurvey.ID)
    End Sub
#End Region


End Class
