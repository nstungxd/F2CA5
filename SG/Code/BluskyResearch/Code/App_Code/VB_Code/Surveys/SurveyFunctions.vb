Option Strict On

Imports System.Net
Imports System.IO
Imports System.Xml
Imports Newtonsoft.Json

Imports System.Text

'# Uses Json.NET - http://james.newtonking.com/pages/json-net.aspx

Namespace PingSurveys
    Public NotInheritable Class SurveyFunctions

#Region "Data"

#Region "IdentityControl"
        Public Shared ReadOnly Property IdentityControl As PingLibrary.UserControl
            Get
                If HttpContext.Current.Session("UserControl") Is Nothing Then HttpContext.Current.Session("UserControl") = New PingLibrary.UserControl()

                '# Get the current survery control class
                Dim UserControl As PingLibrary.UserControl = CType(HttpContext.Current.Session("UserControl"), PingLibrary.UserControl)

                Return UserControl
            End Get
        End Property
#End Region

#Region "Username"
        Public Shared ReadOnly Property Username() As String
            Get
                'If PingLibrary.GlobalMethods.UserLoggedIn(IdentityControl) Then
                '    If Not String.IsNullOrEmpty(IdentityControl.Identity.EmailAddress) Then
                '        Return IdentityControl.Identity.EmailAddress
                '    Else
                '        Return ConfigurationManager.AppSettings("SurveyGizmoUsername")
                '    End If
                'Else
                '    Return ""
                'End If
                Return ConfigurationManager.AppSettings("SurveyGizmoUsername")
            End Get
        End Property
#End Region

#Region "Password"
        Public Shared ReadOnly Property Password() As String
            Get
                'If PingLibrary.GlobalMethods.UserLoggedIn(IdentityControl) Then
                '    If Not String.IsNullOrEmpty(IdentityControl.Identity.Password) Then
                '        Return IdentityControl.Identity.Password
                '    Else
                '        Return ConfigurationManager.AppSettings("SurveyGizmoPassword")
                '    End If
                'Else
                '    Return ""
                'End If
                Return ConfigurationManager.AppSettings("SurveyGizmoPassword")
            End Get
        End Property
#End Region
#End Region

#Region "Query URLs"
#Region "Credentials"
        Public Shared ReadOnly Property Credentials(Optional UserNameOverride As String = "", Optional PasswordOverride As String = "") As String
            Get
                Dim CredUsername As String = Username
                Dim CredPassword As String = Password

                If Not String.IsNullOrEmpty(UserNameOverride) Then CredUsername = UserNameOverride
                If Not String.IsNullOrEmpty(PasswordOverride) Then CredPassword = PasswordOverride

                Return "?user:pass=" & CredUsername & ":" & CredPassword
            End Get
        End Property
#End Region

#Region "ResultPerPages"
        Public Shared Function ResultPerPages(Optional PageCount As Integer = 250) As String
            Return "&resultsperpage=" & PageCount.ToString()
        End Function
#End Region

#Region "ResultPerPages"
        Public Shared Function CurrentPage(Optional PageNumber As Integer = 1) As String
            Return "&page=" & PageNumber.ToString()
        End Function
#End Region

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

#Region "BaseURL"
        Public Shared ReadOnly Property BaseURL(Optional BaseItem As String = "survey") As String
            Get
                Return "https://restapi.surveygizmo.com/head/" & BaseItem
            End Get
        End Property
#End Region

#Region "SearchURL"
        Public Shared Function GetBasicURL(BaseItem As String, ItemID As Integer, StructureExtras As String, QueryStringList As String, PageNumber As Integer) As String

            '# Build the URL query 
            '# i.e. "https://restapi.surveygizmo.com/head/survey/1234567/surveypage/1.xml?user:pass=" & Username & ":" & Password

            Dim QueryURL As String = BaseURL(BaseItem)

            If ItemID > 0 Then
                QueryURL = BaseURL & "/" & ItemID.ToString()
            End If

            If Not String.IsNullOrEmpty(StructureExtras) Then
                QueryURL = QueryURL & StructureExtras
            End If

            QueryURL = QueryURL & ".xml" & Credentials & ResultPerPages() & CurrentPage(PageNumber)

            If Not String.IsNullOrEmpty(QueryStringList) Then
                QueryURL = QueryURL & QueryStringList
            End If

            Return QueryURL

        End Function

        Public Shared Function GetRawURL(UserName As String, Password As String, BaseItem As String, ItemID As Integer, StructureExtras As String, QueryStringList As String, PageNumber As Integer) As String

            '# Build the URL query 
            '# i.e. "https://restapi.surveygizmo.com/head/survey/1234567/surveypage/1.xml?user:pass=" & Username & ":" & Password

            Dim QueryURL As String = BaseURL(BaseItem)

            If ItemID > 0 Then
                QueryURL = BaseURL & "/" & ItemID.ToString()
            End If

            If Not String.IsNullOrEmpty(StructureExtras) Then
                QueryURL = QueryURL & StructureExtras
            End If

            QueryURL = QueryURL & ".xml" & Credentials(UserName, Password) & ResultPerPages() & CurrentPage(PageNumber)

            If Not String.IsNullOrEmpty(QueryStringList) Then
                QueryURL = QueryURL & QueryStringList
            End If

            Return QueryURL

        End Function

        Public Shared Function GetQueryURL(SurveyID As Integer, StructureExtras As String, QueryStringList As String, PageNumber As Integer) As String

            '# Build the URL query 
            '# i.e. "https://restapi.surveygizmo.com/head/survey/1234567/surveypage/1.xml?user:pass=" & Username & ":" & Password

            Dim QueryURL As String = BaseURL

            If SurveyID > 0 Then
                QueryURL = BaseURL & "/" & SurveyID.ToString()
            End If

            If Not String.IsNullOrEmpty(StructureExtras) Then
                QueryURL = QueryURL & StructureExtras
            End If

            QueryURL = QueryURL & ".xml" & Credentials & ResultPerPages() & CurrentPage(PageNumber)

            If Not String.IsNullOrEmpty(QueryStringList) Then
                QueryURL = QueryURL & QueryStringList
            End If

            Return QueryURL

        End Function
#End Region
#End Region

#Region "API Calling Methods"
        Public Shared Function MakeXMLBasic(Optional BaseItem As String = "", Optional ItemID As Integer = 0, Optional StructureExtras As String = "", Optional QueryStringList As String = "", Optional SkipFiltering As Boolean = False, Optional PageNumber As Integer = 1) As XElement

            '# Make URL query to system - returns as XML XEelemnt
            Dim CompleteQueryStringList As String = ""

            If Not SkipFiltering Then

                '# Format QueryString filters
                Dim QueryStringItems As String() = Nothing

                If Not String.IsNullOrEmpty(QueryStringList) Then
                    CompleteQueryStringList = QueryStringList
                    QueryStringItems = QueryStringList.Split(CChar("&filter[field]"))
                End If

                If CurrentSurveyControl IsNot Nothing Then
                    With CurrentSurveyControl

                        If .SurveyFilters IsNot Nothing AndAlso .SurveyFilters.Count > 0 Then

                            Dim FilterQueryString As String = ""
                            Dim Count As Integer = 0

                            For Each sf As SurveyLibrary.SurveyFilter In .SurveyFilters
                                If sf IsNot Nothing Then

                                    '# Quick check to make sure we haven't had this filter hard coded already
                                    Dim SkipItem As Boolean = False
                                    If QueryStringItems IsNot Nothing Then
                                        For Each qsi In QueryStringItems
                                            If qsi.Contains("filter[field][0]=status") Then
                                                SkipItem = True
                                            End If
                                        Next
                                    End If

                                    If Not SkipItem Then
                                        FilterQueryString &= "&filter[field][" & Count.ToString() & "]=" & sf.FieldValue & "&filter[operator][" & Count.ToString() & "]=" & sf.OperatorValue & "&filter[value][" & Count.ToString() & "]=" & sf.FilterValue & ""
                                    End If

                                    Count += 1
                                End If
                            Next

                            CompleteQueryStringList &= FilterQueryString

                        End If

                    End With
                End If
            ElseIf String.IsNullOrEmpty(QueryStringList) Then
                '# Default filter
                CompleteQueryStringList = "&filter[field][0]=status&filter[operator][0]=<>&filter[value][0]=Deleted"
            End If

            '# Create key
            Dim KeyValue As String = "blkey_" & BaseItem & "_" & ItemID.ToString() & "_" & StructureExtras & "_" & CompleteQueryStringList

            '# Check to see if we have cached results
            Dim CompleteResponse As XElement = Nothing

            Try

                Dim CachedResponse As XElement = CType(HttpContext.Current.Cache.Get(KeyValue), XElement)

                If CachedResponse IsNot Nothing Then
                    CompleteResponse = CachedResponse
                Else

                    '# Build the URL
                    Dim QueryURL As String = GetBasicURL(BaseItem, ItemID, StructureExtras, CompleteQueryStringList, PageNumber)

                    '# Run query and return results
                    Dim FreshResponse As XElement = XElement.Load(QueryURL)

                    '# Add to cache
                    'HttpContext.Current.Cache.Insert(KeyValue, FreshResponse, Nothing, System.Web.Caching.Cache.NoAbsoluteExpiration, New TimeSpan(0, 30, 0), System.Web.Caching.CacheItemPriority.Default, Nothing)
                    HttpContext.Current.Cache.Insert(KeyValue, FreshResponse, Nothing, System.DateTime.Now.AddMinutes(30), System.Web.Caching.Cache.NoSlidingExpiration)

                    CompleteResponse = FreshResponse
                End If

            Catch ex As Exception
            End Try

            Return CompleteResponse

        End Function

        Public Shared Function MakeXMLQuery(Optional SurveyID As Integer = 0, Optional StructureExtras As String = "", Optional QueryStringList As String = "", Optional SkipFiltering As Boolean = False, Optional PageNumber As Integer = 1) As XElement

            '# Make URL query to system - returns as XML XEelemnt
            Dim CompleteQueryStringList As String = ""

            If Not SkipFiltering Then

                If Not String.IsNullOrEmpty(QueryStringList) Then
                    CompleteQueryStringList = QueryStringList
                Else
                    '# Default filter
                    CompleteQueryStringList = "&filter[field][0]=status&filter[operator][0]=<>&filter[value][0]=Deleted"
                End If

            ElseIf String.IsNullOrEmpty(QueryStringList) Then
                '# Default filter
                CompleteQueryStringList = "&filter[field][0]=status&filter[operator][0]=<>&filter[value][0]=Deleted"
            End If

            '# Create key
            Dim KeyValue As String = "blkey_" & SurveyID.ToString() & "_" & StructureExtras & "_" & CompleteQueryStringList & "_p" & PageNumber.ToString()

            '# Check to see if we have cached results
            Dim CompleteResponse As XElement = Nothing

            Try

                Dim CachedResponse As XElement = CType(HttpContext.Current.Cache.Get(KeyValue), XElement)
                Dim CachedResponseLoaded As Boolean = False

                If CachedResponse IsNot Nothing Then
                    CompleteResponse = CachedResponse

                    If CompleteResponse IsNot Nothing Then
                        Dim ResultOk = (From dr In CompleteResponse.Elements("result_ok") Select dr).FirstOrDefault()
                        If ResultOk IsNot Nothing AndAlso Not String.IsNullOrEmpty(ResultOk.Value()) Then CachedResponseLoaded = True
                    End If
                End If

                If Not CachedResponseLoaded Then

                    '# Build the URL
                    Dim QueryURL As String = GetQueryURL(SurveyID, StructureExtras, CompleteQueryStringList, PageNumber)

                    '# Run query and return results
                    Dim FreshResponse As XElement '= XElement.Load(QueryURL)

                    '# Run query and return results
                    Dim request = TryCast(WebRequest.Create(QueryURL), HttpWebRequest)
                    request.Timeout = 300000
                    '# Timeout after 1000 ms
                    Using stream = request.GetResponse().GetResponseStream()
                        Using reader = New StreamReader(stream)
                            FreshResponse = XElement.Load(reader)

                            '# Add to cache
                            'HttpContext.Current.Cache.Insert(KeyValue, FreshResponse, Nothing, System.Web.Caching.Cache.NoAbsoluteExpiration, New TimeSpan(0, 30, 0), System.Web.Caching.CacheItemPriority.Default, Nothing)
                            HttpContext.Current.Cache.Insert(KeyValue, FreshResponse, Nothing, System.DateTime.Now.AddMinutes(30), System.Web.Caching.Cache.NoSlidingExpiration)

                        End Using
                    End Using

                    CompleteResponse = FreshResponse
                End If

            Catch ex As Exception
            End Try

            Return CompleteResponse

        End Function

        Public Shared Function MakeXMLQueryPlain() As XElement
            Return MakeXMLQuery(0, "", "", True)
        End Function

        Public Shared Function MakeXMLRaw(Optional UserName As String = "", Optional Password As String = "", Optional BaseItem As String = "", Optional ItemID As Integer = 0, Optional StructureExtras As String = "", Optional QueryStringList As String = "", Optional PageNumber As Integer = 1) As XElement

            '# Check to see if we have cached results
            Dim CompleteResponse As XElement = Nothing

            Try

                '# Build the URL
                Dim QueryURL As String = GetRawURL(UserName, Password, BaseItem, ItemID, StructureExtras, QueryStringList, PageNumber)

                '# Run query and return results
                Dim request = TryCast(WebRequest.Create(QueryURL), HttpWebRequest)
                request.Timeout = 300000
                '# Timeout after 1000 ms
                Using stream = request.GetResponse().GetResponseStream()
                    Using reader = New StreamReader(stream)
                        CompleteResponse = XElement.Load(reader)
                    End Using
                End Using

            Catch ex As Exception
            End Try

            Return CompleteResponse

        End Function

        Public Shared Function MakeRestQuery(address As String) As String

            Dim request As HttpWebRequest = Nothing
            Dim response As HttpWebResponse = Nothing
            Dim reader As StreamReader = Nothing
            Dim sbSource As StringBuilder = Nothing

            If String.IsNullOrEmpty(address) Then
                Throw New ArgumentNullException("address")
            End If

            Dim SuccessfulResult As Boolean = True
            Dim ErrorMessage As String = "Problem with REST"

            Try
                '# Create and initialize the web request  
                request = TryCast(WebRequest.Create(address), HttpWebRequest)
                request.Method = "GET"
                request.KeepAlive = False

                '# Set timeout to 15 seconds  
                request.Timeout = 15 * 1000

                '# Get response  
                response = TryCast(request.GetResponse(), HttpWebResponse)

                If request.HaveResponse = True AndAlso response IsNot Nothing Then
                    '# Get the response stream  
                    reader = New StreamReader(response.GetResponseStream())

                    '# Read it into a StringBuilder  
                    sbSource = New StringBuilder(reader.ReadToEnd())

                End If
            Catch wex As WebException
                '# This exception will be raised if the server didn't return 200 - OK  
                '# Try to retrieve more information about the network error  
                If wex.Response IsNot Nothing Then
                    Using errorResponse As HttpWebResponse = DirectCast(wex.Response, HttpWebResponse)
                        ErrorMessage = String.Format("Problem making REST query - The server returned '{0}' with the status code {1} ({2:d}).", errorResponse.StatusDescription, errorResponse.StatusCode, errorResponse.StatusCode)
                        SuccessfulResult = False
                    End Using
                End If
            Finally
                If response IsNot Nothing Then
                    response.Close()
                End If
            End Try

            If Not SuccessfulResult Then
                Throw New Exception(ErrorMessage)
            End If

            '# return output  
            If sbSource IsNot Nothing Then
                Return sbSource.ToString()
            Else
                Return ""
            End If

        End Function
#End Region

#Region "Formatting"

        Public Shared Function FormatDateTime(ByVal o As Object) As DateTime

            If o IsNot Nothing Then

                '# Try and convert to a date value
                Dim dt As DateTime
                If DateTime.TryParse(o.ToString, dt) Then
                    Return dt
                Else
                    Return New Date(1900, 1, 1)
                End If
            Else
                Return New Date(1900, 1, 1)
            End If

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

        Public Shared Function FormatObject(ByVal o As Object) As String
            If o Is Nothing Then
                Return ""
            Else
                Try
                    Dim result As String = o.ToString()
                    Return result
                Catch ex As Exception
                    Return ""
                End Try
            End If
        End Function

        Public Shared Function FormatObject(Of T)(ByVal o As Object) As T
            If o Is Nothing Then
                Return CType(Nothing, T)
            Else
                Try
                    Return CType(o, T)
                Catch ex As Exception
                    Return CType(Nothing, T)
                End Try
            End If
        End Function

        Public Shared Function FormatElement(ByVal ele As XElement) As String
            If ele Is Nothing Then
                Return ""
            Else
                Try
                    Return ele.Value()
                Catch ex As Exception
                    Return ""
                End Try
            End If
        End Function

        Public Shared Function FormatElement(Of T)(ByVal ele As XElement) As T
            If ele Is Nothing Then
                Return CType(Nothing, T)
            Else
                Try
                    Dim Value = CType(ele.Value(), Object)
                    Return CType(Value, T)
                Catch ex As Exception
                    Return CType(Nothing, T)
                End Try
            End If
        End Function

#End Region

    End Class
End Namespace
