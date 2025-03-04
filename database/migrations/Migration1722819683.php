<?php
namespace Database\Migrations;
use Core\Migration;

class Migration1722819683 extends Migration {
    public function up() {
        $table = "migrations";
        $columns = [
            'id' => ($this->getDBDriver() === 'sqlite') ? 'INTEGER PRIMARY KEY AUTOINCREMENT' : 'INT AUTO_INCREMENT PRIMARY KEY',
            'migration' => 'VARCHAR(255) NOT NULL'
        ];
        $this->createTable($table, $columns);
        $this->addIndex($table, 'migration');
    }

    public function down() {
        $this->dropTable('migrations');
    }

    private function getDBDriver(): string {
        return $this->_db->getPDO()->getAttribute(\PDO::ATTR_DRIVER_NAME);
    }
}
