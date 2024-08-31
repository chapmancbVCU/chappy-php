<?php
namespace Migrations;
use Core\Migration;

class Migration1725143766 extends Migration {
    public function up() {
        $table = 'test_table';
        $this->createTable($table);
    }
}
