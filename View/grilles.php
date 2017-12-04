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
						<th scope="col">Note</th>
						<th scope="col">Coef</th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
					<?php 
						foreach ($grilles as $grille) : ?>
					<tr>
						<td><?php print htmlentities($grille['titre']); ?></td>
						<td><?php print htmlentities($grille['note']); ?></td>
						<td><?php print htmlentities($grille['coef']); ?></td>
						<td>+</td>
						<td><button id="btnModifier" type="button" class="btn btn-sm btn-info disabled">Modifier</button></td>
					</tr>
					<tr id="modifier" class="hidden">
						<td colspan="3">
							<div>
		                        <form method="POST" action="" style="display : inline;">
		                        	<input class="hidden" type="text" name="id" value="<?php print htmlentities($grille['id']); ?>"/>
		                            <label for="titre">Titre:</label>
		                            <input type="text" name="titre" value="<?php print htmlentities($grille['titre']); ?>"/>
		                            <label for="note">Note:</label>
		                            <input type="text" name="note" value="<?php print htmlentities($grille['note']) ?>"/>
		                            <label for="coef">Coef:</label>
		                            <input type="text" name="coef" value="<?php print htmlentities($grille['note']) ?>"/>
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