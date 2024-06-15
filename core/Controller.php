<?php
namespace Core;
use Core\Application;

/**
 * This is the parent Controller class.  It describes functions that are 
 * available to all classes that extends this Controller class.
 */
class Controller extends Application {
    protected $_action;
    protected $_controller;
    public $request;
    public $view;

    /**
     * Constructor for the parent Controller class.  This constructor gets 
     * called when an instance of the child class is instantiated.
     *
     * @param string $controller The name of the controller obtained while 
     * parsing the URL.
     * @param string $action The name of the action specified in the path of 
     * the URL.
     */
    public function __construct($controller, $action) {
        parent::__construct();
        $this->_controller = $controller;
        $this->_action = $action;
        $this->request = new Input();
        $this->view = new View();
    }

    /**
     * Sample jsonResponse for supporting AJAX requests.
     *
     * @param string $res The JSON response.
     * @return void
     */
    public function jsonResponse($res){
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        http_response_code(200);
        echo json_encode($res);
        exit;
    }
    
    /**
     * Loads the model provided to this controller.
     *
     * @param string $model The name of the model that we will used.
     * @return void
     */
    protected function load_model($model) {
        $modelPath = 'App\Models\\' . $model;
        if(class_exists($modelPath)) {
            $this->{$model.'Model'} = new $modelPath();
        }
    }
}