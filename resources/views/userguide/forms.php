<?php $this->setSiteTitle("Rapid Forms - User Guide"); ?>
<?php $this->start('body'); ?>

<div class="main">
    <div class="position-fixed">
        <a href="<?=APP_DOMAIN?>userguide/index" class="btn btn-sm btn-secondary">User Guide Home</a>
    </div>
    <h1 class="text-center">Rapid Forms</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <ol class="pl-4">
            <li><a href="#overview">Overview</a></li>
            <li><a href="#button">button</a></li>
            <li><a href="#button-block">buttonBlock</a></li>
            <li><a href="#checkbox-block-label-left">checkboxBlockLabelLeft</a></li>
            <li><a href="#checkbox-block-label-right">checkboxBlockLabelRight</a></li>
            <li><a href="#csrf-input">csrfInput</a></li>
            <li><a href="#display-errors">displayErrors</a></li>
            <li><a href="#email-block">emailBlock</a></li>
            <li><a href="#hidden">hidden</a></li>
            <li><a href="#input-block">inputBlock</a></li>
            <li><a href="#output">output</a></li>
            <li><a href="#radio-input">radioInput</a></li>
            <li><a href="#select-block">selectBlock</a></li>
            <li><a href="#submit-tag">submitTag</a></li>
            <li><a href="#tel-block">telBlock</a></li>
            <li><a href="#textarea-block">textAreaBlock</a></li>
        </ol>
    </div>

    <h1 id="overview" class="text-center">Overview</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>The Rapid Forms feature of this Model View Controller (MVC) Framework allows 
            the user to quickly create and style forms.  This guide thoroughly describes the 
            ability to create these HTML form elements along with a description and examples.  
            If you would like support for additional features please create an issue  
            <a href="https://github.com/chapmancbVCU/custom-php-mvc-framework/issues">here</a>.  
        </p>
    </div>

    <h1 id="button" class="text-center">button</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>This function creates a button with no surrounding HTML div element.  It supports 
            the ability to set attributes such as classes and event handlers.  If you 
            want a div to surround a button along with any other attributes we recommend 
            that you use the buttonBlock function.  Note the example function call shown below in Figure 1.
        </p>

        <figure class="d-flex flex-column justify-content-center align-items-center">
            <img class="img-fluid" src="<?=APP_DOMAIN?>public/images/userGuide/button-function-call.png" alt="Example button Function Call">
            <figcaption>Figure 1 - Example button Function Call</figcaption>
        </figure>

        <p>This function accepts 2 arguments as described below:</p>
        <ol class="pl-4">
            <li>$buttonText is used to set the text of the button.</li>
            <li>$inputAttrs is an array and can be found in most function calls.  We use this parameter to set 
                values for attributes such as classes for styling, front-side validation, and event handlers.  Make 
                sure when performing an event handler function call that contains strings as arguments to escape 
                any quotes.  The default value is an empty array.
            </li>
        </ol>
    </div>

    <h1 id="button-block" class="text-center">buttonBlock</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>The buttonBlock function is a wrapper for the button function that adds a div around the button element.  An 
            example function call is shown below in Figure 2.
        </p>
        <figure class="d-flex flex-column justify-content-center align-items-center">
            <img class="img-fluid" src="<?=APP_DOMAIN?>public/images/userGuide/button-block-function-call.png" alt="Example buttonBlock Function Call">
            <figcaption>Figure 2 - Example buttonBlock Function Call</figcaption>
        </figure>

        <p>This function accepts 3 arguments as described below:</p>
        <ol class="pl-4">
            <li>$buttonText is used to set the text of the button.</li>
            <li>$inputAttrs is an array and can be found in most function calls.  We use this parameter to set 
                values for attributes such as classes for styling, front-side validation, and event handlers.  Make 
                sure when performing an event handler function call that contains strings as arguments to escape 
                any quotes.  The default value is an empty array.
            </li>
            <li>$divAttrs is an array whose primary purpose is to add classes for styling the div that surrounds the button 
                element.  The default value is an empty array.
            </li>
        </ol>
    </div>

    <h1 id="checkbox-block-label-left" class="text-center">checkboxBlockLabelLeft</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>Generates a checkbox where the label is on the left side.  It generates a div element that surrounds a label and input of 
            type checkbox.  This is idea for situations where labels can be of varying lengths.  An example function call is 
            shown below in Figure 3.
        </p>
        <figure class="d-flex flex-column justify-content-center align-items-center">
            <img class="img-fluid" src="<?=APP_DOMAIN?>public/images/userGuide/checkbox-left-label-function-call.png" alt="Example checkboxBlockLabelLeft Function Call">
            <figcaption>Figure 3 - Example checkboxBlockLabelLeft Function Call</figcaption>
        </figure>

        <p>This function accepts 6 arguments as described below:</p>
        <ol class="pl-4">
            <li>$label is used to set the text of the label element.</li>
            <li>$name sets the value for the name, for, and id attributes.</li>
            <li>$value sets the value for the data received upon form submit.  The default value is an empty string.</li>
            <li>$checked is used to set a value of checked for a checkbox.  This value can be set upon reading information 
                from a database or upon failed form validation.
            </li>
            <li>$inputAttrs is an array and can be found in most function calls.  We use this parameter to set 
                values for attributes such as classes for styling, front-side validation, and event handlers.  The default 
                value is an empty array.
            </li>
            <li>$divAttrs is an array whose primary purpose is to add classes for styling the div that surrounds the input 
                element.  The default value is an empty array.
            </li>
        </ol>
    </div>

    <h1 id="checkbox-block-label-right" class="text-center">checkboxBlockLabelRight</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>Generates a checkbox where the label is on the left side.  It generates a div element that surrounds a label and input of 
            type checkbox.  An example function call from the login view is shown below in Figure 3.
        </p>
        <figure class="d-flex flex-column justify-content-center align-items-center">
            <img class="img-fluid" src="<?=APP_DOMAIN?>public/images/userGuide/checkbox-right-label-function-call.png" alt="Example checkboxBlockLabelRight Function Call">
            <figcaption>Figure 4 - Example checkboxBlockLabelRight Function Call</figcaption>
        </figure>

        <p>This function accepts 6 arguments as described below:</p>
        <ol class="pl-4">
            <li>$label is used to set the text of the label element.</li>
            <li>$name sets the value for the name, for, and id attributes.</li>
            <li>$value sets the value for the data received upon form submit.  The default value is an empty string.</li>
            <li>$checked is used to set a value of checked for a checkbox.  This value can be set upon reading information 
                from a database or upon failed form validation.
            </li>
            <li>$inputAttrs is an array and can be found in most function calls.  We use this parameter to set 
                values for attributes such as classes for styling, front-side validation, and event handlers.  The default 
                value is an empty array.
            </li>
            <li>$divAttrs is an array whose primary purpose is to add classes for styling the div that surrounds the input 
                element.  The default value is an empty array.
            </li>
        </ol>
    </div>

    <h1 id="csrf-input" class="text-center">csrfInput</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>Generates a CRSF token as the value for an input of type hidden.  The token is randomly generated 
            and is used to verify if any tampering of any form has been performed.  Use this function to assist in 
            preventing CSRF attacks.  The CRSF token is unique for every user session and is a sufficiently large 
            string of random values.
        </p>
    </div>

    <h1 id="display-errors" class="text-center">displayErrors</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>The purpose of this function is to display errors related to validation.  An example can be found in Figure 5.</p>
        <figure class="d-flex flex-column justify-content-center align-items-center">
            <img class="img-fluid" src="<?=APP_DOMAIN?>public/images/userGuide/display-errors.png" alt="Display Errors">
            <figcaption>Figure 5 - Display Errors</figcaption>
        </figure>
    </div>

    <h1 id="email-block" class="text-center">emailBlock</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>Use this function to create styled E-mail form inputs.  An example function call is shown below in Figure 6.</p>
        <figure class="d-flex flex-column justify-content-center align-items-center">
            <img class="img-fluid" src="<?=APP_DOMAIN?>public/images/userGuide/email-block.png" alt="Email Block">
            <figcaption>Figure 6 - Email Block</figcaption>
        </figure>
        <p>This function accepts 6 arguments as described below:</p>
        <ol class="pl-4">
            <li>$label is used to set the text of the label element.</li>
            <li>$name sets the value for the name, for, and id attributes.</li>
            <li>The value we want to set. We can use this to set the value of the value attribute during form validation. Default value is the empty string. 
                It can be set with values during form validation and forms used for editing records.</li>
            <li>$inputAttrs The values used to set the class and other attributes of the input string. The default value is an empty array.</li>
            <li>$divAttrs The values used to set the class and other attributes of the surrounding div. The default value is an empty array.</li>
            <li>$errors The errors array. Default value is an empty array.</li>
        </ol>
    </div>

    <h1 id="hidden" class="text-center">hidden</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>Generates a hidden element.  An example function call is shown below in figure 7:</p>
        <figure class="d-flex flex-column justify-content-center align-items-center">
            <img class="img-fluid" src="<?=APP_DOMAIN?>public/images/userGuide/hidden.png" alt="Hidden Input">
            <figcaption>Figure 7 - Hidden Input</figcaption>
        </figure>
        <p>This function accepts 2 arguments as described below:</p>
        <ol class="pl-4">
            <li>$name sets the value for the name, for, and id attributes.</li>
            <li>$value The value for the value attribute.</li>
        </ol>
    </div>

    <h1 id="input-block" class="text-center">inputBlock</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>A generic input block that supports the following input types:</p>
        <ol class="pl-5">
            <li>Color</li>
            <li>date</li>
            <li>datetime-local</li>
            <li>email</li>
            <li>file</li>
            <li>month</li>
            <li>number</li>
            <li>password</li>
            <li>range</li>
            <li>search</li>
            <li>tel</li>
            <li>text</li>
            <li>time</li>
            <li>url</li>
            <li>week</li>
        </ol>
        <p>An example function call is show below in figure 8:</p>
        <figure class="d-flex flex-column justify-content-center align-items-center">
            <img class="img-fluid" src="<?=APP_DOMAIN?>public/images/userGuide/input-block.png" alt="Input Block">
            <figcaption>Figure 8 - Input Block</figcaption>
        </figure>
        <p>This function accepts 7 arguments as described below:</p>
        <ol class="pl-4">
            <li>$type The input type we want to generate.</li>
            <li>$label is used to set the text of the label element.</li>
            <li>$name sets the value for the name, for, and id attributes.</li>
            <li>The value we want to set. We can use this to set the value of the value attribute during form validation. Default value is the empty string. 
                It can be set with values during form validation and forms used for editing records.</li>
            <li>$inputAttrs The values used to set the class and other attributes of the input string. The default value is an empty array.</li>
            <li>$divAttrs The values used to set the class and other attributes of the surrounding div. The default value is an empty array.</li>
            <li>$errors The errors array. Default value is an empty array.</li>
        </ol>
    </div>

    <h1 id="output" class="text-center">output</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>Generates an HTML output element.  The output element is a container that can inject the results of a calculator or the outcome of a user action.  
            An example function call is shown below:
        </p>
        <figure class="d-flex flex-column justify-content-center align-items-center">
            <img class="img-fluid" src="<?=APP_DOMAIN?>public/images/userGuide/output-element.png" alt="Output Element">
            <figcaption>Figure 9 - Output Element</figcaption>
        </figure>
        <p>This function accepts 2 arguments as described below:</p>
        <ol class="pl-4">
            <li>$name Sets the value for the name attributes for this </li>
            <li>$for Sets the value for the for attribute.</li>
        </ol>
    </div>

    <h1 id="radio-input" class="text-center">radioInput</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
    </div>

    <h1 id="select-block" class="text-center">selectBlock</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
    </div>

    <h1 id="submit-block" class="text-center">submitBlock</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
    </div>

    <h1 id="submit-tag" class="text-center">submitTag</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
    </div>

    <h1 id="textarea-block" class="text-center">textAreaBlock</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
    </div>
</div>
<?php $this->end(); ?>