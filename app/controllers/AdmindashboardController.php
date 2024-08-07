<?php
namespace App\Controllers;
use Core\Controller;

/**
 * Implements support for our Home controller.  Functions found in this class 
 * will support tasks related to the home page.
 */
class AdmindashboardController extends Controller {
    /** 
     * The default action for this controller.  It performs rendering of this 
     * site's home page.
     * 
     * @return void
     */
    public function indexAction(): void {
        echo "hi";
        //$this->view->render('admindashboard/index');
    }
}