<?php
use Core\FormHelper;
?>
<?php $this->setSiteTitle("Reset Password for ".$this->user->username); ?>
<?php $this->start('body') ?>

<h1 class="text-center">Reset Password for <?=$this->user->username?></h1>

<div class="row align-items-center justify-content-center">
    <div class="col-md-3 bg-light p-3">
        <form class="form" action=<?=$this->postAction?> method="post">
            <?= FormHelper::csrfInput() ?>
            <?= FormHelper::checkboxBlockLabelLeft('Select to confirm reset password', 'reset_password', $this->user->isChecked(), [], ['class' => 'form-group']); ?>
            <?= FormHelper::submitTag('Reset Password',['class'=>'btn btn-primary']) ?>
        </form>
    </div>
</div>
<?php $this->end(); ?>