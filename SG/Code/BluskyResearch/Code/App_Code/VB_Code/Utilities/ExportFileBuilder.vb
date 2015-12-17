Imports Microsoft.VisualBasic
Imports System.Data
Imports System.IO
Imports System.Xml
Imports System.Web.UI.WebControls
Imports System.Diagnostics
Imports System.Data.OleDb
Imports System.Linq
Imports System.Data.Linq
Imports System.Drawing
Imports iTextSharp.text
Imports iTextSharp.text.pdf
Imports PingLibrary
Imports PingSurveys.SurveyLibrary
Imports PingCore.MySystem
Imports PingCore.MyData
Imports PingUtilities
Imports PingSurveys
Imports Ionic.Zip

Namespace PingUtilities

    Public Class ExportFileBuilder

        Const RootFolderPath As String = "/App_Data/Exports/"

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

#Region "File Handing"
        Public Shared Sub ClearOldFiles(FileLocation As String)
            Try
                Dim ExportFileDirectory As DirectoryInfo = New DirectoryInfo(HttpContext.Current.Server.MapPath("~" & FileLocation))

                For Each fi As FileInfo In ExportFileDirectory.GetFiles()
                    fi.Delete()
                Next
            Catch ex As Exception
            End Try
        End Sub

        Private Const BUFFER_SIZE As Long = 4096

        Public Shared Sub ZipFiles(ZipFileName As String, FileLocation As String)
            Try
                Dim ExportFileDirectory As String = HttpContext.Current.Server.MapPath("~" & FileLocation)
                Dim fqFilenames As New List(Of String)(System.IO.Directory.GetFiles(ExportFileDirectory))
                Dim filenames As List(Of String) = fqFilenames.ConvertAll(Function(s) s.Replace(ExportFileDirectory & "\", ""))

                Dim filesToInclude As New System.Collections.Generic.List(Of String)()

                For Each filename As String In filenames
                    filesToInclude.Add(System.IO.Path.Combine(ExportFileDirectory, filename))
                Next

                HttpContext.Current.Response.Clear()
                HttpContext.Current.Response.BufferOutput = False

                Dim enc As Ionic.Zip.EncryptionAlgorithm = Ionic.Zip.EncryptionAlgorithm.None

                Dim archiveName As String = ZipFileName.Replace(".csv", "") & ".zip"
                HttpContext.Current.Response.ContentType = "application/zip"
                HttpContext.Current.Response.AddHeader("Content-Disposition", "inline; filename=" & Chr(34) & archiveName & Chr(34))

                Using zip As New ZipFile()
                    zip.AddFiles(filesToInclude, "export")
                    zip.Save(HttpContext.Current.Response.OutputStream)
                End Using

                HttpContext.Current.Response.Close()

            Catch ex As Exception
            End Try
        End Sub

#End Region

#Region "Survey Export"
        Public Shared Function BuildSurveyExport(CurrentSurvey As Survey, SingleFile As Boolean) As KeyValuePair(Of Boolean, String)

            '# Create data set of tables containg the results of data is it appears in the survey results list (with filtering)
            '# Then save the data into a CSV & zip file(s)  - depending on the settings
            '# Show download link

            Dim ReturnResponse As New KeyValuePair(Of Boolean, String)(False, "New")

            Try
                If CurrentSurvey IsNot Nothing Then

                    '#########################
                    '# 1 - Get data
                    '#########################
                    Dim ResultsData = New DataSet()

                    '# Get max amount of response columns
                    Dim ResponseColumnCount As Integer = 2

                    Dim QuestionNumber As Integer = 1
                    For Each sq As SurveyQuestion In CurrentSurvey.Questions

                        Dim NumberQuestion As Boolean = IsNumberQuestion(QuestionNumber, CurrentSurvey.ID, sq)

                        Dim SubType As String = sq.SubType
                        If NumberQuestion Then SubType = "number"

                        '# Only for certain questions
                        If SubType = "rank" Then
                            If sq.Statistics IsNot Nothing Then
                                If CInt(sq.Statistics.Max()) > ResponseColumnCount Then
                                    ResponseColumnCount = CInt(sq.Statistics.Max())
                                End If
                            End If
                        ElseIf SubType = "table" Then
                            For Each sub_sq As SurveyQuestion In sq.SubQuestions
                                If sub_sq.Statistics IsNot Nothing Then
                                    If sub_sq.Options.Count() > ResponseColumnCount Then
                                        ResponseColumnCount = sub_sq.Options.Count()
                                    End If
                                End If
                            Next
                        ElseIf SubType = "multi_textbox" Then
                            If sq.Options IsNot Nothing Then
                                If CInt(sq.Options.Count()) > ResponseColumnCount Then
                                    ResponseColumnCount = CInt(sq.Options.Count())
                                End If
                            End If
                        End If

                        QuestionNumber += 1
                    Next

                    '# Get basic information
                    Dim BasicInformationTable As New DataTable("BasicInformationTable")

                    BasicInformationTable.Columns.Add("Question No.", GetType(String))
                    BasicInformationTable.Columns.Add("Title", GetType(String))

                    For i As Integer = 1 To ResponseColumnCount
                        BasicInformationTable.Columns.Add("Response" & i.ToString(), GetType(String))
                    Next

                    Dim BasicInformationRow As DataRow = BasicInformationTable.NewRow()

                    '# Set Totals
                    Dim TotalResponses As Integer = 0
                    Dim FilteredResponses As Integer = 0
                    Dim ExcludedResponses As Integer = 0

                    TotalResponses = CurrentSurveyControl.CurrentSurvey.AllResponses.Count()

                    'If TotalResponses <= 0 Then
                    '    For Each stat As KeyValuePair(Of String, String) In CurrentSurveyControl.UnfilteredSurvey.Statistics
                    '        If stat.Value = "Complete" Then
                    '            Int32.TryParse(stat.Value, TotalResponses)
                    '        End If
                    '    Next
                    'End If

                    '# Check for default
                    If CurrentSurveyControl.SurveyFilters.Count = 1 AndAlso CurrentSurveyControl.SurveyFilters(0).SurveyFilterType = SurveyFilterTypeEnum.Status AndAlso CurrentSurveyControl.SurveyFilters(0).FilterValue = "Deleted" Then
                        FilteredResponses = 0
                        ExcludedResponses = 0
                    Else
                        FilteredResponses = CurrentSurvey.Responses.Count()
                        ExcludedResponses = TotalResponses - FilteredResponses
                    End If

                    '# Created Time/Date
                    AddRowToTable(BasicInformationTable, "", "Created Time/Date:", FormatDate(CurrentSurvey.CreatedOn))

                    '# Modified Time/Date
                    AddRowToTable(BasicInformationTable, "", "Modified Time/Date:", FormatDate(CurrentSurvey.ModifiedOn))

                    '# Total Responses
                    AddRowToTable(BasicInformationTable, "", "Total Responses", TotalResponses.ToString())

                    '# Filtered Responses
                    AddRowToTable(BasicInformationTable, "", "Filtered Responses", FilteredResponses.ToString())

                    '# Responses Excluded
                    AddRowToTable(BasicInformationTable, "", "Responses Excluded", ExcludedResponses.ToString())

                    '# Survey Name
                    AddRowToTable(BasicInformationTable, "", "Survey Name", CurrentSurvey.Title)

                    '# Spacer
                    AddSpacerRowToTable(BasicInformationTable, ResponseColumnCount)

                    ResultsData.Tables.Add(BasicInformationTable)

                    '#########################
                    '# Get fiter information                     
                    '#########################
                    Dim FilterInformationTable As DataTable = GetFilterData(ResponseColumnCount)
                    If FilterInformationTable IsNot Nothing Then ResultsData.Tables.Add(FilterInformationTable)

                    '# Get question/response information
                    Dim QuestionResponsesTable As New DataTable("QuestionResponsesTable")
                    Dim QuestionResponsesRow As DataRow = QuestionResponsesTable.NewRow()

                    QuestionResponsesTable.Columns.Add("Question No.", GetType(String))
                    QuestionResponsesTable.Columns.Add("Title", GetType(String))

                    For i As Integer = 1 To ResponseColumnCount
                        QuestionResponsesTable.Columns.Add("Response" & i.ToString(), GetType(String))
                    Next

                    Dim QuestionCount As Integer = 1
                    For Each sq As SurveyQuestion In CurrentSurvey.Questions
                        If sq.Type = "SurveyQuestion" Then
                            '# Add question row
                            AddRowToTable(QuestionResponsesTable, QuestionCount.ToString(), sq.Title, "")

                            '# Get results
                            GetQuestionData(QuestionResponsesTable, CurrentSurvey, sq, ResponseColumnCount, QuestionCount)

                            '# Spacer
                            AddSpacerRowToTable(QuestionResponsesTable, ResponseColumnCount)

                            QuestionCount += 1
                        End If
                    Next

                    ResultsData.Tables.Add(QuestionResponsesTable)

                    '#########################
                    '# 2 - Save into file(s)
                    '#########################

                    '# Set file paths
                    Dim FinalFilePath As String = RootFolderPath & CurrentSurvey.ID.ToString() & "/"
                    Dim FileName As String = "results_" & Now.Year.ToString() & "_" & Now.Month.ToString() & "_" & Now.Day.ToString() & ".csv"

                    '# Check the folder exists- create folder if it doesn't
                    CheckFolderExists(FinalFilePath)

                    '# Remove old files
                    ClearOldFiles(FinalFilePath)

                    '# Generate complete CSV
                    Dim CSVLocation As String = ""
                    Try
                        Dim CSVBuilder As CSVBuilder = New CSVBuilder()
                        Dim FullPath As String = HttpContext.Current.Server.MapPath("~" & FinalFilePath)

                        CSVLocation = CSVBuilder.ConvertFromDataSet(ResultsData, FullPath, FileName)
                    Catch ex As Exception
                    End Try

                    '# Generate question CSV files - if required
                    If Not SingleFile Then
                        Dim MultiQuestionCount As Integer = 1
                        For Each sq As SurveyQuestion In CurrentSurvey.Questions
                            If sq.Type = "SurveyQuestion" Then

                                Try
                                    Dim MultiQuestionResponsesData As DataSet = ExportQuestionResponses(CurrentSurvey, sq, ResponseColumnCount, MultiQuestionCount)
                                    Dim CSVBuilder As CSVBuilder = New CSVBuilder()
                                    Dim FullPath As String = HttpContext.Current.Server.MapPath("~" & FinalFilePath)

                                    CSVBuilder.ConvertFromDataSet(MultiQuestionResponsesData, FullPath, "q_" & MultiQuestionCount.ToString() & ".csv")
                                Catch ex As Exception
                                End Try

                                MultiQuestionCount += 1
                            End If
                        Next
                    End If

                    '# Build Zip file
                    ZipFiles(FileName, FinalFilePath)

                    '# Open File
                    'HttpContext.Current.Response.ContentType = "text/csv"
                    'HttpContext.Current.Response.AddHeader("content-disposition", "attachment; filename=" & FileName)
                    'HttpContext.Current.Response.WriteFile(CSVLocation)
                    'HttpContext.Current.Response.End()

                Else
                    ReturnResponse = New KeyValuePair(Of Boolean, String)(False, "Problem creating export files - Current survey information is missing")
                End If

            Catch ex As Exception
                ReturnResponse = New KeyValuePair(Of Boolean, String)(False, "Problem creating export files - " & ex.Message)
            End Try

            '#########################
            '# 3 - Show return
            '#########################
            Return ReturnResponse

        End Function
#End Region

#Region "Questions"
        Public Shared Sub GetQuestionData(ByRef CurrentDataTable As DataTable, CurrentSurvey As Survey, CurrentSurveyQuestion As SurveyQuestion, ResponseColumnCount As Integer, QuestionNumber As Integer)

            If CurrentSurveyQuestion IsNot Nothing Then

                Dim sq As SurveyQuestion = CurrentSurveyQuestion
                Dim CurrentSurveyQuestionID As Integer = CInt(sq.ID)
                Dim Count As Integer = 0
                Dim TotalResponses As Integer = 0
                Dim TotalClicks As Integer = 0
                Dim NotAnswered As Integer = 0

                For Each ri As SurveyResponse In CurrentSurvey.Responses
                    Dim ResultList = (From dr In ri.ResponseQuestions Where dr.QuestionID = sq.ID AndAlso Not String.IsNullOrEmpty(dr.AnswerValue) Select dr).ToList()

                    If ResultList.Count > 0 Then
                        TotalResponses += 1
                        TotalClicks += ResultList.Count()
                    End If

                    Dim NotAnsweredResultList = (From dr In ri.ResponseQuestions Where dr.QuestionID = sq.ID AndAlso String.IsNullOrEmpty(dr.AnswerValue) Select dr).ToList()

                    If NotAnsweredResultList.Count > 0 Then
                        NotAnswered += 1
                    End If
                Next

                Dim NumberQuestion As Boolean = IsNumberQuestion(QuestionNumber, CurrentSurvey.ID, sq)

                Dim SubType As String = sq.SubType
                If NumberQuestion Then SubType = "number"

                Select Case SubType
                    Case "table"

                        '# Load options
                        Dim OptionList As New List(Of String)
                        For Each so As SurveyOption In sq.Options
                            OptionList.Add(so.Title)
                        Next

                        AddRowToTable(CurrentDataTable, "", "", ResponseColumnCount, OptionList)

                        '# Load Questions & Responses
                        Dim PercentageList As New List(Of String)
                        Dim ValueList As New List(Of String)
                        For Each sub_sq As SurveyQuestion In sq.SubQuestions

                            '# Clear values
                            PercentageList.Clear()
                            ValueList.Clear()

                            '# Calc temp total
                            For Each ri As SurveyResponse In CurrentSurvey.Responses
                                Dim ResultList = (From dr In ri.ResponseQuestions Where dr.QuestionID = sub_sq.ID AndAlso Not String.IsNullOrEmpty(dr.AnswerValue) Select dr).ToList()

                                If ResultList.Count > 0 Then
                                    TotalResponses += 1
                                    TotalClicks += ResultList.Count()
                                End If

                                Dim NotAnsweredResultList = (From dr In ri.ResponseQuestions Where dr.QuestionID = sub_sq.ID AndAlso String.IsNullOrEmpty(dr.AnswerValue) Select dr).ToList()

                                If NotAnsweredResultList.Count > 0 Then
                                    NotAnswered += 1
                                End If
                            Next

                            '# Get responses
                            If sub_sq IsNot Nothing Then

                                For Each sub_so As SurveyOption In sub_sq.Options

                                    Count = 0

                                    '# Survey responses
                                    Dim ResponseItems As List(Of SurveyResponse) = CurrentSurvey.Responses
                                    Dim QuestionsResponses As New List(Of SurveyResponseQuestion)
                                    For Each ri As SurveyResponse In ResponseItems

                                        Dim rqList = (From dr In ri.ResponseQuestions Where dr.QuestionID = sub_so.QuestionID AndAlso dr.AnswerValue = sub_so.Value Select dr).ToList()

                                        If rqList.Count() <= 0 AndAlso sub_so.Value.ToLower.Contains("other") Then

                                            Dim rqListID = (From dr In ri.ResponseQuestions Where dr.QuestionID = sub_so.QuestionID AndAlso dr.AnswerValue.ToLower.Contains("other") AndAlso dr.OptionID = sub_so.ID Select dr).ToList()

                                            Count += rqListID.Count()
                                            For Each rq As SurveyResponseQuestion In ri.ResponseQuestions
                                                If rq.OptionID = sub_so.ID Then
                                                    QuestionsResponses.Add(rq)
                                                End If
                                            Next
                                        End If

                                        Count += rqList.Count()
                                    Next

                                    Dim Percentage As Decimal = 0
                                    If TotalResponses > 0 Then Percentage = Math.Round(((100 / TotalResponses) * Count), 0)

                                    PercentageList.Add(Percentage.ToString() & "%")
                                    ValueList.Add(Count.ToString())

                                Next

                            End If

                            AddRowToTable(CurrentDataTable, "", sub_sq.Title, ResponseColumnCount, PercentageList)
                            AddRowToTable(CurrentDataTable, "", "", ResponseColumnCount, ValueList)
                        Next

                    Case "radio", "checkbox", "menu"
                        AddRowToTable(CurrentDataTable, "", "", "Responses", "Percent")

                        '# Get options/response
                        For Each so As SurveyOption In sq.Options
                            Count = 0

                            '# Survey responses
                            Dim ResponseItems As List(Of SurveyResponse) = CurrentSurvey.Responses
                            Dim QuestionsResponses As New List(Of SurveyResponseQuestion)
                            For Each ri As SurveyResponse In ResponseItems

                                Dim rqList = (From dr In ri.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.AnswerValue = so.Value Select dr).ToList()

                                If rqList.Count() <= 0 AndAlso so.Value.ToLower.Contains("other") Then

                                    Dim rqListID = (From dr In ri.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.AnswerValue.ToLower.Contains("other") AndAlso dr.OptionID = so.ID Select dr).ToList()

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
                            If TotalResponses > 0 Then Percentage = Math.Round(((100 / TotalResponses) * Count), 1)

                            AddRowToTable(CurrentDataTable, "", so.Title, Count.ToString(), Percentage.ToString() & "%")
                        Next

                        '# Spacer
                        AddSpacerRowToTable(CurrentDataTable, ResponseColumnCount)

                        '# Totals
                        AddRowToTable(CurrentDataTable, "", "Total Clicks:", TotalClicks.ToString())
                        AddRowToTable(CurrentDataTable, "", "Total Responses:", TotalResponses.ToString())

                    Case "rank"

                        '# Load options
                        Dim OptionList As New List(Of String)
                        For i As Integer = 1 To CInt(sq.Statistics.Max())
                            OptionList.Add(i.ToString())
                        Next

                        AddRowToTable(CurrentDataTable, "", "", ResponseColumnCount, OptionList)

                        '# Load Responses
                        Dim PercentageList As New List(Of String)
                        Dim ValueList As New List(Of String)
                        For Each so As SurveyOption In sq.Options

                            '# Clear values
                            PercentageList.Clear()
                            ValueList.Clear()

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
                            If FilteredQuestionsResponses IsNot Nothing AndAlso FilteredQuestionsResponses.Count() > 0 Then
                                For i As Integer = 1 To CInt(CurrentSurveyQuestion.Statistics.Max)

                                    Dim ItemsRanked As Integer = (From dr In FilteredQuestionsResponses Where dr.AnswerValue = i.ToString() Select dr).Count()
                                    Dim ItemPercentage As Decimal = Math.Round(((100 / FilteredQuestionsResponses.Count()) * ItemsRanked), 0)

                                    PercentageList.Add(ItemPercentage.ToString() & "%")
                                    ValueList.Add(ItemsRanked)
                                Next
                            End If

                            AddRowToTable(CurrentDataTable, "", so.Title, ResponseColumnCount, PercentageList)
                            AddRowToTable(CurrentDataTable, "", "", ResponseColumnCount, ValueList)
                        Next

                    Case "multi_textbox"

                        '# Load options
                        Dim OptionList As New List(Of String)
                        For Each so As SurveyOption In sq.Options()
                            OptionList.Add(so.Value)
                        Next

                        AddRowToTable(CurrentDataTable, "", "", ResponseColumnCount, OptionList)

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

                        '# Filter out the responses
                        Dim FilteredQuestionsResponses = (From dr In QuestionsResponses Where String.IsNullOrEmpty(dr.Value.AnswerValue) = False Select New PDFBuilder.MultiTextBoxGroup(dr.Value.QuestionID, CurrentSurveyQuestion.Title, dr.Key)).Distinct.ToList()
                        Dim FilteredQuestionsResponsesDistinct As New List(Of PDFBuilder.MultiTextBoxGroup)

                        For Each mtg In FilteredQuestionsResponses
                            Dim FilterRecordMatch As PDFBuilder.MultiTextBoxGroup = (From dr In FilteredQuestionsResponsesDistinct Where dr.QuestionID = mtg.QuestionID AndAlso dr.CurrentResponseID = mtg.CurrentResponseID Select dr).FirstOrDefault()
                            If FilterRecordMatch Is Nothing Then FilteredQuestionsResponsesDistinct.Add(mtg)
                        Next

                        '# Now get each question within the response question
                        For Each mtg In FilteredQuestionsResponsesDistinct
                            Dim MultiTextBoxAnswers = (From dr In QuestionsResponses Where dr.Key = mtg.CurrentResponseID AndAlso dr.Value.QuestionID = mtg.QuestionID Order By dr.Value.OptionID Select New PDFBuilder.MultiTextBoxValue(dr.Value.OptionID, GetOptionTitle(sq.Options, dr.Value.OptionID), dr.Value.AnswerValue)).ToList()
                            mtg.SetAnswerValues(MultiTextBoxAnswers)
                        Next

                        For Each mtbg As PDFBuilder.MultiTextBoxGroup In FilteredQuestionsResponsesDistinct

                            Dim MultiTextBoxValueList As New List(Of String)
                            For Each mtbv As PDFBuilder.MultiTextBoxValue In mtbg.AnswerValues
                                If CurrentSurvey.CanViewQuestionDetails(QuestionNumber) Then
                                    MultiTextBoxValueList.Add(mtbv.AnswerValue)
                                Else
                                    MultiTextBoxValueList.Add("")
                                End If
                            Next
                            AddRowToTable(CurrentDataTable, "", "", ResponseColumnCount, MultiTextBoxValueList)
                        Next

                    Case Else

                        Dim QuestionsResponses As New List(Of KeyValuePair(Of Integer, SurveyResponseQuestion))
                        For Each ri As SurveyResponse In CurrentSurvey.Responses
                            For Each rq As SurveyResponseQuestion In ri.ResponseQuestions
                                If rq.QuestionID = sq.ID AndAlso Not String.IsNullOrEmpty(rq.AnswerValue) Then
                                    Dim Result As New KeyValuePair(Of Integer, SurveyResponseQuestion)(ri.ResponseID, rq)
                                    QuestionsResponses.Add(Result)
                                End If
                            Next
                        Next

                        If QuestionsResponses IsNot Nothing AndAlso QuestionsResponses.Count > 0 Then

                            '# Filter to ones with answers
                            Dim FilteredQuestionsResponses = (From dr In QuestionsResponses Where String.IsNullOrEmpty(dr.Value.AnswerValue) = False Select dr.Value.QuestionID, CurrentSurveyQuestion.Title, dr.Value.AnswerValue, dr.Key).ToList()

                            '# Not Answered count
                            Dim QuestionsResponsesUnanswered = (From dr In QuestionsResponses Where String.IsNullOrEmpty(dr.Value.AnswerValue) = True Select dr.Value.QuestionID).Count()

                            '# Totals
                            AddRowToTable(CurrentDataTable, "", "Total Responses:", FilteredQuestionsResponses.Count())
                            AddRowToTable(CurrentDataTable, "", "Not answered:", QuestionsResponsesUnanswered)

                            If CurrentSurvey.CanViewQuestionDetails(QuestionNumber) Then

                                '# Spacer
                                AddSpacerRowToTable(CurrentDataTable, ResponseColumnCount)
                                AddRowToTable(CurrentDataTable, "", "----------------------", "")

                                '# Responses
                                For Each fi In FilteredQuestionsResponses
                                    AddRowToTable(CurrentDataTable, "", fi.Key, fi.AnswerValue)
                                Next

                            End If
                        Else
                            AddRowToTable(CurrentDataTable, "", "No results", "")
                        End If

                End Select

            End If

        End Sub

        Public Shared Function ExportQuestionResponses(CurrentSurvey As Survey, CurrentSurveyQuestion As SurveyQuestion, ResponseColumnCount As Integer, QuestionCount As Integer) As DataSet

            Dim ResultsData = New DataSet()

            '##################################################
            '# Get fiter information - if set to show
            '##################################################
            Dim FilterInformationTable As DataTable = GetFilterData(ResponseColumnCount)
            If FilterInformationTable IsNot Nothing Then ResultsData.Tables.Add(FilterInformationTable)

            '# Get question/response information
            Dim QuestionResponsesTable As New DataTable("QuestionResponsesTable")
            Dim QuestionResponsesRow As DataRow = QuestionResponsesTable.NewRow()

            QuestionResponsesTable.Columns.Add("Question No.", GetType(String))
            QuestionResponsesTable.Columns.Add("Title", GetType(String))

            For i As Integer = 1 To ResponseColumnCount
                QuestionResponsesTable.Columns.Add("Response" & i.ToString(), GetType(String))
            Next

            '# Add question row
            AddRowToTable(QuestionResponsesTable, QuestionCount.ToString(), CurrentSurveyQuestion.Title, "")

            '# Get results
            GetQuestionData(QuestionResponsesTable, CurrentSurvey, CurrentSurveyQuestion, ResponseColumnCount, QuestionCount)

            '# Spacer
            AddSpacerRowToTable(QuestionResponsesTable, ResponseColumnCount)

            QuestionCount += 1

            ResultsData.Tables.Add(QuestionResponsesTable)

            Return ResultsData

        End Function
#End Region

#Region "Responses Export"
        Public Shared Function BuildResponsesExport(CurrentSurvey As Survey) As KeyValuePair(Of Boolean, String)

            '# Create data set of tables containg the results of data is it appears in the survey results list (with filtering)
            '# Then save the data into a CSV & zip file(s)  - depending on the settings
            '# Show download link

            Dim ReturnResponse As New KeyValuePair(Of Boolean, String)(False, "New")

            Try
                If CurrentSurvey IsNot Nothing Then

                    '#########################
                    '# 1 - Get data
                    '#########################
                    Dim ResultsData = New DataSet()

                    '# Get amount of response columns => amount of questions + response ID/Status/Date Completed
                    Dim ResponseColumnCount As Integer = CurrentSurvey.Questions.Count() + 3

                    '# Table for data
                    Dim ResponseInformationTable As New DataTable("ResponseInformationTable")
                    Dim ResponseHeadersRow As DataRow = ResponseInformationTable.NewRow()

                    ResponseInformationTable.Columns.Add("Response ID", GetType(String))
                    ResponseHeadersRow(0) = "Response ID"
                    ResponseInformationTable.Columns.Add("Status", GetType(String))
                    ResponseHeadersRow(1) = "Status"
                    ResponseInformationTable.Columns.Add("Completed Date", GetType(String))
                    ResponseHeadersRow(2) = "Completed Date"

                    Dim Count As Integer = 1
                    Dim QuestionNumber As Integer = 1
                    For Each sq As SurveyQuestion In CurrentSurvey.Questions
                        If sq.Type = "SurveyQuestion" Then

                            Dim NumberQuestion As Boolean = IsNumberQuestion(QuestionNumber, CurrentSurvey.ID, sq)

                            Dim SubType As String = sq.SubType
                            If NumberQuestion Then SubType = "number"

                            Select Case SubType
                                Case "table"
                                    For Each subq As SurveyQuestion In sq.SubQuestions
                                        ResponseInformationTable.Columns.Add(Count.ToString() & ". " & GlobalMethods.StripHTML(subq.Title), GetType(String))
                                        ResponseHeadersRow(Count + 2) = Count.ToString() & ". " & GlobalMethods.StripHTML(subq.Title)
                                        Count += 1
                                    Next
                                Case "checkbox"

                                    For Each so As SurveyOption In sq.Options
                                        ResponseInformationTable.Columns.Add(Count.ToString() & ". " & GlobalMethods.StripHTML(sq.Title) & " - " & GlobalMethods.StripHTML(so.Title), GetType(String))
                                        ResponseHeadersRow(Count + 2) = Count.ToString() & ". " & GlobalMethods.StripHTML(sq.Title) & " - " & GlobalMethods.StripHTML(so.Title)
                                        Count += 1
                                    Next

                                Case "radio", "menu", "rank"
                                    ResponseInformationTable.Columns.Add(Count.ToString() & ". " & GlobalMethods.StripHTML(sq.Title), GetType(String))
                                    ResponseHeadersRow(Count + 2) = Count.ToString() & ". " & GlobalMethods.StripHTML(sq.Title)
                                    Count += 1

                                Case "multi_textbox"
                                    For Each so As SurveyOption In sq.Options
                                        ResponseInformationTable.Columns.Add(Count.ToString() & ". " & GlobalMethods.StripHTML(sq.Title) & " " & GlobalMethods.StripHTML(so.Value), GetType(String))
                                        ResponseHeadersRow(Count + 2) = Count.ToString() & ". " & GlobalMethods.StripHTML(sq.Title) & " " & GlobalMethods.StripHTML(so.Value)
                                        Count += 1
                                    Next

                                Case Else
                                    ResponseInformationTable.Columns.Add(Count.ToString() & ". " & GlobalMethods.StripHTML(sq.Title), GetType(String))
                                    ResponseHeadersRow(Count + 2) = Count.ToString() & ". " & GlobalMethods.StripHTML(sq.Title)
                                    Count += 1
                            End Select

                        End If

                        QuestionNumber += 1
                    Next

                    ResponseInformationTable.Rows.Add(ResponseHeadersRow)

                    '# Add rows of data to the table
                    For Each sr As SurveyResponse In CurrentSurvey.Responses
                        With sr
                            Dim CurrentDataRow As DataRow = ResponseInformationTable.NewRow()

                            '# Response Data
                            CurrentDataRow("Response ID") = sr.ResponseID
                            CurrentDataRow("Status") = GlobalMethods.StripHTML(sr.Status)
                            CurrentDataRow("Completed Date") = FormatDateSimple(sr.DateSubmitted)

                            '# Questions
                            Dim QuestionCount As Integer = 1
                            Dim QuestionNumberCount As Integer = 1
                            For Each sq As SurveyQuestion In CurrentSurvey.Questions
                                If sq.Type = "SurveyQuestion" Then

                                    Dim RowColumnName As String = ""
                                    Dim AnswerValue As String = ""
                                    Dim MatchingResponseQuestion As SurveyResponseQuestion = Nothing

                                    Dim NumberQuestion As Boolean = IsNumberQuestion(QuestionNumber, CurrentSurvey.ID, sq)

                                    Dim SubType As String = sq.SubType
                                    If NumberQuestion Then SubType = "number"

                                    Select Case SubType
                                        Case "table"
                                            For Each subq As SurveyQuestion In sq.SubQuestions

                                                RowColumnName = QuestionCount.ToString() & ". " & GlobalMethods.StripHTML(subq.Title)

                                                MatchingResponseQuestion = (From dr In sr.ResponseQuestions Where dr.QuestionID = subq.ID AndAlso Not String.IsNullOrEmpty(dr.AnswerValue) Select dr).FirstOrDefault()
                                                If MatchingResponseQuestion IsNot Nothing Then AnswerValue = MatchingResponseQuestion.AnswerValue

                                                '# Add data                                                
                                                AddDataToRow(CurrentDataRow, RowColumnName, AnswerValue)
                                                QuestionCount += 1
                                                AnswerValue = ""

                                            Next
                                        Case "checkbox"

                                            For Each so As SurveyOption In sq.Options

                                                RowColumnName = QuestionCount.ToString() & ". " & GlobalMethods.StripHTML(sq.Title) & " - " & GlobalMethods.StripHTML(so.Title)

                                                MatchingResponseQuestion = (From dr In sr.ResponseQuestions Where dr.QuestionID = sq.ID AndAlso dr.OptionID = so.ID Select dr).FirstOrDefault()
                                                If MatchingResponseQuestion IsNot Nothing Then AnswerValue = MatchingResponseQuestion.AnswerValue

                                                '# Add data
                                                If Not CurrentSurvey.CanViewQuestionDetails(QuestionNumberCount - 1) AndAlso AnswerValue.ToLower().Contains("other") Then
                                                    AddDataToRow(CurrentDataRow, RowColumnName, "")
                                                Else
                                                    AddDataToRow(CurrentDataRow, RowColumnName, AnswerValue)
                                                End If

                                                QuestionCount += 1

                                                AnswerValue = ""

                                            Next

                                        Case "radio", "menu", "rank"

                                            RowColumnName = QuestionCount.ToString() & ". " & GlobalMethods.StripHTML(sq.Title)

                                            MatchingResponseQuestion = (From dr In sr.ResponseQuestions Where dr.QuestionID = sq.ID AndAlso Not String.IsNullOrEmpty(dr.AnswerValue) Select dr).FirstOrDefault()
                                            If MatchingResponseQuestion IsNot Nothing Then AnswerValue = MatchingResponseQuestion.AnswerValue

                                            '# Add data
                                            If Not CurrentSurvey.CanViewQuestionDetails(QuestionNumberCount - 1) AndAlso AnswerValue.ToLower().Contains("other") Then
                                                AddDataToRow(CurrentDataRow, RowColumnName, "")
                                            Else
                                                AddDataToRow(CurrentDataRow, RowColumnName, AnswerValue)
                                            End If

                                            QuestionCount += 1
                                            AnswerValue = ""

                                        Case "multi_textbox"

                                            For Each so As SurveyOption In sq.Options

                                                RowColumnName = QuestionCount.ToString() & ". " & GlobalMethods.StripHTML(sq.Title) & " " & GlobalMethods.StripHTML(so.Value)

                                                MatchingResponseQuestion = (From dr In sr.ResponseQuestions Where dr.QuestionID = sq.ID AndAlso dr.OptionID = so.ID Select dr).FirstOrDefault()

                                                AnswerValue = MatchingResponseQuestion.AnswerValue

                                                '# Add data
                                                If CurrentSurvey.CanViewQuestionDetails(QuestionNumberCount - 1) Then
                                                    AddDataToRow(CurrentDataRow, RowColumnName, AnswerValue)
                                                Else
                                                    AddDataToRow(CurrentDataRow, RowColumnName, "")
                                                End If
                                                QuestionCount += 1
                                                AnswerValue = ""

                                            Next

                                        Case Else

                                            RowColumnName = QuestionCount.ToString() & ". " & GlobalMethods.StripHTML(sq.Title)

                                            MatchingResponseQuestion = (From dr In sr.ResponseQuestions Where dr.QuestionID = sq.ID Select dr).FirstOrDefault()
                                            If MatchingResponseQuestion IsNot Nothing Then AnswerValue = MatchingResponseQuestion.AnswerValue

                                            '# Add data
                                            If CurrentSurvey.CanViewQuestionDetails(QuestionNumberCount - 1) Then
                                                AddDataToRow(CurrentDataRow, RowColumnName, AnswerValue)
                                            Else
                                                AddDataToRow(CurrentDataRow, RowColumnName, "")
                                            End If
                                            QuestionCount += 1
                                            AnswerValue = ""

                                    End Select

                                End If

                                QuestionNumberCount += 1
                            Next

                            ResponseInformationTable.Rows.Add(CurrentDataRow)
                        End With
                    Next

                    ResultsData.Tables.Add(ResponseInformationTable)

                    '#########################
                    '# 2 - Save into file(s)
                    '#########################

                    '# Set file paths
                    Dim FinalFilePath As String = RootFolderPath & CurrentSurvey.ID.ToString() & "/"
                    Dim FileName As String = "responses_" & Now.Year.ToString() & "_" & Now.Month.ToString() & "_" & Now.Day.ToString() & ".csv"

                    '# Check the folder exists- create folder if it doesn't
                    CheckFolderExists(FinalFilePath)

                    '# Remove old files
                    ClearOldFiles(FinalFilePath)

                    '# Generate complete CSV
                    Dim CSVLocation As String = ""
                    Try
                        Dim CSVBuilder As CSVBuilder = New CSVBuilder()
                        Dim FullPath As String = HttpContext.Current.Server.MapPath("~" & FinalFilePath)

                        CSVLocation = CSVBuilder.ConvertFromDataSet(ResultsData, FullPath, FileName)
                    Catch ex As Exception
                    End Try

                    '# Build Zip file
                    ZipFiles(FileName, FinalFilePath)

                Else
                    ReturnResponse = New KeyValuePair(Of Boolean, String)(False, "Problem creating export files - Current survey information is missing")
                End If

            Catch ex As Exception
                ReturnResponse = New KeyValuePair(Of Boolean, String)(False, "Problem creating export files - " & ex.Message)
            End Try

            '#########################
            '# 3 - Show return
            '#########################
            Return ReturnResponse

        End Function
#End Region

#Region "Filters"
        Public Shared Function GetFilterData(ResponseColumnCount As Integer) As DataTable

            If CurrentSurveyControl IsNot Nothing AndAlso CurrentSurveyControl.SurveyFilters IsNot Nothing AndAlso CurrentSurveyControl.SurveyFilters.Count > 0 Then

                Dim FilterInformationTable As New DataTable("FilterInformationTable")

                FilterInformationTable.Columns.Add("Question No.", GetType(String))
                FilterInformationTable.Columns.Add("Title", GetType(String))

                For i As Integer = 1 To ResponseColumnCount
                    FilterInformationTable.Columns.Add("Response" & i.ToString(), GetType(String))
                Next

                '# Add filter information
                AddRowToTable(FilterInformationTable, "", "Filters Applied", "")

                For Each sf As SurveyFilter In CurrentSurveyControl.SurveyFilters

                    Select Case sf.SurveyFilterType

                        Case SurveyFilterTypeEnum.Status
                            Select Case sf.FilterValue
                                Case "Complete"
                                    AddRowToTable(FilterInformationTable, "", "Status:", "Fully-Completed")
                                Case "Partial"
                                    AddRowToTable(FilterInformationTable, "", "Status:", "Part-Completed")
                                Case Else
                                    AddRowToTable(FilterInformationTable, "", "Status:", "Fully & Part-Completed")
                            End Select
                        Case SurveyFilterTypeEnum.DateBefore

                            '# Get values
                            Dim DateStr As String = sf.FilterValue.Replace("+", " ")
                            Dim RealDate As New Date

                            '# Check this is a valid date
                            Dim DateOK As Boolean = Date.TryParse(DateStr, RealDate)

                            If DateOK Then
                                AddRowToTable(FilterInformationTable, "", "Responses Before:", RealDate.ToString("dd/MM/yyyy HH:mm tt"))
                            End If

                        Case SurveyFilterTypeEnum.DateAfter

                            '# Get values
                            Dim DateStr As String = sf.FilterValue.Replace("+", " ")
                            Dim RealDate As New Date

                            '# Check this is a valid date
                            Dim DateOK As Boolean = Date.TryParse(DateStr, RealDate)

                            If DateOK Then
                                AddRowToTable(FilterInformationTable, "", "Responses After:", RealDate.ToString("dd/MM/yyyy HH:mm tt"))
                            End If

                        Case SurveyFilterTypeEnum.CustomDataText
                            AddRowToTable(FilterInformationTable, "", "Answers containing:", sf.FilterValue)
                        Case SurveyFilterTypeEnum.QuestionFilter
                            AddRowToTable(FilterInformationTable, "", "QuestionFilter:", "QUESTION " & sf.QuestionIndex.ToString() & ": " & sf.QuestionTitle & " -  ANSWER: " & sf.QuestionOptionTitle)
                    End Select
                Next

                '# Spacer
                AddSpacerRowToTable(FilterInformationTable, ResponseColumnCount)

                Return FilterInformationTable
            Else
                Return Nothing
            End If

        End Function
#End Region

#Region "Table Functions"
        Public Shared Sub AddRowToTable(ByRef CurrentDataTable As DataTable, ColumnOneValue As String, ColumnTwoValue As String, ColumnThreeValue As String)
            Dim CurrentDataRow As DataRow = CurrentDataTable.NewRow()
            CurrentDataRow("Question No.") = ColumnOneValue
            CurrentDataRow("Title") = GlobalMethods.StripHTML(ColumnTwoValue)
            CurrentDataRow("Response1") = ColumnThreeValue
            CurrentDataTable.Rows.Add(CurrentDataRow)
        End Sub

        Public Shared Sub AddRowToTable(ByRef CurrentDataTable As DataTable, ColumnOneValue As String, ColumnTwoValue As String, ColumnThreeValue As String, ColumnFourValue As String)
            Dim CurrentDataRow As DataRow = CurrentDataTable.NewRow()
            CurrentDataRow("Question No.") = ColumnOneValue
            CurrentDataRow("Title") = GlobalMethods.StripHTML(ColumnTwoValue)
            CurrentDataRow("Response1") = ColumnThreeValue
            CurrentDataRow("Response2") = ColumnFourValue
            CurrentDataTable.Rows.Add(CurrentDataRow)
        End Sub

        Public Shared Sub AddRowToTable(ByRef CurrentDataTable As DataTable, ColumnOneValue As String, ColumnTwoValue As String, ResponseColumnCount As Integer, ResponseList As List(Of String))
            Dim CurrentDataRow As DataRow = CurrentDataTable.NewRow()
            CurrentDataRow("Question No.") = ColumnOneValue
            CurrentDataRow("Title") = GlobalMethods.StripHTML(ColumnTwoValue)

            For i As Integer = 1 To ResponseColumnCount
                If i <= ResponseList.Count() Then
                    CurrentDataRow("Response" & i.ToString()) = ResponseList(i - 1)
                End If
            Next

            CurrentDataTable.Rows.Add(CurrentDataRow)
        End Sub

        Public Shared Sub AddSpacerRowToTable(ByRef CurrentDataTable As DataTable, ResponseColumnCount As Integer)
            Dim CurrentDataRow As DataRow = CurrentDataTable.NewRow()
            CurrentDataRow("Question No.") = ""
            CurrentDataRow("Title") = ""

            For i As Integer = 1 To ResponseColumnCount
                CurrentDataRow("Response" & i.ToString()) = ""
            Next
            CurrentDataTable.Rows.Add(CurrentDataRow)
        End Sub

        Public Shared Sub AddDataToRow(ByRef CurrentDataRow As DataRow, DataRowColumnName As String, Value As String)
            Try
                CurrentDataRow(DataRowColumnName) = Value
            Catch ex As Exception
                Dim x = 1
            End Try
        End Sub

        Public Shared Function GetOptionTitle(Options As List(Of SurveyOption), OptionID As String) As String
            Dim OptionTitle As String = (From dr In Options Where dr.ID = OptionID Select dr.Title).FirstOrDefault()
            If String.IsNullOrEmpty(OptionTitle) Then OptionTitle = "Question Answer"
            Return OptionTitle
        End Function
#End Region

#Region "General Formatting and Functions"
        Public Shared Function FormatDate(InDate As Date) As String
            Return InDate.ToString("HH:mm d") & GlobalMethods.GetDateSuffix(InDate.Day).ToLower() & " " & InDate.ToString("MMM yyyy")
        End Function

        Public Shared Function FormatDateSimple(InDate As Date) As String
            Return InDate.ToString("dd/MM/yyyy HH:mm")
        End Function

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

        Public Shared Function IsNumberQuestion(QuestionNumber As Integer, CurrentSurveyID As Integer, CurrentSurveyQuestion As SurveyQuestion) As Boolean

            '# Check for Number questions
            Dim NumberQuestion As Boolean = False

            If CurrentSurveyID = "1541759" Then
                '# The 2014 RICS and Macdonald & Company UK Rewards and Attitudes Survey
                If QuestionNumber = 15 OrElse QuestionNumber = 16 OrElse QuestionNumber = 17 OrElse QuestionNumber = 20 OrElse QuestionNumber = 22 Then
                    NumberQuestion = True
                End If
            ElseIf CurrentSurveyID = "1607485" Then
                '# The 2014 RICS and Macdonald & Company UK Rewards and Attitudes Survey
                If QuestionNumber = 15 OrElse QuestionNumber = 16 OrElse QuestionNumber = 17 OrElse QuestionNumber = 20 OrElse QuestionNumber = 22 Then
                    NumberQuestion = True
                End If
            ElseIf CurrentSurveyID = "1541763" Then
                '# The 2014 RICS and Macdonald &amp; Company Middle East Rewards and Attitudes Survey
                If QuestionNumber = 17 OrElse QuestionNumber = 18 OrElse QuestionNumber = 19 OrElse QuestionNumber = 22 OrElse QuestionNumber = 24 Then
                    NumberQuestion = True
                End If
            ElseIf CurrentSurveyID = "1541784" Then
                '# The 2014 RICS and Macdonald &amp; Company Europe Rewards and Attitudes Survey
                If QuestionNumber = 15 OrElse QuestionNumber = 16 OrElse QuestionNumber = 17 OrElse QuestionNumber = 20 OrElse QuestionNumber = 22 Then
                    NumberQuestion = True
                End If
            ElseIf CurrentSurveyID = "1562646" Then
                '# The 2014 RICS and Macdonald &amp; Company Asia Rewards and Attitudes Survey
                If QuestionNumber = 19 OrElse QuestionNumber = 21 OrElse QuestionNumber = 22 OrElse QuestionNumber = 25 OrElse QuestionNumber = 27 Then
                    NumberQuestion = True
                End If
            Else
                '# Loop through properties to find the map_key
                For Each p In CurrentSurveyQuestion.Properties
                    If p.Key = "map_key" Then
                        If Not String.IsNullOrEmpty(p.Value) Then
                            If p.Value.ToLower() = "number" Then
                                NumberQuestion = True
                                Exit For
                            End If
                        End If
                    End If
                Next
            End If

            Return NumberQuestion

        End Function

#End Region

    End Class

End Namespace

