<?php

require_once 'Model/GroupeService.php';
require_once 'Model/ProjetService.php';
require_once 'Model/CompetenceService.php';
require_once 'Model/GrilleService.php';
require_once '../notation/connect.php';

class NotationGroupeCompetenceController
{

	private $competenceService = NULL;
	private $grilleService = NULL;
	private $projetService = NULL;
	private $groupeService = NULL;

	function __construct()
	{
		$this->groupeService = new GroupeService();
		$this->projetService = new ProjetService();
		$this->grilleService = new GrilleService();
		$this->competenceService = new CompetenceService();
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

	public function GetGrille() {
		$grilleId = isset($_GET['grilleId']) ? $_GET['grilleId'] : NULL;
		$grille = $this->grilleService->getGrillesById($grilleId)[0];
		return $grille;
	}
	
	public function GetNoteCompetences(){
		$groupeId = isset($_GET['groupeId']) ? $_GET['groupeId'] : NULL;
		$noteCompetences = $this->competenceService->GetNoteCompetence($groupeId);
		return $noteCompetences;
		}
		
	public function Bidouille($competenceId){
		$groupeId = isset($_GET['groupeId']) ? $_GET['groupeId'] : NULL;
		$noteCompetence = $this->competenceService->GetNoteByCompetence($competenceId, $groupeId);
		if(count($noteCompetence) > 0)
			return $noteCompetence[0];
		else
			return null;
		}

	
	public function ListeCompetences(){
		$title ='Liste Competences';
		
		$groupeId = isset($_GET['groupeId']) ? $_GET['groupeId'] : NULL;
		$projets = $this->ListeProjets();
		$groupes = $this->ListeGroupes();
		//$grille = $this->GetGrille();
		$grilleId = isset($_GET['grilleId']) ? $_GET['grilleId'] : NULL;
		
		$noteCompetences = $this->GetNoteCompetences();

		$competences = $this->competenceService->getAllCompetences($grilleId);
		
		$this->AjouteOrUpdateCompetence();
		
		include 'View/noteGroupe.php';	
	}
	
	public function AjouteOrUpdateCompetence(){
		$competenceId = isset($_POST['competenceId']) ? $_POST['competenceId'] : NULL;
		$groupeId = isset($_GET['groupeId']) ? $_GET['groupeId'] : NULL;
		$note = isset($_POST['note']) ? $_POST['note'] : NULL;
		$appreciation = isset($_POST['appreciation']) ? $_POST['appreciation'] : NULL;
		
		if($this->Bidouille($competenceId) != null)
		{
			$this->ModifierNoteCompetence();
			//$this->ModifierNoteCompetence()
		}
		else
		{
			$this->AjouterNoteCompetence();
		}
		
	}
	
	public function AjouterNoteCompetence() {
		$title = 'Ajouter une note de competence';
		
		
		$note = '';
		$competence = '';
		$appreciation = '';
		$groupeId ='';
		$errors = array();

		if (isset($_POST['form-submitted'])) {
			$note = isset($_POST['note']) ? $_POST['note'] : NULL;
			$competence = isset($_POST['competenceId']) ? $_POST['competenceId'] : NULL;
			$appreciation = isset($_POST['appreciation']) ? $_POST['appreciation'] : NULL;
			$groupeId = isset($_GET['groupeId']) ? $_GET['groupeId'] : NULL;

			try {
				$this->competenceService->addNoteCompetence($note, $competence, $groupeId, $appreciation);
				header("Refresh:0");
				return;
			} catch (ValidationException $e) {
				$errors = $e->getErrors();
			}
		}
		
	

	}
	
		public function ModifierNoteCompetence() {
			//TODO sur modele du dessus 
			//$this->competenceService->updateNoteCompetence($note, $competence, $groupeId, $appreciation);
			
			/*
			$competenceId = isset($_POST['competenceId']) ? $_POST['competenceId'] : NULL;
		$groupeId = isset($_GET['groupeId']) ? $_GET['groupeId'] : NULL;
		$note = isset($_POST['note']) ? $_POST['note'] : NULL;
		$appreciation = isset($_POST['appreciation']) ? $_POST['appreciation'] : NULL;
			*/
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