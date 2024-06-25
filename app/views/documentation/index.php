<?php $this->setSiteTitle("Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>
<?php include('docs_nav.php'); ?>

<div class="main">
    <h1 class="text-center">Custom MVC Framework Docs</h1>

    <div class="row align-items-center justify-content-center my-3">
        <p class="text-center w-75">The MVC documentation contains descriptions for built in classes, functions, and JavaScript</p>
    </div>
    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <td><a href="<?=PROOT?>documentation/controllers" class="text-primary">Controllers</a></td>
            <td>Documentation for controller classes that provide support for interactions between model and views.</td>
        </tr>
        <tr>
            <td>
                <a href="<?=PROOT?>documentation/core" class="text-primary">Core</a>
            </td>
            <td>Core components for this MVC framework.  Here you will find parent parent and helper classes that facilitate operations for this framework.</td>
        </tr>
        <tr>
            <td><a href="<?=PROOT?>documentation/javaScript" class="text-primary">JavaScript</a></td>
            <td>Descriptions for any JavaScript files can be found here.</td>
        </tr>
        <tr>
            <td><a href="<?=PROOT?>documentation/models" class="text-primary">Models</a></td>
            <td>Documentation for models responsible for the application's logic and database operations.</td>
        </tr>
        <tr>
            <td><a href="<?=PROOT?>documentation/validators" class="text-primary">Validators</a></td>
            <td>Collection of classes responsible for server side form validation</td>
        </tr>
    </table>
</div>
<script src="<?=PROOT?>public/js/docNavDropdown.js"></script>
<?php $this->end(); ?>