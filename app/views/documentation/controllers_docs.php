<?php $this->setSiteTitle("Controller Classes - Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>

<div class="main">
    <h1 class="text-center">Controller Classes</h1>
    <div class="row align-items-center justify-content-center my-3 mx-auto">
        <p class="text-center w-75">
            Here you will find information about the various stock controllers 
            that are provided by this Model View Controller (MVC) framework.
        </p>
    </div>
    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto mb-5 table-sm">
        <tr>
            <td><a href="<?=APP_DOMAIN?>documentation/admindashboardController" class="text-primary w-25">Admindashboard Controller</a></td>
            <td>Add description here</td>
        </tr>
        <tr>
            <td><a href="<?=APP_DOMAIN?>documentation/contactsController" class="text-primary w-25">Contacts Controller</a></td>
            <td>Handles views and Create, Read, Update, and Delete operations for the built in example contact management system.</td>
        </tr>
        <tr>
            <td><a href="<?=APP_DOMAIN?>documentation/homeController" class="text-primary w-25">Home Controller</a></td>
            <td>Supports actions and view for home controller.</td>
        </tr>
        <tr>
            <td><a href="<?=APP_DOMAIN?>documentation/profileController" class="text-primary w-25">Profile Controller</a></td>
            <td>Functions found in this class will support tasks related to the user registration.</td>
        </tr>
        <tr>
            <td><a href="<?=APP_DOMAIN?>documentation/registerController" class="text-primary w-25">Register Controller</a></td>
            <td>Functions found in this class will support tasks related to the user registration.</td>
        </tr>
        <tr>
            <td><a href="<?=APP_DOMAIN?>documentation/restrictedController" class="text-primary w-25">Restricted Controller</a></td>
            <td>Functions found in this class will support the rendering of views when a user performs an action that is not allowed.</td>
        </tr>
    </table>

    <a href="<?=APP_DOMAIN?>documentation" class="btn btn-xs btn-secondary mb-5">Docs Home</a>
</div>
<script src="<?=APP_DOMAIN?>public/js/docNavDropdown.js"></script>
<?php $this->end(); ?>