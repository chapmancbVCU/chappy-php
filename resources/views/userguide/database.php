<?php $this->setSiteTitle("Database Operations - User Guide"); ?>
<?php $this->start('body'); ?>

<div class="main">
    <div class="position-fixed">
        <a href="<?=APP_DOMAIN?>userguide/index" class="btn btn-xs btn-secondary">User Guide Home</a>
    </div>
    <h1 class="text-center">Database Operations</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <ol class="pl-4">
            <li><a href="#overview">Overview</a></li>
            <li><a href="#migration">Migration</a></li>
            <li><a href="#create-migration">Create Migration</a></li>
        </ol>
    </div>

    <h1 id="overview" class="text-center">Overview</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>This page goes over the available ways users can manage a database with chappy.php  Using the 
            console, you can perform migrations, drop tables, and other tasks.  A complete description of all 
            Migration class function can be found <a href="<?=APP_DOMAIN?>documentation/migration">here</a>.
        </p>
    </div>

    <h1 id="migration" class="text-center">Migration</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>Performing a database migration is the first task you will perform after establishing a new project.  
            Before you begin you will need to open the .env file and enter some information about the database.  
            An example is shown below:
        </p>
<pre class="my-3 pb-1">
<code class="language-php line-numbers">DB_NAME=chappy
DB_USER=root
DB_PASSWORD=asecurepassword
DB_HOST='127.0.0.1'
</code>
</pre>
        <p>Next, create the database.  If your database is on your local host you can run the make:db command.  
            An example is shown below:
        </p>
<pre class="my-3 pb-1">
<code class="language-php line-numbers">php console make:db chappy
</code>
</pre>
        <p>Finally, you can run the migrate command shown below:</p>
<pre class="my-3 pb-1">
<code class="language-php line-numbers">php console migrate
</code>
</pre>
        <p>If you make a mistake or need a fresh start you can perform a refresh as described below:</p>
<pre class="my-3 pb-1">
<code class="language-php line-numbers">php console migrate:refresh
</code>
</pre>
        <p>Performing a the migrate and refresh commands will add a new record to a migrations table whose 
            purpose is to track all previous migrations.  When you create a one or more new migrations only 
            those will be executed.  You can also modify an existing table with a new migration.  More one 
            building your own migrations will be covered in the next section called Create Migration.
        </p>
        <p>Finally, if you just want to drop tables perform the following command:</p>
<pre class="my-3 pb-1">
<code class="language-php line-numbers">php console migrate:drop-all
</code>
</pre>
        <p>Performing either of these commands will result in status messages being displayed in the 
            console.
        </p>
    </div>

    <h1 id="create-migration" class="text-center">Create Migration</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>Create a migration by running the make:migration command.  An example is shown below for a table called foo:</p>
<pre class="my-3 pb-1">
<code class="language-php line-numbers">php console make:migration foo
</code>
</pre>       
        <p>Once you perform this action a migration class is created with two functions called up and down.  Up is used 
            to create a new table or update an existing one.  Down drops an existing table.  We usually don't modify the 
            down function. The output from the previous command is shown below:
        </p>

<pre class="my-3 pb-1">
<code class="language-php line-numbers">namespace Database\Migrations;
use Core\Migration;

class Migration1733521897 extends Migration {
    public function up() {
        $table = 'foo';
        $this->createTable($table);
    }

    public function down() {
        $this->dropTable('foo');
    }
}
</code>
</pre>
        <p>The up function automatically creates a $table variable set to the value you entered when you ran the make:migration command 
            along with a function call to create the table.  In the code snippet below we added some fields.
        </p>
<pre class="my-3 pb-1">
<code class="language-php line-numbers">namespace Database\Migrations;
use Core\Migration;

class Migration1733521897 extends Migration {
    public function up() {
        $table = 'foo';
        $this->createTable($table);
        $this->addColumn($table,'bar','varchar',['size'=>150]);
        $this->addTimeStamps($table);
        $this->addSoftDelete($table);
        $this->addColumn($table,'user_id','int');
        $this->addIndex($table,'user_id');
    }

    public function down() {
        $this->dropTable('foo');
    }
}
</code>
</pre>
        <p><strong>addColumn</strong> is the most common function that is used.  On line 8 we call this function to create a field 
            called 'bar' whose type is varchar.  The last argument is the optional attributes parameter.  It is an 
            associative array and in this case we set the size.  Other supported attributes are precision, scale, before, 
            after, and definition.
        </p>
        <p><strong>addTimeStamps</strong> as shown on line 9 creates 'created_at' and 'updated_at' fields.  <strong>softDelete</strong> 
            is used as a setting where you want to removed a record from being returned from any database query.  It serves as a safety 
            net that allows you to permanently delete the record later or preserve for later use.
        </p>
        <p>The function call on line 11 adds a user_id field and the next line sets this field as an index.  It is a common way to 
            create relationships with this and the Laravel framework.
        </p>

        <p>Run the migration and the console output, if successful, will be shown below:</p>
        <figure class="d-flex flex-column justify-content-center align-items-center">
            <img class="img-fluid" src="<?=APP_DOMAIN?>public/images/userGuide/migrate_output.png" alt="Migration command output">
            <figcaption>Figure 1 - Migration command output</figcaption>
        </figure>

        <p>Open your database management software package and you will see that the table has been created.</p>
        <figure class="d-flex flex-column justify-content-center align-items-center">
            <img class="img-fluid" src="<?=APP_DOMAIN?>public/images/userGuide/foo-table.png" alt="New database table">
            <figcaption>Figure 2 - New database table after migration was performed</figcaption>
        </figure>
    </div>
</div>
<?php $this->end(); ?>