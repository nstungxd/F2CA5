Option Strict Off

Imports System.Net
Imports System.IO
Imports System.Xml
Imports Newtonsoft.Json
Imports PingSurveys.SurveyLibrary
Imports System.Data
Imports PingLibrary

'# Uses Json.NET - http://james.newtonking.com/pages/json-net.aspx

Namespace PingSurveys
    Public NotInheritable Class SurveyAccess

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
#Region "GetAllSurveys"
        Public Shared Function GetAllSurveys() As List(Of SurveyLibrary.Survey)

            Try

                Dim ResponseXML As XElement = SurveyFunctions.MakeXMLQueryPlain()

                If ResponseXML IsNot Nothing Then

                    Dim ResultOk = (From dr In ResponseXML.Elements("result_ok") Select dr).FirstOrDefault()
                    Dim Code = (From dr In ResponseXML.Elements("code") Select dr).FirstOrDefault()

                    If ResultOk IsNot Nothing AndAlso Not String.IsNullOrEmpty(ResultOk.Value()) Then

                        Dim ReturnValue As List(Of Survey) = New List(Of Survey)

                        '# Retrieve a list of the XML items from this response
                        Dim ResponseItems = (From dr In ResponseXML.Elements("data").Elements() Select dr).ToList()

                        If ResponseItems IsNot Nothing Then

                            '# Database connection
                            Dim dbc As SqlDatabaseConnection = Data.DBConnection()

                            '# Extract the information from each item and create a new instance of FeedItem for each one
                            For Each i As XElement In ResponseItems
                                With i

                                    Dim SurveyItem As Survey = Surveys.GetSurvey(i, False, True)

                                    If SurveyItem IsNot Nothing Then
                                        With SurveyItem

                                            '# Add to DB - if it exists
                                            DataLogic.AddSurvey(.ID, .Title, .Status, .CreatedOn, .ModifiedOn, dbc)

                                            Dim SurveyItemRecord As DataRow = DataAccess.GetSurveyBySurveyNumber(.ID, dbc)
                                            If SurveyItemRecord IsNot Nothing Then
                                                Dim ViewDetails As Boolean = DataFunctions.GetColumnFromDataRow(Of Boolean)(SurveyItemRecord, "ViewDetails")
                                                Dim QuestionsToHide As String = DataFunctions.GetColumnFromDataRow(Of String)(SurveyItemRecord, "QuestionsToHide")
                                                Dim MinimumResponsesAllowed As Integer = DataFunctions.GetColumnFromDataRow(Of Integer)(SurveyItemRecord, "MinimumResponsesAllowed")

                                                SurveyItem.SetViewDetails(ViewDetails)
                                                SurveyItem.SetQuestionsToHide(QuestionsToHide)
                                                SurveyItem.SetMinimumResponsesAllowed(MinimumResponsesAllowed)
                                            End If

                                        End With
                                    End If

                                    ReturnValue.Add(SurveyItem)

                                End With
                            Next

                        End If

                        Return ReturnValue

                    Else
                        Throw New Exception(Code.Value())
                    End If

                Else
                    Throw New Exception("No response")
                End If

            Catch ex As Exception
                Throw New Exception("There was a problem with your request - " & ex.Message)
            End Try

        End Function
#End Region

#Region "GetSurveyByID"
        Public Shared Function GetSurveyByID(SurveyID As Integer, Optional SkipFiltering As Boolean = False) As SurveyLibrary.Survey

            Try

                Dim ResponseXML As XElement = Nothing
                'If SurveyID = 1416845 Then

                '    Dim CachedResponse As XElement = CType(HttpContext.Current.Cache.Get("survey_1416845"), XElement)

                '    If CachedResponse IsNot Nothing Then
                '        ResponseXML = CachedResponse
                '    Else

                '        '# Run query and return results
                '        Dim FreshResponse As XElement = XElement.Load(HttpContext.Current.Server.MapPath("~/Surveys/local/survey_1416845.xml"))

                '        '# Add to cache
                '        HttpContext.Current.Cache.Insert("survey_1416845", FreshResponse, Nothing, System.DateTime.Now.AddMinutes(30), System.Web.Caching.Cache.NoSlidingExpiration)

                '        ResponseXML = FreshResponse
                '    End If

                'Else
                '    ResponseXML = SurveyFunctions.MakeXMLQuery(SurveyID)
                'End If

                ResponseXML = SurveyFunctions.MakeXMLQuery(SurveyID, "", "", SkipFiltering)

                If ResponseXML IsNot Nothing Then

                    Dim ResultOk = (From dr In ResponseXML.Elements("result_ok") Select dr).FirstOrDefault()
                    Dim Code = (From dr In ResponseXML.Elements("code") Select dr).FirstOrDefault()

                    If ResultOk IsNot Nothing AndAlso Not String.IsNullOrEmpty(ResultOk.Value()) Then

                        Dim ReturnValue As Survey = Nothing

                        '# Retrieve a list of the XML items from this response
                        Dim ResponseItem = (From dr In ResponseXML.Elements("data") Select dr).FirstOrDefault()

                        If ResponseItem IsNot Nothing Then
                            Dim SurveyItem As Survey = Surveys.GetSurvey(ResponseItem, True, False, "", SkipFiltering)

                            If SurveyItem IsNot Nothing Then
                                With SurveyItem

                                    '# Add to DB - if it exists
                                    DataLogic.AddSurvey(.ID, .Title, .Status, .CreatedOn, .ModifiedOn)

                                    Dim SurveyItemRecord As DataRow = DataAccess.GetSurveyBySurveyNumber(.ID)
                                    If SurveyItemRecord IsNot Nothing Then
                                        Dim ViewDetails As Boolean = DataFunctions.GetColumnFromDataRow(Of Boolean)(SurveyItemRecord, "ViewDetails")
                                        Dim QuestionsToHide As String = DataFunctions.GetColumnFromDataRow(Of String)(SurveyItemRecord, "QuestionsToHide")
                                        Dim MinimumResponsesAllowed As Integer = DataFunctions.GetColumnFromDataRow(Of Integer)(SurveyItemRecord, "MinimumResponsesAllowed")

                                        SurveyItem.SetViewDetails(ViewDetails)
                                        SurveyItem.SetQuestionsToHide(QuestionsToHide)
                                        SurveyItem.SetMinimumResponsesAllowed(MinimumResponsesAllowed)
                                    End If

                                End With
                            End If

                            ReturnValue = SurveyItem

                        End If

                        Return ReturnValue

                    Else
                        Throw New Exception(Code.Value())
                    End If

                Else
                    Throw New Exception("No response")
                End If

            Catch ex As Exception
                Throw New Exception("There was a problem with your request - " & ex.Message)
            End Try

        End Function
#End Region
#End Region

        '#Region "SurveyPages"
        '#Region "GetAllSurveyPages"
        '        Public Shared Function GetAllSurveyPages(SurveyID As Integer) As List(Of SurveyPage)

        '            Try

        '                Dim ResponseXML As XElement = SurveyFunctions.MakeXMLQuery(SurveyID, "/surveypage")

        '                If ResponseXML IsNot Nothing Then

        '                    Dim ResultOk = (From dr In ResponseXML.Elements("result_ok") Select dr).FirstOrDefault()
        '                    Dim Code = (From dr In ResponseXML.Elements("code") Select dr).FirstOrDefault()

        '                    If ResultOk IsNot Nothing AndAlso Not String.IsNullOrEmpty(ResultOk.Value()) Then

        '                        Dim ReturnValue As List(Of SurveyPage) = New List(Of SurveyPage)

        '                        '# Retrieve a list of the XML items from this response
        '                        Dim ResponseItems = (From dr In ResponseXML.Elements("data").Elements() Select dr).ToList()

        '                        If ResponseItems IsNot Nothing Then

        '                            '# Extract the information from each item and create a new instance of FeedItem for each one
        '                            For Each i As XElement In ResponseItems
        '                                With i
        '                                    ReturnValue.Add(SurveyPages.GetSurveyPage(i))
        '                                End With
        '                            Next

        '                        End If

        '                        Return ReturnValue

        '                    Else
        '                        Throw New Exception(Code.Value())
        '                    End If

        '                Else
        '                    Throw New Exception("No response")
        '                End If

        '            Catch ex As Exception
        '                Throw New Exception("There was a problem with your request - " & ex.Message)
        '            End Try

        '        End Function
        '#End Region

        '#Region "GetSurveyPageByID"
        '        Public Shared Function GetSurveyPageByID(SurveyID As Integer, SurveyPageID As Integer) As SurveyPage

        '            Try

        '                Dim ResponseXML As XElement = SurveyFunctions.MakeXMLQuery(SurveyID, "/surveypage/" & SurveyPageID.ToString())

        '                If ResponseXML IsNot Nothing Then

        '                    Dim ResultOk = (From dr In ResponseXML.Elements("result_ok") Select dr).FirstOrDefault()
        '                    Dim Code = (From dr In ResponseXML.Elements("code") Select dr).FirstOrDefault()

        '                    If ResultOk IsNot Nothing AndAlso Not String.IsNullOrEmpty(ResultOk.Value()) Then

        '                        Dim ReturnValue As SurveyPage = Nothing

        '                        '# Retrieve a list of the XML items from this response
        '                        Dim ResponseItem = (From dr In ResponseXML.Elements("data") Select dr).FirstOrDefault()

        '                        If ResponseItem IsNot Nothing Then
        '                            ReturnValue = SurveyPages.GetSurveyPage(ResponseItem)
        '                        End If

        '                        Return ReturnValue

        '                    Else
        '                        Throw New Exception(Code.Value())
        '                    End If

        '                Else
        '                    Throw New Exception("No response")
        '                End If

        '            Catch ex As Exception
        '                Throw New Exception("There was a problem with your request - " & ex.Message)
        '            End Try

        '        End Function
        '#End Region
        '#End Region

#Region "SurveyQuestions"
#Region "GetAllSurveyQuestions"
        Public Shared Function GetAllSurveyQuestions(SurveyID As Integer, Optional GetStats As Boolean = False) As List(Of SurveyQuestion)

            Try

                Dim ResponseXML As XElement = SurveyFunctions.MakeXMLQuery(SurveyID, "/surveyquestion")

                If ResponseXML IsNot Nothing Then

                    Dim ResultOk = (From dr In ResponseXML.Elements("result_ok") Select dr).FirstOrDefault()
                    Dim Code = (From dr In ResponseXML.Elements("code") Select dr).FirstOrDefault()

                    If ResultOk IsNot Nothing AndAlso Not String.IsNullOrEmpty(ResultOk.Value()) Then

                        Dim ReturnValue As List(Of SurveyQuestion) = New List(Of SurveyQuestion)

                        '# Retrieve a list of the XML items from this response
                        Dim ResponseItems = (From dr In ResponseXML.Elements("data").Elements() Select dr).ToList()

                        If ResponseItems IsNot Nothing Then

                            '# Extract the information from each item and create a new instance of FeedItem for each one
                            For Each i As XElement In ResponseItems
                                With i

                                    Dim NewElement As SurveyQuestion = Nothing

                                    If GetStats Then
                                        NewElement = SurveyQuestions.GetSurveyQuestion(i, SurveyID)
                                    Else
                                        NewElement = SurveyQuestions.GetSurveyQuestion(i)
                                    End If

                                    If NewElement IsNot Nothing Then ReturnValue.Add(NewElement)
                                End With
                            Next

                            '# Handle sub-questions

                            '# We need to:
                            '# Add subquestions to the parent questions


                            Dim SubQuestionIDs As List(Of Integer) = New List(Of Integer)
                            Dim ElementsToRemove As List(Of SurveyQuestion) = New List(Of SurveyQuestion)

                            For Each sq As SurveyQuestion In ReturnValue
                                With sq
                                    If sq.SubQuestionSkus IsNot Nothing AndAlso sq.SubQuestionSkus.Count() > 0 Then

                                        Dim eleList = (From dr In ReturnValue Where sq.SubQuestionSkus.Contains(CType(dr.ID, Integer)) Select dr).ToList()

                                        If eleList IsNot Nothing AndAlso eleList.Count() > 0 Then
                                            If sq.SubQuestions Is Nothing Then sq.SubQuestions = New List(Of SurveyQuestion)
                                            sq.SubQuestions.AddRange(eleList)

                                            For Each e As SurveyQuestion In eleList
                                                ElementsToRemove.Add(e)
                                            Next
                                        End If

                                    End If
                                End With
                            Next

                            '# Remove the subquestions from the main list
                            If ElementsToRemove IsNot Nothing AndAlso ElementsToRemove.Count() > 0 Then
                                For Each e As SurveyQuestion In ElementsToRemove
                                    ReturnValue.Remove(e)
                                Next
                            End If

                        End If


                        Return ReturnValue

                    Else
                        Throw New Exception(Code.Value())
                    End If

                Else
                    Throw New Exception("No response")
                End If

            Catch ex As Exception
                Throw New Exception("There was a problem with your request - " & ex.Message)
            End Try

        End Function
#End Region

#Region "GetSurveyQuestionByID"
        Public Shared Function GetSurveyQuestionByID(SurveyID As Integer, SurveyQuestionID As Integer) As SurveyQuestion

            Try

                Dim ResponseXML As XElement = SurveyFunctions.MakeXMLQuery(SurveyID, "/surveyquestion/" & SurveyQuestionID.ToString())

                If ResponseXML IsNot Nothing Then

                    Dim ResultOk = (From dr In ResponseXML.Elements("result_ok") Select dr).FirstOrDefault()
                    Dim Code = (From dr In ResponseXML.Elements("code") Select dr).FirstOrDefault()

                    If ResultOk IsNot Nothing AndAlso Not String.IsNullOrEmpty(ResultOk.Value()) Then

                        Dim ReturnValue As SurveyQuestion = Nothing

                        '# Retrieve a list of the XML items from this response
                        Dim ResponseItem = (From dr In ResponseXML.Elements("data") Select dr).FirstOrDefault()

                        If ResponseItem IsNot Nothing Then
                            ReturnValue = SurveyQuestions.GetSurveyQuestion(ResponseItem, SurveyID)
                        End If

                        Return ReturnValue

                    Else
                        Throw New Exception(Code.Value())
                    End If

                Else
                    Throw New Exception("No response")
                End If

            Catch ex As Exception
                Throw New Exception("There was a problem with your request - " & ex.Message)
            End Try

        End Function
#End Region
#End Region

#Region "SurveyOptions"
#Region "GetAllSurveyOptions"
        Public Shared Function GetAllSurveyOptions(SurveyID As Integer, SurveyQuestionID As Integer) As List(Of SurveyOption)

            Try

                Dim ResponseXML As XElement = SurveyFunctions.MakeXMLQuery(SurveyID, "/surveyquestion/" & SurveyQuestionID.ToString() & "/surveyoption")

                If ResponseXML IsNot Nothing Then

                    Dim ResultOk = (From dr In ResponseXML.Elements("result_ok") Select dr).FirstOrDefault()
                    Dim Code = (From dr In ResponseXML.Elements("code") Select dr).FirstOrDefault()

                    If ResultOk IsNot Nothing AndAlso Not String.IsNullOrEmpty(ResultOk.Value()) Then

                        Dim ReturnValue As List(Of SurveyOption) = New List(Of SurveyOption)

                        '# Retrieve a list of the XML items from this response
                        Dim ResponseItems = (From dr In ResponseXML.Elements("data").Elements() Select dr).ToList()

                        If ResponseItems IsNot Nothing Then

                            '# Extract the information from each item and create a new instance of FeedItem for each one
                            For Each i As XElement In ResponseItems
                                With i
                                    ReturnValue.Add(SurveyOptions.GetSurveyOption(i, SurveyQuestionID, ""))
                                End With
                            Next

                        End If

                        Return ReturnValue

                    Else
                        Throw New Exception(Code.Value())
                    End If

                Else
                    Throw New Exception("No response")
                End If

            Catch ex As Exception
                Throw New Exception("There was a problem with your request - " & ex.Message)
            End Try

        End Function
#End Region

#Region "GetSurveyOptionByID"
        Public Shared Function GetSurveyOptionByID(SurveyID As Integer, SurveyQuestionID As Integer, SurveyOptionID As Integer) As SurveyOption

            Try

                Dim ResponseXML As XElement = SurveyFunctions.MakeXMLQuery(SurveyID, "/surveyquestion/" & SurveyQuestionID.ToString() & "/surveyoption/" & SurveyOptionID.ToString())

                If ResponseXML IsNot Nothing Then

                    Dim ResultOk = (From dr In ResponseXML.Elements("result_ok") Select dr).FirstOrDefault()
                    Dim Code = (From dr In ResponseXML.Elements("code") Select dr).FirstOrDefault()

                    If ResultOk IsNot Nothing AndAlso Not String.IsNullOrEmpty(ResultOk.Value()) Then

                        Dim ReturnValue As SurveyOption = Nothing

                        '# Retrieve a list of the XML items from this response
                        Dim ResponseItem = (From dr In ResponseXML.Elements("data") Select dr).FirstOrDefault()

                        If ResponseItem IsNot Nothing Then
                            ReturnValue = SurveyOptions.GetSurveyOption(ResponseItem, SurveyQuestionID, "")
                        End If

                        Return ReturnValue

                    Else
                        Throw New Exception(Code.Value())
                    End If

                Else
                    Throw New Exception("No response")
                End If

            Catch ex As Exception
                Throw New Exception("There was a problem with your request - " & ex.Message)
            End Try

        End Function
#End Region
#End Region

#Region "SurveyResponses"
#Region "GetAllSurveyResponses"
        Public Shared Function GetAllSurveyResponses(SurveyID As Integer, Optional SurveyFilters As List(Of SurveyFilter) = Nothing, Optional SkipFiltering As Boolean = False, Optional TotalResponseCount As Integer = 500) As List(Of SurveyResponse)

            Try

                Dim ResponseXML As XElement = Nothing
                Dim ResponseXMLWithPartialFilter As XElement = Nothing

                '# Add  
                If CurrentSurveyControl IsNot Nothing Then
                    With CurrentSurveyControl
                        .AddSurveyFilter(SurveyFilterTypeEnum.General, "istestdata", "=", "0")
                        '.AddSurveyFilter(SurveyFilterTypeEnum.QuestionFilter, "[question(3)]", "=", "Stayed previously", "How did you hear about us?", "10001", "Stayed previously", 1)
                    End With
                End If

                'If SurveyID = 1416845 Then

                '    Dim CachedResponse As XElement = CType(HttpContext.Current.Cache.Get("surveyresponse_1416845"), XElement)

                '    If CachedResponse IsNot Nothing Then
                '        ResponseXML = CachedResponse
                '    Else

                '        '# Run query and return results
                '        Dim FreshResponse As XElement = XElement.Load(HttpContext.Current.Server.MapPath("~/Surveys/local/surveyresponse_1416845.xml"))

                '        '# Add to cache
                '        HttpContext.Current.Cache.Insert("surveyresponse_1416845", FreshResponse, Nothing, System.DateTime.Now.AddMinutes(30), System.Web.Caching.Cache.NoSlidingExpiration)

                '        ResponseXML = FreshResponse
                '    End If

                'Else
                '    ResponseXML = SurveyFunctions.MakeXMLQuery(SurveyID, "/surveyresponse", "&filter[field][0]=status&filter[operator][0]=<>&filter[value][0]=Deleted&filter[field][0]=istestdata&filter[operator][0]==&filter[value][0]=0", SkipFiltering)
                'End If

                '# Get Response results for all of the responses
                Dim PagesOfResponses As Integer = Math.Ceiling((TotalResponseCount / 250))
                Dim ReturnValue As List(Of SurveyResponse) = New List(Of SurveyResponse)

                For p As Integer = 1 To PagesOfResponses

                    ResponseXML = SurveyFunctions.MakeXMLQuery(SurveyID, "/surveyresponse", "&filter[field][0]=status&filter[operator][0]=<>&filter[value][0]=Deleted&filter[field][1]=istestdata&filter[operator][1]==&filter[value][1]=0", False, p)

                    Dim ResultOk As XElement = Nothing
                    Dim Code As XElement = Nothing

                    If ResponseXML IsNot Nothing Then
                        ResultOk = (From dr In ResponseXML.Elements("result_ok") Select dr).FirstOrDefault()
                        Code = (From dr In ResponseXML.Elements("code") Select dr).FirstOrDefault()

                        '# Complete
                        If ResultOk IsNot Nothing AndAlso Not String.IsNullOrEmpty(ResultOk.Value()) Then

                            '# Retrieve a list of the XML items from this response
                            Dim ResponseItems As List(Of XElement) = (From dr In ResponseXML.Elements("data").Elements() Select dr).ToList()

                            If ResponseItems IsNot Nothing Then

                                '# Extract the information from each item and create a new instance of FeedItem for each one
                                Dim count As Integer = 0
                                For Each i As XElement In ResponseItems
                                    Dim NewSurveyResponse As SurveyResponse = SurveyResponses.GetSurveyResponse(i)
                                    If NewSurveyResponse IsNot Nothing Then ReturnValue.Add(NewSurveyResponse)
                                    count += 1
                                Next
                                Dim x = count
                            End If

                        ElseIf Code IsNot Nothing Then
                            Throw New Exception(Code.Value() & " - page: " & p.ToString())
                        Else
                            Throw New Exception("No data available - page: " & p.ToString())
                        End If
                    End If

                Next

                Return ReturnValue

            Catch ex As Exception
                Throw New Exception("There was a problem with your request - " & ex.Message)
            End Try

        End Function
#End Region

#Region "GetFilteredSurveyResponses"
        Public Shared Function GetFilteredSurveyResponses(AllSurveyResponses As List(Of SurveyResponse)) As List(Of SurveyResponse)

            Try

                Dim ReturnValue As List(Of SurveyResponse) = New List(Of SurveyResponse)
                Dim LocalSurveyResponses As List(Of SurveyResponse) = AllSurveyResponses

                '# Filter the list of responses using the user set filters
                If CurrentSurveyControl IsNot Nothing AndAlso CurrentSurveyControl.SurveyFilters IsNot Nothing AndAlso CurrentSurveyControl.SurveyFilters.Count() > 0 AndAlso LocalSurveyResponses IsNot Nothing AndAlso LocalSurveyResponses.Count() > 0 Then

                    '# Apply general filters - if we have any set

                    Dim CustomFiltersPresent As Boolean = False

                    For Each sf As SurveyFilter In CurrentSurveyControl.SurveyFilters
                        If sf.Active Then

                            Select Case sf.SurveyFilterType
                                Case SurveyFilterTypeEnum.Status

                                    If sf.FilterValue = "Complete" OrElse sf.FilterValue = "Partial" Then
                                        LocalSurveyResponses = (From dr In LocalSurveyResponses Where dr.Status = sf.FilterValue Select dr).ToList()
                                    End If

                                Case SurveyFilterTypeEnum.DateBefore
                                    '# Exclude Responses with Dates Before...

                                    '# Get values
                                    Dim DateStr As String = sf.FilterValue.Replace("+", " ")
                                    Dim DateBefore As New Date

                                    Dim DateOK As Boolean = Date.TryParse(DateStr, DateBefore)

                                    If DateOK Then
                                        LocalSurveyResponses = (From dr In LocalSurveyResponses Where CType(dr.DateSubmitted, Date) >= DateBefore Select dr).ToList()
                                    End If

                                Case SurveyFilterTypeEnum.DateAfter
                                    '# Exclude Responses with Dates After...

                                    '# Get values
                                    Dim DateStr As String = sf.FilterValue.Replace("+", " ")
                                    Dim DateAfter As New Date

                                    Dim DateOK As Boolean = Date.TryParse(DateStr, DateAfter)

                                    If DateOK Then
                                        LocalSurveyResponses = (From dr In LocalSurveyResponses Where CType(dr.DateSubmitted, Date) <= DateAfter Select dr).ToList()
                                    End If

                                Case SurveyFilterTypeEnum.CustomDataText

                                    '# If we have custom text entered, we need to check to see if we have questions with matching answers
                                    If Not String.IsNullOrEmpty(sf.FilterValue) Then

                                        Dim CustomTextFilteredResponses As List(Of SurveyResponse) = New List(Of SurveyResponse)
                                        Dim ResponseIsOK As Boolean = False

                                        For Each sr As SurveyResponse In AllSurveyResponses
                                            For Each rq In sr.ResponseQuestions
                                                Dim MatchingQuestions = (From dr In sr.ResponseQuestions Where dr.AnswerValue.Contains(sf.FilterValue) Select dr).ToList()
                                                If MatchingQuestions IsNot Nothing AndAlso MatchingQuestions.Count() > 0 Then ResponseIsOK = True
                                            Next

                                            '# Add item - if we have a match
                                            If ResponseIsOK Then CustomTextFilteredResponses.Add(sr)
                                        Next

                                        '# Add to the current list
                                        If CustomTextFilteredResponses IsNot Nothing AndAlso CustomTextFilteredResponses.Count() > 0 Then
                                            LocalSurveyResponses = CType(LocalSurveyResponses.Union(CustomTextFilteredResponses), Global.System.Collections.Generic.List(Of Global.PingSurveys.SurveyLibrary.SurveyResponse))
                                        End If

                                    End If

                                Case SurveyFilterTypeEnum.QuestionFilter
                                    CustomFiltersPresent = True
                            End Select

                        End If
                    Next

                    If CustomFiltersPresent Then

                        Dim QuestionFilteredResponses As List(Of SurveyResponse) = New List(Of SurveyResponse)

                        For Each sr As SurveyResponse In LocalSurveyResponses

                            '# Check this response has questions that match the filters
                            Dim ResponseQuestions As List(Of SurveyResponseQuestion) = sr.ResponseQuestions
                            Dim ResponseIsOK As Boolean = False

                            '# Get list of question filters
                            Dim QuestionFiltersList As List(Of SurveyLibrary.SurveyFilter) = (From dr In CurrentSurveyControl.SurveyFilters Where dr.SurveyFilterType = SurveyFilterTypeEnum.QuestionFilter AndAlso dr.Active = True Select dr).ToList()

                            If QuestionFiltersList IsNot Nothing AndAlso QuestionFiltersList.Count() > 0 AndAlso ResponseQuestions IsNot Nothing AndAlso ResponseQuestions.Count() > 0 Then

                                '# Check through the current list of response questions to see if we have any matches
                                ResponseQuestions = (From dr In ResponseQuestions Where Not String.IsNullOrEmpty(dr.AnswerValue) Select dr).ToList()


                                If CurrentSurveyControl.QuestionFilterType = SurveyControl.QuestionFilterTypeEnum.OrFilter Then
                                    '# Or operator - Answers that match filter 1 or filter 2 or filter 3 etc.
                                    For Each rq In ResponseQuestions

                                        Dim QuestionMatchingFilters As New List(Of SurveyFilter)

                                        '# Carry out filtering in one of two ways based on whether the question answer is free text or not
                                        If rq.FreeTextAnswer Then
                                            QuestionMatchingFilters = (From dr In QuestionFiltersList Where dr.FieldValue.Replace("[", "").Replace(")]", "").Replace("question(", "") = rq.QuestionID AndAlso Not String.IsNullOrEmpty(rq.AnswerValue) AndAlso dr.FilterValue = rq.AnswerValue Select dr).ToList()
                                        Else
                                            QuestionMatchingFilters = (From dr In QuestionFiltersList Where dr.FieldValue.Replace("[", "").Replace(")]", "").Replace("question(", "") = rq.QuestionID AndAlso dr.QuestionOptionID = rq.OptionID AndAlso Not String.IsNullOrEmpty(rq.AnswerValue) Select dr).ToList()
                                        End If

                                        If QuestionMatchingFilters IsNot Nothing AndAlso QuestionMatchingFilters.Count() > 0 Then ResponseIsOK = True
                                    Next

                                Else
                                    '# And operator - Answers that match filter 1 and filter 2 and filter 3 etc.
                                    Dim QuestionMatchingFilter As Boolean = True

                                    For Each sf As SurveyFilter In QuestionFiltersList

                                        '# Make sure we only continue if we've got matches so far!
                                        If QuestionMatchingFilter Then

                                            Dim FieldValue As String = sf.FieldValue.Replace("[", "").Replace(")]", "").Replace("question(", "")
                                            Dim QuestionOptionID As String = sf.QuestionOptionID
                                            Dim FilterValue As String = sf.FilterValue

                                            Dim FilterMatch As Boolean = False

                                            '# Check to see if there is a match for this filter in the current list of response questions
                                            For Each rq In ResponseQuestions
                                                If rq.FreeTextAnswer Then
                                                    If rq.QuestionID = FieldValue AndAlso FilterValue = rq.AnswerValue Then FilterMatch = True
                                                Else
                                                    If rq.QuestionID = FieldValue AndAlso QuestionOptionID = rq.OptionID Then FilterMatch = True
                                                End If

                                                If FilterMatch Then Exit For
                                            Next

                                            QuestionMatchingFilter = FilterMatch

                                        End If

                                    Next

                                    If QuestionMatchingFilter Then ResponseIsOK = True

                                End If

                            Else
                                '# Not filters so all is ok!
                                ResponseIsOK = True
                            End If

                            '# Add item - if we have a match
                            If ResponseIsOK Then QuestionFilteredResponses.Add(sr)
                        Next

                        '# Add to the current list
                        If QuestionFilteredResponses IsNot Nothing AndAlso QuestionFilteredResponses.Count() > 0 Then
                            For Each qfr In QuestionFilteredResponses
                                Dim Matches = (From dr In LocalSurveyResponses Where dr.ID = qfr.ID AndAlso dr.ResponseID = qfr.ResponseID Select dr).ToList()
                                If Matches Is Nothing OrElse Matches.Count() <= 0 Then
                                    LocalSurveyResponses.Add(qfr)
                                End If
                            Next

                            LocalSurveyResponses = QuestionFilteredResponses
                        End If

                    End If

                    ReturnValue = LocalSurveyResponses

                Else
                    ReturnValue = AllSurveyResponses
                End If

                '# Return results
                Return ReturnValue

            Catch ex As Exception
                Throw New Exception("There was a problem with your request - " & ex.Message)
            End Try

        End Function
#End Region

#Region "GetSurveyResponseByID"
        Public Shared Function GetSurveyResponseByID(SurveyID As Integer, SurveyResponseID As Integer) As SurveyResponse

            Try

                Dim ResponseXML As XElement = SurveyFunctions.MakeXMLQuery(SurveyID, "/surveyresponse/" & SurveyResponseID.ToString())

                '# Add 
                If CurrentSurveyControl IsNot Nothing Then
                    With CurrentSurveyControl
                        .AddSurveyFilter(SurveyFilterTypeEnum.General, "istestdata", "=", "0")
                    End With
                End If

                If ResponseXML IsNot Nothing Then

                    Dim ResultOk = (From dr In ResponseXML.Elements("result_ok") Select dr).FirstOrDefault()
                    Dim Code = (From dr In ResponseXML.Elements("code") Select dr).FirstOrDefault()

                    If ResultOk IsNot Nothing AndAlso Not String.IsNullOrEmpty(ResultOk.Value()) Then

                        Dim ReturnValue As SurveyResponse = Nothing

                        '# Retrieve a list of the XML items from this response
                        Dim ResponseItem = (From dr In ResponseXML.Elements("data") Select dr).FirstOrDefault()

                        If ResponseItem IsNot Nothing Then
                            ReturnValue = SurveyResponses.GetSurveyResponse(ResponseItem, "date_submitted")
                        End If

                        Return ReturnValue

                    Else
                        Throw New Exception(Code.Value())
                    End If

                Else
                    Throw New Exception("No response")
                End If

            Catch ex As Exception
                Throw New Exception("There was a problem with your request - " & ex.Message)
            End Try

        End Function
#End Region

#Region "GetSurveyResponseByQuestionID"
        Public Shared Function GetSurveyResponseByQuestionID(SurveyID As Integer, QuestionID As Integer) As SurveyResponse

            Try

                Dim ResponseXML As XElement = SurveyFunctions.MakeXMLQuery(SurveyID, "/surveyresponse", "&filter[field][0]=[question(" & QuestionID & ")]&filter[operator][0]==&filter[value][0]=yes")

                '# Add 
                If CurrentSurveyControl IsNot Nothing Then
                    With CurrentSurveyControl
                        .AddSurveyFilter(SurveyFilterTypeEnum.General, "istestdata", "=", "0")
                    End With
                End If

                If ResponseXML IsNot Nothing Then

                    Dim ResultOk = (From dr In ResponseXML.Elements("result_ok") Select dr).FirstOrDefault()
                    Dim Code = (From dr In ResponseXML.Elements("code") Select dr).FirstOrDefault()

                    If ResultOk IsNot Nothing AndAlso Not String.IsNullOrEmpty(ResultOk.Value()) Then

                        Dim ReturnValue As SurveyResponse = Nothing

                        '# Retrieve a list of the XML items from this response
                        Dim ResponseItem = (From dr In ResponseXML.Elements("data") Select dr).FirstOrDefault()

                        If ResponseItem IsNot Nothing Then
                            ReturnValue = SurveyResponses.GetSurveyResponse(ResponseItem, "date_submitted")
                        End If

                        Return ReturnValue

                    Else
                        Throw New Exception(Code.Value())
                    End If

                Else
                    Throw New Exception("No response")
                End If

            Catch ex As Exception
                Throw New Exception("There was a problem with your request - " & ex.Message)
            End Try

        End Function
#End Region
#End Region

#Region "SurveyStatistics"
        '#Region "GetAllSurveyStatistics"
        '        Public Shared Function GetAllSurveyStatistics(SurveyID As Integer) As List(Of SurveyStatistic)

        '            Try

        '                Dim ResponseXML As XElement = SurveyFunctions.MakeXMLQuery(SurveyID, "/surveystatistic")

        '                If ResponseXML IsNot Nothing Then

        '                    Dim ResultOk = (From dr In ResponseXML.Elements("result_ok") Select dr).FirstOrDefault()
        '                    Dim Code = (From dr In ResponseXML.Elements("code") Select dr).FirstOrDefault()

        '                    If ResultOk IsNot Nothing AndAlso Not String.IsNullOrEmpty(ResultOk.Value()) Then

        '                        Dim ReturnValue As List(Of SurveyStatistic) = New List(Of SurveyStatistic)

        '                        '# Retrieve a list of the XML items from this response
        '                        Dim ResponseItems = (From dr In ResponseXML.Elements("data").Elements() Select dr).ToList()

        '                        If ResponseItems IsNot Nothing Then

        '                            '# Extract the information from each item and create a new instance of FeedItem for each one
        '                            For Each i As XElement In ResponseItems
        '                                With i
        '                                    ReturnValue.Add(SurveyStatistics.GetSurveyStatistic(i))
        '                                End With
        '                            Next

        '                        End If

        '                        Return ReturnValue

        '                    Else
        '                        Throw New Exception(Code.Value())
        '                    End If

        '                Else
        '                    Throw New Exception("No response")
        '                End If

        '            Catch ex As Exception
        '                Throw New Exception("There was a problem with your request - " & ex.Message)
        '            End Try

        '        End Function
        '#End Region

        '#Region "GetSurveyStatisticsByPageID"
        '        Public Shared Function GetSurveyStatisticsByPageID(SurveyID As Integer, SurveyPageID As Integer) As List(Of SurveyStatistic)

        '            Try

        '                Dim ResponseXML As XElement = SurveyFunctions.MakeXMLQuery(SurveyID, "/surveystatistic/", "&surveypage=" & SurveyPageID.ToString())

        '                If ResponseXML IsNot Nothing Then

        '                    Dim ResultOk = (From dr In ResponseXML.Elements("result_ok") Select dr).FirstOrDefault()
        '                    Dim Code = (From dr In ResponseXML.Elements("code") Select dr).FirstOrDefault()

        '                    If ResultOk IsNot Nothing AndAlso Not String.IsNullOrEmpty(ResultOk.Value()) Then

        '                        Dim ReturnValue As List(Of SurveyStatistic) = New List(Of SurveyStatistic)

        '                        '# Retrieve a list of the XML items from this response
        '                        Dim ResponseItems = (From dr In ResponseXML.Elements("data").Elements() Select dr).ToList()

        '                        If ResponseItems IsNot Nothing Then

        '                            '# Extract the information from each item and create a new instance of FeedItem for each one
        '                            For Each i As XElement In ResponseItems
        '                                With i
        '                                    ReturnValue.Add(SurveyStatistics.GetSurveyStatistic(i))
        '                                End With
        '                            Next

        '                        End If

        '                        Return ReturnValue

        '                    Else
        '                        Throw New Exception(Code.Value())
        '                    End If

        '                Else
        '                    Throw New Exception("No response")
        '                End If

        '            Catch ex As Exception
        '                Throw New Exception("There was a problem with your request - " & ex.Message)
        '            End Try

        '        End Function
        '#End Region

#Region "GetSurveyStatisticsByQuestionID"
        Public Shared Function GetSurveyStatisticsByQuestionID(SurveyID As Integer, SurveyQuestionID As Integer) As SurveyStatistic

            Try

                Dim ResponseXML As XElement = SurveyFunctions.MakeXMLQuery(SurveyID, "/surveystatistic/" & SurveyQuestionID.ToString())

                If ResponseXML IsNot Nothing Then

                    Dim ResultOk = (From dr In ResponseXML.Elements("result_ok") Select dr).FirstOrDefault()
                    Dim Code = (From dr In ResponseXML.Elements("code") Select dr).FirstOrDefault()

                    If ResultOk IsNot Nothing AndAlso Not String.IsNullOrEmpty(ResultOk.Value()) Then

                        Dim ReturnValue As SurveyStatistic = Nothing

                        '# Retrieve a list of the XML items from this response
                        Dim ResponseItem = (From dr In ResponseXML.Elements("data") Select dr).FirstOrDefault()

                        If ResponseItem IsNot Nothing Then
                            ReturnValue = SurveyStatistics.GetSurveyStatistic(ResponseItem)
                        End If

                        Return ReturnValue

                    Else
                        Throw New Exception(Code.Value())
                    End If

                Else
                    Throw New Exception("No response")
                End If

            Catch ex As Exception
                Throw New Exception("There was a problem with your request - " & ex.Message)
            End Try

        End Function
#End Region
#End Region

#Region "AccountUser"
#Region "GetAllAccountUsers"
        Public Shared Function GetAllAccountUsers() As List(Of SurveyLibrary.Survey)

            Try

                Dim ResponseXML As XElement = SurveyFunctions.MakeXMLBasic("accountuser")

                If ResponseXML IsNot Nothing Then

                    Dim ResultOk = (From dr In ResponseXML.Elements("result_ok") Select dr).FirstOrDefault()
                    Dim Code = (From dr In ResponseXML.Elements("code") Select dr).FirstOrDefault()

                    If ResultOk IsNot Nothing AndAlso Not String.IsNullOrEmpty(ResultOk.Value()) Then

                        Dim ReturnValue As List(Of Survey) = New List(Of Survey)

                        '# Retrieve a list of the XML items from this response
                        Dim ResponseItems = (From dr In ResponseXML.Elements("data").Elements() Select dr).ToList()

                        If ResponseItems IsNot Nothing Then

                            '# Extract the information from each item and create a new instance of FeedItem for each one
                            For Each i As XElement In ResponseItems
                                With i
                                    'ReturnValue.Add(Surveys.GetSurvey(i, False, True))
                                End With
                            Next

                        End If

                        Return ReturnValue

                    Else
                        Throw New Exception(Code.Value())
                    End If

                Else
                    Throw New Exception("No response")
                End If

            Catch ex As Exception
                Throw New Exception("There was a problem with your request - " & ex.Message)
            End Try

        End Function
#End Region

#End Region

    End Class
End Namespace