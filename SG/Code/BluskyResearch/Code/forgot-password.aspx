<%@ Page Title="" Language="VB" MasterPageFile="~/Page.master" AutoEventWireup="false" CodeFile="forgot-password.aspx.vb" Inherits="Account_forgot_password" %>

<asp:Content ID="Content2" ContentPlaceHolderID="MainContent" Runat="Server">
    
    <div class="s_login">
        <p>
            Forgotten your password?
            <br /><br />
        </p>

        <asp:MultiView runat="server" ID="mvForgotPassword" ActiveViewIndex="0">
            <asp:View runat="server" ID="View1">
                
                <p>Please enter the email address you use to log in and we'll send a temporary password out to you.</p>
                
                <fieldset id="fpass_wrapper" class="site_form">
                    <legend>Forgotten Password</legend>

                    <div class="sf_row left clear">
                        <asp:Label runat="server" ID="lblEmail" AssociatedControlID="txtEmail" Text="Email Address:" CssClass="left sf_row_title" />
                    </div>
                    <div class="sf_row sf_row_input left clear">
                        <asp:TextBox runat="server" ID="txtEmail" CssClass="left sf_row_text" MaxLength="100" />
                        <asp:RequiredFieldValidator runat="server" ID="reqEmail" ControlToValidate="txtEmail" Display="Dynamic" ErrorMessage="Email address is required" Text="*" CssClass="left sf_row_fail" ValidationGroup="ForgotPasswordForm" />
                        <asp:RegularExpressionValidator runat="server" ID="regEmail" ControlToValidate="txtEmail" Display="Dynamic" ErrorMessage="Enter a valid email address" Text="*" CssClass="left sf_row_fail" ValidationGroup="ForgotPasswordForm" />
                    </div>
                    <div class="sf_row sf_row_indent sf_row_input left clear">
                        <asp:HyperLink runat="server" ID="lnkCancel" NavigateUrl="/SignIn.aspx" CssClass="btn_site btn_cancel">Cancel</asp:HyperLink>
                        <asp:Button runat="server" ID="btnConfirm" Text="Send Password" CssClass="btn_site btn_submit" ValidationGroup="ForgotPasswordForm" />
                    </div>
                    <div class="sf_row left clear">
                        <asp:ValidationSummary ID="vsForgotPasswordForm" runat="server" CssClass="sf_row_faillist" ValidationGroup="ForgotPasswordForm" />
                        <asp:PlaceHolder runat="server" ID="phForgotPasswordForm" />
                    </div>
                </fieldset>

            </asp:View>
            <asp:View runat="server" ID="SuccessView">
                <p>
                    We've sent your temporary password to <asp:Literal ID="litSentEmail" runat="server" />. Continue below to reset your password to something more memorable.
                </p>
                <p>
                    <a href="/reset-password.aspx" title="Continue" class="btn_site">Continue</a>
                </p>
            </asp:View>
        </asp:MultiView>

    </div>

</asp:Content>
