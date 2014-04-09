<?php
Namespace Fredy;

Class FredyAutoloader
{


    function __construct()
    {
        spl_autoload_register([$this,'loadClass']);
    }

    function loadClass($class)
    {
        $file = ROOTPATH . str_replace("\\", "/", $class) . ".php";
        if (file_exists($file)) {
            require_once($file);
        }
    }

}