<?php

require_once 'Model/GroupeGateway.php';
require_once 'Model/ValidationException.php';
require_once '../notation/Includes/connect.php';

class GroupeService 
{

	private $groupeGateway = NULL;

	function __construct()
	{
		$this->groupeGateway = new GroupeGateway();	
	}

	public function getAllGroupes($projetId)
	{
		try {
			$res = $this->groupeGateway->SelectAll($projetId);
			return $res;
		} catch (Exception $e) {
			throw $e;
		}
		return;
	}

	public function getNoteGrille($groupeId, $grilleId)
	{
		try {
			$res = $this->groupeGateway->SelectNoteGrille($groupeId, $grilleId);
			return $res;
		} catch (Exception $e) {
			throw $e;
		}
		return;
	}

	public function getNoteGroupe($idGroupe)
	{
		try {
			$res = $this->groupeGateway->SelectNoteGroupe($idGroupe);
			return $res;
		} catch (Exception $e) {
			throw $e;
		}
	}
	
	public function AjouterGroupe($nom, $prenom, $idGroupe, $note, $pourcentage, $idProjet){
		try {
			$res = $this->groupeGateway->InsertGroupe($nom, $prenom, $idGroupe, $note, $pourcentage, $idProjet);
			return $res;
		} catch (Exception $e) {
			throw $e;
		}	
	}
}

?>