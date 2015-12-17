<%@ Control Language="VB" AutoEventWireup="false" CodeFile="ProductImageManager.ascx.vb" Inherits="Admin_controls_ProductImageManager" %>

<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

<style type="text/css">
    #sortable {list-style-type: none; margin: 0; padding: 0;}
    #sortable li {margin: 3px 3px 3px 0; padding: 1px; float: left; width: 200px; height: 200px; font-size: 4em; text-align: center; cursor: crosshair; background-position: center center; background-repeat: no-repeat; border: 1px solid #D3D3D3; color: #555555; font-weight: normal; position: relative; }
    #sortable li a.delete {position: absolute; top: 0px; right: 0px; cursor: pointer;}
    #sortable li a.delete img { border: 2px solid #c00;}
    
    div.help  { background-image: url(/admin/sections/images/help.png); background-repeat: no-repeat; background-position: 5px 3px; border: 2px solid #666; padding: 5px 30px; margin: 5px 0; background-color: #efefef; font-size: 0.8em;}
    div.help p {  padding: 0; margin: 0px;}
</style>

<h2>Product Images</h2>

<h3>Upload Images</h3>

<telerik:radupload id="photoUpload" runat="server" maxfileinputscount="5" targetfolder="~/Media/ProductImages/" allowedfileextensions=".png,.jpg,.jpeg,.gif" overwriteexistingfiles="true" />
<telerik:radprogressmanager id="Radprogressmanager1" runat="server" />
<telerik:radprogressarea id="progressArea1" runat="server" />

<script type="text/javascript">

    $(function () {
        $("#sortable").sortable();
        $("#sortable").disableSelection();
    });

    function SerializeImages() {
        document.getElementById('<%=SortedString.ClientID %>').value = $("#sortable").sortable("toArray")
        return false;
    }

</script>

<div class="help">
    <p>
        Tip: Your images will automatically be added to the end of your gallery when you click "Save".
    </p>
</div>

<h3>Organise Gallery</h3>

<div class="help">
    <p>
        You can rearrange the order of the existing images in your gallery by dragging the thumbnails below:
    </p>
</div>

<asp:Repeater runat="server" ID="rptImages">
    <HeaderTemplate>
        <ul id="sortable">
    </HeaderTemplate>
    <ItemTemplate>
        <li class="ui-state-default" id='sortableitem_<%# Eval("ProductImageID") %>' style='background-image: url(/Media/ProductImages/Small/<%# Eval("ProductImageID") & Eval("Extension") %>);' />
            <a class="delete" href='#' onclick="return confirm('Are you sure you\'d like to remove this image?')">
                <img src="/admin/sections/images/delete-red.png" alt="Delete Image" />
            </a> 
        </li>
    </ItemTemplate>
    <FooterTemplate>
        </ul>
    </FooterTemplate>
</asp:Repeater>

<asp:TextBox runat="server" ID="SortedString" Style="display: none;" />


<telerik:RadUpload runat="server" id="ruFiles" />
