<?php
include_once 'db_connect.php';
include_once 'psl-config.php';
 
$error_msg = "";
 
if (isset($_POST['nom'],$_POST['prenom'],$_POST['username'], $_POST['email'], $_POST['p'])) {
    $nom = filter_input(INPUT_POST, 'nom');
    $prenom = filter_input(INPUT_POST, 'prenom');
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_msg .= '<p class="error">The email address you entered is not valid</p>';
    }
 
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        $error_msg .= '<p class="error">Invalid password configuration.</p>';
    }
 
    if ($stmt = $conn->prepare("SELECT id FROM personne WHERE email = :EMAIL LIMIT 1")) {
        $stmt->execute(array("EMAIL"=>$email));
 
        if ($stmt->rowCount() == 1) {
            $error_msg .= '<p class="error">A user with this email address already exists.</p>';
            $stmt->closeCursor();
        }
    } else {
        $error_msg .= '<p class="error">Database error Line 39</p>';
        $stmt->closeCursor();
    }
 
    if ($stmt = $conn->prepare("SELECT id FROM personne WHERE username = :USERNAME LIMIT 1")) {
        $stmt->execute(array("USERNAME"=>$username));
        if ($stmt->rowCount() == 1) {
            $error_msg .= '<p class="error">A user with this username already exists</p>';
            $stmt->closeCursor();
        }
    } else {
            $error_msg .= '<p class="error">Database error line 55</p>';
            $stmt->closeCursor();
    }
 
    // TODO: 
    // We'll also have to account for the situation where the user doesn't have
    // rights to do registration, by checking what type of user is attempting to
    // perform the operation.
 
    if (empty($error_msg)) {
 
        // Create hashed password using the password_hash function.
        // This function salts it with a random salt and can be verified with
        // the password_verify function.
        $password = password_hash($password, PASSWORD_BCRYPT);
 
        // Insert the new user into the database 
        if ($insert_stmt = $conn->prepare("INSERT INTO personne (nom, prenom, username, email, password) VALUES (:NOM, :PRENOM, :USERNAME, :EMAIL, :PASSWORD)")) {

            // Execute the prepared query.
            if (! $insert_stmt->execute(array("NOM"=>$nom, "PRENOM"=>$prenom, "USERNAME"=>$username, "EMAIL"=>$email, "PASSWORD"=>$password))) {
                header('Location: ../error.php?err=Registration failure: INSERT');
            }
        }
        header('Location: ./register_success.php');
    }
}
?>