<?php


function loadConfig() {
    foreach (glob(ROOT . DS . 'config' . DS . '*.php') as $configFile) {
        require_once $configFile;
    }
}


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

