<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<?php if (in_array('codeError', $this->element->getErrorMessages())) {?>
		<tr>
			<td width="9%"><div align="left"></div></td>
			<td>
				<label>
					<div align="left" class="error">
						Code incorrect
					</div>
				</label>
			</td>
			<td><div align="left"></div></td>
		</tr>
	<?php }?>
	<?php echo $this->element->password; ?>
	<?php echo $this->element->confirm; ?>
	<tr>
		<td width="13%">&nbsp;</td>
		<td width="37%" class="style5">
			<p>&nbsp;</p>
			<p><a href="#" class="submit">submit</a></p>
		</td>
		<td width="37%"></td>
		<td width="13%">&nbsp;</td>
	</tr>
</table>