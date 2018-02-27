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

	public function AjouterNoteEtudiant($idGroupe, $nomEtudiant)
	{
		include '../notation/Includes/connect.php';

		$stmt = $conn->prepare("UPDATE groupe SET etudiant= JSON_SET(etudiant, '$.note', ':NOTE', '$.pourcentage', ':POURCENTAGE')
								WHERE id = :IDGROUPE AND etudiant->'$.nom' = :NOM");
		$stmt->execute(array("GROUPEID"=>$groupeId, "NOM"=>$nomEtudiant));
	}
	
	public function InsertGroupe($nom, $prenom, $idGroupe, $note, $pourcentage, $idProjet){
		include '../notation/Includes/connect.php';
		
		$stmt = $conn->prepare("INSERT INTO groupe (nomGroupe, etudiant, noteGroupe, projetId) VALUES(:NOMGROUPE, :ETUDIANT, :NOTEGROUPE, :PROJETID)");
		$format = "{\"nom\" : \"".$nom."\",\"prenom\" : \"".$prenom."\",\"pourcentage\" : \"".$pourcentage."\",\"note\" : \"".$note."\"}";
		$stmt->execute(array(":NOMGROUPE"=>$idGroupe, ":ETUDIANT"=> $format, ":NOTEGROUPE"=>0, "PROJETID"=>$idProjet));
		$result = $stmt->fetchAll();

		return $result;
	}

	public function ModifierGroupe($idGroupe, $pourcentage, $note)
	{
		include '../notation/Includes/connect.php';
		
	}
	
	/** select g.noteGroupe, e.noteFinale, e.percentage, p.nom 
FROM etudiant e 
inner join personne p on e.personneId =p.id 
inner join groupe g on e.goupeId = g.id
inner join grille gr on g.projetId = gr.projetId*/
/*
UPDATE `groupe` SET `etudiant` = '[{"nom": "Fastani", "note": "15", "pourcentage": "50"},{"nom": "Chandler", "note": "15", "pourcentage": "50"}]', `noteGroupe` = '14' WHERE `groupe`.`id` = 1
SELECT etudiant->"$[*].nom" FROM groupe
*/


/*
	$stmt = $conn->prepare("SELECT id, nomGroupe, etudiant, noteGroupe FROM groupe");
		
	$stmt->execute();
	$result = $stmt->fetchAll();
	foreach ($result as $gr): 
		echo $gr['nomGroupe'];
		$json = json_decode($gr['etudiant'], true);
		for ($i=0; $i < count($json); $i++) { 
			echo $json[$i]['nom'];
		}
		echo nl2br("\n");
	endforeach;
*/
}