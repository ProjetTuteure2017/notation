<!-- 
** Quand c plus d'un projet, Quand click sur "Modifier" affiche que pour le premier (JQ)
**
-->
<!DOCTYPE html>
<html>
<head>
	<title>
		<?php print htmlentities($title); ?>
	</title>
	<script>
		$(document).ready(function(){
		    $('#btnModifier').click(function(){
		        $('#modifier').show();
		    });
		});
	</script>	
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
						<th scope="col"></th>
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
						<td><button id="btnModifier" type="button" class="btn btn-sm btn-info disabled">Modifier</button></td>
					</tr>
					<tr id="modifier" class="hidden">
						<td colspan="3">
							<div>
		                        <form method="POST" action="" style="display : inline;">
		                        	<input class="hidden" type="text" name="id" value="<?php print htmlentities($projet['id']); ?>"/>
		                            <label for="titre">Titre:</label>
		                            <input type="text" name="titre" value="<?php print htmlentities($projet['titre']); ?>"/>
		                            <label for="description">Description:</label>
		                            <input type="text" name="description" value="<?php print htmlentities($projet['description']) ?>"/>
		                            <input type="hidden" name="form-submitted" value="1" />
		                            <input type="submit" value="Modifier" />
		                        </form>

							</div>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</body>

</html>