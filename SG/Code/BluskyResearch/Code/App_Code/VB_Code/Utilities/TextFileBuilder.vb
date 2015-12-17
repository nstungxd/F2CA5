Imports Microsoft.VisualBasic
Imports System.Data
Imports PingLibrary
Imports System.Xml
Imports iTextSharp.text
Imports iTextSharp.text.pdf
Imports System.IO
Imports PingSurveys.SurveyLibrary

Namespace PingUtilities

    Public Class TextFileBuilder

        Const RootFolderPath As String = "/App_Data/Searches/"

        Public Shared Sub SaveTextFile(SurveyID As Integer, FileName As String, FilterList As List(Of SurveyFilter))

            Dim FileLocation As String = ""

            Try

                '# Get the filename info
                Dim PageFilePath As String = RootFolderPath & SurveyID.ToString() & "/"

                '# Set filelocation
                FileLocation = PageFilePath & FileName & ".txt"

                '# Check the folder exists- create folder if it doesn't
                CheckFolderExists(PageFilePath)

                '# Check the file exists- create file if it doesn't
                Dim IsNewFile As Boolean = CheckFileExists(FileLocation)

                '# Only build if this is a new document
                If IsNewFile Then

                    '# Get file location
                    Dim FullFileLocation As String = HttpContext.Current.Server.MapPath("~" & FileLocation)

                    '# Get a StreamWriter class that can be used to write to the file
                    Dim objStreamWriter As StreamWriter = File.AppendText(FullFileLocation)

                    '# Add content
                    Dim Count As Integer = 0
                    For Each sf As SurveyFilter In FilterList
                        If sf IsNot Nothing Then
                            objStreamWriter.WriteLine("[" & CInt(sf.SurveyFilterType).ToString() & "~" & sf.FieldValue & "~" & sf.QuestionTitle & "~" & sf.QuestionOptionID & "~" & sf.QuestionOptionTitle & "~" & sf.FilterValue & "~" & sf.QuestionIndex.ToString() & "~" & sf.OperatorValue & "~" & CInt(sf.Active).ToString() & "]")
                            Count += 1
                        End If
                    Next

                    '# Close the stream
                    objStreamWriter.Close()

                End If

            Catch ioex As IOException
                Throw (ioex)
            Catch ex As Exception
                Throw (ex)
            End Try

        End Sub

        Public Shared Function DeleteTextFile(SurveyID As Integer, FileName As String) As Boolean

            Dim ReturnValue As Boolean = False

            Try

                '# Get file location
                Dim FileLocation As String = RootFolderPath & SurveyID.ToString() & "/" & FileName & ".txt"

                '# Delete file
                ReturnValue = DeleteFile(FileLocation)

            Catch ex As Exception
                Throw ex
            End Try

            Return ReturnValue

        End Function

        Public Shared Function GetTextFileContents(SurveyID As Integer, FileName As String) As String

            Dim TextContent As String = ""

            Try

                '# Get file location
                Dim FileLocation As String = HttpContext.Current.Server.MapPath("~" & RootFolderPath & SurveyID.ToString() & "/" & FileName & ".txt")

                '# Check this file exisits
                Dim TextFile As FileInfo = New FileInfo(FileLocation)

                If TextFile.Exists() Then

                    '# Get a StreamReader class that can be used to read the file
                    Dim objStreamReader As StreamReader
                    objStreamReader = File.OpenText(FileLocation)

                    '# Get the contents of the file
                    Dim FileContent As String = objStreamReader.ReadToEnd()

                    '# Format contents and return
                    TextContent = FileContent.Replace(vbCrLf, "|")
                Else
                    TextContent = ""
                End If

            Catch ex As Exception
                Throw ex
            End Try

            Return TextContent

        End Function

        Public Shared Function GetSavedTextFiles(SurveyID As Integer) As List(Of KeyValuePair(Of String, String))

            Dim ReturnList As New List(Of KeyValuePair(Of String, String))

            Try
                '# Get file location
                Dim FileLocation As String = RootFolderPath & SurveyID.ToString() & "/"

                '# Check the folder exists- create folder if it doesn't
                CheckFolderExists(FileLocation)

                '# Get files in the location
                Dim FileRoot As DirectoryInfo = New DirectoryInfo(HttpContext.Current.Server.MapPath("~" & FileLocation))

                Dim FilesList As FileInfo() = FileRoot.GetFiles()

                For Each f As FileInfo In FilesList
                    Dim NameOfFile As String = f.Name.Replace(".txt", "")
                    ReturnList.Add(New KeyValuePair(Of String, String)(NameOfFile, NameOfFile))
                Next

            Catch ex As Exception
                Throw ex
            End Try

            Return ReturnList

        End Function

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
