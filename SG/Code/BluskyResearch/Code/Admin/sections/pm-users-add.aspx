<%@ Page Title="" Language="VB" MasterPageFile="~/Admin/admin.master" AutoEventWireup="false" CodeFile="pm-users-add.aspx.vb" Inherits="Admin_sections_pm_users_add" %>

<asp:Content ID="Content1" ContentPlaceHolderID="head" Runat="Server">
</asp:Content>
<asp:Content ID="Content2" ContentPlaceHolderID="adminContentHolder" Runat="Server">

    <article class="module width_full">
        <header>
            <h3>Add New User</h3>
        </header>
    
        <div class='module_content'>

            <asp:ValidationSummary ID="ValidationSummary1" DisplayMode='BulletList' ShowSummary='true' runat='server' HeaderText='<span>Error: There was a problem with the following items:</span>' ForeColor="#7B040F" CssClass="admin_form_fail" ValidationGroup="RegisterForm" />
            <asp:PlaceHolder runat="server" ID="phRegisterForm" />

            <fieldset>
                <legend>Login</legend>
                <div class="g_admin_panel">
                    <div class="admin_form_row clearfix">
                        <span class="admin_form_title">User Type *</span>
                        <asp:DropDownList runat="server" ID="ddlUserType" CssClass="admin_form_ddl">
                            <asp:ListItem Selected="True" Value="2">Admin User</asp:ListItem>
                            <asp:ListItem Value="3">Site User</asp:ListItem>
                        </asp:DropDownList>
                    </div>
                    <div class="admin_form_row clearfix">
                        <span class="admin_form_title">Email *</span>
                        <asp:TextBox runat="server" ID="txtEmail" CssClass="formCopy admin_form_text" MaxLength="250" Width="320" />
                        <asp:RequiredFieldValidator SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage="Email address" Text="* Required" id="req_Subject" ControlToValidate="txtEmail" runat="server" Display="Dynamic" ValidationGroup="RegisterForm" />
                        <asp:RegularExpressionValidator runat="server" ID="regEmail" ControlToValidate="txtEmail" Display="Dynamic" ErrorMessage="Email address" Text="* Invalid" ValidationGroup="RegisterForm" ForeColor="#7B040F" />
                    </div>
                    <div class="admin_form_row clearfix">
                        <span class="admin_form_title">Password *</span>
                        <asp:TextBox runat="server" ID="txtPassword" CssClass="formCopy admin_form_text" MaxLength="20" Width="320" />
                        <asp:RequiredFieldValidator SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage="Password (Must be 7+ characters)" Text="* Required" id="reqPassword" ControlToValidate="txtPassword" runat="server" Display="Dynamic" ValidationGroup="RegisterForm" />
                        <asp:RegularExpressionValidator runat="server" ID="regPassword" ControlToValidate="txtPassword" Display="Dynamic" ErrorMessage="Password (Must be 7+ characters)" Text="* Invalid" ValidationGroup="RegisterForm" ValidationExpression="^\S{6,}$" ForeColor="#7B040F" />
                    </div>
                    <div class="admin_form_row clearfix">
                        <span class="admin_form_title">First name *</span>
                        <asp:TextBox runat="server" ID="txtFirstName" CssClass="formCopy admin_form_text" MaxLength="250" Width="320" />
                        <asp:RequiredFieldValidator SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage="First Name" Text="* Required" id="reqFirstName" ControlToValidate="txtFirstName" runat="server" Display="Dynamic" ValidationGroup="RegisterForm" />
                    </div>
                    <div class="admin_form_row clearfix">
                        <span class="admin_form_title">Surname *</span>
                        <asp:TextBox runat="server" ID="txtSurname" CssClass="formCopy admin_form_text" MaxLength="250" Width="320" />
                        <asp:RequiredFieldValidator SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage="Surname" Text="* Required" id="reqSurname" ControlToValidate="txtSurname" runat="server" Display="Dynamic" ValidationGroup="RegisterForm" />
                    </div>
                    <div class="admin_form_row clearfix">
                        <span class="admin_form_title">Global survey access?</span>
                        <asp:CheckBox runat="server" ID="chkGloblaAccess" CssClass="admin_form_check" />
                    </div>
                    <div class="admin_form_row clearfix">
                        <asp:Button runat="server" ID="btnRegister" Text="Add User" ValidationGroup="RegisterForm" />
                    </div>
                </div>
            </fieldset>

        </div>
        <footer></footer>
    </article>

</asp:Content>
<asp:Content ID="Content3" ContentPlaceHolderID="ScriptContent" Runat="Server">
</asp:Content>

