<!DOCTYPE html>
<html>
<head>
	<title>
    	<?php print htmlentities($title) ?>
	</title>
</head>
<body>
		<?php 
			sec_session_start();
			if($check == true) {
				$enseignantId = isset($_SESSION['id'])? $_SESSION['id']:NULL;
		?>

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

</body>
</html>