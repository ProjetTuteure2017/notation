<?php

require_once 'Model/GroupeService.php';
require_once 'Model/ProjetService.php';
require_once '../notation/connect.php';

class GroupeController
{

	private $groupeService = NULL;
	private $projetService = NULL;

	function __construct()
	{
		$this->groupeService = new GroupeService();
		$this->projetService = new ProjetService();
	}

	public function redirect($location) {
		header('Location: '.$location);
	}

	public function HandleRequest() {
		$op = filter_input(INPUT_GET, 'op', FILTER_SANITIZE_URL);
		try {
		    if (!$op || $op == 'list' ) {
		        $this->ListeGroupess();
		    } else {
		        $this->showError("Page not found", "Page for operation ".$op." was not found!");
		    }
		} catch ( Exception $e ) {
		    $this->showError("Application error", $e->getMessage());
		}
	}

	public function ListeProjets() {
		$enseignantId = isset($_SESSION['id']) ? $_SESSION['id'] : NULL;
		$projets = $this->projetService->getAllProjets($enseignantId);
		return $projets;
	}

	public function ListeGroupess() {
		$title = 'Liste des groupes';

		$projets = $this->ListeProjets();
		//$projetId = isset($_POST['selectProjet']) ? $_POST['selectProjet'] : NULL;
		$projetId = 2;
		$groupes = $this->groupeService->getAllGroupes($projetId);

		include 'View/groupes.php';
	}

}

?>