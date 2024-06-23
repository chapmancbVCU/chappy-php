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
     * Action for the Controller classes documentation page.
     *
     * @return void
     */
    public function controllersAction() {
        $this->view->render('documentation/controllers_docs');
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
     * Action for the Contacts Model class documentation page.
     *
     * @return void
     */
    public function contactsModelAction() {
        $this->view->render('documentation/contacts_model_docs');
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
     * Action for the Home Controller class documentation page.
     *
     * @return void
     */
    public function homeControllerAction() {
        $this->view->render('documentation/home_controller_docs');
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
     * Action for the JavaScript documentation page.
     *
     * @return void
     */
    public function javaScriptAction() {
        $this->view->render('documentation/java_script_docs');
    }

    /**
     * Action for the Login Model class documentation page.
     *
     * @return void
     */
    public function loginModelAction() {
        $this->view->render('documentation/login_model_docs');
    }

    /**
     * Action for the Model classes documentation page.
     *
     * @return void
     */
    public function modelsAction() {
        $this->view->render('documentation/models_docs');
    }

    /**
     * Action for the Register Controller classes documentation page.
     *
     * @return void
     */
    public function registerControllerAction() {
        $this->view->render('documentation/register_controller_docs');
    }

    /**
     * Action for the Register Controller classes documentation page.
     *
     * @return void
     */
    public function restrictedControllerAction() {
        $this->view->render('documentation/restricted_controller_docs');
    }

    /**
     * Action for the Users Model class documentation page.
     *
     * @return void
     */
    public function usersModelAction() {
        $this->view->render('documentation/users_model_docs');
    }

    /**
     * Action for the UserSessions Model class documentation page.
     *
     * @return void
     */
    public function userSessionsModelAction() {
        $this->view->render('documentation/user_sessions_model_docs');
    }
}