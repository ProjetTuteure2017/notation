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
		<div class="row">
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
    	</div>
    
		<div class="row">
			<div class="col-sm-4 col-md-4 col-lg-4">
				<?php 
					print '<a href="index.php?page=grille&op=new&projetId='.$projetId.'">Ajouter grille</a>';
				?>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
					<input type="text" class="form-control" id="myInput" onkeyup="mySearch()" placeholder="Recherche...">
			</div>
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">	
				<table class="table table-hover table-responsive sortable" id="myTable">
					<thead class="indigo">
						<tr class="text-white">
							<th scope="col" style="width: 50%">Titre</th>
							<th data-defaultsort="disabled" scope="col" style="width: 20%">Not&eacute; sur</th>
							<th data-defaultsort="disabled" scope="col" style="width: 20%">Coef</th>
							<th data-defaultsort="disabled" scope="col" style="width: 25%"></th>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach ($grilles as $grille) : ?>
						<tr>
							<td><?php print htmlentities($grille['titre']); ?></td>
							<td><?php print htmlentities($grille['note_sur']); ?></td>
							<td><?php print htmlentities($grille['coef']); ?></td>
							<td><button id="btnModifier" data-toggle="modal" data-target="#myModalModifier<?php print htmlentities($grille['id'])?>" type="button" class="btn btn-sm btn-info">Modifier</button></td>
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
	                            	<div class="row">
		                            	<input type="hidden" name="form-submitted" value="1" />
		                            	<input type="submit" value="Valider" id="btnValider" class="btn" />
		                            </div>
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
	</div>
</body>

</html>