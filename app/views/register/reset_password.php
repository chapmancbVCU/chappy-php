<?php
use Core\FormHelper;
use Core\Helper;
?>
<?php $this->setSiteTitle('Reset Password'); ?>
<?php $this->start('body'); ?>

<div class="row align-items-center justify-content-center">
    <div class="col-md-6 bg-light p-3">
    <h3 class="text-center">Reset Password</h3>
        <div>
            <h4>Password Requirements</h4>
            <ul>
                <li>Minimum 12 characters in length</li>
                <li>Maximum of 30 characters in length</li>
                <li>At least 1 upper case character</li>
                <li>At least 1 lower case character</li>
                <li>At least 1 number</li>
                <li>Must contain at least 1 special character</li>
                <li>Must not contain any spaces</li>
            </ul>
        </div>
        <form class="form" action="" method="post">
            <?= FormHelper::csrfInput() ?>
            <?= FormHelper::inputBlock('password', "Password", 'password', $this->user->password, ['class' => 'form-control input-sm'], ['class' => 'form-group'], $this->displayErrors) ?>
            <?= FormHelper::inputBlock('password', "Confirm Password", 'confirm', $this->user->confirm, ['class' => 'form-control input-sm'], ['class' => 'form-group'], $this->displayErrors) ?>

            <?= FormHelper::submitTag('Set Password',['class'=>'btn btn-primary']) ?>
        </form>
    </div>
</div>
<?php $this->end(); ?>