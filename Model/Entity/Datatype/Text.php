<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 25.03.14
 * Time: 16:36
 */

namespace Model\Entity\DataType;


class Text {

    public $minLength;
    public $maxLength;

    public function __construct($minLength = 0,$maxLength = 0)
    {
        $this->minLength = $minLength;
        $this->maxLength = $maxLength;
    }

    public function isValid($value)
    {
        return is_string($value) 
            && strlen($value) >= $this->minLength 
            && ($this->maxLength==0 || strlen($value) <= $this->maxLength);
    }
} 