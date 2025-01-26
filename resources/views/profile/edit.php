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
            <?= FormHelper::csrfInput() ?>
            <input type="hidden" id="images_sorted" name="images_sorted" value="" />
            <?= FormHelper::displayErrors($this->displayErrors) ?>
            <?= FormHelper::inputBlock('text', "First Name", 'fname', $this->user->fname, ['class' => 'form-control input-sm'], ['class' => 'form-group mb-3']) ?>
            <?= FormHelper::inputBlock('text', "Last Name", 'lname', $this->user->lname, ['class' => 'form-control input-sm'], ['class' => 'form-group mb-3']) ?>
            <?= FormHelper::emailBlock("Email", 'email', $this->user->email, ['class' => 'form-control input-sm'], ['class' => 'form-group mb-3']) ?>
            <?= FormHelper::textAreaBlock("About Me", 
                'description', 
                $this->user->description, 
                ['class' => 'form-control input-sm', 'placeholder' => 'Describe yourself here...', 'rows' => '4'], 
                ['class' => 'form-group mb-3']); 
            ?>

            <?= FormHelper::inputBlock('file', "Upload Profile Image (Optional)", 'profileImage', '', ['class' => 'form-control', 'accept' => 'image/png image/jpeg image/png'], ['class' => 'form-group mb-3'], $this->displayErrors) ?>
            <div id="sortableImages" class="row align-items-center justify-content-start p-2">
                <?php foreach($this->profileImages as $image):?>
                    <div class="col flex-grow-0" id="image_<?=$image->id?>">
                        <span class="btn-danger" onclick="deleteImage('<?=$image->id?>')"><i class="fa fa-times"></i></span>
                        <div class="edit-image-wrapper <?= ($image->sort == 0) ? 'current-profile-img' : ''?>" data-id="<?=$image->id?>">
                            <img src="<?=APP_DOMAIN.$image->url?>" />
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="col-md-12 text-end">
                <a href="<?=APP_DOMAIN?>profile" class="btn btn-default">Cancel</a>
                <?= FormHelper::submitTag('Update', ['class' => 'btn btn-primary'])  ?>
            </div>
        </form>
    </div>
</div>

<?php $this->component('manage_profile_images') ?>
<?php $this->end(); ?>