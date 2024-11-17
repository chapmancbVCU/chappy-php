<?php
namespace Migrations;
use Core\Migration;

class Migration1724274442 extends Migration {
  public function up() {
    $table = 'profile_images';
    $this->createTable($table);
    $this->addColumn($table, 'url', 'varchar', ['size' => 255]);
    $this->addColumn($table, 'sort', 'int');
    $this->addColumn($table, 'user_id', 'int');
    $this->addColumn($table, 'name', 'varchar', ['size' => 255]);
    $this->addSoftDelete($table);
  }

  public function down() {
    $this->dropTable('profile_images');
  }
}
