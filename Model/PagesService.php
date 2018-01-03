<?php

require_once 'Model/PagesGateway.php';
require_once 'Model/ValidationException.php';
require_once '../notation/connect.php';

class PagesService {

	private $pagesGateway = NULL;

	function __construct()	{
		$this->pagesGateway = new PagesGateway();
	}

	public function EnseignantLoginExist($nom, $motDePasse) {
		try {
			$result = $this->pagesGateway->Login($nom, $motDePasse);
			return $result;
		} catch (Exception $e) {
			throw $e;
		}
	}

	public function EnseignantLogin($nom, $motDePasse) {

		try {
			$this->pagesGateway->Login($nom, $motDePasse);
			$result = $this->pagesGateway->IsLogged();
			return $result;
		} catch (Exception $e) {
			throw $e;
		}
	}

	public function ResponsableLogin($nom, $motDePasse) {
		
		try {
			$this->pagesGateway->Login($nom, $motDePasse);
			$result = $this->pagesGateway->IsResponsable();
			return $result;

		} catch (Exception $e) {
			throw $e;
		}
	}

	public function IsResponsableSession() {

		try {
			$result = $this->pagesGateway->IsResponsable();
			return $result;
		} catch (Exception $e) {
			throw $e;
		}
	}

}

?>