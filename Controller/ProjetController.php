<?php

require_once 'Model/ProjetService.php';

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

    public function ListProjets($ensignantId) {
        $projets = $this->projetService->getAllProjets($ensignantId);
        include 'View/projet.php';
    }
    
    public function InsertProjet($description, $enseignantId) {
        $projet = $this->projetService->InsertProjet($description, $enseignantId);
        
        include 'Views/projet.php';
    }
}

?>