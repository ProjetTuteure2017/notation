<?php

require_once 'Model/CompetenceService.php';
require_once 'Model/GrilleService.php';
require_once 'Model/ProjetService.php';
require_once 'Includes/functions.php';
require_once 'Includes/connect.php';

class CompetenceController
{
	private $competenceService = NULL;
	private $grilleService = NULL;
	private $projetService = NULL;
	function __construct()
	{
		$this->competenceService = new CompetenceService();
		$this->grilleService = new GrilleService();
		$this->projetService = new ProjetService();
	}

	public function redirect($location) {
		header('Location: '.$location);
	}

	public function HandleRequest() {
		$op = filter_input(INPUT_GET, 'op', FILTER_SANITIZE_URL);
		try {
		    if (!$op || $op == 'list' ) {
		        $this->ListeCompetences();
		    } else if($op == 'new') {
		    	$this->AjouterCompetence();
		    } else {
		        $this->showError("Page not found", "Page for operation ".$op." was not found!");
		    }
		} catch ( Exception $e ) {
		    $this->showError("Application error", $e->getMessage());
		}
	}

	public function ListeCompetences() {
		$title = 'Liste des competences';

		
		$projets = $this->ListeProjets();
		$grilles = $this->ListeGrilles();
		$grilleId = isset($_POST['selectGrille']) ? $_POST['selectGrille'] : NULL;
		$competences = $this->competenceService->getAllCompetences($grilleId);

		$this->ModifierCompetence();

        $check = login_check();

		include 'View/competences.php';
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
	

	public function AjouterCompetence() {
		$title = 'Ajouter une competence';

		$theme = '';
		$intitule = '';
		$nombrePoint = '';
		$grilleId = '';

		$errors = array();

		if (isset($_POST['form-submitted'])) {
			$theme = isset($_POST['theme']) ? $_POST['theme'] : NULL;
			$intitule = isset($_POST['intitule']) ? $_POST['intitule'] : NULL;
			$nombrePoint = isset($_POST['nombrePoint']) ? $_POST['nombrePoint'] : NULL;
			$grilleId = isset($_POST['grilleId']) ? $_POST['grilleId'] : NULL;
			
			
			try {
				$this->competenceService->ajouterCompetence($theme, $intitule, $nombrePoint, $grilleId);
				$this->redirect('index.php');
				return;
			} catch (ValidationException $e) {
				$errors = $e->getErrors();
			}
		}

        $check = login_check();

		include 'View/competences-form.php';

	}
	
	public function ModifierCompetence() {
		$title = 'Modifier une competence';

		$theme = '';
		$intitule = '';
		$nombrePoint = '';
		$grilleId = '';

		$errors = array();

		if (isset($_POST['form-submitted'])) {
			$id = isset($_POST['id']) ? $_POST['id'] : NULL;
			$theme = isset($_POST['theme']) ? $_POST['theme'] : NULL;
			$intitule = isset($_POST['intitule']) ? $_POST['intitule'] : NULL;
			$nombrePoint = isset($_POST['nombrePoint']) ? $_POST['nombrePoint'] : NULL;
			$grilleId = isset($_POST['grilleId']) ? $_POST['grilleId'] : NULL;

			try {
				$this->competenceService->modifierCompetence($id, $theme, $intitule, $nombrePoint, $grilleId);
				//header("Refresh:0");
				return;
			} catch (ValidationException $e) {
				$errors = $e->getErrors();
			}
		}

	}

}

?>