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
			<?php     
                if(!isset($_SESSION['nom']))
                {
	                print '<div class="alert alert-dismissible alert-warning">';
	                print '<button type="button" class="close" data-dismiss="alert">&times;</button>';
	                print "<h4>Vous n'&ecirc;tes pas connecter!</h4>";
	                print '<a href="index.php?op=login">Se connecter</a>';
	                print '</div>';

	                exit();
                }

				$enseignantId = isset($_SESSION['id'])? $_SESSION['id']:NULL;

            ?>
        </div>
		<h1> Groupe: <?php print $groupeId;?></h1>
		
		<div class="col-md-12">
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
							<td><input type="text" name="note" value="<?php print $this->Bidouille($competence['id'])['note']; ?>"/></td>
							<td><input type="text" name="appreciation" value="<?php print $this->Bidouille($competence['id'])['appreciation']; ?>"/></td>
							<td>
								<input type="hidden" name="competenceId" value="<?php print htmlentities($competence['id']); ?>" />
								<input type="hidden" name="nombrePoint" value="<?php print htmlentities($competence['nombrePoint']); ?>" />
								<input type="hidden" name="form-submitted" value="1" />
								<input type="submit" value="Valider" />
							</td>
						</form>
		       		</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<h2> Note Grille <?php print $noteGrille;?></h2>
		</div>
	</div>
</body>
</html>