<?php $this->setSiteTitle("User Guide"); ?>
<?php $this->start('body'); ?>
<?php include(getcwd().DS.'app' . DS . 'views/layouts/docs_nav.php'); ?>

<div class="main">
    <h1 class="text-center">User Guide</h1>
    <div class="my-5 w-75 bg-light mx-auto border rounded">
        <ol class="py-4">
            <li><a href="<?=PROOT?>userguide/gettingStarted">Getting Started</a></li>
            <li><a href="<?=PROOT?>userguide/loginSystem">Login System</a></li>
            <li><a href="<?=PROOT?>userguide/userProfiles">User Profiles</a></li>
            <li><a href="<?=PROOT?>userguide/contactManagement">Contact Management System</a></li>
            <li><a href="<?=PROOT?>userguide/forms">Quick Forms</a></li>
            <li><a href="<?=PROOT?>userguide/validation">Server Side Validation</a></li>
        </ol>
    </div>
</div>
<?php $this->end(); ?>