<?php
/**
 * Form helper functions.
 */
?>
<?php
class FormHelper {
    /**
     * Returns list of errors.
     */
    public static function displayErrors($errors) {
        $hasErrors = (!empty($errors)) ? ' has-errors' : ''; 
        $html = '<div class="form-errors"><ul class="bg-danger'.$hasErrors.'">';
        foreach($errors as $field =>$error) {
            $html .= '<li class="text-danger">'.$error.'</li>';
            $html .= '<script>jQuery("document").ready(function(){jQuery("#'.$field.'").parent().closest("div").addClass("has-error");});</script>';
        }
        $html .= '</ul></div>';
        return $html;
    }

    public static function checkboxBlock($label, $name, $checked = false, $inputAttrs = [], $divAttrs = []) {
        $divString = self::stringifyAttrs($divAttrs);
        $inputString = self::stringifyAttrs(($inputAttrs));
        $checkString = ($checked) ? ' checked="checked"' : '';

        $html = '<div'.$divString.'>';
        $html .= '<label for="'.$name.'">'.$label.' <input type="checkbox" id="'.$name.'" name="'.$name.'" value="on"'.$checkString.$inputString.'></label>';
        $html .= '</div>';
        return $html;
    }

    public static function checkToken($token) {
        return (Session::exists('csrf_token') && Session::get('csrf_token') == $token);
    }

    public static function csrfInput() {
        return '<input type="hidden" name="csrf_token" id="csrf_token" value="'.self::generateToken().'" />';
    }

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
     * inputBlock("text", "Favorite Color:", "favorite_color", '', ['class'=>'form-control'], ['class'=>'form-group']);
     * 
     * Example HTML output is shown below:
     * <div class="form-group">
     *     <label for="favorite_color">Favorite Color:</label>
     *     <input type="text" id="favorite_color" name="favorite_color" value="" class="form-control" />
     *  </div>
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

    public static function posted_values($post) {
        $clean_array = [];
        foreach($post as $key => $value) {
            $clean_array[$key] = self::sanitize($value);
        }

        return $clean_array;
    }
    
    /**
     * Stringify attributes.
     * @param string $attrs - The attributes we want to stringify.
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
     * submitBlock("Save", ['class'=>'btn btn-primary'], ['class'=>'text-right']);
     * 
     * Example HTML output is shown below:
     * <div class="text-right">
     *     <input type="submit" value="Save" class="btn btn-primary" />
     * </div>
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
     * submitTag("Save", ['class'=>'btn btn-primary']);
     * 
     * Example HTML output is shown below:
     * <input type="submit" value="Save" class="btn btn-primary" />
     * 
     * @param string $buttonText - The text for our button.
     * @param array $inputAttrs - The array of attributes we will add to our 
     * HTML tag.  Default is an empty array.
     * @return string An input element of type submit.
     */
    public static function submitTag($buttonText, $inputAttrs = []) {
        $inputString = self::stringifyAttrs($inputAttrs);
        return '<input type="submit" value="'.$buttonText.'"'.$inputString.' />';
    }

    /**
     * Sanitized potentially harmful string of characters.
     * @param string - $dirty The potentially dirty string.
     * @return string The sanitized version of the dirty string.
     */
    public static function sanitize($dirty) {
        return htmlentities($dirty, ENT_QUOTES, 'UTF-8');
    }
}