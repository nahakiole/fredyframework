<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 25.03.14
 * Time: 16:31
 */

namespace Model\Entity\DataType;


class Integer extends Datatype {

    public $min;
    public $max;

    public function __construct($min = null, $max = null)
    {
        $this->min = $min;
        $this->max = $max;
    }

    function isValid($value)
    {
        return filter_var($value, FILTER_VALIDATE_INT) 
            && ($min == null || intval($value) >= $min)
            && ($max == null || intval($value) <= $max);
    }
} 