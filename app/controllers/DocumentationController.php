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

    /**
     * Action for the Contacts Controller class documentation page.
     *
     * @return void
     */
    public function contactsControllerAction() {
        $this->view->render('documentation/contacts_controller_docs');
    }

    /**
     * Action for the Controller classes documentation page.
     *
     * @return void
     */
    public function controllersAction() {
        $this->view->render('documentation/controllers_docs');
    }

    /**
     * Action for the Core Classes documentation page.
     *
     * @return void
     */
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

    /**
     * Action for the Home Controller class documentation page.
     *
     * @return void
     */
    public function homeControllerAction() {
        $this->view->render('documentation/home_controller_docs');
    }
    /**
     * Action for the JavaScript documentation page.
     *
     * @return void
     */
    public function javaScriptAction() {
        $this->view->render('documentation/java_script_docs');
    }

    /**
     * Action for the Model classes documentation page.
     *
     * @return void
     */
    public function modelsAction() {
        $this->view->render('documentation/models_docs');
    }
}