<?php $this->setSiteTitle("Lib"); ?>
<?php $this->start('body'); ?>

<div class="main">
    <h1 class="text-center">Lib</h1>
    <div class="row align-items-center justify-content-center my-3 mx-auto">
        <p class="text-center w-75">Helpers, utilities, and other miscellaneous files or classes.</p>
    </div>

    <hr>
    <h3 class="text-center">Utilities</h3>
    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto mb-5 table-sm">
        <tr>
            <td><a href="<?=APP_DOMAIN?>documentation/uploads" class="text-primary w-25">Uploads</a></td>
            <td>Provides support for file uploads.</td>
        </tr>
    </table>
</div>
<?php $this->end(); ?>