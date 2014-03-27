<?php

namespace Model\Entity\DataType;

class Id extends Datatype {
    function isValid(&$value)
    {
        return $value == null || filter_var($value, FILTER_VALIDATE_INT);
    }
} 