<?php $this->setSiteTitle("Helper - Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>

<div class="main">
    <a href="<?=APP_DOMAIN?>documentation/core" class="btn btn-sm btn-secondary">Core</a>
    <h1 class="text-center">Helper Class</h1>
    <div class="row align-items-center justify-content-center my-3">
        <p class="text-center w-75">Helper and utility functions.</p>
    </div>

    <table class="table table-striped  table-bordered table-hover w-75 mx-auto table-sm">
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
        <td class="align-middle text-center w-25" colspan="2">void</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped  table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function buildMenuListItems</th>
        </tr>
        <tr>
            <td colspan="2">Creates list of menu items.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$menu The list of menu items containing the name and the URL path.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$dropdownClass The name of the classes that maybe set depending on user input.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string|false</td>
            <td>Returns the contents of the active output buffer on success or false on failure.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped  table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function cl</th>
        </tr>
        <tr>
            <td colspan="2">Prints to console using JavaScript.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$output The information we want to print to console.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">bool</td>
            <td>$with_script_tags - Determines if we will use script tabs in our output.  Default value is true.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25" colspan="2">void</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped  table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function currentPage</th>
        </tr>
        <tr>
            <td colspan="2">Determines current page based on REQUEST_URI.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25" colspan="2">None</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$currentPage  The current page.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped  table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function dnd</th>
        </tr>
        <tr>
            <td colspan="2">Performs var_dump of parameter and kills the page.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">mixed</td>
            <td>$data Contains the data we wan to print to the page.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25" colspan="2">void</td>
        </tr>
    </table>
   
    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped  table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function getObjectProperties</th>
        </tr>
        <tr>
            <td colspan="2">Gets the properties of the given object</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">object</td>
            <td>$object An object instance.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>An associative array of defined object accessible non-static properties for the specified object in scope. If a property have not been assigned a value, it will be returned with a null value.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped  table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function getProfileImage</th>
        </tr>
        <tr>
            <td colspan="2">Retrieves URL user's current profile image.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25" colspan="2">None</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">bool|array</td>
            <td>The associative array for the profile image's record.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped  table-bordered table-hover w-75 mx-auto table-sm mb-5">
        <tr>
            <th colspan="2" class="text-center">public static function timeStamps</th>
        </tr>
        <tr>
            <td colspan="2">Generates a timestamp.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25" colspan="2">None</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>A timestamp in the format Y-m-d H:i:s UTC time.</td>
        </tr>
    </table>

    <a href="<?=APP_DOMAIN?>documentation/core" class="btn btn-sm btn-secondary mb-5">Core</a>
</div>
<?php $this->end(); ?>