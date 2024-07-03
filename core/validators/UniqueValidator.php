<?php
namespace Core\Validators;
use Core\Validators\CustomValidator;
/**
 * Child class that performs validation for fields that require a unique entry 
 * in a database.
 */
class UniqueValidator extends CustomValidator {
    /**
     * Implements the abstract function of the same name from the parent 
     * class.  Enforces requirement for a field.
     *
     * @return bool Returns true if value is not associated with a record's 
     * field that we are targeting in a database.  Otherwise, we return false.
     */
    public function runValidation(): bool {
        $field = (is_array($this->field)) ? $this->field[0] : $this->field;
        $value = $this->_model->{$field};

        $conditions = ["{$field} = ?"];
        $bind = [$value];

        // Check updating record.
        if(!empty($this->_model->id)) {
            $conditions = "id != ?";
            $bind[] = $this->_model->id;
        }

        // This allows you to check multiple fields for uniqueness.
        if(is_array($this->field)) {
            array_unshift($this->field);
            foreach($this->field as $adds) {
                $conditions[] = "{$adds} = ?";
                $bind[] = $this->_model->{$adds};
            }
        }

        $queryParams = ['conditions' => $conditions, 'bind' => $bind];
        $other = $this->_model->findFirst($queryParams);
        return(!$other);
    }
}