<?php
sec_session_start();
?> 
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
			if($check == true) {
				$enseignantId = isset($_SESSION['id'])? $_SESSION['id']:NULL;
		?>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<p class="font-weight-bold">La note du <?php  print $groupe['nomGroupe']; print ' est : '.$groupe['noteGroupe'];?></p>
			<table class="table table-responsive table-bordered">
		    	<thead class="color-primary-dark">
		      		<tr class="text-white">
		        		<th style="width: 20%">Noms des &eacute;tudiants</th>
		        		<th style="width: 20%">Pourcentage &eacute;tudiant</th>
		        		<th style="width: 20%">Note &eacute;tudiant</th>
		       			<th class="middle" style="width: 5%">Modifier</th>
		       			<th class="middle" style="width: 10%">Valider</th>
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
						print '<form method="POST" action="">';
						print '<td>';
						print '<input class="hidden" name="position" id="position" value="'.htmlentities($i).'">';
						print '<input class="hidden" name="nom" id="nom" value="'.htmlentities($json[$i]['nom']).'">';
						print '<input class="form-control" name="pourcentage" id="pourcentage'.$i.'" value="'.htmlentities($json[$i]['pourcentage']).'" disabled="disabled">';
						print '</td>';

						print '<td>';
						print '<input class="form-control" name="note" id="note'.$i.'" value="'.htmlentities($json[$i]['note']).'" disabled="disabled">';
						print '</td>';
						/*if($i==0)
						{
							print '<td rowspan="'.count($json).'">';
							print $groupe['noteGroupe'];
							print '</td>';
						}*/
						print '<td class="middle">';
						print '<button type="button" class="btn" id="btnModifier'.$i.'"><i class="far fa-edit"></i></button>';
						print '</td>';

						print '<td class="middle">';
						print '<input type="hidden" name="form-submitted" value="1" />';
						print '<input type="submit" class="btn btn-info" value="Valider" name="btnValider">';
						print '</td>';

						print '</form>';
						print '</tr>';
						?>
						<script>
								/*Calculer la note*/
								$('#note<?php echo $i ?>').val(<?php echo $groupe['noteGroupe'];?> * <?php echo count($json) ?> * $('#pourcentage<?php echo $i?>').val() / 100);
						</script>
						<script type="text/javascript">
								$('#btnModifier<?php echo $i?>').click(function(){
							        $('#note<?php echo $i?>').prop('disabled', !$("#note<?php echo $i?>").attr('disabled'));
							        $('#pourcentage<?php echo $i?>').prop('disabled', !$("#pourcentage<?php echo $i?>").attr('disabled'));
								});
							
						</script>
					<?php 
				}

				?>
				</tbody>
			</table>
		</div>
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