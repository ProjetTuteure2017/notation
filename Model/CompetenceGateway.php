<?php 

class CompetenceGateway
{
	public function SelectAll($grilleId)
	{
		include '../notation/connect.php';

		$stmt = $conn->prepare("SELECT * FROM competence WHERE grilleId= :GrilleID");
		$stmt->execute(array("GrilleID"=>$grilleId));
		$result = $stmt->fetchAll();

		return $result;
	}

	public function Ajouter($theme, $intitule, $nombrePoint, $grilleId)
	{
		include '../notation/connect.php';

		$theme = isset($_POST['theme']) ? $_POST['theme'] : '';
		$intitule = isset($_POST['intitule']) ? $_POST['intitule'] : '';
		$nombrePoint = isset($_POST['nombrePoint']) ? $_POST['nombrePoint'] : '';
		$grilleId = isset($_POST['grilleId']) ? $_POST['grilleId'] : '';

		$stmt = $conn->prepare("INSERT INTO competence (theme, intitule, nombrePoint, grilleId) VALUES (:THEME, :INTITULE, :NOMBREPOINT, :GRILLEID)");
		$stmt->execute(array("THEME" =>$theme , "INTITULE"=>$intitule ,"NOMBREPOINT" => $nombrePoint, "GRILLEID"=>$grilleId));

	}
	
	public function Modifier($id, $theme, $intitule, $nombrePoint, $grilleId)
	{
		include '../notation/connect.php';

		$id = isset($_POST['id']) ? $_POST['id'] : '';
		$theme = isset($_POST['theme']) ? $_POST['theme'] : '';
		$intitule = isset($_POST['intitule']) ? $_POST['intitule'] : '';
		$nombrePoint = isset($_POST['nombrePoint']) ? $_POST['nombrePoint'] : '';
		$grilleId = isset($_POST['grilleId']) ? $_POST['grilleId'] : '';

		$stmt = $conn->prepare("UPDATE competence SET theme = :THEME, intitule = :INTITULE, nombrePoint = :NOMBREPOINT, grilleId = :GRILLEID WHERE id = :ID");
		$stmt->execute(array("THEME" =>$theme , "INTITULE"=>$intitule ,"NOMBREPOINT" => $nombrePoint, "GRILLEID"=>$grilleId, "ID" => $id));

	}
	
}

?>