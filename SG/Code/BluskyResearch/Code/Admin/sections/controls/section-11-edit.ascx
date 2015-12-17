<%@ Control autoeventwireup="false" Language="VB"  CodeFile="section-11-edit.ascx.vb" Inherits="AdminSection11Edit"  %>
<%@ Register Assembly="Karpach.WebControls" Namespace="Karpach.WebControls" TagPrefix="cc1" %>
<%@ Register Assembly="PingCore" Namespace="PingCore.WebsiteControls" TagPrefix="PM" %>
<%@ Register src="section-12-edit.ascx" TagPrefix="OtherSections" TagName="AddNewSection12" %>

<%@ Import Namespace="PingCore.MyContent" %>
<%@ Import Namespace="System.Data" %>
<%@ Import Namespace="PingCore.MyData" %>
<%@ Import Namespace="PingCore" %>
<div id="EditControl_11">
<asp:textbox ID='recordtitle'  visible='true' runat='server'   style='display:none;' />
<asp:textbox ID='currpage' visible='true' runat='server' Text="1" style='display:none;' />
<asp:textbox ID='maxpage'  visible='true' runat='server' Text="0" style='display:none;' />
<OtherSections:AddNewSection12 ID="input_parent_section_id_AddEdit"  Visible="false" runat="server" />
<OtherSections:AddNewSection12 ID="input_child_section_id_AddEdit"  Visible="false" runat="server" />

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
       
       <div class="admin_form_row clearfix" id="edit_column_admin_section_relationship_type"  >
  <span class="admin_form_title"> Type*</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_relationship_type' />



<PingCore:DependentDropdown id="input_admin_section_relationship_type" runat="server"   />
  <asp:CustomValidator id="req_admin_section_relationship_type" runat="server" SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage='Type' Text="* Required" Display="Dynamic" OnServerValidate="input_admin_section_relationship_type_ValidateReq" /></div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_relationship_name"  >
  <span class="admin_form_title"> Name</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_relationship_name' />



<asp:TextBox  width='320'  MaxLength='50'  ID="input_admin_section_relationship_name"  CssClass="formCopy admin_form_text" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_parent_section_id"  >
  <span class="admin_form_title"> Parent Section Id</span>
<asp:textbox runat='server' visible='false' id='prechanges_parent_section_id' />



<PingCore:DependentDropdown id="input_parent_section_id" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_parent_relation_field"  >
  <span class="admin_form_title"> Parent Relation Field</span>
<asp:textbox runat='server' visible='false' id='prechanges_parent_relation_field' />



<asp:TextBox  width='320'  MaxLength='50'  ID="input_parent_relation_field"  CssClass="formCopy admin_form_text" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_parent_display_field"  >
  <span class="admin_form_title"> Parent Link Title</span>
<asp:textbox runat='server' visible='false' id='prechanges_parent_display_field' />



<asp:TextBox  width='320'  MaxLength='50'  ID="input_parent_display_field"  CssClass="formCopy admin_form_text" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_child_section_id"  >
  <span class="admin_form_title"> Child Section Id</span>
<asp:textbox runat='server' visible='false' id='prechanges_child_section_id' />



<PingCore:DependentDropdown id="input_child_section_id" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_child_relation_field"  >
  <span class="admin_form_title"> Child Relation Field</span>
<asp:textbox runat='server' visible='false' id='prechanges_child_relation_field' />



<asp:TextBox  width='320'  MaxLength='50'  ID="input_child_relation_field"  CssClass="formCopy admin_form_text" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_type2_parent_relation_value"  >
  <span class="admin_form_title"> Type2 Parent Relation Value</span>
<asp:textbox runat='server' visible='false' id='prechanges_type2_parent_relation_value' />



<asp:TextBox  width='320'  MaxLength='50'  ID="input_type2_parent_relation_value"  CssClass="formCopy admin_form_text" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_realtion_one_to_one"  >
  <span class="admin_form_title"> Realtion One To One</span>
<asp:textbox runat='server' visible='false' id='prechanges_realtion_one_to_one' />



<asp:checkbox runat="Server" ID="input_realtion_one_to_one"   CssClass="admin_form_check" />
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
