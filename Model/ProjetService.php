<?php 

require_once 'Model/ProjetGateway.php';
require_once '../notation/connect.php';

class ProjetService {
	
	private $projetGateway = NULL;

	public function __construct() {
		$this->projetGateway = new ProjetGateway();
	}

	public function getAllProjets($enseignantId){
		try{
			$res = $this->projetGateway->SelectAll($enseignantId);
			return $res;
		} catch(Exception $e) {
			throw $e;
		}
		return;
	}

	public function createNewProjet($titre, $description, $enseignantId){
		try {
			$res = $this->projetGateway->Insert($titre, $description, $enseignantId);
			return $res;
		} catch (Exception $e) {
			throw $e;
		}
	}


}