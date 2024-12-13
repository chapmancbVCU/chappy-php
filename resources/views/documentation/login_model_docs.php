<?php $this->setSiteTitle("Login Model - Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>

<div class="main">
<a href="<?=APP_DOMAIN?>documentation/models" class="btn btn-xs btn-secondary">Models</a>
    <h1 class="text-center">Login Model Class</h1>
    <div class="row align-items-center justify-content-center my-3">
        <p class="text-center w-75">Supports functions for the Login model.</p>
    </div>

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">Extends</th>
        </tr>
        <tr>
            <td colspan="2" class="text-center">Model</td>
        </tr>
        <tr>
            <th colspan="2" class="text-center">Namespace</th>
        </tr>
        <tr>
            <td colspan="2" class="text-center">App\Models</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" rowspan="3">Use</th>
            <tr><td>Core\Model</td></tr>
        </tr>  
        <tr><td>Core\Validators\RequiredValidator</td></tr>
        <tr>
            <th colspan="2" class="text-center">Instance Variables</th>
        </tr>
        <tr>
            <th class="text-center">Access Identifier / Name</th>
            <th class="text-center">Description</th>
        </tr>
        <tr>
            <td>public $password</td>
            <td>The user's password</td>
        </tr>
        <tr>
            <td>public $remember_me</td>
            <td>When set the login is remembered between browser an tab sessions.</td>
        </tr>
        <tr>
            <td>public $username</td>
            <td>The username for the current user.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public function construct</th>
        </tr>
        <tr>
            <td colspan="2">Constructor for the Login class.  There is no controller for the Login model.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="text-center" colspan="2">None</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public function getRememberMeChecked</th>
        </tr>
        <tr>
            <td colspan="2">Returns result for remember me checkbox so user stays logged in if it's checked.</td>
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
            <td>The value for remember_me checkbox.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm mb-5">
        <tr>
            <th colspan="2" class="text-center">public function validator</th>
        </tr>
        <tr>
            <td colspan="2">Performs form validation checks for the login screen.</td>
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
    <a href="<?=APP_DOMAIN?>documentation/models" class="btn btn-xs btn-secondary mb-5">Models</a>
</div>
<?php $this->end(); ?>