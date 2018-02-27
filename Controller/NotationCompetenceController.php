<?php

require_once 'Model/CompetenceService.php';
require_once 'Model/GrilleService.php';
require_once 'Model/ProjetService.php';
require_once 'Model/GroupeService.php';
include_once 'Includes/functions.php';
require_once 'Includes/connect.php';

class NotationCompetenceController{
	
	private $competenceService = NULL;
	private $grilleService = NULL;
	private $projetService = NULL;
	
	function __construct()
	{
		$this->competenceService = new CompetenceService();
		$this->grilleService = new GrilleService();
		$this->projetService = new ProjetService();
		$this->groupeService = new GroupeService();
	}
	
	public function redirect($location) {
		header('Location: '.$location);
	}
	
	public function HandleRequest() {
		$op = filter_input(INPUT_GET, 'op', FILTER_SANITIZE_URL);
		try {
		    if (!$op || $op == 'list' ) {
		        $this->ListeCompetences();
		    } else {
		        $this->showError("Page not found", "Page for operation ".$op." was not found!");
		    }
		} catch ( Exception $e ) {
		    $this->showError("Application error", $e->getMessage());
		}
	}

	public function ListeGrilles() {
		$projetId = isset($_GET['selectProjet']) ? $_GET['selectProjet'] : NULL;
		$grilles = $this->grilleService->getAllGrilles($projetId);
		return $grilles;
	}

	public function ListeProjets() {
		$enseignantId = isset($_SESSION['id']) ? $_SESSION['id'] : NULL;
		$projets = $this->projetService->getAllProjets($enseignantId);
		return $projets;
	}
	
	public function ListeGroupes() {
		$projets = $this->ListeProjets();
		$projetId = isset($_GET['selectProjet']) ? $_GET['selectProjet'] : NULL;
		//Etudiant du projet selectionné
		$groupes = $this->groupeService->getAllGroupes($projetId);
		return $groupes;
	}
	
	public function ListeCompetences(){
		$title ='Liste Competences';
		
		//$groupeId = isset($_GET['groupeId']) ? $_GET['groupeId'] : NULL;
		$projets = $this->ListeProjets();
		$grilles = $this->ListeGrilles();
		$groupes = $this->ListeGroupes();
		//$grilleId = isset($_POST['selectGrille']) ? $_POST['selectGrille'] : NULL;
		$grilleId = isset($_GET['grilleSelectionnee']) ? $_GET['grilleSelectionnee'] : NULL;

		$competences = $this->competenceService->getAllCompetences($grilleId);
		//$this->AjouterNoteCompetence();
		
        $check = login_check();

		include 'View/noteCompetence.php';	
	}
	
}

?>