Imports Microsoft.VisualBasic
Imports System.Data
Imports System.Data.SqlClient

Namespace PingLibrary

    Public Interface IDatabaseConnection
        Function RunSQL(ByVal sql As String) As Integer
        Function GetDataTable(ByVal sql As String) As DataTable
        Function GetDataTable(ByVal sql As String, ByRef ds As DataSet, ByVal name As String) As DataTable
        Function GetDataTablePaged(ByVal sql As String, ByVal StartRow As Integer, ByVal EndRow As Integer) As DataTable
        Function GetDataRow(ByVal sql As String) As DataRow
        Function GetDataField(Of T)(ByVal sql As String) As T

        Function GetCommand(ByVal sql As String) As IDbCommand
        Function GetReader(ByVal sql As String) As IDataReader
        Function GetConnection() As IDbConnection
    End Interface

    Public NotInheritable Class Data

        Private Sub New()
        End Sub

        Public Shared ReadOnly Property Connect(Optional UseGlobal As Boolean = False) As IDatabaseConnection
            Get
                If Not UseGlobal Then
                    Return New SqlDatabaseConnection(ConnectionString)
                Else
                    Return New SqlDatabaseConnection(GlobalConnectionString)
                End If
            End Get
        End Property

        Public Shared ReadOnly Property DBConnection(Optional UseGlobal As Boolean = False) As SqlDatabaseConnection
            Get
                Return CType(Connect(UseGlobal), SqlDatabaseConnection)
            End Get
        End Property

        Private Shared _ConnectionString As String
        Public Shared Property ConnectionString As String
            Get
                If String.IsNullOrEmpty(_ConnectionString) Then _ConnectionString = System.Configuration.ConfigurationManager.ConnectionStrings("DefaultConnectionString").ToString()
                Return _ConnectionString
            End Get
            Set(ByVal value As String)
                _ConnectionString = value
            End Set
        End Property

        Private Shared _GlobalConnectionString As String
        Public Shared Property GlobalConnectionString As String
            Get
                If String.IsNullOrEmpty(_GlobalConnectionString) Then _GlobalConnectionString = System.Configuration.ConfigurationManager.ConnectionStrings("GlobalConnectionString").ToString()
                Return _GlobalConnectionString
            End Get
            Set(ByVal value As String)
                _GlobalConnectionString = value
            End Set
        End Property

    End Class

    Public Class SqlDatabaseConnection
        Implements IDatabaseConnection

        Private objConn As SqlConnection
        Private sqlSQL As String

        Sub New(ByVal strConn As String)
            ConnString = strConn
        End Sub

#Region "ConnString"
        Private _strConn As String
        Protected Property ConnString() As String
            Get
                Return _strConn
            End Get
            Set(ByVal value As String)
                _strConn = value
            End Set
        End Property
#End Region

        Public Function GetConnection() As IDbConnection Implements IDatabaseConnection.GetConnection
            Return New SqlConnection(ConnString)
        End Function

        Public Overridable Function RunSQL(ByVal sql As String) As Integer Implements IDatabaseConnection.RunSQL
            Return RunSQL(GetCommand(sql))
        End Function

        Public Overridable Function RunSql(ByVal cmd As IDbCommand) As Integer
            objConn = New SqlConnection(ConnString)

            objConn.Open()
            cmd.Connection = objConn
            Dim rows As Integer = cmd.ExecuteNonQuery()
            objConn.Dispose()
            cmd.Connection = Nothing

            Return rows
        End Function

        Public Function GetDataTable(ByVal sql As String) As DataTable Implements IDatabaseConnection.GetDataTable
            Dim dtOurData As New DataTable("MyData")
            Dim MyAdapter As New SqlDataAdapter(sql, ConnString)
            MyAdapter.Fill(dtOurData)
            MyAdapter.Dispose()
            Return dtOurData
        End Function

        Public Function GetDataTable(ByVal sqlcmd As IDbCommand) As DataTable
            Dim dtOurData As New DataTable("MyData")
            Dim MyAdapter As New SqlDataAdapter(sqlcmd)
            MyAdapter.Fill(dtOurData)
            MyAdapter.Dispose()
            Return dtOurData
        End Function

        Public Function GetDataTableFromStoredProcedure(ByVal sqlcmd As IDbCommand, Optional UseGlobal As Boolean = False) As DataTable
            Dim dtOurData As New DataTable("MyData")
            objConn = New SqlConnection(ConnString)

            Try
                '# Add tablename is required
                If UseGlobal Then
                    sqlcmd.Parameters.Add(NewParameter(Of String)("@DatabaseName", SqlDbType.VarChar, System.Configuration.ConfigurationManager.AppSettings("db_name").ToString()))
                End If

                sqlcmd.CommandTimeout = 600
                sqlcmd.Connection = objConn
                Dim SQLDBDataReader As SqlDataReader = GetReader(sqlcmd)
                dtOurData.Load(SQLDBDataReader)
                objConn.Close()
                SQLDBDataReader.Close()
                sqlcmd.Connection = Nothing
            Catch ex As Exception
                objConn.Close()
                objConn.Dispose()
            End Try

            Return dtOurData
        End Function

        Public Function GetDataRowFromStoredProcedure(ByVal sqlcmd As IDbCommand, Optional UseGlobal As Boolean = False) As DataRow
            Dim dtOurData As New DataTable("MyData")
            objConn = New SqlConnection(ConnString)

            Try
                '# Add tablename is required
                If UseGlobal Then
                    sqlcmd.Parameters.Add(NewParameter(Of String)("@DatabaseName", SqlDbType.VarChar, System.Configuration.ConfigurationManager.AppSettings("db_name").ToString()))
                End If

                sqlcmd.CommandTimeout = 600
                sqlcmd.Connection = objConn
                Dim SQLDBDataReader As SqlDataReader = GetReader(sqlcmd)
                dtOurData.Load(SQLDBDataReader)
                objConn.Close()
                SQLDBDataReader.Close()
                sqlcmd.Connection = Nothing
            Catch ex As Exception
                objConn.Close()
                objConn.Dispose()
            End Try

            If dtOurData Is Nothing Then
                Return Nothing
            ElseIf dtOurData.Rows.Count = 0 Then
                Return Nothing
            ElseIf dtOurData.Rows.Count > 1 Then
                Throw New Exception("GetDataRow expects a query than returns no more than one row")
            Else
                Return dtOurData.Rows(0)
            End If

        End Function

        Public Function GetDataFieldFromStoredProcedure(Of T)(ByVal cmd As IDbCommand, Optional UseGlobal As Boolean = False) As T
            Dim dr As DataRow = GetDataRowFromStoredProcedure(cmd, UseGlobal)

            If dr Is Nothing Then
                Return CType(Nothing, T)
            ElseIf dr.Table.Columns.Count = 0 Then
                Return CType(Nothing, T)
            ElseIf dr.Table.Columns.Count > 1 Then
                Throw New Exception("GetDataField expects a query with no more than 1 field")
            ElseIf IsDBNull(dr(0)) Then
                Return CType(Nothing, T)
            Else
                Return CType(dr(0), T)
            End If

        End Function

        Public Function NewParameter(Of T)(ByVal name As String, ByVal dbType As SqlDbType, ByVal value As T) As SqlParameter
            Dim p As New SqlParameter()
            p.ParameterName = name
            p.SqlDbType = dbType
            If value Is Nothing Then
                p.Value = DBNull.Value
            Else
                p.Value = value
            End If

            Return p
        End Function

        Public Function NewParameterDbType(Of T)(ByVal name As String, ByVal dt As DbType, ByVal value As T) As SqlParameter
            Dim p As New SqlParameter()
            p.ParameterName = name
            p.DbType = dt
            If value Is Nothing Then
                p.Value = DBNull.Value
            Else
                p.Value = value
            End If

            Return p
        End Function

        Public Function GetDataTable(ByVal sql As String, ByRef ds As DataSet, ByVal name As String) As DataTable Implements IDatabaseConnection.GetDataTable
            If ds Is Nothing Then
                ds = New DataSet()
            End If

            Dim MyAdapter As New SqlDataAdapter(sql, ConnString)
            MyAdapter.Fill(ds, name)
            MyAdapter.Dispose()

            Return ds.Tables(name)
        End Function

        Public Function GetDataTablePaged(ByVal sql As String, ByVal StartRow As Integer, ByVal EndRow As Integer) As System.Data.DataTable Implements IDatabaseConnection.GetDataTablePaged
            Dim dtOurData As New DataTable("MyData")
            Dim query As String = "WITH TheTable AS (" & sql & ") SELECT *  FROM TheTable WHERE RowNumber BETWEEN " & StartRow.ToString() & " AND " & EndRow.ToString() & " ORDER BY RowNumber"
            Dim MyAdapter As New SqlDataAdapter(query, ConnString)
            MyAdapter.Fill(dtOurData)
            MyAdapter.Dispose()
            Return dtOurData
        End Function

#Region "GetDataRow"
        Public Function GetDataRow(ByVal sql As String) As DataRow Implements IDatabaseConnection.GetDataRow
            Return GetDataRow(GetCommand(sql))
        End Function

        Public Function GetDataRow(ByVal cmd As IDbCommand) As DataRow
            Dim dt As DataTable = GetDataTable(cmd)
            'Try
            If dt Is Nothing Then
                Return Nothing
            ElseIf dt.Rows.Count = 0 Then
                Return Nothing
            ElseIf dt.Rows.Count > 1 Then
                Throw New Exception("GetDataRow expects a query than returns no more than one row")
            Else
                Return dt.Rows(0)
            End If

        End Function
#End Region

#Region "GetDataField"
        Public Function GetDataField(Of T)(ByVal sql As String) As T Implements IDatabaseConnection.GetDataField
            Return GetDataField(Of T)(GetCommand(sql))
        End Function

        Public Function GetDataField(Of T)(ByVal cmd As IDbCommand) As T
            Dim dr As DataRow = GetDataRow(cmd)

            If dr Is Nothing Then
                Return CType(Nothing, T)
            ElseIf dr.Table.Columns.Count = 0 Then
                Return CType(Nothing, T)
            ElseIf dr.Table.Columns.Count > 1 Then
                Throw New Exception("GetDataField expects a query with no more than 1 field")
            ElseIf IsDBNull(dr(0)) Then
                Return CType(Nothing, T)
            Else
                Return CType(dr(0), T)
            End If

        End Function
#End Region

        Public Function GetCommand(ByVal sql As String) As IDbCommand Implements IDatabaseConnection.GetCommand
            Dim cmd As New SqlCommand(sql, New SqlConnection(ConnString))
            Return cmd
        End Function

        Public Function GetReader(ByVal sql As String) As IDataReader Implements IDatabaseConnection.GetReader
            Return GetReader(GetCommand(sql))
        End Function

        Public Function GetReader(ByVal cmd As IDbCommand) As SqlDataReader
            If cmd.Connection.State <> ConnectionState.Open Then
                cmd.Connection.Open()
            End If
            Return cmd.ExecuteReader(CommandBehavior.CloseConnection)
        End Function


    End Class

End Namespace

