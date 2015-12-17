<%@ Control autoeventwireup="false" Language="VB"  CodeFile="section-14-edit.ascx.vb" Inherits="AdminSection14Edit"  %>
<%@ Register Assembly="Karpach.WebControls" Namespace="Karpach.WebControls" TagPrefix="cc1" %>
<%@ Register Assembly="PingCore" Namespace="PingCore.WebsiteControls" TagPrefix="PM" %>
<%@ Register src="section-12-edit.ascx" TagPrefix="OtherSections" TagName="AddNewSection12" %>

<%@ Import Namespace="PingCore.MyContent" %>
<%@ Import Namespace="System.Data" %>
<%@ Import Namespace="PingCore.MyData" %>
<%@ Import Namespace="PingCore" %>
<div id="EditControl_14">
<asp:textbox ID='recordtitle'  visible='true' runat='server'   style='display:none;' />
<asp:textbox ID='currpage' visible='true' runat='server' Text="1" style='display:none;' />
<asp:textbox ID='maxpage'  visible='true' runat='server' Text="0" style='display:none;' />
<OtherSections:AddNewSection12 ID="input_list_field_section_id_AddEdit"  Visible="false" runat="server" />

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
       
       <div class="admin_form_row clearfix" id="edit_column_list_field_section_id"  >
  <span class="admin_form_title"> Section</span>
<asp:textbox runat='server' visible='false' id='prechanges_list_field_section_id' />



<PingCore:DependentDropdown id="input_list_field_section_id" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_list_field_name"  >
  <span class="admin_form_title"> Field Name</span>
<asp:textbox runat='server' visible='false' id='prechanges_list_field_name' />



<asp:TextBox  width='320'  MaxLength='200'  ID="input_list_field_name"  CssClass="formCopy admin_form_text" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_list_field_display"  >
  <span class="admin_form_title"> Pretty Name</span>
<asp:textbox runat='server' visible='false' id='prechanges_list_field_display' />



<asp:TextBox  width='320'  MaxLength='200'  ID="input_list_field_display"  CssClass="formCopy admin_form_text" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_list_field_order"  >
  <span class="admin_form_title"> Order</span>
<asp:textbox runat='server' visible='false' id='prechanges_list_field_order' />



<asp:TextBox  width='320'  ID="input_list_field_order"  CssClass="formCopy admin_form_text" runat="server"   />
     <asp:RegularExpressionValidator SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage='Order'  runat="server" id="reqEx_list_field_order"  ControlToValidate="input_list_field_order" Text="This entry is invalid" Display="Dynamic" ValidationExpression="^[0-9]{0,4}$" ></asp:RegularExpressionValidator>
</div>

       <div class="admin_form_row clearfix" id="edit_column_list_field_searchable"  >
  <span class="admin_form_title"> Searchable?</span>
<asp:textbox runat='server' visible='false' id='prechanges_list_field_searchable' />



<asp:checkbox runat="Server" ID="input_list_field_searchable"   CssClass="admin_form_check" />
</div>

       <div class="admin_form_row clearfix" id="edit_column_list_field_searchstring"  >
  <span class="admin_form_title"> Search String</span>
<asp:textbox runat='server' visible='false' id='prechanges_list_field_searchstring' />



<asp:TextBox width='320' height='150'  MaxLength='500'  TextMode='multiline' ID="input_list_field_searchstring"  CssClass="formCopy admin_form_multitext" runat="server"   /></div>

       <div class="admin_form_row clearfix" id="edit_column_list_field_function"  >
  <span class="admin_form_title"> List Field Function</span>
<asp:textbox runat='server' visible='false' id='prechanges_list_field_function' />



<asp:TextBox width='320' height='150'  MaxLength='500'  TextMode='multiline' ID="input_list_field_function"  CssClass="formCopy admin_form_multitext" runat="server"   /></div>

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
