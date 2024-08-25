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