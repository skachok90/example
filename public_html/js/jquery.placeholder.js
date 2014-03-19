/*
 * Placeholder 1.2
 *
 * jQuery Plugin for form element placeholder 
 *
 * Copyright (c) 2011 AndreO
 * MIT style license, FREE to use, alter, copy, sell, and especially ENHANCE
 *
 */
(function($) {
	$.fn.placeholder = function(options) {
		var options = $.extend({
			wrap: false,
			classWrap: 'placeholder-wrapper',
			classText: 'placeholder-label',
			offset: {
				left: 0,
				top: 0
			}
		}, options);
		
		var els = this;
		
		return this.each(function() {
			
			var el = $(this);
			var title = el.prop('title');
			
			if (!title) {
				return;
			};
			
			var position = el.position();
			var label = $('<label class="' + options.classText + '"></label>');
			var ml = parseInt(el.css('margin-left').replace('auto', 0));
			var pl = parseInt(el.css('padding-left').replace('auto', 0));
			var blw = parseInt(el.css('border-left-width').replace('auto', 0));
			var mt = parseInt(el.css('margin-top').replace('auto', 0));
			var pt = parseInt(el.css('padding-top').replace('auto', 0));
			var btw = parseInt(el.css('border-top-width').replace('auto', 0));
			
			label.insertBefore(this)
			.text(el.prop('title'))
			.prop('for', el.prop('id') ? el.prop('id') : el.prop('name'))
			.css({
				position: 'absolute',
				cursor: 'text',
				fontSize: el.css('font-size'),
				lineHeight: el.is('textarea') ? el.css('line-height') : el.css('height')
			});
			
			if (options.wrap) {
				var wrap = $('<div class="' + options.classWrap + '"></div>');
				
				label.wrap(wrap);
				
				label.parent().css({
					position: 'relative'
				});
				
				var offset = el.offset();
				
				var left = offset.left + ml + pl + blw;
				var top = 0;
			}
			else {
				
				var left = position.left + ml + pl + blw;
				var top = position.top + mt + pt + btw;
			}
			
			label.css({
				left: left + options.offset.left,
				top: top + options.offset.top
			})
			.click(function() {
				el.focus();
			});
			
			check = function(elements) {
				elements.each(function(){
					var el = $(this);
					var label = $('label[for="' + el.prop('id') + '"]');
					
					if (!el.prop('value')) {
						label.show();
					}
					else {
						label.hide();
					}
				});
			}
			
			el.focus(function() {
				label.hide();
			})
			.blur(function() {
				check(els);
			});
			
			var i = 0;
			var interval = setInterval(function(){
				check(els);
				i++;
				if (i > 10) {
					clearInterval(interval);
				};
			}, 50);
		});
	};
})(jQuery);