<?php
use Core\FormHelper;
?>
<?php $this->setSiteTitle("Set Status for ".$this->user->username); ?>
<?php $this->start('body') ?>

<h1 class="text-center">Set Status for <?=$this->user->username?></h1>

<div class="row align-items-center justify-content-center">
    <div class="col-md-3 bg-light p-3">
        <form class="form" action=<?=$this->postAction?> method="post">
            <?= FormHelper::csrfInput() ?>
            <?= FormHelper::checkboxBlockLabelLeft('Select to activate/deactivate account', 'inactive', $this->user->isInactiveChecked(), [], ['class' => 'form-group'], $this->displayErrors); ?>
            
            <div class="col-md-12 text-right">
                <a href="<?=APP_DOMAIN?>admindashboard/details/<?=$this->user->id?>" class="btn btn-default">Cancel</a>
                <?= FormHelper::submitTag('Activate / Deactivate',['class'=>'btn btn-primary']) ?>
            </div>
        </form>
    </div>
</div>
<?php $this->end(); ?>