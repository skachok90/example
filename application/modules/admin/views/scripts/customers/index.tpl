<article class="full-block clearfix">
	<div class="article-container">
		<header>
			<h2>Customers</h2>
		</header>
		<section>
		<div class="users-list">
			<?php if($this->list) { ?>
					<div class="row">
						<table>
							<thead>
								<tr>
									<th class="sorted sort-id">Id</th>
									<th class="sorted sort-email">E-mail</th>
									<th class="sorted sort-phone">Telephone</th>
									<th class="sorted sort-registration_id">Registration id</th>
									<th class="sorted sort-resp_party">Responsible party</th>
									<th class="sorted sort-institutional_name">Institutional name</th>
									<th class="sorted sort-payment_method">Payment method</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php for($i = 0, $sz = count($this->list); $i < $sz; $i++) { ?>
									<tr>
										<td><?php echo $this->list[$i]['id'] ?></td>
										<td><?php echo $this->list[$i]['email'] ?></td>
										<td><?php echo $this->list[$i]['phone'] ?></td>
										<td><?php echo $this->list[$i]['registration_id'] ?></td>
										<td><?php echo $this->list[$i]['resp_party'] ?></td>
										<td><?php echo $this->list[$i]['institutional_name'] ?></td>
										<td><?php echo $this->list[$i]['payment_method'] ?></td>
										<td>
											<ul class="actions">
												<li><a rel="tooltip" title="Edit customer" href="<?php echo $this->url(array('id' => $this->list[$i]['id']), 'admin:edit-customer') ?>" class="edit">edit</a></li>
												<li><a rel="tooltip" onclick="return confirm('You are about to delete customer. Are you sure?')" title="Delete customer" href="<?php echo $this->url(array('id' => $this->list[$i]['id']), 'admin:delete-customer') ?>" class="delete">delete</a></li>
											</ul>
										</td>
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
		</section>
	</div>
</article>