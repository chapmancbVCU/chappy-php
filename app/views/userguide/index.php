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
            <li><a href="<?=APP_DOMAIN?>userguide/console">Console</a></li>
            <li><a href="<?=APP_DOMAIN?>userguide/administration">Administration</a></li>
            <li><a href="<?=APP_DOMAIN?>userguide/sessionMessages">Session Messages</a></li>
            <li><a href="<?=APP_DOMAIN?>userguide/views">Views</a></li>
            <li><a href="<?=APP_DOMAIN?>userguide/models">Models</a></li>
            <li><a href="<?=APP_DOMAIN?>userguide/controllers">Controllers</a></li>
            <li><a href="<?=APP_DOMAIN?>userguide/acl">Access Control</a></li>
            <li><a href="<?=APP_DOMAIN?>userguide/uploads">Uploads</a></li>
            <li><a href="<?=APP_DOMAIN?>userguide/phpunit">PHPUnit</a></li>
            <li><a href="<?=APP_DOMAIN?>userguide/javascript">JavaScript</a></li>
        </ol>
    </div>

    <h1 id="overview" class="text-center">Overview</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>The chappy.php Framework is everything you need to quickly get started on your projects.  
            With built in server-side validation, user registration, administrative features,
            and rapid form development support you have a solid foundation to build apps of any scale.
        </p>
        <p>This guide goes over all of the major features of chappy.php along with example 
            function calls to help you get started.  Starting with getting started and installation we 
            move on to the main features, and finally we go over the feature efforts and release notes.
        </p>
    </div>
</div>
<?php $this->end(); ?>