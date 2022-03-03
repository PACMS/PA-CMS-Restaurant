<?php

namespace App\Core;

abstract class Sql
{

    private $pdo;
    private $table;

    public function __construct()
    {
        //Plus tard il faudra penser au singleton
        try{
            $this->pdo = new \PDO( DBDRIVER.":host=".DBHOST.";port=".DBPORT.";dbname=".DBNAME , DBUSER , DBPWD
                , [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING]);
        }catch(\Exception $e){
            die("Erreur SQL : ".$e->getMessage());
        }

        $getCalledClassExploded = explode("\\", strtolower(get_called_class())); // App\Model\User
        $this->table = DBPREFIXE.end($getCalledClassExploded);
    }

    protected function databaseFindOne(string $sql, array $params)
    {
        $statement = $this->pdo->prepare($sql);
        if ($statement !== false) {
            $success = $statement->execute($params);
            if ($success) {
                $res = $statement->fetch(\PDO::FETCH_ASSOC);
                if ($res === false) {
                    return null;
                }
                return $res;
            }
        }
        return null;
    }

    protected function databaseFindAll(string $sql, array $params): mixed
    {
        $statement = $this->pdo->prepare($sql);
        if ($statement !== false) {
            $success = $statement->execute($params);
            if ($success) {
                return $statement->fetchAll(\PDO::FETCH_ASSOC);
            }
        }
        return null;
    }


    /**
     * @param null $id
     */
    public function setId(?int $id): self
    {
        $sql = "SELECT * FROM ".$this->table." WHERE id=:id";
        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute( ["id"=>$id] );
        return $queryPrepared->fetchObject(get_called_class());

    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value)
        {
            $methode = 'set'.$key;
            if (method_exists($this, $methode))
            {
                $this->$methode($value);
            }
        }
    }

    public function save(): void
    {
        $colums = get_object_vars($this);
        $varToExclude = get_class_vars(get_class());
        $colums = array_diff_key($colums, $varToExclude);


        if(is_null($this->getId())){
            $sql = "INSERT INTO ".$this->table." (". implode(",", array_keys($colums)) .") VALUES (:". implode(",:", array_keys($colums)) .")";
        }else{
            $update = [];
            foreach ($colums as $key=>$value) {
                $update[] = $key."=:".$key;
            }
            $sql ="UPDATE ".$this->table." SET ".implode(",", $update)." WHERE id=:id";
        }

        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute( $colums );

        //Si ID null alors insert sinon update
    }

    public function findOneBy(array $whereClause)
    {
        $columns = get_object_vars($this);
        $varToExclude = get_class_vars(get_class());
        $columns = array_diff_key($columns, $varToExclude);

        foreach ($whereClause as $key => $whereValue) {
            $where[] = $key . "=:" . $key;
        }

        $sql = "SELECT * FROM " . $this->table . " WHERE " . implode(",", $where);

        $whereClause = array_intersect_key($columns, $whereClause);
        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute($whereClause);

        return $queryPrepared->fetch(\PDO::FETCH_ASSOC);
    }
}