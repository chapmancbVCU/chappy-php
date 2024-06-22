<?php $this->setSiteTitle("Controller Classes - Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>
<?php include('docs_nav.php'); ?>

<div class="main">
    <h1 class="text-center">Controller Classes</h1>
    <div class="row align-items-center justify-content-center my-3">
        <p class="text-center w-75">
            Here you will find information about the various stock controllers 
            that are provided by this Model View Controller (MVC) framework.
        </p>
    </div>
    <div class="ml-5">
        <ul>
            <li><a href="<?=PROOT?>documentation/contactsController" class="text-primary">Contacts Controller</a>: Handles views and Create, Read, Update, and Delete operations for the built in example contact management system.</li>
            <li><a href="<?=PROOT?>documentation/homeController" class="text-primary">Home Controller</a>: Supports actions and view for home controller.</li>
            <li><a href="<?=PROOT?>documentation/javaScript" class="text-primary">javaScript</a></li>
            <li><a href="<?=PROOT?>documentation/models" class="text-primary">Models</a></li>
        </ul>
    </div>
</div>
<script src="<?=PROOT?>public/js/docNavDropdown.js"></script>
<?php $this->end(); ?>