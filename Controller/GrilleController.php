<?php

require_once 'Model/GrilleService.php';
require_once '../notation/connect.php';

/**
* 
*/
class GrilleController
{
	private $grilleService = NULL;
	function __construct()
	{
		$this->grilleService = new GrilleService();
	}

	public function redirect($location) {
		header('Location: '.$location);
	}

	public function HandleRequest() {
		$op = filter_input(INPUT_GET, 'op', FILTER_SANITIZE_URL);
		try {
		    if ( !$op || $op == 'list' ) {
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

		//$projetId = isset($_POST['projetId']) ? $_POST['projetId'] : NULL;
		$projetId = 1;
		$grilles = $this->grilleService->getAllGrilles($projetId);

		include 'View/grilles.php';
	}

	public function AjouterGrille() {
		$title = 'Ajouter grille';

		$titre = '';
		$note = '';
		$coef = '';
		$projetId = '';

		$errors = array();

		if (isset($_POST['form-submitted'])) {
			$titre = isset($_POST['titre']) ? $_POST['titre'] : NULL;
			$note = isset($_POST['note']) ? $_POST['note'] : NULL;
			$coef = isset($_POST['coef']) ? $_POST['coef'] : NULL;
			$projetId = isset($_POST['projetId']) ? $_POST['projetId'] : NULL;

			try {
				$this->grilleService->ajouterGrille($titre, $note, $coef, $projetId);
				$this->redirect('index.php');
				return;
			} catch (ValidationException $e) {
				$errors = $e->getErrors();
			}
		}

		include 'View/grille-form.php';

	}
}

?>