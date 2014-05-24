<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 23.05.14
 * Time: 18:09
 */

namespace Fredy\Model\Repository;


class EntityManager {

    /**
     * @var \PDO
     */
    private $db;

    /**
     * @var \Fredy\Model\Repository\Repository[]
     */
    private $cachedRepository;

    function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * @param $entityName
     *
     * @return \Fredy\Model\Repository\Repository
     */
    function getRepository($entityName)
    {
        if (isset($this->cachedRepository[$entityName])) {
            return $this->cachedRepository[$entityName];
        }
        $className = "\\Model\\Repository\\".$entityName."Repository";
        return new $className($this->db);
    }


}