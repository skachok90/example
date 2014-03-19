<?php echo $this->doctype() ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php 
		echo $this->headTitle();
		echo $this->headMeta()
			->appendHttpEquiv('X-UA-Compatible', 'IE=edge,chrome=1');
	?>
	
	<!-- CSS Styles -->
	
	<?php 
			echo $this->headLink()
			->appendStylesheet($this->urlCss . 'admin/style.css')
			->appendStylesheet($this->urlCss . 'admin/colors.css')
			->appendStylesheet($this->urlCss . 'admin/jquery.tipsy.css')
			->appendStylesheet($this->urlCss . 'admin/jquery.wysiwyg.css')
			->appendStylesheet($this->urlCss . 'admin/jquery.datatables.css')
			->appendStylesheet($this->urlCss . 'admin/jquery.nyromodal.css')
			->appendStylesheet($this->urlCss . 'admin/jquery.datepicker.css')
			->appendStylesheet($this->urlCss . 'admin/jquery.fileinput.css')
			->appendStylesheet($this->urlCss . 'admin/jquery.fullcalendar.css')
			->appendStylesheet($this->urlCss . 'admin/jquery.visualize.css')
			->appendStylesheet($this->urlCss . 'admin/jquery.jqplot.min.css');
		?>

	<!-- Google WebFonts -->
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=PT+Sans:regular,italic,bold,bolditalic">

	<?php 
		echo $this->headScript()
		->appendFile($this->urlJs . 'admin/libs/modernizr-1.7.min.js')
		->appendFile($this->urlJs . 'admin/jquery/jquery-1.7.1.min.js')
		->appendFile($this->urlJs . 'admin/libs/selectivizr.js')
		->appendFile($this->urlJs . 'admin/jquery/jquery.nyromodal.js')
		->appendFile($this->urlJs . 'admin/jquery/jquery.tipsy.js')
		->appendFile($this->urlJs . 'admin/jquery/jquery.wysiwyg.js')
		->appendFile($this->urlJs . 'admin/jquery/jquery.datatables.js')
		->appendFile($this->urlJs . 'admin/jquery/jquery.datepicker.js')
		->appendFile($this->urlJs . 'admin/jquery/jquery.fileinput.js')
		->appendFile($this->urlJs . 'admin/jquery/jquery.fullcalendar.min.js')
		->appendFile($this->urlJs . 'jquery.uri.js')
		->appendFile($this->urlJs . 'jquery.placeholder.js')
		->appendFile($this->urlJs . 'jquery.sorted.js')
		->appendFile($this->urlJs . 'admin/jquery/excanvas.js')
		->appendFile($this->urlJs . 'admin/jquery/jquery.visualize.js')
		->appendFile($this->urlJs . 'admin/jquery/jquery.visualize.tooltip.js')
		->appendFile($this->urlJs . 'admin/libs/modernizr-1.7.min.js')
		->appendFile($this->urlJs . 'admin/removeGroup.js')
		->appendFile($this->urlJs . 'admin/script.js');
	?>
</head>
<body>
	<div class="fixed-wraper">
		<section role="navigation">
			<header>
				<a href="<?php echo $this->url(array(), 'admin') ?>" title="Back to Homepage"></a>
				<h1>DupCheck</h1>
			</header>
			<?php echo $this->action('index', 'admin', 'admin'); ?>
			<?php echo $this->action('menu', 'index', 'admin'); ?>
		</section>
		<section role="main">
			<?php echo $this->layout()->content; ?>
		</section>
	</div>
</body>
</html>