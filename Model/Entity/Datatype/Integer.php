<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 25.03.14
 * Time: 16:31
 */

namespace Model\Entity\DataType;


class Integer extends Datatype {
    function isValid(&$value)
    {
        return filter_var($value, FILTER_VALIDATE_INT);
    }
} 