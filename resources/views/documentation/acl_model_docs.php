<?php $this->setSiteTitle("ACL Model - Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>

<div class="main">
    <a href="<?=APP_DOMAIN?>documentation/models" class="btn btn-sm btn-secondary">Models</a>
    <h1 class="text-center">ACL Model Class</h1>
    <div class="row align-items-center justify-content-center my-3">
        <p class="text-center w-75">Describes ACL model.</p>
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
            <th class="align-middle text-center w-25" rowspan="4">Use</th>
            <tr><td>Core\Model</td></tr>
        </tr>  
        <tr><td>Core\Validators\RequiredValidator</td></tr>
        <tr><td>Core\Validators\UniqueValidator</td></tr>
        <tr>
            <th colspan="2" class="text-center">Instance Variables</th>
        </tr>
        <tr>
            <th class="text-center">Access Identifier / Name</th>
            <th class="text-center">Description</th>
        </tr>
        <tr>
            <td>public $acl</td>
            <td>The value for this ACL</td>
        </tr>
        <tr>
            <td>public const blackList</td>
            <td>List of fields we don't want to update.  For this model they are id and deleted.</td>
        </tr>
        <tr>
            <td>public $created_at</td>
            <td>Timestamp for when this record was created.</td>
        </tr>
        <tr>
            <td>public $deleted</td>
            <td>With an initial value of 0, when set to 1 the corresponding field in the acl table is set. Supports ability to soft delete.</td>
        </tr>
        <tr>
            <td>public $id</td>
            <td>The integer primary key for this acl. Represents the id field in the acl database table.</td>
        </tr>
        <tr>
            <td>protected static $_softDelete</td>
            <td>Handles soft delete operations. When false we perform delete if true we set the delete flag to 1. Default value is false.</td>
        </tr>
        <tr>
            <td>protected static $_table</td>
            <td>The name of the table for this model.  Currently set to acl.</td>
        </tr>
        <tr>
            <td>public $updated_at</td>
            <td>Timestamp for when this record was last updated.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public function beforeSave</th>
        </tr>
        <tr>
            <td colspan="2">Implements beforeSave function described in Model parent class.  Ensures timestamps are created and updated.</td>
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

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm ">
        <tr>
            <th colspan="2" class="text-center">public function getOptionsForForm</th>
        </tr>
        <tr>
            <td colspan="2">Generates list of ACL options based on ACL table.</td>
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

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm ">
        <tr>
            <th colspan="2" class="text-center">public static function getACLs</th>
        </tr>
        <tr>
            <td colspan="2">Retrieves list of all ACLs sorted by the acl field.</td>
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
            <td class="align-middle text-center w-25">array</td>
            <td>The list of ACLs that is returned from the database.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function trimACL</th>
        </tr>
        <tr>
            <td colspan="2">Trims quotes and brackets off of ACL until we figure out better way.  Plan to depreciate after future updates.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$acl The ACL field from a record in the Users table.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$acl The acl after quotes and brackets are removed.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm mb-5">
        <tr>
            <th colspan="2" class="text-center">public function validator</th>
        </tr>
        <tr>
            <td colspan="2">Ensures fields are required and unique.</td>
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

    <a href="<?=APP_DOMAIN?>documentation/models" class="btn btn-sm btn-secondary mb-5">Models</a>
</div>
<?php $this->end(); ?>