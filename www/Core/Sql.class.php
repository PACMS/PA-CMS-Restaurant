<?php

namespace App\Core;

/**
 * Class Sql
 * 
 * @category Core
 * 
 * @package App\Core
 */
abstract class Sql
{
    private $_pdo;
    private $_table;
    public function __construct()
    {
        //Plus tard il faudra penser au singleton
        try {
            $this->_pdo = new \PDO(
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
        $this->_table = DBPREFIXE . end($getCalledClassExploded);
    }

    /**
     * Find one row in the database
     * 
     * @param array       $whereClause Parameters ex: ['id' => 1] or ['name' => 'toto']
     * @param null|string $table       Name of the table (default: false)
     * 
     * @return mixed
     */
    protected function databaseFindOne(array $whereClause, ?string $table = 'false'): mixed
    {
        foreach ($whereClause as $key => $whereValue) {
            $where[] = $key . " = :" . $key;
        }

        if ($table != 'false') {
            $table = DBPREFIXE . $table;
            $sql = "SELECT * FROM " . $table . " WHERE " . implode(" AND ", $where);
        } else {
            $sql = "SELECT * FROM " . $this->_table . " WHERE " . implode(" AND ", $where);
        }

        $queryPrepared = $this->_pdo->prepare($sql);
        if ($queryPrepared !== false) {
            // die(print_r($whereClause));
            $success = $queryPrepared->execute($whereClause);
            if ($success) {
                $res = $queryPrepared->fetch(\PDO::FETCH_ASSOC);
                if ($res === false) {
                    return null;
                }
                return $res;
            }
        }
        return null;
    }

    /**
     * Find all rows in the database with a SQL query and parameters
     * 
     * @param string     $sql    SQL query
     * @param null|array $params Parameters for the SQL query [key => value] (default: [])
     * 
     * @return array|null
     */
    protected function databaseFindAll(string $sql, ?array $params = []): ?array
    {
        if ($params !== []) {
            foreach ($params as $key => $whereValue) {
                $where[] = $key . " = :" . $key;
            }
            $sql = $sql . " WHERE " . implode(" AND ", $where);
        }
        $statement = $this->_pdo->prepare($sql);
        if ($statement !== false) {
            $success = $statement->execute($params);
            if ($success) {
                return $statement->fetchAll(\PDO::FETCH_ASSOC);
            }
        }
        return null;
    }

    /**
     * If the method exists in the model, it will be called
     *
     * @param array $data The data to hydrate the model with
     * 
     * @return void
     */
    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $methode = 'set' . $key;
            if (method_exists($this, $methode)) {
                $this->$methode($value);
            }
        }
    }

    /**
     * Update status of a user
     * 
     * @param null|int    $result Status of the user
     * @param null|string $email  Email of the user
     * 
     * @return void
     */
    public function updateStatus(?int $result, ?string $email): void
    {
        $sql = "UPDATE " . $this->_table . " SET " . "status = " . $result . " WHERE email=:email";
        $queryPrepared = $this->_pdo->prepare($sql);
        $queryPrepared->execute(["email" => $email]);
    }

    /**
     * Save method
     * 
     * @return void
     */
    public function save(): void
    {
        $columns = get_object_vars($this);
        $varToExclude = get_class_vars(get_class());
        $columns = array_diff_key($columns, $varToExclude);
        if (empty($_POST['id']) || is_null($_POST['id'])) {
            $sql = "INSERT INTO " . $this->_table . " (" . implode(",", array_keys($columns)) . ") VALUES (:" . implode(",:", array_keys($columns)) . ")";
        } else {
            $update = [];
            $updateValues = [];

            foreach ($columns as $key => $whereValue) {
                if (!is_null($whereValue) && $key !== 'id') {
                    $update[] = $key . " = :" . $key;
                }
            }

            foreach ($columns as $key => $whereValue) {
                if (!is_null($whereValue)) {
                    $updateValues[$key] = $whereValue;
                }
            }

            $sql = "UPDATE " . $this->_table . " SET " . implode(", ", $update) . " WHERE id = :id";
        }
        $queryPrepared = $this->_pdo->prepare($sql);
        if (is_null($columns['id'])) {
            $queryPrepared->execute($columns);
        } else {
            $queryPrepared->execute($updateValues);
        }

        //Si ID null alors insert sinon update
    }

    /**
     * Verify the token
     * 
     * @param null|string $email         Email of the user
     * @param null|string $tokenToVerify Token to verify
     * @param null|bool   $updateStatus  Update the status of the user (default: true)
     * 
     * @return void
     */
    public function accessToken(?string $email, ?string $tokenToVerify, ?bool $updateStatus = true): void
    {
        echo "<pre>";
        if (is_null($email)) {
            die("L'email ne correspond pas !");
        } else {
            if (is_null($this->databaseFindOne(["email" => $email, "token" => $tokenToVerify]))) {
                echo "Le token est invalide";
            } else {
                // echo "l'authentification token à réussi";
                if ($updateStatus) {
                    $this->updateStatus("1", $email);
                }
            }
        }
    }

    /**
     * Find one by
     * 
     * @param array $whereClause [key => value]
     * 
     * @return null|array
     */
    public function findOneBy(array $whereClause): ?array
    {
        $columns = get_object_vars($this);
        $varToExclude = get_class_vars(get_class());
        $columns = array_diff_key($columns, $varToExclude);

        foreach ($whereClause as $key => $whereValue) {
            $where[] = $key . "=:" . $key;
        }

        $sql = "SELECT * FROM " . $this->_table . " WHERE " . implode(",", $where);

        $queryPrepared = $this->_pdo->prepare($sql);
        $queryPrepared->execute($whereClause);

        return $queryPrepared->fetch(\PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * Find all $whereClause [key => value]
     * 
     * @return array
     */
    protected function getAll(): array
    {

        $sql = "SELECT * FROM " . $this->_table ;
        $queryPrepared = $this->_pdo->prepare($sql);
        $queryPrepared->execute();
        return $queryPrepared->fetchAll(\PDO::FETCH_OBJ);
    }

    /**
     * Verify if the user exists
     * 
     * @param array $params [key => value]
     * 
     * @return void
     */
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
                $_SESSION['user']['role'] = $userVerify['role'];

                if ($userVerify['role'] == 'user') {
                    header('Location: /');
                } else {
                    header('Location: dashboard');
                }
            } else {
                echo "ça fonctionne pas non plus!";
            }
        };
    }

    /**
     * Delete one line in the database with a sql query
     * 
     * @param string $sql    SQL query
     * @param array  $params [key => value]
     * 
     * @return null|string
     */
    protected function databaseDeleteOne(string $sql, array $params): ?string
    {
        $statement = $this->_pdo->prepare($sql);
        if ($statement !== false) {
            $success = $statement->execute($params);
            if ($success) {
                return "supprimé";
            }
        }
        return null;
    }
}
