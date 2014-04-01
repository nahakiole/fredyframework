<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 25.03.14
 * Time: 16:29
 */

namespace Fredy\Model\Entity\Datatype;


abstract class Datatype
{

    abstract function isValid($value, $parentField);

    public function parentIsValid($value, $parentField)
    {
        if ($value == null && !$parentField->isRequired) {
            return true;
        } else {
            return false;
        }
    }

} 