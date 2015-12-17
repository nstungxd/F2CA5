Imports Microsoft.VisualBasic
Imports System.Data
Imports System.Data.SqlClient

Namespace PingLibrary

    Public NotInheritable Class SimbaAccess

#Region "Navigation"

        Public Shared Function GetAdminMenuItemsByUserTypeTable(ByVal utype_id As Integer, ByVal menulevel As Integer) As DataTable

            Dim sql As String = String.Format(String.Concat( _
             "SELECT distinct s.admin_section_id AS id, {0}", _
             "  s.admin_section_name AS name, {0}", _
             "  s.admin_file_name AS filename, admin_section_menu_order, admin_section_MenuLevel, s.admin_section_never_add AS 'NeverAdd' {0}", _
             "FROM tbl_usertypes AS ut {0}", _
             "  left join zz_admin_usertype_sectionaccess AS sa {0}", _
             "    ON ut.utype_id = sa.sectionaccess_usertype_fk {0}", _
             "  INNER JOIN zz_admin_sections AS s {0}", _
             "    ON (ut.utype_hasglobalaccess = 1 OR {0}", _
             "      (sa.sectionaccess_section_fk = s.admin_section_id {0}", _
             "        and sa.sectionaccess_showonnav = 1)){0}", _
             "WHERE s.admin_section_isdeleted = 0 {0}", _
             "  and ut.utype_id = {1} and admin_section_MenuLevel = {2} {0}", _
             "order by admin_section_menu_order"), _
             vbCrLf, utype_id.ToString, menulevel.ToString)

            Return Data.Connect.GetDataTable(sql)

        End Function

        Public Shared Function GetAdminMenuItemsByUserType(ByVal utype_id As Integer, Optional ByVal adminSectionGroup As Integer = 0) As DataTable

            Dim sql As String
            If adminSectionGroup = 0 Then

                sql = String.Format(String.Concat( _
                     "SELECT  admin_section_group_id AS id,   sg.admin_section_group_name AS name,   (select top 1 admin_file_name     FROM tbl_usertypes AS ss_ut     left join zz_admin_usertype_sectionaccess AS ss_sa      ON ss_ut.utype_id = ss_sa.sectionaccess_usertype_fk    INNER JOIN zz_admin_sections AS ss_s      ON (ss_ut.utype_hasglobalaccess = 1 OR        (ss_sa.sectionaccess_section_fk = ss_s.admin_section_id          and ss_sa.sectionaccess_showonnav = 1)) 	where ss_s.admin_section_group_fk=sg.admin_section_group_id  and  ss_s.admin_section_isdeleted = 0    and ss_ut.utype_id ={0} ORDER BY ss_s.admin_section_menu_order) as filename ,admin_section_group_order, 2, ISNULL(admin_section_group_image, 'logo.png') AS logo    FROM tbl_usertypes AS ut     left join zz_admin_usertype_sectionaccess AS sa      ON ut.utype_id = sa.sectionaccess_usertype_fk    INNER JOIN zz_admin_sections AS s      ON (ut.utype_hasglobalaccess = 1 OR        (sa.sectionaccess_section_fk = s.admin_section_id          and sa.sectionaccess_showonnav = 1))   LEFT JOIN zz_admin_section_groups as sg on sg.admin_section_group_id = s.admin_section_group_fk  WHERE admin_section_group_deleted=0 and s.admin_section_isdeleted = 0    and ut.utype_id = {0}   AND sg.admin_section_group_enabled = 1 AND sg.admin_section_group_static = 0   group by admin_section_group_id, admin_section_group_name, admin_section_group_order, admin_section_group_image  order by admin_section_group_order          "), _
                     utype_id.ToString)
            Else
                Dim filename As String = System.IO.Path.GetFileName(HttpContext.Current.Request.FilePath).ToLower()

                sql = String.Format(String.Concat( _
                 "SELECT s.admin_section_id AS id, {0}", _
                 "  s.admin_section_name AS name, {0}", _
                 "  s.admin_file_name AS filename,ISNULL(admin_section_group_id, 0) AS groupid, ISNULL(sg.admin_section_group_name,'') AS groupname, s.admin_section_never_add AS 'NeverAdd' {0}", _
                 "FROM   tbl_usertypes AS ut {0}", _
                 "  left join zz_admin_usertype_sectionaccess AS sa {0}", _
                 "    ON ut.utype_id = sa.sectionaccess_usertype_fk {0}", _
                 "  INNER JOIN zz_admin_sections AS s {0}", _
                 "    ON (ut.utype_hasglobalaccess = 1 OR {0}", _
                 "      (sa.sectionaccess_section_fk = s.admin_section_id {0}", _
                 "      and sa.sectionaccess_showonnav = 1)){0}", _
                 "      LEFT JOIN zz_admin_sections AS ss ON ss.admin_section_group_fk=s.admin_section_group_fk ", _
                 "     LEFT JOIN zz_admin_section_groups as sg on sg.admin_section_group_id = s.admin_section_group_fk  ", _
                 "   Where ", _
                 "   ", _
                 " s.admin_section_isdeleted = 0 and ss.admin_file_name = '{3}'   {0}", _
                 "  and ut.utype_id = {1} AND sg.admin_section_group_enabled = 1 AND sg.admin_section_group_static = 0  {0}", _
                 "  and s.admin_section_id NOT IN (140, 144)  {0}", _
                 "order by s.admin_section_menulevel, s.admin_section_menu_order"), _
                 vbCrLf, utype_id.ToString, adminSectionGroup, DataFunctions.FormatDBInString(filename))

            End If

            Return Data.Connect.GetDataTable(sql)
        End Function

        Public Shared Function GetStaticAdminMenuItemsByUserType(ByVal utype_id As Integer, Optional ByVal adminSectionGroup As Integer = 0) As DataTable

            Dim sql As String
            If adminSectionGroup = 0 Then

                sql = String.Format(String.Concat( _
                     "SELECT  admin_section_group_id AS id,   sg.admin_section_group_name AS name,   (select top 1 admin_file_name     FROM tbl_usertypes AS ss_ut     left join zz_admin_usertype_sectionaccess AS ss_sa      ON ss_ut.utype_id = ss_sa.sectionaccess_usertype_fk    INNER JOIN zz_admin_sections AS ss_s      ON (ss_ut.utype_hasglobalaccess = 1 OR        (ss_sa.sectionaccess_section_fk = ss_s.admin_section_id          and ss_sa.sectionaccess_showonnav = 1)) 	where ss_s.admin_section_group_fk=sg.admin_section_group_id  and  ss_s.admin_section_isdeleted = 0    and ss_ut.utype_id ={0} ORDER BY ss_s.admin_section_menu_order) as filename ,admin_section_group_order, 2, ISNULL(admin_section_group_image, 'logo.png') AS logo    FROM tbl_usertypes AS ut     left join zz_admin_usertype_sectionaccess AS sa      ON ut.utype_id = sa.sectionaccess_usertype_fk    INNER JOIN zz_admin_sections AS s      ON (ut.utype_hasglobalaccess = 1 OR        (sa.sectionaccess_section_fk = s.admin_section_id          and sa.sectionaccess_showonnav = 1))   LEFT JOIN zz_admin_section_groups as sg on sg.admin_section_group_id = s.admin_section_group_fk  WHERE admin_section_group_deleted=0 and s.admin_section_isdeleted = 0    and ut.utype_id = {0}   AND sg.admin_section_group_enabled = 1 AND sg.admin_section_group_static = 1   group by admin_section_group_id, admin_section_group_name, admin_section_group_order, admin_section_group_image  order by admin_section_group_order          "), _
                     utype_id.ToString)
            Else
                Dim filename As String = System.IO.Path.GetFileName(HttpContext.Current.Request.FilePath).ToLower()

                sql = String.Format(String.Concat( _
                 "SELECT s.admin_section_id AS id, {0}", _
                 "  s.admin_section_name AS name, {0}", _
                 "  s.admin_file_name AS filename {0}", _
                 "FROM   tbl_usertypes AS ut {0}", _
                 "  left join zz_admin_usertype_sectionaccess AS sa {0}", _
                 "    ON ut.utype_id = sa.sectionaccess_usertype_fk {0}", _
                 "  INNER JOIN zz_admin_sections AS s {0}", _
                 "    ON (ut.utype_hasglobalaccess = 1 OR {0}", _
                 "      (sa.sectionaccess_section_fk = s.admin_section_id {0}", _
                 "      and sa.sectionaccess_showonnav = 1)){0}", _
                 "      LEFT JOIN zz_admin_sections AS ss ON ss.admin_section_group_fk=s.admin_section_group_fk ", _
                 "   Where ", _
                 "   ", _
                 " s.admin_section_isdeleted = 0 and ss.admin_file_name = '{3}'   {0}", _
                 "  and ut.utype_id = {1}   {0}", _
                 "order by s.admin_section_menulevel, s.admin_section_menu_order"), _
                 vbCrLf, utype_id.ToString, adminSectionGroup, DataFunctions.FormatDBInString(filename))

            End If

            Return Data.Connect.GetDataTable(sql)
        End Function

        Public Shared Function GetCurrentAdminMenuItem() As DataRow

            Dim filename As String = System.IO.Path.GetFileName(HttpContext.Current.Request.FilePath).ToLower()

            Dim sql As String = String.Format(String.Concat( _
             "SELECT TOP 1 s.admin_section_id AS id, {0}", _
             "  s.admin_section_name AS name, {0}", _
             "  s.admin_file_name AS filename,ISNULL(admin_section_group_id, 0) AS groupid, ISNULL(sg.admin_section_group_name,'') AS groupname {0}", _
             "FROM   tbl_usertypes AS ut {0}", _
             "  left join zz_admin_usertype_sectionaccess AS sa {0}", _
             "    ON ut.utype_id = sa.sectionaccess_usertype_fk {0}", _
             "  INNER JOIN zz_admin_sections AS s {0}", _
             "    ON (ut.utype_hasglobalaccess = 1 OR {0}", _
             "      (sa.sectionaccess_section_fk = s.admin_section_id {0}", _
             "      and sa.sectionaccess_showonnav = 1)){0}", _
             "     LEFT JOIN zz_admin_section_groups as sg on sg.admin_section_group_id = s.admin_section_group_fk  ", _
             "   Where ", _
             "   ", _
             " s.admin_section_isdeleted = 0 and s.admin_file_name = '{1}'   {0}", _
             "order by s.admin_section_menulevel, s.admin_section_menu_order"), _
             vbCrLf, DataFunctions.FormatDBInString(filename))

            Return Data.Connect.GetDataRow(sql)
        End Function

        'Shared Function MapToMenuItem(ByVal dr As DataRow) As mc.MenuItem
        '    If dr Is Nothing Then
        '        Return Nothing
        '    Else
        '        Dim id As Integer = DBFactory.FromDB(Of Integer)(dr("id"))
        '        Dim name As String = DBFactory.FromDB(Of String)(dr("name"))
        '        Dim linkurl As String = "sections\" & DBFactory.FromDB(Of String)(dr("filename"))


        '        name = name.Replace(" ", "&nbsp;")

        '        Return New MenuItem(name, name, name, MenuItem.LinkModeEnum.Client, linkurl)
        '    End If
        'End Function

        'Shared Function MapToResolvedMenuItem(ByVal x As mc.MenuItem, ByVal c As Control) As mc.MenuItem
        '    If x Is Nothing Then
        '        Return Nothing
        '    Else
        '        '# resolve this linkurl
        '        Dim adminfolder As String = ConfigurationManager.AppSettings("admin_folder").ToString
        '        Return New mc.MenuItem(x.Code, x.Name, x.AltText, x.Mode, c.ResolveUrl("~/" & adminfolder & "/" & x.ClientLink))
        '        'Return New mc.MenuItem(x.Code, x.Name, x.AltText, x.Mode, x.ClientLink) '# Editied to work with encrypted admin folders
        '    End If
        'End Function

#End Region

#Region "Content Types"
        Public Shared Function GetAllContentTypes(Optional LayoutGroup As String = "default", Optional dbc As SqlDatabaseConnection = Nothing) As DataTable

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandText = "pl_ContentTypes_GetAll"
            cmd.CommandType = CommandType.StoredProcedure

            cmd.Parameters.Add(dbc.NewParameter(Of String)("@LayoutGroup", SqlDbType.VarChar, LayoutGroup))

            Return dbc.GetDataTableFromStoredProcedure(cmd, True)
        End Function

        Public Shared Function GetContentTypeByID(ContentTypeID As Integer, Optional LayoutGroup As String = "default", Optional dbc As SqlDatabaseConnection = Nothing) As DataRow

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandText = "pl_ContentTypes_GetByID"
            cmd.CommandType = CommandType.StoredProcedure

            cmd.Parameters.Add(dbc.NewParameter(Of Integer)("@ContentTypeID", SqlDbType.BigInt, ContentTypeID))
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@LayoutGroup", SqlDbType.VarChar, LayoutGroup))

            Return dbc.GetDataRowFromStoredProcedure(cmd, True)

        End Function

        Public Shared Function GetContentTypeIDByTypeReference(TypeReference As String, Optional LayoutGroup As String = "default", Optional dbc As SqlDatabaseConnection = Nothing) As Integer

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandText = "pl_ContentTypes_GetIDByTypeReference"
            cmd.CommandType = CommandType.StoredProcedure

            cmd.Parameters.Add(dbc.NewParameter(Of String)("@TypeReference", SqlDbType.VarChar, TypeReference))
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@LayoutGroup", SqlDbType.VarChar, LayoutGroup))

            Dim ReturnResult As DataRow = dbc.GetDataRowFromStoredProcedure(cmd, True)

            If ReturnResult IsNot Nothing Then
                Return DataFunctions.GetColumnFromDataRow(Of Integer)(ReturnResult, "ContentTypeID")
            Else
                Return 0
            End If

        End Function

#End Region

#Region "Content Blocks"
        Public Shared Function GetAllContentBlocks(Optional LayoutGroup As String = "default", Optional dbc As SqlDatabaseConnection = Nothing) As DataTable

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandText = "pl_ContentBlocks_GetAll"
            cmd.CommandType = CommandType.StoredProcedure

            Return dbc.GetDataTableFromStoredProcedure(cmd, True)
        End Function

        Public Shared Function GetContentBlockByID(ContentBlockID As Integer, Optional dbc As SqlDatabaseConnection = Nothing) As DataRow

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandText = "pl_ContentBlock_GetByID"
            cmd.CommandType = CommandType.StoredProcedure

            cmd.Parameters.Add(dbc.NewParameter(Of Integer)("@ContentBlockID", SqlDbType.BigInt, ContentBlockID))

            Return dbc.GetDataRowFromStoredProcedure(cmd, True)
        End Function

        Public Shared Function GetAllContentBlocksByParent(ParentID As Integer, ParentTable As String, Optional LayoutGroup As String = "default", Optional dbc As SqlDatabaseConnection = Nothing) As DataTable

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandText = "pl_ContentBlocks_GetAllByParent"
            cmd.CommandType = CommandType.StoredProcedure

            cmd.Parameters.Add(dbc.NewParameter(Of Integer)("@ParentID", SqlDbType.BigInt, ParentID))
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@ParentTable", SqlDbType.VarChar, ParentTable))

            Return dbc.GetDataTableFromStoredProcedure(cmd, True)
        End Function

        Public Shared Function GetAllContentBlocksByIDList(CurrentContentBlockIDs As String, Optional LayoutGroup As String = "default", Optional dbc As SqlDatabaseConnection = Nothing) As DataTable

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandText = "pl_ContentBlocks_GetAllByIDList"
            cmd.CommandType = CommandType.StoredProcedure

            cmd.Parameters.Add(dbc.NewParameter(Of String)("@IDList", SqlDbType.VarChar, CurrentContentBlockIDs))

            Return dbc.GetDataTableFromStoredProcedure(cmd, True)
        End Function

        Public Shared Function AddNewContentBlock(ContentTypeID As Integer, ParentID As Integer, ParentTable As String, Optional dbc As SqlDatabaseConnection = Nothing) As Integer

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandText = "pl_ContentBlock_AddRecord"
            cmd.CommandType = CommandType.StoredProcedure

            cmd.Parameters.Add(dbc.NewParameter(Of String)("@ContentTypeID", SqlDbType.VarChar, ContentTypeID.ToString()))
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@ParentID", SqlDbType.VarChar, ParentID.ToString()))
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@ParentTable", SqlDbType.VarChar, ParentTable))

            Dim ReturnResult As DataRow = dbc.GetDataRowFromStoredProcedure(cmd, True)

            If ReturnResult IsNot Nothing Then
                Return DataFunctions.GetColumnFromDataRow(Of Integer)(ReturnResult, "NewRecordID")
            Else
                Return 0
            End If

        End Function

        Public Shared Function DeleteContentBlock(ContentBlockID As Integer, Optional dbc As SqlDatabaseConnection = Nothing) As Boolean

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandText = "pl_ContentBlock_DeleteRecord"
            cmd.CommandType = CommandType.StoredProcedure

            cmd.Parameters.Add(dbc.NewParameter(Of Integer)("@ContentBlockID", SqlDbType.BigInt, ContentBlockID))

            Dim ReturnResult As DataRow = dbc.GetDataRowFromStoredProcedure(cmd, True)

            If ReturnResult IsNot Nothing Then
                Return True
            Else
                Return False
            End If

        End Function

        Public Shared Function SetContentBlockValues(ContentBlockID As Integer, ColumnName As String, ColumnValue As String, ParentID As Integer, ParentTable As String, Optional dbc As SqlDatabaseConnection = Nothing) As Integer

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandText = "pl_ContentBlock_SetValues"
            cmd.CommandType = CommandType.StoredProcedure

            cmd.Parameters.Add(dbc.NewParameter(Of Integer)("@ContentBlockID", SqlDbType.BigInt, ContentBlockID))
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@ColumnName", SqlDbType.VarChar, ColumnName))
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@ColumnValue", SqlDbType.VarChar, DataFunctions.FormatDBInString(ColumnValue)))
            cmd.Parameters.Add(dbc.NewParameter(Of Integer)("@ParentID", SqlDbType.BigInt, ParentID))
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@ParentTable", SqlDbType.VarChar, ParentTable))

            Dim ReturnResult As DataRow = dbc.GetDataRowFromStoredProcedure(cmd, True)

            If ReturnResult IsNot Nothing Then
                Return DataFunctions.GetColumnFromDataRow(Of Integer)(ReturnResult, "Result")
            Else
                Return 0
            End If

        End Function

        Public Shared Function ReorderContentBlocks(ByVal ParentID As Integer, ParentTable As String, ByVal OrderList As List(Of Integer)) As Boolean

            Dim ResultValue As Boolean = False

            Try

                Dim UpdateSQL As String = ""
                Dim CurrentIndex As Integer = 1
                For Each i As Integer In OrderList
                    UpdateSQL &= String.Format("UPDATE ContentBlocks SET Priority = {1} WHERE ParentID = {2} AND ParentTable = '{4}' AND ContentBlockID = {3}; {0}", vbCrLf, CurrentIndex.ToString(), ParentID.ToString(), i.ToString(), ParentTable)
                    CurrentIndex += 1
                Next

                Dim Result As Integer = 0

                If Not String.IsNullOrEmpty(UpdateSQL) Then
                    Result = Data.Connect.RunSQL(UpdateSQL)
                End If

                If Result > 0 Then
                    ResultValue = True
                End If

            Catch ex As Exception
                Throw New Exception("Error with ReorderContentBlocks: " & ex.Message)
            End Try

            Return ResultValue

        End Function
#End Region

    End Class

End Namespace

