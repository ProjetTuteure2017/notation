<!DOCTYPE html>
<html>
<head>
	<title>
		<?php print htmlentities($title); ?>
	</title>
	<script src="..\Public\js\verif_point.js" type="text/javascript"></script>
</head>

<body>
	<div class="container">
		<?php 
			sec_session_start();
			if($check == true) {
				$enseignantId = isset($_SESSION['id'])? $_SESSION['id']:NULL;
		?>


		<a href="index.php?page=noteCompetence&selectProjet=<?php print (isset($_GET['projetId']) ? $_GET['projetId'] : NULL);?>">Retour<a/>
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
						<form method="POST" action="" style="display : inline;" onsubmit ="return verification()">
							<td><input type="text" name="note" value="<?php print $this->Bidouille($competence['id'])['note']; ?>"/></td>
							<td><input type="text" name="appreciation" value="<?php print $this->Bidouille($competence['id'])['appreciation']; ?>"/></td>
							<td>
								<input type="hidden" name="competenceId" value="<?php print htmlentities($competence['id']); ?>" />
								<input type="hidden" name="nombrePoint" value="<?php print htmlentities($competence['nombrePoint']); ?>" />
								<input type="hidden" name="form-submitted" value="1" />
								<input type="submit" value="<?php $this->Bidouille($competence['id']) != NULL ? print "Modifier" : print "Ajouter"  ?>" />
							</td>
						</form>
		       		</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<?php 
				print '<a href="index.php?page=competence&op=new&grilleId='.$grilleId.'">Ajouter competence</a>';
			?>	
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