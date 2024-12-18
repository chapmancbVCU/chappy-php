<?php $this->setSiteTitle("Core Classes - Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>

<div class="main">
    <h1 class="text-center">Core Classes</h1>
    <div class="row align-items-center justify-content-center my-3 mx-auto">
        <p class="text-center w-75">The classes that provide primary support functions and validation for this Model View Controller (MVC) framework.</p>
    </div>
    <table class="table table-striped table-bordered table-hover w-75 mx-auto mb-5 table-sm">
        <tr>
            <td><a href="<?=APP_DOMAIN?>documentation/application" class="link-primary w-25">Application</a></td>
            <td>The Application class supports basic functional needs of the application.</td>
        </tr>
        <tr>
            <td><a href="<?=APP_DOMAIN?>documentation/controller" class="link-primary w-25">Controller</a></td>
            <td>This is the parent Controller class.  It describes functions that are available to all classes that extends this Controller class.</td>
        </tr>
        <tr>
            <td><a href="<?=APP_DOMAIN?>documentation/cookie" class="link-primary w-25">Cookie</a></td>
            <td>Manages cookies used by this application.  The $_COOKIE superglobal variable is an associative array.</td>
        </tr>
        <tr>
            <td><a href="<?=APP_DOMAIN?>documentation/db" class="link-primary w-25">DB</a></td>
            <td>Support database operations.</td>
        </tr>
        <tr>
            <td><a href="<?=APP_DOMAIN?>documentation/formHelper" class="link-primary w-25">FormHelper</a></td>
            <td>Contains functions for building form elements of various types.</td>
        </tr>
        <tr>
            <td><a href="<?=APP_DOMAIN?>documentation/helper" class="link-primary w-25">Helper</a></td>
            <td>Helper functions.</td>
        </tr>
        <tr>
            <td><a href="<?=APP_DOMAIN?>documentation/input" class="link-primary w-25">Input</a></td>
            <td>Input class handles requests to the server.</td>
        </tr>
        <tr>
            <td><a href="<?=APP_DOMAIN?>documentation/migration" class="link-primary w-25">Migration</a></td>
            <td>Add description here</td>
        </tr>
        <tr>
            <td><a href="<?=APP_DOMAIN?>documentation/model" class="link-primary w-25">Model</a></td>
            <td>Parent class for our models.  Takes functions from DB wrapper and extract functionality further to make operations easier to use and improve extendability.</td>
        </tr>
        <tr>
            <td><a href="<?=APP_DOMAIN?>documentation/router" class="link-primary w-25">Router</a></td>
            <td>This class is responsible for routing between views.</td>
        </tr>
        <tr>
            <td><a href="<?=APP_DOMAIN?>documentation/session" class="link-primary w-25">Session</a></td>
            <td>Supports functions for user sessions.  This class never gets instantiated.</td>
        </tr>
        <tr>
            <td><a href="<?=APP_DOMAIN?>documentation/view" class="link-primary w-25">View</a></td>
            <td>Handles operations related to views and its content.</td>
        </tr>
    </table>

    <a href="<?=APP_DOMAIN?>documentation" class="btn btn-sm btn-secondary mb-5">Docs Home</a>
</div>
<?php $this->end(); ?>