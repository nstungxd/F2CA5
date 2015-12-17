Imports System.Data
Imports Telerik.Web.UI
Imports PingCore.MyContent
Imports PingCore.MyData
Imports PingCore
Imports PingLibrary

Partial Class Admin_controls_ContentBlockEditor
    Inherits System.Web.UI.UserControl

#Region "IsNewRecord"
    Public Property IsNewRecord As Boolean
        Get
            Dim _IsNewRecord As Boolean = False
            If ViewState("_IsNewRecord") IsNot Nothing Then _IsNewRecord = CType(ViewState("_IsNewRecord"), Boolean)
            Return _IsNewRecord
        End Get
        Set(ByVal value As Boolean)
            ViewState("_IsNewRecord") = value
        End Set
    End Property
#End Region

#Region "ContentBlockID"
    Public Property ContentBlockID() As Integer
        Get
            Return PageContent.MakeInt(ViewState("_ContentBlockID"))
        End Get
        Set(ByVal value As Integer)
            ViewState("_ContentBlockID") = value
        End Set
    End Property
#End Region

#Region "ContentTypeID"
    Public Property ContentTypeID() As Integer
        Get
            Return PageContent.MakeInt(ViewState("_ContentTypeID"))
        End Get
        Set(ByVal value As Integer)
            ViewState("_ContentTypeID") = value
        End Set
    End Property
#End Region

#Region "ContentImageValue"
    Public Property ContentImageValue() As Integer
        Get
            Return PageContent.MakeInt(ViewState("_ContentImageValue"))
        End Get
        Set(ByVal value As Integer)
            ViewState("_ContentImageValue") = value
        End Set
    End Property
#End Region

#Region "ContentTypeReference"
    Public Property ContentTypeReference() As String
        Get
            Dim _ContentTypeReference As String = ""
            If ViewState("_ContentTypeReference") IsNot Nothing Then _ContentTypeReference = ViewState("_ContentTypeReference").ToString()
            Return _ContentTypeReference
        End Get
        Set(ByVal value As String)
            ViewState("_ContentTypeReference") = value
        End Set
    End Property
#End Region

#Region "NewContentBlockIDs"
    Private WriteOnly Property NewContentBlockIDs() As String
        Set(ByVal value As String)

            Dim _NewContentBlockIDs As String = ""

            If Session("NewContentBlockIDs") IsNot Nothing Then
                Try
                    _NewContentBlockIDs = Session("NewContentBlockIDs").ToString()
                Catch ex As Exception
                    _NewContentBlockIDs = ""
                End Try
            End If

            _NewContentBlockIDs = _NewContentBlockIDs & value & ","
            Session("NewContentBlockIDs") = _NewContentBlockIDs

        End Set
    End Property
#End Region

#Region "DeleteCurrentImage"
    Public Property DeleteCurrentImage() As Boolean
        Get
            Return CType(ViewState("DeleteCurrentImage"), Boolean)
        End Get
        Set(ByVal value As Boolean)
            ViewState("DeleteCurrentImage") = value
        End Set
    End Property
#End Region

    Protected Sub Page_Load(sender As Object, e As System.EventArgs) Handles Me.Load
        If Not IsPostBack Then
            LoadPage()
        End If
    End Sub

#Region "Load Data"
    Public Sub LoadPage()
        If ContentTypeID > 0 Then

            Try

                Dim dbc As PingLibrary.SqlDatabaseConnection = Data.DBConnection(True)

                '# Load Content Block Type
                Dim ContentTypeRecord As DataRow = SimbaAccess.GetContentTypeByID(ContentTypeID)
                ContentTypeReference = DataFunctions.GetColumnFromDataRow(ContentTypeRecord, "TypeReference")

                Dim cbe_view As View = CType(Me.FindControl("cbe_" & ContentTypeReference), View)

                mvContentBlockItem.SetActiveView(cbe_view)

                '# Load Content Block Content
                If ContentBlockID > 0 Then

                    Dim ContentBlockRecord As DataRow = SimbaAccess.GetContentBlockByID(ContentBlockID)

                    Dim TextValue As String = DataFunctions.GetColumnFromDataRow(ContentBlockRecord, "Text")
                    ContentImageValue = DataFunctions.GetColumnFromDataRow(Of Integer)(ContentBlockRecord, "Image")
                    Dim ImageExtValue As String = DataFunctions.GetColumnFromDataRow(ContentBlockRecord, "ext")
                    Dim EmbedCodeValue As String = DataFunctions.GetColumnFromDataRow(ContentBlockRecord, "EmbedCode")

                    Select Case ContentTypeReference
                        Case "text"
                            If Not String.IsNullOrEmpty(TextValue) Then ckText.Value = TextValue
                        Case "image"
                            SetImageArea(ContentImageValue, ImageExtValue)
                            If Not String.IsNullOrEmpty(TextValue) Then txtAltText.Text = TextValue
                        Case "embedcode"
                            If Not String.IsNullOrEmpty(EmbedCodeValue) Then txtEmbedCode.Text = EmbedCodeValue
                    End Select

                End If

                cbe_item.Attributes.Add("rel", ContentBlockID.ToString())

            Catch ex As Exception
                mvContentBlockItem.SetActiveView(cbe_error)
                lblError.Text = "Problem loading content block - " & ex.Message
            End Try

        End If
    End Sub
#End Region

#Region "Images"
    Sub SetImageArea(ImageID As Integer, Extension As String)
        If ImageID = 0 Then
            HideImage()
        Else
            ShowImage(ImageID, Extension)
        End If
    End Sub

    Sub HideImage()
        pnlImageUpload.Visible = True
        pnlExistingImage.Visible = False
        DeleteCurrentImage = True
    End Sub

    Sub ShowImage(ImageID As Integer, Extension As String)
        pnlExistingImage.Visible = True
        pnlImageUpload.Visible = False
        imgExistingImage.ImageUrl = "/media/images/upload/150/" & ImageID.ToString() & "." & Extension
        DeleteCurrentImage = False
    End Sub

    Protected Sub btnDeleteImage_Click(ByVal sender As Object, ByVal e As System.EventArgs) Handles btnDeleteImage.Click
        HideImage()
    End Sub

    Protected Function UploadImage() As Integer

        Dim NewImageID As Integer = 0

        Try
            If fuUploadBox.HasFile Then
                Dim aps As NameValueCollection = System.Configuration.ConfigurationManager.AppSettings
                NewImageID = MyContent.PageContent.ProcessImageUpload(fuUploadBox, Server.MapPath("../../") & "\" & aps("imageUploadPath"), "../Media/Images/upload/", System.IO.Path.GetExtension(fuUploadBox.PostedFile.FileName), False)
            End If
        Catch ex As Exception
        End Try

        Return NewImageID

    End Function

#End Region

#Region "Event Handlers"

    Public Event DeletedEvent As EventHandler

#Region "Save"
    Public Function Validate() As KeyValuePair(Of Boolean, String)

        Dim ControlValid As Boolean = True
        Dim ErrorMessage As String = ""

        Select Case ContentTypeReference
            Case "text"
                If String.IsNullOrEmpty(ckText.Value) OrElse ckText.Value.Length <= 0 Then
                    ControlValid = False
                    ErrorMessage = "Text - text is required"
                End If
            Case "image"
                If ContentImageValue = 0 Then
                    If Not fuUploadBox.HasFile Then
                        ControlValid = False
                        ErrorMessage = "Image - An image is required"
                    End If
                End If
            Case "embedcode"
                If String.IsNullOrEmpty(txtEmbedCode.Text) OrElse txtEmbedCode.Text.Length <= 0 Then
                    ControlValid = False
                    ErrorMessage = "Embed Code - Embed Code is required"
                ElseIf txtEmbedCode.Text.Length >= 2000 Then
                    ControlValid = False
                    ErrorMessage = "Embed Code - Embed Code is too long. Please ensure it is less than 2000 characters in length."
                End If
        End Select

        Return New KeyValuePair(Of Boolean, String)(ControlValid, ErrorMessage)

    End Function

    Public Function Save(ParentID As Integer, ParentTable As String, Optional IncludeImages As Boolean = True, Optional dbc As PingLibrary.SqlDatabaseConnection = Nothing) As KeyValuePair(Of Boolean, String)

        Dim SaveOK As Boolean = True
        Dim ErrorMessage As String = ""
        Dim ContentTypeName As String = ""

        Try

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Select Case ContentTypeReference
                Case "text"
                    ContentTypeName = "Text"
                    SaveOK = SaveValue("Text", ckText.Value, ParentID, ParentTable, dbc) '# Text Editor
                Case "image"
                    If IncludeImages Then
                        ContentTypeName = "Image"

                        '# Upload image
                        ContentImageValue = UploadImage()

                        If ContentImageValue > 0 Then
                            SaveOK = SaveValue("Image", ContentImageValue.ToString(), ParentID, ParentTable, dbc) '# Image
                            SaveValue("Text", txtAltText.Text, ParentID, ParentTable, dbc) '# Alt Text
                        Else
                            SaveValue("Text", txtAltText.Text, ParentID, ParentTable, dbc) '# Alt Text
                        End If
                    End If
                Case "embedcode"
                    ContentTypeName = "Embed Code"
                    SaveOK = SaveValue("EmbedCode", txtEmbedCode.Text, ParentID, ParentTable, dbc) '# Embed Code
            End Select

            If Not SaveOK Then
                ErrorMessage = ContentTypeName & " - Problem saving data"
            End If

        Catch ex As Exception
            SaveOK = False
            ErrorMessage = ContentTypeName & " - " & ex.Message
        End Try

        Return New KeyValuePair(Of Boolean, String)(SaveOK, ErrorMessage)

    End Function

    Protected Function SaveValue(ColumnName As String, ColumnValue As String, ParentID As Integer, ParentTable As String, dbc As PingLibrary.SqlDatabaseConnection) As Boolean

        Dim ReturnResult As Integer = SimbaAccess.SetContentBlockValues(ContentBlockID, ColumnName, ColumnValue, ParentID, ParentTable, dbc)

        If ReturnResult > 0 Then
            Return True
        Else
            Return False
        End If

    End Function

#End Region

#Region "Delete"
    Protected Sub btnDelete_Click(sender As Object, e As System.EventArgs) Handles btnDelete.Click
        RaiseEvent DeletedEvent(Me, New EventArgs)
    End Sub
#End Region

#End Region

End Class
