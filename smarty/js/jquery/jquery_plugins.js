/* JS For JScrollPane With Dependent JS */
/* JQuery EM JS Starts Here */
/**
 * @projectDescription Monitor Font Size Changes with jQuery
 *
 * @version 1.0
 * @author Dave Cardwell
 *
 * jQuery-Em - $Revision: 24 $ ($Date: 2007-08-19 11:24:56 +0100 (Sun, 19 Aug 2007) $)
 * http://davecardwell.co.uk/javascript/jquery/plugins/jquery-em/
 *
 * Copyright ©2007 Dave Cardwell <http://davecardwell.co.uk/>
 *
 * Released under the MIT licence:
 * http://www.opensource.org/licenses/mit-license.php
 */

// Upon $(document).ready()
jQuery(function($) {
    // Configuration
    var eventName = 'emchange';


    // Set up default options.
    $.em = $.extend({
        /**
         * The jQuery-Em version string.
         *
         * @example $.em.version;
         * @desc '1.0a'
         *
         * @property
         * @name version
         * @type String
         * @cat Plugins/Em
         */
        version: '1.0',

        /**
         * The number of milliseconds to wait when polling for changes to the
         * font size.
         *
         * @example $.em.delay = 400;
         * @desc Defaults to 200.
         *
         * @property
         * @name delay
         * @type Number
         * @cat Plugins/Em
         */
        delay: 200,

        /**
         * The element used to detect changes to the font size.
         *
         * @example $.em.element = $('<div />')[0];
         * @desc Default is an empty, absolutely positioned, 100em-wide <div>.
         *
         * @private
         * @property
         * @name element
         * @type Element
         * @cat Plugins/Em
         */
        element: $('<div />').css({ left:     '-100em',
                                    position: 'absolute',
                                    width:    '100em' })
                             .prependTo('body')[0],

        /**
         * The action to perform when a change in the font size is detected.
         *
         * @example $.em.action = function() { ... }
         * @desc The default action is to trigger a global “emchange” event.
         * You probably shouldn’t change this behaviour as other plugins may
         * rely on it, but the option is here for completion.
         *
         * @example $(document).bind('emchange', function(e, cur, prev) {...})
         * @desc Any functions triggered on this event are passed the current
         * font size, and last known font size as additional parameters.
         *
         * @private
         * @property
         * @name action
         * @type Function
         * @cat Plugins/Em
         * @see current
         * @see previous
         */
        action: function() {
            var currentWidth = $.em.element.offsetWidth / 100;

            // If the font size has changed since we last checked…
            if ( currentWidth != $.em.current ) {
                /**
                 * The previous pixel value of the user agent’s font size. See
                 * $.em.current for caveats. Will initially be undefined until
                 * the “emchange” event is triggered.
                 *
                 * @example $.em.previous;
                 * @result 16
                 *
                 * @property
                 * @name previous
                 * @type Number
                 * @cat Plugins/Em
                 * @see current
                 */
                $.em.previous = $.em.current;

                /**
                 * The current pixel value of the user agent’s font size. As
                 * with $.em.previous, this value *may* be subject to minor
                 * browser rounding errors that mean you might not want to
                 * rely upon it as an absolute value.
                 *
                 * @example $.em.current;
                 * @result 14
                 *
                 * @property
                 * @name current
                 * @type Number
                 * @cat Plugins/Em
                 * @see previous
                 */
                $.em.current = currentWidth;

                $.event.trigger(eventName, [$.em.current, $.em.previous]);
            }
        }
    }, $.em );


    /**
     * Bind a function to the emchange event of each matched element.
     *
     * @example $("p").emchange( function() { alert("Hello"); } );
     *
     * @name emchange
     * @type jQuery
     * @param Function fn A function to bind to the emchange event.
     * @cat Plugins/Em
     */

    /**
     * Trigger the emchange event of each matched element.
     *
     * @example $("p").emchange()
     *
     * @name emchange
     * @type jQuery
     * @cat Plugins/Em
     */
    $.fn[eventName] = function(fn) { return fn ? this.bind(eventName, fn)
                                               : this.trigger(eventName); };


    // Store the initial pixel value of the user agent’s font size.
    $.em.current = $.em.element.offsetWidth / 100;

    /**
     * While polling for font-size changes, $.em.iid stores the intervalID in
     * case you should want to cancel with clearInterval().
     *
     * @example window.clearInterval( $.em.iid );
     *
     * @property
     * @name iid
     * @type Number
     * @cat Plugins/Em
     */
    $.em.iid = setInterval( $.em.action, $.em.delay );
});
/* JQuery EM JS Ends Here */

/* OnImagesLoad JS Starts Here */

// if(!window.jQuery){throw("jQuery must be referenced before using the 'onImagesLoad' plugin.");}
/*
* jQuery 'onImagesLoaded' plugin 1.0.5
* Fires a callback function when all images have loaded within a particular selector.
*
* Copyright (c) Cirkuit Networks, Inc. (http://www.cirkuit.net), 2008.
* Dual licensed under the MIT and GPL licenses:
*   http://www.opensource.org/licenses/mit-license.php
*   http://www.gnu.org/licenses/gpl.html
*
* For documentation and usage, visit "http://includes.cirkuit.net/js/jquery/plugins/onImagesLoad/1.0/documentation/"
*/
(function($){
  $.fn.onImagesLoad = function(options){
    var opts = $.extend({}, $.fn.onImagesLoad.defaults, options);

    return this.each(function(){
      var container = this;
      var $imgs = $('img', container);
      if($imgs.length === 0 && opts.callbackIfNoImagesExist && opts.callback){
        opts.callback(container); //call callback immediately if no images were in selection
      }
      var loadedImages = [];
      $imgs.each(function(i, val){
        $(this).bind('load', function(){
          if(jQuery.inArray(i, loadedImages) == -1){ //don't double count images
            loadedImages.push(i); //keep a record of images we've seen
            if(loadedImages.length == $imgs.length){
              if(opts.callback){ opts.callback(container); }
            }
          }
        }).each(function(){
          if(this.complete || this.complete===undefined){ this.src = this.src; } //needed for potential cached images
        });
      });
    });
  };

  $.fn.onImagesLoad.defaults = {
    callback: null, //the function you want called when all images within $(yourSelector) have loaded
    callbackIfNoImagesExist: true //if no images exist within $(yourSelector), should the callback be called?
  };

})(jQuery);
/* OnImagesLoad JS Ends Here */

/* JQuery MouseWheel JS Starts Here */

/* Copyright (c) 2006 Brandon Aaron (brandon.aaron@gmail.com || http://brandonaaron.net)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 * Thanks to: http://adomas.org/javascript-mouse-wheel/ for some pointers.
 * Thanks to: Mathias Bank(http://www.mathias-bank.de) for a scope bug fix.
 *
 * $LastChangedDate: 2007-12-20 09:02:08 -0600 (Thu, 20 Dec 2007) $
 * $Rev: 4265 $
 *
 * Version: 3.0
 *
 * Requires: $ 1.2.2+
 */

(function($) {

$.event.special.mousewheel = {
	setup: function() {
		var handler = $.event.special.mousewheel.handler;

		// Fix pageX, pageY, clientX and clientY for mozilla
		if ( $.browser.mozilla )
			$(this).bind('mousemove.mousewheel', function(event) {
				$.data(this, 'mwcursorposdata', {
					pageX: event.pageX,
					pageY: event.pageY,
					clientX: event.clientX,
					clientY: event.clientY
				});
			});

		if ( this.addEventListener )
			this.addEventListener( ($.browser.mozilla ? 'DOMMouseScroll' : 'mousewheel'), handler, false);
		else
			this.onmousewheel = handler;
	},

	teardown: function() {
		var handler = $.event.special.mousewheel.handler;

		$(this).unbind('mousemove.mousewheel');

		if ( this.removeEventListener )
			this.removeEventListener( ($.browser.mozilla ? 'DOMMouseScroll' : 'mousewheel'), handler, false);
		else
			this.onmousewheel = function(){};

		$.removeData(this, 'mwcursorposdata');
	},

	handler: function(event) {
		var args = Array.prototype.slice.call( arguments, 1 );

		event = $.event.fix(event || window.event);
		// Get correct pageX, pageY, clientX and clientY for mozilla
		$.extend( event, $.data(this, 'mwcursorposdata') || {} );
		var delta = 0, returnValue = true;

		if ( event.wheelDelta ) delta = event.wheelDelta/120;
		if ( event.detail     ) delta = -event.detail/3;
//		if ( $.browser.opera  ) delta = -event.wheelDelta;

		event.data  = event.data || {};
		event.type  = "mousewheel";

		// Add delta to the front of the arguments
		args.unshift(delta);
		// Add event to the front of the arguments
		args.unshift(event);

		return $.event.handle.apply(this, args);
	}
};

$.fn.extend({
	mousewheel: function(fn) {
		return fn ? this.bind("mousewheel", fn) : this.trigger("mousewheel");
	},

	unmousewheel: function(fn) {
		return this.unbind("mousewheel", fn);
	}
});

})(jQuery);
/* JQuery MouseWheel JS Ends Here */

/* JScrollPane JS Starts Here */

(function($) {
$.jScrollPane = {
	active : []
};
$.fn.jScrollPane = function(settings)
{
 settings = $.extend({}, $.fn.jScrollPane.defaults, settings);

	var rf = function() { return false; };

	return this.each(
		function()
		{
            var $this = $(this);
   			// Switch the element's overflow to hidden to ensure we get the size of the element without the scrollbars [http://plugins.jquery.com/node/1208]
   			$this.css('overflow', 'hidden');
   			var paneEle = this;
            if ($(this).parent().is('.jScrollPaneContainer')) {
   				var currentScrollPosition = settings.maintainPosition ? $this.position().top : 0;
   				var $c = $(this).parent();
   				var paneWidth = $c.innerWidth();
   				var paneHeight = $c.outerHeight();
   				var trackHeight = paneHeight;
   				$('>.jScrollPaneTrack, >.jScrollArrowUp, >.jScrollArrowDown', $c).remove();
   				$this.css({'top':0});
					/*var currentScrollPosition = 0;
   				this.originalPadding = $this.css('paddingTop') + ' ' + $this.css('paddingRight') + ' ' + $this.css('paddingBottom') + ' ' + $this.css('paddingLeft');
   				this.originalSidePaddingTotal = (parseInt($this.css('paddingLeft')) || 0) + (parseInt($this.css('paddingRight')) || 0);
   				var paneWidth = $this.innerWidth()+100;
   				var paneHeight = $this.innerHeight();
   				var trackHeight = paneHeight;
   				$this.css({'top':0});*/
   			} else {
   				var currentScrollPosition = 0;
   				this.originalPadding = $this.css('paddingTop') + ' ' + $this.css('paddingRight') + ' ' + $this.css('paddingBottom') + ' ' + $this.css('paddingLeft');
   				this.originalSidePaddingTotal = (parseInt($this.css('paddingLeft')) || 0) + (parseInt($this.css('paddingRight')) || 0);
   				var paneWidth = $this.innerWidth();
   				var paneHeight = $this.innerHeight();
   				var trackHeight = paneHeight;
   				$this.wrap(
   					$('<div></div>').attr(
   						{'className':'jScrollPaneContainer'}
   					).css(
   						{
   							'height':paneHeight+'px',
   							'width':paneWidth+'px'
   						}
   					)
   				);
   				// deal with text size changes (if the jquery.em plugin is included)
   				// and re-initialise the scrollPane so the track maintains the
   				// correct size
   				$(document).bind(
   					'emchange',
   					function(e, cur, prev)
   					{
   						$this.jScrollPane(settings);
   					}
   				);
   			}

			if (settings.reinitialiseOnImageLoad) {
				// code inspired by jquery.onImagesLoad: http://plugins.jquery.com/project/onImagesLoad
				// except we re-initialise the scroll pane when each image loads so that the scroll pane is always up to size...
				// TODO: Do I even need to store it in $.data? Is a local variable here the same since I don't pass the reinitialiseOnImageLoad when I re-initialise?
				var $imagesToLoad = $.data(paneEle, 'jScrollPaneImagesToLoad') || $('img', $this);
				var loadedImages = [];

				if ($imagesToLoad.length) {
					$imagesToLoad.each(function(i, val)	{
						$(this).bind('load', function() {
							if($.inArray(i, loadedImages) == -1){ //don't double count images
								loadedImages.push(val); //keep a record of images we've seen
								$imagesToLoad = $.grep($imagesToLoad, function(n, i) {
									return n != val;
								});
								$.data(paneEle, 'jScrollPaneImagesToLoad', $imagesToLoad);
								settings.reinitialiseOnImageLoad = false;
								$this.jScrollPane(settings); // re-initialise
							}
						}).each(function(i, val) {
							if(this.complete || this.complete===undefined) {
								//needed for potential cached images
								this.src = this.src;
							}
						});
					});
				};
			}

			var p = this.originalSidePaddingTotal;

			var cssToApply = {
				'height':'auto',
				'width':paneWidth - settings.scrollbarWidth - settings.scrollbarMargin - p + 'px'
			}

			if(settings.scrollbarOnLeft) {
				cssToApply.paddingLeft = settings.scrollbarMargin + settings.scrollbarWidth + 'px';
			} else {
				cssToApply.paddingRight = settings.scrollbarMargin + 'px';
			}

			$this.css(cssToApply);
			el = settings.el;
			eladd = settings.eladd;
			var ht = parseInt($(el).height())+parseInt(eladd);
			var contentHeight = $this.outerHeight();
			if(ht>contentHeight) {
				contentHeight = ht;
			}
			// alert($(el).height());
			// alert(contentHeight);
			// alert(paneHeight);
			var percentInView = paneHeight / contentHeight;

			if (percentInView < .99) {
				var $container = $this.parent();
				$container.append(
					$('<div></div>').attr({'className':'jScrollPaneTrack'}).css({'width':settings.scrollbarWidth+'px'}).append(
						$('<div></div>').attr({'className':'jScrollPaneDrag'}).css({'width':settings.scrollbarWidth+'px'}).append(
							$('<div></div>').attr({'className':'jScrollPaneDragTop'}).css({'width':settings.scrollbarWidth+'px'}),
							$('<div></div>').attr({'className':'jScrollPaneDragBottom'}).css({'width':settings.scrollbarWidth+'px'})
						)
					)
				);

				var $track = $('>.jScrollPaneTrack', $container);
				var $drag = $('>.jScrollPaneTrack .jScrollPaneDrag', $container);
				// alert($container.attr('class'));
				if(!$drag[0]) {
					var $cnt = $('div.jScrollPaneContainer');
					var $track = $('div .jScrollPaneTrack', $cnt);
					var $drag = $('div .jScrollPaneTrack .jScrollPaneDrag', $cnt);
					// alert($drag[0]);
				}

				if (settings.showArrows) {

					var currentArrowButton;
					var currentArrowDirection;
					var currentArrowInterval;
					var currentArrowInc;
					var whileArrowButtonDown = function()
					{
						if (currentArrowInc > 4 || currentArrowInc%4==0) {
							positionDrag(dragPosition + currentArrowDirection * mouseWheelMultiplier);
						}
						currentArrowInc ++;
					};
					var onArrowMouseUp = function(event)
					{
						$('html').unbind('mouseup', onArrowMouseUp);
						currentArrowButton.removeClass('jScrollActiveArrowButton');
						clearInterval(currentArrowInterval);
					};
					var onArrowMouseDown = function() {
						$('html').bind('mouseup', onArrowMouseUp);
						currentArrowButton.addClass('jScrollActiveArrowButton');
						currentArrowInc = 0;
						whileArrowButtonDown();
						currentArrowInterval = setInterval(whileArrowButtonDown, 100);
					};
					$container
						.append(
							$('<a></a>')
								.attr({'href':'javascript:;', 'className':'jScrollArrowUp'})
								.css({'width':settings.scrollbarWidth+'px'})
								.html('Scroll up')
								.bind('mousedown', function()
								{
									currentArrowButton = $(this);
									currentArrowDirection = -1;
									onArrowMouseDown();
									this.blur();
									return false;
								})
								.bind('click', rf),
							$('<a></a>')
								.attr({'href':'javascript:;', 'className':'jScrollArrowDown'})
								.css({'width':settings.scrollbarWidth+'px'})
								.html('Scroll down')
								.bind('mousedown', function()
								{
									currentArrowButton = $(this);
									currentArrowDirection = 1;
									onArrowMouseDown();
									this.blur();
									return false;
								})
								.bind('click', rf)
						);
					var $upArrow = $('>.jScrollArrowUp', $container);
					var $downArrow = $('>.jScrollArrowDown', $container);
					if (settings.arrowSize) {
						trackHeight = paneHeight - settings.arrowSize - settings.arrowSize;
						$track
							.css({'height': trackHeight+'px', top:settings.arrowSize+'px'})
					} else {
						var topArrowHeight = $upArrow.height();
						settings.arrowSize = topArrowHeight;
						trackHeight = paneHeight - topArrowHeight - $downArrow.height();
						$track
							.css({'height': trackHeight+'px', top:topArrowHeight+'px'})
					}
				}

				var $pane = $(this).css({'position':'absolute', 'overflow':'visible'});

				var currentOffset;
				var maxY;
				var mouseWheelMultiplier;
				// store this in a seperate variable so we can keep track more accurately than just updating the css property..
				var dragPosition = 0;
				var dragMiddle = percentInView*paneHeight/2;

				// pos function borrowed from tooltip plugin and adapted...
				var getPos = function (event, c) {
					var p = c == 'X' ? 'Left' : 'Top';
					return event['page' + c] || (event['client' + c] + (document.documentElement['scroll' + p] || document.body['scroll' + p])) || 0;
				};

				var ignoreNativeDrag = function() {	return false; };

				var initDrag = function()
				{
					ceaseAnimation();
					currentOffset = $drag.offset(false);
               if(currentOffset != null) {
					   currentOffset.top -= dragPosition;
               }
					if($drag[0]) {
						maxY = trackHeight - $drag[0].offsetHeight;
					} else {
						// $drag[0] = $('div.jScrollPaneDrag');
						// maxY = trackHeight - $drag[0].offsetHeight;
						maxY = trackHeight + 100;
					}
					mouseWheelMultiplier = 2 * settings.wheelSpeed * maxY / contentHeight;
				};

				var onStartDrag = function(event)
				{
					initDrag();
					dragMiddle = getPos(event, 'Y') - dragPosition - currentOffset.top;
					$('html').bind('mouseup', onStopDrag).bind('mousemove', updateScroll);
					if ($.browser.msie) {
						$('html').bind('dragstart', ignoreNativeDrag).bind('selectstart', ignoreNativeDrag);
					}
					return false;
				};
				var onStopDrag = function()
				{
					$('html').unbind('mouseup', onStopDrag).unbind('mousemove', updateScroll);
					dragMiddle = percentInView*paneHeight/2;
					if ($.browser.msie) {
						$('html').unbind('dragstart', ignoreNativeDrag).unbind('selectstart', ignoreNativeDrag);
					}
				};
				var positionDrag = function(destY)
				{
					destY = destY < 0 ? 0 : (destY > maxY ? maxY : destY);
					dragPosition = destY;
					$drag.css({'top':destY+'px'});
					var p = destY / maxY;
					$pane.css({'top':((paneHeight-contentHeight)*p) + 'px'});
					$this.trigger('scroll');
					if (settings.showArrows) {
						$upArrow[destY == 0 ? 'addClass' : 'removeClass']('disabled');
						$downArrow[destY == maxY ? 'addClass' : 'removeClass']('disabled');
					}
				};
				var updateScroll = function(e)
				{
					positionDrag(getPos(e, 'Y') - currentOffset.top - dragMiddle);
				};

				var dragH = Math.max(Math.min(percentInView*(paneHeight-settings.arrowSize*2), settings.dragMaxHeight), settings.dragMinHeight);

				$drag.css(
					{'height':dragH+'px'}
				).bind('mousedown', onStartDrag);

				var trackScrollInterval;
				var trackScrollInc;
				var trackScrollMousePos;
				var doTrackScroll = function()
				{
					if (trackScrollInc > 8 || trackScrollInc%4==0) {
						positionDrag((dragPosition - ((dragPosition - trackScrollMousePos) / 2)));
					}
					trackScrollInc ++;
				};
				var onStopTrackClick = function()
				{
					clearInterval(trackScrollInterval);
					$('html').unbind('mouseup', onStopTrackClick).unbind('mousemove', onTrackMouseMove);
				};
				var onTrackMouseMove = function(event)
				{
					trackScrollMousePos = getPos(event, 'Y') - currentOffset.top - dragMiddle;
				};
				var onTrackClick = function(event)
				{
					initDrag();
					onTrackMouseMove(event);
					trackScrollInc = 0;
					$('html').bind('mouseup', onStopTrackClick).bind('mousemove', onTrackMouseMove);
					trackScrollInterval = setInterval(doTrackScroll, 100);
					doTrackScroll();
				};

				$track.bind('mousedown', onTrackClick);

				$container.bind(
					'mousewheel',
					function (event, delta) {
						initDrag();
						ceaseAnimation();
						var dr = dragPosition;
						positionDrag(dragPosition - delta * mouseWheelMultiplier);
						var dragOccured = dr != dragPosition;
						return !dragOccured;
					}
				);

				var _animateToPosition;
				var _animateToInterval;
				function animateToPosition()
				{
					var diff = (_animateToPosition - dragPosition) / settings.animateStep;
					if (diff > 1 || diff < -1) {
						positionDrag(dragPosition + diff);
					} else {
						positionDrag(_animateToPosition);
						ceaseAnimation();
					}
				}
				var ceaseAnimation = function()
				{
					if (_animateToInterval) {
						clearInterval(_animateToInterval);
						delete _animateToPosition;
					}
				};
				var scrollTo = function(pos, preventAni)
				{
					if (typeof pos == "string") {
						$e = $(pos, $this);
						if (!$e.length) return;
						pos = $e.offset().top - $this.offset().top;
					}
					$container.scrollTop(0);
					ceaseAnimation();
					var destDragPosition = -pos/(paneHeight-contentHeight) * maxY;
					if (preventAni || !settings.animateTo) {
						positionDrag(destDragPosition);
					} else {
						_animateToPosition = destDragPosition;
						_animateToInterval = setInterval(animateToPosition, settings.animateInterval);
					}
				};
				$this[0].scrollTo = scrollTo;

				$this[0].scrollBy = function(delta)
				{
					var currentPos = -parseInt($pane.css('top')) || 0;
					scrollTo(currentPos + delta);
				};

				initDrag();

				scrollTo(-currentScrollPosition, true);

				// Deal with it when the user tabs to a link or form element within this scrollpane
				$('*', this).bind(
					'focus',
					function(event)
					{
						var $e = $(this);

						// loop through parents adding the offset top of any elements that are relatively positioned between
						// the focused element and the jScrollPaneContainer so we can get the true distance from the top
						// of the focused element to the top of the scrollpane...
						var eleTop = 0;

						while ($e[0] != $this[0]) {
							eleTop += $e.position().top;
							$e = $e.offsetParent();
						}

						var viewportTop = -parseInt($pane.css('top')) || 0;
						var maxVisibleEleTop = viewportTop + paneHeight;
						var eleInView = eleTop > viewportTop && eleTop < maxVisibleEleTop;
						if (!eleInView) {
							var destPos = eleTop - settings.scrollbarMargin;
							if (eleTop > viewportTop) { // element is below viewport - scroll so it is at bottom.
								destPos += $(this).height() + 15 + settings.scrollbarMargin - paneHeight;
							}
							scrollTo(destPos);
						}
					}
				)


				if (location.hash) {
					scrollTo(location.hash);
				}

				// use event delegation to listen for all clicks on links and hijack them if they are links to
				// anchors within our content...
				$(document).bind(
					'click',
					function(e)
					{
						$target = $(e.target);
						if ($target.is('a')) {
							var h = $target.attr('href');
							if(h) {
								if (h.substr(0, 1) == '#') {
									scrollTo(h);
								}
							}
						}
					}
				);

				$.jScrollPane.active.push($this[0]);

			} else {
				$this.css(
					{
						'height':paneHeight+'px',
						'width':paneWidth-this.originalSidePaddingTotal+'px',
						'padding':this.originalPadding
					}
				);
				// remove from active list?
				$this.parent().unbind('mousewheel');
			}

		}
	)
};

$.fn.jScrollPane.defaults = {
	scrollbarWidth : 10,
	scrollbarMargin : 5,
	wheelSpeed : 18,
	showArrows : false,
	arrowSize : 0,
	animateTo : false,
	dragMinHeight : 1,
	dragMaxHeight : 99999,
	animateInterval : 100,
	animateStep: 3,
	maintainPosition: true,
	scrollbarOnLeft: false,
	reinitialiseOnImageLoad: false
};

// clean up the scrollTo expandos
$(window)
	.bind('unload', function() {
		var els = $.jScrollPane.active;
		for (var i=0; i<els.length; i++) {
			els[i].scrollTo = els[i].scrollBy = null;
		}
	}
);
})(jQuery);

/* Jquery Color Box */
// ColorBox v1.3.16 - a full featured, light-weight, customizable lightbox based on jQuery 1.3+
// Copyright (c) 2011 Jack Moore - jack@colorpowered.com
// Licensed under the MIT license: http://www.opensource.org/licenses/mit-license.php
(function ($, document, window) 
{
	var
	// ColorBox Default Settings.	
	// See http://colorpowered.com/colorbox for details.
	defaults = {
		transition: "elastic",
		speed: 300,
		width: false,
		initialWidth: "600",
		innerWidth: false,
		maxWidth: false,
		height: false,
		initialHeight: "450",
		innerHeight: false,
		maxHeight: false,
		scalePhotos: true,
		scrolling: true,
		inline: false,
		html: false,
		iframe: false,
		fastIframe: true,
		photo: false,
		href: false,
		title: false,
		rel: false,
		opacity: 0.9,
		preloading: true,
		current: "image {current} of {total}",
		previous: "previous",
		next: "next",
		close: "close",
		open: false,
		returnFocus: true,
		loop: true,
		slideshow: false,
		slideshowAuto: true,
		slideshowSpeed: 2500,
		slideshowStart: "start slideshow",
		slideshowStop: "stop slideshow",
		onOpen: false,
		onLoad: false,
		onComplete: false,
		onCleanup: false,
		onClosed: false,
		overlayClose: true,		
		escKey: true,
		arrowKey: true
	},
	
	// Abstracting the HTML and event identifiers for easy rebranding
	colorbox = 'colorbox',
	prefix = 'cbox',
	
	// Events	
	event_open = prefix + '_open',
	event_load = prefix + '_load',
	event_complete = prefix + '_complete',
	event_cleanup = prefix + '_cleanup',
	event_closed = prefix + '_closed',
	event_purge = prefix + '_purge',
	
	// Special Handling for IE
	isIE = $.browser.msie && !$.support.opacity, // feature detection alone gave a false positive on at least one phone browser and on some development versions of Chrome.
	isIE6 = isIE && $.browser.version < 7,
	event_ie6 = prefix + '_IE6',

	// Cached jQuery Object Variables
	$overlay,
	$box,
	$wrap,
	$content,
	$topBorder,
	$leftBorder,
	$rightBorder,
	$bottomBorder,
	$related,
	$window,
	$loaded,
	$loadingBay,
	$loadingOverlay,
	$title,
	$current,
	$slideshow,
	$next,
	$prev,
	$close,
	$groupControls,

	// Variables for cached values or use across multiple functions
	settings = {},
	interfaceHeight,
	interfaceWidth,
	loadedHeight,
	loadedWidth,
	element,
	index,
	photo,
	open,
	active,
	closing = false,
	
	publicMethod,
	boxElement = prefix + 'Element';
	
	// ****************
	// HELPER FUNCTIONS
	// ****************

	// jQuery object generator to reduce code size
	function $div(id, cssText) { 
		var div = document.createElement('div');
		div.id = id ? prefix + id : false;
		div.style.cssText = cssText || false;
		return $(div);
	}

	// Convert % values to pixels
	function setSize(size, dimension) {
		dimension = dimension === 'x' ? $window.width() : $window.height();
		return (typeof size === 'string') ? Math.round((/%/.test(size) ? (dimension / 100) * parseInt(size, 10) : parseInt(size, 10))) : size;
	}
	
	// Checks an href to see if it is a photo.
	// There is a force photo option (photo: true) for hrefs that cannot be matched by this regex.
	function isImage(url) {
		return settings.photo || /\.(gif|png|jpg|jpeg|bmp)(?:\?([^#]*))?(?:#(\.*))?$/i.test(url);
	}
	
	// Assigns function results to their respective settings.  This allows functions to be used as values.
	function process(settings) {
		for (var i in settings) {
			if ($.isFunction(settings[i]) && i.substring(0, 2) !== 'on') { // checks to make sure the function isn't one of the callbacks, they will be handled at the appropriate time.
			    settings[i] = settings[i].call(element);
			}
		}
		settings.rel = settings.rel || element.rel || 'nofollow';
		settings.href = $.trim(settings.href || $(element).attr('href'));
		settings.title = settings.title || element.title;
	}

	function trigger(event, callback) {
		if (callback) {
			callback.call(element);
		}
		$.event.trigger(event);
	}

	// Slideshow functionality
	function slideshow() {
		var
		timeOut,
		className = prefix + "Slideshow_",
		click = "click." + prefix,
		start,
		stop,
		clear;
		
		if (settings.slideshow && $related[1]) {
			start = function () {
				$slideshow
					.text(settings.slideshowStop)
					.unbind(click)
					.bind(event_complete, function () {
						if (index < $related.length - 1 || settings.loop) {
							timeOut = setTimeout(publicMethod.next, settings.slideshowSpeed);
						}
					})
					.bind(event_load, function () {
						clearTimeout(timeOut);
					})
					.one(click + ' ' + event_cleanup, stop);
				$box.removeClass(className + "off").addClass(className + "on");
				timeOut = setTimeout(publicMethod.next, settings.slideshowSpeed);
			};
			
			stop = function () {
				clearTimeout(timeOut);
				$slideshow
					.text(settings.slideshowStart)
					.unbind([event_complete, event_load, event_cleanup, click].join(' '))
					.one(click, start);
				$box.removeClass(className + "on").addClass(className + "off");
			};
			
			if (settings.slideshowAuto) {
				start();
			} else {
				stop();
			}
		}
	}

	function launch(elem) {
		if (!closing) {
			
			element = elem;
			
			process($.extend(settings, $.data(element, colorbox)));
			
			$related = $(element);
			
			index = 0;
			
			if (settings.rel !== 'nofollow') {
				$related = $('.' + boxElement).filter(function () {
					var relRelated = $.data(this, colorbox).rel || this.rel;
					return (relRelated === settings.rel);
				});
				index = $related.index(element);
				
				// Check direct calls to ColorBox.
				if (index === -1) {
					$related = $related.add(element);
					index = $related.length - 1;
				}
			}
			
			if (!open) {
				open = active = true; // Prevents the page-change action from queuing up if the visitor holds down the left or right keys.
				
				$box.show();
				
				if (settings.returnFocus) {
					try {
						element.blur();
						$(element).one(event_closed, function () {
							try {
								this.focus();
							} catch (e) {
								// do nothing
							}
						});
					} catch (e) {
						// do nothing
					}
				}
				
				// +settings.opacity avoids a problem in IE when using non-zero-prefixed-string-values, like '.5'
				$overlay.css({"opacity": +settings.opacity, "cursor": settings.overlayClose ? "pointer" : "auto"}).show();
				
				// Opens inital empty ColorBox prior to content being loaded.
				settings.w = setSize(settings.initialWidth, 'x');
				settings.h = setSize(settings.initialHeight, 'y');
				publicMethod.position(0);
				
				if (isIE6) {
					$window.bind('resize.' + event_ie6 + ' scroll.' + event_ie6, function () {
						$overlay.css({width: $window.width(), height: $window.height(), top: $window.scrollTop(), left: $window.scrollLeft()});
					}).trigger('resize.' + event_ie6);
				}
				
				trigger(event_open, settings.onOpen);
				
				$groupControls.add($title).hide();
				
				$close.html(settings.close).show();
			}
			
			publicMethod.load(true);
		}
	}

	// ****************
	// PUBLIC FUNCTIONS
	// Usage format: $.fn.colorbox.close();
	// Usage from within an iframe: parent.$.fn.colorbox.close();
	// ****************
	
	publicMethod = $.fn[colorbox] = $[colorbox] = function (options, callback) {
		var $this = this, autoOpen;
		
		if (!$this[0] && $this.selector) { // if a selector was given and it didn't match any elements, go ahead and exit.
			return $this;
		}
		
		options = options || {};
		
		if (callback) {
			options.onComplete = callback;
		}
		
		if (!$this[0] || $this.selector === undefined) { // detects $.colorbox() and $.fn.colorbox()
			$this = $('<a/>');
			options.open = true; // assume an immediate open
		}
		
		$this.each(function () {
			$.data(this, colorbox, $.extend({}, $.data(this, colorbox) || defaults, options));
			$(this).addClass(boxElement);
		});
		
		autoOpen = options.open;
		
		if ($.isFunction(autoOpen)) {
			autoOpen = autoOpen.call($this);
		}
		
		if (autoOpen) {
			launch($this[0]);
		}
		
		return $this;
	};

	// Initialize ColorBox: store common calculations, preload the interface graphics, append the html.
	// This preps colorbox for a speedy open when clicked, and lightens the burdon on the browser by only
	// having to run once, instead of each time colorbox is opened.
	publicMethod.init = function () {
		// Create & Append jQuery Objects
		$window = $(window);
		$box = $div().attr({id: colorbox, 'class': isIE ? prefix + (isIE6 ? 'IE6' : 'IE') : ''});
		$overlay = $div("Overlay", isIE6 ? 'position:absolute' : '').hide();
		
		$wrap = $div("Wrapper");
		$content = $div("Content").append(
			$loaded = $div("LoadedContent", 'width:0; height:0; overflow:hidden'),
			$loadingOverlay = $div("LoadingOverlay").add($div("LoadingGraphic")),
			$title = $div("Title"),
			$current = $div("Current"),
			$next = $div("Next"),
			$prev = $div("Previous"),
			$slideshow = $div("Slideshow").bind(event_open, slideshow),
			$close = $div("Close")
		);
		$wrap.append( // The 3x3 Grid that makes up ColorBox
			$div().append(
				$div("TopLeft"),
				$topBorder = $div("TopCenter"),
				$div("TopRight")
			),
			$div(false, 'clear:left').append(
				$leftBorder = $div("MiddleLeft"),
				$content,
				$rightBorder = $div("MiddleRight")
			),
			$div(false, 'clear:left').append(
				$div("BottomLeft"),
				$bottomBorder = $div("BottomCenter"),
				$div("BottomRight")
			)
		).children().children().css({'float': 'left'});
		
		$loadingBay = $div(false, 'position:absolute; width:9999px; visibility:hidden; display:none');
		
		$('body').prepend($overlay, $box.append($wrap, $loadingBay));
		
		$content.children()
		.hover(function () {
			$(this).addClass('hover');
		}, function () {
			$(this).removeClass('hover');
		}).addClass('hover');
		
		// Cache values needed for size calculations
		interfaceHeight = $topBorder.height() + $bottomBorder.height() + $content.outerHeight(true) - $content.height();//Subtraction needed for IE6
		interfaceWidth = $leftBorder.width() + $rightBorder.width() + $content.outerWidth(true) - $content.width();
		loadedHeight = $loaded.outerHeight(true);
		loadedWidth = $loaded.outerWidth(true);
		
		// Setting padding to remove the need to do size conversions during the animation step.
		$box.css({"padding-bottom": interfaceHeight, "padding-right": interfaceWidth}).hide();
		
                // Setup button events.
                $next.click(function () {
                        publicMethod.next();
                });
                $prev.click(function () {
                        publicMethod.prev();
                });
                $close.click(function () {
                        publicMethod.close();
                });
		
		$groupControls = $next.add($prev).add($current).add($slideshow);
		
		// Adding the 'hover' class allowed the browser to load the hover-state
		// background graphics.  The class can now can be removed.
		$content.children().removeClass('hover');
		
		$('.' + boxElement).live('click', function (e) {
			// checks to see if it was a non-left mouse-click and for clicks modified with ctrl, shift, or alt.
			if (!((e.button !== 0 && typeof e.button !== 'undefined') || e.ctrlKey || e.shiftKey || e.altKey)) {
				e.preventDefault();
				launch(this);
			}
		});
		
		$overlay.click(function () {
			if (settings.overlayClose) {
				publicMethod.close();
			}
		});
		
		// Set Navigation Key Bindings
		$(document).bind("keydown", function (e) {
			if (open && settings.escKey && e.keyCode === 27) {
				e.preventDefault();
				publicMethod.close();
			}
			if (open && settings.arrowKey && !active && $related[1]) {
				if (e.keyCode === 37 && (index || settings.loop)) {
					e.preventDefault();
					$prev.click();
				} else if (e.keyCode === 39 && (index < $related.length - 1 || settings.loop)) {
					e.preventDefault();
					$next.click();
				}
			}
		});
	};
	
	publicMethod.remove = function () {
		$box.add($overlay).remove();
		$('.' + boxElement).die('click').removeData(colorbox).removeClass(boxElement);
	};

	publicMethod.position = function (speed, loadedCallback) {
		var
		animate_speed,
		// keeps the top and left positions within the browser's viewport.
		posTop = Math.max(document.documentElement.clientHeight - settings.h - loadedHeight - interfaceHeight, 0) / 2 + $window.scrollTop(),
		posLeft = Math.max($window.width() - settings.w - loadedWidth - interfaceWidth, 0) / 2 + $window.scrollLeft();
		
		// setting the speed to 0 to reduce the delay between same-sized content.
		animate_speed = ($box.width() === settings.w + loadedWidth && $box.height() === settings.h + loadedHeight) ? 0 : speed;
		
		// this gives the wrapper plenty of breathing room so it's floated contents can move around smoothly,
		// but it has to be shrank down around the size of div#colorbox when it's done.  If not,
		// it can invoke an obscure IE bug when using iframes.
		$wrap[0].style.width = $wrap[0].style.height = "9999px";
		
		function modalDimensions(that) {
			// loading overlay height has to be explicitly set for IE6.
			$topBorder[0].style.width = $bottomBorder[0].style.width = $content[0].style.width = that.style.width;
			$loadingOverlay[0].style.height = $loadingOverlay[1].style.height = $content[0].style.height = $leftBorder[0].style.height = $rightBorder[0].style.height = that.style.height;
		}
		
		$box.dequeue().animate({width: settings.w + loadedWidth, height: settings.h + loadedHeight, top: posTop, left: posLeft}, {
			duration: animate_speed,
			complete: function () {
				modalDimensions(this);
				
				active = false;
				
				// shrink the wrapper down to exactly the size of colorbox to avoid a bug in IE's iframe implementation.
				$wrap[0].style.width = (settings.w + loadedWidth + interfaceWidth) + "px";
				$wrap[0].style.height = (settings.h + loadedHeight + interfaceHeight) + "px";
				
				if (loadedCallback) {
					loadedCallback();
				}
			},
			step: function () {
				modalDimensions(this);
			}
		});
	};

	publicMethod.resize = function (options) {
		if (open) {
			options = options || {};
			
			if (options.width) {
				settings.w = setSize(options.width, 'x') - loadedWidth - interfaceWidth;
			}
			if (options.innerWidth) {
				settings.w = setSize(options.innerWidth, 'x');
			}
			$loaded.css({width: settings.w});
			
			if (options.height) {
				settings.h = setSize(options.height, 'y') - loadedHeight - interfaceHeight;
			}
			if (options.innerHeight) {
				settings.h = setSize(options.innerHeight, 'y');
			}
			if (!options.innerHeight && !options.height) {				
				var $child = $loaded.wrapInner("<div style='overflow:auto'></div>").children(); // temporary wrapper to get an accurate estimate of just how high the total content should be.
				settings.h = $child.height();
				$child.replaceWith($child.children()); // ditch the temporary wrapper div used in height calculation
			}
			$loaded.css({height: settings.h});
			
			publicMethod.position(settings.transition === "none" ? 0 : settings.speed);
		}
	};

	publicMethod.prep = function (object) {
		if (!open) {
			return;
		}
		
		var speed = settings.transition === "none" ? 0 : settings.speed;
		
		$window.unbind('resize.' + prefix);
		$loaded.remove();
		$loaded = $div('LoadedContent').html(object);
		
		function getWidth() {
			settings.w = settings.w || $loaded.width();
			settings.w = settings.mw && settings.mw < settings.w ? settings.mw : settings.w;
			return settings.w;
		}
		function getHeight() {
			settings.h = settings.h || $loaded.height();
			settings.h = settings.mh && settings.mh < settings.h ? settings.mh : settings.h;
			return settings.h;
		}
		
		$loaded.hide()
		.appendTo($loadingBay.show())// content has to be appended to the DOM for accurate size calculations.
		.css({width: getWidth(), overflow: settings.scrolling ? 'auto' : 'hidden'})
		.css({height: getHeight()})// sets the height independently from the width in case the new width influences the value of height.
		.prependTo($content);
		
		$loadingBay.hide();
		
		// floating the IMG removes the bottom line-height and fixed a problem where IE miscalculates the width of the parent element as 100% of the document width.
		//$(photo).css({'float': 'none', marginLeft: 'auto', marginRight: 'auto'});
		
                $(photo).css({'float': 'none'});
                
		// Hides SELECT elements in IE6 because they would otherwise sit on top of the overlay.
		if (isIE6) {
			$('select').not($box.find('select')).filter(function () {
				return this.style.visibility !== 'hidden';
			}).css({'visibility': 'hidden'}).one(event_cleanup, function () {
				this.style.visibility = 'inherit';
			});
		}
		
		function setPosition(s) {
			publicMethod.position(s, function () {
				var prev, prevSrc, next, nextSrc, total = $related.length, iframe, complete;
				
				if (!open) {
					return;
				}
				
				complete = function () {
					$loadingOverlay.hide();
					trigger(event_complete, settings.onComplete);
				};
				
				if (isIE) {
					//This fadeIn helps the bicubic resampling to kick-in.
					if (photo) {
						$loaded.fadeIn(100);
					}
				}
				
				$title.html(settings.title).add($loaded).show();
				
				if (total > 1) { // handle grouping
					if (typeof settings.current === "string") {
						$current.html(settings.current.replace(/\{current\}/, index + 1).replace(/\{total\}/, total)).show();
					}
					
					$next[(settings.loop || index < total - 1) ? "show" : "hide"]().html(settings.next);
					$prev[(settings.loop || index) ? "show" : "hide"]().html(settings.previous);
					
					prev = index ? $related[index - 1] : $related[total - 1];
					next = index < total - 1 ? $related[index + 1] : $related[0];
					
					if (settings.slideshow) {
						$slideshow.show();
					}
					
					// Preloads images within a rel group
					if (settings.preloading) {
						nextSrc = $.data(next, colorbox).href || next.href;
						prevSrc = $.data(prev, colorbox).href || prev.href;
						
						nextSrc = $.isFunction(nextSrc) ? nextSrc.call(next) : nextSrc;
						prevSrc = $.isFunction(prevSrc) ? prevSrc.call(prev) : prevSrc;
						
						if (isImage(nextSrc)) {
							$('<img/>')[0].src = nextSrc;
						}
						
						if (isImage(prevSrc)) {
							$('<img/>')[0].src = prevSrc;
						}
					}
				} else {
					$groupControls.hide();
				}
				
				if (settings.iframe) {
					iframe = $('<iframe frameborder=0/>').addClass(prefix + 'Iframe')[0];
					
					if (settings.fastIframe) {
						complete();
					} else {
						$(iframe).load(complete);
					}
					iframe.name = prefix + (+new Date());
					iframe.src = settings.href;
					
					if (!settings.scrolling) {
						iframe.scrolling = "no";
					}
					
					if (isIE) {
						iframe.allowTransparency = "true";
					}
					
					$(iframe).appendTo($loaded).one(event_purge, function () {
						iframe.src = "//about:blank";
					});
				} else {
					complete();
				}
				
				if (settings.transition === 'fade') {
					$box.fadeTo(speed, 1, function () {
						$box[0].style.filter = "";
					});
				} else {
                                        $box[0].style.filter = "";
				}
				
				$window.bind('resize.' + prefix, function () {
					publicMethod.position(0);
				});
			});
		}
		
		if (settings.transition === 'fade') {
			$box.fadeTo(speed, 0, function () {
				setPosition(0);
			});
		} else {
			setPosition(speed);
		}
	};

	publicMethod.load = function (launched) {
		var href, setResize, prep = publicMethod.prep;
		
		active = true;
		
		photo = false;
		
		element = $related[index];
		
		if (!launched) {
			process($.extend(settings, $.data(element, colorbox)));
		}
		
		trigger(event_purge);
		
		trigger(event_load, settings.onLoad);
		
		settings.h = settings.height ?
				setSize(settings.height, 'y') - loadedHeight - interfaceHeight :
				settings.innerHeight && setSize(settings.innerHeight, 'y');
		
		settings.w = settings.width ?
				setSize(settings.width, 'x') - loadedWidth - interfaceWidth :
				settings.innerWidth && setSize(settings.innerWidth, 'x');
		
		// Sets the minimum dimensions for use in image scaling
		settings.mw = settings.w;
		settings.mh = settings.h;
		
		// Re-evaluate the minimum width and height based on maxWidth and maxHeight values.
		// If the width or height exceed the maxWidth or maxHeight, use the maximum values instead.
		if (settings.maxWidth) {
			settings.mw = setSize(settings.maxWidth, 'x') - loadedWidth - interfaceWidth;
			settings.mw = settings.w && settings.w < settings.mw ? settings.w : settings.mw;
		}
		if (settings.maxHeight) {
			settings.mh = setSize(settings.maxHeight, 'y') - loadedHeight - interfaceHeight;
			settings.mh = settings.h && settings.h < settings.mh ? settings.h : settings.mh;
		}
		
		href = settings.href;
		
		$loadingOverlay.show();

		if (settings.inline) {
			// Inserts an empty placeholder where inline content is being pulled from.
			// An event is bound to put inline content back when ColorBox closes or loads new content.
			$div().hide().insertBefore($(href)[0]).one(event_purge, function () {
				$(this).replaceWith($loaded.children());
			});
			prep($(href));
		} else if (settings.iframe) {
			// IFrame element won't be added to the DOM until it is ready to be displayed,
			// to avoid problems with DOM-ready JS that might be trying to run in that iframe.
			prep(" ");
		} else if (settings.html) {
			prep(settings.html);
		} else if (isImage(href)) {
			$(photo = new Image())
			.addClass(prefix + 'Photo')
			.error(function () {
				settings.title = false;
				prep($div('Error').text('This image could not be loaded'));
			})
			.load(function () {
				var percent;
				photo.onload = null; //stops animated gifs from firing the onload repeatedly.
				
				if (settings.scalePhotos) {
					setResize = function () {
						photo.height -= photo.height * percent;
						photo.width -= photo.width * percent;	
					};
					if (settings.mw && photo.width > settings.mw) {
						percent = (photo.width - settings.mw) / photo.width;
						setResize();
					}
					if (settings.mh && photo.height > settings.mh) {
						percent = (photo.height - settings.mh) / photo.height;
						setResize();
					}
				}
				
				if (settings.h) {
					photo.style.marginTop = Math.max(settings.h - photo.height, 0) / 2 + 'px';
				}
				
				if ($related[1] && (index < $related.length - 1 || settings.loop)) {
					photo.style.cursor = 'pointer';
					photo.onclick = function () {
                                                publicMethod.next();
                                        };
				}
				
				if (isIE) {
					photo.style.msInterpolationMode = 'bicubic';
				}
				
				setTimeout(function () { // A pause because Chrome will sometimes report a 0 by 0 size otherwise.
					prep(photo);
				}, 1);
			});
			
			setTimeout(function () { // A pause because Opera 10.6+ will sometimes not run the onload function otherwise.
				photo.src = href;
			}, 1);
		} else if (href) {
			$loadingBay.load(href, function (data, status, xhr) {
				prep(status === 'error' ? $div('Error').text('Request unsuccessful: ' + xhr.statusText) : $(this).contents());
			});
		}
	};

	// Navigates to the next page/image in a set.
	publicMethod.next = function () {
		if (!active) {
			index = index < $related.length - 1 ? index + 1 : 0;
			publicMethod.load();
		}
	};
	
	publicMethod.prev = function () {
		if (!active) {
			index = index ? index - 1 : $related.length - 1;
			publicMethod.load();
		}
	};

	// Note: to use this within an iframe use the following format: parent.$.fn.colorbox.close();
	publicMethod.close = function () {
		if (open && !closing) {
			
			closing = true;
			
			open = false;
			
			trigger(event_cleanup, settings.onCleanup);
			
			$window.unbind('.' + prefix + ' .' + event_ie6);
			
			$overlay.fadeTo(200, 0);
			
			$box.stop().fadeTo(300, 0, function () {
                                
				$box.add($overlay).css({'opacity': 1, cursor: 'auto'}).hide();
				
				trigger(event_purge);
				
				$loaded.remove();
				
				setTimeout(function () {
					closing = false;
					trigger(event_closed, settings.onClosed);
				}, 1);
			});
		}
	};

	// A method for fetching the current element ColorBox is referencing.
	// returns a jQuery object.
	publicMethod.element = function () {
		return $(element);
	};

	publicMethod.settings = defaults;
	// Initializes ColorBox when the DOM has loaded
	$(publicMethod.init);
}(jQuery, document, this));
/* *** */

/**
* jQuery Watch Attributes Plugin v 1.0.0 (2010)
* Written By: Darcy Clarke
* URL: http://darcyclarke.me/
*/
jQuery.fn.watch = function(props, callback, timeout)
{
	var $ = jQuery;
	if(!timeout)
		timeout = 10;
	return this.each(function(){
		var el 		= $(this), 
			func 	= function(){ __check.call(this, el) },
			data 	= {	props: 	props.split(","),
						func: 	callback,
						vals: 	[] };
		$.each(data.props, function(i) { data.vals[i] = el.css(data.props[i]); });
		el.data(data);
		if (typeof (this.onpropertychange) == "object"){
			el.bind("propertychange", callback);
		} else if ($.browser.mozilla){
			el.bind("DOMAttrModified", callback);
		} else {
			setInterval(func, timeout);
		}
	});
	function __check(el) {
		var data 	= el.data(),
			changed = false,
			temp	= "";
		for(var i=0;i < data.props.length; i++) {
			temp = el.css(data.props[i]);
			if(data.vals[i] != temp){
				data.vals[i] = temp;
				changed = true;
				break;
			}
		}
		if(changed && data.func) {
			data.func.call(el, data);
		}
	}
}

// Functions ---------- //

function textfilter(bto,bfor,bev) {
	 $(bto).bind(bev, function(event) {
	    if($.trim($(this).val())=='') {
				$(bfor).show();
		  } else {
				$(bfor+':not(:icontains('+$.trim($(this).val())+'))').hide();
				$(bfor+':icontains('+$.trim($(this).val())+')').show();
		  }
	 });
}
// ---------- //