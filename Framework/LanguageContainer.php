<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 27.03.14
 * Time: 13:50
 */

namespace Framework;


class LanguageContainer
{
    private $stringArray = [];

    function __construct($stringArray)
    {
        $this->stringArray = $stringArray;
    }

    function getString($title)
    {
        return $this->stringArray[$title];
    }

    function getStringWithAttributes($title, $attributes = [])
    {
        return vsprintf($this->stringArray[$title], $attributes);
    }


} 