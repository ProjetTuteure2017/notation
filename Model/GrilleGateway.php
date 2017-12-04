<?php 

class GrilleGateway
{
	public function Ajouter($titre, $note, $coef)
	{
		include '../notation/connect.php';

		$titre = isset($_POST['titre']) ? $_POST['titre'] : '';
		$note = isset($_POST['note']) ? $_POST['note'] : '';
		$coef = isset($_POST['coef']) ? $_POST['coef'] : '';

		$stmt = $conn->prepare("INSERT INTO grille (titre, note, coef) VALUES (:TITRE, :NOTE, :COEF)");
		$stmt->execute(array("TITRE" =>$titre ,"NOTE" => $note,"COEF" =>$coef));

	}
	
	
}

?>