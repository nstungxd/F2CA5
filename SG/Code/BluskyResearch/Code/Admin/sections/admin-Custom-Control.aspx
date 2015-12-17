<%@ Page Language="VB" MasterPageFile="~/admin/admin.master" AutoEventWireup="false"  CodeFile="admin-Custom-Control.aspx.vb" Inherits="AdminSection87MainPage"   ValidateRequest="false"  EnableEventValidation="false"  %>
<%@ Register Src="controls/section-87-list.ascx"  TagName="ListView" TagPrefix="ADM"  %>
<%@ Register Src="controls/section-87-edit.ascx"  TagName="EditView" TagPrefix="ADM"  %>
<%@ Import Namespace="PingCore.MyContent" %>
<%@ Import Namespace="PingCore.MyData" %>
<%@ Import Namespace="System.Data" %>
<%@ Import Namespace="System.Data.OLEDB" %>
<%@ Import Namespace="PingCore" %>

<asp:Content ContentPlaceHolderID="adminContentHolder" ID="admincontent" runat="server">

<article class="module width_full">
   <telerik:RadAjaxManager runat="server" ID="TheRadAjaxManager" />

   <ADM:ListView runat="server" ID="ListControl"></ADM:ListView>
   <ADM:EditView runat="server" ID="EditControl"></ADM:EditView>
   </article>
</asp:Content>
