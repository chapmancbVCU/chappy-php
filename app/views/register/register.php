<?php
use Core\FormHelper;
?>
<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="row align-items-center justify-content-center">
    <div class="col-md-6 bg-light p-3">
        <h3 class="text-center">Register Here!</h3>
        <hr>
        <form class="form" action="" method="post">
            <?= FormHelper::csrfInput() ?>
            <?= FormHelper::displayErrors($this->displayErrors) ?>
            <?= FormHelper::inputBlock('text', "First Name", 'fname', $this->newUser->fname, ['class' => 'form-control input-sm]', ['class' => 'form-group']]) ?>
            <?= FormHelper::inputBlock('text', "Last Name", 'lname', $this->newUser->lname, ['class' => 'form-control input-sm]', ['class' => 'form-group']]) ?>
            <?= FormHelper::inputBlock('text', "Email", 'email', $this->newUser->email, ['class' => 'form-control input-sm]', ['class' => 'form-group']]) ?>
            <?= FormHelper::inputBlock('text', "User name", 'username', $this->newUser->username, ['class' => 'form-control input-sm]', ['class' => 'form-group']]) ?>
            <div>
                <h4>Password Requirements</h4>
                <ul>
                    <li>Minimum 12 characters in length</li>
                    <li>Maximum of 30 characters in length</li>
                    <li>At least 1 upper case character</li>
                    <li>At least 1 lower case character</li>
                    <li>At least 1 number</li>
                    <li>Must contain special characters (ex: !, @, $, %, ^, &, *, +, #)</li>
                </ul>
            </div>
            <?= FormHelper::inputBlock('password', "Password", 'password', $this->newUser->password, ['class' => 'form-control input-sm]', ['class' => 'form-group']]) ?>
            <?= FormHelper::inputBlock('password', "Confirm Password", 'confirm', $this->newUser->getConfirm(), ['class' => 'form-control input-sm]', ['class' => 'form-group']]) ?>
            <?= FormHelper::submitBlock('Register', ['class' => 'btn btn-large btn-primary'], ['class' => 'text-right mt-4'])  ?>
        </form>
    </div>
</div>
<?php $this->end(); ?>