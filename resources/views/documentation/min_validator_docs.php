<?php $this->setSiteTitle("MinValidator - Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>

<div class="main">
    <a href="<?=APP_DOMAIN?>documentation/validators" class="btn btn-sm btn-secondary">Validators</a>
    <h1 class="text-center">MinValidator Class</h1>
    <div class="row align-items-center justify-content-center my-3">
        <p class="text-center w-75">Child class that performs validation for the minimum length of a value for a field.</p>
    </div>

    <table class="table table-striped  table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">Extends</th>
        </tr>
        <tr>
            <td colspan="2" class="text-center">CustomValidator</td>
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

    <table class="table table-striped  table-bordered table-hover w-75 mx-auto table-sm mb-5">
        <tr>
            <th colspan="2" class="text-center">abstract public function runValidation</th>
        </tr>
        <tr>
            <td colspan="2">Implements the abstract function of the same name from the parent class.  Enforces minimum length requirements for a form field.</td>
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
            <td>True if value we are testing is less than the min value set by the rule.  Otherwise, we return false.</td>
        </tr>
    </table>

    <a href="<?=APP_DOMAIN?>documentation/validators" class="btn btn-sm btn-secondary mb-5">Validators</a>
</div>
<?php $this->end(); ?>