<?php
$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <head>
        <title>
          <?php print htmlentities($title) ?>
        </title>

        <link href="Public/css/style-authentification.css" rel="stylesheet">

</head>

<body>

  <div class="container">
    <div class="row">
      <div class="col-md-offset-3 col-md-6 col-xs-12">

        	<div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Bien D&eacute;connect&eacute;!</strong> <br/> 
            <p>Retour &agrave; <a href="index.php">la page d'accueil</a></p>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
