jQuery(document).ready(function () {


    jQuery('.leftpanel .nav .parent > a').click(function () {

        var coll = jQuery(this).parents('.collapsed').length;

        if (!coll) {
            jQuery('.leftpanel .nav .parent-focus').each(function () {
                jQuery(this).find('.children').slideUp('fast');
                jQuery(this).removeClass('parent-focus');
            });

            var child = jQuery(this).parent().find('.children');
            if (!child.is(':visible')) {
                child.slideDown('fast');
                if (!child.parent().hasClass('active'))
                    child.parent().addClass('parent-focus');
            } else {
                child.slideUp('fast');
                child.parent().removeClass('parent-focus');
            }
        }
        return false;
    });

    // Menu Toggle
    jQuery('.menu-collapse').click(function () {
        if (!$('body').hasClass('hidden-left')) {
            if ($('.headerwrapper').hasClass('collapsed')) {
                $('.headerwrapper, .mainwrapper').removeClass('collapsed');
            } else {
                $('.headerwrapper, .mainwrapper').addClass('collapsed');
                $('.children').hide(); // hide sub-menu if leave open
            }
        } else {
            if (!$('body').hasClass('show-left')) {
                $('body').addClass('show-left');
            } else {
                $('body').removeClass('show-left');
            }
        }
        return false;
    });

    // Add class nav-hover to mene. Useful for viewing sub-menu
    jQuery('.leftpanel .nav li').hover(function () {
        $(this).addClass('nav-hover');
    }, function () {
        $(this).removeClass('nav-hover');
    });

    // get cache
    {
        var active = $.cookie('leftpanel_active');
        if (active) {
            jQuery("#" + active).addClass("active");
        }
    };

    //  cache
    jQuery('.leftpanel .nav li:not(.parent) > a').click(function () {
        var active = jQuery(this).parents(".parent").attr("id");
        if (active) {
            $.cookie('leftpanel_active', active, { path: '/' });
        }
        else {
            $.removeCookie('leftpanel_active', { path: '/' }); // => true            
        }

    });

    // For Media Queries
    jQuery(window).resize(function () {
        hideMenu();
    });

    hideMenu(); // for loading/refreshing the page
    function hideMenu() {

        if ($('.header-right').css('position') == 'relative') {
            $('body').addClass('hidden-left');
            $('.headerwrapper, .mainwrapper').removeClass('collapsed');
        } else {
            $('body').removeClass('hidden-left');
        }

        // Seach form move to left
        if ($(window).width() <= 360) {
            if ($('.leftpanel .form-search').length == 0) {
                $('.form-search').insertAfter($('.profile-left'));
            }
        } else {
            if ($('.header-right .form-search').length == 0) {
                $('.form-search').insertBefore($('.btn-group-notification'));
            }
        }
    }

    collapsedMenu(); // for loading/refreshing the page
    function collapsedMenu() {

        if ($('.logo').css('position') == 'relative') {
            $('.headerwrapper, .mainwrapper').addClass('collapsed');
        } else {
            $('.headerwrapper, .mainwrapper').removeClass('collapsed');
        }
    }

    // select 2
    if ($.fn.select2)
        $.fn.select2.defaults.set("theme", "bootstrap");
});