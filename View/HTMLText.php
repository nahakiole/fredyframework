<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 26.03.14
 * Time: 11:22
 */

namespace View;


use View\HTMLElement;

class HTMLText extends HTMLElement
{

    private $text;

    function __construct($text)
    {
        $this->text = $text;
    }


    public function render()
    {
        return $this->text;
    }
} 