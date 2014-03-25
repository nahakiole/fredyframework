<?php


namespace Model\Factory;

use Model\Entity;

abstract class Factory {

    public function build($data)
    {
        $entities = [];

        foreach ($data as $key => $entity) {
            $entities[] = new $this->Entity($entity);
        }

        return $entities;
    }
} 