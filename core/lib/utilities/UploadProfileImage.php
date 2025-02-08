<?php
namespace Core\Lib\Utilities;

use Core\Lib\Utilities\Uploads;
/**
 * 
 * 
 * @property $_files
 */
class UploadProfileImage extends Uploads {
    public function __construct(array|string $files, array $fileTypes, int $maxAllowedSize, bool $multiple, string $bucket) {
        parent::__construct($files, $fileTypes, $maxAllowedSize, $multiple, $bucket);
    }

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
        foreach($this->_files as $file) {
            // checking file type
            if(!in_array(exif_imagetype($file['tmp_name']), $this->_allowedFileTypes)){
                $name = $file['name'];
                $msg = $name . " is not an allowed file type. Please use a jpeg, gif, or png.";
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