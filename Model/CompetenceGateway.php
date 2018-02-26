<?php 

class CompetenceGateway
{
	public function SelectAll($grilleId)
	{
		include '../notation/Includes/connect.php';

		$stmt = $conn->prepare("SELECT * FROM competence WHERE grilleId= :GrilleID");
		$stmt->execute(array("GrilleID"=>$grilleId));
		$result = $stmt->fetchAll();

		return $result;
	}

	public function Ajouter($theme, $intitule, $nombrePoint, $grilleId)
	{
		include '../notation/Includes/connect.php';

		$theme = isset($_POST['theme']) ? $_POST['theme'] : '';
		$intitule = isset($_POST['intitule']) ? $_POST['intitule'] : '';
		$nombrePoint = isset($_POST['nombrePoint']) ? $_POST['nombrePoint'] : '';
		$grilleId = isset($_POST['grilleId']) ? $_POST['grilleId'] : '';

		$stmt = $conn->prepare("INSERT INTO competence (theme, intitule, nombrePoint, grilleId) VALUES (:THEME, :INTITULE, :NOMBREPOINT, :GRILLEID)");
		$stmt->execute(array("THEME" =>$theme , "INTITULE"=>$intitule ,"NOMBREPOINT" => $nombrePoint, "GRILLEID"=>$grilleId));

	}
	
	public function Modifier($id, $theme, $intitule, $nombrePoint, $grilleId)
	{
		include '../notation/Includes/connect.php';

		$id = isset($_POST['id']) ? $_POST['id'] : '';
		$theme = isset($_POST['theme']) ? $_POST['theme'] : '';
		$intitule = isset($_POST['intitule']) ? $_POST['intitule'] : '';
		$nombrePoint = isset($_POST['nombrePoint']) ? $_POST['nombrePoint'] : '';
		$grilleId = isset($_POST['grilleId']) ? $_POST['grilleId'] : '';

		$stmt = $conn->prepare("UPDATE competence SET theme = :THEME, intitule = :INTITULE, nombrePoint = :NOMBREPOINT, grilleId = :GRILLEID WHERE id = :ID");
		$stmt->execute(array("THEME" =>$theme , "INTITULE"=>$intitule ,"NOMBREPOINT" => $nombrePoint, "GRILLEID"=>$grilleId, "ID" => $id));

	}
	
	public function AjouterNoteCompetence($note, $competence, $groupeId, $appreciation){
		include '../notation/Includes/connect.php';
		
		$stmt = $conn->prepare("INSERT INTO notecompetence (note, questionId, groupeId, appreciation) VALUES(:NOTE, :COMPETENCE, :GROUPEID, :APPRECIATION)");
		
		$stmt->execute(array(":NOTE"=>$note, ":COMPETENCE"=>$competence, ":GROUPEID"=>$groupeId, ":APPRECIATION"=>$appreciation));
		$result = $stmt->fetchAll();

		return $result;
		
	}
	
	public function ModifierNoteCompetence($note, $a, $groupeId, $appreciation){
		//TODO
		include '../notation/Includes/connect.php';

		//Update notecompetence set note = $note, appr = $appreciation where groupeid = $groupeid and questionid= $competence
		$stmt = $conn->prepare("UPDATE notecompetence SET note = :NOTE, appreciation = :APPRECIATION WHERE groupeId = :GROUPEID and questionId = :b");
		
		$stmt->execute(array("NOTE" =>$note , "b"=>$a ,"GROUPEID" => $groupeId, "APPRECIATION"=>$appreciation));
	}
	
	public function SelectNoteCompetence($groupeId){
		include '../notation/Includes/connect.php';

		$stmt = $conn->prepare("SELECT * FROM notecompetence WHERE groupeId= :GROUPEID");
		$stmt->execute(array("GROUPEID"=>$groupeId));
		$result = $stmt->fetchAll();

		return $result;
	}
	
	public function SelectNoteByCompetence($competenceId ,$groupeId){
		include '../notation/Includes/connect.php';

		$stmt = $conn->prepare("SELECT * FROM notecompetence WHERE questionId = :COMPETENCE and groupeId= :GROUPEID");
		$stmt->execute(array("GROUPEID"=>$groupeId, "COMPETENCE"=>$competenceId));
		$result = $stmt->fetchAll();

		return $result;
	}
}

?>