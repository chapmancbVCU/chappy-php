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
        <li><a href="#usage">Usage</a></li>
        </ol>
    </div>

    <h1 id="overview" class="text-center">Overview</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>The console command is used to manage and perform tasks related to this framework.  You can run a console command following the following syntax: </p>
<pre class="mb-1 pb-1">
        <code>
php console ${command_name} ${argument}
        </code>
</pre>
        <p>An example of a command that requires arguments is demonstrated below:</p>
<pre class="mb-1 pb-1">
        <code>
php console test:run-test Test
        </code>
</pre>
        <p>Where <q>Test</q> is the name of the file containing the test.  Typing <q>php console</q> in the command line at project root will display all of the available commands.</p>
    </div>
</div>
<?php $this->end(); ?>