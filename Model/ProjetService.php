<?php 

class ProjetService {
	
	private $projetService = NULL;

	public function __construct() {
		$this->projetService = new ProjetService();
	}

	public function getAllProjets($enseignantId){
		try{
			$res = $this->projetGateway->SelectAll($enseignantId);
			return $res;
		} catch(Exception $e) {
			throw $e;
		}
	}

	public function createNewProjet($description, $enseignantId){
		try {
			$res = $this->projetGateway->InsertProjet($description, $enseignantId);
			return $res;
		} catch (Exception $e) {
			throw $e;
		}
	}


}