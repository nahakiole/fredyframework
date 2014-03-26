<?php


namespace Model\Repository;

// #@todo: createAll, updateAll, removeAll


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

    protected $entityFields;

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
        $this->entityFields = $this->entity->getFieldDatabaseNameArray();
    }

    /**
     * @param $limit
     * @param $offset
     *
     * @return \Model\Entity\Entity[]
     */
    public function findAll($limit = 0, $offset = 0)
    {
        $limit = $this->getLimit($limit, $offset);
        $query = 'SELECT ' . $this->getFields(", ") . '
                  FROM ' . $this->tableName . '
                  ' . $limit . ' ;';
        $statement = $this->database->prepare($query);
        $statement->execute();
        return $this->factory->buildAll($statement->fetchAll());
    }

    /**
     * @param $id
     *
     * @return \Model\Entity\Entity
     */
    public function findById($id)
    {
        $query =
            'SELECT `' .
            $this->getFields("`, `") . '`
            FROM ' . $this->tableName .
            ' WHERE `id`=:id LIMIT 1';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->execute();
        return $this->factory->build($statement->fetch());
    }

    /**
     * @param $filter \Model\Repository\Filter
     *
     * @param int $limit
     * @param int $offset
     * @return \Model\Entity\Entity
     */
    public function findByFilter($filter, $limit = 0, $offset = 0)
    {
        $limit = $this->getLimit($limit, $offset);
        $query =
            'SELECT ' .
            $this->getFields(", ") .
            ' FROM ' .
            $this->tableName .
            ' WHERE ' .
            join(" AND ", $filter->getConditionArray()) .
            ' ' . $limit . ';';
        $statement = $this->database->prepare($query);
        $statement->execute();
        return $this->factory->buildAll($statement->fetchAll());
    }

    /**
     * @param $entity \Model\Entity\Entity
     */
    public function create($entity)
    {
        $this->applyEntityToDatabase($entity, false);
    }

    /**
     * @param $entity \Model\Entity\Entity
     */
    public function update($entity)
    {
        $this->applyEntityToDatabase($entity, true);
    }

    /**
     * @param $entity \Model\Entity\Entity
     *
     * @param $update
     * @return void
     */
    private function applyEntityToDatabase($entity, $update)
    {
        if ($update) {
            $command = 'REPLACE INTO';
        } else {
            $command = 'INSERT INTO';
        }
        $query =
            $command . ' `' . $this->tableName . '` (`' .
            $this->getFields("`, `") .
            '`) VALUES (:' .
            $this->getFields(", :") .
            ');';
        $statement = $this->database->prepare($query);
        $valueArray = $entity->getValueArray();
        foreach ($this->entityFields as $index => $paramName) {
            $statement->bindParam(':' . $paramName, $valueArray[$index]);
        }
        $statement->execute();
        // #@todo throw and exception if $stmt->errorInfo() has an error?
        // var_dump($stmt->errorInfo());
    }


    /**
     * Remove an entity from the database by using the id of the entity.
     * @param $entity
     *
     * @return void
     */
    public function remove($entity)
    {
        if (is_numeric($entity['id']->value)) {
            $query = 'DELETE FROM `' . $this->tableName . '` WHERE `id`=:id';
            $statement = $this->database->prepare($query);
            $statement->bindParam(':id', $entity['id']->value);
            $statement->execute();
            // #@todo throw and exception if $stmt->errorInfo() has an error?
            // var_dump($stmt->errorInfo());
        } else {
            // #@todo: handle somehow
        }
    }

    /**
     * @param $limit integer
     * @param $offset integer
     * @return string
     */
    private function getLimit($limit, $offset)
    {
        if (!($limit == 0 && $offset == 0)) {
            return 'LIMIT ' . intval($offset) . ', ' . intval($limit);
        } else {
            return '';
        }
    }

    private function getFields($glue)
    {
        return join($glue, $this->entityFields);
    }
}

Class NoTableNameDefinedException extends \Exception
{

}