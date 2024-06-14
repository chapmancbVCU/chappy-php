<?php
namespace Core;
use \PDO;
use \PDOException;

/**
 * Parent class for database connections.
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
     * This constructor creates a new instance of the PDO object.  If there 
     * are any failures the application quits with an error message.
     */
    private function __construct() {
        try {
            $this->_pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function count() {
        return $this->_count;
    }

    /**
     * Performs delete operation against SQL database.
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

    public function find($table, $params = [], $class = false) {
        if($this->_read($table, $params, $class)) {
            return $this->results();
        }
        return false;
    }

    public function findFirst($table, $params=[], $class = false) {
        if($this->_read($table, $params, $class)) {
            return $this->first();
        }
        return false;
    }

    public function first() {
        return (!empty($this->_result)) ? $this->_result[0] : []; 
    }

    public function getColumns($table) {
        return $this->query("SHOW COLUMNS FROM {$table}")->results();
    }

    public static function getInstance() {
        if(!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function insert($table, $fields = []) {
        $fieldString = '';
        $valueString = '';
        $values = [];

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

    public function lastID() {
        return $this->_lastInsertID;
    }

    public function query($sql, $params = [], $class = false) {
        $this->_error = false;
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
                    $this->_result = $this->_query->fetchAll(PDO::FETCH_CLASS, $class);
                } else {
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
     * Supports SELECT operations that maybe ran against a SQL database.
     *
     * @param string $table The name of the table that contains the 
     * record(s) we want to find.
     * @param array $params
     * @param [type] $class
     * @return void
     */
    protected function _read($table, $params=[], $class) {
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

    public function results() {
        return $this->_result;
    }

    /**
     * Performs update operation on a SQL database record.
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
        $fieldString = '';
        $values = [];

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