<?php

class EnseignantGateway {

	public function login($email, $password) {
		include '../notation/Includes/connect.php';

	    // Using prepared statements means that SQL injection is not possible. 
	    if ($stmt = $conn->prepare("SELECT id, nom, username, password 
	        FROM personne
	       WHERE email = :EMAIL
	        LIMIT 1")) {
	        $stmt->execute(array("EMAIL"=>$email));    // Execute the prepared query.
	        $row = $stmt->fetch(PDO::FETCH_ASSOC); 
	        // get variables from result.
	        $user_id = $row['id'];
	        $username = $row['username'];
	        $nom = $row['nom'];
	        $db_password = $row['password'];
	 
	        if ($stmt->rowCount() == 1) {
	            // If the user exists we check if the account is locked
	            // from too many login attempts 
	 
	            if ($this->checkbrute($user_id) == true) {
	                // Account is locked 
	                // Send an email to user saying their account is locked
	                return false;
	            } else {
	                // Check if the password in the database matches
	                // the password the user submitted. We are using
	                // the password_verify function to avoid timing attacks.
	                if (password_verify($password, $db_password)) {
	                    // Password is correct!
	                    // Get the user-agent string of the user.
	                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
	                    // XSS protection as we might print this value
	                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
	                    $_SESSION['id'] = $user_id;
	                    // XSS protection as we might print this value
	                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", 
	                                                                "", 
	                                                                $username);
	                    $_SESSION['username'] = $username;
	                    $_SESSION['nom'] = $nom;
	                    $_SESSION['login_string'] = hash('sha512', 
	                              $db_password . $user_browser);
	                    // Login successful.
	                    return true;
	                } else {
	                    // Password is not correct
	                    print 'Mot de passe incorrect';
	                    // We record this attempt in the database
	                    $now = time();
	                    $conn->query("INSERT INTO login_attempts(user_id, time)
	                                    VALUES ('$user_id', '$now')");
	                    return false;
	                }
	            }
	        } else {
	            // No user exists.
	            print 'user n existe';
	            return false;
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

	public function login_check() {
		include '../notation/Includes/connect.php';
	    // Check if all session variables are set 
	    if (isset($_SESSION['id'], 
	                        $_SESSION['username'], 
	                        $_SESSION['login_string'])) {
	 
	        $user_id = $_SESSION['id'];
	        $login_string = $_SESSION['login_string'];
	        $username = $_SESSION['username'];
	 
	        // Get the user-agent string of the user.
	        $user_browser = $_SERVER['HTTP_USER_AGENT'];
	 
	        if ($stmt = $conn->prepare("SELECT password 
	                                      FROM personne 
	                                      WHERE id = :ID LIMIT 1")) {
	            $stmt->execute(array("ID"=>$user_id));   // Execute the prepared query.
	 
	            if ($stmt->rowCount() == 1) {
	                // If the user exists get variables from result.
	                $row = $stmt->fetch(PDO::FETCH_ASSOC); 

	                $password = $row['password'];

	                $login_check = hash('sha512', $password . $user_browser);
	 
	                if (hash_equals($login_check, $login_string) ){
	                    // Logged In!!!! 
	                    return true;
	                } else {
	                    // Not logged in 
	                    return false;
	                }
	            } else {
	                // Not logged in 
	                return false;
	            }
	        } else {
	            // Not logged in 
	            return false;
	        }
	    } else {
	        // Not logged in 
	        return false;
	    }
	}

/*
	public function Login($nom, $motDePasse)
	{
		include '../notation/Includes/connect.php';
		
		try {
			$nom = isset($_POST['nom']) ? $_POST['nom'] : '';
			$motDePasse = isset($_POST['motDePasse']) ? $_POST['motDePasse'] : '';

			$query = $conn->prepare("SELECT * FROM personne WHERE nom=:NOM");
			$query->execute(array("NOM"=>$nom));
			
			$num = $query->rowCount();

			$checkMDP = $nom;
			if($num > 0)
			{
				if($motDePasse==$checkMDP)
				{
					$_SESSION['nom'] = $nom;
					$_SESSION['start'] = time(); 
            		$_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
					print 'element exist';
					return 1;
				} else 
				{
					print 'Mot de passe incorrect';
				}
			}
			else
			{
				print 'element doesnt exist';
			}
		} catch (Exception $e) {
            print 'caught exception'. $e->getMessage();
		}
	}


	public function IsLogged()
	{
		include '../notation/Includes/connect.php';
		
		$nomCheck = isset($_SESSION['nom']) ? $_SESSION['nom'] : '';

		$result = $conn->prepare("SELECT * FROM personne WHERE nom= :NOMCHECK");
        $result->execute(array("NOMCHECK"=>$nomCheck));

        $row = $result->fetch(PDO::FETCH_ASSOC);
        $num = $result->rowCount();

        $nomSession =$row['nom'];

        
        $_SESSION['id'] = $row['id'];
		
		if($num > 0)
        {
            print 'Session nom' .$nomSession. 'id : '.$_SESSION['id'];
            return $_SESSION['id'];
        }
        else
        {
            $conn = null; 
            print '------not logged in-------';
            return;   
        }

	}



*/
	


}

?>