<!DOCTYPE html>
<html>
<head>
	<title>
		<?php print htmlentities($title); ?>
	</title>
</head>

<body onLoad="Chargement();">
	<div class="container">
    <?php 
      sec_session_start();
      if($check == true) {
        $enseignantId = isset($_SESSION['id'])? $_SESSION['id']:NULL;
        
    ?>
		<div class="col-sm-12 col-md-8 col-lg-8">
      <h4>S&eacute;l&eacute;ctionnez un projet :</h4>
      <form method="get" action="">
		<input type="hidden" name="page" value="noteCompetence">
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
        document.getElementById('selectProjet').value = "<?php echo $_GET['selectProjet'];?>";
      </script>
    </div>

   <div class="col-sm-12 col-md-8 col-lg-8">
      <h4>S&eacute;l&eacute;ctionnez la grille pour afficher les competences associ&eacute;es</h4>
      <form method="post" action="">
	  <script type="text/javascript">
	  function Chargement() { 
		var e = document.getElementById("selectGrille");
		var strUser="";
		if(e != null){
			e.addEventListener("click",function(){
				var $a = $(".lien-noteGroupe");
				$a.each( function(index, value) {
				  this.href = this.href.replace(/&grilleId=([0-9]*)/, "&grilleId=" + e.options[e.selectedIndex].value);
				});
			});
		}
	  }
	  
	  function Verif_Selection(){
		  var options = document.getElementById("selectGrille").options;;
		  for(var i=0; i< options.length;i++){
			  if(options[i].selected){
				return true;
			  }
		  }
		  alert("Veuillez selectionner une grille");
		  return false;
	  }
	 </script>
	 <?php 
		$grilleSelectionnee = '<script type="text/javascript">document.write(valeur); </script>';
	?>
        <div class="input-group">
		
          <select class="custom-select" size="auto" multiple="no" id="selectGrille" name="selectGrille">
            <?php 
              foreach ($grilles as $grille) : 
                print '<option value="'.$grille['id'].'">';
                print htmlentities($grille['titre']);
              endforeach; 
            ?>
          </select>
        </div>
      </form>
      
	
    </div>
	
	<div class="col-lg-12 col-md-12 col-sm-12">
	 <h4>S&eacute;l&eacute;ctionnez un groupe d'&eacute;tudiant pour la notation :</h4>
    <table class="table table-responsive table-hover">
      <thead class="indigo">
        <tr class="text-white">
          <th style="width : 30%">Groupes</th>
          <th style="width : 50%">Noms des &eacute;tudiants</th>
        </tr>
        
      </thead>
      <tbody>
        <?php 
          foreach ($groupes as $groupe): 
            print '<tr>';
            print '<td><a onClick="return Verif_Selection();" class="lien-noteGroupe" href="index.php?page=noteGroupe&op=list&projetId='.(isset($_GET['selectProjet']) ? $_GET['selectProjet'] : NULL).'&groupeId='.$groupe['id'].'&grilleId=">'.$groupe['nomGroupe'].'</td></a>';
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