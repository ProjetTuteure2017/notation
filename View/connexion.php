<!DOCTYPE html>
<html lang="fr">

<head>
  <title>
    <?php print htmlentities($title) ?>
  </title>

  <link href="Public/css/style-authentification.css" rel="stylesheet">
  <script src="Public/js/script-authentification.js"></script>
  
</head>

<body>
 
      <?php
        if ( $errors ) {
            print '<ul class="errors">';
            foreach ( $errors as $field => $error ) {
                print '<li>'.htmlentities($error).'</li>';
            }
            print '</ul>';
        }
      ?>

  <div class="container">
    <div class="login-container">
      <div id="output"></div>
      <div class="avatar"></div>

      <div class="form-box">
        <form role="form" method="POST" action="">
              <input type="text" name="nom" value="<?php print htmlentities($nom) ?>" placeholder="Nom">
              <div class="password">
                <input type="password" id="motDePasse" name="motDePasse" value="<?php print htmlentities($motDePasse) ?>" placeholder="Mot de passe">
                <span class="glyphicons glyphicons-eye-open"></span>
              </div>
              <input type="hidden" name="form-submitted" value="1" />
              <input type="submit" value="Se connecter" tabindex="4" class="form-control btn btn-primary"/>
        </form>
      </div>

    </div>
  </div>


</body>
</html>
