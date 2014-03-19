<td width="196" valign="top" >
	<div align="center">
		<table cellpadding="5" cellspacing="5" bgcolor="#CC0000">
			<tr>
				<td>
					<div align="left">
						<p><br />
						<br />
						<span class="commentstyle">Here you are redirected to when you don't remember your password.<br />
							We have to define what is the thing here. </span></p>
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
			<td width="405">
				<div align="left">
					<p><span class="style3Serif">Forgot your password?</span></p>
					<p>You will get a new ID and password as soon as we have checked your credentials.<br />
						<br />    
					</p>
					<?php if (!$this->success) {?>
						<?php echo $this->form; ?>
					<?php } else {?>
						<span class="send-success-code">Code sent to you email address</span>
					<?php }?>
					<br />
					<br />
					<br /><br />
					<br />
					<br />
					<br />
					<br />
					<br />
					<br />
				</div>
			</td>
			<td width="35"></td>
		</tr>
	</table>
</td>