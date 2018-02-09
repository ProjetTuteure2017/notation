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

	public function modifierGrille($id, $titre, $note_sur, $coef, $projetId)
	{
		try {
			$res=$this->grilleGateway->Modifier($id, $titre, $note_sur, $coef, $projetId);
			return $res;
		} catch (Exception $e) {
			throw $e;
		}
	}
	
		public function addNoteGrille($groupeId, $grilleId, $note, $appreciation)
	{
		try {
			$res=$this->notationCompetenceGateway->AjouterNoteGrille($groupeId, $grilleId, $note, $appreciation);
			return $res;
		} catch (Exception $e) {
			throw $e;
		}
	}


}

?>