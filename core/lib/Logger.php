<?php
namespace Core\Lib;

/**
 * Supports the ability to produce logging.
 */
class Logger {
    private static $logFile = ROOT . DS  . 'logs' . DS . 'app.log'; // Ensure correct path

    /**
     * Performs operations for adding content to log files.
     *
     * @param string $message The description of an event that is being 
     * written to a log file.
     * @param string $level Describes the severity of the message.
     * @return void
     */
    public static function log(string $message, string $level = 'info'): void {
        $date = date('Y-m-d H:i:s');
        $logMessage = "[$date] [$level] $message" . PHP_EOL;

        // Debugging: Check if file is writable
        if(!is_writable(dirname(self::$logFile))) {
            die("Error: Log directory is not writable.");
        }

        // Debugging: Try writing manually
        $result = file_put_contents(self::$logFile, $logMessage, FILE_APPEND | LOCK_EX);

        if($result === false) {
            die("Error: Unable to write to log file.");
        }
    }
}
