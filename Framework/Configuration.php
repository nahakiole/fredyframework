<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 25.03.14
 * Time: 13:11
 */

namespace Framework;


class Configuration
{
    public static $ROOTPATH;
    public static $OFFSETPATH;

    public $container;

    function __construct()
    {

        $this->container = new \Pimple();
        self::$ROOTPATH = substr(__DIR__,0, -9);
        self::$OFFSETPATH = 'fredyframework';
    }

    function loadConfiguration(){

        $this->container['db.host'] = 'localhost';
        $this->container['db.user'] = 'localhost';
        $this->container['db.password'] = 'localhost';
        $this->container['db.dbname'] = 'fredyframework';
    }

    function loadServices(){
        $this->container['PDO'] = function($c){
            return new PDO($c['db.host']);
        };

        $this->container['demo'] = function(){
            return new \Controller\Demo();
        };

        $this->container['error'] = function(){
            return new \Controller\Error();
        };

    }


}