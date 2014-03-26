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
     * @var \Model\Entity\Entity
     */
    protected $entity;

    /**
     * @var $database \PDO
     */
    protected $database;

    /**
     * @var $factory \Model\Factory\Factory
     */
    protected $factory;

    /**
     * @internal param \PDO $database
     */
    public function __construct($database)
    {
        if (empty($this->tableName)) {
            throw new NoTableNameDefinedException();
        }
        $this->database = $database;
    }

    /**
     * @param $limit
     * @param $offset
     *
     * @return \Model\Entity\Entity[]
     */
    public function findAll($limit = 0, $offset = 0)
    {
        if ($limit != 0) {
            $limit = 'LIMIT ' . intval($offset) . ', ' . intval($limit);

        } else {
            $limit = '';
        }

        $query = 'SELECT ' . join(", ", $this->entity->getFieldDatabaseNameArray()) . ' FROM ' . $this->tableName . '  '.$limit.' ;';
        $stmt = $this->database->prepare($query);

        $stmt->execute();


        return $this->factory->buildAll($stmt->fetchAll());

    }

    /**
     * @param $id
     *
     * @return \Model\Entity\Entity
     */
    public function findById($id)
    {

    }

    /**
     * @param $filter \Model\Repository\Filter[]
     *
     * @return \Model\Entity\Entity
     */
    public function findByFilter($filter)
    {

    }

    /**
     * @param $entity
     *
     * @return void
     */
    public function create($entity)
    {

    }

    /**
     * @param $entity
     *
     * @return void
     */
    public function remove($entity)
    {

    }
}

Class NoTableNameDefinedException extends \Exception
{

}

Class NoFieldsDefinedException extends \Exception
{

}