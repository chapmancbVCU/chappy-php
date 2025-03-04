<?php
namespace Database\Migrations;
use Core\Lib\Database\Schema;
use Core\Lib\Database\Blueprint;
use Core\Lib\Database\Migration;

/**
 * Migration class for the contacts table.
 */
class Migration1723167263 extends Migration {
  /**
   * Performs a migration.
   *
   * @return void
   */
  public function up() {
    // $table = "contacts";
    // $this->createTable($table);
    // $this->addColumn($table,'fname','varchar',['size'=>150]);
    // $this->addColumn($table,'lname','varchar',['size'=>150]);
    // $this->addColumn($table,'email','varchar',['size'=>175]);
    // $this->addColumn($table,'home_phone','varchar',['size'=>50]);
    // $this->addColumn($table,'cell_phone','varchar',['size'=>50]);
    // $this->addColumn($table,'work_phone','varchar',['size'=>50]);
    // $this->addColumn($table,'address','varchar',['size'=>255]);
    // $this->addColumn($table,'address2','varchar',['size'=>255]);
    // $this->addColumn($table,'city','varchar',['size'=>255]);
    // $this->addColumn($table,'state','varchar',['size'=>150]);
    // $this->addColumn($table,'zip','varchar',['size'=>50]);
    // $this->addColumn($table,'country','varchar',['size'=>155]);
    // $this->addSoftDelete($table);
    // $this->addColumn($table,'user_id','int');
    // $this->addTimeStamps($table);
    // $this->addIndex($table, 'user_id');
    Schema::create('contacts', function (Blueprint $table) {
      $table->id();
      $table->string('fname', 150);
      $table->string('lname', 150);
      $table->string('email', 175);
      $table->string('home_phone', 50)->nullable();
      $table->string('cell_phone', 50)->nullable();
      $table->string('work_phone', 50)->nullable();
      $table->string('address', 255)->nullable();
      $table->string('address2', 255)->nullable();
      $table->string('city', 255);
      $table->string('state', 150);
      $table->string('zip', 50);
      $table->string('country', 155);
      $table->integer('user_id');
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
    // $this->dropTable('contacts');
    Schema::dropIfExists('contacts');
  }
}
