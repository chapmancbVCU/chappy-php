<?php
namespace Migrations;
use Core\Migration;

class Migration1722819683 extends Migration {
    public function up() {
      $table = "migrations";
      $this->createTable($table);
      $this->addColumn($table, 'migration', 'varchar',['size'=>35]);
    }
}
