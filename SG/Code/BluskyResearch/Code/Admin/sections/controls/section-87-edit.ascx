<%@ Control autoeventwireup="false" Language="VB"  CodeFile="section-87-edit.ascx.vb" Inherits="AdminSection87Edit"  %>
<%@ Register Assembly="Karpach.WebControls" Namespace="Karpach.WebControls" TagPrefix="cc1" %>
<%@ Register Assembly="PingCore" Namespace="PingCore.WebsiteControls" TagPrefix="PM" %>
<%@ Register src="section-12-edit.ascx" TagPrefix="OtherSections" TagName="AddNewSection12" %>
<%@ Register src="section-107-edit.ascx" TagPrefix="OtherSections" TagName="AddNewSection107" %>

<%@ Import Namespace="PingCore.MyContent" %>
<%@ Import Namespace="System.Data" %>
<%@ Import Namespace="PingCore.MyData" %>
<%@ Import Namespace="PingCore" %>
<div id="EditControl_87">
<asp:textbox ID='recordtitle'  visible='true' runat='server'   style='display:none;' />
<asp:textbox ID='currpage' visible='true' runat='server' Text="1" style='display:none;' />
<asp:textbox ID='maxpage'  visible='true' runat='server' Text="0" style='display:none;' />
<OtherSections:AddNewSection12 ID="input_sc_section_id_AddEdit"  Visible="false" runat="server" />
<OtherSections:AddNewSection107 ID="input_sc_groupid_AddEdit"  Visible="false" runat="server" />

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
       
       <div class="admin_form_row clearfix" id="edit_column_sc_section_id"  >
  <span class="admin_form_title"> Section*</span>
<asp:textbox runat='server' visible='false' id='prechanges_sc_section_id' />



<PingCore:DependentDropdown id="input_sc_section_id" runat="server"   />
  <asp:CustomValidator id="req_sc_section_id" runat="server" SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage='Section' Text="* Required" Display="Dynamic" OnServerValidate="input_sc_section_id_ValidateReq" /></div>

       <div class="admin_form_row clearfix" id="edit_column_sc_name"  >
  <span class="admin_form_title"> Name*</span>
<asp:textbox runat='server' visible='false' id='prechanges_sc_name' />



<asp:TextBox  width='320'  MaxLength='100'  ID="input_sc_name"  CssClass="formCopy admin_form_text" runat="server"   />
  <asp:RequiredFieldValidator SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage='Name' Text="* Required" id="req_sc_name" ControlToValidate="input_sc_name" runat="server"  Display="Dynamic"  />
</div>

       <div class="admin_form_row clearfix" id="edit_column_sc_relpath"  >
  <span class="admin_form_title"> Relative Path*</span>
<asp:textbox runat='server' visible='false' id='prechanges_sc_relpath' />



<asp:TextBox  width='320'  MaxLength='250'  ID="input_sc_relpath"  CssClass="formCopy admin_form_text" runat="server"   />
  <asp:RequiredFieldValidator SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage='Relative Path' Text="* Required" id="req_sc_relpath" ControlToValidate="input_sc_relpath" runat="server"  Display="Dynamic"  />
</div>

       <div class="admin_form_row clearfix" id="edit_column_sc_groupid"  >
  <span class="admin_form_title"> Group</span>
<asp:textbox runat='server' visible='false' id='prechanges_sc_groupid' />



<PingCore:DependentDropdown id="input_sc_groupid" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_sc_panelnumber"  >
  <span class="admin_form_title"> Panel Number</span>
<asp:textbox runat='server' visible='false' id='prechanges_sc_panelnumber' />



<PingCore:DependentDropdown id="input_sc_panelnumber" runat="server"   />
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
