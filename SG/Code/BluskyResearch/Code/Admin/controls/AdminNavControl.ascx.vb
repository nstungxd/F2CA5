Imports PingCore.MyContent
Imports PingCore.MyData
Imports System.data
Imports System.Data.sqlclient
Imports PingCore
Imports mc = PingCore.MyControls
Imports PingCore.MyControls

Imports NavLink = PingCore.MyData.Tuple(Of Integer, String, String)

Partial Class Admin_AdminnavControl_Behind
    Inherits SimpleUserControl

#Region "TheMaster"
    Private _theMaster As IMaster
    Private ReadOnly Property TheMaster() As IMaster
        Get
            If _theMaster Is Nothing Then
                Dim m As MasterPage = Me.Page.Master
                Do
                    If m.Master Is Nothing Then
                        _theMaster = CType(m, IMaster)
                        Exit Do
                    Else
                        m = m.Master
                    End If
                Loop
            End If

            Return _theMaster
        End Get
    End Property
#End Region

#Region "Styles"
    Private _MenuStyle As String
    Public Property MenuStyle As String
        Get
            Return _MenuStyle
        End Get
        Set(ByVal value As String)
            _MenuStyle = value
        End Set
    End Property
    Private _MenuItemStyle As String
    Public Property MenuItemStyle As String
        Get
            Return _MenuItemStyle
        End Get
        Set(ByVal value As String)
            _MenuItemStyle = value
        End Set
    End Property
#End Region

#Region "Local"

    Overrides Sub Control_EarlyLocalLoad()

    End Sub

    Overrides Sub Control_LateLocalLoad()

    End Sub

#End Region

#Region "Global"

    Overrides Sub Control_GlobalLoad()
        '# todo: runs on the first page load
        '# populate the dropdowns initially

        LoadSuperMenu()

    End Sub

    Sub LoadSuperMenu()
        Dim utype_id = 0
        'If TheMaster.TheIdentityControl IsNot Nothing Then
        With TheMaster.TheIdentityControl
            If .IsKnown And .IsConfirmed Then
                utype_id = .Identity.UTypeID
            End If
        End With

        Dim xs As Cons(Of mc.MenuItem) = DBAccess.GetAdminMenuItemsByUserType(utype_id)

        With SuperMenu
            .UserLevel = utype_id
            .DataSource = xs
            .DataBind()
        End With

        'End If
    End Sub


#Region "Handlers"

    '# todo: add handlers here

#End Region

#End Region

End Class


