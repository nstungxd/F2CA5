<%@ Page Title="" Language="VB" MasterPageFile="~/Page.master" AutoEventWireup="false" CodeFile="reset-password.aspx.vb" Inherits="Account_reset_password" %>

<asp:Content ID="BodyContent" runat="server" ContentPlaceHolderID="MainContent" >

    <div class="s_login">
        <p>
            Reset Password
            <br /><br />
        </p>

        <asp:MultiView runat="server" ID="mvResetPassword" ActiveViewIndex="0">
            <asp:View runat="server" ID="FormView">
                
                <p>Please re-enter your email address and your temporary password, and choose a new password.</p>
                
                <fieldset id="reset_wrapper" class="site_form">
                    <legend>Reset Password</legend>

                    <div class="sf_row left clear">
                        <asp:Label runat="server" ID="lblEmail" AssociatedControlID="txtEmail" Text="Email:" CssClass="left sf_row_title" />
                    </div>
                    <div class="sf_row sf_row_input left clear">
                        <asp:TextBox runat="server" ID="txtEmail" CssClass="left sf_row_text" MaxLength="100" />
                        <asp:RequiredFieldValidator runat="server" ID="reqEmail" ControlToValidate="txtEmail" Display="Dynamic" ErrorMessage="Email address is required" Text="*" CssClass="left sf_row_fail" ValidationGroup="ResetPasswordForm" />
                        <asp:RegularExpressionValidator runat="server" ID="regEmail" ControlToValidate="txtEmail" Display="Dynamic" ErrorMessage="Enter a valid email address" Text="*" CssClass="left sf_row_fail" ValidationGroup="ResetPasswordForm" />
                    </div>

                    <div class="sf_row left clear">
                        <asp:Label runat="server" ID="lblTempPassword" AssociatedControlID="txtTempPassword" Text="Temporary password:" CssClass="left sf_row_title" />
                    </div>
                    <div class="sf_row sf_row_input left clear">
                        <asp:TextBox ID="txtTempPassword" runat="server" CssClass="left sf_row_text" MaxLength="50" />
                        <asp:RequiredFieldValidator ID="reqTempPassword" runat="server" ControlToValidate="txtTempPassword" Display="Dynamic" ErrorMessage="Temporary password is required" Text="*" ValidationGroup="ResetPasswordForm" CssClass="left sf_row_fail"  />
                        <asp:RegularExpressionValidator ID="regTempPassword" runat="server" ControlToValidate="txtTempPassword" ValidationExpression="^\S{6,}$" Display="Dynamic" ErrorMessage="Enter a valid temporary password" Text="*" ValidationGroup="ResetPasswordForm" CssClass="left sf_row_fail" />
                    </div>
                    <div class="sf_row left clear">
                        <asp:Label runat="server" ID="lblNewPassword" AssociatedControlID="txtNewPassword" Text="New Password:" CssClass="left sf_row_title" />
                    </div>
                    <div class="sf_row sf_row_input left clear">
                        <asp:TextBox runat="server" ID="txtNewPassword" CssClass="left sf_row_text" ValidationGroup="ResetPasswordForm" TextMode="Password" />
                        <asp:RequiredFieldValidator runat="server" ID="reqNewPassword" ControlToValidate="txtNewPassword" ErrorMessage="A new password is required" Text="*" Display="Dynamic" ValidationGroup="ResetPasswordForm" CssClass="left sf_row_fail" />
                        <asp:RegularExpressionValidator runat="server" ID="regNewPassword" ControlToValidate="txtNewPassword" CssClass="left sf_row_fail" Display="Dynamic" ErrorMessage="Enter a valid password" Text="*" ValidationExpression="^\S{6,}$" ValidationGroup="ResetPasswordForm" />
                    </div>
                    <div class="sf_row left clear">
                        <asp:Label runat="server" ID="lblConfirmPassword" AssociatedControlID="txtConfirmPassword" Text="Confirm Password:" CssClass="left sf_row_title" />
                    </div>
                    <div class="sf_row sf_row_input left clear">
                        <asp:TextBox runat="server" ID="txtConfirmPassword" CssClass="left sf_row_text" ValidationGroup="ResetPasswordForm" TextMode="Password" />
                        <asp:RequiredFieldValidator runat="server" ID="reqConfirmPassword" ControlToValidate="txtConfirmPassword" ErrorMessage="Confirmation password is required" Text="*" Display="Dynamic" ValidationGroup="ResetPasswordForm" CssClass="left sf_row_fail" />
                        <asp:CompareValidator runat="server" ID="comConfirmPassword" ControlToValidate="txtConfirmPassword" ErrorMessage="Passwords must match" Text="*" ControlToCompare="txtNewPassword" Display="Dynamic" ValidationGroup="ResetPasswordForm" CssClass="left sf_row_fail" />
                    </div>
                    <div class="sf_row sf_row_indent sf_row_input left clear">
                        <asp:HyperLink runat="server" ID="lnkCancel" NavigateUrl="/SignIn.aspx" CssClass="btn_site btn_cancel">Cancel</asp:HyperLink>
                        <asp:Button runat="server" ID="btnConfirm" Text="Confirm" CssClass="btn_site btn_submit" ValidationGroup="ResetPasswordForm" />
                    </div>
                    <div class="sf_row left clear">
                        <asp:ValidationSummary ID="vsResetPasswordForm" runat="server" CssClass="sf_row_faillist" ValidationGroup="ResetPasswordForm" />
                        <asp:PlaceHolder runat="server" ID="phResetPasswordForm" />
                    </div>
                </fieldset>

            </asp:View>
            <asp:View runat="server" ID="FailView">
                <p>
                    There hasn't been a temporary password set for your account, this is needed in order to reset your password. Click below to be sent a temporary password.
                </p>
                <p>
                    <a href="/forgot-password.aspx" title="Get a temporary password" class="btn_site">Send</a>
                </p>
            </asp:View>
            <asp:View runat="server" ID="SuccessView">
                <p>
                    Your password has been successfully changed.
                </p>
                <p>
                    <a href="/surveys" title="Continue" class="btn_site">Continue</a>
                </p>
            </asp:View>
        </asp:MultiView>


    </div>

</asp:Content>

