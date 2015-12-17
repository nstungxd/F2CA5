Imports Microsoft.VisualBasic
Imports System.Data
Imports PingLibrary
Imports System.Xml
Imports iTextSharp.text
Imports iTextSharp.text.pdf
Imports System.IO
Imports PingSurveys.SurveyLibrary

Namespace PingUtilities

    Public Class PDFBuilder

        Const RootFolderPath As String = "/App_Data/PDFs/"

        Public Shared Sub BuildPDF(FileName As String, Title As String, Text As String)

            Dim r As New Rectangle(400, 300)
            Dim doc As New Document(r)

            Try

                '# Check the folder exists- create folder if it doesn't
                CheckFolderExists(RootFolderPath)

                '# Check the file exists- create file if it doesn't
                Dim IsNewFile As Boolean = CheckFileExists(RootFolderPath & FileName & ".pdf")

                '# Only build if this is a new document
                If IsNewFile Then

                    Dim FolderPath As String = RootFolderPath
                    If Not FolderPath.StartsWith("~") Then FolderPath = "~" & FolderPath

                    '# use a variable to let my code fit across the page...
                    Dim path As String = HttpContext.Current.Server.MapPath(FolderPath)

                    PdfWriter.GetInstance(doc, New FileStream(path & FileName & ".pdf", FileMode.Create))
                    doc.Open()

                    '# Title
                    Title = Title & Environment.NewLine & Environment.NewLine
                    Dim TitleChunk As New Chunk(Title)
                    Dim TitlePhrase As New Phrase(TitleChunk)

                    '# Text
                    Text = Text.Replace(Environment.NewLine, String.Empty).Replace("  ", [String].Empty)
                    Dim TextChunk As New Chunk(Text)
                    Dim TextPhrase As New Phrase(TextChunk)

                    Dim p As New Paragraph()
                    p.Add(TitlePhrase)
                    p.Add(TextPhrase)
                    doc.Add(p)

                End If

            Catch dex As DocumentException
                Throw (dex)
            Catch ioex As IOException
                Throw (ioex)
            Finally
                doc.Close()
            End Try

        End Sub

#Region "Responses"
        Public Shared Function BuildResponsePage(CurrentSurvey As Survey, CurrentSurveyResponse As SurveyResponse, Optional CurrentSelectedQuestion As Integer = 0) As String

            '# Global variables
            Dim doc As New Document(PageSize.A4, 18, 18, 36, 36)

            Dim FileLocation As String = ""
            Dim PageFileName As String = ""

            Try

                If CurrentSurvey IsNot Nothing AndAlso CurrentSurveyResponse IsNot Nothing Then

                    '# Get the filename info
                    Dim PageFilePath As String = RootFolderPath & CurrentSurvey.ID.ToString() & "/"

                    PageFileName = "response_details_" & CurrentSurveyResponse.ID
                    If CurrentSelectedQuestion > 0 Then PageFileName &= "_" & CurrentSelectedQuestion.ToString()

                    '# Set filelocation
                    FileLocation = PageFilePath & PageFileName & ".pdf"

                    '# Check the folder exists- create folder if it doesn't
                    CheckFolderExists(PageFilePath)

                    '# Check the file exists- create file if it doesn't
                    Dim IsNewFile As Boolean = CheckFileExists(FileLocation)

                    '# Only build if this is a new document
                    If IsNewFile Then

                        Dim FolderPath As String = PageFilePath
                        If Not FolderPath.StartsWith("~") Then FolderPath = "~" & FolderPath

                        '# use a variable to let my code fit across the page...
                        Dim path As String = HttpContext.Current.Server.MapPath(FolderPath)

                        Dim pdfWrite As PdfWriter = PdfWriter.GetInstance(doc, New FileStream(path & PageFileName & ".pdf", FileMode.Create))

                        Dim ev As New itsEvents
                        pdfWrite.PageEvent = ev

                        doc.Open()

                        '# Logo
                        Dim Logo As iTextSharp.text.Image
                        Try
                            If Not String.IsNullOrEmpty(CurrentSurvey.DecorativeHeaderImage) Then

                                Dim url As String = CurrentSurvey.DecorativeHeaderImage
                                If Not url.StartsWith("http:") Then url = "http:" & url

                                Logo = Image.GetInstance(New Uri(url))
                            Else
                                Logo = Image.GetInstance(HttpContext.Current.Server.MapPath("~/Media/Images/header-default.jpg"))
                            End If
                        Catch ex As Exception
                            Logo = Image.GetInstance(HttpContext.Current.Server.MapPath("~/Media/Images/header-default.jpg"))
                        End Try

                        Logo.ScaleToFit(400.0F, 100.0F)
                        Logo.Alignment = Image.ALIGN_CENTER
                        doc.Add(Logo)

                        '# Spacer
                        Dim p As Paragraph = New Paragraph(" ")
                        doc.Add(p)

                        '# Add info
                        doc.Add(CreateInformationRow(CurrentSurveyResponse, CurrentSurvey))
                        doc.Add(p)

                        '# Build HTML for the questions
                        Dim QuestionsList As List(Of SurveyQuestion) = (From dr In CurrentSurvey.Questions Where dr.Type = "SurveyQuestion" Select dr).ToList()
                        Dim QuestionCount As Integer = 1

                        If CurrentSelectedQuestion > 0 Then

                            For Each sq As SurveyQuestion In QuestionsList
                                If sq.ID = CurrentSelectedQuestion Then
                                    doc.Add(CreateQuestionRow(CurrentSurveyResponse, sq, CurrentSurvey, QuestionCount))
                                    doc.Add(p)
                                    QuestionCount += 1
                                End If
                            Next

                        Else
                            For Each sq As SurveyQuestion In QuestionsList
                                doc.Add(CreateQuestionRow(CurrentSurveyResponse, sq, CurrentSurvey, QuestionCount))
                                doc.Add(p)
                                QuestionCount += 1
                            Next
                        End If

                        '# Footer
                        Dim Footer As New Paragraph("")

                    End If
                Else
                    Throw New Exception("Deal information can't be accessed")
                End If

            Catch dex As DocumentException
                Throw (dex)
            Catch ioex As IOException
                Throw (ioex)
            Catch ex As Exception
                Throw (ex)
            Finally
                doc.Close()
            End Try

            Return PageFileName & ".pdf"

        End Function

        Public Shared Function CreateInformationRow(CurrentSurveyResponse As SurveyResponse, CurrentSurvey As Survey) As PdfPTable

            '# Set layout
            Dim NumberOfColumns As Integer = 2

            Dim Table As PdfPTable = New PdfPTable(2)

            '# Row 1
            Dim cell As PdfPCell = New PdfPCell(New Phrase("Respondent details:", New Font(Font.FontFamily.HELVETICA, 10)))
            cell.BackgroundColor = BaseColor.WHITE
            cell.Padding = 5
            cell.BorderWidth = 0.0F
            cell.Colspan = 2
            Table.AddCell(cell)

            '# Info rows

            '# Completed
            cell = New PdfPCell(New Phrase("Fully completed?", New Font(Font.FontFamily.HELVETICA, 8)))
            cell.Padding = 5
            cell.BorderWidth = 0.0F
            Table.AddCell(cell)

            cell = New PdfPCell(New Phrase(CompletedStatus(CurrentSurveyResponse.Status), New Font(Font.FontFamily.HELVETICA, 8)))
            cell.Padding = 5
            cell.BorderWidth = 0.0F
            cell.Colspan = 2
            Table.AddCell(cell)

            '# Date
            cell = New PdfPCell(New Phrase("Date completed/last update:", New Font(Font.FontFamily.HELVETICA, 8)))
            cell.Padding = 5
            cell.BorderWidth = 0.0F
            Table.AddCell(cell)

            cell = New PdfPCell(New Phrase(FormatDate(CurrentSurveyResponse.DateSubmitted), New Font(Font.FontFamily.HELVETICA, 8)))
            cell.Padding = 5
            cell.BorderWidth = 0.0F
            cell.Colspan = 2
            Table.AddCell(cell)

            '# ID
            cell = New PdfPCell(New Phrase("RID", New Font(Font.FontFamily.HELVETICA, 8)))
            cell.Padding = 5
            cell.BorderWidth = 0.0F
            Table.AddCell(cell)

            cell = New PdfPCell(New Phrase(CurrentSurveyResponse.ID, New Font(Font.FontFamily.HELVETICA, 8)))
            cell.Padding = 5
            cell.BorderWidth = 0.0F
            cell.Colspan = 2
            Table.AddCell(cell)

            Table.SplitLate = False

            Return Table

        End Function

        Public Shared Function CreateQuestionRow(CurrentSurveyResponse As SurveyResponse, CurrentSurveyQuestion As SurveyQuestion, CurrentSurvey As Survey, QuestionNumber As Integer) As PdfPTable

            Dim CurrentSurveyQuestionID As Integer = 0
            Int32.TryParse(CurrentSurveyQuestion.ID, CurrentSurveyQuestionID)

            Dim CheckImageURL As String = HttpContext.Current.Server.MapPath("~/Media/Images/check.png")

            '# Get stats
            Dim StatisticItem As SurveyStatistic = CurrentSurveyQuestion.Statistics

            '# Check for Number questions
            Dim IsNumberQuestion As Boolean = False

            If CurrentSurvey.ID = "1541759" Then
                '# The 2014 RICS and Macdonald & Company UK Rewards and Attitudes Survey
                If QuestionNumber = 15 OrElse QuestionNumber = 16 OrElse QuestionNumber = 17 OrElse QuestionNumber = 20 OrElse QuestionNumber = 22 Then
                    IsNumberQuestion = True
                End If
            ElseIf CurrentSurvey.ID = "1541763" Then
                '# The 2014 RICS and Macdonald &amp; Company Middle East Rewards and Attitudes Survey
                If QuestionNumber = 17 OrElse QuestionNumber = 18 OrElse QuestionNumber = 19 OrElse QuestionNumber = 22 OrElse QuestionNumber = 24 Then
                    IsNumberQuestion = True
                End If
            ElseIf CurrentSurvey.ID = "1541784" Then
                '# The 2014 RICS and Macdonald &amp; Company Europe Rewards and Attitudes Survey
                If QuestionNumber = 15 OrElse QuestionNumber = 16 OrElse QuestionNumber = 17 OrElse QuestionNumber = 20 OrElse QuestionNumber = 22 Then
                    IsNumberQuestion = True
                End If
            ElseIf CurrentSurvey.ID = "1562646" Then
                '# The 2014 RICS and Macdonald &amp; Company Asia Rewards and Attitudes Survey
                If QuestionNumber = 19 OrElse QuestionNumber = 21 OrElse QuestionNumber = 22 OrElse QuestionNumber = 25 OrElse QuestionNumber = 27 Then
                    IsNumberQuestion = True
                End If
            Else
                '# Loop through properties to find the map_key
                For Each p In CurrentSurveyQuestion.Properties
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

            '# Set layout
            Dim NumberOfColumns As Integer = 2

            Dim SubType As String = CurrentSurveyQuestion.SubType
            If IsNumberQuestion Then SubType = "number"

            Select Case SubType
                Case "table"

                    '# Total options from the sub-questions
                    Dim OptionsCount As Integer = 0
                    For Each sq As SurveyQuestion In CurrentSurveyQuestion.SubQuestions
                        If CurrentSurveyQuestion.Options.Count() > OptionsCount Then
                            OptionsCount = CurrentSurveyQuestion.Options.Count()
                        End If
                    Next

                    NumberOfColumns = OptionsCount + 2
                Case "radio"
                    NumberOfColumns = 2
                Case "checkbox"
                    NumberOfColumns = 2
                Case "menu"
                    NumberOfColumns = 2
                Case "rank"
                    NumberOfColumns = CurrentSurveyQuestion.Options.Count() + 1
                Case Else
                    NumberOfColumns = 1
            End Select

            Dim Table As PdfPTable = New PdfPTable(2)

            '# Row 1
            Dim Title As String = GlobalMethods.StripHTML(CurrentSurveyQuestion.Title)

            Dim cell As PdfPCell = New PdfPCell(New Phrase(Title, New Font(Font.FontFamily.HELVETICA, 10)))
            cell.BackgroundColor = BaseColor.WHITE
            cell.Padding = 5
            cell.BorderWidth = 0.0F
            cell.Colspan = 2
            Table.AddCell(cell)

            Select Case SubType
                Case "radio", "checkbox", "menu"

                    '# Title Row
                    cell = New PdfPCell(New Phrase("Answers:", New Font(Font.FontFamily.HELVETICA, 8)))
                    cell.BackgroundColor = New BaseColor(224, 224, 224)
                    cell.Padding = 5
                    cell.BorderWidth = 1.0F
                    Table.AddCell(cell)

                    cell = New PdfPCell(New Phrase("Responses:", New Font(Font.FontFamily.HELVETICA, 8)))
                    cell.BackgroundColor = New BaseColor(224, 224, 224)
                    cell.Padding = 5
                    cell.BorderWidth = 1.0F
                    Table.AddCell(cell)

                    For Each so In CurrentSurveyQuestion.Options

                        '# Answer Option
                        cell = New PdfPCell(New Phrase(so.Title, New Font(Font.FontFamily.HELVETICA, 8)))
                        cell.Padding = 5
                        cell.BorderWidth = 1.0F
                        Table.AddCell(cell)

                        '# Answer Response
                        Dim HasOtherValue As Boolean = False
                        Dim OtherAnswer As String = ""

                        '# Check to see if this has been selected
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
                            Dim CheckImage = Image.GetInstance(CheckImageURL)
                            CheckImage.ScaleAbsolute(12.0F, 12.0F)
                            Dim CheckedItemTable = New PdfPTable(1)
                            CheckedItemTable.DefaultCell.Border = 0.0F

                            Dim ImageCell = New PdfPCell(CheckImage)
                            ImageCell.BorderWidth = 0.0F
                            ImageCell.HorizontalAlignment = Element.ALIGN_CENTER

                            CheckedItemTable.AddCell(ImageCell)

                            cell = New PdfPCell(CheckedItemTable)
                            cell.Padding = 5
                            cell.BorderWidth = 1.0F

                            Table.AddCell(cell)

                            If HasOtherValue AndAlso CurrentSurvey.CanViewQuestionDetails(QuestionNumber) Then

                                '# Answer Option
                                cell = New PdfPCell(New Phrase("Other Response", New Font(Font.FontFamily.HELVETICA, 8)))
                                cell.Padding = 5
                                cell.BorderWidth = 1.0F
                                Table.AddCell(cell)

                                cell = New PdfPCell(New Phrase(OtherAnswer, New Font(Font.FontFamily.HELVETICA, 8)))
                                cell.Padding = 5
                                cell.BorderWidth = 1.0F
                                Table.AddCell(cell)
                            End If

                        Else
                            cell = New PdfPCell(New Phrase(" ", New Font(Font.FontFamily.HELVETICA, 8)))
                            cell.Padding = 5
                            cell.BorderWidth = 1.0F
                            Table.AddCell(cell)
                        End If

                    Next

                Case "table"

                    '# Load possible options
                    Dim TableValuesTable = New PdfPTable(CurrentSurveyQuestion.Options.Count() + 2)
                    TableValuesTable.DefaultCell.Border = 0.0F

                    Dim TableCell As PdfPCell = New PdfPCell(New Phrase(" ", New Font(Font.FontFamily.HELVETICA, 8)))
                    TableCell.BackgroundColor = New BaseColor(224, 224, 224)
                    TableCell.BorderWidth = 0.0F
                    TableCell.Padding = 5
                    TableCell.Colspan = 2
                    TableCell.HorizontalAlignment = Element.ALIGN_CENTER

                    TableValuesTable.AddCell(TableCell)

                    For Each so As SurveyOption In CurrentSurveyQuestion.Options
                        TableCell = New PdfPCell(New Phrase(so.Title, New Font(Font.FontFamily.HELVETICA, 8)))
                        TableCell.BackgroundColor = New BaseColor(224, 224, 224)
                        TableCell.BorderWidth = 1.0F
                        TableCell.Padding = 5
                        TableCell.HorizontalAlignment = Element.ALIGN_CENTER

                        TableValuesTable.AddCell(TableCell)
                    Next


                    For Each sq As SurveyQuestion In CurrentSurveyQuestion.SubQuestions

                        '# Answer Option
                        TableCell = New PdfPCell(New Phrase(sq.Title, New Font(Font.FontFamily.HELVETICA, 8)))
                        TableCell.Padding = 5
                        TableCell.BorderWidth = 1.0F
                        TableCell.Colspan = 2
                        TableValuesTable.AddCell(TableCell)

                        '# Answer Response

                        For Each so As SurveyOption In sq.Options

                            '# Check to see if this has been selected
                            Dim Count As Integer = 0
                            Dim rqList = (From dr In CurrentSurveyResponse.ResponseQuestions Where dr.QuestionID = sq.ID AndAlso dr.AnswerValue = so.Value Select dr).ToList()

                            If rqList.Count() <= 0 AndAlso so.Value.ToLower.Contains("other") Then
                                Dim rqListID = (From dr In CurrentSurveyResponse.ResponseQuestions Where dr.QuestionID = sq.ID AndAlso dr.AnswerValue.ToLower.Contains("other") AndAlso dr.OptionID = so.ID Select dr).ToList()
                                Count += rqListID.Count()
                            End If

                            Count += rqList.Count()

                            If Count > 0 Then
                                Dim CheckImage = Image.GetInstance(CheckImageURL)
                                CheckImage.ScaleAbsolute(12.0F, 12.0F)
                                Dim CheckedItemTable = New PdfPTable(1)
                                CheckedItemTable.DefaultCell.Border = 0.0F

                                Dim ImageCell = New PdfPCell(CheckImage)
                                ImageCell.BorderWidth = 0.0F
                                ImageCell.HorizontalAlignment = Element.ALIGN_CENTER

                                CheckedItemTable.AddCell(ImageCell)

                                TableCell = New PdfPCell(CheckedItemTable)
                                TableCell.Padding = 5
                                TableCell.BorderWidth = 1.0F

                                TableValuesTable.AddCell(TableCell)

                            Else
                                TableCell = New PdfPCell(New Phrase(" ", New Font(Font.FontFamily.HELVETICA, 8)))
                                TableCell.Padding = 5
                                TableCell.BorderWidth = 1.0F
                                TableValuesTable.AddCell(TableCell)
                            End If

                        Next

                    Next



                    cell = New PdfPCell(TableValuesTable)
                    'cell.BackgroundColor = New BaseColor(224, 224, 224)
                    cell.Padding = 0.0F
                    cell.Colspan = 2
                    cell.BorderWidth = 1.0F

                    Table.AddCell(cell)


                Case "rank"

                    '# Load possible rankings
                    'Dim RankValues As New List(Of Integer)
                    Dim RankValuesTable = New PdfPTable(StatisticItem.Max + 2)
                    RankValuesTable.DefaultCell.Border = 0.0F

                    Dim RankCell As PdfPCell = New PdfPCell(New Phrase(" ", New Font(Font.FontFamily.HELVETICA, 8)))
                    RankCell.BackgroundColor = New BaseColor(224, 224, 224)
                    RankCell.BorderWidth = 0.0F
                    RankCell.Padding = 5
                    RankCell.Colspan = 2
                    RankCell.HorizontalAlignment = Element.ALIGN_CENTER

                    RankValuesTable.AddCell(RankCell)

                    For i As Integer = 1 To CInt(StatisticItem.Max)
                        RankCell = New PdfPCell(New Phrase(i.ToString(), New Font(Font.FontFamily.HELVETICA, 8)))
                        RankCell.BackgroundColor = New BaseColor(224, 224, 224)
                        RankCell.BorderWidth = 1.0F
                        RankCell.Padding = 5
                        RankCell.HorizontalAlignment = Element.ALIGN_CENTER

                        RankValuesTable.AddCell(RankCell)
                    Next

                    '# Load actual responses
                    For Each so In CurrentSurveyQuestion.Options

                        '# Answer Option
                        RankCell = New PdfPCell(New Phrase(so.Title, New Font(Font.FontFamily.HELVETICA, 8)))
                        RankCell.Padding = 5
                        RankCell.BorderWidth = 1.0F
                        RankCell.Colspan = 2
                        RankValuesTable.AddCell(RankCell)

                        '# Answer Response
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

                        For Each rv As KeyValuePair(Of Integer, Integer) In RankValues
                            If rv.Value > 0 Then
                                Dim CheckImage = Image.GetInstance(CheckImageURL)
                                CheckImage.ScaleAbsolute(12.0F, 12.0F)
                                Dim CheckedItemTable = New PdfPTable(1)
                                CheckedItemTable.DefaultCell.Border = 0.0F

                                Dim ImageCell = New PdfPCell(CheckImage)
                                ImageCell.BorderWidth = 0.0F
                                ImageCell.HorizontalAlignment = Element.ALIGN_CENTER

                                CheckedItemTable.AddCell(ImageCell)

                                RankCell = New PdfPCell(CheckedItemTable)
                                RankCell.Padding = 5
                                RankCell.BorderWidth = 1.0F

                                RankValuesTable.AddCell(RankCell)

                            Else
                                RankCell = New PdfPCell(New Phrase(" ", New Font(Font.FontFamily.HELVETICA, 8)))
                                RankCell.Padding = 5
                                RankCell.BorderWidth = 1.0F
                                RankValuesTable.AddCell(RankCell)
                            End If
                        Next

                    Next

                    cell = New PdfPCell(RankValuesTable)
                    'cell.BackgroundColor = New BaseColor(224, 224, 224)
                    cell.Padding = 0.0F
                    cell.Colspan = 2
                    cell.BorderWidth = 1.0F

                    Table.AddCell(cell)

                Case "number"

                    '# Answer Response
                    Dim QuestionsResponses As New List(Of KeyValuePair(Of Integer, SurveyResponseQuestion))
                    For Each rq As SurveyResponseQuestion In CurrentSurveyResponse.ResponseQuestions
                        If rq.QuestionID = CurrentSurveyQuestion.ID AndAlso Not String.IsNullOrEmpty(rq.AnswerValue) Then
                            Dim Result As New KeyValuePair(Of Integer, SurveyResponseQuestion)(CurrentSurveyResponse.ResponseID, rq)
                            QuestionsResponses.Add(Result)
                        End If
                    Next

                    '# Filter to answer
                    Dim AverageMeanText As String = "N/A"

                    Dim FilteredQuestionsResponse As SurveyResponseQuestion = (From dr In QuestionsResponses Where dr.Key = CurrentSurveyResponse.ID Select dr.Value).FirstOrDefault()

                    If FilteredQuestionsResponse IsNot Nothing AndAlso Not String.IsNullOrEmpty(FilteredQuestionsResponse.AnswerValue) Then
                        Dim LocalValue As Decimal = 0D
                        Decimal.TryParse(FilteredQuestionsResponse.AnswerValue, LocalValue)
                        If LocalValue > 0D Then AverageMeanText = LocalValue.ToString("#,##0.00")
                    End If

                    '# Title Row
                    cell = New PdfPCell(New Phrase("Answer:", New Font(Font.FontFamily.HELVETICA, 8)))
                    cell.BackgroundColor = New BaseColor(224, 224, 224)
                    cell.Padding = 5
                    cell.BorderWidth = 1.0F
                    cell.Colspan = 2
                    Table.AddCell(cell)

                    cell = New PdfPCell(New Phrase(AverageMeanText, New Font(Font.FontFamily.HELVETICA, 8)))
                    cell.Padding = 5
                    cell.BorderWidth = 1.0F
                    cell.Colspan = 2
                    Table.AddCell(cell)

                Case Else
                    '# textbox, essay

                    '# Title Row
                    cell = New PdfPCell(New Phrase("Answer:", New Font(Font.FontFamily.HELVETICA, 8)))
                    cell.BackgroundColor = New BaseColor(224, 224, 224)
                    cell.Padding = 5
                    cell.BorderWidth = 1.0F
                    cell.Colspan = 2
                    Table.AddCell(cell)

                    '# Answer Response
                    Dim QuestionsResponses As New List(Of KeyValuePair(Of Integer, SurveyResponseQuestion))
                    For Each rq As SurveyResponseQuestion In CurrentSurveyResponse.ResponseQuestions
                        If rq.QuestionID = CurrentSurveyQuestion.ID AndAlso Not String.IsNullOrEmpty(rq.AnswerValue) Then
                            Dim Result As New KeyValuePair(Of Integer, SurveyResponseQuestion)(CurrentSurveyResponse.ResponseID, rq)
                            QuestionsResponses.Add(Result)
                        End If
                    Next

                    '# Filter to answer
                    Dim FilteredQuestionsResponse As SurveyResponseQuestion = (From dr In QuestionsResponses Where dr.Key = CurrentSurveyResponse.ID Select dr.Value).FirstOrDefault()

                    If CurrentSurvey.CanViewQuestionDetails(QuestionNumber) Then

                        If FilteredQuestionsResponse IsNot Nothing AndAlso Not String.IsNullOrEmpty(FilteredQuestionsResponse.AnswerValue) Then
                            cell = New PdfPCell(New Phrase(FilteredQuestionsResponse.AnswerValue, New Font(Font.FontFamily.HELVETICA, 8)))
                            cell.Padding = 5
                            cell.BorderWidth = 1.0F
                            cell.Colspan = 2
                            Table.AddCell(cell)
                        Else
                            cell = New PdfPCell(New Phrase("Answer not supplied", New Font(Font.FontFamily.HELVETICA, 8)))
                            cell.Padding = 5
                            cell.BorderWidth = 1.0F
                            cell.Colspan = 2
                            Table.AddCell(cell)
                        End If
                    Else
                        cell = New PdfPCell(New Phrase("", New Font(Font.FontFamily.HELVETICA, 8)))
                        cell.Padding = 5
                        cell.BorderWidth = 1.0F
                        cell.Colspan = 2
                        Table.AddCell(cell)
                    End If

            End Select

            Return Table

        End Function
#End Region

#Region "Export"

        Public Shared Function BuildResponsePage(CurrentSurvey As Survey, CurrentSurveyControl As PingSurveys.SurveyControl, Optional IncludeComments As Boolean = True) As String

            '# Global variables
            Dim doc As New iTextSharp.text.Document(iTextSharp.text.PageSize.A4, 0, 0, 12, 40)

            Dim FileLocation As String = ""
            Dim PageFileName As String = ""

            Try

                If CurrentSurvey IsNot Nothing Then

                    '# Get the filename info
                    Dim PageFilePath As String = RootFolderPath & CurrentSurvey.ID.ToString() & "/"

                    Dim FormattedTitle As String = CurrentSurvey.Title.Replace(" ", "").Replace("/", "").Replace(",", "")
                    PageFileName = "ReportSummary_" & FormattedTitle & "_" & CurrentSurvey.ID

                    '# Set filelocation
                    FileLocation = PageFilePath & PageFileName & ".pdf"

                    '# Check the folder exists- create folder if it doesn't
                    CheckFolderExists(PageFilePath)

                    '# Check the file exists- create file if it doesn't
                    Dim IsNewFile As Boolean = True 'CheckFileExists(FileLocation)

                    '# Only build if this is a new iTextSharp.text.Document
                    If IsNewFile Then

                        Dim FolderPath As String = PageFilePath
                        If Not FolderPath.StartsWith("~") Then FolderPath = "~" & FolderPath

                        '# use a variable to let my code fit across the page...
                        Dim path As String = HttpContext.Current.Server.MapPath(FolderPath)

                        Dim pdfWrite As PdfWriter = PdfWriter.GetInstance(doc, New FileStream(path & PageFileName & ".pdf", FileMode.Create))

                        Dim ev As New itsEvents
                        pdfWrite.PageEvent = ev

                        doc.Open()

                        '# Logo
                        Dim Logo As iTextSharp.text.Image
                        Try
                            If Not String.IsNullOrEmpty(CurrentSurvey.DecorativeHeaderImage) Then

                                Dim url As String = CurrentSurvey.DecorativeHeaderImage
                                If Not url.StartsWith("http:") Then url = "http:" & url

                                Logo = iTextSharp.text.Image.GetInstance(New Uri(url))
                            Else
                                Logo = iTextSharp.text.Image.GetInstance(HttpContext.Current.Server.MapPath("~/Media/Images/header-default.jpg"))
                            End If
                        Catch ex As Exception
                            Logo = iTextSharp.text.Image.GetInstance(HttpContext.Current.Server.MapPath("~/Media/Images/header-default.jpg"))
                        End Try

                        Logo.ScaleToFit(400.0F, 100.0F)
                        Logo.Alignment = iTextSharp.text.Image.ALIGN_CENTER
                        doc.Add(Logo)

                        '# Spacer
                        Dim p As iTextSharp.text.Paragraph = New iTextSharp.text.Paragraph(" ")
                        doc.Add(p)

                        '# Exclude List
                        Dim ExcludedResponses As DataTable = DataAccess.GetExcludedResponsesBySurveyID(CurrentSurvey.ID)
                        Dim ExcludedResponseIDs As New List(Of Integer)
                        For Each dr As DataRow In ExcludedResponses.Rows
                            ExcludedResponseIDs.Add(DataFunctions.GetColumnFromDataRow(Of Integer)(dr, "ResponseID"))
                        Next

                        '# Add info
                        Dim InformationTable As PdfPTable = CreateInformationRow(CurrentSurvey, CurrentSurveyControl, ExcludedResponseIDs)
                        InformationTable.SplitLate = False
                        doc.Add(InformationTable)
                        'doc.Add(p)

                        '# Build HTML for the questions
                        Dim QuestionsList As List(Of SurveyQuestion) = (From dr In CurrentSurvey.Questions Where dr.Type = "SurveyQuestion" Select dr).ToList()
                        Dim QuestionCount As Integer = 1

                        Dim ResultListTable As New PdfPTable(1)
                        ResultListTable.SplitLate = False

                        For Each sq As SurveyQuestion In QuestionsList

                            If Not CurrentSurvey.CanViewQuestionDetails(QuestionCount) Then IncludeComments = False

                            Dim ResultTable As PdfPTable = CreateQuestionRow(sq, CurrentSurvey, QuestionCount, IncludeComments, ExcludedResponseIDs)
                            ResultTable.SplitLate = False

                            Dim ResultListCell As PdfPCell = New PdfPCell(ResultTable)
                            ResultListCell.BackgroundColor = iTextSharp.text.BaseColor.WHITE
                            'ResultListCell.Padding = 5
                            ResultListCell.BorderWidth = 0.0F

                            ResultListTable.AddCell(ResultListCell)

                            Dim SpacerCell As PdfPCell = New PdfPCell(p)
                            SpacerCell.BackgroundColor = iTextSharp.text.BaseColor.WHITE
                            'SpacerCell.Padding = 5
                            SpacerCell.BorderWidth = 0.0F

                            ResultListTable.AddCell(SpacerCell)

                            QuestionCount += 1
                        Next

                        doc.Add(ResultListTable)
                        doc.Add(p)

                        '# Footer
                        Dim Footer As New iTextSharp.text.Paragraph("")

                    End If
                Else
                    Throw New Exception("Deal information can't be accessed")
                End If

            Catch dex As iTextSharp.text.DocumentException
                Throw (dex)
            Catch ioex As IOException
                Throw (ioex)
            Catch ex As Exception
                Throw (ex)
            Finally
                doc.Close()
            End Try

            Return PageFileName & ".pdf"

        End Function

        Public Shared Function CreateInformationRow(CurrentSurvey As Survey, CurrentSurveyControl As PingSurveys.SurveyControl, ExcludedResponseIDs As List(Of Integer)) As PdfPTable

            '# Set layout & styles
            Dim Table As PdfPTable = New PdfPTable(2)

            Dim Arial As iTextSharp.text.Font = iTextSharp.text.FontFactory.GetFont(iTextSharp.text.FontFactory.HELVETICA)
            Arial.Size = 8
            Arial.SetColor(21, 21, 21)

            Dim ArialLarge As iTextSharp.text.Font = iTextSharp.text.FontFactory.GetFont(iTextSharp.text.FontFactory.HELVETICA)
            ArialLarge.Size = 10
            ArialLarge.SetColor(21, 21, 21)

            '# Responses
            Dim CurrentResponses As List(Of SurveyResponse) = CurrentSurvey.Responses
            Dim TotalResponseList As List(Of SurveyResponse) = CurrentSurvey.AllResponses

            '# Exclude responses if required
            If ExcludedResponseIDs.Count > 0 Then
                CurrentResponses = (From dr In CurrentResponses Where Not ExcludedResponseIDs.Contains(dr.ID) Select dr).ToList()
                TotalResponseList = (From dr In TotalResponseList Where Not ExcludedResponseIDs.Contains(dr.ID) Select dr).ToList()
            End If

            '# Get Total information
            Dim TotalResponses As Integer = 0
            Dim FilteredResponses As Integer = 0
            Dim ExcludedResponses As Integer = 0

            TotalResponses = TotalResponseList.Count()

            Dim ResponsesAreFiltered As Boolean = True

            If CurrentSurveyControl.SurveyFilters.Count = 1 AndAlso CurrentSurveyControl.SurveyFilters(0).SurveyFilterType = SurveyFilterTypeEnum.Status AndAlso CurrentSurveyControl.SurveyFilters(0).FilterValue = "Deleted" Then
                ResponsesAreFiltered = False
            ElseIf CurrentSurveyControl.SurveyFilters.Count = 2 Then

                Dim NoDeletedDataPresent As Boolean = False
                Dim NoTestDataPresent As Boolean = False

                For Each sf As SurveyFilter In CurrentSurveyControl.SurveyFilters
                    If sf.SurveyFilterType = SurveyFilterTypeEnum.Status AndAlso sf.FilterValue = "Deleted" Then
                        NoDeletedDataPresent = True
                    End If
                Next

                For Each sf As SurveyFilter In CurrentSurveyControl.SurveyFilters
                    If sf.SurveyFilterType = SurveyFilterTypeEnum.General AndAlso sf.FieldValue = "istestdata" Then
                        NoTestDataPresent = True
                    End If
                Next

                If NoDeletedDataPresent AndAlso NoTestDataPresent Then
                    ResponsesAreFiltered = False
                End If

            End If
            If Not ResponsesAreFiltered Then
                FilteredResponses = 0
                ExcludedResponses = 0
            Else
                FilteredResponses = CurrentResponses.Count() 'CurrentSurvey.Responses.Count()
                ExcludedResponses = TotalResponses - FilteredResponses
            End If

            '# Row 1

            '# Load date filters
            Dim DateFilterString As String = ""
            Dim HasBeforeDate As Boolean = False
            Dim BeforeDate As New Date
            Dim HasAfterDate As Boolean = False
            Dim AfterDate As New Date

            Dim FirstResponse As SurveyResponse = (From dr In CurrentSurvey.AllResponses Order By dr.DateSubmitted Select dr).FirstOrDefault()
            Dim LastResponse As SurveyResponse = (From dr In CurrentSurvey.AllResponses Order By dr.DateSubmitted Descending Select dr).FirstOrDefault()

            For Each sf As SurveyFilter In CurrentSurveyControl.SurveyFilters
                Select Case sf.SurveyFilterType

                    Case SurveyFilterTypeEnum.DateBefore
                        '# Get values
                        Dim DateStr As String = sf.FilterValue.Replace("+", " ")

                        '# Check this is a valid date
                        Dim DateOK As Boolean = Date.TryParse(DateStr, BeforeDate)
                        HasBeforeDate = DateOK

                    Case SurveyFilterTypeEnum.DateAfter
                        '# Get values
                        Dim DateStr As String = sf.FilterValue.Replace("+", " ")

                        '# Check this is a valid date
                        Dim DateOK As Boolean = Date.TryParse(DateStr, AfterDate)
                        HasAfterDate = DateOK
                End Select
            Next

            Dim LastDate As Date = LastResponse.DateSubmitted
            If LastDate > Now.Date Then
                LastDate = Now.Date
            End If

            If HasBeforeDate AndAlso HasAfterDate Then
                DateFilterString = " " & FormatExportDateFilter(BeforeDate) & " -" & FormatExportDateFilter(AfterDate)
            ElseIf HasAfterDate Then
                DateFilterString = " " & FormatExportDateFilter(FirstResponse.DateSubmitted) & " -" & FormatExportDateFilter(AfterDate)
            ElseIf HasBeforeDate Then
                DateFilterString = " " & FormatExportDateFilter(BeforeDate) & " -" & FormatExportDateFilter(LastDate)
            Else
                DateFilterString = " " & FormatExportDateFilter(Now.Date)  '" " & FormatExportDateFilter(FirstResponse.DateSubmitted) & " -" & FormatExportDateFilter(LastDate)
            End If

            Dim ReportTitle As String = "Report Summary"
            If Not String.IsNullOrEmpty(DateFilterString) Then ReportTitle = ReportTitle & " -" & DateFilterString

            Dim cell As PdfPCell = New PdfPCell(New iTextSharp.text.Phrase(ReportTitle, ArialLarge))
            cell.BackgroundColor = iTextSharp.text.BaseColor.WHITE
            cell.Padding = 5
            cell.Colspan = 2
            cell.BorderWidth = 0.0F
            Table.AddCell(cell)

            '# Info rows

            '# Survey
            cell = New PdfPCell(New iTextSharp.text.Phrase("Survey: " & CurrentSurvey.Title, Arial))
            cell.Padding = 5
            cell.BorderWidth = 0.0F
            cell.Colspan = 2
            Table.AddCell(cell)

            '# Status
            Dim StatusFont As iTextSharp.text.Font = iTextSharp.text.FontFactory.GetFont(iTextSharp.text.FontFactory.HELVETICA)
            StatusFont.Size = 8

            Dim StatusTitle As String = ""
            Select Case CurrentSurvey.Status
                Case "In Design"
                    StatusFont.SetColor(0, 70, 122)
                    StatusTitle = "In Design"
                Case "Launched"
                    StatusFont.SetColor(156, 205, 68)
                    StatusTitle = "Launched"
                Case "Closed"
                    StatusFont.SetColor(198, 21, 28)
                    StatusTitle = "Closed"
            End Select

            Dim TitleChunk As iTextSharp.text.Chunk = New iTextSharp.text.Chunk("Status: ", Arial)
            Dim InfoChunk As iTextSharp.text.Chunk = New iTextSharp.text.Chunk(StatusTitle, StatusFont)

            Dim StatusPhrase As iTextSharp.text.Phrase = New iTextSharp.text.Phrase(TitleChunk)
            StatusPhrase.Add(InfoChunk)

            cell = New PdfPCell(StatusPhrase)
            cell.Padding = 5
            cell.BorderWidth = 0.0F
            Table.AddCell(cell)

            '# Total Responses
            cell = New PdfPCell(New iTextSharp.text.Phrase("Total Responses: " & TotalResponses.ToString(), Arial))
            cell.Padding = 5
            cell.BorderWidth = 0.0F
            Table.AddCell(cell)

            '# Created Time/Date
            cell = New PdfPCell(New iTextSharp.text.Phrase("Created Time/Date: " & FormatExportDate(CurrentSurvey.CreatedOn, False), Arial))
            cell.Padding = 5
            cell.BorderWidth = 0.0F
            Table.AddCell(cell)

            '# Filtered Responses
            cell = New PdfPCell(New iTextSharp.text.Phrase("Filtered Responses: " & FilteredResponses.ToString(), Arial))
            cell.Padding = 5
            cell.BorderWidth = 0.0F
            Table.AddCell(cell)

            '# Modified Time/Date
            cell = New PdfPCell(New iTextSharp.text.Phrase("Modified Time/Date: " & FormatExportDate(CurrentSurvey.ModifiedOn, False), Arial))
            cell.Padding = 5
            cell.BorderWidth = 0.0F
            Table.AddCell(cell)

            '# Responses Excluded
            cell = New PdfPCell(New iTextSharp.text.Phrase("Responses Excluded: " & ExcludedResponses.ToString(), Arial))
            cell.Padding = 5
            cell.BorderWidth = 0.0F
            Table.AddCell(cell)

            '# Divider
            cell = New PdfPCell()
            cell.Padding = 5
            cell.Colspan = 2
            cell.BorderWidth = 0.0F
            cell.BorderWidthBottom = 1.0F
            cell.BorderColorBottom = New iTextSharp.text.BaseColor(0, 70, 122)
            Table.AddCell(cell)

            Table.SplitLate = False

            Return Table

        End Function

        Public Shared Function CreateQuestionRow(CurrentSurveyQuestion As SurveyQuestion, CurrentSurvey As Survey, QuestionNumber As Integer, IncludeComments As Boolean, ExcludedResponseIDs As List(Of Integer)) As PdfPTable

            '# Set layout options
            Dim Arial As iTextSharp.text.Font = iTextSharp.text.FontFactory.GetFont(iTextSharp.text.FontFactory.HELVETICA)
            Arial.Size = 7
            Arial.SetColor(21, 21, 21)

            Dim ArialBold As iTextSharp.text.Font = iTextSharp.text.FontFactory.GetFont(iTextSharp.text.FontFactory.HELVETICA_BOLD)
            ArialBold.Size = 7
            ArialBold.SetColor(21, 21, 21)

            Dim ArialLarge As iTextSharp.text.Font = iTextSharp.text.FontFactory.GetFont(iTextSharp.text.FontFactory.HELVETICA)
            ArialLarge.Size = 9
            ArialLarge.SetColor(21, 21, 21)

            Dim ArialLargeBold As iTextSharp.text.Font = iTextSharp.text.FontFactory.GetFont(iTextSharp.text.FontFactory.HELVETICA_BOLD)
            ArialLargeBold.Size = 9
            ArialLargeBold.SetColor(21, 21, 21)

            Dim ArialSmall As iTextSharp.text.Font = iTextSharp.text.FontFactory.GetFont(iTextSharp.text.FontFactory.HELVETICA)
            ArialSmall.Size = 6
            ArialSmall.SetColor(21, 21, 21)

            '# Get basic info
            Dim CurrentSurveyQuestionID As Integer = 0
            Int32.TryParse(CurrentSurveyQuestion.ID, CurrentSurveyQuestionID)

            Dim CheckImageURL As String = HttpContext.Current.Server.MapPath("~/Media/Images/check.png")

            '# Get stats
            Dim StatisticItem As SurveyStatistic = CurrentSurveyQuestion.Statistics

            '# Options
            Dim OptionsList As List(Of SurveyOption) = CurrentSurveyQuestion.Options

            '# Responses
            Dim CurrentResponses As List(Of SurveyResponse) = CurrentSurvey.Responses

            '# Exclude responses if required
            If ExcludedResponseIDs.Count > 0 Then
                CurrentResponses = (From dr In CurrentResponses Where Not ExcludedResponseIDs.Contains(dr.ID) Select dr).ToList()
            End If

            '# Check for Number questions
            Dim IsNumberQuestion As Boolean = False

            If CurrentSurvey.ID = "1541759" Then
                '# The 2014 RICS and Macdonald & Company UK Rewards and Attitudes Survey
                If QuestionNumber = 15 OrElse QuestionNumber = 16 OrElse QuestionNumber = 17 OrElse QuestionNumber = 20 OrElse QuestionNumber = 22 Then
                    IsNumberQuestion = True
                End If
            ElseIf CurrentSurvey.ID = "1541763" Then
                '# The 2014 RICS and Macdonald &amp; Company Middle East Rewards and Attitudes Survey
                If QuestionNumber = 17 OrElse QuestionNumber = 18 OrElse QuestionNumber = 19 OrElse QuestionNumber = 22 OrElse QuestionNumber = 24 Then
                    IsNumberQuestion = True
                End If
            ElseIf CurrentSurvey.ID = "1541784" Then
                '# The 2014 RICS and Macdonald &amp; Company Europe Rewards and Attitudes Survey
                If QuestionNumber = 15 OrElse QuestionNumber = 16 OrElse QuestionNumber = 17 OrElse QuestionNumber = 20 OrElse QuestionNumber = 22 Then
                    IsNumberQuestion = True
                End If
            ElseIf CurrentSurvey.ID = "1562646" Then
                '# The 2014 RICS and Macdonald &amp; Company Asia Rewards and Attitudes Survey
                If QuestionNumber = 19 OrElse QuestionNumber = 21 OrElse QuestionNumber = 22 OrElse QuestionNumber = 25 OrElse QuestionNumber = 27 Then
                    IsNumberQuestion = True
                End If
            Else
                '# Loop through properties to find the map_key
                For Each p In CurrentSurveyQuestion.Properties
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

            '# Get total click count
            Dim TotalClicks As Integer = 0
            Dim TotalResponses As Integer = 0

            If OptionsList.Count > 0 Then

                For Each so As SurveyOption In OptionsList
                    For Each ri As SurveyResponse In CurrentResponses 'CurrentSurvey.Responses
                        Dim ResultList = (From dr In ri.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.AnswerValue = so.Value Select dr).ToList()

                        If ResultList.Count() <= 0 AndAlso so.Value.ToLower.Contains("other") Then
                            Dim rqListID As New List(Of SurveyResponseQuestion)

                            If CurrentSurveyQuestion.SubType = "radio" Then
                                ResultList = (From dr In ri.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.OptionID = so.ID Select dr).ToList()
                                'rqListID = (From dr In ri.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.AnswerValue.ToLower.Contains("other") AndAlso dr.OptionID = so.ID Select dr).ToList()
                            Else
                                ResultList = (From dr In ri.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.AnswerValue.ToLower.Contains("other") AndAlso dr.OptionID = so.ID Select dr).ToList()
                            End If

                        End If

                        If ResultList.Count > 0 Then
                            TotalResponses += 1
                            TotalClicks += ResultList.Count()
                        End If
                    Next
                Next
            Else

                For Each ri As SurveyResponse In CurrentResponses
                    '# Check this response has answers
                    Dim ResultList = (From dr In ri.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestion.ID AndAlso Not String.IsNullOrEmpty(dr.AnswerValue) Select dr).ToList()

                    If ResultList.Count > 0 Then
                        TotalResponses += 1
                        TotalClicks += ResultList.Count()
                    End If
                Next

            End If

            '# Set layout
            Dim NumberOfColumns As Integer = 2
            Dim TitleWidth As Integer = 2

            Dim Table As PdfPTable = New PdfPTable(2)
            Table.SplitLate = True

            Dim SubType As String = CurrentSurveyQuestion.SubType
            If IsNumberQuestion Then SubType = "number"

            Select Case SubType
                Case "table"
                    '# Total options from the sub-questions
                    Dim OptionsCount As Integer = 0
                    For Each sq As SurveyQuestion In CurrentSurveyQuestion.SubQuestions
                        If CurrentSurveyQuestion.Options.Count() > OptionsCount Then
                            OptionsCount = CurrentSurveyQuestion.Options.Count()
                        End If
                    Next

                    NumberOfColumns = OptionsCount + 2
                Case "radio"
                    NumberOfColumns = 2

                    'Dim widths As Single() = New Single() {1.5F, 1.0F}
                    Dim widths As Single() = New Single() {1.0F, 1.0F}
                    Table.SetWidths(widths)
                Case "checkbox"
                    NumberOfColumns = 2

                    Dim widths As Single() = New Single() {1.0F, 1.0F}
                    Table.SetWidths(widths)
                Case "menu"
                    NumberOfColumns = 2

                    Dim widths As Single() = New Single() {1.0F, 1.0F}
                    Table.SetWidths(widths)
                Case "rank"
                    NumberOfColumns = CurrentSurveyQuestion.Options.Count() + 1
                Case "multi_textbox"
                    NumberOfColumns = CurrentSurveyQuestion.Options.Count() + 1
                Case "number"
                    NumberOfColumns = 2

                    Dim widths As Single() = New Single() {1.0F, 1.0F}
                    Table.SetWidths(widths)
                Case Else
                    NumberOfColumns = 1
                    Table = New PdfPTable(3)
                    'Dim widths As Single() = New Single() {0.5F, 2.0F}
                    Dim widths As Single() = New Single() {1, 1, 7}
                    Table.SetWidths(widths)
                    TitleWidth = 3
            End Select

            Table.KeepTogether = True
            '# Row 1
            Dim Title As String = GlobalMethods.StripHTML(CurrentSurveyQuestion.Title)

            Dim QuestionChunk As iTextSharp.text.Chunk = New iTextSharp.text.Chunk("Question " & QuestionNumber & ": ", ArialLargeBold)
            Dim TitleChunk As iTextSharp.text.Chunk = New iTextSharp.text.Chunk(Title, ArialLarge)

            Dim QuestionTitlePhrase As iTextSharp.text.Phrase = New iTextSharp.text.Phrase(QuestionChunk)
            QuestionTitlePhrase.Add(TitleChunk)

            Dim cell As PdfPCell = New PdfPCell(QuestionTitlePhrase)
            cell.BackgroundColor = iTextSharp.text.BaseColor.WHITE
            cell.Padding = 5
            cell.BorderWidth = 0.0F
            cell.Colspan = TitleWidth
            Table.AddCell(cell)

            Select Case SubType
                Case "radio", "checkbox", "menu"

                    '# Load possible options
                    Dim GraphValuesTable = New PdfPTable(2)
                    GraphValuesTable.SplitLate = True
                    GraphValuesTable.DefaultCell.Border = 0.0F

                    '# Title Row
                    cell = New PdfPCell(New iTextSharp.text.Phrase("Answers:", Arial))
                    cell.Padding = 5
                    cell.PaddingBottom = 8
                    cell.BorderWidth = 0
                    GraphValuesTable.AddCell(cell)

                    cell = New PdfPCell(New iTextSharp.text.Phrase("Responses:", Arial))
                    cell.Padding = 5
                    cell.PaddingBottom = 8
                    cell.BorderWidth = 0
                    GraphValuesTable.AddCell(cell)

                    Dim OptionCount As Integer = 0
                    For Each so In CurrentSurveyQuestion.Options

                        '# Answer Option
                        cell = New PdfPCell(New iTextSharp.text.Phrase(so.Title, Arial))
                        cell.Padding = 5
                        cell.BorderWidth = 0
                        If (OptionCount Mod 2) <> 0 Then cell.BackgroundColor = New iTextSharp.text.BaseColor(237, 237, 237)
                        GraphValuesTable.AddCell(cell)

                        '# Answer Response
                        Dim ResponseValue As String = "0 / 0%"

                        Dim Count As Integer = 0
                        If so IsNot Nothing Then

                            '# Survey responses
                            For Each ri As SurveyResponse In CurrentResponses

                                Dim rqList = (From dr In ri.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.AnswerValue = so.Value Select dr).ToList()

                                If rqList.Count() <= 0 AndAlso so.Value.ToLower.Contains("other") Then
                                    Dim rqListID As New List(Of SurveyResponseQuestion)

                                    If CurrentSurveyQuestion.SubType = "radio" Then
                                        rqListID = (From dr In ri.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.OptionID = so.ID Select dr).ToList()
                                    Else
                                        rqListID = (From dr In ri.ResponseQuestions Where dr.QuestionID = CurrentSurveyQuestionID AndAlso dr.AnswerValue.ToLower.Contains("other") AndAlso dr.OptionID = so.ID Select dr).ToList()
                                    End If

                                    Count += rqListID.Count()
                                End If

                                Count += rqList.Count()
                            Next

                            Dim Percentage As Decimal = 0
                            If TotalClicks > 0 Then Percentage = Math.Round(((100 / TotalClicks) * Count), 1)
                            Dim WidthValue As Decimal = Percentage * 3

                            ResponseValue = Count.ToString() & " / " & Percentage.ToString() & "%"

                        End If

                        cell = New PdfPCell(New iTextSharp.text.Phrase(ResponseValue, Arial))
                        cell.Padding = 5
                        cell.BorderWidth = 0
                        If (OptionCount Mod 2) <> 0 Then cell.BackgroundColor = New iTextSharp.text.BaseColor(237, 237, 237)
                        GraphValuesTable.AddCell(cell)

                        '# Check to see if we need to show response answers (for 'other' questions)
                        If IncludeComments Then

                            If Count > 0 Then

                                Dim ShowResponseAnswers As Boolean = False
                                Dim OtherOptions = (From dr In so.Properties Where dr.Key.ToLower().Contains("other") AndAlso dr.Value = "1" Select dr).ToList()
                                If OtherOptions IsNot Nothing AndAlso OtherOptions.Count() > 0 Then ShowResponseAnswers = True

                                If ShowResponseAnswers Then
                                    cell = New PdfPCell(GetResponseValuesTable(CurrentSurvey, CurrentSurveyQuestion, so.ID))
                                    cell.Padding = 5
                                    cell.BorderWidth = 0
                                    cell.Colspan = 2
                                    GraphValuesTable.AddCell(cell)
                                End If

                            End If
                        End If

                        OptionCount += 1

                    Next

                    '# Total clicks
                    GraphValuesTable.AddCell(GetTotalValuesTitleCell("TOTAL CLICKS", 7))
                    GraphValuesTable.AddCell(GetTotalValuesCell(TotalClicks, 7))

                    '# Total clicks
                    GraphValuesTable.AddCell(GetTotalValuesTitleCell("TOTAL RESPONSES"))
                    GraphValuesTable.AddCell(GetTotalValuesCell(TotalResponses, 2))

                    '# Add to page
                    cell = New PdfPCell(GraphValuesTable)
                    cell.Padding = 0.0F
                    cell.BorderWidth = 0
                    cell.BorderWidthRight = 1.0F
                    cell.BorderColorRight = New iTextSharp.text.BaseColor(0, 70, 122)
                    Table.AddCell(cell)

                    '# Graph
                    Dim PageFilePath As String = "~/App_Data/Img/" & CurrentSurvey.ID.ToString() & "/"
                    Dim FileExists As Boolean = File.Exists(HttpContext.Current.Server.MapPath(PageFilePath & CurrentSurveyQuestionID & ".jpg"))

                    If FileExists AndAlso TotalResponses > 0 Then
                        Dim GraphImage = iTextSharp.text.Image.GetInstance(HttpContext.Current.Server.MapPath(PageFilePath & CurrentSurveyQuestionID & ".jpg"))

                        Dim h As Single = GraphImage.Height
                        Dim w As Single = GraphImage.Width

                        'GraphImage.ScalePercent(80.0F)
                        Dim h1 As Single = GraphImage.ScaledHeight
                        Dim w1 As Single = GraphImage.ScaledWidth
                        'GraphImage.SetAbsolutePosition(27.0F, 535.0F)
                        'GraphImage.Border = iTextSharp.text.Rectangle.LEFT_BORDER
                        'GraphImage.BorderColor = New iTextSharp.text.BaseColor(0, 70, 122)
                        'GraphImage.BorderWidth = 1.0F
                        GraphImage.Alignment = iTextSharp.text.Image.ALIGN_JUSTIFIED
                        Dim d As Integer = GraphImage.DpiX
                        Dim e As Integer = GraphImage.DpiY
                        GraphImage.SetDpi(300, 300)
                        'GraphImage.ScaleToFit(100.0F, 100.0F)

                        'GraphImage.ScaleAbsolute(12.0F, 12.0F)
                        Dim GraphImageTable = New PdfPTable(1)
                        GraphImageTable.SplitLate = True
                        GraphImageTable.DefaultCell.Border = 0.0F

                        Dim ImageCell = New PdfPCell(GraphImage)
                        ImageCell.Padding = 2
                        ImageCell.BorderWidth = 0.0F
                        ImageCell.HorizontalAlignment = iTextSharp.text.Element.ALIGN_CENTER
                        GraphImageTable.AddCell(ImageCell)

                        '# Add to page
                        cell = New PdfPCell(GraphImageTable)
                        cell.Padding = 2
                        cell.BorderWidth = 0
                        Table.AddCell(cell)
                    Else

                        Dim EmptyCell As PdfPCell = New PdfPCell(New iTextSharp.text.Phrase(" ", Arial))
                        EmptyCell.BorderWidth = 0
                        EmptyCell.Padding = 2

                        '# Add to page
                        cell = New PdfPCell(EmptyCell)
                        cell.Padding = 2
                        cell.BorderWidth = 0
                        Table.AddCell(cell)

                    End If


                Case "table"

                    '# Load possible options
                    Dim TableValuesTable = New PdfPTable(CurrentSurveyQuestion.Options.Count() + 4)
                    TableValuesTable.DefaultCell.Border = 0.0F
                    TableValuesTable.SplitLate = True

                    Dim TableCell As PdfPCell = New PdfPCell(New iTextSharp.text.Phrase(" ", Arial))
                    TableCell.BorderWidth = 0
                    TableCell.Padding = 5
                    TableCell.Colspan = 2
                    TableCell.HorizontalAlignment = iTextSharp.text.Element.ALIGN_CENTER
                    TableValuesTable.AddCell(TableCell)

                    For Each so As SurveyOption In CurrentSurveyQuestion.Options
                        TableCell = New PdfPCell(New iTextSharp.text.Phrase(so.Title, Arial))
                        TableCell.BorderWidth = 0
                        TableCell.Padding = 5
                        TableCell.HorizontalAlignment = iTextSharp.text.Element.ALIGN_CENTER
                        TableValuesTable.AddCell(TableCell)
                    Next

                    TableCell = New PdfPCell(New iTextSharp.text.Phrase("Total Responses", Arial))
                    TableCell.BorderWidth = 0
                    TableCell.Padding = 5
                    TableCell.HorizontalAlignment = iTextSharp.text.Element.ALIGN_CENTER
                    TableCell.BorderWidthLeft = 1.0F
                    TableCell.BorderColorLeft = New iTextSharp.text.BaseColor(0, 70, 122)
                    TableValuesTable.AddCell(TableCell)

                    TableCell = New PdfPCell(New iTextSharp.text.Phrase("Not Answered", Arial))
                    TableCell.BorderWidth = 0
                    TableCell.Padding = 5
                    TableCell.HorizontalAlignment = iTextSharp.text.Element.ALIGN_CENTER
                    TableValuesTable.AddCell(TableCell)

                    Dim RowCount As Integer = 0
                    For Each sq As SurveyQuestion In CurrentSurveyQuestion.SubQuestions

                        '# Clear values
                        TotalResponses = 0
                        TotalClicks = 0

                        '# Answer Option
                        TableCell = New PdfPCell(New iTextSharp.text.Phrase(sq.Title, Arial))
                        TableCell.Padding = 5
                        TableCell.BorderWidth = 0
                        TableCell.Colspan = 2
                        If (RowCount Mod 2) <> 0 Then TableCell.BackgroundColor = New iTextSharp.text.BaseColor(237, 237, 237)
                        TableValuesTable.AddCell(TableCell)

                        Dim ResponseItems As List(Of SurveyResponse) = CurrentResponses
                        Dim QuestionsResponses As New List(Of KeyValuePair(Of Integer, SurveyResponseQuestion))
                        For Each ri As SurveyResponse In ResponseItems
                            For Each rq As SurveyResponseQuestion In ri.ResponseQuestions
                                If rq.QuestionID = sq.ID Then
                                    Dim Result As New KeyValuePair(Of Integer, SurveyResponseQuestion)(ri.ResponseID, rq)
                                    QuestionsResponses.Add(Result)
                                End If
                            Next

                            Dim ResultList = (From dr In ri.ResponseQuestions Where dr.QuestionID = sq.ID AndAlso Not String.IsNullOrEmpty(dr.AnswerValue) Select dr).ToList()

                            If ResultList.Count > 0 Then
                                TotalResponses += 1
                                TotalClicks += ResultList.Count()
                            End If

                        Next

                        '# Answer Responses
                        For Each so As SurveyOption In sq.Options

                            Dim Count As Integer = 0

                            '# Survey responses
                            Dim SurveyResponseQuestions As New List(Of SurveyResponseQuestion)
                            For Each ri As SurveyResponse In ResponseItems
                                Dim rqList = (From dr In ri.ResponseQuestions Where dr.QuestionID = so.QuestionID AndAlso dr.AnswerValue = so.Value Select dr).ToList()

                                Dim OtherOption As SurveyOption = Nothing
                                Dim OtherOptions = (From dr In so.Properties Where dr.Key.ToLower().Contains("other") AndAlso dr.Value = "1" Select dr).ToList()
                                If OtherOptions IsNot Nothing AndAlso OtherOptions.Count() > 0 Then OtherOption = so

                                If rqList.Count() <= 0 AndAlso OtherOptions IsNot Nothing AndAlso OtherOptions.Count() > 0 Then

                                    Dim rqListID = (From dr In ri.ResponseQuestions Where dr.QuestionID = so.QuestionID AndAlso dr.AnswerValue.ToLower.Contains("other") AndAlso dr.OptionID = so.ID Select dr).ToList()

                                    Count += rqListID.Count()
                                    For Each rq As SurveyResponseQuestion In ri.ResponseQuestions
                                        If rq.OptionID = so.ID Then
                                            SurveyResponseQuestions.Add(rq)
                                        End If
                                    Next
                                End If

                                Count += rqList.Count()
                            Next

                            Dim Percentage As Decimal = 0
                            If TotalResponses > 0 Then Percentage = Math.Round(((100 / TotalResponses) * Count), 0)

                            Dim ResponseValue As String = Count.ToString() & " / " & Percentage.ToString() & "%"

                            TableCell = New PdfPCell(New iTextSharp.text.Phrase(ResponseValue, ArialBold))
                            TableCell.Padding = 5
                            TableCell.BorderWidth = 0
                            TableCell.HorizontalAlignment = iTextSharp.text.Element.ALIGN_CENTER
                            If (RowCount Mod 2) <> 0 Then TableCell.BackgroundColor = New iTextSharp.text.BaseColor(237, 237, 237)
                            TableValuesTable.AddCell(TableCell)

                        Next

                        '# Total Responses
                        TableCell = New PdfPCell(New iTextSharp.text.Phrase(TotalResponses.ToString(), Arial))
                        TableCell.Padding = 5
                        TableCell.BorderWidth = 0
                        TableCell.BorderWidthLeft = 1.0F
                        TableCell.BorderColorLeft = New iTextSharp.text.BaseColor(0, 70, 122)
                        TableCell.HorizontalAlignment = iTextSharp.text.Element.ALIGN_CENTER
                        If (RowCount Mod 2) <> 0 Then TableCell.BackgroundColor = New iTextSharp.text.BaseColor(237, 237, 237)
                        TableValuesTable.AddCell(TableCell)

                        '# Not Answered
                        TableCell = New PdfPCell(New iTextSharp.text.Phrase("0", Arial))
                        TableCell.Padding = 5
                        TableCell.BorderWidth = 0
                        TableCell.HorizontalAlignment = iTextSharp.text.Element.ALIGN_CENTER
                        If (RowCount Mod 2) <> 0 Then TableCell.BackgroundColor = New iTextSharp.text.BaseColor(237, 237, 237)
                        TableValuesTable.AddCell(TableCell)

                        RowCount += 1

                    Next

                    cell = New PdfPCell(TableValuesTable)
                    'cell.BackgroundColor = New BaseColor(224, 224, 224)
                    cell.Padding = 0.0F
                    cell.Colspan = 2
                    cell.BorderWidth = 0

                    Table.AddCell(cell)


                    'Case "rank"

                    '        '# Load possible rankings
                    '        'Dim RankValues As New List(Of Integer)
                    '        Dim RankValuesTable = New PdfPTable(StatisticItem.Max + 2)
                    '        RankValuesTable.DefaultCell.Border = 0.0F

                    '        Dim RankCell As PdfPCell = New PdfPCell(New iTextSharp.text.Phrase(" ", New iTextSharp.text.Font(iTextSharp.text.Font.FontFamily.HELVETICA, 8)))
                    '        RankCell.BackgroundColor = New iTextSharp.text.BaseColor(224, 224, 224)
                    '        RankCell.BorderWidth = 0.0F
                    '        RankCell.Padding = 5
                    '        RankCell.Colspan = 2
                    '        RankCell.HorizontalAlignment = iTextSharp.text.Element.ALIGN_CENTER

                    '        RankValuesTable.AddCell(RankCell)

                    '        For i As Integer = 1 To CInt(StatisticItem.Max)
                    '            RankCell = New PdfPCell(New iTextSharp.text.Phrase(i.ToString(), New iTextSharp.text.Font(iTextSharp.text.Font.FontFamily.HELVETICA, 8)))
                    '            RankCell.BackgroundColor = New iTextSharp.text.BaseColor(224, 224, 224)
                    '            RankCell.BorderWidth = 1.0F
                    '            RankCell.Padding = 5
                    '            RankCell.HorizontalAlignment = iTextSharp.text.Element.ALIGN_CENTER

                    '            RankValuesTable.AddCell(RankCell)
                    '        Next

                    '        '# Load actual responses
                    '        For Each so In CurrentSurveyQuestion.Options

                    '            '# Answer Option
                    '            RankCell = New PdfPCell(New iTextSharp.text.Phrase(so.Title, New iTextSharp.text.Font(iTextSharp.text.Font.FontFamily.HELVETICA, 8)))
                    '            RankCell.Padding = 5
                    '            RankCell.BorderWidth = 1.0F
                    '            RankCell.Colspan = 2
                    '            RankValuesTable.AddCell(RankCell)

                    '            '# Answer Response
                    '            Dim ResponseID As Integer = 0
                    '            Dim QuestionsResponses As New List(Of KeyValuePair(Of Integer, SurveyResponseQuestion))
                    '            'For Each rq As SurveyResponseQuestion In CurrentSurveyResponse.ResponseQuestions
                    '            '    If rq.QuestionID = CurrentSurveyQuestion.ID Then
                    '            '        Dim Result As New KeyValuePair(Of Integer, SurveyResponseQuestion)(CurrentSurveyResponse.ResponseID, rq)
                    '            '        QuestionsResponses.Add(Result)
                    '            '    End If
                    '            'Next

                    '            Dim FilteredQuestionsResponses = (From dr In QuestionsResponses Where dr.Value.OptionID = so.ID And String.IsNullOrEmpty(dr.Value.AnswerValue) = False Select dr.Value.QuestionID, dr.Value.AnswerValue, CurrentResponseID = dr.Key).ToList()

                    '            '# Load possible answers
                    '            Dim RankValues As New List(Of KeyValuePair(Of Integer, Integer))

                    '            If FilteredQuestionsResponses IsNot Nothing AndAlso FilteredQuestionsResponses.Count() > 0 Then
                    '                For i As Integer = 1 To CInt(CurrentSurveyQuestion.Statistics.Max)
                    '                    Dim ItemsRanked As Integer = (From dr In FilteredQuestionsResponses Where dr.AnswerValue = i.ToString() Select dr).Count()
                    '                    Dim item As New KeyValuePair(Of Integer, Integer)(i, ItemsRanked)

                    '                    RankValues.Add(item)
                    '                Next
                    '            End If

                    '            For Each rv As KeyValuePair(Of Integer, Integer) In RankValues
                    '                If rv.Value > 0 Then
                    '                    Dim CheckImage = iTextSharp.text.Image.GetInstance(CheckImageURL)
                    '                    CheckImage.ScaleAbsolute(12.0F, 12.0F)
                    '                    Dim CheckedItemTable = New PdfPTable(1)
                    '                    CheckedItemTable.DefaultCell.Border = 0.0F

                    '                    Dim ImageCell = New PdfPCell(CheckImage)
                    '                    ImageCell.BorderWidth = 0.0F
                    '                    ImageCell.HorizontalAlignment = iTextSharp.text.Element.ALIGN_CENTER

                    '                    CheckedItemTable.AddCell(ImageCell)

                    '                    RankCell = New PdfPCell(CheckedItemTable)
                    '                    RankCell.Padding = 5
                    '                    RankCell.BorderWidth = 1.0F

                    '                    RankValuesTable.AddCell(RankCell)

                    '                Else
                    '                    RankCell = New PdfPCell(New iTextSharp.text.Phrase(" ", New iTextSharp.text.Font(iTextSharp.text.Font.FontFamily.HELVETICA, 8)))
                    '                    RankCell.Padding = 5
                    '                    RankCell.BorderWidth = 1.0F
                    '                    RankValuesTable.AddCell(RankCell)
                    '                End If
                    '            Next

                    '        Next

                    '        cell = New PdfPCell(RankValuesTable)
                    '        'cell.BackgroundColor = New BaseColor(224, 224, 224)
                    '        cell.Padding = 0.0F
                    '        cell.Colspan = 2
                    '        cell.BorderWidth = 1.0F

                    '        Table.AddCell(cell)

                Case "multi_textbox"

                    '# Check to see if we need to show response answers (for 'other' questions)
                    If IncludeComments Then

                        Dim MultiValuesTable = New PdfPTable(CurrentSurveyQuestion.Options.Count() + 2)
                        MultiValuesTable.SplitLate = True
                        MultiValuesTable.DefaultCell.Border = 0.0F

                        Dim TableWidth As Single = MultiValuesTable.TotalWidth

                        Dim WidthsList As New List(Of Single)
                        WidthsList.Add(1)
                        WidthsList.Add(1)

                        Dim OptionsWidth As Decimal = (7 / CurrentSurveyQuestion.Options.Count())

                        For Each so As SurveyOption In CurrentSurveyQuestion.Options
                            WidthsList.Add(OptionsWidth)
                        Next

                        Dim widths As Single() = WidthsList.ToArray()

                        MultiValuesTable.SetWidths(widths)

                        'Dim widths As Single() = New Single() {1.5F, 1.0F}
                        'MultiValuesTable.SetWidths(widths)

                        '# Title Row
                        Dim TableCell As PdfPCell = New PdfPCell(New iTextSharp.text.Phrase("Result Set:", Arial))
                        TableCell.Padding = 5
                        TableCell.PaddingBottom = 8
                        TableCell.BorderWidth = 0
                        MultiValuesTable.AddCell(TableCell)

                        TableCell = New PdfPCell(New iTextSharp.text.Phrase("Response ID:", Arial))
                        TableCell.Padding = 5
                        TableCell.PaddingBottom = 8
                        TableCell.BorderWidth = 0
                        MultiValuesTable.AddCell(TableCell)

                        '# Bind options - question titles
                        Dim Options = (From dr In CurrentSurveyQuestion.Options Order By dr.ID Select dr).ToList()
                        For Each so As SurveyOption In Options
                            TableCell = New PdfPCell(New iTextSharp.text.Phrase(so.Value & ":", Arial))
                            TableCell.Padding = 5
                            TableCell.PaddingBottom = 8
                            TableCell.BorderWidth = 0
                            MultiValuesTable.AddCell(TableCell)
                        Next

                        '# Filter out the responses
                        Dim ResponseItems As List(Of SurveyResponse) = CurrentResponses
                        Dim QuestionsResponses As New List(Of KeyValuePair(Of Integer, SurveyResponseQuestion))

                        For Each ri As SurveyResponse In ResponseItems
                            '# Get the questions from the responses that match the current survey question
                            For Each rq As SurveyResponseQuestion In ri.ResponseQuestions
                                If rq.QuestionID = CurrentSurveyQuestion.ID Then
                                    Dim Result As New KeyValuePair(Of Integer, SurveyResponseQuestion)(ri.ResponseID, rq)
                                    QuestionsResponses.Add(Result)
                                End If
                            Next
                        Next

                        Dim FilteredQuestionsResponses = (From dr In QuestionsResponses Where String.IsNullOrEmpty(dr.Value.AnswerValue) = False Select New MultiTextBoxGroup(dr.Value.QuestionID, CurrentSurveyQuestion.Title, dr.Key)).Distinct.ToList()
                        Dim FilteredQuestionsResponsesDistinct As New List(Of MultiTextBoxGroup)

                        For Each mtg In FilteredQuestionsResponses
                            Dim FilterRecordMatch As MultiTextBoxGroup = (From dr In FilteredQuestionsResponsesDistinct Where dr.QuestionID = mtg.QuestionID AndAlso dr.CurrentResponseID = mtg.CurrentResponseID Select dr).FirstOrDefault()
                            If FilterRecordMatch Is Nothing Then FilteredQuestionsResponsesDistinct.Add(mtg)
                        Next

                        '# Now get each question within the response question
                        For Each mtg In FilteredQuestionsResponsesDistinct
                            Dim MultiTextBoxAnswers = (From dr In QuestionsResponses Where dr.Key = mtg.CurrentResponseID AndAlso dr.Value.QuestionID = mtg.QuestionID Order By dr.Value.OptionID Select New MultiTextBoxValue(dr.Value.OptionID, GetOptionTitle(CurrentSurveyQuestion.Options, dr.Value.OptionID), dr.Value.AnswerValue)).ToList()
                            mtg.SetAnswerValues(MultiTextBoxAnswers)
                        Next

                        Dim OptionCount As Integer = 0
                        For Each mtg In FilteredQuestionsResponsesDistinct

                            TableCell = New PdfPCell(New iTextSharp.text.Phrase(OptionCount + 1, Arial))
                            TableCell.Padding = 5
                            TableCell.BorderWidth = 0
                            If (OptionCount Mod 2) <> 0 Then TableCell.BackgroundColor = New iTextSharp.text.BaseColor(237, 237, 237)
                            MultiValuesTable.AddCell(TableCell)

                            TableCell = New PdfPCell(New iTextSharp.text.Phrase(mtg.CurrentResponseID, Arial))
                            TableCell.Padding = 5
                            TableCell.BorderWidth = 0
                            If (OptionCount Mod 2) <> 0 Then TableCell.BackgroundColor = New iTextSharp.text.BaseColor(237, 237, 237)
                            MultiValuesTable.AddCell(TableCell)

                            For Each av In mtg.AnswerValues
                                TableCell = New PdfPCell(New iTextSharp.text.Phrase(av.AnswerValue, Arial))
                                TableCell.Padding = 5
                                TableCell.BorderWidth = 0
                                If (OptionCount Mod 2) <> 0 Then TableCell.BackgroundColor = New iTextSharp.text.BaseColor(237, 237, 237)
                                MultiValuesTable.AddCell(TableCell)
                            Next

                            OptionCount += 1
                        Next

                        cell = New PdfPCell(MultiValuesTable)
                        'cell.BackgroundColor = New BaseColor(224, 224, 224)
                        cell.Padding = 0.0F
                        cell.Colspan = 2
                        cell.BorderWidth = 0

                        Table.AddCell(cell)
                    Else
                        cell = New PdfPCell(New iTextSharp.text.Phrase(""))
                        cell.BackgroundColor = iTextSharp.text.BaseColor.WHITE
                        cell.Padding = 5
                        cell.BorderWidth = 0.0F
                        cell.Colspan = TitleWidth
                        Table.AddCell(cell)
                    End If

                Case "number"

                    '# Answer Response
                    Dim ResponseItems As List(Of SurveyResponse) = CurrentResponses
                    Dim QuestionsResponses As New List(Of KeyValuePair(Of Integer, SurveyResponseQuestion))

                    For Each ri As SurveyResponse In ResponseItems
                        '# Get the questions from the responses that match the current survey question
                        For Each rq As SurveyResponseQuestion In ri.ResponseQuestions
                            If rq.QuestionID = CurrentSurveyQuestion.ID AndAlso Not String.IsNullOrEmpty(rq.AnswerValue) Then
                                Dim Result As New KeyValuePair(Of Integer, SurveyResponseQuestion)(ri.ResponseID, rq)
                                QuestionsResponses.Add(Result)
                            End If
                        Next
                    Next

                    '# Calculate values
                    Dim TotalQuestionsResponses As Integer = 0

                    '# Mean
                    Dim MeanTotal As Decimal = 0D
                    For Each res In QuestionsResponses
                        Dim LocalValue As Decimal = 0D
                        Decimal.TryParse(res.Value.AnswerValue, LocalValue)
                        If LocalValue > 0D Then
                            MeanTotal += LocalValue
                            TotalQuestionsResponses += 1
                        End If
                    Next

                    Dim AverageMeanText As String = "N/A"
                    If TotalQuestionsResponses > 0 AndAlso MeanTotal > 0 Then
                        Dim MeanAverage As Decimal = (MeanTotal / TotalQuestionsResponses)
                        AverageMeanText = MeanAverage.ToString("#,##0.00")
                    End If

                    '# Total amounts
                    Table.AddCell(GetTotalValuesTitleCell("MEAN", 3, 1))
                    Table.AddCell(GetTotalValuesCellStr(AverageMeanText, 1))

                    '# Total clicks
                    Table.AddCell(GetTotalValuesTitleCell("TOTAL CLICKS", 7))
                    Table.AddCell(GetTotalValuesCell(TotalClicks, 7))

                    '# Total clicks
                    Table.AddCell(GetTotalValuesTitleCell("TOTAL RESPONSES"))
                    Table.AddCell(GetTotalValuesCell(TotalResponses, 2))

                Case Else
                    '# textbox, essay

                    'Dim TextValuesTable = New PdfPTable(3)
                    'TextValuesTable.SplitLate = True
                    'TextValuesTable.DefaultCell.Border = 0.0F

                    'Dim widths As Single() = New Single() {1, 1, 9.0F}
                    'TextValuesTable.SetWidths(widths)

                    'Dim TableWidth As Single = TextValuesTable.TotalWidth

                    '# Answer Response
                    Dim ResponseItems As List(Of SurveyResponse) = CurrentResponses
                    Dim QuestionsResponses As New List(Of KeyValuePair(Of Integer, SurveyResponseQuestion))

                    For Each ri As SurveyResponse In ResponseItems
                        '# Get the questions from the responses that match the current survey question
                        For Each rq As SurveyResponseQuestion In ri.ResponseQuestions
                            If rq.QuestionID = CurrentSurveyQuestion.ID AndAlso Not String.IsNullOrEmpty(rq.AnswerValue) Then
                                Dim Result As New KeyValuePair(Of Integer, SurveyResponseQuestion)(ri.ResponseID, rq)
                                QuestionsResponses.Add(Result)
                            End If
                        Next
                    Next

                    Dim FilteredQuestionsResponses As New List(Of PlainTextValue)

                    Select Case CurrentSurveyQuestion.SubType
                        Case "radio", "checkbox", "menu"
                            '# Filter to ones with answers
                            FilteredQuestionsResponses = (From dr In QuestionsResponses Where dr.Value.AnswerValue.Contains("Other") Select New PlainTextValue(dr.Value.QuestionID, CurrentSurveyQuestion.Title, dr.Value.AnswerValue.Replace("Other: ", ""), dr.Key)).ToList()
                        Case Else
                            '# Filter to ones with answers
                            FilteredQuestionsResponses = (From dr In QuestionsResponses Where String.IsNullOrEmpty(dr.Value.AnswerValue) = False Select New PlainTextValue(dr.Value.QuestionID, CurrentSurveyQuestion.Title, dr.Value.AnswerValue, dr.Key)).ToList()
                    End Select

                    If IncludeComments Then

                        '# Title Row
                        cell = New PdfPCell(New iTextSharp.text.Phrase("Result Set:", Arial))
                        cell.Padding = 5
                        cell.PaddingBottom = 8
                        cell.BorderWidth = 0
                        Table.AddCell(cell)

                        cell = New PdfPCell(New iTextSharp.text.Phrase("Response ID:", Arial))
                        cell.Padding = 5
                        cell.PaddingBottom = 8
                        cell.BorderWidth = 0
                        Table.AddCell(cell)

                        cell = New PdfPCell(New iTextSharp.text.Phrase("Answers:", Arial))
                        cell.Padding = 5
                        cell.PaddingBottom = 8
                        cell.BorderWidth = 0
                        Table.AddCell(cell)

                        Dim ResponsesOptionCount As Integer = 0
                        For Each FilteredQuestionsResponse In FilteredQuestionsResponses
                            With FilteredQuestionsResponse

                                cell = New PdfPCell(New iTextSharp.text.Phrase(ResponsesOptionCount + 1, Arial))
                                cell.Padding = 5
                                cell.BorderWidth = 0
                                If (ResponsesOptionCount Mod 2) <> 0 Then cell.BackgroundColor = New iTextSharp.text.BaseColor(237, 237, 237)
                                Table.AddCell(cell)

                                cell = New PdfPCell(New iTextSharp.text.Phrase(.CurrentResponseID, Arial))
                                cell.Padding = 5
                                cell.BorderWidth = 0
                                If (ResponsesOptionCount Mod 2) <> 0 Then cell.BackgroundColor = New iTextSharp.text.BaseColor(237, 237, 237)
                                Table.AddCell(cell)

                                cell = New PdfPCell(New iTextSharp.text.Phrase(.AnswerValue, Arial))
                                cell.Padding = 5
                                cell.BorderWidth = 0
                                If (ResponsesOptionCount Mod 2) <> 0 Then cell.BackgroundColor = New iTextSharp.text.BaseColor(237, 237, 237)
                                Table.AddCell(cell)

                                ResponsesOptionCount += 1
                            End With
                        Next

                    End If

                    'cell = New PdfPCell(TextValuesTable)
                    ''cell.BackgroundColor = New BaseColor(224, 224, 224)
                    'cell.Padding = 0.0F
                    'cell.Colspan = 2
                    'cell.BorderWidth = 0
                    'Table.AddCell(cell)

                    '# Total responses
                    Table.AddCell(GetTotalValuesTitleCell("TOTAL RESPONSES", 3, 3))
                    Table.AddCell(GetTotalValuesCell(FilteredQuestionsResponses.Count(), 3))

            End Select

            '# Divider
            cell = New PdfPCell()
            cell.Padding = 10
            cell.Colspan = TitleWidth
            cell.BorderWidth = 0.0F
            cell.BorderWidthBottom = 1.0F
            cell.BorderColorBottom = New iTextSharp.text.BaseColor(0, 70, 122)
            Table.AddCell(cell)

            Return Table

        End Function

        Public Shared Function GetTotalValuesTitleCell(Title As String, Optional TopPaddingAmount As Integer = 3, Optional Colspan As Integer = 1) As PdfPCell

            Dim ArialLargeBold As iTextSharp.text.Font = iTextSharp.text.FontFactory.GetFont(iTextSharp.text.FontFactory.HELVETICA_BOLD)
            ArialLargeBold.Size = 7
            ArialLargeBold.SetColor(21, 21, 21)

            Dim cell As PdfPCell = New PdfPCell(New iTextSharp.text.Phrase(Title, ArialLargeBold))
            cell.BackgroundColor = iTextSharp.text.BaseColor.WHITE
            cell.Padding = 5
            cell.PaddingTop = TopPaddingAmount
            cell.BorderWidth = 0.0F
            cell.Colspan = Colspan

            Return cell

        End Function

        Public Shared Function GetTotalValuesCell(ClickValue As Integer, Colspan As Integer, Optional TopPaddingAmount As Integer = 3) As PdfPCell

            Dim ArialLarge As iTextSharp.text.Font = iTextSharp.text.FontFactory.GetFont(iTextSharp.text.FontFactory.HELVETICA)
            ArialLarge.Size = 7
            ArialLarge.SetColor(21, 21, 21)

            Dim cell As PdfPCell = New PdfPCell(New iTextSharp.text.Phrase(ClickValue.ToString(), ArialLarge))
            cell.BackgroundColor = iTextSharp.text.BaseColor.WHITE
            cell.Padding = 5
            cell.Colspan = Colspan
            cell.PaddingTop = TopPaddingAmount
            cell.BorderWidth = 0.0F

            Return cell

        End Function

        Public Shared Function GetTotalValuesCellStr(ClickValue As String, Colspan As Integer, Optional TopPaddingAmount As Integer = 3) As PdfPCell

            Dim ArialLarge As iTextSharp.text.Font = iTextSharp.text.FontFactory.GetFont(iTextSharp.text.FontFactory.HELVETICA)
            ArialLarge.Size = 7
            ArialLarge.SetColor(21, 21, 21)

            Dim cell As PdfPCell = New PdfPCell(New iTextSharp.text.Phrase(ClickValue, ArialLarge))
            cell.BackgroundColor = iTextSharp.text.BaseColor.WHITE
            cell.Padding = 5
            cell.Colspan = Colspan
            cell.PaddingTop = TopPaddingAmount
            cell.BorderWidth = 0.0F

            Return cell

        End Function

        Public Shared Function GetResponseValuesTable(CurrentSurvey As Survey, CurrentSurveyQuestion As SurveyQuestion, OptionID As String) As PdfPTable

            Dim Arial As iTextSharp.text.Font = iTextSharp.text.FontFactory.GetFont(iTextSharp.text.FontFactory.HELVETICA)
            Arial.Size = 7
            Arial.SetColor(21, 21, 21)

            '# View responses
            Dim ResponsesTable As PdfPTable = New PdfPTable(2)
            ResponsesTable.SplitLate = True

            '# Get responses
            Dim ResponseItems As List(Of SurveyResponse) = CurrentSurvey.Responses
            Dim QuestionsResponses As New List(Of KeyValuePair(Of Integer, SurveyResponseQuestion))

            For Each ri As SurveyResponse In ResponseItems
                '# Get the questions from the responses that match the current survey question
                For Each rq As SurveyResponseQuestion In ri.ResponseQuestions
                    If rq.QuestionID = CurrentSurveyQuestion.ID AndAlso Not String.IsNullOrEmpty(rq.AnswerValue) Then
                        Dim Result As New KeyValuePair(Of Integer, SurveyResponseQuestion)(ri.ResponseID, rq)
                        QuestionsResponses.Add(Result)
                    End If
                Next
            Next

            Dim FilteredQuestionsResponses = (From dr In QuestionsResponses Where dr.Value.AnswerValue.Contains("Other") AndAlso dr.Value.OptionID = OptionID Select AnswerValue = dr.Value.AnswerValue.Replace("Other: ", ""), CurrentResponseID = dr.Key).ToList()

            If FilteredQuestionsResponses IsNot Nothing AndAlso FilteredQuestionsResponses.Count > 0 Then

                '# Divider
                Dim cell As PdfPCell = New PdfPCell()
                cell.Padding = 2
                cell.Colspan = 2
                cell.BorderWidth = 0.0F
                cell.BorderWidthTop = 0.5F
                cell.BorderColorTop = New iTextSharp.text.BaseColor(0, 70, 122)
                ResponsesTable.AddCell(cell)

                '# Title Row
                cell = New PdfPCell(New iTextSharp.text.Phrase("Answers:", Arial))
                cell.Padding = 5
                cell.BorderWidth = 0
                ResponsesTable.AddCell(cell)

                cell = New PdfPCell(New iTextSharp.text.Phrase("Result Set:", Arial))
                cell.Padding = 5
                cell.BorderWidth = 0
                ResponsesTable.AddCell(cell)

                Dim ResponsesOptionCount As Integer = 0
                For Each FilteredQuestionsResponse In FilteredQuestionsResponses
                    With FilteredQuestionsResponse
                        If Not String.IsNullOrEmpty(.AnswerValue) Then
                            cell = New PdfPCell(New iTextSharp.text.Phrase(.AnswerValue, Arial))
                            cell.Padding = 5
                            cell.BorderWidth = 0
                            If (ResponsesOptionCount Mod 2) <> 0 Then cell.BackgroundColor = New iTextSharp.text.BaseColor(237, 237, 237)
                            ResponsesTable.AddCell(cell)

                            cell = New PdfPCell(New iTextSharp.text.Phrase(.CurrentResponseID, Arial))
                            cell.Padding = 5
                            cell.BorderWidth = 0
                            If (ResponsesOptionCount Mod 2) <> 0 Then cell.BackgroundColor = New iTextSharp.text.BaseColor(237, 237, 237)
                            ResponsesTable.AddCell(cell)

                            ResponsesOptionCount += 1
                        End If
                    End With
                Next

                '# Divider
                cell = New PdfPCell()
                cell.Padding = 2
                cell.Colspan = 2
                cell.BorderWidth = 0.0F
                cell.BorderWidthBottom = 0.5F
                cell.BorderColorBottom = New iTextSharp.text.BaseColor(0, 70, 122)
                ResponsesTable.AddCell(cell)

            End If

            Return ResponsesTable

        End Function

#Region "Formatting"
        Public Shared Function FormatExportDate(DateSubmitted As Date, Optional showtime As Boolean = False) As String
            Try
                Return GlobalMethods.FormatDateTime(DateSubmitted, "HH:mm d", True) & DateSubmitted.ToString(" MMM yyyy")
            Catch ex As Exception
                Return "empty"
            End Try
        End Function

        Public Shared Function FormatExportDateFilter(DateSubmitted As Date) As String
            Try
                Return GlobalMethods.FormatDateTime(DateSubmitted, " d", True) & DateSubmitted.ToString(" MMMM yyyy")
            Catch ex As Exception
                Return "empty"
            End Try
        End Function

        Public Shared Function GetOptionTitle(Options As List(Of SurveyOption), OptionID As String) As String
            Dim OptionTitle As String = (From dr In Options Where dr.ID = OptionID Select dr.Title).FirstOrDefault()
            If String.IsNullOrEmpty(OptionTitle) Then OptionTitle = "Question Answer"
            Return OptionTitle
        End Function
#End Region

#Region "Validation"
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

#End Region

#Region "Classes"
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
#End Region

#End Region

        Public Class itsEvents
            Inherits PdfPageEventHelper
            Public Overrides Sub OnEndPage(ByVal writer As PdfWriter, ByVal doc As Document)
                Dim bf As BaseFont = BaseFont.CreateFont(BaseFont.HELVETICA, BaseFont.CP1252, BaseFont.NOT_EMBEDDED)

                '# Copyright
                Dim cb As PdfContentByte = writer.DirectContent
                cb.BeginText()
                cb.SetFontAndSize(bf, 6)
                cb.SetColorFill(New iTextSharp.text.BaseColor(107, 107, 107))
                cb.SetTextMatrix(50, 30)
                cb.ShowText("© " & Now.Year.ToString() & " BluSky Marketing Limited - http://www.bluskymarketing.com/hotel-guest-experience-surveys")
                cb.EndText()

                '# Page number
                Dim PageNumber As Integer = writer.PageNumber
                Dim RightMargin As Single = (doc.PageSize.Width - doc.RightMargin) - 50

                Dim pgCb As PdfContentByte = writer.DirectContent
                pgCb.BeginText()
                pgCb.SetFontAndSize(bf, 7)
                cb.SetColorFill(New iTextSharp.text.BaseColor(107, 107, 107))
                pgCb.SetTextMatrix(RightMargin, 30)
                pgCb.ShowText("Page " & PageNumber.ToString())
                pgCb.EndText()
            End Sub
        End Class

#Region "Formatting"
        Public Shared Function FormatPrice(ByVal p As Decimal, Optional ByVal ZeroPriceText As String = "") As String
            If p <= 0D Then
                If Not String.IsNullOrEmpty(ZeroPriceText) Then
                    Return ZeroPriceText
                Else
                    Return p.ToString("f2")
                End If
            Else
                Return p.ToString("f2")
            End If
        End Function

        Public Shared Function CompletedStatus(Status As String) As String
            Select Case Status
                Case "Complete"
                    Return "Yes"
                Case Else
                    Return "No"
            End Select
        End Function

        Public Shared Function FormatDate(DateSubmitted As Date, Optional showtime As Boolean = False) As String
            Try
                Return GlobalMethods.FormatDateTime(DateSubmitted, "HH:mm d", True) & DateSubmitted.ToString(" MMM yyyy")
            Catch ex As Exception
                Return "empty"
            End Try
        End Function

#End Region

#Region "Validation"

        Public Shared Function CheckFileExists(ByVal FileFullPath As String) As Boolean

            '# Check if we have a ~ in the folder path
            If Not FileFullPath.StartsWith("~") Then FileFullPath = "~" & FileFullPath
            Dim NewFile As Boolean = False

            Try
                Dim f As New FileInfo(HttpContext.Current.Server.MapPath(FileFullPath))

                '# If we have the file delete it
                If f.Exists Then DeleteFile(FileFullPath)

                '# If we don't have the file then create it
                Dim fs As New FileStream(HttpContext.Current.Server.MapPath(FileFullPath), FileMode.Create)
                fs.Flush()
                fs.Close()
                NewFile = True

                Return NewFile

            Catch ex As Exception
                Throw ex
                Return NewFile
            End Try

        End Function

        Public Shared Function DeleteFile(ByVal FileFullPath As String) As Boolean

            '# Check if we have a ~ in the folder path
            If Not FileFullPath.StartsWith("~") Then FileFullPath = "~" & FileFullPath

            Try
                Dim f As New FileInfo(HttpContext.Current.Server.MapPath(FileFullPath))
                f.Delete()

                Return True
            Catch ex As Exception
                Throw ex
                Return False
            End Try

        End Function

        Public Shared Function GetFileCreationDate(ByVal FileFullPath As String) As Date

            '# Check if we have a ~ in the folder path
            If Not FileFullPath.StartsWith("~") Then FileFullPath = "~" & FileFullPath
            Dim FileExpired As Boolean = False

            Try
                Dim f As New FileInfo(HttpContext.Current.Server.MapPath(FileFullPath))

                Return f.LastWriteTime

            Catch ex As Exception
                Throw ex
                Return New Date(1001, 1, 1)
            End Try

        End Function

#End Region

    End Class


End Namespace

