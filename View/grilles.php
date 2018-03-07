<!DOCTYPE html>
<html>
<head>
	<title>
		<?php print htmlentities($title); ?>
	</title>
	<script src="Public/js/mysearch.js"></script>
	<script src="Public/js/bootstrap-sortable.js"></script>
	<link href="Public/css/bootstrap-sortable.css" rel="stylesheet" type="text/css">

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
					<li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
					<li class="breadcrumb-item"><a href="index.php?page=projet">Projets</a></li>
					<li class="breadcrumb-item active">Grilles</li>
				</ol>
			</div>
			
		</div>
		<hr>
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-12 col-12">
				<input type="text" class="form-control" id="myInput" onkeyup="mySearch()" placeholder="Recherche...">
			</div>
			<div class="col-12 col-sm-4 col-md-6 col-lg-6 text-right">
				<?php 
					print '<a href="index.php?page=grille&op=new&projetId='.$projetId.'" class="btn btn-primary"><i style="margin-right: 10px; color: #fff;" class="fas fa-plus"></i>Ajouter une grille</a>';
				?>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">	
				<table class="table table-hover table-responsive sortable" id="myTable">
					<thead class="color-primary-dark">
						<tr class="text-white">
							<th data-defaultsign="az" scope="col" style="width: 60%">Titre<span id="spanSort" class="spanaz"><i class="fa fa-fw fa-sort"></i></span></th>
							<th class="middle" data-defaultsort="disabled" scope="col" style="width: 20%">Not&eacute; sur</th>
							<th class="middle" data-defaultsort="disabled" scope="col" style="width: 20%">Coef</th>
							<th class="middle" data-defaultsort="disabled" scope="col" style="width: 20%">Comp&eacute;tences</th>
							<th class="middle" data-defaultsort="disabled" scope="col" style="width: 25%">Modifier</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach ($grilles as $grille) : ?>
						<tr>
							<td><?php print htmlentities($grille['titre']); ?></td>
							<td class="middle"><?php print htmlentities($grille['note_sur']); ?></td>
							<td class="middle"><?php print htmlentities($grille['coef']); ?></td>
							<td class="middle"><?php echo '<a href="index.php?page=competence&projetId='.htmlentities($projetId).'&grilleId='.htmlentities($grille['id']).'">';?><i class="fas fa-list"></i></a></td>
							<td class="middle"><a href="#" data-toggle="modal" data-target="#myModalModifier<?php print htmlentities($grille['id'])?>"><i class="far fa-edit"></i></a></td>
						</tr>
						<!-- Modal -->
						<div class="modal fade" id="myModalModifier<?php print htmlentities($grille['id'])?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
						<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Modification de la grille</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<form method="POST" action="">
	                        	<input class="hidden" type="text" name="id" value="<?php print htmlentities($grille['id']); ?>"/>
	                        	<div class="form-groupe">
		                            <label for="titre">Titre:</label>
	                            	<input type="text" class="form-control" id="titre" name="titre" value="<?php print htmlentities($grille['titre']); ?>"/>
	                        	</div>
	                        	<div class="form-groupe">
		                            <label for="note">Not&eacute; sur:</label>
		                            <input type="text" id="note_sur" name="note_sur" class="form-control" value="<?php print htmlentities($grille['note_sur']) ?>"/>
		                        </div>
		                        <div class="form-groupe">
		                            <label for="coef">Coef:</label>
		                            <input type="text" name="coef" class="form-control" id="coef" value="<?php print htmlentities($grille['coef']) ?>"/>
		                        </div>
		                        
		                        <div class="form-groupe">
	                            	<input type="hidden" name="form-submitted" value="1" />
	                            	<input type="submit" value="Valider" id="btnValider" class="btn btn-info" />
		                        </div>
	                        </form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
						</div>
						</div>
						</div>
						</div>
						
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