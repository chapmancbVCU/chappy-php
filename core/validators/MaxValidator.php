<?php
namespace Core\Validators;
use Core\Validators\CustomValidator;
/**
 * Child class that performs validation for the maximum length of a value for
 * a field.
 */
class MaxValidator extends CustomValidator {
    /**
     * Implements the abstract function of the same name from the parent 
     * class.  Enforces maximum length requirements for a form field.
     *
     * @return void
     */
    public function runValidation() {
        $value = $this->_model->{$this->field};
        $pass = (strlen($value) <= $this->rule);
        return $pass;
    }
}