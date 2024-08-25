<?php
use Core\FormHelper;
?>
<?php $this->setSiteTitle("Edit Details for ".$this->user->username); ?>
<?php $this->start('head') ?>
    <link rel="stylesheet" href="<?=APP_DOMAIN?>public/css/profileImage.css?v=<?=VERSION?>" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="<?=APP_DOMAIN?>public/css/jquery-ui/jquery-ui.min.css">
    <script src='<?=APP_DOMAIN?>vendor/tinymce/tinymce/tinymce.min.js'></script>
    <script src='<?=APP_DOMAIN?>public/js/profileDescriptionTinyMCE.js'></script>
    <script type="text/javascript" src="<?=APP_DOMAIN?>public/js/jquery-ui/jquery-ui.min.js"></script>
<?php $this->end() ?>

<?php $this->start('body'); ?>
<div class="row align-items-center justify-content-center">
    <div class="col-md-6 bg-light p-3">
        <h1 class="text-center">Edit Details for <?=$this->user->username?></h1>
        <hr>
        <form class="form" action="" method="POST" enctype="multipart/form-data">
            <?= FormHelper::csrfInput() ?>
            <input type="hidden" id="images_sorted" name="images_sorted" value="" />
            <?= FormHelper::displayErrors($this->displayErrors) ?>
            <?= FormHelper::inputBlock('text', "First Name", 'fname', $this->user->fname, ['class' => 'form-control input-sm'], ['class' => 'form-group']) ?>
            <?= FormHelper::inputBlock('text', "Last Name", 'lname', $this->user->lname, ['class' => 'form-control input-sm'], ['class' => 'form-group']) ?>
            <?= FormHelper::emailBlock("Email", 'email', $this->user->email, ['class' => 'form-control input-sm'], ['class' => 'form-group']) ?>
            <?= FormHelper::textAreaBlock("About Me", 
                'description', 
                $this->user->description, 
                ['class' => 'form-control input-sm', 'placeholder' => 'Describe yourself here...', 'rows' => '4'], 
                ['class' => 'form-group']); 
            ?>

            <?= FormHelper::inputBlock('file', "Upload Profile Image (Optional)", 'profileImage', '', ['class' => 'form-control'], ['class' => 'form-group w-50'], $this->displayErrors) ?>
            <div id="sortableImages" class="row align-items-center justify-content-start p-2">
                <?php foreach($this->profileImages as $image):?>
                    <div class="col flex-grow-0" id="image_<?=$image->id?>">
                        <span class="delete-button" onclick="deleteImage('<?=$image->id?>')"><i class="fa fa-times"></i></span>
                        <div class="edit-image-wrapper <?= ($image->sort == 0) ? 'current-profile-img' : ''?>" data-id="<?=$image->id?>">
                            <img src="<?=APP_DOMAIN.$image->url?>" />
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="col-md-12 text-right">
                <a href="<?=APP_DOMAIN?>profile" class="btn btn-default">Cancel</a>
                <?= FormHelper::submitTag('Update', ['class' => 'btn btn-primary'])  ?>
            </div>
        </form>
    </div>
</div>
<script>
    function updateSort() {
        var sortedIDs = $("#sortableImages").sortable("toArray");
        $('#images_sorted').val(JSON.stringify(sortedIDs));
    }

    function deleteImage(image_id) {
        if(confirm("Are you sure?  This cannot be undone!")) {
            jQuery.ajax({
                url : '<?=APP_DOMAIN?>profile/deleteImage',
                method: "POST",
                data : {image_id : image_id},
                success: function(resp) {
                    if(resp.success) {
                        jQuery('#image_'+resp.model_id).remove();
                        updateSort();
                        alertMsg('Image Deleted.');
                    }
                } 
            });
        }
    }

    jQuery('document').ready(function(){
        jQuery('#sortableImages').sortable({
            axis: "x",
            placeholder: "sortable-placeholder",
            update : function(event, ui) {
                updateSort();
            }
        });
        updateSort();
    });
</script>
<?php $this->end(); ?>