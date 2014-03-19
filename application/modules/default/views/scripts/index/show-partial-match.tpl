<td width="196" valign="top" >
	<div align="center">
		<table cellpadding="5" cellspacing="5" bgcolor="#CC0000">
			<tr>
				<td>
					<div align="left">
						<p><br />
						<br />
						<span class="commentstyle">Partial Matches.</span></p>
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
					<span class="style3Serif">Results for your search </span><br />
					<br />
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td height="27" class="style5">&nbsp;</td>
							<td colspan="<?php echo $this->countFields + 1;?>"><a href="<?php echo $this->url(array(), 'default:show-perfect-match') . '?' . $this->query;?>">Show perfect records</a></td>
						</tr>
						<tr>
							<td height="27" class="style5">&nbsp;</td>
							<td colspan="6" class="style5"><div align="center">Partial Matches</div></td>
						</tr>
						<?php if ($this->data['partial']['match']) { ?>
							<?php foreach ($this->data['partial']['match'] as $value) {?>
								<?php if (!$partial_title) {?>
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
						<?php } else { ?>
							<tr>
								<td height="27" class="style5">&nbsp;</td>
								<td colspan="<?php echo $this->countFields + 1;?>" class="style5">No data</td>
							</tr>
						<?php } ?>
						<tfoot><tr><td colspan="<?php echo $this->countFields + 2;?>"><?php echo $this->paginationControl($this->paginator, 'Sliding', 'partials/pagination.tpl') ?></td></tr></tfoot>
					</table>
					<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
				</div>
			</td>
			<td width="35"></td>
		</tr>
	</table>
</td>