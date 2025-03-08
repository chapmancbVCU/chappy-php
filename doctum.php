<?php
use Doctum\Doctum;
use Doctum\Parser\Filter\PublicFilter;
use Symfony\Component\Finder\Finder;

// Set the directory where PHP code is located
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));

// Use Symfony Finder to scan PHP files
$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->in(ROOT)
    ->exclude([
        'vendor',
        'node_modules',
        'config',
        'public',
        'logs',
        'cache',
        'src/api-docs/views']
    );

// Create a Doctum instance
return new Doctum($iterator, [
    'title' => 'Chappy.php API',
    'build_dir' => ROOT . DS. 'src' .  DS . 'api-docs' . DS . 'views',  // Store docs here
    'cache_dir' => ROOT . DS .'cache' . DS . 'doctum',  // Caching for faster generation
    'default_opened_level' => 2,  // Sidebar depth
    'filter' => new PublicFilter(),  // Only include public methods
]);
