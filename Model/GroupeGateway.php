<?php 

class GroupeGateway
{


	public function SelectAll($projetId)
	{
		include '../notation/Includes/connect.php';

		$stmt = $conn->prepare("SELECT id, nomGroupe, etudiant, noteGroupe
								FROM groupe 
								WHERE projetId = :PROJETID 
								ORDER BY nomGroupe");

		$stmt->execute(array("PROJETID"=>$projetId));
		$result = $stmt->fetchAll();

		return $result;
	}

	public function SelectNoteGrille($groupeId, $grilleId)
	{
		include '../notation/Includes/connect.php';

		$stmt = $conn->prepare("SELECT DISTINCT(ng.note) FROM noteGrille ng
								INNER JOIN groupe gr on ng.groupeId = gr.id
								WHERE gr.id = :IDGROUPE
								AND ng.grilleId = :GRILLEID");
		$stmt->execute(array("IDGROUPE"=>$groupeId, "GRILLEID"=>$grilleId));
		$result = $stmt->fetch();

		return $result['note'];
	}

	public function SelectNoteGroupe($idGroupe)
	{
		include '../notation/Includes/connect.php';

		$stmt = $conn->prepare("SELECT id, nomGroupe, etudiant, noteGroupe
								FROM groupe 
								WHERE id = :IDGROUPE");
		$stmt->execute(array("IDGROUPE"=>$idGroupe));
		$result = $stmt->fetch();

		return $result;
	}

	public function ModifierNoteEtudiant($idGroupe, $nomEtudiant, $note, $pourcentage)
	{
		include '../notation/Includes/connect.php';


		/*$stmt = $conn->prepare("UPDATE groupe SET etudiant = [:ETUDIANT] WHERE id = :IDGROUPE");

	//Donner la poistion de chaque etudiant dans le groupe $[1].note:
			//UPDATE groupe SET etudiant= JSON_SET(etudiant, '$.note', :NOTE, '$.pourcentage', :POURCENTAGE)
			//					WHERE id = :IDGROUPE AND etudiant->'$.nom' = :NOM");
		$etudiant = "{\"nom\" : \"".$nom."\",\"pourcentage\" : \"".$pourcentage."\",\"note\" : \"".$note."\"}";
		$stmt->execute(array("NOTE"=>$note, "POURCENTAGE"=>$pourcentage,"IDGROUPE"=>$idGroupe, "NOM"=>$nomEtudiant));*/
	}

	public function InsertGroupe($etudiant, $idGroupe, $idProjet){
		include '../notation/Includes/connect.php';
		
		$stmt = $conn->prepare("INSERT INTO groupe (nomGroupe, etudiant, noteGroupe, projetId) VALUES(:NOMGROUPE, :ETUDIANT, :NOTEGROUPE, :PROJETID)");
		
		//la variable $$etudaint , n'est pas declaré !! 
		$stmt->execute(array(":NOMGROUPE"=>$idGroupe, ":ETUDIANT"=> $etudiant, ":NOTEGROUPE"=>NULL, "PROJETID"=>$idProjet));
		$result = $stmt->fetchAll();

		return $result;
	}

}