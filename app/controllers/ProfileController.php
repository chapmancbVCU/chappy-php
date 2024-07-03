<?php
namespace App\Controllers;
use Core\Controller;
use App\Models\Users;
class ProfileController extends Controller {
    /**
     * Constructor for Profile Controller.
     *
     * @param string $controller The name of the controller obtained while 
     * parsing the URL.
     * @param string $action The name of the action specified in the path of 
     * the URL.
     */
    public function __construct(string $controller, string $action) {
        parent::__construct($controller, $action);
    }

    public function indexAction(): void {
        $user = Users::currentUser();
        $this->view->user = $user;
        $this->view->render('profile/index');
    }

}