<?php
use Core\FormHelper;
?>
<?php $this->setSiteTitle("Update profile image for ".$this->user->username); ?>
<?php $this->start('body'); ?>
<div class="row align-items-center justify-content-center">
    <div class="col-md-6 bg-light p-3">
        <a href="<?=PROOT?>profile" class="btn btn-xs btn-secondary mb-3">Back</a>
        <h1 class="text-center">Update profile image for <?=$this->user->username?></h1>
        <hr>
        <form class="form" action="" method="post" enctype="multipart/form-data">
            <?= FormHelper::csrfInput() ?>
            <?= FormHelper::displayErrors($this->displayErrors) ?>
            <?= FormHelper::inputBlock('file', "Upload Profile Image (Select none to remove)", 'profileImage', $this->user->profileImage, ['class' => 'form-control'], ['class' => 'form-group w-50']) ?>
            <?= FormHelper::submitBlock('Upload', ['class' => 'btn btn-large btn-primary'], ['class' => 'text-right'])  ?>
        </form>
    </div>
</div>

<?php $this->end(); ?>