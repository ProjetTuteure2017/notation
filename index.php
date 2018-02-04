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
	<link href="Public/css/style-nav.css" rel="stylesheet">
	<script src="Public/js/jquery-3.2.1.min.js"></script>
    <script src="Public/js/bootstrap.min.js"></script>

<?php
	session_start();

	$page = isset($_GET['page']) ? $_GET['page'] : NULL;
	$op = isset($_GET['op']) ? $_GET['op'] : NULL;
	$idSession = isset($_SESSION['id']) ? $_SESSION['id'] : NULL;
	
	?>

<nav class="navbar navbar-expand-md  fixed-top navbar-light bg-faded">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <a class="navbar-brand" href="#">Notation</a>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
		        <li class="nav-item"><a class="nav-link" href="index.php">Accueil</a></li>
		    	<li class="nav-item"><a class="nav-link" href="index.php?page=projet">Projets</a></li>
		    	<li class="nav-item"><a class="nav-link" href="index.php?page=grille">Grilles</a></li>
		    	<li class="nav-item"><a class="nav-link" href="index.php?page=groupe">Groupes</a></li>
		    </ul>
		    <ul class="navbar-nav ml-auto">
				<?php 
					if(empty($_SESSION['nom']))
					{
						print '<li class="nav-item"><a class="nav-link" href="index.php?op=login">Se Connecter</a></li>';
					}
					else 
					{
						print '<li class="nav-item"><a class="nav-link" href="index.php?op=logout">Se D&eacuteconnecter</a></li>';

					}
				?>
			</ul>
		</div>
	</div>
</nav>
</div>
		
			
	<?php
	function __autoload($class_name) {
        require_once("Controller/".$class_name . '.php');
	}

	if(!isset($_GET['page'])){
		$pagesController = new PagesController();
		$pagesController->HandleRequest();
	}
	else {
		switch ($_GET['page']) {
			case 'responsable':
				$enseignantController = new EnseignantController();
				$enseignantController->HandleRequest();
				break;
			case 'enseignant':
				$enseignantController = new EnseignantController();
				$enseignantController->HandleRequest();
				break;
			case 'projet':
				$projetController = new ProjetController();
				$projetController->HandleRequest();
				break;

			case 'grille':
				$grilleController = new GrilleController();
				$grilleController->HandleRequest();
				break;
			case 'groupe':
				$groupeController = new GroupeController();
				$groupeController->HandleRequest();
				break;
		
			default:
				$pagesController = new PagesController();
				$pagesController->HandleRequest();
		}
	}

?>
</head>