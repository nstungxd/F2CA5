Imports PingSurveys.SurveyLibrary
Imports PingSurveys
Imports PingCore.MySystem
Imports System.Data
Imports PingLibrary

Partial Class _Default
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
    Protected Sub Unnamed1_Click(sender As Object, e As System.EventArgs)

        Dim SurveyList As List(Of Survey) = SurveyAccess.GetAllSurveys()
        ' Dim a As Integer = 2115599
        For Each surveyitem As Survey In SurveyList
            Dim CurrentSurvey1 As Survey = SurveyAccess.GetSurveyByID(surveyitem.ID)
            Dim a As DataRow = DataLogic.Access_AddSurvey(CurrentSurvey1)


        Next

        'LocalSiteInterface.CurrentSurveyControl.SetSurvey(a)

    End Sub
End Class
