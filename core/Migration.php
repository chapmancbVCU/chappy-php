<?php
namespace Core;
use Core\{DB, Helper};

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
            $this->_db->insert('acl', ['acl' => 'Standard', 'deleted' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp]);
        }
    }

    /**
     * Add a column to a db table
     * @param string $table Name of db table
     * @param string $name  Name of the column
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
     * @param string $table name of table to add soft delete to.
     * @return void
     */
    public function addSoftDelete($table) {
        $this->addColumn($table,'deleted','tinyint');
        $this->addIndex($table, 'deleted');
    }

    /**
     * Adds created_at and updated_at columns to db table.
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
     * @param string $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _bitColumn($attrs) {
        return "BIT(" . $attrs['size'] . ")";
    }

    /**
     * Setup big int column.
     *
     * @param string $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _bigintColumn($attrs) {
        return 'BIGINT';
    }

    /**
     * Creates a table in the database.
     * @param  string $table name of the db table.
     * @return bool $resp The response.
     */
    public function createTable($table) {
        $sql = "CREATE TABLE IF NOT EXISTS {$table} (
            id INT AUTO_INCREMENT,
            PRIMARY KEY (id)
        )  ENGINE=INNODB;";
        $res = !$this->_db->query($sql)->error();
        $this->_printColor($res,"Creating Table " . $table);
        return $res;
    }

    /**
     * Setup char column.
     *
     * @param string $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _charColumn($attrs) {
        $params = $this->_parsePrecisionScale($attrs);
        return "CHAR".$params;
    }

    /**
     * Setup date column.
     *
     * @param string $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _dateColumn($attrs) {
        return "DATE";
    }

    /**
     * Setup datetime column.
     *
     * @param string $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _datetimeColumn($attrs) {
        return "DATETIME";
    }

    /**
     * Setup decimal column.
     *
     * @param string $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _decimalColumn($attrs) {
        $params = $this->_parsePrecisionScale($attrs);
        return "DECIMAL".$params;
    }

    /**
     * Setup double column.
     *
     * @param string $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _doubleColumn($attrs) {
        $params = $this->_parsePrecisionScale($attrs);
        return "DOUBLE".$params;
    }

    /**
     * Drop Column from table
     * @method dropColumn
     * @param  string     $table name of db table
     * @param  string     $name  name of column to drop
     * @return bool
     */
    public function dropColumn($table, $name) {
        $sql = "ALTER TABLE {$table} DROP COLUMN {$name};";
        $msg = "Dropping Column " . $name . " From ". $table;
        $resp = !$this->_db->query($sql)->error();
        $this->_printColor($resp,$msg);
        return $resp;
    }

    /**
     * Drops index from table
     * @method dropIndex
     * @param  string    $table db table name
     * @param  string    $name  name of column to drop index
     * @return bool
     */
    public function dropIndex($table, $name) {
        $sql = "DROP INDEX {$name} ON {$table}";
        $msg = "Dropping Index " . $name . " From ". $table;
        $resp = !$this->_db->query($sql)->error();
        $this->_printColor($resp,$msg);
        return $resp;
    }

    /**
     * Drops a table in the database
     * @method dropTable
     * @param  string    $table name of table to be dropped
     * @return bool
     */
    public function dropTable($table) {
        $sql = "DROP TABLE IF EXISTS {$table}";
        $msg =  "Dropping Table " . $table;
        $resp = !$this->_db->query($sql)->error();
        $this->_printColor($resp,$msg);
        return $resp;
    }

    /**
     * Undocumented function
     *
     * @param string $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _floatColumn($attrs) {
        $params = $this->_parsePrecisionScale($attrs);
        return "FLOAT".$params;
    }

    /**
     * Undocumented function
     *
     * @param string $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _intColumn($attrs) {
        return "INT";
    }

    /**
     * Undocumented function
     *
     * @param string $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _mediumintColumn($attrs) {
        return 'MEDIUMINT';
    }

    /**
     * Undocumented function
     *
     * @param string $attrs Attributes such as size, precision, scale, before, after, definition.
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
     * Undocumented function
     *
     * @param string $attrs Attributes such as size, precision, scale, before, after, definition.
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
     * Undocumented function
     *
     * @param [type] $res
     * @param [type] $msg
     * @return void
     */
    protected function _printColor($res,$msg){
        $title = ($res)? "SUCCESS: " : "FAIL: ";
    
        if($this->_isCli){
            $for = ($res)? "\e[0;37;" : "\e[0;37;";
            $back = ($res)? "42m" : "41m";
            echo $for.$back."\n\n"."    ".$title.$msg."\n\e[0m\n";
        } else {
            $color = ($res)? "#006600" : "#CC0000";
            echo '<p style="color:'.$color.'">'.$title.$msg.'</p>';
        }
    
    }

    /**
     * run raw SQL statements
     * @method query
     * @param  string $sql SQL Command to run
     * @return bool
     */
    public function query($sql){
        $msg = "Running Query: \"" . $sql ."\"";
        $resp = !$this->_db->query($sql)->error();
        $this->_printColor($resp,$msg);
        return $resp;
    }

    /**
     * Undocumented function
     *
     * @param string $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _smallintColumn($attrs) {
        return 'SMALLINT';
    }

    /**
     * Undocumented function
     *
     * @param string $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _textColumn($attrs) {
        return "TEXT";
    }

    /**
     * Undocumented function
     *
     * @param string $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _timeColumn($attrs) {
        return "TIME";
    }

    /**
     * Undocumented function
     *
     * @param string $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _timestampColumn($attrs) {
        return "TIMESTAMP";
    }

    /**
     * Undocumented function
     *
     * @param string $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _tinyintColumn($attrs) {
        return 'TINYINT';
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    abstract function up();

    /**
     * Undocumented function
     *
     * @param string $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _varcharColumn($attrs) {
        $params = $this->_parsePrecisionScale($attrs);
        return "VARCHAR".$params;
    }

    /**
     * Undocumented function
     *
     * @param string $attrs Attributes such as size, precision, scale, before, after, definition.
     * @return string The string used to configure field and its properties.
     */
    protected function _yearColumn($attrs) {
        return "YEAR(4)";
    }
}
