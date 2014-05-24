<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 27.03.14
 * Time: 23:45
 */

namespace Fredy\View;


abstract class Response implements Viewable
{

    /**
     * @return string
     */
    abstract function render();
} 