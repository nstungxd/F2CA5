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

// Upon $(document).ready()…
jQuery(function($) {
    // Configuration…
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
					currentOffset.top -= dragPosition;
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