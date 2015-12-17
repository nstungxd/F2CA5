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
                If rq.QuestionID = sq.ID AndAlso Not String.IsNullOrEmpty(rq.AnswerValue) Then
                    Dim Result As New KeyValuePair(Of Integer, SurveyResponseQuestion)(ri.ResponseID, rq)
                    QuestionsResponses.Add(Result)
                End If
            Next
        Next

        Dim FilteredQuestionsResponses As New List(Of PlainTextValue)

        Select Case sq.SubType
            Case "radio", "checkbox", "menu"
                '# Filter to ones with answers
                FilteredQuestionsResponses = (From dr In QuestionsResponses Where dr.Value.AnswerValue.Contains("Other") Select New PlainTextValue(dr.Value.QuestionID, CurrentSurveyQuestion.Title, dr.Value.AnswerValue.Replace("Other: ", ""), dr.Key)).ToList()
            Case Else
                '# Filter to ones with answers
                FilteredQuestionsResponses = (From dr In QuestionsResponses Where String.IsNullOrEmpty(dr.Value.AnswerValue) = False Select New PlainTextValue(dr.Value.QuestionID, CurrentSurveyQuestion.Title, dr.Value.AnswerValue, dr.Key)).ToList()
        End Select

        '# Text values
        'If FilteredQuestionsResponses IsNot Nothing AndAlso FilteredQuestionsResponses.Count() > 0 Then
        pnlTextValues.CssClass = "si_modal_textvalues si_modal_textvalues_" & sq.ID
        lblTextValuesTitle.Text = "<span class=""bold"">Question " & ItemCount.ToString() & ": </span>" & GlobalMethods.StripHTML(sq.Title)

        If CurrentSurvey.CanViewQuestionDetails(ItemCount) Then
            With lvTextValues
                .DataSource = FilteredQuestionsResponses
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
#End Region

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

End Class
