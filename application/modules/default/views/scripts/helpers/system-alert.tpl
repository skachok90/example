<?php if ($this->msgList) { ?>
	<script type="text/javascript" charset="utf-8">
		$(function () {
			var messages = <?php echo Zend_Json::encode($this->msgList) ?>;
			
			for (var i = 0, j = messages.length; i < j; i++) {
				
				$.gritter.add(messages[i]);
			}
		});
	</script>
<?php } ?>