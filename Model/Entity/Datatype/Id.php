<?php

namespace Model\Entity\DataType;

class Id extends Datatype
{
    function isValid($value, $parentField)
    {
        if (!($value == null || filter_var($value, FILTER_VALIDATE_INT))) {
            $parentField->error = 'id_not_valid';
        } else {
            return true;
        }
        return false;
    }
} 