Imports System.Data
Imports PingLibrary
Imports PingCore.MySystem
Imports PingSurveys
Imports PingSurveys.SurveyLibrary

Partial Class Controls_SurveyQuestionDetailsControl
    Inherits System.Web.UI.UserControl

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

#Region "CurrentSurveyResponse"
    Public _CurrentSurveyResponse As SurveyResponse
    Public Property CurrentSurveyResponse() As SurveyResponse
        Get
            Return _CurrentSurveyResponse
        End Get
        Set(ByVal value As SurveyResponse)
            _CurrentSurveyResponse = value
        End Set
    End Property
#End Region

#Region "CurrentSurveyResponseID"
    Public ReadOnly Property CurrentSurveyResponseID() As Integer
        Get
            If CurrentSurveyResponse IsNot Nothing Then
                Return CurrentSurveyResponse.ID
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

            If sq.ID = 15 Then
                Dim pause = 1
            End If

            '# Survey responses
            Dim NotAnswered As Integer = 0

            Dim ResponseID As Integer = 0
            Dim ResponseItems As List(Of SurveyResponse) = CurrentSurvey.Responses
            Dim QuestionsResponses As New List(Of KeyValuePair(Of Integer, SurveyResponseQuestion))
            For Each ri As SurveyResponse In ResponseItems

                Dim ResultList = (From dr In ri.ResponseQuestions Where dr.QuestionID = sq.ID AndAlso Not String.IsNullOrEmpty(dr.AnswerValue) Select dr).ToList()

                If ResultList.Count > 0 Then
                    TotalResponses += 1
                    TotalClicks += ResultList.Count()
                End If

                Dim NotAnsweredResultList = (From dr In ri.ResponseQuestions Where dr.QuestionID = sq.ID AndAlso String.IsNullOrEmpty(dr.AnswerValue) Select dr).ToList()

                If NotAnsweredResultList.Count > 0 Then
                    NotAnswered += 1
                End If

                For Each rq As SurveyResponseQuestion In ri.ResponseQuestions
                    If rq.QuestionID = sq.ID AndAlso Not String.IsNullOrEmpty(rq.AnswerValue) Then
                        Dim Result As New KeyValuePair(Of Integer, SurveyResponseQuestion)(ri.ResponseID, rq)
                        QuestionsResponses.Add(Result)
                        'TotalResponses += 1
                        'ResponseID = ri.ResponseID
                    ElseIf rq.QuestionID = sq.ID AndAlso String.IsNullOrEmpty(rq.AnswerValue) Then
                        'NotAnswered += 1
                    End If
                Next
            Next

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
                    si_item.Attributes.Add("class", "survey_item surveyquestion_item survey_item_start clearfix si_" & SubType)
                Else
                    si_item.Attributes.Add("class", "survey_item surveyquestion_item clearfix si_" & SubType)
                End If

                '# Set title
                If IsSubQuestion Then
                    litQuestionTitle.Text = GlobalMethods.StripHTML(sq.Title)
                Else
                    litQuestionTitle.Text = "<span class=""bold"">Question " & ItemCount.ToString() & ": </span>" & GlobalMethods.StripHTML(sq.Title)
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

                            si_item.Attributes.Add("class", "survey_item surveyquestion_item survey_item_parent clearfix")
                            si_dataitem.Attributes.Add("class", "si_data si_data_parent")

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

                        Case "checkbox"
                            mvQuestion.ActiveViewIndex = 3

                            With rptCheckboxOptions
                                .DataSource = sq.Options
                                .DataBind()
                            End With

                            '# Graph
                            ShowGraph = True

                        Case "menu"
                            mvQuestion.ActiveViewIndex = 4

                            With rptMenuOptions
                                .DataSource = sq.Options
                                .DataBind()
                            End With

                            '# Graph
                            ShowGraph = True

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

                            si_item.Attributes.Add("class", "survey_item surveyquestion_item survey_item_parent clearfix")
                            si_dataitem.Attributes.Add("class", "si_data si_data_parent")

                        Case "multi_textbox"
                            mvQuestion.ActiveViewIndex = 6
                            si_item.Attributes.Add("class", "survey_item surveyquestion_item clearfix si_essay si_" & sq.SubType)

                            '# Get each question within the response question
                            Dim MultiTextBoxAnswers = (From dr In QuestionsResponses Where dr.Key = CurrentSurveyResponseID Order By dr.Value.OptionID Select New MultiTextBoxValue(dr.Value.OptionID, GetOptionTitle(sq.Options, dr.Value.OptionID), dr.Value.AnswerValue)).ToList()

                            With rptMultiTextAnswers
                                .DataSource = MultiTextBoxAnswers
                                .DataBind()
                            End With

                        Case "number"
                            mvQuestion.ActiveViewIndex = 7

                            '# Filter to answer
                            Dim AverageMeanText As String = "N/A"

                            Dim FilteredQuestionsResponse As SurveyResponseQuestion = (From dr In QuestionsResponses Where dr.Key = CurrentSurveyResponseID Select dr.Value).FirstOrDefault()

                            If FilteredQuestionsResponse IsNot Nothing AndAlso Not String.IsNullOrEmpty(FilteredQuestionsResponse.AnswerValue) Then
                                Dim LocalValue As Decimal = 0D
                                Decimal.TryParse(FilteredQuestionsResponse.AnswerValue, LocalValue)
                                If LocalValue > 0D Then AverageMeanText = LocalValue.ToString("#,##0.00")
                            End If

                            litAverageMean.Text = AverageMeanText

                            '# Graph
                            ShowGraph = False

                        Case Else
                            mvQuestion.ActiveViewIndex = 0

                            '# Filter to answer
                            Dim FilteredQuestionsResponse As SurveyResponseQuestion = (From dr In QuestionsResponses Where dr.Key = CurrentSurveyResponseID Select dr.Value).FirstOrDefault()

                            If FilteredQuestionsResponse IsNot Nothing AndAlso Not String.IsNullOrEmpty(FilteredQuestionsResponse.AnswerValue) Then
                                litTextAnswer.Text = FilteredQuestionsResponse.AnswerValue
                            End If

                            '# Not Answered count
                            Dim QuestionsResponsesUnanswered = (From dr In QuestionsResponses Where String.IsNullOrEmpty(dr.Value.AnswerValue) = True Select dr.Value.QuestionID).Count()

                            '# Graph
                            ShowGraph = False

                    End Select

                    '# Check to see if we can view the responses for this question
                    Dim HideSurveyQuestion As Boolean = Not CurrentSurvey.CanViewQuestionDetails(ItemCount)

                    If HideSurveyQuestion Then
                        litTextAnswer.Text = ""
                    End If

                Else

                End If
            End If

        Else
            SetSurveyQuestionDetailsView(CantLoadView)
        End If

    End Sub

    Protected Function GetOptionTitle(Options As List(Of SurveyOption), OptionID As String) As String
        Dim OptionTitle As String = (From dr In Options Where dr.ID = OptionID Select dr.Title).FirstOrDefault()
        If String.IsNullOrEmpty(OptionTitle) Then OptionTitle = "Question Answer"
        Return OptionTitle
    End Function

    Protected Sub SetSurveyQuestionDetailsView(RequiredView As View)
        mvSurveyQuestionDetails.SetActiveView(RequiredView)
    End Sub

#End Region

#Region "Options"
    Protected Sub OptionsRepeaterItemDataBound(sender As Object, e As RepeaterItemEventArgs)
        Select Case e.Item.ItemType
            Case ListItemType.Item, ListItemType.SelectedItem, ListItemType.AlternatingItem

                Dim so As SurveyOption = CType(e.Item.DataItem, SurveyOption)
                Dim lblResult As Label = CType(e.Item.FindControl("lblResult"), Label)
                Dim imgCheck As Image = CType(e.Item.FindControl("imgCheck"), Image)
                Dim lblOtherAnswer As Label = CType(e.Item.FindControl("lblOtherAnswer"), Label)

                If ItemCount = 6 Then
                    Dim x = 0
                End If

                If so IsNot Nothing AndAlso CurrentSurveyResponse IsNot Nothing Then

                    '# Survey response
                    Dim QuestionsResponses As New List(Of SurveyResponseQuestion)
                    Dim HasOtherValue As Boolean = False
                    Dim OtherAnswer As String = ""

                    Dim Count As Integer = 0
                    Dim rqList = (From dr In CurrentSurveyResponse.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.AnswerValue = so.Value Select dr).ToList()

                    If rqList.Count() <= 0 AndAlso so.Value.ToLower.Contains("other") Then
                        Dim rqListID = (From dr In CurrentSurveyResponse.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.AnswerValue.ToLower.Contains("other") AndAlso dr.OptionID = so.ID Select dr).ToList()

                        If rqListID.Count() > 0 AndAlso Not String.IsNullOrEmpty(rqListID(0).AnswerValue()) Then
                            OtherAnswer = rqListID(0).AnswerValue().Replace("Other: ", "")
                            HasOtherValue = True
                        End If

                        Count += rqListID.Count()
                    End If

                    Count += rqList.Count()

                    If Count > 0 Then
                        lblResult.CssClass = "si_row_data_chk si_row_data_chk_on"
                        imgCheck.Visible = True
                        If HasOtherValue Then lblOtherAnswer.Text = "(" & OtherAnswer & ")"
                    Else
                        lblResult.CssClass = "si_row_data_chk si_row_data_chk_off"
                        imgCheck.Visible = False
                    End If


                    '# Check to see if we can view the responses for this question
                    If HasOtherValue Then
                        Dim HideSurveyQuestion As Boolean = Not CurrentSurvey.CanViewQuestionDetails(ItemCount)
                        If HideSurveyQuestion Then lblOtherAnswer.Text = ""
                    End If

                End If

        End Select
    End Sub

    Protected Sub rptCheckboxOptions_ItemDataBound(sender As Object, e As RepeaterItemEventArgs)
        Select Case e.Item.ItemType
            Case ListItemType.Item, ListItemType.SelectedItem, ListItemType.AlternatingItem

                Dim so As SurveyOption = CType(e.Item.DataItem, SurveyOption)
                Dim lblResult As Label = CType(e.Item.FindControl("lblResult"), Label)
                Dim imgCheck As Image = CType(e.Item.FindControl("imgCheck"), Image)
                Dim lblOtherAnswer As Label = CType(e.Item.FindControl("lblOtherAnswer"), Label)

                If ItemCount = 6 Then
                    Dim x = 0
                End If

                If so IsNot Nothing AndAlso CurrentSurveyResponse IsNot Nothing Then

                    ''# Survey response
                    'Dim QuestionsResponses As New List(Of SurveyResponseQuestion)

                    'Dim rqList = (From dr In CurrentSurveyResponse.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.OptionID = so.ID Select dr).ToList()

                    'If rqList.Count() <= 0 AndAlso so.Value.ToLower.Contains("other") Then
                    '    Dim rqListID = (From dr In CurrentSurveyResponse.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.AnswerValue.ToLower.Contains("other") AndAlso dr.OptionID = so.ID Select dr).ToList()
                    '    Count += rqListID.Count()
                    'End If

                    'Count += rqList.Count()

                    '# Survey response
                    Dim QuestionsResponses As New List(Of SurveyResponseQuestion)
                    Dim HasOtherValue As Boolean = False
                    Dim OtherAnswer As String = ""

                    Dim Count As Integer = 0
                    Dim rqList = (From dr In CurrentSurveyResponse.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.AnswerValue = so.Value Select dr).ToList()

                    If rqList.Count() <= 0 AndAlso so.Value.ToLower.Contains("other") Then
                        Dim rqListID = (From dr In CurrentSurveyResponse.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.AnswerValue.ToLower.Contains("other") AndAlso dr.OptionID = so.ID Select dr).ToList()

                        If rqListID.Count() > 0 AndAlso Not String.IsNullOrEmpty(rqListID(0).AnswerValue()) Then
                            OtherAnswer = rqListID(0).AnswerValue().Replace("Other: ", "")
                            HasOtherValue = True
                        End If

                        Count += rqListID.Count()
                    End If

                    Count += rqList.Count()

                    If Count > 0 Then
                        lblResult.CssClass = "si_row_data_chk si_row_data_chk_on"
                        imgCheck.Visible = True
                        If HasOtherValue Then lblOtherAnswer.Text = "(" & OtherAnswer & ")"
                    Else
                        lblResult.CssClass = "si_row_data_chk si_row_data_chk_off"
                        imgCheck.Visible = False
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

                    si_row_header_item.Attributes.Add("style", "width:" & WidthValue.ToString() & "px")
                End If

        End Select
    End Sub

    Protected Sub SubQuestionsRepeaterItemDataBound(sender As Object, e As RepeaterItemEventArgs)
        Select Case e.Item.ItemType
            Case ListItemType.Item, ListItemType.SelectedItem, ListItemType.AlternatingItem

                Dim sq As SurveyQuestion = CType(e.Item.DataItem, SurveyQuestion)
                Dim rptTableSubQuestionResults As Repeater = CType(e.Item.FindControl("rptTableSubQuestionResults"), Repeater)

                If sq IsNot Nothing AndAlso rptTableSubQuestionResults IsNot Nothing Then

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

                End If

        End Select
    End Sub

    Protected Sub TableSubQuestionResultsRepeaterItemDataBound(sender As Object, e As RepeaterItemEventArgs)
        Select Case e.Item.ItemType
            Case ListItemType.Item, ListItemType.SelectedItem, ListItemType.AlternatingItem

                Dim so As SurveyOption = CType(e.Item.DataItem, SurveyOption)
                Dim lblResult As Label = CType(e.Item.FindControl("lblResult"), Label)
                Dim imgCheck As Image = CType(e.Item.FindControl("imgCheck"), Image)
                Dim si_row_data_item As HtmlControl = CType(e.Item.FindControl("si_row_data_item"), HtmlControl)

                If so IsNot Nothing Then

                    Dim Count As Integer = 0

                    '# Survey response
                    Dim QuestionsResponses As New List(Of SurveyResponseQuestion)

                    Dim rqList = (From dr In CurrentSurveyResponse.ResponseQuestions Where dr.QuestionID = so.QuestionID AndAlso dr.AnswerValue = so.Value Select dr).ToList()

                    If rqList.Count() <= 0 AndAlso so.Value.ToLower.Contains("other") Then
                        Dim rqListID = (From dr In CurrentSurveyResponse.ResponseQuestions Where dr.QuestionID = so.QuestionID AndAlso dr.AnswerValue.ToLower.Contains("other") AndAlso dr.OptionID = so.ID Select dr).ToList()
                        Count += rqListID.Count()
                    End If

                    Count += rqList.Count()

                    If Count > 0 Then
                        lblResult.CssClass = "si_row_data_chk si_row_data_chk_on"
                        imgCheck.Visible = True
                    Else
                        lblResult.CssClass = "si_row_data_chk si_row_data_chk_off"
                        imgCheck.Visible = False
                    End If

                    If si_row_data_item IsNot Nothing Then
                        si_row_data_item.Attributes.Add("class", "si_row si_row_data si_row_" & e.Item.ItemIndex.ToString())

                        Dim WidthOfWrapper As Integer = 440
                        Dim OptionCount As Integer = CurrentSurveyQuestion.Options.Count()
                        Dim WidthValue As Decimal = (WidthOfWrapper / OptionCount) - 8

                        si_row_data_item.Attributes.Add("style", "width:" & WidthValue.ToString() & "px")
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

                    si_row_header_item.Attributes.Add("style", "width:" & WidthValue.ToString() & "px")
                End If

        End Select
    End Sub

    Protected Sub RankSubQuestionsRepeaterItemDataBound(sender As Object, e As RepeaterItemEventArgs)
        Select Case e.Item.ItemType
            Case ListItemType.Item, ListItemType.SelectedItem, ListItemType.AlternatingItem

                Dim so As SurveyOption = CType(e.Item.DataItem, SurveyOption)
                Dim rptRankSubQuestionResults As Repeater = CType(e.Item.FindControl("rptRankSubQuestionResults"), Repeater)
                Dim lblResult As Label = CType(e.Item.FindControl("lblResult"), Label)

                If so IsNot Nothing Then

                    Dim ResponseID As Integer = 0
                    Dim QuestionsResponses As New List(Of KeyValuePair(Of Integer, SurveyResponseQuestion))
                    For Each rq As SurveyResponseQuestion In CurrentSurveyResponse.ResponseQuestions
                        If rq.QuestionID = CurrentSurveyQuestion.ID Then
                            Dim Result As New KeyValuePair(Of Integer, SurveyResponseQuestion)(CurrentSurveyResponse.ResponseID, rq)
                            QuestionsResponses.Add(Result)
                        End If
                    Next

                    Dim FilteredQuestionsResponses = (From dr In QuestionsResponses Where dr.Value.OptionID = so.ID And String.IsNullOrEmpty(dr.Value.AnswerValue) = False Select dr.Value.QuestionID, dr.Value.AnswerValue, CurrentResponseID = dr.Key).ToList()

                    '# Load possible answers
                    Dim RankValues As New List(Of KeyValuePair(Of Integer, Integer))

                    If FilteredQuestionsResponses IsNot Nothing AndAlso FilteredQuestionsResponses.Count() > 0 Then
                        For i As Integer = 1 To CInt(CurrentSurveyQuestion.Statistics.Max)
                            Dim ItemsRanked As Integer = (From dr In FilteredQuestionsResponses Where dr.AnswerValue = i.ToString() Select dr).Count()
                            Dim item As New KeyValuePair(Of Integer, Integer)(i, ItemsRanked)

                            RankValues.Add(item)
                        Next
                    End If

                    With rptRankSubQuestionResults
                        .DataSource = RankValues
                        .DataBind()
                    End With

                End If

        End Select
    End Sub

    Protected Sub RankSubQuestionResultsRepeaterItemDataBound(sender As Object, e As RepeaterItemEventArgs)
        Select Case e.Item.ItemType
            Case ListItemType.Item, ListItemType.SelectedItem, ListItemType.AlternatingItem

                Dim so As KeyValuePair(Of Integer, Integer) = CType(e.Item.DataItem, KeyValuePair(Of Integer, Integer))
                Dim lblResult As Label = CType(e.Item.FindControl("lblResult"), Label)
                Dim imgCheck As Image = CType(e.Item.FindControl("imgCheck"), Image)
                Dim si_row_data_item As HtmlControl = CType(e.Item.FindControl("si_row_data_item"), HtmlControl)

                If so.Value > 0 Then
                    lblResult.Text = "Selected"
                    lblResult.CssClass = "si_row_data_chk si_row_data_chk_on"
                    imgCheck.Visible = True
                Else
                    lblResult.CssClass = "si_row_data_chk si_row_data_chk_off"
                    imgCheck.Visible = False
                End If

                If si_row_data_item IsNot Nothing Then
                    si_row_data_item.Attributes.Add("class", "si_row si_row_data si_row_" & e.Item.ItemIndex.ToString())

                    Dim WidthOfWrapper As Integer = 440
                    Dim OptionCount As Integer = CurrentSurveyQuestion.Options.Count()
                    Dim WidthValue As Decimal = (WidthOfWrapper / OptionCount) - 8

                    si_row_data_item.Attributes.Add("style", "width:" & WidthValue.ToString() & "px")
                End If

                'End If

        End Select
    End Sub

#End Region

#Region "MultiText"
    Protected Sub rptMultiTextAnswersItemDataBound(sender As Object, e As RepeaterItemEventArgs)
        Select Case e.Item.ItemType
            Case ListItemType.Item, ListItemType.SelectedItem, ListItemType.AlternatingItem

                Dim litMultiTextAnswer As Literal = CType(e.Item.FindControl("litMultiTextAnswer"), Literal)

                If CurrentSurveyResponse IsNot Nothing Then

                    '# Check to see if we can view the responses for this question
                    Dim HideSurveyQuestion As Boolean = Not CurrentSurvey.CanViewQuestionDetails(ItemCount)
                    If HideSurveyQuestion Then litMultiTextAnswer.Text = ""

                End If

        End Select
    End Sub
#End Region

#Region "Hide"
    Public Sub HideSurveyQuestion()
        Me.Visible = False
    End Sub
#End Region

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

End Class
