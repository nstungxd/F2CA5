<%@ Page Title="" Language="VB" MasterPageFile="~/Admin/admin.master" AutoEventWireup="false" CodeFile="login.aspx.vb" Inherits="Admin_login" %>

<asp:Content ID="Content1" ContentPlaceHolderID="head" Runat="Server">
</asp:Content>
<asp:Content ID="Content2" ContentPlaceHolderID="adminContentHolder" Runat="Server">

    <article class="module width_full" style="width: 50%;">
        <header>
            <h3>Login</h3>
        </header>
    
        <div class='module_content'>

            <asp:ValidationSummary ID="ValidationSummary1" DisplayMode='BulletList' ShowSummary='true' runat='server' HeaderText='<span>Error: There was a problem with the following items:</span>' ForeColor="#7B040F" CssClass="admin_form_fail" ValidationGroup="SignInForm" />
            <asp:PlaceHolder runat="server" ID="phSignInForm" />

            <fieldset style="padding: 2% 0% 1%;">
                <legend>Login</legend>
                <div class="g_admin_panel">
                    <div class="admin_form_row clearfix">
                        <span class="admin_form_title">Email *</span>
                        <asp:TextBox runat="server" ID="txtEmail" CssClass="formCopy admin_form_text" MaxLength="250" Width="320" />
                        <asp:RequiredFieldValidator SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage="Email address" Text="* Required" id="req_Subject" ControlToValidate="txtEmail" runat="server" Display="Dynamic" ValidationGroup="SignInForm" />
                        <asp:RegularExpressionValidator runat="server" ID="regEmail" ControlToValidate="txtEmail" Display="Dynamic" ErrorMessage="Email address" Text="* Invalid" ValidationGroup="SignInForm" ForeColor="#7B040F" />
                    </div>
                    <div class="admin_form_row clearfix">
                        <span class="admin_form_title">Password *</span>
                        <asp:TextBox runat="server" ID="txtPassword" CssClass="formCopy admin_form_text" MaxLength="20" TextMode="Password" Width="320" />
                        <asp:RequiredFieldValidator SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage="Password (Must be 7+ characters)" Text="* Required" id="reqPassword" ControlToValidate="txtPassword" runat="server" Display="Dynamic" ValidationGroup="SignInForm" />
                        <asp:RegularExpressionValidator runat="server" ID="regPassword" ControlToValidate="txtPassword" Display="Dynamic" ErrorMessage="Password (Must be 7+ characters)" Text="* Invalid" ValidationGroup="SignInForm" ValidationExpression="^\S{6,}$" ForeColor="#7B040F" />
                    </div>
                    <div class="admin_form_row clearfix">
                        <asp:Button runat="server" ID="btnSignIn" Text="Sign In" ValidationGroup="SignInForm" />
                    </div>
                </div>
            </fieldset>

        </div>
        <footer></footer>
    </article>

</asp:Content>

<asp:Content ID="Content3" ContentPlaceHolderID="ScriptContent" Runat="Server">
</asp:Content>

