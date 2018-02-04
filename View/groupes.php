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

<div class="col-lg-12">
  <table class="table">
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
            print '<th>'.$grille['titre'].$grille['id'].'</th>';
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
            print $json[$i]['nom']. '; ';
          }
          print '</td>';

          for ($i=0; $i < count($grilles); $i++) { 
            print '<td>';
            print $this->groupeService->getNoteGrille(htmlentities($groupe['id']), $grilles[$i]['id']); 
            print '</td>';
            
          }
          print '<td>'.$groupe['noteGroupe'].'</td>';
          print '</tr>';
        endforeach;
      ?>
      </tr>   
    </tbody>
  </table>
</div>

</body>
</html>