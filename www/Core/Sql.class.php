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




}