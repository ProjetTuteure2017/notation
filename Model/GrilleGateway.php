<?php 

class GrilleGateway
{
	public function SelectAll($projetId)
	{
		include '../notation/connect.php';

		$stmt = $conn->prepare("SELECT * FROM grille WHERE projetId= :PROJETID");
		$stmt->execute(array("PROJETID"=>$projetId));
		$result = $stmt->fetchAll();

		return $result;
	}

	public function Ajouter($titre, $note, $coef, $projetId)
	{
		include '../notation/connect.php';

		$titre = isset($_POST['titre']) ? $_POST['titre'] : '';
		$note = isset($_POST['note']) ? $_POST['note'] : '';
		$coef = isset($_POST['coef']) ? $_POST['coef'] : '';
		$projetId = isset($_POST['projetId']) ? $_POST['projetId'] : '';

		$stmt = $conn->prepare("INSERT INTO grille (titre, note, coef, projetId) VALUES (:TITRE, :NOTE, :COEF, :PROJETID)");
		$stmt->execute(array("TITRE" =>$titre ,"NOTE" => $note,"COEF" =>$coef, "PROJETID"=>$projetId));

	}


	
	
}

?>