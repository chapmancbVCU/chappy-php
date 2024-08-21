<?php $this->setSiteTitle("FormHelper - Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>
<?php include(ROOT . DS . 'app' . DS . 'views/layouts/docs_nav.php'); ?>

<div class="main">
    <a href="<?=APP_DOMAIN?>documentation/core" class="btn btn-xs btn-secondary">Core</a>
    <h1 class="text-center">FormHelper Class</h1>
    <div class="row align-items-center justify-content-center my-3">
        <p class="text-center w-75">Contains functions for building form elements of various types.</p>
    </div>

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">Extends</th>
        </tr>
        <tr>
            <td colspan="2" class="text-center">None</td>
        </tr>
        <tr>
            <th colspan="2" class="text-center">Namespace</th>
        </tr>
        <tr>
            <td colspan="2" class="text-center">Core</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" rowspan="3">Use</th>
            <tr><td>Core\Model</td></tr>
        </tr> 
        <tr><td>\Exception\</td></tr> 
        <tr>
            <th colspan="2" class="text-center">Instance Variables</th>
        </tr>
        <tr>
            <td class="text-center" colspan="2">None</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function appendErrorClass</th>
        </tr>
        <tr>
            <td colspan="2">Adds name of error classes to div associated with a form field.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$attrs The values used to set the class and other attributes of the input string.  The default value is an empty array.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$errors The errors array.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$name The name of the field associated with this error.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$class Name of the class used to identify errors for a form field.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$attrs Div attributes with error classes added.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function button</th>
        </tr>
        <tr>
            <td colspan="2">
                Supports ability to create a styled button.  Supports ability to have functions for event handlers.
                <br><br>
                An example function call is shown below:
                <br>
                <pre class="my-0">
<code>
FormHelper::button(
    "Click Me!", 
    ['class' => 'btn btn-large btn-primary', 
    'onClick' => 'alert(\'Hello World!\')']
);
</code>
                </pre>
                Example HTML output is shown below:
                <pre class="my-0">
<code>
&lt;button type="button" 
    class="btn btn-large btn-primary" 
    onClick="alert('Hello World!')"&gt;Click Me!
&lt;/button&gt;    
</code>
                </pre>
            </td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$buttonText The contents of the button's label.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$inputAttrs The values used to set the class and other attributes of the input string.  The default value is an empty array.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>An HTML button element with its label set and any other optional attributes set.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function buttonBlock</th>
        </tr>
        <tr>
            <td colspan="2">
                Supports ability to create a styled button and styled surrounding div block.  Supports ability to have functions for event handlers".
                <br><br>
                An example function call is shown below:
                <br>
                <pre class="my-0">
<code>
FormHelper::buttonBlock(
    "Click Me!", 
    ['class' => 'btn btn-large btn-primary', 
    'onClick' => 'alert(\'Hello World!\')'], 
    ['class' => 'form-group']
);
</code>
                </pre>
                Example HTML output is shown below:
                <pre class="my-0">
<code>
&lt;div class="form-group"&gt; 
    &lt;button type="button"  
        class="btn btn-large btn-primary"
        onClick="alert('Hello World!')"&gt;Click Me!
    &lt;/button&gt;
&lt;/div&gt; 
</code>
                </pre>
            </td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$buttonText The contents of the button's label.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$inputAttrs The values used to set the class and other attributes of the input string.  The default value is an empty array.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$divAttrs The values used to set the class and other attributes of the surrounding div.  The default value is an empty array.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>An HTML div surrounding a button element with its label set and any other optional attributes set.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function checkboxBlockLabelLeft</th>
        </tr>
        <tr>
            <td colspan="2">
                Generates a div containing an input of type checkbox with the label to the left that is not part of a group.
                <br><br>
                An example function call is shown below:
                <br>
                <pre class="my-0">
<code>
FormHelper::checkboxBlockLabelLeft(
    'Remember Me', 
    'remember_me', 
    'on', 
    $this->login->getRememberMeChecked(), 
    [], 
    ['class' => 'form-group']
);
</code>
                </pre>
                Example HTML output is shown below:
                <pre class="my-0">
<code>
&lt;div class="form-group"&gt; 
    &lt;label for="remember_me">Remember Me 
        &lt;input type="checkbox" 
            id="remember_me" 
            name="remember_me" 
            value="on"&gt; 
    &lt;/label&gt; 
&lt;/div&gt; 
</code>
                </pre>
            </td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$label Sets the label for this input.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$name Sets the value for the name, for, and id attributes for this input.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$value The value we want to set.  We can use this to set the value of the value attribute during form validation.  Default value is the empty string.  It can be set with values during form validation and forms used for editing records.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">bool</td>
            <td>$checked The value for the checked attribute.  If true this attribute will be set as checked="checked".  The default value is false.  It can be set with values during form validation and forms used for editing records.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$inputAttrs The values used to set the class and other attributes of the input string.  The default value is an empty array.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$divAttrs The values used to set the class and other attributes of the surrounding div.  The default value is an empty array.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$errors The errors array.  Default value is an empty array.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>A surrounding div and the input element of type checkbox.</td>
        </tr>
    </table>

<hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function checkboxBlockLabelRight</th>
        </tr>
        <tr>
            <td colspan="2">
            Generates a div containing an input of type checkbox with the label to the left that is not part of a group.
                <br><br>
                An example function call is shown below:
                <br>
                <pre class="my-0">
<code>
FormHelper::checkboxBlockLabelRight(
    'Remember Me', 
    'remember_me', 
    'on', 
    $this->login->getRememberMeChecked(), 
    [], 
    ['class' => 'form-group']
);
</code>
                </pre>
                Example HTML output is shown below:
                <pre class="my-0">
<code>
&lt;div class="form-group"&gt;
    &lt;input type="checkbox" 
        id="remember_me" 
        name="remember_me" 
        value="on" /&gt;
    &lt;label for="remember_me">Remember Me&lt;/label&gt;
&lt;/div>
</code>
                </pre>
            </td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$label Sets the label for this input.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$name Sets the value for the name, for, and id attributes for this input.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$value The value we want to set.  We can use this to set the value of the value attribute during form validation.  Default value is the empty string.  It can be set with values during form validation and forms used for editing records.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">bool</td>
            <td>$checked The value for the checked attribute.  If true this attribute will be set as checked="checked".  The default value is false.  It can be set with values during form validation and forms used for editing records.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$inputAttrs The values used to set the class and other attributes of the input string.  The default value is an empty array.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$divAttrs The values used to set the class and other attributes of the surrounding div.  The default value is an empty array.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$errors The errors array.  Default value is an empty array.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>A surrounding div and the input element.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function checkToken</th>
        </tr>
        <tr>
            <td colspan="2">Checks if the csrf token exists.  This is used to verify that that has been no tampering of a form's csrf token.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$token The token string we will test whether or not it exists.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">bool</td>
            <td>The result of the AND operation on whether or not a token exists with a session and if the session's token is equal to the value of the $token parameter.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function csrfInput</th>
        </tr>
        <tr>
            <td colspan="2">
                A hidden input to represent the csrf token in a web form.
                Example HTML output is shown below:
                <pre class="my-0">
<code>
&lt;input type="hidden" 
    name="csrf_token" 
    id="csrf_token" 
    value="RANDOM_STRING_OF_VALUES" 
/&gt;
</code>
                </pre>
            </td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="text-center" colspan="2">None</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>The hidden input of type hidden with the generated token set as the value.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function displayErrors</th>
        </tr>
        <tr>
            <td colspan="2">Returns list of errors.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$errors A list of errors and their description that is generated during server side form validation.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>A string representation of a div element containing an input of type checkbox.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">
    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function emailBlock</th>
        </tr>
        <tr>
            <td colspan="2">
                Renders an HTML div element that surrounds an input of type email.
                <br><br>
                An example function call is shown below:
                <br>
                <pre class="my-0">
<code>
FormHelper::emailBlock('Email', 
    'email', 
    $this->contact->email, 
    ['class' => 'form-control'], 
    ['class' => 'form-group col-md-6']
);
</code>
                </pre>
                Example HTML output is shown below:
                <pre class="my-0">
<code>
&lt;div class="form-group"&gt; 
    &lt;label for="email"&gt;Email&lt;/label&gt;
    &lt;input type="email" 
        id="email" 
        name="email" 
        value="" 
        class="form-control" 
        placeholder="joe@example.com" 
    /&gt;
&lt;/div&gt; 
</code>
                </pre>
            </td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$label Sets the label for this input.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$name Sets the value for the name, for, and id attributes for this input.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">mixed</td>
            <td>$value The value we want to set.  We can use this to set the value of the value attribute during form validation.  Default value is the empty string.  It can be set with values during form validation and forms used for editing records.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$inputAttrs The values used to set the class and other attributes of the input string.  The default value is an empty array.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$divAttrs The values used to set the class and other attributes of the surrounding div.  The default value is an empty array.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$errors The errors array.  Default value is an empty array.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>A surrounding div and the input element of type email.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function generateToken</th>
        </tr>
        <tr>
            <td colspan="2">Creates a randomly generated csrf token.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td>None</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>The randomly generated token.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function hidden</th>
        </tr>
        <tr>
            <td colspan="2">
                Generates a hidden input element.
                <br><br>
                An example function call is shown below:
                <br>
                <pre class="my-0">
<code>
FormHelper::hidden(
    "example_name", 
    "example_value"
);
</code>
                </pre>
                Example HTML output is shown below:
                <pre class="my-0">
<code>
&lt;input type="hidden"
    name="example_name" 
    id="example_name" 
    value="example_value"
/&gt;
</code>
                </pre>
            </td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$name The value for the name and id attributes.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">mixed</td>
            <td>$value The value for the value attribute.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>The html input element with type hidden.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function inputBlock</th>
        </tr>
        <tr>
            <td colspan="2">
                Assists in the development of forms input blocks in forms.  It accepts parameters for setting attribute tags in the form section.  Not to be used for inputs of type "Submit"  For submit inputs use the submitBlock or submitTag functions.
                <br><br>
                Types of inputs supported:
                <br>
                <ol>
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
            
            <br>
                <pre class="my-0">
<code>
FormHelper::inputBlock(
    'text', 
    'Example', 
    'example_name', 
    example_value, 
    ['class' => 'form-control'], 
    ['class' => 'form-group']
);
</code>
                </pre>
                Example HTML output is shown below:
                <pre class="my-0">
</code>
<code>
&lt;div class="form-group"&gt; 
    &lt;label for="example">Example&lt;/label&gt; 
    &lt;input type="text" 
        id="example_name" 
        name="example_name" 
        value="example_value" 
        class="form-control" /&gt; 
&lt;/div&gt; 
</code>      
                </pre>
            </td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$type The input type we want to generate.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$label Sets the label for this input.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$name Sets the value for the name, for, and id attributes for this input.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">mixed</td>
            <td>$value The value we want to set.  We can use this to set the value of the value attribute during form validation.  Default value is the empty string.  It can be set with values during form validation and forms used for editing records.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$inputAttrs The values used to set the class and other attributes of the input string.  The default value is an empty array.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$divAttrs The values used to set the class and other attributes of the surrounding div.  The default value is an empty array.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$errors The errors array.  Default value is an empty array.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>A surrounding div and the input element.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function output</th>
        </tr>
        <tr>
            <td colspan="2">
                Generates an HTML output element.
                <br><br>
                An example function call is shown below:
                <br>
                <pre class="my-0">
<code>
FormHelper::output(
    "my_name", 
    "for_value"
);
</code>
                </pre>
                Example HTML output is shown below:
                <pre class="my-0">
<code>
&lt;output name="my_name" 
    for="for_value"&gt;
&lt;/output&gt;
</code>
                </pre>
            </td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$name Sets the value for the name attributes for this 
            * input.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$for Sets the value for the for attribute.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>The HTML output element.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function posted_values</th>
        </tr>
        <tr>
            <td colspan="2">Performs sanitization of values obtained during $_POST.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$post Values from the $_POST superglobal array when the user submits a form.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>An array of sanitized values from the submitted form.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function radioInput</th>
        </tr>
        <tr>
            <td colspan="2">
                Creates an input element of type radio with an accompanying label element.  Compatible with radio button groups.
                <br><br>
                An example function call is shown below:
                <br>
                <pre class="my-0">
<code>
FormHelper::radioInput('HTML', 'html', 
    'fav_language', "HTML", $check1, 
    ['class' => 'form-group mr-1']
);
FormHelper::radioInput('CSS', 'css', 
    'fav_language', "CSS", $check2, 
    ['class' => 'form-group mr-1']
);
</code>
                </pre>
                Example HTML output is shown below:
                <pre class="my-0">
<code>
&lt;input type="radio" 
    id="html" 
    name="fav_language" 
    value="HTML" 
    class="form-group 
    mr-1"&gt; 
&lt;label for="html">HTML&lt;/label&gt;  &lt;br&gt; 
&lt;input type="radio" 
    id="css" 
    name="fav_language" 
    value="CSS" 
    class="form-group 
    mr-1"&gt; 
&lt;label for="css">CSS&lt;/label&gt; 
</code>
                </pre>
            </td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$label Sets the label for this input.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$id The id attribute for the radio input element.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$value The value we want to set.  We can use this to set the value of the value attribute during form validation.  Default value is the empty string.  It can be set with values during form validation and forms used for editing records.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td></td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">bool</td>
            <td>$checked The value for the checked attribute.  If true this attribute will be set as checked="checked".  The default value is false.  It can be set with values during form validation and forms used for editing records.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$inputAttrs The values used to set the class and other attributes of the input string.  The default value is an empty array.</td>
        </tr>

        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>The HTML input element of type radio.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function sanitize</th>
        </tr>
        <tr>
            <td colspan="2">Sanitizes potentially harmful string of characters.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">mixed</td>
            <td>$dirty The potentially dirty string.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>The sanitized version of the dirty string.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function selectBlock</th>
        </tr>
        <tr>
            <td colspan="2">
                Renders a select element with a list of options.
                <br><br>
                An example function call is shown below:
                <br>
                <pre class="my-0">
<code>
FormHelper::selectBlock(
    "Test", 
    "test", 
    $_POST["test"],
    ['A' => 'a','B' => 'b', 'C' => 'c'], 
    ['class' => 'form-control'], 
    ['class' => 'form-group']
);
</code>
                </pre>
                Example HTML output is shown below:
                <pre class="my-0">
<code>
&lt;div class="form-group"&gt; 
&lt;label for="test"&gt;Test&lt;/label&gt;
    &lt;select id="test" 
    name="test" 
    value="" 
    class="form-control"&gt;
        &lt;option&gt;---Please select an item--&lt;/option&gt;
        &lt;option value="a"&gt;A&lt;/option&gt;
        &lt;option value="b"&gt;B&lt;/option&gt;
        &lt;option value="c"&gt;C&lt;/option&gt;
    &lt;/select&gt;
&lt;/div&gt; 
</code>
                </pre>
            </td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$label Sets the label for this input.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$name Sets the value for the name, for, and id attributes for this input.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$checked The value we want to set as selected.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$inputAttrs The values used to set the class and other attributes of the input string.  The default value is an empty array.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$options The list of options we will use to populate the select option dropdown.  The default value is an empty array.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$divAttrs The values used to set the class and other attributes of the surrounding div.  The default value is an empty array.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$errors The errors array.  Default value is an empty array.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>A surrounding div and option select element.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function stringifyAttrs</th>
        </tr>
        <tr>
            <td colspan="2">Stringify attributes.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$attrs The attributes we want to stringify.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>The stringified attributes.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function submitBlock</th>
        </tr>
        <tr>
            <td colspan="2">
                Generates a div containing an input of type submit.
                <br><br>
                An example function call is shown below:
                <br>
                <pre class="my-0">
<code>
FormHelper::submitBlock(
    "Save", 
    ['class'=>'btn btn-primary'], 
    ['class'=>'text-right']
);
</code>
                </pre>
                Example HTML output is shown below:
                <pre class="my-0">
<code>
&lt;div class="text-right"&gt;
    &lt;input type="submit" 
        value="Save" 
        class="btn btn-primary" 
    /&gt;
&lt;/div&gt;
</code>
                </pre>
            </td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$buttonText Sets the value of the text describing the button.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$inputAttrs The values used to set the class and other attributes of the input string.  The default value is an empty array.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$divAttrs The values used to set the class and other attributes of the surrounding div.  The default value is an empty array.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>A surrounding div and the input element of type submit.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function submitTag</th>
        </tr>
        <tr>
            <td colspan="2">
                Create a input element of type submit.
                <br><br>
                An example function call is shown below:
                <br>
                <pre class="my-0">
<code>
FormHelper::submitTag(
    "Save", 
    ['class'=>'btn btn-primary']
);
</code>
                </pre>
                or
                <pre class="my-0">
<code>
self::submitTag(
    "Save", 
    ['class'=>'btn btn-primary']
);
</code>
                </pre>
                Example HTML output is shown below:
                <pre class="my-0">
<code>
&lt;input type="submit" 
    value="Save" 
    class="btn btn-primary" 
/&gt;
</code>
                </pre>
            </td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$buttonText Sets the value of the text describing the button.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$inputAttrs The values used to set the class and other attributes of the input string.  The default value is an empty array.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>An input element of type submit.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function telBlock</th>
        </tr>
        <tr>
            <td colspan="2">
                Renders an HTML div element that surrounds an input of type tel.  The user is able to enter cell, home, and work as phone types.  Certain options can be set using the args parameter.  
                <br><br>
                Arguments supported:
                <br>
                <ul>
                    <li>a - All default options turned on. </li>
                    <li>d - All options are off.</li>
                    <li>e - Default event listener turned on for enforcing phone format requirements.</li>
                    <li>h - Default placeholder turned on.</li>
                    <li>p - Default telephone pattern is enforced.</li>
                </ul>
                
                The user may use 'a', or any combination of 'h', 'p', or 'e'.  The empty string is not a valid value for args.  Leaving out a value for args in the function call will cause all defaults to be turned on.  If the d is entered with all other valid options together will cause no options to be set.  If bad phone types and args values are entered exceptions displaying relevant information will be thrown.
                <br><br>
                An example function call where no arguments are set is shown below:
                <br>
                <pre class="my-0">
<code>
FormHelper::telBlock(
    'cell', 
    'Cell Phone', 
    'cell_phone', 
    $this->contact->cell_phone, 
    ['class' => 'form-control'], 
    ['class' => 'form-group col-md-6']
);
</code>
                </pre>
                The corresponding HTML output is shown below:
                <pre class="my-0">
<code>
&lt;div class="form-group"&gt; 
    &lt;label for="cell_phone"&gt;Cell Phone&lt;/label&gt;
    &lt;input type="tel" 
        id="cell_phone" 
        name="cell_phone" 
        value="" 
        class="form-control" 
    /&gt;
&lt;/div&gt; 
</code>
                </pre>

                <br><br>
                An example function call where two options are set and other is set with the inputAttrs array is shown below:
                <br>
                <pre class="my-0">
<code>
FormHelper::telBlock(
    'home', 
    'Home Phone', 
    'home_phone',
    $this->contact->home_phone, 
    ['class' => 'form-control', 'placeholder' => 'My placeholder'], 
    ['class' => 'form-group col-md-6'],
    "pe"
);
</code>
                </pre>
                The corresponding HTML output is shown below:
                <pre class="my-0">
<code>
&lt;div class="form-group"&gt; 
    &lt;label for="home_phone"&gt;Home Phone&lt;/label&gt;
    &lt;input type="tel" 
        id="home_phone" 
        name="home_phone" 
        value="" 
        class="form-control" 
        placeholder="My placeholder" 
        pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" 
        onkeydown="homePhoneNumberFormatter()" 
    /&gt;
&lt;/div&gt; 
</code>
                </pre>

                <br><br>
                An example function call where 'a' flag is set is shown below:
                <br>
                <pre class="my-0">
<code>
FormHelper::telBlock(
    'work', 
    'Work Phone', 
    'work_phone', 
    $this->contact->work_phone, 
    ['class' => 'form-control'], 
    ['class' => 'form-group col-md-6'],
    "a"
);
</code>
                </pre>
                The corresponding HTML output is shown below:
                <pre class="my-0">
<code>
&lt;div class="form-group"&gt; 
    &lt;label for="work_phone"&gt;Work Phone&lt;/label&gt;
    &lt;input type="tel" 
        id="work_phone" 
        name="work_phone" 
        value="" 
        class="form-control" 
        placeholder="ex: 123-456-7890" 
        pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" 
        onkeydown="workPhoneNumberFormatter()" 
    /&gt;
&lt;/div&gt; 
</code>
                </pre>
            </td>
        </tr>
        
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$phoneType The type of phone that can be used.  We currently support "cell", "home", and "work" type phones.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$label Sets the label for this input.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$name Sets the value for the name, for, and id attributes for this input.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">mixed</td>
            <td>$value The value we want to set.  We can use this to set the value of the value attribute during form validation.  Default value is the empty string.  It can be set with values during form validation and forms used for editing records.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$inputAttrs The values used to set the class and other attributes of the input string.  The default value is an empty array.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$divAttrs The values used to set the class and other  attributes of the surrounding div.  The default value is an empty array.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$args Arguments that influence which options are turned on.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$errors The errors array.  Default value is an empty array.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>The HTML div element surrounding an input of type tel  with configuration and values set based on parameters entered during function call.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm my-5">
        <tr>
            <th colspan="2" class="text-center">public static function textAreaBlock</th>
        </tr>
        <tr>
            <td colspan="2">
                Assists in the development of textarea in forms.  It accepts parameters for setting  attribute tags in the form section.
                <br><br>
                An example function call is shown below:
                <br>
                <pre class="my-0">
<code>
FormHelper::textAreaBlock(
    "Example", 
    'example_name', 
    example_value, 
    ['class' => 'form-control input-sm', 
        'placeholder' => 'foo'], 
    ['class' => 'form-group']
);
</code>
                </pre>
                Example HTML output is shown below:
                <pre class="my-0">
<code>
&lt;div class="form-group"&gt;
    &lt;label for="example_name">Example&lt;/label&gt;
    &lt;textarea id="example_name" 
        name="example_name"  
        class="form-control input-sm"
        placeholder="foo"&gt;example_value&lt;/textarea&gt;
&lt;/div&gt;
</code>
                </pre>
            </td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$label Sets the label for this input.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>name Sets the name for, id, and name attributes for this input.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">mixed</td>
            <td>$value The value we want to set.  We can use this to set the value of the value attribute during form validation.  Default value is the empty string.  It can be set with values during form validation and forms used for editing records.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$inputAttrs The values used to set the class and other attributes of the input string.  The default value is an empty array.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$divAttrs The values used to set the class and other attributes of the surrounding div.  The default value is an empty array.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$errors The errors array.  Default value is an empty array.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>A surrounding div and the input element.</td>
        </tr>
    </table>

    <a href="<?=APP_DOMAIN?>documentation/core" class="btn btn-xs btn-secondary mb-5">Core</a>
</div>
<script src="<?=APP_DOMAIN?>public/js/docNavDropdown.js"></script>
<?php $this->end(); ?>