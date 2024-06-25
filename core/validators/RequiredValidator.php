<?php
namespace Core\Validators;
use Core\Validators\CustomValidator;
/**
 * Child class that performs validation for fields that are required.
 */
class RequiredValidator extends CustomValidator {
    /**
     * Implements the abstract function of the same name from the parent 
     * class.  Enforces the required requirement for a field.
     *
     * @return void Returns true if the value is set.  If the value is empty 
     * we return false.
     */
    public function runValidation() {
        $value = $this->_model->{$this->field};
        $passes = (!empty($value));
        return $passes;
    }
}