<?php use Core\Helper; ?>

<?php $this->setSiteTitle($this->user->username . " Details"); ?>
<?php $this->start('head') ?>
    <script src='<?=APP_DOMAIN?>vendor/tinymce/tinymce/tinymce.min.js'></script>
    <script src='<?=APP_DOMAIN?>public/js/profileDescriptionTinyMCE.js'></script>
<?php $this->end() ?>
<?php $this->start('body'); ?>
<h1 class="text-center">Details for <?=$this->user->username?></h1>

<div class="col align-items-center justify-content-center mx-auto my-3 w-50">
    <a href="<?=APP_DOMAIN?>admindashboard/index" class="btn btn-xs btn-secondary mb-3">Back</a>
    <?php if($this->user->profileImage != null):?>
        <img src="<?=APP_DOMAIN?>public/images/profileImage/<?=$this->user->profileImage?>"
            class="img-thumbnail mx-auto my-5 d-block w-50 rounded border border-primary shadow-lg">
        </img>
    <?php endif; ?>
    <table class="table table-striped table-condensed table-bordered table-hover bg-light my-5">
        <tbody>
            <tr>
                <th class="text-center">First Name</th>
                <td class="text-center"><?=$this->user->fname?></td>
            </tr>
            <tr>
                <th class="text-center">Last Name</th>
                <td class="text-center"><?=$this->user->lname?></td>
            </tr>
            <tr>
                <th class="text-center">E-mail</th>
                <td class="text-center"><?=$this->user->email?></td>
            </tr>
            <tr>
                <th class="text-center">ACL</th>
                <td class="text-center"><?=$this->user->acl?></td>
            </tr>
            <?php if($this->user->description): ?>
                <tr>
                    <th class="text-center" colspan="2">Description</th>
                </tr>
                <tr>
                    <td class="p-4" colspan="2"><?=htmlspecialchars_decode(stripslashes($this->user->description));?></td>
                </tr>
            <?php else: ?>
                <tr>
                    <td class="text-center" colspan="2">No description</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <div class="mb-5 d-flex justify-content-around">
        <a href="<?=APP_DOMAIN?>admindashboard/edit/<?=$this->user->id?>" class="btn btn-info btn-xs mx-2 mb-3">
            <i class="fa fa-edit"></i> Edit User Profile
        </a>
        <a href="<?=APP_DOMAIN?>admindashboard/editProfileImage/<?=$this->user->id?>" class="btn btn-secondary btn-xs mx-2 mb-3">
            <i class="fa fa-image"></i> Edit Profile Image
        </a>
        <a href="<?=APP_DOMAIN?>admindashboard/setResetPassword/<?=$this->user->id?>" class="btn btn-danger btn-xs mx-2 mb-3">
            <i class="fa fa-key"></i> Reset Password
        </a>
    </div>
    
</div>
<?php $this->end(); ?>