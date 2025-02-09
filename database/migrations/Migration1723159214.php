<?php
namespace Database\Migrations;
use Core\Migration;

/**
 * Migration class for the acl table.
 */
class Migration1723159214 extends Migration {
  /**
   * Performs a migration.
   *
   * @return void
   */
  public function up() {
    $table = 'acl';
    $this->createTable($table);
    $this->addColumn($table, 'acl', 'varchar', ['size' => 25]);
    $this->addSoftDelete($table);
    $this->addTimeStamps($table);
    $this->aclSetup($table);
  }

  /**
   * Undo a migration task.
   *
   * @return void
   */
  public function down() {
    $this->dropTable('acl');
  }
}
