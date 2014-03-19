<article class="full-block clearfix">
	<div class="article-container">
		<header>
			<h2>Incoming requests</h2>
		</header>
		<div class="users-list">
			<?php if($this->list) { ?>
					<div class="row">
						<table>
							<thead>
								<tr>
									<th>Id</th>
									<th>Sex</th>
									<th>Birthday</th>
									<th>Height</th>
									<th>Race</th>
									<th>Number of letters first name</th>
									<th>Number of letters last name</th>
									<th>Last four digits of national ID or Security Number</th>
									<?php /*?>
									<th>Actions</th>
									<?php */?>
								</tr>
							</thead>
							<tbody>
								<?php for($i = 0, $sz = count($this->list); $i < $sz; $i++) { ?>
									<tr>
										<td><?php echo $this->list[$i]['id'] ?></td>
										<td><?php echo $this->list[$i]['sex'] ?></td>
										<td><?php echo $this->list[$i]['birthday'] ?></td>
										<td><?php echo $this->list[$i]['height'] ?></td>
										<td><?php echo $this->list[$i]['race'] ?></td>
										<td><?php echo $this->list[$i]['firstname'] ?></td>
										<td><?php echo $this->list[$i]['lastname'] ?></td>
										<td><?php echo $this->list[$i]['security_id'] ?></td>
										<?php /*?>
										<td>
											<ul class="actions">
												<li><a rel="tooltip" title="Edit incoming request" href="<?php echo $this->url(array('id' => $this->list[$i]['id']), 'admin:edit-incoming-request') ?>" class="edit">edit</a></li>
												<li><a rel="tooltip" onclick="return confirm('You are about to delete incoming request. Are you sure?')" title="Delete patient" href="<?php echo $this->url(array('id' => $this->list[$i]['id']), 'admin:delete-incoming-request') ?>" class="delete">delete</a></li>
											</ul>
										</td>
										<?php */?>
									</tr>
								<?php } ?>
							</tbody>
							<tfoot><tr><td colspan="8"><?php echo $this->paginationControl($this->paginator, 'Sliding', 'partials/pagination.tpl') ?></td></tr></tfoot>
						</table>
					</div>
			<?php } else { ?>
				<div class="notification information">
					<p>
						<strong>
							No data
						</strong>
					</p>
				</div>
			<?php } ?>
		</div>
	</div>
</article>