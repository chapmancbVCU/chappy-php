<?php $this->setSiteTitle("Session - Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>
<?php include('docs_nav.php'); ?>

<div class="main">
    <a href="<?=PROOT?>documentation/core" class="btn btn-xs btn-secondary">Core</a>
    <h1 class="text-center">Session Class</h1>
    <div class="row align-items-center justify-content-center my-3">
        <p class="text-center w-75">Supports functions for user sessions.  This class never gets instantiated.</p>
    </div>

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">Extends</th>
        </tr>
        <tr>
            <td colspan="2" class="text-center">None</td>
        </tr>
        <tr>
            <th colspan="2" class="text-center">Namespace</th>
        </tr>
        <tr>
            <td colspan="2" class="text-center">Core</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25">Use</th>
            <td>None</td>
        </tr>  
        <tr>
            <th colspan="2" class="text-center">Instance Variables</th>
        </tr>
        <tr>
            <td class="text-center" colspan="2">None</td>
        </tr>
    </table>

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">public static function addMessage</th>
        </tr>
        <tr>
            <td colspan="2">Adds a session alert message.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$type Can be info, success, warning, or danger.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$message The message you want to display in the alert.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="text-center" colspan="2">void</td>
        </tr>
    </table>
    
    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">public static function delete</th>
        </tr>
        <tr>
            <td colspan="2">Removes CURRENT_USER_SESSION_NAME from th $_SESSION superglobal array when a user logs out of a user session.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">int</td>
            <td>$name The CURRENT_USER_SESSION_NAME associated with the current user session.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="text-center" colspan="2">void</td>
        </tr>
    </table>

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">public static function displayMessage</th>
        </tr>
        <tr>
            <td colspan="2">Displays messages related to actions a user may perform.</td>
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
            <td class="align-middle text-center w-25">string</td>
            <td>A HTML element containing a message along with a button button to dismiss the message.</td>
        </tr>
    </table>

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">public static function exists</th>
        </tr>
        <tr>
            <td colspan="2">Checks if a session by user name exists.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">int</td>
            <td>$name The id of the user associated with a particular session.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">bool</td>
            <td>True if the session exists.  Otherwise we return false.</td>
        </tr>
    </table>

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">public static function get</th>
        </tr>
        <tr>
            <td colspan="2">Getter function that returns the $_SESSION superglobal associative array.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">int</td>
            <td>$name The id of the user associated with a particular session.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">int</td>
            <td>Element in the $_SESSION superglobal array for CURRENT_USER_SESSION_NAME set as id for current logged in user.</td>
        </tr>
    </table>

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">public static function set</th>
        </tr>
        <tr>
            <td colspan="2">Sets value to $_SESSION name key.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25"></td>
            <td>$name The current user session name.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25"></td>
            <td>$value The id of the user associated with a particular session.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25"></td>
            <td>Element in the $_SESSION superglobal array for CURRENT_USER_SESSION_NAME set as id for current logged in user.</td>
        </tr>
    </table>

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto mb-5">
        <tr>
            <th colspan="2" class="text-center">public static function uagent_no_version</th>
        </tr>
        <tr>
            <td colspan="2">Don't store browser version numbers so we don't break session during end user software updates.</td>
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
            <td class="align-middle text-center w-25"></td>
            <td>User agent information with the browser version removed.</td>
        </tr>
    </table>
    <a href="<?=PROOT?>documentation/core" class="btn btn-xs btn-secondary mb-5">Core</a>
</div>
<script src="<?=PROOT?>public/js/docNavDropdown.js"></script>
<?php $this->end(); ?>