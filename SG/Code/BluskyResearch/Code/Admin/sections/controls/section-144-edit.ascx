<%@ Control autoeventwireup="false" Language="VB"  CodeFile="section-144-edit.ascx.vb" Inherits="AdminSection144Edit"  %>
<%@ Register Assembly="Karpach.WebControls" Namespace="Karpach.WebControls" TagPrefix="cc1" %>
<%@ Register Assembly="PingCore" Namespace="PingCore.WebsiteControls" TagPrefix="PM" %>

<%@ Import Namespace="PingCore.MyContent" %>
<%@ Import Namespace="System.Data" %>
<%@ Import Namespace="PingCore.MyData" %>
<%@ Import Namespace="PingCore" %>
<div id="EditControl_144">
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
       
       <div class="admin_form_row clearfix" id="edit_column_Name"  >
  <span class="admin_form_title"> Name</span>
<asp:textbox runat='server' visible='false' id='prechanges_Name' />



<asp:label runat='server' CssClass="admin_form_lbl" id='input_Name'/>
</div>

       <div class="admin_form_row clearfix" id="edit_column_Subject"  >
  <span class="admin_form_title"> Subject*    <a href='javascript:;' class="admin_form_tip"  onmouseover='return overlib("Subject line for the email");' onmouseout='return nd();' >
      <img src='/admin/images/icn_alert_info.png' border='0' align='absmiddle' />
    </a></span>
<asp:textbox runat='server' visible='false' id='prechanges_Subject' />



<asp:TextBox width='320' height='150'  MaxLength='500'  TextMode='multiline' ID="input_Subject"  CssClass="formCopy admin_form_multitext" runat="server"   />  <asp:RequiredFieldValidator SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage='Subject' Text="* Required" id="req_Subject" ControlToValidate="input_Subject" runat="server"  Display="Dynamic"  />
</div>

       <div class="admin_form_row clearfix" id="edit_column_BodyCopy"  >
  <span class="admin_form_title"> 
Body    <a href='javascript:;' class="admin_form_tip"  onmouseover='return overlib("Body of the email");' onmouseout='return nd();' >
      <img src='/admin/images/icn_alert_info.png' border='0' align='absmiddle' />
    </a></span>
<asp:textbox runat='server' visible='false' id='prechanges_BodyCopy' />
<div class="admin_form_textedit">

<PM:Ckeditor id="input_BodyCopy"  runat="server" BaseHref="~/Admin/Resources/ckeditor/" Width="720" Height="300"  Toolbar="Basic" /></div></div>

       <div class="admin_form_row clearfix" id="edit_column_FooterCopy"  >
  <span class="admin_form_title"> 
Footer    <a href='javascript:;' class="admin_form_tip"  onmouseover='return overlib("Appears at bottom of email");' onmouseout='return nd();' >
      <img src='/admin/images/icn_alert_info.png' border='0' align='absmiddle' />
    </a></span>
<asp:textbox runat='server' visible='false' id='prechanges_FooterCopy' />
<div class="admin_form_textedit">

<PM:Ckeditor id="input_FooterCopy"  runat="server" BaseHref="~/Admin/Resources/ckeditor/" Width="720" Height="300"  Toolbar="Basic" /></div></div>

       <div class="admin_form_row clearfix" id="edit_column_SenderAddress"  >
  <span class="admin_form_title"> Sender Address    <a href='javascript:;' class="admin_form_tip"  onmouseover='return overlib("Email address, email is sent from. If left blank, default addresses will be used.");' onmouseout='return nd();' >
      <img src='/admin/images/icn_alert_info.png' border='0' align='absmiddle' />
    </a></span>
<asp:textbox runat='server' visible='false' id='prechanges_SenderAddress' />



<asp:TextBox width='320' height='150'  MaxLength='500'  TextMode='multiline' ID="input_SenderAddress"  CssClass="formCopy admin_form_multitext" runat="server"   /></div>

       <div class="admin_form_row clearfix" id="edit_column_Recipients"  >
  <span class="admin_form_title"> Recipients    <a href='javascript:;' class="admin_form_tip"  onmouseover='return overlib("Comma seperated list of email recipients. If left blank, default addresses will be used (Only used for admin targeted emails)");' onmouseout='return nd();' >
      <img src='/admin/images/icn_alert_info.png' border='0' align='absmiddle' />
    </a></span>
<asp:textbox runat='server' visible='false' id='prechanges_Recipients' />



<asp:TextBox width='320' height='150'  MaxLength='1000'  TextMode='multiline' ID="input_Recipients"  CssClass="formCopy admin_form_multitext" runat="server"   /></div>

       
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
