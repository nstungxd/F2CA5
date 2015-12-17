$('#checkbox').click( function ()
    {
        orgs = $('input:checkbox[name="iBidId\[\]"]');
        if($(this).attr('checked')) {
            $.each(orgs, function (ln,el) {
                $(this).attr('checked','checked');
            });
        } else {
            $.each(orgs, function (ln,el) {
                $(this).attr('checked','');
            });
        }
    });

function getrfq2bidlist(vl,pg,cursort)
{
    $('#updating').show();
    $('#mod').val(vl);
    if(cursort == $('#cursort').val()) {
        if($('#cursorttype').val() == 1) {
            $('#cursorttype').val('0');
        } else {
            $('#cursorttype').val('1');
        }
    } else {
        $('#cursorttype').val('0');
    }

    $('#cursort').val(cursort);
    listrfq2bid(pg);
}

function listrfq2bid(pg)
{
    pars = "";
    vl = $('#mod').val();

    if(vl == 'all' || $.trim(vl) == '')
    {
        var val = $('#search_text').val();
        pars += "&val="+val+"&mod="+vl;
    }
    else if(vl == 'srch')
    {
        pars += "&mod=srch"+"&vRFQ2Code="+$.trim($('#vRFQ2Code').val())+"&vInvoiceCode="+$.trim($('#vInvoiceCode').val())+"&amount="+$.trim($('#amount').val())+"&buyer="+$.trim($('#buyer').val())+"&supplier="+$.trim($('#supplier').val())+"&eAuctionType="+$.trim($('#eAuctionType').val())+"&eBidCriteria="+$.trim($('#eBidCriteria').val())+"&dStartDate="+$.trim($('#dStartDate').val())+"&dEndDate="+$.trim($('#dEndDate').val())+"&product="+$.trim($('#product').val())+"&bestbid="+$.trim($('#bestbid').val())+"&eStatus="+$.trim($('#eStatus').val())+"";
    }
    pars += '&status='+$('#status').val();
    if(pg == 'prv') {
        pg = pg-1;
    }
    if(pg == 'nxt') {
        pg = pg+1;
    }
    pars += "&page="+pg;		// $('#pg').val();
    // $('#updating').show();
    if($('#cursort')) {
        pars += "&cursort="+$('#cursort').val();
    }

    if($('#cursorttype')) {
        pars += "&cursorttype="+$('#cursorttype').val();
    }
    if($('#sts')) {
        pars += "&sts="+$('#sts').val();
    }
    url = SITE_URL+"index.php?file=u-aj_b2rfq2bidvlist";
    $('#mod').val(vl);
    // alert(url+pars); return false;
    $.post(url, pars, function(resp)
    {
        // $('#updating').hide();
        $('#grouplist').attr('innerHTML',resp);
        //$.getScript(SITE_URL_DUM+'js/ajax/coreajax.js');
        window.setTimeout("$('#updating').hide();", 1000);
        $(document).ready( function() {
            $(function() {
                $('#pane2').jScrollPane({
                    showArrows:true, 
                    scrollbarWidth: 15, 
                    arrowSize: 15
                });
            });
        });
    });
}
getrfq2bidlist('all',1);

function chstatus(mode,val)
{
    if(mode == 'deleteall' || mode == 'status')
    {
        var sel = 0;
        var orgsval = '';
        var orgs = document.getElementsByName('iBidId[]');

        if(orgs.length == 0) {
            return false;
        }
        for(var l=0; l<orgs.length;l++)
        {
            //alert(orgs[l].id);
            if(orgs[l].checked) {
                //alert(orgs[l].value);
                orgsval += orgs[l].value+",";
            } else {
                sel = sel+1;
            }
        }
        if(sel == orgs.length) {
            //$('#imgProcess').addClass('hidden');
            alert(MSG_SELECT_ATLEAST_ONE_REC);
            return false;
        } else {
            $('#updating').show();
            $('#dispmsg').hide();
            if(orgsval.lastIndexOf(',') == orgsval.length-1) {
                orgsval = orgsval.substring(0,orgsval.length-1);
            }
        }
    //alert(orgsval);
    }
	
    pars = "";
    if(mode == 'delete') {
        pars += "&val="+val+"&mode="+mode;
    } else if(mode == 'deleteall' || mode == 'status') {
        pars += "&val="+orgsval+"&mode="+mode;
    }
	
    if(mode == 'deleteall' || mode == 'delete') {
        var con = confirm(''+MSG_CONFIRM_DELETE+'');
        if(!con) {
            $('#updating').hide();
            return false;
        }
    }

    url = SITE_URL+"index.php?file=u-aj_b2rfq2bidlist_a";
    // alert(url+pars);
    $.post(url, pars, function(resp)
    {
        $('#updating').hide();
        $('#dispmsg').show();
        $('#dispmsg').attr('innerHTML',resp);
        //window.setTimeout("$('#updating').hide();", 1000);
        getrfq2list('all',1);
    });
}