<?php
spl_autoload_register('loadClass');
function loadClass($class)
{
    $file = str_replace("\\", "/", $class) . ".php";
    if (file_exists($file)) {
        require_once($file);
    }
}
