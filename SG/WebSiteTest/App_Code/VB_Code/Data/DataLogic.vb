Imports Microsoft.VisualBasic
Imports System.Data
Imports System.Data.SqlClient
Imports PingCore.MyData
Imports PingSurveys.SurveyLibrary

Namespace PingLibrary

    Public Class DataLogic

#Region "Global"
        Public Shared Function CheckContentRewriteNameExists(ByVal RewriteNameToCheck As String, ByVal TableName As String, ByVal RewriteNameField As String, Optional dbc As SqlDatabaseConnection = Nothing) As Boolean

            '# Check to see if RewriteName already exists in the particular table
            If Not String.IsNullOrEmpty(RewriteNameToCheck) Then

                If dbc Is Nothing Then dbc = Data.DBConnection(True)

                Dim ItemRecord As DataRow = DataAccess.GetContentByRewriteName(TableName, RewriteNameField, RewriteNameToCheck, dbc)

                If ItemRecord IsNot Nothing Then
                    Return True
                Else
                    Return False
                End If

            Else
                Return False
            End If

        End Function

        Public Shared Function EditContentRewriteName(ItemID As Integer, TableName As String, RewriteNameField As String, PrimaryKeyField As String, RewriteName As String, Optional dbc As SqlDatabaseConnection = Nothing) As String

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandText = "pl_ContentRewriteName_Edit"
            cmd.CommandType = CommandType.StoredProcedure

            With cmd.Parameters
                .Add(dbc.NewParameter(Of Integer)("@ITEMID", SqlDbType.BigInt, ItemID))
                .Add(dbc.NewParameter(Of String)("@TABLE", SqlDbType.VarChar, TableName))
                .Add(dbc.NewParameter(Of String)("@REWRITEFIELD", SqlDbType.VarChar, RewriteNameField))
                .Add(dbc.NewParameter(Of String)("@PRIMARYKEY", SqlDbType.VarChar, PrimaryKeyField))
                .Add(dbc.NewParameter(Of String)("@REWRITENAME", SqlDbType.VarChar, RewriteName))
            End With

            Return dbc.GetDataFieldFromStoredProcedure(Of String)(cmd, True)

        End Function

        Public Shared Function CheckURLNameIsUnique(URLName As String, ItemID As Integer, TableName As String, RewriteNameField As String, PrimaryKeyField As String, DeletedField As String, Optional dbc As SqlDatabaseConnection = Nothing) As Boolean

            Dim URLUnique As Boolean = False
            Dim ResultCount As Integer = 0

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandType = CommandType.StoredProcedure

            If ItemID > 0 Then
                cmd.CommandText = "pl_URLName_CheckUniqueNotCurrentID"

                With cmd.Parameters
                    .Add(dbc.NewParameter(Of String)("@PRIMARYKEYFIELD", SqlDbType.VarChar, PrimaryKeyField))
                    .Add(dbc.NewParameter(Of Integer)("@ITEMID", SqlDbType.BigInt, ItemID))
                    .Add(dbc.NewParameter(Of String)("@TABLENAME", SqlDbType.VarChar, TableName))
                    .Add(dbc.NewParameter(Of String)("@REWRITENAMEFIELD", SqlDbType.VarChar, RewriteNameField))
                    .Add(dbc.NewParameter(Of String)("@URLNAME", SqlDbType.VarChar, DataFunctions.FormatDBInString(URLName)))
                    .Add(dbc.NewParameter(Of String)("@DELETEDFIELD", SqlDbType.VarChar, DeletedField))
                End With
            Else
                cmd.CommandText = "pl_URLName_CheckUnique"

                With cmd.Parameters
                    .Add(dbc.NewParameter(Of Integer)("@PRIMARYKEYFIELD", SqlDbType.VarChar, PrimaryKeyField))
                    .Add(dbc.NewParameter(Of String)("@TABLENAME", SqlDbType.VarChar, TableName))
                    .Add(dbc.NewParameter(Of String)("@REWRITENAMEFIELD", SqlDbType.VarChar, RewriteNameField))
                    .Add(dbc.NewParameter(Of String)("@URLNAME", SqlDbType.VarChar, DataFunctions.FormatDBInString(URLName)))
                    .Add(dbc.NewParameter(Of String)("@DELETEDFIELD", SqlDbType.VarChar, DeletedField))
                End With
            End If

            ResultCount = dbc.GetDataFieldFromStoredProcedure(Of Integer)(cmd, True)

            If ResultCount > 0 Then
                URLUnique = False
            Else
                URLUnique = True
            End If

            Return URLUnique

        End Function

#End Region

#Region "Users"

        Public Shared Function CheckUserExists(ByVal Email As String, Optional dbc As SqlDatabaseConnection = Nothing) As Boolean

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim ResultRow As DataRow = DataAccess.GetUserByEmail(Email, dbc)

            If ResultRow IsNot Nothing Then
                Return True
            Else
                Return False
            End If

        End Function

        Public Shared Function AddUser(ByVal UserEmail As String, ByVal Password As NakedPassword, Optional ByVal UserType As Integer = 3) As Integer

            Dim NewID As Integer = 0

            Try

                Dim sdb As SqlDatabaseConnection = Data.DBConnection()

                Dim Email As Email
                Dim Pwd As NakedPassword = Nothing

                '# vars
                Dim Hash As Hash
                Dim Salt As Salt

                '# gather data
                With "gather"
                    Email = Email.FromString(UserEmail)

                    With "hash"
                        Salt = Salt.Generate()
                        Pwd = Password
                        Hash = Hash.FromPassword(Pwd, Salt)
                    End With
                End With

                '# perform update
                With "sql"

                    Dim sql As String = String.Format(String.Concat( _
                      "if exists (select * from users where user_email = @EMAIL) {0}", _
                      "begin {0}", _
                      "  select cast(0 as bigint) as 'id'; {0}", _
                      "end; {0}", _
                      "else {0}", _
                      "begin {0}", _
                      "INSERT INTO users ({0}", _
                      "  user_title, user_firstname, user_surname, {0}", _
                      "  user_screen_name, user_email, {0}", _
                      "  user_password_hash, user_password_salt, user_type_fk){0}", _
                      "VALUES({0}", _
                      "  '', '', '', {0}", _
                      "  '', @EMAIL, {0}", _
                      "  @HASH, @SALT, @TYPE){0}", _
                      "select SCOPE_IDENTITY() as 'id';{0}", _
                      "end;"), _
                      vbCrLf)

                    Dim cmd As SqlCommand = sdb.GetCommand(sql)
                    With cmd.Parameters
                        .Add(sdb.NewParameter(Of String)("@EMAIL", SqlDbType.VarChar, Email.ToString))
                        .Add(sdb.NewParameter(Of Byte())("@HASH", SqlDbType.Binary, Hash.Value))
                        .Add(sdb.NewParameter(Of Byte())("@SALT", SqlDbType.Binary, Salt.Value))
                        .Add(sdb.NewParameter(Of Integer)("@TYPE", SqlDbType.BigInt, UserType))
                    End With

                    NewID = sdb.GetDataField(Of Integer)(cmd)
                End With

                If NewID <= 0 Then
                    LogError("Problem adding user: " & UserEmail, "AddUser()")
                End If

            Catch ex As Exception
                LogError(ex.Message, "AddUser()")
            End Try

            Return NewID

        End Function

        'Public Shared Function AddUser(UserEmail As String, Password As NakedPassword, Optional UserType As Integer = 3, Optional dbc As SqlDatabaseConnection = Nothing) As Integer

        '    Dim NewID As Integer = 0

        '    '# Database connection
        '    If dbc Is Nothing Then dbc = Data.DBConnection(True)

        '    Dim Email As Email
        '    Dim Pwd As NakedPassword = Nothing

        '    '# vars
        '    Dim Hash As Hash
        '    Dim Salt As Salt

        '    '# gather data
        '    With "gather"
        '        Email = Email.FromString(UserEmail)

        '        With "hash"
        '            Salt = Salt.Generate()
        '            Pwd = Password
        '            Hash = Hash.FromPassword(Pwd, Salt)
        '        End With
        '    End With

        '    Dim cmd As New SqlCommand()
        '    cmd.CommandText = "pl_User_Add"
        '    cmd.CommandType = CommandType.StoredProcedure

        '    With cmd.Parameters
        '        .Add(dbc.NewParameter(Of String)("@EMAIL", SqlDbType.VarChar, Email.ToString))
        '        .Add(dbc.NewParameter(Of Byte())("@HASH", SqlDbType.Binary, Hash.Value))
        '        .Add(dbc.NewParameter(Of Byte())("@SALT", SqlDbType.Binary, Salt.Value))
        '        .Add(dbc.NewParameter(Of Integer)("@TYPE", SqlDbType.BigInt, UserType))
        '    End With

        '    NewID = dbc.GetDataFieldFromStoredProcedure(Of Integer)(cmd, True)

        '    If NewID <= 0 Then
        '        LogError("Problem adding user: " & UserEmail, "AddUser()")
        '    End If

        '    Return NewID

        'End Function

        Public Shared Function AddUser(ByVal Title As String, ByVal FirstName As String, ByVal Surname As String, ByVal UserEmail As String, ByVal Password As NakedPassword, Optional ByVal UserType As Integer = 3) As Integer

            Dim NewID As Integer = 0

            Try

                Dim sdb As SqlDatabaseConnection = Data.DBConnection()

                Dim Email As Email
                Dim Pwd As NakedPassword = Nothing

                '# vars
                Dim Hash As Hash
                Dim Salt As Salt

                '# gather data
                With "gather"
                    Email = Email.FromString(UserEmail)

                    With "hash"
                        Salt = Salt.Generate()
                        Pwd = Password
                        Hash = Hash.FromPassword(Pwd, Salt)
                    End With
                End With

                '# perform update
                With "sql"

                    Dim sql As String = String.Format(String.Concat( _
                      "if exists (select * from users where user_email = @EMAIL) {0}", _
                      "begin {0}", _
                      "  select cast(0 as bigint) as 'id'; {0}", _
                      "end; {0}", _
                      "else {0}", _
                      "begin {0}", _
                      "INSERT INTO users ({0}", _
                      "  user_title, user_firstname, user_surname, {0}", _
                      "  user_screen_name, user_email, {0}", _
                      "  user_password_hash, user_password_salt, user_type_fk){0}", _
                      "VALUES({0}", _
                      "  @TITLE, @FIRSTNAME, @SURNAME, {0}", _
                      "  '', @EMAIL, {0}", _
                      "  @HASH, @SALT, @TYPE){0}", _
                      "select SCOPE_IDENTITY() as 'id';{0}", _
                      "end;"), _
                      vbCrLf)

                    Dim cmd As SqlCommand = sdb.GetCommand(sql)
                    With cmd.Parameters
                        .Add(sdb.NewParameter(Of String)("@TITLE", SqlDbType.NVarChar, Title))
                        .Add(sdb.NewParameter(Of String)("@FIRSTNAME", SqlDbType.NVarChar, FirstName))
                        .Add(sdb.NewParameter(Of String)("@SURNAME", SqlDbType.NVarChar, Surname))
                        .Add(sdb.NewParameter(Of String)("@EMAIL", SqlDbType.VarChar, Email.ToString))
                        .Add(sdb.NewParameter(Of Byte())("@HASH", SqlDbType.Binary, Hash.Value))
                        .Add(sdb.NewParameter(Of Byte())("@SALT", SqlDbType.Binary, Salt.Value))
                        .Add(sdb.NewParameter(Of Integer)("@TYPE", SqlDbType.BigInt, UserType))
                    End With

                    NewID = sdb.GetDataField(Of Integer)(cmd)
                End With

                If NewID <= 0 Then
                    LogError("Problem adding user: " & UserEmail, "AddUser()")
                End If

            Catch ex As Exception
                LogError(ex.Message, "AddUser()")
            End Try

            Return NewID

        End Function

        'Public Shared Function AddUser(Title As String, FirstName As String, Surname As String, UserEmail As String, Password As NakedPassword, Optional UserType As Integer = 3, Optional dbc As SqlDatabaseConnection = Nothing) As Integer

        '    Dim NewID As Integer = 0

        '    '# Database connection
        '    If dbc Is Nothing Then dbc = Data.DBConnection(True)

        '    Dim Email As Email
        '    Dim Pwd As NakedPassword = Nothing

        '    '# vars
        '    Dim Hash As Hash
        '    Dim Salt As Salt

        '    '# gather data
        '    With "gather"
        '        Email = Email.FromString(UserEmail)

        '        With "hash"
        '            Salt = Salt.Generate()
        '            Pwd = Password
        '            Hash = Hash.FromPassword(Pwd, Salt)
        '        End With
        '    End With

        '    Dim cmd As New SqlCommand()
        '    cmd.CommandText = "pl_User_AddWithNames"
        '    cmd.CommandType = CommandType.StoredProcedure

        '    With cmd.Parameters
        '        .Add(dbc.NewParameter(Of String)("@TITLE", SqlDbType.NVarChar, Title))
        '        .Add(dbc.NewParameter(Of String)("@FIRSTNAME", SqlDbType.NVarChar, FirstName))
        '        .Add(dbc.NewParameter(Of String)("@SURNAME", SqlDbType.NVarChar, Surname))
        '        .Add(dbc.NewParameter(Of String)("@EMAIL", SqlDbType.VarChar, Email.ToString))
        '        .Add(dbc.NewParameter(Of Byte())("@HASH", SqlDbType.Binary, Hash.Value))
        '        .Add(dbc.NewParameter(Of Byte())("@SALT", SqlDbType.Binary, Salt.Value))
        '        .Add(dbc.NewParameter(Of String)("@TYPE", SqlDbType.BigInt, UserType))
        '    End With

        '    NewID = dbc.GetDataField(Of Integer)(cmd)

        '    If NewID <= 0 Then
        '        LogError("Problem adding user: " & UserEmail, "AddUser()")
        '    End If

        '    Return NewID

        'End Function

        Public Shared Function UpdateUserDetailsBasic(UserID As Integer, FirstName As String, Surname As String, ReceiveNewsletter As Boolean, Optional dbc As SqlDatabaseConnection = Nothing) As Boolean

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandText = "pl_User_UpdateDetailsBasic"
            cmd.CommandType = CommandType.StoredProcedure

            With cmd.Parameters
                .Add(dbc.NewParameter(Of Integer)("@UserID", SqlDbType.BigInt, UserID))
                .Add(dbc.NewParameter(Of String)("@FirstName", SqlDbType.VarChar, FirstName))
                .Add(dbc.NewParameter(Of String)("@Surname", SqlDbType.VarChar, Surname))
                .Add(dbc.NewParameter(Of Boolean)("@ReceiveNewsletter", SqlDbType.Bit, ReceiveNewsletter))
            End With

            Dim ReturnResult As DataRow = dbc.GetDataRowFromStoredProcedure(cmd, True)
            Dim Result As Boolean = DataFunctions.GetColumnFromDataRow(Of Boolean)(ReturnResult, "Result")

            If Result Then
                Return True
            Else
                Return False
            End If

        End Function

        Public Shared Function UpdateUserPassword(ByVal UserID As Integer, ByVal NewHash As Hash, ByVal NewSalt As Salt) As Boolean

            Dim ResultValue As Boolean = False

            Try
                Dim dbc As SqlDatabaseConnection = Data.DBConnection

                Dim sql As String = String.Format(String.Concat( _
                                                "UPDATE Users SET {0} ", _
                                                "user_password_salt = @SALT, user_password_hash = @HASH, user_temporary_salt = null, user_temporary_hash = null {0} ", _
                                                "WHERE user_id = @USERID "), vbCrLf)

                Dim cmd As SqlCommand = dbc.GetCommand(sql)

                With cmd.Parameters
                    .Add(dbc.NewParameter(Of Integer)("@USERID", SqlDbType.BigInt, UserID))
                    .Add(dbc.NewParameter(Of Byte())("@HASH", SqlDbType.Binary, NewHash.Value))
                    .Add(dbc.NewParameter(Of Byte())("@SALT", SqlDbType.Binary, NewSalt.Value))
                End With

                Dim result As Integer = dbc.RunSQL(cmd)

                If result = 0 Then
                    LogError("Update failed for User Password", "UpdateUserPassword()")
                Else
                    ResultValue = True
                End If

            Catch ex As Exception
                LogError(ex.Message, "UpdateUserPassword()")
            End Try

            Return ResultValue

        End Function

        'Public Shared Function UpdateUserPassword(UserID As Integer, NewHash As Hash, NewSalt As Salt, Optional dbc As SqlDatabaseConnection = Nothing) As Boolean

        '    '# Database connection
        '    If dbc Is Nothing Then dbc = Data.DBConnection(True)

        '    Dim cmd As New SqlCommand()
        '    cmd.CommandText = "pl_User_UpdatePassword"
        '    cmd.CommandType = CommandType.StoredProcedure

        '    With cmd.Parameters
        '        .Add(dbc.NewParameter(Of Integer)("@UserID", SqlDbType.BigInt, UserID))
        '        .Add(dbc.NewParameter(Of Byte())("@HASH", SqlDbType.Binary, NewHash.Value))
        '        .Add(dbc.NewParameter(Of Byte())("@SALT", SqlDbType.Binary, NewSalt.Value))
        '    End With

        '    Dim ReturnResult As DataRow = dbc.GetDataRowFromStoredProcedure(cmd, True)
        '    Dim Result As Boolean = DataFunctions.GetColumnFromDataRow(Of Boolean)(ReturnResult, "Result")

        '    If Result Then
        '        Return True
        '    Else
        '        Return False
        '    End If

        'End Function

        Public Shared Function UpdateUserLoggedInformation(UserID As Integer, Optional dbc As SqlDatabaseConnection = Nothing) As Boolean

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandText = "pl_User_UpdateLoggedInfo"
            cmd.CommandType = CommandType.StoredProcedure

            cmd.Parameters.Add(dbc.NewParameter(Of Integer)("@UserID", SqlDbType.BigInt, UserID))

            Dim ReturnResult As DataRow = dbc.GetDataRowFromStoredProcedure(cmd, True)
            Dim Result As Boolean = DataFunctions.GetColumnFromDataRow(Of Boolean)(ReturnResult, "Result")

            If Result Then
                Return True
            Else
                Return False
            End If

        End Function

        Public Shared Function UpdateUserLoggedInformation(UserEmail As String, Optional dbc As SqlDatabaseConnection = Nothing) As Boolean

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandText = "pl_User_UpdateLoggedInfoEmail"
            cmd.CommandType = CommandType.StoredProcedure

            cmd.Parameters.Add(dbc.NewParameter(Of String)("@UserEmail", SqlDbType.VarChar, UserEmail))

            Dim ReturnResult As DataRow = dbc.GetDataRowFromStoredProcedure(cmd, True)
            Dim Result As Boolean = DataFunctions.GetColumnFromDataRow(Of Boolean)(ReturnResult, "Result")

            If Result Then
                Return True
            Else
                Return False
            End If

        End Function

        Public Shared Function UpdateUserExtraInformation(UserID As Integer, Telephone As String, ReceiveNewsletter As Boolean, Optional UserNotes As String = "", Optional TwitterName As String = "", Optional DateOfBirth As String = "", Optional dbc As SqlDatabaseConnection = Nothing) As Boolean

            Dim ResultValue As Boolean = False

            Try
                '# Database connection
                If dbc Is Nothing Then dbc = Data.DBConnection(True)

                Dim cmd As New SqlCommand()
                cmd.CommandText = "pl_User_UpdateExtraInfoByID"
                cmd.CommandType = CommandType.StoredProcedure

                With cmd.Parameters
                    .Add(dbc.NewParameter(Of Integer)("@USERID", SqlDbType.BigInt, UserID))
                    .Add(dbc.NewParameter(Of String)("@PHONE", SqlDbType.VarChar, Telephone))
                    .Add(dbc.NewParameter(Of Boolean)("@NEWSLETTER", SqlDbType.Bit, ReceiveNewsletter))
                    .Add(dbc.NewParameter(Of String)("@NOTES", SqlDbType.VarChar, UserNotes))
                    .Add(dbc.NewParameter(Of String)("@TWITTER", SqlDbType.VarChar, TwitterName))
                End With

                Dim result = dbc.GetDataFieldFromStoredProcedure(Of Integer)(cmd, True)

                '# Update Date Of Birth
                If Not String.IsNullOrEmpty(DateOfBirth) Then

                    '# Convert DateOfBirth to a date
                    Dim dDateOfBirth As Date = Nothing
                    Dim DateConvertedOK As Boolean = Date.TryParse(DateOfBirth, dDateOfBirth)

                    If DateConvertedOK AndAlso dDateOfBirth.Year > 1 Then

                        Dim cmd2 As New SqlCommand()
                        cmd2.CommandText = "pl_User_UpdateDOBByID"
                        cmd2.CommandType = CommandType.StoredProcedure

                        With cmd2.Parameters
                            .Add(dbc.NewParameter(Of Integer)("@USERID", SqlDbType.BigInt, UserID))
                            .Add(dbc.NewParameter(Of Date)("@DOB", SqlDbType.VarChar, DateOfBirth))
                        End With

                        dbc.GetDataTableFromStoredProcedure(cmd2, True)
                    End If
                End If

                If result = 0 Then
                    LogError("Update failed for User extra information", "UpdateUserExtraInformation()")
                Else
                    ResultValue = True
                End If

            Catch ex As Exception
                LogError(ex.Message, "UpdateUserExtraInformation()")
            End Try

            Return ResultValue

        End Function

        Public Shared Function UpdateUserExtraInformation(UserEmail As String, Telephone As String, ReceiveNewsletter As Boolean, Optional UserNotes As String = "", Optional TwitterName As String = "", Optional DateOfBirth As String = "", Optional dbc As SqlDatabaseConnection = Nothing) As Boolean

            Dim ResultValue As Boolean = False

            Try
                '# Database connection
                If dbc Is Nothing Then dbc = Data.DBConnection(True)

                Dim cmd As New SqlCommand()
                cmd.CommandText = "pl_User_UpdateExtraInfoByEmail"
                cmd.CommandType = CommandType.StoredProcedure

                With cmd.Parameters
                    cmd.Parameters.Add(dbc.NewParameter(Of String)("@USEREMAIL", SqlDbType.VarChar, UserEmail))
                    cmd.Parameters.Add(dbc.NewParameter(Of String)("@PHONE", SqlDbType.VarChar, Telephone))
                    cmd.Parameters.Add(dbc.NewParameter(Of Boolean)("@NEWSLETTER", SqlDbType.Bit, ReceiveNewsletter))
                    cmd.Parameters.Add(dbc.NewParameter(Of String)("@NOTES", SqlDbType.VarChar, UserNotes))
                    cmd.Parameters.Add(dbc.NewParameter(Of String)("@TWITTER", SqlDbType.VarChar, TwitterName))
                End With

                Dim result = dbc.GetDataFieldFromStoredProcedure(Of Integer)(cmd, True)

                '# Update Date Of Birth
                If Not String.IsNullOrEmpty(DateOfBirth) Then

                    '# Convert DateOfBirth to a date
                    Dim dDateOfBirth As Date = Nothing
                    Dim DateConvertedOK As Boolean = Date.TryParse(DateOfBirth, dDateOfBirth)

                    If DateConvertedOK AndAlso dDateOfBirth.Year > 1 Then

                        Dim cmd2 As New SqlCommand()
                        cmd2.CommandText = "pl_User_UpdateDOBByEmail"
                        cmd2.CommandType = CommandType.StoredProcedure

                        With cmd2.Parameters
                            .Add(dbc.NewParameter(Of String)("@USEREMAIL", SqlDbType.VarChar, UserEmail))
                            .Add(dbc.NewParameter(Of Date)("@DOB", SqlDbType.VarChar, DateOfBirth))
                        End With

                        dbc.GetDataTableFromStoredProcedure(cmd2, True)
                    End If
                End If

                If result = 0 Then
                    LogError("Update failed for User extra information", "UpdateUserExtraInformation()")
                Else
                    ResultValue = True
                End If

            Catch ex As Exception
                LogError(ex.Message, "UpdateUserExtraInformation()")
            End Try

            Return ResultValue

        End Function

        Public Shared Function UpdateUserGiftAid(UserID As Integer, GiftAid As Boolean, Optional dbc As SqlDatabaseConnection = Nothing) As Boolean

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandText = "pl_User_UpdateGiftAid"
            cmd.CommandType = CommandType.StoredProcedure

            With cmd.Parameters
                .Add(dbc.NewParameter(Of Integer)("@UserID", SqlDbType.BigInt, UserID))
                .Add(dbc.NewParameter(Of Boolean)("@GiftAid", SqlDbType.Bit, GiftAid))
            End With

            Dim ReturnResult As DataRow = dbc.GetDataRowFromStoredProcedure(cmd, True)
            Dim Result As Boolean = DataFunctions.GetColumnFromDataRow(Of Boolean)(ReturnResult, "Result")

            If Result Then
                Return True
            Else
                Return False
            End If

        End Function

        Public Shared Function UpdateUserGiftAid(UserEmail As String, GiftAid As Boolean, Optional dbc As SqlDatabaseConnection = Nothing) As Boolean

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandText = "pl_User_UpdateGiftAidEmail"
            cmd.CommandType = CommandType.StoredProcedure

            With cmd.Parameters
                .Add(dbc.NewParameter(Of String)("@UserEmail", SqlDbType.VarChar, UserEmail))
                .Add(dbc.NewParameter(Of Boolean)("@GiftAid", SqlDbType.Bit, GiftAid))
            End With

            Dim ReturnResult As DataRow = dbc.GetDataRowFromStoredProcedure(cmd, True)
            Dim Result As Boolean = DataFunctions.GetColumnFromDataRow(Of Boolean)(ReturnResult, "Result")

            If Result Then
                Return True
            Else
                Return False
            End If

        End Function

#End Region

#Region "Surveys"
        Public Shared Function AddSurvey(SurveyNumber As Integer, Name As String, Status As String, CreatedOn As Date, ModifiedOn As Date, Optional dbc As SqlDatabaseConnection = Nothing) As DataRow

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection()

            Dim cmd As New SqlCommand()
            cmd.CommandText = "bl_Surveys_AddNew"
            cmd.CommandType = CommandType.StoredProcedure

            cmd.Parameters.Add(dbc.NewParameter(Of String)("@SurveyNumber", SqlDbType.BigInt, SurveyNumber))
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@Name", SqlDbType.VarChar, Name))
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@Status", SqlDbType.VarChar, Status))
            cmd.Parameters.Add(dbc.NewParameter(Of Date)("@CreatedOn", SqlDbType.DateTime, CreatedOn))
            cmd.Parameters.Add(dbc.NewParameter(Of Date)("@ModifiedOn", SqlDbType.DateTime, ModifiedOn))

            Return dbc.GetDataRowFromStoredProcedure(cmd)

        End Function

        Public Shared Function DeleteSurvey(SurveyID As Integer, Optional dbc As SqlDatabaseConnection = Nothing) As DataRow

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection()

            Dim cmd As New SqlCommand()
            cmd.CommandText = "bl_Surveys_Delete"
            cmd.CommandType = CommandType.StoredProcedure

            cmd.Parameters.Add(dbc.NewParameter(Of Integer)("@SurveyID", SqlDbType.BigInt, SurveyID))

            Return dbc.GetDataRowFromStoredProcedure(cmd)

        End Function

        Public Shared Function UpdateViewDetailsFromSurveyNumber(SurveyNumber As Integer, ViewDetails As Boolean, Optional dbc As SqlDatabaseConnection = Nothing) As DataRow

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection()

            Dim cmd As New SqlCommand()
            cmd.CommandText = "bl_Surveys_UpdateViewDetailsFromSurveyNumber"
            cmd.CommandType = CommandType.StoredProcedure

            cmd.Parameters.Add(dbc.NewParameter(Of Integer)("@SurveyNumber", SqlDbType.BigInt, SurveyNumber))
            cmd.Parameters.Add(dbc.NewParameter(Of Boolean)("@ViewDetails", SqlDbType.Bit, ViewDetails))

            Return dbc.GetDataRowFromStoredProcedure(cmd)

        End Function

        Public Shared Function UpdateQuestionsToHideFromSurveyNumber(SurveyNumber As Integer, QuestionsToHide As String, Optional dbc As SqlDatabaseConnection = Nothing) As DataRow

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection()

            Dim cmd As New SqlCommand()
            cmd.CommandText = "bl_Surveys_UpdateQuestionsToHideFromSurveyNumber"
            cmd.CommandType = CommandType.StoredProcedure

            cmd.Parameters.Add(dbc.NewParameter(Of Integer)("@SurveyNumber", SqlDbType.BigInt, SurveyNumber))
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@QuestionsToHide", SqlDbType.VarChar, QuestionsToHide))

            Return dbc.GetDataRowFromStoredProcedure(cmd)

        End Function

        Public Shared Function UpdateMinimumResponsesAllowedFromSurveyNumber(SurveyNumber As Integer, MinimumResponsesAllowed As Integer, Optional dbc As SqlDatabaseConnection = Nothing) As DataRow

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection()

            Dim cmd As New SqlCommand()
            cmd.CommandText = "bl_Surveys_UpdateMinimumResponsesAllowedFromSurveyNumber"
            cmd.CommandType = CommandType.StoredProcedure

            cmd.Parameters.Add(dbc.NewParameter(Of Integer)("@SurveyNumber", SqlDbType.BigInt, SurveyNumber))
            cmd.Parameters.Add(dbc.NewParameter(Of Integer)("@MinimumResponsesAllowed", SqlDbType.Int, MinimumResponsesAllowed))

            Return dbc.GetDataRowFromStoredProcedure(cmd)

        End Function

        Public Shared Function AddUserSurvey(SurveyID As Integer, UserID As Integer, SurveyName As String, Optional dbc As SqlDatabaseConnection = Nothing) As DataRow

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection()

            Dim cmd As New SqlCommand()
            cmd.CommandText = "bl_UserSurveys_AddNew"
            cmd.CommandType = CommandType.StoredProcedure

            cmd.Parameters.Add(dbc.NewParameter(Of Integer)("@SurveyID", SqlDbType.BigInt, SurveyID))
            cmd.Parameters.Add(dbc.NewParameter(Of Integer)("@UserID", SqlDbType.BigInt, UserID))
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@SurveyName", SqlDbType.VarChar, SurveyName))

            Return dbc.GetDataRowFromStoredProcedure(cmd)

        End Function

        Public Shared Function DeleteUserSurvey(SurveyID As Integer, UserID As Integer, Optional dbc As SqlDatabaseConnection = Nothing) As DataRow

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection()

            Dim cmd As New SqlCommand()
            cmd.CommandText = "bl_UserSurveys_Delete"
            cmd.CommandType = CommandType.StoredProcedure

            cmd.Parameters.Add(dbc.NewParameter(Of Integer)("@SurveyID", SqlDbType.BigInt, SurveyID))
            cmd.Parameters.Add(dbc.NewParameter(Of Integer)("@UserID", SqlDbType.BigInt, UserID))

            Return dbc.GetDataRowFromStoredProcedure(cmd)

        End Function
#End Region

#Region "Responses"
        Public Shared Function AddEditExcludedResponse(ResponseID As Integer, SurveyID As Integer, Optional dbc As SqlDatabaseConnection = Nothing) As DataRow

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection()

            Dim cmd As New SqlCommand()
            cmd.CommandText = "bl_ExcludedResponses_AddEdit"
            cmd.CommandType = CommandType.StoredProcedure

            cmd.Parameters.Add(dbc.NewParameter(Of Integer)("@ResponseID", SqlDbType.BigInt, ResponseID))
            cmd.Parameters.Add(dbc.NewParameter(Of Integer)("@SurveyID", SqlDbType.BigInt, SurveyID))

            Return dbc.GetDataRowFromStoredProcedure(cmd)

        End Function
#End Region

#Region "Email"

        Public Shared Function AddEmailLog(ToAddress As String, FromAddress As String, Subject As String, Body As String, Optional dbc As SqlDatabaseConnection = Nothing) As Boolean

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandText = "pl_Email_Log"
            cmd.CommandType = CommandType.StoredProcedure

            With cmd.Parameters
                .Add(dbc.NewParameter(Of String)("@TO", SqlDbType.VarChar, ToAddress))
                .Add(dbc.NewParameter(Of String)("@FROM", SqlDbType.VarChar, FromAddress))
                .Add(dbc.NewParameter(Of String)("@SUBJECT", SqlDbType.VarChar, Subject))
                .Add(dbc.NewParameter(Of String)("@BODY", SqlDbType.VarChar, Body))
            End With

            Dim ReturnResult As DataRow = dbc.GetDataRowFromStoredProcedure(cmd, True)
            Dim Result As Boolean = DataFunctions.GetColumnFromDataRow(Of Boolean)(ReturnResult, "Result")

            If Result Then
                Return True
            Else
                Return False
            End If

        End Function

#End Region

#Region "Error Log"

        Public Shared Function LogError(ErrorDetails As String, Location As String, Optional dbc As SqlDatabaseConnection = Nothing) As Boolean

            '# Database connection
            If dbc Is Nothing Then dbc = Data.DBConnection(True)

            Dim cmd As New SqlCommand()
            cmd.CommandText = "pl_Error_Log"
            cmd.CommandType = CommandType.StoredProcedure

            With cmd.Parameters
                .Add(dbc.NewParameter(Of String)("@ERROR", SqlDbType.VarChar, ErrorDetails))
                .Add(dbc.NewParameter(Of String)("@LOCATION", SqlDbType.VarChar, Location))
            End With

            Dim ReturnResult As DataRow = dbc.GetDataRowFromStoredProcedure(cmd, True)
            Dim Result As Boolean = DataFunctions.GetColumnFromDataRow(Of Boolean)(ReturnResult, "Result")

            If Result Then
                Return True
            Else
                Return False
            End If

        End Function

#End Region

#Region "tungns"
        Public Shared Function Access_AddSurvey(SurveyNumber As Survey) As DataRow

            '# Database connection
            Dim dbc As SqlDatabaseConnection = Nothing
            dbc = Data.DBConnection()

            Dim cmd As New SqlCommand()
            cmd.CommandText = "sg_Survey_AddNew"
            cmd.CommandType = CommandType.StoredProcedure

            cmd.Parameters.Add(dbc.NewParameter(Of String)("@blockby", SqlDbType.VarChar, SurveyNumber.Blockby))
            cmd.Parameters.Add(dbc.NewParameter(Of Date)("@CreateOn", SqlDbType.Date, SurveyNumber.CreatedOn))
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@DecorativeHeaderImage", SqlDbType.VarChar, SurveyNumber.CreatedOn))
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@ForwardOnly", SqlDbType.VarChar, SurveyNumber.CreatedOn))
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@ID", SqlDbType.VarChar, SurveyNumber.ID))
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@InternalTitle", SqlDbType.VarChar, SurveyNumber.InternalTitle))
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@Languages", SqlDbType.VarChar, SurveyNumber.Languages))
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@MinimumResponsesAllowed", SqlDbType.VarChar, SurveyNumber.MinimumResponsesAllowed))
            cmd.Parameters.Add(dbc.NewParameter(Of Date)("@ModifiedOn", SqlDbType.Date, SurveyNumber.ModifiedOn))
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@QuestionsToHideValue", SqlDbType.VarChar, SurveyNumber.QuestionsToHide))
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@Status", SqlDbType.VarChar, SurveyNumber.Status))
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@SubType", SqlDbType.VarChar, SurveyNumber.SubType))
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@Team", SqlDbType.VarChar, SurveyNumber.Team))
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@Theme", SqlDbType.VarChar, SurveyNumber.Theme))
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@Title", SqlDbType.VarChar, SurveyNumber.Title))
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@TitleML", SqlDbType.VarChar, SurveyNumber.TitleML))
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@Type", SqlDbType.VarChar, SurveyNumber.Type))
            cmd.Parameters.Add(dbc.NewParameter(Of Boolean)("@ViewDetails", SqlDbType.Bit, SurveyNumber.ViewDetails))

            For Each _surveyResponse As SurveyResponse In SurveyNumber.AllResponses
                Access_AddSurveyResponse(_surveyResponse, SurveyNumber.ID)
            Next
            Return dbc.GetDataRowFromStoredProcedure(cmd)

        End Function

        Public Shared Function Access_AddSurveyResponse(SurveyNumber As SurveyResponse, SurveyId As String) As DataRow
            Dim dbc As SqlDatabaseConnection = Nothing
            dbc = Data.DBConnection()

            Dim cmd As New SqlCommand()
            cmd.CommandText = "sg_SurveyResponse_AddNew"
            cmd.CommandType = CommandType.StoredProcedure

            cmd.Parameters.Add(dbc.NewParameter(Of String)("@SurveyId", SqlDbType.VarChar, SurveyId))
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@ContactID", SqlDbType.VarChar, SurveyNumber.ContactID))
            cmd.Parameters.Add(dbc.NewParameter(Of Date)("@DateSubmitted", SqlDbType.Date, SurveyNumber.DateSubmitted))
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@ID", SqlDbType.VarChar, SurveyNumber.ID))
            cmd.Parameters.Add(dbc.NewParameter(Of Boolean)("@IsTestData", SqlDbType.Bit, SurveyNumber.IsTestData))
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@ResponseComment", SqlDbType.VarChar, SurveyNumber.ResponseComment))
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@ResponseID", SqlDbType.VarChar, SurveyNumber.ResponseID))
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@Status", SqlDbType.VarChar, SurveyNumber.Status))
            For Each _surveyResponse As SurveyResponseQuestion In SurveyNumber.ResponseQuestions
                Access_AddSurveyResponseQuestion(_surveyResponse, SurveyId, SurveyNumber.ResponseID)
            Next
            Return dbc.GetDataRowFromStoredProcedure(cmd)
        End Function

        Public Shared Function Access_AddSurveyResponseQuestion(SurveyNumber As SurveyResponseQuestion, SurveyId As String, ResponseId As String) As DataRow
            Dim dbc As SqlDatabaseConnection = Nothing
            dbc = Data.DBConnection()

            Dim cmd As New SqlCommand()
            cmd.CommandText = "sg_SurveyResponseQuestion_AddNew"
            cmd.CommandType = CommandType.StoredProcedure
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@AnswerValue", SqlDbType.VarChar, SurveyNumber.AnswerValue))
            cmd.Parameters.Add(dbc.NewParameter(Of Boolean)("@FreeTextAnswer", SqlDbType.Bit, SurveyNumber.FreeTextAnswer))
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@OptionID", SqlDbType.VarChar, SurveyNumber.OptionID))
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@QuestionID", SqlDbType.VarChar, SurveyNumber.QuestionID))
            cmd.Parameters.Add(dbc.NewParameter(Of Boolean)("@QuestionShown", SqlDbType.Bit, SurveyNumber.QuestionShown))
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@SurveyId", SqlDbType.VarChar, SurveyId))
            cmd.Parameters.Add(dbc.NewParameter(Of String)("@ResponseId", SqlDbType.VarChar, ResponseId))
            Return dbc.GetDataRowFromStoredProcedure(cmd)
        End Function
#End Region

    End Class

End Namespace
