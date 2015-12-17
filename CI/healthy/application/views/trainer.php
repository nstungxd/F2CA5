<!-- CONTENT -->
<div id="content" class="ninecol last">
    <div class="panel-wrapper">
        <div class="panel">
            <div class="title no-border">
                <div class="headline first" style="width:100px;">
                    <label id='lbl-total-count'></label> 
                </div>
                <div class="headline first">
                    <label>Center: </label> 
                    <select id="centercode" name="centercode" class="" required="required">
                        <option value="" selected>Please select</option>
                    <?php foreach ($centers as $center): ?>
                        <option value="<?php echo $center->CenterCode ?>"><?php echo $center->CenterNm ?></option>
                    <?php endforeach; ?>
                    </select>
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
        var centercode = $('#centercode').val();

        $.post("<?php echo $baseDir; ?>/admin/ctrainer/search_trainer", {
                page : page,
                keyvalue : keyvalue,
                centercode : centercode
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
        window.location.href = '<?php echo $baseDir; ?>/admin/ctrainer/trainermodify?seq='+seq+'&page=' + cpage;
    }

    function onDelete(seq)
    {
        if (confirm("Are you sure to delete this?")) {
            $.post("<?php echo $baseDir; ?>/admin/ctrainer/delete_trainer", {
                    seq : seq
                }, function(data) {
                    doSearch(0);
            });
        }
    }

    function onDetail(seq)
    {
        // window.location.href = '<?php echo $baseDir; ?>/admin/ccenter/details?seq=' + seq + '&page=' + cpage;
    }
    
    $(document).ready(function() {
<?php if (perm_is_center($permission)): ?>
        $("#centercode").val('<?php echo $centercode ?>');
        $("#centercode").prop("disabled", true);
<?php endif; ?>        
        doSearch(0);
    }); 
</script>
<script>
    $("#searchkey").keypress(function(event) {
        if ( event.which != 13 ) return;
        onClickSearch();
    });

    $("#centercode").change(function(event) {
        onClickSearch();
    });

</script>