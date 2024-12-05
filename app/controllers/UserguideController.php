<?php
namespace App\Controllers;
use Core\Controller;

class UserguideController extends Controller {
    public function aclAction(): void {
        $this->view->render('userguide/acl');
    }
    public function administrationAction(): void {
        $this->view->render('userguide/administration');
    }
    public function consoleAction(): void {
        $this->view->render('userguide/console');
    } 
    public function contactManagementAction(): void {
        $this->view->render('userguide/contact_management');
    }

    public function controllersAction(): void {
        $this->view->render('userguide/controllers');
    }

    public function databaseAction(): void {
        $this->view->render('userguide/database');
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

    public function javascriptAction(): void {
        $this->view->render('userguide/javascript');
    }

    public function loginSystemAction(): void {
        $this->view->render('userguide/login_system');
    }

    public function modelsAction(): void {
        $this->view->render('userguide/models');
    }

    /**
     * Implements Model class' onConstruct function.
     *
     * @return void
     */
    public function onConstruct(): void {
        $this->view->setLayout('docs');
    }

    public function phpunitAction(): void {
        $this->view->render('userguide/phpunit');
    }

    public function sessionMessagesAction(): void {
        $this->view->render('userguide/session_messages');
    }

    public function uploadsAction(): void {
        $this->view->render('userguide/uploads');
    }
    public function userProfilesAction(): void {
        $this->view->render('userguide/user_profiles');
    }

    public function validationAction(): void {
        $this->view->render('userguide/validation');
    }
    
    public function viewsAction(): void {
        $this->view->render('userguide/views');
    }
}