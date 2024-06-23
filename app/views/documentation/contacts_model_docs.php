<?php $this->setSiteTitle("Contacts Model - Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>
<?php include('docs_nav.php'); ?>

<div class="main">
    <a href="<?=PROOT?>documentation/models" class="btn btn-xs btn-secondary">Models</a>
    <h1 class="text-center">Contacts Model Class</h1>
    <div class="row align-items-center justify-content-center my-3">
        <p class="text-center w-75">Supports functions for handling Contacts such as displaying information, form validation, and DB operations.</p>
    </div>

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">Namespace</th>
        </tr>
        <tr>
            <td colspan="2">App\Models</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" rowspan="4">Use</th>
            <tr><td>Core\Model</td></tr>
        </tr>  
        <tr><td>Core\Validators\MaxValidator</td></tr>
        <tr><td>Core\Validators\RequiredValidator</td></tr>
        <tr>
            <th colspan="2" class="text-center">Instance Variables</th>
        </tr>
        <tr>
            <th class="text-center">Access Identifier / Name</th>
            <th class="text-center">Description</th>
        </tr>
        <tr>
            <td>public $address</td>
            <td>The address for a contact.  Represents the address field in contacts database table.</td>
        </tr>
        <tr>
            <td>public $address2</td>
            <td>The second address variable for a contact.  Represents the address2 field in contacts database table when required.</td>
        </tr>
        <tr>
            <td>public $cell_phone</td>
            <td>The cellphone for a contact.  Represents the cellphone field in the contacts database table.</td>
        </tr>
        <tr>
            <td>public $city</td>
            <td>The city where a contact resides.  Represents the city field in the contacts database table.</td>
        </tr>
        <tr>
            <td>public $deleted</td>
            <td>With an initial value of 0, when set to 1 the corresponding field in the contacts table is set.  Supports ability to soft delete.</td>
        </tr>
        <tr>
            <td>public $email</td>
            <td>The contact's E-mail address.  Represents the email field in the contacts database table.</td>
        </tr>
        <tr>
            <td>public $fname</td>
            <td>The contact's first name.  Represents the fname field in the contacts database table.</td>
        </tr>
        <tr>
            <td>public $home_phone</td>
            <td>The home phone for a contact.  Represents the home phone field in the contacts database table.</td>
        </tr>
        <tr>
            <td>public $id</td>
            <td>The integer primary key for this contact.  Represents the id field in the contacts database table.</td>
        </tr>
        <tr>
            <td>public $lname</td>
            <td>The contact's last name.  Represents the lname field in the contacts database table.</td>
        </tr>
        <tr>
            <td>public $state</td>
            <td>The state where a contact resides.  Represents the state field in the contacts database table.</td>
        </tr>
        <tr>
            <td>public $user_id</td>
            <td>The integer primary key for the user associated with this contact.  Represents the user_id field in the contacts database table.</td>
        </tr>
        <tr>
            <td>public $work_phone</td>
            <td>The work phone for a contact.  Represents the work phone field in the contacts database table.</td>
        </tr>
        <tr>
            <td>public $zip</td>
            <td>The zip code where a contact resides.  Represents the zip field in the contacts database table.</td>
        </tr>

    </table>

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">public function construct</th>
        </tr>
        <tr>
            <td colspan="2">Constructor for the Contacts model class.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="text-center" colspan="2">None</td>
        </tr>
    </table>

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">public function displayAddress</th>
        </tr>
        <tr>
            <td colspan="2">Formats address to conform to form factor of an address label.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="text-center" colspan="2">None</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25">return</th>
            <td>$html The formatted address.</td>
        </tr>
    </table>

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">public function displayAddressLabel</th>
        </tr>
        <tr>
            <td colspan="2">Displays contact information in an address label format.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="text-center" colspan="2">None</td>
        </tr>
        <tr>
            <td colspan="2">$html The contact information in an address label format.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25">return</th>
            <td>$html The contact information in an address label format.</td>
        </tr>
    </table>

    <hr class="w-75 my-5">
    
    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">public function displayName</th>
        </tr>
        <tr>
            <td colspan="2">Displays name in following format: ${firstName}, ${lastName}.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="text-center" colspan="2">None</td>
        </tr>
        <tr>
            <td colspan="2">$html The contact information in an address label format.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25">return</th>
            <td>Returns first name and last name.</td>
        </tr>
    </table>

    <hr class="w-75 my-5">

    <a href="<?=PROOT?>documentation/models" class="btn btn-xs btn-secondary mb-5">Models</a>
</div>
<script src="<?=PROOT?>public/js/docNavDropdown.js"></script>
<?php $this->end(); ?>