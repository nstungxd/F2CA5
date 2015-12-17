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
       $.post(SITE_URL+"index.php?file=or-updateDashboard", order, function(theResponse){});
      }
	});
	// here, we reload the saved order
	restoreOrder();
   $(".plusminus-img").click( function() {
   	$(this).parent().parent('div').children('div').toggle();
      if($(this).attr('src') == SITE_IMAGES+'sm_images/minus-icon.gif') {
         $(this).attr('src',SITE_IMAGES+'sm_images/plus-icon.gif');
      } else {
         $(this).attr('src',SITE_IMAGES+'sm_images/minus-icon.gif');
      }
   });
});

function showlist(itm,typ)
{
	var linkpage = '';
	var srchfor = '';
	var srchval = typ;
	if(itm == 'org')
	{
		if(typ == 'nvfy') {
			linkpage = 'verifyorganization';
		} else {
			linkpage = 'organizationlist';
		}
	} else if(itm == 'asoc') {
		if(typ == 'nvfy') {
			linkpage = 'verifyassociationlist';
		} else {
			linkpage = 'associationlist';
		}
	} else if(itm == 'grp') {
		if(typ == 'nvfy') {
			linkpage = 'verifygrouplist';
		} else {
			linkpage = 'grouplist';
		}
	}	else if(itm == 'usr') {
		srchfor = itm;
		if(typ == 'nvfy') {
			linkpage = 'verifyorganizationuserlist';
		} else {
			linkpage = 'organizationuserlist';
		}
	} else if(itm == 'vur') {
		srchfor = itm;
		if(typ == 'nvfy') {
			linkpage = 'verifyrights';
		} else {
			linkpage = 'listrights';
		}
	} else if(itm == 'adm') {
		srchfor = itm;
		if(typ == 'nvfy') {
			linkpage = 'verifyorganizationuserlist';
		} else {
			linkpage = 'organizationuserlist';
		}
	} else {
	  linkpage = itm;
	}
	// alert(linkpage+'='+srchfor+'-'+srchval);
	$('#srchfor').val(srchfor);
	$('#srchval').val(srchval);
	$('#golist').attr('action',SITE_URL_DUM+linkpage);
	$('#golist').submit();
}