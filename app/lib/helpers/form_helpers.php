<?php
/**
 * Form helper functions.
 */
?>
<?php
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
function inputBlock($type, $label, $name, $value = '', $inputAttrs= [], $divAttrs = []) {
    $divString = stringifyAttrs($divAttrs);
    $inputString = stringifyAttrs(($inputAttrs));

    $html = '<div' . $divString . '>';
    $html .= '<label for="'.$name.'">'.$label.'</label>';
    $html .= '<input type="'.$type.'" id="'.$name.'" name="'.$name.'" value="'.$value.'"'.$inputString.' />';
    $html .= '</div>';

    return $html;
}


/**
 * Stringify attributes.
 * @param string $attrs - The attributes we want to stringify.
 * @return string The stringified attributes.
 */
function stringifyAttrs($attrs) {
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
function submitBlock($buttonText, $inputAttrs = [], $divAttrs = []) {
    $divString = stringifyAttrs($divAttrs);

    $html = '<div'.$divString.'>';
    $html .= submitTag($buttonText, $inputAttrs); 
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
function submitTag($buttonText, $inputAttrs = []) {
    $inputString = stringifyAttrs($inputAttrs);
    return '<input type="submit" value="'.$buttonText.'"'.$inputString.' />';
}