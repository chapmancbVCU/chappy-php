<?php
use Core\FormHelper;
use Core\Helper;

?>
<?php $this->setSiteTitle("Edit Details for ".$this->user->username); ?>
<?php $this->start('head') ?>
    <script src='<?=APP_DOMAIN?>vendor/tinymce/tinymce/tinymce.min.js'></script>
    <script src='<?=APP_DOMAIN?>public/js/profileDescriptionTinyMCE.js'></script>
<?php $this->end() ?>

<?php $this->start('body'); ?>
<div class="row align-items-center justify-content-center">
    <div class="col-md-6 bg-light p-3">
        <a href="<?=APP_DOMAIN?>admindashboard/details/<?=$this->user->id?>" class="btn btn-xs btn-secondary mb-3">Back</a>
        <h1 class="text-center">Edit Details for <?=$this->user->username?></h1>
        <hr>
        <form class="form" action=<?=$this->postAction?> method="post">
            <?= FormHelper::csrfInput() ?>
            <?= FormHelper::displayErrors($this->displayErrors) ?>
            <?= FormHelper::inputBlock('text', "First Name", 'fname', $this->user->fname, ['class' => 'form-control input-sm'], ['class' => 'form-group']) ?>
            <?= FormHelper::inputBlock('text', "Last Name", 'lname', $this->user->lname, ['class' => 'form-control input-sm'], ['class' => 'form-group']) ?>
            <?= FormHelper::emailBlock("Email", 'email', $this->user->email, ['class' => 'form-control input-sm'], ['class' => 'form-group']) ?>
            <?= FormHelper::selectBlock('ACL', 'acl', $this->user->acl, $this->acls, ['class' => 'form-control input-sm'], ['class' => 'form-group'], $this->displayErrors); ?>
            <?= FormHelper::textAreaBlock("About Me", 
                'description', 
                $this->user->description, 
                ['class' => 'form-control input-sm', 'placeholder' => 'Describe yourself here...', 'rows' => '4'], 
                ['class' => 'form-group']); 
            ?>
            <?= FormHelper::submitBlock('Update', ['class' => 'btn btn-large btn-primary'], ['class' => 'text-right'])  ?>
        </form>
    </div>
</div>
<?php $this->end(); ?>