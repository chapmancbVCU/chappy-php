<?php $this->setSiteTitle("Router - Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>
<?php include(ROOT . DS . 'app' . DS . 'views/layouts/docs_nav.php'); ?>

<div class="main">
    <a href="<?=APP_DOMAIN?>documentation/core" class="btn btn-xs btn-secondary">Core</a>
    <h1 class="text-center">Router Class</h1>
    <div class="row align-items-center justify-content-center my-3">
        <p class="text-center w-75">This class is responsible for routing between views.</p>
    </div>

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
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
            <th class="align-middle text-center w-25" rowspan="2">Use</th>
            <tr><td>App\Model\Users</td></tr>
        </tr>  
        <tr><td>Core\Session</td></tr>
        <tr>
            <th colspan="2" class="text-center">Instance Variables</th>
        </tr>
        <tr>
            <td class="text-center" colspan="2">None</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">private function get_link</th>
        </tr>
        <tr>
            <td colspan="2">Gets link based on value from acl.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$value item in acl that will be used to create a link.  </td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">bool|string</td>
            <td>False if the user does not have access to a controller or action.  Otherwise we return the value so we can create a link.</td>
        </tr>
    </table>


    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function getMenu</th>
        </tr>
        <tr>
            <td colspan="2">Parses menu_acl.json file to determine menu contents depending on acl of user.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$menu Name of menu acl file.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>The array of menu items.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function hasAccess</th>
        </tr>
        <tr>
            <td colspan="2">Checks if user has access to a particular section of the site and grants access if that is the case.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25"></td>
            <td>$controller_name The name of the controller we want to test before granting the user access to a particular section of the site.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25"></td>
            <td>$action_name The name of the action the user wants to perform.  The default value is "index".</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">bool</td>
            <td>$grantAccess True if we give access, otherwise false.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function redirect</th>
        </tr>
        <tr>
            <td colspan="2">Performs redirect operations.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$location The view where we will redirect the user.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="text-center" colspan="2">void</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm mb-5">
        <tr>
            <th colspan="2" class="text-center">public static function route</th>
        </tr>
        <tr>
            <td colspan="2">Supports operations for routing.  It parses the url to determine which page needs to be rendered.  That path is parsed to determine the correct controller and action to use.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$url The path that contains information about the controller and action to use.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="text-center" colspan="2">void</td>
        </tr>
    </table>

    
    <a href="<?=APP_DOMAIN?>documentation/core" class="btn btn-xs btn-secondary mb-5">Core</a>
</div>
<script src="<?=APP_DOMAIN?>public/js/docNavDropdown.js"></script>
<?php $this->end(); ?>