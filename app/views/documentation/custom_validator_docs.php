<?php $this->setSiteTitle("CustomValidator - Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>
<?php include(getcwd().DS.'app' . DS . 'views/layouts/docs_nav.php'); ?>

<div class="main">
    <a href="<?=PROOT?>documentation/validators" class="btn btn-xs btn-secondary">Validators</a>
    <h1 class="text-center">abstract CustomValidator Class</h1>
    <div class="row align-items-center justify-content-center my-3">
        <p class="text-center w-75">Abstract parent class for our child validation child classes.  Each child class must implement the runValidation() function.</p>
    </div>

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">Extends</th>
        </tr>
        <tr>
            <td colspan="2" class="text-center">None</td>
        </tr>
        <tr>
            <th colspan="2" class="text-center">Namespace</th>
        </tr>
        <tr>
            <td colspan="2" class="text-center">Core\Validators</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" rowspan="2">Use</th>
            <tr><td>\Exception</td></tr>
        </tr>  
        <tr>
            <th colspan="2" class="text-center">Instance Variables</th>
        </tr>
        <tr>
            <th class="text-center">Access Identifier / Name</th>
            <th class="text-center">Description</th>
        </tr>
        <tr>
            <td>public $field</td>
            <td>The field we are validating.</td>
        </tr>
        <tr>
            <td>protected $_model</td>
            <td>The model associated with the form we are validating</td>
        </tr>
        <tr>
            <td>public $message</td>
            <td></td>
        </tr>
        <tr>
            <td>public $rule</td>
            <td></td>
        </tr>
        <tr>
            <td>public $success</td>
            <td></td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">public function construct</th>
        </tr>
        <tr>
            <td colspan="2">Constructor for Custom Validator.  It performs checks on the model and params such as fields, rules, and messages.  Finally the validation is performed against input from a form.  An exception is thrown if any conditions are not satisfied.  When an exception is thrown a message is displayed describing the issue.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">object</td>
            <td>$model The name of the model we want to perform validation when submitting a form.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$params A list of values obtained from an input when a form is submitted during a post action.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto mb-5">
        <tr>
            <th colspan="2" class="text-center">abstract function runValidation</th>
        </tr>
        <tr>
            <td colspan="2">Signature for the runValidation function that must be implemented by each child class.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="text-center" colspan="2">None</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="text-center" colspan="2">None</td>
        </tr>
    </table>
    <a href="<?=PROOT?>documentation/validators" class="btn btn-xs btn-secondary mb-5">Validators</a>
</div>
<script src="<?=PROOT?>public/js/docNavDropdown.js"></script>
<?php $this->end(); ?>