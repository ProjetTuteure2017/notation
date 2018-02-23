<?php 

require_once 'Model/GrilleGateway.php';
require_once 'Model/ValidationException.php';
require_once '../notation/connect.php';

class GrilleService
{
	
	private $grilleGateway = NULL;

	public function __construct()
	{
		$this->grilleGateway = new GrilleGateway();
	}

	public function getAllGrilles($projetId)
	{
		try {
			$res = $this->grilleGateway->SelectAll($projetId);
			return $res;
		} catch (Exception $e) {
			throw $e;
		}
		return;
	}
	
	public function getGrillesById($grilleId)
	{
		try {
			$res = $this->grilleGateway->SelectByGrilleId($grilleId);
			return $res;
		} catch (Exception $e) {
			throw $e;
		}
		return;
	}

	public function ajouterGrille($titre, $note_sur, $coef, $projetId)
	{
		try {
			$res=$this->grilleGateway->Ajouter($titre, $note_sur, $coef, $projetId);
			return $res;
		} catch (Exception $e) {
			throw $e;
		}
	}

	public function modifierGrille($id, $titre, $note_sur, $coef)
	{
		try {
			$res=$this->grilleGateway->Modifier($id, $titre, $note_sur, $coef);
			return $res;
		} catch (Exception $e) {
			throw $e;
		}
	}
	
		public function addNoteGrille($groupeId, $grilleId, $note, $appreciation)
	{
		try {
			$res=$this->grilleGateway->AjouterNoteGrille($groupeId, $grilleId, $note, $appreciation);
			return $res;
		} catch (Exception $e) {
			throw $e;
		}
	}
	
		public function UpdateNoteGrille($note, $grilleId, $groupeId, $appreciation)
	{
		try {
			$res=$this->grilleGateway->ModifierNoteGrille($note, $grilleId, $groupeId, $appreciation);
			return $res;
		} catch (Exception $e) {
			throw $e;
		}
	}

	public function GetNoteByGrille($grilleId, $groupeId)
	{
		try {
			$res=$this->grilleGateway->SelectNoteGrilleByGroupe($grilleId, $groupeId);
			return $res;
		} catch (Exception $e) {
			throw $e;
		}
	}
	
	public function getNotesByIdGroupe($groupeId){
		try {
			$res=$this->grilleGateway->SelectNotesGrillesByGroupeId($groupeId);
			return $res;
		} catch (Exception $e) {
			throw $e;
		}
	}

}

?>