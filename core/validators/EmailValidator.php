<?php
namespace Core\Validators;
use Core\Validators\CustomValidator;
/**
 * Child class that performs validation for E-mail fields.
 */
class EmailValidator extends CustomValidator {
    /**
     * Implements the abstract function of the same name from the parent 
     * class.
     *
     * @return void
     */
    public function runValidation() {
        $email = $this->_model->{$this->field};
        $pass = true;
        if(!empty($email)) {
            $pass = filter_var($email, FILTER_VALIDATE_EMAIL);
        }
        return $pass;
    }
}