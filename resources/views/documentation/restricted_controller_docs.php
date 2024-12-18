<?php $this->setSiteTitle("Restricted Controller - Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>

<div class="main">
    <a href="<?=APP_DOMAIN?>documentation/controllers" class="btn btn-sm btn-secondary">Controllers</a>
    <h1 class="text-center">Restricted Controller Class</h1>
    <div class="row align-items-center justify-content-center my-3">
        <p class="text-center w-75">Implements support for our Contact Controller.  It contains actions for handling user interactions that will result in CRUD operations against the database.</p>
    </div>

    <table class="table table-striped  table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">Extends</th>
        </tr>
        <tr>
            <td colspan="2" class="text-center">Controller</td>
        </tr>
        <tr>
            <th colspan="2" class="text-center">Namespace</th>
        </tr>
        <tr>
            <td colspan="2" class="text-center">App\Controllers</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" rowspan="1">Use</th>
            <td>Core\Controller</td>
        </tr>
        <tr>
            <th colspan="2" class="text-center">Instance Variables</th>
        </tr>
        <tr>
            <td class="text-center" colspan="2">None</td>
        </tr>  
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped  table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public function brokenTokenAction</th>
        </tr>
        <tr>
            <td colspan="2">Renders page when a bad csrf token is detected.</td>
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
            <td class="align-middle text-center w-25">void</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">
    
    <table class="table table-striped  table-bordered table-hover w-75 mx-auto table-sm mb-5">
        <tr>
            <th colspan="2" class="text-center">public function indexAction</th>
        </tr>
        <tr>
            <td colspan="2">This controller's default action.</td>
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
            <td class="align-middle text-center w-25">void</td>
        </tr>
    </table>

    <a href="<?=APP_DOMAIN?>documentation/controllers" class="btn btn-sm btn-secondary mb-5">Controllers</a>
</div> 
<?php $this->end(); ?>