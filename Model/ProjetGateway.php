<?php

class ProjetGateway {

	public function SelectAll($enseignantId) {

		include '../notation/connect.php';
        $stmt = $conn->prepare('SELECT * from projet where enseignantId= :ENSEIGNANTID');
        $stmt->execute(array(':enseignantId'=>$enseignantId));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result;	
	}

	public function Insert($titre, $description, $enseignantId) {
        include '../notation/connect.php';
        
        $description = isset($_POST['description'])?$_POST['description']:NULL;
        $titre = isset($_POST['titre'])?$_POST['titre']:NULL;
        
        $stmt = $conn->prepare('INSERT INTO projet (titre, description, enseignantId) VALUES (:TITRE, :DESCRIPTION, :ENSEIGNANTID)');
        $stmt->execute(array(":TITRE"=>$titre,
        					":DESCRIPTION"=>$description,
                            ":ENSEIGNANTID"=>$enseignantId));

    }
}

?>