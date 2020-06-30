<?php


namespace CoverCMS\Support;


use Psr\Log\LoggerInterface;

/**
 * Class Log
 * @package CoverCMS\Support
 * @method static void emergency($message, array $context = array())
 * @method static void alert($message, array $context = array())
 * @method static void critical($message, array $context = array())
 * @method static void error($message, array $context = array())
 * @method static void warning($message, array $context = array())
 * @method static void notice($message, array $context = array())
 * @method static void info($message, array $context = array())
 * @method static void debug($message, array $context = array())
 * @method static void log($message, array $context = array())
 */
class Log extends Logger
{
    /**
     * @var LoggerInterface
     */
    private static $instance;

    /**
     * Log constructor.
     */
    private function __construct()
    {
    }

    /**
     * @param string $method
     * @param array $args
     */
    public function __call($method, $args): void
    {
        call_user_func_array([self::getInstance(), $method], $args);
    }

    /**
     * @param $method
     * @param $args
     */
    public static function __callStatic($method, $args): void
    {
        forward_static_call_array([self::getInstance(), $method], $args);
    }

    /**
     * @return Logger
     */
    public static function getInstance(): Logger
    {
        if (is_null(self::$instance)) {
            self::$instance = new Logger();
        }

        return self::$instance;
    }

    /**
     * @param Logger $logger
     */
    public static function setInstance(Logger $logger): void
    {
        self::$instance = $logger;
    }
}