<!DOCTYPE html>
<html>
<head>
	<title>
		<?php print htmlentities($title); ?>
	</title>
	<script src="..\Public\js\etudiant.js" type="text/javascript"></script>
	<script src="..\Public\js\verif_selection.js" type="text/javascript"></script>
</head>

<body>
	<div class="container">
    <?php 
      sec_session_start();
      if($check == true) {
        $enseignantId = isset($_SESSION['id'])? $_SESSION['id']:NULL;
    ?>

		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
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
            <button type="button submit" class="btn btn-outline-primary" >S&eacute;l&eacute;ctionner</button>
          </div>
        </div>
      </form>
      <script type="text/javascript">
        document.getElementById('selectProjet').value = "<?php echo $_POST['selectProjet'];?>";
      </script>
    </div>
    
    <div class="col-lg-12 col-md-12">
      <hr>
      <h4>S&eacute;l&eacute;ctionnez un groupe d'&eacute;tudiant pour la notation :</h4>
      <table class="table table-responsive table-hover">
        <thead class="indigo">
          <tr class="text-white">
            <th style="width : 30%">Groupes</th>
            <th style="width: 50%">Noms des &eacute;tudiants</th>
          </tr>
          
        </thead>
        <tbody>
          <?php 
            foreach ($groupes as $groupe): 
              print '<tr>';
              print '<td>'.$groupe['nomGroupe'].'</td></a>';
              $json = json_decode($groupe['etudiant'], true);
              print '<td>';
              for ($i=0; $i < count($json); $i++) { 
                print $json[$i]['nom']. '<br /> ';
              }
              print '</td>';
            endforeach;
          ?>
          </tr>   
        </tbody>
      </table>
  </div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <form method="post" action="index.php?page=etudiant" enctype="multipart/form-data" id="fileLoader">
	<input type="hidden" name="ProjID" value="<?php print (isset($_POST['selectProjet']) ? $_POST['selectProjet'] : "0");?>"/>
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
		  $fp = fopen($content_dir.$name_file, "r");
		  echo 'Fichier en lecture<br>';
		  
		  //$i=0;
		$ligne = fgetcsv($fp);
		$tabInsertion = array();
		while (!feof($fp)){
		$ligne = fgetcsv($fp);

			$ProjID = $_POST['ProjID'];
			
			$num = count($ligne);
			list($nom,$prenom,$idGroupe) = explode(';', $ligne[0]);
			$etudiant = "{\"nom\" : \"".$nom."\",\"prenom\" : \"".$prenom."\",\"pourcentage\" : \"\",\"note\" : \"\"}";
			
			
			$tempo = array('etudiant' => $etudiant, 'idGroupe' => $idGroupe, 'idProjet'=>$ProjID);
			$modif = false;
			$i = 0;
			foreach($tabInsertion as $tab){
				if($tab['idGroupe'] == $tempo['idGroupe'])
				{
					$tabInsertion[$i]['etudiant'] = $tab['etudiant'] . "," . $tempo['etudiant'];
					$modif = true;
				}
				$i++;
			}
			
			if(!$modif){
				$tabInsertion = array_merge($tabInsertion, array($tempo));
			}
			
		}
		echo var_dump($tabInsertion);
		foreach($tabInsertion as $res){
			$this->AddGroupe("[".$res['etudiant']."]", "Groupe ".$res["idGroupe"], $res['idProjet']);
		}
	}
  ?>
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