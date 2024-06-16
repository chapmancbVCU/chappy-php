<?php
namespace App\Controllers;
use Core\Controller;

/**
 * Controller for actions that involve content related to user guides and 
 * documentation.
 */
class DocumentationController extends Controller {
    /**
     * Constructor for the Documentation Controller
     *
     * @param string $controller The name of the controller obtained while 
     * parsing the URL.
     * @param string $action The name of the action specified in the path of 
     * the URL.
     */
    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
        $this->view->setLayout('default');
    }

    public function coreAction() {
        $this->view->render('documentation/core_docs');
    }

    /** 
     * The default action for this controller.  It performs rendering of this 
     * site's documentation page.
     * 
     * @return void
     */
    public function indexAction() {
        $this->view->render('documentation/index');
    }

    
}