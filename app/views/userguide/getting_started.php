<?php $this->setSiteTitle("Getting Started - User Guide"); ?>
<?php $this->start('body'); ?>
<?php include(getcwd().DS.'app' . DS . 'views/layouts/docs_nav.php'); ?>

<div class="main">
<a href="<?=PROOT?>userguide/index" class="btn btn-xs btn-secondary">User Guide Home</a>
    <h1 class="text-center">Getting Started</h1>
    <div class="my-5 w-75 bg-light mx-auto border rounded">
        Test
    </div>
</div>
<?php $this->end(); ?>