<?php
namespace App\Models;
use Core\Model;
use Core\Validators\RequiredValidator;
use Core\Validators\MaxValidator;

class Contacts extends Model {
    public $address;
    public $address2;
    public $cell_phone;
    public $city;
    public $deleted = 0;
    public $email;
    public $fname;
    public $home_phone;
    public $id;
    public $lname;
    public $state;
    public $user_id;
    public $work_phone;
    public $zip;

    public function __construct() {
        $table = 'contacts';
        parent::__construct($table);
        $this->_softDelete = true;
    }

    public function displayAddress() {
        $address = '';
        if(!empty($this->address)) {
            $address .= $this->address . '<br>';
        }
        if(!empty($this->address2)) {
            $address .= $this->address2 . '<br>';
        }
        if(!empty($this->city)) {
            $address .= $this->city . ', ';
        }
        $address .= $this->state . ' ' .  $this->zip . '<br>';

        return $address;
    }

    public function displayAddressLabel() {
        $html = $this->displayName() . '<br>';
        $html .= $this->displayAddress();
        return $html;
    }

    public function displayName() {
        return $this->fname . ' ' . $this->lname;
    }

    public function findAllByUserId($user_id, $params = []) {
        $conditions = [
            'conditions' => 'user_id = ?',
            'bind' => [$user_id]
        ];

        // In case you want to add more conditions
        $conditions = array_merge($conditions, $params);
        return $this->find($conditions);
    }

    public function findByIdAndUserId($contact_id, $user_id, $params = []) {
        $conditions = [
            'conditions' => 'id = ? AND user_id = ?',
            'bind' => [$contact_id, $user_id]
        ];
        $conditions = array_merge($conditions, $params);
        return $this->findFirst($conditions);
    }

    public function validator() {
        $this->runValidation(new RequiredValidator($this, ['field' => 'fname', 'message' => 'First Name is required']));
        $this->runValidation((new MaxValidator($this, ['field' => 'fname', 'message' => 'First Name must be less than 156 characters.', 'rule' => 155])));

        $this->runValidation(new RequiredValidator($this, ['field' => 'lname', 'message' => 'Last Name is required']));
        $this->runValidation((new MaxValidator($this, ['field' => 'lname', 'message' => 'Last Name must be less than 156 characters.', 'rule' => 155])));

        
    }
}