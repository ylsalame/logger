<?php

namespace App\Http\Helper;

class Logger
{
    /**
     * Defines the minimum acceptable log level at the moment
     */
    static $loggerMinimumAcceptableLogLevel;

    const LOG_LEVEL_DEBUG = 2;
    const LOG_LEVEL_INFO = 4;
    const LOG_LEVEL_WARNING = 8;
    const LOG_LEVEL_ERROR = 16;

    /**
     * Either saves the log message or outputs it to the terminal
     * Will silently exit/return if the log level is not appropriate
     * 
     * @param  int $logLevel Forced level to be set
     * @param  msg $msg      The message being logged
     * 
     * @return void
     */
    private static function log($type, String $msg = 'something'): void
    {
        echo 'DEBUG: triggered log($type='.$type.', $msg='.$msg.')'.chr(10);

        //static calls will not trigger a construct so this needs to be managed manually
        self::configureLogLevel();

        //determines if the message should be logged based on the minimum level
        if (self::$loggerMinimumAcceptableLogLevel < $type) {
            return;
        }

        $msg = date('Y-m-d H:i:s').' - '.$type.' : '.$msg.chr(10);

        if (PHP_SAPI === 'cli') {
            echo $msg;
            return;
        }

        file_put_contents('log.txt', $msg, FILE_APPEND | LOCK_EX);
    }

    /**
     * Sets the current log level accepted by the Logger class
     * Initial run for this needs to take into consideration that no 
     * level has been defined yet so it needs to fetch it from the env
     * 
     * @param  int $logLevel Forced level to be set
     * 
     * @return void
     */
    public static function configureLogLevel(int $logLevel = null): void
    {
        self::$loggerMinimumAcceptableLogLevel = self::$loggerMinimumAcceptableLogLevel ?: getenv('logger.level');

        echo 'DEBUG: triggered configureLogLevel($logLevel = '.$logLevel.')'.chr(10);

        self::$loggerMinimumAcceptableLogLevel = $logLevel ?: self::$loggerMinimumAcceptableLogLevel;

        echo 'DEBUG: log level set to: '.self::$loggerMinimumAcceptableLogLevel.chr(10);
    }

    /**
     * Log a Debug message
     * 
     * @param  string $msg Message to be logged
     * 
     * @return void
     */
    public static function logDebug(String $msg): void
    {
        echo 'DEBUG: triggered logDebug'.chr(10);

        self::log(Logger::LOG_LEVEL_DEBUG, $msg);
    }

    /**
     * Log an info message
     * 
     * @param  string $msg Message to be logged
     * 
     * @return void
     */
    public static function logInfo(String $msg): void
    {
        echo 'DEBUG: triggered logInfo'.chr(10);

        self::log(Logger::LOG_LEVEL_INFO, $msg);
    }

    /**
     * Log a Warning message
     * 
     * @param  string $msg Message to be logged
     * 
     * @return void
     */
    public static function logWarning(String $msg): void
    {
        echo 'DEBUG: triggered logWarning'.chr(10);

        self::log(Logger::LOG_LEVEL_WARNING, $msg);
    }

    /**
     * Log an Error message
     * 
     * @param  string $msg Message to be logged
     * 
     * @return void
     */
    public static function logError(String $msg): void
    {
        echo 'DEBUG: triggered logError'.chr(10);

        self::log(Logger::LOG_LEVEL_ERROR, $msg);
    }

}