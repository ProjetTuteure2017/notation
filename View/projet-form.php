<!DOCTYPE html>
<html>
<head>
	<title>
		<?php print htmlentities($title); ?>
	</title>

</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-md-offset-3 col-md-6 col-xs-12">
				<div class="panel panel-compte">

					<div class="panel-heading">
						<h5>Ajouter Projet</h5>
						<hr>
					</div>

					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12 col-sm-12">
								
								<form role="form" method="POST" action="">
									<div class="form-group">
										<input type="text" class="form-control" name="titre" value="<?php print htmlentities($titre); ?>" placeholder="Description du projet">
									</div>
									<div class="form-group">
										<input type="text" class="form-control" name="description" value="<?php print htmlentities($description); ?>" placeholder="Description du projet">
									</div>
									<div class="form-group">
										<input type="text" class="form-control" name="enseignantId" value="<?php print htmlentities($enseignantId); ?>" placeholder="Enseignant Id">
									</div>									
									<div class="form-group">
										<div class="row">
											<div class="col-md-offset-3 col-md-6 col-sm-12">
												<input type="hidden" name="form-submitted" value="1" />
												<input type="submit" value="Enregistrer" tabindex="4" class="form-control btn btn-authen"/>
											</div>
										</div>
									</div>
								</form>

							</div>
						</div>
					</div>

				</div>

			</div> 
		</div>
	</div>            

</body>

</html>