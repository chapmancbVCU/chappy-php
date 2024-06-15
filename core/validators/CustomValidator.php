<?php
namespace Core\Validators;
use \Exception;

/**
 * Abstract parent class for our child validation child classes.  Each child 
 * class must implement the runValidation() function.
 */
abstract class CustomValidator {
    public $field;
    protected $_model;
    public $message = '';
    public $rule;
    public $success = true;
    
    /**
     * Constructor for Custom Validator
     *
     * @param string $model The name of the model we want to perform 
     * validation when submitting a form.
     * @param array $params A list of values obtained from an input when a 
     * form is submitted during a post action.
     */
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

    /**
     * Signature for the runValidation function that must be implemented by 
     * each child class.
     *
     * @return void
     */
    abstract public function runValidation();
}