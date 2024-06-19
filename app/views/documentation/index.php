<?php $this->setSiteTitle("Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>
<h1 class="text-center">Custom MVC Framework Docs</h1>

<div class="row align-items-center justify-content-center my-3">
    <p class="text-center w-75">The MVC documentation contains descriptions for built in classes, functions, and JavaScript</p>
</div>
<div class="ml-5">
    <ul>
        <li><a href="<?=PROOT?>documentation/controllers" class="text-primary">Controllers</a></li>
        <li><a href="<?=PROOT?>documentation/core" class="text-primary">Core</a></li>
        <li><a href="<?=PROOT?>documentation/javaScript" class="text-primary">javaScript</a></li>
        <li><a href="<?=PROOT?>documentation/models" class="text-primary">Models</a></li>
    </ul>
</div>


<?php $this->end(); ?>