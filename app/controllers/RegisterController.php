<?php
namespace App\Controllers;
use Core\Controller;
use Core\Router;
use App\Models\Users;
use App\Models\Login;
use Core\Helper;
/**
 * Implements support for our Register controller.  Functions found in this 
 * class will support tasks related to the user registration.
 */
class RegisterController extends Controller {
    public function onConstruct(){
        $this->view->setLayout('default');
    }

    /**
     * Manages login action processes.
     *
     * @return void
     */
    public function loginAction(): void {
        $loginModel = new Login();
        if($this->request->isPost()) {
            // form validation
            $this->request->csrfCheck();
            $loginModel->assign($this->request->get());
            $loginModel->validator();
            if($loginModel->validationPassed()){
                $user = Users::findByUsername($_POST['username']);
                if($user && password_verify($this->request->get('password'), $user->password)) {
                    if($user->reset_password == 1) {
                        Router::redirect('register/resetPassword/'.$user->id);
                    }
                    $remember = $loginModel->getRememberMeChecked();
                    $user->login($remember);

                    Router::redirect('');
                }  else {
                    $loginModel->addErrorMessage('username','There is an error with your username or password');
                }
            }
        }
        $this->view->login = $loginModel;
        $this->view->displayErrors = $loginModel->getErrorMessages();
        $this->view->render('register/login');
    }

    /**
     * Manages logout action for a user.  It checks if a user is currently 
     * logged.  No matter of the result, the user gets redirected to the 
     * login screen.
     *
     * @return void
     */
    public function logoutAction(): void {
        if(Users::currentUser()) {
            Users::currentUser()->logout();
        }
        Router::redirect(('register/login'));
    }

    /**
     * Manages actions related to user registration.
     *
     * @return void
     */
    public function registerAction(): void {
        $newUser = new Users();
        if($this->request->isPost()) {
            $this->request->csrfCheck();
            $newUser->assign($this->request->get());
            $newUser->confirm = $this->request->get('confirm');
            // Accepted file types.
            $fileTypes = ['png', 'jpg', 'gif', 'bmp'];  
            $newUser->profileImage = $newUser->processFile($_FILES, "profileImage", $newUser->username, "", "images", $fileTypes);
            $newUser->acl = Users::setAclAtRegistration();
            if($newUser->save()) {
                Router::redirect('register/login');
            }
        }

        $this->view->newUser = $newUser;
        $this->view->displayErrors = $newUser->getErrorMessages();
        $this->view->render('register/register');
    }

    public function resetPasswordAction($id): void {
        $user = Users::findById($id);
        $user->password = "";
        
        if(!$user) Router::redirect('');
        if($this->request->isPost()) {
            $this->request->csrfCheck();
            $user->assign($this->request->get(), Users::blackListedFormKeys);
            
            // PW mode on for correct validation.
            $user->setChangePassword(true);
            
            // Allows password matching confirmation.
            $user->confirm = $this->request->get('confirm');
            //{
               // $user->resetPassword = 0;
            //}
            
            if($user->save()) {
                // PW change mode off.
                $user->setChangePassword(false);    
                Router::redirect('register/login');
            }
        }
        $user->resetPassword = 1;
        $user->setChangePassword(false);
        $this->view->displayErrors = $user->getErrorMessages();
        $this->view->user = $user;
        $this->view->postAction = APP_DOMAIN . 'register' . DS . 'reset_password' . DS . $user->id;
        $this->view->render('register/reset_password');
    }
}