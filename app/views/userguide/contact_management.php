<?php $this->setSiteTitle("Contact Management System - User Guide"); ?>
<?php $this->start('body'); ?>

<div class="main">
    <div class="position-fixed">
        <a href="<?=APP_DOMAIN?>userguide/index" class="btn btn-xs btn-secondary">User Guide Home</a>
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
            <img class="img-fluid" src="<?=APP_DOMAIN?>public/images/userGuide/contacts.png" alt="My Contacts Home">
            <figcaption>Figure 1 - My Contacts Home</figcaption>
        </figure>
    </div>

    <h1 id="details" class="text-center">Details</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>This view is accessed by clicking on a name of a contact on the My Contacts view.  It 
            displays basic information for a contact.  The left side shows contact information 
            and the right side shows your contact's address in the form of an address label.  Clicking 
            on the back button will take you back to the My Contacts view.  
            A screenshot of this view can be found below in Figure 2.
        </p>
        <figure class="d-flex flex-column justify-content-center align-items-center">
            <img class="img-fluid" src="<?=APP_DOMAIN?>public/images/userGuide/details.png" alt="Contact details view">
            <figcaption>Figure 2 - Contact Details View</figcaption>
        </figure>
    </div>

    <h1 id="edit" class="text-center">Edit</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>The Edit Contact view allows the use to update any contact.  Server-side validation ensures 
            acceptable data is submitted to the database.  By default, front-end validation enforces 
            proper formatting for the E-mail address and JavaScript is used to ensure phone numbers are 
            in a consistent and correct format.
        </p>
        <figure class="d-flex flex-column justify-content-center align-items-center">
            <img class="img-fluid" src="<?=APP_DOMAIN?>public/images/userGuide/edit.png" alt="Edit Contact view">
            <figcaption>Figure 3 - Edit Contact View</figcaption>
        </figure>
    </div>

    <h1 id="delete" class="text-center">Delete</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>When a user deletes a contact a confirmation prompt appears asking "Are you Sure?"  The 
            user can cancel or confirm.  A screenshot of the delete contact is displayed below in 
            Figure 4.
        </p>
        <figure class="d-flex flex-column justify-content-center align-items-center">
            <img class="img-fluid" src="<?=APP_DOMAIN?>public/images/userGuide/delete.png" alt="Delete contact prompt">
            <figcaption>Figure 4 - Delete Contact Prompt</figcaption>
        </figure>
    </div>
</div>
<script src="<?=APP_DOMAIN?>public/js/docNavDropdown.js"></script>
<?php $this->end(); ?>