<article class="full-block clearfix">
	<div class="article-container">
		<header>
			<h2>Delete study</h2>
		</header>
		<section>
			<div class="notification information">
				<p><strong>Do you want to remove this study and its participants?</strong></p>
			</div>
			<dd class="form-buttons">
				<a class="button blue" href="<?php echo $this->url(array('id' => $this->id), 'admin:delete-study') . '?delete_all=true' ?>">Delete</a>
				<a class="button" href="<?php echo $this->url(array(), 'admin:studies') ?>">Cancel</a>
			</dd>
		</section>
	</div>
</article>