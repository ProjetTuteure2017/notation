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
            } else if($op == 'reg') {
                $this->Register();
            } else if($op == 'succes') {
                $this->SuccessPage();
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

    public function SuccessPage()
    {
        $title = 'Registration succes';

        include 'View/register_success.php';
    }

    public function Register(){

        $title = 'Registration';
        $errors= array();


        if (isset($_POST['nom'],$_POST['prenom'],$_POST['username'], $_POST['email'], $_POST['p'])) {
            
            $nom = filter_input(INPUT_POST, 'nom');
            $prenom = filter_input(INPUT_POST, 'prenom');
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors = 'The email address you entered is not valid';
            }
         
            $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
            if (strlen($password) != 128) {
                $errors = 'Invalid password configuration.';
            }

            $result = $this->enseignantService->canRegister($email, $username);
            if($result == 1)
            {
                print 'Email deja exist';
            }
            if($result == 2)
            {
                print 'User deja exist';
            }

            if (empty($error_msg)) {
                // Create hashed password using the password_hash function.
                // This function salts it with a random salt and can be verified with
                // the password_verify function.
                $password = password_hash($password, PASSWORD_BCRYPT);
                $insert_result = $this->enseignantService->IsRegister($nom, $prenom, $username, $email, $password);
                // Insert the new user into the database 
                if($insert_result)
                {
                    $this->Redirect('index.php?page=responsable&op=succes');
                }
                else if(!$insert_result){
                    $this->Redirect('index.php?page=responsable&op=fail');
                }
            }
        }

        include 'View/register.php';
    }

}


?>