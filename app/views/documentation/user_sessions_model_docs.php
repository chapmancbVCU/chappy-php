<?php $this->setSiteTitle("UserSessions Model - Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>
<?php include('docs_nav.php'); ?>

<div class="main">
<a href="<?=PROOT?>documentation/models" class="btn btn-xs btn-secondary">Models</a>
    <h1 class="text-center">UsersSessions Model Class</h1>
    <div class="row align-items-center justify-content-center my-3">
        <p class="text-center w-75">Supports operations of the User Session model.</p>
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
            <tr><td>Core\Cookie</td></tr>
        </tr>
        <tr><td>Core\Model</td></tr>
        <tr><td>Core\Session</td></tr>
        <tr>
            <th colspan="2" class="text-center">Instance Variables</th>
        </tr>
        <tr>
            <th class="text-center">Access Identifier / Name</th>
            <th class="text-center">Description</th>
        </tr>
        <tr>
            <td>public $id</td>
            <td>The integer primary key ID for current user session.</td>
        </tr>
        <tr>
            <td>public $session</td>
            <td>MD5 has that represents name of user session.</td>
        </tr>
        <tr>
            <td>public $user_agent</td>
            <td>Browser information for current logged in user.</td>
        </tr>
        <tr>
            <td>public $user_id</td>
            <td>The integer primary key for current logged in user.</td>
        </tr>
    </table>

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">public function construct</th>
        </tr>
        <tr>
            <td colspan="2">Creates new instance of UserSessions model.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="text-center" colspan="2">None</td>
        </tr>
    </table>

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto mb-5">
        <tr>
            <th colspan="2" class="text-center">public function getFromCookie</th>
        </tr>
        <tr>
            <td colspan="2">Retrieves User Session information from cookie.</td>
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
            <td class="align-middle text-center w-25">bool|UserSessions</td>
            <td>An object containing information about the current user's session.  If a user session does not exist false is returned.</td>
        </tr>
    </table>

    <a href="<?=PROOT?>documentation/models" class="btn btn-xs btn-secondary mb-5">Models</a>
</div>
<script src="<?=PROOT?>public/js/docNavDropdown.js"></script>
<?php $this->end(); ?>