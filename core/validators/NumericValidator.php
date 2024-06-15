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
     * class.
     *
     * @return void
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