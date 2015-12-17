<%@ Control Language="VB" AutoEventWireup="false" CodeFile="ContentBlockEditor.ascx.vb" Inherits="Admin_controls_ContentBlockEditor" %>
<%@ Register Assembly="Karpach.WebControls" Namespace="Karpach.WebControls" TagPrefix="cc1" %>
<%@ Register Assembly="PingCore" Namespace="PingCore.WebsiteControls" TagPrefix="PM" %>

<li runat="server" id="cbe_item" class="cbe_item cbe_dragdrop">

    <asp:MultiView runat="server" ID="mvContentBlockItem" ActiveViewIndex="0">
        <asp:View runat="server" ID="cbe_text">
            <div class="cbe_i_inner cbe_i_text">
                <div class="cbe_i_content">
                    <PM:Ckeditor ID="ckText" runat="server" BaseHref="~/Admin/Resources/ckeditor/" Width="700" Height="200" Toolbar="Basic" EnableViewState="true" />
                </div>
            </div>
        </asp:View>
        <asp:View runat="server" ID="cbe_image">
            <div class="cbe_i_inner cbe_i_image">
                <div class="cbe_i_content">
                    <asp:Panel runat="server" ID="pnlImageUpload" >
                        <asp:FileUpload runat="server" ID="fuUploadBox" />
                    </asp:Panel>
                    <asp:Panel Visible="false" runat="server" ID="pnlExistingImage" >
                        <asp:Image runat="server" ID="imgExistingImage" />
                        <asp:LinkButton runat="server" ID="btnDeleteImage" Text="Delete/Amend Image" />
                    </asp:Panel>
                </div>
            </div>
            <div class="cbe_i_inner cbe_i_image">
                <div class="cbe_i_content">
                    <asp:TextBox Width="320" MaxLength="250" ID="txtAltText" CssClass="formCopy admin_form_text" runat="server" />
                    <ajaxToolkit:TextBoxWatermarkExtender runat="server" ID="tweAltText" TargetControlID="txtAltText" WatermarkText="Alternative Text" />
                </div>
            </div>
        </asp:View>
        <asp:View runat="server" ID="cbe_embedcode">
            <div class="cbe_i_inner cbe_i_embedcode">
                <div class="cbe_i_content">
                    <asp:TextBox width="690" height="150" MaxLength="2000" TextMode="MultiLine" ID="txtEmbedCode" CssClass="formCopy admin_form_multitext" runat="server"   />
                </div>
            </div>
        </asp:View>

        <asp:View runat="server" ID="cbe_error">
            <div class="cbe_i_inner cbe_i_error">
                <div class="cbe_i_content">
                    <asp:Label runat="server" ID="lblError" Text="Problem loading content block" />
                </div>
            </div>
        </asp:View>
    </asp:MultiView>

    <div class="cbe_i_inner cbe_i_btn">
        <asp:Button runat="server" ID="btnDelete" Text="Delete" CommandArgument="999" ValidationGroup="ContentBlockEditor" OnClientClick="javascript:return confirm('Are you sure you want to delete this content block?')" />
    </div>

</li>
