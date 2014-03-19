<article class="full-block clearfix">
	<header>
		<h2>Customer edit</h2>
	</header>
	<section>
		<?php echo $this->form ?>
	</section>
</article>
<script type="text/javascript">
(function($){
	$(function () {
		$('#studies-all').change(function(){
			if ($(this).prop('checked')) {
				$('form [name="studies[]"]').prop('disabled', true);
				$(this).prop('disabled', false);
			} else {
				$('form [name="studies[]"]').prop('disabled', false);
			}
		});
		$('#studies-all').trigger('change');
	});
})(jQuery);
</script>