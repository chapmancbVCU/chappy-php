<?php
namespace Core;
use Core\{DB, Helper};
use Console\Helpers\Tools;

/**
 * Supports database migration operations.
 */
abstract class Migration {
    protected $_db;
    protected $_columnTypesMap = [
        'int' => '_intColumn', 'integer' => '_intColumn', 'tinyint' => '_tinyintColumn', 'smallint' => '_smallintColumn',
        'mediumint' => '_mediumintColumn', 'bigint' => '_bigintColumn', 'numeric' => '_decimalColumn', 'decimal' => '_decimalColumn',
        'double' => '_doubleColumn', 'float' => '_floatColumn', 'bit' => '_bitColumn', 'date' => '_dateColumn',
        'datetime' => '_datetimeColumn', 'timestamp' => '_timestampColumn', 'time' => '_timeColumn', 'year' => '_yearColumn',
        'char' => '_charColumn', 'varchar' => '_varcharColumn', 'text' => '_textColumn'
    ];
    protected $_isCli;

    /**
     * Creates instance of Migration class.
     * 
     * @param string $isCli Contains value for interface type.
     */
    public function __construct($isCli) {
        $this->_db = DB::getInstance();
        $this->_isCli = $isCli;
    }

    /**
     * Setup acl table's initial fields during first db migration.
     *
     * @param string $table Name of acl table used to test that we are 
     * performing operations on correct table.
     * @return void
     */
    public function aclSetup($table) {
        $timestamp = Helper::timeStamps();
        if($table == 'acl') {
            $this->_db->insert('acl', ['acl' => 'Admin', 'deleted' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp]);
        }
    }

    /**
     * Add a column to a db table.
     * 
     * @param string $table Name of db table.
     * @param string $name  Name of the column.
     * @param string $type  Type of column varchar, text, int, tinyint, smallint, mediumint, bigint
     * @param array $attrs Attributes such as size, precision, scale, before, after, definition
     * @return bool $resp The response.
     */
    public function addColumn($table, $name, $type, $attrs = []) {
        $formattedType = call_user_func([$this, $this->_columnTypesMap[$type]], $attrs);
        $definition = array_key_exists('definition',$attrs)? $attrs['definition']." " : "";
        $order = $this->_orderingColumn($attrs);
        $sql = "ALTER TABLE {$table} ADD COLUMN {$name} {$formattedType} {$definition}{$order};";
        $msg = "Adding Column " . $name . " To ". $table;
        $resp = !$this->_db->query($sql)->error();
        $this->_printColor($resp, $msg);
        return $resp;
    }
    
    /**
     * Add Index to db table.
     * 
     * @param string $table db table name.
     * @param string $name name of column to add index.
     * @return bool $resp The response.
     */
    public function addIndex($table,$name,$columns=false) {
        $columns = (!$columns)? $name : $columns;
        $sql = "ALTER TABLE {$table} ADD INDEX {$name} ({$columns})";
        $msg = "Adding Index " . $name . " To ". $table;
        $resp = !$this->_db->query($sql)->error();
        $this->_printColor($resp,$msg);
        return $resp;
    }

    /**
     * Adds deleted column to db table to be used for soft deleting rows.
     * 
     * @param string $table name of table to add soft delete to.
     * @return void
     */
    public function addSoftDelete($table) {
        $this->addColumn($table,'deleted','tinyint');
        $this->addIndex($table, 'deleted');
    }

    /**
     * Adds created_at and updated_at columns to db table.
     * 
     * @param string $table name of db table.
     * @return bool Reports status of operation.
     */
    public function addTimeStamps($table) {
        $c = $this->addColumn($table,'created_at','datetime',['after'=>'id']);
        $u = $this->addColumn($table,'updated_at','datetime',['after'=>'created_at']);
        return $c && $u;
    }
    
    /**
     * Setup bit column.
     *
     * @param array $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _bitColumn($attrs) {
        return "BIT(" . $attrs['size'] . ")";
    }

    /**
     * Setup big int column.
     *
     * @param array $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _bigintColumn($attrs) {
        return 'BIGINT';
    }

    /**
     * Creates a table in the database.
     * 
     * @param  string $table name of the db table.
     * @return bool $resp The response.
     */
    public function createTable($table) {
        $sql = "CREATE TABLE IF NOT EXISTS {$table} (
            id INT AUTO_INCREMENT,
            PRIMARY KEY (id)
        )  ENGINE=INNODB;";
        $resp = !$this->_db->query($sql)->error();
        $this->_printColor($resp,"Creating Table " . $table);
        return $resp;
    }

    /**
     * Setup char column.
     *
     * @param array $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _charColumn($attrs) {
        $params = $this->_parsePrecisionScale($attrs);
        return "CHAR".$params;
    }

    /**
     * Setup date column.
     *
     * @param array $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _dateColumn($attrs) {
        return "DATE";
    }

    /**
     * Setup datetime column.
     *
     * @param array $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _datetimeColumn($attrs) {
        return "DATETIME";
    }

    /**
     * Setup decimal column.
     *
     * @param array $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _decimalColumn($attrs) {
        $params = $this->_parsePrecisionScale($attrs);
        return "DECIMAL".$params;
    }

    /**
     * Setup double column.
     *
     * @param array $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _doubleColumn($attrs) {
        $params = $this->_parsePrecisionScale($attrs);
        return "DOUBLE".$params;
    }

    /**
     * Drop column from table.
     * 
     * @param string $table name of db table.
     * @param string $name name of column to drop.
     * @return bool $resp The response.
     */
    public function dropColumn($table, $name) {
        $sql = "ALTER TABLE {$table} DROP COLUMN {$name};";
        $msg = "Dropping Column " . $name . " From ". $table;
        $resp = !$this->_db->query($sql)->error();
        $this->_printColor($resp,$msg);
        return $resp;
    }

    /**
     * Drops index from table.
     * 
     * @param string $table db table name.
     * @param string $name name of column to drop index.
     * @return bool $resp The response.
     */
    public function dropIndex($table, $name) {
        $sql = "DROP INDEX {$name} ON {$table}";
        $msg = "Dropping Index " . $name . " From ". $table;
        $resp = !$this->_db->query($sql)->error();
        $this->_printColor($resp,$msg);
        return $resp;
    }

    /**
     * Drops a table in the database.
     * 
     * @param string $table name of table to be dropped.
     * @return bool $resp The response.
     */
    public function dropTable($table) {
        $sql = "DROP TABLE IF EXISTS {$table}";
        $msg =  "Dropping Table " . $table;
        $resp = !$this->_db->query($sql)->error();
        $this->_printColor($resp,$msg);
        return $resp;
    }

    /**
     * Setup float column.
     *
     * @param array $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _floatColumn($attrs) {
        $params = $this->_parsePrecisionScale($attrs);
        return "FLOAT".$params;
    }

    /**
     * Setup int column.
     *
     * @param array $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _intColumn($attrs) {
        return "INT";
    }

    /**
     * Setup medium int column.
     *
     * @param array $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _mediumintColumn($attrs) {
        return 'MEDIUMINT';
    }

    /**
     * Setup ordering column.
     *
     * @param array $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _orderingColumn($attrs) {
        if(array_key_exists('after',$attrs)){
            return "AFTER " . $attrs['after'];
        } else if(array_key_exists('before',$attrs)){
            return "BEFORE " . $attrs['before'];
        } else {
            return "";
        }
    }

    /**
     * Setup precision scale.
     *
     * @param array $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _parsePrecisionScale($attrs) {
        $precision = (array_key_exists('precision',$attrs))? $attrs['precision'] : null;
        $precision = (!$precision && array_key_exists('size',$attrs))? $attrs['size'] : $precision;
        $scale = (array_key_exists('scale',$attrs))? $attrs['scale'] : null;
        $params = ($precision)? "(" . $precision : "";
        $params .= ($precision && $scale) ? ", " .$scale : "";
        $params .= ($precision) ? ")" : "";
        return $params;
    }

    /**
     * Prints color surrounding response output depending on success or failure.
     *
     * @param string $res The type of response.  It can be SUCCESS or FAIL.
     * @param string $msg The message associated with the response.
     * @return void
     */
    protected function _printColor($res,$msg){
        $title = ($res)? "SUCCESS: " : "FAIL: ";
    
        if($res == 'SUCCESS') {
            Tools::info($title.$msg);
        } else {
            Tools::info($title.$msg, 'error', 'red');
        }
    }

    /**
     * Run raw SQL statements
     * 
     * @param string $sql SQL Command to run
     * @return bool $resp The response.
     */
    public function query($sql){
        $msg = "Running Query: \"" . $sql ."\"";
        $resp = !$this->_db->query($sql)->error();
        $this->_printColor($resp,$msg);
        return $resp;
    }

    /**
     * Setup small int column.
     *
     * @param array $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _smallintColumn($attrs) {
        return 'SMALLINT';
    }

    /**
     * Setup text column.
     *
     * @param array $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _textColumn($attrs) {
        return "TEXT";
    }

    /**
     * Setup time column.
     *
     * @param array $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _timeColumn($attrs) {
        return "TIME";
    }

    /**
     * Setup timestamp column.
     *
     * @param array $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _timestampColumn($attrs) {
        return "TIMESTAMP";
    }

    /**
     * Setup tinyint column.
     *
     * @param array $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _tinyintColumn($attrs) {
        return 'TINYINT';
    }

    /**
     * Abstract function for migrations.  Must be implemented by child classes.
     *
     * @return void
     */
    abstract function up();

    /**
     * Setup varchar column.
     *
     * @param array $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _varcharColumn($attrs) {
        $params = $this->_parsePrecisionScale($attrs);
        return "VARCHAR".$params;
    }

    /**
     * Setup year column.
     *
     * @param array $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _yearColumn($attrs) {
        return "YEAR(4)";
    }
}
