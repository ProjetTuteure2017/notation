<?php
sec_session_start();
?> 
<!DOCTYPE html>
<html lang="fr">

<head>
  <title>
    <?php print htmlentities($title) ?>
  </title>

  <link href="Public/css/style-authentification.css" rel="stylesheet">
  <script type="text/JavaScript" src="Public/js/sha512.js"></script> 
  <script type="text/JavaScript" src="Public/js/forms.js"></script> 

</head>

<body>
  <div class="container">
 
      <?php

      if($check == true) {
        print '<div class="row">';
        print '<div class="col-lg-12 col-md-12 col-sm-12">';
        print '<div class="alert alert-dismissible alert-info">';
        print '<button type="button" class="close" data-dismiss="alert">&times;</button>';
        print "<h4>Vous &ecirc;tes d&eacute;ja connect&eacute; !</h4>";
        print '<a href="index.php?op=logout">Se d&eacute;connecter</a>';
        print '</div>';
        print '</div>';
        print '</div>';
      } else { 

    ?>
    <div class="login-container">
      <div id="output"></div>
      <div>
        <h3>Se connecter :</h3>
        <?php 
          if ( $errors ) {
          print '<div class="row">';
          print '<div class="col-lg-12 col-md-12 col-sm-12">';
          print '<div class="alert alert-dismissible alert-danger">';
          print '<button type="button" class="close" data-dismiss="alert">&times;</button>';
            foreach ( $errors as $field => $error ) {
                print '<strong>'.htmlentities($error).'</strong>';
            }
          print '</div>';
          print '</div>';
          print '</div>';
        }
        ?>
        <hr/>
      </div>
      <div class="form-box">
        <form role="form" method="POST" action="" name="login_form">
              <input type="text" name="email" placeholder="Email">
              <div class="password">
                <input type="password" id="password" name="password" placeholder="Mot de passe"/>
                <a onclick="show()" id="filtersubmit"><i class="fa fa-eye"></i></a>
              </div>
              <input type="submit" value="Se connecter" class="btn btn-primary" onclick="formhash(this.form, this.form.password);"/>
        </form>
      </div>

    </div>
    
    <script type="text/javascript">
      function show() {
        var a=document.getElementById("password");
        if (a.type=="password")  {
          a.type="text";
        }
        else {
          a.type="password";
        }
        }
    </script>

    <?php
  }
    ?>
  </div>


</body>
</html>