<?php $this->setSiteTitle("Add A Contact"); ?>
<?php $this->start('body'); ?>
<div class="col-md-8 col-md-offset-2 well">
    <h2 class="text-center">Add A Contact</h2>
    <hr>
    <?php $this->addPartialView('contacts', 'form'); ?>
</div>
<?php $this->end(); ?>