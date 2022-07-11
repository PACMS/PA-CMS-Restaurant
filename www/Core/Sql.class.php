<?php

namespace App\Core;
use App\Core\Pdo;
/**
 * Sql class
 * 
 * @category Core
 * 
 * @package App\Core
 * 
 * @access abstract
 * 
 * @author PACMS <pa.cms.test@gmail.com>
 * 
 */
abstract class Sql
{
    private $_pdo;
    private $_table;

    /**
     * Constructor
     * 
     * @return void
     */
    public function __construct()
    {
        //Plus tard il faudra penser au singleton
        try {
            $this->_pdo = Pdo::getInstance();
        } catch (\Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }

        $getCalledClassExploded = explode("\\", strtolower(get_called_class())); // App\Model\User
        $this->_table = DBPREFIXE . end($getCalledClassExploded);
    }

    /**
     * Find a value in the database with where clause
     *
     * @param array       $whereClause An associative array of where clause
     * @param string|null $table       An optional table name
     *
     * @return array|null Returns an associative array or null if no result
     */
    protected function databaseFindOne(array $whereClause, ?string $table = null): ?array
    {
        foreach ($whereClause as $key => $whereValue) {
            $where[] = $key . " = :" . $key;
        }

        if (isset($table)) {
            $table = DBPREFIXE . $table;
            $sql = "SELECT * FROM " . $table . " WHERE " . implode(" AND ", $where);
        } else {
            $sql = "SELECT * FROM " . $this->_table . " WHERE " . implode(" AND ", $where);
        }

        $queryPrepared = $this->_pdo->getPdo()->prepare($sql);
        if ($queryPrepared !== false) {
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
        $statement = $this->_pdo->getPdo()->prepare($sql);
        if ($statement !== false) {
            $success = $statement->execute($params);
            if ($success) {
                return $statement->fetchAll(\PDO::FETCH_ASSOC);
            }
        }
        return null;
    }

    /**
     * Set all values given in the array if they exist in the model
     * 
     * Attention : There is no error if the setter doesn't exist in the model
     *
     * @param array $data An array of data
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
     * Update the status of a line in the database
     * 
     * @param null $result The status to set (1 or 0)
     * @param null $email  The email to set
     * 
     * @return void
     */
    public function updateStatus(int $result, string $email): void
    {
        $sql = "UPDATE " . $this->_table . " SET " . "status = " . $result . " WHERE email=:email";
        $queryPrepared = $this->_pdo->getPdo()->prepare($sql);
        $queryPrepared->execute(["email" => $email]);
    }

    /**
     * Save the current object in the database
     * 
     * Insert if the id is null, update if not
     *
     * @return void
     */
    public function save(): void
    {
        $columns = get_object_vars($this);
        $varToExclude = get_class_vars(get_class());
        $columns = array_diff_key($columns, $varToExclude);
        if ((empty($_POST['id']) || is_null($_POST['id'])) && is_null($columns['id'])) {
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
        $queryPrepared = $this->_pdo->getPdo()->prepare($sql);
        if (is_null($columns['id'])) {
            $queryPrepared->execute($columns);
        } else {
            $queryPrepared->execute($updateValues);
        }
    }

    /**
     * Verify if there is a line in the database with the same email and the same token and update the status
     *
     * @param string    $email         The email
     * @param string    $tokenToVerify The token
     * @param bool|null $updateStatus  If the status should be updated or not (default : true)
     * 
     * @throws \Exception If the token is not valid
     * 
     * @return void
     */
    public function accessToken(string $email, string $tokenToVerify, ?bool $updateStatus = true): void
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
     * Find a line in the database with where clause
     * 
     * @param array $whereClause An associative array of where clause
     * 
     * @return array|object|null Returns an associative array or null if no result
     */
    public function findOneBy(array $whereClause)
    {
        $columns = get_object_vars($this);
        $varToExclude = get_class_vars(get_class());
        $columns = array_diff_key($columns, $varToExclude);

        foreach ($whereClause as $key => $whereValue) {
            $where[] = $key . "=:" . $key;
        }

        $sql = "SELECT * FROM " . $this->_table . " WHERE " . implode(",", $where);
        $queryPrepared = $this->_pdo->getPdo()->prepare($sql);

        if ($queryPrepared !== false) {
            $success = $queryPrepared->execute($whereClause);
            if ($success) {
                return $queryPrepared->fetch(\PDO::FETCH_ASSOC);
            }
        }
        return null;
    }

    /**
     * Find all lines of a table in the database 
     * 
     * @return array|null Returns an associative array or null if no result
     */
    protected function getAll(): ?array
    {

        $sql = "SELECT * FROM " . $this->_table ;
        $queryPrepared = $this->_pdo->getPdo()->prepare($sql);
        $queryPrepared->execute();
        return $queryPrepared->fetchAll(\PDO::FETCH_OBJ);
    }

    public function last()
    {
        $sql = "SELECT * FROM " . $this->_table . " ORDER BY id DESC LIMIT 1";
        $queryPrepared = $this->_pdo->getPdo()->prepare($sql);
        $queryPrepared->execute();
        return $queryPrepared->fetch(\PDO::FETCH_OBJ);
    }

    /**
     * Verify if there is an user in the database with the same email and verify if the password is correct
     *
     * @param array $params An associative array with the email
     * 
     * @throws \Exception If the user doesn't exist
     * @throws \Exception If the password is not correct
     * 
     * @return void
     */
    public function verifyUser(array $params)
    {
        $userVerify = $this->findOneBy($params);
        echo '<pre>';
        if (empty($userVerify)) {
            return false;
        } else {
            if (password_verify($_POST['password'], $userVerify['password'])) {
                session_start();
                $_SESSION['user']['id'] = $userVerify['id'];
                $_SESSION['user']['email'] = $userVerify['email'];
                $_SESSION['user']['firstname'] = $userVerify['firstname'];
                $_SESSION['user']['lastname'] = $userVerify['lastname'];
                $_SESSION['user']['role'] = $userVerify['role'];

                if ($userVerify['role'] == 'user') {
                    if (!is_null($_SESSION['previous_location'])) {
                        header('Location: ' . $_SESSION['previous_location']);
                    } else  {
                        header('Location: /');
                    }
                } else {
                    header('Location: dashboard');
                }
            } else {
                return false;
            }
        };
    }

    /**
     * Delete a line in the database
     *
     * @param integer $id The id of the line to delete
     * 
     * @return void 
     */
    protected function delete(int $id): void
    {
        $sql = "DELETE FROM " . $this->_table . " WHERE id = :id";
        $queryPrepared = $this->_pdo->getPdo()->prepare($sql);
        $queryPrepared->execute(["id" => $id]);
    }

    protected function databaseDeleteOne(string $sql, array $params)

    {

        $statement = $this->_pdo->getPdo()->prepare($sql);
        if ($statement !== false) {
            $success = $statement->execute($params);
            if ($success) {
                return "supprimé";
            }
        }
        return null;
    }

    function selectQuery(string $sql, int $type)
    {
        $queryPrepared = $this->_pdo->getPdo()->prepare($sql);
        $queryPrepared->execute();
        return $queryPrepared->fetchAll($type);
    }

    function selectFetchAll(string $sql, int $type)
    {
        $queryPrepared = $this->_pdo->getPdo()->prepare($sql);
        $queryPrepared->execute();
        $queryPrepared->setFetchMode(\PDO::FETCH_CLASS, 'CarteModel');
        return $queryPrepared->fetch();
        // if ($type == 5) {
        //     return (object) $queryPrepared->fetchAll($type);
        // } else {
        //     return $queryPrepared->fetchAll($type);
        // }
    }

    function selectFetch(string $sql, int $type)
    {
        $queryPrepared = $this->_pdo->getPdo()->prepare($sql);
        $queryPrepared->execute();
        return $queryPrepared->fetch($type);
    }

    function upsertQuery(string $sql, array $data)
    {
        $queryPrepared= $this->_pdo->getPdo()->prepare($sql);
        $queryPrepared->execute($data);
    }

}
