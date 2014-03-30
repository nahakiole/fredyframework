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
        self::$ROOTPATH = substr(__DIR__, 0, -9);
        self::$OFFSETPATH = '';
    }

    function loadConfiguration()
    {

        $this->container['db.host'] = 'localhost';
        $this->container['db.user'] = 'root';
        $this->container['db.password'] = '';
        $this->container['db.dbname'] = 'fredyframework';
        $this->container['language.default'] = 'en';
        $this->container['language.directory'] = self::$ROOTPATH . 'View/Language/';
        $this->container['language.array'] = [
            'en',
            'de'
        ];
    }

    function loadServices()
    {
        $this->container['PDO'] = function ($c) {
            return new \PDO(
                'mysql:host=' . $c['db.host'] . ';dbname=' . $c['db.dbname'] . ';'
                , $c['db.user']
                , $c['db.password']);
        };

        $this->container['demo'] = function ($c) {
            return new \Controller\Demo($c['PDO'], $c['languageLoader']);
        };

        $this->container['error'] = function () {
            return new \Controller\Error();
        };

        $this->container['journal'] = function ($c) {
            return new \Controller\JournalController($c['PDO'], $c['languageLoader']);
        };

        $this->container['languageLoader'] = function ($c) {
            return new \Framework\LanguageLoader($c['language.default'], $c['language.array'], $c['language.directory'], $_SERVER['HTTP_ACCEPT_LANGUAGE']);
        };

        $this->container['test'] = function ($c) {
            return new \Controller\TestController();
        };

    }


}