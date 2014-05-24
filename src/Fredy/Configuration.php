<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 25.03.14
 * Time: 13:11
 */
namespace Fredy;

class Configuration
{

    public $config = [];

    function __construct($filePath)
    {
        require_once $filePath;
        /**
         * @var $configuration String
         */
        $this->config = $configuration;
    }

}