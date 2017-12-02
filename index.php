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
</head>
<body>
<?php
	require_once 'Controller/ProjetController.php';

	$projetController = new ProjetController();
	$projetController->HandleRequest();
?>

</body>
</html>