<!-- CONTENT -->
<div id="content" class="ninecol last">
    <div class="panel-wrapper">
        <div class="panel">
            <div class="title no-border">
                <div class="headline first" style="width:100px;">
                    <label id='lbl-total-count'></label> 
                </div>
                <div class="headline first" style="float:right">
                    <input class="datetime medium" id="searchkey" value="" placeholder="">
                    <button class="button-blue" onclick="onClickSearch();">Search</button>
                </div>
            </div>
            <div class="content">
                <div id="tbl-data"></div>
            </div>
        </div>
        <div class="panel">
            <div style="float:left;width:100%;" id="navigation-bar">
            </div>
        </div>
    </div>
</div>

<script type='text/javascript'>
    var cpage = "<?php echo $page ?>";
    function doSearch(page)
    {
        var keyvalue = $('#searchkey').val();
        $.post("<?php echo $baseDir; ?>/admin/ccenter/search_center", {
                page : page,
                keyvalue : keyvalue
            }, function(data) {
                var results = data.split("|||");
                $("#tbl-data").html(results[0]);
                $("#navigation-bar").html(results[1]);
                $("#lbl-total-count").html("Total : <span style='color:#FF2C67;'><b>" + results[2] + "</b></span>");
        });
    }
    
    function onClickSearch()
    {
        doSearch(0);
        document.getElementById('searchkey').focus();
    }
    
    function onSelectPage(page)
    {
        cpage = page;
        doSearch(page);
    }

    function onModify(seq)
    {
        window.location.href = '<?php echo $baseDir; ?>/admin/ccenter/centermodify?seq='+seq+'&page=' + cpage;
    }

    function onDelete(seq)
    {
        if (confirm("Are you sure to delete this?")) {
            $.post("<?php echo $baseDir; ?>/admin/ccenter/delete_center", {
                    seq : seq
                }, function(data) {
                    if(data != '') alert(data);
                    doSearch(0);
            });
        }
    }

    function onDetail(seq)
    {
        // window.location.href = '<?php echo $baseDir; ?>/admin/ccenter/details?seq=' + seq + '&page=' + cpage;
    }
    
    $(document).ready(function() {
        doSearch(0);
    }); 
</script>
<script>
    $("#searchkey").keypress(function(event) {
        if ( event.which != 13 ) return;
        onClickSearch();
    });
</script>