<?php $this->setSiteTitle("User Guide"); ?>
<?php $this->start('body'); ?>
<?php include(getcwd().DS.'app' . DS . 'views/layouts/docs_nav.php'); ?>

<div class="main">
    <h1 class="text-center">User Guide</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded">
        <ol class="py-4">
            <li><a href="#overview">Overview</a></li>
            <li><a href="<?=PROOT?>userguide/gettingStarted">Getting Started</a></li>
            <li><a href="<?=PROOT?>userguide/loginSystem">Login System</a></li>
            <li><a href="<?=PROOT?>userguide/userProfiles">User Profiles</a></li>
            <li><a href="<?=PROOT?>userguide/contactManagement">Contact Management System</a></li>
            <li><a href="<?=PROOT?>userguide/forms">Quick Forms</a></li>
            <li><a href="<?=PROOT?>userguide/validation">Server Side Validation</a></li>
        </ol>
    </div>

    <h1 id="overview" class="text-center">Overview</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded">

    </div>
</div>
<script src="<?=PROOT?>public/js/docNavDropdown.js"></script>
<?php $this->end(); ?>