<%@ Page Language="VB" AutoEventWireup="false" MasterPageFile="~/admin/admin.master" ClassName="SectionAccessMatrix_Front" Inherits="SectionAccessMatrix_Behind" CodeFile="custom-sectionaccess_matrix.aspx.vb" %>
<%@ Register TagPrefix="my" Namespace=" MyControls" %>

<asp:Content ContentPlaceHolderID="adminContentHolder" ID="admincontent" runat="server">

<table cellpadding='0' cellspacing='0' rules='all' class='startLaterTable' style='border-collapse:collapse;'>
  <tr>
    <td colspan='3' class='subnav2'>
      <strong>
        Section Access
      </strong>
      <strong></strong>
    </td>
  </tr>
</table>
<br />

      <h3>User Type: <asp:Label ID="lblUserType" runat="server" /></h3>

      <div class="p">
        <table border="1">
          <asp:Repeater ID="rptSections" runat="server">
            <ItemTemplate>
              <tr>
                <td>
                  <asp:HiddenField ID="hdnSectionID" runat="server" Value='<%# eval("id") %>' />
                  <asp:CheckBox ID="chkSelected" runat="server" Text='<%# eval("name") %>' />
                </td>
                <td>
                  <asp:CheckBox ID="chkShowOnMenu" runat="server" Text="Menu?" />
                </td>
              </div>
            </ItemTemplate>
          </asp:Repeater>
        </table>
      </div>

<%--      <asp:Repeater ID="rptPics" runat="server">
        <ItemTemplate>
          <table border="1">
            <tr>
              <td><img src="<%# eval("B") %>" alt="" /></td>
              <td>
                <asp:radiobuttonlist ID="rblArtists" runat="server"
                  DataValueField="A"
                  datatextfield="B"
                  datasource='<%# Artists %>' />
              </td>
            </tr>
          </table>
        </ItemTemplate>
      </asp:Repeater>
--%>


<br />
  <table border='1' bordercolor='#c0c0c0' cellpadding='0' cellspacing='0' rules='all' class='startWayLaterTable' style='border-collapse:collapse;border-width:1px'>
    <tr>
      <td wodth='33%'>
        <asp:Button CssClass="adminButton" Visible="true" ID="btnAbandon" Text="Abandon Changes" runat="server" CausesValidation="False" />
      </td>
      <td wodth='33%'>
        <asp:Button CssClass="adminButton" Visible="true" ID="btnSave"  Text="Save" runat="server" />
      </td>
    </tr>
  </table>
  <br />

</asp:Content>
