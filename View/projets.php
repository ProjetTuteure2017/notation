<!DOCTYPE html>
<html>
<head>
	<title>
		<?php print htmlentities($title); ?>
	</title>
	<link href="Public/css/bootstrap-sortable.css" rel="stylesheet" type="text/css">
	<script src="Public/js/bootstrap-sortable.js"></script>
	<script src="Public/js/mysearch.js"></script>


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
					<li class="breadcrumb-item active">Projets</li>
				</ol>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-8 col-12">
				<input type="text" class="form-control" id="myInput" onkeyup="mySearch()" placeholder="Recherche...">
			</div>
			<div class="col-12 col-sm-4 col-md-6 col-lg-6 text-right">
				<a href="index.php?page=projet&op=new" class="btn btn-primary"><i style="margin-right: 10px; color: #fff;" class="fas fa-plus"></i>Ajouter un projet</a>
			</div>
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
				<table id="myTable" class="table table-responsive table-hover sortable">
					<thead class="color-primary-dark">
						<tr class="text-white">
							<th data-defaultsign="az" scope="col" style="width: 25%">Titre<span id="spanSort" class="spanaz"><i class="fa fa-fw fa-sort"></i></span></th>
							<th data-defaultsort="disabled" scope="col" style="width: 50%">Description</th>
							<th class="middle" data-defaultsort="disabled" scope="col" style="width: 10%">Grilles</th>
							<th class="middle" data-defaultsort="disabled" scope="col" style="width: 10%">Enseignant</th>
							<th class="middle" data-defaultsort="disabled" scope="col" style="width: 10%">Modifier</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach ($projets as $projet) : ?>
						<tr>
							<td><?php print htmlentities($projet['titre']); ?></td>
							<td><?php print htmlentities($projet['description']); ?></td>
							<td class="middle"><?php echo '<a href="index.php?page=grille&projetId='.htmlentities($projet['id']).'"><i class="fas fa-list"></i></a>';?></td>
							<td class="middle"><?php echo '<a href="index.php?page=enseignant&op=add&projetId='.htmlentities($projet['id']).'"><i class="fas fa-plus"></i></a>';?></td>
							<td class="middle"><a href="#" data-toggle="modal" data-target="#myModalModifier<?php print htmlentities($projet['id'])?>"><i class="far fa-edit"></i></a></td>
						</tr>
						
						<!-- Modal -->
						<div class="modal fade" id="myModalModifier<?php print htmlentities($projet['id'])?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
						<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Modification du projet</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<form method="POST" action="">
								<input class="hidden" type="text" name="id" value="<?php print htmlentities($projet['id']); ?>"/>

								<div class="form-groupe">
									<label for="titre">Titre :</label>
									<input type="text" class="form-control" name="titre" id="titre" value="<?php print htmlentities($projet['titre']); ?>"/>
								</div>
								<div class="form-groupe">
									<label for="description">Description :</label>
									<input type="text" class="form-control" name="description" id="description" value="<?php print htmlentities($projet['description']); ?>"/>
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