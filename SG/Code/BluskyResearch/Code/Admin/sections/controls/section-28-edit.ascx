<%@ Control autoeventwireup="false" Language="VB"  CodeFile="section-28-edit.ascx.vb" Inherits="AdminSection28Edit"  %>
<%@ Register Assembly="Karpach.WebControls" Namespace="Karpach.WebControls" TagPrefix="cc1" %>
<%@ Register Assembly="PingCore" Namespace="PingCore.WebsiteControls" TagPrefix="PM" %>
<%@ Register src="section-12-edit.ascx" TagPrefix="OtherSections" TagName="AddNewSection12" %>
<%@ Register src="section-107-edit.ascx" TagPrefix="OtherSections" TagName="AddNewSection107" %>

<%@ Import Namespace="PingCore.MyContent" %>
<%@ Import Namespace="System.Data" %>
<%@ Import Namespace="PingCore.MyData" %>
<%@ Import Namespace="PingCore" %>
<div id="EditControl_28">
<asp:textbox ID='recordtitle'  visible='true' runat='server'   style='display:none;' />
<asp:textbox ID='currpage' visible='true' runat='server' Text="1" style='display:none;' />
<asp:textbox ID='maxpage'  visible='true' runat='server' Text="0" style='display:none;' />
<OtherSections:AddNewSection12 ID="input_df_section_id_AddEdit"  Visible="false" runat="server" />
<OtherSections:AddNewSection107 ID="input_df_actiongroupid_AddEdit"  Visible="false" runat="server" />

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
       <div class="admin_form_row clearfix" id="edit_column_df_specifichtmlelement"  >
  <span class="admin_form_title"> Df Specifichtmlelement</span>
<asp:textbox runat='server' visible='false' id='prechanges_df_specifichtmlelement' />



<asp:TextBox  width='320'  MaxLength='100'  ID="input_df_specifichtmlelement"  CssClass="formCopy admin_form_text" runat="server"   />
</div>

       
       <div class="admin_form_row clearfix" id="edit_column_df_section_id"  >
  <span class="admin_form_title"> Section</span>
<asp:textbox runat='server' visible='false' id='prechanges_df_section_id' />



<PingCore:DependentDropdown id="input_df_section_id" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_df_desc"  >
  <span class="admin_form_title"> Description</span>
<asp:textbox runat='server' visible='false' id='prechanges_df_desc' />



<asp:TextBox  width='320'  MaxLength='200'  ID="input_df_desc"  CssClass="formCopy admin_form_text" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_df_actionpanelnumber"  >
  <span class="admin_form_title"> Panel</span>
<asp:textbox runat='server' visible='false' id='prechanges_df_actionpanelnumber' />



<PingCore:DependentDropdown id="input_df_actionpanelnumber" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_df_actiongroupid"  >
  <span class="admin_form_title"> Group</span>
<asp:textbox runat='server' visible='false' id='prechanges_df_actiongroupid' />



<PingCore:DependentDropdown id="input_df_actiongroupid" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_df_actionfield"  >
  <span class="admin_form_title"> Action Field</span>
<asp:textbox runat='server' visible='false' id='prechanges_df_actionfield' />



<asp:TextBox  width='320'  MaxLength='50'  ID="input_df_actionfield"  CssClass="formCopy admin_form_text" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_df_conditionfield"  >
  <span class="admin_form_title"> Condition Field</span>
<asp:textbox runat='server' visible='false' id='prechanges_df_conditionfield' />



<asp:TextBox  width='320'  MaxLength='50'  ID="input_df_conditionfield"  CssClass="formCopy admin_form_text" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_df_regex"  >
  <span class="admin_form_title"> Regex</span>
<asp:textbox runat='server' visible='false' id='prechanges_df_regex' />



<asp:TextBox width='320' height='150'  MaxLength='500'  TextMode='multiline' ID="input_df_regex"  CssClass="formCopy admin_form_multitext" runat="server"   /></div>

       <div class="admin_form_row clearfix" id="edit_column_df_matchclass"  >
  <span class="admin_form_title"> Match Class</span>
<asp:textbox runat='server' visible='false' id='prechanges_df_matchclass' />



<asp:TextBox  width='320'  MaxLength='100'  ID="input_df_matchclass"  CssClass="formCopy admin_form_text" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_df_failclass"  >
  <span class="admin_form_title"> Fail Class</span>
<asp:textbox runat='server' visible='false' id='prechanges_df_failclass' />



<asp:TextBox  width='320'  MaxLength='100'  ID="input_df_failclass"  CssClass="formCopy admin_form_text" runat="server"   />
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
