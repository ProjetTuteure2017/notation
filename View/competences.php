<!DOCTYPE html>
<html>
<head>
	<title>
		<?php print htmlentities($title); ?>
	</title>
	<script src="../Public/js/myscripts.js"></script>	
	<script src="../Public/js/search.js"></script>
	<script src="../Public/js/etudiant.js"></script>
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
		<div class="col-sm-12 col-md-8 col-lg-8">	
		<input type="text" class="form-control" id="myInput" onkeyup="mySearch()" placeholder="Recherche...">
		
		<h4>S&eacute;l&eacute;ctionnez le projet pour afficher les grilles associ&eacute;es</h4>
		<form method="post" action="">
			<div class="input-group">
				<select class="custom-select" id="selectProjet" name="selectProjet">
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
    
		<div class="col-sm-4 col-md-4 col-lg-4">
			<?php 
				//$projetId = isset($_POST['selectProjet']) ? $_POST['selectProjet'] : NULL;
				print '<a href="index.php?page=competence&op=new&grilleId='.$grilleId.'">Ajouter competence</a>';
			?>
		</div>
			<div class="col-md-12">
				<table id="myTable" class="table table-striped table-responsive">
			
				<thead>
					<tr>
						<th scope="col">Id</th>
						<th scope="col">Theme</th>
						<th scope="col">Intitule</th>
						<th scope="col">NB Point</th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
					<?php 
						foreach ($competences as $competence) : ?>
					<tr>
						<td><?php print htmlentities($competence['id']); ?></td>
						<td><?php print htmlentities($competence['theme']); ?></td>
						<td><?php print htmlentities($competence['intitule']); ?></td>
						<td><?php print htmlentities($competence['nombrePoint']); ?></td>
						<td><button id="btnModifier" type="button" onClick="showHide('modifier<?php print htmlentities($competence['id'])?>')" class="btn btn-sm btn-info">Modifier</button></td>
					</tr>
					<tr id="modifier<?php print htmlentities($competence['id'])?>" class="closed">
						<td colspan="5">
							<div>
		                        <form method="POST" action="" style="display : inline;">
		                        	<input class="hidden" type="text" name="id" value="<?php print htmlentities($competence['id']); ?>"/>
		                            <label for="theme">Theme:</label>
		                            <input type="text" name="theme" value="<?php print htmlentities($competence['theme']); ?>"/>
									<label for="Intitule">Intitule:</label>
		                            <input type="text" name="intitule" value="<?php print htmlentities($competence['intitule']); ?>"/>
		                            <label for="nombrePoint">Nombre de Points:</label>
		                            <input type="text" name="nombrePoint" value="<?php print htmlentities($competence['nombrePoint']); ?>"/>
		                            <label for="grilleId">GrilleId:</label>
		                            <input type="text" name="grilleId" value="<?php print htmlentities($competence['grilleId']);?>"/>
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