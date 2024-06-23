<?php $this->setSiteTitle("Model - Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>
<?php include('docs_nav.php'); ?>

<div class="main">
    <a href="<?=PROOT?>documentation/core" class="btn btn-xs btn-secondary">Core</a>
    <h1 class="text-center">Model Class</h1>
    <div class="row align-items-center justify-content-center my-3">
        <p class="text-center w-75">Parent class for our models.  Takes functions from DB wrapper and extract functionality further to make operations easier to use and improve extendability.</p>
    </div>

    <a href="<?=PROOT?>documentation/core" class="btn btn-xs btn-secondary mb-5">Core</a>
</div>
<script src="<?=PROOT?>public/js/docNavDropdown.js"></script>
<?php $this->end(); ?>