<?php
namespace Database\Migrations;
use Core\Lib\Database\Blueprint;
use Core\Lib\Database\Schema;
use Core\Lib\Database\Migration;

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
    // $table = 'profile_images';
    // $this->createTable($table);
    // $this->addColumn($table, 'url', 'varchar', ['size' => 255]);
    // $this->addColumn($table, 'sort', 'int');
    // $this->addColumn($table, 'user_id', 'int');
    // $this->addColumn($table, 'name', 'varchar', ['size' => 255]);
    // $this->addSoftDelete($table);
    Schema::create('profile_images', function (Blueprint $table) {
      $table->id();
      $table->string('url', 255);
      $table->integer('sort')->nullable();
      $table->integer('user_id');
      $table->string('name', 255);
      $table->timestamps();
      $table->softDeletes();
      $table->index('user_id');
    });
  }

  /**
   * Undo a migration task.
   *
   * @return void
   */
  public function down() {
    // $this->dropTable('profile_images');
    Schema::dropIfExists('profile_images');
  }
}
