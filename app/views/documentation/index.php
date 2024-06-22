<?php $this->setSiteTitle("Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>
<?php include('docs_nav.php'); ?>

<div class="main">
    <h1 class="text-center">Custom MVC Framework Docs</h1>

    <div class="row align-items-center justify-content-center my-3">
        <p class="text-center w-75">The MVC documentation contains descriptions for built in classes, functions, and JavaScript</p>
    </div>
    <div class="ml-5">
        <ul>
            <li><a href="<?=PROOT?>documentation/controllers" class="text-primary">Controllers</a>: Documentation for controller classes that provide support for interactions between model and views.</li>
            <li><a href="<?=PROOT?>documentation/core" class="text-primary">Core</a>: Core components for this MVC framework.  Here you will find parent parent and helper classes that facilitate operations for this framework.</li>
            <li><a href="<?=PROOT?>documentation/javaScript" class="text-primary">JavaScript</a>: Descriptions for any JavaScript files can be found here.</li>
            <li><a href="<?=PROOT?>documentation/models" class="text-primary">Models</a>: Documentation for models that perform the application's logic and database operations.</li>
        </ul>
    </div>
</div>
<script src="<?=PROOT?>public/js/docNavDropdown.js"></script>
<?php $this->end(); ?>