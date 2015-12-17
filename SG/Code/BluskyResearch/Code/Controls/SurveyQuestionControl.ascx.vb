Imports System.Data
Imports PingLibrary
Imports PingCore.MySystem
Imports PingSurveys
Imports PingSurveys.SurveyLibrary
Imports System.IO

Partial Class Controls_SurveyQuestionControl
    Inherits System.Web.UI.UserControl

    Event ReLoadSurveyDetails()

    Public Event FilterClicked As EventHandler

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

#Region "CurrentSurvey"
    Protected ReadOnly Property CurrentSurvey() As Survey
        Get
            Return LocalSiteInterface.CurrentSurveyControl.CurrentSurvey
        End Get
    End Property
#End Region

#Region "SurveyID"
    Protected ReadOnly Property SurveyID() As Integer
        Get
            Return LocalSiteInterface.CurrentSurveyControl.SurveyID
        End Get
    End Property
#End Region

#Region "CurrentSurveyQuestion"
    Public _CurrentSurveyQuestion As SurveyQuestion
    Public Property CurrentSurveyQuestion() As SurveyQuestion
        Get
            Return _CurrentSurveyQuestion
        End Get
        Set(ByVal value As SurveyQuestion)
            _CurrentSurveyQuestion = value
        End Set
    End Property
#End Region

#Region "CurrentSurveyQuestionID"
    Public ReadOnly Property CurrentSurveyQuestionID() As Integer
        Get
            If CurrentSurveyQuestion IsNot Nothing Then
                Return CurrentSurveyQuestion.ID
            Else
                Return 0
            End If
        End Get
    End Property
#End Region

#Region "IsSubQuestion"
    Public _IsSubQuestion As Boolean
    Public Property IsSubQuestion() As Boolean
        Get
            Return _IsSubQuestion
        End Get
        Set(ByVal value As Boolean)
            _IsSubQuestion = value
        End Set
    End Property
#End Region

#Region "ItemCount"
    Public _ItemCount As Integer
    Public Property ItemCount() As Integer
        Get
            Return _ItemCount
        End Get
        Set(ByVal value As Integer)
            _ItemCount = value
        End Set
    End Property
#End Region

#Region "TotalClicks"
    Public Property TotalClicks() As Integer
        Get
            Dim _TotalClicks As Integer = 0
            Int32.TryParse(ViewState("TotalClicks"), _TotalClicks)
            Return _TotalClicks
        End Get
        Set(ByVal value As Integer)
            ViewState("TotalClicks") = value
        End Set
    End Property
#End Region

#Region "TotalResponses"
    Public Property TotalResponses() As Integer
        Get
            Dim _TotalResponses As Integer = 0
            Int32.TryParse(ViewState("TotalResponses"), _TotalResponses)
            Return _TotalResponses
        End Get
        Set(ByVal value As Integer)
            ViewState("TotalResponses") = value
        End Set
    End Property
#End Region

    Protected Sub Page_Load(sender As Object, e As EventArgs) Handles Me.Load
    End Sub

#Region "Survey Question"
    Public Sub LoadSurveyQuestion()

        If CurrentSurveyQuestion IsNot Nothing Then

            '# Set view
            SetSurveyQuestionDetailsView(LoadedView)

            '# Load data
            Dim sq As SurveyQuestion = CurrentSurveyQuestion

            '# Options
            Dim OptionsList As List(Of SurveyOption) = sq.Options

            '# Survey responses
            Dim NotAnswered As Integer = 0

            Dim ResponseID As Integer = 0
            Dim ResponseItems As List(Of SurveyResponse) = CurrentSurvey.Responses
            Dim FilteredResponseItems As New List(Of SurveyResponse)
            Dim QuestionsResponses As New List(Of KeyValuePair(Of Integer, SurveyResponseQuestion))


            If OptionsList.Count > 0 Then

                For Each so As SurveyOption In OptionsList

                    For Each ri As SurveyResponse In CurrentSurvey.Responses

                        Dim ResultList = (From dr In ri.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.AnswerValue = so.Value Select dr).ToList()

                        If ResultList.Count() <= 0 AndAlso so.Value.ToLower.Contains("other") Then

                            Dim rqListID As New List(Of SurveyResponseQuestion)

                            If CurrentSurveyQuestion.SubType = "radio" Then
                                ResultList = (From dr In ri.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.OptionID = so.ID Select dr).ToList()
                                'rqListID = (From dr In ri.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.AnswerValue.ToLower.Contains("other") AndAlso dr.OptionID = so.ID Select dr).ToList()
                            Else
                                ResultList = (From dr In ri.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.AnswerValue.ToLower.Contains("other") AndAlso dr.OptionID = so.ID Select dr).ToList()
                            End If

                        End If

                        If ResultList.Count > 0 Then
                            TotalResponses += 1
                            TotalClicks += ResultList.Count()

                            FilteredResponseItems.Add(ri)
                        End If

                        '# Check this response is empty
                        Dim NotAnsweredResultList = (From dr In ri.ResponseQuestions Where dr.QuestionID = sq.ID AndAlso String.IsNullOrEmpty(dr.AnswerValue) Select dr).ToList()
                        If NotAnsweredResultList.Count > 0 Then NotAnswered += 1

                        '# Get the questions from the responses that match the current survey question
                        For Each rq As SurveyResponseQuestion In ri.ResponseQuestions
                            If rq.QuestionID = sq.ID AndAlso Not String.IsNullOrEmpty(rq.AnswerValue) Then
                                Dim Result As New KeyValuePair(Of Integer, SurveyResponseQuestion)(ri.ResponseID, rq)
                                QuestionsResponses.Add(Result)
                            End If
                        Next

                        '# Filter the ResponseQuestions
                        Dim frq = (From dr In ri.ResponseQuestions Where dr.QuestionID = 3 AndAlso dr.AnswerValue = "Stayed previously" Select dr).ToList()
                        If frq IsNot Nothing AndAlso frq.Count() > 0 Then
                            FilteredResponseItems.Add(ri)
                        End If


                    Next

                Next

            Else

                For Each ri As SurveyResponse In ResponseItems

                    '# Check this response has answers
                    Dim ResultList = (From dr In ri.ResponseQuestions Where dr.QuestionID = sq.ID AndAlso Not String.IsNullOrEmpty(dr.AnswerValue) Select dr).ToList()

                    If ResultList.Count > 0 Then
                        TotalResponses += 1
                        TotalClicks += ResultList.Count()

                        FilteredResponseItems.Add(ri)
                    End If

                    '# Check this response is empty
                    Dim NotAnsweredResultList = (From dr In ri.ResponseQuestions Where dr.QuestionID = sq.ID AndAlso String.IsNullOrEmpty(dr.AnswerValue) Select dr).ToList()
                    If NotAnsweredResultList.Count > 0 Then NotAnswered += 1

                    '# Get the questions from the responses that match the current survey question
                    For Each rq As SurveyResponseQuestion In ri.ResponseQuestions
                        If rq.QuestionID = sq.ID AndAlso Not String.IsNullOrEmpty(rq.AnswerValue) Then
                            Dim Result As New KeyValuePair(Of Integer, SurveyResponseQuestion)(ri.ResponseID, rq)
                            QuestionsResponses.Add(Result)
                        End If
                    Next

                    '# Filter the ResponseQuestions
                    Dim frq = (From dr In ri.ResponseQuestions Where dr.QuestionID = 3 AndAlso dr.AnswerValue = "Stayed previously" Select dr).ToList()
                    If frq IsNot Nothing AndAlso frq.Count() > 0 Then
                        FilteredResponseItems.Add(ri)
                    End If

                Next

            End If



            '# Get stats
            Dim StatisticItem As SurveyStatistic = sq.Statistics

            '# Clicks
            'If StatisticItem.SurveyStatisticBreakdown IsNot Nothing AndAlso StatisticItem.SurveyStatisticBreakdown.Count > 0 Then
            '    For Each bi As SurveyStatisticBreakdownItem In StatisticItem.SurveyStatisticBreakdown
            '        TotalClicks += bi.Count
            '    Next
            'End If

            '# Check for Number questions
            Dim IsNumberQuestion As Boolean = False

            If CurrentSurvey.ID = "1541759" Then
                '# The 2014 RICS and Macdonald & Company UK Rewards and Attitudes Survey
                If ItemCount = 15 OrElse ItemCount = 16 OrElse ItemCount = 17 OrElse ItemCount = 20 OrElse ItemCount = 22 Then
                    IsNumberQuestion = True
                End If
            ElseIf CurrentSurvey.ID = "1607485" Then
                '# The 2014 RICS and Macdonald & Company UK Rewards and Attitudes Survey
                If ItemCount = 15 OrElse ItemCount = 16 OrElse ItemCount = 17 OrElse ItemCount = 20 OrElse ItemCount = 22 Then
                    IsNumberQuestion = True
                End If
            ElseIf CurrentSurvey.ID = "1541763" Then
                '# The 2014 RICS and Macdonald &amp; Company Middle East Rewards and Attitudes Survey
                If ItemCount = 17 OrElse ItemCount = 18 OrElse ItemCount = 19 OrElse ItemCount = 22 OrElse ItemCount = 24 Then
                    IsNumberQuestion = True
                End If
            ElseIf CurrentSurvey.ID = "1541784" Then
                '# The 2014 RICS and Macdonald &amp; Company Europe Rewards and Attitudes Survey
                If ItemCount = 15 OrElse ItemCount = 16 OrElse ItemCount = 17 OrElse ItemCount = 20 OrElse ItemCount = 22 Then
                    IsNumberQuestion = True
                End If
            ElseIf CurrentSurvey.ID = "1562646" Then
                '# The 2014 RICS and Macdonald &amp; Company Asia Rewards and Attitudes Survey
                If ItemCount = 19 OrElse ItemCount = 21 OrElse ItemCount = 22 OrElse ItemCount = 25 OrElse ItemCount = 27 Then
                    IsNumberQuestion = True
                End If

                '# New 10/02/2015

            ElseIf CurrentSurvey.ID = "1997578" Then
                '# The 2015 RICS and Macdonald & Company UK Rewards and Attitudes Survey
                'If ItemCount = 16 OrElse ItemCount = 17 OrElse ItemCount = 18 OrElse ItemCount = 26 OrElse ItemCount = 30 Then
                If ItemCount = 15 OrElse ItemCount = 16 OrElse ItemCount = 17 OrElse ItemCount = 20 OrElse ItemCount = 22 Then
                    IsNumberQuestion = True
                End If

            ElseIf CurrentSurvey.ID = "1997614" Then
                '# The 2015 RICS and Macdonald & Company Asia Rewards and Attitudes Survey
                'If ItemCount = 23 OrElse ItemCount = 25 OrElse ItemCount = 26 OrElse ItemCount = 29 OrElse ItemCount = 31 Then
                If ItemCount = 19 OrElse ItemCount = 21 OrElse ItemCount = 22 OrElse ItemCount = 25 OrElse ItemCount = 27 Then
                    IsNumberQuestion = True
                End If

            ElseIf CurrentSurvey.ID = "1997670" Then
                '# The 2015 RICS and Macdonald & Company Middle East Rewards and Attitudes Survey
                'If ItemCount = 19 OrElse ItemCount = 20 OrElse ItemCount = 21 OrElse ItemCount = 24 OrElse ItemCount = 26 Then
                If ItemCount = 17 OrElse ItemCount = 18 OrElse ItemCount = 19 OrElse ItemCount = 22 OrElse ItemCount = 24 Then
                    IsNumberQuestion = True
                End If

            ElseIf CurrentSurvey.ID = "1997681" Then
                '# The 2015 RICS and Macdonald & Company Europe Rewards and Attitudes Survey
                'If ItemCount = 16 OrElse ItemCount = 17 OrElse ItemCount = 18 OrElse ItemCount = 26 OrElse ItemCount = 30 Then
                If ItemCount = 15 OrElse ItemCount = 16 OrElse ItemCount = 17 OrElse ItemCount = 20 OrElse ItemCount = 22 Then
                    IsNumberQuestion = True
                End If

            Else
                '# Loop through properties to find the map_key
                For Each p In sq.Properties
                    If p.Key = "map_key" Then
                        If Not String.IsNullOrEmpty(p.Value) Then
                            If p.Value.ToLower() = "number" Then
                                IsNumberQuestion = True
                                Exit For
                            End If
                        End If
                    End If
                Next
            End If

            '# Graph flag
            Dim ShowGraph As Boolean = False

            If sq IsNot Nothing Then

                Dim SubType As String = sq.SubType
                If IsNumberQuestion Then SubType = "number"

                '# Set class
                If ItemCount = 1 Then
                    si_item.Attributes.Add("class", "survey_item survey_item_start clearfix si_" & SubType)
                Else
                    si_item.Attributes.Add("class", "survey_item clearfix si_" & SubType)
                End If

                '# Set title
                If IsSubQuestion Then
                    litQuestionTitle.Text = GlobalMethods.StripHTML(sq.Title)
                Else
                    litQuestionTitle.Text = "<span class=""bold"">Question " & ItemCount.ToString() & ": </span>" & GlobalMethods.StripHTML(sq.Title)
                End If

                '# Set count values
                If IsSubQuestion Then
                    SetCountValues(False, False, False)
                Else
                    SetCountValues(True, True, False, TotalClicks, TotalResponses, NotAnswered)
                End If

                '# Set view
                If Not IsSubQuestion Then

                    Select Case SubType
                        Case "table"
                            mvQuestion.ActiveViewIndex = 1

                            '# Load possible answers
                            With rptTableSubQuestionAnswers
                                .DataSource = sq.Options
                                .DataBind()
                            End With

                            With rptTableSubQuestions
                                .DataSource = sq.SubQuestions
                                .DataBind()
                            End With

                            si_item.Attributes.Add("class", "survey_item survey_item_parent clearfix")
                            si_dataitem.Attributes.Add("class", "si_data si_data_parent")

                            '# Totals
                            'Dim sqClicks As Integer = 0
                            'Dim sqResponses As Integer = 0

                            'For Each SubQuestion As SurveyQuestion In sq.SubQuestions

                            '    '# Get stats
                            '    Dim sqStatisticItem As SurveyStatistic = SubQuestion.Statistics

                            '    '# Clicks
                            '    If sqStatisticItem.SurveyStatisticBreakdown IsNot Nothing AndAlso sqStatisticItem.SurveyStatisticBreakdown.Count > 0 Then
                            '        For Each bi As SurveyStatisticBreakdownItem In sqStatisticItem.SurveyStatisticBreakdown
                            '            sqClicks += bi.Count
                            '        Next
                            '    End If

                            '    sqResponses += TotalResponses

                            'Next

                            '# Totals
                            SetCountValues(False, False, False)

                            '# Graph
                            ShowGraph = False

                        Case "radio"
                            mvQuestion.ActiveViewIndex = 2

                            With rptRadioOptions
                                .DataSource = sq.Options
                                .DataBind()
                            End With

                            '# Graph
                            ShowGraph = True

                            '# View responses link
                            Dim OtherOption As SurveyOption = (From dr In sq.Options Where dr.Value.ToLower().Contains("other") Select dr).FirstOrDefault()
                            If OtherOption IsNot Nothing Then
                                btnTextViewButtonRadio.Attributes.Add("onclick", "javascript:window.open('/surveys/text-details.aspx?sq=" & CurrentSurveyQuestionID & "&so=" & OtherOption.ID & "&no=" & ItemCount.ToString() & "','','width=750,height=595'); return false;")
                            Else
                                btnTextViewButtonRadio.Visible = False
                            End If

                            'Dim OtherResponseList = (From dr In QuestionsResponses Where dr.Value.AnswerValue.Contains("Other") Select New PlainTextValue(dr.Value.QuestionID, CurrentSurveyQuestion.Title, dr.Value.AnswerValue.Replace("Other: ", ""), dr.Key)).ToList()

                            'If OtherResponseList IsNot Nothing AndAlso OtherResponseList.Count() > 0 Then
                            '    pnlTextViewButtonRadio.Visible = True
                            '    pnlTextValues.Visible = True
                            '    pnlTextValues.CssClass = "s_modal si_modal_textvalues si_modal_textvalues_" & sq.ID
                            '    lblTextValuesTitle.Text = "<span class=""bold"">Question " & ItemCount.ToString() & ": </span>" & GlobalMethods.StripHTML(sq.Title)

                            '    With lvTextValues
                            '        .DataSource = OtherResponseList
                            '        .DataBind()
                            '    End With

                            '    With lvTextValuesRadio
                            '        .DataSource = OtherResponseList
                            '        .DataBind()
                            '    End With
                            'Else
                            '    pnlTextViewButtonRadio.Visible = False
                            '    pnlTextValues.Visible = False
                            '    div_text_values.Attributes.Add("class", "si_values si_values_hidden")
                            'End If

                        Case "checkbox"
                            mvQuestion.ActiveViewIndex = 3

                            With rptCheckboxOptions
                                .DataSource = sq.Options
                                .DataBind()
                            End With

                            '# Graph
                            ShowGraph = True

                            '# View responses link
                            Dim OtherOption As SurveyOption = (From dr In sq.Options Where dr.Value.ToLower().Contains("other") Select dr).FirstOrDefault()
                            If OtherOption IsNot Nothing Then
                                btnTextViewButtonCheckbox.Attributes.Add("onclick", "javascript:window.open('/surveys/text-details.aspx?sq=" & CurrentSurveyQuestionID & "&so=" & OtherOption.ID & "&no=" & ItemCount.ToString() & "','','width=750,height=595'); return false;")
                            Else
                                btnTextViewButtonCheckbox.Visible = False
                            End If

                            'Dim OtherResponseList = (From dr In QuestionsResponses Where dr.Value.AnswerValue.Contains("Other") Select New PlainTextValue(dr.Value.QuestionID, CurrentSurveyQuestion.Title, dr.Value.AnswerValue.Replace("Other: ", ""), dr.Key)).ToList()

                            'If OtherResponseList IsNot Nothing AndAlso OtherResponseList.Count() > 0 Then
                            '    pnlTextViewButtonCheckbox.Visible = True
                            '    pnlTextValues.Visible = True
                            '    pnlTextValues.CssClass = "s_modal si_modal_textvalues si_modal_textvalues_" & sq.ID
                            '    lblTextValuesTitle.Text = "<span class=""bold"">Question " & ItemCount.ToString() & ": </span>" & GlobalMethods.StripHTML(sq.Title)

                            '    With lvTextValues
                            '        .DataSource = OtherResponseList
                            '        .DataBind()
                            '    End With

                            '    With lvTextValuesCheckbox
                            '        .DataSource = OtherResponseList
                            '        .DataBind()
                            '    End With
                            'Else
                            '    pnlTextViewButtonCheckbox.Visible = False
                            '    pnlTextValues.Visible = False
                            'End If

                        Case "menu"
                            mvQuestion.ActiveViewIndex = 4

                            With rptMenuOptions
                                .DataSource = sq.Options
                                .DataBind()
                            End With

                            '# Graph
                            ShowGraph = True

                            '# View responses link
                            Dim OtherOption As SurveyOption = (From dr In sq.Options Where dr.Value.ToLower().Contains("other") Select dr).FirstOrDefault()
                            If OtherOption IsNot Nothing Then
                                btnTextViewButtonMenu.Attributes.Add("onclick", "javascript:window.open('/surveys/text-details.aspx?sq=" & CurrentSurveyQuestionID & "&so=" & OtherOption.ID & "&no=" & ItemCount.ToString() & "','','width=750,height=595'); return false;")
                            Else
                                btnTextViewButtonMenu.Visible = False
                            End If

                            'Dim OtherResponseList = (From dr In QuestionsResponses Where dr.Value.AnswerValue.Contains("Other") Select New PlainTextValue(dr.Value.QuestionID, CurrentSurveyQuestion.Title, dr.Value.AnswerValue.Replace("Other: ", ""), dr.Key)).ToList()

                            'If OtherResponseList IsNot Nothing AndAlso OtherResponseList.Count() > 0 Then
                            '    pnlTextViewButtonMenu.Visible = True
                            '    pnlTextValues.Visible = True
                            '    pnlTextValues.CssClass = "s_modal si_modal_textvalues si_modal_textvalues_" & sq.ID
                            '    lblTextValuesTitle.Text = "<span class=""bold"">Question " & ItemCount.ToString() & ": </span>" & GlobalMethods.StripHTML(sq.Title)

                            '    With lvTextValues
                            '        .DataSource = OtherResponseList
                            '        .DataBind()
                            '    End With

                            '    With lvTextValuesMenu
                            '        .DataSource = OtherResponseList
                            '        .DataBind()
                            '    End With
                            'Else
                            '    pnlTextViewButtonMenu.Visible = False
                            '    pnlTextValues.Visible = False
                            'End If

                        Case "rank"
                            mvQuestion.ActiveViewIndex = 5

                            '# Load possible answers
                            Dim RankValues As New List(Of Integer)
                            For i As Integer = 1 To CInt(StatisticItem.Max)
                                RankValues.Add(i)
                            Next

                            With rptRankSubQuestionAnswers
                                .DataSource = RankValues
                                .DataBind()
                            End With

                            With rptRankSubQuestions
                                .DataSource = sq.Options
                                .DataBind()
                            End With

                            si_item.Attributes.Add("class", "survey_item survey_item_parent clearfix")
                            si_dataitem.Attributes.Add("class", "si_data si_data_parent")

                            '# Totals
                            SetCountValues(False, True, False, 0, TotalResponses)

                        Case "multi_textbox"
                            mvQuestion.ActiveViewIndex = 6
                            si_item.Attributes.Add("class", "survey_item clearfix si_essay si_" & sq.SubType)

                            '# Filter out the responses
                            Dim FilteredQuestionsResponses = (From dr In QuestionsResponses Where String.IsNullOrEmpty(dr.Value.AnswerValue) = False Select New MultiTextBoxGroup(dr.Value.QuestionID, CurrentSurveyQuestion.Title, dr.Key)).Distinct.ToList()
                            Dim FilteredQuestionsResponsesDistinct As New List(Of MultiTextBoxGroup)

                            For Each mtg In FilteredQuestionsResponses
                                Dim FilterRecordMatch As MultiTextBoxGroup = (From dr In FilteredQuestionsResponsesDistinct Where dr.QuestionID = mtg.QuestionID AndAlso dr.CurrentResponseID = mtg.CurrentResponseID Select dr).FirstOrDefault()
                                If FilterRecordMatch Is Nothing Then FilteredQuestionsResponsesDistinct.Add(mtg)
                            Next

                            '# Now get each question within the response question
                            For Each mtg In FilteredQuestionsResponsesDistinct
                                Dim MultiTextBoxAnswers = (From dr In QuestionsResponses Where dr.Key = mtg.CurrentResponseID AndAlso dr.Value.QuestionID = mtg.QuestionID Select New MultiTextBoxValue(dr.Value.OptionID, GetOptionTitle(sq.Options, dr.Value.OptionID), dr.Value.AnswerValue)).ToList()
                                mtg.SetAnswerValues(MultiTextBoxAnswers)
                            Next

                            '# Totals
                            SetCountValues(False, True, False, 0, FilteredQuestionsResponsesDistinct.Count())

                            ' Dim FilteredQuestionsResponsesDistinct = (From dr In FilteredQuestionsResponses Select dr).Distinct().ToList()

                            '# View responses link
                            btnTextViewButtonMulti.Attributes.Add("onclick", "javascript:window.open('/surveys/multitext-details.aspx?sq=" & CurrentSurveyQuestionID & "&no=" & ItemCount.ToString() & "','responses','width=1160,height=595'); return false;")

                        Case "number"
                            mvQuestion.ActiveViewIndex = 7

                            '# Calculate values
                            Dim TotalQuestionsResponses As Integer = 0

                            '# Mean
                            Dim MeanTotal As Decimal = 0D
                            For Each res In QuestionsResponses
                                Dim LocalValue As Decimal = 0D
                                Decimal.TryParse(res.Value.AnswerValue, LocalValue)
                                If LocalValue > 0D Then
                                    MeanTotal += LocalValue
                                    TotalQuestionsResponses += 1
                                End If
                            Next

                            Dim AverageMeanText As String = "N/A"
                            If TotalQuestionsResponses > 0 AndAlso MeanTotal > 0 Then
                                Dim MeanAverage As Decimal = MeanTotal / TotalQuestionsResponses
                                AverageMeanText = MeanAverage.ToString("#,##0.00")
                            End If

                            litAverageMean.Text = AverageMeanText

                            '# Graph
                            ShowGraph = False

                        Case Else
                            mvQuestion.ActiveViewIndex = 0

                            '# Filter to ones with answers
                            Dim FilteredQuestionsResponses = (From dr In QuestionsResponses Where String.IsNullOrEmpty(dr.Value.AnswerValue) = False Select New PlainTextValue(dr.Value.QuestionID, CurrentSurveyQuestion.Title, dr.Value.AnswerValue, dr.Key)).ToList()

                            'With lvText
                            '    .DataSource = FilteredQuestionsResponses
                            '    .DataBind()
                            'End With

                            '# View responses link
                            btnTextViewButton.Attributes.Add("onclick", "javascript:window.open('/surveys/text-details.aspx?sq=" & CurrentSurveyQuestionID & "&no=" & ItemCount.ToString() & "','responses','width=750,height=595'); return false;")

                            '# Not Answered count
                            'Dim QuestionsResponsesUnanswered = (From dr In QuestionsResponses Where String.IsNullOrEmpty(dr.Value.AnswerValue) = True Select dr.Value.QuestionID).Count()

                            ''# Totals
                            'SetCountValues(False, True, True, TotalClicks, FilteredQuestionsResponses.Count(), QuestionsResponsesUnanswered)

                            ''# Graph
                            'ShowGraph = False

                            ''# Text values
                            'If FilteredQuestionsResponses IsNot Nothing AndAlso FilteredQuestionsResponses.Count() > 0 Then
                            '    pnlTextViewButton.Visible = True
                            '    pnlTextValues.Visible = True
                            '    pnlTextValues.CssClass = "s_modal si_modal_textvalues si_modal_textvalues_" & sq.ID
                            '    lblTextValuesTitle.Text = "<span class=""bold"">Question " & ItemCount.ToString() & ": </span>" & GlobalMethods.StripHTML(sq.Title)

                            '    With lvTextValues
                            '        .DataSource = FilteredQuestionsResponses
                            '        .DataBind()
                            '    End With
                            'Else
                            '    pnlTextViewButton.Visible = False
                            '    pnlTextValues.Visible = False
                            'End If

                    End Select
                Else

                End If
                
                '# Check to see if we can view the responses for this question
                Dim HideSurveyQuestion As Boolean = Not CurrentSurvey.CanViewQuestionDetails(ItemCount)

                If HideSurveyQuestion Then
                    btnTextViewButtonRadio.Visible = False
                    btnTextViewButtonCheckbox.Visible = False
                    btnTextViewButtonMenu.Visible = False
                    btnTextViewButtonMulti.Visible = False
                    btnTextViewButton.Visible = False
                End If

                '# Graph
                If ShowGraph Then
                    lnkViewGraphs.Visible = True
                    LoadGraph()
                End If
            End If


        Else
            SetSurveyQuestionDetailsView(CantLoadView)
        End If

    End Sub

    Protected Sub SetSurveyQuestionDetailsView(RequiredView As View)
        mvSurveyQuestionDetails.SetActiveView(RequiredView)
    End Sub

    Public Sub SetCountValues(ShowClicks As Boolean, ShowResponses As Boolean, ShowNotAnswered As Boolean, Optional ClickValue As Integer = 0, Optional ResponsesValue As Integer = 0, Optional NotAnsweredValue As Integer = 0)

        If div_TotalClicks IsNot Nothing AndAlso lblTotalClicks IsNot Nothing Then
            div_TotalClicks.Visible = ShowClicks
            lblTotalClicks.Text = ClickValue.ToString()
        End If

        If div_TotalResponses IsNot Nothing AndAlso lblTotalResponses IsNot Nothing Then
            div_TotalResponses.Visible = ShowResponses
            lblTotalResponses.Text = ResponsesValue.ToString()
        End If

        If div_TotalNotAnswered IsNot Nothing AndAlso lblTotalNotAnswered IsNot Nothing Then
            div_TotalNotAnswered.Visible = ShowNotAnswered
            lblTotalNotAnswered.Text = NotAnsweredValue.ToString()
        End If

    End Sub

    Protected Function GetOptionTitle(Options As List(Of SurveyOption), OptionID As String) As String
        Dim OptionTitle As String = (From dr In Options Where dr.ID = OptionID Select dr.Title).FirstOrDefault()
        If String.IsNullOrEmpty(OptionTitle) Then OptionTitle = "Question Answer"
        Return OptionTitle
    End Function

#End Region

#Region "Text Values"
    'Protected Sub lvText_ItemDataBound(sender As Object, e As ListViewItemEventArgs) Handles lvText.ItemDataBound
    '    Select Case e.Item.ItemType
    '        Case ListViewItemType.DataItem

    '            Dim ptv As PlainTextValue = CType(e.Item.DataItem, PlainTextValue)

    '            Dim lnkSetAnswerFilter As LinkButton = CType(e.Item.FindControl("lnkSetAnswerFilter"), LinkButton)

    '            '# Set filter values
    '            If lnkSetAnswerFilter IsNot Nothing Then
    '                lnkSetAnswerFilter.CommandArgument = "[" & ptv.QuestionID & "~" & ptv.QuestionTitle & "~0~ ~" & ptv.AnswerValue & "~" & ItemCount.ToString() & "~" & ItemCount.ToString() & "]"
    '            End If

    '    End Select
    'End Sub
#End Region

#Region "Options"
    Protected Sub OptionsRepeaterItemDataBound(sender As Object, e As RepeaterItemEventArgs)
        Select Case e.Item.ItemType
            Case ListItemType.Item, ListItemType.SelectedItem, ListItemType.AlternatingItem

                Dim so As SurveyOption = CType(e.Item.DataItem, SurveyOption)
                Dim lblAmountFilled As Label = CType(e.Item.FindControl("lblAmountFilled"), Label)
                Dim lblResult As Label = CType(e.Item.FindControl("lblResult"), Label)
                Dim lnkSetAnswerFilter As LinkButton = CType(e.Item.FindControl("lnkSetAnswerFilter"), LinkButton)

                Dim Count As Integer = 0

                If CurrentSurveyQuestion.SubType = "radio" Then
                    Dim x = "pause"
                End If

                If so IsNot Nothing Then

                    '# Survey responses
                    For Each ri As SurveyResponse In CurrentSurvey.Responses

                        Dim rqList = (From dr In ri.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.AnswerValue = so.Value Select dr).ToList()

                        If rqList.Count() <= 0 AndAlso so.Value.ToLower.Contains("other") Then

                            Dim rqListID As New List(Of SurveyResponseQuestion)

                            If CurrentSurveyQuestion.SubType = "radio" Then
                                rqListID = (From dr In ri.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.OptionID = so.ID Select dr).ToList()
                                'rqListID = (From dr In ri.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.AnswerValue.ToLower.Contains("other") AndAlso dr.OptionID = so.ID Select dr).ToList()
                            Else
                                rqListID = (From dr In ri.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.AnswerValue.ToLower.Contains("other") AndAlso dr.OptionID = so.ID Select dr).ToList()
                            End If

                            Count += rqListID.Count()
                        End If

                        Count += rqList.Count()
                    Next

                    Dim Percentage As Decimal = 0
                    'If TotalResponses > 0 Then Percentage = Math.Round(((100 / TotalResponses) * Count), 1)
                    If TotalClicks > 0 Then Percentage = Math.Round(((100 / TotalClicks) * Count), 1)
                    Dim WidthValue As Decimal = Percentage * 3

                    'lblAmountFilled.Attributes.Add("style", "width:" & WidthValue.ToString() & "px;")
                    lblAmountFilled.Attributes.Add("style", "width:" & Percentage.ToString() & "%;")
                    lblResult.Text = Count.ToString() & " / " & Percentage.ToString() & "%"

                    '# Set filter values
                    If lnkSetAnswerFilter IsNot Nothing Then
                        lnkSetAnswerFilter.CommandArgument = "[" & so.QuestionID & "~" & CurrentSurveyQuestion.Title & "~" & so.ID & "~" & so.Title & "~" & so.Value & "~" & ItemCount.ToString() & "]"
                    End If

                End If

        End Select
    End Sub
#End Region

#Region "SubQuestions"
    Protected Sub TableSubQuestionAnswersRepeaterItemDataBound(sender As Object, e As RepeaterItemEventArgs)
        Select Case e.Item.ItemType
            Case ListItemType.Item, ListItemType.SelectedItem, ListItemType.AlternatingItem

                Dim si_row_header_item As HtmlControl = CType(e.Item.FindControl("si_row_header_item"), HtmlControl)

                If si_row_header_item IsNot Nothing Then

                    Dim WidthOfWrapper As Integer = 440
                    Dim OptionCount As Integer = CurrentSurveyQuestion.Options.Count()
                    Dim WidthValue As Decimal = (WidthOfWrapper / OptionCount) - 8
                    Dim PercentageWidthValue As Decimal = (100 / OptionCount) - 1

                    'si_row_header_item.Attributes.Add("style", "width:" & WidthValue.ToString() & "px")
                    si_row_header_item.Attributes.Add("style", "width:" & PercentageWidthValue.ToString() & "%; padding:0 0 0 1%;")




                End If

        End Select
    End Sub

    Protected Sub SubQuestionsRepeaterItemDataBound(sender As Object, e As RepeaterItemEventArgs)
        Select Case e.Item.ItemType
            Case ListItemType.Item, ListItemType.SelectedItem, ListItemType.AlternatingItem

                Dim sq As SurveyQuestion = CType(e.Item.DataItem, SurveyQuestion)
                Dim rptTableSubQuestionResults As Repeater = CType(e.Item.FindControl("rptTableSubQuestionResults"), Repeater)
                Dim lblTotalResponses As Label = CType(e.Item.FindControl("lblTotalResponses"), Label)
                Dim lblTotalNotAnswered As Label = CType(e.Item.FindControl("lblTotalNotAnswered"), Label)

                If sq IsNot Nothing AndAlso rptTableSubQuestionResults IsNot Nothing Then

                    TotalResponses = 0

                    Dim ResponseID As Integer = 0
                    Dim ResponseItems As List(Of SurveyResponse) = CurrentSurvey.Responses
                    Dim QuestionsResponses As New List(Of KeyValuePair(Of Integer, SurveyResponseQuestion))
                    For Each ri As SurveyResponse In ResponseItems
                        For Each rq As SurveyResponseQuestion In ri.ResponseQuestions
                            If rq.QuestionID = sq.ID Then
                                Dim Result As New KeyValuePair(Of Integer, SurveyResponseQuestion)(ri.ResponseID, rq)
                                QuestionsResponses.Add(Result)
                                'ResponseID = ri.ResponseID
                            End If
                        Next

                        Dim ResultList = (From dr In ri.ResponseQuestions Where dr.QuestionID = sq.ID AndAlso Not String.IsNullOrEmpty(dr.AnswerValue) Select dr).ToList()

                        If ResultList.Count > 0 Then
                            TotalResponses += 1
                            TotalClicks += ResultList.Count()
                        End If

                    Next

                    With rptTableSubQuestionResults
                        .DataSource = sq.Options
                        .DataBind()
                    End With

                    '# Calc Totals 
                    'Dim sqResponses As Integer = sq.Statistics.TotalResponses
                    Dim sqResponses As Integer = TotalResponses

                    If lblTotalResponses IsNot Nothing Then
                        lblTotalResponses.Text = sqResponses.ToString()
                    End If

                    If lblTotalNotAnswered IsNot Nothing Then
                        lblTotalNotAnswered.Text = 0.ToString()
                    End If

                End If

        End Select
    End Sub

    Protected Sub TableSubQuestionResultsRepeaterItemDataBound(sender As Object, e As RepeaterItemEventArgs)
        Select Case e.Item.ItemType
            Case ListItemType.Item, ListItemType.SelectedItem, ListItemType.AlternatingItem

                Dim so As SurveyOption = CType(e.Item.DataItem, SurveyOption)
                Dim lblResult As Label = CType(e.Item.FindControl("lblResult"), Label)
                Dim si_row_data_item As HtmlControl = CType(e.Item.FindControl("si_row_data_item"), HtmlControl)
                Dim lnkSetAnswerFilter As LinkButton = CType(e.Item.FindControl("lnkSetAnswerFilter"), LinkButton)

                If so IsNot Nothing Then

                    Dim Count As Integer = 0

                    '# Survey responses
                    Dim ResponseItems As List(Of SurveyResponse) = CurrentSurvey.Responses
                    Dim QuestionsResponses As New List(Of SurveyResponseQuestion)
                    For Each ri As SurveyResponse In ResponseItems

                        Dim rqList = (From dr In ri.ResponseQuestions Where dr.QuestionID = so.QuestionID AndAlso dr.AnswerValue = so.Value Select dr).ToList()

                        If rqList.Count() <= 0 AndAlso so.Value.ToLower.Contains("other") Then

                            Dim rqListID = (From dr In ri.ResponseQuestions Where dr.QuestionID = so.QuestionID AndAlso dr.AnswerValue.ToLower.Contains("other") AndAlso dr.OptionID = so.ID Select dr).ToList()

                            Count += rqListID.Count()
                            For Each rq As SurveyResponseQuestion In ri.ResponseQuestions
                                If rq.OptionID = so.ID Then
                                    QuestionsResponses.Add(rq)
                                End If
                            Next
                        End If

                        Count += rqList.Count()
                    Next

                    Dim Percentage As Decimal = 0
                    If TotalResponses > 0 Then Percentage = Math.Round(((100 / TotalResponses) * Count), 0)

                    lblResult.Text = Count.ToString() & " <br /> " & Percentage.ToString() & "%"

                    '# Set filter values
                    If lnkSetAnswerFilter IsNot Nothing Then
                        lnkSetAnswerFilter.CommandArgument = "[" & so.QuestionID & "~" & CurrentSurveyQuestion.Title & " " & so.QuestionTitle & "~" & so.ID & "~" & so.Title & "~" & so.Value & "~" & ItemCount.ToString() & "]"
                    End If

                    If si_row_data_item IsNot Nothing Then
                        si_row_data_item.Attributes.Add("class", "si_row si_row_data si_row_" & e.Item.ItemIndex.ToString())

                        Dim WidthOfWrapper As Integer = 440
                        Dim OptionCount As Integer = CurrentSurveyQuestion.Options.Count()
                        Dim WidthValue As Decimal = (WidthOfWrapper / OptionCount) - 8
                        Dim PercentageWidthValue As Decimal = (100 / OptionCount) - 1

                        'si_row_data_item.Attributes.Add("style", "width:" & WidthValue.ToString() & "px")
                        si_row_data_item.Attributes.Add("style", "width:" & PercentageWidthValue.ToString() & "%; padding:0 0 0 1%;")
                    End If

                End If

        End Select
    End Sub

    Protected Sub RankSubQuestionAnswersRepeaterItemDataBound(sender As Object, e As RepeaterItemEventArgs)
        Select Case e.Item.ItemType
            Case ListItemType.Item, ListItemType.SelectedItem, ListItemType.AlternatingItem

                Dim si_row_header_item As HtmlControl = CType(e.Item.FindControl("si_row_header_item"), HtmlControl)

                If si_row_header_item IsNot Nothing Then

                    Dim WidthOfWrapper As Integer = 440
                    Dim OptionCount As Integer = CurrentSurveyQuestion.Options.Count()
                    Dim WidthValue As Decimal = (WidthOfWrapper / OptionCount) - 8
                    Dim PercentageWidthValue As Decimal = (100 / OptionCount) - 1

                    'si_row_header_item.Attributes.Add("style", "width:" & WidthValue.ToString() & "px")
                    si_row_header_item.Attributes.Add("style", "width:" & PercentageWidthValue.ToString() & "%; padding:0 0 0 1%;")
                End If

        End Select
    End Sub

    Protected Sub RankSubQuestionsRepeaterItemDataBound(sender As Object, e As RepeaterItemEventArgs)
        Select Case e.Item.ItemType
            Case ListItemType.Item, ListItemType.SelectedItem, ListItemType.AlternatingItem

                Dim so As SurveyOption = CType(e.Item.DataItem, SurveyOption)
                Dim rptRankSubQuestionResults As Repeater = CType(e.Item.FindControl("rptRankSubQuestionResults"), Repeater)
                Dim lblTotalResponses As Label = CType(e.Item.FindControl("lblTotalResponses"), Label)
                Dim lblTotalNotAnswered As Label = CType(e.Item.FindControl("lblTotalNotAnswered"), Label)
                Dim lblResult As Label = CType(e.Item.FindControl("lblResult"), Label)

                If so IsNot Nothing Then

                    Dim ResponseID As Integer = 0
                    Dim ResponseItems As List(Of SurveyResponse) = CurrentSurvey.Responses
                    Dim QuestionsResponses As New List(Of KeyValuePair(Of Integer, SurveyResponseQuestion))
                    For Each ri As SurveyResponse In ResponseItems
                        For Each rq As SurveyResponseQuestion In ri.ResponseQuestions
                            If rq.QuestionID = CurrentSurveyQuestion.ID Then
                                Dim Result As New KeyValuePair(Of Integer, SurveyResponseQuestion)(ri.ResponseID, rq)
                                QuestionsResponses.Add(Result)
                                ResponseID = ri.ResponseID
                            End If
                        Next

                    Next

                    '# Filter to ones with answers
                    Dim FilteredQuestionsResponses = (From dr In QuestionsResponses Where dr.Value.OptionID = so.ID And String.IsNullOrEmpty(dr.Value.AnswerValue) = False Select dr.Value.QuestionID, dr.Value.AnswerValue, CurrentResponseID = dr.Key).ToList()

                    '# Load possible answers
                    Dim RankValues As New List(Of RankValue)

                    If FilteredQuestionsResponses IsNot Nothing AndAlso FilteredQuestionsResponses.Count() > 0 Then
                        For i As Integer = 1 To CInt(CurrentSurveyQuestion.Statistics.Max)

                            Dim ItemsRanked As Integer = (From dr In FilteredQuestionsResponses Where dr.AnswerValue = i.ToString() Select dr).Count()

                            Dim ItemPercentage As Integer = Math.Round(((100 / FilteredQuestionsResponses.Count()) * ItemsRanked), 0)

                            Dim item As New RankValue(ItemsRanked, ItemPercentage, so.QuestionID, so.QuestionTitle, so.ID, so.Title, so.Value)

                            RankValues.Add(item)
                        Next
                    End If

                    With rptRankSubQuestionResults
                        .DataSource = RankValues
                        .DataBind()
                    End With

                    'Dim sqResponses As Integer = CurrentSurveyQuestion.Statistics.TotalResponses
                    Dim sqResponses As Integer = TotalResponses

                    '# Calc Totals 
                    If lblTotalResponses IsNot Nothing Then
                        lblTotalResponses.Text = FilteredQuestionsResponses.Count()
                    End If

                    If lblTotalNotAnswered IsNot Nothing Then
                        lblTotalNotAnswered.Text = (sqResponses - FilteredQuestionsResponses.Count())
                    End If

                End If

        End Select
    End Sub

    Protected Sub RankSubQuestionResultsRepeaterItemDataBound(sender As Object, e As RepeaterItemEventArgs)
        Select Case e.Item.ItemType
            Case ListItemType.Item, ListItemType.SelectedItem, ListItemType.AlternatingItem

                Dim so As RankValue = CType(e.Item.DataItem, RankValue)
                Dim lblResult As Label = CType(e.Item.FindControl("lblResult"), Label)
                Dim si_row_data_item As HtmlControl = CType(e.Item.FindControl("si_row_data_item"), HtmlControl)
                Dim lnkSetAnswerFilter As LinkButton = CType(e.Item.FindControl("lnkSetAnswerFilter"), LinkButton)

                lblResult.Text = so.ItemsRanked.ToString() & " <br /> " & so.ItemPercentage.ToString() & "%"

                '# Set filter values
                If lnkSetAnswerFilter IsNot Nothing Then
                    lnkSetAnswerFilter.CommandArgument = "[" & so.QuestionID & "~" & so.QuestionTitle & "~" & so.OptionID & "~" & so.OptionTitle & "~" & so.OptionValue & "~" & ItemCount.ToString() & "]"
                End If

                If si_row_data_item IsNot Nothing Then
                    si_row_data_item.Attributes.Add("class", "si_row si_row_data si_row_" & e.Item.ItemIndex.ToString())

                    Dim WidthOfWrapper As Integer = 440
                    Dim OptionCount As Integer = CurrentSurveyQuestion.Options.Count()
                    Dim PercentageWidthValue As Decimal = (100 / OptionCount) - 1

                    'si_row_data_item.Attributes.Add("style", "width:" & WidthValue.ToString() & "px")
                    si_row_data_item.Attributes.Add("style", "width:" & PercentageWidthValue.ToString() & "%; padding:0 0 0 1%;")
                End If

                'End If

        End Select
    End Sub

#End Region

#Region "Graph"
    Public Sub LoadGraph()

        '# Load graph if we have data
        If TotalResponses > 0 Then

            Dim sq As SurveyQuestion = CurrentSurveyQuestion
            Dim GraphID As String = "blgraph_" & sq.ID


            '# Build Results Array
            Dim ResultsArray As String = "[""Answers"", ""Responses""], "

            Select Case sq.SubType
                Case "radio", "checkbox", "menu", "rank"
                    For Each op As SurveyOption In sq.Options

                        '# Get stats
                        Dim AnswerCount As Integer = 0

                        '# Survey responses
                        For Each ri As SurveyResponse In CurrentSurvey.Responses

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

                        ResultsArray &= "[""" & HttpUtility.HtmlEncode(GlobalMethods.StripHTML(op.Title.Trim())) & """, " & AnswerCount.ToString() & "], "
                    Next
            End Select

            If Not String.IsNullOrEmpty(ResultsArray) AndAlso ResultsArray.Length > 2 Then
                ResultsArray = "[" & ResultsArray.Substring(0, ResultsArray.Length - 2) & "]"
            End If

            '# Add the placeholder chart control to the page
            Dim GraphHolder As HtmlGenericControl = New HtmlGenericControl("div")
            GraphHolder.ID = GraphID & "_wrapper"
            'GraphHolder.InnerHtml = "<div id=""" & GraphID & """ style=""width: 450px; height: 250px;""></div>"
            GraphHolder.InnerHtml = "<div id=""" & GraphID & """ class=""blgraph""></div><div id=""" & GraphID & "_large"" class=""blgraph blgraph_large""></div>"

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
                csText.Append("var " & GraphID & "resultArray = " & ResultsArray & "; ")
                csText.Append("LoadGraph('" & GraphID & "', " & GraphID & "resultArray, '" & HttpUtility.HtmlEncode(sq.Title) & "'); ")
                csText.Append("</script>")
                cs.RegisterClientScriptBlock(csType, csName, csText.ToString())
            End If

            lnkViewGraphs.NavigateUrl = GetGraphLink()
            lnkViewGraphs.Attributes.Add("rel", GraphID)

        Else
            '# Add no data placeholder to the page
            Dim NoGraphHolder As HtmlGenericControl = New HtmlGenericControl("div")
            NoGraphHolder.ID = "graph_nodata"
            NoGraphHolder.InnerHtml = "<span>No data</span>"
            phGraph.Controls.Add(NoGraphHolder)

            '# Hide link
            lnkViewGraphs.Visible = False
        End If

    End Sub

    Protected Function GetGraphLink(Optional oQuestionID As Object = Nothing, Optional oOptionID As Object = Nothing) As String
        Dim URL As String = "/surveys/graphs.aspx?"
        Dim QuestionQS As String = ""

        If oQuestionID IsNot Nothing Then
            QuestionQS = "sq=" & oQuestionID.ToString()
        Else
            QuestionQS = "sq=" & CurrentSurveyQuestionID.ToString()
        End If

        URL = URL & QuestionQS

        If oOptionID IsNot Nothing Then
            URL = URL & "&so=" & oOptionID.ToString()
        End If

        Return URL
    End Function

    Public Sub SaveGraphImage(SurveyQuestionID As Integer)

        If SurveyQuestionID > 0 Then

            '# Get file path
            Dim PageFilePath As String = "~/App_Data/Img/" & CurrentSurvey.ID.ToString() & "/"
            'Dim PageFilePath As String = "~/Secure7pac/Img/" & CurrentSurvey.ID.ToString() & "/"

            '# Check path exists
            CheckFolderExists(PageFilePath)

            '# Get image string
            Dim ImageString As String = hdnGraph.Value.Replace("data:image/png;base64,", "")

            '# Convert image
            If Not String.IsNullOrEmpty(ImageString) Then
                Dim GraphImage As System.Drawing.Image = Base64ToImage(ImageString)
                GraphImage.Save(Server.MapPath(PageFilePath & SurveyQuestionID.ToString & ".jpg"))
            End If
            
        End If

    End Sub

    Public Shared Function Base64ToImage(ByVal base64string As String) As System.Drawing.Image

        Dim ImageBytes As Byte() = Convert.FromBase64String(base64string)

        Dim NewGraphImage As System.Drawing.Image

        Using ms As New MemoryStream(ImageBytes)
            NewGraphImage = System.Drawing.Image.FromStream(ms)
            ms.Close()
            ms.Flush()
        End Using

        Return NewGraphImage
    End Function

#End Region

#Region "Filtering"
    Protected Sub SetAnswerFilter(sender As Object, e As CommandEventArgs)

        Dim FilterValueArgs As String = ""

        Try

            If e.CommandArgument IsNot Nothing Then FilterValueArgs = e.CommandArgument.ToString()

            If Not String.IsNullOrEmpty(FilterValueArgs) AndAlso FilterValueArgs.Length > 0 Then

                '# Remove bookends
                FilterValueArgs = FilterValueArgs.Replace("[", "").Replace("]", "")

                '# Set value varibles
                Dim QuestionID As String = ""
                Dim QuestionTitle As String = ""
                Dim OptionID As String = ""
                Dim OptionTitle As String = ""
                Dim OptionValue As String = ""
                Dim QuestionIndex As String = ""

                '# Get values
                Dim FilterValues As String() = FilterValueArgs.Split("~")
                If FilterValues.Length > 0 Then
                    QuestionID = "[question(" & FilterValues(0) & ")]"
                    QuestionTitle = FilterValues(1)
                    OptionID = FilterValues(2)
                    OptionTitle = FilterValues(3)
                    OptionValue = FilterValues(4)
                    QuestionIndex = FilterValues(5)
                End If

                LocalSiteInterface.CurrentSurveyControl.AddSurveyFilter(SurveyFilterTypeEnum.QuestionFilter, QuestionID, "=", OptionValue, GlobalMethods.StripHTML(QuestionTitle), OptionID, GlobalMethods.StripHTML(OptionTitle), QuestionIndex, True)

                Dim CustomTextValue As String = ""
                If Not String.IsNullOrEmpty(CustomTextValue) Then
                    'LocalSiteInterface.CurrentSurveyControl.RemoveSurveyFilterByType(SurveyFilterTypeEnum.CustomDataText)

                End If

                '# Reload survey details
                RaiseEvent FilterClicked(Me, New EventArgs())

            End If

        Catch ex As Exception
        End Try

    End Sub
#End Region

    Public Class RankValue

#Region "ItemsRanked"
        Protected _ItemsRanked As Integer
        Public Property ItemsRanked As Integer
            Get
                Return _ItemsRanked
            End Get
            Set(value As Integer)
                _ItemsRanked = value
            End Set
        End Property
#End Region

#Region "ItemPercentage"
        Protected _ItemPercentage As Integer
        Public Property ItemPercentage As Integer
            Get
                Return _ItemPercentage
            End Get
            Set(value As Integer)
                _ItemPercentage = value
            End Set
        End Property
#End Region

#Region "QuestionID"
        Protected _QuestionID As String
        Public Property QuestionID As String
            Get
                Return _QuestionID
            End Get
            Set(value As String)
                _QuestionID = value
            End Set
        End Property
#End Region

#Region "QuestionTitle"
        Protected _QuestionTitle As String
        Public Property QuestionTitle As String
            Get
                Return _QuestionTitle
            End Get
            Set(value As String)
                _QuestionTitle = value
            End Set
        End Property
#End Region

#Region "OptionID"
        Protected _OptionID As String
        Public Property OptionID As String
            Get
                Return _OptionID
            End Get
            Set(value As String)
                _OptionID = value
            End Set
        End Property
#End Region

#Region "OptionTitle"
        Protected _OptionTitle As String
        Public Property OptionTitle As String
            Get
                Return _OptionTitle
            End Get
            Set(value As String)
                _OptionTitle = value
            End Set
        End Property
#End Region

#Region "OptionValue"
        Protected _OptionValue As String
        Public Property OptionValue As String
            Get
                Return _OptionValue
            End Get
            Set(value As String)
                _OptionValue = value
            End Set
        End Property
#End Region

        Public Sub New(ItemsRanked As Integer, ItemPercentage As Integer, QuestionID As String, QuestionTitle As String, OptionID As String, OptionTitle As String, OptionValue As String)

            _ItemsRanked = ItemsRanked
            _ItemPercentage = ItemPercentage
            _QuestionID = QuestionID
            _QuestionTitle = QuestionTitle
            _OptionID = OptionID
            _OptionTitle = OptionTitle
            _OptionValue = OptionValue

        End Sub

    End Class

    Public Class PlainTextValue

#Region "QuestionID"
        Protected _QuestionID As String
        Public Property QuestionID As String
            Get
                Return _QuestionID
            End Get
            Set(value As String)
                _QuestionID = value
            End Set
        End Property
#End Region

#Region "QuestionTitle"
        Protected _QuestionTitle As String
        Public Property QuestionTitle As String
            Get
                Return _QuestionTitle
            End Get
            Set(value As String)
                _QuestionTitle = value
            End Set
        End Property
#End Region

#Region "AnswerValue"
        Protected _AnswerValue As String
        Public Property AnswerValue As String
            Get
                Return _AnswerValue
            End Get
            Set(value As String)
                _AnswerValue = value
            End Set
        End Property
#End Region

#Region "CurrentResponseID"
        Protected _CurrentResponseID As String
        Public Property CurrentResponseID As String
            Get
                Return _CurrentResponseID
            End Get
            Set(value As String)
                _CurrentResponseID = value
            End Set
        End Property
#End Region

        Public Sub New(QuestionID As String, QuestionTitle As String, AnswerValue As String, CurrentResponseID As String)

            _QuestionID = QuestionID
            _QuestionTitle = QuestionTitle
            _AnswerValue = AnswerValue
            _CurrentResponseID = CurrentResponseID

        End Sub

    End Class

    Public Class MultiTextBoxGroup

#Region "QuestionID"
        Protected _QuestionID As String
        Public Property QuestionID As String
            Get
                Return _QuestionID
            End Get
            Set(value As String)
                _QuestionID = value
            End Set
        End Property
#End Region

#Region "QuestionTitle"
        Protected _QuestionTitle As String
        Public Property QuestionTitle As String
            Get
                Return _QuestionTitle
            End Get
            Set(value As String)
                _QuestionTitle = value
            End Set
        End Property
#End Region

#Region "CurrentResponseID"
        Protected _CurrentResponseID As String
        Public Property CurrentResponseID As String
            Get
                Return _CurrentResponseID
            End Get
            Set(value As String)
                _CurrentResponseID = value
            End Set
        End Property
#End Region

#Region "AnswerValues"
        Protected _AnswerValues As List(Of MultiTextBoxValue)
        Public Property AnswerValues As List(Of MultiTextBoxValue)
            Get
                Return _AnswerValues
            End Get
            Set(value As List(Of MultiTextBoxValue))
                _AnswerValues = value
            End Set
        End Property
#End Region

        Public Sub New(QuestionID As String, QuestionTitle As String, CurrentResponseID As String, Optional AnswerValues As List(Of MultiTextBoxValue) = Nothing)
            _QuestionID = QuestionID
            _QuestionTitle = QuestionTitle
            _CurrentResponseID = CurrentResponseID
            _AnswerValues = AnswerValues
        End Sub

        Public Sub SetAnswerValues(AnswerValues As List(Of MultiTextBoxValue))
            _AnswerValues = AnswerValues
        End Sub

    End Class

    Public Class MultiTextBoxValue

#Region "OptionID"
        Protected _OptionID As String
        Public Property OptionID As String
            Get
                Return _OptionID
            End Get
            Set(value As String)
                _OptionID = value
            End Set
        End Property
#End Region

#Region "OptionTitle"
        Protected _OptionTitle As String
        Public Property OptionTitle As String
            Get
                Return _OptionTitle
            End Get
            Set(value As String)
                _OptionTitle = value
            End Set
        End Property
#End Region

#Region "AnswerValue"
        Protected _AnswerValue As String
        Public Property AnswerValue As String
            Get
                Return _AnswerValue
            End Get
            Set(value As String)
                _AnswerValue = value
            End Set
        End Property
#End Region

        Public Sub New(OptionID As String, OptionTitle As String, AnswerValue As String)
            _OptionID = OptionID
            _OptionTitle = OptionTitle
            _AnswerValue = AnswerValue
        End Sub

    End Class

    Protected Sub Page_PreRender(sender As Object, e As System.EventArgs) Handles Me.PreRender
        'SaveGraphImage()
    End Sub

    Public Shared Sub CheckFolderExists(ByVal FolderPath As String)

        '# Check if we have a ~ in the folder path
        If Not FolderPath.StartsWith("~") Then FolderPath = "~" & FolderPath

        Try
            Dim di As New DirectoryInfo(HttpContext.Current.Server.MapPath(FolderPath))

            '# If we don't have the folder then create it
            If Not di.Exists Then di.Create()

        Catch ex As Exception
            Throw ex
        End Try

    End Sub

End Class
