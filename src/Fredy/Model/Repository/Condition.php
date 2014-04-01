<?php

namespace Fredy\Model\Repository;


class Condition
{

    private $field;
    private $operator;
    private $value;

    /**
     * @param $field string
     * @param $operator string
     * @param $value string
     */
    function __construct($field, $operator, $value)
    {
        $this->field = $field;
        $this->operator = $operator;
        $this->value = $value;
    }

    /**
     * @param $database \PDO
     * @return string
     */
    public function getQuotedCondition($database)
    {
        $value = $database->quote($this->value);
        return "`$this->field` $this->operator $value";
    }


}