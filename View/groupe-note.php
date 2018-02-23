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

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<table class="table table-responsive table-bordered">
		    	<thead>
		      		<tr>
		        		<th>Noms des &eacute;tudiants</th>
		        		<th>Pourcentage &eacute;tudiant</th>
		        		<th>Note &eacute;tudiant</th>
		       			<th>Note groupe</th>
		       		</tr>
				</thead>
				<tbody>
				<?php 
  					$json = json_decode($groupe['etudiant'], true);
					for ($i=0; $i < count($json); $i++) { 
						print '<tr>';

						print '<td>';
						print $json[$i]['nom'];
						print '</td>';

						print '<td>';
						print $json[$i]['pourcentage'];
						print '</td>';

						print '<td>';
						print $json[$i]['note'];
						print '</td>';
						if($i==0)
						{
							print '<td rowspan="'.count($json).'">';
							print $groupe['noteGroupe'];
							print '</td>';
						}

						print '</tr>';
					}

				?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>