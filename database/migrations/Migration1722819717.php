<?php
namespace Database\Migrations;
use Core\Lib\Database\Blueprint;
use Core\Lib\Database\Migration;
use Core\Lib\Database\Schema;
/**
 * Migration class for the users table.
 */
class Migration1722819717 extends Migration {
    /**
     * Performs a migration task.
     *
     * @return void
     */
    public function up() {
        // $table = "users";
        // $this->createTable($table);
        // $this->addColumn($table,'username','varchar',['size'=>150]);
        // $this->addColumn($table,'email','varchar',['size'=>150]);
        // $this->addColumn($table,'password','varchar',['size'=>150]);
        // $this->addColumn($table,'fname','varchar',['size'=>150]);
        // $this->addColumn($table,'lname','varchar',['size'=>150]);
        // $this->addColumn($table,'acl','text');
        // $this->addColumn($table, 'description', 'text', ['size'=>1000]);
        // $this->addColumn($table, 'reset_password', 'tinyint');
        // $this->addColumn($table, 'inactive', 'tinyint');
        // $this->addColumn($table, 'login_attempts','int');
        // $this->addTimeStamps($table);
        // $this->addSoftDelete($table);
        // $this->addIndex($table,'created_at');
        // $this->addIndex($table,'updated_at');
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 150);
            $table->string('email', 150);
            $table->string('password', 150);
            $table->string('fname', 150);
            $table->string('lname', 150);
            $table->text('acl');
            $table->text('description')->nullable();
            $table->tinyInteger('reset_password')->default(0);
            $table->tinyInteger('inactive')->default(0);
            $table->integer('login_attempts')->default(0);
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('created_at');
            $table->index('updated_at');
        });
    }

    /**
     * Undo a migration task.
     *
     * @return void
     */
    public function down() {
        // $this->dropTable('users');
        Schema::dropIfExists('users');
    }
}
