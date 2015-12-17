$(window).resize(function() {	
	//init_charts();
});

$(function() {	
	init_tables();
	//init_charts();
	init_panels();
	init_wysiwyg();
	//init_forms();
	//init_calendar();
	//init_gallery();
	init_sideNavigation();
	//init_logoHover();
	//init_faq();
	//init_notices();
});

function init_wysiwyg() {
	$('textarea.wysiwyg-editor').each(function() {	
		var editor_id = $(this).attr('id');
		new nicEditor({iconsPath : '_layout/scripts/nicEdit/nicEditorIcons.gif'}).panelInstance(editor_id); 
	});
}

function init_panels() {
	$('.panel .collapse').click(function() {	
		if ($(this).closest('.panel').hasClass('collapsed')) {	
			var restoreHeight = $(this).attr('id');
			$(this).closest('.panel').animate({height:restoreHeight+'px'}, function() {   
				$(this).removeClass('collapsed');
			});
		}
		else {
			var currentHeight = $(this).closest('.panel').height();
			$(this).attr('id', currentHeight);
			$(this).closest('.panel').addClass('collapsed').animate({height:'45px'}, function() {	});
		}
	});
	$('.panel .tabs li').click(function() {	
		var parent = $(this).closest('.panel');
		var content = $('a', this).attr('rel');
		$('.tabs .active', parent).removeClass('active');
		$(this).addClass('active');
		$('.tabs-content > .active', parent).removeClass('active');
		$('#'+content).addClass('active');
/*		$('.tabs-content > .active', parent).slideUp('fast', function() {	
			$(this).removeClass('active');
			$('#'+content).slideDown('fast', function() {	
				$(this).addClass('active');
			});
		}); */
		return false;
	});
}

function init_tables() {
	if ($('table.sortable').size()) {	
		$("table.sortable").tablesorter(); 
	}
	if ($('table.resizable').size()) {	
	}	
}

function init_sideNavigation() {
	$("#navigation > li > a").click(function() {
		var parent = $(this).closest('li');
		if ($('ul',parent).size()) {
			if ($(parent).hasClass('active')) {
				$('ul',parent).slideUp('fast',function() {
					$(parent).removeClass('active');
				});
			}
			else {
				$('ul',parent).slideDown('fast');
				$(parent).addClass('active');
			}
			return false;
		}		
	});
    $("#navigation > li > ul > li > a").click(function() {
		var parent = $(this).closest('li');
		if ($('ul',parent).size()) {
			if ($(parent).hasClass('activesub')) {
				$('ul',parent).slideUp('fast',function() {
					$(parent).removeClass('activesub');
				});
			}
			else {
				$('ul',parent).slideDown('fast');
				$(parent).addClass('activesub');
			}
			return false;
		}
	});
}