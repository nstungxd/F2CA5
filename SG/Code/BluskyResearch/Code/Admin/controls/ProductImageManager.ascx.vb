Imports System
Imports System.Collections
Imports System.ComponentModel
Imports System.Data
Imports System.Drawing
Imports System.IO
Imports System.Web
Imports System.Web.SessionState
Imports System.Web.UI
Imports System.Web.UI.WebControls
Imports System.Web.UI.HtmlControls
Imports Telerik.Web.UI
Imports Telerik.Web.UI.Upload
Imports PingCore.MyData
Imports PingCore.MyContent.PageContent

Partial Class Admin_controls_ProductImageManager
    Inherits PingCore.MyControls.SpecialAdminControl

    Public Overrides Sub ClearData()
    End Sub

    Public Overloads Overrides Sub LoadData(ByVal ParentRecordID As Integer)
        FixMissingOrderValues()
        Dim MyDbTable As DataTable = DBFactory.DB.GetDataTable("SELECT * FROM ProductImages WHERE ProductFK = " & ParentRecordID & " ORDER BY Priority")
        rptImages.DataSource = MyDbTable
        rptImages.DataBind()
    End Sub

    Public Overrides Sub SaveData(ByVal ParentRecordID As Integer)

        'sort out image order
        'get the list of images (in order)
        Dim MySortedString = SortedString.Text.Replace("sortableitem_", "")
        Dim strImageOrder As List(Of String) = Split(MySortedString, ",").ToList

        Dim OrderCount As Integer = 0
        Dim SQLToRun As String = ""
        For Each item As String In strImageOrder
            If Not String.IsNullOrEmpty(item) Then
                OrderCount += 1
                SQLToRun &= "UPDATE ProductImages SET Priority=" & OrderCount & " WHERE ProductImageID = " & item & ";"
            End If
        Next

        If Not String.IsNullOrEmpty(SQLToRun) Then DBFactory.DB.RunSQL(SQLToRun)


        Dim MyDbTable As DataTable = DBFactory.DB.GetDataTable("SELECT * FROM ProductImages WHERE ProductFK=" & ParentRecordID & " ORDER BY Priority")

        If photoUpload.UploadedFiles.Count > 0 Then
            For Each UploadedFile As UploadedFile In photoUpload.UploadedFiles
                'get new image id
                Dim ImageExtension As String = UploadedFile.GetExtension
                Dim MyImageID As Integer = DBFactory.DB.GetDataField(Of Integer)("INSERT INTO ProductImages (ProductFK, AltText, Extension) values (" & ParentRecordID & ",'', '" & addSlashes(ImageExtension) & "');SELECT @@IDENTITY;")
                ' perform resize
                Dim fullPathIn As String = Path.Combine(Server.MapPath(photoUpload.TargetFolder), UploadedFile.GetName)
                Dim fullPathOut As String
                fullPathOut = Path.Combine(Server.MapPath(photoUpload.TargetFolder) & "Thumbnails", MyImageID & ImageExtension)
                PingCore.MyContent.ImageUtil.ResizeImage(fullPathIn, fullPathOut, 200, 200, True)
                fullPathOut = Path.Combine(Server.MapPath(photoUpload.TargetFolder) & "Large", MyImageID & ImageExtension)
                PingCore.MyContent.ImageUtil.ResizeImage(fullPathIn, fullPathOut, 600, 600, True)
            Next
        End If

        AddDeleteDependencyForFile(photoUpload.UploadedFiles)
        FixMissingOrderValues()
    End Sub

    Sub FixMissingOrderValues()
        DBFactory.DB.RunSQL("UPDATE ProductImages SET Priority=ProductImageID WHERE Priority IS NULL;")
    End Sub

    Private callBack As CacheItemRemovedCallback

    Private Sub AddDeleteDependencyForFile(ByVal uploadedFileCollection As UploadedFileCollection)
        Dim uploadedFile As UploadedFile
        For Each uploadedFile In uploadedFileCollection
            Dim timeOut As TimeSpan = TimeSpan.FromMinutes(5)

            callBack = New CacheItemRemovedCallback(AddressOf DeleteFile)

            Dim fullPath As String = Path.Combine(Server.MapPath(photoUpload.TargetFolder), uploadedFile.GetName())

            Context.Cache.Insert(uploadedFile.FileName, fullPath, Nothing, DateTime.Now.Add(timeOut), TimeSpan.Zero, CacheItemPriority.Default, callBack)
        Next
    End Sub

    Private Sub DeleteFile(ByVal key As String, ByVal path As Object, ByVal reason As CacheItemRemovedReason)
        File.Delete(DirectCast(path, String))
    End Sub


    Protected Sub RadUpload1_FileExists(ByVal sender As Object, ByVal e As Telerik.Web.UI.Upload.UploadedFileEventArgs)
        Dim counter As Integer = 1

        Dim file As UploadedFile = e.UploadedFile

        Dim targetFolder As String = Server.MapPath(photoUpload.TargetFolder)

        Dim targetFileName As String = Path.Combine(targetFolder, file.GetNameWithoutExtension() + counter.ToString() + file.GetExtension())

        While System.IO.File.Exists(targetFileName)
            counter += 1
            targetFileName = Path.Combine(targetFolder, file.GetNameWithoutExtension() + counter.ToString() + file.GetExtension())
        End While

        file.SaveAs(targetFileName)
    End Sub

End Class
