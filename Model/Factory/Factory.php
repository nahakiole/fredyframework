<?php


namespace Model\Factory;

use Model\Entity;

abstract class Factory
{

    protected $Entity;

    public function buildAll($rawEntityData)
    {
        $entities = [];
        foreach ($rawEntityData as $key => $singleRawEntityData) {
            $entities[] = $this->build($singleRawEntityData);
        }
        return $entities;
    }

    abstract public function build($data);
} 