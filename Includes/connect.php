<?php
	
	include_once 'psl-config.php';

	try {
		$conn = new PDO(
			"mysql:host=".HOST.";dbname=".DATABASE.";charset=UTF8",
			USER,
			PASSWORD);
	
	}
	catch(PDOException $e) {
		error_log($e->getMessage());
		die("A database error was encountered");
	}
?>
