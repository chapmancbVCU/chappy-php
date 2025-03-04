<?php
namespace Database\Migrations;
use Core\Migration;

/**
 * Migration class for the migrations table.
 */
class Migration1722819683 extends Migration {
    /**
     * Performs a migration.
     *
     * @return void
     */
    public function up() {
      $table = "migrations";
      $this->createTable($table);
      $this->addColumn($table, 'migration', 'varchar',['size'=>35]);
      $this->addIndex($table,'migration');
    }

    /**
     * Undo a migration task.
     *
     * @return void
     */
    public function down() {
      $this->dropTable('migrations');
    }
}
