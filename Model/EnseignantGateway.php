<?php

class EnseignantGateway {

	public function SelectAll($currentId)
	{
		include '../notation/Includes/connect.php';

        $stmt = $conn->prepare("SELECT p.id, p.nom FROM enseignant e INNER JOIN personne p ON e.personneId = p.id WHERE p.id != :ID");
        $stmt->execute(array("ID"=>$currentId));
        $result = $stmt->fetchAll();
        
        return $result;	
	}

	public function SelectAllbyProjet($projetId)
	{
		include '../notation/Includes/connect.php';

        $stmt = $conn->prepare("SELECT p.nom FROM enseignant e, projetenseignant pe, personne p WHERE e.personneId = p.id AND pe.enseignantId = e.personneId AND pe.projetId =:PROJETID");
        $stmt->execute(array("PROJETID"=>$projetId));
        $result = $stmt->fetchAll();
        
        return $result;	
	}

	public function AddEnseignantProjet($projetId, $enseignantId)
	{
		include '../notation/Includes/connect.php';

		$stmt = $conn->prepare("INSERT INTO projetenseignant VALUES (:PROJETID, :ENSID)");
		$result = $stmt->execute(array("PROJETID"=>$projetId, "ENSID"=>$enseignantId));
		return $result;
	}

	public function login($email, $password) {
		include '../notation/Includes/connect.php';

	    // Using prepared statements means that SQL injection is not possible. 
	    if ($stmt = $conn->prepare("SELECT id, nom, password FROM personne WHERE email = :EMAIL LIMIT 1")) {
	        $stmt->execute(array("EMAIL"=>$email));    // Execute the prepared query.
	        $row = $stmt->fetch(PDO::FETCH_ASSOC); 
	        // get variables from result.
	        $user_id = $row['id'];

	        $nom = $row['nom'];
	        $db_password = $row['password'];
	 
	        if ($stmt->rowCount() == 1) {
	            // If the user exists we check if the account is locked
	            // from too many login attempts 
	 
	            if ($this->checkbrute($user_id) == true) {
	                // Account is locked 
	                // Send an email to user saying their account is locked
	                return 0;
	            } else {
	                // Check if the password in the database matches
	                // the password the user submitted. We are using
	                // the password_verify function to avoid timing attacks.
	                if (password_verify($password, $db_password)) {
	                    // Get the user-agent string of the user.
	                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
	                    // XSS protection as we might print this value
	                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
	                    $_SESSION['id'] = $user_id;
	                    // XSS protection as we might print this value

	                    $_SESSION['nom'] = $nom;
	                    $_SESSION['login_string'] = hash('sha512', 
	                              $db_password . $user_browser);
	                    // Login successful.
	                    return 1;
	                } else {
	                    $now = time();
	                    $conn->query("INSERT INTO login_attempts(user_id, time)
	                                    VALUES ('$user_id', '$now')");
	                    // Password is not correct
	                    return 2;
	                    //return false;
	                }
	            }
	        } else {
	            // No user exists.
	            return 3;
	            //return false;
	        }
	    }
	}

	public function IsResponsable()
	{
		include '../notation/Includes/connect.php';

		$idCheck = isset($_SESSION['id']) ? $_SESSION['id'] : '';
		
		$result = $conn->prepare("SELECT * from enseignant e INNER JOIN personne p on e.personneId = p.id WHERE p.id = :ID");
		$result->execute(array("ID"=>$idCheck));
		$row = $result->fetch(PDO::FETCH_ASSOC);

        $estResponsable = $row['responsable'];

        return $estResponsable;
	}

	public function checkbrute($user_id) {
		include '../notation/Includes/connect.php';

	    // Get timestamp of current time 
	    $now = time();
	 
	    // All login attempts are counted from the past 2 hours. 
	    $valid_attempts = $now - (2 * 60 * 60);
	 
	    if ($stmt = $conn->prepare("SELECT time 
	                             FROM login_attempts 
	                             WHERE user_id = :USERID
	                            AND time > '$valid_attempts'")) {
	        // Execute the prepared query. 
	        $stmt->execute(array("USERID"=>$user_id));
	        $stmt->fetchAll(); 
	        // If there have been more than 5 failed logins 
	        if ($stmt->rowCount() > 5) {
	            return true;
	        } else {
	            return false;
	        }
	    }
	}

	public function IsLogged()
	{
		include '../notation/Includes/connect.php';
		
		$idCheck = isset($_SESSION['id']) ? $_SESSION['id'] : '';

		$result = $conn->prepare("SELECT * FROM personne WHERE id= :IDCHECK");
        $result->execute(array("IDCHECK"=>$idCheck));

        $row = $result->fetch(PDO::FETCH_ASSOC);
        $num = $result->rowCount();

        $_SESSION['id'] = $row['id'];
		
		if($num > 0)
        {
            return $_SESSION['id'];
        }
        else
        {
            $conn = null; 
            print '------not logged in-------';
            return;   
        }

	}

	public function registerCheck($email) {

		include '../notation/Includes/connect.php';

		if ($stmt = $conn->prepare("SELECT id FROM personne WHERE email = :EMAIL LIMIT 1")) {
        $stmt->execute(array("EMAIL"=>$email));
 
	        if ($stmt->rowCount() == 1) {
	            //$error_msg .= '<p class="error">A user with this email address already exists.</p>';
	            $stmt->closeCursor();
	            //Utilisateur avec le meme Email exist deja
	            return 1;
	        }
	    } else {
	        //$error_msg .= '<p class="error">Database error Line 39</p>';
	        $stmt->closeCursor();
	        return;
	    }
	 
	}

	public function register($nom, $prenom, $email, $password){
		include '../notation/Includes/connect.php';

		$insert_stmt = $conn->prepare("INSERT INTO personne (nom, prenom, email, password) VALUES (:NOM, :PRENOM, :EMAIL, :PASSWORD)");
		$result = $insert_stmt->execute(array("NOM"=>$nom, "PRENOM"=>$prenom, "EMAIL"=>$email, "PASSWORD"=>$password));
        $last_id = $conn->lastInsertId();
        $responsable = 0;
        if (! $result) {
        	return false;
        }
        $stmt = $conn->prepare("INSERT INTO enseignant (personneId, responsable) VALUES (:PERSONNEID, :RESPONSABLE)");
        $stmt->execute(array("PERSONNEID"=>$last_id, "RESPONSABLE"=>$responsable));
        
        return true;
        
    }

}

?>