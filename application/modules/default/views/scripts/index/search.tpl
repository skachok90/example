<td width="196" valign="top" >
	<div align="center">
		<table cellpadding="5" cellspacing="5" bgcolor="#CC0000">
			<tr>
				<td>
					<div align="left">
						<p><br />
						<br />
						<?php if ($this->data) {?>
							<span class="commentstyle">Here you can see the results for your search on likelihood.</span></p>
						<?php } else {?>
							<span class="commentstyle">Here you can fill in the fields you want to look for a likelihood.</span></p>
						<?php }?>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
					</div>
				</td>
			</tr>
		</table>
	</div>
</td>
<td width="476">
	<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="36"></td>
			<td width="418">
				<div align="left">
					<?php if (($this->data['perfect']['match'] || $this->data['partial']['match']) || (!$this->data['perfect']['totalCnt'] && !$this->data['partial']['totalCnt'] && $this->search)) {?>
						<div><a href="#" class="switch show">Show form</a></div>
					<?php } ?>
					<div class="form-block" style="<?php echo (($this->data['perfect']['match'] || $this->data['partial']['match']) || (!$this->data['perfect']['totalCnt'] && !$this->data['partial']['totalCnt'] && $this->search)) ? 'display:none': 'display:block'?>">
						<span class="style3Serif">Start your search for a person</span><br />
						<br />
						<?php echo $this->form; ?>
						<br /><br /><br /><br />
					</div>
					<?php if ($this->data['perfect']['match'] || $this->data['partial']['match']) {?>
						<span class="style3Serif">Results for your search </span><br />
         				<br />
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<?php if ($this->data['perfect']['match']) { ?>
								<?php foreach ($this->data['perfect']['match'] as $value) {?>
									<?php if (!$perfect_title) { ?>
										<tr>
											<td height="27" class="style5">&nbsp;</td>
											<td colspan="8" class="style5">
												<div align="center">Perfect Match (on provided fields)</div>                
												<div align="center"></div>
												<div align="right"></div>
											</td>
										</tr>
										<tr width="100%">
											<td height="27" class="style5">&nbsp;</td>
											<?php if ($this->title['sex']) {?>
												<td class="style5"><div align="center">sex</div></td>
											<?php }?>
											<?php if ($this->title['birthday']) {?>
												<td class="style5"><div align="center">dob</div></td>
											<?php }?>
											<?php if ($this->title['height']) {?>
												<td class="style5"><div align="center">height</div></td>
											<?php }?>
											<?php if ($this->title['race']) {?>
												<td class="style5"><div align="center">race</div></td>
											<?php }?>
											<?php if ($this->title['firstname_length']) {?>
												<td class="style5"><div align="center">firstname</div></td>
											<?php }?>
											<?php if ($this->title['lastname_length']) {?>
												<td class="style5"><div align="center">lastname</div></td>
											<?php }?>
											<?php if ($this->title['security_id']) {?>
												<td class="style5"><div align="center">ID</div></td>
											<?php }?>
											<td class="style5"><div align="right">%</div></td>
										</tr>
										<?php $perfect_title = true; ?>
									<?php } ?>
									<tr width="100%">
										<td height="22">&nbsp;</td>
										<?php if ($this->title['sex']) {?>
											<td><div align="center"><?php echo $value['sex']?></div></td>
										<?php }?>
										<?php if ($this->title['birthday']) {?>
											<td> <div align="center"><?php echo $value['birthday']?></div></td>
										<?php }?>
										<?php if ($this->title['height']) {?>
											<td><div align="center"><?php echo $value['height']?></div></td>
										<?php }?>
										<?php if ($this->title['race']) {?>
											<td><div align="center"><?php echo $value['race']?></div></td>
										<?php }?>
										<?php if ($this->title['firstname_length']) {?>
											<td><div align="center"><?php echo $value['firstname_length']?></div></td>
										<?php }?>
										<?php if ($this->title['lastname_length']) {?>
											<td><div align="center"><?php echo $value['lastname_length']?></div></td>
										<?php }?>
										<?php if ($this->title['security_id']) {?>
											<td><div align="center"><?php echo $value['security_id']?></div></td>
										<?php }?>
										<td><div align="right"><?php echo $value['percent']?></div></td>
									</tr>
								<?php }?>
							<?php }?>
							<?php if ($this->data['perfect']['totalCnt'] > count($this->data['perfect']['match'])) { ?>
								<tr>
									<td height="27" class="style5">&nbsp;</td>
									<td colspan="<?php echo $this->countFields + 1;?>"><a href="<?php echo $this->url(array(), 'default:show-perfect-match') . '?' . $this->query;?>">Show more</a></td>
								</tr>
							<?php }?>
							<?php if ($this->data['partial']['match']) { ?>
								<?php foreach ($this->data['partial']['match'] as $value) {?>
									<?php if (!$partial_title) {?>
										<?php if($perfect_title) {?>
											<tr>
												<td height="27" class="style5">&nbsp;</td>
											</tr>
										<?php } ?>
										<tr>
											<td height="27" class="style5">&nbsp;</td>
											<td colspan="6" class="style5"><div align="center">Partial Matches</div></td>
										</tr>
										<tr>
											<td height="27" class="style5">&nbsp;</td>
											<?php if ($this->title['sex']) {?>
												<td class="style5"><div align="center">sex</div></td>
											<?php }?>
											<?php if ($this->title['birthday']) {?>
												<td class="style5"><div align="center">dob </div></td>
											<?php }?>
											<?php if ($this->title['height']) {?>
												<td class="style5"><div align="center">height</div></td>
											<?php }?>
											<?php if ($this->title['race']) {?>
												<td class="style5"><div align="center">race</div></td>
											<?php }?>
											<?php if ($this->title['firstname_length']) {?>
												<td class="style5"><div align="center">firstname</div></td>
											<?php }?>
											<?php if ($this->title['lastname_length']) {?>
												<td class="style5"><div align="center">lastname</div></td>
											<?php }?>
											<?php if ($this->title['security_id']) {?>
												<td class="style5"><div align="center">ID</div></td>
											<?php }?>
											<td class="style5"><div align="right">%</div></td>
										</tr>
										<?php $partial_title = true; ?>
									<?php } ?>
									<tr>
										<td height="22">&nbsp;</td>
										<?php if ($this->title['sex']) {?>
											<td><div align="center"><?php echo $value['sex']?></div></td>
										<?php }?>
										<?php if ($this->title['birthday']) {?>
											<td><div align="center"><?php echo $value['birthday']?></div></td>
										<?php }?>
										<?php if ($this->title['height']) {?>
											<td><div align="center"><?php echo $value['height']?></div></td>
										<?php }?>
										<?php if ($this->title['race']) {?>
											<td><div align="center"><?php echo $value['race']?></div></td>
										<?php }?>
										<?php if ($this->title['firstname_length']) {?>
											<td><div align="center"><?php echo $value['firstname_length']?></div></td>
										<?php }?>
										<?php if ($this->title['lastname_length']) {?>
											<td><div align="center"><?php echo $value['lastname_length']?></div></td>
										<?php }?>
										<?php if ($this->title['security_id']) {?>
											<td><div align="center"><?php echo $value['security_id']?></div></td>
										<?php }?>
										<td><div align="right"><?php echo $value['percent']?></div></td>
									</tr>
								<?php } ?>
							<?php } ?>
							<?php if ($this->data['partial']['totalCnt'] > count($this->data['partial']['match'])) { ?>
								<tr>
									<td height="27" class="style5">&nbsp;</td>
									<td colspan="<?php echo $this->countFields + 1;?>"><a href="<?php echo $this->url(array(), 'default:show-partial-match') . '?' . $this->query;?>">Show more</a></td>
								</tr>
							<?php } ?>
						</table>
						<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
					<?php }  else { ?>
						<?php if ($this->search) { ?>
							<tr>
								<td height="27" class="style5">&nbsp;</td>
								<td colspan="<?php echo $this->countFields + 1;?>" class="style5">No data</td>
							</tr>
							<tr height="125"></tr>
						<?php } ?>
					<?php } ?>
				</div>
			</td>
			<td width="35"></td>
		</tr>
	</table>
</td>
<script type="text/javascript">
	$('.switch').on('click', function(){
		if ($(this).hasClass('show')) {
			$(this).text('Hide form');
			$(this).removeClass('show');
			$(this).addClass('hide');
			$('.form-block').fadeIn(100);
		} else {
			$(this).text('Show form');
			$(this).removeClass('hide');
			$(this).addClass('show');
			$('.form-block').fadeOut(100);
		}
		return false;
	});
	$('.datepicker').datepicker({
		"dateFormat": "dd-mm-y"
	});
</script>