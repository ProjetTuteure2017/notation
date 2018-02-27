<!DOCTYPE html>
<html>
<head>
	<title>
		<?php print htmlentities($title); ?>
	</title>
	<script src="../Public/js/myscripts.js"></script>	
	<script src="../Public/js/search.js"></script>
	<script src="../Public/js/etudiant.js"></script>
	<link href="Public/css/bootstrap-sortable.css" rel="stylesheet" type="text/css">
	<script src="Public/js/bootstrap-sortable.js"></script>
	<script src="Public/js/mysearch.js"></script>	
	<script src="Public/js/myscripts.js"></script>
		
</head>

<body>
	<div class="container">
		<div class="row">
		<?php 
			sec_session_start();
			if($check == true) {
				$enseignantId = isset($_SESSION['id'])? $_SESSION['id']:NULL;
		?>
		<div class="col-sm-12 col-md-8 col-lg-8">
			<h4>S&eacute;l&eacute;ctionnez le projet pour afficher les grilles associ&eacute;es</h4>
			<form method="post" action="">
				<div class="input-group">
					<select class="custom-select decorated" id="selectProjet" name="selectProjet">
						<option selected="selected">Veuillez selectioner un projet....</option>
						<?php 
						foreach ($projets as $projet) : 
						print '<option value="'.$projet['id'].'">';
						print htmlentities($projet['titre']);
						endforeach; 
						?>
					</select>
					<div class="input-group-append">
						<button type="button submit" class="btn btn-outline-primary">S&eacute;l&eacute;ctionner</button>
					</div>
				</div>
			</form>
			<script type="text/javascript">
			document.getElementById('selectProjet').value = "<?php echo $_POST['selectProjet'];?>";
			</script>
		</div>
    
			<div class="col-sm-12 col-md-8 col-lg-8">
		      <h4>S&eacute;l&eacute;ctionnez la grille pour afficher les competences associ&eacute;es</h4>
		      <form method="post" action="">
		        <div class="input-group">
		          <select class="custom-select" id="selectGrille" name="selectGrille">
		            <option selected="selected">Veuillez selectioner une grille....</option>
		            <?php 
		              foreach ($grilles as $grille) : 
		                print '<option value="'.$grille['id'].'">';
		                print htmlentities($grille['titre']);
		              endforeach; 
		            ?>
		          </select>
		          <div class="input-group-append">
		            <button type="button submit" class="btn btn-outline-primary">S&eacute;l&eacute;ctionner</button>
		          </div>
		        </div>
		      </form>
		      <script type="text/javascript">
		        document.getElementById('selectGrille').value = "<?php echo $_POST['selectGrille'];?>";
		      </script>
	    </div>
    
    </div>
    <div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<?php 
				//$projetId = isset($_POST['selectProjet']) ? $_POST['selectProjet'] : NULL;
				print '<a href="index.php?page=competence&op=new&grilleId='.$grilleId.'">Ajouter competence</a>';
			?>
		</div>
	</div>

	<hr>
	<div class="row">
		<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
			<input type="text" class="form-control" id="myInput" onkeyup="mySearch()" placeholder="Recherche...">
		</div>
		<div class="col-sm-12 col-md-12 col-lg-12">	
			<table id="myTable" class="table table-hover table-responsive sortable">
				<thead class="indigo">
					<tr class="text-white">
						<th scope="col" style="width: 25%">Th&egrave;me</th>
						<th data-defaultsort="disabled" scope="col" style="width: 50%">Intitule</th>
						<th data-defaultsort="disabled" scope="col" style="width: 20%">Nombre du point</th>
						<th data-defaultsort="disabled" scope="col" style="width: 20%"></th>
					</tr>
				</thead>
				<tbody>
					<?php 
						foreach ($competences as $competence) : ?>
					<tr>
						<td><?php print htmlentities($competence['theme']); ?></td>
						<td><?php print htmlentities($competence['intitule']); ?></td>
						<td><?php print htmlentities($competence['nombrePoint']); ?></td>
						<td><button id="btnModifier" data-toggle="modal" data-target="#myModalModifier<?php print htmlentities($competence['id'])?>" type="button" class="btn btn-sm btn-info">Modifier</button></td>
					</tr>

					<!-- Modal -->
					<div class="modal fade" id="myModalModifier<?php print htmlentities($competence['id'])?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Modification du projet</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<form method="POST" action="">
							<input class="hidden" type="text" name="id" value="<?php print htmlentities($competence['id']); ?>"/>

							<div class="form-groupe">
								<label for="theme">Theme :</label>
								<input type="text" class="form-control" name="theme" id="theme" value="<?php print htmlentities($competence['theme']); ?>"/>
							</div>
							<div class="form-groupe">
								<label for="intitule">Intitule :</label>
								<input type="text" class="form-control" name="intitule" id="intitule" value="<?php print htmlentities($competence['intitule']); ?>"/>
							</div>
							<div class="form-groupe">
								<label for="nombrePoint">Nombre de Points :</label>
								<input type="text" class="form-control" name="nombrePoint" id="nombrePoint" value="<?php print htmlentities($competence['nombrePoint']); ?>"/>
							</div>
							<div class="form-groupe">
								<input type="hidden" name="form-submitted" value="1" />
								<input type="submit" class="btn btn-info" value="Valider" id="btnValider" class="btn" />
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
					<!-- !!!! -->
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
</body>

</html>