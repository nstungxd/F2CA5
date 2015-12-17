Imports Microsoft.VisualBasic
Imports System.Data
Imports System.Data.SqlClient

Namespace PingLibrary

    Public NotInheritable Class DataAccess

#Region "Global"

        Public Shared Function GetAllGlobalContent(Optional dbc As SqlDatabaseConnection = Nothing) As DataTable

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandText = "pl_GlobalContent_GetAll"
            cmd.CommandType = CommandType.StoredProcedure

            Return dbc.GetDataTableFromStoredProcedure(cmd, True)

        End Function

        Public Shared Function GetGlobalContentByID(ID As Integer, Optional dbc As SqlDatabaseConnection = Nothing) As DataRow

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandText = "pl_GlobalContent_GetByID"
            cmd.CommandType = CommandType.StoredProcedure

            cmd.Parameters.Add(dbc.NewParameter(Of Integer)("@ID", SqlDbType.BigInt, ID))

            Return dbc.GetDataRowFromStoredProcedure(cmd, True)

        End Function

        Public Shared Function GetGlobalContentValue(ID As Integer, Optional dbc As SqlDatabaseConnection = Nothing) As String

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandText = "pl_GlobalContent_GetValueByID"
            cmd.CommandType = CommandType.StoredProcedure

            cmd.Parameters.Add(dbc.NewParameter(Of Integer)("@ID", SqlDbType.BigInt, ID))

            Return dbc.GetDataFieldFromStoredProcedure(Of String)(cmd, True)

        End Function

        Public Shared Function GetGlobalContentValue(Of T)(ID As Integer, Optional dbc As SqlDatabaseConnection = Nothing) As T

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandText = "pl_GlobalContent_GetValueByID"
            cmd.CommandType = CommandType.StoredProcedure

            cmd.Parameters.Add(dbc.NewParameter(Of Integer)("@ID", SqlDbType.BigInt, ID))

            Return dbc.GetDataFieldFromStoredProcedure(Of T)(cmd, True)

        End Function

        Public Shared Function GetAllSettings(Optional dbc As SqlDatabaseConnection = Nothing) As DataTable

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandText = "pl_Settings_GetAll"
            cmd.CommandType = CommandType.StoredProcedure

            Return dbc.GetDataTableFromStoredProcedure(cmd, True)

        End Function

        Public Shared Function GetSettingByID(ID As Integer, Optional dbc As SqlDatabaseConnection = Nothing) As DataRow

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandText = "pl_Setting_GetByID"
            cmd.CommandType = CommandType.StoredProcedure

            cmd.Parameters.Add(dbc.NewParameter(Of Integer)("@ID", SqlDbType.BigInt, ID))

            Return dbc.GetDataRowFromStoredProcedure(cmd, True)

        End Function

        Public Shared Function GetSettingValue(ID As Integer, Optional dbc As SqlDatabaseConnection = Nothing) As String

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandText = "pl_Setting_GetValueByID"
            cmd.CommandType = CommandType.StoredProcedure

            cmd.Parameters.Add(dbc.NewParameter(Of Integer)("@ID", SqlDbType.BigInt, ID))

            Return dbc.GetDataFieldFromStoredProcedure(Of String)(cmd, True)

        End Function

        Public Shared Function GetSettingValue(Of T)(ID As Integer, Optional dbc As SqlDatabaseConnection = Nothing) As T

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandText = "pl_Setting_GetValueByID"
            cmd.CommandType = CommandType.StoredProcedure

            cmd.Parameters.Add(dbc.NewParameter(Of Integer)("@ID", SqlDbType.BigInt, ID))

            Return dbc.GetDataFieldFromStoredProcedure(Of T)(cmd, True)

        End Function

        Public Shared Function GetContentRewriteNameByID(ItemID As Integer, TableName As String, RewriteNameField As String, PrimaryKeyField As String, Optional dbc As SqlDatabaseConnection = Nothing) As String

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandText = "pl_ContentRewriteName_GetByID"
            cmd.CommandType = CommandType.StoredProcedure

            With cmd.Parameters
                .Add(dbc.NewParameter(Of Integer)("@ItemID", SqlDbType.BigInt, ItemID))
                .Add(dbc.NewParameter(Of String)("@TableName", SqlDbType.VarChar, TableName))
                .Add(dbc.NewParameter(Of String)("@RewriteNameField", SqlDbType.VarChar, RewriteNameField))
                .Add(dbc.NewParameter(Of String)("@PrimaryKeyField", SqlDbType.VarChar, PrimaryKeyField))
            End With

            Return dbc.GetDataFieldFromStoredProcedure(Of String)(cmd, True)
        End Function

        Public Shared Function GetContentByRewriteName(TableName As String, RewriteNameField As String, RewriteName As String, Optional dbc As SqlDatabaseConnection = Nothing) As DataRow

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandText = "pl_Content_GetByRewriteName"
            cmd.CommandType = CommandType.StoredProcedure

            With cmd.Parameters
                .Add(dbc.NewParameter(Of String)("@TableName", SqlDbType.VarChar, TableName))
                .Add(dbc.NewParameter(Of String)("@RewriteNameField", SqlDbType.VarChar, RewriteNameField))
                .Add(dbc.NewParameter(Of String)("@RewriteName", SqlDbType.VarChar, RewriteName))
            End With

            Return dbc.GetDataRowFromStoredProcedure(cmd, True)
        End Function

        Public Shared Function GetContentName(ItemID As Integer, TableName As String, NameField As String, PrimaryKeyField As String, Optional dbc As SqlDatabaseConnection = Nothing) As String

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandText = "pl_ContentName_GetByID"
            cmd.CommandType = CommandType.StoredProcedure

            With cmd.Parameters
                .Add(dbc.NewParameter(Of Integer)("@ItemID", SqlDbType.BigInt, ItemID))
                .Add(dbc.NewParameter(Of String)("@TableName", SqlDbType.VarChar, TableName))
                .Add(dbc.NewParameter(Of String)("@NameField", SqlDbType.VarChar, NameField))
                .Add(dbc.NewParameter(Of String)("@PrimaryKeyField", SqlDbType.VarChar, PrimaryKeyField))
            End With

            Return dbc.GetDataFieldFromStoredProcedure(Of String)(cmd, True)
        End Function

        Public Shared Function GetOriginalImage(ImageID As Integer, Optional dbc As SqlDatabaseConnection = Nothing) As DataRow

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandText = "pl_OriginalImage_GetByID"
            cmd.CommandType = CommandType.StoredProcedure

            cmd.Parameters.Add(dbc.NewParameter(Of Integer)("@ImageID", SqlDbType.BigInt, ImageID))

            Return dbc.GetDataRowFromStoredProcedure(cmd, True)

        End Function

        Public Shared Function GetImageExtension(ImageID As Integer, Optional dbc As SqlDatabaseConnection = Nothing) As String

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandText = "pl_ImageExtension_GetByID"
            cmd.CommandType = CommandType.StoredProcedure

            cmd.Parameters.Add(dbc.NewParameter(Of Integer)("@ImageID", SqlDbType.BigInt, ImageID))

            Return dbc.GetDataFieldFromStoredProcedure(Of String)(cmd, True)

        End Function

#End Region

#Region "Email"

        Public Shared Function GetEmailCopyByID(ID As Integer, Optional dbc As SqlDatabaseConnection = Nothing) As DataRow

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandText = "pl_EmailCopy_GetByID"
            cmd.CommandType = CommandType.StoredProcedure

            cmd.Parameters.Add(dbc.NewParameter(Of Integer)("@ID", SqlDbType.BigInt, ID))

            Return dbc.GetDataRowFromStoredProcedure(cmd, True)

        End Function

#End Region

#Region "Users"

        Public Shared Function GetUserByID(ID As Integer, Optional dbc As SqlDatabaseConnection = Nothing) As DataRow

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandText = "pl_User_GetByID"
            cmd.CommandType = CommandType.StoredProcedure

            cmd.Parameters.Add(dbc.NewParameter(Of Integer)("@ID", SqlDbType.BigInt, ID))

            Return dbc.GetDataRowFromStoredProcedure(cmd, True)

        End Function

        Public Shared Function GetUserByEmail(Email As String, Optional dbc As SqlDatabaseConnection = Nothing) As DataRow

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            If Not String.IsNullOrEmpty(Email) AndAlso Email.Length > 0 Then

                Dim cmd As New SqlCommand()
                cmd.CommandText = "pl_User_GetByEmail"
                cmd.CommandType = CommandType.StoredProcedure

                cmd.Parameters.Add(dbc.NewParameter(Of String)("@Email", SqlDbType.VarChar, Email))

                Return dbc.GetDataRowFromStoredProcedure(cmd, True)
            Else
                Return Nothing
            End If

        End Function

#End Region

#Region "Surveys"
        Public Shared Function GetAllSurveys(Optional dbc As SqlDatabaseConnection = Nothing) As DataTable

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection()

            Dim cmd As New SqlCommand()
            cmd.CommandText = "bl_Surveys_GetAll"
            cmd.CommandType = CommandType.StoredProcedure

            Return dbc.GetDataTableFromStoredProcedure(cmd)

        End Function

        Public Shared Function GetSurveyBySurveyNumber(SurveyNumber As Integer, Optional dbc As SqlDatabaseConnection = Nothing) As DataRow

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection()

            Dim cmd As New SqlCommand()
            cmd.CommandText = "bl_Surveys_GetBySurveyNumber"
            cmd.CommandType = CommandType.StoredProcedure

            cmd.Parameters.Add(dbc.NewParameter(Of Integer)("@SurveyNumber", SqlDbType.BigInt, SurveyNumber))

            Return dbc.GetDataRowFromStoredProcedure(cmd)

        End Function

        Public Shared Function GetAllUserSurveys(ID As Integer, Optional dbc As SqlDatabaseConnection = Nothing) As DataTable

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection()

            Dim cmd As New SqlCommand()
            cmd.CommandText = "bl_UserSurveys_GetAll"
            cmd.CommandType = CommandType.StoredProcedure

            cmd.Parameters.Add(dbc.NewParameter(Of Integer)("@UserID", SqlDbType.BigInt, ID))

            Return dbc.GetDataTableFromStoredProcedure(cmd)

        End Function
#End Region

#Region "Responses"
        Public Shared Function GetExcludedResponsesBySurveyID(SurveyID As Integer, Optional dbc As SqlDatabaseConnection = Nothing) As DataTable

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection()

            Dim cmd As New SqlCommand()
            cmd.CommandText = "bl_ExcludedResponses_GetBySurveyID"
            cmd.CommandType = CommandType.StoredProcedure

            cmd.Parameters.Add(dbc.NewParameter(Of Integer)("@SurveyID", SqlDbType.BigInt, SurveyID))

            Return dbc.GetDataTableFromStoredProcedure(cmd)

        End Function

        Public Shared Function GetExcludedResponseByResponseID(ResponseID As Integer, Optional dbc As SqlDatabaseConnection = Nothing) As Boolean

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection()

            Dim cmd As New SqlCommand()
            cmd.CommandText = "bl_ExcludedResponses_GetByResponseID"
            cmd.CommandType = CommandType.StoredProcedure

            cmd.Parameters.Add(dbc.NewParameter(Of Integer)("@ResponseID", SqlDbType.BigInt, ResponseID))

            Dim Response As DataRow = dbc.GetDataRowFromStoredProcedure(cmd)

            Return DataFunctions.GetColumnFromDataRow(Of Boolean)(Response, "ExcludedResponseID")

        End Function

#End Region

#Region "CSV"

        Public Shared Function GetAllCSVUsers(Optional dbc As SqlDatabaseConnection = Nothing) As DataTable

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandText = "pl_CSVUsers_GetAll"
            cmd.CommandType = CommandType.StoredProcedure

            Return dbc.GetDataTableFromStoredProcedure(cmd, True)

        End Function

        Public Shared Function GetAllCSVNewsletterSignUps(Optional dbc As SqlDatabaseConnection = Nothing) As DataTable

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandText = "pl_CSVSignups_GetAll"
            cmd.CommandType = CommandType.StoredProcedure

            Return dbc.GetDataTableFromStoredProcedure(cmd, True)

        End Function
#End Region

    End Class

End Namespace

