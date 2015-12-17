<%@ Control autoeventwireup="false" Language="VB"  CodeFile="section-7-edit.ascx.vb" Inherits="AdminSection7Edit"  %>
<%@ Register Assembly="Karpach.WebControls" Namespace="Karpach.WebControls" TagPrefix="cc1" %>
<%@ Register Assembly="PingCore" Namespace="PingCore.WebsiteControls" TagPrefix="PM" %>
<%@ Register src="section-12-edit.ascx" TagPrefix="OtherSections" TagName="AddNewSection12" %>

<%@ Import Namespace="PingCore.MyContent" %>
<%@ Import Namespace="System.Data" %>
<%@ Import Namespace="PingCore.MyData" %>
<%@ Import Namespace="PingCore" %>
<div id="EditControl_7">
<asp:textbox ID='recordtitle'  visible='true' runat='server'   style='display:none;' />
<asp:textbox ID='currpage' visible='true' runat='server' Text="1" style='display:none;' />
<asp:textbox ID='maxpage'  visible='true' runat='server' Text="0" style='display:none;' />
<OtherSections:AddNewSection12 ID="input_DropDownLinkedSectionID_AddEdit"  Visible="false" runat="server" />

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
       
       <div class="admin_form_row clearfix" id="edit_column_DropDownName"  >
  <span class="admin_form_title"> Name*</span>
<asp:textbox runat='server' visible='false' id='prechanges_DropDownName' />



<asp:TextBox width='320' height='150'  MaxLength='500'  TextMode='multiline' ID="input_DropDownName"  CssClass="formCopy admin_form_multitext" runat="server"   />  <asp:RequiredFieldValidator SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage='Name' Text="* Required" id="req_DropDownName" ControlToValidate="input_DropDownName" runat="server"  Display="Dynamic"  />
</div>

       <div class="admin_form_row clearfix" id="edit_column_DownDownType"  >
  <span class="admin_form_title"> Type*</span>
<asp:textbox runat='server' visible='false' id='prechanges_DownDownType' />



<PingCore:DependentDropdown id="input_DownDownType" runat="server"   />
  <asp:CustomValidator id="req_DownDownType" runat="server" SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage='Type' Text="* Required" Display="Dynamic" OnServerValidate="input_DownDownType_ValidateReq" /></div>

       <div class="admin_form_row clearfix" id="edit_column_DropDownListCSV"  >
  <span class="admin_form_title"> CSV</span>
<asp:textbox runat='server' visible='false' id='prechanges_DropDownListCSV' />



<asp:TextBox width='320' height='150'  MaxLength='500'  TextMode='multiline' ID="input_DropDownListCSV"  CssClass="formCopy admin_form_multitext" runat="server"   /></div>

       <div class="admin_form_row clearfix" id="edit_column_DropDownTableName"  >
  <span class="admin_form_title"> From Clause</span>
<asp:textbox runat='server' visible='false' id='prechanges_DropDownTableName' />



<asp:TextBox width='320' height='150'  MaxLength='500'  TextMode='multiline' ID="input_DropDownTableName"  CssClass="formCopy admin_form_multitext" runat="server"   /></div>

       <div class="admin_form_row clearfix" id="edit_column_DropDownValueField"  >
  <span class="admin_form_title"> Value Field</span>
<asp:textbox runat='server' visible='false' id='prechanges_DropDownValueField' />



<asp:TextBox width='320' height='150'  MaxLength='500'  TextMode='multiline' ID="input_DropDownValueField"  CssClass="formCopy admin_form_multitext" runat="server"   /></div>

       <div class="admin_form_row clearfix" id="edit_column_DropDownTextField"  >
  <span class="admin_form_title"> Text Field</span>
<asp:textbox runat='server' visible='false' id='prechanges_DropDownTextField' />



<asp:TextBox width='320' height='150'  MaxLength='500'  TextMode='multiline' ID="input_DropDownTextField"  CssClass="formCopy admin_form_multitext" runat="server"   /></div>

       <div class="admin_form_row clearfix" id="edit_column_DropDownOrderBy"  >
  <span class="admin_form_title"> Order By</span>
<asp:textbox runat='server' visible='false' id='prechanges_DropDownOrderBy' />



<asp:TextBox  width='320'  MaxLength='200'  ID="input_DropDownOrderBy"  CssClass="formCopy admin_form_text" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_DropDownLinkedSectionID"  >
  <span class="admin_form_title"> Add New Section</span>
<asp:textbox runat='server' visible='false' id='prechanges_DropDownLinkedSectionID' />



<PingCore:DependentDropdown id="input_DropDownLinkedSectionID" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_DropDownParent"  >
  <span class="admin_form_title"> Parent DD</span>
<asp:textbox runat='server' visible='false' id='prechanges_DropDownParent' />



<PingCore:DependentDropdown id="input_DropDownParent" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_DropDownParentKeyField"  >
  <span class="admin_form_title"> Parent Foreign Key</span>
<asp:textbox runat='server' visible='false' id='prechanges_DropDownParentKeyField' />



<asp:TextBox  width='320'  MaxLength='50'  ID="input_DropDownParentKeyField"  CssClass="formCopy admin_form_text" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_DropDownTargetToDisable"  >
  <span class="admin_form_title"> Target To Disable</span>
<asp:textbox runat='server' visible='false' id='prechanges_DropDownTargetToDisable' />



<PingCore:DependentDropdown id="input_DropDownTargetToDisable" runat="server"   />
</div>

       <div class="admin_form_row clearfix" id="edit_column_DropDownSearchQuery"  >
  <span class="admin_form_title"> Drop Down Search Query</span>
<asp:textbox runat='server' visible='false' id='prechanges_DropDownSearchQuery' />



<asp:TextBox width='320' height='150'  MaxLength='500'  TextMode='multiline' ID="input_DropDownSearchQuery"  CssClass="formCopy admin_form_multitext" runat="server"   /></div>

       <div class="admin_form_row clearfix" id="edit_column_DropDownSearchField"  >
  <span class="admin_form_title"> Search FielDrop Down Search Fieldd</span>
<asp:textbox runat='server' visible='false' id='prechanges_DropDownSearchField' />



<asp:TextBox  width='320'  MaxLength='100'  ID="input_DropDownSearchField"  CssClass="formCopy admin_form_text" runat="server"   />
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
