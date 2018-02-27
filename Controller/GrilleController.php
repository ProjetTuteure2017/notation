<?php

require_once 'Model/GrilleService.php';
require_once 'Model/ProjetService.php';
include_once 'Includes/functions.php';
require_once 'Includes/connect.php';

class GrilleController
{
	private $grilleService = NULL;
	private $projetService = NULL;
	function __construct()
	{
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
		        $this->ListeGrilles();
		    } else if($op == 'new') {
		    	$this->AjouterGrille();
		    } else {
		        $this->showError("Page not found", "Page for operation ".$op." was not found!");
		    }
		} catch ( Exception $e ) {
		    $this->showError("Application error", $e->getMessage());
		}
	}

	public function ListeGrilles() {
		$title = 'Liste des grilles';

		$projets = $this->ListeProjets();
		$projetId = isset($_GET['projetId']) ? $_GET['projetId'] : NULL;
		$grilles = $this->grilleService->getAllGrilles($projetId);

		$this->ModifierGrille();

        $check = login_check();

		include 'View/grilles.php';
	}
	public function ListeProjets() {
		$enseignantId = isset($_SESSION['id']) ? $_SESSION['id'] : NULL;
		$projets = $this->projetService->getAllProjets($enseignantId);
		return $projets;
	}

	public function AjouterGrille() {
		$title = 'Ajouter grille';

		$titre = '';
		$note_sur = '';
		$coef = '';
		$projetId = '';

		$errors = array();

		if (isset($_POST['form-submitted'])) {
			$titre = isset($_POST['titre']) ? $_POST['titre'] : NULL;
			$note_sur = isset($_POST['note_sur']) ? $_POST['note_sur'] : NULL;
			$coef = isset($_POST['coef']) ? $_POST['coef'] : NULL;
			$projetId = isset($_GET['projetId']) ? $_GET['projetId'] : NULL;

			try {
				$this->grilleService->ajouterGrille($titre, $note_sur, $coef, $projetId);
				$this->redirect('http://notation/index.php?page=grille&projetId='.$projetId);
				return;
			} catch (ValidationException $e) {
				$errors = $e->getErrors();
			}
		}

        $check = login_check();

		include 'View/grille-form.php';

	}

	public function ModifierGrille()
	{
		$id = '';
		$titre = '';
		$note = '';
		$coef = '';
		$projetId = '';

		$errors = array();

		if (isset($_POST['form-submitted'])) {
			$id = isset($_POST['id']) ? $_POST['id'] : NULL;
			$titre = isset($_POST['titre']) ? $_POST['titre'] : NULL;
			$note_sur = isset($_POST['note_sur']) ? $_POST['note_sur'] : NULL;
			$coef = isset($_POST['coef']) ? $_POST['coef'] : NULL;     

			try {
                $this->grilleService->modifierGrille($id, $titre, $note_sur, $coef);
                header("Refresh:0");
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
		}
	}


}

?>