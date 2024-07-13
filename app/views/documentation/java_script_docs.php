<?php $this->setSiteTitle("Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>
<?php include(ROOT . DS . 'app' . DS . 'views/layouts/docs_nav.php'); ?>

<div class="main">
    <h1 class="text-center">JavaScript</h1>
    <div class="row align-items-center justify-content-center my-3 mx-auto">
        <p class="text-center w-75">Description</p>
    </div>

    <a href="<?=PROOT?>documentation" class="btn btn-xs btn-secondary mb-5">Docs Home</a>
</div>
<script src="<?=PROOT?>public/js/docNavDropdown.js"></script>
<?php $this->end(); ?>