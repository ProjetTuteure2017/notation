<!DOCTYPE html>
<html>
<head>
	<title>
		<?php print htmlentities($title); ?>
	</title>
	<script src="Public/js/myscripts.js"></script>	
</head>

<body>
	<div class="container">
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

			$enseignantId = isset($_SESSION['id'])? $_SESSION['id']:NULL;
        ?>
    	</div>
		<div class="col-md-4 col-lg-4">
			<a href="index.php?page=projet&op=new">Ajouter projet</a>
		</div>
		<div class="col-md-12">

			<table class="table table-striped">
				<thead>
					<tr>
						<th scope="col">Titre</th>
						<th scope="col">Description</th>
						<th scope="col">Enseignant</th>
						<th scope="col">Grille</th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
					<?php 
						foreach ($projets as $projet) : ?>
					<tr>
						<td><?php print htmlentities($projet['titre']); ?></td>
						<td><?php print htmlentities($projet['description']); ?></td>
						<td><?php print htmlentities($projet['enseignantId']); ?></td>
						<td><?php echo '<a href="index.php?page=grille&op=new&projetId='.htmlentities($projet['id']).'">Ajouter grille</a>';?></td>
						<td><button id="btnModifier" onClick="showHide('modifier<?php print htmlentities($projet['id'])?>')" type="button" class="btn btn-sm btn-info">Modifier</button></td>
					</tr>
					<tr id="modifier<?php print htmlentities($projet['id'])?>" class="closed">
						<td colspan="4">
							<div>
		                        <form method="POST" action="" style="display : inline;">
		                        	<input class="hidden" type="text" name="id" value="<?php print htmlentities($projet['id']); ?>"/>
		                            <label for="titre">Titre:</label>
		                            <input type="text" name="titre" value="<?php print htmlentities($projet['titre']); ?>"/>
		                            <label for="description">Description:</label>
		                            <input type="text" name="description" value="<?php print htmlentities($projet['description']) ?>"/>
		                            <input type="hidden" name="form-submitted" value="1" />
		                            <input type="submit" value="Valider" />
		                        </form>
							</div>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</body>

</html>