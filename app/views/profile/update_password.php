<?php
use Core\FormHelper;
?>
<?php $this->setSiteTitle("Change Password for ".$this->user->username); ?>
<?php $this->start('body'); ?>
<div class="row align-items-center justify-content-center">
    <div class="col-md-6 bg-light p-3">
        <a href="<?=PROOT?>profile" class="btn btn-xs btn-secondary mb-3">Back</a>
        <h1 class="text-center">Change Password for <?=$this->user->username?></h1>
        <hr>
        <form class="form" action="" method="post">
            <?= FormHelper::csrfInput() ?>
            <?= FormHelper::displayErrors($this->displayErrors) ?>
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
            <?= FormHelper::inputBlock('password', "Password", 'password', $this->user->password, ['class' => 'form-control input-sm'], ['class' => 'form-group']) ?>
            <?= FormHelper::inputBlock('password', "Confirm Password", 'confirm', $this->user->getConfirm(), ['class' => 'form-control input-sm'], ['class' => 'form-group']) ?>
            <?= FormHelper::submitBlock('Update', ['class' => 'btn btn-large btn-primary'], ['class' => 'text-right'])  ?>
        </form>
    </div>
</div>
<?php $this->end(); ?>