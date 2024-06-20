<?php
namespace Core;
use Core\Session;

/**
 * Form helper functions.
 */
class FormHelper {
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
     * Generates a div containing an input of type checkbox.
     *
     * An example function call is shown below:
     * FormHelper::checkboxBlock('Remember Me', 'remember_me', $this->login->getRememberMeChecked(), [], ['class' => 'form-group']);
     * 
     * Example HTML output is shown below:
     * <div class="form-group">
     *     <label for="remember_me">Remember Me <input type="checkbox" id="remember_me" name="remember_me" value="on"></label>
     * </div>
     * 
     * @param string $label Sets the label for this input.
     * @param string $name Sets the name for, id, and name attributes for this 
     * input.
     * @param boolean $checked The value for the checked attribute.  If true 
     * this attribute will be set as checked="checked".  The default value is 
     * false.  It can be set with values during form validation and forms 
     * used for editing records.
     * @param array $inputAttrs The values used to set the class and other 
     * attributes of the input string.  The default value is an empty array.
     * @param array $divAttrs The values used to set the class and other 
     * attributes of the surrounding div.  The default value is an empty array.
     * @return string A surrounding div and the input element of type checkbox.
     */
    public static function checkboxBlock($label, $name, $checked = false, $inputAttrs = [], $divAttrs = []) {
        $divString = self::stringifyAttrs($divAttrs);
        $inputString = self::stringifyAttrs(($inputAttrs));
        $checkString = ($checked) ? ' checked="checked"' : '';

        $html = '<div'.$divString.'>';
        $html .= '<label for="'.$name.'">'.$label.' <input type="checkbox" id="'.$name.'" name="'.$name.'" value="on"'.$checkString.$inputString.'></label>';
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
     * Assists in the development of forms.  It accepts parameters for setting 
     * attribute tags in the form section.
     * 
     * An example function call is shown below:
     * FormHelper::inputBlock('text', 'Username', 'username', $this->login->username, ['class' => 'form-control'], ['class' => 'form-group']);
     * 
     * Example HTML output is shown below:
     * <div class="form-group">
     *     <label for="username">Username</label>
     *     <input type="text" id="username" name="username" value="" class="form-control" />
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
     * @param string A surrounding div and the input element.
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
     * Example HTML output is shown below:
     * 
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
     * Sanitizes potentially harmful string of characters.
     * 
     * @param string $dirty The potentially dirty string.
     * @return string The sanitized version of the dirty string.
     */
    public static function sanitize($dirty) {
        return htmlentities($dirty, ENT_QUOTES, 'UTF-8');
    }
}