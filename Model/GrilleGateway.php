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
	
	
		public function SelectByGrilleId($grilleId)
	{
		include '../notation/connect.php';

		$stmt = $conn->prepare("SELECT * FROM grille WHERE id= :GRILLEID");
		$stmt->execute(array("GRILLEID"=>$grilleId));
		$result = $stmt->fetchAll();

		return $result;
	}


	public function Ajouter($titre, $note_sur, $coef, $projetId)
	{
		include '../notation/connect.php';

		$titre = isset($_POST['titre']) ? $_POST['titre'] : '';
		$note_sur = isset($_POST['note_sur']) ? $_POST['note_sur'] : '';
		$coef = isset($_POST['coef']) ? $_POST['coef'] : '';
		$projetId = isset($_GET['projetId']) ? $_GET['projetId'] : '';

		$stmt = $conn->prepare("INSERT INTO grille (titre, note_sur, coef, projetId) VALUES (:TITRE, :NOTESUR, :COEF, :PROJETID)");
		$stmt->execute(array("TITRE" =>$titre ,"NOTESUR" => $note_sur,"COEF" =>$coef, "PROJETID"=>$projetId));

	}

	public function Modifier($id, $titre, $note_sur, $coef, $projetId)
	{
		include '../notation/connect.php';

		$id = isset($_POST['id']) ? $_POST['id'] : '';
		$titre = isset($_POST['titre']) ? $_POST['titre'] : '';
		$note_sur = isset($_POST['note_sur']) ? $_POST['note_sur'] : '';
		$coef = isset($_POST['coef']) ? $_POST['coef'] : '';
		$projetId = isset($_POST['projetId']) ? $_POST['projetId'] : '';

		$stmt = $conn->prepare("UPDATE grille SET titre=:TITRE, note_sur=:NOTESUR, coef=:COEF, projetId=:PROJETID WHERE id=:ID");
		$stmt->execute(array("TITRE"=>$titre, "NOTESUR"=>$note_sur, "COEF"=>$coef, "PROJETID"=>$projetId, "ID"=>$id));

	}

	public function AjouterNoteGrille($groupeId, $grilleId, $note, $appreciation){
		include '../notation/connect.php';
		
		$stmt = $conn->prepare("INSERT INTO notegrille (groupeId, grilleId, note, appreciation) VALUES(:GROUPEID, :GRILLEID, :NOTE, :APPRECIATION)");
		
		$stmt->execute(array(":GROUPEID"=>$groupeId, ":GRILLEID"=> $grilleId, ":NOTE"=>$note, ":APPRECIATION"=>$appreciation));
		$result = $stmt->fetchAll();

		return $result;
		
	}
	
	public function ModifierNoteGrille($note, $grilleId, $groupeId, $appreciation){
		include '../notation/connect.php';

		//Update notecompetence set note = $note, appr = $appreciation where groupeid = $groupeid and questionid= $competence
		$stmt = $conn->prepare("UPDATE notegrille SET note = :NOTE, appreciation = :APPRECIATION WHERE groupeId = :GROUPEID and grilleId = :GRILLEID");
		
		$stmt->execute(array("NOTE" =>$note , "GRILLEID"=>$grilleId ,"GROUPEID" => $groupeId, "APPRECIATION"=>$appreciation));
	}
	
	public function SelectNoteGrilleByGroupe($grilleId, $groupeId){
		include '../notation/connect.php';

		$stmt = $conn->prepare("SELECT * FROM notegrille WHERE grilleId= :GRILLEID and groupeId = :GROUPEID");
		$stmt->execute(array("GRILLEID"=>$grilleId, "GROUPEID"=>$groupeId));
		$result = $stmt->fetchAll();

		return $result;
	}
	
	public function SelectNotesGrillesByGroupeId($groupeId){
		include '../notation/connect.php';

		$stmt = $conn->prepare("SELECT * FROM notegrille WHERE groupeId = :GROUPEID");
		$stmt->execute(array("GROUPEID"=>$groupeId));
		$result = $stmt->fetchAll();

		return $result;
	}
	
}

?>