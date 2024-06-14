<?php
namespace App\Controllers;
use Core\Controller;

class HomeController extends Controller {
    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
    }

    /** Optional array of params can be passed into an action function as an 
     *  array. */
    public function indexAction() {
        $this->view->render('home/index');
    }

    public function testAjaxAction(){
        $resp = ['success'=>true,'data'=>['id'=>23,'name'=>'Curtis','favorite_food'=>'bread']];
        $this->jsonResponse($resp);
      }
}