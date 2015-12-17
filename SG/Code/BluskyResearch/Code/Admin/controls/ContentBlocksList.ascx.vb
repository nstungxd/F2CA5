Imports System.Data
Imports Telerik.Web.UI
Imports PingCore.MyContent
Imports PingCore
Imports PingLibrary

Partial Class Admin_controls_ContentBlocksList
    Inherits System.Web.UI.UserControl

#Region "NewItem"
    Public Property NewItem As Boolean
        Get
            Dim _NewItem As Boolean = False
            If ViewState("_NewItem") IsNot Nothing Then _NewItem = CType(ViewState("_NewItem"), Boolean)
            Return _NewItem
        End Get
        Set(ByVal value As Boolean)
            ViewState("_NewItem") = value
        End Set
    End Property
#End Region

#Region "ParentID"
    Public Property ParentID() As Integer
        Get
            Return PageContent.MakeInt(ViewState("_ParentID"))
        End Get
        Set(ByVal value As Integer)
            ViewState("_ParentID") = value
        End Set
    End Property
#End Region

#Region "ParentTable"
    Public Property ParentTable() As String
        Get
            Dim _ParentTable As String = "default"

            If ViewState("_ParentTable") IsNot Nothing Then
                _ParentTable = ViewState("_ParentTable").ToString()
            End If

            Return _ParentTable
        End Get
        Set(ByVal value As String)
            ViewState("_ParentTable") = value
        End Set
    End Property
#End Region

#Region "LayoutGroup"
    Public Property LayoutGroup() As String
        Get
            Dim _LayoutGroup As String = "default"

            If ViewState("_LayoutGroup") IsNot Nothing Then
                _LayoutGroup = ViewState("_LayoutGroup").ToString()
            End If

            Return _LayoutGroup
        End Get
        Set(ByVal value As String)
            ViewState("_LayoutGroup") = value
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

#Region "NewContentBlockIDs"
    Public Property NewContentBlockIDs() As String
        Get
            Dim _NewContentBlockIDs As String = ""

            If Session("NewContentBlockIDs") IsNot Nothing Then
                Try
                    _NewContentBlockIDs = Session("NewContentBlockIDs").ToString()
                Catch ex As Exception
                    _NewContentBlockIDs = ""
                End Try
            End If

            Return _NewContentBlockIDs
        End Get
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

    Public Sub ResetNewContentBlockIDs()
        Session("NewContentBlockIDs") = ""
    End Sub
#End Region

    Protected Sub Page_Load(sender As Object, e As System.EventArgs) Handles Me.Load
        If Not IsPostBack Then

            '# Reset new data
            ResetNewContentBlockIDs()

            LoadContentTypes()
            LoadList()
        End If
    End Sub

#Region "Initialise"
    Public Sub Initialise(InitalNewItem As Boolean, InitalParentID As Integer, InitalParentTable As String)
        ResetNewContentBlockIDs()
        NewItem = InitalNewItem
        ParentID = InitalParentID
        ParentTable = InitalParentTable
        LoadList()
    End Sub
#End Region

#Region "Content Types"
    Protected Sub LoadContentTypes()
        With ddlContentTypes
            .DataSource = SimbaAccess.GetAllContentTypes(LayoutGroup)
            .DataValueField = "TypeReference"
            .DataTextField = "Name"
            .DataBind()

            .Items.Insert(0, New ListItem("Please select", ""))
        End With
    End Sub
#End Region

#Region "List"
    Public Sub LoadList()

        Dim ContentBlocks As DataTable = Nothing

        If ParentID > 0 Then
            ContentBlocks = SimbaAccess.GetAllContentBlocksByParent(ParentID, ParentTable, LayoutGroup)

            hdnParent.Value = ParentID
            hdnParentTbl.Value = ParentTable

        ElseIf Not String.IsNullOrEmpty(NewContentBlockIDs) Then
            Dim CurrentContentBlockIDs As String = NewContentBlockIDs.Substring(0, NewContentBlockIDs.Length - 1)
            ContentBlocks = SimbaAccess.GetAllContentBlocksByIDList(CurrentContentBlockIDs)
        End If

        With rlContentBlocks
            .DataSource = ContentBlocks
            .DataBind()
        End With

    End Sub

    Protected Sub rlContentBlocks_ItemDataBound(sender As Object, e As AjaxControlToolkit.ReorderListItemEventArgs) Handles rlContentBlocks.ItemDataBound
        Select Case e.Item.ItemType
            Case ListItemType.Item, ListItemType.AlternatingItem, ListItemType.SelectedItem

                Dim DataItem As DataRow = CType(e.Item.DataItem, DataRowView).Row
                Dim pmContentBlockEditor As Admin_controls_ContentBlockEditor = CType(e.Item.FindControl("pmContentBlockEditor"), Admin_controls_ContentBlockEditor)

                If DataItem IsNot Nothing AndAlso pmContentBlockEditor IsNot Nothing Then

                    Dim ContentBlockID As Integer = DataFunctions.GetColumnFromDataRow(Of Integer)(DataItem, "ContentBlockID")
                    Dim ContentTypeID As Integer = DataFunctions.GetColumnFromDataRow(Of Integer)(DataItem, "ContentTypeFk")

                    pmContentBlockEditor.ContentBlockID = ContentBlockID
                    pmContentBlockEditor.ContentTypeID = ContentTypeID
                    pmContentBlockEditor.IsNewRecord = NewItem

                    pmContentBlockEditor.LoadPage()

                End If

        End Select
    End Sub

    Protected Function GetBlockTitle(oContentTypeID As Object) As String
        Dim ContentTypeID As Integer = 0
        Int32.TryParse(oContentTypeID, ContentTypeID)

        If ContentTypeID > 0 Then
            Select Case ContentTypeID
                Case 1
                    Return "Text Block"
                Case 2
                    Return "Image (Dimensions: 150px x 150px)"
                Case 3
                    Return "Embed Code (Embed code from external source i.e. YouTube, Vimeo, Vine or Flickr etc.)"
                Case Else
                    Return "Content Block"
            End Select
        Else
            Return "Content Block"
        End If

    End Function

    Protected Sub rlContentBlocks_ItemReorder(sender As Object, e As AjaxControlToolkit.ReorderListItemReorderEventArgs) Handles rlContentBlocks.ItemReorder

        Dim NewOrder As Integer = e.NewIndex + 1
        Dim OldOrder As Integer = e.OldIndex + 1

        Dim itemContentBlockEditor As Admin_controls_ContentBlockEditor = CType(rlContentBlocks.Items(e.OldIndex).FindControl("pmContentBlockEditor"), Admin_controls_ContentBlockEditor)
        Dim itemContentBlockID As Integer = itemContentBlockEditor.ContentBlockID
        Dim itemPriority As Integer = DataFunctions.GetColumnFromDataRow(Of Integer)(SimbaAccess.GetContentBlockByID(itemContentBlockID), "Priority")

        Dim replacedItemContentBlockEditor As Admin_controls_ContentBlockEditor = CType(rlContentBlocks.Items(e.NewIndex).FindControl("pmContentBlockEditor"), Admin_controls_ContentBlockEditor)
        Dim replacedItemContentBlockID As Integer = replacedItemContentBlockEditor.ContentBlockID
        Dim replacedItemPriority As Integer = DataFunctions.GetColumnFromDataRow(Of Integer)(SimbaAccess.GetContentBlockByID(replacedItemContentBlockID), "Priority")

        Dim pmContentBlockEditor As Admin_controls_ContentBlockEditor = CType(e.Item.FindControl("pmContentBlockEditor"), Admin_controls_ContentBlockEditor)
        Dim ContentBlockID As Integer = pmContentBlockEditor.ContentBlockID

        Dim UpdateSQL As String = ""
        Dim ListItemCount As Integer = 1

        '# Update the list and set the order depending on the direction we're moving items
        If replacedItemPriority > itemPriority Then

            '# Moving down
            UpdateSQL &= String.Format("UPDATE ContentBlocks SET Priority = Priority - 1 WHERE ParentID = {1} AND ParentTable = '{2}' AND Priority <= {3} AND ContentBlockID <> {4} AND Priority > {5}; {0}", vbCrLf, ParentID.ToString(), ParentTable, replacedItemPriority.ToString(), itemContentBlockID.ToString(), itemPriority.ToString())

        ElseIf replacedItemPriority < itemPriority Then

            '# Moving up
            UpdateSQL &= String.Format("UPDATE ContentBlocks SET Priority = Priority + 1 WHERE ParentID = {1} AND ParentTable = '{2}' AND Priority >= {3} AND ContentBlockID <> {4} AND Priority < {5}; {0}", vbCrLf, ParentID.ToString(), ParentTable, replacedItemPriority.ToString(), itemContentBlockID.ToString(), itemPriority.ToString())

        End If

        '#finally, update the selected one for its changed priority
        UpdateSQL &= String.Format("UPDATE ContentBlocks SET Priority = {1} WHERE ParentID = {2} AND ParentTable = '{3}' AND ContentBlockID = {4}; {0}", vbCrLf, replacedItemPriority.ToString(), ParentID.ToString(), ParentTable, itemContentBlockID.ToString())

        Dim Result As Integer = 0

        If Not String.IsNullOrEmpty(UpdateSQL) Then
            Result = Data.Connect.RunSQL(UpdateSQL)
        End If

        '# Re-load the list of Content Block Editors so we show the latest content block information
        LoadList()

    End Sub

#End Region

#Region "Event Handlers"
    Protected Sub btnAddNewContentBlock_Click(sender As Object, e As System.EventArgs) Handles btnAddNewContentBlock.Click

        Dim dbc As SqlDatabaseConnection = Data.DBConnection(True)

        '# Do quick save to ensure we don't loose text values
        Save(ParentID, ParentTable, False, dbc)

        '# Get Data Values
        Dim ContentTypeReference As String = ddlContentTypes.SelectedValue

        '# Get ContentTypeID
        ContentTypeID = SimbaAccess.GetContentTypeIDByTypeReference(ContentTypeReference, LayoutGroup, dbc)

        '# Add record to Database for new content block
        Dim NewRecordID As Integer = SimbaAccess.AddNewContentBlock(ContentTypeID, ParentID, ParentTable, dbc)

        '# Log the New Item ID
        If NewItem Then
            NewContentBlockIDs = NewRecordID
        End If

        '# Re-load the list of Content Block Editors so we show the latest content block information
        LoadList()

    End Sub

    Protected Sub ContentBlockEditor_DeletedEvent(ByVal sender As Object, ByVal e As EventArgs)

        Dim dbc As SqlDatabaseConnection = Data.DBConnection(True)

        '# Do quick save to ensure we don't loose text values
        Save(ParentID, ParentTable, False, dbc)

        '# Get the control being deleted
        Dim pmContentBlockEditor As Admin_controls_ContentBlockEditor = CType(sender, Admin_controls_ContentBlockEditor)

        If pmContentBlockEditor IsNot Nothing Then

            '# Get the ID of the record to delete
            Dim ContentBlockID As Integer = pmContentBlockEditor.ContentBlockID

            '# Get the ID of the record to delete
            SimbaAccess.DeleteContentBlock(ContentBlockID, dbc)
        End If

        '# Re-load the list of Content Block Editors so we show the latest content block information
        LoadList()

    End Sub
#End Region

#Region "Save"
    Public Function ValidateContentBlocks() As KeyValuePair(Of Boolean, String)

        Dim DataIsValid As Boolean = True
        Dim ErrorList As String = ""

        '# Loop through each control and check to see if the value is valid
        For Each li As AjaxControlToolkit.ReorderListItem In rlContentBlocks.Items

            Dim pmContentBlockEditor As Admin_controls_ContentBlockEditor = CType(li.FindControl("pmContentBlockEditor"), Admin_controls_ContentBlockEditor)

            If pmContentBlockEditor IsNot Nothing Then
                Dim ResultValue As KeyValuePair(Of Boolean, String) = pmContentBlockEditor.Validate()

                If ResultValue.Key = False Then
                    DataIsValid = False
                    ErrorList &= "<li>" & ResultValue.Value & "</li>"
                End If
            End If

        Next

        Return New KeyValuePair(Of Boolean, String)(DataIsValid, ErrorList)

    End Function

    Public Function Save(ParentID As Integer, ParentTable As String, Optional IncludeImages As Boolean = True, Optional dbc As PingLibrary.SqlDatabaseConnection = Nothing) As KeyValuePair(Of Boolean, String)

        Dim SaveIsValid As Boolean = True
        Dim ErrorList As String = ""

        If dbc Is Nothing Then dbc = Data.DBConnection(True)

        '# Loop through each control and save each item
        For Each li As AjaxControlToolkit.ReorderListItem In rlContentBlocks.Items

            Dim pmContentBlockEditor As Admin_controls_ContentBlockEditor = CType(li.FindControl("pmContentBlockEditor"), Admin_controls_ContentBlockEditor)

            If pmContentBlockEditor IsNot Nothing Then
                Dim ResultValue As KeyValuePair(Of Boolean, String) = pmContentBlockEditor.Save(ParentID, ParentTable, IncludeImages, dbc)

                If ResultValue.Key = False Then
                    SaveIsValid = False
                    ErrorList &= "<li>" & ResultValue.Value & "</li>"
                End If
            End If

        Next

        Return New KeyValuePair(Of Boolean, String)(SaveIsValid, ErrorList)

    End Function

#End Region

End Class
