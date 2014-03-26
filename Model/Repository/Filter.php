<?php
/**
 * Created by PhpStorm.
 * User: robin.glauser
 * Date: 03.03.14
 * Time: 11:03
 */

namespace Model\Repository;


class Filter {

    private $database;
    private $conditions;

    function __construct($database)
    {
        $this->database = $database;
    }

    public function addCondition($condition)
    {
        $this->conditions[] = $condition;
    }

    function getConditionArray()
    {
        $quotedConditions = [];
        foreach ($this->conditions as $index => $condition) {
            $quotedConditions[] = $condition->getQuotedCondition($this->database);
        }
        return $quotedConditions;
    }


}