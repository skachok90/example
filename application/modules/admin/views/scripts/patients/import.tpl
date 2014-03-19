<article class="full-block clearfix">
	<header>
		<h2>Import patients</h2>
	</header>
	<section>
		<?php echo $this->form ?>
	</section>
</article>
<script type="text/javascript">
(function($){
	$(function () {
		$('#studies').change(function(){
			if ($(this).find(':selected').prop('value') != 0) {
				$('form input#name').prop('disabled', true);
			} else {
				$('form input#name').prop('disabled', false);
			}
		});
		$('#studies').trigger('change');
	});
})(jQuery);
</script>