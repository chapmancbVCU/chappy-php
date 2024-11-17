<?php
namespace Migrations;
use Core\Migration;

class Migration1731861283 extends Migration {
    public function up() {
        $table = 'user_sessions';
        $this->createTable($table);
        $this->addTimeStamps($table);
        $this->addColumn($table, 'user_id', 'int');
        $this->addColumn($table, 'session', 'varchar', ['size' => 255]);
        $this->addColumn($table, 'user_agent', 'varchar', ['size' => 255]);
        $this->addIndex($table, 'user_id');
        $this->addIndex($table, 'session');
    }
}
