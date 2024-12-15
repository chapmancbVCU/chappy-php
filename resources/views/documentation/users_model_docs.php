<?php $this->setSiteTitle("Users Model - Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>

<div class="main">
    <a href="<?=APP_DOMAIN?>documentation/models" class="btn btn-sm btn-secondary">Models</a>
    <h1 class="text-center">Users Model Class</h1>
    <div class="row align-items-center justify-content-center my-3">
        <p class="text-center w-75">Implements support for our Contact Controller.  It contains actions for handling user interactions that will result in CRUD operations against the database.</p>
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
            <td>public const blackListedFormKeys</td>
            <td>List of fields we don't want to update. For this model they are id and deleted.</td>
        </tr>
        <tr>
            <td>private $changePassword</td>
            <td>Boolean flag when set to true allows operations needed for changing password.  Currently used to assist in validation when changing a password.</td>
        </tr>
        <tr>
            <td>private $_confirm</td>
            <td>Used by registration process for representing confirm field for password.</td>
        </tr>
        <tr>
            <td>public $created_at</td>
            <td>Timestamp for when this record was created.</td>
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
            <td>public $description</td>
            <td>Description for a user.  Represents the description field in the user database table.</td>
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
            <td>public $inactive</td>
            <td>Tiny int value that represents whether or not a user's account is active or inactive.</td>
        </tr>
        <tr>
            <td>public $lname</td>
            <td>This user's last name.  Represents the lname field in the contacts database table.</td>
        </tr>
        <tr>
            <td>public $login_attempts</td>
            <td>Tracks failed login attempts for a user.</td>
        </tr>
        <tr>
            <td>pubic $reset_password</td>
            <td>Tiny int value that when set to 1 causes user to be prompted to set a new password.</td>
        </tr>
        <tr>
            <td>public $password</td>
            <td>The password for this user.  Represents the password field in the users database table.</td>
        </tr>
        <tr>
            <td>protected static $_softDelete</td>
            <td>Handles soft delete operations. When false we perform delete if true we set the delete flag to 1. Default value is false.</td>
        </tr>
        <tr>
            <td>protected static $_table</td>
            <td>The name of the table for this model. Currently set to users.</td>
        </tr>
        <tr>
            <td>public $updated_at</td>
            <td>Timestamp for when this record was last updated.</td>
        </tr>
        <tr>
            <td>public $userName</td>
            <td>The username for this user.  Represents the username field in the users table.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
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

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function aclToId</th>
        </tr>
        <tr>
            <td colspan="2">Gets id for user assigned ACL and assist in setup of web form for updating user's ACL.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$user_acl The user's current ACL.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$aclArray Array of ACLs in format that can be used to populate dropdown forms.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">int</td>
            <td>$key The id of the ACL.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function addAcl</th>
        </tr>
        <tr>
            <td colspan="2">Add ACL to user's acl field as an element of an array.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">int</td>
            <td>$user_id The id of the user whose acl field we want to modify.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$acl The name of the new ACL.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">bool</td>
            <td>True or false depending on success of operation.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public function beforeSave</th>
        </tr>
        <tr>
            <td colspan="2">Implements beforeSave function described in Model parent class.  Ensures password is not in plain text but a hashed one.  The reset_password flag is also set to 0.</td>
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

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
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

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public function findAllUsersExceptCurrent</th>
        </tr>
        <tr>
            <td colspan="2">Retrieves a list of all users except current logged in user.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">int</td>
            <td>$current_user_id The id of the currently logged in user.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$params Used to build conditions for database query.  The default value is an empty array.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>The list of users that is returned from the database.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function findByUserName</th>
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

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function findUserByAcl</th>
        </tr>
        <tr>
            <td colspan="2">Retrieves a list of users who are assigned to a particular acl.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$acl The ACL we want to use in our query.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">object</td>
            <td>An individual user who is assigned to an acl.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public function hashPassword</th>
        </tr>
        <tr>
            <td colspan="2">Hashes password.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$password Original password submitted on a registration or update password form.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">void</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function idToAcl</th>
        </tr>
        <tr>
            <td colspan="2">Take id from form post and return ACL in format that can be added to users table.  May not necessarily be actual id of ACL in acl table.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">int</td>
            <td>$acl_value The value for ACL from form POST.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$aclArray Array of ACLs in format that can be used to populate dropdown forms.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$key The id of the ACL.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public function isInactiveChecked</th>
        </tr>
        <tr>
            <td colspan="2">Assists in setting value of inactive field based on POST.</td>
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
            <td class="align-middle text-center w-25">int</td>
            <td>$inactive The value for inactive based on value received from POST.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public function isResetPWChecked</th>
        </tr>
        <tr>
            <td colspan="2">Assists in setting value of reset_password field based on POST.</td>
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
            <td class="align-middle text-center w-25">int</td>
            <td>$reset_password The value for reset_password based on value received from POST.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
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

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function loginAttempts</th>
        </tr>
        <tr>
            <td colspan="2">Tests for login attempts and sets session messages when there is a failed attempt or when account is locked.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">User</td>
            <td>$user The user whose login attempts we are tracking.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">Login</td>
            <td>$loginModel The model that will be responsible for displaying messages.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">Login</td>
            <td>$loginModel The Login model after login in attempt test and session messages are assigned.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
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

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
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

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function removeAcl</th>
        </tr>
        <tr>
            <td colspan="2">Add ACL to user's acl field as an element of an array.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">int</td>
            <td>$user_id The id of the user whose acl field we want to modify.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$acl The name of the ACL to be removed.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">bool</td>
            <td>True or false depending on success of operation.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function setAclAtRegistration</th>
        </tr>
        <tr>
            <td colspan="2">Sets ACL at registration.  If users table is empty the default value is Admin.  Otherwise, we set the value to Standard.</td>
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
            <td class="align-middle text-center w-25">string</td>
            <td>The value of the ACL we are setting upon registration of a user.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public function setChangePassword</th>
        </tr>
        <tr>
            <td colspan="2">Setter function for $changePassword.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">bool</td>
            <td>$value The value we will assign to $changePassword.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">void</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm mb-5">
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
    <a href="<?=APP_DOMAIN?>documentation/models" class="btn btn-sm btn-secondary mb-5">Models</a>
</div>
<?php $this->end(); ?>