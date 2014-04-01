<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 25.03.14
 * Time: 16:36
 */

namespace Fredy\Model\Entity\DataType;


class Text extends Datatype
{

    public $minLength;
    public $maxLength;

    public function __construct($minLength = 0, $maxLength = 0)
    {
        $this->minLength = $minLength;
        $this->maxLength = $maxLength;
    }

    public function isValid($value, $parentField)
    {
        if (!is_string($value)) {
            $parentField->error = 'must_be_string';
        } else if (strlen($value) < $this->minLength) {
            $parentField->error = 'text_too_short';
        } else if ($this->maxLength != 0 && strlen($value) > $this->maxLength) {
            $parentField->error = 'text_too_long';
        } else {
            return true;
        }
        return false;
    }
} 