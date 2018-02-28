<?php

require_once 'Model/EnseignantGateway.php';
require_once 'Model/ValidationException.php';
require_once '../notation/Includes/connect.php';

class EnseignantService {

	private $enseignantGateway = NULL;

	function __construct()	{
		$this->enseignantGateway = new EnseignantGateway();
	}


	public function getAllEnseignants($currentId) {
		try {
			$result = $this->enseignantGateway->SelectAll($currentId);
			return $result;
		} catch (Exception $e) {
			throw $e;
		}
	}

	
	public function getAllEnseignantsbyProjet($projetId) {
		try {
			$result = $this->enseignantGateway->SelectAllbyProjet($projetId);
			return $result;
		} catch (Exception $e) {
			throw $e;
		}
	}
	public function AddEnseignantsToProject($projetId, $enseignantId) {
		try {
			$result = $this->enseignantGateway->AddEnseignantProjet($projetId, $enseignantId);
			return $result;
		} catch (Exception $e) {
			throw $e;
		}
	}

	public function EnseignantLoginExist($nom, $motDePasse) {
		try {
			$result = $this->enseignantGateway->Login($nom, $motDePasse);
			return $result;
		} catch (Exception $e) {
			throw $e;
		}
	}

	public function EnseignantLogin($nom, $motDePasse) {

		try {
			$this->enseignantGateway->Login($nom, $motDePasse);
			$result = $this->enseignantGateway->IsLogged();
			return $result;
		} catch (Exception $e) {
			throw $e;
		}
	}

	public function ResponsableLogin($nom, $motDePasse) {
		
		try {
			$this->enseignantGateway->Login($nom, $motDePasse);
			$result = $this->enseignantGateway->IsResponsable();
			return $result;

		} catch (Exception $e) {
			throw $e;
		}
	}

	public function IsResponsableSession() {

		try {
			$result = $this->enseignantGateway->IsResponsable();
			return $result;
		} catch (Exception $e) {
			throw $e;
		}
	}

	public function canRegister($email, $username) {
		try {
			$result = $this->enseignantGateway->registerCheck($email, $username);
			return $result;
		} catch (Exception $e) {
			throw $e;
		}
	}

	public function IsRegister($nom, $prenom, $username, $email, $password) {
		try {
			$result = $this->enseignantGateway->register($nom, $prenom, $username, $email, $password);
			return $result;
		} catch (Exception $e) {
			throw $e;
		}
	}

}

?>