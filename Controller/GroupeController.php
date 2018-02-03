<?php

require_once 'Model/GroupeService.php';
require_once 'Model/ProjetService.php';
require_once 'Model/GrilleService.php';
require_once '../notation/connect.php';

class GroupeController
{

	private $groupeService = NULL;
	private $projetService = NULL;
	private $grilleService = NULL;

	function __construct()
	{
		$this->groupeService = new GroupeService();
		$this->projetService = new ProjetService();
		$this->grilleService = new GrilleService();
	}

	public function redirect($location) {
		header('Location: '.$location);
	}

	public function HandleRequest() {
		$op = filter_input(INPUT_GET, 'op', FILTER_SANITIZE_URL);
		try {
		    if (!$op || $op == 'list' ) {
		        $this->ListeGroupes();
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

	public function ListeGrilles() {
		$projets = $this->ListeProjets();
		$projetId = isset($_POST['selectProjet']) ? $_POST['selectProjet'] : NULL;
		$grilles = $this->grilleService->getAllGrilles($projetId);

		return $grilles;
	}

	public function ListeGroupes() {
		$title = 'Liste des groupes';

		$projets = $this->ListeProjets();
		$projetId = isset($_POST['selectProjet']) ? $_POST['selectProjet'] : NULL;

		//Etudiant du projet selectionné
		$groupes = $this->groupeService->getAllGroupes($projetId);

		//Grilles of selected project
		$grilles = $this->ListeGrilles();

		include 'View/groupes.php';
	}

}

?>