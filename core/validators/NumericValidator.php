<?php
namespace Core\Validators;
use Core\Validators\CustomValidator;
/**
 * Child class that performs validation for fields than only accept numeric 
 * values.
 */
class NumericValidator extends CustomValidator {
    /**
     * Implements the abstract function of the same name from the parent 
     * class.  Enforces requirement where a field must contain a number.
     *
     * @return void Returns true if value is a numeric value.  Otherwise, we 
     * return false.
     */
    public function runValidation() {
        $value = $this->_model->{$this->field};
        $pass = true;
        if(!empty($value)) {
            $pass = is_numeric($value);
        }
        return $pass;
    }
}