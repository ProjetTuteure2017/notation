<?php

	try {
		$conn = new PDO(
			"mysql:host=localhost;dbname=db_notation;charset=UTF8",
			"root",
			"");
	
	}
	catch(PDOException $e) {
		error_log($e->getMessage());
		die("A database error was encountered");
	}


?>