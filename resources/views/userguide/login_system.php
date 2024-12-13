<?php $this->setSiteTitle("Login System - User Guide"); ?>
<?php $this->start('body'); ?>

<div class="main">
    <div class="position-fixed">
        <a href="<?=APP_DOMAIN?>userguide/index" class="btn btn-xs btn-secondary">User Guide Home</a>
    </div>
    <h1 class="text-center">Login System</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <ol class="pl-4">
            <li><a href="#registration">Registration</a></li>
            <li><a href="#login">Login</a></li>
        </ol>
    </div>

    <h1 id="registration" class="text-center">Registration</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>At the login page the user can access the registration page.  A screenshot is shown 
            below in figure 1.
        </p>
        <figure class="d-flex flex-column justify-content-center align-items-center">
            <img class="img-fluid" src="<?=APP_DOMAIN?>public/images/userGuide/registration.png" alt="Registration screen">
            <figcaption>Figure 1 - Registration Screen</figcaption>
        </figure>
        <p>Field Descriptions:</p>
        <ol class="pl-4">
            <li>First Name: User's first name and it's a required field.</li>
            <li>Last Name: User's last name and it's a required field.</li>
            <li>E-mail: User's Email and it's a required field</li>
            <li>User name: Your user name and it's a required field</li>
            <li>Description: Optional field where the user can describe themselves.</li>
            <li>Profile Image: Optional profile image.</li>
            <li>Password: Make sure they match and fulfill complexity requirements.</li>
        </ol>
    </div>

    <h1 id="login" class="text-center">Login</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>The login page is the standard login setup with a remember me checkbox.  Once you login you can access parts of the application 
            that are allowed for your access control level.  The number of failed attempts allowed can be set by your administrator.  If 
            you are an administrator and you get locked out and there are no other administrators you can set the inactive field to 0 and 
            login_attempts to 0 in the record associated with your user account.
        </p>
    </div>
</div>
<?php $this->end(); ?>