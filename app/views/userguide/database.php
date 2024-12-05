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
        </ol>
    </div>

    <h1 id="overview" class="text-center">Overview</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>This page goes over the available ways users can manage a database with chappy.php  Using the 
            console, you can perform migrations, drop tables, and other tasks.
        </p>
    </div>

    <h1 id="migration" class="text-center">Migration</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>Performing a database migration is the first task you will perform after establishing a new project.  
        </p>
    </div>
</div>
<?php $this->end(); ?>