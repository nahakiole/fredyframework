<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 25.03.14
 * Time: 16:31
 */

namespace Fredy\Model\Entity\DataType;


class Integer extends Datatype
{

    public $min;
    public $max;

    public function __construct($min = null, $max = null)
    {
        $this->min = $min;
        $this->max = $max;
    }

    function isValid($value, $parentField)
    {
        if (isset($inputvariable) && (filter_var($inputvariable, FILTER_VALIDATE_INT) === 0 || !filter_var($inputvariable, FILTER_VALIDATE_INT) === False)) {
            $parentField->error = 'must_be_integer';
        } else if ($this->min != null && intval($value) < $this->min) {
            $parentField->error = 'integer_too_small';
        } else if ($this->max != null && intval($value) > $this->max) {
            $parentField->error = 'integer_too_big';
        } else {
            return true;
        }
        return false;
    }
} 