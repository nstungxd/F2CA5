<%@ Control autoeventwireup="false" Language="VB"  CodeFile="section-86-edit.ascx.vb" Inherits="AdminSection86Edit"  %>
<%@ Register Assembly="Karpach.WebControls" Namespace="Karpach.WebControls" TagPrefix="cc1" %>
<%@ Register Assembly="PingCore" Namespace="PingCore.WebsiteControls" TagPrefix="PM" %>
<%@ Register src="section-12-edit.ascx" TagPrefix="OtherSections" TagName="AddNewSection12" %>
<%@ Register src="section-107-edit.ascx" TagPrefix="OtherSections" TagName="AddNewSection107" %>

<%@ Import Namespace="PingCore.MyContent" %>
<%@ Import Namespace="System.Data" %>
<%@ Import Namespace="PingCore.MyData" %>
<%@ Import Namespace="PingCore" %>
<div id="EditControl_86">
<asp:textbox ID='recordtitle'  visible='true' runat='server'   style='display:none;' />
<asp:textbox ID='currpage' visible='true' runat='server' Text="1" style='display:none;' />
<asp:textbox ID='maxpage'  visible='true' runat='server' Text="0" style='display:none;' />
<OtherSections:AddNewSection12 ID="input_m2m_section_id_AddEdit"  Visible="false" runat="server" />
<OtherSections:AddNewSection12 ID="input_m2m_linkedsection_AddEdit"  Visible="false" runat="server" />
<OtherSections:AddNewSection107 ID="input_m2m_groupid_AddEdit"  Visible="false" runat="server" />

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
       <div class="admin_form_row clearfix" id="edit_column_m2m_linkedtable_orderby"  >
  <span class="admin_form_title"> M2m Linkedtable Orderby</span>
<asp:textbox runat='server' visible='false' id='prechanges_m2m_linkedtable_orderby' />



<asp:TextBox  width='320'  MaxLength='200'  ID="input_m2m_linkedtable_orderby"  CssClass="formCopy admin_form_text" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_m2m_linkedtable_rewritefield"  >
  <span class="admin_form_title"> M2m Linkedtable Rewritefield</span>
<asp:textbox runat='server' visible='false' id='prechanges_m2m_linkedtable_rewritefield' />



<asp:TextBox  width='320'  MaxLength='200'  ID="input_m2m_linkedtable_rewritefield"  CssClass="formCopy admin_form_text" runat="server"   />
</div>

       
       <div class="admin_form_row clearfix" id="edit_column_m2m_name"  >
  <span class="admin_form_title"> Name*</span>
<asp:textbox runat='server' visible='false' id='prechanges_m2m_name' />



<asp:TextBox  width='320'  MaxLength='200'  ID="input_m2m_name"  CssClass="formCopy admin_form_text" runat="server"   />
  <asp:RequiredFieldValidator SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage='Name' Text="* Required" id="req_m2m_name" ControlToValidate="input_m2m_name" runat="server"  Display="Dynamic"  />
</div>

       <div class="admin_form_row clearfix" id="edit_column_m2m_section_id"  >
  <span class="admin_form_title"> Section*</span>
<asp:textbox runat='server' visible='false' id='prechanges_m2m_section_id' />



<PingCore:DependentDropdown id="input_m2m_section_id" runat="server"   />
  <asp:CustomValidator id="req_m2m_section_id" runat="server" SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage='Section' Text="* Required" Display="Dynamic" OnServerValidate="input_m2m_section_id_ValidateReq" /></div>

       <div class="admin_form_row clearfix" id="edit_column_m2m_linkedsection"  >
  <span class="admin_form_title"> Linked Section*</span>
<asp:textbox runat='server' visible='false' id='prechanges_m2m_linkedsection' />



<PingCore:DependentDropdown id="input_m2m_linkedsection" runat="server"   />
  <asp:CustomValidator id="req_m2m_linkedsection" runat="server" SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage='Linked Section' Text="* Required" Display="Dynamic" OnServerValidate="input_m2m_linkedsection_ValidateReq" /></div>

       <div class="admin_form_row clearfix" id="edit_column_m2m_linkingtable"  >
  <span class="admin_form_title"> Linking Table Name*</span>
<asp:textbox runat='server' visible='false' id='prechanges_m2m_linkingtable' />



<asp:TextBox  width='320'  MaxLength='200'  ID="input_m2m_linkingtable"  CssClass="formCopy admin_form_text" runat="server"   />
  <asp:RequiredFieldValidator SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage='Linking Table Name' Text="* Required" id="req_m2m_linkingtable" ControlToValidate="input_m2m_linkingtable" runat="server"  Display="Dynamic"  />
</div>

       <div class="admin_form_row clearfix" id="edit_column_m2m_linktable_localfk"  >
  <span class="admin_form_title"> Link Table Local FK Field*    <a href='javascript:;' class="admin_form_tip"  onmouseover='return overlib("The field in the linking table the holds the ID of the PK in the this table");' onmouseout='return nd();' >
      <img src='/admin/images/icn_alert_info.png' border='0' align='absmiddle' />
    </a></span>
<asp:textbox runat='server' visible='false' id='prechanges_m2m_linktable_localfk' />



<asp:TextBox  width='320'  MaxLength='200'  ID="input_m2m_linktable_localfk"  CssClass="formCopy admin_form_text" runat="server"   />
  <asp:RequiredFieldValidator SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage='Link Table Local FK Field' Text="* Required" id="req_m2m_linktable_localfk" ControlToValidate="input_m2m_linktable_localfk" runat="server"  Display="Dynamic"  />
</div>

       <div class="admin_form_row clearfix" id="edit_column_m2m_linkingtable_linkedfk"  >
  <span class="admin_form_title"> Linking Table Linked FK Field*    <a href='javascript:;' class="admin_form_tip"  onmouseover='return overlib("The field in the linking table the holds the ID of the PK in the linked table");' onmouseout='return nd();' >
      <img src='/admin/images/icn_alert_info.png' border='0' align='absmiddle' />
    </a></span>
<asp:textbox runat='server' visible='false' id='prechanges_m2m_linkingtable_linkedfk' />



<asp:TextBox  width='320'  MaxLength='200'  ID="input_m2m_linkingtable_linkedfk"  CssClass="formCopy admin_form_text" runat="server"   />
  <asp:RequiredFieldValidator SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage='Linking Table Linked FK Field' Text="* Required" id="req_m2m_linkingtable_linkedfk" ControlToValidate="input_m2m_linkingtable_linkedfk" runat="server"  Display="Dynamic"  />
</div>

       <div class="admin_form_row clearfix" id="edit_column_m2m_panelnumber"  >
  <span class="admin_form_title"> Panel*    <a href='javascript:;' class="admin_form_tip"  onmouseover='return overlib("Which Panel would you like this field to appear in?");' onmouseout='return nd();' >
      <img src='/admin/images/icn_alert_info.png' border='0' align='absmiddle' />
    </a></span>
<asp:textbox runat='server' visible='false' id='prechanges_m2m_panelnumber' />



<PingCore:DependentDropdown id="input_m2m_panelnumber" runat="server"   />
  <asp:CustomValidator id="req_m2m_panelnumber" runat="server" SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage='Panel' Text="* Required" Display="Dynamic" OnServerValidate="input_m2m_panelnumber_ValidateReq" /></div>

       <div class="admin_form_row clearfix" id="edit_column_m2m_groupid"  >
  <span class="admin_form_title"> Group*    <a href='javascript:;' class="admin_form_tip"  onmouseover='return overlib("Which Group would you like this field to appear in?");' onmouseout='return nd();' >
      <img src='/admin/images/icn_alert_info.png' border='0' align='absmiddle' />
    </a></span>
<asp:textbox runat='server' visible='false' id='prechanges_m2m_groupid' />



<PingCore:DependentDropdown id="input_m2m_groupid" runat="server"   />
  <asp:CustomValidator id="req_m2m_groupid" runat="server" SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage='Group' Text="* Required" Display="Dynamic" OnServerValidate="input_m2m_groupid_ValidateReq" /></div>

       <div class="admin_form_row clearfix" id="edit_column_m2m_sql_override"  >
  <span class="admin_form_title"> Sql Override</span>
<asp:textbox runat='server' visible='false' id='prechanges_m2m_sql_override' />



<asp:TextBox width='320' height='150'  MaxLength='500'  TextMode='multiline' ID="input_m2m_sql_override"  CssClass="formCopy admin_form_multitext" runat="server"   /></div>

       <div class="admin_form_row clearfix" id="edit_column_m2m_add_new_name_Only"  >
  <span class="admin_form_title"> Add New Name  Only</span>
<asp:textbox runat='server' visible='false' id='prechanges_m2m_add_new_name_Only' />



<asp:checkbox runat="Server" ID="input_m2m_add_new_name_Only"   CssClass="admin_form_check" />
</div>

       <div class="admin_form_row clearfix" id="edit_column_m2m_linkedtable_isdeletedfield"  >
  <span class="admin_form_title"> Linkedtable Isdeletedfield</span>
<asp:textbox runat='server' visible='false' id='prechanges_m2m_linkedtable_isdeletedfield' />



<asp:TextBox  width='320'  MaxLength='200'  ID="input_m2m_linkedtable_isdeletedfield"  CssClass="formCopy admin_form_text" runat="server"   />
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
