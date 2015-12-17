<%@ Control Language="VB" AutoEventWireup="false"   Inherits="AdminSection7List" CodeFile="section-7-list.ascx.vb" %>

<%@ Import Namespace="PingCore.MyContent" %>
<%@ Import Namespace="System.Data" %>
<%@ Import Namespace="PingCore.MyData" %>
<%@ Import Namespace="PingCore" %>
<asp:label id='lblJavaScript' runat='server' />
<asp:panel runat='Server' id='pl_tablelist'>

<header>
<h3>A Dropdowns List</h3>
   <% if CanAdd then %>
       <asp:linkbutton runat='Server' id='add_new_link1' CssClass='admin_links btn_addnew' onCommand='AddNew'>New Dropdown</asp:linkbutton>
       <% if HasParent then %>
           <asp:linkbutton runat='Server' id='back_button' onCommand='BackToParent' CssClass="admin_links btn_back">Back</asp:linkbutton>
       <% end if %>
   <% end if %>
</header>
<div class="module_content">
   <fieldset>
   <label>
       <asp:linkbutton runat='server' id='toggleSearchVisible' border='0' alt='Show search'>Search - <asp:literal runat='Server' id='RecordSummary' /></asp:linkbutton>
   </label>
       <ajaxToolkit:CollapsiblePanelExtender ID="cpeSearch" runat="Server" TargetControlID="pnlSearchTable" CollapsedSize="0" Collapsed="True" ExpandControlID="toggleSearchVisible" CollapseControlID="toggleSearchVisible" SuppressPostBack="true" AutoCollapse="False" AutoExpand="False" ExpandDirection="Vertical" ImageControlID="imgSearch" CollapsedImage="../images/edit_collapsed.png" ExpandedImage="../images/edit_expanded.png" />
   <asp:Panel runat='server' ID='pnlSearchTable' CssClass='searchWrapper'>
       <table id="searchtable"  border='0' noshade='noshade' cellpadding='0' cellspacing='0' rules='all' class='ListHeaderTable' style='border-collapse:collapse;border-width:1px'>
           <tr class='admin_search_cell'><td class='admin_search_label'>Name</td><td><asp:TextBox  width='350'  ID="search_input_DropDownName" CssClass="formCopy" runat="server"   /></td></tr>

           <tr class='admin_search_cell'><td class='admin_search_label'>&nbsp;</td><td ><asp:button id='search_button' Onclick='perfSearch' cssclass='adminButton' Text='Search' runat='server' /></td></tr>
       </table>
   </asp:Panel>
   </fieldset>
<asp:textbox ID='txtSort' visible='true' runat='server'  style='display:none;' />

<telerik:RadCodeBlock runat="server" ID="codeBlock1">
<telerik:RadGrid runat="server" ID="dg_TableList"  AllowSorting="True" OnSortCommand="dg_TableList_SortCommand" AllowPaging="False"  AllowMultiRowSelection="False" autogeneratecolumns="False" EnableAJAX="False" PageSize="25" EnableEmbeddedSkins="False" Skin="PingCoreEngage"  style="margin:0 0 10px;"> 
<MasterTableView DataKeyNames="DropDownID"> 
<Columns> 
<telerik:GridBoundColumn ItemStyle-CssClass='css_DropDownID' SortExpression='DropDownID' HeaderText='ID' DataField='DropDownID'   />
<telerik:GridBoundColumn ItemStyle-CssClass='css_DropDownName' SortExpression='DropDownName' HeaderText='Name' DataField='DropDownName'   />

<telerik:GridTemplateColumn 
  ItemStyle-CssClass='rel_18' 
  HeaderText='<b>Translations</b>'
  HeaderStyle-HorizontalAlign='center' 
  ItemStyle-HorizontalAlign='center' 
  Visible='True'>
  <ItemTemplate>
    <asp:linkbutton id="rel_18" runat="server" CommandName="Relationship" CommandArgument="18" CssClass="admin_links" onmouseover='return overlib("Translations");' onmouseout='return nd();'>
      <img src='images/A_Dropdown_Translations.png' border='0' alt='Translations' title='Translations' />
    </asp:linkbutton>
  </ItemTemplate>
</telerik:GridTemplateColumn>

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
