<?php
use Doctum\Doctum;
use Doctum\Parser\Filter\PublicFilter;
use Symfony\Component\Finder\Finder;

// Set the directory where PHP code is located
$dir = __DIR__;

// Use Symfony Finder to scan PHP files
$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->in($dir)
    ->exclude([
        'vendor',
        'node_modules',
        'config',
        'public',
        'node_modules',
        'logs',
        'cache',
        'resources/views/api-docs']
    );

// Create a Doctum instance
return new Doctum($iterator, [
    'title' => 'Chappy.php API',
    'build_dir' => __DIR__ . '/resources/views/api-docs',  // Store docs here
    'cache_dir' => __DIR__ . '/cache/doctum',  // Caching for faster generation
    'default_opened_level' => 2,  // Sidebar depth
    'filter' => new PublicFilter(),  // Only include public methods
]);
