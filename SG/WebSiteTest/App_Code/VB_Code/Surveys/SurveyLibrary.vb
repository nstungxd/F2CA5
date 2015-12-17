Option Strict On

Imports System.Net
Imports System.IO
Imports System.Xml
Imports Newtonsoft.Json

'# Uses Json.NET - http://james.newtonking.com/pages/json-net.aspx

Namespace PingSurveys
    Public NotInheritable Class SurveyLibrary

#Region "CurrentSurveyControl"
        Public Shared ReadOnly Property CurrentSurveyControl As SurveyControl
            Get
                If HttpContext.Current.Session("CurrentSurveyControl") Is Nothing Then HttpContext.Current.Session("CurrentSurveyControl") = New SurveyControl()

                '# Get the current survery control class
                Dim SurveyControl As SurveyControl = CType(HttpContext.Current.Session("CurrentSurveyControl"), SurveyControl)

                Return SurveyControl
            End Get
        End Property
#End Region

#Region "Survey"
        Public Class Survey

#Region "ID"
            Protected _ID As String
            Public Property ID As String
                Get
                    Return _ID
                End Get
                Set(value As String)
                    _ID = value
                End Set
            End Property
#End Region

#Region "Team"
            Protected _Team As String
            Public Property Team As String
                Get
                    Return _Team
                End Get
                Set(value As String)
                    _Team = value
                End Set
            End Property
#End Region

#Region "Type"
            Protected _Type As String
            Public Property Type As String
                Get
                    Return _Type
                End Get
                Set(value As String)
                    _Type = value
                End Set
            End Property
#End Region

#Region "SubType"
            Protected _SubType As String
            Public Property SubType As String
                Get
                    Return _SubType
                End Get
                Set(value As String)
                    _SubType = value
                End Set
            End Property
#End Region

#Region "Status"
            Protected _Status As String
            Public Property Status As String
                Get
                    Return _Status
                End Get
                Set(value As String)
                    _Status = value
                End Set
            End Property
#End Region

#Region "CreatedOn"
            Protected _CreatedOn As DateTime
            Public Property CreatedOn As DateTime
                Get
                    Return _CreatedOn
                End Get
                Set(value As DateTime)
                    _CreatedOn = value
                End Set
            End Property
#End Region

#Region "ModifiedOn"
            Protected _ModifiedOn As DateTime
            Public Property ModifiedOn As DateTime
                Get
                    Return _ModifiedOn
                End Get
                Set(value As DateTime)
                    _ModifiedOn = value
                End Set
            End Property
#End Region

#Region "ForwardOnly"
            Protected _ForwardOnly As Boolean
            Public Property ForwardOnly As Boolean
                Get
                    Return _ForwardOnly
                End Get
                Set(value As Boolean)
                    _ForwardOnly = value
                End Set
            End Property
#End Region

#Region "Languages"
            Protected _Languages As String
            Public Property Languages As String
                Get
                    Return _Languages
                End Get
                Set(value As String)
                    _Languages = value
                End Set
            End Property
#End Region

#Region "Title"
            Protected _Title As String
            Public Property Title As String
                Get
                    Return _Title
                End Get
                Set(value As String)
                    _Title = value
                End Set
            End Property
#End Region

#Region "InternalTitle"
            Protected _InternalTitle As String
            Public Property InternalTitle As String
                Get
                    Return _InternalTitle
                End Get
                Set(value As String)
                    _InternalTitle = value
                End Set
            End Property
#End Region

#Region "TitleML"
            Protected _TitleML As String
            Public Property TitleML As String
                Get
                    Return _TitleML
                End Get
                Set(value As String)
                    _TitleML = value
                End Set
            End Property
#End Region

#Region "Links"
            Protected _Links As List(Of KeyValuePair(Of String, String))
            Public Property Links As List(Of KeyValuePair(Of String, String))
                Get
                    Return _Links
                End Get
                Set(value As List(Of KeyValuePair(Of String, String)))
                    _Links = value
                End Set
            End Property
#End Region

#Region "Statistics"
            Protected _Statistics As List(Of KeyValuePair(Of String, String))
            Public Property Statistics As List(Of KeyValuePair(Of String, String))
                Get
                    Return _Statistics
                End Get
                Set(value As List(Of KeyValuePair(Of String, String)))
                    _Statistics = value
                End Set
            End Property
#End Region

#Region "Theme"
            Protected _Theme As String
            Public Property Theme As String
                Get
                    Return _Theme
                End Get
                Set(value As String)
                    _Theme = value
                End Set
            End Property
#End Region

#Region "DecorativeHeaderImage"
            Protected _DecorativeHeaderImage As String
            Public Property DecorativeHeaderImage As String
                Get
                    Return _DecorativeHeaderImage
                End Get
                Set(value As String)
                    _DecorativeHeaderImage = value
                End Set
            End Property
#End Region


#Region "ViewDetails"
            Protected _ViewDetails As Boolean
            Public Property ViewDetails As Boolean
                Get
                    Return _ViewDetails
                End Get
                Set(value As Boolean)
                    _ViewDetails = value
                End Set
            End Property
#End Region

#Region "QuestionsToHide"
            Protected _QuestionsToHide As String
            Public Property QuestionsToHide As String
                Get
                    Return _QuestionsToHide
                End Get
                Set(value As String)
                    _QuestionsToHide = value
                End Set
            End Property
#End Region

#Region "MinimumResponsesAllowed"
            Protected _MinimumResponsesAllowed As Integer
            Public Property MinimumResponsesAllowed As Integer
                Get
                    Return _MinimumResponsesAllowed
                End Get
                Set(value As Integer)
                    _MinimumResponsesAllowed = value
                End Set
            End Property
#End Region


#Region "Blockby"
            Protected _Blockby As String
            Public Property Blockby As String
                Get
                    Return _Blockby
                End Get
                Set(value As String)
                    _Blockby = value
                End Set
            End Property
#End Region

#Region "Pages"
            Protected _Pages As List(Of SurveyPage)
            Public Property Pages As List(Of SurveyPage)
                Get
                    Return _Pages
                End Get
                Set(value As List(Of SurveyPage))
                    _Pages = value
                End Set
            End Property
#End Region

#Region "Questions"
            Protected _Questions As List(Of SurveyQuestion)
            Public Property Questions As List(Of SurveyQuestion)
                Get
                    Return _Questions
                End Get
                Set(value As List(Of SurveyQuestion))
                    _Questions = value
                End Set
            End Property
#End Region

#Region "Responses"
            Protected _Responses As List(Of SurveyResponse)
            Public Property Responses As List(Of SurveyResponse)
                Get
                    Return _Responses
                End Get
                Set(value As List(Of SurveyResponse))
                    _Responses = value
                End Set
            End Property
#End Region

#Region "AllResponses"
            Protected _AllResponses As List(Of SurveyResponse)
            Public Property AllResponses As List(Of SurveyResponse)
                Get
                    Return _AllResponses
                End Get
                Set(value As List(Of SurveyResponse))
                    _AllResponses = value
                End Set
            End Property
#End Region

            Public Sub New(ID As String, Team As String, Type As String, SubType As String, Status As String, CreatedOn As DateTime, ModifiedOn As DateTime, ForwardOnly As Boolean, Languages As String, Title As String, InternalTitle As String, TitleML As String, Links As List(Of KeyValuePair(Of String, String)), Statistics As List(Of KeyValuePair(Of String, String)), Theme As String, Blockby As String, Pages As List(Of SurveyPage), Questions As List(Of SurveyQuestion), ResponseItems As List(Of SurveyResponse), AllResponseItems As List(Of SurveyResponse), Optional DecorativeHeaderImage As String = "")
                _ID = ID
                _Team = Team
                _Type = Type
                _SubType = SubType
                _Status = Status
                _CreatedOn = CreatedOn
                _ModifiedOn = ModifiedOn
                _ForwardOnly = ForwardOnly
                _Languages = Languages
                _Title = Title
                _InternalTitle = InternalTitle
                _TitleML = TitleML
                _Links = Links
                _Statistics = Statistics
                _Theme = Theme
                _Blockby = Blockby
                _Pages = Pages
                _Questions = Questions
                _Responses = ResponseItems
                _AllResponses = AllResponseItems
                _DecorativeHeaderImage = DecorativeHeaderImage
            End Sub

            Public Sub AddDecorativeHeaderImage(ImageURL As String)
                _DecorativeHeaderImage = ImageURL
            End Sub

            Public Sub SetViewDetails(ViewDetailsValue As Boolean)
                _ViewDetails = ViewDetailsValue
            End Sub

            Public Sub SetQuestionsToHide(QuestionsToHideValue As String)
                _QuestionsToHide = QuestionsToHideValue
            End Sub

            Public Sub SetMinimumResponsesAllowed(MinimumResponsesAllowedValue As Integer)
                _MinimumResponsesAllowed = MinimumResponsesAllowedValue
            End Sub

            Public Function CanViewQuestionDetails(QuestionID As Integer) As Boolean

                Dim ViewSurveyQuestion As Boolean = True

                '# Check ViewDetails
                If Not ViewDetails Then ViewSurveyQuestion = False

                '# Check Questions
                If ViewSurveyQuestion AndAlso Not String.IsNullOrEmpty(QuestionsToHide) Then
                    QuestionsToHide = QuestionsToHide.Replace(" ", "")
                    Dim QuestionsToHideList() As String = QuestionsToHide.Split(CChar(","))

                    If QuestionsToHideList IsNot Nothing AndAlso QuestionsToHideList.Length > 0 Then
                        For Each s As String In QuestionsToHideList
                            If s = QuestionID.ToString() Then
                                ViewSurveyQuestion = False
                                Exit For
                            End If
                        Next
                    End If
                End If

                Return ViewSurveyQuestion

            End Function

        End Class

        Public NotInheritable Class Surveys
            Public Shared Function GetSurvey(xEl As XElement, Optional SingleQuery As Boolean = False, Optional BasicResponse As Boolean = False, Optional Filter As String = "", Optional SkipFiltering As Boolean = False) As Survey

                Try

                    If xEl IsNot Nothing Then
                        With xEl

                            Dim SurveyID As Integer = SurveyFunctions.FormatElement(Of Integer)(.Element("id"))

                            '# Filters
                            Dim SurveyFilters As List(Of SurveyFilter) = Nothing
                            If CurrentSurveyControl IsNot Nothing Then
                                SurveyFilters = CurrentSurveyControl.SurveyFilters
                            End If

                            '# Links
                            Dim Links As New List(Of KeyValuePair(Of String, String))
                            If Not BasicResponse Then
                                Dim LinksList = (From dr In .Elements("links").Elements() Select dr).ToList()

                                If LinksList IsNot Nothing AndAlso LinksList.Count > 0 Then
                                    For Each l As XElement In LinksList
                                        Links.Add(New KeyValuePair(Of String, String)(l.Name.ToString(), SurveyFunctions.FormatElement(l)))
                                    Next
                                End If
                            End If

                            '# Statistics
                            Dim Statistics As New List(Of KeyValuePair(Of String, String))
                            If Not BasicResponse Then
                                Dim StatisticsList = (From dr In .Elements("statistics").Elements() Select dr).ToList()

                                If StatisticsList IsNot Nothing AndAlso StatisticsList.Count > 0 Then
                                    For Each l As XElement In StatisticsList
                                        Statistics.Add(New KeyValuePair(Of String, String)(l.Name.ToString(), SurveyFunctions.FormatElement(l)))
                                    Next
                                End If
                            End If

                            '# Pages
                            Dim Pages As New List(Of SurveyPage)
                            'If Not BasicResponse Then
                            '    Dim PagesList = (From dr In .Elements("pages").Elements() Select dr).ToList()

                            '    If PagesList IsNot Nothing AndAlso PagesList.Count > 0 Then
                            '        For Each l As XElement In PagesList
                            '            Pages.Add(SurveyPages.GetSurveyPage(l))
                            '        Next
                            '    End If
                            'End If

                            '# Get Total Count of Responses
                            Dim TotalResponseCount As Integer = 0
                            If Statistics IsNot Nothing AndAlso Statistics.Count() > 0 Then
                                For Each s As KeyValuePair(Of String, String) In Statistics
                                    If s.Key = "Partial" Or s.Key = "Complete" Then
                                        Dim StatCount As Integer = 0
                                        Int32.TryParse(s.Value, StatCount)
                                        TotalResponseCount += StatCount
                                    End If
                                Next
                            End If

                            '# Responses
                            Dim ResponseItems As New List(Of SurveyResponse)
                            Dim AllResponseItems As New List(Of SurveyResponse)
                            If Not BasicResponse Then

                                '# Get all (unfiltered) responses - check cache first!
                                Try
                                    Dim CachedResponseItems As List(Of SurveyResponse) = CType(HttpContext.Current.Cache.Get("AllResponseItems_" & SurveyID), List(Of SurveyResponse))
                                    If CachedResponseItems IsNot Nothing AndAlso CachedResponseItems.Count() > 0 Then
                                        AllResponseItems = CachedResponseItems
                                    End If
                                Catch ex As Exception
                                End Try

                                If AllResponseItems Is Nothing OrElse AllResponseItems.Count() <= 0 Then
                                    AllResponseItems = SurveyAccess.GetAllSurveyResponses(SurveyID, SurveyFilters, True, TotalResponseCount)

                                    '# Add to cache
                                    HttpContext.Current.Cache.Insert("AllResponseItems_" & SurveyID, AllResponseItems, Nothing, System.DateTime.Now.AddMinutes(30), System.Web.Caching.Cache.NoSlidingExpiration)
                                End If

                                '# Filter values
                                ResponseItems = SurveyAccess.GetFilteredSurveyResponses(AllResponseItems)
                            End If

                            '# Questions
                            Dim Questions As List(Of SurveyQuestion) = Nothing
                            If Not BasicResponse Then Questions = SurveyAccess.GetAllSurveyQuestions(SurveyID, SingleQuery)

                            '# Set header image
                            Dim DecorativeHeaderImage As String = ""
                            If Questions IsNot Nothing Then
                                Dim MediaQuestions = (From dr In Questions Where dr.Type = "SurveyDecorative" AndAlso dr.SubType = "media" Select dr).ToList()

                                If MediaQuestions IsNot Nothing AndAlso MediaQuestions.Count() > 0 Then
                                    For Each mq As SurveyQuestion In MediaQuestions

                                        Dim PropertiesList As List(Of KeyValuePair(Of String, String)) = mq.Properties

                                        If PropertiesList IsNot Nothing AndAlso PropertiesList.Count > 0 Then
                                            For Each pl As KeyValuePair(Of String, String) In PropertiesList
                                                If pl.Key = "url" Then
                                                    DecorativeHeaderImage = pl.Value
                                                End If
                                            Next
                                        End If
                                    Next
                                End If
                            End If


                            Dim NewItem As Survey = New Survey(SurveyFunctions.FormatElement(.Element("id")),
                                                               SurveyFunctions.FormatElement(.Element("team")),
                                                               SurveyFunctions.FormatElement(.Element("_type")),
                                                               SurveyFunctions.FormatElement(.Element("_subtype")),
                                                               SurveyFunctions.FormatElement(.Element("status")),
                                                               SurveyFunctions.FormatElement(Of DateTime)(.Element("created_on")),
                                                               SurveyFunctions.FormatElement(Of DateTime)(.Element("modified_on")),
                                                               SurveyFunctions.FormatElement(Of Boolean)(.Element("forward_only")),
                                                               SurveyFunctions.FormatElement(.Element("languages")),
                                                               SurveyFunctions.FormatElement(.Element("title")),
                                                               SurveyFunctions.FormatElement(.Element("internal_title")),
                                                               SurveyFunctions.FormatElement(.Element("title_ml")),
                                                               Links,
                                                               Statistics,
                                                               SurveyFunctions.FormatElement(.Element("theme")),
                                                               SurveyFunctions.FormatElement(.Element("blockby")),
                                                               Pages,
                                                               Questions,
                                                               ResponseItems,
                                                               AllResponseItems,
                                                               DecorativeHeaderImage)

                            Return NewItem

                        End With

                    Else
                        Return Nothing
                    End If

                Catch ex As Exception
                    Return Nothing
                End Try

            End Function
        End Class
#End Region

#Region "SurveyPage"
        Public Class SurveyPage

#Region "ID"
            Protected _ID As String
            Public Property ID As String
                Get
                    Return _ID
                End Get
                Set(value As String)
                    _ID = value
                End Set
            End Property
#End Region

#Region "Type"
            Protected _Type As String
            Public Property Type As String
                Get
                    Return _Type
                End Get
                Set(value As String)
                    _Type = value
                End Set
            End Property
#End Region

#Region "Title"
            Protected _Title As String
            Public Property Title As String
                Get
                    Return _Title
                End Get
                Set(value As String)
                    _Title = value
                End Set
            End Property
#End Region

#Region "Description"
            Protected _Description As String
            Public Property Description As String
                Get
                    Return _Description
                End Get
                Set(value As String)
                    _Description = value
                End Set
            End Property
#End Region

#Region "Questions"
            Protected _Questions As List(Of SurveyQuestion)
            Public Property Questions As List(Of SurveyQuestion)
                Get
                    Return _Questions
                End Get
                Set(value As List(Of SurveyQuestion))
                    _Questions = value
                End Set
            End Property
#End Region

#Region "Properties"
            Protected _Properties As List(Of KeyValuePair(Of String, String))
            Public Property Properties As List(Of KeyValuePair(Of String, String))
                Get
                    Return _Properties
                End Get
                Set(value As List(Of KeyValuePair(Of String, String)))
                    _Properties = value
                End Set
            End Property
#End Region

            Public Sub New(ID As String, Type As String, Title As String, Description As String, Questions As List(Of SurveyQuestion), Properties As List(Of KeyValuePair(Of String, String)))
                _ID = ID
                _Type = Type
                _Title = Title
                _Description = Description
                _Questions = Questions
                _Properties = Properties
            End Sub

        End Class

        Public NotInheritable Class SurveyPages
            Public Shared Function GetSurveyPage(xEl As XElement) As SurveyPage

                Try

                    If xEl IsNot Nothing Then
                        With xEl

                            '# Properties
                            Dim Properties As New List(Of KeyValuePair(Of String, String))
                            Dim PropertiesList = (From dr In .Elements("properties").Elements() Select dr).ToList()

                            If PropertiesList IsNot Nothing AndAlso PropertiesList.Count > 0 Then
                                For Each l As XElement In PropertiesList
                                    Properties.Add(New KeyValuePair(Of String, String)(l.Name.ToString(), SurveyFunctions.FormatElement(l)))
                                Next
                            End If

                            '# Questions
                            Dim Questions As New List(Of SurveyQuestion)
                            Dim QuestionsList = (From dr In .Elements("questions").Elements() Select dr).ToList()

                            If QuestionsList IsNot Nothing AndAlso QuestionsList.Count > 0 Then
                                For Each l As XElement In QuestionsList
                                    Questions.Add(SurveyQuestions.GetSurveyQuestion(l))
                                Next
                            End If

                            Dim NewItem As SurveyPage = New SurveyPage(SurveyFunctions.FormatElement(.Element("id")), SurveyFunctions.FormatElement(.Element("_type")), SurveyFunctions.FormatElement(.Element("title")), SurveyFunctions.FormatElement(.Element("description")), Questions, Properties)

                            Return NewItem

                        End With

                    Else
                        Return Nothing
                    End If

                Catch ex As Exception
                    Return Nothing
                End Try

            End Function
        End Class
#End Region

#Region "SurveyQuestion"
        Public Class SurveyQuestion
#Region "ID"
            Protected _ID As String
            Public Property ID As String
                Get
                    Return _ID
                End Get
                Set(value As String)
                    _ID = value
                End Set
            End Property
#End Region

#Region "Type"
            Protected _Type As String
            Public Property Type As String
                Get
                    Return _Type
                End Get
                Set(value As String)
                    _Type = value
                End Set
            End Property
#End Region

#Region "SubType"
            Protected _SubType As String
            Public Property SubType As String
                Get
                    Return _SubType
                End Get
                Set(value As String)
                    _SubType = value
                End Set
            End Property
#End Region

#Region "Title"
            Protected _Title As String
            Public Property Title As String
                Get
                    Return _Title
                End Get
                Set(value As String)
                    _Title = value
                End Set
            End Property
#End Region

#Region "Shortname"
            Protected _Shortname As String
            Public Property Shortname As String
                Get
                    Return _Shortname
                End Get
                Set(value As String)
                    _Shortname = value
                End Set
            End Property
#End Region

#Region "Varname"
            Protected _Varname As String
            Public Property Varname As String
                Get
                    Return _Varname
                End Get
                Set(value As String)
                    _Varname = value
                End Set
            End Property
#End Region

#Region "HasShowhideDeps"
            Protected _HasShowhideDeps As Boolean
            Public Property HasShowhideDeps As Boolean
                Get
                    Return _HasShowhideDeps
                End Get
                Set(value As Boolean)
                    _HasShowhideDeps = value
                End Set
            End Property
#End Region

#Region "Comment"
            Protected _Comment As Boolean
            Public Property Comment As Boolean
                Get
                    Return _Comment
                End Get
                Set(value As Boolean)
                    _Comment = value
                End Set
            End Property
#End Region

#Region "Options"
            Protected _Options As List(Of SurveyOption)
            Public Property Options As List(Of SurveyOption)
                Get
                    Return _Options
                End Get
                Set(value As List(Of SurveyOption))
                    _Options = value
                End Set
            End Property
#End Region

#Region "SubQuestionSkus"
            Protected _SubQuestionSkus As List(Of Integer)
            Public Property SubQuestionSkus As List(Of Integer)
                Get
                    Return _SubQuestionSkus
                End Get
                Set(value As List(Of Integer))
                    _SubQuestionSkus = value
                End Set
            End Property
#End Region

#Region "SubQuestions"
            Public _SubQuestions As List(Of SurveyQuestion)
            Public Property SubQuestions As List(Of SurveyQuestion)
                Get
                    Return _SubQuestions
                End Get
                Set(value As List(Of SurveyQuestion))
                    _SubQuestions = value
                End Set
            End Property
#End Region

#Region "Properties"
            Protected _Properties As List(Of KeyValuePair(Of String, String))
            Public Property Properties As List(Of KeyValuePair(Of String, String))
                Get
                    Return _Properties
                End Get
                Set(value As List(Of KeyValuePair(Of String, String)))
                    _Properties = value
                End Set
            End Property
#End Region

#Region "Statistics"
            Public _Statistics As SurveyStatistic
            Public Property Statistics As SurveyStatistic
                Get
                    Return _Statistics
                End Get
                Set(value As SurveyStatistic)
                    _Statistics = value
                End Set
            End Property
#End Region


            '# No data for:
            '# Continuous Sum Properties
            '# File Upload Properties
            '# URL Redirect Properties
            '# Result Chart Properties

            Public Sub New(ID As String, Type As String, SubType As String, Title As String, Shortname As String, Varname As String, HasShowhideDeps As Boolean, Comment As Boolean, Options As List(Of SurveyOption), SubQuestionSkus As List(Of Integer), Properties As List(Of KeyValuePair(Of String, String)), Statistics As SurveyStatistic)
                _ID = ID
                _Type = Type
                _SubType = SubType
                _Title = Title
                _Shortname = Shortname
                _Varname = Varname
                _HasShowhideDeps = HasShowhideDeps
                _Comment = Comment
                _Options = Options
                _SubQuestionSkus = SubQuestionSkus
                _Properties = Properties
                _Statistics = Statistics
            End Sub

        End Class

        Public NotInheritable Class SurveyQuestions
            Public Shared Function GetSurveyQuestion(xEl As XElement, Optional SurveyID As Integer = 0) As SurveyQuestion

                Try

                    If xEl IsNot Nothing Then
                        With xEl

                            '# Question ID
                            Dim QuestionID As Integer = SurveyFunctions.FormatElement(Of Integer)(.Element("id"))
                            Dim QuestionTitle As String = SurveyFunctions.FormatElement(.Element("title"))

                            '# Type - to check for questions only
                            Dim Type As String = SurveyFunctions.FormatElement(.Element("_type"))
                            Dim SubType As String = SurveyFunctions.FormatElement(.Element("_subtype"))

                            If Not String.IsNullOrEmpty(Type) AndAlso Type = "SurveyQuestion" Then

                                '# Properties
                                Dim Properties As New List(Of KeyValuePair(Of String, String))
                                Dim PropertiesList = (From dr In .Elements("properties").Elements() Select dr).ToList()

                                If PropertiesList IsNot Nothing AndAlso PropertiesList.Count > 0 Then
                                    For Each l As XElement In PropertiesList
                                        Properties.Add(New KeyValuePair(Of String, String)(l.Name.ToString(), SurveyFunctions.FormatElement(l)))
                                    Next
                                End If

                                '# Statistic
                                Dim StatisticItem As SurveyStatistic = Nothing
                                If SurveyID > 0 Then
                                    StatisticItem = SurveyAccess.GetSurveyStatisticsByQuestionID(SurveyID, QuestionID)
                                End If

                                '# Options
                                Dim Options As New List(Of SurveyOption)
                                Dim OptionsList = (From dr In .Elements("options").Elements() Select dr).ToList()

                                If OptionsList IsNot Nothing AndAlso OptionsList.Count > 0 Then
                                    For Each l As XElement In OptionsList
                                        Options.Add(SurveyOptions.GetSurveyOption(l, QuestionID, QuestionTitle, StatisticItem))
                                    Next
                                End If

                                '# SubQuestionSkus
                                Dim SubQuestionSkus As New List(Of Integer)
                                Dim SubQuestionSkusList = (From dr In .Elements("sub_question_skus").Elements() Select dr).ToList()

                                If SubQuestionSkusList IsNot Nothing AndAlso SubQuestionSkusList.Count > 0 Then
                                    For Each l As XElement In SubQuestionSkusList
                                        SubQuestionSkus.Add(SurveyFunctions.FormatElement(Of Integer)(l))
                                    Next
                                End If

                                Dim NewItem As SurveyQuestion = New SurveyQuestion(QuestionID.ToString(),
                                                                                   Type,
                                                                                   SubType,
                                                                                   SurveyFunctions.FormatElement(.Element("title")),
                                                                                   SurveyFunctions.FormatElement(.Element("shortname")),
                                                                                   SurveyFunctions.FormatElement(.Element("varname")),
                                                                                   SurveyFunctions.FormatElement(Of Boolean)(.Element("has_showhide_deps")),
                                                                                   SurveyFunctions.FormatElement(Of Boolean)(.Element("comment")),
                                                                                   Options,
                                                                                   SubQuestionSkus,
                                                                                   Properties,
                                                                                   StatisticItem)

                                Return NewItem

                            ElseIf Not String.IsNullOrEmpty(Type) AndAlso Type = "SurveyDecorative" AndAlso Not String.IsNullOrEmpty(SubType) AndAlso SubType = "media" Then

                                '# Properties
                                Dim Properties As New List(Of KeyValuePair(Of String, String))
                                Dim PropertiesList = (From dr In .Elements("properties").Elements() Select dr).ToList()

                                If PropertiesList IsNot Nothing AndAlso PropertiesList.Count > 0 Then
                                    For Each l As XElement In PropertiesList
                                        Properties.Add(New KeyValuePair(Of String, String)(l.Name.ToString(), SurveyFunctions.FormatElement(l)))
                                    Next
                                End If

                                Dim NewItem As SurveyQuestion = New SurveyQuestion(QuestionID.ToString(),
                                                                                   Type, SubType,
                                                                                   SurveyFunctions.FormatElement(.Element("title")),
                                                                                   SurveyFunctions.FormatElement(.Element("shortname")),
                                                                                   SurveyFunctions.FormatElement(.Element("varname")),
                                                                                   SurveyFunctions.FormatElement(Of Boolean)(.Element("has_showhide_deps")),
                                                                                   SurveyFunctions.FormatElement(Of Boolean)(.Element("comment")),
                                                                                   Nothing, Nothing, Properties, Nothing)

                                Return NewItem

                            Else
                                Return Nothing
                                End If

                        End With

                    Else
                        Return Nothing
                    End If

                Catch ex As Exception
                    Return Nothing
                End Try

            End Function
        End Class
#End Region

#Region "SurveyOption"
        Public Class SurveyOption
#Region "ID"
            Protected _ID As String
            Public Property ID As String
                Get
                    Return _ID
                End Get
                Set(value As String)
                    _ID = value
                End Set
            End Property
#End Region

#Region "Type"
            Protected _Type As String
            Public Property Type As String
                Get
                    Return _Type
                End Get
                Set(value As String)
                    _Type = value
                End Set
            End Property
#End Region

#Region "Title"
            Protected _Title As String
            Public Property Title As String
                Get
                    Return _Title
                End Get
                Set(value As String)
                    _Title = value
                End Set
            End Property
#End Region

#Region "Value"
            Protected _Value As String
            Public Property Value As String
                Get
                    Return _Value
                End Get
                Set(value As String)
                    _Value = value
                End Set
            End Property
#End Region

#Region "QuestionID"
            Protected _QuestionID As Integer
            Public Property QuestionID As Integer
                Get
                    Return _QuestionID
                End Get
                Set(value As Integer)
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

#Region "QuestionStatistics"
            Public _QuestionStatistics As SurveyStatistic
            Public Property QuestionStatistics As SurveyStatistic
                Get
                    Return _QuestionStatistics
                End Get
                Set(value As SurveyStatistic)
                    _QuestionStatistics = value
                End Set
            End Property
#End Region

#Region "Properties"
            Protected _Properties As List(Of KeyValuePair(Of String, String))
            Public Property Properties As List(Of KeyValuePair(Of String, String))
                Get
                    Return _Properties
                End Get
                Set(value As List(Of KeyValuePair(Of String, String)))
                    _Properties = value
                End Set
            End Property
#End Region

            Public Sub New(ID As String, Type As String, Title As String, Value As String, QuestionID As Integer, QuestionTitle As String, Properties As List(Of KeyValuePair(Of String, String)), QuestionStatistics As SurveyStatistic)
                _ID = ID
                _Type = Type
                _Title = Title
                _Value = Value
                _QuestionID = QuestionID
                _QuestionTitle = QuestionTitle
                _Properties = Properties
                _QuestionStatistics = QuestionStatistics
            End Sub

        End Class

        Public NotInheritable Class SurveyOptions
            Public Shared Function GetSurveyOption(xEl As XElement, QuestionID As Integer, QuestionTitle As String, Optional QuestionStatistics As SurveyStatistic = Nothing) As SurveyOption

                Try

                    If xEl IsNot Nothing Then
                        With xEl

                            '# Properties
                            Dim Properties As New List(Of KeyValuePair(Of String, String))
                            Dim PropertiesList = (From dr In .Elements("properties").Elements() Select dr).ToList()

                            If PropertiesList IsNot Nothing AndAlso PropertiesList.Count > 0 Then
                                For Each l As XElement In PropertiesList
                                    Properties.Add(New KeyValuePair(Of String, String)(l.Name.ToString(), SurveyFunctions.FormatElement(l)))
                                Next
                            End If

                            Dim NewItem As SurveyOption = New SurveyOption(SurveyFunctions.FormatElement(.Element("id")),
                                                                               SurveyFunctions.FormatElement(.Element("_type")),
                                                                               SurveyFunctions.FormatElement(.Element("title")),
                                                                               SurveyFunctions.FormatElement(.Element("value")),
                                                                               QuestionID,
                                                                               QuestionTitle,
                                                                               Properties,
                                                                               QuestionStatistics)

                            Return NewItem

                        End With

                    Else
                        Return Nothing
                    End If

                Catch ex As Exception
                    Return Nothing
                End Try

            End Function
        End Class
#End Region

#Region "SurveyResponse"
        Public Class SurveyResponse

#Region "ID"
            Protected _ID As String
            Public Property ID As String
                Get
                    Return _ID
                End Get
                Set(value As String)
                    _ID = value
                End Set
            End Property
#End Region

#Region "ContactID"
            Protected _ContactID As String
            Public Property ContactID As String
                Get
                    Return _ContactID
                End Get
                Set(value As String)
                    _ContactID = value
                End Set
            End Property
#End Region

#Region "Status"
            Protected _Status As String
            Public Property Status As String
                Get
                    Return _Status
                End Get
                Set(value As String)
                    _Status = value
                End Set
            End Property
#End Region

#Region "IsTestData"
            Protected _IsTestData As Boolean
            Public Property IsTestData As Boolean
                Get
                    Return _IsTestData
                End Get
                Set(value As Boolean)
                    _IsTestData = value
                End Set
            End Property
#End Region

#Region "DateSubmitted"
            Protected _DateSubmitted As DateTime
            Public Property DateSubmitted As DateTime
                Get
                    Return _DateSubmitted
                End Get
                Set(value As DateTime)
                    _DateSubmitted = value
                End Set
            End Property
#End Region

#Region "ResponseComment"
            Protected _ResponseComment As String
            Public Property ResponseComment As String
                Get
                    Return _ResponseComment
                End Get
                Set(value As String)
                    _ResponseComment = value
                End Set
            End Property
#End Region

#Region "ResponseID"
            Protected _ResponseID As String
            Public Property ResponseID As String
                Get
                    Return _ResponseID
                End Get
                Set(value As String)
                    _ResponseID = value
                End Set
            End Property
#End Region

#Region "ResponseQuestions"
            Protected _ResponseQuestions As List(Of SurveyResponseQuestion)
            Public Property ResponseQuestions As List(Of SurveyResponseQuestion)
                Get
                    Return _ResponseQuestions
                End Get
                Set(value As List(Of SurveyResponseQuestion))
                    _ResponseQuestions = value
                End Set
            End Property
#End Region

            Public Sub New(ID As String, ContactID As String, Status As String, IsTestData As Boolean, DateSubmitted As DateTime, ResponseComment As String, ResponseID As String, ResponseQuestions As List(Of SurveyResponseQuestion))
                _ID = ID
                _ContactID = ContactID
                _Status = Status
                _IsTestData = IsTestData
                _DateSubmitted = DateSubmitted
                _ResponseComment = ResponseComment
                _ResponseID = ResponseID
                _ResponseQuestions = ResponseQuestions
            End Sub

        End Class

        Public NotInheritable Class SurveyResponses
            Public Shared Function GetSurveyResponse(xEl As XElement, Optional DateElementName As String = "datesubmitted") As SurveyResponse

                Try

                    If xEl IsNot Nothing Then
                        With xEl

                            '# Questions
                            Dim ResponseQuestions As New List(Of SurveyResponseQuestion)
                            Dim QuestionElements As List(Of XElement) = (From dr In .Elements() Where dr.Name.ToString().StartsWith("question") Select dr).ToList()

                            For Each QuestionElement As XElement In QuestionElements
                                Try

                                    Dim QuestionName As String = QuestionElement.Name.ToString()

                                    '# Get the answer - if we have one
                                    Dim QuestionValue As String = QuestionElement.Value()

                                    '# Get the Question ID & the Option ID (if we have one)
                                    Dim QuestionID As String = ""
                                    Dim OptionID As String = ""
                                    Dim FreeTextAnswer As Boolean = False

                                    If Not QuestionName.Contains("other") Then

                                        If QuestionName.Contains("option") Then
                                            Dim QuestionPart As String = QuestionName.Substring(0, QuestionName.IndexOf("option"))
                                            Dim OptionPart As String = QuestionName.Substring(QuestionName.IndexOf("option"))

                                            QuestionID = QuestionPart.Replace("question", "")
                                            OptionID = OptionPart.Replace("option", "")
                                        Else
                                            QuestionID = QuestionName.Replace("question", "")
                                            FreeTextAnswer = True
                                        End If

                                        '# Handle 'Other' values
                                        If Not String.IsNullOrEmpty(QuestionValue) AndAlso QuestionValue.ToLower().StartsWith("other") Then

                                            '# Get answer
                                            Dim OtherAnswer As XElement = (From dr In .Elements() Where dr.Name.ToString() = "question" & QuestionID & "option" & OptionID & "other" Select dr).FirstOrDefault()

                                            If OtherAnswer IsNot Nothing Then
                                                QuestionValue = "Other: " & SurveyFunctions.FormatObject(OtherAnswer.Value())
                                            Else
                                                '# Try without option
                                                OtherAnswer = (From dr In .Elements() Where dr.Name.ToString().Contains("question" & QuestionID & "option") AndAlso dr.Name.ToString().Contains("other") Select dr).FirstOrDefault()

                                                If OtherAnswer IsNot Nothing Then
                                                    QuestionValue = "Other: " & SurveyFunctions.FormatObject(OtherAnswer.Value())
                                                End If
                                            End If
                                        End If

                                        '# Question Shown
                                        Dim QuestionShown As Boolean = True
                                        Dim QuestionShownResult As XElement = (From dr In .Elements() Where dr.Name.ToString() = "variable" & QuestionID & "shown" Select dr).FirstOrDefault()

                                        If QuestionShownResult IsNot Nothing Then
                                            QuestionShown = SurveyFunctions.FormatObject(Of Boolean)(QuestionShownResult.Value())
                                        End If

                                        '# Create item
                                        Dim ResponseQuestion As New SurveyResponseQuestion(QuestionID, OptionID, FreeTextAnswer, QuestionValue, QuestionShown)
                                        ResponseQuestions.Add(ResponseQuestion)

                                    End If

                                Catch ex As Exception
                                End Try

                            Next

                            Dim NewItem As SurveyResponse = New SurveyResponse(SurveyFunctions.FormatElement(.Element("id")),
                                                               SurveyFunctions.FormatElement(.Element("contact_id")),
                                                               SurveyFunctions.FormatElement(.Element("status")),
                                                               SurveyFunctions.FormatElement(Of Boolean)(.Element("is_test_data")),
                                                               SurveyFunctions.FormatElement(Of DateTime)(.Element(DateElementName)),
                                                               SurveyFunctions.FormatElement(.Element("sResponseComment")),
                                                               SurveyFunctions.FormatElement(.Element("responseID")),
                                                               ResponseQuestions)

                            Return NewItem

                        End With

                    Else
                        Return Nothing
                    End If

                Catch ex As Exception
                    Return Nothing
                End Try

            End Function
        End Class
#End Region

#Region "SurveyResponseQuestion"
        Public Class SurveyResponseQuestion

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

#Region "FreeTextAnswer"
            Protected _FreeTextAnswer As Boolean
            Public Property FreeTextAnswer As Boolean
                Get
                    Return _FreeTextAnswer
                End Get
                Set(value As Boolean)
                    _FreeTextAnswer = value
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

#Region "QuestionShown"
            Protected _QuestionShown As Boolean
            Public Property QuestionShown As Boolean
                Get
                    Return _QuestionShown
                End Get
                Set(value As Boolean)
                    _QuestionShown = value
                End Set
            End Property
#End Region

            Public Sub New(QuestionID As String, OptionID As String, FreeTextAnswer As Boolean, AnswerValue As String, QuestionShown As Boolean)
                _QuestionID = QuestionID
                _OptionID = OptionID
                _FreeTextAnswer = FreeTextAnswer
                _AnswerValue = AnswerValue
                _QuestionShown = QuestionShown
            End Sub

        End Class

        Public NotInheritable Class SurveyResponseQuestions
            Public Shared Function GetSurveyResponseQuestion(xEl As XElement) As Survey

                Try

                    If xEl IsNot Nothing Then
                        With xEl

                            ''# Links
                            'Dim Links As New List(Of KeyValuePair(Of String, String))
                            'Dim LinksList = (From dr In .Elements("links").Elements() Select dr).ToList()

                            'If LinksList IsNot Nothing AndAlso LinksList.Count > 0 Then
                            '    For Each l As XElement In LinksList
                            '        Links.Add(New KeyValuePair(Of String, String)(l.Name.ToString(), SurveyFunctions.FormatElement(l)))
                            '    Next
                            'End If

                            ''# Statistics
                            'Dim Statistics As New List(Of KeyValuePair(Of String, String))
                            'Dim StatisticsList = (From dr In .Elements("statistics").Elements() Select dr).ToList()

                            'If StatisticsList IsNot Nothing AndAlso StatisticsList.Count > 0 Then
                            '    For Each l As XElement In StatisticsList
                            '        Statistics.Add(New KeyValuePair(Of String, String)(l.Name.ToString(), SurveyFunctions.FormatElement(l)))
                            '    Next
                            'End If

                            ''# Pages
                            'Dim Pages As New List(Of SurveyPage)
                            'Dim PagesList = (From dr In .Elements("pages").Elements() Select dr).ToList()

                            'If PagesList IsNot Nothing AndAlso PagesList.Count > 0 Then
                            '    For Each l As XElement In PagesList
                            '        Pages.Add(SurveyPages.GetSurveyPage(l))
                            '    Next
                            'End If

                            'Dim NewItem As Survey = New Survey(SurveyFunctions.FormatElement(.Element("id")),
                            '                                   SurveyFunctions.FormatElement(.Element("team")),
                            '                                   SurveyFunctions.FormatElement(.Element("_type")),
                            '                                   SurveyFunctions.FormatElement(.Element("_subtype")),
                            '                                   SurveyFunctions.FormatElement(.Element("status")),
                            '                                   SurveyFunctions.FormatElement(Of DateTime)(.Element("created_on")),
                            '                                   SurveyFunctions.FormatElement(Of DateTime)(.Element("modified_on")),
                            '                                   SurveyFunctions.FormatElement(Of Boolean)(.Element("forward_only")),
                            '                                   SurveyFunctions.FormatElement(.Element("languages")),
                            '                                   SurveyFunctions.FormatElement(.Element("title")),
                            '                                   SurveyFunctions.FormatElement(.Element("internal_title")),
                            '                                   SurveyFunctions.FormatElement(.Element("title_ml")),
                            '                                   Links,
                            '                                   Statistics,
                            '                                   SurveyFunctions.FormatElement(.Element("theme")),
                            '                                   SurveyFunctions.FormatElement(.Element("blockby")),
                            '                                   Pages)

                            'Return NewItem

                        End With

                    Else
                        Return Nothing
                    End If

                Catch ex As Exception
                    Return Nothing
                End Try

            End Function
        End Class
#End Region

#Region "SurveyStatistic"
        Public Class SurveyStatistic

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

#Region "Type"
            Protected _Type As String
            Public Property Type As String
                Get
                    Return _Type
                End Get
                Set(value As String)
                    _Type = value
                End Set
            End Property
#End Region

#Region "SubType"
            Protected _SubType As String
            Public Property SubType As String
                Get
                    Return _SubType
                End Get
                Set(value As String)
                    _SubType = value
                End Set
            End Property
#End Region

#Region "TotalResponses"
            Protected _TotalResponses As Integer
            Public Property TotalResponses As Integer
                Get
                    Return _TotalResponses
                End Get
                Set(value As Integer)
                    _TotalResponses = value
                End Set
            End Property
#End Region

#Region "Sum"
            Protected _Sum As Decimal
            Public Property Sum As Decimal
                Get
                    Return _Sum
                End Get
                Set(value As Decimal)
                    _Sum = value
                End Set
            End Property
#End Region

#Region "Average"
            Protected _Average As Decimal
            Public Property Average As Decimal
                Get
                    Return _Average
                End Get
                Set(value As Decimal)
                    _Average = value
                End Set
            End Property
#End Region

#Region "StdDev"
            Protected _StdDev As Decimal
            Public Property StdDev As Decimal
                Get
                    Return _StdDev
                End Get
                Set(value As Decimal)
                    _StdDev = value
                End Set
            End Property
#End Region

#Region "Min"
            Protected _Min As Decimal
            Public Property Min As Decimal
                Get
                    Return _Min
                End Get
                Set(value As Decimal)
                    _Min = value
                End Set
            End Property
#End Region

#Region "Max"
            Protected _Max As Decimal
            Public Property Max As Decimal
                Get
                    Return _Max
                End Get
                Set(value As Decimal)
                    _Max = value
                End Set
            End Property
#End Region

#Region "SurveyStatisticBreakdown"
            Protected _SurveyStatisticBreakdown As List(Of SurveyStatisticBreakdownItem)
            Public Property SurveyStatisticBreakdown As List(Of SurveyStatisticBreakdownItem)
                Get
                    Return _SurveyStatisticBreakdown
                End Get
                Set(value As List(Of SurveyStatisticBreakdownItem))
                    _SurveyStatisticBreakdown = value
                End Set
            End Property
#End Region

            Public Sub New(QuestionID As String, Type As String, SubType As String, TotalResponses As Integer, Sum As Decimal, Average As Decimal, StdDev As Decimal, Min As Decimal, Max As Decimal, SurveyStatisticBreakdown As List(Of SurveyStatisticBreakdownItem))
                _QuestionID = QuestionID
                _Type = Type
                _SubType = SubType
                _TotalResponses = TotalResponses
                _Sum = Sum
                _Average = Average
                _StdDev = StdDev
                _Min = Min
                _Max = Max
                _SurveyStatisticBreakdown = SurveyStatisticBreakdown
            End Sub

        End Class

        Public NotInheritable Class SurveyStatistics
            Public Shared Function GetSurveyStatistic(xEl As XElement) As SurveyStatistic

                Try

                    If xEl IsNot Nothing Then
                        With xEl

                            Dim QuestionID As String = SurveyFunctions.FormatElement(.Element("id"))
                            QuestionID = QuestionID.Replace("[question(", "").Replace(")]", "")

                            '# Breakdown
                            Dim BreakdownValues As New List(Of SurveyStatisticBreakdownItem)
                            Dim BreakdownList = (From dr In .Elements("Breakdown").Elements() Select dr).ToList()

                            If BreakdownList IsNot Nothing AndAlso BreakdownList.Count > 0 Then
                                For Each bl As XElement In BreakdownList
                                    With bl
                                        Dim BreakdownResponse As New SurveyStatisticBreakdownItem(QuestionID,
                                                                                                  SurveyFunctions.FormatElement(.Element("label")),
                                                                                                  SurveyFunctions.FormatElement(.Element("_type")),
                                                                                                  SurveyFunctions.FormatElement(Of Decimal)(.Element("percentage")),
                                                                                                  SurveyFunctions.FormatElement(Of Integer)(.Element("count")))
                                        BreakdownValues.Add(BreakdownResponse)
                                    End With
                                Next
                            End If

                            Dim NewItem As SurveyStatistic = New SurveyStatistic(QuestionID,
                                                               SurveyFunctions.FormatElement(.Element("_type")),
                                                               SurveyFunctions.FormatElement(.Element("_subtype")),
                                                               SurveyFunctions.FormatElement(Of Integer)(.Element("TotalResponses")),
                                                               SurveyFunctions.FormatElement(Of Decimal)(.Element("Sum")),
                                                               SurveyFunctions.FormatElement(Of Decimal)(.Element("Average")),
                                                               SurveyFunctions.FormatElement(Of Decimal)(.Element("StdDev")),
                                                               SurveyFunctions.FormatElement(Of Decimal)(.Element("Min")),
                                                               SurveyFunctions.FormatElement(Of Decimal)(.Element("Max")),
                                                               BreakdownValues)

                            Return NewItem

                        End With

                    Else
                        Return Nothing
                    End If

                Catch ex As Exception
                    Return Nothing
                End Try

            End Function
        End Class
#End Region

#Region "SurveyStatisticBreakdown"
        Public Class SurveyStatisticBreakdownItem

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

#Region "Label"
            Protected _Label As String
            Public Property Label As String
                Get
                    Return _Label
                End Get
                Set(value As String)
                    _Label = value
                End Set
            End Property
#End Region

#Region "Type"
            Protected _Type As String
            Public Property Type As String
                Get
                    Return _Type
                End Get
                Set(value As String)
                    _Type = value
                End Set
            End Property
#End Region

#Region "Percentage"
            Protected _Percentage As Decimal
            Public Property Percentage As Decimal
                Get
                    Return _Percentage
                End Get
                Set(value As Decimal)
                    _Percentage = value
                End Set
            End Property
#End Region

#Region "Count"
            Protected _Count As Integer
            Public Property Count As Integer
                Get
                    Return _Count
                End Get
                Set(value As Integer)
                    _Count = value
                End Set
            End Property
#End Region

            Public Sub New(QuestionID As String, Label As String, Type As String, Percentage As Decimal, Count As Integer)
                _QuestionID = QuestionID
                _Label = Label
                _Type = Type
                _Percentage = Percentage
                _Count = Count
            End Sub

        End Class

#End Region

#Region "SurveyFilter"

        Public Enum SurveyFilterTypeEnum As Integer
            None = 0
            Status = 1
            DateBefore = 2
            DateAfter = 3
            CustomDataText = 4
            QuestionFilter = 5
            General = 6
        End Enum

        Public Class SurveyFilter

#Region "SurveyFilterType"
            Protected _SurveyFilterType As SurveyFilterTypeEnum
            Public Property SurveyFilterType As SurveyFilterTypeEnum
                Get
                    Return _SurveyFilterType
                End Get
                Set(value As SurveyFilterTypeEnum)
                    _SurveyFilterType = value
                End Set
            End Property
#End Region

#Region "Field"
            Protected _FieldValue As String
            Public Property FieldValue As String
                Get
                    Return _FieldValue
                End Get
                Set(value As String)
                    _FieldValue = value
                End Set
            End Property
#End Region

#Region "Operator"
            Protected _OperatorValue As String
            Public Property OperatorValue As String
                Get
                    Return _OperatorValue
                End Get
                Set(value As String)
                    _OperatorValue = value
                End Set
            End Property
#End Region

#Region "FilterValue"
            Protected _FilterValue As String
            Public Property FilterValue As String
                Get
                    Return _FilterValue
                End Get
                Set(value As String)
                    _FilterValue = value
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

#Region "QuestionOptionID"
            Protected _QuestionOptionID As String
            Public Property QuestionOptionID As String
                Get
                    Return _QuestionOptionID
                End Get
                Set(value As String)
                    _QuestionOptionID = value
                End Set
            End Property
#End Region

#Region "QuestionOptionTitle"
            Protected _QuestionOptionTitle As String
            Public Property QuestionOptionTitle As String
                Get
                    Return _QuestionOptionTitle
                End Get
                Set(value As String)
                    _QuestionOptionTitle = value
                End Set
            End Property
#End Region

#Region "QuestionIndex"
            Protected _QuestionIndex As Integer
            Public Property QuestionIndex As Integer
                Get
                    Return _QuestionIndex
                End Get
                Set(value As Integer)
                    _QuestionIndex = value
                End Set
            End Property
#End Region

#Region "Active"
            Protected _Active As Boolean
            Public Property Active As Boolean
                Get
                    Return _Active
                End Get
                Set(value As Boolean)
                    _Active = value
                End Set
            End Property
#End Region

            Public Sub New(SurveyFilterType As SurveyFilterTypeEnum, FieldValue As String, OperatorValue As String, FilterValue As String, Optional Active As Boolean = True)
                _SurveyFilterType = SurveyFilterType
                _FieldValue = FieldValue
                _OperatorValue = OperatorValue
                _FilterValue = FilterValue
                _Active = Active
            End Sub

            Public Sub New(SurveyFilterType As SurveyFilterTypeEnum, FieldValue As String, OperatorValue As String, FilterValue As String, QuestionTitle As String, QuestionOptionID As String, QuestionOptionTitle As String, QuestionIndex As Integer, Optional Active As Boolean = True)
                _SurveyFilterType = SurveyFilterType
                _FieldValue = FieldValue
                _OperatorValue = OperatorValue
                _FilterValue = FilterValue
                _QuestionTitle = QuestionTitle
                _QuestionOptionID = QuestionOptionID
                _QuestionOptionTitle = QuestionOptionTitle
                _QuestionIndex = QuestionIndex
                _Active = Active
            End Sub

            Public Sub SetActive(IsActive As Boolean)
                _Active = IsActive
            End Sub

        End Class

#End Region

    End Class
End Namespace