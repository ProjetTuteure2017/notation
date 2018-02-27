<?php

class ProjetGateway {

	public function SelectAll($enseignantId) {
		include '../notation/Includes/connect.php';

        $stmt = $conn->prepare("SELECT * FROM projet WHERE enseignantId= :ENSEIGNANTID");
        $stmt->execute(array('ENSEIGNANTID'=>$enseignantId));
        $result = $stmt->fetchAll();
        
        return $result;	
	}

	public function Ajouter($titre, $description, $enseignantId) {
        include '../notation/Includes/connect.php';
        
        $titre = isset($_POST['titre']) ? $_POST['titre'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $enseignantId = isset($_SESSION['id']) ? $_SESSION['id'] : '';
        
        $stmt = $conn->prepare("INSERT INTO projet (titre, description, enseignantId) VALUES (:TITRE, :DESCRIPTION, :ENSEIGNANTID)");
        $stmt->execute(array("TITRE"=>$titre,"DESCRIPTION"=>$description,"ENSEIGNANTID"=>$enseignantId));
    }

    public function Modifier($id, $titre, $description)
    {
        include '../notation/Includes/connect.php';

        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $titre = isset($_POST['titre']) ? $_POST['titre'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';

        $stmt = $conn->prepare("UPDATE projet SET titre = :TITRE, description = :DESCRIPTION WHERE id = :ID");
        $stmt->execute(array("TITRE"=>$titre, "DESCRIPTION"=>$description, "ID"=>$id));
    }
	
	public function SelectProject($groupeId){
		
		include '../notation/Includes/connect.php';

		$stmt = $conn->prepare("SELECT projetId FROM groupe WHERE id = :GROUPEID");

		$stmt->execute(array("GROUPEID"=>$groupeId));
		$result = $stmt->fetchAll();

		return $result;
	}
	
}

?>