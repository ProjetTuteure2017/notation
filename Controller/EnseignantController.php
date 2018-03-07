<?php
include_once 'Includes/functions.php';
require_once 'Includes/connect.php';
require_once 'Model/EnseignantService.php';


class EnseignantController{
	
    private $enseignantService = NULL;

	function __construct()
	{	
        $this->enseignantService = new EnseignantService();
	}

    public function redirect($location) {
        header('Location: '.$location);
    }

	public function HandleRequest() {

        $op = isset($_GET['op']) ? $_GET['op'] : NULL;

        try {
            if (!$op || $op== 'ens') {
            	$this->Page();
            } else if($op == 'resp') {
                $this->ResponsablePage();
            } else if($op == 'add') {
                $this->AddEnseignantToProjet();
            } else if($op == 'register') {
                $this->Register();
            } else if($op == 'fail') {
                $this->FailPage();
            } else{
                $this->ShowError("Page not found", "Page for operation ".$op." was not found!");
            }
        } catch (Exception $e ) {
            
            $this->ShowError("Application error", $e->GetMessage());
        }
    }

    public function Page()
    {
    	$title = 'Home | Enseignant';

        $check = login_check();

    	include 'View/enseignant-page.php';
    }

    public function ResponsablePage()
    {
    	$title = 'Home | Responsable';

        $check = login_check();

    	include 'View/responsable-page.php';
    }

    public function AddEnseignantToProjet()
    {
        $title = "Ajout enseignant au projet";
        $projetId = isset($_GET['projetId']) ? $_GET['projetId'] : NULL;

        $currentId = isset($_SESSION['id'])? $_SESSION['id']:NULL;

        $enseignants = $this->enseignantService->getAllEnseignants($currentId);

        $ensbyprojet = $this->enseignantService->getAllEnseignantsbyProjet($projetId);

        $ensSelectionne = isset($_POST['selectEnseignant']) ? $_POST['selectEnseignant'] : NULL;
        $result = $this->enseignantService->AddEnseignantsToProject($projetId, $ensSelectionne);
        if($result)
        {
            header("Refresh:0");
            
        }
            
        $check = login_check();

        include 'View/enseignants.php';
    }

    public function FailPage()
    {
        $title = 'Registration';

        include 'View/register_fail.php';
    }

    public function Register(){

        $title = 'Registration';
        $errors= array();
        $projetId = isset($_GET['projetId']) ? $_GET['projetId'] : NULL;

        if (isset($_POST['nom'],$_POST['prenom'], $_POST['email'], $_POST['p'])) {
            
            $nom = filter_input(INPUT_POST, 'nom');
            $prenom = filter_input(INPUT_POST, 'prenom');
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                 array_push($errors, 'L\'adresse email n\'est pas valide!');
            }
         
            $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
            if (strlen($password) != 128) {
                array_push($errors, 'La confaiguration du mot de passe est invalide!');
            }

            $result = $this->enseignantService->canRegister($email);
            if($result == 1)
            {
                array_push($errors, 'L\'adresse email existe déja!');
            }

            if (empty($errors)) {
                // Create hashed password using the password_hash function.
                // This function salts it with a random salt and can be verified with
                // the password_verify function.
                $password = password_hash($password, PASSWORD_BCRYPT);
                $insert_result = $this->enseignantService->IsRegister($nom, $prenom, $email, $password);
                
                if($insert_result)
                {
                    $this->Redirect('index.php?page=enseignant&op=add&projetId='.$projetId);
                }
                else if(!$insert_result)
                {
                    $this->Redirect('index.php?page=enseignant&op=fail');
                }
            }
        }

        include 'View/register.php';
    }

}


?>