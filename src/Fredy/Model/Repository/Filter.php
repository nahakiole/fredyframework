<?php
/**
 * Created by PhpStorm.
 * User: robin.glauser
 * Date: 03.03.14
 * Time: 11:03
 */

namespace Fredy\Model\Repository;


class Filter
{

    /**
     * @var \PDO
     */
    private $database;

    /**
     * @var Condition[]
     */
    private $conditions;

    /**
     * @param $database \PDO
     */
    function __construct($database)
    {
        $this->database = $database;
    }

    /**
     * @param $condition
     */
    public function addCondition($condition)
    {
        $this->conditions[] = $condition;
    }

    /**
     * @return Condition[]
     */
    function getConditionArray()
    {
        $quotedConditions = [];
        foreach ($this->conditions as $index => $condition) {
            $quotedConditions[] = $condition->getQuotedCondition($this->database);
        }
        return $quotedConditions;
    }


}