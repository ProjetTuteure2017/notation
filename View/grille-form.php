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
                    <div class="panel panel-compte">
                        <div class="panel-heading">
                            <h5>Ajout grille</h5>
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
                                        
                                            <label for="note">Note:</label><br/>
                                            <input type="text" name="note" value="<?php print htmlentities($note) ?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="coef">Coef:</label><br/>
                                            <input type="text" name="coef" value="<?php print htmlentities($coef) ?>" />
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
