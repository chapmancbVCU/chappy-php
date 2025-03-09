<?php
use Dotenv\Dotenv;

// Load Composer dependencies
require_once ROOT . DS . 'vendor' . DS . 'autoload.php';

// Load environment variables
$dotenv = Dotenv::createImmutable(ROOT);
$dotenv->load();

// Load configuration and helper functions
require_once ROOT . DS . 'src' . DS . 'scripts' . DS . 'helpers.php';
loadConfig();

// Start PHP session
session_start();