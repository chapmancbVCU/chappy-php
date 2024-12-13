<?php
use Core\FormHelper;
?>
<?php $this->setSiteTitle("Change Password for ".$this->user->username); ?>
<?php $this->start('body'); ?>
<div class="row align-items-center justify-content-center">
    <div class="col-md-6 bg-light p-3">
        <h1 class="text-center">Change Password for <?=$this->user->username?></h1>
        <hr>  
        <?php $this->component('password_complexity_requirements'); ?>
        <form class="form" action="" method="post">
            <?= FormHelper::csrfInput() ?>
            <?= FormHelper::displayErrors($this->displayErrors) ?>
            <?= FormHelper::inputBlock('password', "Current Password", 'current_password', $this->current_password, ['class' => 'form-control input-sm'], ['class' => 'form-group']) ?>
            <?= FormHelper::inputBlock('password', "Password", 'password', $this->new_password, ['class' => 'form-control input-sm'], ['class' => 'form-group']) ?>
            <?= FormHelper::inputBlock('password', "Confirm Password", 'confirm', $this->confirm, ['class' => 'form-control input-sm'], ['class' => 'form-group']) ?>
            
            <div class="col-md-12 text-right">
                <a href="<?=APP_DOMAIN?>profile" class="btn btn-default">Cancel</a>
                <?= FormHelper::submitTag('Update', ['class' => 'btn btn-primary'])  ?>
            </div>
        </form>
    </div>
</div>
<?php $this->end(); ?>