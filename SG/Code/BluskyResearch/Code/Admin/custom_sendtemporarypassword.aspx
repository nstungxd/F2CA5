<%@ Page Language="VB" MasterPageFile="~/admin/admin.master" AutoEventWireup="false" ClassName="Custom_SendTemporaryPassword_Front" Inherits="Custom_SendTemporaryPassword_Behind" CodeFile="custom_sendtemporarypassword.aspx.vb" %>
<%@ Register TagPrefix="my" Namespace=" MyControls" %>
<asp:Content id="Content1" runat="server" ContentPlaceHolderID="AdminContentHolder">
	<h2>Issue Temporary Password</h2>

	<asp:PlaceHolder ID="pnlSuccess" runat="server">
		<p>A new temporary password has been generated for this user and an email has been sent to their email address.</p>
	</asp:PlaceHolder>
	
	<asp:PlaceHolder ID="pnlMailError" runat="server">
		<p  style="color:#c00;">A mail error occurred.  Please refresh this page (F5) to try again or click below to return to the users screen.</p>
	</asp:PlaceHolder>
	
	<asp:PlaceHolder ID="pnlMissingTemplate" runat="server">
		<p  style="color:#c00;">The email was not sent because the email template is missing. Please contact web support.</p>
	</asp:PlaceHolder>
	
	
	
	<p><asp:HyperLink ID="lnkReturn" runat="server" NavigateUrl="/admin/sections/admin-users.aspx" Text="Return..." /></p>

</asp:Content>