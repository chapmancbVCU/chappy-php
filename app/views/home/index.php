<?php $this->start('body'); ?>
<h1 class="text-center">Welcome to MVC framework!</h1>

<div class="row align-items-center justify-content-center my-5">
  <p class="text-center w-75">The Model View Controller is a style of programming that allows developers to efficiently manage interactions between users, the user interface, and the database of a web application.  The models manages the data, logic and rules of the application.  The views are what the user sees and interacts with.  Finally, the controller manages interactions between the user, views, and models.</p>
  <p class="text-center w-75">This sample application natively comes with support for user login, registration, sessions associated with each user, sample contact management system, and documentation.</p>
</div>


<h4 class="text-center mb-4">Example Ajax Request</h4>

<div class="col text-center">
  <div class="btn btn-primary"onclick="ajaxTest();">Click me!!!
    <script>
      function ajaxTest(){
        $.ajax({
          type: "POST",
          url : '<?=PROOT?>home/testAjax',
          data : {model_id:45},
          success : function(resp){
            if(resp.success){
              window.alert(resp.data.name);
            }
            console.log(resp);
          }
        });
      }
    </script>
  </div>
</div>

  


<?php $this->end(); ?>