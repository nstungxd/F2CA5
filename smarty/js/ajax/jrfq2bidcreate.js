function setamtsfpc()
{
	var ipam = (! isNaN(parseFloat($.trim($('.ipaam').attr('innerHTML')))) )? parseFloat($.trim($('.ipaam').attr('innerHTML')).replace(new RegExp(',', 'g'),'')) : 0;
	var mnadv_pc = (! isNaN(parseFloat($.trim($('#fBidAdvancePc').val()))) )? parseFloat($.trim($('#fBidAdvancePc').val()).replace(new RegExp(',', 'g'),'')) : 0;
	var mxprc_pc = (! isNaN(parseFloat($.trim($('#fBidPricePc').val()))) )? parseFloat($.trim($('#fBidPricePc').val()).replace(new RegExp(',', 'g'),'')) : 0;
	var mnadv_amt = (! isNaN(parseFloat($.trim($('#fBidAdvanceAmt').val()))) )? parseFloat($.trim($('#fBidAdvanceAmt').val()).replace(new RegExp(',', 'g'),'')) : 0;
	var mxprc_amt = (! isNaN(parseFloat($.trim($('#fBidPriceAmt').val()))) )? parseFloat($.trim($('#fBidPriceAmt').val()).replace(new RegExp(',', 'g'),'')) : 0;
	
        if(ipam>0) {
		if(mnadv_pc>0) {
			var t = ipam*mnadv_pc/100;
			$('#fBidAdvanceAmt').val(t.toFixed(2));
			$('#fBidAdvanceTotal').val(t+ipam);
			$('.bdat').html(t+ipam);
		} else {
			$('#fBidAdvanceAmt').val('0');
			$('#fBidAdvanceTotal').val('0');
			$('.bdat').html('0');
		}
		if(mxprc_pc>0) {
			var t = ipam*mxprc_pc/100;
			$('#fBidPriceAmt').val(t.toFixed(2));
			$('#fBidPriceTotal').val(t+ipam);
			$('.bdpt').html(t+ipam);
		} else {
			$('#fBidPriceAmt').val('0');
			$('#fBidPriceTotal').val('0');
			$('.bdpt').html('0');
		}
	}
}
function setpcfamts()
{
	var ipam = (! isNaN(parseFloat($.trim($('.ipaam').attr('innerHTML')))) )? parseFloat($.trim($('.ipaam').attr('innerHTML')).replace(new RegExp(',', 'g'),'')) : 0;
	var mnadv_pc = (! isNaN(parseFloat($.trim($('#fBidAdvancePc').val()))) )? parseFloat($.trim($('#fBidAdvancePc').val()).replace(new RegExp(',', 'g'),'')) : 0;
	var mxprc_pc = (! isNaN(parseFloat($.trim($('#fBidPricePc').val()))) )? parseFloat($.trim($('#fBidPricePc').val()).replace(new RegExp(',', 'g'),'')) : 0;
	var mnadv_amt = (! isNaN(parseFloat($.trim($('#fBidAdvanceAmt').val()))) )? parseFloat($.trim($('#fBidAdvanceAmt').val()).replace(new RegExp(',', 'g'),'')) : 0;
	var mxprc_amt = (! isNaN(parseFloat($.trim($('#fBidPriceAmt').val()))) )? parseFloat($.trim($('#fBidPriceAmt').val()).replace(new RegExp(',', 'g'),'')) : 0;
	if(ipam>0) {
		if(mnadv_amt>0) {
			var t = mnadv_amt*100/ipam;
			$('#fBidAdvancePc').val(t.toFixed(2));
			$('#fBidAdvanceTotal').val(mnadv_amt+ipam);
			$('.bdat').html(mnadv_amt+ipam);
		} else {
			$('#fBidAdvancePc').val('0');
			$('#fBidAdvanceTotal').val('0');
			$('.bdat').html('0');
		}
		if(mxprc_amt>0) {
			var t = mxprc_amt*100/ipam;
			$('#fBidPricePc').val(t.toFixed(2));
			$('#fBidPriceTotal').val(mxprc_amt+ipam);
			$('.bdpt').html(mxprc_amt+ipam);
		} else {
			$('#fBidPricePc').val('0');
			$('#fBidPriceTotal').val('0');
			$('.bdpt').html('0');
		}
	}
}
//
$('#fBidAdvancePc').live("blur", setamtsfpc);
$('#fBidPricePc').live("blur", setamtsfpc);
$('#fBidAdvanceAmt').live("blur", setpcfamts);
$('#fBidPriceAmt').live("blur", setpcfamts);
$(document).ready(function() {
	$('#fBidAdvancePc').trigger('blur');
	$('#fBidPricePc').trigger('blur');
	$('#fBidAdvanceAmt').trigger('blur');
	$('#fBidPriceAmt').trigger('blur');
});
//