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
        $query = 
            'SELECT `' . 
                join("`, `", $this->entity->getFieldDatabaseNameArray()) . 
            '` FROM ' . $this->tableName . 
            ' WHERE `id`=:id' . 
            ';';
        $stmt = $this->database->prepare($query);

        $stmt->bindParam(':id', $id);

        $stmt->execute();

        return $this->factory->build($stmt->fetch());
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
    public function create($entity,$update=false)
    {
        $databaseNameArray = $entity->getFieldDatabaseNameArray();


        if ($update) {
            $command = 'REPLACE INTO';
        } else {
            $command = 'INSERT INTO';
        }

        $query =
            $command . ' `' . $this->tableName . '` (`' . 
                join("`, `", $databaseNameArray) . 
            '`) VALUES (:' .
                join(", :", $databaseNameArray) . 
            ');';


        $stmt = $this->database->prepare($query);

        var_dump($query);
        echo '<br>';

        $valueArray = $entity->getValueArray();
        foreach ($databaseNameArray as $index => $paramName) {
            $stmt->bindParam(':' . $paramName, $valueArray[$index]);
            echo ':' . $paramName . ': ' . $valueArray[$index] . '<br>';
        }

        $stmt->execute();

        var_dump($stmt->errorInfo());

    }

    public function update($entity)
    {
        $this->create($entity,true);
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