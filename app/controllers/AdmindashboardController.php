<?php
namespace App\Controllers;
use Core\{Controller, Router, Session};
use App\Models\{ACL, ProfileImages, Users};
use App\Lib\Utilities\Uploads;
use Core\Helper;

/**
 * Implements support for our Admindashboard controller.
 */
class AdmindashboardController extends Controller {

    public function addAclAction(): void {
        $this->view->render('admindashboard/add_acl');
    }

    /**
     * Performs delete action.
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

    function deleteAclAction($id): void {
        $acl = ACL::findById($id);

        // Get users so we can get number using acl and update later.
        $users = Users::findUserByAcl($acl->acl)->results();
        if(count($users) > 0) {
            Session::addMessage('info', "Cannot delete ". $acl->acl. ", assigned to one or more users.");
            Router::redirect('admindashboard/manageAcls');
        }
    }
    /**
     * Deletes an image associated with a user's profile.
     *
     * @return void
     */
    function deleteImageAction(): void {
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
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function detailsAction($id): void {
        $user = Users::findById($id);
        $profileImage = ProfileImages::findCurrentProfileImage($user->id);
        $this->view->profileImage = $profileImage;
        $this->view->user = $user;
        $this->view->render('admindashboard/details');
    }

    public function editAclAction($id): void {
        $acl = ACL::findById($id);

        // Get users so we can get number using acl and update later.
        $users = Users::findUserByAcl($acl->acl)->results();
        if(count($users) > 0) {
            Session::addMessage('info', "Cannot update ". $acl->acl.", assigned to one or more users.");
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
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function editAction($id): void {
        $user = Users::findById($id);
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
            $files = $_FILES['profileImage'];
            $isFiles = $files['tmp_name'] != '';
            if($isFiles) {
                $uploads = new Uploads($files, ProfileImages::getAllowedFileTypes(), 
                    ProfileImages::getMaxAllowedFileSize(), false, ROOT.DS);
                
                $uploads->runValidation();
                $imagesErrors = $uploads->validates();
                if(is_array($imagesErrors)){
                    $msg = "";
                    foreach($imagesErrors as $name => $message){
                        $msg .= $message . " ";
                    }
                    $user->addErrorMessage('profileImage', trim($msg));
                }
            }

            $user->assign($this->request->get(), Users::blackListedFormKeys);
            $this->view->user->acl = Users::idToAcl($_POST['acl'], $acls);
            $user->save();
            if($user->validationPassed()) {
                if($isFiles) {
                    // Upload Image
                    ProfileImages::uploadProfileImage($user->id, $uploads);
                }
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
     * site's home page.
     * 
     * @return void
     */
    public function indexAction(): void {
        $users = Users::findAllUsers(Users::currentUser()->id);
        $this->view->users = $users;
        $this->view->render('admindashboard/index');
    }

    public function manageACLsAction(): void {
        $acls = ACL::getACLs();
        $this->view->acls = $acls;
        $this->view->render('admindashboard/manage_acls');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function onConstruct(): void {
        $this->view->setLayout('admin');
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function setResetPasswordAction($id) {
        $user = Users::findById($id);
        
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

    public function setStatusAction($id) {
        $user = Users::findById($id);

        if($this->request->isPost()) {
            $this->request->csrfCheck();
            $user->assign($this->request->get(), Users::blackListedFormKeys);
            $user->inactive = ($this->request->get('inactive') == 'on') ? 1 : 0;
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