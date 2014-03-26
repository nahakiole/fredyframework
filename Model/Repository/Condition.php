<?php

namespace Model\Repository;


class Condition {

    private $field;
    private $operator;
    private $value;

    function __construct($field, $operator,$value)
    {
        $this->field = $field;
        $this->operator = $operator;
        $this->value = $value;
    }

    public function getQuotedCondition($database)
    {
        $value = $database->quote($this->value);
        return "`$this->field` $this->operator $value";
    }


}