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
		
	public function BidouilleGrille(){
		$groupeId = isset($_GET['groupeId']) ? $_GET['groupeId'] : NULL;
		$grilleId = isset($_GET['grilleId']) ? $_GET['grilleId'] : NULL;
		$noteGrille = $this->grilleService->GetNoteByGrille($grilleId, $groupeId);
		if(count($noteGrille) > 0)
			return $noteGrille[0];
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
		//$noteGrille = $this->grilleService->GetNoteByGrille($grilleId,$groupeId);
		
		
		include 'View/noteGroupe.php';	
	}
	
	public function AjouteOrUpdateCompetence(){
		$competenceId = isset($_POST['competenceId']) ? $_POST['competenceId'] : NULL;
		$groupeId = isset($_GET['groupeId']) ? $_GET['groupeId'] : NULL;
		$note = isset($_POST['note']) ? $_POST['note'] : NULL;
		$appreciation = isset($_POST['appreciation']) ? $_POST['appreciation'] : NULL;
		
		if($this->Bidouille($competenceId) != null)
		{
			$this->ModifyNoteCompetence();
			//$this->ModifierNoteCompetence()
		}
		else
		{
			$this->AjouterNoteCompetence();
		}
		
		$this->UpdateNoteGrille();
	}
	
	public function UpdateNoteGrille(){
		$noteGrille = $this->BidouilleGrille();
		if($noteGrille != null)
		{
			$this->ModifyNoteGrille();
			//$this->ModifierNoteCompetence()
		}
		else
		{
			$this->AjouterNoteGrille();
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
	
	public function ModifyNoteCompetence() {
			//TODO  
		$title = 'Modifier une note de competence';
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
				$this->competenceService->UpdateNoteCompetence($note, $competence, $groupeId, $appreciation);
				header("Refresh:0");
				return;
			} catch (ValidationException $e) {
				$errors = $e->getErrors();
			}
		}
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
			$grilleId = isset($_GET['grilleId']) ? $_GET['grilleId'] : NULL;
			$appreciation = isset($_POST['appreciation']) ? $_POST['appreciation'] : NULL;
			
			$nouvelleNoteCompetence = isset($_POST['note']) ? $_POST['note'] : NULL;
			$nombrePoint = isset($_POST['nombrePoint']) ? $_POST['nombrePoint'] : NULL;
			$note = ($nouvelleNoteCompetence / $nombrePoint) * 20;

			try {
				$this->grilleService->addNoteGrille($groupeId, $grilleId, $note, $appreciation);
				header("Refresh:0");
				return;
			} catch (ValidationException $e) {
				$errors = $e->getErrors();
			}
		}

	}
	
	public function ModifyNoteGrille() {
		$title = 'Modifier une note de grille';
		$note = '';
		$grilleId = '';
		$appreciation = '';
		$groupeId ='';
		$errors = array();

		if (isset($_POST['form-submitted'])) {
			$grilleId = isset($_GET['grilleId']) ? $_GET['grilleId'] : NULL;
			$appreciation = isset($_POST['appreciation']) ? $_POST['appreciation'] : NULL;
			$groupeId = isset($_GET['groupeId']) ? $_GET['groupeId'] : NULL;
			
			
			$competences = $this->competenceService->getAllCompetences($grilleId);
			
			$i=0;
			$n=0;
			foreach($competences as $c){
				$nbPoint = $c['nombrePoint'];
				$noteCompetence = $this->competenceService->GetNoteByCompetence($c['id'], $groupeId);
				if(count($noteCompetence) > 0){
					$noteTempo = $noteCompetence[0]['note'];
					$n += $noteTempo / $nbPoint * 20;
					$i++;
				}
			}
			$note = ($n == 0 || $i == 0) ? NULL : ($n / $i);

			try {
				$this->grilleService->UpdateNoteGrille($note, $grilleId, $groupeId, $appreciation);
				header("Refresh:0");
				return;
			} catch (ValidationException $e) {
				$errors = $e->getErrors();
			}
		}
	}
	
}

?>