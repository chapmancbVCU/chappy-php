<?php
namespace Core\Lib\Utilities;

use Core\Helper;
use Core\Lib\Utilities\Uploads;
/**
 * Supports the ability to upload a single profile image at a time.
 */
class UploadProfileImage extends Uploads {
    /**
     * Creates instance of UploadProfileImage class.
     *
     * @param array|string $files Array of files or the name to be uploaded.
     * @param array $imageTypes An array containing a list of acceptable file 
     * types for a particular upload action.
     * @param int $maxAllowedSize Maximum allowable size for a particular 
     * file.  This can vary depending on requirements.
     * @param bool $multiple A boolean flag to set whether or not we are 
     * working with a single file upload or an array regarding form setup.
     * @param string $bucket The location where the files will be stored.
     */
    public function __construct(array|string $files, array $fileTypes, int $maxAllowedSize, bool $multiple, string $bucket) {
        parent::__construct($files, $fileTypes, $maxAllowedSize, $multiple, $bucket);
    }

    /**
     * Performs validation on profile image uploads.  This function focuses on 
     * file size and file type.
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
        $reportTypes = [];
        foreach($this->_allowedFileTypes as $type) {
            array_push($reportTypes, image_type_to_mime_type($type));
        }

        foreach($this->_files as $file) {
            // checking file type
            if(!in_array(exif_imagetype($file['tmp_name']), $this->_allowedFileTypes)){
                $name = $file['name'];
                $msg = $name . " is not an allowed file type. Please use the following types: " . implode(', ', $reportTypes);
                $this->addErrorMessage($name, $msg);
            }
        }
    }

    /**
     * Validates file size and sets error message if file is too large.
     *
     * @return void
     */
    protected function validateSize(): void {
        foreach($this->_files as $file){
            $name = $file['name'];
            if($file['size'] > $this->_maxAllowedSize){
                $msg = $name . " is over the max allowed size of 5mb.";
                $this->addErrorMessage($name,$msg);
            }
        }
    }
}