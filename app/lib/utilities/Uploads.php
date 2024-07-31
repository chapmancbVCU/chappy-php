<?php
namespace App\Lib\Utilities;
use Core\Helper;
class Uploads {

    private $_errors = [], $_files=[], $_maxAllowedSize = 5242880;
    private $_allowedImageTypes = [IMAGETYPE_GIF,IMAGETYPE_JPEG,IMAGETYPE_PNG];

    public function __construct($files){
        $this->_files = self::restructureFiles($files);
    }
    
    protected function addErrorMessage($name,$message){
        if(array_key_exists($name,$this->_errors)){
            $this->_errors[$name] .= $this->_errors[$name] . " " . $message;
        } else {
            $this->_errors[$name] = $message;
        }
    }
    
    public function getFiles(){
        return $this->_files;
    }

    public static function restructureFiles($files){
        $structured = [];
        foreach($files['tmp_name'] as $key => $val){
            $structured[] = [
            'tmp_name'=>$files['tmp_name'][$key],'name'=>$files['name'][$key],
            'size'=>$files['size'][$key],'error'=>$files['error'][$key],'type'=>$files['type'][$key]
            ];
        }
        return $structured;
    }

    public function runValidation(){
        $this->validateSize();
        $this->validateImageType();
    }

    public function upload($bucket,$name,$tmp){
        if (!file_exists($bucket)) {
            mkdir($bucket);
        }
        move_uploaded_file($tmp,ROOT.DS.$bucket.$name);
    }

    public function validates(){
        return (empty($this->_errors))? true : $this->_errors;
    }

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
