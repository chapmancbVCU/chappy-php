<?php $this->setSiteTitle("Controller - Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>
<?php include('docs_nav.php'); ?>

<div class="main">
    <a href="<?=PROOT?>documentation/core" class="btn btn-xs btn-secondary">Core</a>
    <h1 class="text-center">Controller Class</h1>
    <div class="row align-items-center justify-content-center my-3">
        <p class="text-center w-75">This is the parent Controller class.  It describes functions that are available to all classes that extends this Controller class.</p>
    </div>

    <a href="<?=PROOT?>documentation/core" class="btn btn-xs btn-secondary mb-5">Core</a>
</div>
<script src="<?=PROOT?>public/js/docNavDropdown.js"></script>
<?php $this->end(); ?>