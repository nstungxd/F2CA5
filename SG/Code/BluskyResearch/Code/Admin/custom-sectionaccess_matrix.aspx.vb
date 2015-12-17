Imports System.Data
Imports System.Data.SqlClient
Imports PingCore.MyData
Imports PingCore.MyContent
Imports PingCore.MySystem
Imports PingCore.MyControls
Imports PingCore
Imports PingCore.GeneralStuff

Partial Public Class SectionAccessMatrix_Behind
    Inherits SimplePage

    Class Save
        Class SectionAccessRecord
            'Public ReadOnly SectionID As Integer
            'Public ReadOnly Present As Boolean
            'Public ReadOnly ShowOnNav As Boolean

#Region "SectionID"
            Private _sectionid As Integer
            Public ReadOnly Property SectionID() As Integer
                Get
                    Return _sectionid
                End Get
            End Property
#End Region

#Region "Present"
            Private _present As Boolean
            Public ReadOnly Property Present() As Boolean
                Get
                    Return _present
                End Get
            End Property
#End Region

#Region "ShowOnNav"
            Private _showonnav As Boolean
            Public ReadOnly Property ShowOnNav() As Boolean
                Get
                    Return _showonnav
                End Get
            End Property
#End Region


#Region "Constructor"
            Public Sub New(ByVal SectionID As Integer, ByVal Present As Boolean, ByVal ShowOnNav As Boolean)
                _sectionid = SectionID
                _present = Present
                _showonnav = ShowOnNav
            End Sub
#End Region

        End Class
    End Class



#Region "TheMaster"
    Private _theMaster As New Memo(Of IMaster)(AddressOf GetTheMaster)
    ReadOnly Property TheMaster() As IMaster
        Get
            Return _theMaster.Value
        End Get
    End Property

    Function GetTheMaster() As IMaster
        Return CType(Page.Master, IMaster)
    End Function
#End Region

#Region "Local"

#Region "l_AdminID"
    Private _lAdminID As New Memo(Of Nullable(Of Integer))(AddressOf _GetLAdminID)
    ReadOnly Property l_AdminID() As Nullable(Of Integer)
        Get
            Return _lAdminID.Value
        End Get
    End Property

    Function _GetLAdminID() As Nullable(Of Integer)
        '# from master of course
        With TheMaster.TheIdentityControl
            If Not .IsKnown OrElse Not .IsConfirmed Then
                '# not logged in
                Return Nothing
            Else
                '# is this an admin?
                If Not Security.UType.IsAdmin(.Identity.UTypeID) Then
                    '# not an admin
                    Return Nothing
                Else
                    '# all good
                    Return .Identity.ID
                End If
            End If
        End With
    End Function
#End Region

#Region "l_UTypeID"
    Private _lUTypeID As New Memo(Of Nullable(Of Integer))(AddressOf _GetUTypeID)
    ReadOnly Property l_UTypeID() As Nullable(Of Integer)
        Get
            Return _lUTypeID.Value
        End Get
    End Property

    Function _GetUTypeID() As Nullable(Of Integer)
        '# from querystring
        Dim s As String = Request.QueryString("id")
        Dim i As Integer = 0 : Int32.TryParse(s, i)

        If Not i > 0 Then
            '# invalid
            Return Nothing
        Else
            '# all ok
            Return i
        End If
    End Function
#End Region

    Overrides Sub Page_EarlyLocalLoad()
        '# this must be an admin
        If Not l_AdminID.HasValue Then
            '# not an admin
            BackToAdminDefault()
        End If
    End Sub

    Overrides Sub Page_LateLocalLoad()

    End Sub

#End Region


#Region "Global"

#Region "g_AdminID"
    ReadOnly Property g_AdminID() As Integer
        Get
            Return l_AdminID
        End Get
    End Property
#End Region

#Region "g_UTypeID"
    Property g_UTypeID() As Integer
        Get
            Return DBFactory.FromViewState(Of Integer)(ViewState, "g_UTypeID")
        End Get
        Set(ByVal value As Integer)
            ViewState("g_UTypeID") = value
        End Set
    End Property
#End Region


    Overrides Sub Page_GlobalLoad()
        '# todo: runs on the first page load

        '# need a usertype
        If Not l_UTypeID.HasValue Then
            BackToAdminDefault()
        Else
            '# set global
            g_UTypeID = l_UTypeID.Value
        End If

        '# right, the adminid and utypeid's are there, now move data
        MoveSections()
    End Sub

    Sub MoveSections()
        '# load the data for the sections, bind to repeater
        Dim sql As String = String.Format(String.Concat( _
            "select s.admin_section_id as 'id', {0}", _
            "  s.admin_section_name as 'name', {0}", _
            "  isnull(x.present, 0) as 'present', {0}", _
            "  isnull(x.showonnav, 0) as 'showonnav' {0}", _
            "from zz_admin_sections s {0}", _
            "  left join ( {0}", _
            "    select sectionaccess_section_fk as 'id', {0}", _
            "      1 as present, {0}", _
            "      sectionaccess_showonnav as 'showonnav' {0}", _
            "    from zz_admin_usertype_sectionaccess {0}", _
            "    where sectionaccess_usertype_fk = {1}) as x on s.admin_section_id = x.id {0}", _
            "order by s.admin_section_name"), _
            vbCrLf, g_UTypeID)

        Dim dt As DataTable = DBFactory.DB.GetDataTable(sql)

        '# bind it
        With rptSections
            .DataSource = dt
            .DataBind()
        End With

    End Sub



#Region "Handlers"

    '# todo: place event handlers here
    Sub btnAdandonBtn1_Click(ByVal sender As Object, ByVal e As EventArgs) Handles btnAbandon.Click
        BackToAdminDefault()
    End Sub

#Region "rptSections_ItemDataBound"
    Sub rptSections_ItemDataBound(ByVal sender As Object, ByVal e As RepeaterItemEventArgs) Handles rptSections.ItemDataBound
        Dim item As RepeaterItem = e.Item
        Select Case item.ItemType
            Case ListItemType.Item, ListItemType.AlternatingItem, ListItemType.SelectedItem
                Dim chkSelected = PageContent.MyFindControl(Of CheckBox)("chkSelected", item)
                Dim chkShowOnMenu = PageContent.MyFindControl(Of CheckBox)("chkShowOnMenu", item)

                If chkSelected IsNot Nothing AndAlso chkShowOnMenu IsNot Nothing Then
                    Dim present As Boolean = DBFactory.FromDB(Of Boolean)(DataBinder.Eval(item.DataItem, "present"))
                    Dim showonnav As Boolean = DBFactory.FromDB(Of Boolean)(DataBinder.Eval(item.DataItem, "showonnav"))

                    chkSelected.checked = present
                    chkShowOnMenu.checked = showonnav
                End If
        End Select
    End Sub
#End Region

#Region "btnSave_Click"
    Sub btnSave_Click(ByVal sender As Object, ByVal e As EventArgs) Handles btnSave.Click
        '# ok, we must update the db-status of this usertype's permissions
        '# to make things easier, delete all and reinsert

        Dim deleteSql As String = "delete from zz_admin_usertype_sectionaccess where sectionaccess_usertype_fk = {1}{0}"

        '# get repeateritems
        Dim items As Cons(Of RepeaterItem) = Nothing : cons.FromEnumerable(rptSections.Items, items)

        '# map to list of sectionaccessrecords
        Dim xs As Cons(Of Save.SectionAccessRecord) = Nothing : cons.Map(AddressOf MapItemToSAR, items, xs)

        '# filter to only those which are present because the earlier delete all makes things easier
        xs = cons.Filter(AddressOf FilterPresentOnly, xs)

        '# right, these are the present ones, map to insert queries
        Dim inserts As Cons(Of String) = Nothing : cons.Map(AddressOf MapSARToInsertStatement, xs, inserts)

        '# concat the inserts to the end of the delete statement
        Dim insertSql As String = cons.FoldWithState(AddressOf Funcs.Join, Nothing, "{0}", inserts)

        '# format the sql statement
        Dim sqlFormatted As String = String.Format(deleteSql & insertSql, vbCrLf, g_UTypeID)

        '# run it
        DBFactory.DB.RunSQL(sqlFormatted)


        '# at last, the db has been sorted, rebind
        MoveSections()

    End Sub

    Function MapItemToSAR(ByVal ri As RepeaterItem) As Save.SectionAccessRecord
        If ri Is Nothing Then
            Return Nothing
        Else
            Dim hdnSectionID As HiddenField = PageContent.MyFindControl(Of HiddenField)("hdnSectionID", ri)
            Dim chkSelected As CheckBox = PageContent.MyFindControl(Of CheckBox)("chkSelected", ri)
            Dim chkShowOnMenu As CheckBox = PageContent.MyFindControl(Of CheckBox)("chkShowOnMenu", ri)

            If hdnSectionID Is Nothing OrElse chkSelected Is Nothing OrElse chkShowOnMenu Is Nothing Then
                Return Nothing
            Else
                Dim sid As Integer = 0 : Int32.TryParse(hdnSectionID.Value, sid)
                Dim present As Boolean = chkSelected.Checked
                Dim showonnav As Boolean = chkShowOnMenu.Checked

                Return New Save.SectionAccessRecord(sid, present, showonnav)
            End If
        End If
    End Function

    Function FilterPresentOnly(ByVal x As Save.SectionAccessRecord) As Boolean
        If x Is Nothing Then
            Return False
        Else
            Return x.Present
        End If
    End Function

    Function MapSARToInsertStatement(ByVal x As Save.SectionAccessRecord) As String
        If x Is Nothing Then
            Return Nothing
        Else
            Dim sid As Integer = x.SectionID
            Dim showonnav As Integer = CType(IIf(x.ShowOnNav, 1, 0), Integer)

            Dim sql As String = _
                "insert into zz_admin_usertype_sectionaccess (sectionaccess_usertype_fk, sectionaccess_section_fk, sectionaccess_showonnav) {0}" & _
                "values ({1}, " & sid.ToString & ", " & showonnav.ToString & ");{0}"

            Return sql
        End If
    End Function

#End Region

#End Region

#End Region

    Sub BackToAdminDefault()
        Response.Redirect(Me.ResolveClientUrl("default.aspx"))
    End Sub

End Class