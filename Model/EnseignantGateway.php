<?php

class EnseignantGateway {

	public function Login($nom, $motDePasse)
	{
		include '../notation/connect.php';
		
		try {
			$nom = isset($_POST['nom']) ? $_POST['nom'] : '';
			$motDePasse = isset($_POST['motDePasse']) ? $_POST['motDePasse'] : '';

			$query = $conn->prepare("SELECT * FROM personne WHERE nom=:NOM");
			$query->execute(array("NOM"=>$nom));
			
			$num = $query->rowCount();

			$checkMDP = $nom;
			if($num > 0)
			{
				if($motDePasse==$checkMDP)
				{
					$_SESSION['nom'] = $nom;
					$_SESSION['start'] = time(); // Taking now logged in time.
            		// Ending a session in 30 minutes from the starting time.
            		$_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
					print 'element exist';
					return 1;
				} else 
				{
					print 'Mot de passe incorrect';
				}
			}
			else
			{
				print 'element doesnt exist';
			}
		} catch (Exception $e) {
            print 'caught exception'. $e->getMessage();
		}
	}

	public function IsLogged()
	{
		include '../notation/connect.php';
		
		$nomCheck = isset($_SESSION['nom']) ? $_SESSION['nom'] : '';

		$result = $conn->prepare("SELECT * FROM personne WHERE nom= :NOMCHECK");
        $result->execute(array("NOMCHECK"=>$nomCheck));

        $row = $result->fetch(PDO::FETCH_ASSOC);
        $num = $result->rowCount();

        $nomSession =$row['nom'];

        
        $_SESSION['id'] = $row['id'];
		
		if($num > 0)
        {
            print 'Session nom' .$nomSession. 'id : '.$_SESSION['id'];
            return $_SESSION['id'];
        }
        else
        {
            $conn = null; 
            print '------not logged in-------';
            return;   
        }

	}

	public function IsResponsable()
	{
		include '../notation/connect.php';

		$nomCheck = isset($_SESSION['nom']) ? $_SESSION['nom'] : '';
		
		$result = $conn->prepare("SELECT * from enseignant e INNER JOIN personne p on e.personneId = p.id WHERE p.nom = :NOMCHECK");
		$result->execute(array("NOMCHECK"=>$nomCheck));
		$row = $result->fetch(PDO::FETCH_ASSOC);

        $estResponsable = $row['responsable'];

        return $estResponsable;
	}

}

?>