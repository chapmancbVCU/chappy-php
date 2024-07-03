<?php 
namespace App\Controllers;
use Core\Controller;

/**
 * Implements support for the Restricted controller.  Interactions that the 
 * user performs that are restricted will result in a relevant view being 
 * rendered.
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
    public function __construct(string $controller, string $action) {
        parent::__construct($controller, $action);
    }

    /**
     * Renders page when a bad csrf token is detected.
     *
     * @return void
     */
    public function badTokenAction(): void {
        $this->view->render('restricted/badToken');
    }
    
    /**
     * This controller's default action.
     *
     * @return void
     */
    public function indexAction(): void {
        $this->view->render('restricted/index');
    }
}