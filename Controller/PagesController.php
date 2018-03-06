<?php

require_once 'Model/enseignantService.php';
require_once 'Includes/functions.php';
require_once 'Includes/connect.php';

sec_session_start(); 

class PagesController
{

	private $enseignantService = NULL;

	function __construct()
	{
		$this->enseignantService = new enseignantService();
	}

	public function redirect($location) {
		header('Location: '.$location);
	}

	public function HandleRequest() {
		$op = filter_input(INPUT_GET, 'op', FILTER_SANITIZE_URL);
		try {
		    if (!$op || $op == 'home') {
                $this->Home();
            } else if ($op == 'login'){
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

    public function Home()
    {
        $title = 'Accueil';
        include 'View/accueil.php';
    }
    
	public function Logout()
    {
        $title = 'Déconnecter';
        include 'View/logout.php';
    }

    public function Login() 
    {
    	$title = 'Connexion';

    	$email = '';
    	$motDePasse = '';

    	$enseignantId = isset($_SESSION['id']) ? $_SESSION['id'] : NULL;

    	$errors = array();

    	if(isset($_POST['email'], $_POST['p'])) 
    	{
            $email = $_POST['email'];
            $motDePasse = $_POST['p'];

            try {
            	$enseignantExist = $this->enseignantService->EnseignantLoginExist($email, $motDePasse);

            	if($enseignantExist == 1) 
            	{

            		$enseignantLogged = $this->enseignantService->EnseignantLogin($email, $motDePasse);
            		if(isset($enseignantLogged))
            		{
            			/* Test if responsable logged*/
            			$responsableLogged = $this->enseignantService->ResponsableLogin($email, $motDePasse);
                        //row responsable true = 1
            			if($responsableLogged == 1)
            			{
            				$this->Redirect('index.php?page=enseignant&op=resp');
            			} else
            			{
            				$this->Redirect('index.php?page=enseignant');
            			}
            		} else
            		{
            			$this->Redirect('index.php');
            		}
            	} else if($enseignantExist == 2) 
            	{
                    //2 => Mot de passe incorrect
                    array_push($errors, 'Mot de Passe incorrect');
            	}
                else if($enseignantExist == 3){
                    //3 => user doesnt exist
                    array_push($errors, 'Nom d\'Utilisateur incorrect');

                } else{
                    array_push($errors, 'Compte bloqué');
                    //print 'Account locked';
                }
            } catch (ValidationException $e) {
            	
            	$errors = $e->GetErrors();	
            }

    	}

        $check = login_check();
        
		include 'View/connexion.php';

    }

}
?>