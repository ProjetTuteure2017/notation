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
                <div class="col-lg-8 col-md-8 col-lg-offset-2 col-md-offset-2 col-sm-12">
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
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div id="mydiv">
                        <div class="panel panel-compte">
                            <div class="panel-heading">
                                <h5>Ajouter une grille</h5>
                                <hr>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        
                                        <form role="form" method="POST" action="" style="display : block;">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="titre" value="<?php print htmlentities($titre) ?>" placeholder="Titre">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="note_sur" value="<?php print htmlentities($note_sur) ?>" placeholder="Not&eacute; sur">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="coef" value="<?php print htmlentities($coef) ?>" placeholder="Coef">
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6 col-sm-offset-3">
                                                        <input type="hidden" name="form-submitted" value="1" />
                                                        <input type="submit" value="Valider" tabindex="4" class="form-control btn btn-primary"/>
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
