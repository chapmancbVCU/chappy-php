<?php $this->setSiteTitle("Uploads - Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>

<div class="main">
    <a href="<?=APP_DOMAIN?>documentation/Lib" class="btn btn-xs btn-secondary">Lib</a>
    <h1 class="text-center">Uploads Class</h1>
    <div class="row align-items-center justify-content-center my-3">
        <p class="text-center w-75">Provides support for file uploads.</p>
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
            <td colspan="2" class="text-center">App\Lib\Utilities</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25">Use</th>
            <td>None</td>
        </tr>  
        <tr>
            <th colspan="2" class="text-center">Instance Variables</th>
        </tr>
        <tr>
            <th class="text-center">Access Identifier / Type / Name</th>
            <th class="text-center">Description</th>
        </tr>
        <tr>
            <td>private string $_bucket</td>
            <td>Path to upload directory.</td>
        </tr>
        <tr>
            <td>private array $_allowedFileTypes</td>
            <td>Array of allowed file types.</td>
        </tr>
        <tr>
            <td>private array $_errors</td>
            <td>An array of errors.</td>
        </tr>
        <tr>
            <td>private array $_files</td>
            <td>An array of files to upload.</td>
        </tr>
        <tr>
            <td>private int $_maxAllowedSize</td>
            <td>Maximum allowable size for an upload.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public function construct</th>
        </tr>
        <tr>
            <td colspan="2">Creates instance of Uploads class.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$files Array of files to be uploaded.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$imageTypes An array containing a list of acceptable file types for a particular upload action.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$maxAllowedSize Maximum allowable size for a particular file.  This can vary depending on requirements.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">int</td>
            <td>$multiple A boolean flag to set whether or not we are working with a single file upload or an array regarding form setup.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">protected function addErrorMessage</th>
        </tr>
        <tr>
            <td colspan="2">Adds an error message to the $_errors array.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$name The name of the error.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$message The message associated with this error.</td>
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
            <th colspan="2" class="text-center">public function getFiles</th>
        </tr>
        <tr>
            <td colspan="2">Getter function for the $_files array.</td>
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
            <td>The $_files array.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function restructureFiles</th>
        </tr>
        <tr>
            <td colspan="2">Restructures files input from post into an array that can be processed.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$files A single or an array of elements in the $_FILES variable whose information will be restructured so we can process.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$structured the restructured array.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public function runValidation</th>
        </tr>
        <tr>
            <td colspan="2">Performs validation tasks.</td>
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
            <th colspan="2" class="text-center">public function upload</th>
        </tr>
        <tr>
            <td colspan="2">Performs file upload.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$path Directory where file will exist when uploaded.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$uploadName The actual name for the file when uploaded.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$fileName The temporary file name.</td>
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
            <th colspan="2" class="text-center">public function validates</th>
        </tr>
        <tr>
            <td colspan="2">Getter function for the $_files array.</td>
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
            <td>True if validation is successful.  Otherwise, we return the $_errors array.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">protected function validateImageType</th>
        </tr>
        <tr>
            <td colspan="2">Validates image type and sets error message if file type is invalid.</td>
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

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm mb-5">
        <tr>
            <th colspan="2" class="text-center">protected function validateSize</th>
        </tr>
        <tr>
            <td colspan="2">Validates file size and sets error message if file is too large.</td>
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

    <a href="<?=APP_DOMAIN?>documentation/lib" class="btn btn-xs btn-secondary mb-5">Lib</a>
</div>
<?php $this->end(); ?>