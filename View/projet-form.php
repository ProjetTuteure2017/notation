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
        <form method="POST" action="">
            <label for="titre">titre:</label><br/>
            <input type="text" name="titre" value="<?php print htmlentities($titre) ?>"/>
            <br/>
            
            <label for="description">description:</label><br/>
            <input type="text" name="description" value="<?php print htmlentities($description) ?>"/>
            <br/>
            <label for="enseignantId">Enseignant:</label><br/>
            <input type="text" name="enseignantId" value="<?php print htmlentities($enseignantId) ?>" />
           
            <br/>
            <input type="hidden" name="form-submitted" value="1" />
            <input type="submit" value="Submit" />
        </form>
        
    </body>
</html>
