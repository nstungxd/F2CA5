Imports System
Imports System.IO
Imports System.Data
Imports System.Data.OleDb
Imports System.Data.SqlClient
Imports PingCore.MyContent
Imports System.Configuration
Imports System.Collections.Generic
Imports PingCore.MyData
Imports PingCore.MyControls.DependentDropdown
Imports PingCore.MySystem
Imports PingCore.Simba
Imports PingCore
Imports GroupTuple = PingCore.MyData.Tuple(Of System.Nullable(Of Integer), String)

Partial Public Class CreateAdmin_Behind
    Inherits System.Web.UI.Page

#Region "Local Vars"
#Region "TheIdentityControl"
    Private _theIdentityControl As UserIdentityControl
    Private ReadOnly Property TheIdentityControl() As UserIdentityControl
        Get
            If _theIdentityControl Is Nothing Then
                _theIdentityControl = New UserIdentityControl(HttpContext.Current)
            End If

            Return _theIdentityControl
        End Get
    End Property
#End Region

    Private _AdminSection As AdminCreator
    Public Property AdminSection() As AdminCreator
        Get
            Return _AdminSection
        End Get
        Set(ByVal value As AdminCreator)
            _AdminSection = value
        End Set
    End Property


#Region "SectionID"
    Private _sectionID As Integer
    Public Property SectionID() As Integer
        Get
            Return CInt(ViewState("SectionID"))
        End Get
        Set(ByVal value As Integer)
            ViewState("SectionID") = value
        End Set
    End Property
#End Region

#End Region

    Private Sub die(ByVal message As String)
        Response.Write("Dying: " & message)
        Response.End()
    End Sub

    Dim myUpdate, myUpdate2, myContent, ddFromColumn, ddToColumn As String

    Dim DS As DataSet = New DataSet
    Dim DS2 As DataSet = New DataSet
    Dim Row As DataRow
    Dim j, PanelID As Integer
    Dim MyUser As User

    Sub Page_Load(ByVal sender As Object, ByVal e As EventArgs) Handles Me.Load
        If Not TheIdentityControl.HasSectionAccess(-1) Then
            'Response.Redirect("login.aspx")
        End If

        With "SectionID"
            Dim intSectionID As String = PageContent.MakeInt(Request("section"))
            Dim i As Integer = 0
            Int32.TryParse(intSectionID, i)
            If i > 0 Then
                SectionID = i
            ElseIf SectionID <= 0 Then
                Response.Redirect("sections/admin_sections.aspx")
            End If
        End With

        AdminSection = New AdminCreator(SectionID)

        If Not IsPostBack Then
            '# throw an exception if the tablename is unset
            If StringUtility.IsEffectivelyEmpty(AdminSection.tableName) Then
                Throw New Exception("tablename unset")
            End If
            ActionBindFieldList()
        End If

        ' If we've received an action in the querystring, execute it here
        If Request("action") = "goto" Then
            'goto this section that was clicked on
            Response.Redirect("sections/" & AdminSection.MainFileName)
        ElseIf Not StringUtility.IsEffectivelyEmpty(Request("generateandreturn")) Then
            AdminSection.CreateAdminPage()
            pageforms.Visible = False
            updated.Visible = True
        ElseIf Not StringUtility.IsEffectivelyEmpty(Request("generateall")) Then
            Try

                AdminSection.CreateAdminPage()
            Catch ex As Exception

            End Try
            pageforms.Visible = False

            Dim intNextSectionID As Integer = PageContent.MakeInt(PageContent.GetOneFieldFrom("SELECT TOP 1 admin_section_id FROM zz_admin_sections WHERE (admin_section_isdeleted=0 OR admin_section_isdeleted IS NULL) AND admin_section_id >" & SectionID & " ORDER BY admin_section_id", System.Configuration.ConfigurationManager.AppSettings("strsource")))
            If Not intNextSectionID = 0 Then
                updateandnext.Text = Replace(updateandnext.Text, "{{url}}", "create-admin.aspx?generateall=1&section=" & intNextSectionID)
                updateandnext.Visible = True
            Else
                updateandnext.Visible = False
                pageforms.Visible = False
                updatedgohome.Visible = True
            End If
        End If
    End Sub


    Sub ActionBindFieldList()
        With dg_fieldlist
            .DataSource = AdminSection.Fields
            .DataBind()
        End With

        pl_fieldlist.Visible = True
    End Sub

    Sub BindFieldList()
        ActionBindFieldList()
        Dim i As Integer
        Dim _item As DataGridItem
        'Dim dr As DataRow

        Dim updatedColumnNames = False

        For i = 0 To dg_fieldlist.Items.Count - 1

            _item = dg_fieldlist.Items(i)
            Dim txtfieldID As Label = _item.FindControl("ColumnID")
            Dim txtfieldname As Label = _item.FindControl("fieldname")
            Dim txtFieldTitle As TextBox = _item.FindControl("FieldTitle")

            If txtFieldTitle.Text & "x" = "x" Then
                Response.Write("Title of " & txtfieldname.Text & " is BLANK" & txtFieldTitle.Text & "<br />")
                Dim intColumnID As Integer = txtfieldID.Text
                Dim strfieldname As String = txtfieldname.Text
                Dim strFieldTitle As String = txtFieldTitle.Text
                strFieldTitle = AdminSection.PCase(strfieldname)
                Dim strSQL As String = "UPDATE zz_admin_section_fields SET FieldTitle='" & strFieldTitle & "' WHERE ColumnID=" & intColumnID
                MyData.DBFactory.DB.RunSQL(strSQL)
                updatedColumnNames = True
            End If
        Next

        If updatedColumnNames Then
            Response.Write("Hit Refresh for Default Column Names<br />")
        End If
    End Sub

    Sub btnUpdate_click(ByVal sender As Object, ByVal e As EventArgs) Handles btnUpdate1.Click, btnUpdate2.Click
        If Page.IsValid Then
            Dim i As Integer
            Dim _item As DataGridItem
            '

            For i = 0 To dg_fieldlist.Items.Count - 1
                _item = dg_fieldlist.Items(i)
                Dim strColumnID As Label = _item.FindControl("ColumnID")
                Dim strDisplayAs As TextBox = _item.FindControl("FieldTitle")
                Dim strExtra As TextBox = _item.FindControl("FieldExtra")
                Dim strdefault_value As TextBox = _item.FindControl("default_value")
                Dim strRequiredField As CheckBox = _item.FindControl("is_required_field")
                Dim strViewField As CheckBox = _item.FindControl("ViewField")
                Dim strEditField As CheckBox = _item.FindControl("EditField")
                Dim strShowFieldOnList As CheckBox = _item.FindControl("ShowFieldOnList")
                Dim strForceNumeric As CheckBox = _item.FindControl("ForceNumeric")
                Dim strRichText As CheckBox = _item.FindControl("RichText")
                Dim strisImage As CheckBox = _item.FindControl("isImage")
                Dim strDropdownAddNew As CheckBox = _item.FindControl("DropdownAddNew")

                Dim strFileUpload As CheckBox = _item.FindControl("FileUpload")
                Dim strToolTip As TextBox = _item.FindControl("ToolTip")
                Dim strSearchable As CheckBox = _item.FindControl("Searchable")
                Dim strgroup_id As DropDownList = _item.FindControl("group_id")
                Dim ddlFieldFunction As DropDownList = _item.FindControl("fieldFunction")

                Dim strPrimaryKey As CheckBox = _item.FindControl("PrimaryKey")
                Dim strFieldPanel As DropDownList = _item.FindControl("FieldPanel")
                Dim strRegularExpression As DropDownList = _item.FindControl("RegularExpression")
                Dim strShowDropDown As DropDownList = _item.FindControl("ShowDropDown")

                '    With "update"
                Dim title As String = strDisplayAs.Text
                Dim extra As String = strExtra.Text
                Dim thedefault As String = strdefault_value.Text
                Dim islistfield As Boolean = strShowFieldOnList.Checked
                Dim isviewfield As Boolean = strViewField.Checked
                Dim iseditfield As Boolean = strEditField.Checked
                Dim isrequired As Boolean = strRequiredField.Checked
                Dim isforcenumeric As Boolean = strForceNumeric.Checked
                Dim isimage As Boolean = strisImage.Checked
                Dim isrichtext As Boolean = strRichText.Checked
                Dim isfileupload As Boolean = strFileUpload.Checked
                Dim issearchable As Boolean = strSearchable.Checked
                Dim groupfk As Nullable(Of Integer) = AdminSection.ParseNullableInteger(strgroup_id.SelectedValue)
                Dim isddaddnew As Boolean = strDropdownAddNew.Checked
                Dim tooltip As String = strToolTip.Text
                Dim ispk As Boolean = strPrimaryKey.Checked
                Dim regexfk As Nullable(Of Integer) = AdminSection.ParseNullableInteger(strRegularExpression.SelectedValue)
                Dim dropdownfk As Nullable(Of Integer) = AdminSection.ParseNullableInteger(strShowDropDown.SelectedValue)
                Dim fieldFunction As Nullable(Of Integer) = AdminSection.ParseNullableInteger(ddlFieldFunction.SelectedValue)
                Dim panelno As Nullable(Of Integer) = AdminSection.ParseNullableInteger(strFieldPanel.SelectedValue)

                Dim colid As Integer = 0
                Int32.TryParse(strColumnID.Text, colid)

                AdminSection.updateColumn(colid, title, extra, thedefault, islistfield, isviewfield, iseditfield, isrequired, isforcenumeric, isimage, _
                                             isfileupload, isrichtext, issearchable, groupfk, isddaddnew, tooltip, ispk, regexfk, dropdownfk, fieldFunction, panelno)

            Next

            AdminSection.CreateAdminPage()

            Response.Write("New Page at <a href='sections/" & AdminSection.MainFileName & "' target='_blank'>" & AdminSection.MainFileName & "</a>")
        End If
    End Sub



    Sub btnBack_click(ByVal sender As Object, ByVal e As EventArgs)
        Response.Redirect("sections/admin_sections.aspx")
    End Sub




#Region "DropDowns Code"
    Function RegExDrop() As DataTable
        RegExDrop = MyData.DBFactory.DB.GetDataTable("select * from zz_admin_regular_expressions")
    End Function

    Function MapFieldGroup(ByVal dr As DataRow) As GroupTuple
        If dr Is Nothing Then
            Return Nothing
        Else
            Dim id As Integer = MyData.DBFactory.FromDB(Of Integer)(dr("field_group_id"))
            Dim name As String = MyData.DBFactory.FromDB(Of String)(dr("field_group_name"))

            Return New GroupTuple(id, name)
        End If
    End Function

    Function Group_DownDrop() As Cons(Of GroupTuple)
        Dim sql As String = "select * from zz_admin_section_field_groups"

        Dim groups As Cons(Of GroupTuple) = cons(Of GroupTuple).FromRowSetQuery(sql, AddressOf MapFieldGroup)

        '# null option
        groups = New Cons(Of GroupTuple)(New GroupTuple(Nothing, "--"), groups)

        Return groups
    End Function

    Function Functions_DownDrop() As DataTable
        Functions_DownDrop = MyData.DBFactory.DB.GetDataTable("select * from zz_admin_field_functions")
    End Function

    Function ShowDropDownDrop() As DataTable
        ShowDropDownDrop = MyData.DBFactory.DB.GetDataTable("select * from zz_admin_DropDowns order by DropDownName")
    End Function

    Function GetRegExValue(ByVal varIn As Integer) As Integer
        If varIn < 1 Then varIn = 1
        GetRegExValue = varIn
    End Function

    Function GetLevelDropListIndex(ByVal varIn As String) As Integer
        If IsDBNull(varIn) Then varIn = 0
        If varIn < 1 Then varIn = 1
        GetLevelDropListIndex = varIn
    End Function

#End Region

    Function NormaliseID(ByVal id As Integer, ByVal def As Nullable(Of Integer)) As String
        Dim res As Nullable(Of Integer) = Nothing

        If def.HasValue AndAlso def.Value <= 0 Then
            Throw New PreconditionException("default id must be valid")
        ElseIf id <= 0 Then
            res = def
        Else
            res = id
        End If

        Return res.ToString
    End Function

End Class