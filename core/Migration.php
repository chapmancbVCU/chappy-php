<?php
namespace Core;
use PDO;
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
    protected $_tableDefinitions = [];

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
        $pdo = $this->_db->getPDO();
        $dbDriver = $pdo->getAttribute(PDO::ATTR_DRIVER_NAME);
    
        // Re-check column existence to ensure SQLite isn't misreporting
        if ($this->columnExists($table, $name)) {
            Tools::info("Skipping Column '{$name}' in {$table} - Already Exists", 'debug', 'yellow');
            return true;
        }
    
        // Ensure correct column type formatting
        $formattedType = $this->_formatColumnType($type, $attrs);
    
        // SQLite does not support ALTER TABLE ADD COLUMN for constraints
        if ($dbDriver === 'sqlite') {
            Tools::info("SQLite Detected - Altering Table {$table} is Limited.", 'debug', 'red');
        }
    
        // Run the ALTER TABLE query
        $sql = "ALTER TABLE {$table} ADD COLUMN {$name} {$formattedType};";
        $resp = !$this->_db->query($sql)->error();
    
        $this->_printColor($resp, "Adding Column {$name} To {$table}");
        return $resp;
    }
    
    
    /**
     * Add Index to db table.
     * 
     * @param string $table db table name.
     * @param string $name name of column to add index.
     * @return bool $resp The response.
     */
    public function addIndex($table, $name) {
        $pdo = $this->_db->getPDO();
        $dbDriver = $pdo->getAttribute(PDO::ATTR_DRIVER_NAME);
    
        $sql = ($dbDriver === 'sqlite')
            ? "CREATE INDEX IF NOT EXISTS {$table}_{$name}_idx ON {$table} ({$name})"
            : "ALTER TABLE {$table} ADD INDEX {$name} ({$name})";
    
        $resp = !$this->_db->query($sql)->error();
        $this->_printColor($resp, "Adding Index {$name} To {$table}");
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
        $pdo = $this->_db->getPDO();
        $dbDriver = $pdo->getAttribute(PDO::ATTR_DRIVER_NAME);
    
        // Ensure ID column is always present
        if (!isset($this->_tableDefinitions[$table])) {
            $this->_tableDefinitions[$table] = [
                'id' => ($dbDriver === 'sqlite') ? 'INTEGER PRIMARY KEY AUTOINCREMENT' : 'INT AUTO_INCREMENT PRIMARY KEY'
            ];
        }
    
        // Construct column definitions
        $columnDefinitions = [];
        foreach ($this->_tableDefinitions[$table] as $name => $type) {
            if ($dbDriver === 'sqlite' && strpos($type, 'AUTO_INCREMENT') !== false) {
                $type = str_replace('AUTO_INCREMENT', 'AUTOINCREMENT', $type);
            }
            $columnDefinitions[] = "{$name} {$type}";
        }
    
        // Build and execute the query
        $sql = "CREATE TABLE IF NOT EXISTS {$table} (" . implode(", ", $columnDefinitions) . ");";
        $resp = !$this->_db->query($sql)->error();
    
        // Log table creation status
        $this->_printColor($resp, "Creating Table {$table}");
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
     * Checks if a column exists in the given table.
     *
     * @param string $table The table name.
     * @param string $column The column name.
     * @return bool Whether the column exists.
     */
    protected function columnExists($table, $column) {
        $pdo = $this->_db->getPDO();
        $dbDriver = $pdo->getAttribute(PDO::ATTR_DRIVER_NAME);
    
        if ($dbDriver === 'sqlite') {
            $sql = "PRAGMA table_info({$table})";
            $columns = $this->_db->query($sql)->results();
    
            foreach ($columns as $col) {
                if (isset($col->name) && $col->name === $column) {
                    return true;
                }
            }
        } else {
            $sql = "SHOW COLUMNS FROM {$table} LIKE '{$column}'";
            return count($this->_db->query($sql)->results()) > 0;
        }
    
        return false;
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
        $pdo = $this->_db->getPDO();
        $dbDriver = $pdo->getAttribute(PDO::ATTR_DRIVER_NAME);
    
        if ($dbDriver === 'sqlite') {
            $sql = "DROP INDEX IF EXISTS {$table}_{$name}_idx";
        } else {
            $sql = "DROP INDEX {$name} ON {$table}";
        }
    
        $msg = "Dropping Index " . $name . " From " . $table;
        $resp = !$this->_db->query($sql)->error();
        $this->_printColor($resp, $msg);
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
        $resp = !$this->_db->query($sql)->error();
    
        // Log table drop status
        $this->_printColor($resp, "Dropping Table {$table}");
        
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
     * Formats column type with optional attributes.
     * 
     * @param string $type The base column type (e.g., varchar, int).
     * @param array $attrs Optional attributes like size, precision.
     * @return string The formatted column type string.
     */
    protected function _formatColumnType($type, $attrs) {
        if (isset($attrs['size'])) {
            return strtoupper($type) . "({$attrs['size']})";
        }
        return strtoupper($type);
    }

    protected function getDBDriver(): string {
        return $this->_db->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME);
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
     * Checks if a table exists in the database.
     * 
     * @param string $table The table name.
     * @return bool Whether the table exists.
     */
    protected function tableExists($table) {
        $pdo = $this->_db->getPDO();
        $dbDriver = $pdo->getAttribute(PDO::ATTR_DRIVER_NAME);

        if ($dbDriver === 'sqlite') {
            $sql = "SELECT name FROM sqlite_master WHERE type='table' AND name='{$table}'";
        } else {
            $sql = "SHOW TABLES LIKE '{$table}'";
        }

        return count($this->_db->query($sql)->results()) > 0;
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
