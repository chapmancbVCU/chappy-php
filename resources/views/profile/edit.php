<?php
use Core\FormHelper;
?>
<?php $this->setSiteTitle("Edit Details for ".$this->user->username); ?>
<?php $this->start('head') ?>
    <link rel="stylesheet" href="<?=APP_DOMAIN?>resources/css/profileImage.css?v=<?=VERSION?>" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="<?=APP_DOMAIN?>resources/css/jquery-ui/jquery-ui.min.css">
    <script src='<?=APP_DOMAIN?>vendor/tinymce/tinymce/tinymce.min.js'></script>
    <script src='<?=APP_DOMAIN?>resources/js/profileDescriptionTinyMCE.js'></script>
    <script type="text/javascript" src="<?=APP_DOMAIN?>resources/js/jquery-ui/jquery-ui.min.js"></script>
<?php $this->end() ?>

<?php $this->start('body'); ?>
<div class="row align-items-center justify-content-center">
    <div class="col-md-6 bg-light p-3">
        <h1 class="text-center">Edit Details for <?=$this->user->username?></h1>
        <hr>
        <form class="form" action="" method="POST" enctype="multipart/form-data">
            
            <?= $this->component('edit_profile_details'); ?>
            <?= FormHelper::inputBlock('file', "Upload Profile Image (Optional)", 'profileImage', '', ['class' => 'form-control', 'accept' => 'image/png image/jpeg image/png'], ['class' => 'form-group mb-3'], $this->displayErrors) ?>
            <?= $this->component('manage_profile_images') ?>

            <div class="col-md-12 text-end">
                <a href="<?=APP_DOMAIN?>profile" class="btn btn-default">Cancel</a>
                <?= FormHelper::submitTag('Update', ['class' => 'btn btn-primary'])  ?>
            </div>
        </form>
    </div>
</div>


<?php $this->end(); ?>