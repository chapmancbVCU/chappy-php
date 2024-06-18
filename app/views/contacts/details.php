<?php $this->setSiteTitle($this->contact->displayName()); ?>
<?php $this->start('body'); ?>
<div class="col-md-8 col-md-offset-2 well">
    <a href="<?PROOT?>contacts" class="btn btn-xs btn-default">Back</a>
    <h2 class="text-center"><?=$this->contact->displayName()?></h2>
    <div class="col-md-6">
        <p><strong>Email: </strong><?=$this->contact->email?></p>
        <p><strong>Cell Phone: </strong><?=$this->contact->cell_phone?></p>
        <p><strong>Home Phone: </strong><?=$this->contact->home_phone?></p>
        <p><strong>Work Phone: </strong><?=$this->contact->work_phone?></p>
    </div>
    <div class="col-md-6">
        <?=$this->contact->displayAddressLabel()?>
    </div>
</div>
<?php $this->end(); ?>