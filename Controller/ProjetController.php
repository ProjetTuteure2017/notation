<?php

require_once 'Model/ProjetService.php';
require_once '../notation/connect.php';

class ProjetController {

 	private $projetService = NULL;
    
    public function __construct() {
        $this->projetService = new projetService();
    }
    
    public function redirect($location) {
        header('Location: '.$location);
    }

	public function HandleRequest() {
        $op = filter_input(INPUT_GET, 'op', FILTER_SANITIZE_URL);
        try {
            if ( !$op || $op == 'list' ) {
                $this->ListeProjets();
            } else if($op == 'new') {
            	$this->AjouterProjet();
            } else {
                $this->showError("Page not found", "Page for operation ".$op." was not found!");
            }
        } catch ( Exception $e ) {
            $this->showError("Application error", $e->getMessage());
        }
    }

    public function ListeProjets() {
        $title = 'Liste des projets';

        $enseignantId= filter_input(INPUT_GET, 'enseignantId', FILTER_SANITIZE_URL);

        $projets = $this->projetService->getAllProjets($enseignantId);
        $this->ModifierProjet();

        include 'View/projets.php';
    }
    
    public function AjouterProjet() {
        $title = 'Ajouter Projet';

        $titre = '';
        $description = '';
        $enseignantId='';

        $errors= array();

        if(isset($_POST['form-submitted'])) {
            $titre = isset($_POST['titre']) ? $_POST['titre'] : NULL;
            $description = isset($_POST['description']) ? $_POST['description'] : NULL;
            $enseignantId = isset($_POST['enseignantId']) ? $_POST['enseignantId'] : NULL;
            
            try {
                $this->projetService->ajouterNouveauProjet($titre, $description, $enseignantId);
                $this->redirect('index.php');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }

        include 'View/projet-form.php';
    }

    public function ModifierProjet()
    {
        $id = '';
        $titre = '';
        $description = '';

        $errors= array();

        if(isset($_POST['form-submitted'])) {

            $id= isset($_POST['id']) ? $_POST['id'] : NULL;
            $titre = isset($_POST['titre']) ? $_POST['titre'] : NULL;
            $description = isset($_POST['description']) ? $_POST['description'] : NULL;

            try {
                $this->projetService->modifierProjet($id, $titre, $description);
                header("Refresh:0");
                //$this->redirect('index.php');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }

        //include 'View/projets.php';

    }
}

?>