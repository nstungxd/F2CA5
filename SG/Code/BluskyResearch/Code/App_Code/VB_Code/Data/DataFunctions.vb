Imports Microsoft.VisualBasic
Imports System.Data

Namespace PingLibrary

    Public NotInheritable Class DataFunctions

        Public Shared Function GetColumnFromDataRow(ByVal dr As DataRow, ByVal ColumnName As String) As String
            If dr Is Nothing Then
                Return ""
            ElseIf IsDBNull(dr.Item(ColumnName)) Then
                Return ""
            ElseIf dr.IsNull(ColumnName) Then
                Return ""
            Else
                Try
                    Dim result As String = dr.Item(ColumnName).ToString()
                    Return result
                Catch ex As Exception
                    Return ""
                End Try
            End If
        End Function

        Public Shared Function GetColumnFromDataRow(Of T)(ByVal dr As DataRow, ByVal ColumnName As String) As T
            If dr Is Nothing Then
                Return CType(Nothing, T)
            ElseIf IsDBNull(dr.Item(ColumnName)) Then
                Return CType(Nothing, T)
            ElseIf dr.IsNull(ColumnName) Then
                Return CType(Nothing, T)
            Else
                Try
                    Return CType(dr.Item(ColumnName), T)
                Catch ex As Exception
                    Return CType(Nothing, T)
                End Try
            End If
        End Function

        Public Shared Function FormatDBInString(ByVal strIn As String) As String
            If strIn & "x" = "x" Then strIn = ""
            strIn = Replace(strIn, "'", "''")
            Return strIn
        End Function

        Public Shared Function AddToWhereString(ByVal CurrentStr As String, ByVal NewPart As String) As String

            CurrentStr = CurrentStr.ToLower()

            If Not String.IsNullOrEmpty(CurrentStr) Then
                CurrentStr = CurrentStr & " AND " & NewPart
            Else
                CurrentStr = "WHERE " & NewPart
            End If

            Return CurrentStr

        End Function

    End Class

End Namespace
