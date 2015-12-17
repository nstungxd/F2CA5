Imports Microsoft.VisualBasic
Imports System.Data
Imports System.IO

Namespace PingUtilities

    Public Class CSVBuilder

        ''' <summary>
        ''' To generate CSV file.
        ''' </summary>
        Public Function ConvertFromDataSet(ByVal oDataSet As DataSet, ByVal directoryPath As String, ByVal fileName As String) As String

            Dim fullpath As String = ""

            If directoryPath.Substring(directoryPath.Length - 1, 1) = "\" OrElse directoryPath.Substring(directoryPath.Length - 1, 1) = "/" Then
                fullpath = directoryPath + fileName
            Else
                fullpath = (directoryPath & "\") + fileName
            End If

            Dim SW As StreamWriter = File.CreateText(fullpath)
            Dim oStringBuilder As New StringBuilder()

            '*****************************************************************
            '* Start, Creating column header
            '*****************************************************************
            'For Each oDataColumn As DataColumn In oDataSet.Tables(0).Columns
            '    oStringBuilder.Append(StrConv(oDataColumn.ColumnName, VbStrConv.ProperCase).Replace(",", " ") & ",")
            'Next

            'SW.WriteLine(oStringBuilder.ToString().Substring(0, oStringBuilder.ToString().Length - 1))
            'oStringBuilder.Length = 0

            '*****************************************************************
            '* End, Creating column header
            '*****************************************************************

            '*****************************************************************
            '* Start, Creating rows
            '*****************************************************************

            Dim TempString As String

            For Each oDataTable As DataTable In oDataSet.Tables()
                For Each oDataRow As DataRow In oDataTable.Rows

                    For Each oDataColumn As DataColumn In oDataTable.Columns

                        If Not oDataRow(oDataColumn.ColumnName).Equals(DBNull.Value) Then

                            If oDataColumn.ColumnName.ToLower().Contains("email") Then
                                TempString = StrConv(oDataRow(oDataColumn.ColumnName), VbStrConv.Lowercase).Replace(",", " ")
                            ElseIf oDataColumn.ColumnName.ToLower() = "postcode" Then
                                TempString = StrConv(oDataRow(oDataColumn.ColumnName), VbStrConv.Uppercase).Replace(",", " ")
                            Else
                                TempString = StrConv(oDataRow(oDataColumn.ColumnName), VbStrConv.ProperCase).Replace(",", " ")
                            End If

                        Else
                            TempString = ""
                        End If
                        oStringBuilder.Append(TempString & ",")
                    Next
                    SW.WriteLine(oStringBuilder.ToString().Substring(0, oStringBuilder.ToString().Length - 1))

                    oStringBuilder.Length = 0
                Next
            Next

            '*****************************************************************
            '* End, Creating rows
            '*****************************************************************

            SW.Close()

            Return fullpath
        End Function

        ''' <summary>
        ''' To generate CSV file.
        ''' </summary>
        Public Function Convert(ByVal oDataTable As DataTable, ByVal directoryPath As String, ByVal fileName As String) As String

            Dim fullpath As String = ""

            If directoryPath.Substring(directoryPath.Length - 1, 1) = "\" OrElse directoryPath.Substring(directoryPath.Length - 1, 1) = "/" Then
                fullpath = directoryPath + fileName
            Else
                fullpath = (directoryPath & "\") + fileName
            End If

            Dim SW As StreamWriter = File.CreateText(fullpath)
            Dim oStringBuilder As New StringBuilder()

            '*****************************************************************
            '* Start, Creating column header
            '*****************************************************************

            'For Each oDataColumn As DataColumn In oDataTable.Columns
            '    oStringBuilder.Append(StrConv(oDataColumn.ColumnName, VbStrConv.ProperCase).Replace(",", " ") & ",")
            'Next

            'SW.WriteLine(oStringBuilder.ToString().Substring(0, oStringBuilder.ToString().Length - 1))
            'oStringBuilder.Length = 0

            '*****************************************************************
            '* End, Creating column header
            '*****************************************************************

            '*****************************************************************
            '* Start, Creating rows
            '*****************************************************************

            Dim TempString As String

            For Each oDataRow As DataRow In oDataTable.Rows

                For Each oDataColumn As DataColumn In oDataTable.Columns

                    If Not oDataRow(oDataColumn.ColumnName).Equals(DBNull.Value) Then

                        If oDataColumn.ColumnName.ToLower().Contains("email") Then
                            TempString = StrConv(oDataRow(oDataColumn.ColumnName), VbStrConv.Lowercase).Replace(",", " ")
                        ElseIf oDataColumn.ColumnName.ToLower() = "postcode" Then
                            TempString = StrConv(oDataRow(oDataColumn.ColumnName), VbStrConv.Uppercase).Replace(",", " ")
                        Else
                            TempString = StrConv(oDataRow(oDataColumn.ColumnName), VbStrConv.ProperCase).Replace(",", " ")
                        End If

                    Else
                        TempString = ""
                    End If
                    oStringBuilder.Append(TempString & ",")
                Next
                SW.WriteLine(oStringBuilder.ToString().Substring(0, oStringBuilder.ToString().Length - 1))

                oStringBuilder.Length = 0
            Next

            '*****************************************************************
            '* End, Creating rows
            '*****************************************************************

            SW.Close()

            Return fullpath
        End Function

        Public Function ConvertSave(ByVal oDataTable As DataTable, ByVal fileName As String) As String

            Dim fullpath As String = ConfigurationManager.AppSettings("CSVPath") & fileName

            Dim SW As StreamWriter = File.CreateText(fullpath)
            Dim oStringBuilder As New StringBuilder()

            '*****************************************************************
            '* Start, Creating column header
            '*****************************************************************

            For Each oDataColumn As DataColumn In oDataTable.Columns
                oStringBuilder.Append(StrConv(oDataColumn.ColumnName, VbStrConv.ProperCase).Replace(",", " ") & ",")
            Next

            SW.WriteLine(oStringBuilder.ToString().Substring(0, oStringBuilder.ToString().Length - 1))
            oStringBuilder.Length = 0

            '*****************************************************************
            '* End, Creating column header
            '*****************************************************************

            '*****************************************************************
            '* Start, Creating rows
            '*****************************************************************

            For Each oDataRow As DataRow In oDataTable.Rows
                For Each oDataColumn As DataColumn In oDataTable.Columns
                    oStringBuilder.Append(StrConv(oDataRow(oDataColumn.ColumnName), VbStrConv.ProperCase).Replace(",", " ") & ",")
                Next

                SW.WriteLine(oStringBuilder.ToString().Substring(0, oStringBuilder.ToString().Length - 1))

                oStringBuilder.Length = 0
            Next

            '*****************************************************************
            '* End, Creating rows
            '*****************************************************************

            SW.Close()

            Return fullpath
        End Function

    End Class

End Namespace
