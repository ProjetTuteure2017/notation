<?php
include_once 'Includes/functions.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>
        <?php print htmlentities($title); ?>
        </title>
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
        <ul>
            <li>Usernames may contain only digits, upper and lowercase letters and underscores</li>
            <li>Emails must have a valid email format</li>
            <li>Passwords must be at least 6 characters long</li>
            <li>Passwords must contain
                <ul>
                    <li>At least one uppercase letter (A..Z)</li>
                    <li>At least one lowercase letter (a..z)</li>
                    <li>At least one number (0..9)</li>
                </ul>
            </li>
            <li>Your password and confirmation must match exactly</li>
        </ul>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div id="mydiv">
                        <div class="panel panel-compte">
                            <div class="panel-heading">
                                <h5>S'enregistrer</h5>
                                <hr>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <form action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post" name="registration_form" style="display: block;">
                                            <div class="form-group">
                                                <input type="text" name="nom" id="nom" placeholder="Nom" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="prenom" id="prenom" placeholder="Prenom" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="username" id="username" placeholder="Nom d'utilisateur" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="email" id="email" placeholder="Email" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" id="password" placeholder="Mot de passe" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="confirmpwd" id="confirmpwd" placeholder="Confirmation mot de passe" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <input type="submit" value="Register" 
                                                           onclick="return regformhash(this.form, this.form.nom, this.form.prenom,
                                                                           this.form.username,
                                                                           this.form.email,
                                                                           this.form.password,
                                                                           this.form.confirmpwd);" /> 
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
        </div>
    </body>
</html>