<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<link href="Public/css/bootstrap.min.css" rel="stylesheet">
	<link href="Public/css/style.css" rel="stylesheet">
	<script src="Public/js/jquery-3.2.1.min.js"></script>
    <script src="Public/js/bootstrap.min.js"></script>


<?php
	
	function __autoload($class_name) {
        require_once("Controller/".$class_name . '.php');
	}

	$page = isset($_GET['page']) ? $_GET['page'] : NULL;

	if(!isset($_GET['page'])){
?>

<?php

	}
	else {
		switch ($_GET['page']) {
			case 'projet':
				$projetController = new ProjetController();
				$projetController->HandleRequest();
				break;

			case 'grille':
				$grilleController = new GrilleController();
				$grilleController->HandleRequest();
				break;
		
			default:
				break;
		}
	}

?>

	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="#">Navbar</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarColor03">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="index.php?page=projet">Projets</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="index.php?page=grille">Grilles</a>
				</li>
			</ul>
		</div>
	</nav>
</head>