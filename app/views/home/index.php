<?php $this->start('body'); ?>
<h1 class="text-center">Welcome to MVC framework!</h1>

<div class="row align-items-center justify-content-center my-5">
  <p class="text-center w-75">The Model View Controller is a style of programming that allows developers to efficiently manage interactions between users, the user interface, and the database of a web application.  The models manages the data, logic and rules of the application.  The views are what the user sees and interacts with.  Finally, the controller manages interactions between the user, views, and models.</p>
  <p class="text-center w-75">This sample application natively comes with support for user login, registration, sessions associated with each user, sample contact management system, and documentation.</p>
</div>

<div class="d-flex flex-column w-75 mx-auto">
  <div class="d-flex flex-wrap justify-content-around">

    <div class="card mb-5" style="width: 30rem;">
      <img class="card-img-top" src="<?=PROOT?>public/images/form_helper.png" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">Rapid Form Development</h5>
        <p class="card-text">Built in library of functions focused on rapid development of responsive web forms.</p>
      </div>
    </div>

    <div class="card mb-5" style="width: 30rem;">
      <img class="card-img-top" src="<?=PROOT?>public/images/validation.png" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">Server Side Form Validation</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      </div>
    </div>
  </div>
  
  <div class="d-flex flex-wrap justify-content-around">
    <div class="card mb-5" style="width: 30rem;">
      <img class="card-img-top" src="<?=PROOT?>public/images/contacts.png" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">Sample MVC App</h5>
        <p class="card-text">The sample contact management systems demonstrates how to use all features of this MVC framework.</p>
      </div>
    </div>
    <div class="card mb-5" style="width: 30rem;">
      <img class="card-img-top" src="<?=PROOT?>public/images/register.png" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">User Management System</h5>
        <p class="card-text">Register and manage users with ease.  Use built in validation to enforce strong password requirements.</p>
      </div>
    </div>
  </div>


  <div class="d-flex justify-content-around">
    <div class="card mb-5" style="width: 30rem;">
      <div class="card-body">
        <h5 class="card-title">Example Ajax Request</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <div class="col text-center d-flex">
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
      </div>
    </div> 
  </div>
</div>

<?php $this->end(); ?>