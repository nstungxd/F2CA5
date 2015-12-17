Imports Microsoft.VisualBasic
Imports PingCore
Imports System.Data
Imports System.IO
Imports System
Imports System.Globalization

Namespace PingLibrary

    Public Class GlobalMethods

#Region "User"

#Region "UserLoggedIn"
        Public Shared Function UserLoggedIn(ByVal IdentityControl As PingLibrary.UserControl) As Boolean
            If IdentityControl IsNot Nothing Then
                Return IdentityControl.UserLoggedIn
            Else
                Return 0
            End If
        End Function
#End Region

#Region "CurrentUserID"
        Public Shared Function CurrentUserID(ByVal IdentityControl As UserControl) As Integer
            If IdentityControl IsNot Nothing Then
                Return IdentityControl.CurrentUserID
            Else
                Return 0
            End If
        End Function
#End Region

#Region "CurrentUserTypeID"
        Public Shared Function CurrentUserTypeID(ByVal IdentityControl As UserIdentityControl) As Integer
            If IdentityControl IsNot Nothing Then
                Return IdentityControl.CurrentUserTypeID
            Else
                Return 0
            End If
        End Function
#End Region


#End Region

#Region "Addresses"

        Public Shared Sub BuildAddressString(ByRef TargetString As String, ByVal InputString As String, ByVal Seperator As String)
            If Not String.IsNullOrEmpty(InputString) Then TargetString &= InputString & Seperator
        End Sub

#End Region

#Region "URL Handling"

        Public Shared Function BreakUpURL(ByVal sectionToFind As String) As String

            Dim url As String = HttpContext.Current.Request.RawUrl.ToLower

            If url.Contains(sectionToFind) Then
                Dim str As String = url.Substring(url.IndexOf(sectionToFind))

                str = str.Replace(sectionToFind, "")
                If str.Contains("?") Then str = str.Substring(0, str.IndexOf("?"))
                str = str.Replace(".aspx", "")

                Return str
            Else
                Return String.Empty
            End If

        End Function

#End Region

#Region "Images"
        Public Shared Sub LoadImage(ByVal ImageControl As Image, ByVal ImageFile As String, ByVal ImageToolTip As String, ByVal ImageExt As String, ByVal Size As String, Optional ByVal HideIfNoImg As Boolean = False)

            If HideIfNoImg AndAlso (String.IsNullOrEmpty(ImageFile) OrElse ImageFile = "0") Then
                ImageControl.Visible = False
            Else
                With ImageControl
                    .ImageUrl = "/Media/Images/upload/" & Size & "/" & ImageFile & "." & ImageExt
                    .ToolTip = ImageToolTip
                    .AlternateText = ImageToolTip
                End With
            End If

        End Sub

        Public Shared Function DoesImageFileExist(ByVal ImageID As Integer, ByVal SizeFolder As String, Optional ByVal extension As String = "jpg") As Boolean

            Dim FileExists As Boolean = False

            Try

                '# Build filename
                Dim filename As String = ImageID & "." & extension

                '# Build location string
                Dim filelocation As String = "~/Media/Images/upload/" & SizeFolder & "/" & filename

                If File.Exists(HttpContext.Current.Server.MapPath(filelocation)) Then
                    FileExists = True
                Else
                    FileExists = False
                End If

            Catch ex As Exception
            End Try

            Return FileExists

        End Function
#End Region

#Region "Data Formatting"
        Public Shared Function FormatPrice(ByVal o As Object, Optional ByVal ZeroPriceText As String = "") As String

            Dim p As Decimal = 0D
            Decimal.TryParse(o, p)

            If p <= 0D Then
                If Not String.IsNullOrEmpty(ZeroPriceText) Then
                    Return ZeroPriceText
                Else
                    Return "&pound;" & p.ToString("f2")
                End If
            Else
                Return "&pound;" & p.ToString("f2")
            End If
        End Function

        Public Shared Function FormatPrice(ByVal p As Decimal, Optional ByVal ZeroPriceText As String = "") As String
            If p <= 0D Then
                If Not String.IsNullOrEmpty(ZeroPriceText) Then
                    Return ZeroPriceText
                Else
                    Return "&pound;" & p.ToString("f2")
                End If
            Else
                Return "&pound;" & p.ToString("f2")
            End If
        End Function

        Public Shared Function FormatLongString(ByVal LongString As String, ByVal Length As Integer, ByVal Suffix As String, Optional StripHTMLTags As Boolean = False) As String
            If Not String.IsNullOrEmpty(LongString) AndAlso LongString.Length > 0 Then

                Dim ShortString As String = String.Empty

                If StripHTMLTags Then
                    LongString = StripHTML(LongString)
                End If

                If LongString.Length > Length Then
                    ShortString = LongString.Substring(0, Length) & Suffix
                Else
                    ShortString = LongString
                End If

                Return ShortString

            Else
                Return String.Empty
            End If
        End Function

        Public Shared Function FormatDateTime(ByVal o As Object, ByVal FormatString As String, Optional ByVal IncludeDateSuffix As Boolean = False) As String

            Dim ReturnString As String = ""

            If o IsNot Nothing Then
                '# Try and convert to a date value
                Dim dt As DateTime

                If DateTime.TryParse(o.ToString, dt) Then
                    If IncludeDateSuffix Then
                        Return dt.ToString(FormatString) & GetDateSuffix(dt.Day)
                    Else
                        Return dt.ToString(FormatString)
                    End If
                End If
            End If

            Return ReturnString

        End Function

        Public Shared Function FormatDateTime(ByVal dt As Date, ByVal FormatString As String, Optional ByVal IncludeDateSuffix As Boolean = False) As String

            Dim ReturnString As String = ""

            Try
                If IncludeDateSuffix Then
                    Return dt.ToString(FormatString) & GetDateSuffix(dt.Day)
                Else
                    Return dt.ToString(FormatString)
                End If
            Catch ex As Exception
            End Try

            Return ReturnString

        End Function

        Public Shared Function GetDateSuffix(ByVal day As Integer) As String
            Select Case day
                Case 1, 21, 31
                    Return "st"
                Case 2, 22
                    Return "nd"
                Case 3, 23
                    Return "rd"
                Case Else
                    Return "th"
            End Select
        End Function

        Public Shared Function GetMonthName(Month As Integer) As String
            Return CultureInfo.CurrentCulture.DateTimeFormat.GetMonthName(Month)
        End Function

        Public Shared Function StripHTML(ByVal strHTML As String) As String

            '# Strips the HTML tags from strHTML using split and join

            Try
                '# Ensure that strHTML contains something
                If Len(strHTML) = 0 Then
                    StripHTML = strHTML
                    Exit Function
                End If

                Dim arysplit, i, j, strOutput As Object

                arysplit = Split(strHTML, "<")

                '# Assuming strHTML is nonempty, we want to start iterating
                '# from the 2nd array postition
                If Len(arysplit(0)) > 0 Then j = 1 Else j = 0

                '# Loop through each instance of the array
                For i = j To UBound(arysplit)
                    'Do we find a matching > sign?
                    If InStr(arysplit(i), ">") Then
                        'If so, snip out all the text between the start of the string
                        'and the > sign
                        arysplit(i) = Mid(arysplit(i), InStr(arysplit(i), ">") + 1)
                    Else
                        'Ah, the < was was nonmatching
                        arysplit(i) = "<" & arysplit(i)
                    End If
                Next

                '# Rejoin the array into a single string
                strOutput = Join(arysplit, "")

                '# Snip out the first <
                strOutput = Mid(strOutput, 2 - j)

                '# Convert < and > to &lt; and &gt;
                strOutput = Replace(strOutput, ">", "&gt;")
                strOutput = Replace(strOutput, "<", "&lt;")

                StripHTML = strOutput

            Catch ex As Exception
                Return strHTML
            End Try

        End Function

        Public Shared Function FormatHTMLCodes(InStr As String) As String
            Dim OutStr As String = InStr

            If Not String.IsNullOrEmpty(OutStr) Then
                OutStr = OutStr.Replace("®", "<sup>&reg;</sup>")
                OutStr = OutStr.Replace("©", "<sup>&copy;</sup>")
                OutStr = OutStr.Replace("™", "<sup>&#8482;</sup>")
            End If

            Return OutStr
        End Function
#End Region

#Region "Validation"
        Public Shared Function ValidDateEntered(ByVal inDateStr As String) As Boolean

            Dim DateValid As Boolean = False

            Try
                If inDateStr IsNot Nothing AndAlso Not String.IsNullOrEmpty(inDateStr) AndAlso inDateStr.Length > 0 Then

                    '# Match against regex
                    Dim DateRegex As New Regex("^\d{1,2}\/\d{1,2}\/\d{4}$")
                    Dim DateMatches As Boolean = DateRegex.IsMatch(inDateStr)

                    If DateMatches Then

                        '# Date matches - ensure we have the days and months in the right order
                        '# Try and convert to a date value
                        Dim UkCulture As CultureInfo = New CultureInfo("en-GB")
                        Dim outDateTime As DateTime = DateTime.Parse(inDateStr, UkCulture.DateTimeFormat)

                        Dim inYear As Integer = outDateTime.Year
                        Dim inMonth As Integer = outDateTime.Month
                        Dim inDay As Integer = outDateTime.Day

                        If inYear >= 1900 AndAlso inYear <= Now.Year Then
                            Select Case inMonth
                                Case 2
                                    If inDay <= 29 Then DateValid = True
                                Case 4, 6, 9, 11
                                    If inDay <= 30 Then DateValid = True
                                Case Else
                                    If inDay <= 31 Then DateValid = True
                            End Select
                        End If
                    End If
                End If
            Catch ex As Exception
                DateValid = False
            End Try

            Return DateValid

        End Function
#End Region

#Region "Rewrite Name Stuff"

        Public Shared Function BuildBasicLinkName(ByVal ItemName As String) As String

            '# Transform name to a safe version
            Dim result As String = ""
            result = ItemName.ToLower
            result = Regex.Replace(result, "\s+", "-")
            result = Regex.Replace(result, "[\W+]", "-")
            result = result.Replace("_", "-")

            Return result

        End Function

        Public Shared Function GenerateLinkName(ByVal ItemID As Integer, ByVal NameField As String, ByVal TableName As String, ByVal RewriteNameField As String, ByVal PrimaryKeyField As String) As String

            '# NameField: field that stores name of this item, used to generate the linkname
            '# TableName: name of the table that stores these records
            '# RewriteNameField: name of the field that will store the linkname
            '# PrimaryKeyField: name of the primary key field, used to select the correct record

            Dim sdb As SqlDatabaseConnection = Data.DBConnection()

            '# Get current rewrite name
            Dim CurrentRewriteName As String = DataAccess.GetContentRewriteNameByID(ItemID, TableName, RewriteNameField, PrimaryKeyField)

            '#If Current RewriteName isn't empty we don't need to create one
            If String.IsNullOrEmpty(CurrentRewriteName) Then

                '# Get current name
                Dim CurrentName As String = DataAccess.GetContentName(ItemID, TableName, NameField, PrimaryKeyField)

                '# Transform name to a safe version
                Dim prefix As String = ""
                prefix = CurrentName.ToLower
                prefix = Regex.Replace(prefix, "\s+", "-")
                prefix = Regex.Replace(prefix, "[\W+]", "")
                prefix = prefix.Replace("_", "")

                '# Determine suffix
                Dim result As String = Nothing
                Dim i As Integer = 0
                Do
                    Dim _suffix As String = CType(IIf(i > 0, i.ToString, ""), String)
                    Dim pot As String = prefix & _suffix
                    Dim sql As String = String.Format(String.Concat( _
                     "select cast(1 as bit) as 'success' {0}", _
                     "where exists ({0}", _
                     "  select * {0}", _
                     "  from {1} {0}", _
                     "  where {2} = '{3}')"), _
                     vbCrLf, TableName, RewriteNameField, pot)

                    Dim clashes As Boolean = sdb.GetDataField(Of Boolean)(sql)

                    If Not clashes Then
                        result = pot

                        '# update
                        SetLinkName(ItemID, result, TableName, RewriteNameField, PrimaryKeyField)

                        Exit Do
                    Else
                        i += 1
                    End If
                Loop

                '# all done
                Return result

            Else
                Return CurrentRewriteName
            End If

        End Function

        Public Shared Sub SetLinkName(ByVal ItemID As Integer, ByVal RewriteName As String, ByVal TableName As String, ByVal RewriteNameField As String, ByVal PrimaryKeyField As String)

            '# TableName: name of table with records that are virtual
            '# RewriteNameField: field that will hold the linkname
            '# PrimaryKeyField: the primary key field, used to test against the id so the correct row is selected
            DataLogic.EditContentRewriteName(ItemID, TableName, RewriteNameField, PrimaryKeyField, RewriteName)

        End Sub

#End Region

#Region "Register Input Submission on Enter"

        Public Shared Sub SubmitOnEnterKey(ByVal SourceControl As Control, ByVal SubmitControl As Control)

            Dim Source As WebControl = TryCast(SourceControl, WebControl)

            If Source Is Nothing Then
                Throw New ArgumentException("Unrecognised control-type: " & Source.GetType().ToString(), "source")
            End If

            If TypeOf SubmitControl Is LinkButton Then
                Source.Attributes.Add("onKeyPress", [String].Concat("if ((event.which ? event.which : event.keyCode) == 13) { eval(document.getElementById('", SubmitControl.ClientID, "').getAttribute('href')); }"))
            ElseIf TypeOf SubmitControl Is Button Then
                Source.Attributes.Add("onKeyPress", [String].Concat("if ((event.which ? event.which : event.keyCode) == 13) { eval(document.getElementById('", SubmitControl.ClientID, "').click()); return false; }"))
            Else
                Throw New ArgumentException("Unrecognised control type: " & SubmitControl.GetType().ToString(), "submit")
            End If
        End Sub

#End Region

    End Class

End Namespace
