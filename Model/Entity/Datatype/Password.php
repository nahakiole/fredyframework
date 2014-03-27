<?php

namespace Model\Entity\DataType;

class Password extends Datatype {

    public $minLength;

    public function __construct($minLength = 4)
    {
        $this->minLength;
    }

    public function isValid($value,$parentField)
    {
        if (!strlen($value) >= $this->minLength) {
            $parentField->error = 'password_too_short';
        } else {
            return true;
        }
        return false;
    }
} 