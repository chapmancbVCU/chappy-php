<?php use Core\Helper; ?>
<?php $this->setSiteTitle("Manage ACL Items"); ?>
<?php $this->start('body'); ?>
<h1 class="text-center">Manage ACL Items
    <a href="<?=APP_DOMAIN?>admindashboard/addAcl/<?=$this->user->id?>" class="btn btn-info btn-xs">
        <i class="fa fa-plus"></i> Add ACL
    </a>
</h1>
<table class="table table-striped table-condensed table-bordered table-hover">
    <thead>
        <th>ACL</th>
        <th></th>
    </thead>
    <tbody>
        <?php foreach($this->acls as $acl): ?>
            <tr>
                <?php if($acl->acl !== "Admin"): ?>
                    <td><?= $acl->acl ?></td>
                    <td class="text-center">
                        <a href="<?=APP_DOMAIN?>admindashboard/editAcl/<?=$this->user->id?>" class="btn btn-info btn-xs">
                            <i class="fa fa-edit"></i> Edit ACL
                        </a>
                        <a href="<?=APP_DOMAIN?>admindashboard/deleteAcl/<?=$this->user->id?>" class="btn btn-danger btn-xs" onclick="if(!confirm('Are you sure?')){return false;}">
                            <i class="fa fa-trash"></i> Delete
                        </a>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->end(); ?>