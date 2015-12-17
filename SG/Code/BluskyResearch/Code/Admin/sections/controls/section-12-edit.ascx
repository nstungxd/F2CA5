<%@ Control autoeventwireup="false" Language="VB"  CodeFile="section-12-edit.ascx.vb" Inherits="AdminSection12Edit"  %>
<%@ Register Assembly="Karpach.WebControls" Namespace="Karpach.WebControls" TagPrefix="cc1" %>
<%@ Register Assembly="PingCore" Namespace="PingCore.WebsiteControls" TagPrefix="PM" %>

<%@ Import Namespace="PingCore.MyContent" %>
<%@ Import Namespace="System.Data" %>
<%@ Import Namespace="PingCore.MyData" %>
<%@ Import Namespace="PingCore" %>
<div id="EditControl_12">
<asp:textbox ID='recordtitle'  visible='true' runat='server'   style='display:none;' />
<asp:textbox ID='currpage' visible='true' runat='server' Text="1" style='display:none;' />
<asp:textbox ID='maxpage'  visible='true' runat='server' Text="0" style='display:none;' />

<header>
<h3><asp:Literal runat="server" ID="edittitle" /></h3>
<asp:LinkButton ID="back_link1" CausesValidation='false' CssClass='admin_links btn_back' OnClick='BackLink' runat='server'>Back</asp:LinkButton>
</header>
<asp:panel id='pnl_Edit' runat='server' >
<div class='module_content'>
<div class="admin_btn_wrapper clearfix">
   <asp:Button CssClass="btn_abandon" Visible="true" ID="AbandonBtn1" Text="Abandon Changes" runat="server" CausesValidation="False" />
   <asp:Button CssClass="alt_btn btn_save" Visible="true" ID="SubmitBtn1" OnClick="SubmitBtn_Click" Text="Save >" runat="server" />
   <asp:Button CssClass="alt_btn btn_save" Visible="false" ID="PrevBtn1" OnClick="PrevBtn_Click" Text="< Previous" runat="server" />
   <asp:Button CssClass="alt_btn btn_save" Visible="false" ID="NextBtn1" OnClick="NextBtn_Click" Text="Next >" runat="server" />
</div>

<asp:ValidationSummary ID="ValidationSummary1" DisplayMode='BulletList' ShowSummary='true' runat='server' HeaderText='<span>Error: There was a problem with the following items:</span>' ForeColor="#7B040F" CssClass="admin_form_fail" />
<!-- Start New Panel //-->
<asp:panel id='page1' runat='server' visible='false' style="position: relative;">

<!-- Start New Group //-->
<fieldset><div id='panel_1_group_2' class="g_admin_panel">
      <label>General</label>
       
       <div class="admin_form_row clearfix" id="edit_column_admin_section_name"  >
  <span class="admin_form_title"> Name</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_name' />



<asp:TextBox  width='320'  MaxLength='200'  ID="input_admin_section_name"  CssClass="formCopy admin_form_text" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_item_name"  >
  <span class="admin_form_title"> Item Name</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_item_name' />



<asp:TextBox  width='320'  MaxLength='50'  ID="input_admin_section_item_name"  CssClass="formCopy admin_form_text" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_list_fields"  >
  <span class="admin_form_title"> Admin Section List Fields</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_list_fields' />



<asp:TextBox width='320' height='150'  MaxLength='2147483647'  TextMode='multiline' ID="input_admin_section_list_fields"  CssClass="formCopy admin_form_multitext" runat="server"   /></div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_list_tables"  >
  <span class="admin_form_title"> Admin Section List Tables</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_list_tables' />



<asp:TextBox width='320' height='150'  MaxLength='2147483647'  TextMode='multiline' ID="input_admin_section_list_tables"  CssClass="formCopy admin_form_multitext" runat="server"   /></div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_edit_table"  >
  <span class="admin_form_title"> Edit Table</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_edit_table' />



<asp:TextBox  width='320'  MaxLength='200'  ID="input_admin_section_edit_table"  CssClass="formCopy admin_form_text" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_admin_file_name"  >
  <span class="admin_form_title"> File Name*</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_file_name' />



<asp:TextBox  width='320'  MaxLength='50'  ID="input_admin_file_name"  CssClass="formCopy admin_form_text" runat="server"   />
  <asp:RequiredFieldValidator SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage='File Name' Text="* Required" id="req_admin_file_name" ControlToValidate="input_admin_file_name" runat="server"  Display="Dynamic"  />
</div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_title_field"  >
  <span class="admin_form_title"> Title Field</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_title_field' />



<asp:TextBox  width='320'  MaxLength='100'  ID="input_admin_section_title_field"  CssClass="formCopy admin_form_text" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_never_add"  >
  <span class="admin_form_title"> Never Add</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_never_add' />



<asp:checkbox runat="Server" ID="input_admin_section_never_add"   CssClass="admin_form_check" />
</div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_never_edit"  >
  <span class="admin_form_title"> Never Edit</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_never_edit' />



<asp:checkbox runat="Server" ID="input_admin_section_never_edit"   CssClass="admin_form_check" />
</div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_never_delete"  >
  <span class="admin_form_title"> Never Delete</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_never_delete' />



<asp:checkbox runat="Server" ID="input_admin_section_never_delete"   CssClass="admin_form_check" />
</div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_order_field"  >
  <span class="admin_form_title"> Order Field</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_order_field' />



<asp:TextBox  width='320'  MaxLength='50'  ID="input_admin_section_order_field"  CssClass="formCopy admin_form_text" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_isdeleted_field"  >
  <span class="admin_form_title"> IsDeleted Field</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_isdeleted_field' />



<asp:TextBox  width='320'  MaxLength='100'  ID="input_admin_section_isdeleted_field"  CssClass="formCopy admin_form_text" runat="server"   />
</div>

       
       <div class="admin_form_row clearfix" id="edit_column_admin_section_group_fk"  >
  <span class="admin_form_title"> Group Fk</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_group_fk' />



<PingCore:DependentDropdown id="input_admin_section_group_fk" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_rewrite_name_field"  >
  <span class="admin_form_title"> RewriteURL Name Field</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_rewrite_name_field' />



<asp:TextBox  width='320'  MaxLength='250'  ID="input_admin_section_rewrite_name_field"  CssClass="formCopy admin_form_text" runat="server"   />
</div>

</div>
</fieldset>
<!-- End New Group -->

<!-- Start New Group //-->
<fieldset><div id='panel_1_group_8' class="g_admin_panel">
      <label>Extra Info</label>
       <div class="admin_form_row clearfix" id="edit_column_admin_section_iscustom"  >
  <span class="admin_form_title"> Custom Section?</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_iscustom' />



<asp:checkbox runat="Server" ID="input_admin_section_iscustom"   CssClass="admin_form_check" />
</div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_custom_list_control"  >
  <span class="admin_form_title"> Custom List Control?</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_custom_list_control' />



<asp:TextBox  width='320'  MaxLength='200'  ID="input_admin_section_custom_list_control"  CssClass="formCopy admin_form_text" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_custom_edit_control"  >
  <span class="admin_form_title"> Custom Edit Control?</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_custom_edit_control' />



<asp:TextBox  width='320'  MaxLength='200'  ID="input_admin_section_custom_edit_control"  CssClass="formCopy admin_form_text" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_list_query"  >
  <span class="admin_form_title"> List Query</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_list_query' />



<asp:TextBox width='320' height='150'  MaxLength='2147483647'  TextMode='multiline' ID="input_admin_section_list_query"  CssClass="formCopy admin_form_multitext" runat="server"   /></div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_after_add_new_func"  >
  <span class="admin_form_title"> After Add New Func</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_after_add_new_func' />



<asp:TextBox width='320' height='150'  MaxLength='400'  TextMode='multiline' ID="input_admin_section_after_add_new_func"  CssClass="formCopy admin_form_multitext" runat="server"   /></div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_after_add_new"  >
  <span class="admin_form_title"> After Add New</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_after_add_new' />



<asp:TextBox width='320' height='150'  MaxLength='400'  TextMode='multiline' ID="input_admin_section_after_add_new"  CssClass="formCopy admin_form_multitext" runat="server"   /></div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_after_update_func"  >
  <span class="admin_form_title"> After Update Func</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_after_update_func' />



<asp:TextBox width='320' height='150'  MaxLength='400'  TextMode='multiline' ID="input_admin_section_after_update_func"  CssClass="formCopy admin_form_multitext" runat="server"   /></div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_after_update"  >
  <span class="admin_form_title"> After Update</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_after_update' />



<asp:TextBox width='320' height='150'  MaxLength='400'  TextMode='multiline' ID="input_admin_section_after_update"  CssClass="formCopy admin_form_multitext" runat="server"   /></div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_max_user_level"  >
  <span class="admin_form_title"> Max User Level</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_max_user_level' />



<asp:TextBox  width='320'  ID="input_admin_section_max_user_level"  CssClass="formCopy admin_form_text" runat="server"   />
     <asp:RegularExpressionValidator SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage='Max User Level'  runat="server" id="reqEx_admin_section_max_user_level"  ControlToValidate="input_admin_section_max_user_level" Text="This entry is invalid" Display="Dynamic" ValidationExpression="^[0-9]{0,4}$" ></asp:RegularExpressionValidator>
</div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_owner_field"  >
  <span class="admin_form_title"> Owner Field</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_owner_field' />



<asp:TextBox  width='320'  MaxLength='50'  ID="input_admin_section_owner_field"  CssClass="formCopy admin_form_text" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_owner_session_var"  >
  <span class="admin_form_title"> Owner Session Var</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_owner_session_var' />



<asp:TextBox  width='320'  MaxLength='50'  ID="input_admin_section_owner_session_var"  CssClass="formCopy admin_form_text" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_fixedWhere"  >
  <span class="admin_form_title"> Fixed Where</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_fixedWhere' />



<asp:TextBox width='320' height='150'  MaxLength='500'  TextMode='multiline' ID="input_admin_section_fixedWhere"  CssClass="formCopy admin_form_multitext" runat="server"   /></div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_orderby"  >
  <span class="admin_form_title"> Orderby</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_orderby' />



<asp:TextBox width='320' height='150'  MaxLength='1000'  TextMode='multiline' ID="input_admin_section_orderby"  CssClass="formCopy admin_form_multitext" runat="server"   /></div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_groupby"  >
  <span class="admin_form_title"> Groupby</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_groupby' />



<asp:TextBox width='320' height='150'  MaxLength='500'  TextMode='multiline' ID="input_admin_section_groupby"  CssClass="formCopy admin_form_multitext" runat="server"   /></div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_add_before_edit"  >
  <span class="admin_form_title"> Add Before Edit</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_add_before_edit' />



<asp:checkbox runat="Server" ID="input_admin_section_add_before_edit"   CssClass="admin_form_check" />
</div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_never_add_user_level"  >
  <span class="admin_form_title"> Never Add User Level</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_never_add_user_level' />



<asp:TextBox  width='320'  ID="input_admin_section_never_add_user_level"  CssClass="formCopy admin_form_text" runat="server"   />
     <asp:RegularExpressionValidator SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage='Never Add User Level'  runat="server" id="reqEx_admin_section_never_add_user_level"  ControlToValidate="input_admin_section_never_add_user_level" Text="This entry is invalid" Display="Dynamic" ValidationExpression="^[0-9]{0,4}$" ></asp:RegularExpressionValidator>
</div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_never_edit_user_level"  >
  <span class="admin_form_title"> Never Edit User Level</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_never_edit_user_level' />



<asp:TextBox  width='320'  ID="input_admin_section_never_edit_user_level"  CssClass="formCopy admin_form_text" runat="server"   />
     <asp:RegularExpressionValidator SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage='Never Edit User Level'  runat="server" id="reqEx_admin_section_never_edit_user_level"  ControlToValidate="input_admin_section_never_edit_user_level" Text="This entry is invalid" Display="Dynamic" ValidationExpression="^[0-9]{0,4}$" ></asp:RegularExpressionValidator>
</div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_never_delete_user_level"  >
  <span class="admin_form_title"> Never Delete User Level</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_never_delete_user_level' />



<asp:TextBox  width='320'  ID="input_admin_section_never_delete_user_level"  CssClass="formCopy admin_form_text" runat="server"   />
     <asp:RegularExpressionValidator SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage='Never Delete User Level'  runat="server" id="reqEx_admin_section_never_delete_user_level"  ControlToValidate="input_admin_section_never_delete_user_level" Text="This entry is invalid" Display="Dynamic" ValidationExpression="^[0-9]{0,4}$" ></asp:RegularExpressionValidator>
</div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_order_groupby"  >
  <span class="admin_form_title"> Order Field Groupby (csv)</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_order_groupby' />



<asp:TextBox  width='320'  MaxLength='100'  ID="input_admin_section_order_groupby"  CssClass="formCopy admin_form_text" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_order_isreversed"  >
  <span class="admin_form_title"> Order Field Reversed?</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_order_isreversed' />



<asp:checkbox runat="Server" ID="input_admin_section_order_isreversed"   CssClass="admin_form_check" />
</div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_menu_id"  >
  <span class="admin_form_title"> Menu Tab</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_menu_id' />



<asp:TextBox  width='320'  ID="input_admin_section_menu_id"  CssClass="formCopy admin_form_text" runat="server"   />
     <asp:RegularExpressionValidator SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage='Menu Tab'  runat="server" id="reqEx_admin_section_menu_id"  ControlToValidate="input_admin_section_menu_id" Text="This entry is invalid" Display="Dynamic" ValidationExpression="^[0-9]{0,4}$" ></asp:RegularExpressionValidator>
</div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_menu_order"  >
  <span class="admin_form_title"> Menu Order</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_menu_order' />



<asp:TextBox  width='320'  ID="input_admin_section_menu_order"  CssClass="formCopy admin_form_text" runat="server"   />
     <asp:RegularExpressionValidator SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage='Menu Order'  runat="server" id="reqEx_admin_section_menu_order"  ControlToValidate="input_admin_section_menu_order" Text="This entry is invalid" Display="Dynamic" ValidationExpression="^[0-9]{0,4}$" ></asp:RegularExpressionValidator>
</div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_conditional_display"  >
  <span class="admin_form_title"> Conditional Display</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_conditional_display' />



<asp:checkbox runat="Server" ID="input_admin_section_conditional_display"   CssClass="admin_form_check" />
</div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_rowclassexpr"  >
  <span class="admin_form_title"> RowClass Expression</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_rowclassexpr' />



<asp:TextBox width='320' height='150'  MaxLength='500'  TextMode='multiline' ID="input_admin_section_rowclassexpr"  CssClass="formCopy admin_form_multitext" runat="server"   /></div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_show_duplicates"  >
  <span class="admin_form_title"> Show Duplicates</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_show_duplicates' />



<asp:checkbox runat="Server" ID="input_admin_section_show_duplicates"   CssClass="admin_form_check" />
</div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_internal_hierarchy_field"  >
  <span class="admin_form_title"> Internal Hierarchy Field</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_internal_hierarchy_field' />



<asp:TextBox  width='320'  MaxLength='50'  ID="input_admin_section_internal_hierarchy_field"  CssClass="formCopy admin_form_text" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_Has_Paragraphs"  >
  <span class="admin_form_title"> Has  Paragraphs</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_Has_Paragraphs' />



<asp:checkbox runat="Server" ID="input_admin_section_Has_Paragraphs"   CssClass="admin_form_check" />
</div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_Has_Paragraphs_Position_After"  >
  <span class="admin_form_title"> Has  Paragraphs  Position  After</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_Has_Paragraphs_Position_After' />



<asp:TextBox  width='320'  MaxLength='50'  ID="input_admin_section_Has_Paragraphs_Position_After"  CssClass="formCopy admin_form_text" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_Has_Paragraphs_DBTable"  >
  <span class="admin_form_title"> Has  Paragraphs  D B Table</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_Has_Paragraphs_DBTable' />



<asp:TextBox  width='320'  MaxLength='50'  ID="input_admin_section_Has_Paragraphs_DBTable"  CssClass="formCopy admin_form_text" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_MenuLevel"  >
  <span class="admin_form_title"> Menu Level</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_MenuLevel' />



<asp:TextBox  width='320'  ID="input_admin_section_MenuLevel"  CssClass="formCopy admin_form_text" runat="server"   />
     <asp:RegularExpressionValidator SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage='Menu Level'  runat="server" id="reqEx_admin_section_MenuLevel"  ControlToValidate="input_admin_section_MenuLevel" Text="This entry is invalid" Display="Dynamic" ValidationExpression="^[0-9]{0,4}$" ></asp:RegularExpressionValidator>
</div>

</div>
</fieldset>
<!-- End New Group -->

</asp:panel>
<!-- End Panel //-->

</div>
<footer>
<div class="admin_btn_wrapper">
   <asp:Button CssClass="btn_abandon" Visible="true" ID="AbandonBtn2" Text="Abandon Changes" runat="server" CausesValidation="False" /> 
   <asp:Button CssClass="alt_btn btn_save" Visible="true" ID="SubmitBtn2" OnClick="SubmitBtn_Click" Text="Save >" runat="server" /> 
  <asp:Button CssClass="alt_btn btn_save" Visible="false" ID="PrevBtn2" OnClick="PrevBtn_Click" Text="< Previous" runat="server" />
  <asp:Button CssClass="alt_btn btn_save"  Visible="false" ID="NextBtn2" OnClick="NextBtn_Click" Text="Next >" runat="server" />
</div>

</footer>
</asp:panel>
<script type='text/javascript'>
</script>

</div>
