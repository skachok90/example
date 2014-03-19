<nav id="main-nav">
	<ul>
		<?php foreach ($this->modules as $group => $data) { ?>
			<li <?php echo $data['current'] ? 'class="current"' : '' ?>>
				<a href="<?php echo $this->url(array(), 'admin:' . $data['url_name']) ?>" class="dashboard no-submenu"><?php echo $data['name'] ?></a>
			</li>
		<?php } ?>
	</ul>
</nav>