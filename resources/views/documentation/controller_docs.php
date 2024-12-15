<?php $this->setSiteTitle("Controller - Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>

<div class="main">
    <a href="<?=APP_DOMAIN?>documentation/core" class="btn btn-sm btn-secondary">Core</a>
    <h1 class="text-center">Controller Class</h1>
    <div class="row align-items-center justify-content-center my-3">
        <p class="text-center w-75">This is the parent Controller class.  It describes functions that are available to all classes that extends this Controller class.</p>
    </div>

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">Extends</th>
        </tr>
        <tr>
            <td colspan="2" class="text-center">Application</td>
        </tr>
        <tr>
            <th colspan="2" class="text-center">Namespace</th>
        </tr>
        <tr>
            <td colspan="2" class="text-center">Core</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" rowspan="2">Use</th>
            <tr><td>Core\Application</td></tr>
        </tr>  
        <tr>
            <th colspan="2" class="text-center">Instance Variables</th>
        </tr>
        <tr>
            <th class="text-center">Access Identifier / Name</th>
            <th class="text-center">Description</th>
        </tr>
        <tr>
            <td>protected $_action</td>
            <td>The action we want to perform.</td>
        </tr>
        <tr>
            <td>protected $_controller</td>
            <td>The name of the controller we will be using.</td>
        </tr>
        <tr>
            <td>public $request</td>
            <td>The type of request we are working with.</td>
        </tr>
        <tr>
            <td>public $view</td>
            <td>The view that will be rendered</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public function construct</th>
        </tr>
        <tr>
            <td colspan="2">Constructor for the parent Controller class.  This constructor gets called when an instance of the child class is instantiated.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$controller The name of the controller obtained while parsing the URL.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$action The name of the action specified in the path of the URL.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public function jsonResponse</th>
        </tr>
        <tr>
            <td colspan="2">Sample jsonResponse for supporting AJAX requests.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">mixed</td>
            <td>$res The JSON response.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25" colspan="2">void</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm mb-5">
        <tr>
            <th colspan="2" class="text-center">function onConstruct</th>
        </tr>
        <tr>
            <td colspan="2">Function implemented by child model classes when models are instantiated.</td>
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
            <td class="align-middle text-center w-25" colspan="2">void</td>
        </tr>
    </table>

    <a href="<?=APP_DOMAIN?>documentation/core" class="btn btn-sm btn-secondary mb-5">Core</a>
</div>
<?php $this->end(); ?>