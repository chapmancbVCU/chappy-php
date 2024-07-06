<?php $this->setSiteTitle("User Profiles - User Guide"); ?>
<?php $this->start('body'); ?>
<?php include(getcwd().DS.'app' . DS . 'views/layouts/docs_nav.php'); ?>

<div class="main">
<a href="<?=PROOT?>userguide/index" class="btn btn-xs btn-secondary">User Guide Home</a>
    <h1 class="text-center">User Profiles</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded">
        Test
    </div>
</div>
<script src="<?=PROOT?>public/js/docNavDropdown.js"></script>
<?php $this->end(); ?>