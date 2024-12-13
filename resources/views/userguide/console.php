<?php $this->setSiteTitle("Console - User Guide"); ?>
<?php $this->start('body'); ?>

<div class="main">
    <div class="position-fixed">
        <a href="<?=APP_DOMAIN?>userguide/index" class="btn btn-xs btn-secondary">User Guide Home</a>
    </div>
    <h1 class="text-center">Console</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <ol class="pl-4">
            <li><a href="#overview">Overview</a></li>
            <li><a href="#summary">Summary of Available Commands</a></li>
        </ol>
    </div>

    <h1 id="overview" class="text-center">Overview</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>The console command is used to manage and perform tasks related to this framework.  You can run a console command following the following syntax: </p>
<pre class="mb-1 pb-1">
<code class="language-php line-numbers">php console ${command_name} ${argument}
</code>
</pre>
        <p>An example of a command that requires arguments is demonstrated below:</p>
<pre class="mb-1 pb-1">
<code class="language-php line-numbers">php console test:run-test Test
</code>
</pre>
        <p>Where <q>Test</q> is the name of the file containing the test.  Typing <q>php console</q> in the command line at project 
            root will display all of the available commands.  Each of the supported command will be covered in their respective sections 
            in this user guide.
        </p>
        <p>If there is a command you would like for us to support you can submit an issue <a href="https://github.com/chapmancbVCU/chappy-php/issues">here</a>.</p>
    </div>

    <h1 id="summary" class="text-center">Summary of Available Commands</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>Below is a list of available commands.  Most items in this list contains a link to the page that describes an individual command.</p>
        <table class="table table-striped table-condensed table-bordered table-hover mx-auto table-sm my-2">
            <thead>
                <th class="w-25 text-center">Command</th>
                <th class="text-center">Description</th>
            </thead>
            <tbody>
                <tr>
                    <td><a href="<?=APP_DOMAIN?>userguide/database#migration">migrate</a></td>
                    <td>Runs a Database Migration!</td>
                </tr>
                <tr>
                    <td>test</td>
                    <td>Performs the phpunit test.</td>
                </tr>
                <tr>
                    <td>init:mk-profile-images-dir</td>
                    <td>Builds Profile Image Dir</td>
                </tr>
                <tr>
                    <td>make:command</td>
                    <td>Generates a new command class</td>
                </tr>
                <tr>
                    <td>make:controller</td>
                    <td>Generates a new controller file!</td>
                </tr>
                <tr>
                    <td><a href="<?=APP_DOMAIN?>userguide/database#migration">make:db</a></td>
                    <td>Creates a new database</td>
                </tr>
                <tr>
                    <td>make:db-user</td>
                    <td>Create a new database user (Coming soon!)</td>
                </tr>
                <tr>
                    <td><a href="<?=APP_DOMAIN?>userguide/database#create-migration">make:migration</a></td>
                    <td>Generates a Database Migration!</td>
                </tr>
                <tr>
                    <td><a href="<?=APP_DOMAIN?>userguide/models#overview">make:model</a></td>
                    <td>Generates a new model file!</td>
                </tr>
                <tr>
                    <td>make:test</td>
                    <td>Generates a new test file!</td>
                </tr>
                <tr>
                    <td><a href="<?=APP_DOMAIN?>userguide/database#migration">migrate:drop-all</a></td>
                    <td>Drops all database tables</td>
                </tr>
                <tr>
                    <td><a href="<?=APP_DOMAIN?>userguide/database#migration">migrate:refresh</a></td>
                    <td>Drops all tables and runs a Database Migration!</td>
                </tr>
                <tr>
                    <td>tools:mk-env</td>
                    <td>Creates the .env file</td>
                </tr>
                <tr>
                    <td>tools:rm-profile-images</td>
                    <td>Removes all profile images.</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php $this->end(); ?>