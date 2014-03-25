<?php


namespace Model\Repository;


abstract class Repository
{

    /**
     *
     * @var string
     */
    protected $tableName = '';

    /**
     * Array with all fields
     */
    protected $fields = [];

    /**
     * @var $database \PDO
     */
    protected $database;

    /**
     * @var $db \PDO
     */
    protected $factory;

    /**
     * @internal param \PDO $database
     */
    public function __construct($database)
    {
        if (empty($this->tableName)){
            throw new NoTableNameDefinedException();
        }
        if (count($this->fields) == 0){
            throw new NoFieldsDefinedException();
        }
        $this->database = $database;
    }

    /**
     * @param $limit
     * @param $offset
     *
     * @return \Model\Entity\Entity[]
     */
    public function findAll($limit = 0, $offset = 0){

    }

    /**
     * @param $id
     *
     * @return \Model\Entity\Entity
     */
    public function findById($id){

    }

    /**
     * @param $filter \Model\Repository\Filter[]
     *
     * @return \Model\Entity\Entity
     */
    public function findByFilter($filter){

    }

    /**
     * @param $entity
     *
     * @return void
     */
    public function create($entity){

    }

    /**
     * @param $entity
     *
     * @return void
     */
    public function remove($entity){

    }
}

Class NoTableNameDefinedException extends \Exception {

}

Class NoFieldsDefinedException extends \Exception {

}