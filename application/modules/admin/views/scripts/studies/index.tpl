<article class="full-block clearfix">
	<div class="article-container">
		<header>
			<h2>Studies</h2>
		</header>
		<div class="dataTables_length">
			<a class="button" href="<?php echo $this->url(array(), 'admin:add-study') ?>">Add study</a>
			<a class="button blue" href="<?php echo $this->url(array('study-id' => $this->studyId), 'admin:import-patients') ?>">Import patients</a>
		</div>
		<?php if($this->list) { ?>
			<table>
				<thead>
					<tr>
						<th class="sorted sort-id">Name</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php for($i = 0, $sz = count($this->list); $i < $sz; $i++) { ?>
						<tr>
							<td><a href="<?php echo $this->url(array('study-id' => $this->list[$i]['id']), 'admin:patients')?>"><?php echo $this->list[$i]['name'] ?></a></td>
							<td>
								<ul class="actions">
									<li><a rel="tooltip" title="Edit study" href="<?php echo $this->url(array('id' => $this->list[$i]['id']), 'admin:edit-study') ?>" class="edit">edit</a></li>
									<li><a rel="tooltip" onclick="return confirm('You are about to delete study. Are you sure?')" title="Delete study" href="<?php echo $this->url(array('id' => $this->list[$i]['id']), 'admin:delete-study') ?>" class="delete">delete</a></li>
									<li><a rel="tooltip" href="<?php echo $this->url(array('study-id' => $this->list[$i]['id']), 'admin:patients')?>" class="view" original-title="View patients">view</a></li>
								</ul>
							</td>
						</tr>
					<?php } ?>
				</tbody>
				<tfoot><tr><td colspan="2"><?php echo $this->paginationControl($this->paginator, 'Sliding', 'partials/pagination.tpl') ?></td></tr></tfoot>
			</table>
		<?php } else { ?>
			<div class="notification information">
				<p><strong>No data</strong></p>
			</div>
		<?php } ?>
	</div>
</article>