Imports System.Data
Imports PingLibrary
Imports PingCore.MySystem
Imports PingSurveys
Imports Newtonsoft.Json
Imports System.Net
Imports System.Dynamic
Imports PingSurveys.SurveyLibrary

Partial Class Testing
    Inherits System.Web.UI.Page

    Const SectionID As Integer = 1

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

    Protected Property SurveyID() As Integer
        Get
            Dim _SurveyID As Integer = 0
            Int32.TryParse(ViewState("SurveyID"), _SurveyID)

            If SurveyID <= 0 Then

                '# Get all surveys
                Dim SurveyResultList As List(Of Survey) = SurveyAccess.GetAllSurveys()

                '# Get most recent survey
                If SurveyResultList IsNot Nothing Then
                    _SurveyID = (From dr In SurveyResultList Select dr Order By dr.CreatedOn Descending Select dr.ID).FirstOrDefault()
                    ViewState("SurveyID") = _SurveyID
                End If

            End If

            Return _SurveyID
        End Get
        Set(ByVal value As Integer)
            ViewState("SurveyID") = value
        End Set
    End Property

    Protected Sub Page_Load(ByVal sender As Object, ByVal e As System.EventArgs) Handles Me.Load
        If Not IsPostBack Then
        End If
    End Sub

#Region "Temp Handlers"
    Protected Sub btnGetAllSurveys_Click(sender As Object, e As EventArgs) Handles btnGetAllSurveys.Click
        If Page.IsValid Then

            litResults.Text = ""

            '# Get all surveys
            Dim ResultList As List(Of Survey) = SurveyAccess.GetAllSurveys()

            '# Get most recent survey
            If ResultList IsNot Nothing Then
                SurveyID = (From dr In ResultList Select dr Order By dr.CreatedOn Descending Select dr.ID).FirstOrDefault()
            End If

            Dim SurveyResult As Survey = SurveyAccess.GetSurveyByID(SurveyID)

            litResults.Text = "<br /><br />Results:<br />" '& SurveyResult

        End If
    End Sub

    Protected Sub btnGetAllSurveyPages_Click(sender As Object, e As EventArgs) Handles btnGetAllSurveyPages.Click
        If Page.IsValid Then

            'litResults.Text = ""

            ''# Get all survey pages
            'Dim ResultList As List(Of SurveyPage) = SurveyAccess.GetAllSurveyPages(SurveyID)

            ''# Get first page
            'Dim SurveyPageID As Integer = 0
            'If ResultList IsNot Nothing Then
            '    SurveyPageID = (From dr In ResultList Select dr Select dr.ID).FirstOrDefault()
            'End If

            'Dim SurveyResult As SurveyPage = SurveyAccess.GetSurveyPageByID(SurveyID, SurveyPageID)

            'litResults.Text = "<br /><br />Results:<br />" '& SurveyResult

        End If
    End Sub

    Protected Sub btnGetAllSurveyQuestions_Click(sender As Object, e As EventArgs) Handles btnGetAllSurveyQuestions.Click
        If Page.IsValid Then

            litResults.Text = ""

            '# Get all survey questions
            Dim ResultList As List(Of SurveyQuestion) = SurveyAccess.GetAllSurveyQuestions(SurveyID)

            '# Get first question
            Dim SurveyQuestionID As Integer = 0
            If ResultList IsNot Nothing Then
                SurveyQuestionID = (From dr In ResultList Select dr Select dr.ID).FirstOrDefault()
            End If

            Dim SurveyResult As SurveyQuestion = SurveyAccess.GetSurveyQuestionByID(SurveyID, SurveyQuestionID)

            litResults.Text = "<br /><br />Results:<br />" '& SurveyResult

        End If
    End Sub

    Protected Sub btnGetAllSurveyOptions_Click(sender As Object, e As EventArgs) Handles btnGetAllSurveyOptions.Click
        If Page.IsValid Then

            litResults.Text = ""

            '# Get all survey options
            Dim ResultList As List(Of SurveyOption) = SurveyAccess.GetAllSurveyOptions(SurveyID, 21)

            '# Get first option
            Dim SurveyOptionID As Integer = 0
            If ResultList IsNot Nothing Then
                SurveyOptionID = (From dr In ResultList Select dr Select dr.ID).FirstOrDefault()
            End If

            Dim SurveyResult As SurveyOption = SurveyAccess.GetSurveyOptionByID(SurveyID, 21, SurveyOptionID)

            litResults.Text = "<br /><br />Results:<br />" '& SurveyResult

        End If
    End Sub

    Protected Sub btnGetAllSurveyResponses_Click(sender As Object, e As EventArgs) Handles btnGetAllSurveyResponses.Click
        If Page.IsValid Then

            litResults.Text = ""

            '# Get all survey Responses
            Dim ResultList As List(Of SurveyResponse) = SurveyAccess.GetAllSurveyResponses(SurveyID)

            '# Get first response
            Dim SurveyResponseID As Integer = 0
            If ResultList IsNot Nothing Then
                SurveyResponseID = (From dr In ResultList Select dr Select dr.ID).FirstOrDefault()
            End If

            Dim SurveyResult As SurveyResponse = SurveyAccess.GetSurveyResponseByID(SurveyID, SurveyResponseID)

            litResults.Text = "<br /><br />Results:<br />" '& SurveyResult

        End If
    End Sub

    Protected Sub btnGetAllSurveyStatistics_Click(sender As Object, e As EventArgs) Handles btnGetAllSurveyStatistics.Click
        If Page.IsValid Then

            'litResults.Text = ""

            ''# Get all survey stats
            'Dim ResultList As List(Of SurveyStatistic) = SurveyAccess.GetAllSurveyStatistics(1274519)

            ''# Get first response
            'Dim SurveyStatisticQuestionID As Integer = 0
            'If ResultList IsNot Nothing Then
            '    SurveyStatisticQuestionID = (From dr In ResultList Select dr Order By dr.QuestionID Descending Select dr.QuestionID).FirstOrDefault()
            'End If

            'Dim SurveyResult As SurveyStatistic = SurveyAccess.GetSurveyStatisticsByQuestionID(1274519, 3)

            'litResults.Text = "<br /><br />Results:<br />" '& SurveyResult

        End If
    End Sub
#End Region

End Class
