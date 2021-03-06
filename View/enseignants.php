<?php
sec_session_start();
?> 
<!DOCTYPE html>
<html>
<head>
    <title>
        <?php print htmlentities($title); ?>
    </title>

</head>

<body>
    <div class="container">
        <?php 
            if($check == true) {
                $enseignantId = isset($_SESSION['id'])? $_SESSION['id']:NULL;
        ?>

        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-8">
                <h4>S&eacute;l&eacute;ctionnez un enseignant :</h4>
                <form method="post" action="">
                    <div class="input-group">
                        <select class="custom-select" id="selectEnseignant" name="selectEnseignant">
                            <option value="-1" selected="selected">Veuillez selectionner un enseignant...</option>
                            <?php 
                                foreach ($enseignants as $enseignant) : 
                                    print '<option value="'.$enseignant['id'].'">';
                                    print htmlentities($enseignant['nom']).'</option>';
                                endforeach; 
                            ?>
                        </select>
                        <div class="input-group-append">
                            <button type="button submit" class="btn btn-outline-primary">S&eacute;l&eacute;ctionner</button>
                        </div>
                    </div>
                </form>
                <script type="text/javascript">
            document.getElementById('selectEnseignant').value = "<?php echo isset($_POST['selectEnseignant']) ? $_POST['selectEnseignant'] : "-1";?>";
                </script>
            </div>
        </div>
        <div class="row" style="margin-top: 10px; margin-bottom: -10px;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <p>Cr&eacute;er le profil d'<a href="http://notation/index.php?page=enseignant&op=register&projetId=<?php echo $_GET['projetId']?>">un nouveau enseignant.</a></p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <h4>Les enseignants dans ce projet : </h4>
            </div>
            <div style="margin-top: 10px;" class="col-lg-12 col-md-12 col-sm-12">
                <div class="list-group">
                    <?php 
                        foreach ($ensbyprojet as $value) {
                            print '<ol>';
                            print $value['nom'];
                            print '</ol>';
                        }

                    ?>
                </div>
            </div>
        </div>

        <?php 
      } else { 
        print '<div class="row">';
        print '<div class="col-lg-12 col-md-12 col-sm-12">';
        print '<div class="alert alert-dismissible alert-warning">';
        print '<button type="button" class="close" data-dismiss="alert">&times;</button>';
        print "<h4>Vous n'&ecirc;tes pas connecter!</h4>";
        print '<a href="index.php?op=login">Se connecter</a>';
        print '</div>';
        print '</div>';
        print '</div>';
      } 
        ?>
    </div>

</body>
</html>