<!DOCTYPE html>
<html>
<head>
	<title>
		La grille d'&eacute;valuation
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
    		<div class="col-lg-6 col-md-6 col-sm-12 col-12">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.php?page=noteCompetence&selectProjet=<?php print (isset($_GET['projetId']) ? $_GET['projetId'] : NULL);?>">Groupes</a></li>
					<li class="breadcrumb-item active">Grille d'&eacute;valuation</li>
				</ol>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-8 col-12">
				<h4> Groupe: <?php print $groupeId;?></h4>
			</div>
			<div class="col-12 col-sm-4 col-md-6 col-lg-6 text-right">
				<a href="index.php?page=competence&op=new&grilleId=<?php echo $grilleId; ?>" class="btn btn-primary"><i style="margin-right: 10px; color: #fff;" class="fas fa-plus"></i>Ajouter competence</a>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<br>
			<table class="table table-responsive table-hover sortable">
		    	<thead class="color-primary-dark">
					<tr class="text-white">
						<th data-defaultsign="az" scope="col" style="width: 20%">Th&egrave;me<span id="spanSort" class="spanaz"><i class="fa fa-fw fa-sort"></i></span></th>
						<th data-defaultsort="disabled" scope="col" style="width: 45%">Intitule</th>
						<th class="middle" data-defaultsort="disabled" scope="col" style="width: 10%">Points</th>
						<th class="middle" data-defaultsort="disabled" scope="col" style="width: 10%">Note</th>
						<th class="middle" data-defaultsort="disabled" scope="col" style="width: 25%">Appreciation</th>
						<th class="middle" data-defaultsort="disabled" scope="col" style="width: 10%">Modifier/Ajouter</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($competences as $competence) : ?>
		      		<tr>
						<td><?php print htmlentities($competence['theme']); ?></td>
						<td><?php print htmlentities($competence['intitule']); ?></td>
						<td class="middle"><?php print htmlentities($competence['nombrePoint']); ?></td>
						<form method="POST" action="" style="display : inline;" onsubmit ="return verification()">
							<td class="middle"><input type="text" name="note" class="form-control" value="<?php print $this->Bidouille($competence['id'])['note']; ?>"/></td>
							<td class="middle"><input type="text" name="appreciation" class="form-control" value="<?php print $this->Bidouille($competence['id'])['appreciation']; ?>"/></td>
							<input type="hidden" name="competenceId" value="<?php print htmlentities($competence['id']); ?>" />
							<input type="hidden" name="nombrePoint" value="<?php print htmlentities($competence['nombrePoint']); ?>" />
							<input type="hidden" name="form-submitted" value="1" />
							<td class="middle">
								<button type="submit" class="btn"><?php $this->Bidouille($competence['id']) != NULL ? print '<i class="fas fa-edit"></i>' : print '<i class="fas fa-plus"></i>'  ?> </button>
							</td>
						</form>
		       		</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
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
	<script>
	$( document ).ready(function() {
		$("th" ).click(function() {
			$('#spanSort').hide();
		});
	});
 </script>	
</body>
</html>