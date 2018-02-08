<!DOCTYPE html>
<html>
<head>
	<title>
		<?php print htmlentities($title); ?>
	</title>
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
      <h4>S&eacute;l&eacute;ctionnez un projet :</h4>
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
    
	<div class="col-lg-12">
  <table class="table table-responsive">
    <thead>
	<h4>S&eacute;l&eacute;ctionnez un groupe d'&eacute;tudiant pour la notation :</h4>
      <tr>
        <th>Groupes</th>
        <th>Nom etudiants</th>
      </tr>
      
    </thead>
    <tbody>
      <?php 
        foreach ($groupes as $groupe): 
          print '<tr>';
          print '<td><a href=a>'.$groupe['nomGroupe'].'</td></a>';
          $json = json_decode($groupe['etudiant'], true);
          print '<td>';
          for ($i=0; $i < count($json); $i++) { 
            print $json[$i]['nom']. '; ';
          }
          print '</td>';
        endforeach;
      ?>
      </tr>   
    </tbody>
  </table>
</div>

<div>
  <form method="post" action="index.php?page=groupe" enctype="multipart/form-data">
    <input type="file" name="import"/>
    <input type="submit" name="submit" value="Charger" />
  </form>
  <?php 
    if(isset($_FILES['import']))
    {
      echo '+++++'.$_FILES['import']['name'];
      
      $content_dir = 'C:\\wamp64\\www\\tmp\\';
      $name_file = $_FILES['import']['name'];
      $tmp_file = $_FILES['import']['tmp_name'];
      if( !move_uploaded_file($tmp_file, $content_dir . $name_file) )
      {
        exit("Impossible de copier le fichier dans $content_dir");
      }
      echo "Le fichier a bien été uploadé";
      
      //$file = $_FILES['import']['name'];
      //echo $file;
      //$name_file = $_FILES['import']['name'];
 
      //if (file_exists($file)){
        $fp = fopen($content_dir.$name_file, "r");
        echo 'Fichier en lecture<br>';
      //}
      /*else { /* le fichier n'existe pas 
        echo "Fichier introuvable !<br>Importation stoppée.";
        exit();
      }*/
      
      $ligne = fgetcsv($fp);
      while (!feof($fp)){
        $ligne = fgetcsv($fp);
        
        //echo 'lecture des lignes<br>';
        //
        $num = count($ligne);

        for ($c=0; $c < $num; $c++) {
          list($nom,$prenom,$id) = explode(';', $ligne[$c]);
          echo $ligne[$c]. "<br />\n";
          echo 'nom:'.$nom.' prenom:'.$prenom.' id:'.$id. "<br />\n";
          echo "<br />\n";
        }
     
      }
    
    }
  ?>
</div>

	
	</div>
</body>

</html>