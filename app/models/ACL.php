<?php
namespace App\Models;
use Core\Model;
use Core\Helper;

/**
 * Describes ACL model.
 */
class ACL extends Model {
    public $acl;
    public $deleted = 0;
    protected static $_softDelete = true;
    protected static $_table = 'acl';

    /**
     * Generates list of ACL options based on ACL table.
     *
     * @return void
     */
    public static function getOptionsForForm() {
        $acls = self::find(['order' => 'acl']);
        $aclArray = ['' => ' - Select ACL -'];
        foreach($acls as $acl) {
            $aclArray[$acl->id] = $acl->acl;
        }
        //return $aclArray;
        return $acls;
    }

    public static function getACLs() {
        return self::find(['order' => 'acl']);
    }

    /**
     * Trims quotes and brackets off of ACL until we figure out better way.
     *
     * @param [type] $acl
     * @return void
     */
    public static function trimACL($acl) {
        $acl = substr($acl, 2);
        $acl = substr_replace($acl, '', -2);
        return $acl;
    }
}