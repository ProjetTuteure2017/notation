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
		<div class="col-sm-12 col-md-12 col-lg-12">
			<h4>S&eacute;l&eacute;ctionnez le projet pour afficher les gilles associ&acute;es</h4>
			<form method="post" action="">
			<select id="selectProjet" name="selectProjet">
				<option selected="selected">Veuillez selectioner un projet....</option>
				<?php 
					foreach ($projets as $projet) : 
						print '<option value="'.$projet['id'].'">';
						print htmlentities($projet['titre']);
					endforeach; 
				?>
			</select>
			<input type="submit" value="S&eacute;l&eacute;ctionner"/>
			</form>
		</div>
		<div class="col-sm-4 col-md-4 col-lg-4">
			<?php 
				//$projetId = isset($_POST['selectProjet']) ? $_POST['selectProjet'] : NULL;
				print '<a href="index.php?page=grille&op=new&projetId='.$projetId.'">Ajouter grille</a>';
			?>
		</div>
		<div class="col-sm-12 col-md-12 col-lg-12">	
			<table class="table table-striped">
				<thead>
					<tr>
						<th scope="col">Id</th>
						<th scope="col">Titre</th>
						<th scope="col">Note</th>
						<th scope="col">Coef</th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
					<?php 

						foreach ($grilles as $grille) : ?>
					<tr>
						<td><?php print htmlentities($grille['id']); ?></td>
						<td><?php print htmlentities($grille['titre']); ?></td>
						<td><?php print htmlentities($grille['note']); ?></td>
						<td><?php print htmlentities($grille['coef']); ?></td>
						<td><button id="btnModifier" type="button" onClick="showHide('modifier<?php print htmlentities($grille['id'])?>')" class="btn btn-sm btn-info">Modifier</button></td>
					</tr>
					<tr id="modifier<?php print htmlentities($grille['id'])?>" class="closed">
						<td colspan="5">
							<div>
		                        <form method="POST" action="" style="display : inline;">
		                        	<input class="hidden" type="text" name="id" value="<?php print htmlentities($grille['id']); ?>"/>
		                            <label for="titre">Titre:</label>
		                            <input type="text" name="titre" value="<?php print htmlentities($grille['titre']); ?>"/>
		                            <label for="note">Note:</label>
		                            <input type="text" name="note" value="<?php print htmlentities($grille['note']) ?>"/>
		                            <label for="coef">Coef:</label>
		                            <input type="text" name="coef" value="<?php print htmlentities($grille['coef']) ?>"/>
		                            <label for="coef">ProjetId:</label>
		                            <input type="text" name="projetId" value="<?php print htmlentities($grille['projetId']); ?>"/>
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