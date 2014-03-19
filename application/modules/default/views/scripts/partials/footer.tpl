						<td width="225" valign="top">          
			          		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			            		<tr>
			              			<td width="14%">&nbsp;</td>
			              			<td width="72%">
			              				<div align="left">
			              					<a href="mailto:<?php echo Zend_Registry::get('config')->email->support;?>">Contact</a>
			              					<br />
				                			<br />
				                			<br />
				                			<a href="<?php echo $this->url(array(), 'default:terms');?>">Terms &amp; Conditions</a>
				                			<?php if ($this->userInfo) {?>
				              					<br />
					                			<br />
					                			<br />
					                			<a href="<?php echo $this->url(array(), 'default:logout');?>">Logout</a>
				                			<?php } ?>
			                			</div>
			                		</td>
			              			<td width="14%">&nbsp;</td>
			            		</tr>
			          		</table>
			          	</td>
			      	</tr>
			    </table>
    			<table width="100%" border="0" cellspacing="0" cellpadding="0">
  					<tr>
    					<td width="13%">&nbsp;</td>
    					<td width="68%">
    						<div align="center">
        						<span class="style3">copyright 2013 Jonathan Rabinowitz</span><br />
       	 						<br />
    						</div>
    					</td>
    					<td width="19%">&nbsp;</td>
  					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>