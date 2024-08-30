<?php
namespace App\Models;
use Core\{Helper, Model};
use App\Lib\Utilities\Uploads;

class ProfileImages extends Model {
    protected static $allowedFileTypes = [IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG];
    public $deleted = 0;
    public $id;
    protected static $maxAllowedFileSize = 5242880;
    public $name;
    protected static $_softDelete = true;
    protected static $_table = 'profile_images';
    public $user_id;
    public $url;

    public static function deleteById($id) {
        
        $image = self::findById($id);
        $sort = $image->sort;
        $afterImages = self::find([
            'conditions' => 'user_id = ? and sort > ?',
            'bind' => [$image->user_id, $sort]
        ]);
        foreach($afterImages as $af) {
            $af->sort = $af->sort - 1;
            $af->save();
        }
        unlink(S3_BUCKET.DS.'public'.DS.'images'.DS.'uploads'.DS . 'profile_images' . DS . 'user_' . $image->user_id. DS. $image->name);
        return $image->delete();
    }
    
    public static function findCurrentProfileImage($user_id) {
        return $image = self::findFirst([
            'conditions' => 'user_id = ? AND sort = 0',
            'bind' => ['user_id' => $user_id]
        ]);
    }

    public static function findByUserId($user_id) {
        return $images = self::find([
            'conditions' => 'user_id = ?',
            'bind' => ['user_id' => $user_id],
            'order' => 'sort'
        ]);
    }

    public static function getAllowedFileTypes() {
        return self::$allowedFileTypes;
    }

    public static function getMaxAllowedFileSize() {
        return self::$maxAllowedFileSize;
    }
    
    public static function updateSortByUserId($user_id, $sortOrder = []) {
        $images = self::findByUserId($user_id);
        $i = 0;
        foreach($images as $image) {
            $val = 'image_'.$image->id;
            $sort = (in_array($val, $sortOrder)) ? array_search($val, $sortOrder) : $i;
            $image->sort = $sort;
            $image->save();
            $i++;
        }
    }

    public static function uploadProfileImage($user_id, $uploads) {
        $lastImage = self::findFirst([
            'conditions' => "user_id = ?",
            'bind' => [$user_id],
            'order' => 'sort DESC'
        ]);
        $lastSort = (!$lastImage) ? 0 : $lastImage->sort;
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
            $image->sort = $lastSort;
            if($image->save()) {
                $uploads->upload($path, $uploadName, $file['tmp_name']);
                $lastSort++;
            }
        }
    }
}