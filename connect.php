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

	$stmt = $conn->prepare("SELECT g.nomGroupe, g.etudiant, g.noteGroupe, gr.titre, gr.note
		FROM groupe g 
		INNER join grille gr on g.projetId = gr.projetId 
		where g.projetId = :PROJETID 
		Order by g.nomGroupe");

		$stmt->execute(array("PROJETID"=>2));
		$result = $stmt->fetchAll();

	foreach ($result as $gr): 
		echo $gr['nomGroupe'];
		$json = json_decode($gr['etudiant'], true);
		for ($i=0; $i < count($json); $i++) { 
			echo $json[$i]['nom'];
		}
		echo $gr['titre'];
		echo nl2br("\n");
	endforeach;

		/** select g.noteGroupe, e.noteFinale, e.percentage, p.nom 
FROM etudiant e 
inner join personne p on e.personneId =p.id 
inner join groupe g on e.goupeId = g.id
inner join grille gr on g.projetId = gr.projetId*/

?>
