<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 25.05.14
 * Time: 14:36
 */

namespace Fredy;


class Debugger {

    private static $whoops;
    private static $fileHandler;
    private static $mode;

    private function __construct()
    {
    }

    /**
     * @param $mode
     * Set the mode of the framework. This is either dev or prod at the moment.
     * dev enables the errorhandler to show a fancy stacktrace
     * prod removes all error output and shows no errors
     */
    public static function setMode($mode)
    {
        self::$mode = $mode;
        if ($mode == 'dev') {
            self::$whoops = new \Whoops\Run;
            self::$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
            self::$whoops->register();
        } elseif ($mode == 'prod') {
            ini_set('display_errors', 'Off');
            error_reporting(0);
        }
    }

    /**
     * Enables output to file.
     */
    public static function enableFileOutput()
    {
        self::$fileHandler = fopen('log', 'a');
    }

    public static function log($string)
    {
        if (self::$mode != 'prod'){
            if (self::$fileHandler) {
                fwrite(self::$fileHandler, date('l jS \of F Y h:i:s ') . " " . $string."\n");
            }
            else {
                self::showMessage($string);
            }
        }
    }

    private static function showMessage($message)
    {
        var_dump($message);
        echo "<br/>";
    }


}