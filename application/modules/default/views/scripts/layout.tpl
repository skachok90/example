<?php echo $this->doctype() ?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php 
			echo $this->headTitle();
			echo $this->headMeta()
				->appendHttpEquiv('X-UA-Compatible', 'IE=edge,chrome=1');
		?>
		
		<?php 
			echo $this->headLink()
			->appendStylesheet($this->urlCss . 'main.css')
			->appendStylesheet($this->urlCss . 'datepicker/jquery-ui-1.10.1.custom.min.css');
		?>
		<?php 
		echo $this->headScript()
		->appendFile($this->urlJs . 'vendor/jquery-1.9.0.min.js')
		->appendFile($this->urlJs . 'main.js')
		->appendFile($this->urlJs . 'vendor/jquery-ui-1.10.1.custom.min.js');
		?>
	</head>
	<body>
		<?php echo $this->partial('partials/header.tpl', $this) ?>
		<?php echo $this->layout()->content ?>
		<?php echo $this->partial('partials/footer.tpl', $this) ?>
	</body>
</html>