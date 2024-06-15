<?php
namespace Core\Validators;
use \Exception;

abstract class CustomValidator {
    public $field;
    protected $_model;
    public $message = '';
    public $rule;
    public $success = true;
    

    

    public function __construct($model, $params) {
        $this->_model = $model;

        if(!array_key_exists('field', $params)) {
            throw new Exception("You must add a field to the params array.");
        } else {
            $this->field = (is_array($params['field'])) ? $params['field'][0] : $params['field'];
        }

        if(!property_exists($model, $this->field)) {
            throw new Exception("The field must exist in the model");
        }

        if(!array_key_exists('message', $params)) {
            throw new Exception("You must add a message to the params array");
        } else {
            $this->message = $params['message'];
        }

        if(array_key_exists('rule', $params)) {
            $this->rule = $params['rule'];
        }

        try {
            $this->success = $this->runValidation();
        } catch(Exception $e) {
            echo "Validation Exception on " . get_class() . ": " . $e->getMessage() . "<br>";
        }
    }

    abstract public function runValidation();
}