<section id="user-info">
	<img src="<?php echo $this->urlImg ?>admin/sample_user.png" alt="Sample User Avatar">
	<div>
		<a href="<?php echo $this->url(array(), 'admin:profile') ?>" title="Account Settings"><?php echo $this->userInfo['login'] ?></a>
		<em>Administrator</em>
		<ul>
			<li><a class="button-link" href="<?php echo $this->url(array(), 'index') ?>" target="balnk">view website</a></li>
			<li><a class="button-link" href="<?php echo $this->url(array(), 'admin:logout') ?>">logout</a></li>
		</ul>
	</div>
</section>