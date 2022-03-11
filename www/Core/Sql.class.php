<?php

namespace App\Core;

abstract class Sql
{

    private $pdo;
    private $table;

    public function __construct()
    {
        //Plus tard il faudra penser au singleton
        try {
            $this->pdo = new \PDO(
                DBDRIVER . 
                ":host=" . DBHOST . 
                ";port=" . DBPORT . 
                ";dbname=" . DBNAME,
                DBUSER,
                DBPWD,
                [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING]
            );
        } catch (\Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }

        $getCalledClassExploded = explode("\\", strtolower(get_called_class())); // App\Model\User
        $this->table = DBPREFIXE . end($getCalledClassExploded);
    }

    protected function databaseFindOne(string $sql, array $params): mixed
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
        $sql = "SELECT * FROM " . $this->table . " WHERE id=:id";
        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute(["id" => $id]);
        return $queryPrepared->fetchObject(get_called_class());
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value)
        {
            $methode = 'set'.ucfirst($key);
            if (method_exists($this, $methode))
            {
                $this->$methode($value);
            }
        }
    }

    public function save(): void
    {

        $columns = get_object_vars($this);
        $varToExclude = get_class_vars(get_class());
        $columns = array_diff_key($columns, $varToExclude);

        if (is_null($this->getId())) {
            $sql = "INSERT INTO " . $this->table . " (" . implode(",", array_keys($columns)) . ") VALUES (:" . implode(",:", array_keys($columns)) . ")";
        } else {
            $update = [];
            foreach ($columns as $key) {
                $update[] = $key . "=:" . $key;
            }
            $sql = "UPDATE " . $this->table . " SET " . implode(",", $update) . " WHERE id=:id";
        }

        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute($columns);

        //Si ID null alors insert sinon update
    }

    public function findOneBy(array $whereClause): array
    {
        $columns = get_object_vars($this);
        $varToExclude = get_class_vars(get_class());
        $columns = array_diff_key($columns, $varToExclude);

        foreach ($whereClause as $key => $whereValue) {
            $where[] = $whereValue . "=:" . $whereValue;
        }

        $sql = "SELECT * FROM " . $this->table . " WHERE " . implode(",", $where);
        
        $whereClause = array_intersect_key($columns, $whereClause);

        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute($whereClause);

        return $queryPrepared->fetch(\PDO::FETCH_ASSOC);
    }

    public function verifyUser(array $params): void
    {
        $userVerify = $this->findOneBy($params);
        echo '<pre>';
        if (empty($userVerify)) {
            echo "ça fonctionne pas !";
        } else {
            if (password_verify($_POST['password'], $userVerify['password'])) {
                session_start();
                $_SESSION['user']['id'] = $userVerify['id'];
                $_SESSION['user']['email'] = $userVerify['email'];
                $_SESSION['user']['firstname'] = $userVerify['firstname'];
                $_SESSION['user']['lastname'] = $userVerify['lastname'];

                header('Location: dashboard');
            } else {
                echo "ça fonctionne pas non plus!";
            }
        };

        // echo '<pre>';
        // print_r($_POST);
        // $colums = get_object_vars($this);
        // echo '<pre>';
        // print_r($colums);
    }
}
