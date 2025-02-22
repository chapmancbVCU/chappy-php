<div id="sortableImages" class="row align-items-center justify-content-start p-2">
    <?php foreach($this->profileImages as $image):?>
        <div class="col flex-grow-0" id="image_<?=$image->id?>">
            <span class="btn-danger" onclick="deleteImage('<?=$image->id?>')"><i class="fa fa-times"></i></span>
            <div class="edit-image-wrapper <?= ($image->sort == 0) ? 'current-profile-img' : ''?>" data-id="<?=$image->id?>">
                <img src="<?=APP_DOMAIN.$image->url?>" />
            </div>
        </div>
    <?php endforeach; ?>
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