<?php
namespace Console\Helpers;

use Symfony\Component\Console\Command\Command;

/**
 * Supports ability to manage logs.
 */
class Log {
    public static function delete(string $message, string $path) {
        if(unlink($path)) Tools::info($message, 'green');
    }
}
