<article class="full-block clearfix">
	<header>
		<h2>Patient edit</h2>
	</header>
	<section>
		<?php echo $this->form ?>
	</section>
</article>
<script type="text/javascript">
(function($){
	$(function () {
		$(".datepicker").datepick("option", "dateFormat", "dd-mm-yy");
	});
})(jQuery);
</script>