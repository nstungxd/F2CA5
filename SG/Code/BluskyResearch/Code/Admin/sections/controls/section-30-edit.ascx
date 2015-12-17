<%@ Control autoeventwireup="false" Language="VB"  CodeFile="section-30-edit.ascx.vb" Inherits="AdminSection30Edit"  %>
<%@ Register Assembly="Karpach.WebControls" Namespace="Karpach.WebControls" TagPrefix="cc1" %>
<%@ Register Assembly="PingCore" Namespace="PingCore.WebsiteControls" TagPrefix="PM" %>
<%@ Register src="section-12-edit.ascx" TagPrefix="OtherSections" TagName="AddNewSection12" %>

<%@ Import Namespace="PingCore.MyContent" %>
<%@ Import Namespace="System.Data" %>
<%@ Import Namespace="PingCore.MyData" %>
<%@ Import Namespace="PingCore" %>
<div id="EditControl_30">
<asp:textbox ID='recordtitle'  visible='true' runat='server'   style='display:none;' />
<asp:textbox ID='currpage' visible='true' runat='server' Text="1" style='display:none;' />
<asp:textbox ID='maxpage'  visible='true' runat='server' Text="0" style='display:none;' />
<OtherSections:AddNewSection12 ID="input_filter_admin_section_AddEdit"  Visible="false" runat="server" />

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
       
       <div class="admin_form_row clearfix" id="edit_column_filter_admin_section"  >
  <span class="admin_form_title"> Section*</span>
<asp:textbox runat='server' visible='false' id='prechanges_filter_admin_section' />



<PingCore:DependentDropdown id="input_filter_admin_section" runat="server"   />
  <asp:CustomValidator id="req_filter_admin_section" runat="server" SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage='Section' Text="* Required" Display="Dynamic" OnServerValidate="input_filter_admin_section_ValidateReq" /></div>

       <div class="admin_form_row clearfix" id="edit_column_filter_to_use"  >
  <span class="admin_form_title"> Type*</span>
<asp:textbox runat='server' visible='false' id='prechanges_filter_to_use' />



<PingCore:DependentDropdown id="input_filter_to_use" runat="server"   />
  <asp:CustomValidator id="req_filter_to_use" runat="server" SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage='Type' Text="* Required" Display="Dynamic" OnServerValidate="input_filter_to_use_ValidateReq" /></div>

       <div class="admin_form_row clearfix" id="edit_column_filter_field"  >
  <span class="admin_form_title"> Field*</span>
<asp:textbox runat='server' visible='false' id='prechanges_filter_field' />



<asp:TextBox  width='320'  MaxLength='50'  ID="input_filter_field"  CssClass="formCopy admin_form_text" runat="server"   />
  <asp:RequiredFieldValidator SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage='Field' Text="* Required" id="req_filter_field" ControlToValidate="input_filter_field" runat="server"  Display="Dynamic"  />
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
