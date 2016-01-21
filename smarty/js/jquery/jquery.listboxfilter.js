/**
* jQuery Selectbox filter
* author: bigo 
* date: aug/2008
*/
;(function($)
{  
  var BigoFilter = function (src, where, settings) { 
    settings = jQuery.extend({ property: 'text' }, settings);
    $(src).on('keyup',function() {
      var field = $(this)[0];
      var select = $(where)[0];      
      var found = false;
      var fieldvalue = $.trim(field.value);
      var slb = $(select);
      if($.trim(fieldvalue)=='' || fieldvalue.length==0) {
		  slb.find('span>option').unwrap('<span>');
        slb.find('option').show();
      } else {  
		  slb.find('span>option').unwrap('<span>');
        slb.find('option').wrap('<span>').hide();
		  slb.find('span>option:icontains("' + fieldvalue + '")').unwrap('span');
        slb.find('option:icontains("' + fieldvalue + '")').show();
		  slb.find('span>option[value=""]').unwrap('span');
      }
      slb.find('option[value=""]').show();
		if(slb.attr('multiple'))
		{
		  for (var i = 0; i < select.options.length; i++) {
			 if (select.options[i][settings.property].toUpperCase().indexOf(fieldvalue.toUpperCase()) != -1 && select.options[i].value!='') {
				select.options[i].selected = "selected";
			 }
		  }
		}
		else
		{
		  for (var i = 0; i < select.options.length; i++) {
			 if (select.options[i][settings.property].toUpperCase().indexOf(fieldvalue.toUpperCase()) != -1 && select.options[i].value!='') { 	// && select.options[i].selected!='selected'
				found=true; break;
			 }
		  }
		  if (found && $.trim(fieldvalue)!='' && fieldvalue.length>0) { select.selectedIndex = i; }
		  else {
			 if($.trim(fieldvalue)!='' && fieldvalue.length>0) { select.selectedIndex = -1; }
		  }
		}
    }); // function  
  } // main func.
  
  $.fn.bigoFilter = function (where, opts) {    
	var bleh =  new BigoFilter(this, where, opts);    
  } // trigger
 
})(jQuery); // closure