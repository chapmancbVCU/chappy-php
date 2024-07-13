<?php $this->setSiteTitle("Contact Management System - User Guide"); ?>
<?php $this->start('body'); ?>
<?php include(ROOT . DS . 'app' . DS . 'views/layouts/docs_nav.php'); ?>

<div class="main">
    <a href="<?=PROOT?>userguide/index" class="btn btn-xs btn-secondary">User Guide Home</a>
    <h1 class="text-center">Contact Management System</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <ol class="pl-4">
            <li><a href="#overview">Overview</a></li>
            <li><a href="#details">Details</a></li>
            <li><a href="#edit">Edit</a></li>
            <li><a href="#delete">Delete</a></li>
        </ol>
    </div>

    <h1 id="overview" class="text-center">Overview</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
    </div>

    <h1 id="details" class="text-center">Details</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
    </div>

    <h1 id="edit" class="text-center">Edit</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
    </div>

    <h1 id="delete" class="text-center">Delete</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
    </div>
</div>
<script src="<?=PROOT?>public/js/docNavDropdown.js"></script>
<?php $this->end(); ?>