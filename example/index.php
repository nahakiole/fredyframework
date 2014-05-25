<?php
define("ROOTPATH", dirname(__FILE__) . '/');
define("OFFSETPATH", '');
require_once __DIR__ . '/vendor/autoload.php';
$config = require_once __DIR__ . '/vendor/nahakiole/fredyframework/src/Fredy/Run.php';
\Fredy\Debugger::setMode('dev');
//\Fredy\Debugger::setFileOutput(true);
new \Fredy\Fredy($config);
