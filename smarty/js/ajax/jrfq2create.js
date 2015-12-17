function chkb2s()
{
    var prdtid = $('#iProductId').val();
    if(typeof(prdtid) != "undefined" && prdtid != null) {
        var pids = prdtid.split('-');
        $('#iBuyer2Id option[prdt!="'+pids[1]+'"]:not(:eq(0))').remove();
    }
}

function srchprdt()
{
    var url = SITE_URL+"index.php?file=u-aj_getproducts";
    var selected_type = $('input:radio[name=eFor]:checked').val();    
    var prms = "&availability="+$('#eAssociateBuyer2').val()+"&iInvoiceID="+$('#iInvoiceID').val()+"&iPurchaseOrderID="+$('#iPurchaseOrderID').val()+"&eType="+selected_type+"&prdt_nm="+$('#prdt_nm').val()+"&prdt_cd="+$('#prdt_cd').val()+"&ext=size\='10'"+"&dflt=<option value='' disabled='disabled'>"+$('#iProductId option[value=""]').text()+"</option>"+"&ocf=return getb2s();"+"&elid=iProductId&elnm=Data[iProductId]";
    $.ajax({
        type:"POST",
        url:url,
        data:prms,
        success:function(resp) {
            $('#prdtlist').html('');
            $('#prdtlist').append(resp);
        }
    });
}

$('#iProductId').on("change", function (event) {
    //alert(1);
    var url = SITE_URL+"index.php?file=u-aj_showprdtls";
    // var prms = "&iInvoiceID="+$('#iInvoiceID').val()+"&iProductId="+$('#iProductId').val()+"&iBuyer2Id="+$(this).val();
    var prms = "&iInvoiceID="+$('#iInvoiceID').val()+"&iProductId="+$(this).val()+"&availability="+$('#eAssociateBuyer2').val();
    $.ajax({
        type:"POST",
        url:url,
        data:prms,
        success:function(resp) {
            $('#prdtl').html('');
            $('#prdtl').append(resp);
        }
    });
    //
    //$(this).css('background-color','#eeeeee');
    v=parseFloat($('#iProductId').css("width").replace("px",""));
    //alert(v+$(this).position().left);
    $('#prdtl').css('left', v+$(this).position().left);
    // $('#prdtl').css('top', $(this).position().top+parseInt($(this).attr('index')));
    // $('#prdtl').css('display','');
    $('#prdtl').show();
});
/*$('#iProductId').on("mouseout", function (event) {
	$(this).css('background-color','#ffffff');
});*/
$('#iProductId').on("mouseout", function(event) {
    // $('#prdtl').css('display','none');
    $('#prdtl').hide();
    $('#prdtl').html('');
});

function getb2s()
{
    chkb2s();
    //
    var url = SITE_URL+"index.php?file=u-aj_getprodtls";
    var prms = "&iProductId="+$('#iProductId').val()+"&fld=tDescription";
    $.ajax({
        type:"POST",
        url:url,
        data:prms,
        success:function(resp) {
            if($.trim(resp)!='') {
                $('#pdesc').html(resp);
                // $('#pdesc').append(resp);
                $('#pdsc').show();
            } else {
                $('#pdesc').html('');
            // $('#pdsc').hide();
            }
        }
    });
    //
    var url = SITE_URL+"index.php?file=u-aj_getbuyer2s";
    var selected_type = $('input:radio[name=eFor]:checked').val();    
    var prms = "&iInvoiceID="+$('#iInvoiceID').val()+"&iPurchaseOrderID="+$('#iPurchaseOrderID').val()+"&eType="+selected_type+"&iProductId="+$('#iProductId').val()+"&ext=size\='10'"+"&dflt=<option value='' disabled='disabled'>"+$('#Buyer2Id option[value=""]').text()+"</option>"+"&ocf="+"&elid=Buyer2Id&elnm=Data[Buyer2Id]";
    $('.ldrb2').show();
    $.ajax({
        type:"POST",
        url:url,
        data:prms,
        success:function(resp) {
            $('#b2list').html('');
            $('#b2list').append(resp);
            $('.ldrb2').hide();
            var total_buyer2_options = $("#Buyer2Id option").size();            
            if(total_buyer2_options == "2"){
                $('#Buyer2Id option:eq(1)').attr('selected', 'selected');
                $("#b2a").trigger("click");
                $('#iBuyer2Id option:eq(1)').attr('selected', 'selected');
                if($('#fAdvancePc_hidden').val() == ""){
                    $('#fAdvancePc_hidden').val('0');
                }
                $('#fAdvanceMinPc').val($('#fAdvancePc_hidden').val());
                if($('#fFeePc_hidden').val() == ""){
                    $('#fFeePc_hidden').val('0');
                }
                $('#fPriceMaxPc').val($('#fFeePc_hidden').val());
                setamtsfpc();
                $('#fAdvanceMinPc').trigger('blur');
                if($('#fAdvanceMinPc').val() == "" || $('#fAdvanceMinPc').val() == "0"){
                    $('#fAdvanceMinPc').val('0');
                    $('#fAdvanceMinAmt').val('0');
                }
                $('#fPriceMaxPc').trigger('blur');
                if($('#fPriceMaxPc').val() == "" || $('#fPriceMaxPc').val() == "0"){
                    $('#fPriceMaxPc').val('0');
                    $('#fPriceMaxAmt').val('0');                    
                }
                if($('#fAdvanceMinAmt').val() == ""){
                    $('#fAdvanceMinAmt').val('0');
                }
                if($('#fPriceMaxAmt').val() == ""){
                    $('#fPriceMaxAmt').val('0');
                }
            }else{
                //$('#fAdvanceMinPc').val($('#fAdvancePc_hidden').val());
                //$('#fPriceMaxPc').val($('#fFeePc_hidden').val());
                //$('#fAdvanceMinPc').val('');
                //$('#fPriceMaxPc').val('');
                $('#fAdvanceMinPc').trigger('blur');
                if($('#fAdvanceMinPc').val() == "" || $('#fAdvanceMinPc').val() == "0"){
                    $('#fAdvanceMinPc').val('0');
                    $('#fAdvanceMinAmt').val('0');
                }
                $('#fPriceMaxPc').trigger('blur');
                if($('#fPriceMaxPc').val() == "" || $('#fPriceMaxPc').val() == "0"){
                    $('#fPriceMaxPc').val('0');
                    $('#fPriceMaxAmt').val('0');                    
                }
                if($('#fAdvanceMinAmt').val() == ""){
                    $('#fAdvanceMinAmt').val('0');
                }
                if($('#fPriceMaxAmt').val() == ""){
                    $('#fPriceMaxAmt').val('0');
                }
            }
        }
    });
// $('.ldrb2').hide();
}
getb2s();

$(".b2sal").on("click", function() {
    $("#Buyer2Id option[value!='']").attr('selected','selected');
});

$('#b2a').click(function() {    
    //var total_option_sel = $('#Buyer2Id option:selected').size();
    var total_buyer2selected_options = $("#iBuyer2Id option").size();
    var selected_val = $('input:radio[name=eFor]:checked').val();    
    //if((total_buyer2selected_options > 1) && selected_val == "PO"){
        //alert('You can only select one buyer2');
        //return false;
    //}    
    $.each($('#Buyer2Id option:selected'), function () {
        if($(this).val()!='') {
            mel = $(this).clone();
            var th = 'n';
            $.each($('#iBuyer2Id option'), function () {
                if($(this).val()==mel.val()) {
                    th='y';
                }
            });
            if(th=='n') {
                $('#iBuyer2Id').append(mel);
            }
            if(selected_val == "PO" || selected_val == "Invoice"){
                var total_buyer2_sel_options = $("#iBuyer2Id option").size();
                if(total_buyer2_sel_options == "2"){
                    $('#Buyer2Id option:eq(1)').attr('selected', 'selected');
                    //$("#b2a").trigger("click");
                    $('#iBuyer2Id option:eq(1)').attr('selected', 'selected');
                    var adv_val = $('#advance_price_values > #advance_price_values_'+$(this).val()).html();
                    var adv_val_arr = adv_val.split(',');                    
                    $('#fAdvanceMinPc').val(adv_val_arr[0]);
                    $('#fPriceMaxPc').val(adv_val_arr[1]);
                    setamtsfpc();
                    $('#fAdvanceMinPc').trigger('blur');
                    if($('#fAdvanceMinPc').val() == "" || $('#fAdvanceMinPc').val() == "0"){
                        $('#fAdvanceMinPc').val('0');
                        $('#fAdvanceMinAmt').val('0');
                    }
                    $('#fPriceMaxPc').trigger('blur');
                    if($('#fAdvanceMinAmt').val() == ""){
                        $('#fAdvanceMinAmt').val('0');
                    }
                    if($('#fPriceMaxAmt').val() == ""){
                        $('#fPriceMaxAmt').val('0');
                    }                    
                }else{
                    if($('#fAdvancePc_hidden').val() == ""){
                        $('#fAdvancePc_hidden').val('0');
                    }
                    $('#fAdvanceMinPc').val($('#fAdvancePc_hidden').val());
                    if($('#fFeePc_hidden').val() == ""){
                        $('#fFeePc_hidden').val('0');
                    }
                    $('#fPriceMaxPc').val($('#fFeePc_hidden').val());
                    $('#fAdvanceMinPc').val('0');
                    $('#fPriceMaxPc').val('0');
                    $('#fAdvanceMinPc').trigger('blur');
                    $('#fPriceMaxPc').trigger('blur');
                    if($('#fAdvanceMinAmt').val() == ""){
                        $('#fAdvanceMinAmt').val('0');
                    }
                    if($('#fPriceMaxAmt').val() == ""){
                        $('#fPriceMaxAmt').val('0');
                    }
                }
            }
        }
    });    
});
$('#b2r').click(function() {
    $('#iBuyer2Id option[value!=""]:selected').remove();
});

$('#Buyer2Id').on("change",function(event) {
    // alert($(this).val());
    var url = SITE_URL+"index.php?file=u-aj_getrpb2basocdtls";
    //alert();alert($(this).val());
    // var prms = "&iInvoiceID="+$('#iInvoiceID').val()+"&iProductId="+$('#iProductId').val()+"&iBuyer2Id="+$(this).val();
    var prms = "&iInvoiceID="+$('#iInvoiceID').val()+"&iProductId="+$('#Buyer2Id option:selected').attr('prdt')+"&iBuyer2Id="+$(this).val();
    //alert(prms);
    $.ajax({
        type:"POST",
        url:url,
        data:prms,
        success:function(resp) {
            $('#b2dtl').html('');
            $('#b2dtl').append(resp);
        }
    });
    //
    //$(this).css('background-color','#eeeeee');
    v=parseFloat($('#Buyer2Id').css("width").replace("px",""));
    //alert(v+$(this).position().left);
    $('#b2dtl').css('left', v+$(this).position().left);
    //$('#b2dtl').css('left', event.pageX);
    // $('#b2dtl').css('top', $(this).position().top+parseInt($(this).attr('index')));
    // $('#b2dtl').css('display','');
    $('#b2dtl').show();
});
/*$('#Buyer2Id option').on("mouseout", function (event) {
	$(this).css('background-color','#ffffff');
});*/
$('#Buyer2Id').on("mouseout", function(event) {
    // $('#b2dtl').css('display','none');
    $('#b2dtl').hide();
    $('#b2dtl').html('');
});
$('#iBuyer2Id').on("change",function(event) {
    // alert($(this).val());
    var url = SITE_URL+"index.php?file=u-aj_getrpb2basocdtls";
    // var prms = "&iInvoiceID="+$('#iInvoiceID').val()+"&iProductId="+$('#iProductId').val()+"&iBuyer2Id="+$(this).val();
    var prms = "&iInvoiceID="+$('#iInvoiceID').val()+"&iProductId="+$('#iBuyer2Id option:selected').attr('prdt')+"&iBuyer2Id="+$(this).val();
    $.ajax({
        type:"POST",
        url:url,
        data:prms,
        success:function(resp) {
            $('#b2dtls').html('');
            $('#b2dtls').append(resp);
        }
    });
    //
    //$(this).css('background-color','#eeeeee');
    v=parseFloat($('#iBuyer2Id').css("width").replace("px",""));
    //alert(v+$(this).position().left);
    $('#b2dtls').css('left', v+$(this).position().left);
    //$('#b2dtls').css('left', event.pageX);
    // $('#b2dtls').css('top', $(this).position().top+parseInt($(this).attr('index')));
    // $('#b2dtls').css('display','');
    $('#b2dtls').show();
});
$('#iBuyer2Id').on("mouseout", function (event) {
    $(this).css('background-color','#ffffff');
});
$('#iBuyer2Id').on("mouseout", function(event) {
    // $('#b2dtls').css('display','none');
    $('#b2dtls').hide();
    $('#b2dtls').html('');
});
//
/*
function setTypeFlds()
{
	if($('#eAuctionType').val()=='Auction') {
		$('#byoa').show();
		$('#byop').show();
	} else if($('#eAuctionType').val()=='Tender') {
		$('#byoa').hide();
		$('#byop').hide();
	}
}
$('#eAuctionType').change(setTypeFlds);
*/
// ipaam
function setamtsfpc()
{
    var ipam = (! isNaN(parseFloat($.trim($('.ipaam').attr('innerHTML')))) )? parseFloat($.trim($('.ipaam').attr('innerHTML'))) : 0;
    var mnadv_pc = (! isNaN(parseFloat($.trim($('#fAdvanceMinPc').val()))) )? parseFloat($.trim($('#fAdvanceMinPc').val())) : 0;
    var mxprc_pc = (! isNaN(parseFloat($.trim($('#fPriceMaxPc').val()))) )? parseFloat($.trim($('#fPriceMaxPc').val())) : 0;
    var mnadv_amt = (! isNaN(parseFloat($.trim($('#fAdvanceMinAmt').val()))) )? parseFloat($.trim($('#fAdvanceMinAmt').val())) : 0;
    var mxprc_amt = (! isNaN(parseFloat($.trim($('#fPriceMaxAmt').val()))) )? parseFloat($.trim($('#fPriceMaxAmt').val())) : 0;
    if(ipam>0) {
        if(mnadv_pc>0) {
            var t = ipam*mnadv_pc/100;
            $('#fAdvanceMinAmt').val(t.toFixed(2)); 	// // t.toFixed(2)
            $('#fAdvanceTotal').val((t+ipam).toFixed(2));
            $('.at').attr('innerHTML',(t+ipam).toFixed(2));
        } else {
            $('#fAdvanceMinAmt').val('0');
            $('#fAdvanceTotal').val('0');
            $('.at').attr('innerHTML','0');
        }
        if(mxprc_pc>0) {
            var t = ipam*mxprc_pc/100;
            $('#fPriceMaxAmt').val(t.toFixed(2)); 	// t.toFixed(2)
            $('#fPriceTotal').val((t+ipam).toFixed(2));
            $('.pt').attr('innerHTML',(t+ipam).toFixed(2));
        } else {
            $('#fPriceMaxAmt').val('0');
            $('#fPriceTotal').val('0');
            $('.pt').attr('innerHTML','0');
        }
    }
}
function setpcfamts()
{
    var ipam = (! isNaN(parseFloat($.trim($('.ipaam').attr('innerHTML')))) )? parseFloat($.trim($('.ipaam').attr('innerHTML'))) : 0;
    var mnadv_pc = (! isNaN(parseFloat($.trim($('#fAdvanceMinPc').val()))) )? parseFloat($.trim($('#fAdvanceMinPc').val())) : 0;
    var mxprc_pc = (! isNaN(parseFloat($.trim($('#fPriceMaxPc').val()))) )? parseFloat($.trim($('#fPriceMaxPc').val())) : 0;
    var mnadv_amt = (! isNaN(parseFloat($.trim($('#fAdvanceMinAmt').val()))) )? parseFloat($.trim($('#fAdvanceMinAmt').val())) : 0;
    var mxprc_amt = (! isNaN(parseFloat($.trim($('#fPriceMaxAmt').val()))) )? parseFloat($.trim($('#fPriceMaxAmt').val())) : 0;
    if(ipam>0) {
        if(mnadv_amt>0) {
            var t = mnadv_amt*100/ipam;
            $('#fAdvanceMinPc').val(t.toFixed(2)); 	// // t.toFixed(2)
            $('#fAdvanceTotal').val((mnadv_amt+ipam).toFixed(2));
            $('.at').attr('innerHTML',(mnadv_amt+ipam).toFixed(2));
        } else {
            $('#fAdvanceMinPc').val('0');
            $('#fAdvanceTotal').val('0');
            $('.at').attr('innerHTML','0');
        }
        if(mxprc_amt>0) {
            var t = mxprc_amt*100/ipam;
            $('#fPriceMaxPc').val(t.toFixed(2)); 	// t.toFixed(5)
            $('#fPriceTotal').val((mxprc_amt+ipam).toFixed(2));
            $('.pt').attr('innerHTML',(mxprc_amt+ipam).toFixed(2));
        } else {
            $('#fPriceMaxPc').val('0');
            $('#fPriceTotal').val('0');
            $('.pt').attr('innerHTML','0');
        }
    }
}
$('#fAdvanceMinPc').bind("blur", setamtsfpc);
$('#fPriceMaxPc').bind("blur", setamtsfpc);
$('#fAdvanceMinAmt').bind("blur", setpcfamts);
$('#fPriceMaxAmt').bind("blur", setpcfamts);
if(! isNaN(parseFloat($('#fAdvanceMinPc').val(),10))) {
    $('#fAdvanceMinPc').trigger('blur');
    if($('#fAdvanceMinAmt').val() == ""){
        $('#fAdvanceMinAmt').val('0');
    }
    if($('#fPriceMaxAmt').val() == ""){
        $('#fPriceMaxAmt').val('0');
    }
}
if(! isNaN(parseFloat($('#fPriceMaxPc').val(),10))) {
    $('#fPriceMaxPc').trigger('blur');
    if($('#fAdvanceMinAmt').val() == ""){
        $('#fAdvanceMinAmt').val('0');
    }
    if($('#fPriceMaxAmt').val() == ""){
        $('#fPriceMaxAmt').val('0');
    }
}
//