<?php
namespace Core\Lib\Utilities;
use Core\Model;
use Core\Helper;
use Core\Lib\Logging\Logger;
/**
 * Provides support for file uploads.
 */
class Uploads {
    private string $_bucket;
    protected array $_allowedFileTypes = [];
    private array $_errors = [];
    protected array $_files= []; 
    protected int $_maxAllowedSize;
    protected string $sizeMsg;

    /**
     * Creates instance of Uploads class.
     *
     * @param array|string $files Array of files to be uploaded.
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
        $this->_files = self::restructureFiles($files, $multiple);
        $this->_allowedFileTypes = $fileTypes;
        $this->_maxAllowedSize = $maxAllowedSize;
        $this->_bucket = $bucket;
        $this->sizeMsg = $sizeMsg;
    }
    
    /**
     * Adds an error message to the $_errors array.
     *
     * @param string $name The name of the error.
     * @param string $message The message associated with this error.
     * @return void
     */
    protected function addErrorMessage(string $name, string $message): void {
        Logger::log("Upload error: $message", 'error'); // Log validation errors
        if(array_key_exists($name, $this->_errors)) {
            $this->_errors[$name] .= $this->_errors[$name] . " " . $message;
        } else {
            $this->_errors[$name] = $message;
        }
    }

    /**
     * Processes list of errors associated with uploads and makes them 
     * presentable to user during validation.
     *
     * @param bool|array $errors The errors, if any are detected will be an array.
     * @param Model $model The model associated with the errors.
     * @param string $name The name of the field in the model for the errors.
     * @return void
     */
    public function errorReporting(bool|array $errors, Model $model, string $name): void {
        if(is_array($errors)){
            $msg = "";
            foreach($errors as $name => $message){
                $msg .= $message . " ";
            }
            $model->addErrorMessage($name, trim($msg));
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

    /**
     * Performs validation tasks.
     *
     * @return void
     */
    public function runValidation(): void { }

    /**
     * Performs file upload.
     *
     * @param string $path Directory where file will exist when uploaded.
     * @param string $uploadName The actual name for the file when uploaded.
     * @param string $fileName The temporary file name.
     * @return void
     */
    public function upload($path, $uploadName, $fileName): void {
        Logger::log("Attempting to upload file: $uploadName | Path: $path", 'info');
        if (!file_exists($path)) {
            mkdir($path);
        }
        
        $destination = $this->_bucket.$path.$uploadName;
        if(move_uploaded_file($fileName, $destination)) {
            Logger::log("File uploaded successfully: $uploadName | Destination: $destination", 'info');
        } else {
            Logger::log("File upload failed: Could not move $uploadName to $destination", 'error');
        }
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
     * Validates file type and sets error message if file type is invalid.
     *
     * @return void
     */
    protected function validateFileType(): void {}

    /**
     * Validates file size and sets error message if file is too large.
     *
     * @return void
     */
    protected function validateSize(): void {
        foreach($this->_files as $file){
            $name = $file['name'];
            if($file['size'] > $this->_maxAllowedSize){
                $msg = $name . " is over the max allowed size of " . $this->sizeMsg . ".";
                $this->addErrorMessage($name,$msg);
            }
        } 
    }
}
