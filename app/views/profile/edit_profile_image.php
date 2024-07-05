<?php $this->setSiteTitle("Update profile image for ".$this->user->username); ?>
<?php $this->start('body'); ?>
<div class="row align-items-center justify-content-center">
    <div class="col-md-6 bg-light p-3">
        <a href="<?=PROOT?>profile" class="btn btn-xs btn-secondary mb-3">Back</a>
        <h1 class="text-center">Update profile image for <?=$this->user->username?></h1>
        <hr>
    </div>
</div>

<?php $this->end(); ?>