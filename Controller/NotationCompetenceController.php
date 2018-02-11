<?php

require_once 'Model/CompetenceService.php';
require_once 'Model/GrilleService.php';
require_once 'Model/ProjetService.php';
require_once 'Model/GroupeService.php';
require_once '../notation/connect.php';

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
		$projetId = isset($_POST['selectProjet']) ? $_POST['selectProjet'] : NULL;
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
		$projetId = isset($_POST['selectProjet']) ? $_POST['selectProjet'] : NULL;
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
		
		include 'View/noteCompetence.php';	
	}
	

	public function AjouterNoteGrille() {
		$title = 'Ajouter une note pour la grille';

		$groupeId = '';
		$grilleId = '';
		$note = '';
		$appreciation = '';

		$errors = array();

		if (isset($_POST['form-submitted'])) {
			$groupeId = isset($_GET['groupeId']) ? $_GET['groupeId'] : NULL;
			$grilleId = isset($_POST['grilleId']) ? $_POST['grilleId'] : NULL;
			$note = isset($_POST['note']) ? $_POST['note'] : NULL;
			$appreciation = isset($_POST['appreciation']) ? $_POST['appreciation'] : NULL;

			try {
				$this->competenceService->addNoteGrille($groupeId, $grilleId, $note, $appreciation);
				header("Refresh:0");
				return;
			} catch (ValidationException $e) {
				$errors = $e->getErrors();
			}
		}


	}
}

?>