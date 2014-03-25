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
    public $value;
    /**
     * @var DataType\DataType
     */
    private $dataType;
    private $element;
    private $isRequired;
    public $index;

    function __construct($dataType, $element, $isRequired, $name, $value, $index)
    {
        $this->dataType = $dataType;
        $this->element = $element;
        $this->isRequired = $isRequired;
        $this->name = $name;
        $this->value = $value;
        $this->index = $index;
    }



} 