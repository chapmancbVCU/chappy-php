<?php
namespace Core;
use Core\Helper;
use \stdClass;

/**
 * Parent class for our models.  Takes functions from DB wrapper and extract 
 * functionality further to make operations easier to use and improve 
 * extendability.
 */
class Model {
    protected $_db;
    public $id;
    protected $_modelName;
    protected $_softDelete = false;
    protected $_table;
    protected $_validates = true;
    protected $_validationErrors = [];

    /**
     * Default constructor.
     * 
     * @param string $table The name of the table so we can work with the 
     * correct child model class.
     */
    public function __construct(string $table) {
        $this->_db = DB::getInstance();
        $this->_table = $table;

        /* Replace table name under scores with a space and use ucwords upper 
           case each word of model and replaces all spaces with no space. 
           $table = 'user_sessions => User Sessions => UserSessions */
        $this->_modelName = str_replace(' ', '', ucwords(str_replace('_', '', $this->_table)));
    }

    /**
     * Generates error messages that occur during form validation.
     *
     * @param string $field The form field associated with failed form 
     * validation
     * @param string $message A message that describes to the user the cause 
     * for failed form validation.
     * @return void
     */
    public function addErrorMessage(string $field, string $message): void {
        $this->_validates = false;
        $this->_validationErrors[$field] = $message;  
    }

    /**
     * Called before save.
     *
     * @return void
     */
    public function afterSave(): void {}

    /**
     * Update the object with an associative array.
     * 
     * @param array Take values from post array and assign values.
     * @return bool Report for whether or not the operation was successful.
     */
    public function assign(array $params): bool {
        if(!empty($params)) {
            foreach($params as $key => $val) {
                if(property_exists($this, $key)) {
                    $this->$key = $val;
                }
            }
            return true;
        }
        return false;
    }

    /**
     * Called after save.
     *
     * @return void
     */
    public function beforeSave(): void {}

    /**
     * Grab object and if we just need data for smaller result set.
     * 
     * @return object The data associated with an object.
     */
    public function data(): object {
        $data = new stdClass();
        foreach(Helper::getObjectProperties($this) as $column => $value) {
            $data->column = $value;
        }
        return $data;
    }

    /**
     * Wrapper for database delete function.  If not softDelete we set it.
     * If row is set to softDelete we call the database delete function.
     * 
     * @param string $id The primary key for the record we want to remove from a 
     * database table.  The default value is an empty string.
     * @return bool True if delete operation is successful.  Otherwise, we 
     * return false.
     */
    public function delete(string $id = ''): bool {
        if($id == '' && $this->id == '') return false;
        $id = ($id == '') ? $this->id : $id;
        if($this->_softDelete) {
            return $this->update($id, ['deleted' => 1]);
        }

        return $this->_db->delete($this->_table, $id);
    }

    /**
     * Gets columns from table.
     * 
     * @return array An array of objects where each one represents a column 
     * from a database table.
     */
    public function getColumns(): array {
        return $this->_db->getColumns($this->_table);
    }

    /**
     * Displays error messages when form validation fails.
     *
     * @return array An array that contains a list of items that failed form 
     * validation.
     */
    public function getErrorMessages(): array {
        return $this->_validationErrors;
    }

    /**
     * Wrapper for the find function that is found in the DB class.
     *
     * @param array $params The values for the query.  They are the fields of 
     * the table in our database.  The default value is an empty array.
     * @return bool|array An array of object returned from an SQL query.
     */
    public function find(array $params = []): bool|array {
        $params = $this->_softDeleteParams($params);

        // Using $this will return the child class.
        $resultsQuery = $this->_db->find($this->_table, $params, get_class($this));

        if(!$resultsQuery) return [];
        return $resultsQuery;
    }

    /**
     * Get result from database by primary key ID.
     *
     * @param int $id The ID of the row we want to retrieve from the database.
     * @return bool|object The row from a database.
     */
    public function findById(int $id): bool|object {
        return $this->findFirst(['conditions'=>"id = ?", 'bind' => [$id]]);
    }

    /**
     * Wrapper for the findFirst function that is found in the DB class.
     *
     * @param array $params The values for the query.  They are the fields of 
     * the table in our database.  The default value is an empty array.
     * @return bool|object An array of object returned from an SQL query.
     */
    public function findFirst(array $params = []): bool|object {
        $params = $this->_softDeleteParams($params);
        $resultQuery = $this->_db->findFirst($this->_table, $params, get_class($this));
        return $resultQuery;
    }

    /** 
     * Wrapper for database insert function.
     * 
     * @param array $fields The field names and the respective values we will 
     * use to populate a database record.  The default value is an empty array.
     * @return bool Report for whether or not the operation was successful.
     */
    public function insert(array $fields): bool {
        if(empty($fields)) return false;
        return $this->_db->insert($this->_table, $fields);
    }

    /**
     * Checks if an object is a new insertion or an existing record.
     *
     * @return bool Returns true if the record exists.  Otherwise, we 
     * return false.
     */
    public function isNew(): bool {
        return (property_exists($this, 'id') && !empty($this->id)) ? false : true;
    }
    
    /**
     * Populates object with data.
     *
     * @param array|object $result Results from a database query.
     * @return void
     */
    protected function populateObjData(array|object $result): void {
        foreach($result as $key => $val) {
            $this->$key = $val;
        }
    }

    public function processFile($file) {
        if($file['profileImage']['name'] != "") {
            Helper::cl($file);
            $target_dir = PROOT."public/images/profileImages/";
            $target_file = $target_dir . basename($file["profileImage"]["name"]);
            $target_file = preg_replace('/\s+/', '', $target_file);
            Helper::cl($target_file);
        } else {
            Helper::cl("No file selected");
        } 
    }

    /**
     * Wrapper for database query function.
     * 
     * @param string $sql The database query we will submit to the database.
     * @param array The values we want to bind in our database query.
     * @return DB The results of the database query.
     */
    public function query(string $sql, array $bind): DB {
        return $this->_db->query($sql, $bind);
    }

    /**
     * Runs a validator object and sets validates boolean and adds error 
     * message if validator fails.
     *
     * @param object $validator The validator object.
     * @return void
     */
    public function runValidation(object $validator): void {
        // $validator->field is the field we ar validating.
        $key = $validator->field;
        if(!$validator->success) {
            $this->_validates = false;

            // Sets message as value for the key.
            $this->_validationErrors[$key] = $validator->message;
        }
    }

    /**
     * Wrapper for update and insert functions.  A failed form validation will
     * cause this function to return false.
     * 
     * @return bool True if the update operation is successful.  Otherwise, 
     * we return false.
     */
    public function save(): bool {
        $this->validator();
        if($this->_validates) {
            $this->beforeSave();
            $fields = Helper::getObjectProperties($this);

            // Determine whether to update or insert.
            if(property_exists($this, 'id') && $this->id != '') {
                $save =  $this->update($this->id, $fields);
                $this->afterSave();
                return $save;
            } else {
                $save = $this->insert($fields);
                $this->afterSave();
                return $save;
            }
        }
        return false;
    }

    /**
     * Adds to the conditions to avoid getting soft deleted rows returned
     *
     * @param array $params Defined parameters to search by.
     * @return array $params parameters with appended conditions for soft 
     * delete.
     */
    protected function _softDeleteParams(array $params): array {
        if($this->_softDelete) {
            if(array_key_exists('conditions', $params)) {
                if(is_array($params['conditions'])) {
                    $params['conditions'][] = "deleted != 1";
                } else {
                    $params['conditions'] .= " AND deleted != 1";
                }
            } else {
                $params['conditions'] = "deleted != 1";
            }
        }
        return $params;
    }

    /**
     * Wrapper for the update function found in the DB class.
     *
     * @param int $id The primary key for the record we want to remove from a 
     * database table.
     * @param array $fields The value of the fields we want to set for the 
     * database record.  The default value is an empty array.
     * @return bool True if the update operation is successful.  Otherwise, 
     * we return false.
     */
    public function update(int $id, array $fields): bool {
        if(empty($fields) || $id == '') return false;
        return $this->_db->update($this->_table, $id, $fields);
    }

    /**
     * Getter function for the $_validates boolean instance variable.
     *
     * @return bool $_validates is true if validation is successful and 
     * false if there is a failure.
     */
    public function validationPassed(): bool {
        return $this->_validates;
    }

    /**
     * Function that is called on save.  If validation fails the save function 
     * will not proceed.  This function is just a signature and must be 
     * implemented by models that run form validation because since it is 
     * called from within this class.
     * @method validator
     * @return void
     */
    public function validator(): void {

    }
}