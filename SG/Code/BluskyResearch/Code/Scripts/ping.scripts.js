//----------------------------------------------------------------------------- 
// Jquery functions
// Built:   04/06/2012
// Desc:    General site-wide JQuery function calls
//-----------------------------------------------------------------------------

jQuery.noConflict();

function pageLoad(sender, args) {
    if (args.get_isPartialLoad()) {
        LoadFormStyling();
        LoadBackToTop();
    }
}

jQuery(document).ready(function () {
    LoadFormStyling();
    LoadBackToTop();
});

//--- Forms
function LoadFormStyling() {
    jQuery("select, input[type='checkbox'], input[type='radio']").uniform();
}

//--- Back to Top
function LoadBackToTop() {
    var offset = 220;
    var duration = 500;
    jQuery(window).scroll(function () {
        if (jQuery(this).scrollTop() > offset) {
            jQuery('.f_top').fadeIn(duration);
        } else {
            jQuery('.f_top').fadeOut(duration);
        }
    });

    jQuery('.f_top').click(function (event) {
        event.preventDefault();
        jQuery('html, body').animate({ scrollTop: 0 }, duration);
        return false;
    })
}
