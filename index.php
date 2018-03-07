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
	<link href="Public/font-awesome/css/fontawesome-all.min.css" rel="stylesheet">
	<script src="Public/js/jquery-3.2.1.min.js"></script>
    <script src="Public/js/bootstrap.min.js"></script>

<?php
	require_once 'Includes/functions.php';

	sec_session_start();

	$page = isset($_GET['page']) ? $_GET['page'] : NULL;
	$op = isset($_GET['op']) ? $_GET['op'] : NULL;
	$idSession = isset($_SESSION['id']) ? $_SESSION['id'] : NULL;
	
	?>

<nav class="navbar navbar-expand-md  fixed-top navbar-light bg-faded">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <a class="navbar-brand" href="index.php">Notation</a>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
    	<?php
    	//id du responsable
    		//if($idSession == 2)
    		//{

    			?>
        <li class="dropdown">
        	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Partie configuration</a>
        	<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
    			<a class="dropdown-item" href="index.php?page=etudiant">Ajouter groupes</a>
    			<a class="dropdown-item" href="index.php?page=projet">Projets</a>
    		</div>
    	</li>
    	<?php 
    	//} 
    	?>
    	<li class="dropdown">
        	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Partie utilisation</a>
        	<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				<a class="dropdown-item" href="index.php?page=noteCompetence">Notes de comp&eacute;tences</a>
		    	<a class="dropdown-item" href="index.php?page=groupe">Notes de groupes</a>
    		</div>
    	</li>
    	
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
			case 'etudiant':
				$etudiantController = new EtudiantController();
				$etudiantController->HandleRequest();
				break;
			case 'noteCompetence':
				$notationCompetenceController = new NotationCompetenceController();
				$notationCompetenceController->HandleRequest();
				break;
			case 'noteGroupe':
				$notationGroupeCompetenceController = new NotationGroupeCompetenceController();
				$notationGroupeCompetenceController->HandleRequest();
				break;
			case 'competence':
				$competenceController = new CompetenceController();
				$competenceController->HandleRequest();
				break;
		
			default:
				$pagesController = new PagesController();
				$pagesController->HandleRequest();
		}
	}

?>
</head>