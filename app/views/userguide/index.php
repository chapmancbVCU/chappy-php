<?php $this->setSiteTitle("User Guide"); ?>
<?php $this->start('body'); ?>

<div class="main">
    <h1 class="text-center">User Guide</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <ol class="pl-4">
            <li><a href="#overview">Overview</a></li>
            <li><a href="<?=APP_DOMAIN?>userguide/gettingStarted">Getting Started</a></li>
            <li><a href="<?=APP_DOMAIN?>userguide/loginSystem">Login System</a></li>
            <li><a href="<?=APP_DOMAIN?>userguide/userProfiles">User Profiles</a></li>
            <li><a href="<?=APP_DOMAIN?>userguide/contactManagement">Contact Management System</a></li>
            <li><a href="<?=APP_DOMAIN?>userguide/forms">Rapid Forms</a></li>
            <li><a href="<?=APP_DOMAIN?>userguide/validation">Server Side Validation</a></li>
        </ol>
    </div>

    <h1 id="overview" class="text-center">Overview</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>This simple and complete Model View Controller (MVC) Framework is everything you need to 
            quickly get started on your projects.  With built in server-side validation, user registration,
            and rapid form development support you have a solid foundation.
        </p>
        <p>This guide goes over all of the major features of this MVC framework along with example 
            function calls to help you get started.  Starting with getting started and installation we 
            move on to the main features, and finally we go over the feature efforts and release notes.</p>
    </div>
</div>
<script src="<?=APP_DOMAIN?>public/js/docNavDropdown.js"></script>
<?php $this->end(); ?>