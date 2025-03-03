<?php
namespace Core\Lib;
use Core\Helper;
/**
 * Supports the ability to produce logging.
 */
class Logger {
    private static string $logFile;// = ROOT.DS.'storage'.DS.'logs'.DS.'app.log'; 

    /**
     * Initializes the log file based on the environment (CLI or Web).
     */
    private static function init(): void {
        if (!defined('ROOT')) {
            throw new \Exception("ROOT constant is not defined.");
        }

        // Determine log file location
        self::$logFile = ROOT . DS . 'storage' . DS . 'logs' . DS . (php_sapi_name() === 'cli' ? 'cli.log' : 'app.log');
    }

    /**
     * Performs operations for adding content to log files.
     *
     * @param string $message The description of an event that is being 
     * written to a log file.
     * @param string $level Describes the severity of the message.
     * @return void
     */
    public static function log(string $message, string $level = 'info'): void {
        if (!defined('DEBUG') || DEBUG !== "true") {
            return; // Skip logging if DEBUG is disabled
        }

        if (!isset(self::$logFile)) {
            self::init();
        }

        $date = date('Y-m-d H:i:s');
        $logMessage = "[$date - GMT] [$level] $message" . PHP_EOL;
        $logDir = dirname(self::$logFile);

        // Debug: Check directory existence
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }

        // Debug: Check directory permissions
        if (!is_writable($logDir)) {
            die("Error: Log directory is not writable. Current permissions: " . substr(sprintf('%o', fileperms($logDir)), -4));
        }

        // Debug: Check file existence
        if (!file_exists(self::$logFile)) {
            touch(self::$logFile);
            chmod(self::$logFile, 0644);
        }

        // Debug: Check if file is writable
        if (!is_writable(self::$logFile)) {
            die("Error: Log file is not writable.");
        }

        // Write to log file
        $result = file_put_contents(self::$logFile, $logMessage, FILE_APPEND | LOCK_EX);

        if ($result === false) {
            die("Error: Unable to write to log file.");
        }
        
    }
}
