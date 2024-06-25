<?php $this->setSiteTitle("Model Classes - Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>
<?php include('docs_nav.php'); ?>

<div class="main">
    <h1 class="text-center">Model Classes</h1>
    <div class="row align-items-center justify-content-center my-3 mx-auto">
        <p class="text-center w-75">Here you will find information about the various stock models 
            that are described by this Model View Controller (MVC) framework.
        </p>
    </div>
    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto mb-5">
        <tr>
            <td><a href="<?=PROOT?>documentation/contactsModel" class="text-primary w-25">Contacts Model</a></td>
            <td>Supports functions for handling Contacts such as displaying information, form validation, and DB operations.</td>
        </tr>
        <tr>
            <td><a href="<?=PROOT?>documentation/loginModel" class="text-primary w-25">Login Model</a></td>
            <td>Supports actions and view for home controller.</td>
        </tr>
        <tr>
            <td><a href="<?=PROOT?>documentation/usersModel" class="text-primary w-25">Users Model</a></td>
            <td>Functions found in this class will support tasks related to the user registration.</td>
        </tr>
        <tr>
            <td><a href="<?=PROOT?>documentation/userSessionsModel" class="text-primary w-25">User Sessions Model</a></td>
            <td>Functions found in this class will support the rendering of views when a user performs an action that is not allowed.</td>
        </tr>
    </table>

    <a href="<?=PROOT?>documentation" class="btn btn-xs btn-secondary mb-5">Docs Home</a>
</div>
<script src="<?=PROOT?>public/js/docNavDropdown.js"></script>
<?php $this->end(); ?>