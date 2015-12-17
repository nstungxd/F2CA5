<%@ Control autoeventwireup="false" Language="VB"  CodeFile="section-6-edit.ascx.vb" Inherits="AdminSection6Edit"  %>
<%@ Register Assembly="Karpach.WebControls" Namespace="Karpach.WebControls" TagPrefix="cc1" %>
<%@ Register Assembly="PingCore" Namespace="PingCore.WebsiteControls" TagPrefix="PM" %>

<%@ Import Namespace="PingCore.MyContent" %>
<%@ Import Namespace="System.Data" %>
<%@ Import Namespace="PingCore.MyData" %>
<%@ Import Namespace="PingCore" %>
<div id="EditControl_6">
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
       
       <div class="admin_form_row clearfix" id="edit_column_user_type_fk"  >
  <span class="admin_form_title"> Type</span>
<asp:textbox runat='server' visible='false' id='prechanges_user_type_fk' />



<PingCore:DependentDropdown id="input_user_type_fk" runat="server"   />
</div>

       
       <div class="admin_form_row clearfix" id="edit_column_user_firstname"  >
  <span class="admin_form_title"> Firstname*</span>
<asp:textbox runat='server' visible='false' id='prechanges_user_firstname' />



<asp:TextBox  width='320'  MaxLength='50'  ID="input_user_firstname"  CssClass="formCopy admin_form_text" runat="server"   />
  <asp:RequiredFieldValidator SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage='Firstname' Text="* Required" id="req_user_firstname" ControlToValidate="input_user_firstname" runat="server"  Display="Dynamic"  />
</div>

       <div class="admin_form_row clearfix" id="edit_column_user_surname"  >
  <span class="admin_form_title"> Surname*</span>
<asp:textbox runat='server' visible='false' id='prechanges_user_surname' />



<asp:TextBox  width='320'  MaxLength='50'  ID="input_user_surname"  CssClass="formCopy admin_form_text" runat="server"   />
  <asp:RequiredFieldValidator SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage='Surname' Text="* Required" id="req_user_surname" ControlToValidate="input_user_surname" runat="server"  Display="Dynamic"  />
</div>

       
       <div class="admin_form_row clearfix" id="edit_column_user_email"  >
  <span class="admin_form_title"> Email*</span>
<asp:textbox runat='server' visible='false' id='prechanges_user_email' />



<asp:TextBox  width='320'  MaxLength='100'  ID="input_user_email"  CssClass="formCopy admin_form_text" runat="server"   />
  <asp:RequiredFieldValidator SetFocusOnError="true" ForeColor="#7B040F" ErrorMessage='Email' Text="* Required" id="req_user_email" ControlToValidate="input_user_email" runat="server"  Display="Dynamic"  />
</div>

       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       <div class="admin_form_row clearfix" id="edit_column_user_allsurveys"  >
  <span class="admin_form_title"> Global survey access?    <a href='javascript:;' class="admin_form_tip"  onmouseover='return overlib("User can view all surveys available");' onmouseout='return nd();' >
      <img src='/admin/images/icn_alert_info.png' border='0' align='absmiddle' />
    </a></span>
<asp:textbox runat='server' visible='false' id='prechanges_user_allsurveys' />



<asp:checkbox runat="Server" ID="input_user_allsurveys"   CssClass="admin_form_check" />
</div>

</div>
</fieldset>
<!-- End New Group -->

                <!-- Start New Group //-->
                <fieldset>
                    <div id='panel_2_group_2' class="g_admin_panel">
                        <label>Viewable Surveys</label>
                        <div class="admin_form_row clearfix" id="panel_1_group_tags">
                            <div class="admin_form_many2many">                                
                                <asp:CheckBoxList runat="server" ID="chkSurveyList" RepeatColumns="2" RepeatLayout="Table" CssClass="admin_form_checklist" />
                            </div>
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
