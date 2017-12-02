<!DOCTYPE html>
<html>
<head>
	<title>
		<?php print htmlentities($title); ?>
	</title>

</head>

<body>
	<div class="container">
		<div class="col-md-12">

			<table class="table table-striped">
				<thead>
					<tr>
						<th scope="col">Titre</th>
						<th scope="col">Description</th>
						<th scope="col">Enseignant</th>
						<th scope="col">Grille</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						foreach ($projets as $projet) : ?>
					<tr>
						<td><?php print htmlentities($projet['titre']); ?></td>
						<td><?php print htmlentities($projet['description']); ?></td>
						<td><?php print htmlentities($projet['enseignantId']); ?></td>
						<td>+</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</body>

</html>