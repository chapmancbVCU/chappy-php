<?php
namespace Core\Lib\Utilities;

/**
 * Supports ability to use environment variables.
 */
class Env {
    private static array $env = [];

    /**
      * Load .env file into memory (only once)
      *
      * @param string $path The path to the .env file.
      * @return void
      */
    public static function load(string $path = ROOT . DS . 'env'): void {
        if (!file_exists($path)) {
            return;
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) {
                continue; // Skip comments
            }

            list($key, $value) = explode('=', $line, 2);
            self::$env[trim($key)] = trim($value);
        }
    }

     /**
      * Get an environment variable with an optional default value
      *
      * @param string $key The key for the key value pair for env variables.
      * @param mixed $default The default value for the env variable.
      * @return mixed
      */
    public static function get(string $key, mixed $default = null): mixed {
        if (empty(self::$env)) {
            self::load();
        }
    
        $value = self::$env[$key] ?? $_ENV[$key] ?? getenv($key) ?? $default;
    
        // Convert "true"/"false" to booleans
        if (strtolower($value) === 'true') return true;
        if (strtolower($value) === 'false') return false;
        
        // Convert numeric values
        if (is_numeric($value)) return $value + 0;
    
        return $value;
    }
}
