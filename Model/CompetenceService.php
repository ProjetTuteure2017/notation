<?php 

require_once 'Model/CompetenceGateway.php';
require_once 'Model/ValidationException.php';
require_once '../notation/connect.php';

class CompetenceService
{
	
	private $CompetenceGateway = NULL;

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


}

?>