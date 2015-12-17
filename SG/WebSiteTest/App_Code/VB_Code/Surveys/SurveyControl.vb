Option Strict On

Imports System.Net
Imports System.IO
Imports System.Xml
Imports PingSurveys.SurveyLibrary

Namespace PingSurveys
    Public Class SurveyControl

#Region "Constructor"
        Public Sub New()
            AddSurveyFilter(SurveyFilterTypeEnum.Status, "status", "<>", "Deleted")
            QuestionFilterType = QuestionFilterTypeEnum.OrFilter
        End Sub
#End Region

#Region "Data"
#Region "Filters"
        Dim _SurveyFilters As List(Of SurveyFilter)
        Public Property SurveyFilters() As List(Of SurveyFilter)
            Get
                Return _SurveyFilters
            End Get
            Set(ByVal value As List(Of SurveyFilter))
                _SurveyFilters = value
            End Set
        End Property
#End Region

#Region "FilterSet"
        Dim _FilterSet As String
        Public Property FilterSet() As String
            Get
                Return _FilterSet
            End Get
            Set(ByVal value As String)
                _FilterSet = value
            End Set
        End Property
#End Region

#Region "SurveyID"
        Dim _SurveyID As Integer
        Public Property SurveyID() As Integer
            Get
                Return _SurveyID
            End Get
            Set(ByVal value As Integer)
                _SurveyID = value
            End Set
        End Property
#End Region

#Region "CurrentSurvey"
        Dim _CurrentSurvey As Survey
        Public Property CurrentSurvey() As Survey
            Get
                Return _CurrentSurvey
            End Get
            Set(ByVal value As Survey)
                _CurrentSurvey = value
            End Set
        End Property
#End Region

        '#Region "UnfilteredSurvey"
        '        Dim _UnfilteredSurvey As Survey
        '        Public Property UnfilteredSurvey() As Survey
        '            Get
        '                Return _UnfilteredSurvey
        '            End Get
        '            Set(ByVal value As Survey)
        '                _UnfilteredSurvey = value
        '            End Set
        '        End Property
        '#End Region

#Region "SurveyQuestionID"
        Dim _SurveyQuestionID As Integer
        Public Property SurveyQuestionID() As Integer
            Get
                Return _SurveyQuestionID
            End Get
            Set(ByVal value As Integer)
                _SurveyQuestionID = value
            End Set
        End Property
#End Region

#Region "CurrentSurveyQuestion"
        Dim _CurrentSurveyQuestion As SurveyQuestion
        Public Property CurrentSurveyQuestion() As SurveyQuestion
            Get
                Return _CurrentSurveyQuestion
            End Get
            Set(ByVal value As SurveyQuestion)
                _CurrentSurveyQuestion = value
            End Set
        End Property
#End Region

#Region "SurveyOptionID"
        Dim _SurveyOptionID As Integer
        Public Property SurveyOptionID() As Integer
            Get
                Return _SurveyOptionID
            End Get
            Set(ByVal value As Integer)
                _SurveyOptionID = value
            End Set
        End Property
#End Region

#Region "CurrentSurveyOption"
        Dim _CurrentSurveyOption As SurveyOption
        Public Property CurrentSurveyOption() As SurveyOption
            Get
                Return _CurrentSurveyOption
            End Get
            Set(ByVal value As SurveyOption)
                _CurrentSurveyOption = value
            End Set
        End Property
#End Region

#Region "QuestionFilterType"
        Public Enum QuestionFilterTypeEnum As Integer
            OrFilter = 0
            AndFilter = 1
        End Enum

        Dim _QuestionFilterType As QuestionFilterTypeEnum
        Public Property QuestionFilterType() As QuestionFilterTypeEnum
            Get
                Return _QuestionFilterType
            End Get
            Set(ByVal value As QuestionFilterTypeEnum)
                _QuestionFilterType = value
            End Set
        End Property
#End Region
#End Region

#Region "Survey"
        Public Sub SetSurvey(ID As Integer)
            SurveyID = ID
            CurrentSurvey = SurveyAccess.GetSurveyByID(SurveyID)
            'UnfilteredSurvey = SurveyAccess.GetSurveyByID(SurveyID, True)
        End Sub
#End Region

#Region "SurveyQuestion"
        Public Sub SetSurveyQuestion(SurveyID As Integer, QuestionID As Integer)
            SurveyQuestionID = QuestionID
            CurrentSurveyQuestion = SurveyAccess.GetSurveyQuestionByID(SurveyID, QuestionID)
        End Sub
#End Region

#Region "SurveyOption"
        Public Sub SetSurveyOption(SurveyID As Integer, QuestionID As Integer, OptionID As Integer)
            SurveyOptionID = QuestionID
            CurrentSurveyOption = SurveyAccess.GetSurveyOptionByID(SurveyID, QuestionID, OptionID)
        End Sub
#End Region

#Region "Filters"
        Public Sub SetQuestionFilterType(TypeOfFilter As QuestionFilterTypeEnum)
            QuestionFilterType = TypeOfFilter
        End Sub

        Public Sub AddSurveyFilter(SurveyFilterType As SurveyFilterTypeEnum, FieldValue As String, OperatorValue As String, FilterValue As String)

            Dim NewSurveyFilter As New SurveyFilter(SurveyFilterType, FieldValue, OperatorValue, FilterValue)

            If SurveyFilters IsNot Nothing AndAlso SurveyFilters.Count > 0 Then
                '# Check to see if this filter already exists
                Dim SurveyFiltersToRemove As New List(Of SurveyFilter)

                For Each sf As SurveyFilter In SurveyFilters
                    If sf.SurveyFilterType = SurveyFilterType Then
                        SurveyFiltersToRemove.Add(sf)
                    End If
                Next

                '# Remove items
                If SurveyFiltersToRemove IsNot Nothing AndAlso SurveyFiltersToRemove.Count > 0 Then
                    For Each sf As SurveyFilter In SurveyFiltersToRemove
                        SurveyFilters.Remove(sf)
                    Next
                End If

                '# Add new filter
                SurveyFilters.Add(NewSurveyFilter)
            Else
                SurveyFilters = New List(Of SurveyFilter)
                SurveyFilters.Add(NewSurveyFilter)
            End If

        End Sub

        Public Sub AddSurveyFilter(SurveyFilterType As SurveyFilterTypeEnum, FieldValue As String, OperatorValue As String, FilterValue As String, QuestionTitle As String, QuestionOptionID As String, QuestionOptionTitle As String, QuestionIndex As Integer, IsActive As Boolean)

            Dim NewSurveyFilter As New SurveyFilter(SurveyFilterType, FieldValue, OperatorValue, FilterValue, QuestionTitle, QuestionOptionID, QuestionOptionTitle, QuestionIndex, IsActive)

            If SurveyFilters IsNot Nothing AndAlso SurveyFilters.Count > 0 Then
                '# Check to see if this filter already exists
                Dim SurveyFiltersToRemove As New List(Of SurveyFilter)

                For Each sf As SurveyFilter In SurveyFilters
                    If sf.SurveyFilterType = SurveyFilterType AndAlso sf.FieldValue = FieldValue Then
                        SurveyFiltersToRemove.Add(sf)
                    End If
                Next

                '# Remove items
                If SurveyFiltersToRemove IsNot Nothing AndAlso SurveyFiltersToRemove.Count > 0 Then
                    For Each sf As SurveyFilter In SurveyFiltersToRemove
                        SurveyFilters.Remove(sf)
                    Next
                End If

                '# Add new filter
                SurveyFilters.Add(NewSurveyFilter)
            Else
                SurveyFilters = New List(Of SurveyFilter)
                SurveyFilters.Add(NewSurveyFilter)
            End If

        End Sub

        Public Sub RemoveAllSurveyFilters()
            If SurveyFilters IsNot Nothing AndAlso SurveyFilters.Count > 0 Then

                '# List of filters to delete
                Dim SurveyFiltersToRemove As New List(Of SurveyFilter)

                For Each sf As SurveyFilter In SurveyFilters
                    SurveyFiltersToRemove.Add(sf)
                Next

                '# Remove items
                If SurveyFiltersToRemove IsNot Nothing AndAlso SurveyFiltersToRemove.Count > 0 Then
                    For Each sf As SurveyFilter In SurveyFiltersToRemove
                        SurveyFilters.Remove(sf)
                    Next
                End If
            End If
        End Sub

        Public Sub RemoveSurveyFilterByType(SurveyFilterType As SurveyFilterTypeEnum)
            If SurveyFilters IsNot Nothing AndAlso SurveyFilters.Count > 0 Then

                '# List of filters to delete
                Dim SurveyFiltersToRemove As New List(Of SurveyFilter)

                For Each sf As SurveyFilter In SurveyFilters
                    If sf.SurveyFilterType = SurveyFilterType Then
                        SurveyFiltersToRemove.Add(sf)
                    End If
                Next

                '# Remove items
                If SurveyFiltersToRemove IsNot Nothing AndAlso SurveyFiltersToRemove.Count > 0 Then
                    For Each sf As SurveyFilter In SurveyFiltersToRemove
                        SurveyFilters.Remove(sf)
                    Next
                End If
            End If
        End Sub

        Public Sub RemoveSurveyFilterByFieldValue(FieldValue As String, Optional SurveyFilterType As SurveyFilterTypeEnum = SurveyFilterTypeEnum.None)

            If SurveyFilters IsNot Nothing AndAlso SurveyFilters.Count > 0 Then

                '# List of filters to delete
                Dim SurveyFiltersToRemove As New List(Of SurveyFilter)

                For Each sf As SurveyFilter In SurveyFilters

                    If SurveyFilterType = SurveyFilterTypeEnum.None Then
                        If sf.FieldValue = FieldValue Then
                            SurveyFiltersToRemove.Add(sf)
                        End If
                    Else
                        If sf.SurveyFilterType = SurveyFilterTypeEnum.QuestionFilter AndAlso sf.FieldValue = FieldValue Then
                            SurveyFiltersToRemove.Add(sf)
                        End If
                    End If

                Next

                '# Remove items
                If SurveyFiltersToRemove IsNot Nothing AndAlso SurveyFiltersToRemove.Count > 0 Then
                    For Each sf As SurveyFilter In SurveyFiltersToRemove
                        SurveyFilters.Remove(sf)
                    Next
                End If

            End If
        End Sub

        Public Sub SetSurveyFilterActiveByFieldValue(FieldValue As String, IsActive As Boolean, Optional SurveyFilterType As SurveyFilterTypeEnum = SurveyFilterTypeEnum.None)

            If SurveyFilters IsNot Nothing AndAlso SurveyFilters.Count > 0 Then
                For Each sf As SurveyFilter In SurveyFilters

                    If SurveyFilterType = SurveyFilterTypeEnum.None Then
                        If sf.FieldValue = FieldValue Then
                            sf.SetActive(IsActive)
                        End If
                    Else
                        If sf.SurveyFilterType = SurveyFilterTypeEnum.QuestionFilter AndAlso sf.FieldValue = FieldValue Then
                            sf.SetActive(IsActive)
                        End If
                    End If
                Next
            End If
        End Sub
#End Region

    End Class
End Namespace
