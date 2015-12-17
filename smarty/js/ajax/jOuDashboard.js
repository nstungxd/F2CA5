// set the list selector
var setSelector = "div.sortable";
// set the cookie name
var setCookieName = "listOrder";

// function that restores the list order from a cookie
function restoreOrder() {
	var list = $(setSelector);
	if (list == null) return

	// make array from saved order
	var IDs = cookie.split(",");

	// fetch current order
	var items = list.sortable("toArray");

	// make array from current order
	var rebuild = new Array();
	for ( var v=0, len=items.length; v<len; v++ ){
		rebuild[items[v]] = items[v];
	}

	for (var i = 0, n = IDs.length; i < n; i++) {

		// item id from saved order
		var itemID = IDs[i];

		if (itemID in rebuild) {

			// select item id from current order
			var item = rebuild[itemID];

			// select the item according to current order
			var child = $("div.sortable.ui-sortable").children("#" + item);

			// select the item according to the saved order
			var savedOrd = $("div.sortable.ui-sortable").children("#" + itemID);

			// remove all the items
			child.remove();

			// add the items in turn according to saved order
			// we need to filter here since the "ui-sortable"
			// class is applied to all ul elements and we
			// only want the very first!  You can modify this
			// to support multiple lists - not tested!
			$("div.sortable.ui-sortable").filter(":first").append(savedOrd);
		}
	}
}

jQuery(document).ready(function() {
	jQuery("div.sortable").sortable({axis: "y",
		cursor: ".sortable",
		update: function() {
		 var order1 = $('#one').sortable("toArray");
       //alert(order1);
       order ='&order='+order1;
       $.post(SITE_URL+"index.php?file=u-updateDashboard", order, function(theResponse){});
      }
	});
	
	$(".plusminus-img").live("click", function() {
		// alert($(this).parent().parent('div').children('div').css('display'));
		if($(this).parent().parent('div').children('div').css('display') == 'block') {
			$(this).parent().parent('div').children('div').css('display','none');
		} else {
			$(this).parent().parent('div').children('div').css('display','block');
		}
   	// $(this).parent().parent('div').children('div').toggle();
      if($(this).attr('src') == SITE_IMAGES+'sm_images/minus-icon.gif'){
         $(this).attr('src',SITE_IMAGES+'sm_images/plus-icon.gif');
      } else {
         $(this).attr('src',SITE_IMAGES+'sm_images/minus-icon.gif');
      }
   });
	// reloads the saved order
	restoreOrder();
});

function showlist(itm,typ,id,lvl)
{
	// alert(id); return false;
	var linkpage = '';
	var vl = '';
	var srchfor = '';
	var srchval = typ;
	if(itm == 'Invoice') {
		if(lvl == 'isu') {
			linkpage = 'invoicelist';
		} else if(lvl == 'acpt') {
			linkpage = 'invacptlist';
		}
	} else if(itm == 'PO') {
		if(lvl == 'isu') {
			linkpage = 'polist';
		} else if(lvl == 'acpt') {
			linkpage = 'poacptlist';
		}
	} else {
		linkpage = itm;
	}
	if(typ == 'Verify' || typ == 'Issue' || typ == 'Auth1' || typ == 'Auth2' || typ == 'Auth3' || typ == 'Issued' || typ == 'Accepted' || typ == 'Rejected') {
		vl = id;
	} else {
		vl = id; // 'all';
		srchval = id;
	}
	// alert(linkpage+'='+srchfor+'-'+srchval); return false;

/*	$('#srchfor').val(srchfor);
	$('#srchval').val(srchval);
	$('#golist').attr('action',SITE_URL_DUM+linkpage+"/"+vl);
	$('#golist').submit();
*/
	window.location = SITE_URL_DUM+linkpage+"/"+vl;
}