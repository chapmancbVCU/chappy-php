<?php
use Core\FormHelper;
use Core\Helper;

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
        <form class="form" action=<?=$this->postAction?> method="post">
            <?= FormHelper::csrfInput() ?>
            <input type="hidden" id="images_sorted" name="images_sorted" value="" />
            <?= FormHelper::inputBlock('text', "First Name", 'fname', $this->user->fname, ['class' => 'form-control input-sm'], ['class' => 'form-group mb-3'], $this->displayErrors) ?>
            <?= FormHelper::inputBlock('text', "Last Name", 'lname', $this->user->lname, ['class' => 'form-control input-sm'], ['class' => 'form-group mb-3'], $this->displayErrors) ?>
            <?= FormHelper::emailBlock("Email", 'email', $this->user->email, ['class' => 'form-control input-sm'], ['class' => 'form-group mb-3'], $this->displayErrors) ?>
            
            <?= FormHelper::textAreaBlock("Description", 
                'description', 
                $this->user->description, 
                ['class' => 'form-control input-sm', 'placeholder' => 'Update user\'s description...', 'rows' => '4'], 
                ['class' => 'form-group mb-3']); 
            ?>

            <!-- ACL Management Section -->
            <div class="form-group mb-3">
                <label>Manage ACLs:</label>
                <?php foreach ($this->acls as $aclKey => $aclName): ?>
                    <?= FormHelper::checkboxBlockLabelRight($aclName, "acls[]", $aclName, $this->user->hasAcl($aclName), [], ['class' => 'form-check'], $this->displayErrors, 
                    ); ?>
                <?php endforeach; ?>
            </div>
            
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
                <a href="<?=APP_DOMAIN?>admindashboard/details/<?=$this->user->id?>" class="btn btn-default">Cancel</a>
                <?= FormHelper::submitTag('Update', ['class' => 'btn btn-primary'])  ?>
            </div>
        </form>
    </div>
</div>

<?php $this->component('manage_profile_images') ?>

<?php $this->end(); ?>