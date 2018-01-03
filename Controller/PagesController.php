<?php

require_once 'Model/PagesService.php';
require_once '../notation/connect.php';

class PagesController
{

	private $pagesService = NULL;

	function __construct()
	{
		$this->pagesService = new PagesService();
	}

	public function redirect($location) {
		header('Location: '.$location);
	}

	public function HandleRequest() {
		$op = filter_input(INPUT_GET, 'op', FILTER_SANITIZE_URL);
		try {
		    if ( !$op || $op == 'login' ) {
		        $this->Login();
		    } else if($op == 'logout') {
		    	$this->Logout();
		    } else {
		        $this->showError("Page not found", "Page for operation ".$op." was not found!");
		    }
		} catch ( Exception $e ) {
		    $this->showError("Application error", $e->getMessage());
		}
	}

	public function Logout()
    {
        $title = 'Deconnecter';
        include 'View/logout.php';
    }

    public function Login() 
    {
    	$title = 'Connexion';

    	$nom = '';
    	$motDePasse = '';

    	$enseignantId = isset($_SESSION['id']) ? $_SESSION['id'] : NULL;

    	$errors = array();

    	if(isset($_POST['form-submitted']) ) 
    	{
    		$nom = isset($_POST['nom']) ? $_POST['nom'] :NULL;
            $motDePasse = isset($_POST['motDePasse']) ? $_POST['motDePasse'] :NULL;

            try {
            	$enseignantExist = $this->pagesService->EnseignantLoginExist($nom, $motDePasse);

            	if($enseignantExist == 1) 
            	{

            		$enseignantLogged = $this->pagesService->EnseignantLogin($nom, $motDePasse);
            		if(isset($enseignantLogged))
            		{
            			/* Test if responsable logged*/
            			$responsableLogged = $this->pagesService->ResponsableLogin($nom, $motDePasse);
            			if($responsableLogged == 1)
            			{
            				$this->Redirect('index.php?page=enseignant&op=resp');
            			} else
            			{
            				$this->Redirect('index.php?page=enseignant&op=ens');
            			}
            		} else
            		{
            			$this->Redirect('index.php?page=index&op=home');
            		}
            	} else 
            	{
                    $this->Redirect('index.php?page=index&op=login');
            	}
            } catch (ValidationException $e) {
            	
            	$errors = $e->GetErrors();	
            }

    	}
		include 'View/connexion.php';

    }

}
?>