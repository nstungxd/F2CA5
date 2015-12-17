var invType = $('#invtype').attr('innerHTML');		// {/literal}'{$invoiceTypes}'{literal};
var uom = $('.uoms').attr('innerHTML');
var cr = 0;
var i=1;
cr = i-1;
if(cnt>1) {
    i = parseInt(cnt);
    cr = i;
}

function addRw () {
	var noadd = false;
	$.each($('.ot'), function(i,el) {
		if($.trim($(this).html().toLowerCase()) == 'discount' || $.trim($(this).html().toLowerCase()) == 'charge') {
			noadd = true;
		}
	});
	if(noadd) {
		alert(LBL_NO_MORE_ITEMS_MSG);
		return false;
	}
    var j=i;

    if(!document.getElementById('vUnitOfMeasure'+cr)) {
        return false;
    }

    if(document.getElementById('vUnitOfMeasure'+cr)) {
        if($('#vUnitOfMeasure'+cr) && $('#vUnitOfMeasure'+cr) != 'undefined') {
            // if($("#frmadd").validate().element('#vUnitOfMeasure'+cr) && $("#frmadd").validate().element('#fAmount'+cr) && $("#frmadd").validate().element('#fLineTotal'+cr)) {
            if(($("#frmadd").validate().element('#fPrice'+cr) && $("#frmadd").validate().element('#fAmount'+cr) && $("#frmadd").validate().element('#fLineTotal'+cr)) || ($("#frmadd").validate().element('#fPrice'+cr) && ($('#eInvoiceType'+cr).val()=='Discount' || $('#eInvoiceType'+cr).val()=='Charge'))) {
            //
            } else {
                return false;
            }
        }
    }

    for(var h=0; h<i; h++) {
        if(document.getElementById('vUnitOfMeasure'+h)) {
            if($("#frmadd").validate().element('#fPrice'+h)==false || $("#frmadd").validate().element('#fAmount'+h)==false || $("#frmadd").validate().element('#fLineTotal'+h)==false) {
                $('#Div'+h).attr('innerHTML','');
            }
        }
    }

    if(edt!='y') {
        cr = i;
    }

    var lin = j;
    var ln = j-1;
    if(document.getElementById('eInvoiceType'+ln) && !document.getElementById('spnd'+ln)) {
		$('#dlines').append("<div id='spnd"+ln+"'><span style='display:inline-block; line-height:0px; width:5px; padding:0px; margin-right:5px;' class='ar'><img src='"+SITE_IMAGES+"sm_images/arrow-orange.gif' /></span><span style='display:none; height:10px; width:50px; padding:1px; margin:0px;' class='ot'>"+$('#eInvoiceType'+ln).val()+"</span><span style='display:inline-block; height:10px; width:121px; padding:1px; margin:0px;' class='td'>"+$('#tDescription'+ln).val()+"</span><span style='display:inline-block; height:10px; width:63px; padding:1px; margin:0px;' class='um'>"+$('#vPartNo'+ln).val()+"</span><span style='display:inline-block; height:10px; width:70px; padding:1px; margin:0px;' class='um'>"+(($('#eInvoiceType'+ln).val()=='Discount' || $('#eInvoiceType'+ln).val()=='Charge')? '' : $('#vUnitOfMeasure'+ln).val())+"</span><span style='display:inline-block; height:10px; width:38px; padding:1px; margin:0px; text-align:right;' class='iq'>"+$('#iQuantity'+ln).val()+"</span><span style='display:inline-block; height:10px; width:"+(($('#eInvoiceType'+ln).val()=='Discount' || $('#eInvoiceType'+ln).val()=='Charge')? '88' : '77')+"px; padding:1px; margin:0px; text-align:right;' class='fp'>"+parseFloat($('#fPrice'+ln).val()).toFixed(2)+"</span><span style='display:inline-block; height:10px; width:"+(($('#eInvoiceType'+ln).val()=='Discount' || $('#eInvoiceType'+ln).val()=='Charge')? '118' : '129')+"px; padding:1px; margin:0px; text-align:right;' class='fa'>"+$('#fAmount'+ln).val()+"</span><span style='display:inline-block; height:10px; width:74px; padding:1px; margin:0px; text-align:right;' class='fv'>"+parseFloat($('#vat'+ln).val()).toFixed(2)+"</span><span style='display:inline-block; height:10px; width:50px; padding:1px; margin:0px; text-align:right;display:none;' class='ox'>"+parseFloat($('#othertax1'+ln).val()).toFixed(2)+"</span><span style='display:inline-block; height:10px; width:84px; padding:1px; margin:0px; text-align:right;' class='wt'>"+parseFloat($('#withholdingtax'+ln).val()).toFixed(2)+"</span><span style='display:inline-block; height:10px; width:119px; padding:1px; margin:0px; text-align:right;' class='lt'>"+$('#fLineTotal'+ln).val()+"</span><span style='display:inline-block; height:10px; padding:1px; margin:0px;' class='at'>  &nbsp; <img src='"+SITE_IMAGES+"sm_images/icon-pen.gif' onclick='edt=\"y\"; shwtbl("+ln+");' />&nbsp;<img src='"+SITE_IMAGES+"sm_images/icon-cancel.gif' onclick='deltbl("+ln+");' /></span> <div id='subli' style='padding-left:12px; margin-bottom:10px; "+(($('#eInvoiceType'+ln).val()=='Discount' || $('#eInvoiceType'+ln).val()=='Charge' || $('#eSublineType'+ln).val()=='')? 'display:none;' : '')+"'><span style='display:inline-block; height:10px; width:180px; margin:0px; text-align:left;' class='sltyp'>"+$('#eSublineType'+ln).val()+" </span> <span class='slqt' style='display:inline-block; height:10px; width:114px; margin:0px; text-align:right;'><span class='sqt'>"+$('#iSubQuantity'+ln).val()+"</span></span> &nbsp;&nbsp;&nbsp;<span class='slrt' style='display:inline-block; height:10px; width:77px; margin:0px; text-align:right;'><span class='srt'>"+parseFloat($('#fSubRate'+ln).val()).toFixed(2)+"%</span></span> &nbsp;&nbsp;&nbsp;<span class='sltl' style='display:inline-block; height:10px; width:109px; margin:0px; text-align:right;'>"+(($('#eSublineType'+ln).val() == 'Discount')? "" : "")+"<span class='stl'>"+parseFloat($('#fSubAmount'+ln).val()).toFixed(2)+"</span>"+(($('#eSublineType'+ln).val() == 'Discount')? "" : "")+"</span><span class='slvt' style='display:inline-block; height:10px; width:75px; margin:0px; text-align:right;'><span class='slv'></span></span><span class='slot' style='display:inline-block; height:10px; width:57px; margin:0px; text-align:right;display:none;'><span class='slo'></span></span><span class='slwt' style='display:inline-block; height:10px; width:86px; margin:0px; text-align:right;'><span class='slw'></span></span><span class='sltt' style='display:inline-block; height:10px; width:122px; margin:0px; text-align:right;'><span class='slf'></span></span></div></div>");
        edt='y';
    } else if(document.getElementById('eInvoiceType'+cr) && document.getElementById('spnd'+cr)) {
        $("#spnd"+cr).attr('innerHTML',"<span style='display:inline-block; line-height:0px; width:5px; padding:0px; margin-right:5px;' class='ar'><img src='"+SITE_IMAGES+"sm_images/arrow-orange.gif' /></span><span style='display:none; height:10px; width:49px; padding:1px; margin:0px;' class='ot'>"+$('#eInvoiceType'+cr).val()+"</span><span style='display:inline-block; height:10px; width:121px; padding:1px; margin:0px;' class='td'>"+$('#tDescription'+cr).val()+"</span><span style='display:inline-block; height:10px; width:63px; padding:1px; margin:0px;' class='um'>"+$('#vPartNo'+cr).val()+"</span><span style='display:inline-block; height:10px; width:70px; padding:1px; margin:0px;' class='um'>"+(($('#eInvoiceType'+cr).val()=='Discount' || $('#eInvoiceType'+cr).val()=='Charge')? '' : $('#vUnitOfMeasure'+cr).val())+"</span><span style='display:inline-block; height:10px; width:38px; padding:1px; margin:0px; text-align:right;' class='iq'>"+$('#iQuantity'+cr).val()+"</span><span style='display:inline-block; height:10px; width:"+(($('#eInvoiceType'+cr).val()=='Discount' || $('#eInvoiceType'+cr).val()=='Charge')? '88' : '77')+"px; padding:1px; margin:0px; text-align:right;' class='fp'>"+parseFloat($('#fPrice'+cr).val()).toFixed(2)+"</span><span style='display:inline-block; height:10px; width:"+(($('#eInvoiceType'+cr).val()=='Discount' || $('#eInvoiceType'+cr).val()=='Charge')? '118' : '129')+"px; padding:1px; margin:0px; text-align:right;' class='fa'>"+$('#fAmount'+cr).val()+"</span><span style='display:inline-block; height:10px; width:74px; padding:1px; margin:0px; text-align:right;' class='fv'>"+parseFloat($('#vat'+cr).val()).toFixed(2)+"</span><span style='display:inline-block; height:10px; width:50px; padding:1px; margin:0px; text-align:right;' class='ox'>"+parseFloat($('#othertax1'+cr).val()).toFixed(2)+"</span><span style='display:inline-block; height:10px; width:84px; padding:1px; margin:0px; text-align:right;' class='wt'>"+parseFloat($('#withholdingtax'+cr).val()).toFixed(2)+"</span><span style='display:inline-block; height:10px; width:119px; padding:1px; margin:0px; text-align:right;' class='lt'>"+$('#fLineTotal'+cr).val()+"</span><span style='display:inline-block; height:10px; padding:1px; margin:0px;' class='at'> &nbsp; <img src='"+SITE_IMAGES+"sm_images/icon-pen.gif' onclick='shwtbl("+cr+");' />&nbsp;<img src='"+SITE_IMAGES+"sm_images/icon-cancel.gif' onclick='deltbl("+cr+");' /></span> <div id='subli' style='padding-left:12px; margin-bottom:10px; "+(($('#eInvoiceType'+cr).val()=='Discount' || $('#eInvoiceType'+cr).val()=='Charge' || $('#eSublineType'+cr).val()=='')? 'display:none;' : '')+"'><span style='display:inline-block; height:10px; width:180px; margin:0px; text-align:left;' class='sltyp'>"+$('#eSublineType'+cr).val()+" </span> <span class='slqt' style='display:inline-block; height:10px; width:114px; margin:0px; text-align:right;'><span class='sqt'>"+$('#iSubQuantity'+cr).val()+"</span></span> &nbsp;&nbsp;&nbsp;<span class='slrt' style='display:inline-block; height:10px; width:77px; margin:0px; text-align:right;'><span class='srt'>"+parseFloat($('#fSubRate'+cr).val()).toFixed(2)+"%</span></span> &nbsp;&nbsp;&nbsp; <span class='sltl' style='display:inline-block; height:10px; width:109px; margin:0px; text-align:right;'>"+(($('#eSublineType'+ln).val() == 'Discount')? "" : "")+"<span class='stl'>"+parseFloat($('#fSubAmount'+cr).val()).toFixed(2)+"</span>"+(($('#eSublineType'+cr).val() == 'Discount')? "" : "")+"</span><span class='slvt' style='display:inline-block; height:10px; width:75px; margin:0px; text-align:right;'><span class='slv'></span></span><span class='slot' style='display:inline-block; height:10px; width:57px; margin:0px; text-align:right;display:none;'><span class='slo'></span></span><span class='slwt' style='display:inline-block; height:10px; width:86px; margin:0px; text-align:right;'><span class='slw'></span></span><span class='sltt' style='display:inline-block; height:10px; width:122px; margin:0px; text-align:right;'><span class='slf'></span></span></div>");
        edt='n';
    }

    if($('div [id*="spnd"]').length<1) {
        if(document.getElementById('nli')) {
            $('#nli').show();
        } else {
            $('#dlines').attr('innerHTML',"<div id='nli' align='center'><br /><b>"+$LBL_NO_LINE_ITEMS+"</b></div>");
        }
    } else {
        $('#nli').hide();
    }

    // alert(i); return false;

    //----------------------
    // i = i+1;
    j = i;
    cr = j;
    var invoiceType = invType;
    invoiceType = invoiceType.replace('id="eInvoiceType"',"id='eInvoiceType"+i+"'");
    invoiceType = invoiceType.replace('id=eInvoiceType',"id='eInvoiceType"+i+"'");
    invoiceType = invoiceType.replace('id="eInvoiceType0"',"id='eInvoiceType"+i+"'");
    invoiceType = invoiceType.replace("id='eInvoiceType1'","id='eInvoiceType"+i+"'");
    invoiceType = invoiceType.replace("id='eInvoiceType2'","id='eInvoiceType"+i+"'");
    invoiceType = invoiceType.replace("id='eInvoiceType3'","id='eInvoiceType"+i+"'");
    //
    var uoms = uom;
    uoms = uoms.replace('id="vUnitOfMeasure"',"id='vUnitOfMeasure"+i+"'");
    uoms = uoms.replace('id=vUnitOfMeasure',"id='vUnitOfMeasure"+i+"'");
    uoms = uoms.replace('id="vUnitOfMeasure0"',"id='vUnitOfMeasure"+i+"'");
    uoms = uoms.replace("id='vUnitOfMeasure1'","id='vUnitOfMeasure"+i+"'");
    uoms = uoms.replace("id='vUnitOfMeasure2'","id='vUnitOfMeasure"+i+"'");
    uoms = uoms.replace("id='vUnitOfMeasure3'","id='vUnitOfMeasure"+i+"'");
    //
    $('div [id*="Div"]').hide();
    var ni = document.getElementById('addNew');
    var numi=document.getElementById('mdiv');
    var num = (parseInt(document.getElementById('mdiv').value) - parseInt(1))+ parseInt(2);
    numi.value = num;
    var newdiv = document.createElement('div');
    var divIdName ="Div"+j;
    newdiv.setAttribute('id', divIdName);
    // newdiv.innerHTML ="<table id='tbl"+j+"' width='100%' border='0' cellspacing='0' class='black'><tr><td><table width='100%' border='0' cellspacing='5' cellpadding='0'><tr><td width='108'>"+LBL_ORDER_TYPE+" :&nbsp;<font class='reqmsg'>*</font></td><td width='281'>"+ordertype+"</td><td width='122'>{/literal}{$LBL_CURRENCY}{literal} : &nbsp;</td><td><b>"+currency+"</b></td></tr><tr><td valign='top'>"+LBL_ORDER_DESCRIPTION+" : </td><td><textarea name='tDescription[]' id='tDescription"+i+"' class='input-rag' style='width:188px; height: 73px;' >"+$('#tDescription'+ln).val()+"</textarea></td><td valign='top'>"+LBL_UNIT_MEASURE+" :&nbsp;<font class='reqmsg'>*</font></td><td valign='top'><input type='text' name='vUnitOfMeasure[]' id='vUnitOfMeasure"+i+"' class='input-rag required' style='width:188px;' title='"+LBL_ENTER+" "+LBL_UNIT_MEASURE+"' value='"+$('#vUnitOfMeasure'+ln).val()+"' /></td></tr></table></td></tr><tr><td><table width='100%' border='0' cellspacing='5' cellpadding='0'><tr><td width='108'>"+LBL_QUANTITY+" :&nbsp;<font class='reqmsg'>*</font></td><td width='154'><input type='text' name='iQuantity[]' id='iQuantity"+i+"' class='input-rag required digits' style='width:117px;' title='"+LBL_ENTER+" "+LBL_QUANTITY+"' value='"+$('#iQuantity'+ln).val()+"' /></td><td width='111'>"+LBL_PRICE+" :&nbsp;<font class='reqmsg'>*</font></td><td width='149'><input type='text' name='fPrice[]' id='fPrice"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_PRICE+"' value='"+$('#fPrice'+ln).val()+"' /></td><td>"+LBL_AMOUNT+" :&nbsp;<font class='reqmsg'>*</font></td><td><input type='text' name='fAmount[]' id='fAmount"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_AMOUNT+"' readonly='readonly' value='"+$('#fAmount'+ln).val()+"' /></td></tr><tr><td>"+LBL_VAT+" "+LBL_RATE+" (%):&nbsp;<font class='reqmsg'>*</font></td><td><input type='text' name='fVAT[]' id='fVAT"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_VAT+"' value='"+$('#fVAT'+ln).val()+"' /></td><td>"+LBL_VAT+" : </td><td><input type='text' name='vat' id='vat"+i+"' class='input-rag' style='width:117px;' title='"+LBL_ENTER+" "+LBL_VAT+"' readonly='readonly' value='"+$('#vat'+ln).val()+"' /></td><td>"+LBL_OTHER_TAX+" "+LBL_RATE+" (%):</td><td><input type='text' name='fOtherTax1[]' id='fOtherTax1"+i+"' class='input-rag decimals' style='width:117px;' value='"+$('#fOtherTax1'+ln).val()+"' /></td></tr><tr><td>"+LBL_OTHER_TAX+":</td><td><input type='text' name='othertax1' id='othertax1"+i+"' class='input-rag' style='width:117px;' readonly='readonly' value='"+$('#othertax1'+ln).val()+"' /></td><td>"+LBL_LINE_TOTAL+" : </td><td><input type='text' name='fLineTotal[]' id='fLineTotal"+i+"' class='input-rag decimals' style='width:117px;' readonly='readonly' value='"+$('#fLineTotal'+ln).val()+"' /></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td align='right'><img src='"+SITE_IMAGES+"sm_images/btn-close.gif' name='close' value='close' onclick=\"$('#adb').hide(); closeRow(\'"+j+"\')\" /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr><tr><td colspan='6'><hr style='border-style: dashed;'></td></tr></table>";
    //newdiv.innerHTML = "<table id='tbl"+j+"' width='100%' border='0' cellspacing='0' class='black'><tr><td><table width='100%' border='0' cellspacing='5' cellpadding='0'><tr><td width='108'>"+LBL_LINE_TYPE+" :&nbsp;<font class='reqmsg'>*</font></td><td width='281'>"+invoiceType+"</td><td width='122'>"+LBL_CURRENCY+" : &nbsp;</td><td><b>"+currency+"</b></td></tr><tr><td valign='top'>"+LBL_DESCRIPTION+" : </td><td><textarea name='tDescription[]' id='tDescription"+i+"' class='input-rag' style='width:188px; height:73px;' >"+$('#tDescription'+ln).val()+"</textarea></td><td width='122'>"+LBL_PART_NO+" : &nbsp;</td><td><input type='text' name='vPartNo[]' id='vPartNo"+i+"' value='"+$('#vPartNo'+ln).val()+"'></td><td valign='top'><span class='ndcf'>"+LBL_UNIT_MEASURE+" :&nbsp;<font class='reqmsg'></font></span></td><td valign='top'>"+uoms+"</td></tr></table></td></tr><tr><td><table width='100%' border='0' cellspacing='5' cellpadding='0'><tr><td width='108'><span class='ndcf'>"+LBL_QUANTITY+" :&nbsp;<font class='reqmsg'>*</font></span></td><td width='154'><input type='text' name='iQuantity[]' id='iQuantity"+i+"' class='input-rag required digits' style='width:117px;' title='"+LBL_ENTER+" "+LBL_QUANTITY+"' value='"+$('#iQuantity'+ln).val()+"' /></td><td width='111'><span class='dcr'>"+LBL_PRICE+" :&nbsp;<font class='reqmsg'>*</font></span></td><td width='149'><input type='text' name='fPrice[]' id='fPrice"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_PRICE+"' value='"+$('#fPrice'+ln).val()+"' /></td><td><span class='ndcf'>"+LBL_AMOUNT+" :&nbsp;<font class='reqmsg'>*</font></span></td><td><input type='text' name='fAmount[]' id='fAmount"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_AMOUNT+"' readonly='readonly' value='"+$('#fAmount'+ln).val()+"' /></td></tr><tr><td><span class='ndcf'>"+LBL_VAT+" "+LBL_RATE+" (%):&nbsp;<font class='reqmsg'>*</font></span></td><td><input type='text' name='fVAT[]' id='fVAT"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_VAT+"' value='"+vat+"' value='"+$('#fVAT'+ln).val()+"' /></td><td><span class='ndcf'>"+LBL_VAT+" :&nbsp;<font class='reqmsg'>*</font></span></td><td><input type='text' name='vat' id='vat"+i+"' class='input-rag decimals' style='width:117px;' title='"+LBL_VAT+"' readonly='readonly' value='"+$('#vat'+ln).val()+"' /></td><td><span class='ndcf'>"+LBL_OTHER_TAX+" "+LBL_RATE+" (%):</span></td><td><input type='text' name='fOtherTax1[]' id='fOtherTax1"+i+"' class='input-rag decimals' style='width:117px;' value='"+$('#fOtherTax1'+ln).val()+"' /></td></tr><tr><td><span class='ndcf'>"+LBL_OTHER_TAX+" : </span></td><td><input type='text' name='othertax1' id='othertax1"+i+"' class='input-rag decimals' style='width:117px;' readonly='readonly' value='"+$('#othertax1'+ln).val()+"' /></td><td><span class='ndcf'>"+LBL_WITH_HOLDING_TAX+" "+LBL_RATE+" (%): </span></td><td><input type='text' name='fWithHoldingTax[]' id='fWithHoldingTax"+i+"' class='input-rag decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_WITH_HOLDING_TAX+"' value='"+$('#fWithHoldingTax'+ln).val()+"' /></td><td><span class='ndcf'>"+LBL_WITH_HOLDING_TAX+" : </span></td><td><input type='text' name='withholdingtax' id='withholdingtax"+i+"' class='input-rag decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_WITH_HOLDING_TAX+"' readonly='readonly' value='"+$('#withholdingtax'+ln).val()+"' /></td><tr><td><span class='ndcf'>"+LBL_LINE_TOTAL+" : </span></td><td><input type='text' name='fLineTotal[]' id='fLineTotal"+i+"' class='input-rag decimals' style='width:117px;' readonly='readonly' value='"+$('#fLineTotal'+ln).val()+"' /></td><td><span class='ndcf'>"+LBL_RECEIPT+" : </span></td><td><input type='text' name='tReceipt[]' id='tReceipt"+i+"' class='input-rag' style='width:117px;' value='"+$('#tReceipt'+ln).val()+"' /></td><td colspan='2'>&nbsp;</td></tr><tr><td colspan='3'>&nbsp;</td></tr><tr><td colspan='2'><span class='ndcf'><b>"+LBL_DISCOUNT+" / "+LBL_CHARGE+" </b> &nbsp; <select id='eSublineType"+i+"' name='eSublineType[]'><option value=''>None</option><option value='Discount'>Discount</option><option value='Charge'>Charge</option></select></span></td><td colspan='4'>&nbsp;</td></tr><tr><td><span class='ndcf'>"+LBL_QUANTITY+" : </span></td><td><input type='text' name='iSubQuantity[]' id='iSubQuantity"+i+"' class='input-rag decimals' style='width:117px;' value='' /></td><td><span class='ndcf'>"+LBL_RATE+" : </span></td><td><input type='text' name='fSubRate[]' id='fSubRate"+i+"' class='input-rag' style='width:117px;' value='' /></td><td colspan='2'><input type='hidden' name='fSubAmount[]' id='fSubAmount"+i+"' class='input-rag' style='width:117px;' value='' /></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td align='right'><img src='"+SITE_IMAGES+"sm_images/btn-close.gif' name='close' value='close' onclick=\"$('#adb').hide(); closeRow(\'"+j+"\')\" /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr><tr><td colspan='6'><hr style='border-style: dashed;'></td></tr></table>";
	newdiv.innerHTML ="<table id='tbl"+j+"' width='100%' border='0' cellspacing='0' class='black'><tr><td><table width='100%' border='0' cellspacing='5' cellpadding='0'><tr><td width='108'>"+LBL_LINE_TYPE+" :&nbsp;<font class='reqmsg'>*</font></td><td width='281'>"+invoiceType+"</td><td width='122'>"+LBL_PART_NO+" : &nbsp;</td><td><input type='text' name='vPartNo[]' id='vPartNo"+i+"'></td></tr><tr><td valign='top'>"+LBL_DESCRIPTION+" : </td><td><textarea name='tDescription[]' id='tDescription"+i+"' class='input-rag' style='width:188px; height: 73px;'  ></textarea></td><td valign='top'><span class='ndcf'>"+LBL_UNIT_MEASURE+" :&nbsp;<font class='reqmsg'></font></span></td><td valign='top'>"+uoms+"</td></tr></table></td></tr><tr><td><table width='100%' border='0' cellspacing='5' cellpadding='0'><tr><td width='108'><span class='ndcf'>"+LBL_QUANTITY+" :&nbsp;<font class='reqmsg'>*</font></span></td><td width='154'><input type='text' name='iQuantity[]' id='iQuantity"+i+"' class='input-rag required digits' style='width:117px;' title='"+LBL_ENTER+" "+LBL_QUANTITY+"' /></td><td width='111'><span class='dcr'>"+LBL_PRICE+" :&nbsp;<font class='reqmsg'>*</font></span></td><td width='149'><input type='text' name='fPrice[]' id='fPrice"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_PRICE+"' /></td><td><span class='ndcf'>"+LBL_AMOUNT+" :&nbsp;<font class='reqmsg'>*</font></span></td><td><input type='text' name='fAmount[]' id='fAmount"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_AMOUNT+"' readonly='readonly' value='0' /></td></tr><tr><td><span class='ndcf'>"+LBL_VAT+" "+LBL_RATE+" (%):&nbsp;<font class='reqmsg'>*</font></span></td><td><input type='text' name='fVAT[]' id='fVAT"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_VAT+"' value='"+vat+"' /></td><td><span class='ndcf'>"+LBL_VAT+" :&nbsp;<font class='reqmsg'>*</font></span></td><td><input type='text' name='vat' id='vat"+i+"' class='input-rag decimals' style='width:117px;' title='"+LBL_VAT+"' readonly='readonly' /></td><td><span class='ndcf'>"+LBL_OTHER_TAX+" "+LBL_RATE+" (%):</span></td><td><input type='text' name='fOtherTax1[]' id='fOtherTax1"+i+"' class='input-rag decimals' style='width:117px;' value='"+otax+"' /></td></tr><tr><td><span class='ndcf'>"+LBL_OTHER_TAX+" : </span></td><td><input type='text' name='othertax1' id='othertax1"+i+"' class='input-rag decimals' style='width:117px;' readonly='readonly' /></td><td><span class='ndcf'>"+LBL_WITH_HOLDING_TAX+" "+LBL_RATE+" (%): </span></td><td><input type='text' name='fWithHoldingTax[]' id='fWithHoldingTax"+i+"' class='input-rag decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_WITH_HOLDING_TAX+"' value='"+wtax+"' /></td><td><span class='ndcf'>"+LBL_WITH_HOLDING_TAX+" : </span></td><td><input type='text' name='withholdingtax' id='withholdingtax"+i+"' class='input-rag decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_WITH_HOLDING_TAX+"' readonly='readonly' /></td><tr><td><span class='ndcf'>"+LBL_LINE_TOTAL+" : </span></td><td><input type='text' name='fLineTotal[]' id='fLineTotal"+i+"' class='input-rag decimals' style='width:117px;' readonly='readonly' /></td><td><span class='ndcf'>"+LBL_RECEIPT+" : </span></td><td><input type='text' name='tReceipt[]' id='tReceipt"+i+"' class='input-rag' style='width:117px;' /></td><td>"+LBL_CURRENCY+" : </td><td><b>"+currency+"</b></td></tr><tr><td colspan='3'>&nbsp;</td></tr><tr><td colspan='2'><span class='ndcf'><b>"+LBL_DISCOUNT+" / "+LBL_CHARGE+" </b> &nbsp; <select id='eSublineType"+i+"' name='eSublineType[]'><option value=''>None</option><option value='Discount'>Discount</option><option value='Charge'>Charge</option></select></span></td><td colspan='4'>&nbsp;</td></tr><tr><td><span class='ndcf'>"+LBL_QUANTITY+" : </span></td><td><input type='text' name='iSubQuantity[]' id='iSubQuantity"+i+"' class='input-rag decimals' style='width:117px;' value='' /></td><td><span class='ndcf'>"+LBL_RATE+" : </span></td><td><input type='text' name='fSubRate[]' id='fSubRate"+i+"' class='input-rag' style='width:117px;' value='' /></td><td colspan='2'><input type='hidden' name='fSubAmount[]' id='fSubAmount"+i+"' class='input-rag' style='width:117px;' value='' /></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td align='right'><img src='"+SITE_IMAGES+"sm_images/btn-close.gif' name='close' value='close' onclick=\"$('#adb').hide(); closeRow(\'"+j+"\')\" /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr><tr><td colspan='6'><hr style='border-style: dashed;'></td></tr></table>";
    // &nbsp; <img src='"+SITE_IMAGES+"sm_images/btn-remove.gif' name='remove' value='remove' onClick=\"removeRow(\'"+divIdName+"\')\" />
    ni.appendChild(newdiv);

    // ----------
    $('input[name="fPrice\[\]"]').blur(function() {
        var rq = $(this).attr('id').replace('fPrice','');
        var type = $('#eInvoiceType'+rq).val();
        if($.trim(type)=='Discount' || $.trim(type)=='Charge') {
            var p = parseFloat($(this).val().replace(new RegExp(',', 'g'),'')).toFixed(2);
            $('#spnd'+rq+'>.iq').attr('innerHTML','');
            $('#spnd'+rq+'>.fp').attr('innerHTML', money_format('%i',parseFloat(p))+'%');
            $('#spnd'+rq+'>.fv').attr('innerHTML','');
            $('#spnd'+rq+'>.ox').attr('innerHTML','');
            $('#spnd'+rq+'>.wt').attr('innerHTML','');
            $('#spnd'+rq+'>.fa').attr('innerHTML','');
            var subtotal = parseFloat($('#subt').html().replace(new RegExp(',', 'g'),''));
			var st = parseFloat(subtotal * p / 100).toFixed(2); 	// litotal
			if(!isNaN(st)) {
				$('#fAmount'+rq).val(st);
			}
			st = $.trim(money_format('%i', parseFloat(st)).replace("USD",""));
			$('#spnd'+rq+'>.fa').attr('innerHTML', st);
			st = parseFloat(st);
			//
			var fv = gettxtotal('.fv');
			if(!isNaN(p)) { $('#fVAT'+rq).val(p); }
			fv = parseFloat(fv * p / 100).toFixed(2);
			$('#spnd'+rq+'>.fv').attr('innerHTML', fv);
			fv = parseFloat(fv);
			//
			var ox = gettxtotal('.ox');
			if(!isNaN(p)) { $('#fOtherTax1'+rq).val(p); }
			ox = parseFloat(ox * p / 100).toFixed(2);
			$('#spnd'+rq+'>.ox').attr('innerHTML', ox);
			ox = parseFloat(ox);
			//
			var wt = gettxtotal('.wt');
			if(!isNaN(p)) { $('#fWithHoldingTax'+rq).val(p); }
			wt = parseFloat(wt * p / 100).toFixed(2);
			$('#spnd'+rq+'>.wt').attr('innerHTML', wt);
			wt = parseFloat(wt);
			//
			var lt = parseFloat((st + fv + ox - wt));
			if(!isNaN(lt)) {
				$('#fLineTotal'+rq).val(lt.toFixed(2));
			}
			lt = $.trim(money_format('%i', lt).replace("USD",""));
			$('#spnd'+rq+'>.lt').attr('innerHTML', lt);
        } else {
            var q = parseInt($('#iQuantity'+rq).val().replace(new RegExp(',', 'g'),''));
            var p = parseFloat($(this).val().replace(new RegExp(',', 'g'),'')).toFixed(2);
            var sum = parseInt(q)*parseFloat(p);
            if(!isNaN(sum)) {
                $('#fAmount'+rq).val($.trim(money_format('%i',sum).replace("USD","")));
            }
            var v = parseFloat($('#fVAT'+rq).val().replace(new RegExp(',', 'g'),'')).toFixed(2);
            var t = parseFloat($('#fOtherTax1'+rq).val().replace(new RegExp(',', 'g'),''));
            var w = parseFloat($('#fWithHoldingTax'+rq).val().replace(new RegExp(',', 'g'),''));
            var a = sum;
            var sm = 0;
            if(!isNaN(a)) {
                sm = sm + a;
                if(!isNaN(v)) {
                    sm = sm + (a*v/100);
                    $('#vat'+rq).val(a*v/100);
                }
                if(!isNaN(t)) {
                    sm = sm + (a*t/100);
                    $('#othertax1'+rq).val(a*t/100);
                }
                if(!isNaN(w)) {
                    sm = sm - (a*w/100);
                    $('#withholdingtax'+rq).val(a*w/100);
                }
                if(!isNaN(sm)) {
                    $('#fLineTotal'+rq).val($.trim(money_format('%i',sm).replace("USD","")));
                }
            }
            // $('#fAmount'+rq).val(parseInt(q)*parseFloat(p));
            if(document.getElementById('spnd'+rq)) {
                $('#spnd'+rq+'>.iq').attr('innerHTML',q);
                $('#spnd'+rq+'>.fp').attr('innerHTML',p);
                $('#spnd'+rq+'>.fv').attr('innerHTML',parseFloat($('#vat'+rq).val()).toFixed(2));
                $('#spnd'+rq+'>.ox').attr('innerHTML',parseFloat($('#othertax1'+rq).val()).toFixed(2));
                $('#spnd'+rq+'>.wt').attr('innerHTML',parseFloat($('#withholdingtax'+rq).val()).toFixed(2));
                var fa = $.trim(money_format('%i',sum).replace("USD",""));
                if(fa.indexOf('.') != -1 && parseInt(fa.substring(fa.lastIndexOf('.')+1, fa.length),10) == 0) {
                    fa = fa.substring(0, fa.length-3);
                }
                $('#spnd'+rq+'>.fa').attr('innerHTML', fa);
                var lt = $.trim(money_format('%i',sm).replace("USD",""));
                if(lt.indexOf('.') != -1 && parseInt(lt.substring(lt.lastIndexOf('.')+1, lt.length),10) == 0) {
                    lt = lt.substring(0, lt.length-3);
                }
                $('#spnd'+rq+'>.lt').attr('innerHTML', lt);
            }
            $.each($('div[id*="Div"]'), function(l) {
                var sbtyp = $(this).find('[name="invoiceType\[\]"]');
                if(sbtyp.val() == 'Discount' || sbtyp.val() == 'Charge') {
                    $(this).find('[name="fPrice\[\]"]').trigger('blur');
                }
            });
        }
        settotal();
    });

    $('input[name="iQuantity\[\]"]').blur(function() {
        var rq = $(this).attr('id').replace('iQuantity','');
        $('#fPrice'+rq).trigger('blur');
    /*var p = parseFloat($('#fPrice'+rq).val().replace(new RegExp(',', 'g'),''));
		var q = parseInt($(this).val().replace(new RegExp(',', 'g'),''));
		var sum = parseInt(q)*parseFloat(p);
		if(!isNaN(sum)) {
			$('#fAmount'+rq).val($.trim(money_format('%i',sum).replace("USD","")));
		}
		var v = parseFloat($('#fVAT'+rq).val().replace(new RegExp(',', 'g'),''));
		var t = parseFloat($('#fOtherTax1'+rq).val().replace(new RegExp(',', 'g'),''));
		var w = parseFloat($('#fWithHoldingTax'+rq).val().replace(new RegExp(',', 'g'),''));
		var a = sum;
		var sm = 0;
		if(!isNaN(a)) {
			sm = sm + a;
			if(!isNaN(v)) { sm = sm + (a*v/100); $('#vat'+rq).val(a*v/100); }
			if(!isNaN(t)) { sm = sm + (a*t/100); $('#othertax1'+rq).val(a*t/100); }
			if(!isNaN(w)) { sm = sm - (a*w/100); $('#withholdingtax'+rq).val(a*w/100); }
			if(!isNaN(sm)) {
				$('#fLineTotal'+rq).val($.trim(money_format('%i',sm).replace("USD","")));
			}
		}

		if(document.getElementById('spnd'+rq)) {
			$('#spnd'+rq+'>.iq').attr('innerHTML',q);
			$('#spnd'+rq+'>.fp').attr('innerHTML',p);
			$('#spnd'+rq+'>.fv').attr('innerHTML',$('#vat'+rq).val());
			$('#spnd'+rq+'>.ox').attr('innerHTML',$('#othertax1'+rq).val());
			$('#spnd'+rq+'>.wt').attr('innerHTML',$('#withholdingtax'+rq).val());
			$('#spnd'+rq+'>.fa').attr('innerHTML',$.trim(money_format('%i',sum).replace("USD","")));
			$('#spnd'+rq+'>.lt').attr('innerHTML',$.trim(money_format('%i',sm).replace("USD","")));
		}
		settotal();*/
    });

    $('input[name="fOtherTax1\[\]"]').change(function() {
        var rq = $(this).attr('id').replace('fOtherTax1','');
        $('#fPrice'+rq).trigger('blur');
    /*var a  = parseFloat($('#fAmount'+rq).val().replace(new RegExp(',', 'g'),''));
		var v = parseFloat($('#fVAT'+rq).val().replace(new RegExp(',', 'g'),''));
		var t = parseFloat($(this).val().replace(new RegExp(',', 'g'),''));
		var w = parseFloat($('#fWithHoldingTax'+rq).val().replace(new RegExp(',', 'g'),''));
		var sum = 0;
		if(!isNaN(a)) {
			sum = sum + a;
			if(!isNaN(v)) { sum = sum + (a*v/100); $('#vat'+rq).val(a*v/100); }
			if(!isNaN(t)) { sum = sum + (a*t/100); $('#othertax1'+rq).val(a*t/100); }
			if(!isNaN(w)) { sum = sum - (a*w/100); $('#withholdingtax'+rq).val(a*w/100); }
			if(!isNaN(sum)) {
				$('#fLineTotal'+rq).val($.trim(money_format('%i',sum).replace("USD","")));
			}
		}

		if(document.getElementById('spnd'+rq)) {
			$('#spnd'+rq+'>.ox').attr('innerHTML',$('#othertax1'+rq).val());
			$('#spnd'+rq+'>.lt').attr('innerHTML',$.trim(money_format('%i',sum).replace("USD","")));
		}
		settotal();*/
    });
    $('input[name="fVAT\[\]"]').change(function() {
        var rq = $(this).attr('id').replace('fVAT','');
        $('#fPrice'+rq).trigger('blur');
    /*var a  = parseFloat($('#fAmount'+rq).val().replace(new RegExp(',', 'g'),''));
		var t = parseFloat($('#fOtherTax1'+rq).val().replace(new RegExp(',', 'g'),''));
		var w = parseFloat($('#fWithHoldingTax'+rq).val().replace(new RegExp(',', 'g'),''));
		var v = parseFloat($(this).val().replace(new RegExp(',', 'g'),''));
		var sum = 0;
		if(!isNaN(a)) {
			sum = sum + a;
			if(!isNaN(v)) { sum = sum + (a*v/100); $('#vat'+rq).val(a*v/100); }
			if(!isNaN(t)) { sum = sum + (a*t/100); $('#othertax1'+rq).val(a*t/100); }
			if(!isNaN(w)) { sum = sum - (a*w/100); $('#withholdingtax'+rq).val(a*w/100); }
			if(!isNaN(sum)) {
				$('#fLineTotal'+rq).val($.trim(money_format('%i',sum).replace("USD","")));
			}
		}

		if(document.getElementById('spnd'+rq)) {
			// $('#spnd'+rq+'>.fv').attr('innerHTML',v);
			$('#spnd'+rq+'>.fv').attr('innerHTML',$('#vat'+rq).val());
			$('#spnd'+rq+'>.lt').attr('innerHTML',$.trim(money_format('%i',sum).replace("USD","")));
		}
		settotal();*/
    });
    $('input[name="fWithHoldingTax\[\]"]').change(function() {
        var rq = $(this).attr('id').replace('fWithHoldingTax','');
        $('#fPrice'+rq).trigger('blur');
    /*var a  = parseFloat($('#fAmount'+rq).val().replace(new RegExp(',', 'g'),''));
		var t = parseFloat($('#fOtherTax1'+rq).val().replace(new RegExp(',', 'g'),''));
		var v = parseFloat($('#fVAT'+rq).val().replace(new RegExp(',', 'g'),''));
		var w = parseFloat($(this).val().replace(new RegExp(',', 'g'),''));
		var sum = 0;
		if(!isNaN(a)) {
			sum = sum + a;
			if(!isNaN(v)) { sum = sum + (a*v/100); $('#vat'+rq).val(a*v/100); }
			if(!isNaN(t)) { sum = sum + (a*t/100); $('#othertax1'+rq).val(a*t/100); }
			if(!isNaN(w)) { sum = sum - (a*w/100); $('#withholdingtax'+rq).val(a*w/100); }
			if(!isNaN(sum)) {
				$('#fLineTotal'+rq).val($.trim(money_format('%i',sum).replace("USD","")));
			}
		}
		if(document.getElementById('spnd'+rq)) {
			// $('#spnd'+rq+'>.wt').attr('innerHTML',w);
			$('#spnd'+rq+'>.wt').attr('innerHTML',$('#withholdingtax'+rq).val());
			$('#spnd'+rq+'>.lt').attr('innerHTML',$.trim(money_format('%i',sum).replace("USD","")));
		}
		settotal();*/
    });

    $('textarea[name="tDescription\[\]"]').change(function() {
        var rq = $(this).attr('id').replace('tDescription','');
        if(document.getElementById('spnd'+rq)) {
            if($.trim($(this).val()) != '') $('#spnd'+rq+'>.td').attr('innerHTML',$.trim($(this).val()));
        }
    });

    $('[name="vUnitOfMeasure\[\]"]').change(function() {
        var rq = $(this).attr('id').replace('vUnitOfMeasure','');
        if(document.getElementById('spnd'+rq)) {
            // if($.trim($(this).val()) != '')
            $('#spnd'+rq+'>.um').attr('innerHTML',$.trim($(this).val()));
        }
    });

    $('select[name="invoiceType\[\]"]').change(function() {
        var rq = $(this).attr('id').replace('eInvoiceType','');
        if(document.getElementById('spnd'+rq)) {
            if($.trim($(this).val()) != '') $('#spnd'+rq+'>.ot').attr('innerHTML',$.trim($(this).val()));
        }
        //
        /*if($(this).val() == 'Discount' || $(this).val() == 'Charge') {
			// alert($(this).closest('table[id^="tbl"]').find('.ndcf').closest('input').length);
			$(this).closest('table[id^="tbl"]').find('.ndcf').hide();
			$(this).closest('table[id^="tbl"]').find('.ndcf').parent('td').next('td').hide();
			$(this).closest('table[id^="tbl"]').find('input[id^="iQuantity"]').parent('td').attr('width','285px');
		} else {
			$(this).closest('table[id^="tbl"]').find('.ndcf').show();
			$(this).closest('table[id^="tbl"]').find('.ndcf').parent('td').next('td').show();
			$(this).closest('table[id^="tbl"]').find('input[id^="iQuantity"]').parent('td').attr('width','154px');
		}*/
        if($(this).val() == 'Discount' || $(this).val() == 'Charge') {
			$('#spnd'+rq+'>.ot').attr('innerHTML', '');
            // alert($(this).closest('table[id^="tbl"]').find('.ndcf').closest('input').length);
            $(this).closest('table[id^="tbl"]').find('.ndcf').hide();
            $(this).closest('table[id^="tbl"]').find('.ndcf').parent('td').hide();
            $(this).closest('table[id^="tbl"]').find('.ndcf').parent('td').next('td').hide();
            // $(this).closest('table[id^="tbl"]').find('input[id^="iQuantity"]').parent('td').attr('width','1');
            $(this).closest('table[id^="tbl"]').find('.dcr').parent('td').attr('width','12.5%'); 	//
            $(this).closest('table[id^="tbl"]').find('.dcr').html('Rate : &nbsp;<font class="reqmsg">*</font>');
            $(this).closest('table[id^="tbl"]').find('[name="eSublineType\[\]"]').val('');
            $(this).closest('table[id^="tbl"]').find('[name="eSublineType\[\]"]').trigger('change');
        } else {
            $(this).closest('table[id^="tbl"]').find('.ndcf').show();
            $(this).closest('table[id^="tbl"]').find('.ndcf').parent('td').show();
            $(this).closest('table[id^="tbl"]').find('.ndcf').parent('td').next('td').show();
            // $(this).closest('table[id^="tbl"]').find('input[id^="iQuantity"]').parent('td').attr('width','154px');
            $(this).closest('table[id^="tbl"]').find('.dcr').parent('td').attr('width','111');
            $(this).closest('table[id^="tbl"]').find('.dcr').html('Price : &nbsp;<font class="reqmsg">*</font>');
        }
    //var id = $(this).attr('id').replace('envoiceType','');
    //$('div[id*="Div"]').find('[name="fPrice\[\]"]').trigger('blur');
    });
    // ----------
	$('#eInvoiceType'+j).trigger('change');
    $('div[id*="Div"]').find('[name="fPrice\[\]"]').trigger('blur');
    $('#eInvoiceType'+ln).trigger('blur');

    i = i+1;
    $(document).ready(function() {
        $(function() {
            var ead=10;
            $('#pane2').jScrollPane({
                showArrows:true,
                scrollbarWidth: 15,
                arrowSize: 15,
                el:'div.middle-container',
                eladd:ead
            });
        });
    });
    //----------------------
    settotal();
}

function addRow(typ)
{
	var noadd = false;
	$.each($('.ot'), function(i,el) {
		if($.trim($(this).html().toLowerCase()) == 'discount' || $.trim($(this).html().toLowerCase()) == 'charge') {
			noadd = true;
		}
	});
	if(noadd) {
		alert(LBL_NO_MORE_ITEMS_MSG);
		return false;
	}
	$('#adb').show();
    var j = i;
    var invoiceType = invType;
    invoiceType = invoiceType.replace('id="eInvoiceType"',"id='eInvoiceType"+i+"'");
    invoiceType = invoiceType.replace('id=eInvoiceType',"id='eInvoiceType"+i+"'");
    invoiceType = invoiceType.replace('id="eInvoiceType0"',"id='eInvoiceType"+i+"'");
    invoiceType = invoiceType.replace("id='eInvoiceType1'","id='eInvoiceType"+i+"'");
    invoiceType = invoiceType.replace("id='eInvoiceType2'","id='eInvoiceType"+i+"'");
    invoiceType = invoiceType.replace("id='eInvoiceType3'","id='eInvoiceType"+i+"'");
    //
    var uoms = uom;
    uoms = uoms.replace('id="vUnitOfMeasure"',"id='vUnitOfMeasure"+i+"'");
    uoms = uoms.replace('id=vUnitOfMeasure',"id='vUnitOfMeasure"+i+"'");
    uoms = uoms.replace('id="vUnitOfMeasure0"',"id='vUnitOfMeasure"+i+"'");
    uoms = uoms.replace("id='vUnitOfMeasure1'","id='vUnitOfMeasure"+i+"'");
    uoms = uoms.replace("id='vUnitOfMeasure2'","id='vUnitOfMeasure"+i+"'");
    uoms = uoms.replace("id='vUnitOfMeasure3'","id='vUnitOfMeasure"+i+"'");
    //
    var ni = document.getElementById('addNew');
    var numi=document.getElementById('mdiv');
    var num = (parseInt(document.getElementById('mdiv').value) -parseInt(1))+ parseInt(2);
    // alert(num);
    numi.value = num;
    if(document.getElementById('vUnitOfMeasure'+cr)) {
        if($('#vUnitOfMeasure'+cr) && $('#vUnitOfMeasure'+cr) != 'undefined') {
            if(($("#frmadd").validate().element('#fPrice'+cr) && $("#frmadd").validate().element('#fAmount'+cr) && $("#frmadd").validate().element('#fLineTotal'+cr)) || ($("#frmadd").validate().element('#fPrice'+cr) && ($('#eInvoiceType'+cr).val()=='Discount' || $('#eInvoiceType'+cr).val()=='Charge'))) {
            //
            } else {
                return false;
            }
        }
    }
    for(var h=0; h<i; h++) {
        if(document.getElementById('vUnitOfMeasure'+h)) {
            if($("#frmadd").validate().element('#fPrice'+h)==false || $("#frmadd").validate().element('#fAmount'+h)==false || $("#frmadd").validate().element('#fLineTotal'+h)==false) {
                $('#Div'+h).attr('innerHTML','');
            }
        }
    }

    /*var ld = j;
	if(document.getElementById('vUnitOfMeasure'+ld)) {
		//if($("#frmadd").validate().element('#vUnitOfMeasure'+ld)==false || $("#frmadd").validate().element('#fAmount'+ld)==false || $("#frmadd").validate().element('#fLineTotal'+ld)==false) {
		//	$('#Div'+ld).attr('innerHTML','');
		//}
	}*/

    if(edt != 'y') {
        cr = i;
    }
    $('div [id*="Div"]').hide();

    if(typeof typ == 'undefined' || typ == null || typ == '' || typ!='n') {
        var newdiv = document.createElement('div');
        var divIdName = "Div"+j; 	// num
        newdiv.setAttribute('id',divIdName);
        //newdiv.innerHTML ="<table id='tbl"+j+"' width='100%' border='0' cellspacing='0' class='black'><tr><td><table width='100%' border='0' cellspacing='5' cellpadding='0'><tr><td width='108'>"+LBL_LINE_TYPE+" :&nbsp;<font class='reqmsg'>*</font></td><td width='281'>"+invoiceType+"</td><td width='122'>"+LBL_CURRENCY+" : &nbsp;</td><td><b>"+currency+"</b></td></tr><tr><td valign='top'>"+LBL_DESCRIPTION+" : </td><td><textarea name='tDescription[]' id='tDescription"+i+"' class='input-rag' style='width:188px; height: 73px;'  ></textarea></td><td valign='top'><span class='ndcf'>"+LBL_UNIT_MEASURE+" :&nbsp;<font class='reqmsg'>*</font></span></td><td valign='top'>"+uoms+"</td></tr></table></td></tr><tr><td><table width='100%' border='0' cellspacing='5' cellpadding='0'><tr><td width='108'><span class='ndcf'>"+LBL_QUANTITY+" :&nbsp;<font class='reqmsg'>*</font></span></td><td width='154'><input type='text' name='iQuantity[]' id='iQuantity"+i+"' class='input-rag required digits' style='width:117px;' title='"+LBL_ENTER+" "+LBL_QUANTITY+"' /></td><td width='111'><span class='dcr'>"+LBL_PRICE+" :&nbsp;<font class='reqmsg'>*</font></span></td><td width='149'><input type='text' name='fPrice[]' id='fPrice"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_PRICE+"' /></td><td><span class='ndcf'>"+LBL_AMOUNT+" :&nbsp;<font class='reqmsg'>*</font></span></td><td><input type='text' name='fAmount[]' id='fAmount"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_AMOUNT+"' readonly='readonly' /></td></tr><tr><td><span class='ndcf'>"+LBL_VAT+" "+LBL_RATE+" (%):&nbsp;<font class='reqmsg'>*</font></span></td><td><input type='text' name='fVAT[]' id='fVAT"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_VAT+"' value='"+vat+"' /></td><td><span class='ndcf'>"+LBL_VAT+" :&nbsp;<font class='reqmsg'>*</font></span></td><td><input type='text' name='vat' id='vat"+i+"' class='input-rag decimals' style='width:117px;' title='"+LBL_VAT+"' readonly='readonly' /></td><td><span class='ndcf'>"+LBL_OTHER_TAX+" "+LBL_RATE+" (%):</span></td><td><input type='text' name='fOtherTax1[]' id='fOtherTax1"+i+"' class='input-rag decimals' style='width:117px;' value='"+otax+"' /></td></tr><tr><td><span class='ndcf'>"+LBL_OTHER_TAX+" : </span></td><td><input type='text' name='othertax1' id='othertax1"+i+"' class='input-rag decimals' style='width:117px;' readonly='readonly' /></td><td><span class='ndcf'>"+LBL_WITH_HOLDING_TAX+" "+LBL_RATE+" (%): </span></td><td><input type='text' name='fWithHoldingTax[]' id='fWithHoldingTax"+i+"' class='input-rag decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_WITH_HOLDING_TAX+"' value='"+wtax+"' /></td><td><span class='ndcf'>"+LBL_WITH_HOLDING_TAX+" : </span></td><td><input type='text' name='withholdingtax' id='withholdingtax"+i+"' class='input-rag decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_WITH_HOLDING_TAX+"' readonly='readonly' /></td><tr><td><span class='ndcf'>"+LBL_LINE_TOTAL+" : </span></td><td><input type='text' name='fLineTotal[]' id='fLineTotal"+i+"' class='input-rag decimals' style='width:117px;' readonly='readonly' /></td><td><span class='ndcf'>"+LBL_RECEIPT+" : </span></td><td><input type='text' name='tReceipt[]' id='tReceipt"+i+"' class='input-rag' style='width:117px;' /></td><td colspan='2'>&nbsp;</td></tr><tr><td colspan='3'>&nbsp;</td></tr><tr><td colspan='2'><span class='ndcf'><b>"+LBL_DISCOUNT+" / "+LBL_CHARGE+" </b> &nbsp; <select id='eSublineType"+i+"' name='eSublineType[]'><option value=''>None</option><option value='Discount'>Discount</option><option value='Charge'>Charge</option></select></span></td><td colspan='4'>&nbsp;</td></tr><tr><td><span class='ndcf'>"+LBL_QUANTITY+" : </span></td><td><input type='text' name='iSubQuantity[]' id='iSubQuantity"+i+"' class='input-rag decimals' style='width:117px;' value='' /></td><td><span class='ndcf'>"+LBL_RATE+" : </span></td><td><input type='text' name='fSubRate[]' id='fSubRate"+i+"' class='input-rag' style='width:117px;' value='' /></td><td colspan='2'><input type='hidden' name='fSubAmount[]' id='fSubAmount"+i+"' class='input-rag' style='width:117px;' value='' /></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td align='right'><img src='"+SITE_IMAGES+"sm_images/btn-close.gif' name='close' value='close' onclick=\"$('#adb').hide(); closeRow(\'"+j+"\')\" /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr><tr><td colspan='6'><hr style='border-style: dashed;'></td></tr></table>";
        newdiv.innerHTML ="<table id='tbl"+j+"' width='100%' border='0' cellspacing='0' class='black'><tr><td><table width='100%' border='0' cellspacing='5' cellpadding='0'><tr><td width='108'>"+LBL_LINE_TYPE+" :&nbsp;<font class='reqmsg'>*</font></td><td width='281'>"+invoiceType+"</td><td width='122'>"+LBL_PART_NO+" : &nbsp;</td><td><input type='text' name='vPartNo[]' id='vPartNo"+i+"'></td></tr><tr><td valign='top'>"+LBL_DESCRIPTION+" : </td><td><textarea name='tDescription[]' id='tDescription"+i+"' class='input-rag' style='width:188px; height: 73px;'  ></textarea></td><td valign='top'><span class='ndcf'>"+LBL_UNIT_MEASURE+" :&nbsp;<font class='reqmsg'></font></span></td><td valign='top'>"+uoms+"</td></tr></table></td></tr><tr><td><table width='100%' border='0' cellspacing='5' cellpadding='0'><tr><td width='108'><span class='ndcf'>"+LBL_QUANTITY+" :&nbsp;<font class='reqmsg'>*</font></span></td><td width='154'><input type='text' name='iQuantity[]' id='iQuantity"+i+"' class='input-rag required digits' style='width:117px;' title='"+LBL_ENTER+" "+LBL_QUANTITY+"' /></td><td width='111'><span class='dcr'>"+LBL_PRICE+" :&nbsp;<font class='reqmsg'>*</font></span></td><td width='149'><input type='text' name='fPrice[]' id='fPrice"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_PRICE+"' /></td><td><span class='ndcf'>"+LBL_AMOUNT+" :&nbsp;<font class='reqmsg'>*</font></span></td><td><input type='text' name='fAmount[]' id='fAmount"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_AMOUNT+"' readonly='readonly' value='0' /></td></tr><tr><td><span class='ndcf'>"+LBL_VAT+" "+LBL_RATE+" (%):&nbsp;<font class='reqmsg'>*</font></span></td><td><input type='text' name='fVAT[]' id='fVAT"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_VAT+"' value='"+vat+"' /></td><td><span class='ndcf'>"+LBL_VAT+" :&nbsp;<font class='reqmsg'>*</font></span></td><td><input type='text' name='vat' id='vat"+i+"' class='input-rag decimals' style='width:117px;' title='"+LBL_VAT+"' readonly='readonly' /></td><td><span class='ndcf'>"+LBL_OTHER_TAX+" "+LBL_RATE+" (%):</span></td><td><input type='text' name='fOtherTax1[]' id='fOtherTax1"+i+"' class='input-rag decimals' style='width:117px;' value='"+otax+"' /></td></tr><tr><td><span class='ndcf'>"+LBL_OTHER_TAX+" : </span></td><td><input type='text' name='othertax1' id='othertax1"+i+"' class='input-rag decimals' style='width:117px;' readonly='readonly' /></td><td><span class='ndcf'>"+LBL_WITH_HOLDING_TAX+" "+LBL_RATE+" (%): </span></td><td><input type='text' name='fWithHoldingTax[]' id='fWithHoldingTax"+i+"' class='input-rag decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_WITH_HOLDING_TAX+"' value='"+wtax+"' /></td><td><span class='ndcf'>"+LBL_WITH_HOLDING_TAX+" : </span></td><td><input type='text' name='withholdingtax' id='withholdingtax"+i+"' class='input-rag decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_WITH_HOLDING_TAX+"' readonly='readonly' /></td><tr><td><span class='ndcf'>"+LBL_LINE_TOTAL+" : </span></td><td><input type='text' name='fLineTotal[]' id='fLineTotal"+i+"' class='input-rag decimals' style='width:117px;' readonly='readonly' /></td><td><span class='ndcf'>"+LBL_RECEIPT+" : </span></td><td><input type='text' name='tReceipt[]' id='tReceipt"+i+"' class='input-rag' style='width:117px;' /></td><td>"+LBL_CURRENCY+" : </td><td><b>"+currency+"</b></td></tr><tr><td colspan='3'>&nbsp;</td></tr><tr><td colspan='2'><span class='ndcf'><b>"+LBL_DISCOUNT+" / "+LBL_CHARGE+" </b> &nbsp; <select id='eSublineType"+i+"' name='eSublineType[]'><option value=''>None</option><option value='Discount'>Discount</option><option value='Charge'>Charge</option></select></span></td><td colspan='4'>&nbsp;</td></tr><tr><td><span class='ndcf'>"+LBL_QUANTITY+" : </span></td><td><input type='text' name='iSubQuantity[]' id='iSubQuantity"+i+"' class='input-rag decimals' style='width:117px;' value='' /></td><td><span class='ndcf'>"+LBL_RATE+" : </span></td><td><input type='text' name='fSubRate[]' id='fSubRate"+i+"' class='input-rag' style='width:117px;' value='' /></td><td colspan='2'><input type='hidden' name='fSubAmount[]' id='fSubAmount"+i+"' class='input-rag' style='width:117px;' value='' /></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td align='right'><img src='"+SITE_IMAGES+"sm_images/btn-close.gif' name='close' value='close' onclick=\"$('#adb').hide(); closeRow(\'"+j+"\')\" /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr><tr><td colspan='6'><hr style='border-style: dashed;'></td></tr></table>";
        // &nbsp; <img src='"+SITE_IMAGES+"sm_images/btn-remove.gif' name='remove' value='remove' onClick=\"removeRow(\'"+divIdName+"\')\" />
        //newdiv.innerHTML ="<table width='100%' border='0' cellspacing='0' class='black'><tr><td><table width='100%' border='0' cellspacing='5' cellpadding='0'><tr><td width='108'>"+LBL_LINE_TYPE+" :&nbsp;<font class='reqmsg'>*</font></td><td width='281'>"+invoiceType+"</td><td width='122'>"+LBL_ITEM_CODE+" :&nbsp;<font class='reqmsg'>*</font></td><td><input type='text' name='vItemCode[]' id='vItemCode"+i+"' class='input-rag required' style='width:188px;' title='"+LBL_ENTER+" "+LBL_ITEM_CODE+"' /></td></tr><tr><td valign='top'>"+LBL_INVOICE_DESCRIPTION+" : </td><td><textarea name='tDescription[]' id='tDescription"+i+"' class='input-rag' style='width:188px; height: 73px;'  ></textarea></td><td valign='top'>"+LBL_UNIT_MEASURE+" :&nbsp;<font class='reqmsg'>*</font></td><td valign='top'><input type='text' name='vUnitOfMeasure[]' id='vUnitOfMeasure"+i+"' class='input-rag required' style='width:188px;' title='"+LBL_ENTER+" "+LBL_UNIT_MEASURE+"' /></td></tr></table></td></tr><tr><td><table width='100%' border='0' cellspacing='5' cellpadding='0'><tr><td width='108'>"+LBL_QUANTITY+" :&nbsp;<font class='reqmsg'>*</font></td><td width='154'><input type='text' name='iQuantity[]' id='iQuantity"+i+"' class='input-rag required digits' style='width:117px;' title='"+LBL_ENTER+" "+LBL_QUANTITY+"' /></td><td width='111'>"+LBL_PRICE+" :&nbsp;<font class='reqmsg'>*</font></td><td width='149'><input type='text' name='fPrice[]' id='fPrice"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_PRICE+"' /></td><td>"+LBL_AMOUNT+" :&nbsp;<font class='reqmsg'>*</font></td><td><input type='text' name='fAmount[]' id='fAmount"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_AMOUNT+"' /></td></tr><tr><td>"+LBL_VAT+" :&nbsp;<font class='reqmsg'>*</font></td><td><input type='text' name='fVAT[]' id='fVAT"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_VAT+"' /></td><td>"+LBL_OTHER_TAX+":</td><td><input type='text' name='fOtherTax1[]' id='fOtherTax1"+i+"' class='input-rag decimals' style='width:117px;' /></td><td>"+LBL_LINE_TOTAL+" : </td><td><input type='text' name='fLineTotal[]' id='fLineTotal "+i+"' class='input-rag decimals' style='width:117px;' /></td></tr><tr><td>"+LBL_WITH_HOLDING_TAX+" : &nbsp;<font class='reqmsg'>*</font></td><td><input type='text' name='fWithHoldingTax[]' id='fWithHoldingTax"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_WITH_HOLDING_TAX+"' /></td><td>"+LBL_PURCHASE_ORDER+" : &nbsp;<font class='reqmsg'>*</font></td><td><input type='text' name='purchaseOrder' class='input-rag' id='purchaseOrder"+i+"' title='"+LBL_ENTER+" "+LBL_PURCHASE_ORDER+"' style='width:117px;' /><input type='hidden' name='iPurchaseOrderID[]' id='iPurchaseOrderID"+i+"' class='input-rag' style='width:117px;' title='"+LBL_ENTER+" "+LBL_PURCHASE_ORDER+"' /></td><td>"+LBL_PO_REL_LINE+" : &nbsp;<font class='reqmsg'>*</font></td><td><input type='text' name='POItemCode' class='input-rag' id='POItemCode"+i+"' title='"+LBL_ENTER+" "+LBL_PO_REL_LINE+"' style='width:117px;' /><input type='hidden' name='iRelatedPurchaseOrderLineID[]' id='iRelatedPurchaseOrderLineID"+i+"' class='input-rag' style='width:117px;' title='"+LBL_ENTER+" "+LBL_PO_REL_LINE+"' /></td></tr><tr><td>"+LBL_RECEIPT+" : </td><td><input type='text' name='tReceipt[]' id='tReceipt"+i+"' class='input-rag' style='width:117px;' /></td><td colspan='4'>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td align='right'><img src='"+SITE_IMAGES+"sm_images/btn-remove.gif' name='remove' value='remove' onClick=\"removeRow(\'"+divIdName+"\')\" /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr><tr><td colspan='6'><hr style='border-style: dashed;'></td></tr></table>";
        ni.appendChild(newdiv);
    }

    function findPOValue(li) {
        if( li == null ) return alert("No match!");
        if( !!li.extra ) var sValue = li.extra[0];
        else var sValue = li.selectValue;

        var totVal = sValue;
        var totValID;
        var totValRes;
        totVal = totVal.split('</span>');
        totValID = totVal[0].replace("<span style='display:none'>","");
        totValRes = totVal[1];
        var iOrgId=totValID.split('_');
        totValID=iOrgId[0];
        iOrgId=iOrgId[1];
        $('#iRelatedPurchaseOrderLineID'+j+'').val(totValID);
        var url = SITE_URL+"index.php?file=m-aj_getItemDetails";
        var pars = "&table="+PRJ_DB_PREFIX+"_purchase_order_line"+"&iId=iOrderLineID"+"&id="+totValID+"&cnt="+j+"&fields=all"+"&jtbl=&where=";
        //alert(url+pars); return false;
        $('#spn').load(url+pars);
    // $.ajax({type:"post", url:url, data:pars, success:getDetails});
    //alert(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+iOrgId+"&iUserID="+totValID);
    //$('#OrgStatus_Div').load(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+totValID);		// +"&iOrgId="+iOrgId
    }

    function selectPOItem(li) {
        findPOValue(li);
    }

    function formatItem(row) {
        var totVal = row[0];
        var totValID;
        var totValRes;
        totVal = totVal.split('</span>');
        totValID = totVal[0].replace("<span style='display:none'>");
        totValRes = totVal[1];
        return totValRes;
    }
    function findUserValue(li) {
        if( li == null ) return alert("No match!");
        if( !!li.extra ) var sValue = li.extra[0];
        else var sValue = li.selectValue;

        var totVal = sValue;
        var totValID;
        var totValRes;
        totVal = totVal.split('</span>');
        totValID = totVal[0].replace("<span style='display:none'>","");
        totValRes = totVal[1];
        var iOrgId=totValID.split('_');
        totValID=iOrgId[0];
        iOrgId=iOrgId[1];
    //	alert(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+iOrgId+"&iUserID="+totValID);
    //$('#OrgStatus_Div').load(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+totValID);		// +"&iOrgId="+iOrgId
    }
    function selectUsrItem(li) {
        findUserValue(li);
    }

    function setuser()
    {
        $("#POItemCode"+j+"").autocomplete(
            SITE_URL+"index.php?file=u-aj_getInvPoItem&iPOId="+$("#iPurchaseOrderID"+j+"").val(),
            {
                delay:10,
                minChars:1,
                matchSubset:1,
                matchContains:1,
                cacheLength:10,
                onItemSelect:selectPOItem,
                onFindValue:findPOValue,
                formatItem:formatItem,
                autoFill:false
            }
            );
    }

    function findValue(li) {
        if( li == null ) return alert("No match!");
        if( !!li.extra ) var sValue = li.extra[0];
        else var sValue = li.selectValue;

        var totVal = sValue;
        var totValID;
        var totValRes;
        totVal = totVal.split('</span>');
        totValID = totVal[0].replace("<span style='display:none'>","");
        totValRes = totVal[1];
        $("#iPurchaseOrderID"+j+"").val(totValID);
        //$('#result').load(SITE_URL+"index.php?file=u-aj_getOrganizationUser&type=user&iId="+totValID+"");
        //$('#OrgStatus_Div').load(SITE_URL+"index.php?file=or-aj_getOrganizationStatus&type=user&iId="+totValID+"");
        if(totValID != '') {
            setuser();
        }
    }
    function selectItem(li) {
        findValue(li);
    }

    $("#purchaseOrder"+i+"").autocomplete(
        SITE_URL+"index.php?file=u-aj_getInvPo",
        {
            delay:10,
            minChars:1,
            matchSubset:1,
            matchContains:1,
            cacheLength:10,
            onItemSelect:selectItem,
            onFindValue:findValue,
            formatItem:formatItem,
            autoFill:false
        }
        );
    i = i + 1;
    $(document).ready( function() {
        $(function() {
            var ead=10;
            $('#pane2').jScrollPane({
                showArrows:true,
                scrollbarWidth: 15,
                arrowSize: 15,
                el:'div.middle-container',
                eladd:ead
            });
        });
    });

    var lin = j; 	//j-1
    var ln = j-1;
    if(ad=='y') { 	// && edt!='y' && document.getElementById('eInvoiceType'+lin)
        //$('#dlines').append("<span id='spnd"+lin+"'><span style='display:inline-block; width:30px;' class='ar'> <img src='"+SITE_IMAGES+"sm_images/arrow-orange.gif' /> &nbsp; </span><span style='display:inline-block; width:70px;' class='ot'>"+$('#eInvoiceType'+lin).val()+"</span><span style='display:inline-block; width:150px;' class='td'>"+$('#tDescription'+lin).val()+"</span><span style='display:inline-block; width:110px;' class='um'>"+$('#vUnitOfMeasure'+lin).val()+"</span><span style='display:inline-block; width:50px;' class='iq'>"+$('#iQuantity'+lin).val()+"</span><span style='display:inline-block; width:50px;' class='fp'>"+$('#fPrice'+lin).val()+"</span><span style='display:inline-block; width:53px;' class='fa'>"+$('#fAmount'+lin).val()+"</span><span style='display:inline-block; width:53px;' class='fv'>"+$('#fVAT'+lin).val()+"</span><span style='display:inline-block; width:75px;' class='ox'>"+$('#fOtherTax1'+lin).val()+"</span><span style='display:inline-block; width:101px;' class='wt'>"+$('#fWithHoldingTax'+lin).val()+"</span><span style='display:inline-block; width:100px;' class='lt'>"+$('#fLineTotal'+lin).val()+"</span><span style='display:inline-block;' class='at'><img src='"+SITE_IMAGES+"sm_images/icon-pen.gif' onclick='edt=\"y\"; shwtbl("+lin+");' />&nbsp;<img src='"+SITE_IMAGES+"sm_images/icon-cancel.gif' onclick='deltbl("+lin+");' /></span><div style='height:1px;'>&nbsp;</div></span>");
        if(document.getElementById('eInvoiceType'+ln) && !document.getElementById('spnd'+ln)) {
			// $('#dlines').append("<span id='spnd"+ln+"'><span style='display:table-cell; line-height:10px; width:1px; padding:1px; margin:0px;' class='ar'> <img src='"+SITE_IMAGES+"sm_images/arrow-orange.gif' /> &nbsp; </span><span style='display:table-cell; height:10px; width:50px; padding:1px; margin:0px;' class='ot'>"+$('#eInvoiceType'+ln).val()+"</span><span style='display:table-cell; height:10px; width:110px; padding:1px; margin:0px;' class='td'>"+$('#tDescription'+ln).val()+"</span><span style='display:table-cell; height:10px; width:55px; padding:1px; margin:0px;' class='um'>"+$('#vUnitOfMeasure'+ln).val()+"</span><span style='display:table-cell; height:10px; width:70px; padding:1px; margin:0px; text-align:right;' class='iq'>"+$('#iQuantity'+ln).val()+"</span><span style='display:table-cell; height:10px; width:70px; padding:1px; margin:0px; text-align:right;' class='fp'>"+$('#fPrice'+ln).val()+"</span><span style='display:table-cell; height:10px; width:100px; padding:1px; margin:0px; text-align:right;' class='fa'>"+$('#fAmount'+ln).val()+"</span><span style='display:table-cell; height:10px; width:50px; padding:1px; margin:0px; text-align:right;' class='fv'>"+$('#fVAT'+ln).val()+"</span><span style='display:table-cell; height:10px; width:50px; padding:1px; margin:0px; text-align:right;' class='ox'>"+$('#fOtherTax1'+ln).val()+"</span><span style='display:table-cell; height:10px; width:79px; padding:1px; margin:0px; text-align:right;' class='wt'>"+$('#fWithHoldingTax'+ln).val()+"</span><span style='display:table-cell; height:10px; width:100px; padding:1px; margin:0px; text-align:right;' class='lt'>"+$('#fLineTotal'+ln).val()+"</span><span style='display:table-cell; height:10px; padding:1px; margin:0px;' class='at'> &nbsp; <img src='"+SITE_IMAGES+"sm_images/icon-pen.gif' onclick='edt=\"y\"; shwtbl("+ln+");' />&nbsp;<img src='"+SITE_IMAGES+"sm_images/icon-cancel.gif' onclick='deltbl("+ln+");' /></span><div style='height:1px;'>&nbsp;</div></span> <div id='subli' style='padding-left:19px; margin-bottom:10px;'><span style='display:inline-block; height:10px; width:171px; padding-left:57px; margin:0px; text-align:left;' class='sltyp'>"+$('#eSublineType'+ln).val()+" </span> <span class='slqt' style='display:inline-block; height:10px; width:75px; margin:0px; text-align:right;'><span class='sqt'>"+$('#iSubQuantity'+ln).val()+"</span></span> &nbsp;&nbsp;&nbsp; <span class='slrt' style='display:inline-block; height:10px; width:63px; margin:0px; text-align:right;'><span class='srt'>"+$('#fSubRate'+ln).val()+"</span></span> &nbsp;&nbsp;&nbsp; <span class='sltl' style='display:inline-block; height:10px; width:97px; margin:0px; text-align:right;'>"+(($('#eSublineType'+ln).val() == 'Discount')? "" : "")+"<span class='stl'>"+$('#fSubAmount'+ln).val()+"</span>"+(($('#eSublineType'+ln).val() == 'Discount')? "" : "")+"</span><span class='slvt' style='display:inline-block; height:10px; width:57px; margin:0px; text-align:right;'><span class='slv'></span></span><span class='slot' style='display:inline-block; height:10px; width:57px; margin:0px; text-align:right;'><span class='slo'></span></span><span class='slwt' style='display:inline-block; height:10px; width:87px; margin:0px; text-align:right;'><span class='slw'></span></span><span class='sltt' style='display:inline-block; height:10px; width:104px; margin:0px; text-align:right;'><span class='slf'></span></span></div>");
            $('#dlines').append("<div id='spnd"+ln+"'><span style='display:inline-block; line-height:0px; width:5px; padding:0px; margin-right:5px;' class='ar'><img src='"+SITE_IMAGES+"sm_images/arrow-orange.gif' /></span><span style='display:none; height:10px; width:50px; padding:1px; margin:0px;' class='ot'>"+$('#eInvoiceType'+ln).val()+"</span><span style='display:inline-block; height:10px; width:121px; padding:1px; margin:0px;' class='td'>"+$('#tDescription'+ln).val()+"</span><span style='display:inline-block; height:10px; width:63px; padding:1px; margin:0px;' class='um'>"+$('#vPartNo'+ln).val()+"</span><span style='display:inline-block; height:10px; width:70px; padding:1px; margin:0px;' class='um'>"+(($('#eInvoiceType'+ln).val()=='Discount' || $('#eInvoiceType'+ln).val()=='Charge')? '' : $('#vUnitOfMeasure'+ln).val())+"</span><span style='display:inline-block; height:10px; width:38px; padding:1px; margin:0px; text-align:right;' class='iq'>"+$('#iQuantity'+ln).val()+"</span><span style='display:inline-block; height:10px; width:"+(($('#eInvoiceType'+ln).val()=='Discount' || $('#eInvoiceType'+ln).val()=='Charge')? '88' : '77')+"px; padding:1px; margin:0px; text-align:right;' class='fp'>"+parseFloat($('#fPrice'+ln).val()).toFixed(2)+"</span><span style='display:inline-block; height:10px; width:"+(($('#eInvoiceType'+ln).val()=='Discount' || $('#eInvoiceType'+ln).val()=='Charge')? '118' : '129')+"px; padding:1px; margin:0px; text-align:right;' class='fa'>"+$('#fAmount'+ln).val()+"</span><span style='display:inline-block; height:10px; width:74px; padding:1px; margin:0px; text-align:right;' class='fv'>"+parseFloat($('#vat'+ln).val()).toFixed(2)+"</span><span style='display:inline-block; height:10px; width:50px; padding:1px; margin:0px; text-align:right;display:none;' class='ox'>"+parseFloat($('#othertax1'+ln).val()).toFixed(2)+"</span><span style='display:inline-block; height:10px; width:84px; padding:1px; margin:0px; text-align:right;' class='wt'>"+parseFloat($('#withholdingtax'+ln).val()).toFixed(2)+"</span><span style='display:inline-block; height:10px; width:119px; padding:1px; margin:0px; text-align:right;' class='lt'>"+$('#fLineTotal'+ln).val()+"</span><span style='display:inline-block; height:10px; padding:1px; margin:0px;' class='at'>  &nbsp; <img src='"+SITE_IMAGES+"sm_images/icon-pen.gif' onclick='edt=\"y\"; shwtbl("+ln+");' />&nbsp;<img src='"+SITE_IMAGES+"sm_images/icon-cancel.gif' onclick='deltbl("+ln+");' /></span> <div id='subli' style='padding-left:12px; margin-bottom:10px; "+(($('#eInvoiceType'+ln).val()=='Discount' || $('#eInvoiceType'+ln).val()=='Charge' || $('#eSublineType'+ln).val()=='')? 'display:none;' : '')+"'><span style='display:inline-block; height:10px; width:180px; margin:0px; text-align:left;' class='sltyp'>"+$('#eSublineType'+ln).val()+" </span> <span class='slqt' style='display:inline-block; height:10px; width:114px; margin:0px; text-align:right;'><span class='sqt'>"+$('#iSubQuantity'+ln).val()+"</span></span> &nbsp;&nbsp;&nbsp;<span class='slrt' style='display:inline-block; height:10px; width:77px; margin:0px; text-align:right;'><span class='srt'>"+parseFloat($('#fSubRate'+ln).val()).toFixed(2)+"%</span></span> &nbsp;&nbsp;&nbsp;<span class='sltl' style='display:inline-block; height:10px; width:109px; margin:0px; text-align:right;'>"+(($('#eSublineType'+ln).val() == 'Discount')? "" : "")+"<span class='stl'>"+parseFloat($('#fSubAmount'+ln).val()).toFixed(2)+"</span>"+(($('#eSublineType'+ln).val() == 'Discount')? "" : "")+"</span><span class='slvt' style='display:inline-block; height:10px; width:75px; margin:0px; text-align:right;'><span class='slv'></span></span><span class='slot' style='display:inline-block; height:10px; width:57px; margin:0px; text-align:right;display:none;'><span class='slo'></span></span><span class='slwt' style='display:inline-block; height:10px; width:86px; margin:0px; text-align:right;'><span class='slw'></span></span><span class='sltt' style='display:inline-block; height:10px; width:122px; margin:0px; text-align:right;'><span class='slf'></span></span></div></div>");
        }
        edt='y';
    } else if(edt=='y' && document.getElementById('eInvoiceType'+cr)) {
        // $("#spnd"+cr).attr('innerHTML',"<span style='display:table-cell; line-height:10px; width:1px; padding:1px; margin:0px;' class='ar'> <img src='"+SITE_IMAGES+"sm_images/arrow-orange.gif' /> &nbsp; </span><span style='display:table-cell; height:10px; width:50px; padding:1px; margin:0px;' class='ot'>"+$('#eInvoiceType'+cr).val()+"</span><span style='display:table-cell; height:10px; width:110px; padding:1px; margin:0px;' class='td'>"+$('#tDescription'+cr).val()+"</span><span style='display:table-cell; height:10px; width:55px; padding:1px; margin:0px;' class='um'>"+$('#vUnitOfMeasure'+cr).val()+"</span><span style='display:table-cell; height:10px; width:70px; padding:1px; margin:0px; text-align:right;' class='iq'>"+$('#iQuantity'+cr).val()+"</span><span style='display:table-cell; height:10px; width:70px; padding:1px; margin:0px; text-align:right;' class='fp'>"+$('#fPrice'+cr).val()+"</span><span style='display:table-cell; height:10px; width:100px; padding:1px; margin:0px; text-align:right;' class='fa'>"+$('#fAmount'+cr).val()+"</span><span style='display:table-cell; height:10px; width:50px; padding:1px; margin:0px; text-align:right;' class='fv'>"+$('#fVAT'+cr).val()+"</span><span style='display:table-cell; height:10px; width:50px; padding:1px; margin:0px; text-align:right;' class='ox'>"+$('#fOtherTax1'+cr).val()+"</span><span style='display:table-cell; height:10px; width:79px; padding:1px; margin:0px; text-align:right;' class='wt'>"+$('#fWithHoldingTax'+cr).val()+"</span><span style='display:table-cell; height:10px; width:100px; padding:1px; margin:0px; text-align:right;' class='lt'>"+$('#fLineTotal'+cr).val()+"</span><span style='display:table-cell; height:10px; padding:1px; margin:0px;' class='at'> &nbsp; <img src='"+SITE_IMAGES+"sm_images/icon-pen.gif' onclick='shwtbl("+cr+");' />&nbsp;<img src='"+SITE_IMAGES+"sm_images/icon-cancel.gif' onclick='deltbl("+cr+");' /></span><div style='height:1px;'>&nbsp;</div> <div id='subli' style='padding-left:19px; margin-bottom:10px;'><span style='display:inline-block; height:10px; width:171px; padding:1px; margin:0px; text-align:left;' class='sltyp'>"+$('#eSublineType'+cr).val()+" </span> <span class='slqt' style='display:inline-block; height:10px; width:75px; margin:0px; text-align:right;'><span class='sqt'>"+$('#iSubQuantity'+cr).val()+"</span></span> &nbsp;&nbsp;&nbsp; <span class='slrt' style='display:inline-block; height:10px; width:63px; margin:0px; text-align:right;'><span class='srt'>"+$('#fSubRate'+cr).val()+"</span></span> &nbsp;&nbsp;&nbsp; <span class='sltl' style='display:inline-block; height:10px; width:97px; margin:0px; text-align:right;'>"+(($('#eSublineType'+ln).val() == 'Discount')? "" : "")+"<span class='stl'>"+$('#fSubAmount'+cr).val()+"</span>"+(($('#eSublineType'+ln).val() == 'Discount')? "" : "")+"</span><span class='slvt' style='display:inline-block; height:10px; width:57px; margin:0px; text-align:right;'><span class='slv'></span></span><span class='slot' style='display:inline-block; height:10px; width:57px; margin:0px; text-align:right;'><span class='slo'></span></span><span class='slwt' style='display:inline-block; height:10px; width:87px; margin:0px; text-align:right;'><span class='slw'></span></span><span class='sltt' style='display:inline-block; height:10px; width:104px; margin:0px; text-align:right;'><span class='slf'></span></span></div>");
        $("#spnd"+cr).attr('innerHTML',"<span style='display:inline-block; line-height:0px; width:5px; padding:0px; margin-right:5px;' class='ar'><img src='"+SITE_IMAGES+"sm_images/arrow-orange.gif' /></span><span style='display:none; height:10px; width:49px; padding:1px; margin:0px;' class='ot'>"+$('#eInvoiceType'+cr).val()+"</span><span style='display:inline-block; height:10px; width:121px; padding:1px; margin:0px;' class='td'>"+$('#tDescription'+cr).val()+"</span><span style='display:inline-block; height:10px; width:63px; padding:1px; margin:0px;' class='um'>"+$('#vPartNo'+cr).val()+"</span><span style='display:inline-block; height:10px; width:70px; padding:1px; margin:0px;' class='um'>"+(($('#eInvoiceType'+cr).val()=='Discount' || $('#eInvoiceType'+cr).val()=='Charge')? '' : $('#vUnitOfMeasure'+cr).val())+"</span><span style='display:inline-block; height:10px; width:38px; padding:1px; margin:0px; text-align:right;' class='iq'>"+$('#iQuantity'+cr).val()+"</span><span style='display:inline-block; height:10px; width:"+(($('#eInvoiceType'+cr).val()=='Discount' || $('#eInvoiceType'+cr).val()=='Charge')? '88' : '77')+"px; padding:1px; margin:0px; text-align:right;' class='fp'>"+parseFloat($('#fPrice'+cr).val()).toFixed(2)+"</span><span style='display:inline-block; height:10px; width:"+(($('#eInvoiceType'+cr).val()=='Discount' || $('#eInvoiceType'+cr).val()=='Charge')? '118' : '129')+"px; padding:1px; margin:0px; text-align:right;' class='fa'>"+$('#fAmount'+cr).val()+"</span><span style='display:inline-block; height:10px; width:74px; padding:1px; margin:0px; text-align:right;' class='fv'>"+parseFloat($('#vat'+cr).val()).toFixed(2)+"</span><span style='display:inline-block; height:10px; width:50px; padding:1px; margin:0px; text-align:right;' class='ox'>"+parseFloat($('#othertax1'+cr).val()).toFixed(2)+"</span><span style='display:inline-block; height:10px; width:84px; padding:1px; margin:0px; text-align:right;' class='wt'>"+parseFloat($('#withholdingtax'+cr).val()).toFixed(2)+"</span><span style='display:inline-block; height:10px; width:119px; padding:1px; margin:0px; text-align:right;' class='lt'>"+$('#fLineTotal'+cr).val()+"</span><span style='display:inline-block; height:10px; padding:1px; margin:0px;' class='at'> &nbsp; <img src='"+SITE_IMAGES+"sm_images/icon-pen.gif' onclick='shwtbl("+cr+");' />&nbsp;<img src='"+SITE_IMAGES+"sm_images/icon-cancel.gif' onclick='deltbl("+cr+");' /></span> <div id='subli' style='padding-left:12px; margin-bottom:10px; "+(($('#eInvoiceType'+cr).val()=='Discount' || $('#eInvoiceType'+cr).val()=='Charge' || $('#eSublineType'+cr).val()=='')? 'display:none;' : '')+"'><span style='display:inline-block; height:10px; width:180px; margin:0px; text-align:left;' class='sltyp'>"+$('#eSublineType'+cr).val()+" </span> <span class='slqt' style='display:inline-block; height:10px; width:114px; margin:0px; text-align:right;'><span class='sqt'>"+$('#iSubQuantity'+cr).val()+"</span></span> &nbsp;&nbsp;&nbsp;<span class='slrt' style='display:inline-block; height:10px; width:77px; margin:0px; text-align:right;'><span class='srt'>"+parseFloat($('#fSubRate'+cr).val()).toFixed(2)+"%</span></span> &nbsp;&nbsp;&nbsp; <span class='sltl' style='display:inline-block; height:10px; width:109px; margin:0px; text-align:right;'>"+(($('#eSublineType'+ln).val() == 'Discount')? "" : "")+"<span class='stl'>"+parseFloat($('#fSubAmount'+cr).val()).toFixed(2)+"</span>"+(($('#eSublineType'+cr).val() == 'Discount')? "" : "")+"</span><span class='slvt' style='display:inline-block; height:10px; width:75px; margin:0px; text-align:right;'><span class='slv'></span></span><span class='slot' style='display:inline-block; height:10px; width:57px; margin:0px; text-align:right;display:none;'><span class='slo'></span></span><span class='slwt' style='display:inline-block; height:10px; width:86px; margin:0px; text-align:right;'><span class='slw'></span></span><span class='sltt' style='display:inline-block; height:10px; width:122px; margin:0px; text-align:right;'><span class='slf'></span></span></div>");
        edt='n';
    }
    cr = j;
    ad='n';

    $('input[name="fPrice\[\]"]').blur(function() {
        var rq = $(this).attr('id').replace('fPrice','');
        var type = $('#eInvoiceType'+rq).val();
        if($.trim(type)=='Discount' || $.trim(type)=='Charge') {
            var p = parseFloat($(this).val().replace(new RegExp(',', 'g'),'')).toFixed(2);
            $('#spnd'+rq+'>.iq').attr('innerHTML','');
            $('#spnd'+rq+'>.fp').attr('innerHTML', money_format('%i',parseFloat(p))+'%');
            $('#spnd'+rq+'>.fv').attr('innerHTML','');
            $('#spnd'+rq+'>.ox').attr('innerHTML','');
            $('#spnd'+rq+'>.wt').attr('innerHTML','');
            $('#spnd'+rq+'>.fa').attr('innerHTML','');
            var subtotal = parseFloat($('#subt').html().replace(new RegExp(',', 'g'),''));
			var st = parseFloat(subtotal * p / 100).toFixed(2); 	// litotal
			if(!isNaN(st)) {
				$('#fAmount'+rq).val(st);
			}
			st = $.trim(money_format('%i', parseFloat(st)).replace("USD",""));
			$('#spnd'+rq+'>.fa').attr('innerHTML', st);
			st = parseFloat(st);
			//
			var fv = gettxtotal('.fv');
			if(!isNaN(p)) { $('#fVAT'+rq).val(p); }
			fv = parseFloat(fv * p / 100).toFixed(2);
			$('#spnd'+rq+'>.fv').attr('innerHTML', fv);
			fv = parseFloat(fv);
			//
			var ox = gettxtotal('.ox');
			if(!isNaN(p)) { $('#fOtherTax1'+rq).val(p); }
			ox = parseFloat(ox * p / 100).toFixed(2);
			$('#spnd'+rq+'>.ox').attr('innerHTML', ox);
			ox = parseFloat(ox);
			//
			var wt = gettxtotal('.wt');
			if(!isNaN(p)) { $('#fWithHoldingTax'+rq).val(p); }
			wt = parseFloat(wt * p / 100).toFixed(2);
			$('#spnd'+rq+'>.wt').attr('innerHTML', wt);
			wt = parseFloat(wt);
			//
			var lt = parseFloat((st + fv + ox - wt));
			if(!isNaN(lt)) {
				$('#fLineTotal'+rq).val(lt.toFixed(2));
			}
			lt = $.trim(money_format('%i', lt).replace("USD",""));
			$('#spnd'+rq+'>.lt').attr('innerHTML', lt);
        } else {
            var q = parseInt($('#iQuantity'+rq).val().replace(new RegExp(',', 'g'),''));
            var p = parseFloat($(this).val().replace(new RegExp(',', 'g'),'')).toFixed(2);
            var sum = parseInt(q)*parseFloat(p);
			if(!isNaN(sum)) {
                $('#fAmount'+rq).val($.trim(money_format('%i',sum).replace("USD","")));
            }

            var v = parseFloat($('#fVAT'+rq).val().replace(new RegExp(',', 'g'),''));
            var t = parseFloat($('#fOtherTax1'+rq).val().replace(new RegExp(',', 'g'),''));
            var w = parseFloat($('#fWithHoldingTax'+rq).val().replace(new RegExp(',', 'g'),''));
            var a = sum;
            var sm = 0;
            if(!isNaN(a)) {
                sm = sm + a;
                if(!isNaN(v)) {
                    sm = sm + (a*v/100);
                    $('#vat'+rq).val(a*v/100);
                }
                if(!isNaN(t)) {
                    sm = sm + (a*t/100);
                    $('#othertax1'+rq).val(a*t/100);
                }
                if(!isNaN(w)) {
                    sm = sm - (a*w/100);
                    $('#withholdingtax'+rq).val(a*w/100);
                }
                if(!isNaN(sm)) {
                    $('#fLineTotal'+rq).val($.trim(money_format('%i',sm).replace("USD","")));
                }
            }
            // $('#fAmount'+rq).val(parseInt(q)*parseFloat(p));
            if(document.getElementById('spnd'+rq)) {
                $('#spnd'+rq+'>.iq').attr('innerHTML',q);
                $('#spnd'+rq+'>.fp').attr('innerHTML',p);
                $('#spnd'+rq+'>.fv').attr('innerHTML',parseFloat($('#vat'+rq).val()).toFixed(2));
                $('#spnd'+rq+'>.ox').attr('innerHTML',parseFloat($('#othertax1'+rq).val()).toFixed(2));
                $('#spnd'+rq+'>.wt').attr('innerHTML',parseFloat($('#withholdingtax'+rq).val()).toFixed(2));
                var fa = $.trim(money_format('%i',sum).replace("USD",""));
                if(fa.indexOf('.') != -1 && parseInt(fa.substring(fa.lastIndexOf('.')+1, fa.length),10) == 0) {
                    fa = fa.substring(0, fa.length-3);
                }
                $('#spnd'+rq+'>.fa').attr('innerHTML', fa);
                var lt = $.trim(money_format('%i',sm).replace("USD",""));
                if(lt.indexOf('.') != -1 && parseInt(lt.substring(lt.lastIndexOf('.')+1, lt.length),10) == 0) {
                    lt = lt.substring(0, lt.length-3);
                }
                $('#spnd'+rq+'>.lt').attr('innerHTML', lt);
            }
            $.each($('div[id*="Div"]'), function(l) {
                var sbtyp = $(this).find('[name="invoiceType\[\]"]');
                if(sbtyp.val() == 'Discount' || sbtyp.val() == 'Charge') {
                    $(this).find('[name="fPrice\[\]"]').trigger('blur');
                }
            });
        }
        settotal();
    });

    $('input[name="iQuantity\[\]"]').blur(function() {
        var rq = $(this).attr('id').replace('iQuantity','');
        $('#fPrice'+rq).trigger('blur');
    /*var p = parseFloat($('#fPrice'+rq).val().replace(new RegExp(',', 'g'),''));
		var q = parseInt($(this).val().replace(new RegExp(',', 'g'),''));
		var sum = parseInt(q)*parseFloat(p);
		if(!isNaN(sum)) {
			$('#fAmount'+rq).val($.trim(money_format('%i',sum).replace("USD","")));
		}

		var v = parseFloat($('#fVAT'+rq).val().replace(new RegExp(',', 'g'),''));
		var t = parseFloat($('#fOtherTax1'+rq).val().replace(new RegExp(',', 'g'),''));
		var w = parseFloat($('#fWithHoldingTax'+rq).val().replace(new RegExp(',', 'g'),''));
		var a = sum;
		var sm = 0;
		if(!isNaN(a)) {
			sm = sm + a;
			if(!isNaN(v)) { sm = sm + (a*v/100); $('#vat'+rq).val(a*v/100); }
			if(!isNaN(t)) { sm = sm + (a*t/100); $('#othertax1'+rq).val(a*t/100); }
			if(!isNaN(w)) { sm = sm - (a*w/100); $('#withholdingtax'+rq).val(a*w/100); }
			if(!isNaN(sm)) {
				$('#fLineTotal'+rq).val($.trim(money_format('%i',sm).replace("USD","")));
			}
		}

		if(document.getElementById('spnd'+rq)) {
			$('#spnd'+rq+'>.iq').attr('innerHTML',q);
			$('#spnd'+rq+'>.fp').attr('innerHTML',p);
			$('#spnd'+rq+'>.fv').attr('innerHTML',$('#vat'+rq).val());
			$('#spnd'+rq+'>.ox').attr('innerHTML',$('#othertax1'+rq).val());
			$('#spnd'+rq+'>.wt').attr('innerHTML',$('#withholdingtax'+rq).val());
			$('#spnd'+rq+'>.fa').attr('innerHTML',$.trim(money_format('%i',sum).replace("USD","")));
			$('#spnd'+rq+'>.lt').attr('innerHTML',$.trim(money_format('%i',sm).replace("USD","")));
		}
		settotal();*/
    });

    $('input[name="fOtherTax1\[\]"]').change(function() {
        var rq = $(this).attr('id').replace('fOtherTax1','');
        $('#fPrice'+rq).trigger('blur');
    /*var a  = parseFloat($('#fAmount'+rq).val().replace(new RegExp(',', 'g'),''));
		var v = parseFloat($('#fVAT'+rq).val().replace(new RegExp(',', 'g'),''));
		var t = parseFloat($(this).val().replace(new RegExp(',', 'g'),''));
		var w = parseFloat($('#fWithHoldingTax'+rq).val().replace(new RegExp(',', 'g'),''));
		var sum = 0;
		if(!isNaN(a)) {
			sum = sum + a;
			if(!isNaN(v)) { sum = sum + (a*v/100); $('#vat'+rq).val(a*v/100); }
			if(!isNaN(t)) { sum = sum + (a*t/100); $('#othertax1'+rq).val(a*t/100); }
			if(!isNaN(w)) { sum = sum - (a*w/100); $('#withholdingtax'+rq).val(a*w/100); }
			if(!isNaN(sum)) {
				$('#fLineTotal'+rq).val($.trim(money_format('%i',sum).replace("USD","")));
			}
		}

		if(document.getElementById('spnd'+rq)) {
			// $('#spnd'+rq+'>.ox').attr('innerHTML',t);
			$('#spnd'+rq+'>.ox').attr('innerHTML',$('#othertax1'+rq).val());
			$('#spnd'+rq+'>.lt').attr('innerHTML',$.trim(money_format('%i',sum).replace("USD","")));
		}
		settotal();*/
    });
    $('input[name="fVAT\[\]"]').change(function() {
        var rq = $(this).attr('id').replace('fVAT','');
        $('#fPrice'+rq).trigger('blur');
    /*var a  = parseFloat($('#fAmount'+rq).val().replace(new RegExp(',', 'g'),''));
		var t = parseFloat($('#fOtherTax1'+rq).val().replace(new RegExp(',', 'g'),''));
		var w = parseFloat($('#fWithHoldingTax'+rq).val().replace(new RegExp(',', 'g'),''));
		var v = parseFloat($(this).val().replace(new RegExp(',', 'g'),''));
		var sum = 0;
		if(!isNaN(a)) {
			sum = sum + a;
			if(!isNaN(v)) { sum = sum + (a*v/100); $('#vat'+rq).val(a*v/100); }
			if(!isNaN(t)) { sum = sum + (a*t/100); $('#othertax1'+rq).val(a*t/100); }
			if(!isNaN(w)) { sum = sum - (a*w/100); $('#withholdingtax'+rq).val(a*w/100); }
			if(!isNaN(sum)) {
				$('#fLineTotal'+rq).val($.trim(money_format('%i',sum).replace("USD","")));
			}
		}

		if(document.getElementById('spnd'+rq)) {
			$('#spnd'+rq+'>.fv').attr('innerHTML',$('#vat'+rq).val());
			$('#spnd'+rq+'>.lt').attr('innerHTML',$.trim(money_format('%i',sum).replace("USD","")));
		}
		settotal();*/
    });

    $('input[name="fWithHoldingTax\[\]"]').change(function() {
        var rq = $(this).attr('id').replace('fWithHoldingTax','');
        $('#fPrice'+rq).trigger('blur');
    /*var a  = parseFloat($('#fAmount'+rq).val().replace(new RegExp(',', 'g'),''));
		var t = parseFloat($('#fOtherTax1'+rq).val().replace(new RegExp(',', 'g'),''));
		var v = parseFloat($('#fVAT'+rq).val().replace(new RegExp(',', 'g'),''));
		var w = parseFloat($(this).val().replace(new RegExp(',', 'g'),''));
		var sum = 0;
		if(!isNaN(a)) {
			sum = sum + a;
			if(!isNaN(v)) { sum = sum + (a*v/100); $('#vat'+rq).val(a*v/100); }
			if(!isNaN(t)) { sum = sum + (a*t/100); $('#othertax1'+rq).val(a*t/100); }
			if(!isNaN(w)) { sum = sum - (a*w/100); $('#withholdingtax'+rq).val(a*w/100); }
			if(!isNaN(sum)) {
				$('#fLineTotal'+rq).val($.trim(money_format('%i',sum).replace("USD","")));
			}
		}
		if(document.getElementById('spnd'+rq)) {
			$('#spnd'+rq+'>.wt').attr('innerHTML',$('#withholdingtax'+rq).val());
			$('#spnd'+rq+'>.lt').attr('innerHTML',$.trim(money_format('%i',sum).replace("USD","")));
		}
		settotal();*/
    });

    $('textarea[name="tDescription\[\]"]').change(function() {
        var rq = $(this).attr('id').replace('tDescription','');
        if(document.getElementById('spnd'+rq)) {
            if($.trim($(this).val()) != '') $('#spnd'+rq+'>.td').attr('innerHTML',$.trim($(this).val()));
        }
    });

    $('[name="vUnitOfMeasure\[\]"]').change(function() {
        var rq = $(this).attr('id').replace('vUnitOfMeasure','');
        if(document.getElementById('spnd'+rq)) {
            // if($.trim($(this).val()) != '')
            $('#spnd'+rq+'>.um').attr('innerHTML',$.trim($(this).val()));
        }
    });

    $('select[name="invoiceType\[\]"]').change(function() {
        var rq = $(this).attr('id').replace('eInvoiceType','');
        if(document.getElementById('spnd'+rq)) {
            if($.trim($(this).val()) != '') $('#spnd'+rq+'>.ot').attr('innerHTML',$.trim($(this).val()));
        }
        //
        /*if($(this).val() == 'Discount' || $(this).val() == 'Charge') {
			// alert($(this).closest('table[id^="tbl"]').find('.ndcf').closest('input').length);
			$(this).closest('table[id^="tbl"]').find('.ndcf').hide();
			$(this).closest('table[id^="tbl"]').find('.ndcf').parent('td').next('td').hide();
			$(this).closest('table[id^="tbl"]').find('input[id^="iQuantity"]').parent('td').attr('width','285px');
		} else {
			$(this).closest('table[id^="tbl"]').find('.ndcf').show();
			$(this).closest('table[id^="tbl"]').find('.ndcf').parent('td').next('td').show();
			$(this).closest('table[id^="tbl"]').find('input[id^="iQuantity"]').parent('td').attr('width','154px');
		}*/
        if($(this).val() == 'Discount' || $(this).val() == 'Charge') {
			$('#spnd'+rq+'>.ot').attr('innerHTML', '');
            // alert($(this).closest('table[id^="tbl"]').find('.ndcf').closest('input').length);
            $(this).closest('table[id^="tbl"]').find('.ndcf').hide();
            $(this).closest('table[id^="tbl"]').find('.ndcf').parent('td').hide();
            $(this).closest('table[id^="tbl"]').find('.ndcf').parent('td').next('td').hide();
            // $(this).closest('table[id^="tbl"]').find('input[id^="iQuantity"]').parent('td').attr('width','1');
            $(this).closest('table[id^="tbl"]').find('.dcr').parent('td').attr('width','12.5%'); 	//
            $(this).closest('table[id^="tbl"]').find('.dcr').html('Rate : &nbsp;<font class="reqmsg">*</font>');
            $(this).closest('table[id^="tbl"]').find('[name="eSublineType\[\]"]').val('');
            $(this).closest('table[id^="tbl"]').find('[name="eSublineType\[\]"]').trigger('change');
        } else {
            $(this).closest('table[id^="tbl"]').find('.ndcf').show();
            $(this).closest('table[id^="tbl"]').find('.ndcf').parent('td').show();
            $(this).closest('table[id^="tbl"]').find('.ndcf').parent('td').next('td').show();
            // $(this).closest('table[id^="tbl"]').find('input[id^="iQuantity"]').parent('td').attr('width','154px');
            $(this).closest('table[id^="tbl"]').find('.dcr').parent('td').attr('width','111');
            $(this).closest('table[id^="tbl"]').find('.dcr').html('Price : &nbsp;<font class="reqmsg">*</font>');
        }
    //var id = $(this).attr('id').replace('envoiceType','');
    //$('div[id*="Div"]').find('[name="fPrice\[\]"]').trigger('blur');
    });
	$('#eInvoiceType'+j).trigger('change');
    $('div[id*="Div"]').find('[name="fPrice\[\]"]').trigger('blur');

    if($('div [id*="spnd"]').length<1) {
        $('#nli').show();
    } else {
        $('#nli').hide();
    }
    settotal();
}
$('#adb').hide();
$('div [id*="Div"]').hide();
// addRow();
if(document.getElementById('vUnitOfMeasure')) {
    // alert($("#frmadd").validate().element('#vUnitOfMeasure'));
    if($("#frmadd").find('#fPrice').length < 1 || $("#frmadd").validate().element('#fPrice')==false || $("#frmadd").validate().element('#fAmount')==false || $("#frmadd").validate().element('#fLineTotal')==false) {
        $('#Div0').attr('innerHTML','');
    }
}

function removeRow(divNum) {
    var a = document.getElementById('addNew');
    var rdiv = document.getElementById(divNum);
    //alert(divNum);
    // a.removeChild(rdiv);
    if(divNum=='Div1') {
        var t=document.getElementById('trid');
        if(t)
            t.style.display="none";
    }
    var nm = divNum.replace('Div','');
    deltbl(nm);
}
// removeRow("Div"+cr);

function setfields() {
    var ni = document.getElementById('addNew');
    var numi=document.getElementById('mdiv');
    var num = (parseInt(document.getElementById('mdiv').value) -parseInt(1))+ parseInt(2);
    numi.value = num;
    var newdiv = document.createElement('div');
    var divIdName = "dvf"+j; 	// num
    newdiv.setAttribute('id',divIdName);
    newdiv.innerHTML ="<table id='tbl"+j+"' width='100%' border='0' cellspacing='0' class='black'><tr><td><table width='100%' border='0' cellspacing='5' cellpadding='0'><tr><td width='108'>"+LBL_LINE_TYPE+" :&nbsp;<font class='reqmsg'>*</font></td><td width='281'>"+invoiceType+"</td><td width='122'>"+LBL_CURRENCY+" : &nbsp;</td><td><b>"+currency+"</b></td></tr><tr><td valign='top'>"+LBL_DESCRIPTION+" : </td><td><textarea name='tDescription[]' id='tDescription"+i+"' class='input-rag' style='width:188px; height: 73px;'  ></textarea></td><td valign='top'><span class='ndcf'>"+LBL_UNIT_MEASURE+" :&nbsp;<font class='reqmsg'></font></span></td><td valign='top'>"+uoms+"</td></tr></table></td></tr><tr><td><table width='100%' border='0' cellspacing='5' cellpadding='0'><tr><td width='108'><span class='ndcf'>"+LBL_QUANTITY+" :&nbsp;<font class='reqmsg'>*</font></span></td><td width='154'><input type='text' name='iQuantity[]' id='iQuantity"+i+"' class='input-rag required digits' style='width:117px;' title='"+LBL_ENTER+" "+LBL_QUANTITY+"' /></td><td width='111'><span class='dcr'>"+LBL_PRICE+" :&nbsp;<font class='reqmsg'>*</font></span></td><td width='149'><input type='text' name='fPrice[]' id='fPrice"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_PRICE+"' /></td><td><span class='ndcf'>"+LBL_AMOUNT+" :&nbsp;<font class='reqmsg'>*</font></span></td><td><input type='text' name='fAmount[]' id='fAmount"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_AMOUNT+"' readonly='readonly' /></td></tr><tr><td><span class='ndcf'>"+LBL_VAT+" "+LBL_RATE+" (%):&nbsp;<font class='reqmsg'>*</font></span></td><td><input type='text' name='fVAT[]' id='fVAT"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_VAT+"' value='"+vat+"' /></td><td><span class='ndcf'>"+LBL_VAT+" :&nbsp;<font class='reqmsg'>*</font></span></td><td><input type='text' name='vat' id='vat"+i+"' class='input-rag decimals' style='width:117px;' title='"+LBL_VAT+"' readonly='readonly' /></td><td><span class='ndcf'>"+LBL_OTHER_TAX+" "+LBL_RATE+" (%):</span></td><td><input type='text' name='fOtherTax1[]' id='fOtherTax1"+i+"' class='input-rag decimals' style='width:117px;' value='"+otax+"' /></td></tr><tr><td><span class='ndcf'>"+LBL_OTHER_TAX+" : </span></td><td><input type='text' name='othertax1' id='othertax1"+i+"' class='input-rag decimals' style='width:117px;' readonly='readonly' /></td><td><span class='ndcf'>"+LBL_WITH_HOLDING_TAX+" "+LBL_RATE+" (%): </span></td><td><input type='text' name='fWithHoldingTax[]' id='fWithHoldingTax"+i+"' class='input-rag decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_WITH_HOLDING_TAX+"' value='"+wtax+"' /></td><td><span class='ndcf'>"+LBL_WITH_HOLDING_TAX+" : </span></td><td><input type='text' name='withholdingtax' id='withholdingtax"+i+"' class='input-rag decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_WITH_HOLDING_TAX+"' readonly='readonly' /></td><tr><td><span class='ndcf'>"+LBL_LINE_TOTAL+" : </span></td><td><input type='text' name='fLineTotal[]' id='fLineTotal"+i+"' class='input-rag decimals' style='width:117px;' readonly='readonly' /></td><td><span class='ndcf'>"+LBL_RECEIPT+" : </span></td><td><input type='text' name='tReceipt[]' id='tReceipt"+i+"' class='input-rag' style='width:117px;' /></td><td colspan='2'>&nbsp;</td></tr><tr><td colspan='3'>&nbsp;</td></tr><tr><td colspan='2'><span class='ndcf'><b>"+LBL_DISCOUNT+" / "+LBL_CHARGE+" </b> &nbsp; <select id='eSublineType"+i+"' name='eSublineType[]'><option value=''>None</option><option value='Discount'>Discount</option><option value='Charge'>Charge</option></select></span></td><td colspan='4'>&nbsp;</td></tr><tr><td><span class='ndcf'>"+LBL_QUANTITY+" : </span></td><td><input type='text' name='iSubQuantity[]' id='iSubQuantity"+i+"' class='input-rag decimals' style='width:117px;' value='' /></td><td><span class='ndcf'>"+LBL_RATE+" : </span></td><td><input type='text' name='fSubRate[]' id='fSubRate"+i+"' class='input-rag' style='width:117px;' value='' /></td><td colspan='2'><input type='hidden' name='fSubAmount[]' id='fSubAmount"+i+"' class='input-rag' style='width:117px;' value='' /></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td align='right'><img src='"+SITE_IMAGES+"sm_images/btn-close.gif' name='close' value='close' onclick=\"$('#adb').hide(); closeRow(\'"+j+"\')\" /> &nbsp; <img src='"+SITE_IMAGES+"sm_images/btn-remove.gif' name='remove' value='remove' onClick=\"removeRow(\'"+divIdName+"\')\" /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr><tr><td colspan='6'><hr style='border-style: dashed;'></td></tr></table>";
    ni.appendChild(newdiv);
}

settotal();

$(document).ready(function() {
    $('[name="eSublineType\[\]"]').live("change", function() {
        var idx = $(this).attr('id').replace('eSublineType','');
        var pr = false;
        if($('#spnd'+idx+' > #subli').length > 0) {
            pr = $('#spnd'+idx+' > #subli');
            if($.trim($(this).val()) != '') {
                $('.sltyp',pr).attr('innerHTML', ''+$(this).val()+'');
                pr.show();
            } else {
                $('.sltyp',pr).attr('innerHTML', '');
                $('.sqt',pr).attr('innerHTML', '');
                $('.srt',pr).attr('innerHTML', '');
                $('.slt',pr).attr('innerHTML', '');
                pr.hide();
                $('#fSubRate'+idx).val('0');
                $('#iSubQuantity'+idx).val('0');
                $(this).val('Discount');
                $('#fPrice'+idx).trigger('blur');
                $(this).val('');
            }
        }
        $('#fSubRate'+idx).trigger('blur');
    });
    //
    $('[name="iSubQuantity\[\]"]').live('blur', function() {
        var idx = $(this).attr('id').replace('iSubQuantity','');
        pr = false;
        if($('#spnd'+idx+' > #subli').length > 0) {
            pr = $('#spnd'+idx+' > #subli');
            if($('.sqt',pr).length > 0) {
                $('.sqt',pr).attr('innerHTML', money_format('%i',$(this).val(),'no'));
            // alert($('.srt',pr).length);
            }
        }
        if($.trim($('#fSubRate'+idx).val()) != '' && !isNaN(parseInt($('#fSubRate'+idx).val(), 10))) {
            var subtype = $.trim($('#eSublineType'+idx).val());
            if($.trim($('#eSublineType'+idx).val()) == '') {
                return false;
            }
            var subquantity = parseFloat($.trim($(this).val()), 10);
            var linetotal = parseFloat($.trim($('#fLineTotal'+idx).val()), 10);
            var subrate = parseFloat($.trim($('#fSubRate'+idx).val()), 10);
            var quantity = parseFloat($.trim($('#iQuantity'+idx).val()), 10);
            var price = parseFloat($.trim($('#fPrice'+idx).val()), 10);
            var vat = parseFloat($.trim($('#fVAT'+idx).val()), 10);
            var otax = parseFloat($.trim($('#fOtherTax1'+idx).val()), 10);
            var whtax = parseFloat($.trim($('#fWithHoldingTax'+idx).val()), 10);
            var qno = (subquantity > quantity)? quantity : subquantity;
            var sum = (qno * price);
            var amt = sum;

            if(subtype == 'Charge') {
                var amt1 = (sum * subrate / 100);
                amt = amt1 + ((sum * vat / 100) * subrate / 100) + ((sum * otax / 100) * subrate / 100) - ((sum * whtax / 100) * subrate / 100);
            } else {
                var amt1 = (-(sum * subrate / 100));
                amt = amt1 - ((sum * vat / 100) * subrate / 100) - ((sum * otax / 100) * subrate / 100) + ((sum * whtax / 100) * subrate / 100);
            }
            // amt = amt + ramt;
            amt = parseFloat(amt,10).toFixed(2);
            // alert(amt);
            if(!isNaN(amt1) && amt1.toString() != 'NaN') {
                if(pr){
                    var stl = Math.abs(amt1);
                    //$('.stl', pr).attr('innerHTML', ((stl > parseInt(stl,10))? stl.toFixed(2) : stl));
                    $('.stl', pr).attr('innerHTML', stl.toFixed(2));
                }
            }
            if(!isNaN(amt) && amt.toString() != 'NaN') {
                $('#fSubAmount'+idx).val(amt);
                if(pr) {
                    var slf = Math.abs(amt);
                    // $('.stl',pr).attr('innerHTML', amt);
                    //$('.slf',pr).attr('innerHTML', ((slf > parseInt(slf,10))? slf.toFixed(2) : slf));
                    $('.slf',pr).attr('innerHTML', slf.toFixed(2));
                }
            }

            var slv = ((sum * vat / 100) * subrate / 100);
            slv = (slv > parseInt(slv,10))? slv.toFixed(2) : slv;
            $('.slv',pr).attr('innerHTML', slv);
            var slo = ((sum * otax / 100) * subrate / 100);
            slo = (slo > parseInt(slo,10))? slo.toFixed(2) : slo;
            $('.slo',pr).attr('innerHTML', slo);
            var slw = ((sum * whtax / 100) * subrate / 100);
            slw = (slw > parseInt(slw,10))? slw.toFixed(2) : slw;
            $('.slw',pr).attr('innerHTML', slw);

            $('#fPrice'+idx).trigger('blur');
        // settotal();
        // return false;
        }
    });
    //
    $('[name="fSubRate\[\]"]').live('blur', function() {
        var idx = $(this).attr('id').replace('fSubRate','');
        pr = false;
        if($('#spnd'+idx+' > #subli').length > 0) {
            pr = $('#spnd'+idx+' > #subli');
            // alert($('.srt',pr).length);
            if($('.srt',pr).length > 0) {
                $('.srt',pr).attr('innerHTML', money_format('%i',parseFloat($(this).val()).toFixed(2)+ '%'));
            }
        }
        if($.trim($('#iSubQuantity'+idx).val()) == '' || isNaN(parseInt($('#iSubQuantity'+idx).val(),10))) {
            return false;
        }
        $('div[id*="Div"]').find('[name="fPrice\[\]"]').trigger('blur');
        $('#iSubQuantity'+idx).trigger('blur');
    });
    //
    $('[name="eSublineType\[\]"]').trigger('change');
});
