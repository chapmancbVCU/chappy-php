<?php
namespace Core;
use \PDO;
use \PDOException;
use Core\Helper;
/**
 * Support database operations.
 */
class DB {
    private $_count = 0;
    private $_error = false;
    private static $_instance = null;
    private $_lastInsertID = null;
    private $_pdo;
    private $_query;
    private $_result;
    
    /**
     * This constructor creates a new PDO object as an instance variable.  If 
     * there are any failures the application quits with an error message.
     */
    private function __construct() {
        try {
            $this->_pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * Getter function for the private _count variable.
     *
     * @return int The number of results found in an SQL query.
     */
    public function count(): int {
        return $this->_count;
    }

    /**
     * Performs delete operation against SQL database.
     *
     * Example setup:
     * $contacts = $db->delete('contacts', 3);
     * 
     * @param string $table The name of the table that contains the record 
     * we want to delete.
     * @param int $id The primary key for the record we want to remove from a 
     * database table.
     * @return bool True if delete operation is successful.  Otherwise, we 
     * return false.
     */
    public function delete(string $table, int $id): bool {
        $sql = "DELETE FROM {$table} WHERE id = {$id}";

        if(!$this->query($sql)->error()) {
            return true;
        } else return false;
    }

    /**
     * Getter function for the $_error variable.
     *
     * @return bool The value for the $_error flag.
     */
    public function error() {
        return $this->_error;
    }

    /**
     * Performs find operation against the database.  The user can use 
     * parameters such as conditions, bind, order, limit, and sort.
     * 
     * Example setup:
     * $contacts = $db->find('users', [
     *     'conditions' => ["email = ?"],
     *     'bind' => ['chad.chapman@email.com'],
     *     'order' => "username",
     *     'limit' => 5,
     *     'sort' => 'DESC'
     * ]);
     *
     * @param string $table The name or the table we want to perform 
     * our query against
     * @param array $params The values for the query.  They are the fields of 
     * the table in our database.  The default value is an empty array.
     * @param bool|string $class A default value of false, it contains the 
     * name of the class we will build based on the name of a model.
     * @return bool|array An array of object returned from an SQL query.
     */
    public function find($table, $params = [], $class = false) {
        if($this->_read($table, $params, $class)) {
            return $this->results();
        }
        return false;
    }

    /**
     * Returns the first result performed by an SQL query.  It is a wrapper
     * for the _read function for this purpose.
     *
     * @param @param string $table The name or the table we want to perform 
     * our query against.
     * @@param array $params The values for the query.  They are the fields of 
     * the table in our database.  The default value is an empty array.
     * @param bool|string  $class A default value of false, it contains the 
     * name of the class we will build based on the name of a model.
     * @return bool|array An associative array of results returned from an SQL 
     * query.
     */
    public function findFirst($table, $params = [], $class = false) {
        if($this->_read($table, $params, $class)) {
            return $this->first();
        }
        return false;
    }

    /**
     * Returns first result in the _result array.
     *
     * @return array An associative array that first object in a _result.
     */
    public function first() {
        return (!empty($this->_result)) ? $this->_result[0] : []; 
    }

    /**
     * Returns columns for a table.
     *
     * @param string $table The name of the table we want to retrieve
     * the column names.
     * @return array An array of objects where each one represents a column 
     * from a database table.
     */
    public function getColumns(string $table): array {
        return $this->query("SHOW COLUMNS FROM {$table}")->results();
    }

    /**
     * An instance of this class set as a variable.  To be used in other 
     * class because we can't use $this.
     *
     * @return self The instance of this class.
     */
    public static function getInstance() {
        if(!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Perform insert operations against the database.
     * 
     * Example setup:
     * $fields = [
     *   'fname' => 'John',
     *   'lname' => 'Doe',
     *   'email' => 'example@email.com'
     * ];
     * $contacts = $db->insert('contacts', $fields);
     * 
     * @param string $table The name of the table we want to perform the 
     * insert operation.
     * @param array $fields The field names and the respective values we will 
     * use to populate a database record.  The default value is an empty array.
     * @return bool Report whether or not the operation was successful.
     */
    public function insert($table, $fields = []) {
        $fieldString = '';      // Table field
        $valueString = '';      // Populated with ?
        $values = [];           // Values we will bind when we build our query

        foreach($fields as $field => $value) {
            $fieldString .= '`' . $field . '`,';
            $valueString .= '?,';
            $values[] = $value;
        }

        // Cleanup trailing commas
        $fieldString = rtrim($fieldString, ',');
        $valueString = rtrim($valueString, ',');
        $sql = "INSERT INTO {$table} ({$fieldString}) VALUES ({$valueString})";

        if(!$this->query($sql, $values)->error()) {
            return true;
        } else return false;
    }

    /**
     * The primary key ID of the last insert operation.
     *
     * @return int The primary key ID from the last insert operation.
     */
    public function lastID() {
        return $this->_lastInsertID;
    }

    /**
     * Performs database query operations that includes prepare, 
     * binding, execute, and fetch.  
     *
     * @param string $sql The database query we will submit to the database.
     * @param array $params The values for the query.  They are the fields of 
     * the table in our database.  The default value is an empty array.
     * @param bool|string $class A default value of false, it contains the 
     * name of the class we will build based on the name of a model.
     * @return DB The results of the database query.  If the operation 
     * is not successful the $_error instance variable is set to true and is 
     * returned.
     */
    public function query(string $sql, array $params = [], bool|string $class = false): DB {
        $this->_error = false;
        Helper::cl($sql);
        if($this->_query = $this->_pdo->prepare($sql)) {
            $x = 1;
            if(count($params)) {
                foreach($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }
            if($this->_query->execute()) {
                if($class) {
                    // Construct results in array into class that we pass it.
                    $this->_result = $this->_query->fetchAll(PDO::FETCH_CLASS, $class);
                } else {
                    // We just construct an object from the results.
                    $this->_result = $this->_query->fetchAll(PDO::FETCH_OBJ);
                }
                $this->_count = $this->_query->rowCount();
                $this->_lastInsertID = $this->_pdo->lastInsertId();
            } else {
                $this->_error = true;
            }
        }
        return $this;
    }

    /**
     * Supports SELECT operations that maybe ran against a SQL database.  It 
     * supports the ability to order and limit the number of results returned 
     * from a database query.  The user can use parameters such as conditions, 
     * bind, order, limit, and sort.
     *
     * @param string $table The name of the table that contains the 
     * record(s) we want to find.
     * @param array $params The values for the query.  They are the fields of 
     * the table in our database.  The default value is an empty array.
     * @param bool|string  $class A default value of false, it contains the 
     * name of the class we will build based on the name of a model.
     * @return bool A true or false value depending on a successful operation.
     */
    protected function _read($table, array $params = [], bool|string $class): bool {
        $conditionString = '';
        $bind = [];
        $order = '';
        $limit = '';
  
        // Conditions
        if(isset($params['conditions'])) {
            if(is_array($params['conditions'])) {
                foreach($params['conditions'] as $condition) {
                    $conditionString .= ' ' . $condition . ' AND';
                }
                $conditionString = trim($conditionString);
                $conditionString = rtrim($conditionString, ' AND');
            } else {
                $conditionString = $params['conditions'];
            }

            if($conditionString != '') {
                $conditionString = ' WHERE ' . $conditionString;
            }
        }

        // Bind
        if(array_key_exists('bind', $params)) {
            $bind = $params['bind'];
        }

        // Order 
        if(array_key_exists('order', $params)) {
            $order = ' ORDER BY ' . $params['order'];
        }

        // Limit
        if(array_key_exists('limit', $params)) {
            $limit = ' LIMIT ' . $params['limit'];
        }

        $sql = "SELECT * FROM {$table}{$conditionString}{$order}{$limit}";
        if($this->query($sql, $bind, $class)) {
            if(!count($this->_result)) {
                return false;
            }
            return true;
        }
        return false;
    }

    /**
     * Returns value of query results.
     *
     * @return array An array of objects that contain results of a database 
     * query.
     */
    public function results(): array {
        return $this->_result;
    }

    /**
     * Performs update operation on a SQL database record.
     *
     * Example setup:
     * $fields = [
     *   'fname' => 'John',
     *   'email' => 'example@email.com'
     * ];
     * $contacts = $db->update('contacts', 3, $fields);
     * 
     * @param string $table $table The name of the table that contains the 
     * record we want to update.
     * @param int $id The primary key for the record we want to remove from a 
     * database table.
     * @param array $fields The value of the fields we want to set for the 
     * database record.  The default value is an empty array.
     * @return bool True if the update operation is successful.  Otherwise, 
     * we return false.
     */
    public function update(string $table, int $id, array $fields = []): bool {
        $fieldString = '';      // Table field
        $values = [];           // Values we will bind when we build our query

        foreach($fields as $field => $value) {
            $fieldString .= ' ' . $field . ' = ?,';
            $values[] = $value;
        }

        $fieldString = trim($fieldString);
        $fieldString = rtrim($fieldString, ',');

        $sql = "UPDATE {$table} SET {$fieldString} where id = {$id}";

        if(!$this->query($sql, $values)->error()) {
            return true;
        } else return false;
    }  
}