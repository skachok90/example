<article class="full-block clearfix">
	<div class="article-container">
		<header>
			<h2>Patients</h2>
		</header>
		<div class="dataTables_length">
			<a class="button" href="<?php echo $this->url(array('study-id' => $this->studyId), 'admin:add-patient') ?>">Add patient</a>
			<a class="button blue" href="<?php echo $this->url(array('study-id' => $this->studyId), 'admin:import-patients') ?>">Import patients</a>
		</div>
		<?php echo $this->form; ?>
		<div class="users-list">
			<?php if($this->list) { ?>
					<div class="row">
						<table>
							<thead>
								<tr>
									<th>Id</th>
									<th>Firstname</th>
									<th>Lastname</th>
									<th>Sex</th>
									<th>Birthday</th>
									<th>Height</th>
									<th>Race</th>
									<th>Number of letters first name</th>
									<th>Number of letters last name</th>
									<th>Last four digits of national ID or Security Number</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php for($i = 0, $sz = count($this->list); $i < $sz; $i++) { ?>
									<tr>
										<td><?php echo $this->list[$i]['id'] ?></td>
										<td><?php echo $this->list[$i]['firstname'] ?></td>
										<td><?php echo $this->list[$i]['lastname'] ?></td>
										<td><?php echo $this->list[$i]['sex'] ?></td>
										<td><?php echo $this->list[$i]['birthday'] ?></td>
										<td><?php echo $this->list[$i]['height'] ?></td>
										<td><?php echo $this->list[$i]['race'] ?></td>
										<td><?php echo $this->list[$i]['firstname_length'] ?></td>
										<td><?php echo $this->list[$i]['lastname_length'] ?></td>
										<td><?php echo $this->list[$i]['security_id'] ?></td>
										<td>
											<ul class="actions">
												<li><a rel="tooltip" title="Edit patient" href="<?php echo $this->url(array('id' => $this->list[$i]['id']), 'admin:edit-patient') ?>" class="edit">edit</a></li>
												<li><a rel="tooltip" onclick="return confirm('You are about to delete patient. Are you sure?')" title="Delete patient" href="<?php echo $this->url(array('id' => $this->list[$i]['id']), 'admin:delete-patient') ?>" class="delete">delete</a></li>
											</ul>
										</td>
									</tr>
								<?php } ?>
							</tbody>
							<tfoot><tr><td colspan="11"><?php echo $this->paginationControl($this->paginator, 'Sliding', 'partials/pagination.tpl') ?></td></tr></tfoot>
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