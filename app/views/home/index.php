<?php $this->start('body'); ?>
<h1 class="text-center">Welcome to MVC framework!</h1>

<div class="row align-items-center justify-content-center my-5">
  <p class="text-center w-75">The Model View Controller is a style of programming that allows developers to efficiently manage interactions between users, the user interface, and the database of a web application.  The models manages the data, logic and rules of the application.  The views are what the user sees and interacts with.  Finally, the controller manages interactions between the user, views, and models.</p>
  <p class="text-center w-75">This sample application natively comes with support for user login, registration, sessions associated with each user, sample contact management system, and documentation.</p>
</div>

<div class="d-flex flex-column w-75 mx-auto">
  <div class="d-flex flex-wrap justify-content-around">
    <div class="card mb-5 border border-primary rounded-lg" style="width: 30rem;">
      <img class="card-img-top" src="<?=PROOT?>public/images/form_helper.png" alt="Example FormHelper function call">
      <div class="card-body">
        <h5 class="card-title">Rapid Form Development</h5>
        <p class="card-text">Built in library of functions focused on rapid development of responsive web forms.</p>
      </div>
    </div>
    <div class="card mb-5 border border-primary rounded-lg" style="width: 30rem;">
      <img class="card-img-top" src="<?=PROOT?>public/images/validation.png" alt="Validation messages">
      <div class="card-body">
        <h5 class="card-title">Server Side Form Validation</h5>
        <p class="card-text">Built in suite of server side form validation tools with message alert support.</p>
      </div>
    </div>
  </div>
  
  <div class="d-flex flex-wrap justify-content-around">
    <div class="card mb-5 border border-primary rounded-lg" style="width: 30rem;">
      <img class="card-img-top" src="<?=PROOT?>public/images/contacts.png" alt="Contacts page">
      <div class="card-body">
        <h5 class="card-title">Sample MVC App</h5>
        <p class="card-text">The sample contact management systems demonstrates how to use all features of this MVC framework.</p>
      </div>
    </div>
    <div class="card mb-5 border border-primary rounded-lg" style="width: 30rem;">
      <img class="card-img-top" src="<?=PROOT?>public/images/register.png" alt="User registration page">
      <div class="card-body">
        <h5 class="card-title">User Management System</h5>
        <p class="card-text">Register and manage users with ease.  Use built in validation to enforce strong password requirements.</p>
      </div>
    </div>
  </div>

  <div class="d-flex flex-wrap justify-content-around">
   <div class="card mb-5 border border-primary rounded-lg" style="width: 30rem;">
      <img class="card-img-top" src="<?=PROOT?>public/images/documentation.png" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">MVC Documentation</h5>
        <p class="card-text">Descriptions of all functions and classes that come with this MVC framework.</p>
      </div>
    </div>
    <div class="card mb-5 border border-primary rounded-lg" style="width: 30rem;">
      <img class="card-img-top" src="<?=PROOT?>public/images/ajax.png" alt="Card image cap">
      <img class="card-img-top" src="<?=PROOT?>public/images/ajax_request.png" alt="Ajax request code">
      <div class="card-body d-flex flex-column">
        <h5 class="card-title">Example Ajax Request</h5>
        <p class="card-text">Demonstration of an ajax requests.</p>
          <div class="btn btn-primary mt-auto w-25" onclick="ajaxTest();">Click me!!!
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

<?php $this->end(); ?>