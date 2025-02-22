<?php
namespace Database\Migrations;
use Core\Migration;

/**
 * Migration class for the profile_images table.
 */
class Migration1724274442 extends Migration {
  /**
   * Performs a migration.
   *
   * @return void
   */
  public function up() {
    $table = 'profile_images';
    $this->createTable($table);
    $this->addColumn($table, 'url', 'varchar', ['size' => 255]);
    $this->addColumn($table, 'sort', 'int');
    $this->addColumn($table, 'user_id', 'int');
    $this->addColumn($table, 'name', 'varchar', ['size' => 255]);
    $this->addSoftDelete($table);
  }

  /**
   * Undo a migration task.
   *
   * @return void
   */
  public function down() {
    $this->dropTable('profile_images');
  }
}
