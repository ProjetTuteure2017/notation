<!DOCTYPE html>
<html>
<head>
	<title>
		<?php print htmlentities($title); ?>
	</title>
	<link href="../Public/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="Public/css/bootstrap-sortable.css" rel="stylesheet" type="text/css">
	<script src="Public/js/bootstrap-sortable.js"></script>
	<script src="Public/js/mysearch.js"></script>	
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-lg-offset-2 col-md-offset-2 col-sm-12">
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
	            /*else {
        			$now = time();

			        if ($now > $_SESSION['expire']) {
			            session_destroy();
			            print '<div class="alert alert-dismissible alert-warning">';
	                	print '<button type="button" class="close" data-dismiss="alert">&times;</button>';
	                	print "<h4>Votre session est expir&eacute; !</h4>";
	                	print '<a href="index.php?op=login">Se connecter</a>';
	                	print '</div>';
			        }
			        else { */

						$enseignantId = isset($_SESSION['id'])? $_SESSION['id']:NULL;
	        ?>
	    	</div>
    	</div>
    	<div class="row">
			<div class="col-md-4 col-lg-4">
				<a href="index.php?page=projet&op=new">Ajouter projet</a>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
				<input type="text" class="form-control" id="myInput" onkeyup="mySearch()" placeholder="Recherche...">
			</div>
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
				<table id="myTable" class="table table-responsive table-hover sortable">
					<thead class="indigo">
						<tr class="text-white">
							<th scope="col" style="width: 25%">Titre</th>
							<th data-defaultsort="disabled" scope="col" style="width: 60%">Description</th>
							<th data-defaultsort="disabled" scope="col" style="width: 10%">Grilles</th>
							<th data-defaultsort="disabled" scope="col" style="width: 10%"></th>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach ($projets as $projet) : ?>
						<tr>
							<td><?php print htmlentities($projet['titre']); ?></td>
							<td><?php print htmlentities($projet['description']); ?></td>
							<td><?php echo '<a href="index.php?page=grille&projetId='.htmlentities($projet['id']).'">Liste</a>';?></td>
							<td><button id="btnModifier" data-toggle="modal" data-target="#myModalModifier<?php print htmlentities($projet['id'])?>" type="button" class="btn btn-sm btn-info">Modifier</button></td>
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
									<input type="submit" value="Valider" id="btnValider" class="btn" />
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

	<?php
      //  }
    //}
?>
</body>

</html>