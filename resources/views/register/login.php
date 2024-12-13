<?php
use Core\FormHelper;
use Core\Helper;
?>
<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="row align-items-center justify-content-center">
    <div class="col-md-6 bg-light p-3">
        <h3 class="text-center">Log In</h3>
        <form class="form" action="<?=APP_DOMAIN?>register/login" method="post">
            <?= FormHelper::csrfInput() ?>
            <?= FormHelper::displayErrors($this->displayErrors) ?>
            <?= FormHelper::inputBlock('text', 'Username', 'username', $this->login->username, ['class' => 'form-control'], ['class' => 'form-group']); ?>
            <?= FormHelper::inputBlock('password', 'Password', 'password', $this->login->password,['class' => 'form-control'], ['class' => 'form-group']); ?>
            <?= FormHelper::checkboxBlockLabelLeft('Remember Me', 'remember_me', $this->login->getRememberMeChecked(), [], ['class' => 'form-group']); ?>
            
            <div class="d-flex justify-content-end">
                <div class="flex-grow-1 text-body">Don't have an account? <a href="<?=APP_DOMAIN?>register/register">Sign Up</a></div>
                <?= FormHelper::submitTag('Login',['class'=>'btn btn-primary']) ?>
            </div>
        </form>
    </div>
</div>
<?php $this->end(); ?>