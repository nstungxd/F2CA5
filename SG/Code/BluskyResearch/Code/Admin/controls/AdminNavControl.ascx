<%@ Control Language="VB" AutoEventWireup="false" classname="AdminNavControl"  Inherits="Admin_AdminnavControl_Behind" CodeFile="AdminNavControl.ascx.vb" %>
<%@ Register TagPrefix="PM" TagName="MenuControl" Src="~/admin/Controls/MenuControl.ascx" %>

    <PM:MenuControl ID="SuperMenu" runat="server" CssClass="g_superadminnav">
	    <SeparatorTemplate></SeparatorTemplate>
    </PM:MenuControl>
  