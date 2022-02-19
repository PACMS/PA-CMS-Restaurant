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

    protected function databaseFindOne(string $sql, array $params): ?array
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

    /**
     * @param null $email
     */
    public function compareToken(?string $email, ?string $token): array
    {
        $sql = "SELECT token FROM ".$this->table." WHERE email=:email AND token=:token";
        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute( ["email"=>$email,"token"=>$token] );
        return $queryPrepared->fetchAll();
    }

       /**
     * @param null $email
     * @param null $result
     */
    public function updateStatus(?int $result, ?string $email): void
    {
        $sql = "UPDATE ".$this->table." SET "."status = ".$result." WHERE email=:email";
        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute( ["email"=>$email] );
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



    public function accessToken(?string $email, ?string $tokenToVerify): void 
    {
        echo "<pre>";
        if(is_null($this->getEmail())){
            die("L'email ne correspond pas !");
        } else {
            if(is_null($this->databaseFindOne("SELECT token FROM ".$this->table." WHERE email=:email AND token=:token", ["email"=>$email,"token"=>$tokenToVerify]))) {
                echo "Le token est invalide";
            } else {
                echo "l'authentification token à réussi";
            }

        }
    }

}