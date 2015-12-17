<%@ Page   AutoEventWireup="false"   ClassName="CreateAdmin_Front"   Inherits="CreateAdmin_Behind"   CodeFile="create-admin.aspx.vb"   Explicit="True"   Language="VB"   Debug="True" %>
<%@ Import Namespace=" PingCore.MyData" %>
<%@ Import Namespace=" PingCore.MyContent" %>
<%@ Import Namespace="PingCore" %>
<%@ Import Namespace="PingCore.Simba" %>
<%@ Import Namespace="PingCore.Simba.CreateAdmin" %>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <style type="text/css">
		body{	font-family:Arial, Helvetica, sans-serif;}
			td{font-size:8pt}
		</style>
		<script type="text/javascript" src="overlib/overlib.js"></script>
        <script type="text/javascript" src="overlib/overlib_anchor.js"></script>
        <script type="text/javascript" src="overlib/overlib_centerpopup.js"></script>
        <script type="text/javascript" src="overlib/overlib_crossframe.js"></script>
        <script type="text/javascript" src="overlib/overlib_cssstyle.js"></script>
        <script type="text/javascript" src="overlib/overlib_debug.js"></script>
        <script type="text/javascript" src="overlib/overlib_exclusive.js"></script>
        <script type="text/javascript" src="overlib/overlib_followscroll.js"></script>
        <script type="text/javascript" src="overlib/overlib_hideform.js"></script>
        <script type="text/javascript" src="overlib/overlib_setonoff.js"></script>
        <script type="text/javascript" src="overlib/overlib_shadow.js"></script> 
        <link rel="Stylesheet" href="/Media/CSS/AdminStyle.css" type="text/css" media="screen" />
</head>
<body>
    <form runat="server" action="create-admin.aspx">
        <asp:Label ID='updateandnext' runat="server" Visible="false"><script type="text/javascript">window.location = '{{url}}';</script></asp:Label>
        <asp:Label ID='updatedgohome' runat="server" Visible="false"><script type="text/javascript">alert('The admin pages have all been regenerated.');window.location = 'default.aspx';</script></asp:Label>
        <asp:Label ID='updated' runat="server" Visible="false">
            <script type="text/javascript">
                history.go(-1);
//            if(confirm('The admin page has been regenerated. Is it ok?'))
//            {
//                history.go(-1);
//            }
//            else {
//                location.reload();        
//            }
            </script></asp:Label>
            <asp:Panel runat="server" ID="pageforms">
            <asp:Panel runat="Server" ID="pl_fieldlist">
                <asp:LinkButton ID="btnBack" runat="server" Text="Back" OnClick="btnBack_click" CausesValidation="true" Font-Bold="true" Font-Size="Small" />
                <asp:LinkButton ID="btnUpdate1" runat="server" Text="Update" CausesValidation="true" Font-Bold="true" Font-Size="Small" />
                <asp:TextBox ReadOnly="true" runat="server" ID="SectionNumber" Visible="false"></asp:TextBox>
                <asp:TextBox ReadOnly="true" runat="server" ID="table_name" Visible="false"></asp:TextBox>
                <asp:TextBox ReadOnly="true" runat="server" ID="admin_section_id" Visible="false"></asp:TextBox>
                <asp:DataGrid ID="dg_fieldlist" runat="server" DataKeyField="columnID" AutoGenerateColumns="false" AlternatingItemStyle-BackColor="#efefef" HeaderStyle-BackColor="#696969" HeaderStyle-ForeColor="#ffffff">
                    <Columns>
                        <asp:TemplateColumn HeaderText="ID"  Visible="false">
                            <ItemTemplate>
                                <asp:Label  Text='<%# CType(Container.DataItem, AdminField).columnID %>' ID="ColumnID"
                                    runat="server"></asp:Label>
                            </ItemTemplate>
                        </asp:TemplateColumn>
                        <asp:TemplateColumn HeaderText="PrimaryKey" >
                            <ItemTemplate>
                                <asp:CheckBox ID="PrimaryKey" Checked='<%# CType(Container.DataItem, AdminField).IsPrimaryKey %>'
                                    runat="server"></asp:CheckBox>
                            </ItemTemplate>
                        </asp:TemplateColumn>
                        <asp:TemplateColumn HeaderText="Display As (and extra)" >
                            <ItemTemplate>
                                <asp:TextBox Text='<%# CType(Container.DataItem, AdminField).fieldTitle %>' MaxLength="200" ID="FieldTitle" runat="server" Columns="14" />
                                &nbsp;<asp:TextBox MaxLength="200" ID="FieldExtra" runat="server" Columns="2" />
                                <a href='javascript:;'  onmouseover='return overlib("<%# CType(Container.DataItem, AdminField).ColumnName %><br /><%# CType(Container.DataItem, AdminField).dataType %>(<%# CType(Container.DataItem, AdminField).maxCharacters %>)");' onmouseout='return nd();' >
                                  <img src='images/hint.png' border='0' align='absmiddle' />
                                </a> 
                            </ItemTemplate>
                        </asp:TemplateColumn>
                        <asp:TemplateColumn HeaderText="List" >
                            <ItemTemplate>
                                <asp:CheckBox ID="ShowFieldOnList" Checked='<%# CType(Container.DataItem, AdminField).showFieldOnList %>'
                                    runat="server"></asp:CheckBox>
                            </ItemTemplate>
                        </asp:TemplateColumn>
                        <asp:TemplateColumn HeaderText="View" >
                            <ItemTemplate>
                                <asp:CheckBox ID="ViewField" Checked='<%# CType(Container.DataItem, AdminField).ViewField %>'
                                    runat="server"></asp:CheckBox>
                            </ItemTemplate>
                        </asp:TemplateColumn>
                        <asp:TemplateColumn HeaderText="Edit" >
                            <ItemTemplate>
                                <asp:CheckBox ID="EditField" Checked='<%# CType(Container.DataItem, AdminField).editField %>'
                                    runat="server"></asp:CheckBox>
                            </ItemTemplate>
                        </asp:TemplateColumn>
                        <asp:TemplateColumn HeaderText="Required?" >
                            <ItemTemplate>
                                <asp:CheckBox ID="is_required_field" Checked='<%# CType(Container.DataItem, AdminField).isRequiredField %>'
                                    runat="server"></asp:CheckBox>
                            </ItemTemplate>
                        </asp:TemplateColumn>
                        <asp:TemplateColumn HeaderText="Force<br />Numeric?" 
                            Visible="false">
                            <ItemTemplate>
                                <asp:CheckBox ID="ForceNumeric" Checked='<%# CType(Container.DataItem, AdminField).isForceNumeric %>'
                                    runat="server"></asp:CheckBox>
                            </ItemTemplate>
                        </asp:TemplateColumn>
                        <asp:TemplateColumn HeaderText="Rich<br />Text" >
                            <ItemTemplate>
                                <asp:CheckBox ID="RichText" Checked='<%# CType(Container.DataItem, AdminField).isRichText %>'
                                    runat="server"></asp:CheckBox>
                            </ItemTemplate>
                        </asp:TemplateColumn>
                        <asp:TemplateColumn HeaderText="Searchable?" >
                            <ItemTemplate>
                                <asp:CheckBox ID="Searchable" Checked='<%# CType(Container.DataItem, AdminField).Searchable  %>'
                                    runat="server"></asp:CheckBox>
                            </ItemTemplate>
                        </asp:TemplateColumn>
                        <asp:TemplateColumn HeaderText="File<br />Upload?" >
                            <ItemTemplate>
                                <asp:CheckBox ID="FileUpload" Checked='<%# CType(Container.DataItem, AdminField).FileUpload  %>'
                                    runat="server"></asp:CheckBox>
                            </ItemTemplate>
                        </asp:TemplateColumn>
                        <asp:TemplateColumn HeaderText="Uploadable<br />Image" >
                            <ItemTemplate>
                                <asp:CheckBox ID="isImage" Checked='<%# CType(Container.DataItem, AdminField).isImage  %>'
                                    runat="server"></asp:CheckBox>
                            </ItemTemplate>
                        </asp:TemplateColumn>
                        <asp:TemplateColumn HeaderText="Default<br />Value" >
                            <ItemTemplate>
                                <asp:TextBox Text='<%# CType(Container.DataItem, AdminField).DefaultValue  %>' MaxLength="200" ID="default_value"
                                    runat="server"></asp:TextBox>
                            </ItemTemplate>
                        </asp:TemplateColumn>
                        <asp:TemplateColumn HeaderText="ToolTip" >
                            <ItemTemplate>
                                <asp:TextBox Text='<%# CType(Container.DataItem, AdminField).toolTip  %>' MaxLength="200" ID="ToolTip"
                                    runat="server"></asp:TextBox>
                            </ItemTemplate>
                        </asp:TemplateColumn>
                        <asp:TemplateColumn HeaderText="Panel<br />Number" >
                            <ItemTemplate>
                                <asp:DropDownList ID="FieldPanel" runat="server" SelectedValue='<%#GetLevelDropListIndex( CType(Container.DataItem, AdminField).PanelNumber)%>'>
                                    <asp:ListItem Text="1" Value="1" />
                                    <asp:ListItem Text="2" Value="2" />
                                    <asp:ListItem Text="3" Value="3" />
                                    <asp:ListItem Text="4" Value="4" />
                                    <asp:ListItem Text="5" Value="5" />
                                    <asp:ListItem Text="6" Value="6" />
                                    <asp:ListItem Text="7" Value="7" />
                                    <asp:ListItem Text="8" Value="8" />
                                    <asp:ListItem Text="9" Value="9" />
                                    <asp:ListItem Text="10" Value="10" />
                                </asp:DropDownList>
                            </ItemTemplate>
                        </asp:TemplateColumn>
                        <asp:TemplateColumn HeaderText="Function" >
                            <ItemTemplate>
                                <asp:DropDownList ID="fieldFunction" runat="server" DataValueField="function_id" DataTextField="function_name"
                                    DataSource='<%# Functions_DownDrop()%>' SelectedValue='<%#GetLevelDropListIndex(CType(Container.DataItem, AdminField).fieldFunction)%>'>
                                </asp:DropDownList>
                            </ItemTemplate>
                        </asp:TemplateColumn>
                        <asp:TemplateColumn HeaderText="Group" >
                            <ItemTemplate>
                                <asp:DropDownList ID="group_id" runat="server" DataValueField="A" DataTextField="B"
                                    DataSource='<%# Group_DownDrop()%>' SelectedValue='<%# CType(Container.DataItem, AdminField).fieldGroupId %>'>
                                </asp:DropDownList>
                            </ItemTemplate>
                        </asp:TemplateColumn>
                        <asp:TemplateColumn HeaderText="Dropdown&nbsp;&nbsp;&nbsp;(Allow Add New)" >
                            <ItemTemplate>
                                <asp:DropDownList ID="ShowDropDown" runat="server" DataValueField="DropDownID" DataTextField="DropDownName"
                                    DataSource='<%#ShowDropDownDrop()%>' SelectedValue='<%#GetLevelDropListIndex(CType(Container.DataItem, AdminField).dropDownID)%>'>
                                </asp:DropDownList>
                                (<asp:CheckBox ID="DropdownAddNew" Checked='<%# CType(Container.DataItem, AdminField).DropDownAddNew %>'
                                    runat="server"></asp:CheckBox>)
                            </ItemTemplate>
                        </asp:TemplateColumn>
                        
                        <asp:TemplateColumn HeaderText="Regular Expression" >
                            <ItemTemplate>
                                <asp:DropDownList ID="RegularExpression" runat="server" DataValueField="RegularExpressionID"
                                    DataTextField="regular_expression_name" DataSource='<%#RegExDrop()%>' SelectedValue='<%#GetLevelDropListIndex(CType(Container.DataItem, AdminField).regularExpressionID)%>'>
                                </asp:DropDownList>
                            </ItemTemplate>
                        </asp:TemplateColumn>
                    </Columns>
                </asp:DataGrid>
                <asp:LinkButton ID="btnBack2" runat="server" Text="Back" OnClick="btnBack_click" CausesValidation="true" Font-Bold="true" Font-Size="Small" />
                <asp:LinkButton ID="btnUpdate2" runat="server" Text="Update" CausesValidation="true" Font-Bold="true" Font-Size="Small" />
            </asp:Panel> 
</asp:Panel>         
    </form>
</body>
</html>
