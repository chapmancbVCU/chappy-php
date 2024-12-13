<?php $this->setSiteTitle("Profile Images Model - Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>

<div class="main">
    <a href="<?=APP_DOMAIN?>documentation/models" class="btn btn-xs btn-secondary">Models</a>
    <h1 class="text-center">ProfileImages Model Class</h1>
    <div class="row align-items-center justify-content-center my-3">
        <p class="text-center w-75">Supports CRUD operations on profile images.</p>
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
            <td>protected static $allowedFileTypes</td>
            <td>An array of allowed file types.</td>
        </tr>
        <tr>
            <td>public $deleted</td>
            <td>With an initial value of 0, when set to 1 the corresponding field in the profile_images table is set. Supports ability to soft delete.</td>
        </tr>
        <tr>
            <td>public $id</td>
            <td>The integer primary key for this profile image. Represents the id field in the profile_images database table.</td>
        </tr>
        <tr>
            <td>protected static $maxAllowedFileSize</td>
            <td>The max allowed size for profile images.</td>
        </tr>
        <tr>
            <td>public $name</td>
            <td>The name for this profile image.</td>
        </tr>
        <tr>
            <td>protected static $_softDelete</td>
            <td>Handles soft delete operations. When false we perform delete if true we set the delete flag to 1. Default value is false.</td>
        </tr>
        <tr>
            <td>public $sort</td>
            <td>The position for this profile image when sorting.</td>
        </tr>
        <tr>
            <td>protected static $_table</td>
            <td>The name of the table for this model.  Currently set to profile_images.</td>
        </tr>
        <tr>
            <td>protected static $_uploadPath</td>
            <td>Destination directory for profile images.  Can be set to another location for production.</td>
        </tr>
        <tr>
            <td>public $url</td>
            <td>Database field that stores location of image.</td>
        </tr>
        <tr>
            <td>$user_id</td>
            <td>The id for the user associated with this profile image.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function deleteById</th>
        </tr>
        <tr>
            <td colspan="2">Deletes a profile image by id.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">int</td>
            <td>$id The id of the image we want to delete.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">bool</td>
            <td>Result of delete operation.  True if success, otherwise false.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function findCurrentProfileImage</th>
        </tr>
        <tr>
            <td colspan="2">Returns currently set profile image for a user.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">int</td>
            <td>$user_id The id of the user whose profile image we want to retrieve.</td>
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

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function findByUserId</th>
        </tr>
        <tr>
            <td colspan="2">Finds all profile images for a user.</td>
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
            <td class="align-middle text-center w-25">bool|array</td>
            <td>The associative array of profile image records for a user.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function findByUserId</th>
        </tr>
        <tr>
            <td colspan="2">Finds all profile images for a user.</td>
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
            <td class="align-middle text-center w-25">bool|array</td>
            <td>The associative array of profile image records for a user.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function getMaxAllowedFileSize</th>
        </tr>
        <tr>
            <td colspan="2">Getter function for $maxAllowedFileSize.</td>
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
            <td>$maxAllowedFileSize The max file size for an individual file.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function updateSortByUserId</th>
        </tr>
        <tr>
            <td colspan="2">Getter function for $maxAllowedFileSize.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">int</td>
            <td>$user_id The id of the user whose profile images we want to sort.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">int</td>
            <td>$sortOrder An array containing sort values for a profile image.</td>
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
            <th colspan="2" class="text-center">public static function uploadProfileImage</th>
        </tr>
        <tr>
            <td colspan="2">Performs upload operation for a profile image.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">int</td>
            <td>$user_id The id of the user that the upload operation is performed upon.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">Uploads</td>
            <td>$uploads The instance of the Uploads class for this upload.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">void</td>
        </tr>
    </table>

    <a href="<?=APP_DOMAIN?>documentation/models" class="btn btn-xs btn-secondary mb-5">Models</a>
</div>
<?php $this->end(); ?>