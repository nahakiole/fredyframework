<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 25.03.14
 * Time: 16:28
 */

namespace Model\Entity;


class Field
{
    public $name;
    public $databaseField;
    public $value;

    public $error;
    public $valid;

    /**
     * @var DataType\DataType
     */
    public $dataType;
    public $element;
    public $isRequired;
    public $index;

    function __construct($name, $dataType, $element, $isRequired, $value, $index)
    {
        $this->name = $name;
        $this->dataType = $dataType;
        $this->element = $element;
        $this->isRequired = $isRequired;
        $this->databaseField = strtolower($name);
        $this->value = $value;
        $this->index = $index;
    }

    public function toSelectString()
    {
        return $this->databaseField;
    }

    public function toInsertString()
    {
        return isset($this->value) ? $this->value : null;
    }

    public function __tostring()
    {
        return (string)$this->value;
    }

    public function isValid()
    {
        $this->valid = $this->dataType->parentIsValid($this->value, $this)
            || $this->dataType->isValid($this->value, $this);
        return $this->valid;
    }
}