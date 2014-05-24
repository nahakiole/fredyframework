<?php


namespace Fredy\Model\Factory;

use  Fredy\Model\Entity;

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
     * @return \Fredy\Model\Entity\Entity
     */
    abstract public function build($data);
} 