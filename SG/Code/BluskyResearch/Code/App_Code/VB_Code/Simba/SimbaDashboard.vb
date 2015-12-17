Imports Microsoft.VisualBasic
Imports System.Data
Imports System.Data.SqlClient

Namespace PingLibrary

    Public NotInheritable Class SimbaDashboard

#Region "Contact Enquiries"
        Public Shared Function GetAllContactEnquiries() As DataTable
            Return Data.Connect.GetDataTable("SELECT * FROM ContactEnquiries WHERE Deleted = 0 ORDER BY Date DESC")
        End Function
#End Region

#Region "Order Totals"
        Public Shared Function GetTodaysOrderTotals() As DataRow

            Dim StartDateStr As String = Now.Date().ToString("yyyy-MM-dd 00:00:00")
            Dim EndDateStr As String = Now.Date().AddDays(1).ToString("yyyy-MM-dd 00:00:00")

            Return Data.Connect.GetDataRow("SELECT COUNT(OrderID) AS Sales, SUM(SubTotal) AS Amount FROM Orders INNER JOIN Users AS u ON UserFk = u.user_id WHERE u.user_type_fk = 3 AND StatusFk IN (2,5) AND (Date >= '" & StartDateStr & "' AND Date < '" & EndDateStr & "')")
        End Function

        Public Shared Function GetYesterdaysOrderTotals() As DataRow

            Dim StartDateStr As String = Now.Date().AddDays(-1).ToString("yyyy-MM-dd 00:00:00")
            Dim EndDateStr As String = Now.Date().ToString("yyyy-MM-dd 00:00:00")

            Return Data.Connect.GetDataRow("SELECT COUNT(OrderID) AS Sales, SUM(SubTotal) AS Amount FROM Orders INNER JOIN Users AS u ON UserFk = u.user_id WHERE u.user_type_fk = 3 AND StatusFk IN (2,5) AND (Date >= '" & StartDateStr & "' AND Date < '" & EndDateStr & "')")
        End Function

        Public Shared Function GetThisMonthOrderTotals() As DataRow

            Dim StartDate As Date = New Date(Now.Year(), Now.Month(), 1)
            Dim StartDateStr As String = StartDate.ToString("yyyy-MM-dd 00:00:00")

            Dim EndDate As Date = New Date(Now.Year(), Now.Month(), StartDate.AddMonths(1).AddDays(-1).Day)
            Dim EndDateStr As String = EndDate.ToString("yyyy-MM-dd 00:00:00")

            Return Data.Connect.GetDataRow("SELECT COUNT(OrderID) AS Sales, SUM(SubTotal) AS Amount FROM Orders INNER JOIN Users AS u ON UserFk = u.user_id WHERE u.user_type_fk = 3 AND StatusFk IN (2,5) AND (Date >= '" & StartDateStr & "' AND Date < '" & EndDateStr & "')")
        End Function

        Public Shared Function GetOrderTotalsByDate(ByVal TheDate As Date) As DataRow

            Dim StartDateStr As String = TheDate.ToString("yyyy-MM-dd 00:00:00")
            Dim EndDateStr As String = TheDate.AddDays(1).ToString("yyyy-MM-dd 00:00:00")

            Return Data.Connect.GetDataRow("SELECT COUNT(OrderID) AS Sales, SUM(SubTotal) AS Amount FROM Orders INNER JOIN Users AS u ON UserFk = u.user_id WHERE u.user_type_fk = 3 AND StatusFk IN (2,5) AND (Date >= '" & StartDateStr & "' AND Date < '" & EndDateStr & "')")
        End Function
#End Region

#Region "Orders"
        Public Shared Function GetOrdersByStatus(ByVal StatusID As Integer) As DataTable
            Return Data.Connect.GetDataTable("SELECT TOP 10 o.*, os.Title AS 'Status', u.user_firstname + ' ' + u.user_surname AS 'Customer' FROM Orders AS o INNER JOIN OrderStatus AS os ON o.StatusFk = os.OrderStatusID INNER JOIN Users AS u ON o.UserFk = u.user_id WHERE u.user_type_fk = 3 AND o.StatusFk = " & StatusID.ToString() & " ORDER BY o.Date DESC")
        End Function
#End Region

#Region "Donations"
        Public Shared Function GetOneOffDonations() As DataTable
            Return Data.Connect.GetDataTable("SELECT TOP 10 d.*, os.Title AS 'Status', u.user_firstname + ' ' + u.user_surname AS 'Customer', ISNULL(e.Title, '') AS EventTitle FROM Donations AS d INNER JOIN OrderStatus AS os ON d.StatusFk = os.OrderStatusID INNER JOIN Users AS u ON d.UserFk = u.user_id LEFT JOIN Events AS e ON d.EventFk = e.EventID WHERE u.user_type_fk = 3 AND d.StatusFk IN (2,3,5) AND d.EventFk <= 0 ORDER BY d.Date DESC")
        End Function

        Public Shared Function GetLegacyDonations() As DataTable
            Return Nothing
        End Function

        Public Shared Function GetEventDonations() As DataTable
            Return Data.Connect.GetDataTable("SELECT TOP 10 d.*, os.Title AS 'Status', u.user_firstname + ' ' + u.user_surname AS 'Customer', ISNULL(e.Title, '') AS EventTitle FROM Donations AS d INNER JOIN OrderStatus AS os ON d.StatusFk = os.OrderStatusID INNER JOIN Users AS u ON d.UserFk = u.user_id LEFT JOIN Events AS e ON d.EventFk = e.EventID WHERE u.user_type_fk = 3 AND d.StatusFk IN (2,3,5) AND d.EventFk > 0 ORDER BY d.Date DESC")
        End Function
#End Region

    End Class

End Namespace
