<?php
namespace App\Controllers;
use Core\Controller;

class UserguideController extends Controller {
    /**
     * Constructor for the UserGuide Controller
     *
     * @param string $controller The name of the controller obtained while 
     * parsing the URL.
     * @param string $action The name of the action specified in the path of 
     * the URL.
     */
    public function __construct(string $controller, string $action) {
        parent::__construct($controller, $action);
        $this->view->setLayout('default');
    }

    public function contactManagementAction(): void {
        $this->view->render('userguide/contact_management');
    }

    public function formsAction(): void {
        $this->view->render('userguide/forms');
    } 

    public function gettingStartedAction(): void {
        $this->view->render('userguide/getting_started');
    }

    /** 
     * The default action for this controller.  It performs rendering of this 
     * site's user guide page.
     * 
     * @return void
     */
    public function indexAction(): void {
        $this->view->render('userguide/index');
    }

    public function loginSystemAction(): void {
        $this->view->render('userguide/login_system');
    }

    public function userProfilesAction(): void {
        $this->view->render('userguide/user_profiles');
    }

    public function validationAction(): void {
        $this->view->render('userguide/validation');
    }
    
}