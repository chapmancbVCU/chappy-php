<?php
namespace App\Models;
use Core\Model;
use Core\Helper;
class ACL extends Model {
    public $acl;
    public $deleted = 0;
    protected static $_table = 'acl';

    public static function getOptionsForForm() {
        $acls = self::find(['order' => 'acl']);
        $aclArray = ['' => ' - Select ACL -'];
        foreach($acls as $acl) {
            $aclArray[$acl->id] = $acl->acl;
        }
        return $aclArray;
    }

    public static function trimACL($acl) {
        $acl = substr($acl, 2);
        $acl = substr_replace($acl, '', -2);
        return $acl;
    }
}