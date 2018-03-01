<?php

require_once 'Model/GroupeService.php';
require_once 'Model/ProjetService.php';
require_once 'Model/GrilleService.php';
include_once 'Includes/functions.php';
require_once 'Includes/connect.php';

class EtudiantController
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
		        $this->ListeEtudiants();
		    } else if($op == 'note') {
		    	$this->ListeNoteEtudiant();
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

	public function ListeEtudiants() {
		$title = 'Liste des étudiants';

		$projets = $this->ListeProjets();
		$projetId = isset($_POST['selectProjet']) ? $_POST['selectProjet'] : NULL;

		//Etudiant du projet selectionné
		$groupes = $this->groupeService->getAllGroupes($projetId);

        $check = login_check();

		include 'View/etudiants.php';
	}

	public function ListeNoteEtudiant() {
		$title = 'Notes des étudiants';

		$idGroupe = isset($_GET['idgroupe']) ? $_GET['idgroupe'] : NULL;
		$groupe = $this->groupeService->getNoteGroupe($idGroupe);

		$result = $this->ModifierNoteEtudiant();
		if($result)
		{
			header("Refresh:0");
		}

        $check = login_check();

		include 'View/groupe-note.php';
	}
	public function AddGroupe($etudiant, $idGroupe, $note, $idProjet){
		$this->groupeService->AjouterGroupe($etudiant, $idGroupe, $note, $idProjet);
		
	}

	public function ModifierNoteEtudiant() {

		$title = 'Modifer note';

		$nom ='';
		$note ='';
		$pourcentage ='';
		$idGroupe = isset($_GET['idgroupe']) ? $_GET['idgroupe'] : NULL;

		$errors = array();


		if(isset($_POST['form-submitted'])){
			$position = isset($_POST['position']) ? $_POST['position'] : NULL;
			$nom = isset($_POST['nom']) ? $_POST['nom'] : NULL;
			$note = isset($_POST['note']) ? $_POST['note'] : NULL;
			$pourcentage = isset($_POST['pourcentage']) ? $_POST['pourcentage'] : NULL;
			try {
				$result = $this->groupeService->ModifyNoteEtudiant($idGroupe, $position, $nom, $note, $pourcentage);
				//header("Refresh:0");
				return $result;
			} catch (ValidationException $e) {
				$errors = $e->getErrors();
			}
		}
	}

}
