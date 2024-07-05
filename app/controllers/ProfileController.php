<?php
namespace App\Controllers;
use Core\Controller;
use Core\Router;
use App\Models\Users;
use Core\Helper;

/**
 * Undocumented class
 */
class ProfileController extends Controller {
    /**
     * Constructor for Profile Controller.
     *
     * @param string $controller The name of the controller obtained while 
     * parsing the URL.
     * @param string $action The name of the action specified in the path of 
     * the URL.
     */
    public function __construct(string $controller, string $action) {
        parent::__construct($controller, $action);
    }

    public function editAction(): void {
        $user = Users::currentUser();
        if(!$user) Router::redirect('');
        if($this->request->isPost()) {
            $this->request->csrfCheck();
            $user->assign($this->request->get());
            if($user->save()) {
                Router::redirect('profile/index');
            }
        }
        $this->view->displayErrors = $user->getErrorMessages();
        $this->view->user = $user;
        $this->view->postAction = PROOT . 'profile' . DS . 'edit' . DS . $user->id;
        $this->view->render('profile/edit');
    }

    public function editProfileImageAction(): void {
        $user = Users::currentUser();
        if(!$user) Router::redirect('');
        if($this->request->isPost()) {
            $this->request->csrfCheck();
            $user->assign($this->request->get());
            $fileTypes = ['png', 'jpg', 'gif', 'bmp'];
            $user->profileImage = $user->processFile($_FILES, "profileImage", $user->username, $fileTypes, $user->profileImage);
            if($user->save()) {
                Router::redirect('profile/index');
            }
        }
        $this->view->displayErrors = $user->getErrorMessages();
        $this->view->user = $user;
        $this->view->postAction = PROOT . 'profile' . DS . 'edit_profile_image' . DS . $user->id;
        $this->view->render('profile/edit_profile_image');
    }

    public function indexAction(): void {
        $user = Users::currentUser();

        if(!$user) {
            Router::redirect('');
        }
        $this->view->user = $user;
        $this->view->render('profile/index');
    }

    public function updatePasswordAction(): void {
        $user = Users::currentUser();
        if(!$user) Router::redirect('');
        if($this->request->isPost()) {
            $this->request->csrfCheck();
            $user->assign($this->request->get());
            $user->setChangePassword(true);
            $user->setConfirm($this->request->get('confirm'));
            if($user->save()) {
                Router::redirect('profile/index');
                $user->setChangePassword(false);
            }
        }
        $this->view->displayErrors = $user->getErrorMessages();
        $this->view->user = $user;
        $this->view->postAction = PROOT . 'profile' . DS . 'update_password' . DS . $user->id;
        $this->view->render('profile/update_password');
    }

}