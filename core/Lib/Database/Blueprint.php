<?php
namespace Core\Lib\Database;

use Core\DB;
use Exception;
use Core\Lib\Logger;
use Console\Helpers\Tools;

/**
 * Handles schema definitions before executing them.
 */
class Blueprint {
    protected $columns = [];
    protected $engine = 'InnoDB';
    protected $dbDriver;
    protected $foreignKeys = [];
    protected $indexes = [];
    protected $table;

    public function __construct($table) {
        $this->table = $table;
        $this->dbDriver = DB::getInstance()->getPDO()->getAttribute(\PDO::ATTR_DRIVER_NAME);
    }

    /**
     * Define a big integer column.
     */
    public function bigInteger($name) {
        $this->columns[] = "{$name} BIGINT";
        return $this;
    }

    /**
     * Define a boolean column.
     */
    public function boolean($name) {
        $this->columns[] = "{$name} TINYINT(1)";
        return $this;
    }

    /**
     * Create the table.
     */
    public function create() {
        $columnsSql = implode(", ", $this->columns);
        
        if ($this->dbDriver === 'mysql') {
            $sql = "CREATE TABLE IF NOT EXISTS {$this->table} ({$columnsSql}) ENGINE={$this->engine}";
        } else {
            $sql = "CREATE TABLE IF NOT EXISTS {$this->table} ({$columnsSql})";
        }
        
        DB::getInstance()->query($sql);
        Tools::info("SUCCESS: Creating Table {$this->table}");

        foreach ($this->indexes as $index) {
            $this->createIndex($index);
        }
        
        foreach ($this->foreignKeys as $fk) {
            $this->createForeignKey($fk);
        }
    }

    /**
     * Create a foreign key (MySQL only).
     */
    protected function createForeignKey($fk) {
        if ($this->dbDriver === 'mysql') {
            DB::getInstance()->query($fk);
            Tools::info("SUCCESS: Adding Foreign Key To {$this->table}");
        }
    }

    /**
     * Create an index.
     */
    protected function createIndex($column) {
        $sql = ($this->dbDriver === 'sqlite')
            ? "CREATE INDEX IF NOT EXISTS {$this->table}_{$column}_idx ON {$this->table} ({$column})"
            : "ALTER TABLE {$this->table} ADD INDEX ({$column})";

        DB::getInstance()->query($sql);
        Tools::info("SUCCESS: Adding Index {$column} To {$this->table}");
    }

    /**
     * Define a date column.
     */
    public function date($name) {
        $this->columns[] = "{$name} DATE";
        return $this;
    }

    /**
     * Define a datetime column.
     */
    public function dateTime($name) {
        $this->columns[] = "{$name} DATETIME";
        return $this;
    }

    /**
     * Define a decimal column.
     */
    public function decimal($name, $precision = 8, $scale = 2) {
        $this->columns[] = "{$name} DECIMAL({$precision}, {$scale})";
        return $this;
    }

    public function default($value) {
        $lastIndex = count($this->columns) - 1;

        if ($lastIndex < 0) {
            throw new Exception("Cannot apply default value without a defined column.");
        }

        preg_match('/^(\w+)\s+([\w()]+)/', $this->columns[$lastIndex], $matches);

        if (!isset($matches[2])) {
            throw new Exception("Could not extract column type.");
        }

        $columnType = strtoupper($matches[2]);

        if ($this->dbDriver === 'sqlite' && in_array($columnType, ['TEXT', 'BLOB'])) {
            Logger::log("Skipping default value for column '{$matches[1]}' (type: $columnType) in SQLite.", 'warning');
            return $this;
        }

        $this->columns[$lastIndex] .= " DEFAULT " . (is_string($value) ? "'$value'" : $value);
        return $this;
    }
    
    /**
     * Drops a table if it exists.
     *
     * @param string $table
     * @return void
     */
    public function dropIfExists($table) {
        $sql = "DROP TABLE IF EXISTS {$table}";
        DB::getInstance()->query($sql);
        Tools::info("SUCCESS: Dropping Table {$table}");
    }
    /**
     * Define a double column.
     */
    public function double($name, $precision = 16, $scale = 4) {
        $this->columns[] = "{$name} DOUBLE({$precision}, {$scale})";
        return $this;
    }

    /**
     * Define an enum column (MySQL only).
     */
    public function enum($name, array $values) {
        if ($this->dbDriver === 'mysql') {
            $enumValues = implode("','", $values);
            $this->columns[] = "{$name} ENUM('{$enumValues}')";
        } else {
            $this->columns[] = "{$name} TEXT";
        }
        return $this;
    }

    /**
     * Define a float column.
     */
    public function float($name, $precision = 8, $scale = 2) {
        $this->columns[] = "{$name} FLOAT({$precision}, {$scale})";
        return $this;
    }

    /**
     * Define a foreign key (MySQL only).
     */
    public function foreign($column, $references, $onTable, $onDelete = 'CASCADE', $onUpdate = 'CASCADE') {
        if ($this->dbDriver === 'mysql') {
            $this->foreignKeys[] = "ALTER TABLE {$this->table} ADD FOREIGN KEY ({$column}) REFERENCES {$onTable}({$references}) ON DELETE {$onDelete} ON UPDATE {$onUpdate}";
        }
    }

    /**
     * Add an ID column (primary key).
     */
    public function id() {
        $type = ($this->dbDriver === 'sqlite') ? "INTEGER PRIMARY KEY AUTOINCREMENT" : "INT AUTO_INCREMENT PRIMARY KEY";
        $this->columns[] = "id {$type}";
    }

    /**
     * Define an index.
     */
    public function index($column) {
        $this->indexes[] = $column;
        return $this;
    }

    /**
     * Define an integer column.
     */
    public function integer($name) {
        $type = ($this->dbDriver === 'sqlite') ? "INTEGER" : "INT";
        $this->columns[] = "{$name} {$type}";
        return $this;
    }

    /**
     * Define a medium integer column.
     */
    public function mediumInteger($name) {
        $this->columns[] = "{$name} MEDIUMINT";
        return $this;
    }

    public function nullable() {
        $lastIndex = count($this->columns) - 1;
        if ($lastIndex >= 0) {
            $this->columns[$lastIndex] .= " NULL";
        }
        return $this;  // ✅ Allow chaining
    }

    /**
     * Define a small integer column.
     */
    public function smallInteger($name) {
        $this->columns[] = "{$name} SMALLINT";
        return $this;
    }

    /**
     * Define a soft delete column.
     */
    public function softDeletes() {
        $this->columns[] = "deleted TINYINT(1)";
        return $this;
    }

    /**
     * Define a string column.
     */
    public function string($name, $length = 255) {
        $type = ($this->dbDriver === 'sqlite') ? "TEXT" : "VARCHAR({$length})";
        $this->columns[] = "{$name} {$type}";
        return $this;
    }

    /**
     * Define a text column.
     */
    public function text($name) {
        $this->columns[] = "{$name} TEXT";
        return $this;
    }

    /**
     * Define a time column.
     */
    public function time($name) {
        $this->columns[] = "{$name} TIME";
        return $this;
    }

    /**
     * Define a timestamp column.
     */
    public function timestamp($name) {
        $this->columns[] = "{$name} TIMESTAMP";
        return $this;
    }

    /**
     * Define timestamps (created_at and updated_at).
     */
    public function timestamps() {
        $this->columns[] = "created_at DATETIME";
        $this->columns[] = "updated_at DATETIME";
        return $this;
    }

    /**
     * Define a tiny integer column.
     */
    public function tinyInteger($name) {
        $type = ($this->dbDriver === 'sqlite') ? "INTEGER" : "TINYINT";
        $this->columns[] = "{$name} {$type}";
        return $this;
    }

    /**
     * Define an unsigned integer column (MySQL only).
     */
    public function unsignedInteger($name) {
        if ($this->dbDriver === 'mysql') {
            $this->columns[] = "{$name} INT UNSIGNED";
        } else {
            $this->columns[] = "{$name} INTEGER";
        }
        return $this;
    }

    /**
     * Update an existing table.
     */
    public function update() {
        foreach ($this->columns as $column) {
            $sql = "ALTER TABLE {$this->table} ADD COLUMN {$column}";
            DB::getInstance()->query($sql);
            Tools::info("SUCCESS: Adding Column {$column} To {$this->table}");
        }

        foreach ($this->indexes as $index) {
            $this->createIndex($index);
        }
    }

    /**
     * Define a UUID column (MySQL only).
     */
    public function uuid($name) {
        if ($this->dbDriver === 'mysql') {
            $this->columns[] = "{$name} CHAR(36) NOT NULL";
        } else {
            $this->columns[] = "{$name} TEXT";
        }
        return $this;
    }

}