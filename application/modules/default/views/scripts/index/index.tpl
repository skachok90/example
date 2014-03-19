<?php if (!$this->userInfo) {?>
	<?php echo $this->action('login', 'auth'); ?>
<?php } else {?>
	<?php echo $this->action('search', 'index'); ?>
<?php }?>