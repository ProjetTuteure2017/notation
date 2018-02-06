<?php 

class GroupeGateway
{


	public function SelectAll($projetId)
	{
		include '../notation/connect.php';

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
		include '../notation/connect.php';

		$stmt = $conn->prepare("SELECT DISTINCT(ng.note) FROM noteGrille ng
								INNER JOIN groupe gr on ng.groupeId = gr.id
								WHERE gr.id = :IDGROUPE
								AND ng.grilleId = :GRILLEID");
		$stmt->execute(array("IDGROUPE"=>$groupeId, "GRILLEID"=>$grilleId));
		$result = $stmt->fetch();

		return $result['note'];
	}

	public function SelectNoteEtudiant($idGroupe)
	{
		include '../notation/connect.php';

		$stmt = $conn->prepare("SELECT id, nomGroupe, etudiant, noteGroupe
								FROM groupe 
								WHERE id = :IDGROUPE");
		$stmt->execute(array("GROUPEID"=>$groupeId));
		$result = $stmt->fetchAll();

		return $result;
	}
	public function AjouterNoteEtudiant($idGroupe, $nomEtudiant)
	{
		include '../notation/connect.php';

		$stmt = $conn->prepare("UPDATE groupe SET etudiant= JSON_SET(etudiant, '$.note', ':NOTE', '$.pourcentage', ':POURCENTAGE')
								WHERE id = :IDGROUPE AND etudiant->'$.nom' = :NOM");
		$stmt->execute(array("GROUPEID"=>$groupeId, "NOM"=>$nomEtudiant));
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