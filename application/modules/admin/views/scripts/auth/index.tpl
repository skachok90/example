<section role="main">
	<article id="login-box">
		<div class="article-container">
			<?php if ($this->error) { ?>
			<div class="notification error">
				<a href="#" class="close-notification" title="Hide Notification" rel="tooltip">x</a>
				<p><strong>Login incorrect</strong></p>
			</div>
		    <?php } ?>
		    <?php echo $this->form ?>
		</div>
	</article>
</section>