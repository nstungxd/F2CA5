<%@ Control Language="VB" AutoEventWireup="false" CodeFile="ContentBlocksList.ascx.vb" Inherits="Admin_controls_ContentBlocksList" %>
<%@ Register Src="~/admin/controls/ContentBlockEditor.ascx" TagPrefix="PM" TagName="ContentBlockEditor" %>

<%--    <asp:UpdatePanel ID="pnlContentBlocksList" runat="server">
        <ContentTemplate>--%>
            <div class="save_text_container">
                <span class="save_text" style="display:none;"></span>
            </div>

            <div class="cbe_sortable">
                <ajaxToolkit:ReorderList ID="rlContentBlocks" runat="server" PostBackOnReorder="true" CallbackCssStyle="callbackStyle" DataKeyField="ContentBlockID" SortOrderField="Priority" DragHandleAlignment="Top" CssClass="cbe_sortable_list">
                    <ItemTemplate>
                        <div class="itemArea">
                            <PM:ContentBlockEditor runat="server" ID="pmContentBlockEditor" OnDeletedEvent="ContentBlockEditor_DeletedEvent" EnableViewState="true" />
                        </div>
                    </ItemTemplate>
                    <ReorderTemplate>
                        <asp:Panel ID="pnlReorder" runat="server" CssClass="reorderCue" />
                    </ReorderTemplate>
                    <DragHandleTemplate>
                        <div class="cbe_i_inner cbe_i_title cbe_i_order"><%# GetBlockTitle(Eval("ContentTypeFk")) %></div>
                    </DragHandleTemplate>
                </ajaxToolkit:ReorderList>
            </div>

            <table cellspacing="0" cellpadding="0" border="0" style="border-width:0px;border-collapse:collapse;">
                <tr>
                    <td>
                        <div>
                            <div class="cbe_i_inner cbe_i_title">Add new content block</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width:100%;">
                        <div class="itemArea">
                            <div class="cbe_item cbe_add">
                                <div class="cbe_i_inner cbe_i_text">
                                    <asp:DropDownList runat="server" ID="ddlContentTypes" />
                                    <asp:Button runat="server" ID="btnAddNewContentBlock" Text="Add New" CausesValidation="false" />
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>

            <asp:HiddenField runat="server" ID="hdnParent" />
            <asp:HiddenField runat="server" ID="hdnParentTbl" />
            <asp:Button ID="btnRefresh" runat="server" Text="" Style="background:0 none; height:0; font-size:0; line-height:0; color:inherit; border-style:none;" />

<%--        </ContentTemplate>
    </asp:UpdatePanel>--%>

    <%--<script type="text/javascript">

        function pageLoad(sender, args) {
            if (args.get_isPartialLoad()) {
                loadPage();
            }
        }

        $(document).ready(function () {
            loadPage();
        });

        function loadPage() {

            $(".cbe_sortable").sortable({
                items: ".cbe_dragdrop",
                containment: ".cbe_sortable",
                scroll: false,
                revert: true,
                placeholder: "drop_state",
                activate: function (event, ui) {
                    
                },
                update: function (event, ui) {
                    //create an array with the new order
                    var order = jQuery(".cbe_sortable").sortable('toArray');
                },
                beforeStop: function (event, ui) {

                    var Par = $('#ctl00_adminContentHolder_EditControl_pmContentBlocksList_hdnParent').val();
                    var ParTbl = $('#ctl00_adminContentHolder_EditControl_pmContentBlocksList_hdnParentTbl').val();

                    var orderList = '';
                    jQuery('.cbe_sortable .cbe_dragdrop').each(function (index) {
                        orderList += jQuery(this).attr('rel') + ',';
                    });
                    orderList = orderList.substring(0, orderList.length - 1);

                    jQuery('.save_text').html('Saving...').fadeIn(500).delay(1000).fadeOut(500);

                    jQuery.ajax({ type: "POST",
                        url: "SimbaServices.asmx/ReorderContentBlocks",
                        data: "{OrderStr: '" + orderList + "',Par: '" + Par + "',ParTbl: '" + ParTbl + "'}",
                        contentType: "application/json; charset=utf-8",
                        dataType: "json",
                        success: function (response) {
                            jQuery('.save_text').html(response.d);
                        },
                        error: function (msg) {
                            jQuery('.save_text').html("Error: There was a problem updating your selection." + msg);
                        }
                    });
                },
                stop: function (event, ui) {
                    setTimeout(function () { RefreshParent(); }, 1000);
                }
            }).disableSelection();

        }

        function RefreshParent() {
//            var btn = document.getElementById('ctl00_adminContentHolder_EditControl_pmContentBlocksList_btnRefresh');
//            if (btn) { btn.click(); }
        }

    </script>--%>

