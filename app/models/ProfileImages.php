<?php
namespace App\Models;
use Core\{Helper, Model};
use App\Lib\Utilities\Uploads;

class ProfileImages extends Model {
    public $deleted = 0;
    public $id;
    public $name;
    protected static $_softDelete = true;
    protected static $_table = 'profile_images';
    public $user_id;
    public $url;

    public static function uploadProductImages($user_id, $uploads){
        $lastImage = self::findFirst([
            'conditions' => "user_id = ?",
            'bind' => [$user_id],
            'order' => 'sort DESC'
        ]);
        $path = 'public'.DS.'images'.DS.'uploads'.DS.'profile_images'.DS.'user_'.$user_id.DS;
        foreach($uploads->getFiles() as $file) {
            $parts = explode('.',$file['name']);
            $ext = end($parts);
            $hash = sha1(time().$user_id.$file['tmp_name']);
            $uploadName = $hash . '.' . $ext;
            $image = new self();
            $image->url = $path . $uploadName;
            $image->name = $uploadName;
            $image->user_id = $user_id;
            if($image->save()) {
                $uploads->upload($path, $uploadName, $file['tmp_name']);
            }
        }
    }
}