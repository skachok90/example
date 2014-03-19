(function($){
	$(function () {
		$('a.submit').on('click', function(){
			var form = $(this).parents('form');
			$(form).submit();
			return false;
		});
	});
})(jQuery);
