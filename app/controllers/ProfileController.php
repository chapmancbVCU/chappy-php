<?php
namespace App\Controllers;
use Core\Controller;
use Core\Router;
use App\Models\Users;
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

    public function indexAction(): void {
        $user = Users::currentUser();

        if(!$user) {
            Router::redirect('');
        }
        $this->view->user = $user;
        $this->view->render('profile/index');
    }

    public function editAction(string $id): void {
        $user = Users::currentUser();
        
        if(!$user) Router::redirect('');
        if($this->request->isPost()) {
            $this->request->csrfCheck();
            $user->assign($this->request->get());
            if($user->save()) {
                Router::redirect('profile');
            }
        }

        $this->view->displayErrors = $user->getErrorMessages();
        $this->view->user = $user;
        $this->view->postAction = PROOT . 'profile' . DS . 'edit' . DS . $user->id;
        $this->view->render('profile/edit');
    }

}