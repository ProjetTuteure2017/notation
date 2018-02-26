<?php

require_once 'Model/GroupeService.php';
require_once 'Model/ProjetService.php';
require_once 'Model/GrilleService.php';
require_once '../notation/Includes/connect.php';

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

		include 'View/etudiants.php';
	}

	public function ListeNoteEtudiant() {
		$title = 'Notes des étudiants';

		$idGroupe = isset($_GET['idgroupe']) ? $_GET['idgroupe'] : NULL;
		$groupe = $this->groupeService->getNoteGroupe($idGroupe);

		include 'View/groupe-note.php';
	}
	
	public function AddGroupe($nom, $prenom, $idGroupe, $note, $pourcentage, $idProjet){
		$this->groupeService->AjouterGroupe($nom, $prenom, $idGroupe, $note, $pourcentage, $idProjet);
		
	}

}
