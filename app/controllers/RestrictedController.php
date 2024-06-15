<?php 
namespace App\Controllers;
use Core\Controller;

/**
 * Implements support for the Restricted controller.
 */
class RestrictedController extends Controller {
    /**
     * Constructor for Restricted Controller.
     *
     * @param string $controller The name of the controller obtained while 
     * parsing the URL.
     * @param string $action The name of the action specified in the path of 
     * the URL.
     */
    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
    }

    /**
     * Renders page when a bad csrf token is detected.
     *
     * @return void
     */
    public function badTokenAction() {
        $this->view->render('restricted/badToken');
    }
    
    /**
     * This controller's default action.
     *
     * @return void
     */
    public function indexAction() {
        $this->view->render('restricted/index');
    }
}