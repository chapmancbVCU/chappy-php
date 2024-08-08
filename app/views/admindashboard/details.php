<?php use Core\Helper; ?>

<?php $this->setSiteTitle($this->user->username . " Details"); ?>
<?php $this->start('body'); ?>
<h1 class="text-center">Details for <?=$this->user->username?></h1>


<?php $this->end(); ?>