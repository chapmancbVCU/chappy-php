<?php $this->setSiteTitle("Contact Management System - User Guide"); ?>
<?php $this->start('body'); ?>
<?php include(ROOT . DS . 'app' . DS . 'views/layouts/docs_nav.php'); ?>

<div class="main">
    <div class="position-fixed">
        <a href="<?=PROOT?>userguide/index" class="btn btn-xs btn-secondary">User Guide Home</a>
    </div>
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
        <p>The Contact Management System is a sample application that demonstrates how this Model 
            View Controller (MVC) Framework operates.  The ContactsController class provides examples on how 
            this framework supports Create, Read, Update, and Delete (CRUD) operations.
        </p>

        <p>The My Contacts view is controlled by the indexAction.  It demonstrates the ability to create 
            lists of contacts from the contacts table and display some information for each record.  It also 
            has a link to the details page by clicking a name for a particular contact.  There are also buttons 
            for performing update and delete operations.
        </p>

        <p>An image of the contacts home page can be found below in Figure 1.</p>

        <figure class="d-flex flex-column justify-content-center align-items-center">
            <img class="img-fluid" src="<?=PROOT?>public/images/userGuide/contacts.png" alt="My Contacts Home">
            <figcaption>Figure 1 - My Contacts Home</figcaption>
        </figure>
    </div>

    <h1 id="details" class="text-center">Details</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p></p>
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