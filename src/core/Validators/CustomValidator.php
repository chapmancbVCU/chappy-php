<?php
namespace Core\Validators;
use \Exception;
use Core\Helper;
use Core\Lib\Utilities\Arr;
/**
 * Abstract parent class for our child validation child classes.  Each child 
 * class must implement the runValidation() function.
 * @abstract
 */
abstract class CustomValidator {
    public $additionalFieldData = [];
    public $field;
    public $includeDeleted = false;
    protected $_model;
    public $message = '';
    public $rule;
    public $success = true;
    
    /**
     * Constructor for Custom Validator.  It performs checks on the model and 
     * params such as fields, rules, and messages.  Finally the validation is 
     * performed against input from a form.  An exception is thrown if any 
     * conditions are not satisfied.  When an exception is thrown a message 
     * is displayed describing the issue.
     *
     * @param object $model The name of the model we want to perform 
     * validation when submitting a form.
     * @param array $params A list of values obtained from an input when a 
     * form is submitted during a post action.
     */
    public function __construct(object $model, array $params) {

        $this->_model = $model;

        if(!Arr::exists($params, 'field')) {
            throw new Exception("You must add a field to the params array.");
        } else {
        if(is_array($params['field'])) {
            $this->field = $params['field'][0];
            array_shift($params['field']);
            $this->additionalFieldData = $params['field'];
        } else {
            $this->field = $params['field'];
        }
        }

        if(!property_exists($model, $this->field)) {
            throw new Exception("The field must exist in the model");
        }

        if(!Arr::exists($params, 'message')) {
            throw new Exception("You must add a msg to the params array.");
        } else {
            $this->message = $params['message'];
        }

        if(Arr::exists($params, 'rule',)) {
            $this->rule = $params['rule'];
        }

        if(Arr::exists($params, 'includeDeleted') && $params['includeDeleted']) {
            $this->includeDeleted = true;
        }

        try {
            $this->success = $this->runValidation();
        } catch(Exception $e) {
            echo "Validation Exception on " . get_class() . ": " . $e->getMessage() . "<br />";
        }
    }

    /**
     * Signature for the runValidation function that must be implemented by 
     * each child class.
     *
     * @return void
     * @abstract
     */
    abstract public function runValidation();
}