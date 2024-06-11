<?php 
/**
 * Helper functions.
 */
?>
<?php
/**
 * Prints to console using JavaScript.
 * @param data - The information we want to print to console.
 * @param string $context The context for what we are printing.  Used as a 
 * parameter to the console.info function.
 */
function cl($data, $context = 'Debug in Console') {
    if(CONSOLE_LOGGING) {
        // Buffering to solve problems frameworks, like header() in this and not a solid return.
        ob_start();

        $output  = 'console.info(\'' . $context . ':\');';
        $output .= 'console.log(' . json_encode($data) . ');';
        $output  = sprintf('<script>%s</script>', $output);

        echo $output;
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
