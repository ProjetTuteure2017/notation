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

</head>
<body>
<?php
	
	function __autoload($class_name) {
        require_once("Controller/".$class_name . '.php');
	}

	$page = isset($_GET['page']) ? $_GET['page'] : NULL;

	if(!isset($_GET['page'])){
?>
<h2>Bienvenue</h2>

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

</body>
</html>