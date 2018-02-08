<!DOCTYPE html>
<html>
<head>
  <title>
    <?php print htmlentities($title); ?>
  </title>
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
      <div class="col-sm-12 col-md-8 col-lg-8">
      <h4>S&eacute;l&eacute;ctionnez le projet pour afficher les gilles associ&eacute;es</h4>
      <form method="post" action="">
        <div class="input-group">
          <select class="custom-select" id="selectProjet" name="selectProjet">
            <option value="-1" selected="selected">Veuillez selectioner un projet....</option>
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
        document.getElementById('selectProjet').value = "<?php echo isset($_POST['selectProjet']) ? $_POST['selectProjet'] : "-1";?>";
      </script>
    </div>

<div class="col-md-12">
  <table class="table table-responsive table-bordered">
    <thead>
      <tr>
        <th>Groupes</th>
        <th>Nom etudiants</th>
        <th colspan="<?php print count($grilles);?>">Grilles</th>
        <th>Note groupe</th>
      </tr>
      <tr>
        <th></th>
      	<th></th>
        <?php 
          foreach($grilles as $grille) :
            print '<th>'.$grille['titre'].'</th>';
          endforeach;

        ?>
      	<th></th>

      </tr>
    </thead>
    <tbody>
      <?php 
        foreach ($groupes as $groupe): 
          print '<tr>';
          print '<td>'.$groupe['nomGroupe'].'</td>';
          $json = json_decode($groupe['etudiant'], true);
          print '<td>';
          for ($i=0; $i < count($json); $i++) { 
            print $json[$i]['nom'].'<br/>';
          }
          print '</td>';

          for ($i=0; $i < count($grilles); $i++) { 
            $noteGrille = $this->groupeService->getNoteGrille(htmlentities($groupe['id']), $grilles[$i]['id']);
            if($noteGrille>10)
            {
              print '<td class="bg-success">'.$noteGrille.'</td>';
            }
            else if ($noteGrille < 10 && isset($noteGrille))
            {
              print '<td class="bg-warning">'.$noteGrille.'</td>';
            }
            else if(!isset($noteGrille))
            {
              print '<td class="bg-danger">'.$noteGrille.'</td>';
            }
            
          }

          $noteGroupe = $groupe['noteGroupe'];
          if($noteGroupe>10)
            {
              print '<td class="bg-success">'.$noteGroupe.'</td>';
            }
            else if ($noteGroupe < 10 && isset($noteGroupe))
            {
              print '<td class="bg-warning">'.$noteGroupe.'</td>';
            }
            else if(!isset($noteGroupe))
            {
              print '<td class="bg-danger">'.$noteGroupe.'</td>';
            }
          print '</tr>';
        endforeach;
      ?>
    </tbody>
  </table>
</div>
</body>
</html>