Option Strict On

Imports System.Net
Imports System.IO
Imports System.Xml
Imports Newtonsoft.Json
Imports PingSurveys.SurveyLibrary

Namespace PingSurveys
    Public NotInheritable Class SurveyLogic

#Region "Data"
#Region "Username"
        Public Shared ReadOnly Property Username() As String
            Get
                Return SurveyFunctions.Username()
            End Get
        End Property
#End Region

#Region "Password"
        Public Shared ReadOnly Property Password() As String
            Get
                Return SurveyFunctions.Password()
            End Get
        End Property
#End Region
#End Region

#Region "Survey"
#Region "CreateSurvey"
        Public Shared Function CreateSurvey(Title As String, Optional Type As String = "survey") As String

            Dim ReturnValue As String = ""

            Return ReturnValue

        End Function
#End Region

#Region "UpdateSurvey"
        Public Shared Function UpdateSurvey(SurveyID As Integer, Optional Title As String = "", Optional Type As String = "survey") As String

            Dim ReturnValue As String = ""

            Return ReturnValue

        End Function
#End Region

#Region "DeleteSurvey"
        Public Shared Function DeleteSurvey(SurveyID As Integer) As String

            Dim ReturnValue As String = ""

            Return ReturnValue

        End Function
#End Region
#End Region

#Region "SurveyPages"
#Region "CreateSurveyPage"
        Public Shared Function CreateSurveyPage(SurveyID As Integer, Title As String, Description As String) As String

            Dim ReturnValue As String = ""

            Return ReturnValue

        End Function
#End Region

#Region "UpdateSurveyPage"
        Public Shared Function UpdateSurveyPage(SurveyID As Integer, SurveyPageID As Integer, Title As String, Description As String) As String

            Dim ReturnValue As String = ""

            Return ReturnValue

        End Function
#End Region

#Region "DeleteSurveyPage"
        Public Shared Function DeleteSurveyPage(SurveyID As Integer, SurveyPageID As Integer) As String

            Dim ReturnValue As String = ""

            Return ReturnValue

        End Function
#End Region
#End Region

#Region "SurveyQuestions"
#Region "CreateSurveyQuestion"
        Public Shared Function CreateSurveyQuestion(SurveyID As Integer, SurveyPageID As Integer, Type As String, Question As String, Description As String) As String

            Dim ReturnValue As String = ""

            Return ReturnValue

        End Function
#End Region

#Region "UpdateSurveyQuestion"
        Public Shared Function UpdateSurveyQuestion(SurveyID As Integer, SurveyQuestionID As Integer, Title As String, Description As String) As String

            Dim ReturnValue As String = ""

            Return ReturnValue

        End Function
#End Region

#Region "DeleteSurveyQuestion"
        Public Shared Function DeleteSurveyQuestion(SurveyID As Integer, SurveyQuestionID As Integer) As String

            Dim ReturnValue As String = ""

            Return ReturnValue

        End Function
#End Region
#End Region

#Region "SurveyOptions"
#Region "CreateSurveyOption"
        Public Shared Function CreateSurveyOption(SurveyID As Integer, SurveyPageID As Integer, SurveyQuestionID As Integer, Title As String, Value As String) As String

            Dim ReturnValue As String = ""

            Return ReturnValue

        End Function
#End Region

#Region "UpdateSurveyOption"
        Public Shared Function UpdateSurveyOption(SurveyID As Integer, SurveyPageID As Integer, SurveyQuestionID As Integer, SurveyOptionID As Integer, Title As String, Value As String) As String

            Dim ReturnValue As String = ""

            Return ReturnValue

        End Function
#End Region

#Region "DeleteSurveyOption"
        Public Shared Function DeleteSurveyOption(SurveyID As Integer, SurveyPageID As Integer, SurveyQuestionID As Integer, SurveyOptionID As Integer) As String

            Dim ReturnValue As String = ""

            Return ReturnValue

        End Function
#End Region
#End Region

    End Class
End Namespace