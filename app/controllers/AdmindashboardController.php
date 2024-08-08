<?php
namespace App\Controllers;
use Core\Controller;
use App\Models\Users;
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

    public function detailsAction($id): void {
        $user = Users::findUserById($id);
        $this->view->user = $user;
        $this->view->render('admindashboard/details');
    }
}