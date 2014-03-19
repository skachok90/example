(function($) {
	$.fn.sorted = function(options) {
		var options = $.extend({
			classPrefix: 'sort-',
			paramSort: 'sort',
			paramDirection: 'dir',
			paramPage: 'page',
			sortArray: true
		}, options);
		
		var uri = $.uri();
		var sort = uri.getParam(options.paramSort);
		var direction = uri.getParam(options.paramDirection);
		var reg = new RegExp(".*" + options.classPrefix + "(\\w+).*", "ig");
		
		if (options.sortArray) {
			var s = sort;
			for (sort in s) {
				direction = s[sort];
			}
		};
		
		return this.each(function() {
			
			var $this = $(this);
			var sorted = false;
			
			if ($this.hasClass(options.classPrefix + sort)) {
				$this.removeClass('asc desc').addClass(direction);
				sorted = true;
			}
			
			if ($this.hasClass('asc') || $this.hasClass('desc')) {
				direction = $this.hasClass('asc') ? 'asc' : 'desc';
				sorted = true;
			}
			
			$this.click(function(){
				
				var by = $this.prop('class').replace(reg, '$1');
				var dir = 'asc';
				
				if (sorted && direction == 'asc') {
					dir = 'desc';
				};
				
				if (options.sortArray) {
					eval("var p = {" + by + ": '" + dir + "'};");
					uri.setParam(options.paramSort, p);
				} else {
					
					uri.setParam(options.paramSort, by);
					uri.setParam(options.paramDirection, dir);
				}
				
				uri.removeParam(options.paramPage).go();
			});
		});
	};
})(jQuery);