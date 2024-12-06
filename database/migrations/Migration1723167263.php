<?php
namespace Database\Migrations;
use Core\Migration;

class Migration1723167263 extends Migration {
  public function up() {
    $table = "contacts";
    $this->createTable($table);
    $this->addColumn($table,'fname','varchar',['size'=>150]);
    $this->addColumn($table,'lname','varchar',['size'=>150]);
    $this->addColumn($table,'email','varchar',['size'=>175]);
    $this->addColumn($table,'home_phone','varchar',['size'=>50]);
    $this->addColumn($table,'cell_phone','varchar',['size'=>50]);
    $this->addColumn($table,'work_phone','varchar',['size'=>50]);
    $this->addColumn($table,'address','varchar',['size'=>255]);
    $this->addColumn($table,'address2','varchar',['size'=>255]);
    $this->addColumn($table,'city','varchar',['size'=>255]);
    $this->addColumn($table,'state','varchar',['size'=>150]);
    $this->addColumn($table,'zip','varchar',['size'=>50]);
    $this->addColumn($table,'country','varchar',['size'=>155]);
    $this->addSoftDelete($table);
    $this->addColumn($table,'user_id','int');
    $this->addTimeStamps($table);
    $this->addIndex($table, 'user_id');
  }

  public function down() {
    $this->dropTable('contacts');
  }
}
