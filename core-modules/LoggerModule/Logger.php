<?php

namespace CoreModules\LoggerModule;

class Logger
{
    protected $logFile;

    public function __construct()
    {
        $this->logFile = __DIR__ . '/../../storage/logs/app.log';
        if (!file_exists(dirname($this->logFile))) {
            mkdir(dirname($this->logFile), 0777, true);
        }
    }

    public static function log($message, $level = 'INFO')
    {
        $instance = new self();
        $timestamp = date('Y-m-d H:i:s');
        $formatted = "[$timestamp] [$level] $message" . PHP_EOL;
        file_put_contents($instance->logFile, $formatted, FILE_APPEND);
    }

    public static function error($message)
    {
        self::log($message, 'ERROR');
    }

    public static function info($message)
    {
        self::log($message, 'INFO');
    }
}
