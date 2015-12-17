<%@ Control Language="VB" AutoEventWireup="false"   Inherits="AdminSection55List" CodeFile="section-55-list.ascx.vb" %>

<%@ Import Namespace="PingCore.MyContent" %>
<%@ Import Namespace="System.Data" %>
<%@ Import Namespace="PingCore.MyData" %>
<%@ Import Namespace="PingCore" %>
<asp:label id='lblJavaScript' runat='server' />
<asp:panel runat='Server' id='pl_tablelist'>

<header>
<h3>A Regular Expressions List</h3>
   <% if CanAdd then %>
       <asp:linkbutton runat='Server' id='add_new_link1' CssClass='admin_links btn_addnew' onCommand='AddNew'>New Regex</asp:linkbutton>
       <% if HasParent then %>
           <asp:linkbutton runat='Server' id='back_button' onCommand='BackToParent' CssClass="admin_links btn_back">Back</asp:linkbutton>
       <% end if %>
   <% end if %>
</header>
<div class="module_content">
   <fieldset>
   <asp:Panel runat="server" ID="pnlSearchTable"></asp:Panel>
   <label>
       <asp:literal runat='Server' id='RecordSummary' />
   </label>
   </fieldset>
<asp:textbox ID='txtSort' visible='true' runat='server'  style='display:none;' />

<telerik:RadCodeBlock runat="server" ID="codeBlock1">
<telerik:RadGrid runat="server" ID="dg_TableList"  AllowSorting="True" OnSortCommand="dg_TableList_SortCommand" AllowPaging="False"  AllowMultiRowSelection="False" autogeneratecolumns="False" EnableAJAX="False" PageSize="25" EnableEmbeddedSkins="False" Skin="PingCoreEngage"  style="margin:0 0 10px;"> 
<MasterTableView DataKeyNames="RegularExpressionID"> 
<Columns> 
<telerik:GridBoundColumn ItemStyle-CssClass='css_RegularExpressionID' SortExpression='RegularExpressionID' HeaderText='ID' DataField='RegularExpressionID'   />
<telerik:GridBoundColumn ItemStyle-CssClass='css_regular_expression_name' SortExpression='regular_expression_name' HeaderText='Name' DataField='regular_expression_name'   />
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
