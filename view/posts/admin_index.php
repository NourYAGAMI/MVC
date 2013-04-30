<div class="page-header">
	<H1><?php echo $totals; ?> Articles</H1>
</div>

<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Titre</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($posts as $k => $v): ?>
		<tr>
			<td><?php echo $v->id; ?></td>
			<td><?php echo $v->name; ?></td>
			<td>
				<a href="<?php Router::('admin/posts/edit'.$v->id); ?>">Editer</a> 
				<a onclick="return confirm('Voulez vous vraiment supprimer ce contenu?')" href="<?php Router::('admin/posts/edit'.$v->id); ?>">Supprimer</a>
			</td>
		</tr>			
		<?php endforeach ?>
	</tbody>
</table>