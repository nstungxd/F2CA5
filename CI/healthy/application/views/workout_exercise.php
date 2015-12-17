<?php if (isset($workout) && $workout != null){ ?>
<div id="content" class="ninecol last">
    <div class="panel-wrapper">
        <div class="panel">
            <div class="title no-border">
                <div class="headline first" style="width:100px;">
                    <label id='lbl-total-count'></label>
                </div>
                <div class="headline first">

                </div>

                <div class="headline first" style="float:right">
                    <?php if($workout->CreateBy== $adminseq || $adminseq==''){ ?>
                    <button class="button-green" onclick="onAdd();">Add Exercises</button>
                    <?php } ?>
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
            var seq = "<?php echo $seq ?>";
            var check_owner = "<?php if($workout->CreateBy== $adminseq || $adminseq==''){ echo 'true'; } else echo 'false'; ?>";
            function doSearch(page)
            {
                $.post("<?php echo $baseDir; ?>/admin/cworkout/search_workout_execise", {
                    page : page,
                    seq : seq,
                    check_owner : check_owner
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
                
            }
            function onSelectPage(page)
            {
                cpage = page;
                doSearch(page);
            }
            function onAdd()
            {
                window.location.href = '<?php echo $baseDir; ?>/admin/cworkout/add_workout_execise?page=' + cpage +'&seq=' + seq;
            }
            function onDelete(seq)
            {
                if (confirm("Are you sure to delete this?")) {
                    $.post("<?php echo $baseDir; ?>/admin/cworkout/delete_workout_execise", {
                        seq : seq
                    }, function(data) {
                        doSearch(0);
                    });
                }
            }
            $(document).ready(function() {
                doSearch(0);

            });
            
        </script>

    <?php } ?>
    
   
