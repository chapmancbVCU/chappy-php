<?php
namespace App\Models;
use Core\Model;
use Core\Validators\RequiredValidator;

/**
 * Extends the Model class.  Supports functions for the Login model.
 */
class Login extends Model {
    public $password;
    public $remember_me;
    public $username;

    /**
     * Constructor for the Login class.  There is no controller for the Login 
     * model.
     */
    public function __construct() {
        parent::__construct('tmp_fake');
    }

    /**
     * Returns result for remember me checkbox so user stays logged in if it's
     * checked.
     *
     * @return void
     */
    public function getRememberMeChecked() {
        return $this->remember_me == 'on';
    }

    /**
     * Performs form validation checks for the login screen.
     *
     * @return void
     */
    public function validator() {
        $this->runValidation(new RequiredValidator($this, ['field' => 'username', 'message' => 'Username is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'password', 'message' => 'Password is required']));
    }
}