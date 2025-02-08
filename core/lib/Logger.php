<?php
namespace Core\Lib;
class Logger {
    private static $logFile = ROOT . DS  . 'logs' . DS . 'app.log'; // Ensure correct path

    public static function log($message, $level = 'info') {
        $date = date('Y-m-d H:i:s');
        $logMessage = "[$date] [$level] $message" . PHP_EOL;

        // Debugging: Check if file is writable
        if (!is_writable(dirname(self::$logFile))) {
            die("Error: Log directory is not writable.");
        }

        // Debugging: Try writing manually
        $result = file_put_contents(self::$logFile, $logMessage, FILE_APPEND | LOCK_EX);

        if ($result === false) {
            die("Error: Unable to write to log file.");
        }
    }
}
