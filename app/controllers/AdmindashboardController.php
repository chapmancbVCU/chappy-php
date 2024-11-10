<?php
namespace App\Controllers;
use Core\{Controller, Router, Session};
use App\Models\{ACL, ProfileImages, Users};
use App\Lib\Utilities\UploadProfileImage;
use Core\Helper;

/**
 * Implements support for our Admindashboard controller.
 */
class AdmindashboardController extends Controller {

    /**
     * Renders add acl view and adds ACL to acl table.
     *
     * @return void
     */
    public function addAclAction(): void {
        $acl = new ACL();
        if($this->request->isPost()) {
            $this->request->csrfCheck();
            $acl->assign($this->request->get());
            if($acl->save()) {
                Session::addMessage('success', 'ACL added!');
                Router::redirect('admindashboard/manageAcls');
            }
        }

        $this->view->acl = $acl;
        $this->view->displayErrors = $acl->getErrorMessages();
        $this->view->postAction = APP_DOMAIN . 'admindashboard' . DS . 'addAcl';
        $this->view->render('admindashboard/add_acl');
    }

    /**
     * Performs delete action on a user.
     *
     * @param integer $id The id for the user we want to delete.
     * @return void
     */
    public function deleteAction(int $id): void {
        $user = Users::findById((int)$id);
        if($user && $user->acl != '["Admin"]') {
            $user->delete();
            Session::addMessage('success', 'User has been deleted.');
        } else {
            Session::addMessage('danger', 'Cannot delete Admin user!');
        }
        Router::redirect('admindashboard');
    }

    /**
     * Deletes ACL from acl table.
     *
     * @param int $id The id for the ACL we want to delete.
     * @return void
     */
    function deleteAclAction($id): void {
        $acl = ACL::findById((int)$id);

        // Get users so we can get number using acl and update later.
        $users = Users::findUserByAcl($acl->acl)->results();
        if(count($users) > 0) {
            Session::addMessage('info', "Cannot delete ". $acl->acl. ", assigned to one or more users.");
        }
        if($acl) {
            $acl->delete();
            Session::addMessage('success', 'ACL has been deleted');
        } else {
            Session::addMessage('danger', 'You do not have permission to perform this action.');
        }
        Router::redirect('admindashboard/manageAcls');
    }

    /**
     * Deletes an image associated with a user's profile.
     *
     * @return void
     */
    public function deleteImageAction(): void {
        $resp = ['success' => false];
        if($this->request->isPost()) {
            $user = Users::currentUser();
            $id = $this->request->get('image_id');
            $image = ProfileImages::findById($id);
            if($user) {
                ProfileImages::deleteById($image->id);
                $resp = ['success' => true, 'model_id' => $image->id];
            }
        }
        $this->jsonResponse($resp);
    }

    /**
     * Presents information about a particular user's profile.
     *
     * @param int $id The id of the user whose details we want to view.
     * @return void
     */
    public function detailsAction($id): void {
        $user = Users::findById((int)$id);
        $profileImage = ProfileImages::findCurrentProfileImage($user->id);
        $this->view->profileImage = $profileImage;
        $this->view->user = $user;
        $this->view->render('admindashboard/details');
    }

    /**
     * Supports ability to edit ACLs not assigned to a user through a web form.
     *
     * @param int $id The id of the ACL we want to modify.
     * @return void
     */
    public function editAclAction($id): void {
        $acl = ACL::findById((int)$id);

        // Get users so we can get number using acl and update later.
        $users = Users::findUserByAcl($acl->acl)->results();
        if(count($users) > 0) {
            Session::addMessage('danger', "Cannot update ". $acl->acl.", assigned to one or more users.");
            Router::redirect('admindashboard/manageAcls');
        }

        if($this->request->isPost()) {
            $this->request->csrfCheck();
            $acl->assign($this->request->get(), ACL::blackList);
            
            if($acl->save()) {
                Session::addMessage('info', "ACL Name updated.");
                Router::redirect('admindashboard/manageAcls');
            }
        }
        $this->view->displayErrors = $acl->getErrorMessages();
        $this->view->acl = $acl;
        $this->view->postAction = APP_DOMAIN . 'admindashboard' . DS . 'editAcl' . DS . $acl->id;
        $this->view->render('admindashboard/edit_acl');
    }

    /**
     * Supports ability for administrators to edit user profiles.
     *
     * @param int $id The id of the user whose profile we want to modify.
     * @return void
     */
    public function editAction($id): void {
        $user = Users::findById((int)$id);
        if(!$user) {
            Session::addMessage('danger', 'You do not have permission to edit this user.');
            Router::redirect('');
        }
       
        $this->view->user = $user;
        // Setup acl data.
        $acls = ACL::getOptionsForForm();
        $this->view->acls = $acls;
        $this->view->aclId = Users::aclToId(ACL::trimACL($user->acl), $acls);
        $profileImages = ProfileImages::findByUserId($user->id);
        if($this->request->isPost()) {
            $this->request->csrfCheck();
            $user->assign($this->request->get(), Users::blackListedFormKeys);
            $this->view->user->acl = Users::idToAcl($_POST['acl'], $acls);
            if($user->save()) {
                $sortOrder = json_decode($_POST['images_sorted']);
                ProfileImages::updateSortByUserId($user->id, $sortOrder);

                Router::redirect('admindashboard/details/'.$this->view->user->id);
            }
        }

        $this->view->profileImages = $profileImages;
        $this->view->displayErrors = $user->getErrorMessages();
        $this->view->postAction = APP_DOMAIN . 'admindashboard' . DS . 'edit' . DS . $user->id;
        $this->view->render('admindashboard/edit');
    }

    /** 
     * The default action for this controller.  It performs rendering of this 
     * site's admin dashboard page.
     * 
     * @return void
     */
    public function indexAction(): void {
        $users = Users::findAllUsersExceptCurrent(Users::currentUser()->id);
        $this->view->users = $users;
        $this->view->render('admindashboard/index');
    }

    public function manageACLsAction(): void {
        $acls = ACL::getACLs();
        $usedAcls = [];
        $unUsedAcls = [];
        foreach($acls as $acl) {
            if(count(Users::findUserByAcl($acl->acl)->results()) == 0) {
                array_push($usedAcls, $acl);
            } else {
                array_push($unUsedAcls, $acl);
            }
        }
        $this->view->usedAcls = $usedAcls;
        $this->view->unUsedAcls = $unUsedAcls;
        $this->view->render('admindashboard/manage_acls');
    }

    /**
     * Runs when the object is constructed.
     *
     * @return void
     */
    public function onConstruct(): void {
        $this->view->setLayout('admin');
    }

    /**
     * Support ability to toggle on or off the reset password flag for a 
     * particular user.
     *
     * @param int $id The id of the user whose reset password flag we want to 
     * modify.
     * @return void
     */
    public function setResetPasswordAction($id) {
        $user = Users::findById((int)$id);
        
        if($this->request->isPost()) {
            $this->request->csrfCheck();
            $user->assign($this->request->get(), Users::blackListedFormKeys);
            $user->reset_password = ($this->request->get('reset_password') == 'on') ? 1 : 0;
            if($user->save()) {
                Router::redirect('admindashboard/details/'.$user->id);
            }
        }

        $this->view->user = $user;
        $this->view->displayErrors = $user->getErrorMessages();
        $this->view->postAction = APP_DOMAIN . 'admindashboard' . DS . 'setResetPassword' . DS . $user->id;
        $this->view->render('admindashboard/set_reset_password');
    }

    /**
     * Sets active status for a particular user.  The administrator can 
     * toggle the setting on or off using a web form.
     *
     * @param int $id The id of the user we want to activate or inactivate.
     * @return void
     */
    public function setStatusAction($id) {
        $user = Users::findById((int)$id);

        if($this->request->isPost()) {
            $this->request->csrfCheck();
            $user->assign($this->request->get(), Users::blackListedFormKeys);
            $user->inactive = ($this->request->get('inactive') == 'on') ? 1 : 0;
            $user->login_attempts = ($user->inactive == 0) ? 0 : $user->login_attempts;
            if($user->save()) {
                Router::redirect('admindashboard/details/'.$user->id);
            }
        }

        $this->view->user = $user;
        $this->view->displayErrors = $user->getErrorMessages();
        $this->view->postAction = APP_DOMAIN . 'admindashboard' . DS . 'setStatus' . DS . $user->id;
        $this->view->render('admindashboard/set_account_status');
    }
}