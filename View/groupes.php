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

<div class="col-lg-12">
<!--Col span : retourne count of Grille, 2 titre for projetId : 2-->
<?php foreach($groupes as $groupe) : 
        print($groupe['titre']);
      endforeach;
?>
  <table class="table">
    <thead>
      <tr>
        <th>Groupes</th>
        <th colspan="2">Grilles</th>
        <th>Note groupe</th>
      </tr>
      <tr>
      	<th></th>
		    <th>Demo</th>
      	<th>Presentation</th>      	

      	<th></th>

      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Groupe 1</td>
        <td>14</td>
        <td>15</td>
        <td>16</td>
      </tr>   
    </tbody>
  </table>
</div>

</body>
</html>