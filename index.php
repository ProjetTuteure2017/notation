<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php

	require_once 'Controller/ProjetController.php';

	$projetController = new ProjetController();
	$projetController->HandleRequest();
?>
</body>
</html>