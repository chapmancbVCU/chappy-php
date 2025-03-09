<?php

use Core\Lib\Utilities\Env;
use Core\Lib\Utilities\Config;

if (!function_exists('config')) {
    /**
     * Get a configuration value.
     *
     * @param string $key Dot notation key
     * @param mixed $default Default value if key not found
     * @return mixed
     */
    function config($key, $default = null)
    {
        return Config::get($key, $default);
    }
}

if (!function_exists('env')) {
    /**
     * Get an environment variable.
     *
     * @param string $key The key to retrieve
     * @param mixed $default Default value if key is not found
     * @return mixed
     */
    function env($key, $default = null)
    {
        return Env::get($key, $default);
    }
}
if(!function_exists('vite')){
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

