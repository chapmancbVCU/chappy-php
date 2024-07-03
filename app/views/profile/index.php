<?php
    use App\Models\Users;
?>
<?php $this->setSiteTitle($this->user->fname." Profile Details"); ?>
<?php $this->start('body'); ?>
<h1 class="text-center"><?=$this->user->fname?> Profile Details</h1>

<div class="row align-items-center justify-content-center my-3">


    <table class="table table-striped table-condensed table-bordered table-hover bg-light w-50 mx-auto">
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
</div>
<?php $this->end(); ?>