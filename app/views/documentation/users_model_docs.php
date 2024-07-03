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

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">public function construct</th>
        </tr>
        <tr>
            <td colspan="2">Builds instance of Users model class.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$user The name of the user.  Default value is an empty string.</td>
        </tr>
        </tr>
    </table>

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">public function acls</th>
        </tr>
        <tr>
            <td colspan="2">Returns an array containing access control list information.  When the $acl instance variable is empty an empty array is returned.</td>
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
            <td>The array containing access control list information.</td>
        </tr>
    </table>

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">public function beforeSave</th>
        </tr>
        <tr>
            <td colspan="2">Implements beforeSave function described in Model parent class.  Ensures password is not in plain text but a hashed one.</td>
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

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">public function currentUser</th>
        </tr>
        <tr>
            <td colspan="2">Checks if a user is logged in.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">none</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">object|null</td>
            <td>An object containing information about current logged in user from users table.</td>
        </tr>
    </table>

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">public function findByUserName</th>
        </tr>
        <tr>
            <td colspan="2">Finds user by username in the Users table.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$username The username we want to find in the Users table.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">bool|object</td>
            <td>An object containing information about a user from the Users table.</td>
        </tr>
    </table>

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">public function getConfirm</th>
        </tr>
        <tr>
            <td colspan="2">Getter function for $_confirm instance variable.</td>
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
            <td>The value for $_confirm.</td>
        </tr>
    </table>

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">public function login</th>
        </tr>
        <tr>
            <td colspan="2">Creates a session when the user logs in.  A new record is added to the user_sessions table and a cookie is created if remember me is selected.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">bool</td>
            <td>$rememberMe Value obtained from remember me checkbox found in login form.  Default value is false.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25" colspan="2">void</td>
        </tr>
    </table>

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">public function logout</th>
        </tr>
        <tr>
            <td colspan="2">Perform logout operation on current logged in user.  The record for the current logged in user is removed from the user_session table and the corresponding cookie is deleted.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25" colspan="2">none</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">bool</td>
            <td>Returns true if operation is successful.</td>
        </tr>
    </table>

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">public function loginUserFromCookie</th>
        </tr>
        <tr>
            <td colspan="2">Logs in user from cookie.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25" colspan="2">none</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">User</td>
            <td>The user associated with previous session.</td>
        </tr>
    </table>

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">public function setConfirm</th>
        </tr>
        <tr>
            <td colspan="2">Setter function for $_confirm instance variable.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$username The username we want to find in the Users table.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25" colspan="2">void</td>
        </tr>
    </table>

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