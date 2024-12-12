<?php $this->start('body'); ?>
<div class="col-12 mx-auto text-center">
  <img class="w-50" src="<?=APP_DOMAIN?>public/images/home/logo.png" alt="Example FormHelper function call">
</div>


<div class="row align-items-center justify-content-center my-5">
  <p class="text-center w-75">chappy.php is a whole new Model View Controller framework tailored to all of the fellows of the internet.  
    Our goal is to provide a light weight and easily expandable framework for any PHP developer.
  </p>
</div>

<div class="d-flex flex-column w-75 mx-auto">
  <div class="d-flex flex-wrap justify-content-around">
    <div class="card mb-5 border border-primary rounded-lg shadow-lg" style="width: 30rem;">
      <img class="card-img-top" src="<?=APP_DOMAIN?>public/images/home/form_helper.png" alt="Example FormHelper function call">
      <div class="card-body">
        <h5 class="card-title">Rapid Form Development</h5>
        <p class="card-text">Built in library of functions focused on rapid development of responsive web forms.</p>
      </div>
    </div>
    <div class="card mb-5 border border-primary rounded-lg shadow-lg" style="width: 30rem;">
      <img class="card-img-top" src="<?=APP_DOMAIN?>public/images/home/validation.png" alt="Validation messages">
      <div class="card-body">
        <h5 class="card-title">Server Side Form Validation</h5>
        <p class="card-text">Built in suite of server side form validation tools with message alert support.</p>
      </div>
    </div>
  </div>
  
  <div class="d-flex flex-wrap justify-content-around">
    <div class="card mb-5 border border-primary rounded-lg shadow-lg" style="width: 30rem;">
      <img class="card-img-top" src="<?=APP_DOMAIN?>public/images/home/contacts.png" alt="Contacts page">
      <div class="card-body">
        <h5 class="card-title">Sample MVC App</h5>
        <p class="card-text">The sample contact management systems includes a sample code base to introduce you to how to easily work with this framework..</p>
      </div>
    </div>
    <div class="card mb-5 border border-primary rounded-lg shadow-lg" style="width: 30rem;">
      <img class="card-img-top" src="<?=APP_DOMAIN?>public/images/home/register.png" alt="User registration page">
      <div class="card-body">
        <h5 class="card-title">User Management System</h5>
        <p class="card-text">Register new users and administer their permissions with ease using our Access Control Level tools.</p>
      </div>
    </div>
  </div>

  <div class="d-flex flex-wrap justify-content-around">
   <div class="card mb-5 border border-primary rounded-lg shadow-lg" style="width: 30rem;">
      <img class="card-img-top" src="<?=APP_DOMAIN?>public/images/home/documentation.png" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">Documentation</h5>
        <p class="card-text">Descriptions of all functions and classes that come with chappy.php along with a complete users guide.</p>
      </div>
    </div>
    <div class="card mb-5 border border-primary rounded-lg shadow-lg" style="width: 30rem;">
      <img class="card-img-top" src="<?=APP_DOMAIN?>public/images/home/ajax.png" alt="Card image cap">
      <img class="card-img-top" src="<?=APP_DOMAIN?>public/images/home/ajax_request.png" alt="Ajax request code">
      <div class="card-body d-flex flex-column">
        <h5 class="card-title">Example Ajax Request</h5>
        <p class="card-text">Demonstration of an ajax requests.</p>
          <div class="btn btn-primary mt-auto w-25" onclick="ajaxTest();">Click me!!!
            <script>
              function ajaxTest(){
                $.ajax({
                  type: "POST",
                  url : '<?=APP_DOMAIN?>home/testAjax',
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