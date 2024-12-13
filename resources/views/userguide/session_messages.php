<?php $this->setSiteTitle("Session Messages - User Guide"); ?>
<?php $this->start('body'); ?>

<div class="main">
    <div class="position-fixed">
        <a href="<?=APP_DOMAIN?>userguide/index" class="btn btn-xs btn-secondary">User Guide Home</a>
    </div>
    <h1 class="text-center">Session Messages</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <ol class="pl-4">
            <li><a href="#overview">Overview</a></li>
            <li><a href="#usage">Usage</a></li>
        </ol>
    </div>

    <h1 id="overview" class="text-center">Overview</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>Session messages provides support for displaying information to the user in a div 
            element styled using Bootstrap alert classes.  Examples are shown below:
        </p>
        <ol class="pl-4">
            <li class="alert alert-info" role="alert">alert-info example</li>
            <li class="alert alert-success" role="alert">alert-success example</li>
            <li class="alert alert-warning" role="alert">alert-warning example</li>
            <li class="alert alert-danger" role="alert">alert-danger example</li>
            <li class="alert alert-primary" role="alert">alert-primary example</li>
            <li class="alert alert-secondary" role="alert">alert-secondary example</li>
            <li class="alert alert-dark" role="alert">alert-dark example</li>
            <li class="alert alert-light" role="alert">alert-light example</li>
        </ol>
    </div>

    <h1 id="usage" class="text-center">Usage</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>When using with PHP you must first declare <b>use Session</b>.  An example 
            for how to perform this task is shown below:
        </p>
<pre class="mb-1 pb-1">
<code class="language-php line-numbers">Session::addMessage('success', 'Contact has been deleted');
</code>
</pre>
        <p>The result of performing the action is shown below in Figure 1.</p>
        <figure class="d-flex flex-column justify-content-center align-items-center">
            <img class="img-fluid" src="<?=APP_DOMAIN?>public/images/userGuide/session-message.png" alt="Example session message">
            <figcaption>Figure 1 - alert-success example</figcaption>
        </figure>
        <p>Note that the user can close each message by clicking on the x button.</p>

        <p>This same action can be completed using jQuery.  The only difference is a popup message appears at 
            the bottom of the screen with the message and disappears after 5 seconds.  An example from where we 
            use this to delete an image is shown below:
        </p>
<pre class="mb-1 pb-1">
<code class="language-php line-numbers">function deleteImage(image_id) {
    if(confirm("Are you sure?  This cannot be undone!")) {
        jQuery.ajax({
            url : '<?=APP_DOMAIN?>admindashboard/deleteImage',
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
</code>
</pre>
        <p>The result of calling this function is shown below in Figure 2.</p>
        <figure class="d-flex flex-column justify-content-center align-items-center">
            <img class="img-fluid" src="<?=APP_DOMAIN?>public/images/userGuide/session-message-2.png" alt="Popup session message">
            <figcaption>Figure 2 - Popup session message</figcaption>
        </figure>
    </div>
</div>
<?php $this->end(); ?>