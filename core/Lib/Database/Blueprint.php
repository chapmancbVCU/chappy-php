<?php
namespace Core\Lib\Database;

use Core\DB;
use Console\Helpers\Tools;

/**
 * Handles schema definitions before executing them.
 */
class Blueprint {
    protected $columns = [];
    protected $engine = 'InnoDB';
    protected $dbDriver;
    protected $indexes = [];
    protected $table;

    public function __construct($table) {
        $this->table = $table;
        $this->dbDriver = DB::getInstance()->getPDO()->getAttribute(\PDO::ATTR_DRIVER_NAME);
    }

    /**
     * Create the table.
     */
    public function create() {
        $columnsSql = implode(", ", $this->columns);
        $sql = "CREATE TABLE IF NOT EXISTS {$this->table} ({$columnsSql})";
        DB::getInstance()->query($sql);
        Tools::info("SUCCESS: Creating Table {$this->table}");

        foreach ($this->indexes as $index) {
            $this->createIndex($index);
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
     * Add an ID column (primary key).
     */
    public function id() {
        $this->columns[] = "id INTEGER PRIMARY KEY AUTOINCREMENT";
    }

    /**
     * Define an index.
     */
    public function index($column) {
        $this->indexes[] = $column;
    }

    /**
     * Define an integer column.
     */
    public function integer($name) {
        $type = ($this->dbDriver === 'sqlite') ? "INTEGER" : "INT";
        $this->columns[] = "{$name} {$type}";
    }

    /**
     * Define a soft delete column.
     */
    public function softDeletes() {
        $this->columns[] = "deleted TINYINT";
    }

    /**
     * Define a string column.
     */
    public function string($name, $length = 255) {
        $type = ($this->dbDriver === 'sqlite') ? "TEXT" : "VARCHAR({$length})";
        $this->columns[] = "{$name} {$type}";
    }

    /**
     * Define a timestamp column.
     */
    public function timestamps() {
        $this->columns[] = "created_at DATETIME";
        $this->columns[] = "updated_at DATETIME";
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
}