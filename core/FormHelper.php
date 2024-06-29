<?php
namespace Core;
use Core\Session;
use Core\Helper;
/**
 * Contains functions for building form elements of various types.
 */
class FormHelper {
    /**
     * 
     * An example function call is shown below:
     * FormHelper::button("Click Me!", ['class' => 'btn btn-large btn-primary', 'onClick' => 'alert(\'Hello World!\')']);
     * 
     * Example HTML output is shown below:
     * <button type="button"  class="btn btn-large btn-primary" onClick="alert('Hello World!')">Click Me!</button>
     * @param [type] $buttonText
     * @param array $inputAttrs
     * @return void
     */
    public static function button($buttonText, $inputAttrs = []) {
        $inputString = self::stringifyAttrs($inputAttrs);
        return '<button type="button" '.$inputString.'>'.$buttonText.'</button>';
    }

    /**
     * 
     * An example function call is shown below:
     * FormHelper::buttonBlock("Click Me!", ['class' => 'btn btn-large btn-primary', 'onClick' => 'alert(\'Hello World!\')'], ['class' => 'form-group']);
     * 
     * Example HTML output is shown below:
     * <div class="form-group"><button type="button"  class="btn btn-large btn-primary" onClick="alert('Hello World!')">Click Me!</button></div> 
     * @param [type] $buttonText
     * @param array $inputAttrs
     * @param array $divAttrs
     * @return void
     */
    public static function buttonBlock($buttonText, $inputAttrs = [], $divAttrs = []) {
        $divString = self::stringifyAttrs($divAttrs);

        $html = '<div'.$divString.'>';
        $html .= self::button($buttonText, $inputAttrs); 
        $html .= '</div>';

        return $html;
    }
    /**
     * Generates a div containing an input of type checkbox with the label to 
     * the left that is not part of a group.
     *
     * An example function call is shown below:
     * FormHelper::checkboxBlockLabelLeft('Example', 'example_name', 'checked', [], ['class' => 'form-group']);
     * 
     * Example HTML output is shown below:
     * <div class="form-group">
     *     <label for="example_name">Example 
     *         <input type="checkbox" id="example_name" name="example_name" value="on" checked="checked">
     *     </label>
     * </div>
     * 
     * @param string $label Sets the label for this input.
     * @param string $name Sets the name for, id, and name attributes for this 
     * input.
     * @param bool $checked The value for the checked attribute.  If true 
     * this attribute will be set as checked="checked".  The default value is 
     * false.  It can be set with values during form validation and forms 
     * used for editing records.
     * @param array $inputAttrs The values used to set the class and other 
     * attributes of the input string.  The default value is an empty array.
     * @param array $divAttrs The values used to set the class and other 
     * attributes of the surrounding div.  The default value is an empty array.
     * @return string A surrounding div and the input element of type checkbox.
     */
    public static function checkboxBlockLabelLeft($label, $name, $checked = false, $inputAttrs = [], $divAttrs = []) {
        $divString = self::stringifyAttrs($divAttrs);
        $inputString = self::stringifyAttrs(($inputAttrs));
        $checkString = ($checked) ? ' checked="checked"' : '';

        $html = '<div'.$divString.'>';
        $html .= '<label for="'.$name.'">'.$label.' <input type="checkbox" id="'.$name.'" name="'.$name.'" value="on"'.$checkString.$inputString.'></label>';
        $html .= '</div>';
        return $html;
    }

    /**
     * Generates a div containing an input of type checkbox with the label to 
     * the right that is not part of a group.
     *
     * An example function call is shown below:
     * FormHelper::checkboxBlockLabelRight('Remember Me', 'remember_me', $this->login->getRememberMeChecked(), [], ['class' => 'form-group mr-1']);
     * 
     * Example HTML output is shown below:
     * <div>
     *     <input type="checkbox" id="remember_me" name="remember_me" value="" class="form-group mr-1">
     *     <label for="remember_me">Remember Me</label>
     * </div> 
     * 
     * @param string $type The input type we want to generate.
     * @param string $label Sets the label for this input.
     * @param string $name Sets the name for, id, and name attributes for this 
     * input.
     * @param string $value The value we want to set.  We can use this to set 
     * the value of the value attribute during form validation.  Default value 
     * is the empty string.  It can be set with values during form validation 
     * and forms used for editing records.
     * @param boolean $checked The value for the checked attribute.  If true 
     * this attribute will be set as checked="checked".  The default value is 
     * false.  It can be set with values during form validation and forms 
     * used for editing records.
     * @param array $inputAttrs The values used to set the class and other 
     * attributes of the input string.  The default value is an empty array.
     * @return string A surrounding div and the input element.
     */
    public static function checkboxBlockLabelRight($label, $name, $value, $checked = false, $inputAttrs = [], $divAttrs = []) {
        $divString = self::stringifyAttrs($divAttrs);
        $inputString = self::stringifyAttrs(($inputAttrs));
        $checkString = ($checked) ? ' checked="checked"' : '';
        $html = '<div'.$divString.'>';
        $html .='<input type="checkbox" id="'.$name.'" name="'.$name.'" value="'.$value.'"'.$checkString.$inputString.'><label for="'.$name.'">'.$label.'</label> ';
        $html .= '</div>';
        return $html;
    }

    /**
     * Checks if the csrf token exists.  This is used to verify that that has 
     * been no tampering of a form's csrf token.
     *
     * @param string $token The token string we will test whether or not it 
     * exists.
     * @return bool The result of the AND operation on whether or not a token 
     * exists with a session and if the session's token is equal to the value 
     * of the $token parameter.
     */
    public static function checkToken($token) {
        return (Session::exists('csrf_token') && Session::get('csrf_token') == $token);
    }

    /**
     * A hidden input to represent the csrf token in a web form.
     *
     * Example HTML output is shown below:
     * <input type="hidden" name="csrf_token" id="csrf_token" value="RANDOM_STRING_OF_VALUES" />
     * 
     * @return string The hidden input of type hidden with the generated token 
     * set as the value.
     */
    public static function csrfInput() {
        return '<input type="hidden" name="csrf_token" id="csrf_token" value="'.self::generateToken().'" />';
    }

    /**
     * Returns list of errors.
     * 
     * @param array $errors A list of errors and their description that is 
     * generated during server side form validation.
     * @return string A string representation of a div element containing an 
     * input of type checkbox.
     */
    public static function displayErrors($errors) {
        $hasErrors = (!empty($errors)) ? ' has-errors' : ''; 
        $html = '<div class="form-errors"><ul class="bg-light'.$hasErrors.'">';
        foreach($errors as $field =>$error) {
            $html .= '<li class="text-danger">'.$error.'</li>';
            $html .= '<script>jQuery("document").ready(function(){jQuery("#'.$field.'").parent().closest("div").addClass("has-error");});</script>';
        }
        $html .= '</ul></div>';
        return $html;
    }

    /**
     * Creates a randomly generated csrf token.
     *
     * @return string The randomly generated token.
     */
    public static function generateToken() {
        $token = base64_encode(openssl_random_pseudo_bytes(32));
        Session::set('csrf_token', $token);
        return $token;
    }

    /**
     * Undocumented function
     *
     * @param [type] $name
     * @param [type] $value
     * @return void
     */
    public static function hidden($name, $value) {
        return '<input type="hidden" name="'.$name.'" id="'.$name.'" value="'.$value.'" />';
    }

    /** 
     * Assists in the development of forms input blocks in forms.  It accepts 
     * parameters for setting attribute tags in the form section.  Not to be 
     * used for inputs of type "Submit"  For submit inputs use the submitBlock 
     * or submitTag functions.
     * 
     * Types of inputs supported:
     * 1. color
     * 2. date
     * 3. datetime-local
     * 4. email
     * 5. file
     * 6. month
     * 7. number
     * 8. password
     * 9. range
     * 10. search
     * 11. tel
     * 12. text
     * 13. time
     * 14. url 
     * 15. week
     * 
     * An example function call is shown below:
     * FormHelper::inputBlock('text', 'Example', 'example_name', example_value, ['class' => 'form-control'], ['class' => 'form-group']);
     * 
     * Example HTML output is shown below:
     * <div class="form-group">
     *     <label for="example">Example</label>
     *     <input type="text" id="example_name" name="example_name" value="example_value" class="form-control" />
     * </div>
     * 
     * @param string $type The input type we want to generate.
     * @param string $label Sets the label for this input.
     * @param string $name Sets the name for, id, and name attributes for this 
     * input.
     * @param string $value The value we want to set.  We can use this to set 
     * the value of the value attribute during form validation.  Default value 
     * is the empty string.  It can be set with values during form validation 
     * and forms used for editing records.
     * @param array $inputAttrs The values used to set the class and other 
     * attributes of the input string.  The default value is an empty array.
     * @param array $divAttrs The values used to set the class and other 
     * attributes of the surrounding div.  The default value is an empty array.
     * @return string A surrounding div and the input element.
     */
    public static function inputBlock($type, $label, $name, $value = '', $inputAttrs= [], $divAttrs = []) {
        $divString = self::stringifyAttrs($divAttrs);
        $inputString = self::stringifyAttrs(($inputAttrs));

        $html = '<div' . $divString . '>';
        $html .= '<label for="'.$name.'">'.$label.'</label>';
        $html .= '<input type="'.$type.'" id="'.$name.'" name="'.$name.'" value="'.$value.'"'.$inputString.' />';
        $html .= '</div>';

        return $html;
    }

    public static function output($name, $for) {
        return '<output name="'.$name.'" for="'.$for.'"></output>';
    }

    /**
     * Creates an input element of type radio with an accompanying label 
     * element.  Compatible with radio button groups.
     *
     * An example function call is shown below:
     * FormHelper::radioInput('HTML', 'html', 'fav_language', "HTML", $check1, ['class' => 'form-group mr-1']); <br>
     * FormHelper::radioInput('CSS', 'css', 'fav_language', "CSS", $check2, ['class' => 'form-group mr-1']);
     * 
     * Example HTML output is shown below:
     * <input type="radio" id="html" name="fav_language" value="HTML" class="form-group mr-1">
     * <label for="html">HTML</label>  <br>
     * <input type="radio" id="css" name="fav_language" value="CSS" class="form-group mr-1">
     * <label for="css">CSS</label>
     * 
     * @param string $label Sets the label for this input.
     * @param string $id The id attribute for the radio input element.
     * @param $name Sets the name for, id, and name attributes for this 
     * input.
     * @param $value The value we want to set.  We can use this to set 
     * the value of the value attribute during form validation.  Default value 
     * is the empty string.  It can be set with values during form validation 
     * and forms used for editing records.
     * @param boolean $checked The value for the checked attribute.  If true 
     * this attribute will be set as checked="checked".  The default value is 
     * false.  It can be set with values during form validation and forms 
     * used for editing records.
     * @param array $inputAttrs The values used to set the class and other 
     * attributes of the input string.  The default value is an empty array.
     * @return void
     */
    public static function radioInput($label, $id, $name, $value, $checked = false, $inputAttrs = []) {
        $inputString = self::stringifyAttrs(($inputAttrs));
        $checkString = ($checked) ? ' checked="checked"' : '';
        return '<input type="radio" id="'.$id.'" name="'.$name.'" value="'.$value.'"'.$checkString.$inputString.'><label for="'.$id.'">'.$label.'</label> ';
    }
    
    /**
     * Performs sanitization of values obtained during $_POST.
     *
     * @param array $post Values from the $_POST superglobal array when the 
     * user submits a form.
     * @return array An array of sanitized values from the submitted form.
     */
    public static function posted_values($post) {
        $clean_array = [];
        foreach($post as $key => $value) {
            $clean_array[$key] = self::sanitize($value);
        }

        return $clean_array;
    }
    
    /**
     * Sanitizes potentially harmful string of characters.
     * 
     * @param string $dirty The potentially dirty string.
     * @return string The sanitized version of the dirty string.
     */
    public static function sanitize($dirty) {
        return htmlentities($dirty, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Renders a select element with a list of options.
     * 
     * An example function call is shown below:
     * FormHelper::selectBlock("Test", "test", $_POST["test"],['A' => 'a','B' => 'b', 'C' => 'c'], ['class' => 'form-control'], ['class' => 'form-group']);
     *
     * Example HTML output is shown below:
     * <div class="form-group">
     *     <label for="test">Test</label>
     *     <select id="test" name="test" value=""  class="form-control">
     *         <option>---Please select an item--</option>
     *         <option value="a">A</option>
     *         <option value="b">B</option>
     *         <option value="c">C</option>
     *     </select>
     * </div>
     * 
     * @param string $label Sets the label for this input.
     * @param string $name Sets the name for, id, and name attributes for this 
     * input.
     * @param string $checked The value we want to set as selected.
     * @param array $inputAttrs The values used to set the class and other 
     * attributes of the input string.  The default value is an empty array.
     * @param array $options The list of options we will use to populate the 
     * select option dropdown.
     * @param array $divAttrs The values used to set the class and other 
     * attributes of the surrounding div.  The default value is an empty array.
     * @return string A surrounding div and option select element.
     */
    public static function selectBlock($label, $name, $checked = "", $options = [], $inputAttrs= [], $divAttrs = []) {
        $divString = self::stringifyAttrs($divAttrs);
        $inputString = self::stringifyAttrs(($inputAttrs));

        $html = '<div' . $divString . '>';
        $html .= '<label for="'.$name.'">'.$label.'</label>';
        $html .= '<select id="'.$name.'" name="'.$name.'" value="" '.$inputString.'>';
        $html .= '<option>---Please select an item--</option>';
        foreach($options as $key => $value) {
            if($checked == $value) {
                $html .= '<option value="'.$value.'" selected>'.$key.'</option>';
            } else {
                $html .= '<option value="'.$value.'">'.$key.'</option>';
            }
        }
        $html .= '</select>';
        $html .= '</div>';
        
        return $html;
    }

    /**
     * Stringify attributes.
     * 
     * @param array $attrs The attributes we want to stringify.
     * @return string The stringified attributes.
     */
    public static function stringifyAttrs($attrs) {
        $string = '';
        foreach($attrs as $key => $val) {
            $string .= ' ' . $key . '="' . $val . '"'; 
        }
        return $string;
    }

    /**
     * Generates a div containing an input of type submit.
     * 
     * An example function call is shown below:
     * FormHelper::submitBlock("Save", ['class'=>'btn btn-primary'], ['class'=>'text-right']);
     * 
     * Example HTML output is shown below:
     * <div class="text-right">
     *     <input type="submit" value="Save" class="btn btn-primary" />
     * </div>
     * 
     * @param string $buttonText Sets the value of the text describing the 
     * button.
     * @param array $inputAttrs The values used to set the class and other 
     * attributes of the input string.  The default value is an empty array.
     * @param array $divAttrs The values used to set the class and other 
     * attributes of the surrounding div.  The default value is an empty array.
     * @param string A surrounding div and the input element of type submit.
     */
    public static function submitBlock($buttonText, $inputAttrs = [], $divAttrs = []) {
        $divString = self::stringifyAttrs($divAttrs);

        $html = '<div'.$divString.'>';
        $html .= self::submitTag($buttonText, $inputAttrs); 
        $html .= '</div>';

        return $html;
    }

    /**
     * Create a input element of type submit.
     * 
     * An example function call is shown below:
     * FormHelper::submitTag("Save", ['class'=>'btn btn-primary']);
     * 
     * or 
     * 
     * self::submitTag("Save", ['class'=>'btn btn-primary']);
     * 
     * Example HTML output is shown below:
     * <input type="submit" value="Save" class="btn btn-primary" />
     * 
     * @param string $buttonText Sets the value of the text describing the 
     * button.
     * @param array $inputAttrs The values used to set the class and other 
     * attributes of the input string.  The default value is an empty array.
     * @return string An input element of type submit.
     */
    public static function submitTag($buttonText, $inputAttrs = []) {
        $inputString = self::stringifyAttrs($inputAttrs);
        return '<input type="submit" value="'.$buttonText.'"'.$inputString.' />';
    }
    
    /** 
     * Assists in the development of textarea in forms.  It accepts parameters 
     * for setting  attribute tags in the form section.
     * 
     * An example function call is shown below:
     * FormHelper::textAreaBlock("Example", 'example_name', example_value, ['class' => 'form-control input-sm', 'placeholder' => 'foo'], ['class' => 'form-group']);
     * 
     * Example HTML output is shown below:
     * <div class="form-group">
     *     <label for="example_name">Example</label>
     *     <textarea id="example_name" name="example_name"  class="form-control input-sm" placeholder="foo">example_value</textarea>
     * </div>
     * 
     * @param string $label Sets the label for this input.
     * @param string $name Sets the name for, id, and name attributes for this 
     * input.
     * @param string $value The value we want to set.  We can use this to set 
     * the value of the value attribute during form validation.  Default value 
     * is the empty string.  It can be set with values during form validation 
     * and forms used for editing records.
     * @param array $inputAttrs The values used to set the class and other 
     * attributes of the input string.  The default value is an empty array.
     * @param array $divAttrs The values used to set the class and other 
     * attributes of the surrounding div.  The default value is an empty array.
     * @param string A surrounding div and the input element.
     */
    public static function textAreaBlock($label, $name, $value = '', $inputAttrs= [], $divAttrs = []) {
        $divString = self::stringifyAttrs($divAttrs);
        $inputString = self::stringifyAttrs(($inputAttrs));

        $html = '<div' . $divString . '>';
        $html .= '<label for="'.$name.'">'.$label.'</label>';
        $html .= '<textarea id="'.$name.'" name="'.$name.'" '.$inputString.'>'.$value.'</textarea>';
        $html .= '</div>';

        return $html;
    }
}