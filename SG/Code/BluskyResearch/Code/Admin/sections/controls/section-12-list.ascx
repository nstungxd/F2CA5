<%@ Control Language="VB" AutoEventWireup="false"   Inherits="AdminSection12List" CodeFile="section-12-list.ascx.vb" %>

<%@ Import Namespace="PingCore.MyContent" %>
<%@ Import Namespace="System.Data" %>
<%@ Import Namespace="PingCore.MyData" %>
<%@ Import Namespace="PingCore" %>
<asp:label id='lblJavaScript' runat='server' />
<asp:panel runat='Server' id='pl_tablelist'>

<header>
<h3>A Sections List</h3>
   <% if CanAdd then %>
       <asp:linkbutton runat='Server' id='add_new_link1' CssClass='admin_links btn_addnew' onCommand='AddNew'>New Section</asp:linkbutton>
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
           <tr class='admin_search_cell'><td class='admin_search_label'>Name</td><td><asp:TextBox  width='350'  ID="search_input_admin_section_name" CssClass="formCopy" runat="server"   /></td></tr>
           <tr class='admin_search_cell'><td class='admin_search_label'>Item Name</td><td><asp:TextBox  width='350'  ID="search_input_admin_section_item_name" CssClass="formCopy" runat="server"   /></td></tr>
           <tr class='admin_search_cell'><td class='admin_search_label'>Edit Table</td><td><asp:TextBox  width='350'  ID="search_input_admin_section_edit_table" CssClass="formCopy" runat="server"   /></td></tr>
           <tr class='admin_search_cell'>
  <td class='admin_search_label'>Group Fk</td>
  <td><asp:Panel id="search_input_admin_section_group_fk_AjaxPanel" runat="server">
    <PingCore:DependentDropdown id="search_input_admin_section_group_fk" runat="server" />
  </asp:Panel></td>
</tr>
           <tr class='admin_search_cell'><td class='admin_search_label'>&nbsp;</td><td ><asp:button id='search_button' Onclick='perfSearch' cssclass='adminButton' Text='Search' runat='server' /></td></tr>
       </table>
   </asp:Panel>
   </fieldset>
<asp:textbox ID='txtSort' visible='true' runat='server'  style='display:none;' />

<telerik:RadCodeBlock runat="server" ID="codeBlock1">
<telerik:RadGrid runat="server" ID="dg_TableList" CssClass='dg_draglist' AllowSorting="True" OnSortCommand="dg_TableList_SortCommand" AllowPaging="False" OnRowDrop="dg_TableList_RowDrop" AllowMultiRowSelection="False" autogeneratecolumns="False" EnableAJAX="False" PageSize="25" EnableEmbeddedSkins="False" Skin="PingCoreEngage"  style="margin:0 0 10px;"> 
<MasterTableView DataKeyNames="admin_section_id,admin_section_menu_order"> 
<Columns> 
<telerik:GridBoundColumn ItemStyle-CssClass='css_admin_section_id' SortExpression='admin_section_id' HeaderText='ID' DataField='admin_section_id'   />
<telerik:GridBoundColumn ItemStyle-CssClass='css_admin_section_name' SortExpression='admin_section_name' HeaderText='Name' DataField='admin_section_name'   />

<telerik:GridTemplateColumn 
  ItemStyle-CssClass='rel_1' 
  
  HeaderStyle-HorizontalAlign='center' 
  ItemStyle-HorizontalAlign='center' 
  Visible='True'>
  <ItemTemplate>
    <asp:linkbutton id="rel_1" runat="server" CommandName="Relationship" CommandArgument="1" CssClass="admin_links" onmouseover='return overlib("Fields");' onmouseout='return nd();'>
      <img src='images/A_List_Fields.png' border='0' alt='Fields' title='Fields' />
    </asp:linkbutton>
  </ItemTemplate>
</telerik:GridTemplateColumn>


<telerik:GridTemplateColumn 
  ItemStyle-CssClass='rel_2' 
  
  HeaderStyle-HorizontalAlign='center' 
  ItemStyle-HorizontalAlign='center' 
  Visible='True'>
  <ItemTemplate>
    <asp:linkbutton id="rel_2" runat="server" CommandName="Relationship" CommandArgument="2" CssClass="admin_links" onmouseover='return overlib("Links");' onmouseout='return nd();'>
      <img src='images/A_Custom_Links.png' border='0' alt='Links' title='Links' />
    </asp:linkbutton>
  </ItemTemplate>
</telerik:GridTemplateColumn>


<telerik:GridTemplateColumn 
  ItemStyle-CssClass='rel_3' 
  
  HeaderStyle-HorizontalAlign='center' 
  ItemStyle-HorizontalAlign='center' 
  Visible='True'>
  <ItemTemplate>
    <asp:linkbutton id="rel_3" runat="server" CommandName="Relationship" CommandArgument="3" CssClass="admin_links" onmouseover='return overlib("Relationships");' onmouseout='return nd();'>
      <img src='images/A_Relationships.png' border='0' alt='Relationships' title='Relationships' />
    </asp:linkbutton>
  </ItemTemplate>
</telerik:GridTemplateColumn>


<telerik:GridTemplateColumn 
  ItemStyle-CssClass='rel_13' 
  
  HeaderStyle-HorizontalAlign='center' 
  ItemStyle-HorizontalAlign='center' 
  Visible='True'>
  <ItemTemplate>
    <asp:linkbutton id="rel_13" runat="server" CommandName="Relationship" CommandArgument="13" CssClass="admin_links" onmouseover='return overlib("Dependent Fields");' onmouseout='return nd();'>
      <img src='images/A_S_Dependent_Fields.png' border='0' alt='Dependent Fields' title='Dependent Fields' />
    </asp:linkbutton>
  </ItemTemplate>
</telerik:GridTemplateColumn>


<telerik:GridTemplateColumn 
  ItemStyle-CssClass='rel_14' 
  
  HeaderStyle-HorizontalAlign='center' 
  ItemStyle-HorizontalAlign='center' 
  Visible='True'>
  <ItemTemplate>
    <asp:linkbutton id="rel_14" runat="server" CommandName="Relationship" CommandArgument="14" CssClass="admin_links" onmouseover='return overlib("Filters");' onmouseout='return nd();'>
      <img src='images/A_Filters.png' border='0' alt='Filters' title='Filters' />
    </asp:linkbutton>
  </ItemTemplate>
</telerik:GridTemplateColumn>


<%--<telerik:GridTemplateColumn 
  ItemStyle-CssClass='rel_19' 
  
  HeaderStyle-HorizontalAlign='center' 
  ItemStyle-HorizontalAlign='center' 
  Visible='True'>
  <ItemTemplate>
    <asp:linkbutton id="rel_19" runat="server" CommandName="Relationship" CommandArgument="19" CssClass="admin_links" onmouseover='return overlib("Ajax Methods");' onmouseout='return nd();'>
      <img src='images/' border='0' alt='Ajax Methods' title='Ajax Methods' />
    </asp:linkbutton>
  </ItemTemplate>
</telerik:GridTemplateColumn>--%>


<telerik:GridTemplateColumn 
  ItemStyle-CssClass='custom_link_1' 
  
  HeaderStyle-HorizontalAlign='center' 
  ItemStyle-HorizontalAlign='center' 
  Visible='True'>
  <ItemTemplate>
    <asp:linkbutton id="cust_1" runat="server" CommandName="CustomLink" CommandArgument="1" CssClass="admin_links">
      <img src='images/Contents.png' border='0' alt='Contents' title='Contents' />
    </asp:linkbutton>
  </ItemTemplate>
</telerik:GridTemplateColumn>


<telerik:GridTemplateColumn 
  ItemStyle-CssClass='custom_link_2' 
  
  HeaderStyle-HorizontalAlign='center' 
  ItemStyle-HorizontalAlign='center' 
  Visible='True'>
  <ItemTemplate>
    <asp:linkbutton id="cust_2" runat="server" CommandName="CustomLink" CommandArgument="2" CssClass="admin_links">
      <img src='images/Regen.png' border='0' alt='Regen' title='Regen' />
    </asp:linkbutton>
  </ItemTemplate>
</telerik:GridTemplateColumn>


<telerik:GridTemplateColumn 
  ItemStyle-CssClass='custom_link_3' 
  
  HeaderStyle-HorizontalAlign='center' 
  ItemStyle-HorizontalAlign='center' 
  Visible='True'>
  <ItemTemplate>
    <asp:linkbutton id="cust_3" runat="server" CommandName="CustomLink" CommandArgument="3" CssClass="admin_links">
      <img src='images/Goto.png' border='0' alt='Goto' title='Goto' />
    </asp:linkbutton>
  </ItemTemplate>
</telerik:GridTemplateColumn>

<telerik:GridButtonColumn HeaderStyle-HorizontalAlign='center' CommandName="EditRecord" HeaderText="<b>Edit</b>" ButtonType="LinkButton" UniqueName="EditColumn" Text='<center><img src="images/documentedit.png" alt="Edit" border="0" /></center>'></telerik:GridButtonColumn>
<telerik:GridTemplateColumn HeaderStyle-HorizontalAlign='center' HeaderText='<b>Delete</b>' Visible='True'><ItemTemplate ><asp:LinkButton  OnClientClick="javascript:return confirm('Are you sure you want to delete this record?')" CommandName='Delete' Text="<center><img src='images/deletenew.png' alt='delete' border='0' /></center>" ID='btnDel' Runat='server' /></ItemTemplate></telerik:GridTemplateColumn>
</Columns>
</MasterTableView>
<ClientSettings AllowRowsDragDrop="True">
   <Selecting AllowRowSelect="True" EnableDragToSelectRows="false"/>
</ClientSettings>
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
