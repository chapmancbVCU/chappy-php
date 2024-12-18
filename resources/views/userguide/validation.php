<?php $this->setSiteTitle("Validation - User Guide"); ?>
<?php $this->start('body'); ?>

<div class="main">
    <div class="position-fixed">
        <a href="<?=APP_DOMAIN?>userguide/index" class="btn btn-sm btn-secondary">User Guide Home</a>
    </div>
    <h1 class="text-center">Validation</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <ol class="pl-4">
            <li><a href="#overview">Overview</a></li>
            <li><a href="#setup">Setup</a></li>
            <li><a href="#validators">Validation Rules</a></li>
        </ol>
    </div>

    <h1 id="overview" class="text-center">Overview</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        Server side validation supports the frameworks ability to check if 
        values for an input field on a form meet specific requirements.  The most 
        commonly used check is required.  A list of supported checks is shown below:
        <ol class="pl-4 pt-3">
            <li>Email - checks if string is in valid email format.</li>
            <li>Lower Character - Checks if a string contains at least 1 lower case character.</li>
            <li>Matches - Used to check if two separate values match.  Used when setting up password.</li>
            <li>Max - Ensures value does not exceed maximum input size. <strong>(Requires rule - integer)</strong></li>
            <li>Min - Ensures value exceeds minimum input size. <strong>(Requires rule - integer)</strong></li>
            <li>Number - Checks if a string contains at least 1 numeric character</li>
            <li>Numeric - Ensures value is a numeric character</li>
            <li>Required - Ensures required value is entered into form</li>
            <li>Special - Checks if a string contains at least 1 special character that is not a space</li>
            <li>Unique - Checks database on form submit and verifies a value is unique (ex: user name)</li>
            <li>Upper Character - Checks if a string contains at least 1 upper case character.</li>
        </ol>
    </div>

    <h1 id="setup" class="text-center">Setup</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        Let's use the addAction function from an example ContactsController class.  
        As shown below on line 32, we have a displayErrors property for the View class.  We generally set 
        this value to a function call called getErrorMessages on the model.  In this case, we 
        are using the $contacts model because we want to add a new contact.

        <figure class="d-flex flex-column justify-content-center align-items-center pt-3">
            <img class="img-fluid" src="<?=APP_DOMAIN?>public/images/userGuide/add-action.png" alt="Controller side setup">
            <figcaption>Figure 1 - Controller side setup</figcaption>
        </figure>

        In the form you have two ways display errors:
        <ol class="pl-4 pt-3">
            <li>At the very top after the opening form tag.</li>
            <li>As an optional parameter in a function call to the FormHelper class for an input.</li>
        </ol>

        The form setup is shown below in figure 2.
        <figure class="d-flex flex-column justify-content-center align-items-center pt-3">
            <img class="img-fluid" src="<?=APP_DOMAIN?>public/images/userGuide/display-errors-form.png" alt="Form side setup">
            <figcaption>Figure 2 - Form side setup</figcaption>
        </figure>

        The result of submitting a form without entering required input is shown below.  Note the 
        box above all for elements.  All action items will be listed here.  Notice that since we 
        added $this->displayErrors as an argument for the FormHelper::inputBlock for first name 
        that the same message is below it as well along with styling around the input field.

        <figure class="d-flex flex-column justify-content-center align-items-center pt-3">
            <img class="img-fluid" src="<?=APP_DOMAIN?>public/images/userGuide/display-errors-example.png" alt="Form validation error example">
            <figcaption>Figure 3 - Form validation error example</figcaption>
        </figure>
    </div>

    <h1 id="validators" class="text-center">Validation Rules</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        First step is to create a validator function in your model class.  The structure looks as follows:
<pre class="my-3 pb-1">
<code class="language-php line-numbers">public function validator(): void {
    // Enter your validation function calls here.
}
</code>
</pre>    
        You can easily create a model with this function already created from the console by running the following command:
<pre class="my-3 pb-1" >
<code class="language-php line-numbers">php console make:model ${Modelname}
</code>
</pre>  
        Let's use the MaxValidator for the First Name field in the Contacts model as an example:
<pre class="my-3 pb-1">
<code class="language-php line-numbers">$this->runValidation(new MaxValidator($this, ['field' => 'fname', 'rule' => 150, 'message' => 'First name must be less than 150 characters.']));
</code>
</pre>   
        <p>The function call requires two parameters.  The $this keyword and an associative array.  
        Within the associative array you need to define the field, sometimes rule, and a message.  
        Let's look at the field.  Notice that it is a key value pair whose value is the 
        database field or model class' instance variable called fname.  The rule is similar and you 
        can adjust the rule based on how you define this field in the database.  Finally, the message 
        key value pair is used to set the the language displayed to the user when validation fails.  
        Within reason, industry standards always recommend utilizing both front end and server side 
        validation.</p>

        <p>You can also group several fields together and iterate through them with a foreach loop:</p>
<pre class="my-3 pb-1 ">
<code class="language-php line-numbers">$requiredFields = ['fname' => 'First Name', 'lname' => 'Last Name', 
    'address' => 'Address', 'city' => 'City', 'state' => 'State', 
    'zip' => 'Zip', 'email' => 'Email'];

foreach($requiredFields as $field => $display) {
    $this->runValidation(new RequiredValidator($this,['field'=>$field,'message'=>$display." is required."]));
}</code>
</pre>
        <p>This method requires a second associative array that contains the instance variables for your 
            model mapped to a string that matches the label on your form.  Then you iterate this array 
            through a foreach loop where you create a new instance for the validator object you want to use.
        </p>
    </div>
</div>
<?php $this->end(); ?>