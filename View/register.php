<?php
include_once 'Includes/functions.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
        <?php print htmlentities($title); ?>
        </title>
        <script type="text/JavaScript" src="Public/js/sha512.js"></script> 
        <script type="text/JavaScript" src="Public/js/forms.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div id="mydiv">
                        <div class="panel panel-compte">
                            <div class="panel-heading">
                                <h5>Ajouter un enseignant</h5>
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
                                <hr>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <form action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post" name="registration_form" style="display: block;">
                                            <div class="row">
                                                <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <input type="text" name="nom" id="nom" placeholder="Nom" class="form-control">
                                                </div>
                                                <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <input type="text" name="prenom" id="prenom" placeholder="Prenom" class="form-control">
                                                </div>
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
                                                <div class="alert alert-dismissible alert-warning">
                                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                    <p class="mb-0"><i class="fas fa-exclamation-triangle" style="color: #fff; margin-right: 10px;"></i>Le mot de passe doit comporter au moins 6 caractères( au moins : un chiffre, une lettre minuscule et une majuscule ).</p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <input type="submit" class="form-control btn btn-primary" tabindex="4" value="Valider" 
                                                           onclick="return regformhash(this.form, this.form.nom, this.form.prenom,
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