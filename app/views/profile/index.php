<?php
    use App\Models\Users;
?>
<?php $this->setSiteTitle("Profile Details for ".$this->user->username); ?>
<?php $this->start('body'); ?>
<h1 class="text-center">Profile Details for <?=$this->user->username?></h1>

<div class="col align-items-center justify-content-center mx-auto my-3 w-50">
    <table class="table table-striped table-condensed table-bordered table-hover bg-light">
        <thead>
            <th class="text-center">Field Name</th>
            <th class="text-center">Value</th>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">First Name</td>
                <td class="text-center"><?=$this->user->fname?></td>
            </tr>
            <tr>
                <td class="text-center">Last Name</td>
                <td class="text-center"><?=$this->user->lname?></td>
            </tr>
            <tr>
                <td class="text-center">E-mail</td>
                <td class="text-center"><?=$this->user->email?></td>
            </tr>
            <tr>
                <td class="text-center">ACL</td>
                <td class="text-center"><?=$this->user->acl?></td>
            </tr>
        </tbody>
    </table>
    <a href="<?=PROOT?>profile/edit/<?=$this->user->id?>" class="btn btn-info btn-xs">
        <i class="fa fa-edit"></i> Edit Profile
    </a>
</div>
<?php $this->end(); ?>