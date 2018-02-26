<!DOCTYPE html>
<html>
<head>
  <title>
    <?php print htmlentities($title); ?>
  </title>
</head>

<body>
  <div class="container">
    <?php 
      sec_session_start();
      if($check == true) {
        $enseignantId = isset($_SESSION['id'])? $_SESSION['id']:NULL;
    ?>


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

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <table class="table table-responsive table-bordered">
    <thead>
      <tr>
        <th>Groupes</th>
        <th>Nom etudiants</th>
        <th colspan="<?php print count($grilles);?>">Grilles</th>
        <th>Note groupe</th>
        <th>Details</th>
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

          $groupeId = $groupe['id'];
          $notesGrilles = $this->grilleService->getNotesByIdGroupe($groupeId);
          $i=0;
          $n=0;
          foreach($notesGrilles as $nG){
          	if(count($notesGrilles) > 0){
          		$n += $nG['note'];
          		$i++;
          	}
          }
          $noteGroupe = ($n == 0 || $i == 0) ? NULL : ($n / $i);

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
          print '<td><a href="http://notation/index.php?page=etudiant&op=note&idgroupe='.$groupe['id'].'">+</a></td>';
          print '</tr>';
        endforeach;
      ?>
    </tbody>
  </table>
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