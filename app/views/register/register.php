<?php
use Core\FormHelper;
?>
<?php $this->setSiteTitle("Register Here!"); ?>
<?php $this->start('head') ?>
  <script src='<?=APP_DOMAIN?>vendor/tinymce/tinymce/tinymce.min.js'></script>
  <script src='<?=APP_DOMAIN?>public/js/profileDescriptionTinyMCE.js'></script>
<?php $this->end() ?>

<?php $this->start('body'); ?>
<div class="row align-items-center justify-content-center">
    <div class="col-md-6 bg-light p-3">
        <h3 class="text-center">Register Here!</h3>
        <hr>
        <form class="form" action="" method="post" enctype="multipart/form-data">
            <?= FormHelper::csrfInput() ?>
            <?= FormHelper::inputBlock('text', "First Name", 'fname', $this->newUser->fname, ['class' => 'form-control input-sm'], ['class' => 'form-group'], $this->displayErrors) ?>
            <?= FormHelper::inputBlock('text', "Last Name", 'lname', $this->newUser->lname, ['class' => 'form-control input-sm'], ['class' => 'form-group'], $this->displayErrors) ?>
            <?= FormHelper::inputBlock('text', "Email", 'email', $this->newUser->email, ['class' => 'form-control input-sm'], ['class' => 'form-group'], $this->displayErrors) ?>
            <?= FormHelper::inputBlock('text', "User name", 'username', $this->newUser->username, ['class' => 'form-control input-sm'], ['class' => 'form-group'], $this->displayErrors) ?>
            <?= FormHelper::textAreaBlock("About Me", 
                'description', 
                $this->newUser->description, 
                ['class' => 'form-control input-sm', 'placeholder' => 'Describe yourself here...', 'rows' => '4'], 
                ['class' => 'form-group'], $this->displayErrors); 
            ?>
            <?= FormHelper::inputBlock('file', "Upload Profile Image (Optional)", 'profileImage', '', ['class' => 'form-control'], ['class' => 'form-group w-50'], $this->displayErrors) ?>
            <div>
                <h4>Password Requirements</h4>
                <ul class="pl-3">
                    <li>Minimum 12 characters in length</li>
                    <li>Maximum of 30 characters in length</li>
                    <li>At least 1 upper case character</li>
                    <li>At least 1 lower case character</li>
                    <li>At least 1 number</li>
                    <li>Must contain at least 1 special character</li>
                    <li>Must not contain any spaces</li>
                </ul>
            </div>
            <?= FormHelper::inputBlock('password', "Password", 'password', $this->newUser->password, ['class' => 'form-control input-sm'], ['class' => 'form-group'], $this->displayErrors) ?>
            <?= FormHelper::inputBlock('password', "Confirm Password", 'confirm', $this->newUser->confirm, ['class' => 'form-control input-sm'], ['class' => 'form-group'], $this->displayErrors) ?>
            <?= FormHelper::submitBlock('Register', ['class' => 'btn btn-large btn-primary'], ['class' => 'text-right'])  ?>
        </form>
    </div>
</div>
<?php $this->end(); ?>