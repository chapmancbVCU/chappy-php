<?php $this->setSiteTitle("User Profiles - User Guide"); ?>
<?php $this->start('body'); ?>
<?php include(getcwd().DS.'app' . DS . 'views/layouts/docs_nav.php'); ?>

<div class="main">
<a href="<?=PROOT?>userguide/index" class="btn btn-xs btn-secondary">User Guide Home</a>
    <h1 class="text-center">User Profiles</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
    <ol class="pl-4">
            <li><a href="#profile">User Profile Home</a></li>
            <li><a href="#update">Update Profile</a></li>
            <li><a href="#image">Add/Update Profile Image</a></li>
            <li><a href="#password">Update Password</a></li>
        </ol>
    </div>

    <h1 id="#profile" class="text-center">User Profile Home</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>The profile page can be accessed by clicking your name or profile image at the top right of any page.</p>
        <p>The user profile contains basic information for a user.  You can add fields to the users table and 
            more information to this view depending on your needs.  Make sure you don't display personal and financial information in this view without taking proper security measures to obscure information.</p>
        <p>This view presents to the user the ability to update profile, profile image, and their password.  The 
            default layout for this view is shown below in Figure 1.</p>
        <figure class="d-flex flex-column justify-content-center align-items-center">
            <img src="<?=PROOT?>public/images/userGuide/user_profile.png" alt="Default Profile View">
            <figcaption>Figure 1 - Default Profile View</figcaption>
        </figure>
    </div>

    <h1 id="#update" class="text-center">Update Profile</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>At the edit profile page the user can edit their details.  A screenshot is shown below in figure 2.</p>
        <figure class="d-flex flex-column justify-content-center align-items-center">
            <img src="<?=PROOT?>public/images/userGuide/edit_profile.png" alt="Edit Profile">
            <figcaption>Figure 2 - Edit Profile</figcaption>
        </figure>
        <p>Field Descriptions:</p>
        <ol class="pl-4">
            <li>First Name: User's first name and it's a required field.</li>
            <li>Last Name: User's last name and it's a required field.</li>
            <li>E-mail: User's Email and it's a required field</li>
            <li>Description: Optional field where the user can describe themselves.</li>
        </ol>
    </div>

    <h1 id="#image" class="text-center">Add/Update Profile Image</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>The edit profile image allows the user to select either png, jpg, gif, or bmp image 
            types.  The $fileTypes array can be modified within the editProfileImageAction 
            function inside the ProfileController class.</p>
        <p>If you do not choose an image and click "upload" the current image will be removed.</p>
        <p>A screenshot of this page is shown below:</p>
        <figure class="d-flex flex-column justify-content-center align-items-center">
            <img src="<?=PROOT?>public/images/userGuide/profile_image.png" alt="Edit Profile Image Page">
            <figcaption>Figure 3 - Edit Profile Image</figcaption>
        </figure>
    </div>

    <h1 id="#password" class="text-center">Update Password</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>This view allows the user to change their password.  Complex passwords are enforced here.  
            A screenshot of the update password screen is shown below in Figure 4.</p>
        <figure class="d-flex flex-column justify-content-center align-items-center">
            <img src="<?=PROOT?>public/images/userGuide/change_password.png" alt="Update Password Page">
            <figcaption>Figure 4 - Update Password Page</figcaption>
        </figure>
    </div>

</div>
<script src="<?=PROOT?>public/js/docNavDropdown.js"></script>
<?php $this->end(); ?>