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

    /**
     * Generates list of ACL options based on ACL table.  Compatible with 
     * dropdown and checkbox group elements.
     *
     * @return array $aclArray The array containing ACLs from ACL table.
     */
    public static function getOptionsForForm(): array {
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
    public static function getACLs(): array {
        return self::find(['order' => 'acl']);
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