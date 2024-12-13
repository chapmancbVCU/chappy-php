<?php 
use Core\Helper;
?>
<?php $this->setSiteTitle("Administration"); ?>
<?php $this->start('body'); ?>
<h1 class="text-center">Administration Dashboard</h1>

<table class="table table-striped table-condensed table-bordered table-hover">
    <thead>
        <th>Username</th>
        <th>Access Level</th>
        <th>Status</th>
        <th>Created</th>
        <th>Last Update</th>
        <th></th>
    </thead>
    <tbody>
        <?php foreach($this->users as $user): ?>
            <tr>
                <td><?= $user->username ?></td>
                <td><?= $user->acl ?></td>
                <td><?= ($user->inactive == 0) ? 'Active' : 'Inactive'?></td>
                <td><?= Helper::diffForHumans($user->created_at) ?></td>
                <td><?= Helper::diffForHumans($user->updated_at) ?></td>
                <td class="text-center">
                    <a href="<?=APP_DOMAIN?>admindashboard/details/<?=$user->id?>" class="btn btn-info btn-xs w-100">
                        <i class="fa fa-user"></i> Details
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->end(); ?>