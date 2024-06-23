<?php
namespace App\Models;
use Core\Model;
use Core\Validators\RequiredValidator;
use Core\Validators\MaxValidator;
use Core\Helper;

/**
 * Extends the Model class.  Supports functions for handling Contacts such as 
 * displaying information, form validation, and DB operations.
 */
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

    /**
     * Constructor for the Contacts class.
     */
    public function __construct() {
        $table = 'contacts';
        parent::__construct($table);
        $this->_softDelete = true;
    }

    /**
     * Formats address to conform to form factor of an address label.
     *
     * @return string $html The formatted address.
     */
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

    /**
     * Displays contact information in an address label format.
     *
     * @return string $html The contact information in an address label 
     * format.
     */
    public function displayAddressLabel() {
        $html = $this->displayName() . '<br>';
        $html .= $this->displayAddress();
        return $html;
    }

    /**
     * Displays name in following format: ${firstName}, ${lastName}.
     *
     * @return string Returns first name and last name.
     */
    public function displayName() {
        return $this->fname . ' ' . $this->lname;
    }

    /**
     * Retrieves list of all contacts related to a logged in user.  Using 
     * additional parameters you can order by fields within the Contacts 
     * table or set other conditions.
     *
     * @param int $user_id The ID user associated with this contact.
     * @param array $params Used to build conditions for database query.
     * @return array The list of contacts that is returned from the database.
     */
    public function findAllByUserId($user_id, $params = []) {
        $conditions = [
            'conditions' => 'user_id = ?',
            'bind' => [$user_id]
        ];

        // In case you want to add more conditions
        $conditions = array_merge($conditions, $params);
        return $this->find($conditions);
    }

    /**
     * Retrieves information for a contact that is associate with a 
     * particular user.
     *
     * @param int $contact_id The ID of the contact whose details we want.
     * @param int $user_id The ID of the logged in user.
     * @param array $params Used to set additional conditions.
     * @return void The contact whose information we want to view.
     */
    public function findByIdAndUserId($contact_id, $user_id, $params = []) {
        $conditions = [
            'conditions' => 'id = ? AND user_id = ?',
            'bind' => [$contact_id, $user_id]
        ];
        $conditions = array_merge($conditions, $params);
        return $this->findFirst($conditions);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function validator() {
        // Validate first name
        $this->runValidation(new RequiredValidator($this, ['field' => 'fname', 'message' => 'First Name is required']));
        $this->runValidation((new MaxValidator($this, ['field' => 'fname', 'message' => 'First Name must be less than 156 characters.', 'rule' => 155])));

        // Validate last name
        $this->runValidation(new RequiredValidator($this, ['field' => 'lname', 'message' => 'Last Name is required']));
        $this->runValidation((new MaxValidator($this, ['field' => 'lname', 'message' => 'Last Name must be less than 156 characters.', 'rule' => 155])));

        // Validate address
        $this->runValidation(new RequiredValidator($this, ['field' => 'address', 'message' => 'Address is required']));
        $this->runValidation((new MaxValidator($this, ['field' => 'address', 'message' => 'Address must be less than 256 characters.', 'rule' => 255])));

        // Validate address 2
        $this->runValidation((new MaxValidator($this, ['field' => 'address2', 'message' => 'Address 2 Name must be less than 256 characters.', 'rule' => 255])));

        // Validate city
        $this->runValidation(new RequiredValidator($this, ['field' => 'city', 'message' => 'City is required']));
        $this->runValidation((new MaxValidator($this, ['field' => 'city', 'message' => 'City must be less than 256 characters.', 'rule' => 255])));

        // Validate state
        $this->runValidation(new RequiredValidator($this, ['field' => 'state', 'message' => 'State is required']));
        $this->runValidation((new MaxValidator($this, ['field' => 'state', 'message' => 'City requires 2 character length abbreviation.', 'rule' => 2])));

        // Validate zip
        $this->runValidation(new RequiredValidator($this, ['field' => 'zip', 'message' => 'Zip code is required']));
        $this->runValidation((new MaxValidator($this, ['field' => 'zip', 'message' => 'Zip code must be less than 10 characters', 'rule' => 9])));

        // Validate Email
        $this->runValidation(new RequiredValidator($this, ['field' => 'email', 'message' => 'Email is required']));
        $this->runValidation((new MaxValidator($this, ['field' => 'email', 'message' => 'Zip code must be less than 176 characters', 'rule' => 175])));
    }
}