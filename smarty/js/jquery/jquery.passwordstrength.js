$.fn.passwordStrength = function(options)
{
	return this.each(function()
	{
		var that = this;
		that.opts = {};
		that.opts = $.extend({}, $.fn.passwordStrength.defaults, options);
		that.div = $(that.opts.targetElement);
		that.span = $(that.opts.targetTextElement);
		that.psimsg = $(that.opts.psimsg);
		that.defaultClass = that.div.attr('class');
		that.percents = (that.opts.classes.length) ? 100 / that.opts.classes.length : 100;

		v = $(this).blur(function()
		{
			if(typeof el == "undefined" || typeof this.el == "undefined") { el = this.el = $(this); }
			var s = getPasswordStrength (this.value);
			var p = this.percents;
			var t = Math.floor(s / p);

			if(100 <= s) {
				t = this.opts.classes.length - 1;
			}

			this.div
			.removeAttr('class')
			.addClass(this.defaultClass)
			.addClass(this.opts.classes[t]);

			var perc = parseInt(this.opts.classes[t].replace('is',''));
			var psmsg = "";
			if(perc <= 50) {
				psmsg = this.psimsg[0];
			} else if(perc <= 80) {
				psmsg = this.psimsg[1];
			} else if(perc <= 90) {
				psmsg = this.psimsg[2];
			} else if(perc <= 100) {
				psmsg = this.psimsg[3];
			}
			this.span
			.html(': '+psmsg);
		})
		/*.after('<a href="#">Generate Password</a>')
		.next()
		.click(function() {
			$(this).prev().val( randomPassword() ).trigger('keyup');
			return false;
		});*/
	});

	function getPasswordStrength(H)
	{
		var D = (H.length);
		if(D > 5) { D = 5; }
		var F = H.replace(/[0-9]/g,"");
		var G = (H.length-F.length);
		if(G > 3) {G = 3; }
		var A = H.replace(/\W/g,"");
		var C = (H.length-A.length);
		if(C > 3) { C = 3; }
		var B = H.replace(/[A-Z]/g,"");
		var I = (H.length-B.length);
		if(I > 3) { I = 3; }
		var E = ((D*10)-20)+(G*10)+(C*15)+(I*10);
		if(E < 0) { E = 0; }
		if(E > 100) { E = 100; }
		return E;
	}

	function randomPassword()
	{
		var chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$_-+";
		var size = 10;
		var i = 1;
		var ret = "";
		while (i <= size) {
			$max = chars.length-1;
			$num = Math.floor(Math.random()*$max);
			$temp = chars.substr($num, 1);
			ret += $temp;
			i++;
		}
		return ret;
	}

};
$.fn.passwordStrength.defaults = {
	classes : Array('is10','is20','is30','is40','is50','is60','is70','is80','is90','is100'),
	targetElement : '#passwordStrengthIndicator',
	cache : {}
}
/*$(document).ready(function() {
	$('input[name="password"]').passwordStrength();
	$('input[name="password2"]').passwordStrength({targetElement: '#passwordStrengthDiv2',classes : Array('is10','is20','is30','is40')});
});*/