<?php
namespace Database\Migrations;
use Core\Lib\Database\Schema;
use Core\Lib\Database\Blueprint;
use Core\Lib\Database\Migration;

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
      // $table = "migrations";
      // $this->createTable($table);
      // $this->addColumn($table, 'migration', 'varchar',['size'=>35]);
      // $this->addIndex($table,'migration');
        Schema::create('migrations', function (Blueprint $table) {
          $table->id();
          $table->string('migration', 35);
          $table->index('migration');
      });
    }

    /**
     * Undo a migration task.
     *
     * @return void
     */
    public function down() {
      // $this->dropTable('migrations');
      Schema::dropIfExists('migrations');
    }
}
