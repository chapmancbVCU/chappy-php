<?php
namespace Core;
use \PDO;
use Exception;
use Core\Helper;
use Core\Lib\Logger;
use \PDOException;
/**
 * Support database operations.
 */
class DB {
    private $_count = 0;
    private $_error = false;
    private $_fetchStyle = PDO::FETCH_OBJ;
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
            $this->_pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        } catch(PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    /** 
     * Constructs join statements for SQL queries.
     *
     * @param array $join Data such as table, conditions, and aliases needed 
     * to construct join query.  Default value is an empty array.
     * @return string The join component of a query.
     */
    protected function _buildJoin($join=[]) {
        $table = $join[0];
        $condition = $join[1];
        $alias = $join[2];
        $type = (isset($join[3]))? strtoupper($join[3]) : "INNER";
        $jString = "{$type} JOIN {$table} {$alias} ON {$condition}";
        return " " . $jString;
    }

    /**
     * Getter function for the private _count variable.
     *
     * @return int The number of results found in an SQL query.
     */
    public function count() {
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
    public function delete($table, $id) {
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
     * Returns number of records in a table.
     *
     * @param string $table  The name or the table we want to perform 
     * our query against.
     * @param array $params The values for the query.  They are the fields of 
     * the table in our database.  The default value is an empty array.
     * @return int $count The number of records in a table.
     */
    public function findTotal($table, $params=[]) {
        $count = 0;
        if($this->_read($table, $params, false, true)) {
            $count = $this->first()->count;
        }
        return $count;
    }

    /**
     * Returns first result in the _result array.
     *
     * @return array|object An associative array that is the first object 
     * in a _result.
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
    public function getColumns($table) {
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
    public function query($sql, $params = [],$class = false) {
        $this->_error = false;
        $startTime = microtime(true); // Start timing query execution

        if($this->_query = $this->_pdo->prepare($sql)) {
            $x = 1;
            if(count($params)) {
                foreach($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }
            if($this->_query->execute()) {
                $executionTime = microtime(true) - $startTime; // Calculate execution time
                if($class && $this->_fetchStyle === PDO::FETCH_CLASS){
                    $this->_result = $this->_query->fetchAll($this->_fetchStyle,$class);
                } else {
                    $this->_result = $this->_query->fetchAll($this->_fetchStyle);
                }
                $this->_count = $this->_query->rowCount();
                $this->_lastInsertID = $this->_pdo->lastInsertId();

                // Log successful query execution
                Logger::log("Executed Query: $sql | Params: " . json_encode($params) . " | Rows Affected: {$this->_count} | Execution Time: " . number_format($executionTime, 5) . "s", 'debug');
            } else {
                $this->_error = true;

                // Log query execution failure
                Logger::log("Database Error: " . json_encode($this->_query->errorInfo()) . " | Query: $sql | Params: " . json_encode($params), 'error');
            }
        } else {
            // Log query preparation failure
            Logger::log("Failed to prepare query: $sql | Params: " . json_encode($params), 'error');
        }

        return $this;
    }

    /** UPDATE
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
     * @param bool $count Boolean switch for turning on support for count 
     * operations.  Default value is false.
     * @return bool A true or false value depending on a successful operation.
     */
    protected function _read($table, $params=[], $class=false, $count=false) {
        $columns = '*';
        $joins = "";
        $conditionString = '';
        $bind = [];
        $order = '';
        $limit = '';
        $offset = '';
    
        //FETCH STYLE
        if(isset($params['fetchStyle'])){
          $this->_fetchStyle = $params['fetchStyle'];
        }
    
        // conditions
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
                $conditionString = ' Where ' . $conditionString;
            }
        }
    
        // columns
        if(array_key_exists('columns',$params)){
            $columns = $params['columns'];
        }
    
        // joins and raw joins
        if(array_key_exists('joins',$params)){
            foreach($params['joins'] as $join){
                $joins .= $this->_buildJoin($join);
            }
            $joins .= " ";
        }
    
        if(array_key_exists('joinsRaw', $params)) {
            foreach($params['joinsRaw'] as $raw) {
                $joins .= ' ' .$raw;
            }
        }
    
        // bind
        if(array_key_exists('bind', $params)) {
            $bind = $params['bind'];
        }
    
        // order
        if(array_key_exists('order', $params)) {
            $order = ' ORDER BY ' . $params['order'];
        }
    
        // limit
        if(array_key_exists('limit', $params)) {
            $limit = ' LIMIT ' . $params['limit'];
        }
    
        // offset
        if(array_key_exists('offset', $params)) {
            $offset = ' OFFSET ' . $params['offset'];
        }
        $sql = ($count) ? "SELECT COUNT(*) as count " : "SELECT {$columns} ";
        $sql .= "FROM {$table}{$joins}{$conditionString}{$order}{$limit}{$offset}";
        if($this->query($sql, $bind, $class)) {
            if(!count($this->_result)) return false;
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
    public function results() {
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
    public function update($table, $id, $fields = []) {
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
        }
        return false;
    }  
}