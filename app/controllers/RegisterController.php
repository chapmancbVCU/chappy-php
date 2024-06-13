<?php
class RegisterController extends Controller {
    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
        $this->load_model('Users');
        $this->view->setLayout('default');
    }

    public function loginAction() {
        $validation = new Validate();

        if($_POST) {
            // Form validation
            $validation->check($_POST, [
                'username' => [
                    'display' => "Username",
                    'required' => true
                ],
                'password' => [
                    'display' => 'Password',
                    'required' => true,
                    'min' => 6
                ]
            ], true);

            if($validation->passed()) {
                $user = $this->UsersModel->findByUsername($_POST['username']);
                if($user && password_verify(Input::get('password'), $user->password)) {
                    $remember = (isset($_POST['remember_me']) && Input::get('remember_me')) ? true : false;
                    $user->login($remember);
                    Router::redirect('');
                } else {
                    $validation->addError("There is an error with your username or password.");
                }
            }
        }
        $this->view->displayErrors = $validation->displayErrors();
        $this->view->render('register/login');
    }

    public function logoutAction() {
        if(Users::currentUser()) {
            Users::currentUser()->logout();
        }
        Router::redirect(('register/login'));
    }

    public function registerAction() {
        $newUser = new Users();
        if($_POST) {

            // $validation->check($_POST, [
            //     'fname' => [
            //         'display' => 'First Name',
            //         'required' => true
            //     ],
            //     'lname' => [
            //         'display' => 'Last Name',
            //         'required' => true
            //     ],
            //     'username' => [
            //         'display' => 'Username',
            //         'required' => true,
            //         'unique' => 'users',
            //         'min' => 6,
            //         'max' => 150
            //     ],
            //     'email' => [
            //         'display' => 'E-mail',
            //         'required' => true,
            //         'unique' => 'users',
            //         'max' => 150,
            //         'valid_email' => true
            //     ],
            //     'password' => [
            //         'display' => 'Password',
            //         'required' => true,
            //         'min' => 6
            //     ],
            //     'confirm' => [
            //         'display' => 'Confirm Password',
            //         'required' => true,
            //         'matches' => 'password'
            //     ]
            // ], true);

            $newUser->assign($_POST);
            if($newUser->save()) {
                Router::redirect('register/login');
            }
        }

        $this->view->newUser = $newUser;
        $this->view->displayErrors = $newUser->getErrorMessages();
        $this->view->render('register/register');
    }
}