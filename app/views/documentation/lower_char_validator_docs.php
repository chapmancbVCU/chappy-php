<?php $this->setSiteTitle("Lower Char Validator - Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>
<?php include(getcwd().DS.'app' . DS . 'views/layouts/docs_nav.php'); ?>

<div class="main">
    <a href="<?=PROOT?>documentation/validators" class="btn btn-xs btn-secondary">Validators</a>
    <h1 class="text-center">LowerCharValidator Class</h1>
    <div class="row align-items-center justify-content-center my-3">
        <p class="text-center w-75">Child class class that supports ability to check if field contains a lower case character in the field.</p>
    </div>

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">Extends</th>
        </tr>
        <tr>
            <td colspan="2" class="text-center">CustomValidator/td>
        </tr>
        <tr>
            <th colspan="2" class="text-center">Namespace</th>
        </tr>
        <tr>
            <td colspan="2" class="text-center">Core\Validators</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" rowspan="2">Use</th>
            <tr><td>Core\Validators\CustomValidator</td></tr>
        </tr>  
        <tr>
            <th colspan="2" class="text-center">Instance Variables</th>
        </tr>
        <tr>
            <td class="text-center" colspan="2">None</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto mb-5">
        <tr>
            <th colspan="2" class="text-center">abstract public function runValidation</th>
        </tr>
        <tr>
            <td colspan="2">Implements the abstract function of the same name from the parent class.  Enforces requirement where a field must contain at least one lower case character.</td>
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
            <td class="align-middle text-center w-25">bool</td>
            <td>True if field contains at least one lower case character.</td>
        </tr>
    </table>

    <a href="<?=PROOT?>documentation/validators" class="btn btn-xs btn-secondary mb-5">Validators</a>
</div>
<script src="<?=PROOT?>public/js/docNavDropdown.js"></script>
<?php $this->end(); ?>