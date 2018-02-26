<!DOCTYPE html>
<html lang="fr">

<head>
  <title>
    <?php print htmlentities($title) ?>
  </title>

  <link href="Public/css/style-authentification.css" rel="stylesheet">
  <link rel="stylesheet" href="Public/font-awesome/css/font-awesome.min.css">
  
  <script src="Public/js/script-authentification.js"></script>
  <script type="text/JavaScript" src="Public/js/sha512.js"></script> 
  <script type="text/JavaScript" src="Public/js/forms.js"></script> 

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
      <div>
        <h3>Se connecter :</h3>
        <hr/>
      </div>
      <div class="form-box">
        <form role="form" method="POST" action="" name="login_form">
              <input type="text" name="email" placeholder="Email">
              <div class="password">
                <input type="password" id="password" name="password" placeholder="Mot de passe"/>
                <i id="filtersubmit" class="fa fa-eye"></i>
              </div>
              <input type="submit" value="Se connecter" class="btn btn-primary" onclick="formhash(this.form, this.form.password);"/>
        </form>
      </div>

    </div>
  </div>


</body>
</html>