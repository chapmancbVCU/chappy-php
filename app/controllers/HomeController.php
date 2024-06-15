<?php
namespace App\Controllers;
use Core\Controller;

/**
 * Implements support for our Home controller.  Functions found in the class 
 * will support tasks related to the home page.
 */
class HomeController extends Controller {
    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
    }

    /** 
     * The default action for this controller.  It performs rendering of this 
     * site's home page.
     * 
     * @return void
     */
    public function indexAction() {
        $this->view->render('home/index');
    }

    /**
     * Demonstration for an Ajax request.
     *
     * @return void
     */
    public function testAjaxAction(){
        $resp = ['success'=>true,'data'=>['id'=>23,'name'=>'Curtis','favorite_food'=>'bread']];
        $this->jsonResponse($resp);
      }
}