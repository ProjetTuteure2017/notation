<?php

require_once 'Model/GroupeGateway.php';
require_once 'Model/ValidationException.php';
require_once '../notation/connect.php';

class GroupeService 
{

	private $groupeGateway = NULL;

	function __construct()
	{
		$this->groupeGateway = new GroupeGateway();	
	}

	public function getAllGroupes($projetId)
	{
		try {
			$res = $this->groupeGateway->SelectAll($projetId);
			return $res;
		} catch (Exception $e) {
			throw $e;
		}
		return;
	}

}

?>