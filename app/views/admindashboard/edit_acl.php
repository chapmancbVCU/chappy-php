<?php use Core\Helper; ?>
<?php use Core\FormHelper; ?>
<?php $this->setSiteTitle("Edit ACL - " . $this->acl->acl); ?>
<?php $this->start('body'); ?>
<h1 class="text-center">Edit ACL - <?= $this->acl->acl ?></h1>

<div class="row align-items-center justify-content-center">
    <div class="col-md-6 bg-light p-3">
        <form class="form" action=<?=$this->postAction?> method="post">
            <?= FormHelper::csrfInput() ?>
            <?= FormHelper::inputBlock('text', "ACL", 'acl', $this->acl->acl, ['class' => 'form-control input-sm'], ['class' => 'form-group'], $this->displayErrors) ?>
            <div class="col-md-12 text-right">
                <a href="<?=APP_DOMAIN?>admindashboard/manageACLs" class="btn btn-default">Cancel</a>
                <?= FormHelper::submitTag('Update',['class'=>'btn btn-primary']) ?>
            </div>
        </form>
    </div>
</div>
<?php $this->end(); ?>