<?php 

require_once 'Model/ProjetGateway.php';
require_once 'Model/ValidationException.php';
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

	public function ajouterProjet($titre, $description, $enseignantId){
		try {
			$res = $this->projetGateway->Ajouter($titre, $description, $enseignantId);
			return $res;
		} catch (Exception $e) {
			throw $e;
		}
	}

	public function modifierProjet($id, $titre, $description)
	{
		try{
			$res = $this->projetGateway->Modifier($id, $titre, $description);
			return $res;
		} catch (Exception $e) {
			throw $e;
		}
	}


}