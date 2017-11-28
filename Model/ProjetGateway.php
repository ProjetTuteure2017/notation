<?php

class ProjetGateway {

	public function SelectAll($enseignantId) {
		include '../notation/connect.php';

        $stmt = $conn->prepare('SELECT * from projet where enseignantId= :ENSEIGNANTID');
        $stmt->execute(array(':ENSEIGNANTID'=>$enseignantId));
        $result = $stmt->fetch();
        
        return $result;	
	}

	public function Insert($titre, $description, $enseignantId) {
        include '../notation/connect.php';
        
        $titre = isset($_POST['titre']) ? $_POST['titre'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $enseignantId = isset($_POST['enseignantId']) ? $_POST['enseignantId'] : '';
        
        $stmt = $conn->prepare("INSERT INTO projet (titre, description, enseignantId) VALUES (:TITRE, :DESCRIPTION, :ENSEIGNANTID)");
        $stmt->execute(array(":TITRE"=>$titre,
        					":DESCRIPTION"=>$description,
                            ":ENSEIGNANTID"=>$enseignantId));

    }
}

?>