<table width="100%" cellpadding="2" cellspacing="0" class="tablerand2">
	<tr>
		<td width="9%"><div align="left"></div></td>
		<td>
			<div align="left">
				<span class="style5"><br />LOGIN<br /><br /></span>
			</div>
		</td>
		<td><div align="left"></div></td>
	</tr>
	<?php if (in_array('notAuth', $this->element->getErrorMessages())) {?>
		<tr>
			<td width="9%"><div align="left"></div></td>
			<td>
				<label>
					<div align="left" class="error">
						Email or password incorrect
					</div>
				</label>
			</td>
			<td><div align="left"></div></td>
		</tr>
	<?php }?>
	<?php echo $this->element->email?>
	<?php echo $this->element->password?>
	<tr>
		<td width="9%"><div align="left"></div></td>
		<td>
			<div align="left"><a href="#" class="style5 submit"><br />SUBMIT</a><br /><br /></div>
		</td>
		<td><div align="left"></div></td>
	</tr>
	<tr>
		<td width="9%"><div align="left"></div></td>
		<td><div align="left"></div></td>
		<td><div align="left"></div></td>
	</tr>
	<tr>
		<td width="9%"><div align="left"></div></td>
		<td>
			<div align="left">
				<span class="style8">
					Forgotten you password? <br />Click <a href="<?php echo $this->url(array(), 'default:forgot');?>"><strong>here</strong></a>.<br /><br />
					You didn't register yet? <br />Click <a href="<?php echo $this->url(array(), 'default:registration');?>"><strong>here</strong></a>.
				</span>
			</div>
		</td>
		<td><div align="left"></div></td>
	</tr>
	<tr>
		<td width="9%"><div align="left"></div></td>
		<td><div align="left"><br /><br /></div></td>
		<td><div align="left"></div></td>
	</tr>
</table>