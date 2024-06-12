<?php 
/**
 * Helper functions.
 */
?>
<?php
/**
 * Prints to console using JavaScript.
 * @param string $output - The information we want to print to console.
 * @param bool $with_script_tags - Determines if we will use script tabs in 
 * our output.  Default value is true.
 */
function cl($output, $with_script_tags = true) {
    if(CONSOLE_LOGGING) {
        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
        if($with_script_tags) $js_code = '<script>' . $js_code . '</script>';
        echo $js_code;
    }
}

/**
 * Determines current page based on REQUEST_URI.
 * @return string $currentPage - The current page.
 */
function currentPage() {
    $currentPage = $_SERVER['REQUEST_URI'];
    if($currentPage == PROOT || $currentPage == PROOT.'home/index') {
        $currentPage = PROOT . 'home';
    }
    return $currentPage;
}

/**
 * Getter function for the current logged in user.
 * @return string The current user.
 */
function currentUser() {
    return Users::currentLoggedInUser();
}

/**
 * Performs var_dump of parameter and kills the page.
 * @param $data - Contains the data we wan to print to the page.
 */
function dnd($data) {
    echo "<pre>";
    var_dump($data);
    echo "<pre>";
    die();
}

function getObjectProperties($obj) {
    return get_object_vars($obj);
}

function posted_values($post) {
    $clean_array = [];
    foreach($post as $key => $value) {
        $clean_array[$key] = sanitize($value);
    }

    return $clean_array;
}

/**
 * Sanitized potentially harmful string of characters.
 * @param string - $dirty The potentially dirty string.
 * @return string The sanitized version of the dirty string.
 */
function sanitize($dirty) {
    return htmlentities($dirty, ENT_QUOTES, 'UTF-8');
}
