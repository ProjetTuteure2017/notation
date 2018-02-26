<?php

require_once 'Model/EnseignantGateway.php';
require_once 'Model/ValidationException.php';
require_once '../notation/Includes/connect.php';

class EnseignantService {

	private $enseignantGateway = NULL;

	function __construct()	{
		$this->enseignantGateway = new EnseignantGateway();
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

}

?>