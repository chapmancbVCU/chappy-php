<?php
namespace Migrations;
use Core\Migration;

class Migration1722819717 extends Migration {
    public function up() {
        $table = "users";
        $this->createTable($table);
        $this->addColumn($table,'username','varchar',['size'=>150]);
        $this->addColumn($table,'email','varchar',['size'=>150]);
        $this->addColumn($table,'password','varchar',['size'=>150]);
        $this->addColumn($table,'fname','varchar',['size'=>150]);
        $this->addColumn($table,'lname','varchar',['size'=>150]);
        $this->addColumn($table,'acl','text');
        $this->addColumn($table, 'description', 'text', ['size'=>1000]);
        $this->addColumn($table, 'profileImage', 'varchar', ['size'=>255]);
        $this->addColumn($table, 'reset_password', 'tinyint');
        $this->addColumn($table, 'inactive', 'tinyint');
        $this->addTimeStamps($table);
        $this->addSoftDelete($table);
        $this->addIndex($table,'created_at');
        $this->addIndex($table,'updated_at');
    
        $table = "user_sessions";
        $this->createTable($table);
        $this->addTimeStamps($table);
        $this->addColumn($table,'user_id','int');
        $this->addColumn($table,'session','varchar',['size'=>255]);
        $this->addColumn($table,'user_agent','varchar',['size'=>255]);
        $this->addIndex($table,'user_id');
        $this->addIndex($table,'session');
    }
}
