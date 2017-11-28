<?php

class ProjetGateway {

	public function SelectAll($enseignantId) {

		include '../notation/connect.php';
        $stmt = $conn->prepare('SELECT * from projet where enseignantId= :ENSEIGNANTID');
        $stmt->execute(array(':enseignantId'=>$enseignantId));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result['description'];	
	}

	public function Insert($description, $enseignantId) {
        include '../notation/connect.php';
        
        $description = isset($_POST['description'])?$_POST['description']:NULL;
        
        $stmt = $conn->prepare('INSERT INTO projet (description, enseignantId) VALUES (:DESCRIPTION, :ENSEIGNANTID)');
        $stmt->execute(array(":DESCRIPTION"=>$description,
                            ":ENSEIGNANTID"=>$enseignantId));

    }
}

?>