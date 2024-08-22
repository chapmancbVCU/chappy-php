<?php
namespace App\Controllers;
use Core\Controller;

/**
 * Controller for actions that involve content related to user guides and 
 * documentation.
 */
class DocumentationController extends Controller {
    /**
     * Action for the Application class documentation page.
     *
     * @return void
     */
    public function aclModelAction(): void {
        $this->view->render('documentation/acl_model_docs');
    }

    /**
     * Action for the Application class documentation page.
     *
     * @return void
     */
    public function admindashboardControllerAction(): void {
        $this->view->render('documentation/admin_dashboard_controller_docs');
    }

    /**
     * Action for the Application class documentation page.
     *
     * @return void
     */
    public function applicationAction(): void {
        $this->view->render('documentation/application_docs');
    }

    /**
     * Action for the Controller class documentation page.
     *
     * @return void
     */
    public function controllerAction(): void {
        $this->view->render('documentation/controller_docs');
    }

    /**
     * Action for the Controller classes documentation page.
     *
     * @return void
     */
    public function controllersAction(): void {
        $this->view->render('documentation/controllers_docs');
    }

    /**
     * Action for the Contacts Controller class documentation page.
     *
     * @return void
     */
    public function contactsControllerAction(): void {
        $this->view->render('documentation/contacts_controller_docs');
    }

    /**
     * Action for the Contacts Model class documentation page.
     *
     * @return void
     */
    public function contactsModelAction(): void {
        $this->view->render('documentation/contacts_model_docs');
    }

    /**
     * Action for the Cookie class documentation page.
     *
     * @return void
     */
    public function cookieAction(): void {
        $this->view->render('documentation/cookie_docs');
    }

    /**
     * Action for the Core Classes documentation page.
     *
     * @return void
     */
    public function coreAction(): void {
        $this->view->render('documentation/core_docs');
    }

    /**
     * Action for the Custom Validator class documentation page.
     *
     * @return void
     */
    public function customValidatorAction(): void {
        $this->view->render('documentation/custom_validator_docs');
    }

    /**
     * Action for the DB class documentation page.
     *
     * @return void
     */
    public function dbAction(): void {
        $this->view->render('documentation/db_docs');
    }

    /**
     * Action for the Email Validator class documentation page.
     *
     * @return void
     */
    public function emailValidatorAction(): void {
        $this->view->render('documentation/email_validator_docs');
    }

    /**
     * Action for the FormHelper class documentation page.
     *
     * @return void
     */
    public function formHelperAction(): void {
        $this->view->render('documentation/form_helper_docs');
    }

    /**
     * Action for the Helper class documentation page.
     *
     * @return void
     */
    public function helperAction(): void {
        $this->view->render('documentation/helper_docs');
    }

    /**
     * Action for the Input class documentation page.
     *
     * @return void
     */
    public function InputAction(): void {
        $this->view->render('documentation/input_docs');
    }

    /**
     * Action for the Home Controller class documentation page.
     *
     * @return void
     */
    public function homeControllerAction(): void {
        $this->view->render('documentation/home_controller_docs');
    }
    
    /** 
     * The default action for this controller.  It performs rendering of this 
     * site's documentation page.
     * 
     * @return void
     */
    public function indexAction(): void {
        $this->view->render('documentation/index');
    }

    /**
     * Action for the JavaScript documentation page.
     *
     * @return void
     */
    public function javaScriptAction(): void {
        $this->view->render('documentation/java_script_docs');
    }

    /**
     * Action for the Login Model class documentation page.
     *
     * @return void
     */
    public function loginModelAction(): void {
        $this->view->render('documentation/login_model_docs');
    }

    /**
     * Action for the Lower Char Validator class documentation page.
     *
     * @return void
     */
    public function lowerCharValidatorAction(): void {
        $this->view->render('documentation/lower_char_validator_docs');
    }

    /**
     * Action for the Matches Validator class documentation page.
     *
     * @return void
     */
    public function matchesValidatorAction(): void {
        $this->view->render('documentation/matches_validator_docs');
    }

    /**
     * Action for the Max Validator class documentation page.
     *
     * @return void
     */
    public function maxValidatorAction(): void {
        $this->view->render('documentation/max_validator_docs');
    }

    /**
     * Action for the Min Validator class documentation page.
     *
     * @return void
     */
    public function migrationAction(): void {
        $this->view->render('documentation/migration_docs');
    }

    /**
     * Action for the Min Validator class documentation page.
     *
     * @return void
     */
    public function minValidatorAction(): void {
        $this->view->render('documentation/min_validator_docs');
    }

    /**
     * Action for the Application class documentation page.
     *
     * @return void
     */
    public function modelAction(): void {
        $this->view->render('documentation/model_docs');
    }

    /**
     * Action for the Model classes documentation page.
     *
     * @return void
     */
    public function modelsAction(): void {
        $this->view->render('documentation/models_docs');
    }

    /**
     * Action for the Number Validator class documentation page.
     *
     * @return void
     */
    public function numberCharValidatorAction(): void {
        $this->view->render('documentation/number_char_validator_docs');
    }

    /**
     * Action for the Numeric Validator class documentation page.
     *
     * @return void
     */
    public function numericValidatorAction(): void {
        $this->view->render('documentation/numeric_validator_docs');
    }

    /**
     * Implements Model class' onConstruct function.
     *
     * @return void
     */
    public function onConstruct(): void {
        $this->view->setLayout('docs');
    }

    /**
     * Action for the Profile Controller class documentation page.
     *
     * @return void
     */
    public function profileControllerAction(): void {
        $this->view->render('documentation/profile_controller_docs');
    }

    /**
     * Action for the Register Controller class documentation page.
     *
     * @return void
     */
    public function registerControllerAction(): void {
        $this->view->render('documentation/register_controller_docs');
    }

    /**
     * Action for the Required Validator class documentation page.
     *
     * @return void
     */
    public function requiredValidatorAction(): void {
        $this->view->render('documentation/required_validator_docs');
    }

    /**
     * Action for the Register Controller class documentation page.
     *
     * @return void
     */
    public function restrictedControllerAction(): void {
        $this->view->render('documentation/restricted_controller_docs');
    }

    /**
     * Action for the Router class documentation page.
     *
     * @return void
     */
    public function routerAction(): void {
        $this->view->render('documentation/router_docs');
    }

    /**
     * Action for the Session class documentation page.
     *
     * @return void
     */
    public function sessionAction(): void {
        $this->view->render('documentation/session_docs');
    }

    /**
     * Action for the Special Char Validator class documentation page.
     *
     * @return void
     */
    public function specialCharValidatorAction(): void {
        $this->view->render('documentation/special_char_validator_docs');
    }

    /**
     * Action for the Unique Char Validator class documentation page.
     *
     * @return void
     */
    public function uniqueCharValidatorAction(): void {
        $this->view->render('documentation/unique_char_validator_docs');
    }
    
    /**
     * Action for the  Validator class documentation page.
     *
     * @return void
     */
    public function upperCharValidatorAction(): void {
        $this->view->render('documentation/upper_char_validator_docs');
    }

    /**
     * Action for the Users Model class documentation page.
     *
     * @return void
     */
    public function usersModelAction(): void {
        $this->view->render('documentation/users_model_docs');
    }

    /**
     * Action for the UserSessions Model class documentation page.
     *
     * @return void
     */
    public function userSessionsModelAction(): void {
        $this->view->render('documentation/user_sessions_model_docs');
    }

    /**
     * Action for the View class documentation page.
     *
     * @return void
     */
    public function validatorsAction(): void {
        $this->view->render('documentation/validators_docs');
    }

    /**
     * Action for the View class documentation page.
     *
     * @return void
     */
    public function viewAction(): void {
        $this->view->render('documentation/view_docs');
    }
}