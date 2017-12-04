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

	public function ajouterGrille($titre, $note, $coef, $projetId)
	{
		try {
			$res=$this->grilleGateway->Ajouter($titre, $note, $coef, $projetId);
			return $res;
		} catch (Exception $e) {
			throw $e;
		}
	}


}

?>