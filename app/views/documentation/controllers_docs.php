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
    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <td><a href="<?=PROOT?>documentation/contactsController" class="text-primary">Contacts Controller</a></td>
            <td>Handles views and Create, Read, Update, and Delete operations for the built in example contact management system.</td>
        </tr>
        <tr>
            <td><a href="<?=PROOT?>documentation/homeController" class="text-primary">Home Controller</a></td>
            <td>Supports actions and view for home controller.</td>
        </tr>
    </table>
</div>
<script src="<?=PROOT?>public/js/docNavDropdown.js"></script>
<?php $this->end(); ?>