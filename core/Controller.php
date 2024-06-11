<?php
#[AllowDynamicProperties]
class Controller extends Application {
    protected $_controller;
    protected $_action;
    public $view;

    public function __construct($controller, $action) {
        parent::__construct();

        $this->_controller = $controller;
        $this->_action = $action;
        $this->view = new View();
    }

    protected function load_model($model) {
        if(class_exists($model)) {
            $this->{$model.'Model'} = new $model(strtolower($model));
        }
    }
}