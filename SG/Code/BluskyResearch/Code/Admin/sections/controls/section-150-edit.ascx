<%@ Control autoeventwireup="false" Language="VB"  CodeFile="section-150-edit.ascx.vb" Inherits="AdminSection150Edit"  %>
<%@ Register Assembly="Karpach.WebControls" Namespace="Karpach.WebControls" TagPrefix="cc1" %>
<%@ Register Assembly="PingCore" Namespace="PingCore.WebsiteControls" TagPrefix="PM" %>

<%@ Import Namespace="PingCore.MyContent" %>
<%@ Import Namespace="System.Data" %>
<%@ Import Namespace="PingCore.MyData" %>
<%@ Import Namespace="PingCore" %>
<div id="EditControl_150">
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
       
       <div class="admin_form_row clearfix" id="edit_column_SurveyNumber"  >
  <span class="admin_form_title"> ID</span>
<asp:textbox runat='server' visible='false' id='prechanges_SurveyNumber' />



<asp:label runat='server' CssClass="admin_form_lbl" id='input_SurveyNumber'/>
</div>

       <div class="admin_form_row clearfix" id="edit_column_Name"  >
  <span class="admin_form_title"> Name</span>
<asp:textbox runat='server' visible='false' id='prechanges_Name' />



<asp:label runat='server' CssClass="admin_form_lbl" id='input_Name'/>
</div>

       <div class="admin_form_row clearfix" id="edit_column_Status"  >
  <span class="admin_form_title"> Status</span>
<asp:textbox runat='server' visible='false' id='prechanges_Status' />



<asp:label runat='server' CssClass="admin_form_lbl" id='input_Status'/>
</div>

       
       
       <div class="admin_form_row clearfix" id="edit_column_ViewDetails"  >
  <span class="admin_form_title"> View Details?    <a href='javascript:;' class="admin_form_tip"  onmouseover='return overlib("Un-tick to hide question details, exports and individual responses");' onmouseout='return nd();' >
      <img src='/admin/images/icn_alert_info.png' border='0' align='absmiddle' />
    </a></span>
<asp:textbox runat='server' visible='false' id='prechanges_ViewDetails' />



<asp:checkbox runat="Server" ID="input_ViewDetails"   CssClass="admin_form_check" />
</div>

       <div class="admin_form_row clearfix" id="edit_column_QuestionsToHide"  >
  <span class="admin_form_title"> Questions To Hide    <a href='javascript:;' class="admin_form_tip"  onmouseover='return overlib("Enter question numbers that require the details to be hidden - provide in comma separated list");' onmouseout='return nd();' >
      <img src='/admin/images/icn_alert_info.png' border='0' align='absmiddle' />
    </a></span>
<asp:textbox runat='server' visible='false' id='prechanges_QuestionsToHide' />



<asp:TextBox  width='320'  MaxLength='250'  ID="input_QuestionsToHide"  CssClass="formCopy admin_form_text" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_MinimumResponsesAllowed"  >
  <span class="admin_form_title"> Minimum Responses Allowed    <a href='javascript:;' class="admin_form_tip"  onmouseover='return overlib("Minimum number of responses allowed to show response data. Leave as zero for no minimum check.");' onmouseout='return nd();' >
      <img src='/admin/images/icn_alert_info.png' border='0' align='absmiddle' />
    </a></span>
<asp:textbox runat='server' visible='false' id='prechanges_MinimumResponsesAllowed' />



<asp:TextBox  width='320'  ID="input_MinimumResponsesAllowed"  CssClass="formCopy admin_form_text" runat="server"   />
     <asp:RegularExpressionValidator SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage='Minimum Responses Allowed'  runat="server" id="reqEx_MinimumResponsesAllowed"  ControlToValidate="input_MinimumResponsesAllowed" Text="This entry is invalid" Display="Dynamic" ValidationExpression="^[0-9]{0,4}$" ></asp:RegularExpressionValidator>
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
