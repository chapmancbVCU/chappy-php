<?php $this->setSiteTitle("Contracts Controller - Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>
<?php include('docs_nav.php'); ?>

<div class="main">
    <a href="<?=PROOT?>documentation/controllers" class="btn btn-xs btn-secondary">Controllers</a>
    <h1 class="text-center">Contacts Controller Class</h1>
    <div class="row align-items-center justify-content-center my-3">
        <p class="text-center w-75">Implements support for our Contact Controller.  It contains actions for handling user interactions that will result in CRUD operations against the database.</p>
    </div>

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">Namespace</th>
        </tr>
        <tr>
            <td colspan="2">App\Controllers</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" rowspan="4">Use</th>
            <td>Core\Controller</td>
        </tr>  
        <tr><td>Core\Router</td></tr>
        <tr><td>App\Models\Login</td></tr>
        <tr><td>App\Models\Users</td></tr>
    </table>

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">construct</th>
        </tr>
        <tr>
            <td colspan="2">Constructor for Register Controller.</td>
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

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">loginAction</th>
        </tr>
        <tr>
            <td colspan="2">Manages login action processes.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="text-center" colspan="2">None</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25">return</th>
            <td>void</td>
        </tr>
    </table>

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">logoutAction</th>
        </tr>
        <tr>
            <td colspan="2">Manages logout action for a user.  It checks if a user is currently logged.  No matter of the result, the user gets redirected to the login screen.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="text-center" colspan="2">None</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25">return</th>
            <td>void</td>
        </tr>
    </table>

    <hr class="w-75 my-5">
    
    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto mb-5">
        <tr>
            <th colspan="2" class="text-center">registerAction</th>
        </tr>
        <tr>
            <td colspan="2">Manages actions related to user registration.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="text-center" colspan="2">None</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25">return</th>
            <td>void</td>
        </tr>
    </table>

    <a href="<?=PROOT?>documentation/controllers" class="btn btn-xs btn-secondary mb-5">Controllers</a>
    </div>
    <script src="<?=PROOT?>public/js/docNavDropdown.js"></script>
<?php $this->end(); ?>