<?php
namespace App\Lib\Utilities;
use Core\Helper;

/**
 * Provides support for file uploads.
 */
class Uploads {
    private string $_bucket;
    private array $_allowedFileTypes = [];
    private array $_errors = [];
    private array $_files= []; 
    private int $_maxAllowedSize;

    /**
     * Creates instance of Uploads class.
     *
     * @param array $files Array of files to be uploaded.
     * @param array $imageTypes An array containing a list of acceptable file 
     * types for a particular upload action.
     * @param int $maxAllowedSize Maximum allowable size for a particular 
     * file.  This can vary depending on requirements.
     * @param bool $multiple A boolean flag to set whether or not we are 
     * working with a single file upload or an array regarding form setup.
     */
    public function __construct(array|string $files, array $fileTypes, int $maxAllowedSize, bool $multiple, string $bucket) {
        $this->_files = self::restructureFiles($files, $multiple);
        $this->_allowedFileTypes = $fileTypes;
        $this->_maxAllowedSize = $maxAllowedSize;
        $this->_bucket = $bucket;
    }
    
    /**
     * Adds an error message to the $_errors array.
     *
     * @param string $name The name of the error.
     * @param string $message The message associated with this error.
     * @return void
     */
    protected function addErrorMessage(string $name, string $message): void {
        if(array_key_exists($name, $this->_errors)) {
            $this->_errors[$name] .= $this->_errors[$name] . " " . $message;
        } else {
            $this->_errors[$name] = $message;
        }
    }
    
    /**
     * Getter function for the $_files array.
     *
     * @return array The $_files array.
     */
    public function getFiles(): array {
        return $this->_files;
    }

    /**
     * Restructures files input from post into an array that can be processed.
     *
     * @param array $files A single or an array of elements in the 
     * $_FILES variable whose information will be restructured so we can 
     * process.
     * @return array $structured the restructured array.
     */
    public static function restructureFiles(array $files, bool $multiple) {
        $structured = [];
        if($multiple) {
            foreach($files['tmp_name'] as $key => $val){
                $structured[] = [
                    'tmp_name'=>$files['tmp_name'][$key],'name'=>$files['name'][$key],
                    'size'=>$files['size'][$key],'error'=>$files['error'][$key],'type'=>$files['type'][$key]
                ];
            }
        } else {
            $structured[] = [
                'tmp_name'=>$files['tmp_name'],'name'=>$files['name'],
                'size'=>$files['size'],'error'=>$files['error'],'type'=>$files['type']
            ];
        }
        return $structured;
    }

    /**Update to support other file types.
     * Performs validation tasks.
     *
     * @return void
     */
    public function runValidation(): void {
        $this->validateSize();
        $this->validateImageType();
    }

    /**
     * Performs file upload.
     *
     * @param string $path Directory where file will exist when uploaded.
     * @param string $uploadName The actual name for the file when uploaded.
     * @param string $fileName The temporary file name.
     * @return void
     */
    public function upload($path, $uploadName, $fileName): void {
        if (!file_exists($path)) {
            mkdir($path);
        }
        move_uploaded_file($fileName, $this->_bucket.$path.$uploadName);
    }

    /**
     * Reports on success of validation.
     *
     * @return bool|array True if validation is successful.  Otherwise,
     * we return the $_errors array.
     */
    public function validates() {
        return (empty($this->_errors)) ? true : $this->_errors;
    }

    /**
     * Validates image type and sets error message if file type is invalid.
     *
     * @return void
     */
    protected function validateImageType(): void { 
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
