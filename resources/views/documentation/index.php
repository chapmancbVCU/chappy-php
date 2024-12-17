<?php $this->setSiteTitle("Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>

<div class="main">
    <h1 class="text-center">Custom MVC Framework Docs</h1>

    <div class="row align-items-center justify-content-center my-3">
        <p class="text-center w-75">The MVC documentation contains descriptions for built in classes, functions, and JavaScript</p>
    </div>
    <table class="table table-striped  table-bordered table-hover w-75 mx-auto mb-5 table-sm">
        <tr>
            <td><a href="<?=APP_DOMAIN?>documentation/controllers" class="link-primary">Controllers</a></td>
            <td>Documentation for controller classes that provide support for interactions between model and views.</td>
        </tr>
        <tr>
            <td>
                <a href="<?=APP_DOMAIN?>documentation/core" class="link-primary">Core</a>
            </td>
            <td>Core components for this MVC framework.  Here you will find parent parent and helper classes that facilitate operations for this framework.</td>
        </tr>
        <tr>
            <td><a href="<?=APP_DOMAIN?>documentation/lib" class="link-primary">Lib</a></td>
            <td>Helpers, utilities, and other miscellaneous files or classes.</td>
        </tr>
        <tr>
            <td><a href="<?=APP_DOMAIN?>documentation/javaScript" class="link-primary">JavaScript</a></td>
            <td>Descriptions for any JavaScript files can be found here.</td>
        </tr>
        <tr>
            <td><a href="<?=APP_DOMAIN?>documentation/models" class="link-primary">Models</a></td>
            <td>Documentation for models responsible for the application's logic and database operations.</td>
        </tr>
        <tr>
            <td><a href="<?=APP_DOMAIN?>documentation/validators" class="link-primary">Validators</a></td>
            <td>Collection of classes responsible for server side form validation</td>
        </tr>
    </table>
    <a></a>
</div>
<?php $this->end(); ?>