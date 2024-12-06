<?php
namespace Database\Migrations;
use Core\Migration;

class Migration1722819683 extends Migration {
    public function up() {
      $table = "migrations";
      $this->createTable($table);
      $this->addColumn($table, 'migration', 'varchar',['size'=>35]);
      $this->addIndex($table,'migration');
    }

    public function down() {
      $this->dropTable('migrations');
    }
}
