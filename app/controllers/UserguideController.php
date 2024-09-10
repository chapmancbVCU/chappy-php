<?php
namespace App\Controllers;
use Core\Controller;

class UserguideController extends Controller {
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

    /**
     * Implements Model class' onConstruct function.
     *
     * @return void
     */
    public function onConstruct(): void {
        $this->view->setLayout('docs');
    }

    public function userProfilesAction(): void {
        $this->view->render('userguide/user_profiles');
    }

    public function validationAction(): void {
        $this->view->render('userguide/validation');
    }
    
}