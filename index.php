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
	session_start();

	$page = isset($_GET['page']) ? $_GET['page'] : NULL;
	$op = isset($_GET['op']) ? $_GET['op'] : NULL;
	$idSession = isset($_SESSION['id']) ? $_SESSION['id'] : NULL;
	
	?>
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

		  	<a class="navbar-brand" href="index.php"><img style="width:50px; margin-top: -15px; height: 50px;" src="Public/img/Logo.png"></a>
		</div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		    <ul class="nav navbar-nav">
		        <li><a href="index.php">Accueil</a></li>
		    	<li><a href="index.php?page=projet">Projets</a></li>
		    	<li><a href="index.php?page=grille">Grilles</a></li>
		    </ul>
		    <ul class="nav navbar-nav navbar-right">
				<?php 
					if(empty($_SESSION['nom']))
					{
						print '<li><a class="nav-link" href="index.php?op=login">Se Connecter</a></li>';
					}
					else 
					{
						print '<li><a class="nav-link" href="index.php?op=logout">Se D&eacuteconnecter</a></li>';

					}
				?>
			</ul>
		</div>
	</div>
</nav>
		
			
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
		
			default:
				$pagesController = new PagesController();
				$pagesController->HandleRequest();
		}
	}

?>

<script>
      var $nav = $('.navbar');
      
      $(document).scroll(function() {
        if($(this).scrollTop() > 100){
          $nav.css({
            'margin-top':'0px'
          });
         
        }else{
          $nav.css({
            'margin-top' :'75px'
          });
        }
      });
      var $logo = $('.navbar-brand');
        $(document).scroll(function() {
            $logo.css({display: $(this).scrollTop() > 100? "block":"none"});
        });
</script>
</head>