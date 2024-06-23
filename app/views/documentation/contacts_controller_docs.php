<?php $this->setSiteTitle("Contacts Controller - Custom MVC Framework Docs"); ?>
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
            <th class="align-middle text-center w-25" rowspan="5">Use</th>
            <td>Core\Controller</td>
        </tr>  
        <tr><td>Core\Session</td></tr>
        <tr><td>Core\Router</td></tr>
        <tr><td>App\Models\Contacts</td></tr>
        <tr><td>App\Models\Users</td></tr>
    </table>

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">public function construct</th>
        </tr>
        <tr>
            <td colspan="2">Constructor for the Contacts Controller.  It sets the default layout and loads the Contacts model.</td>
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
            <th colspan="2" class="text-center">public function addAction</th>
        </tr>
        <tr>
            <td colspan="2">Displays view for adding a new contact, assists with form validation, and begins task for saving record to database.</td>
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
            <th colspan="2" class="text-center">public function deleteAction</th>
        </tr>
        <tr>
            <td colspan="2">Performs delete operation on a contact and redirects user back to the  index contacts view.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">int</td>
            <td>$id The ID of the contact to be deleted.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25">return</th>
            <td>void</td>
        </tr>
    </table>

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">public function detailsAction</th>
        </tr>
        <tr>
            <td colspan="2">Retrieves information for a contact and render its details.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">int</td>
            <td>$id The ID of the contact to be deleted.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25">return</th>
            <td>void</td>
        </tr>
    </table>

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">public function editAction</th>
        </tr>
        <tr>
            <td colspan="2">Retrieves contact by ID and sets up view for editing a contact.  If form validation fails the page is displayed again with the appropriate messages.  If the contact does not exist the user is redirected to he main contacts page.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">int</td>
            <td>$id The ID of the contact to be deleted.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25">return</th>
            <td>void</td>
        </tr>
    </table>

    <hr class="w-75 my-5">
    
    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto mb-5">
        <tr>
            <th colspan="2" class="text-center">public function indexAction</th>
        </tr>
        <tr>
            <td colspan="2">The index action loads the home page for contacts that lists all  contacts associated with a particular user.</td>
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