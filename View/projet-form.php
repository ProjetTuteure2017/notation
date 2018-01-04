<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>
        <?php print htmlentities($title) ?>
        </title>
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
                <div class="col-md-12 col-xs-12">
                    <?php     
                        if(!isset($_SESSION['nom']))
                        {
                            print '<div class="alert alert-dismissible alert-warning">';
                            print '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                            print "<h4>Vous n'&ecirc;tes pas connecter!</h4>";
                            print '<a href="index.php?op=login">Se connecter</a>';
                            print '</div>';

                            exit();
                        }

                        $enseignantId = isset($_SESSION['id'])? $_SESSION['id']:NULL;

                    ?>
                    <div class="panel panel-compte">
                        <div class="panel-heading">
                            <h5>Ajout projet</h5>
                            <hr>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <form method="POST" action="" style="display : block;">
                                        <div class="form-group">

                                            <label for="titre">Titre:</label><br/>
                                            <input type="text" name="titre" value="<?php print htmlentities($titre) ?>"/>
                                        </div>
                                        <div class="form-group">
                                        
                                            <label for="description">Description:</label><br/>
                                            <input type="text" name="description" value="<?php print htmlentities($description) ?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="enseignantId">Enseignant:</label><br/>
                                            <input type="text" name="enseignantId" value="<?php print htmlentities($enseignantId) ?>" />
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="form-submitted" value="1" />
                                            <input type="submit" value="Valider" />
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
