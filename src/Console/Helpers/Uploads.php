<?php
namespace Console\Helpers;

use Symfony\Component\Console\Command\Command;

/**
 * Contains functions for creating a new Uploads class
 */
class Uploads {
    /**
     * Generates a new class for supporting file uploads.
     *
     * @param string $uploadName The name of the Uploads class.
     * @return string The contents of the Uploads class.
     */
    public static function makeUpload(string $uploadName): string {
        return '<?php
namespace App\Lib\Utilities;
use Core\Lib\Utilities\Uploads;

/**
 * Supports the ability to upload ' . $uploadName . ' files.
 */
class Upload'.$uploadName.' extends Uploads {
    /**
     * Creates instance of Upload'.$uploadName.' class.
     *
     * @param array|string $files Array of files or the name to be uploaded.
     * @param array $imageTypes An array containing a list of acceptable file 
     * types for a particular upload action.
     * @param int $maxAllowedSize Maximum allowable size for a particular 
     * file.  This can vary depending on requirements.
     * @param bool $multiple A boolean flag to set whether or not we are 
     * working with a single file upload or an array regarding form setup.
     * @param string $bucket The location where the files will be stored.
     * @param string $sizeMsg The message describing the maximum allowable 
     * size usually described as <size_as_an_int><bytes|mb|gb> (e.g.: 5mb).
     */
    public function __construct(array|string $files, array $fileTypes, int $maxAllowedSize, bool $multiple, string $bucket, string $sizeMsg) {
        parent::__construct($files, $fileTypes, $maxAllowedSize, $multiple, $bucket, $sizeMsg);
    }

    /**
     * Performs validation on file uploads.
     *
     * @return void
     */
    public function runValidation(): void {
        $this->validateSize();
        $this->validateFileType();
    }
    
    /**
     * Validates file type and sets error message if file type is invalid.
     *
     * @return void
     */
    protected function validateFileType(): void { 
        // Setup file type reporting.

        // Perform validation and set error messages.
    }
}
';
    }
}
