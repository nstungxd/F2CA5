<%@ Control Language="VB" AutoEventWireup="false"   Inherits="AdminSection29List" CodeFile="section-29-list.ascx.vb" %>

<%@ Import Namespace="PingCore.MyContent" %>
<%@ Import Namespace="System.Data" %>
<%@ Import Namespace="PingCore.MyData" %>
<%@ Import Namespace="PingCore" %>
<asp:label id='lblJavaScript' runat='server' />
<asp:panel runat='Server' id='pl_tablelist'>

<header>
<h3>A User Types List</h3>
   <% if CanAdd then %>
       <asp:linkbutton runat='Server' id='add_new_link1' CssClass='admin_links btn_addnew' onCommand='AddNew'>New Type of User</asp:linkbutton>
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
<MasterTableView DataKeyNames="utype_id"> 
<Columns> 
<telerik:GridBoundColumn ItemStyle-CssClass='css_utype_name' SortExpression='utype_name' HeaderText='Name' DataField='utype_name'   />
<telerik:GridTemplateColumn HeaderStyle-HorizontalAlign='center' ItemStyle-CssClass='css_utype_hasglobalaccess' HeaderText='<b>Hasglobalaccess</b>' ><itemtemplate><center><img border='0' id='list_utype_hasglobalaccess' src='images/<%#MyContent.PageContent.ShowListBitField(DataBinder.Eval(Container.DataItem, "utype_hasglobalaccess"))%>' /></center></itemtemplate></telerik:GridTemplateColumn>

<telerik:GridTemplateColumn 
  ItemStyle-CssClass='custom_link_10' 
  HeaderText='<b>Sections</b>'
  HeaderStyle-HorizontalAlign='center' 
  ItemStyle-HorizontalAlign='center' 
  Visible='True'>
  <ItemTemplate>
    <asp:linkbutton id="cust_10" runat="server" CommandName="CustomLink" CommandArgument="10" CssClass="admin_links">
      <img src='images/Sections.png' border='0' alt='Sections' title='Sections' />
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
