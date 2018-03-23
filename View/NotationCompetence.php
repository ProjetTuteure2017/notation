<?php
sec_session_start();
?> 
<!-- NOT USED ?-->
<!DOCTYPE html>
<html>
<head>
	<title>
		<?php print htmlentities($title); ?>
	</title>
</head>

<body>
	<div class="container">
		<?php 
			if($check == true) {
				$enseignantId = isset($_SESSION['id'])? $_SESSION['id']:NULL;
		?>

		<h1> Groupe: <?php print $groupeId ?></h1>
		<p>
			<?php 
				print $groupeId; 
				print '<br/>';
			?>
		</p>
		<div class="col-md-12">
			<?php foreach ($grilles as $g) : ?>
			<table class="table table-responsive table-bordered">
		    	<thead>
					<tr>
						<th scope="col">Id</th>
						<th scope="col">Theme</th>
						<th scope="col">Intitule</th>
						<th scope="col">NB Point</th>
						<th scope="col">Note</th>
						<th scope="col">Appreciation</th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($competences as $competence) : ?>
		      		<tr>
		        		<td><?php print htmlentities($competence['id']); ?></td>
						<td><?php print htmlentities($competence['theme']); ?></td>
						<td><?php print htmlentities($competence['intitule']); ?></td>
						<td><?php print htmlentities($competence['nombrePoint']); ?></td>
						<form method="POST" action="" style="display : inline;">
							<td><input type="text" name="note"/></td>
							<td><input type="text" name="appreciation"/></td>
							<td>
								<input type="hidden" name="competenceId" value="<?php print htmlentities($competence['id']); ?>" />
								<input type="hidden" name="form-submitted" value="1" />
								<input type="submit" value="Valider" />
							</td>
						</form>
		       		</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<?php endforeach; ?>
		</div>


		<?php

			} else { 
				print '<div class="row">';
				print '<div class="col-lg-12 col-md-12 col-sm-12">';
				print '<div class="alert alert-dismissible alert-warning">';
				print '<button type="button" class="close" data-dismiss="alert">&times;</button>';
				print "<h4>Vous n'&ecirc;tes pas connecter!</h4>";
				print '<a href="index.php?op=login">Se connecter</a>';
				print '</div>';
				print '</div>';
				print '</div>';
			} 

		?>
	</div>
</body>
</html>