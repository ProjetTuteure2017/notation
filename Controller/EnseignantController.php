<?php

class EnseignantController{
	
	function __construct()
	{	
	}

	public function HandleRequest() {

        $op = isset($_GET['op']) ? $_GET['op'] : NULL;

        try {
            if (!$op || $op== 'ens') {
            	$this->Page();
            } else if($op == 'resp') {
                $this->ResponsablePage();
            } else{
                $this->ShowError("Page not found", "Page for operation ".$op." was not found!");
            }
        } catch (Exception $e ) {
            
            $this->ShowError("Application error", $e->GetMessage());
        }
    }

    public function Page()
    {
    	$title = 'Home | Enseignant';

    	include 'View/enseignant-page.php';
    }

    public function ResponsablePage()
    {
    	$title = 'Home | Responsable';

    	include 'View/responsable-page.php';
    }

}


?>