<div class="middle-container">
    <h1>{$LBL_INVOICE_DETAILS}</h1>
    <div class="middle-containt">
        <div class="statistics-main-box-white">
            <div>
                <ul id="inner-tab">
                    <li><a href="{$SITE_URL_DUM}invoicecreate" class="current"><EM>{$LBL_INVOICE_DETAILS}</EM></a></li>
                </ul>
            </div>
            <div class="clear"></div>
            <div class="inner-gray-bg">
                <div>&nbsp;</div>
                <div>
                    {if $msg neq ''}<div class="msg">{$msg}</div>{/if}
                    <form name="frmadd" id="frmadd" action="{$SITE_URL}index.php?file=u-binvoiceocreatefpo_a"  method="post" enctype="multipart/form-data">
                        <input type="hidden" name="iInvoiceID" id="iInvoiceID" value="{$invid}" />
                        <input type="hidden" name="view" id="view" value="bifp" />
                        <table width="97%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
                            <tr><td colspan="3" align="left"><font size="2" color=""><b>{$MSG_INVOICE_REMAINING_DETAILS}</b></font></td></tr>
									 <tr><td colspan="3">&nbsp;</td></tr>
                            <tr>
                                <td width="210px">{$LBL_INVOICE_TYPE}</td>
                                <td>:</td>
                                <td>{$invoiceType}</td>
                            </tr>
									 <tr>
                                <td>{$LBL_FREIGHT} </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vFreight]" class="input-rag decimals" id="vFreight" style="width:228px;" value="{$invdtls[0].vFreight}" /></td>
                            </tr>
									 <tr>
                                <td>{$LBL_DISCOUNT_BASELINE_DATE} </td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="Data[dCashDiscountBaseline]" class="input-rag" id="dCashDiscountBaseline" style="width:190px;" value="{$invdtls[0].dCashDiscountBaseline}" readonly="readonly" />
                                    &nbsp;<img src="{$SITE_IMAGES}sm_images/icon-calander.gif" id="cal2"/>
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_MAXCASH_DISCOUNTDAYS} </td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="Data[iMaxCashDiscountDays]" class="input-rag digits" id="iMaxCashDiscountDays" style="width:190px;" value="{$invdtls[0].iMaxCashDiscountDays}" />
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_MAXCASH_DISCOUNTPERCENT} </td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="Data[fMaxCashDiscountPercentage]" class="input-rag decimals" id="fMaxCashDiscountPercentage" style="width:190px;" max="100" value="{$invdtls[0].fMaxCashDiscountPercentage}" title="{$LBL_ENTER} {$LBL_MAXCASH_DISCOUNTPERCENT}" maxlength="4" />
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_NORMALCASH_DISCOUNTDAYS} </td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="Data[iNormalCashDiscountDays]" class="input-rag digits" id="iNormalCashDiscountDays" style="width:228px;" value="{$invdtls[0].iNormalCashDiscountDays}" />
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_NORMALCASH_DISCOUNTPERCNET} </td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="Data[iNormalCashDiscountPercentage]" class="input-rag decimals" max="100" id="iNormalCashDiscountPercentage" style="width:228px;" value="{$invdtls[0].iNormalCashDiscountPercentage}" title="{$LBL_ENTER} {$LBL_NORMALCASH_DISCOUNTPERCNET}" maxlength="4" />
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_NET_PAYMENT_DAYS} </td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="Data[iNetPaymentDays]" class="input-rag digits" id="iNetPaymentDays" style="width:228px;" value="{$invdtls[0].iNetPaymentDays}" />
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_NET_PAYMENT_DATE} </td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="Data[dNetPaymentdate]" class="input-rag " id="dNetPaymentdate" style="width:190px;" value="{$invdtls[0].dNetPaymentdate}" readonly="readonly" />
                                    &nbsp;<img src="{$SITE_IMAGES}sm_images/icon-calander.gif" id="cal3"/>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" height="5"></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td colspan="2"><a href="javascript:void(0)">
										  <img src="{$SITE_IMAGES}sm_images/btn-submit.gif" alt="" border="0"  id="btnSubmit" name="Submit" title="submit" src="images/btn-submit.gif" alt="" onclick="$('#eSaved').val('No'); return submitFrm();" style="vertical-align:middle;"/></a>
                                <img src="{$SITE_IMAGES}sm_images/btn-reset.gif" alt="" border="0"  onclick="resetFrm();" style="vertical-align:middle; cursor:pointer;"/>
                                <img src="{$SITE_IMAGES}sm_images/btn-cancel.gif" alt="" border="0" onclick="location.href='{$SITE_URL_DUM}invacptlist'" style="vertical-align:middle; cursor:pointer;"/></a>
										</td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div>&nbsp;</div>
            </div>
        </div>
    </div>
<span id="sn" style="display:hidden;"></span>
<span id="spn" style="display:hidden;"></span>
<span id="vldms" style="display:none;"></span>
</div>

<script type="text/javascript" src="{$S_JQUERY}jquery.validate.js"></script>
<script type="text/javascript" src="{$DATETIMEPICKER}jquery.dynDateTime.js"></script>
<script type="text/javascript" src="{$DATETIMEPICKER}lang/calendar-en.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="{$DATETIMEPICKER}css/calendar-blue.css"  />
{*<!--<script type="text/javascript" src="{$SITE_CONTENT_JS}multifile.js"></script>-->*}
{literal}
<script type="text/javascript">
var corg = '{/literal}{$curORGID}{literal}';
var sid = '{/literal}{$sid}{literal}';

$("#frmadd").validate({
	 messages: {
		  "Data[vFreight]": {
				decimals: LBL_DIGITS_ONLY
		  },
		  "Data[iMaxCashDiscountDays]": {
				digits: LBL_DIGITS_ONLY
		  },
		  "Data[fMaxCashDiscountPercentage]": {
				decimals: LBL_DIGITS_ONLY,
				max: LBL_EXCEEDS_MAX_VALUE_OF_PERCENT
		  },
		  "Data[iNormalCashDiscountDays]": {
				digits: LBL_DIGITS_ONLY
		  },
		  "Data[iNormalCashDiscountPercentage]": {
				decimals: LBL_DIGITS_ONLY,
				max: LBL_EXCEEDS_MAX_VALUE_OF_PERCENT
		  },
		  "Data[iNetPaymentDays]": {
				digits: LBL_DIGITS_ONLY
		  }
	 }
});
function submitFrm() {
	 var vldfrm = $('#frmadd').valid();
	 if(! vldfrm) {
      return false;
	 }
	 $('#frmadd').submit();
	 $(document).ready( function() {
		  $(function() {
				var ead=10;
				$('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
		  });
	 });
}

function resetFrm() {
   $('#frmadd')[0].reset();
}

jQuery(document).ready(function() {
	 var cal2Pos=$('#cal2').position();
	 jQuery("#dCashDiscountBaseline").dynDateTime({
		  showsTime: true,
		  ifFormat: "%Y-%m-%d",
		  daFormat: "%l;%M %p, %e %m, %Y",
		  align: "TL",
		  electric: false,
		  singleClick: false,
		  button:".next()",
		  displayArea: ".siblings('.dtcDisplayArea')"
		  //position:[cal2Pos.left-230,0]
	 });

	 var cal3Pos=$('#cal3').position();
	 jQuery("#dNetPaymentdate").dynDateTime({
		  showsTime: true,
		  ifFormat: "%Y-%m-%d",
		  daFormat: "%l;%M %p, %e %m, %Y",
		  align: "TL",
		  electric: false,
		  singleClick: false,
		  button:".next()",
		  displayArea: ".siblings('.dtcDisplayArea')"
		  // position:[cal3Pos.left-230,10]
	 });
});
</script>
{/literal}

{if $vldmsg neq ''}
{literal}
<script>
$(document).ready(function() {
	var vldmsg = '{/literal}{$vldmsg}{literal}';
   if(vldmsg!= '' && vldmsg != undefined && $('#vldms').attr('innerHTML')!=vldmsg) {
	   alert(vldmsg);
		$('#vldms').attr('innerHTML',vldmsg);
   }
});
</script>
{/literal}
{/if}
{if $mmsg neq ''}
{literal}
<script>
	 $(document).ready(function() {
		  var mmsg='{/literal}{$mmsg}{literal}';
		  if(mmsg!= '' && mmsg != undefined)
		  alert(mmsg);
	 });
</script>
{/literal}
{/if}