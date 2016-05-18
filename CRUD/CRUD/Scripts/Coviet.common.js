/// <reference path="jquery.blockUI.js" />

// common
var defaultTimeout = 3 * 60 * 1000;
function GenerateUrl(path) {
    if (rootUrl == "/")
        return path;
    else
        return rootUrl + path;
}

function ToArray(json) {
    var result = [];
    for (var i in json)
        result.push([i, json[i]]);
    return result;
}

function GetRandom() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for (var i = 0; i < 5; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}

Array.prototype.getIndexBy = function (value, name) {
    for (var i = 0; i < this.length; i++) {
        if (name) {
            if (this[i][name] == value) {
                return i;
            }
        }
        else {
            if (this[i] == value) {
                return i;
            }
        }
    }

    return -1;
}

Array.prototype.remove = function (item) {
    var index = $.inArray(item, this);
    if (index >= 0)
        this.splice(index, 1);

}

// format string
String.prototype.format = function (args) {
    var str = this;
    return str.replace(String.prototype.format.regex, function (item) {
        var intVal = parseInt(item.substring(1, item.length - 1));
        var replace;
        if (intVal >= 0) {
            replace = args[intVal];
        } else if (intVal === -1) {
            replace = "{";
        } else if (intVal === -2) {
            replace = "}";
        } else {
            replace = "";
        }
        return replace;
    });
};
String.prototype.format.regex = new RegExp("{-?[0-9]+}", "g");

$.fn.clearForm = function () {
    return this.each(function () {
        var type = this.type, tag = this.tagName.toLowerCase();
        if (tag == 'form')
            return $(':input', this).clearForm();
        if (type == 'hidden' || type == 'text' || type == 'password' || tag == 'textarea')
            this.value = '';
        else if (type == 'checkbox' || type == 'radio')
            this.checked = false;
        else if (tag == 'select')
            this.selectedIndex = -1;
    });
};

var substringMatcher = function (strs, property) {
    return function findMatches(q, cb) {
        var matches, substringRegex;

        // an array that will be populated with substring matches
        matches = [];

        // regex used to determine if a string contains the substring `q`
        substrRegex = new RegExp(q, 'i');

        // iterate through the pool of strings and for any string that
        // contains the substring `q`, add it to the `matches` array
        $.each(strs, function (i, str) {
            if (property) {
                if (substrRegex.test(str[property])) {
                    matches.push(str);
                }
            }
            else {
                if (substrRegex.test(str)) {
                    matches.push(str);
                }
            }
        });

        cb(matches);
    };
};

//// demo.
//var str = "my name is {0}";
//str = str.format(["linhpn"]);
//alert(str);

function Confirm(_title, _mess, _type) {
    return window.confirm(_mess);
}

var config = new function ConfigUtil() {
    var self = this;
    self.defaultTimeout = 60 * 1000;
}();

var messageUtil = new function MessageUtil() {
    var self = this;
    var stack_topleft = { "dir1": "down", "dir2": "right", "push": "top" };
    var stack_topright = { "dir1": "down", "dir2": "left", "push": "top" };
    var stack_bottomleft = { "dir1": "right", "dir2": "up", "push": "top" };
    var stack_custom = { "dir1": "right", "dir2": "down" };
    var stack_custom2 = { "dir1": "left", "dir2": "up", "push": "top" };
    var stack_bar_top = { "dir1": "down", "dir2": "left", "push": "top", "spacing1": 10, "spacing2": 20 };
    var stack_bar_bottom = { "dir1": "up", "dir2": "right", "spacing1": 0, "spacing2": 0 };

    self.ShowAlert = function (state, message, _timeout) {
        var hastimeout = false;
        var timeout = _timeout ? _timeout : 3000;
        var type = "";

        var opts = {
            title: "Thông báo",
            styling: "bootstrap3",
            animation: 'slide',
            animate_speed: 'fast',
            icon: false,
            history: false,
            buttons: {
                sticker: false,
                closer: true
            },
            cornerclass: "",
            type: type,
            //addclass: "stack-bar-top mini",            
            hide: hastimeout,
            delay: timeout,
            stack: stack_bar_top
        };

        switch (state) {
            case "error":
            case -1: // error
                if (!message) message = "Xảy ra lỗi!";
                opts.hide = true;
                opts.type = "error";
                break;
            case "info":
            case 0: // information
                opts.hide = true;
                hastimeout = true;
                type = "info";
                break;
            case "success":
            case 1: // success
                if (!message) message = "Thành công!";
                opts.hide = true;
                opts.type = "success";
                break;
            case "loading":
            case 2: // loading
                opts.buttons.closer = false;
                opts.title = 'Đang xử lý';
                opts.animation = 'none';
                message = "";
                opts.icon = false;
                if (_timeout) {
                    opts.hide = true;
                }
                else {
                    opts.hide = false;
                }
                //opts.width = "150px";
                opts.type = "info";
                break;
            default:
                opts.hide = false;
        }
        opts.text = message;
        new PNotify(opts);
    };

    self.HideAlert = function (callback, timeout) {
        //$.pnotify_remove_all();
        PNotify.removeAll();
    };

    self.Notify = function (state, message) {
        var opts = {
            styling: "bootstrap3",
            animate_speed: 'fast',
            text: message,
            type: state,
            buttons: {
                sticker: false,
                closer: false
            },
            history: false,
            addclass: "stack-bar-top",
            cornerclass: "",
            //width: "20%",
            delay: 2000,
            stack: stack_bar_top
        };

        new PNotify(opts);
    };

    //self.Confirm = function confirm_dialog(text, callback, cmdTitle) {
    //    var buttons =
    //            [{
    //                text: 'Đồng ý',
    //                addClass: 'btn-success',
    //                click: function () {
    //                    self.HideAlert();
    //                    callback();
    //                }
    //            }, {
    //                text: 'Hủy bỏ',
    //                click: function () {
    //                    self.HideAlert();
    //                }
    //            }];

    //    if (cmdTitle && cmdTitle.length >= 2) {
    //        buttons[0].text = cmdTitle[0];
    //        buttons[1].text = cmdTitle[1];
    //    }

    //    (new PNotify({
    //        styling: 'bootstrap3',
    //        animate_speed: 'fast',
    //        //title: '',            
    //        text: text,
    //        icon: 'glyphicon glyphicon-question-sign',
    //        hide: false,
    //        addclass: "stack-bar-top confirm-cust",
    //        cornerclass: "",
    //        //width: "95%",
    //        stack: stack_bar_top,
    //        buttons: {
    //            sticker: false,
    //            closer: false
    //        },
    //        confirm: {
    //            confirm: true,
    //            buttons: buttons
    //        },
    //        history: {
    //            history: false
    //        }
    //    }));
    //};

    self.Confirm = function (text, callback) {
        if (confirm(text))
            callback();
    }
}

var dialogUtil = new function DialogUtil() {
    var self = this;

    self.OpenConfirm = function (_title, _mess, _type) {
        return window.confirm(_mess);
    };

    self.OpenDialog = function (source, width, height, title, CallBack, overflow) {

        var _height = 400;
        var _width = 600;
        var _overflow = "auto";
        var _left = 0;
        var _top = 0;
        var _title = "";
        if (width) _width = width;
        if (height) _height = height;
        if (overflow) _overflow = overflow;
        if (overflow) _overflow = overflow;
        if (title) _title = title;

        // refresh if cache for IE
        if (source.indexOf("?") >= 0)
            source = source + "&refreshRandom=" + Math.random();
        else
            source = source + "?refreshRandom=" + Math.random();

        var dynamicReveal = $("#reveal-dialog");
        if (dynamicReveal.length > 0)
            dynamicReveal.remove();
        dynamicReveal = $('<div id="reveal-dialog" class="reveal-modal"></div>');

        var modal = null;
        var modal_header = $('<div class="header-reveal-modal"></div>');
        var modal_header_title = $('<div class="header-title-reveal-modal"></div>');
        var modal_closer = $('<a class="close-reveal-modal close-modal">&#215;</a>');
        var modal_content = $('<div class="content-reveal-modal"></div>');
        var modal_wait = $('<div class="content-reveal-wait"><center><img src="/Content/reveal/loading.gif" alt="Hãy chờ..." /></center></div>');

        var option = {
            animation: 'none',                   //fade, fadeAndPop, none
            animationspeed: 200,                       //how fast animtions are
            closeonbackgroundclick: false,              //if you click background will modal close?
            dismissmodalclass: 'close-modal',    //the class of a button or element that will close an open modal
            returnData: null,
            callBack: CallBack
        }

        modal_header_title.html(_title);
        modal_header.append(modal_header_title);
        dynamicReveal.append(modal_header);
        dynamicReveal.append(modal_wait);
        dynamicReveal.append(modal_content);
        dynamicReveal.append(modal_closer);
        $(document.body).append(dynamicReveal);

        modal_content.css("overflow-y", _overflow);

        dynamicReveal.width(_width);
        dynamicReveal.height(_height);

        _left = ($(window).width() - dynamicReveal.outerWidth()) / 2;
        dynamicReveal.css("left", _left + "px");

        _top = ($(window).height() - dynamicReveal.outerHeight()) / 2;
        dynamicReveal.css("top", _top + "px");

        $.ajax({
            type: 'Get',
            url: source,
            beforeSend: function () {
                // wait
                //   modal_content.html(wait);
                modal_content.css("display", "none");
                dynamicReveal.reveal("open", option);
            },
            success: function (content) {
                // hide wait
                modal_wait.css("display", "none");
                // bind html
                modal_content.html(content).fadeIn('slow');
                // bind close event for element has "class= option.dismissmodalclass"
                $('.' + option.dismissmodalclass, "#reveal-dialog").bind('click.modalEvent', function () {
                    dynamicReveal.reveal("close", option);
                });

                var totalHeight = _height - modal_header.outerHeight();
                var padding = modal_content.outerHeight() - modal_content.height();
                modal_content.height(totalHeight - padding);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // failed request, show info
                modal_content.html('<p class="error"><strong>Xảy ra lỗi!</strong></p><p>' + textStatus + '</p>');
            }
        });
    };

    self.CloseDialog = function (returnData) {
        if ($("#reveal-dialog").length > 0)
            $("#reveal-dialog").reveal("close", { returnData: returnData });
    }

    self.OpenLocalDialog = function (dialogId, width, height, title, CallBack, overflow) {
        var _height = 400;
        var _width = 600;
        var _overflow = "auto";
        var _left = 0;
        var _top = 0;
        var _title = "";
        if (width) _width = width;
        if (height) _height = height;
        if (overflow) _overflow = overflow;
        if (title) _title = title;

        var option = {
            animation: 'none',                   //fade, fadeAndPop, none
            animationspeed: 200,                       //how fast animtions are
            closeonbackgroundclick: false,              //if you click background will modal close?
            dismissmodalclass: 'close-modal',    //the class of a button or element that will close an open modal
            returnData: null,
            callBack: CallBack
        }

        var contentDialog = $("#" + dialogId);
        var dynamicReveal = $("#reveal-dialog");
        if (dynamicReveal.length > 0)
            dynamicReveal.remove();
        dynamicReveal = $('<div id="reveal-dialog" class="reveal-modal"></div>');

        var modal = null;
        var modal_header = $('<div class="header-reveal-modal"></div>');
        var modal_header_title = $('<div class="header-title-reveal-modal"></div>');
        var modal_closer = $('<a class="close-reveal-modal close-modal">&#215;</a>');
        var modal_content = $('<div class="content-reveal-modal"></div>');
        // add id source container
        modal_content.attr("idsrc", dialogId);
        // bind html
        modal_content.html(contentDialog.html());
        contentDialog.html("");
        // bind close event
        option.handleClose = function () {
            contentDialog.html(modal_content.html());
            modal_content.html("");
            dynamicReveal.reveal("close", option);
        }

        modal_header_title.html(_title);
        modal_header.append(modal_header_title);
        dynamicReveal.append(modal_header);
        dynamicReveal.append(modal_content);
        dynamicReveal.append(modal_closer);

        var totalHeight = _height - modal_header.outerHeight();
        var padding = modal_content.outerHeight() - modal_content.height();
        modal_content.height(totalHeight - padding);
        modal_content.css("overflow-y", _overflow);

        dynamicReveal.width(_width);
        dynamicReveal.height(_height);

        _left = ($(window).width() - dynamicReveal.outerWidth()) / 2;
        dynamicReveal.css("left", _left + "px");

        _top = ($(window).height() - dynamicReveal.outerHeight()) / 2;
        dynamicReveal.css("top", _top + "px");

        $(document.body).append(dynamicReveal);
        // open dialog
        dynamicReveal.reveal("open", option);
    }

    self.CloseLocalDialog = function (returnData) {
        if ($("#reveal-dialog").length > 0) {
            var modal_content = $($(".content-reveal-modal")[0]);
            var contentDialog = $("#" + modal_content.attr("idsrc"));
            contentDialog.html(modal_content.html());
            modal_content.html("");
            $("#reveal-dialog").reveal("close", { returnData: returnData });
        }
    }

}();

var urlUtil = new function UrlUtil() {
    var self = this;
    self.QueryString = function (key) {
        var re = new RegExp('(?:\\?|&)' + key + '=(.*?)(?=&|$)', 'gi');
        var r = [], m;
        while ((m = re.exec(document.location.search)) != null) r.push(m[1]);
        return r;
    };

    self.parseUrl = function () {
        $(window).bind('hashchange', function (e) {
            var url = $.param.fragment();

        });

        $(window).trigger('hashchange');
    };

    // using  jquery.ba-bbq.js >>
    self.AddFragment = function (key, value) {
        var state = {};
        state[key] = value;
        $.bbq.pushState(state);
    }

    self.FragmentGetKey = function (key) {
        var value = $.bbq.getState(key) || '';
        return value;
    }

    self.ParseFragment = function () {
        var value = $.bbq.getState();
        return value;
    }

    self.ClearFragment = function () {
        $.bbq.removeState();
    }

    //self.ParseFragmentTo = function (state) {
    //    var fragment = $.bbq.getState();
    //    for (prop in state)
    //        state[prop] = fragment[prop] || '';
    //    return fragment;
    //}

    self.UpdateFragment = function (state) {
        $.bbq.pushState(state);
    }
}();