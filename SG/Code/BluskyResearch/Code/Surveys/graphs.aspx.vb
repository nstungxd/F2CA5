Imports System.Data
Imports PingLibrary
Imports PingCore.MySystem
Imports PingSurveys
Imports PingSurveys.SurveyLibrary

Partial Class Surveys_graphs
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

#Region "CurrentSurveyQuestion"
    Protected ReadOnly Property CurrentSurveyQuestion() As SurveyQuestion
        Get
            Return LocalSiteInterface.CurrentSurveyControl.CurrentSurveyQuestion
        End Get
    End Property
#End Region

#Region "CurrentSurveyQuestionID"
    Public ReadOnly Property CurrentSurveyQuestionID() As Integer
        Get
            Return LocalSiteInterface.CurrentSurveyControl.SurveyQuestionID
        End Get
    End Property
#End Region

#Region "CurrentSurveyOption"
    Protected ReadOnly Property CurrentSurveyOption() As SurveyOption
        Get
            Return LocalSiteInterface.CurrentSurveyControl.CurrentSurveyOption
        End Get
    End Property
#End Region

#Region "CurrentSurveyOptionID"
    Public ReadOnly Property CurrentSurveyOptionID() As Integer
        Get
            Return LocalSiteInterface.CurrentSurveyControl.SurveyOptionID
        End Get
    End Property
#End Region

#Region "CurrentView"
    Public Property CurrentView As ChartType
        Get
            Dim _CurrentView As ChartType = ChartType.ColumnChart
            If ViewState("CurrentView") IsNot Nothing Then _CurrentView = CType(ViewState("CurrentView"), ChartType)
            Return _CurrentView
        End Get
        Set(value As ChartType)
            ViewState("CurrentView") = value
        End Set
    End Property
#End Region

    Protected Sub Page_Init(ByVal sender As Object, ByVal e As System.EventArgs) Handles Me.Init
        CheckLoggedIn()
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
        SetQuestionDetailsView(NotLoadedView)

        If SurveyID > 0 Then

            If CurrentSurvey IsNot Nothing Then
                '# Set header
                If Not String.IsNullOrEmpty(CurrentSurvey.DecorativeHeaderImage) Then
                    imgHeaderBannerFull.ImageUrl = CurrentSurvey.DecorativeHeaderImage
                    imgHeaderBannerFull.AlternateText = CurrentSurvey.Title
                End If
            End If

            '# Load All Questions
            LoadQuestions()

            '# Load question from URL Querystring
            SetQuestionFromURL()
        End If


    End Sub

    Protected Sub SetQuestionDetailsView(RequiredView As View)
        mvQuestionDetails.SetActiveView(RequiredView)
    End Sub
#End Region

#Region "Questions"
    Protected Sub LoadQuestions()

        Dim SurveyQuestions As List(Of SurveyQuestion) = SurveyAccess.GetAllSurveyQuestions(SurveyID)

        '# Filtering
        Dim FilteredSurveyQuestions As New List(Of SurveyQuestion)

        For Each sq As SurveyQuestion In SurveyQuestions
            If sq.Type <> "rank" Then
                If sq.SubQuestions IsNot Nothing AndAlso sq.SubQuestions.Count > 0 Then
                    For Each q As SurveyQuestion In sq.SubQuestions
                        FilteredSurveyQuestions.Add(q)
                    Next
                Else
                    FilteredSurveyQuestions.Add(sq)
                End If
            End If
        Next

        If FilteredSurveyQuestions IsNot Nothing AndAlso FilteredSurveyQuestions.Count > 0 Then
            With ddlQuestions
                .DataSource = FilteredSurveyQuestions
                .DataValueField = "ID"
                .DataTextField = "Title"
                .DataBind()

                .Items.Insert(0, New ListItem("Select Question", "0"))
            End With
        End If

    End Sub

    Protected Sub btnChangeQuestion_Click(sender As Object, e As EventArgs) Handles btnChangeQuestion.Click
        If Page.IsValid Then

            '# Get ID of selected question
            Dim SurveyQuestionID As Integer = 0
            Int32.TryParse(ddlQuestions.SelectedValue, SurveyQuestionID)

            If SurveyQuestionID > 0 Then
                Response.Redirect("/surveys/graphs.aspx?sq=" & SurveyQuestionID.ToString(), False)
            Else
                ShowSelectQuestionFail("* Please select a Question")
            End If

        End If
    End Sub

    Protected Sub ShowSelectQuestionFail(ByVal Msg As String)

        Dim c As New CustomValidator()
        c.IsValid = False
        c.Text = "&nbsp;"
        c.ErrorMessage = "<div class='ss_row'><div class='warning'><p>" & Msg & "</p></div></div>"
        c.Text = "<div class='warning'><p>" & Msg & "</p></div>"
        c.CssClass = "sf_row_faillist"
        c.Style("padding") = "10px 0"
        c.Style("display") = "block"

        phQuestions.Visible = True
        phQuestions.Controls.Add(c)

    End Sub

    Protected Sub SetQuestionFromURL()

        Dim SurveyQuestionID As Integer = 0
        Dim SurveyOptionID As Integer = 0

        Try

            If Request.QueryString("sq") IsNot Nothing Then

                '# Get ID of selected question
                Int32.TryParse(Request.QueryString("sq"), SurveyQuestionID)

                If SurveyQuestionID > 0 Then
                    '# Set the Survey Question
                    LocalSiteInterface.CurrentSurveyControl.SetSurveyQuestion(SurveyID, SurveyQuestionID)
                End If

            End If

            If Request.QueryString("so") IsNot Nothing Then

                '# Get ID of selected question
                Int32.TryParse(Request.QueryString("so"), SurveyOptionID)

                If SurveyOptionID > 0 Then
                    '# Set the Survey Question
                    LocalSiteInterface.CurrentSurveyControl.SetSurveyOption(SurveyID, SurveyQuestionID, SurveyOptionID)
                End If
            Else
                LocalSiteInterface.CurrentSurveyControl.CurrentSurveyOption = Nothing
            End If

            If SurveyQuestionID > 0 Then
                LoadQuestionDetails()
            End If

        Catch ex As Exception
            SetQuestionDetailsView(NotLoadedView)
        End Try

    End Sub
#End Region

#Region "Question Details"
    Protected Sub LoadQuestionDetails()
        If CurrentSurveyQuestion IsNot Nothing Then
            With CurrentSurveyQuestion

                '# Set view
                SetQuestionDetailsView(LoadedView)

                '# Set title
                lblQuestionTitle.Text = "Graphical results for the question: " & .Title

                '# Load Graph
                LoadColumnChart()

            End With
        End If
    End Sub
#End Region

#Region "Graph"
    Public Enum ChartType As Integer
        ColumnChart = 0
        BarChart = 1
        PieChart = 2
    End Enum

    Public Sub LoadColumnChart(Optional DataView As String = "")
        CurrentView = ChartType.ColumnChart
        LoadChart(ChartType.ColumnChart, DataView)
    End Sub

    Public Sub LoadBarChart(Optional DataView As String = "")
        CurrentView = ChartType.BarChart
        LoadChart(ChartType.BarChart, DataView)
    End Sub

    Public Sub LoadPieChart(Optional DataView As String = "")
        CurrentView = ChartType.PieChart
        LoadChart(ChartType.PieChart, DataView)
    End Sub

    Public Sub LoadChart(TypeOfChart As ChartType, Optional DataView As String = "")

        Try

            Dim sq As SurveyQuestion = CurrentSurveyQuestion
            Dim GraphID As String = "blgraph"
            Dim GraphType As String = "_BarChart_Horizontal"

            Dim JSMethod As String = "LoadColumnChart"
            Dim ChartMethodCall As String = JSMethod & "('" & GraphID & "', resultArray, '" & HttpUtility.HtmlEncode(sq.Title) & "'); "

            '# Type based information
            Select Case TypeOfChart
                Case ChartType.ColumnChart
                    '# Set title
                    lblTypeTitle.Text = "Column Chart"
                    Dim xAxisTitle As String = "Answers"
                    Dim hAxisTitle As String = "Total Clicks: " & GetTotalResponsesValue()

                    '# Set Options
                    pnlChartDirection.Visible = True
                    'pnlChartDataView.Visible = False

                    If ddlChartDataView.SelectedValue = "percentages" Then xAxisTitle = "Answers (%)"

                    '# JS Method
                    JSMethod = "LoadColumnChart"

                    '# Build method override
                    ChartMethodCall = JSMethod & "('" & GraphID & "', resultArray, '" & HttpUtility.HtmlEncode(sq.Title) & "', '" & HttpUtility.HtmlEncode(xAxisTitle) & "', '" & HttpUtility.HtmlEncode(hAxisTitle) & "'); "

                Case ChartType.BarChart
                    '# Set title
                    lblTypeTitle.Text = "Bar Chart"
                    Dim xAxisTitle As String = "Total Clicks: " & GetTotalResponsesValue()
                    Dim hAxisTitle As String = "Answers"

                    '# Set Options
                    pnlChartDirection.Visible = True
                    'pnlChartDataView.Visible = False

                    If ddlChartDataView.SelectedValue = "percentages" Then hAxisTitle = "Answers (%)"

                    '# JS Method
                    JSMethod = "LoadBarChart"

                    '# Build method override
                    ChartMethodCall = JSMethod & "('" & GraphID & "', resultArray, '" & HttpUtility.HtmlEncode(sq.Title) & "', '" & HttpUtility.HtmlEncode(xAxisTitle) & "', '" & HttpUtility.HtmlEncode(hAxisTitle) & "'); "

                Case ChartType.PieChart
                    '# Set title
                    lblTypeTitle.Text = "Pie Chart"

                    '# Set Options
                    pnlChartDirection.Visible = False
                    'pnlChartDataView.Visible = True

                    '# JS Method
                    JSMethod = "LoadPieChart"

                    '# Data View
                    Dim Tooltip As String = "value"
                    Dim SliceText As String = "label"

                    Select Case ddlChartDataView.SelectedValue
                        Case "percentages"
                            Tooltip = "percentage"
                            SliceText = "percentage"
                        Case "values"
                            Tooltip = "value"
                            SliceText = "value"
                    End Select

                    '# Build method override
                    ChartMethodCall = JSMethod & "('" & GraphID & "', resultArray, '" & HttpUtility.HtmlEncode(sq.Title & " (" & "Total Clicks: " & GetTotalResponsesValue() & ")") & "', '" & Tooltip & "', '" & SliceText & "'); "

            End Select

            '# Build Results Array
            Dim ResultsArray As String = "[""Answers"", ""Responses""], "

            '# Get totals
            Dim ResponseItems As List(Of SurveyResponse) = CurrentSurvey.Responses
            Dim TotalResponses As Integer = 0
            Dim TotalClicks As Integer = 0

            For Each ri As SurveyResponse In ResponseItems
                Dim ResultList = (From dr In ri.ResponseQuestions Where dr.QuestionID = sq.ID AndAlso Not String.IsNullOrEmpty(dr.AnswerValue) Select dr).ToList()

                If ResultList.Count > 0 Then
                    TotalResponses += 1
                    TotalClicks += ResultList.Count()
                End If
            Next

            Select Case sq.SubType
                Case "radio", "checkbox", "menu"
                    For Each op As SurveyOption In sq.Options

                        '# Get stats
                        Dim AnswerCount As Integer = 0

                        '# Survey responses
                        For Each ri As SurveyResponse In ResponseItems

                            Dim rqList = (From dr In ri.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.AnswerValue = op.Value Select dr).ToList()

                            If rqList.Count() <= 0 AndAlso op.Value.ToLower.Contains("other") Then

                                Dim rqListID As New List(Of SurveyResponseQuestion)

                                If CurrentSurveyQuestion.SubType = "radio" Then
                                    rqListID = (From dr In ri.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.OptionID = op.ID Select dr).ToList()
                                Else
                                    rqListID = (From dr In ri.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.AnswerValue.ToLower.Contains("other") AndAlso dr.OptionID = op.ID Select dr).ToList()
                                End If

                                AnswerCount += rqListID.Count()
                            End If

                            AnswerCount += rqList.Count()
                        Next

                        Dim Percentage As Decimal = 0
                        If TotalResponses > 0 Then Percentage = Math.Round(((100 / TotalClicks) * AnswerCount), 1)

                        If (ChartType.BarChart OrElse ChartType.ColumnChart) AndAlso ddlChartDataView.SelectedValue = "percentages" Then
                            ResultsArray &= "[""" & HttpUtility.HtmlEncode(op.Title) & """, " & Percentage.ToString() & "], "
                        Else
                            ResultsArray &= "[""" & HttpUtility.HtmlEncode(op.Title) & """, " & AnswerCount.ToString() & "], "
                        End If

                    Next
                Case "rank"

                    If CurrentSurveyOption IsNot Nothing Then

                        Dim ResponseID As Integer = 0
                        Dim QuestionsResponses As New List(Of KeyValuePair(Of Integer, SurveyResponseQuestion))
                        For Each ri As SurveyResponse In ResponseItems
                            For Each rq As SurveyResponseQuestion In ri.ResponseQuestions
                                If rq.QuestionID = CurrentSurveyQuestionID Then
                                    Dim Result As New KeyValuePair(Of Integer, SurveyResponseQuestion)(ri.ResponseID, rq)
                                    QuestionsResponses.Add(Result)
                                End If
                            Next
                        Next

                        '# Filter to ones with answers
                        Dim FilteredQuestionsResponses = (From dr In QuestionsResponses Where dr.Value.OptionID = CurrentSurveyOption.ID And String.IsNullOrEmpty(dr.Value.AnswerValue) = False Select dr.Value.QuestionID, dr.Value.AnswerValue, CurrentResponseID = dr.Key).ToList()

                        '# Load possible answers
                        Dim RankValues As New List(Of KeyValuePair(Of Integer, Integer))
                        For i As Integer = 1 To CInt(CurrentSurveyQuestion.Statistics.Max)

                            Dim ItemsRanked As Integer = (From dr In FilteredQuestionsResponses Where dr.AnswerValue = i.ToString() Select dr).Count()
                            Dim ItemPercentage As Integer = Math.Round(((100 / FilteredQuestionsResponses.Count()) * ItemsRanked), 0)

                            If (ChartType.BarChart OrElse ChartType.ColumnChart) AndAlso ddlChartDataView.SelectedValue = "percentages" Then
                                ResultsArray &= "[""" & i.ToString() & """, " & ItemPercentage.ToString() & "], "
                            Else
                                ResultsArray &= "[""" & i.ToString() & """, " & ItemsRanked.ToString() & "], "
                            End If

                        Next
                    Else
                        SetQuestionDetailsView(NotLoadedView)
                    End If

            End Select

            If Not String.IsNullOrEmpty(ResultsArray) AndAlso ResultsArray.Length > 2 Then
                ResultsArray = "[" & ResultsArray.Substring(0, ResultsArray.Length - 2) & "]"
            End If

            '# Add the placeholder chart control to the page
            Dim GraphHolder As HtmlGenericControl = New HtmlGenericControl("div")
            GraphHolder.ID = GraphID & "_wrapper"
            GraphHolder.InnerHtml = "<div id=""" & GraphID & """ style=""width: 680px; height: 378px; visibility: hidden;""></div>"

            phGraph.Controls.Add(GraphHolder)

            '# Define the name and type of the client script on the page. 
            Dim csName As String = GraphID & "Script"
            Dim csType As Type = Me.[GetType]()

            '# Get a ClientScriptManager reference from the Page class. 
            Dim cs As ClientScriptManager = Page.ClientScript

            '# Check to see if the client script is already registered. 
            If Not cs.IsClientScriptBlockRegistered(csType, csName) Then
                Dim csText As New StringBuilder()
                csText.Append("<script type=""text/javascript"">")
                csText.Append("var resultArray = " & ResultsArray & "; ")
                csText.Append("var QuestionID = '" & sq.ID & "'; ")
                csText.Append("var ElementIDValue = '" & GraphID & "'; ")
                csText.Append("var ChartTitle = '" & HttpUtility.HtmlEncode(sq.Title) & "'; ")
                csText.Append(ChartMethodCall)
                csText.Append("</script>")
                cs.RegisterClientScriptBlock(csType, csName, csText.ToString())
            End If

        Catch ex As Exception
            SetQuestionDetailsView(NotLoadedView)
        End Try

    End Sub

    Public Function GetTotalResponsesValue() As String

        Dim TotalClicks As Integer = 0

        For Each ri As SurveyResponse In CurrentSurvey.Responses

            '# Check this response has answers
            Dim ResultList = (From dr In ri.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestion.ID AndAlso Not String.IsNullOrEmpty(dr.AnswerValue) Select dr).ToList()

            If ResultList.Count > 0 Then
                TotalClicks += ResultList.Count()
            End If

        Next

        Return TotalClicks.ToString()

    End Function
#End Region

#Region "Event Handlers"
    Protected Sub lnkBarChart_Click(sender As Object, e As EventArgs) Handles lnkBarChart.Click
        If Page.IsValid Then
            LoadColumnChart()
        End If
    End Sub

    Protected Sub lnkPieChart_Click(sender As Object, e As EventArgs) Handles lnkPieChart.Click
        If Page.IsValid Then
            LoadPieChart()
        End If
    End Sub

    Protected Sub ddlChartDirection_SelectedIndexChanged(sender As Object, e As EventArgs) Handles ddlChartDirection.SelectedIndexChanged
        Select Case ddlChartDirection.SelectedValue
            Case "vertical"
                LoadColumnChart(ddlChartDataView.SelectedValue)
            Case "horizontal"
                LoadBarChart(ddlChartDataView.SelectedValue)
        End Select
    End Sub

    Protected Sub ddlChartDataView_SelectedIndexChanged(sender As Object, e As EventArgs) Handles ddlChartDataView.SelectedIndexChanged

        'Select Case ddlChartDirection.SelectedValue
        '    Case "vertical"
        '        CurrentView = ChartType.ColumnChart
        '    Case "horizontal"
        '        CurrentView = ChartType.BarChart
        'End Select

        Select Case CurrentView
            Case ChartType.PieChart
                LoadPieChart(ddlChartDataView.SelectedValue)
            Case ChartType.BarChart
                LoadBarChart(ddlChartDataView.SelectedValue)
            Case ChartType.ColumnChart
                LoadColumnChart(ddlChartDataView.SelectedValue)
        End Select

    End Sub
#End Region

End Class
