<%@ Page Title="" Language="VB" MasterPageFile="~/Page.master" AutoEventWireup="false" CodeFile="Login.aspx.vb" Inherits="Login" %>

<asp:Content ID="Content2" ContentPlaceHolderID="MainContent" Runat="Server">

    <div class="s_login">
        <p>
            Please use the login box below.
            <br /><br />
        </p>
        <p>User Login:</p>

        <fieldset id="login_wrapper" class="site_form">
            <legend>Login</legend>
            <div class="sf_row left clear">
                <asp:Label runat="server" ID="lblEmail" AssociatedControlID="txtEmail" Text="Email Address:" CssClass="left sf_row_title" />
            </div>
            <div class="sf_row sf_row_input left clear">
                <asp:TextBox runat="server" ID="txtEmail" CssClass="left sf_row_text" MaxLength="100" />
                <asp:RequiredFieldValidator runat="server" ID="reqEmail" ControlToValidate="txtEmail" Display="Dynamic" ErrorMessage="Email address is required" Text="*" CssClass="left sf_row_fail" ValidationGroup="SignInForm" />
                <asp:RegularExpressionValidator runat="server" ID="regEmail" ControlToValidate="txtEmail" Display="Dynamic" ErrorMessage="Enter a valid email address" Text="*" CssClass="left sf_row_fail" ValidationGroup="SignInForm" />
            </div>
            <div class="sf_row left clear">
                <asp:Label runat="server" ID="lblPassword" AssociatedControlID="txtPassword" Text="Password:" CssClass="left sf_row_title" />
            </div>
            <div class="sf_row sf_row_input left clear">
                <asp:TextBox runat="server" ID="txtPassword" CssClass="left sf_row_text" MaxLength="20" TextMode="Password" />
                <asp:RequiredFieldValidator runat="server" ID="reqPassword" ControlToValidate="txtPassword" Display="Dynamic" ErrorMessage="Password is required" Text="*" CssClass="left sf_row_fail" ValidationGroup="SignInForm" />
            </div>
            <div class="sf_row sf_row_indent sf_row_input left clear">
                <asp:Button runat="server" ID="btnLogin" Text="Login" CssClass="btn_site" ValidationGroup="SignInForm" />
            </div>
            <div class="sf_row left clear">
                <asp:HyperLink runat="server" ID="lnkForgotPassword" NavigateUrl="/forgot-password.aspx" ToolTip="Forgot your password?" EnableViewState="false">Forgot your password?</asp:HyperLink>
            </div>
            <div class="sf_row left clear">
                <asp:ValidationSummary ID="vsSignInForm" runat="server" CssClass="sf_row_faillist" ValidationGroup="SignInForm" />
                <asp:PlaceHolder runat="server" ID="phSignInForm" />
            </div>
        </fieldset>
    </div>

</asp:Content>
