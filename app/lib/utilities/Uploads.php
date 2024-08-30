<?php
namespace App\Lib\Utilities;
use Core\Helper;

/**
 * Undocumented class
 */
class Uploads {

    private $_allowedImageTypes = [];
    private $_errors = [];
    private $_files= []; 
    private $_maxAllowedSize;

    /**
     * Undocumented function
     *
     * @param [type] $files
     */
    public function __construct($files, $imageTypes, $maxAllowedSize, $multiple) {
        $this->_files = self::restructureFiles($files, $multiple);
        $this->_allowedImageTypes = $imageTypes;
        $this->_maxAllowedSize = $maxAllowedSize;
    }
    
    /**
     * Undocumented function
     *
     * @param [type] $name
     * @param [type] $message
     * @return void
     */
    protected function addErrorMessage($name,$message) {
        if(array_key_exists($name, $this->_errors)) {
            $this->_errors[$name] .= $this->_errors[$name] . " " . $message;
        } else {
            $this->_errors[$name] = $message;
        }
    }
    
    /**
     * Undocumented function
     *
     * @return void
     */
    public function getFiles(){
        return $this->_files;
    }

    /**
     * Undocumented function
     *
     * @param [type] $files
     * @return void
     */
    public static function restructureFiles($files, $multiple) {
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
     * Undocumented function
     *
     * @return void
     */
    public function runValidation(){
        $this->validateSize();
        $this->validateImageType();
    }

    /**
     * Undocumented function
     *
     * @param [type] $bucket
     * @param [type] $name
     * @param [type] $tmp
     * @return void
     */
    public function upload($bucket,$name,$tmp){
        if (!file_exists($bucket)) {
            mkdir($bucket);
        }
        move_uploaded_file($tmp,ROOT.DS.$bucket.$name);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function validates(){
        return (empty($this->_errors))? true : $this->_errors;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    protected function validateImageType(){
        foreach($this->_files as $file){
            // checking file type
            if(!in_array(exif_imagetype($file['tmp_name']),$this->_allowedImageTypes)){
                $name = $file['name'];
                $msg = $name . " is not an allowed file type. Please use a jpeg, gif, or png.";
                $this->addErrorMessage($name,$msg);
            }
        }
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    protected function validateSize(){
        foreach($this->_files as $file){
            $name = $file['name'];
            if($file['size'] > $this->_maxAllowedSize){
                $msg = $name . " is over the max allowed size of 5mb.";
                $this->addErrorMessage($name,$msg);
            }
        }
    }
}
