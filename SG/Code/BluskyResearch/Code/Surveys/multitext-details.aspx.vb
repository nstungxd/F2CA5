Imports System.Data
Imports PingLibrary
Imports PingCore.MySystem
Imports PingSurveys
Imports PingSurveys.SurveyLibrary

Partial Class Surveys_text_details
    Inherits System.Web.UI.Page

#Region "IdentityControl"
    Public ReadOnly Property IdentityControl As PingLibrary.UserControl
        Get
            If Session("UserControl") Is Nothing Then Session("UserControl") = New PingLibrary.UserControl()

            '# Get the current survery control class
            Dim UserControl As PingLibrary.UserControl = CType(Session("UserControl"), PingLibrary.UserControl)

            Return UserControl
        End Get
    End Property
#End Region

#Region "CurrentSurveyControl"
    Public Property CurrentSurveyControl As SurveyControl
        Get
            If Session("CurrentSurveyControl") Is Nothing Then Session("CurrentSurveyControl") = New SurveyControl()

            '# Get the current survery control class
            Dim SurveyControl As SurveyControl = CType(Session("CurrentSurveyControl"), SurveyControl)

            Return SurveyControl
        End Get
        Set(value As SurveyControl)
            Session("CurrentSurveyControl") = value
        End Set
    End Property
#End Region

#Region "SurveyID"
    Protected ReadOnly Property SurveyID() As Integer
        Get
            Return CurrentSurveyControl.SurveyID
        End Get
    End Property
#End Region

#Region "CurrentSurvey"
    Protected ReadOnly Property CurrentSurvey() As Survey
        Get
            Return CurrentSurveyControl.CurrentSurvey
        End Get
    End Property
#End Region

#Region "CurrentSurveyQuestion"
    Protected ReadOnly Property CurrentSurveyQuestion() As SurveyQuestion
        Get
            Return CurrentSurveyControl.CurrentSurveyQuestion
        End Get
    End Property
#End Region

#Region "CurrentSurveyQuestionID"
    Public ReadOnly Property CurrentSurveyQuestionID() As Integer
        Get
            Return CurrentSurveyControl.SurveyQuestionID
        End Get
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

    Protected Sub Page_Load(ByVal sender As Object, ByVal e As System.EventArgs) Handles Me.Load
        If Not IsPostBack Then
            If GlobalMethods.UserLoggedIn(IdentityControl) Then
                LoadPage()
            End If
        End If
    End Sub

#Region "Load Data"
    Protected Sub LoadPage()

        If SurveyID > 0 Then
            '# Load question from URL Querystring
            SetQuestionFromURL()
        End If

    End Sub
#End Region

#Region "Questions"
    Protected Sub SetQuestionFromURL()

        Dim SurveyQuestionID As Integer = 0
        Dim SurveyOptionID As Integer = 0

        Try

            If Request.QueryString("sq") IsNot Nothing Then

                '# Get ID of selected question
                Int32.TryParse(Request.QueryString("sq"), SurveyQuestionID)

                If SurveyQuestionID > 0 Then
                    '# Set the Survey Question
                    CurrentSurveyControl.SetSurveyQuestion(SurveyID, SurveyQuestionID)
                End If

            End If

            If Request.QueryString("so") IsNot Nothing Then

                '# Get ID of selected question
                Int32.TryParse(Request.QueryString("so"), SurveyOptionID)

                If SurveyOptionID > 0 Then
                    '# Set the Survey Question
                    CurrentSurveyControl.SetSurveyOption(SurveyID, SurveyQuestionID, SurveyOptionID)
                End If
            Else
                CurrentSurveyControl.CurrentSurveyOption = Nothing
            End If

            If Request.QueryString("no") IsNot Nothing Then
                '# Get ID of selected question
                Int32.TryParse(Request.QueryString("no"), ItemCount)
            Else
                ItemCount = 0
            End If


            If SurveyQuestionID > 0 Then
                LoadQuestionDetails()
            End If

        Catch ex As Exception
        End Try

    End Sub

    Protected Sub LoadQuestionDetails()

        '# Load data
        Dim sq As SurveyQuestion = CurrentSurveyQuestion

        Dim ResponseItems As List(Of SurveyResponse) = CurrentSurvey.Responses
        Dim QuestionsResponses As New List(Of KeyValuePair(Of Integer, SurveyResponseQuestion))

        For Each ri As SurveyResponse In ResponseItems
            '# Get the questions from the responses that match the current survey question
            For Each rq As SurveyResponseQuestion In ri.ResponseQuestions
                If rq.QuestionID = sq.ID Then
                    Dim Result As New KeyValuePair(Of Integer, SurveyResponseQuestion)(ri.ResponseID, rq)
                    QuestionsResponses.Add(Result)
                End If
            Next
        Next

        '# Bind options - question titles
        Dim Options = (From dr In sq.Options Order By dr.ID Select dr).ToList()
        With rptRowTitles
            .DataSource = Options
            .DataBind()
        End With

        '# Filter out the responses
        Dim FilteredQuestionsResponses = (From dr In QuestionsResponses Where String.IsNullOrEmpty(dr.Value.AnswerValue) = False Select New MultiTextBoxGroup(dr.Value.QuestionID, CurrentSurveyQuestion.Title, dr.Key)).Distinct.ToList()
        Dim FilteredQuestionsResponsesDistinct As New List(Of MultiTextBoxGroup)

        For Each mtg In FilteredQuestionsResponses
            Dim FilterRecordMatch As MultiTextBoxGroup = (From dr In FilteredQuestionsResponsesDistinct Where dr.QuestionID = mtg.QuestionID AndAlso dr.CurrentResponseID = mtg.CurrentResponseID Select dr).FirstOrDefault()
            If FilterRecordMatch Is Nothing Then FilteredQuestionsResponsesDistinct.Add(mtg)
        Next

        '# Now get each question within the response question
        For Each mtg In FilteredQuestionsResponsesDistinct
            Dim MultiTextBoxAnswers = (From dr In QuestionsResponses Where dr.Key = mtg.CurrentResponseID AndAlso dr.Value.QuestionID = mtg.QuestionID Order By dr.Value.OptionID Select New MultiTextBoxValue(dr.Value.OptionID, GetOptionTitle(sq.Options, dr.Value.OptionID), dr.Value.AnswerValue)).ToList()
            mtg.SetAnswerValues(MultiTextBoxAnswers)
        Next

        '# Text values
        'If FilteredQuestionsResponses IsNot Nothing AndAlso FilteredQuestionsResponses.Count() > 0 Then
        pnlTextValues.CssClass = "si_modal_textvalues si_modal_multitextvalues si_modal_textvalues_" & sq.ID
        lblTextValuesTitle.Text = "<span class=""bold"">Question " & ItemCount.ToString() & ": </span>" & GlobalMethods.StripHTML(sq.Title)

        If CurrentSurvey.CanViewQuestionDetails(ItemCount) Then
            With lvTextValues
                .DataSource = FilteredQuestionsResponsesDistinct
                .DataBind()
            End With
        Else
            With lvTextValues
                .DataSource = Nothing
                .DataBind()
            End With
        End If

        'End If

    End Sub

    Protected Sub lvTextValues_ItemDataBound(sender As Object, e As ListViewItemEventArgs) Handles lvTextValues.ItemDataBound
        Select Case e.Item.ItemType
            Case ListViewItemType.DataItem

                Dim DataItem As MultiTextBoxGroup = CType(e.Item.DataItem, MultiTextBoxGroup)
                Dim rptOptionAnswers As Repeater = CType(e.Item.FindControl("rptOptionAnswers"), Repeater)

                If DataItem IsNot Nothing AndAlso rptOptionAnswers IsNot Nothing Then
                    With rptOptionAnswers
                        .DataSource = DataItem.AnswerValues
                        .DataBind()
                    End With
                End If

        End Select
    End Sub

    Protected Sub rptRowTitles_ItemDataBound(sender As Object, e As RepeaterItemEventArgs) Handles rptRowTitles.ItemDataBound
        Select Case e.Item.ItemType
            Case ListItemType.Item, ListItemType.SelectedItem, ListItemType.AlternatingItem

                Dim si_m_row_multiitem As HtmlControl = CType(e.Item.FindControl("si_m_row_multiitem"), HtmlControl)

                Dim WidthOfWrapper As Integer = 795
                Dim OptionCount As Integer = CurrentSurveyQuestion.Options.Count()
                Dim WidthValue As Decimal = (WidthOfWrapper / OptionCount) - 8
                Dim PercentageWidthValue As Decimal = (100 / OptionCount) - 1

                si_m_row_multiitem.Attributes.Add("style", "width:" & PercentageWidthValue.ToString() & "%; padding:0 0 0 1%;")

        End Select
    End Sub

    Protected Sub rptOptionAnswers_ItemDataBound(sender As Object, e As RepeaterItemEventArgs)
        Select Case e.Item.ItemType
            Case ListItemType.Item, ListItemType.SelectedItem, ListItemType.AlternatingItem

                Dim si_m_row_multiitem As HtmlControl = CType(e.Item.FindControl("si_m_row_multiitem"), HtmlControl)
                Dim litAnswerValue As Literal = CType(e.Item.FindControl("litAnswerValue"), Literal)

                'If litAnswerValue IsNot Nothing Then
                '    Dim CurrentIndex As Integer = e.Item.ItemIndex
                '    Dim CurrentQuestion As SurveyOption = CurrentSurveyQuestion.Options(CurrentIndex)
                '    litAnswerValue.Text = ""
                'End If

                If si_m_row_multiitem IsNot Nothing Then
                    Dim WidthOfWrapper As Integer = 795
                    Dim OptionCount As Integer = CurrentSurveyQuestion.Options.Count()
                    Dim WidthValue As Decimal = (WidthOfWrapper / OptionCount) - 8
                    Dim PercentageWidthValue As Decimal = (100 / OptionCount) - 1

                    si_m_row_multiitem.Attributes.Add("style", "width:" & PercentageWidthValue.ToString() & "%; padding:6px 0 0 1%;")
                End If

        End Select
    End Sub

    Protected Function GetOptionTitle(Options As List(Of SurveyOption), OptionID As String) As String
        Dim OptionTitle As String = (From dr In Options Where dr.ID = OptionID Select dr.Title).FirstOrDefault()
        If String.IsNullOrEmpty(OptionTitle) Then OptionTitle = "Question Answer"
        Return OptionTitle
    End Function

    Protected Function FormatLink(oResponseID As Object) As String

        Dim ReturnLink As String = "#"

            '# Get Search ID
        Dim ResponseID As Integer = 0
        Int32.TryParse(oResponseID, ResponseID)

        If ResponseID > 0 Then

            '# Find the response in the list
            If CurrentSurvey IsNot Nothing Then

                Dim PageCount As Integer = 1
                Dim FoundSurvey As Boolean = False
                Dim SearchRecord As SurveyResponse = Nothing
                Dim SurveyResponsesList As List(Of SurveyResponse) = CurrentSurvey.Responses()

                If SurveyResponsesList IsNot Nothing AndAlso SurveyResponsesList.Count > 0 Then
                    For Each sr As SurveyResponse In SurveyResponsesList
                        If sr.ID = ResponseID Then
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
                    ReturnLink = "/surveys/single.aspx?p=" & PageCount.ToString()
                End If
            End If
        End If

        Return ReturnLink

    End Function
#End Region

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

End Class
