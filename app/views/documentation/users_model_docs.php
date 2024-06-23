<?php $this->setSiteTitle("Users Model - Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>
<?php include('docs_nav.php'); ?>

<div class="main">
<a href="<?=PROOT?>documentation/models" class="btn btn-xs btn-secondary">Models</a>
    <h1 class="text-center">Users Model Class</h1>
    <div class="row align-items-center justify-content-center my-3">
        <p class="text-center w-75">Implements support for our Contact Controller.  It contains actions for handling user interactions that will result in CRUD operations against the database.</p>
    </div>

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
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
            <th class="align-middle text-center w-25" rowspan="15">Use</th>
            <tr><td>Core\Cookie</td></tr>
        </tr>  
        <tr><td>Core\Validators\EmailValidator</td></tr>
        <tr><td>Core\Validators\LowerCharValidator</td></tr>
        <tr><td>Core\Validators\MaxValidator</td></tr>
        <tr><td>Core\Validators\MatchesValidator</td></tr>
        <tr><td>Core\Validators\MinValidator</td></tr>
        <tr><td>Core\Model</td></tr>
        <tr><td>Core\Validators\NumberCharValidator</td></tr>
        <tr><td>Core\Validators\RequiredValidator</td></tr>
        <tr><td>Core\Session</td></tr>
        <tr><td>Core\Validators\SpecialCharValidator</td></tr>
        <tr><td>Core\Validators\UniqueValidator</td></tr>
        <tr><td>Core\Validators\UpperCharValidator</td></tr>
        <tr><td>App\Models\UserSessions</td></tr>
        <tr>
            <th colspan="2" class="text-center">Instance Variables</th>
        </tr>
        <tr>
            <th class="text-center">Access Identifier / Name</th>
            <th class="text-center">Description</th>
        </tr>
        <tr>
            <td>public $acl</td>
            <td>Access control list level.  Represents the acl field in the users table.</td>
        </tr>
        <tr>
            <td>private $_confirm</td>
            <td>Used by registration process for representing confirm field for password.</td>
        </tr>
        <tr>
            <td>private $_cookieName</td>
            <td>Value of cookie for current session.</td>
        </tr>
        <tr>
            <td>private static $currentLoggedInUser</td>
            <td>Database information for current logged in user.</td>
        </tr>
        <tr>
            <td>public $deleted</td>
            <td>With an initial value of 0, when set to 1 the corresponding field in the users table is set.  Supports ability to soft delete.</td>
        </tr>
        <tr>
            <td>public $email</td>
            <td>This user's E-mail address.  Represents the email field in the users database table.</td>
        </tr>
        <tr>
            <td>public $fname</td>
            <td>This user's first name.  Represents the fname field in the users database table.</td>
        </tr>
        <tr>
            <td>public $id</td>
            <td>The integer primary key for this user.  Represents the id field in the users database table.</td>
        </tr>
        <tr>
            <td>public $lname</td>
            <td>This user's last name.  Represents the lname field in the contacts database table.</td>
        </tr>
        <tr>
            <td>public $password</td>
            <td>The password for this user.  Represents the password field in the users database table.</td>
        </tr>
        <tr>
            <td>private $_sessionName </td>
            <td>The name for the current session.  Represents the session filed associated with this user in the user_sessions table.</td>
        </tr>
        <tr>
            <td>public $userName</td>
            <td>The username for this user.  Represents the username field in the users table.</td>
        </tr>
        </table>

    <hr class="w-75 my-5">



    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto mb-5">
        <tr>
            <th colspan="2" class="text-center">public function validator</th>
        </tr>
        <tr>
            <td colspan="2">Performs validation on the user registration form.</td>
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
    <a href="<?=PROOT?>documentation/models" class="btn btn-xs btn-secondary mb-5">Models</a>
</div>
<script src="<?=PROOT?>public/js/docNavDropdown.js"></script>
<?php $this->end(); ?>