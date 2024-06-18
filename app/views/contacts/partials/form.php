<?php 
use Core\FormHelper;
?>
<form class="form" action=<?=$this->postAction?> method="post">
    <?= FormHelper::displayErrors($this->displayErrors) ?>
    <?= FormHelper::csrfInput() ?>
    <?= FormHelper::inputBlock('text', 
        'First Name', 
        'fname', 
        $this->contact->fname, 
        ['class' => 'form-control'], 
        ['class' => 'form-group col-md-6']
    );?>

    <?= FormHelper::inputBlock('text', 
        'Last Name', 
        'lname', 
        $this->contact->lname, 
        ['class' => 'form-control'], 
        ['class' => 'form-group col-md-6']
    );?>

    <?= FormHelper::inputBlock('text', 
        'Address', 
        'address', 
        $this->contact->address, 
        ['class' => 'form-control'], 
        ['class' => 'form-group col-md-6']
    );?>

    <?= FormHelper::inputBlock('text', 
        'Address 2', 
        'address2', 
        $this->contact->address2, 
        ['class' => 'form-control'], 
        ['class' => 'form-group col-md-6']
    );?>

    <?= FormHelper::inputBlock('text', 
        'City', 
        'city', 
        $this->contact->city, 
        ['class' => 'form-control'], 
        ['class' => 'form-group col-md-5']
    );?>

    <?= FormHelper::inputBlock('text', 
        'State', 
        'state', 
        $this->contact->state, 
        ['class' => 'form-control'], 
        ['class' => 'form-group col-md-3']
    );?>

    <?= FormHelper::inputBlock('text', 
        'Zip', 
        'zip', 
        $this->contact->zip, 
        ['class' => 'form-control', 'pattern' => '[0-9]*', 'placeholder' => 'ex: 90210'], 
        ['class' => 'form-group col-md-4']
    );?>

    <?= FormHelper::inputBlock('text', 
        'Email', 
        'email', 
        $this->contact->email, 
        ['class' => 'form-control'], 
        ['class' => 'form-group col-md-6']
    );?>

    <?= FormHelper::inputBlock('tel', 
        'Cell Phone', 
        'cell_phone', 
        $this->contact->cell_phone, 
        [
            'class' => 'form-control',
            'onkeydown' => 'cellPhoneNumberFormatter()',
            'pattern' => '[0-9]{3}-[0-9]{3}-[0-9]{4}',
            'placeholder' => 'ex: 123-456-7890',
        ], 
        ['class' => 'form-group col-md-6']
    );?>

    <?= FormHelper::inputBlock('tel', 
        'Home Phone', 
        'home_phone', 
        $this->contact->home_phone,
        [
            'class' => 'form-control',
            'onkeydown' => 'homePhoneNumberFormatter()',
            'pattern' => '[0-9]{3}-[0-9]{3}-[0-9]{4}',
            'placeholder' => 'ex: 123-456-7890',
        ], 
        ['class' => 'form-group col-md-6']
    );?>

    <?= FormHelper::inputBlock('tel', 
        'Work Phone', 
        'work_phone', 
        $this->contact->work_phone, 
        [
            'class' => 'form-control',
            'onkeydown' => 'workPhoneNumberFormatter()',
            'pattern' => '[0-9]{3}-[0-9]{3}-[0-9]{4}',
            'placeholder' => 'ex: 123-456-7890',
        ], 
        ['class' => 'form-group col-md-6']
    );?>

    <div class="col-md-12 text-right">
        <a href="<?=PROOT?>contacts" class="btn btn-default">Cancel</a>
        <?= FormHelper::submitTag('Save', ['class' => 'btn btn-primary']) ?>
    </div>
    <script src="<?=PROOT?>public/js/frontEndPhoneNumberValidate.js"></script>
</form>