<?php $this->setSiteTitle("Admindashboard - Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>
<?php include(ROOT . DS . 'app' . DS . 'views/layouts/docs_nav.php'); ?>

<div class="main">
    <a href="<?=APP_DOMAIN?>documentation/controllers" class="btn btn-xs btn-secondary">Controllers</a>
    <h1 class="text-center">Admindashboard Controller Class</h1>
    <div class="row align-items-center justify-content-center my-3">
        <p class="text-center w-75">Add description here</p>
    </div>

    <a href="<?=APP_DOMAIN?>documentation/controllers" class="btn btn-xs btn-secondary mb-5">Controllers</a>
</div>

<script src="<?=APP_DOMAIN?>public/js/docNavDropdown.js"></script>
<?php $this->end(); ?>