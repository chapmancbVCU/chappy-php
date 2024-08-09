<?php
namespace App\Controllers;
use Core\Controller;
use App\Models\{ACL, Users};
use Core\Helper;
/**
 * Implements support for our Home controller.  Functions found in this class 
 * will support tasks related to the home page.
 */
class AdmindashboardController extends Controller {
    public function onConstruct()
    {
        $this->view->setLayout('admin');
        $this->currentUser = Users::currentUser();
    }

    public function detailsAction($id): void {
        $user = Users::findUserById($id);
        $this->view->user = $user;
        $this->view->render('admindashboard/details');
    }

    public function editAction($id): void {
        $user = Users::findUserById($id);
        $acl = new ACL();
        $this->view->acls = ACL::getOptionsForForm($user->acl);
        $this->view->user = $user;
        $this->view->aclId = Users::aclToId(ACL::trimACL($user->acl), $this->view->acls);
        
        if($this->request->isPost()) {
            $this->request->csrfCheck();
            // $acls->assign($th)
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

    
}