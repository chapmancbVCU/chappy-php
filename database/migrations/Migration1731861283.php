<?php
namespace Database\Migrations;
use Core\Migration;

/**
 * Migration class for the user_sessions table.
 */
class Migration1731861283 extends Migration {
    /**
     * Performs a migration.
     *
     * @return void
     */
    public function up() {
        $table = 'user_sessions';
        $this->createTable($table);
        $this->addTimeStamps($table);
        $this->addColumn($table, 'user_id', 'int');
        $this->addColumn($table, 'session', 'varchar', ['size' => 255]);
        $this->addColumn($table, 'user_agent', 'varchar', ['size' => 255]);
        $this->addIndex($table, 'user_id');
        $this->addIndex($table, 'session');
    }

    /**
     * Undo a migration task.
     *
     * @return void
     */
    public function down() {
        $this->dropTable('user_sessions');
    }
}
