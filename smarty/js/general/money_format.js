function trim(s)
{
 	return s.replace(/^\s+|\s+$/g, '');
}

function getenv (varname) {
    // Get the value of an environment variable
    //
    // version: 1006.1915
    // discuss at: http://phpjs.org/functions/getenv
    // +   original by: Brett Zamir (http://brett-zamir.me)
    // %        note 1: We are not using $_ENV as in PHP, you could define
    // %        note 1: "$_ENV = this.php_js.ENV;" and get/set accordingly
    // %        note 2: Returns e.g. 'en-US' when set global this.php_js.ENV is set
    // %        note 3: Uses global: php_js to store environment info
    // *     example 1: getenv('LC_ALL');
    // *     returns 1: false

    if (!this.php_js || !this.php_js.ENV || !this.php_js.ENV[varname]) {
        return false;
    }

    return this.php_js.ENV[varname];
}

function setlocale (category, locale) {
    // Set locale information
    //
    // version: 1006.1915
    // discuss at: http://phpjs.org/functions/setlocale
    // +   original by: Brett Zamir (http://brett-zamir.me)
    // +   derived from: Blues at http://hacks.bluesmoon.info/strftime/strftime.js
    // +   derived from: YUI Library: http://developer.yahoo.com/yui/docs/YAHOO.util.DateLocale.html
    // -    depends on: getenv
    // %          note 1: Is extensible, but currently only implements locales en,
    // %          note 1: en_US, en_GB, en_AU, fr, and fr_CA for LC_TIME only; C for LC_CTYPE;
    // %          note 1: C and en for LC_MONETARY/LC_NUMERIC; en for LC_COLLATE
    // %          note 2: Uses global: php_js to store locale info
    // %          note 3: Consider using http://demo.icu-project.org/icu-bin/locexp as basis for localization (as in i18n_loc_set_default())
    // *     example 1: setlocale('LC_ALL', 'en_US');
    // *     returns 1: 'en_US'
    var categ = '', cats = [], i = 0, d = this.window.document;

    // BEGIN STATIC
    var _copy = function _copy (orig) {
        if (orig instanceof RegExp) {
            return new RegExp(orig);
        }
        else if (orig instanceof Date) {
            return new Date(orig);
        }
        var newObj = {};
        for (var i in orig) {
            if (typeof orig[i] === 'object') {
                newObj[i] = _copy(orig[i]);
            }
            else {
                newObj[i] = orig[i];
            }
        }
        return newObj;
    };

    // Function usable by a ngettext implementation (apparently not an accessible part of setlocale(), but locale-specific)
    // See http://www.gnu.org/software/gettext/manual/gettext.html#Plural-forms though amended with others from
    // https://developer.mozilla.org/En/Localization_and_Plurals (new categories noted with "MDC" below, though
    // not sure of whether there is a convention for the relative order of these newer groups as far as ngettext)
    // The function name indicates the number of plural forms (nplural)
    // Need to look into http://cldr.unicode.org/ (maybe future JavaScript); Dojo has some functions (under new BSD),
    // including JSON conversions of LDML XML from CLDR: http://bugs.dojotoolkit.org/browser/dojo/trunk/cldr
    // and docs at http://api.dojotoolkit.org/jsdoc/HEAD/dojo.cldr
    var _nplurals1 = function (n) { // e.g., Japanese
        return 0;
    };
    var _nplurals2a = function (n) { // e.g., English
        return n !== 1 ? 1 : 0;
    };
    var _nplurals2b = function (n) { // e.g., French
        return n > 1 ? 1 : 0;
    };
    var _nplurals2c = function (n) { // e.g., Icelandic (MDC)
        return n % 10 === 1 && n % 100 !== 11 ? 0 : 1;
    };
    var _nplurals3a = function (n) { // e.g., Latvian (MDC has a different order from gettext)
        return n % 10 === 1 && n % 100 !== 11 ? 0 : n !== 0 ? 1 : 2;
    };
    var _nplurals3b = function (n) { // e.g., Scottish Gaelic
        return n === 1 ? 0 : n === 2 ? 1 : 2;
    };
    var _nplurals3c = function (n) { // e.g., Romanian
        return n === 1 ? 0 : (n === 0 || (n % 100 > 0 && n % 100 < 20)) ? 1 : 2;
    };
    var _nplurals3d = function (n) { // e.g., Lithuanian (MDC has a different order from gettext)
        return n % 10 === 1 && n % 100 !== 11 ? 0 : n % 10 >= 2 && (n % 100 <10 || n % 100 >= 20) ? 1 : 2;
    };
    var _nplurals3e = function (n) { // e.g., Croatian
        return n % 10 === 1 && n % 100 !== 11 ? 0 : n % 10 >=2 && n % 10 <= 4 && (n % 100 < 10 || n % 100 >= 20) ? 1 : 2;
    };
    var _nplurals3f = function (n) { // e.g., Slovak
        return n === 1 ? 0 : n >= 2 && n <= 4 ? 1 : 2;
    };
    var _nplurals3g = function (n) { // e.g., Polish
        return n === 1 ? 0 : n % 10 >= 2 && n % 10 <= 4 && (n % 100 < 10 || n % 100 >= 20) ? 1 : 2;
    };
    var _nplurals3h = function (n) { // e.g., Macedonian (MDC)
        return n % 10 === 1 ? 0 : n % 10 === 2 ? 1 : 2;
    };
    var _nplurals4a = function (n) { // e.g., Slovenian
        return n % 100 === 1 ? 0 : n % 100 === 2 ? 1 : n % 100 === 3 || n % 100 === 4 ? 2 : 3;
    };
    var _nplurals4b = function (n) { // e.g., Maltese (MDC)
        return n === 1 ? 0 : n === 0 || (n % 100 && n % 100 <= 10) ? 1 : n % 100 >= 11 && n % 100 <= 19 ? 2 : 3;
    };
    var _nplurals5 = function (n) { // e.g., Irish Gaeilge (MDC)
        return n === 1 ? 0 : n === 2 ? 1 : n >=3 && n <= 6 ? 2 : n >= 7 && n <= 10 ? 3 : 4;
    };
    var _nplurals6 = function (n) { // e.g., Arabic (MDC) - Per MDC puts 0 as last group
        return n === 0 ? 5 : n === 1 ? 0 : n === 2 ? 1 : n % 100 >= 3 && n % 100 <= 10 ?
                                                                                                                                2 : n % 100 >= 11 && n % 100 <= 99 ? 3 : 4;
    };
    // END STATIC

    // BEGIN REDUNDANT
    this.php_js = this.php_js || {};

    var phpjs = this.php_js;

    // Reconcile Windows vs. *nix locale names?
    // Allow different priority orders of languages, esp. if implement gettext as in
    //     LANGUAGE env. var.? (e.g., show German if French is not available)
    if (!phpjs.locales) {
        // Can add to the locales
        phpjs.locales = {};

        phpjs.locales.en = {
            'LC_COLLATE' :  // For strcoll
                function ( str1, str2 ) { // Fix: This one taken from strcmp, but need for other locales; we don't use localeCompare since its locale is not settable
                    return ( str1 == str2 ) ? 0 : ( ( str1 > str2 ) ? 1 : -1 );
                }
            ,
            'LC_CTYPE' : { // Need to change any of these for English as opposed to C?
                an: /^[A-Za-z\d]+$/g,
                al: /^[A-Za-z]+$/g,
                ct: /^[\u0000-\u001F\u007F]+$/g,
                dg: /^[\d]+$/g,
                gr: /^[\u0021-\u007E]+$/g,
                lw: /^[a-z]+$/g,
                pr: /^[\u0020-\u007E]+$/g,
                pu: /^[\u0021-\u002F\u003A-\u0040\u005B-\u0060\u007B-\u007E]+$/g,
                sp: /^[\f\n\r\t\v ]+$/g,
                up: /^[A-Z]+$/g,
                xd: /^[A-Fa-f\d]+$/g,
                CODESET : 'UTF-8',
                 // Used by sql_regcase
                lower : 'abcdefghijklmnopqrstuvwxyz',
                upper : 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
            },
            'LC_TIME' : { // Comments include nl_langinfo() constant equivalents and any changes from Blues' implementation
                a: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'], // ABDAY_
                A: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'], // DAY_
                b: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'], // ABMON_
                B: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'], // MON_
                c: '%a %d %b %Y %r %Z', // D_T_FMT // changed %T to %r per results
                p: ['AM', 'PM'], // AM_STR/PM_STR
                P: ['am', 'pm'], // Not available in nl_langinfo()
                r: '%I:%M:%S %p', // T_FMT_AMPM (Fixed for all locales)
                x: '%m/%d/%Y', // D_FMT // switched order of %m and %d; changed %y to %Y (C uses %y)
                X: '%r', // T_FMT // changed from %T to %r  (%T is default for C, not English US)
                // Following are from nl_langinfo() or http://www.cptec.inpe.br/sx4/sx4man2/g1ab02e/strftime.4.html
                alt_digits : '', // e.g., ordinal
                ERA : '',
                ERA_YEAR : '',
                ERA_D_T_FMT : '',
                ERA_D_FMT : '',
                ERA_T_FMT : ''
            },
             // Assuming distinction between numeric and monetary is thus:
             // See below for C locale
            'LC_MONETARY' : { // Based on Windows "english" (English_United States.1252) locale
                int_curr_symbol : 'USD',
                currency_symbol : '$',
                mon_decimal_point : '.',
                mon_thousands_sep : ',',
                mon_grouping : [3], // use mon_thousands_sep; "" for no grouping; additional array members indicate successive group lengths after first group (e.g., if to be 1,23,456, could be [3, 2])
                positive_sign : '',
                negative_sign : '-',
                int_frac_digits : 2, // Fractional digits only for money defaults?
                frac_digits : 2,
                p_cs_precedes : 1, // positive currency symbol follows value = 0; precedes value = 1
                p_sep_by_space : 0, // 0: no space between curr. symbol and value; 1: space sep. them unless symb. and sign are adjacent then space sep. them from value; 2: space sep. sign and value unless symb. and sign are adjacent then space separates
                n_cs_precedes : 1, // see p_cs_precedes
                n_sep_by_space : 0, // see p_sep_by_space
                p_sign_posn : 3, // 0: parentheses surround quantity and curr. symbol; 1: sign precedes them; 2: sign follows them; 3: sign immed. precedes curr. symbol; 4: sign immed. succeeds curr. symbol
                n_sign_posn : 0 // see p_sign_posn
            },
            'LC_NUMERIC' : { // Based on Windows "english" (English_United States.1252) locale
                decimal_point : '.',
                thousands_sep : ',',
                grouping : [3] // see mon_grouping, but for non-monetary values (use thousands_sep)
            },
            'LC_MESSAGES' : {
                YESEXPR : '^[yY].*',
                NOEXPR : '^[nN].*',
                YESSTR : '',
                NOSTR : ''
            },
            nplurals : _nplurals2a
        };
        phpjs.locales.en_US = _copy(phpjs.locales.en);
        phpjs.locales.en_US.LC_TIME.c = '%a %d %b %Y %r %Z';
        phpjs.locales.en_US.LC_TIME.x = '%D';
        phpjs.locales.en_US.LC_TIME.X = '%r';
        // The following are based on *nix settings
        phpjs.locales.en_US.LC_MONETARY.int_curr_symbol = 'USD ';
        phpjs.locales.en_US.LC_MONETARY.p_sign_posn = 1;
        phpjs.locales.en_US.LC_MONETARY.n_sign_posn = 1;
        phpjs.locales.en_US.LC_MONETARY.mon_grouping = [3, 3];
        phpjs.locales.en_US.LC_NUMERIC.thousands_sep = '';
        phpjs.locales.en_US.LC_NUMERIC.grouping = [];

        phpjs.locales.en_GB = _copy(phpjs.locales.en);
        phpjs.locales.en_GB.LC_TIME.r =  '%l:%M:%S %P %Z';

        phpjs.locales.en_AU = _copy(phpjs.locales.en_GB);
        phpjs.locales.C = _copy(phpjs.locales.en); // Assume C locale is like English (?) (We need C locale for LC_CTYPE)
        phpjs.locales.C.LC_CTYPE.CODESET = 'ANSI_X3.4-1968';
        phpjs.locales.C.LC_MONETARY = {
            int_curr_symbol : '',
            currency_symbol : '',
            mon_decimal_point : '',
            mon_thousands_sep : '',
            mon_grouping : [],
            p_cs_precedes : 127,
            p_sep_by_space : 127,
            n_cs_precedes : 127,
            n_sep_by_space : 127,
            p_sign_posn : 127,
            n_sign_posn : 127,
            positive_sign : '',
            negative_sign : '',
            int_frac_digits : 127,
            frac_digits : 127
        };
        phpjs.locales.C.LC_NUMERIC = {
            decimal_point : '.',
            thousands_sep : '',
            grouping : []
        };
        phpjs.locales.C.LC_TIME.c = '%a %b %e %H:%M:%S %Y'; // D_T_FMT
        phpjs.locales.C.LC_TIME.x = '%m/%d/%y'; // D_FMT
        phpjs.locales.C.LC_TIME.X = '%H:%M:%S'; // T_FMT
        phpjs.locales.C.LC_MESSAGES.YESEXPR = '^[yY]';
        phpjs.locales.C.LC_MESSAGES.NOEXPR = '^[nN]';

        phpjs.locales.fr =_copy(phpjs.locales.en);
        phpjs.locales.fr.nplurals = _nplurals2b;
        phpjs.locales.fr.LC_TIME.a = ['dim', 'lun', 'mar', 'mer', 'jeu', 'ven', 'sam'];
        phpjs.locales.fr.LC_TIME.A = ['dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
        phpjs.locales.fr.LC_TIME.b = ['jan', 'f\u00E9v', 'mar', 'avr', 'mai', 'jun', 'jui', 'ao\u00FB', 'sep', 'oct', 'nov', 'd\u00E9c'];
        phpjs.locales.fr.LC_TIME.B = ['janvier', 'f\u00E9vrier', 'mars', 'avril', 'mai', 'juin', 'juillet', 'ao\u00FBt', 'septembre', 'octobre', 'novembre', 'd\u00E9cembre'];
        phpjs.locales.fr.LC_TIME.c = '%a %d %b %Y %T %Z';
        phpjs.locales.fr.LC_TIME.p = ['', ''];
        phpjs.locales.fr.LC_TIME.P = ['', ''];
        phpjs.locales.fr.LC_TIME.x = '%d.%m.%Y';
        phpjs.locales.fr.LC_TIME.X = '%T';

        phpjs.locales.fr_CA = _copy(phpjs.locales.fr);
        phpjs.locales.fr_CA.LC_TIME.x = '%Y-%m-%d';
    }
    if (!phpjs.locale) {
        phpjs.locale = 'en_US';
        var NS_XHTML = 'http://www.w3.org/1999/xhtml';
        var NS_XML = 'http://www.w3.org/XML/1998/namespace';
        if (d.getElementsByTagNameNS &&
                d.getElementsByTagNameNS(NS_XHTML, 'html')[0]) {
            if (d.getElementsByTagNameNS(NS_XHTML, 'html')[0].getAttributeNS &&
                    d.getElementsByTagNameNS(NS_XHTML, 'html')[0].getAttributeNS(NS_XML, 'lang')) {
                phpjs.locale = d.getElementsByTagName(NS_XHTML, 'html')[0].getAttributeNS(NS_XML, 'lang');
            } else if (d.getElementsByTagNameNS(NS_XHTML, 'html')[0].lang) { // XHTML 1.0 only
                phpjs.locale = d.getElementsByTagNameNS(NS_XHTML, 'html')[0].lang;
            }
        } else if (d.getElementsByTagName('html')[0] && d.getElementsByTagName('html')[0].lang) {
            phpjs.locale = d.getElementsByTagName('html')[0].lang;
        }
    }
    phpjs.locale = phpjs.locale.replace('-', '_'); // PHP-style

    // Fix locale if declared locale hasn't been defined
    if (!(phpjs.locale in phpjs.locales)) {
        if (phpjs.locale.replace(/_[a-zA-Z]+$/, '') in phpjs.locales) {
            phpjs.locale = phpjs.locale.replace(/_[a-zA-Z]+$/, '');
        }
    }

    if (!phpjs.localeCategories) {
        phpjs.localeCategories = {
            'LC_COLLATE': phpjs.locale, // for string comparison, see strcoll()
            'LC_CTYPE': phpjs.locale,// for character classification and conversion, for example strtoupper()
            'LC_MONETARY': phpjs.locale,// for localeconv()
            'LC_NUMERIC': phpjs.locale,// for decimal separator (See also localeconv())
            'LC_TIME': phpjs.locale,// for date and time formatting with strftime()
            'LC_MESSAGES':phpjs.locale// for system responses (available if PHP was compiled with libintl)
        };
    }
    // END REDUNDANT

    if (locale === null || locale === '') {
        locale = this.getenv(category) || this.getenv('LANG');
    } else if (locale instanceof Array) {
        for (i=0; i < locale.length; i++) {
            if (!(locale[i] in this.php_js.locales)) {
                if (i === locale.length-1) {
                    return false; // none found
                }
                continue;
            }
            locale = locale[i];
            break;
        }
    }

    // Just get the locale
    if (locale === '0' || locale === 0) {
        if (category === 'LC_ALL') {
            for (categ in this.php_js.localeCategories) {
                cats.push(categ+'='+this.php_js.localeCategories[categ]); // Add ".UTF-8" or allow ".@latint", etc. to the end?
            }
            return cats.join(';');
        }
        return this.php_js.localeCategories[category];
    }

    if (!(locale in this.php_js.locales)) {
        return false; // Locale not found
    }

    // Set and get locale
    if (category === 'LC_ALL') {
        for (categ in this.php_js.localeCategories) {
            this.php_js.localeCategories[categ] = locale;
        }
    } else {
        this.php_js.localeCategories[category] = locale;
    }
    return locale;
}

function money_format(format, number, dp)
{
    // Convert monetary value(s) to string
    //
    // version: 1006.1915
    // discuss at: http://phpjs.org/functions/money_format
    // +   original by: Brett Zamir (http://brett-zamir.me)
    // +   input by: daniel airton wermann (http://wermann.com.br)
    // +   bugfixed by: Brett Zamir (http://brett-zamir.me)
    // -    depends on: setlocale
    // %          note 1: This depends on setlocale having the appropriate locale (these examples use 'en_US')
    // *     example 1: money_format('%i', 1234.56);
    // *     returns 1: 'USD 1,234.56'
    // *     example 2: money_format('%14#8.2n', 1234.5678);
    // *     returns 2: ' $     1,234.57'
    // *     example 3: money_format('%14#8.2n', -1234.5678);
    // *     returns 3: '-$     1,234.57'
    // *     example 4: money_format('%(14#8.2n', 1234.5678);
    // *     returns 4: ' $     1,234.57 '
    // *     example 5: money_format('%(14#8.2n', -1234.5678);
    // *     returns 5: '($     1,234.57)'
    // *     example 6: money_format('%=014#8.2n', 1234.5678);
    // *     returns 6: ' $000001,234.57'
    // *     example 7: money_format('%=014#8.2n', -1234.5678);
    // *     returns 7: '-$000001,234.57'
    // *     example 8: money_format('%=*14#8.2n', 1234.5678);
    // *     returns 8: ' $*****1,234.57'
    // *     example 9: money_format('%=*14#8.2n', -1234.5678);
    // *     returns 9: '-$*****1,234.57'
    // *     example 10: money_format('%=*^14#8.2n', 1234.5678);
    // *     returns 10: '  $****1234.57'
    // *     example 11: money_format('%=*^14#8.2n', -1234.5678);
    // *     returns 11: ' -$****1234.57'
    // *     example 12: money_format('%=*!14#8.2n', 1234.5678);
    // *     returns 12: ' *****1,234.57'
    // *     example 13: money_format('%=*!14#8.2n', -1234.5678);
    // *     returns 13: '-*****1,234.57'
    // *     example 14: money_format('%i', 3590);
    // *     returns 14: ' USD 3,590.00'

    // Per PHP behavior, there seems to be no extra padding for sign when there is a positive number, though my
    // understanding of the description is that there should be padding; need to revisit examples
    // Helpful info at http://ftp.gnu.org/pub/pub/old-gnu/Manuals/glibc-2.2.3/html_chapter/libc_7.html and http://publib.boulder.ibm.com/infocenter/zos/v1r10/index.jsp?topic=/com.ibm.zos.r10.bpxbd00/strfmp.htm

    if (typeof number !== 'number') {
        return null;
    }
    var regex = /%((=.|[+^(!-])*?)(\d*?)(#(\d+))?(\.(\d+))?([in%])/g; // 1: flags, 3: width, 5: left, 7: right, 8: conversion

    this.setlocale('LC_ALL', 0); // Ensure the locale data we need is set up
    var monetary = this.php_js.locales[this.php_js.localeCategories['LC_MONETARY']]['LC_MONETARY'];

    var doReplace = function (n0, flags, n2, width, n4, left, n6, right, conversion) {
        var value='', repl = '';
        if (conversion === '%') { // Percent does not seem to be allowed with intervening content
            return '%';
        }
        var fill = flags && (/=./).test(flags) ? flags.match(/=(.)/)[1] : ' '; // flag: =f (numeric fill)
        var showCurrSymbol = !flags || flags.indexOf('!') === -1; // flag: ! (suppress currency symbol)
        width = parseInt(width, 10) || 0; // field width: w (minimum field width)

        var neg = number < 0;
        number = number+''; // Convert to string
        number = neg ? number.slice(1) : number; // We don't want negative symbol represented here yet

        var decpos = number.indexOf('.');
        var integer = decpos !== -1 ? number.slice(0, decpos) : number; // Get integer portion
        var fraction = decpos !== -1 ? number.slice(decpos+1) : ''; // Get decimal portion

        var _str_splice = function (integerStr, idx, thous_sep) {
            var integerArr = integerStr.split('');
            integerArr.splice(idx, 0, thous_sep);
            return integerArr.join('');
        };

        var init_lgth = integer.length;
        left = parseInt(left, 10);
        var filler = init_lgth < left;
        if (filler) {
            var fillnum = left-init_lgth;
            integer = new Array(fillnum+1).join(fill)+integer;
        }
        if (flags.indexOf('^') === -1) { // flag: ^ (disable grouping characters (of locale))
            // use grouping characters
            var thous_sep = monetary.mon_thousands_sep; // ','
            var mon_grouping = monetary.mon_grouping; // [3] (every 3 digits in U.S.A. locale)

            if (mon_grouping[0] < integer.length) {
                for (var i = 0, idx = integer.length; i < mon_grouping.length; i++) {
                    idx -= mon_grouping[i]; // e.g., 3
                    if (idx < 0) {break;}
                    if (filler && idx < fillnum) {
                        thous_sep = fill;
                    }
                    integer = _str_splice(integer, idx, thous_sep);
                }
            }
            if (mon_grouping[i-1] > 0) { // Repeating last grouping (may only be one) until highest portion of integer reached
                while (idx > mon_grouping[i-1]) {
                    idx -= mon_grouping[i-1];
                    if (filler && idx < fillnum) {
                        thous_sep = fill;
                    }
                    integer = _str_splice(integer, idx, thous_sep);
                }
            }
        }

        // left, right
        if (right === '0') { // No decimal or fractional digits
            value = integer;
        }
        else {
            var dec_pt = monetary.mon_decimal_point; // '.'
            if (right === '' || right === undefined) {
                right = conversion === 'i' ? monetary.int_frac_digits : monetary.frac_digits;
            }
            right = parseInt(right, 10);

            if (right === 0) { // Only remove fractional portion if explicitly set to zero digits
                fraction = '';
                dec_pt = '';
            }
            else if (right < fraction.length) {
                fraction = Math.round(parseFloat(fraction.slice(0, right)+'.'+fraction.substr(right, 1), 10))+'';
            }
            else if (right > fraction.length) {
                fraction += new Array(right - fraction.length + 1).join('0'); // pad with 0's
            }
            value = integer+dec_pt+fraction;
        }

        var symbol = '';
        if (showCurrSymbol) {
            symbol = conversion === 'i' ? monetary.int_curr_symbol : monetary.currency_symbol; // 'i' vs. 'n' ('USD' vs. '$')
        }
        var sign_posn = neg ? monetary.n_sign_posn : monetary.p_sign_posn;

        // 0: no space between curr. symbol and value
        // 1: space sep. them unless symb. and sign are adjacent then space sep. them from value
        // 2: space sep. sign and value unless symb. and sign are adjacent then space separates
        var sep_by_space = neg ? monetary.n_sep_by_space : monetary.p_sep_by_space;

        // p_cs_precedes, n_cs_precedes // positive currency symbol follows value = 0; precedes value = 1
        var cs_precedes = neg ? monetary.n_cs_precedes : monetary.p_cs_precedes;

        // Assemble symbol/value/sign and possible space as appropriate
        if (flags.indexOf('(') !== -1) { // flag: parenth. for negative
            // Fix: unclear on whether and how sep_by_space, sign_posn, or cs_precedes have
            // an impact here (as they do below), but assuming for now behaves as sign_posn 0 as
            // far as localized sep_by_space and sign_posn behavior
            repl = (cs_precedes ?
                                symbol + (sep_by_space === 1 ? ' ' : ''):
                                ''
                        ) +
                        value +
                        (!cs_precedes ?
                                (sep_by_space === 1 ? ' ' : '') + symbol:
                                ''
                        );
            if (neg) {
                repl = '(' + repl + ')';
            }
            else {
                repl = ' ' + repl + ' ';
            }
        }
        else { // '+' is default
            var pos_sign = monetary.positive_sign; // ''
            var neg_sign = monetary.negative_sign; // '-'
            var sign = neg ? (neg_sign) : (pos_sign);
            var otherSign = neg ? (pos_sign) : (neg_sign);
            var signPadding = '';
            if (sign_posn) { // has a sign
                signPadding = new Array(otherSign.length - sign.length + 1).join(' ');
            }

            var valueAndCS = '';
            switch(sign_posn) {
                // 0: parentheses surround value and curr. symbol;
                // 1: sign precedes them;
                // 2: sign follows them;
                // 3: sign immed. precedes curr. symbol; (but may be space between)
                // 4: sign immed. succeeds curr. symbol; (but may be space between)
                case 0:
                    valueAndCS = cs_precedes ?
                                    symbol + (sep_by_space === 1 ? ' ' : '') + value :
                                    value + (sep_by_space === 1 ? ' ' : '') + symbol;
                    repl = '('+valueAndCS+')';
                    break;
                case 1:
                    valueAndCS = cs_precedes ?
                                    symbol+(sep_by_space === 1 ? ' ' : '')+value :
                                    value+(sep_by_space === 1 ? ' ' : '')+symbol;
                    repl = signPadding+sign+(sep_by_space === 2 ? ' ' : '')+valueAndCS;
                    break;
                case 2:
                    valueAndCS = cs_precedes ?
                                    symbol+(sep_by_space === 1 ? ' ' : '')+value :
                                    value+(sep_by_space === 1 ? ' ' : '')+symbol;
                    repl = valueAndCS+(sep_by_space === 2 ? ' ' : '')+sign+signPadding;
                    break;
                case 3:
                    repl = cs_precedes ?
                                    signPadding+sign+(sep_by_space === 2 ? ' ' : '')+symbol+(sep_by_space === 1 ? ' ' : '')+value :
                                    value+(sep_by_space === 1 ? ' ' : '')+sign+signPadding+(sep_by_space === 2 ? ' ' : '')+symbol;
                    break;
                case 4:
                    repl = cs_precedes ?
                                    symbol+(sep_by_space === 2 ? ' ' : '')+signPadding+sign+(sep_by_space === 1 ? ' ' : '')+value :
                                    value+(sep_by_space === 1 ? ' ' : '')+symbol+(sep_by_space === 2 ? ' ' : '')+sign+signPadding;
                    break;
            }
        }

        var padding = width-repl.length;
        if (padding > 0) {
            padding = new Array(padding+1).join(' ');
            // Fix: How does p_sep_by_space affect the count if there is a space? Included in count presumably?
            if (flags.indexOf('-') !== -1) { // left-justified (pad to right)
                repl += padding;
            }
            else { // right-justified (pad to left)
                repl = padding + repl;
            }
        }
        return repl;
    };

   var rslt_num = format.replace(regex, doReplace);
   rslt_num = trim(rslt_num.replace("USD",""));
	if(rslt_num.charAt(0)==',') {
		rslt_num = rslt_num.substring(1,rslt_num.length);
	}
   var ad = rslt_num.substring(rslt_num.indexOf('.')+1);
   if(ad.length == 1) {
       rslt_num = rslt_num.substring(0,rslt_num.indexOf('.'));
       rslt_num = rslt_num + '.0' + ad;
   }
   if(typeof dp != 'undefined' && dp != null && dp=='no') {
       rslt_num = rslt_num.substring(0,rslt_num.indexOf('.'));
   }
   // console.log(ad);
   return rslt_num;
}