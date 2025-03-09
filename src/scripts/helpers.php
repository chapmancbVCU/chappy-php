<?php

use Symfony\Component\VarDumper\VarDumper;

if(!function_exists('cl')) {
    /**
   * Prints to console using JavaScript.
   * 
   * @param mixed $output The information we want to print to console.
   * @param bool $with_script_tags - Determines if we will use script tabs in 
   * our output.  Default value is true.
   * @return void
   */
  function cl(mixed $output, bool $with_script_tags = true): void {
        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
        if($with_script_tags) {
            $js_code = '<script>' . $js_code . '</script>';
        }        
        echo $js_code;
    }
}

if(!function_exists('dd')) {
  /**
   * Performs var_dump of parameter and kills the page.
   * 
   * @param mixed ...$var Contains the data we wan to print to the page.
   * @return void
   */
  function dd(mixed ...$vars): void {
    foreach ($vars as $var) {
      VarDumper::dump($var);
    }
    die(1); // Terminate the script
  }
}

if(!function_exists('dump')) {
    /**
   * Dumps content but continues execution.
   *
   * @param mixed ...$var Contains the data we wan to print to the page.
   * @return void
   */
    function dump(...$vars): void {
        foreach ($vars as $var) {
            VarDumper::dump($var);
        }
    }
}

if(!function_exists('vite')) {
    /**
     * Generate the URL for a Vite asset.
     *
     * @param string $asset Path to the asset (e.g., 'resources/js/app.js').
     * @return string The URL to the asset.
     */
    function vite(string $asset): string {
        $devServer = 'http://localhost:5173';
        $manifestPath = __DIR__ . '/../public/build/manifest.json';

        if (is_file($manifestPath)) {
            $manifest = json_decode(file_get_contents($manifestPath), true);
            if (isset($manifest[$asset])) {
                return '/build/' . $manifest[$asset]['file'];
            }
        }

        return "$devServer/$asset";
    }
}
