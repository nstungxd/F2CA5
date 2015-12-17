<%@ Control Language="VB" AutoEventWireup="false"   Inherits="AdminSection6List" CodeFile="section-6-list.ascx.vb" %>

<%@ Import Namespace="PingCore.MyContent" %>
<%@ Import Namespace="System.Data" %>
<%@ Import Namespace="PingCore.MyData" %>
<%@ Import Namespace="PingCore" %>
<asp:label id='lblJavaScript' runat='server' />
<asp:panel runat='Server' id='pl_tablelist'>

<header>
<h3>Users List</h3>
    <% if HasParent then %>
           <asp:linkbutton runat='Server' id='back_button' onCommand='BackToParent' CssClass="admin_links btn_back">Back</asp:linkbutton>
    <% end if %>
            <a href="/admin/sections/pm-users-add.aspx" class="admin_links btn_addnew">Add New User</a>
</header>
<div class="module_content">
   <fieldset>
   <label>
       <asp:linkbutton runat='server' id='toggleSearchVisible' border='0' alt='Show search'>Search - <asp:literal runat='Server' id='RecordSummary' /></asp:linkbutton>
   </label>
       <ajaxToolkit:CollapsiblePanelExtender ID="cpeSearch" runat="Server" TargetControlID="pnlSearchTable" CollapsedSize="0" Collapsed="True" ExpandControlID="toggleSearchVisible" CollapseControlID="toggleSearchVisible" SuppressPostBack="true" AutoCollapse="False" AutoExpand="False" ExpandDirection="Vertical" ImageControlID="imgSearch" CollapsedImage="../images/edit_collapsed.png" ExpandedImage="../images/edit_expanded.png" />
   <asp:Panel runat='server' ID='pnlSearchTable' CssClass='searchWrapper'>
       <table id="searchtable"  border='0' noshade='noshade' cellpadding='0' cellspacing='0' rules='all' class='ListHeaderTable' style='border-collapse:collapse;border-width:1px'>
           <tr class='admin_search_cell'><td class='admin_search_label'>Surname</td><td><asp:TextBox  width='350'  ID="search_input_user_surname" CssClass="formCopy" runat="server"   /></td></tr>
           <tr class='admin_search_cell'><td class='admin_search_label'>Email</td><td><asp:TextBox  width='350'  ID="search_input_user_email" CssClass="formCopy" runat="server"   /></td></tr>

           <tr class='admin_search_cell'><td class='admin_search_label'>&nbsp;</td><td ><asp:button id='search_button' Onclick='perfSearch' cssclass='adminButton' Text='Search' runat='server' /></td></tr>
       </table>
   </asp:Panel>
   </fieldset>
<asp:textbox ID='txtSort' visible='true' runat='server'  style='display:none;' />

<telerik:RadCodeBlock runat="server" ID="codeBlock1">
<telerik:RadGrid runat="server" ID="dg_TableList"  AllowSorting="True" OnSortCommand="dg_TableList_SortCommand" AllowPaging="False"  AllowMultiRowSelection="False" autogeneratecolumns="False" EnableAJAX="False" PageSize="25" EnableEmbeddedSkins="False" Skin="PingCoreEngage"  style="margin:0 0 10px;"> 
<MasterTableView DataKeyNames="user_id"> 
<Columns> 
<telerik:GridBoundColumn ItemStyle-CssClass='css_user_firstname' SortExpression='user_firstname' HeaderText='Firstname' DataField='user_firstname'   />
<telerik:GridBoundColumn ItemStyle-CssClass='css_user_surname' SortExpression='user_surname' HeaderText='Surname' DataField='user_surname'   />
<telerik:GridBoundColumn ItemStyle-CssClass='css_user_last_login' SortExpression='user_last_login' HeaderText='Last Login' DataField='user_last_login'  DataFormatString="{0:dd/MM/yyyy}"   />
<telerik:GridBoundColumn ItemStyle-CssClass='css_user_login_amount' SortExpression='user_login_amount' HeaderText='Login Amount' DataField='user_login_amount'   />
<telerik:GridTemplateColumn HeaderStyle-HorizontalAlign='center' ItemStyle-CssClass='css_user_allsurveys' HeaderText='<b>Global survey access?</b>' ><itemtemplate><center><asp:linkbutton id='linklisttoggle_user_allsurveys'   CommandName='toggle_user_allsurveys'  CommandArgument='user_id'   runat='server' ><img border='0' id='imglist_user_allsurveys' src='images/<%#MyContent.PageContent.ShowListBitField(DataBinder.Eval(Container.DataItem, "user_allsurveys"))%>' /></asp:linkbutton></center></itemtemplate></telerik:GridTemplateColumn>
<telerik:GridButtonColumn HeaderStyle-HorizontalAlign='center' CommandName="EditRecord" HeaderText="<b>Edit</b>" ButtonType="LinkButton" UniqueName="EditColumn" Text='<center><img src="images/documentedit.png" alt="Edit" border="0" /></center>'></telerik:GridButtonColumn>
<telerik:GridTemplateColumn HeaderStyle-HorizontalAlign='center' HeaderText='<b>Delete</b>' Visible='True'><ItemTemplate ><asp:LinkButton  OnClientClick="javascript:return confirm('Are you sure you want to delete this record?')" CommandName='Delete' Text="<center><img src='images/deletenew.png' alt='delete' border='0' /></center>" ID='btnDel' Runat='server' /></ItemTemplate></telerik:GridTemplateColumn>
</Columns>
</MasterTableView>
</telerik:RadGrid>
</telerik:RadCodeBlock>
</div>
<footer>
   <div class="page_links">
       <PingCore:NumericPager runat="server" ID="MyNumericPaging" />
   </div>
   <div id='recsPerPage' class="submit_link">
       Records per page: 
       <asp:dropdownlist runat="server" ID="PageSize" AutoPostBack="true">
           <asp:ListItem Value="10" />
           <asp:ListItem Value="25" selected="true" />
           <asp:ListItem Value="50" />
           <asp:ListItem Value="100" />
           <asp:ListItem Value="999999999"  Text="View All" />    
       </asp:dropdownlist>
   </div>
</footer>
</asp:panel>
