<?php
namespace App\Models;
use Core\Model;
use Core\Validators\{RequiredValidator, UniqueValidator};
use Core\Helper;

/**
 * Describes ACL model.
 */
class ACL extends Model {
    public $acl;
    public const blackList = ['id', 'deleted'];
    public $created_at;
    public $deleted = 0;
    public $id;
    protected static $_softDelete = true;
    protected static $_table = 'acl';
    public $updated_at;

    /**
     * Implements beforeSave function described in Model parent class.  
     * Ensures timestamps are created and updated.
     *
     * @return void
     */
    public function beforeSave(): void {
        $this->timeStamps();
    }

    /** UPDATE
     * Generates list of ACL options based on ACL table.
     *
     * @return array Used to populate options for form.  Compatible with 
     * dropdown and checkbox group elements.
     */
    public static function getOptionsForForm() {
        $acls = self::find(['order' => 'acl']);
        foreach($acls as $acl) {
            $aclArray[$acl->id] = $acl->acl;
        }
        return $aclArray;
    }

    /**
     * Retrieves list of all ACLs sorted by the acl field.
     *
     * @return array The list of ACLs that is returned from the database.
     */
    public static function getACLs() {
        return self::find(['order' => 'acl']);
    }

    /**
     * Trims quotes and brackets off of ACL until we figure out better way.
     * Plan to depreciate after future updates.
     * @param string $acl The ACL field from a record in the Users table.
     * @return string $acl The acl after quotes and brackets are removed.
     */
    public static function trimACL($acl) {
        $acl = substr($acl, 2);
        $acl = substr_replace($acl, '', -2);
        return $acl;
    }

    /**
     * Ensures fields are required and unique.
     *
     * @return void
     */
    public function validator(): void {
        $this->runValidation(new UniqueValidator($this, ['field' => 'acl', 'message' => 'That acl already exists.  Please chose a new one.']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'acl', 'message' => 'ACL name is required.'])); 
    }
}