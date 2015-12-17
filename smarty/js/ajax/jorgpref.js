/*ordsts = $('#vOrderStatusLevel');
ordsts_optns = $('#vOrderStatusLevel option');
var ord_auth1_index = "";
var ord_auth2_index = "";
var ord_auth3_index = "";

invsts = $('#vInvoiceStatusLevel');
invsts_optns = $('#vInvoiceStatusLevel option');
var inv_auth1_index = "";
var inv_auth2_index = "";
var inv_auth3_index = "";

invacpt = $('#vInvoiceAcceptanceLevel');
invacpt_optns = $('#vInvoiceAcceptanceLevel option');
var ord_auth1_index = "";
var ord_auth2_index = "";
var ord_auth3_index = "";

ordacpt = $('#vOrderAcceptanceLevel');
ordacpt_optns = $('#vOrderAcceptanceLevel option');
var ord_auth1_index = "";
var ord_auth2_index = "";
var ord_auth3_index = "";

$.each(ordsts_optns, function(i,el) {
   if($(this).text() == 'Auth1') {
     ord_auth1_index = $(this).attr('index');
   }
   if($(this).text() == 'Auth2') {
     ord_auth2_index = $(this).attr('index');
   }
   if($(this).text() == 'Auth3') {
     ord_auth3_index = $(this).attr('index');
   }
});
ordsts.keyup(function() {
     if($('#vOrderStatusLevel [index='+ord_auth3_index+']').attr('selected')) {
          $('#vOrderStatusLevel [index='+ord_auth2_index+']').attr('selected',true);
          $('#vOrderStatusLevel [index='+ord_auth1_index+']').attr('selected',true);
     }
     if($('#vOrderStatusLevel [index='+ord_auth2_index+']').attr('selected')) {
        $('#vOrderStatusLevel [index='+ord_auth1_index+']').attr('selected',true);
     }
});
ordsts.click(function() {
     if($('#vOrderStatusLevel [index='+ord_auth3_index+']').attr('selected')) {
          $('#vOrderStatusLevel [index='+ord_auth2_index+']').attr('selected',true);
          $('#vOrderStatusLevel [index='+ord_auth1_index+']').attr('selected',true);
     }
     if($('#vOrderStatusLevel [index='+ord_auth2_index+']').attr('selected')) {
        $('#vOrderStatusLevel [index='+ord_auth1_index+']').attr('selected',true);
     }
});

$.each(invsts_optns, function(i,el) {
   if($(this).text() == 'Auth1') {
     inv_auth1_index = $(this).attr('index');
   }
   if($(this).text() == 'Auth2') {
     inv_auth2_index = $(this).attr('index');
   }
   if($(this).text() == 'Auth3') {
     inv_auth3_index = $(this).attr('index');
   }
});
invsts.keyup(function() {
     if($('#vInvoiceStatusLevel [index='+inv_auth3_index+']').attr('selected')) {
          $('#vInvoiceStatusLevel [index='+inv_auth2_index+']').attr('selected',true);
          $('#vInvoiceStatusLevel [index='+inv_auth1_index+']').attr('selected',true);
     }
     if($('#vInvoiceStatusLevel [index='+inv_auth2_index+']').attr('selected')) {
        $('#vInvoiceStatusLevel [index='+inv_auth1_index+']').attr('selected',true);
     }
});
invsts.click(function() {
     if($('#vInvoiceStatusLevel [index='+inv_auth3_index+']').attr('selected')) {
          $('#vInvoiceStatusLevel [index='+inv_auth2_index+']').attr('selected',true);
          $('#vInvoiceStatusLevel [index='+inv_auth1_index+']').attr('selected',true);
     }
     if($('#vInvoiceStatusLevel [index='+inv_auth2_index+']').attr('selected')) {
        $('#vInvoiceStatusLevel [index='+inv_auth1_index+']').attr('selected',true);
     }
});

$.each(invacpt_optns, function(i,el) {
   if($(this).text() == 'Auth1') {
     invacpt_auth1_index = $(this).attr('index');
   }
   if($(this).text() == 'Auth2') {
     invacpt_auth2_index = $(this).attr('index');
   }
   if($(this).text() == 'Auth3') {
     invacpt_auth3_index = $(this).attr('index');
   }
});
invacpt.keyup(function() {
     if($('#vInvoiceAcceptanceLevel [index='+invacpt_auth3_index+']').attr('selected')) {
          $('#vInvoiceAcceptanceLevel [index='+invacpt_auth2_index+']').attr('selected',true);
          $('#vInvoiceAcceptanceLevel [index='+invacpt_auth1_index+']').attr('selected',true);
     }
     if($('#vInvoiceAcceptanceLevel [index='+invacpt_auth2_index+']').attr('selected')) {
        $('#vInvoiceAcceptanceLevel [index='+invacpt_auth1_index+']').attr('selected',true);
     }
});
invacpt.click(function() {
     if($('#vInvoiceAcceptanceLevel [index='+invacpt_auth3_index+']').attr('selected')) {
          $('#vInvoiceAcceptanceLevel [index='+invacpt_auth2_index+']').attr('selected',true);
          $('#vInvoiceAcceptanceLevel [index='+invacpt_auth1_index+']').attr('selected',true);
     }
     if($('#vInvoiceAcceptanceLevel [index='+invacpt_auth2_index+']').attr('selected')) {
        $('#vInvoiceAcceptanceLevel [index='+invacpt_auth1_index+']').attr('selected',true);
     }
});

$.each(ordacpt_optns, function(i,el) {
   if($(this).text() == 'Auth1') {
     ordacpt_auth1_index = $(this).attr('index');
   }
   if($(this).text() == 'Auth2') {
     ordacpt_auth2_index = $(this).attr('index');
   }
   if($(this).text() == 'Auth3') {
     ordacpt_auth3_index = $(this).attr('index');
   }
});
ordacpt.keyup(function() {
     if($('#vOrderAcceptanceLevel [index='+ordacpt_auth3_index+']').attr('selected')) {
          $('#vOrderAcceptanceLevel [index='+ordacpt_auth2_index+']').attr('selected',true);
          $('#vOrderAcceptanceLevel [index='+ordacpt_auth1_index+']').attr('selected',true);
     }
     if($('#vOrderAcceptanceLevel [index='+ordacpt_auth2_index+']').attr('selected')) {
        $('#vOrderAcceptanceLevel [index='+ordacpt_auth1_index+']').attr('selected',true);
     }
});
ordacpt.click(function() {
     if($('#vOrderAcceptanceLevel [index='+ordacpt_auth3_index+']').attr('selected')) {
          $('#vOrderAcceptanceLevel [index='+ordacpt_auth2_index+']').attr('selected',true);
          $('#vOrderAcceptanceLevel [index='+ordacpt_auth1_index+']').attr('selected',true);
     }
     if($('#vOrderAcceptanceLevel [index='+ordacpt_auth2_index+']').attr('selected')) {
        $('#vOrderAcceptanceLevel [index='+ordacpt_auth1_index+']').attr('selected',true);
     }
}); */

$('#vOrderStatusLevel').click(function() {
   selindx = this.selectedIndex;
   // if(this.selectedIndex>0) {
      $('#vOrderStatusLevel option').each(function() {
         if($(this).attr('index') <= selindx) {
            $(this).attr('selected',true);
         } else {
            $(this).attr('selected',false);
         }
      });
   // }
});
$('#vInvoiceStatusLevel').click(function() {
   selindx = this.selectedIndex;
   // if(this.selectedIndex>0) {
      $('#vInvoiceStatusLevel option').each(function() {
         if($(this).attr('index') <= selindx) {
            $(this).attr('selected',true);
         } else {
            $(this).attr('selected',false);
         }
      });
   // }
});
$('#vInvoiceAcceptanceLevel').click(function() {
   selindx = this.selectedIndex;
   // if(this.selectedIndex>0) {
      $('#vInvoiceAcceptanceLevel option').each(function() {
         if($(this).attr('index') <= selindx) {
            $(this).attr('selected',true);
         } else {
            $(this).attr('selected',false);
         }
      });
   // }
});
$('#vOrderAcceptanceLevel').click(function() {
   selindx = this.selectedIndex;
   // if(this.selectedIndex>0) {
      $('#vOrderAcceptanceLevel option').each(function() {
         if($(this).attr('index') <= selindx) {
            $(this).attr('selected',true);
         } else {
            $(this).attr('selected',false);
         }
      });
   // }
});

$('#vRFQ2AwardStatusLevel').click(function() {
   selindx = this.selectedIndex;
   // if(this.selectedIndex>0) {
      $('#vRFQ2AwardStatusLevel option').each(function() {
         if($(this).attr('index') <= selindx) {
            $(this).attr('selected',true);
         } else {
            $(this).attr('selected',false);
         }
      });
   // }
});
$('#vRFQ2AwardAcceptLevel').click(function() {
   selindx = this.selectedIndex;
   // if(this.selectedIndex>0) {
      $('#vRFQ2AwardAcceptLevel option').each(function() {
         //alert('');
         if($(this).attr('index') <= selindx) {
            $(this).attr('selected',true);
         } else {
            $(this).attr('selected',false);
         }
      });
   // }
});