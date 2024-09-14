<?php $this->setSiteTitle("Admindashboard - Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>

<div class="main">
    <a href="<?=APP_DOMAIN?>documentation/controllers" class="btn btn-xs btn-secondary">Controllers</a>
    <h1 class="text-center">Admindashboard Controller Class</h1>
    <div class="row align-items-center justify-content-center my-3">
        <p class="text-center w-75">Add description here</p>
    </div>

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">Extends</th>
        </tr>
        <tr>
            <td colspan="2" class="text-center">Controller</td>
        </tr>
        <tr>
            <th colspan="2" class="text-center">Namespace</th>
        </tr>
        <tr>
            <td colspan="2" class="text-center">App\Controllers</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" rowspan="8">Use</th>
            <td>Core\Controller</td>
        </tr>
        <tr><td>App\Models\ACL</td></tr>
        <tr><td>Core\Controller</td></tr>
        <tr><td>App\Models\ProfileImages</td></tr>
        <tr><td>Core\Router</td></tr>
        <tr><td>Core\Session</td></tr>
        <tr><td>App\Models\Users</td></tr>
        <tr><td>App\Lib\Utilities\Uploads</td></tr>
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
            <th colspan="2" class="text-center">public function addAcl</th>
        </tr>
        <tr>
            <td colspan="2">Renders add acl view and adds ACL to acl table.</td>
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

    <a href="<?=APP_DOMAIN?>documentation/controllers" class="btn btn-xs btn-secondary mb-5">Controllers</a>
</div>
<?php $this->end(); ?>