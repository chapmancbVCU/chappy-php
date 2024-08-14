<?php
namespace App\Controllers;
use Core\{Controller, Router, Session};
use App\Models\{ACL, Users};
use Core\Helper;
/**
 * Implements support for our Admindashboard controller.
 */
class AdmindashboardController extends Controller {

    /**
     * Undocumented function
     *
     * @param integer $id
     * @return void
     */
    public function deleteAction(int $id): void {
        $user = Users::findById((int)$id, Users::currentUser()->id);
        if($user && $user->acl != '["Admin"]') {
            $user->delete();
            Session::addMessage('success', 'User has been deleted');
        } else {
            Session::addMessage('danger', 'Cannot delete Admin user!');
        }
        Router::redirect('admindashboard');
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function detailsAction($id): void {
        $user = Users::findById($id);
        $this->view->user = $user;
        $this->view->render('admindashboard/details');
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function editAction($id): void {
        $user = Users::findById($id);
        $this->view->user = $user;

        // Setup acl data.
        $acls = ACL::getOptionsForForm($user->acl);
        $this->view->acls = $acls;
        $this->view->aclId = Users::aclToId(ACL::trimACL($user->acl), $acls);
        
        if($this->request->isPost()) {
            $this->request->csrfCheck();
            $user->assign($this->request->get(), Users::blackListedFormKeys);
            $this->view->user->acl = Users::idToAcl($_POST['acl'], $acls);
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

    /**
     * Undocumented function
     *
     * @return void
     */
    public function onConstruct(): void {
        $this->view->setLayout('admin');
        $this->currentUser = Users::currentUser();
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
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