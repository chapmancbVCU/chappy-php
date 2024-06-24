<?php $this->setSiteTitle("FormHelper - Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>
<?php include('docs_nav.php'); ?>

<div class="main">
    <a href="<?=PROOT?>documentation/core" class="btn btn-xs btn-secondary">Core</a>
    <h1 class="text-center">FormHelper Class</h1>
    <div class="row align-items-center justify-content-center my-3">
        <p class="text-center w-75">Contains functions for building form elements of various types.</p>
    </div>

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
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
            <th class="align-middle text-center w-25" rowspan="2">Use</th>
            <tr><td>Core\Model</td></tr>
        </tr>  
        <tr>
            <th colspan="2" class="text-center">Instance Variables</th>
        </tr>
        <tr>
            <td class="text-center" colspan="2">None</td>
        </tr>
    </table>

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">public static function checkboxAndRadioInput</th>
        </tr>
        <tr>
            <td colspan="2">
                Generates a collection of elements consisting of an input that can be of type checkbox or radio and a label directly to its right.
                <br><br>
                An example function call is shown below:
                <br>
                <pre class="my-0">
<code>
FormHelper::checkboxAndRadioInput('checkbox', 
    'Example', 
    'example_name', 
    'example_value', 
    checked, 
    ['class' => 'mr-1']
);
</code>
                </pre>
                Example HTML output is shown below:
                <pre class="my-0">
<code>
&lt;input type="checkbox" 
    id="example_name" 
    name="example_name" 
    value="example_value" 
    checked="checked" 
    class="mr-1"&gt;
&lt;label for="example"&lt;Example&lt;/label&gt;   
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
            <td>$name Sets the name for, id, and name attributes for this input.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$value The value we want to set.  We can use this to set the value of the value attribute during form validation.  Default value is the empty string.  It can be set with values during form validation and forms used for editing records.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">boolean</td>
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
            <td>A surrounding div and the input element.</td>
        </tr>
    </table>

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">public static function checkboxBlock</th>
        </tr>
        <tr>
            <td colspan="2">
                Generates a div containing an input of type checkbox that is not part of a group.
                <br><br>
                An example function call is shown below:
                <br>
                <pre class="my-0">
<code>
FormHelper::checkboxBlock('Example', 
    'example_name', 
    'checked', 
    [], 
    ['class' => 'form-group']
);
</code>
                </pre>
                Example HTML output is shown below:
                <pre class="my-0">
<code>
&lt;div class="form-group"&gt; 
    &lt;label for="example_name"&gt;Example 
        &lt;input type="checkbox" 
            id="example_name" 
            name="example_name" 
            value="on" 
            checked="checked"&gt;
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
            <td>$name Sets the name for, id, and name attributes for this 
            * input.</td>
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
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>A surrounding div and the input element of type checkbox.</td>
        </tr>
    </table>

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
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

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
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

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
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

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
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

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
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
FormHelper::inputBlock('text', 
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
            <td>$name Sets the name for, id, and name attributes for this input.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
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
            <td class="align-middle text-center w-25">string</td>
            <td>A surrounding div and the input element.</td>
        </tr>
    </table>

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
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

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
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
            <td class="align-middle text-center w-25">string</td>
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

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
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

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">public static function </th>
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25"></td>
            <td></td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25"></td>
            <td></td>
        </tr>
    </table>

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto">
        <tr>
            <th colspan="2" class="text-center">public static function </th>
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25"></td>
            <td></td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25"></td>
            <td></td>
        </tr>
    </table>

    <hr class="w-75 my-5">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto my-5">
        <tr>
            <th colspan="2" class="text-center">public static function </th>
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25"></td>
            <td></td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25"></td>
            <td></td>
        </tr>
    </table>

    <a href="<?=PROOT?>documentation/core" class="btn btn-xs btn-secondary mb-5">Core</a>
</div>
<script src="<?=PROOT?>public/js/docNavDropdown.js"></script>
<?php $this->end(); ?>