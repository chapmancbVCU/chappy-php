<?php
class UniqueValidator extends CustomValidator {
    public function runValidation() {
        $field = (is_array($this->field)) ? $this->field[0] : $this->field;
        $value = $this->_model->{$field};

        $conditions = ["{$field} = ?"];
        $bind = [$value];

        // Check updating record.
        if(!empty($this->_model->id)) {
            $conditions = "id = ?";
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