<?php
namespace App\Controllers;
use Core\{Controller, Router};
use App\Models\{ACL, Users};
use Core\Helper;
/**
 * Implements support for our Admindashboard controller.
 */
class AdmindashboardController extends Controller {

    public function detailsAction($id): void {
        $user = Users::findUserById($id);
        $this->view->user = $user;
        $this->view->render('admindashboard/details');
    }

    public function editAction($id): void {
        $user = Users::findUserById($id);
        $this->view->user = $user;

        // Setup acl data.
        $acls = ACL::getOptionsForForm($user->acl);
        $this->view->acls = $acls;
        $this->view->aclId = Users::aclToId(ACL::trimACL($user->acl), $acls);
        
        if($this->request->isPost()) {
            $this->request->csrfCheck();
            $user->assign($this->request->get(), Users::blackListedFormKeys);
            $this->view->user->acl = Users::idToAcl($_POST['acl'], ACL::getOptionsForForm($user->acl));
            if($user->save()) {
                Router::redirect('admindashboard/details/'.$this->view->user->id);
            }
        }

        $this->view->displayErrors = $user->getErrorMessages();
        $this->view->postAction = APP_DOMAIN . 'admindashboard' . DS . 'edit' . DS . $user->id;
        $this->view->render('admindashboard/edit');
    }

    /** 
     * The default action for this controller.  It performs rendering of this 
     * site's home page.
     * 
     * @return void
     */
    public function indexAction(): void {
        $users = Users::findAllUsers($this->currentUser->id);
        $this->view->users = $users;
        $this->view->render('admindashboard/index');
    }

    public function onConstruct()
    {
        $this->view->setLayout('admin');
        $this->currentUser = Users::currentUser();
    }

    public function setResetPasswordAction($id) {
        $user = Users::findById($id);
        $this->view->user = $user;
        
        if($this->request->isPost()) {
            $this->request->csrfCheck();
            $user->assign($this->request->get(), Users::blackListedFormKeys);
            $user->reset_password = ($this->request->get('reset_password') == 'on') ? 1 : 0;
            if($user->save()) {
                Router::redirect('admindashboard/details/'.$this->view->user->id);
            }
        }
        $this->view->displayErrors = $user->getErrorMessages();
        $this->view->postAction = APP_DOMAIN . 'admindashboard' . DS . 'setResetPassword' . DS . $user->id;
        $this->view->render('admindashboard/set_reset_password');
    }
}