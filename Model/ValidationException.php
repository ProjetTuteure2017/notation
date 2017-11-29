<?php


class ValidationException extends Exception {
    
    private $errors = NULL;
    
    public function __construct($errors) {
        parent::__construct("Validation error!");
        $this->errors = $errors;
    }
    
    
    public function getErrors() {
        return $this->errors;
    }
    
}

?>
