<?php $this->setSiteTitle("CustomValidator - Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>
<?php include('docs_nav.php'); ?>

<div class="main">
    <a href="<?=PROOT?>documentation/validators" class="btn btn-xs btn-secondary">Validators</a>
    <h1 class="text-center">CustomValidator Class</h1>
    <div class="row align-items-center justify-content-center my-3">
        <p class="text-center w-75">Abstract parent class for our child validation child classes.  Each child class must implement the runValidation() function.</p>
    </div>

    <a href="<?=PROOT?>documentation/validators" class="btn btn-xs btn-secondary mb-5">Validators</a>
</div>
<script src="<?=PROOT?>public/js/docNavDropdown.js"></script>
<?php $this->end(); ?>