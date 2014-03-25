<?php


namespace Model\Factory;

use Model\Entity;

abstract class Factory {

    protected $Entity;

    public function buildAll($data)
    {
        $entities = [];

        foreach ($data as $key => $entity) {
            $entities[] = new $this->build($entity);
        }

        return $entities;
    }

    public function build($data)
    {
        return new $this->Entity($data);
    }
} 