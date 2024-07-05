<?php $this->setSiteTitle("Validation Classes - Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>
<?php include(getcwd().DS.'app' . DS . 'views/layouts/docs_nav.php'); ?>

<div class="main">
    <h1 class="text-center">Validation</h1>
    <div class="row align-items-center justify-content-center my-3 mx-auto">
        <p class="text-center w-75">
            Built-in form validation classes along with the parent abstract Custom 
            Validation class provided by this Model View Controller (MVC) framework.
        </p>
    </div>
    <table class="table table-striped table-condensed table-bordered table-hover w-75 mb-5 mx-auto">
        <tr>
            <td><a href="<?=PROOT?>documentation/customValidator" class="text-primary w-25">Custom Validator</a></td>
            <td>Abstract parent class for our child validation child classes.  Each child class must implement the runValidation() function.</td>
        </tr>
        <tr>
            <td><a href="<?=PROOT?>documentation/emailValidator" class="text-primary w-25">Email Validator</a></td>
            <td>Child class that performs validation for E-mail fields.</td>
        </tr>
        <tr>
            <td><a href="<?=PROOT?>documentation/lowerCharValidator" class="text-primary w-25">Lower Char Validator</a></td>
            <td>Child class class that supports ability to check if field contains a lower case character in the field.</td>
        </tr>
        <tr>
            <td><a href="<?=PROOT?>documentation/matchesValidator" class="text-primary w-25">Matches Validator</a></td>
            <td>Child class that performs validation for two fields that are required to have the same value.</td>
        </tr>
        <tr>
            <td><a href="<?=PROOT?>documentation/maxValidator" class="text-primary w-25">Max Validator</a></td>
            <td>Child class that performs validation for the maximum length of a value for a field.</td>
        </tr>
        <tr>
            <td><a href="<?=PROOT?>documentation/minValidator" class="text-primary w-25">Min Validator</a></td>
            <td>Child class that performs validation for the minimum length of a value for a field.</td>
        </tr>
        <tr>
            <td><a href="<?=PROOT?>documentation/numberCharValidator" class="text-primary w-25">Number Char Validator</a></td>
            <td>Child class class that supports ability to check if field contains a numeric character in the field.</td>
        </tr>
        <tr>
            <td><a href="<?=PROOT?>documentation/numericValidator" class="text-primary w-25">Numeric Validator</a></td>
            <td>Child class that performs validation for fields than only accept numeric values.</td>
        </tr>
        <tr>
            <td><a href="<?=PROOT?>documentation/requiredValidator" class="text-primary w-25">Required Validator</a></td>
            <td>Child class that performs validation for fields that are required.</td>
        </tr>
        <tr>
            <td><a href="<?=PROOT?>documentation/specialCharValidator" class="text-primary w-25">Special Char Validator</a></td>
            <td>Child class class that supports ability to check if field contains an special character that is not a space in the field.</td>
        </tr>
        <tr>
            <td><a href="<?=PROOT?>documentation/uniqueCharValidator" class="text-primary w-25">Unique Char Validator</a></td>
            <td>Child class that performs validation for fields that require a unique entry in a database.</td>
        </tr>
        <tr>
            <td><a href="<?=PROOT?>documentation/upperCharValidator" class="text-primary w-25">Upper Char Validator</a></td>
            <td>Child class class that supports ability to check if field contains an upper case character in the field.</td>
        </tr>
    </table>

    <a href="<?=PROOT?>documentation" class="btn btn-xs btn-secondary mb-5">Docs Home</a>
</div>
<script src="<?=PROOT?>public/js/docNavDropdown.js"></script>
<?php $this->end(); ?>