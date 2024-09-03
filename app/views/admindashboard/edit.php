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
        <h1 class="text-center">Edit Details for <?=$this->user->username?></h1>
        <hr>
        <form class="form" action=<?=$this->postAction?> method="post">
            <?= FormHelper::csrfInput() ?>
            <?= FormHelper::inputBlock('text', "First Name", 'fname', $this->user->fname, ['class' => 'form-control input-sm'], ['class' => 'form-group'], $this->displayErrors) ?>
            <?= FormHelper::inputBlock('text', "Last Name", 'lname', $this->user->lname, ['class' => 'form-control input-sm'], ['class' => 'form-group'], $this->displayErrors) ?>
            <?= FormHelper::emailBlock("Email", 'email', $this->user->email, ['class' => 'form-control input-sm'], ['class' => 'form-group'], $this->displayErrors) ?>
            
            <?= FormHelper::textAreaBlock("Description", 
                'description', 
                $this->user->description, 
                ['class' => 'form-control input-sm', 'placeholder' => 'Update user\'s description...', 'rows' => '4'], 
                ['class' => 'form-group']); 
            ?>

            <?= FormHelper::selectBlock('ACL', 'acl', $this->aclId, $this->acls, ['class' => 'form-control input-sm'], ['class' => 'form-group'], $this->displayErrors); ?>
            
            <div class="col-md-12 text-right">
                <a href="<?=APP_DOMAIN?>admindashboard/details/<?=$this->user->id?>" class="btn btn-default">Cancel</a>
                <?= FormHelper::submitTag('Update', ['class' => 'btn btn-primary'])  ?>
            </div>
        </form>
    </div>
</div>
<?php $this->end(); ?>