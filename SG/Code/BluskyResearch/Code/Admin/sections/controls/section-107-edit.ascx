<%@ Control autoeventwireup="false" Language="VB"  CodeFile="section-107-edit.ascx.vb" Inherits="AdminSection107Edit"  %>
<%@ Register Assembly="Karpach.WebControls" Namespace="Karpach.WebControls" TagPrefix="cc1" %>
<%@ Register Assembly="PingCore" Namespace="PingCore.WebsiteControls" TagPrefix="PM" %>

<%@ Import Namespace="PingCore.MyContent" %>
<%@ Import Namespace="System.Data" %>
<%@ Import Namespace="PingCore.MyData" %>
<%@ Import Namespace="PingCore" %>
<div id="EditControl_107">
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
       <div class="admin_form_row clearfix" id="edit_column_admin_section_group_enabled"  >
  <span class="admin_form_title"> Admin Section Group Enabled</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_group_enabled' />



<asp:checkbox runat="Server" ID="input_admin_section_group_enabled"   CssClass="admin_form_check" />
</div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_group_static"  >
  <span class="admin_form_title"> Admin Section Group Static</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_group_static' />



<asp:checkbox runat="Server" ID="input_admin_section_group_static"   CssClass="admin_form_check" />
</div>

       <div class="admin_form_row clearfix" id="edit_column_admin_section_group_image"  >
  <span class="admin_form_title"> Admin Section Group Image</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_group_image' />



<asp:TextBox  width='320'  MaxLength='200'  ID="input_admin_section_group_image"  CssClass="formCopy admin_form_text" runat="server"   />
</div>

       
       <div class="admin_form_row clearfix" id="edit_column_admin_section_group_name"  >
  <span class="admin_form_title"> Group Name*</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_group_name' />



<asp:TextBox  width='320'  MaxLength='200'  ID="input_admin_section_group_name"  CssClass="formCopy admin_form_text" runat="server"   />
  <asp:RequiredFieldValidator SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage='Group Name' Text="* Required" id="req_admin_section_group_name" ControlToValidate="input_admin_section_group_name" runat="server"  Display="Dynamic"  />
</div>

       
       
       <div class="admin_form_row clearfix" id="edit_column_admin_section_group_description"  >
  <span class="admin_form_title"> 
Group Description</span>
<asp:textbox runat='server' visible='false' id='prechanges_admin_section_group_description' />
<div class="admin_form_textedit">

<PM:Ckeditor id="input_admin_section_group_description"  runat="server" BaseHref="~/Admin/Resources/ckeditor/" Width="720" Height="300"  Toolbar="Basic" /></div></div>

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
