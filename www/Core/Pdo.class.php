<?php

namespace App\Core;

class Pdo
{
    private $_pdo;
    private static $instance = null;

    public function __construct()
    {
        try {
            $this->_pdo = new \PDO(
                DBDRIVER .
                    ":host=" . DBHOST .
                    ";port=" . DBPORT .
                    ";dbname=" . DBNAME .
                    ";charset=utf8",
                DBUSER,
                DBPWD,
                [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING]
            );
        } catch (\Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
       
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new Pdo();
        }
        return self::$instance;
    }

    public function getPdo()
    {
        return $this->_pdo;
    }

    public function fetch(string $sql, string $class, array $data = null) {
        $queryPrepared = $this->_pdo->prepare($sql);
        if (is_null($data)) {
            $queryPrepared->execute();
        } else {
            $queryPrepared->execute($data);
        }
        $queryPrepared->setFetchMode(\PDO::FETCH_CLASS, "App\Model\\". ucfirst($class));
        return $queryPrepared->fetch();
    }

    public function fetchAll(string $sql, string $class, array $data = null) {
        $queryPrepared = $this->_pdo->prepare($sql);
        if (is_null($data)) {
            $queryPrepared->execute();
        } else {
            $queryPrepared->execute($data);
        }
        $queryPrepared->setFetchMode(\PDO::FETCH_CLASS, "App\Model\\". ucfirst($class));
        return $queryPrepared->fetchAll();
    }

    public function execute(string $sql, array $data = null) {
        $queryPrepared = $this->_pdo->prepare($sql);
        if (is_null($data)) {
            $queryPrepared->execute();
        } else {
            $queryPrepared->execute($data);
        }
    }

   }
