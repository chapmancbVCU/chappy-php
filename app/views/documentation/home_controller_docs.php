<?php $this->setSiteTitle("Home Controller - Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>
<?php include('docs_nav.php'); ?>

<div class="main">
    <h1 class="text-center">Home Controller Class</h1>

    <a class="ml-5" href="<?=PROOT?>documentation" class="text-primary">Custom MVC Docs Home</a>

    <div class="row align-items-center justify-content-center my-3">
        <p class="text-center w-75">Functions</p>
    </div>
    <div class="ml-5">
        <ul>
            <li><a href="<?=PROOT?>documentation/controllers" class="text-primary">Controllers</a></li>
            <li><a href="<?=PROOT?>documentation/core" class="text-primary">Core</a></li>
            <li><a href="<?=PROOT?>documentation/javaScript" class="text-primary">javaScript</a></li>
            <li><a href="<?=PROOT?>documentation/models" class="text-primary">Models</a></li>
        </ul>
    </div>
</div>
<script src="<?=PROOT?>public/js/docNavDropdown.js"></script>
<?php $this->end(); ?>