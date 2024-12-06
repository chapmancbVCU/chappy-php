<?php
namespace Database\Migrations;
use Core\Migration;

class Migration1723159214 extends Migration {
  public function up() {
    $table = 'acl';
    $this->createTable($table);
    $this->addColumn($table, 'acl', 'varchar', ['size' => 25]);
    $this->addSoftDelete($table);
    $this->addTimeStamps($table);
    $this->aclSetup($table);
  }

  public function down() {
    $this->dropTable('acl');
  }
}
