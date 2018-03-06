<!DOCTYPE html>
<html>
<head>
	<title>
		<?php print htmlentities($title); ?>
	</title>
	<link href="Public/css/bootstrap-sortable.css" rel="stylesheet" type="text/css">
	<script src="Public/js/verif_point.js" type="text/javascript"></script>
	<script src="Public/js/bootstrap-sortable.js"></script>
</head>

<body>
	<div class="container">
		<?php 
			sec_session_start();
			if($check == true) {
				$enseignantId = isset($_SESSION['id'])? $_SESSION['id']:NULL;
		?>

		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<a href="index.php?page=noteCompetence&selectProjet=<?php print (isset($_GET['projetId']) ? $_GET['projetId'] : NULL);?>">Retour</a>
				<h4> Groupe: <?php print $groupeId;?></h4>
			</div>
		</div>
		<hr>
		<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<table class="table table-responsive table-hover sortable">
		    	<thead class="color-primary-dark">
					<tr class="text-white">
						<th scope="col" style="width: 20%">Theme</th>
						<th data-defaultsort="disabled" scope="col" style="width: 45%">Intitule</th>
						<th data-defaultsort="disabled" scope="col" style="width: 10%">Points</th>
						<th data-defaultsort="disabled" scope="col" style="width: 10%">Note</th>
						<th data-defaultsort="disabled" scope="col" style="width: 25%">Appreciation</th>
						<th data-defaultsort="disabled" scope="col" style="width: 10%"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($competences as $competence) : ?>
		      		<tr>
						<td><?php print htmlentities($competence['theme']); ?></td>
						<td><?php print htmlentities($competence['intitule']); ?></td>
						<td><?php print htmlentities($competence['nombrePoint']); ?></td>
						<form method="POST" action="" style="display : inline;" onsubmit ="return verification()">
							<td><input type="text" name="note" class="form-control" value="<?php print $this->Bidouille($competence['id'])['note']; ?>"/></td>
							<td><input type="text" name="appreciation" class="form-control" value="<?php print $this->Bidouille($competence['id'])['appreciation']; ?>"/></td>
							<td>
								<input type="hidden" name="competenceId" value="<?php print htmlentities($competence['id']); ?>" />
								<input type="hidden" name="nombrePoint" value="<?php print htmlentities($competence['nombrePoint']); ?>" />
								<input type="hidden" name="form-submitted" value="1" />
								<input type="submit" class="btn btn-sm btn-info" value="<?php $this->Bidouille($competence['id']) != NULL ? print "Modifier" : print "Ajouter"  ?>" />
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