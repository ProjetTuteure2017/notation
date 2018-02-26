<?php 

require_once 'Model/CompetenceGateway.php';
require_once 'Model/ValidationException.php';
require_once '../notation/Includes/connect.php';

class CompetenceService
{
	
	private $competenceGateway = NULL;

	public function __construct()
	{
		$this->competenceGateway = new CompetenceGateway();
	}

	public function getAllCompetences($grilleId)
	{
		try {
			$res = $this->competenceGateway->SelectAll($grilleId);
			return $res;
		} catch (Exception $e) {
			throw $e;
		}
		return;
	}

	public function ajouterCompetence($theme, $intitule, $nombrePoint, $grilleId)
	{
		try {
			$res=$this->competenceGateway->Ajouter($theme, $intitule, $nombrePoint, $grilleId);
			return $res;
		} catch (Exception $e) {
			throw $e;
		}
	}

	public function modifierCompetence($id, $theme, $intitule, $nombrePoint, $grilleId)
	{
		try {
			$res=$this->competenceGateway->Modifier($id, $theme, $intitule, $nombrePoint, $grilleId);
			return $res;
		} catch (Exception $e) {
			throw $e;
		}
	}

	public function addNoteCompetence($note, $competence, $groupeId, $appreciation)
	{
		try {
			$res=$this->competenceGateway->AjouterNoteCompetence($note, $competence, $groupeId, $appreciation);
			return $res;
		} catch (Exception $e) {
			throw $e;
		}
	}

	public function UpdateNoteCompetence($note, $competence, $groupeId, $appreciation)
	{
		try {
			$res=$this->competenceGateway->ModifierNoteCompetence($note, $competence, $groupeId, $appreciation);
			return $res;
		} catch (Exception $e) {
			throw $e;
		}
	}
	
	public function GetNoteCompetence($groupeId){
		try {
			$res=$this->competenceGateway->SelectNoteCompetence($groupeId);
			return $res;
		} catch (Exception $e) {
			throw $e;
		}
	}
	
	public function GetNoteByCompetence($competenceId, $groupeId){
		try {
			$res=$this->competenceGateway->SelectNoteByCompetence($competenceId, $groupeId);
			return $res;
		} catch (Exception $e) {
			throw $e;
		}
	}
	
}

?>