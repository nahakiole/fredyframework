<?php


namespace Model\Factory;

use Model\Entity;

abstract class Factory
{

    protected $Entity;

    /**
     * @param $rawEntityData
     * @return array
     */
    public function buildAll($rawEntityData)
    {
        $entities = [];
        foreach ($rawEntityData as $key => $singleRawEntityData) {
            $entities[] = $this->build($singleRawEntityData);
        }
        return $entities;
    }

    /**
     * @param $data
     * @return \Model\Entity\Entity
     */
    abstract public function build($data);
} 