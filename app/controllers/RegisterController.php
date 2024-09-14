<?php
namespace App\Controllers;
use Core\{Controller, Helper, Router, Session};
use App\Models\{Login, ProfileImages, Users};
use App\Lib\Utilities\Uploads;

/**
 * Implements support for our Register controller.  Functions found in this 
 * class will support tasks related to the user registration.
 */
class RegisterController extends Controller {
    
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
                    if($user->inactive == 1) {
                        Session::addMessage('danger', 'Account is currently inactive');
                        Router::redirect('register/login');
                    } 
                    $remember = $loginModel->getRememberMeChecked();
                    $user->login_attempts = 0;
                    $user->save();
                    $user->login($remember);
                    Router::redirect('');
                }  else {
                    if($user) {
                        $loginModel = Users::loginAttempts($user, $loginModel);
                    }
                    else {
                        $loginModel->addErrorMessage('username','There is an error with your username or password');
                    }
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

    public function onConstruct(): void {
        $this->view->setLayout('default');
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
            $files = $_FILES['profileImage'];
            if($files['tmp_name'] != '') {
                $uploads = new Uploads($files, ProfileImages::getAllowedFileTypes(), 
                    ProfileImages::getMaxAllowedFileSize(), false, ROOT.DS);
                
                $uploads->runValidation();
                $imagesErrors = $uploads->validates();
                if(is_array($imagesErrors)){
                    $msg = "";
                    foreach($imagesErrors as $name => $message){
                        $msg .= $message . " ";
                    }
                    $newUser->addErrorMessage('profileImage', trim($msg));
                }
            }

            $newUser->assign($this->request->get());
            $newUser->confirm = $this->request->get('confirm');
            $newUser->acl = Users::setAclAtRegistration();
            $newUser->save();
            if($newUser->validationPassed()) {
                if($uploads) {
                    ProfileImages::uploadProfileImage($newUser->id, $uploads);
                }
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
            
            if($user->save()) {
                // PW change mode off.
                $user->reset_password = 0;
                $user->setChangePassword(false);    
                Router::redirect('register/login');
            }
        }

        $user->setChangePassword(false);
        $this->view->displayErrors = $user->getErrorMessages();
        $this->view->user = $user;
        $this->view->postAction = APP_DOMAIN . 'register' . DS . 'reset_password' . DS . $user->id;
        $this->view->render('register/reset_password');
    }
}