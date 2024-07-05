<?php
namespace App\Controllers;
use Core\Controller;

class UserguideController extends Controller {
    /**
     * Constructor for the UserGuide Controller
     *
     * @param string $controller The name of the controller obtained while 
     * parsing the URL.
     * @param string $action The name of the action specified in the path of 
     * the URL.
     */
    public function __construct(string $controller, string $action) {
        parent::__construct($controller, $action);
        $this->view->setLayout('default');
    }

    /** 
     * The default action for this controller.  It performs rendering of this 
     * site's user guide page.
     * 
     * @return void
     */
    public function indexAction(): void {
        $this->view->render('userguide/index');
    }
}