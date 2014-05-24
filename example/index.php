<?php
define("ROOTPATH", dirname(__FILE__) . '/');
define("OFFSETPATH", '');
define("MODE", 'dev');
require_once __DIR__ . '/vendor/autoload.php';
$config = require_once __DIR__ . '/vendor/nahakiole/fredyframework/src/Fredy/Run.php';
new \Fredy\Fredy($config);
