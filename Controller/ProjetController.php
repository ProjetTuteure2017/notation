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
        $op = isset($_GET['op'])?$_GET['op']:NULL;
        try {
            if ( !$op || $op == 'list' ) {
                $this->ListProjets();
            } else if($op == 'new') {
            	$this->InsertProjet();
            } else {
                $this->showError("Page not found", "Page for operation ".$op." was not found!");
            }
        } catch ( Exception $e ) {
            throw $e;
        }
    }

    public function ListProjets() {
        $title = 'Liste des projets';
        $ensignantId = isset($_GET['ensignantId']) ? $_GET['ensignantId'] : NULL;

        $projets = $this->projetService->getAllProjets($ensignantId);
        include 'View/projets.php';
    }
    
    public function InsertProjet() {
        $title = 'Ajouter Projet';

        $titre = '';
        $description = '';
        $enseignantId='';

        if(isset($_POST['form-submitted'])) {
            $titre = isset($_POST['titre']) ? $_POST['titre'] : NULL;
            $description = isset($_POST['description']) ? $_POST['description'] : NULL;
            $enseignantId = isset($_POST['enseignantId']) ? $_POST['enseignantId'] : NULL;
            
            try {
                $this->projetService->createNewProjet($titre, $description, $enseignantId);
                //$this->redirect('index.php?page=projet&op=list');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        

        }

        include 'View/projet-form.php';
    }

}

?>