<!DOCTYPE html>
<html lang="fr">

<head>
  <title>
    <?php print htmlentities($title) ?>
  </title>

  <link href="Public/css/style-authentification.css" rel="stylesheet">

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
    <div class="row">
      <div class="col-md-offset-3 col-md-6 col-xs-12">
        <?php     
          if(isset($_SESSION['nom']))
          {
          print '<div class="alert alert-dismissible alert-info">';
          print '<button type="button" class="close" data-dismiss="alert">&times;</button>';
          print '<h4>Vous etes deja connecter!</h4>';
          print '</div>';

          exit();
          }

        ?>
        <div class="panel panel-compte">
          <div class="panel-heading">
            <h5>Login</h5>
            <hr>
          </div>

          <div class="panel-body">
            <div class="row">
              <div class="col-lg-12">

                <form role="form" method="POST" action="" style="display: block;">
                  <div class="form-group">
                      <input type="text" class="form-control" name="nom" value="<?php print htmlentities($nom) ?>" placeholder="Enter nom">
                  </div>
                  <div class="form-group">
                      <input type="password" class="form-control" name="motDePasse" value="<?php print htmlentities($motDePasse) ?>" placeholder="Enter Mot de passe">
                  </div>
                  <div class="form-group">        
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="hidden" name="form-submitted" value="1" />
                        <input type="submit" value="Submit" tabindex="4" class="form-control btn btn-authen"/>
                      </div>
                    </div>
                  </div>
                </form>

              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

</body>
</html>
