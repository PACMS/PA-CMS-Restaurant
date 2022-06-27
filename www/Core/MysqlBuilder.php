<?php
    namespace App\Core;
    
    use App\Core\Pdo;

    interface QueryBuilder
    {
        public function select(string $table, array $columns): QueryBuilder;

        public function where(string $column, string $value, string $operator = "="): QueryBuilder;
        
        public function limit(int $from, int $offset = 1): QueryBuilder;

        public function order(string $columnName, string $value): QueryBuilder;

        public function insert(string $table, array $columns): QueryBuilder;

        public function update(string $table, array $columns): QueryBuilder;

        public function delete(string $table, array $columns): QueryBuilder;

        public function getQuery();

        public function fetch();

        public function fetchAll();

        public function fetchClass(string $class): QueryBuilder;

        public function execute(): void;
    }

    class MysqlBuilder implements QueryBuilder
    {
        private $query;
        private $data = null;
        private $type = \PDO::FETCH_CLASS;
        private $fetchClass;

        private function reset()
        {
            $this->query = new \stdClass();
            $this->data = null;
        }

        public function select(string $table, array $columns): QueryBuilder
        {
            $this->reset();
            $this->query->base = "SELECT " . implode(", ", $columns) . " FROM " . DBPREFIXE . $table;
            return $this;
        }

        public function where(string $column, string $value, string $operator = "="): QueryBuilder
        {
            if (is_null($this->data)){
                $this->data = [$column => $value];
            } else {    
                $this->data = array_merge([htmlentities($column) => htmlentities($value)], $this->data);
            }
            $this->query->where[] = $column . $operator . " :" . htmlentities($column);
            return $this;
        }

        public function limit(int $from, int $offset = 1): QueryBuilder
        {
            $this->query->limit = " LIMIT " . $from;
            return $this;
        }

        public function order(string $columnName, string $value): QueryBuilder
        {
            $this->query->order = " ORDER BY " . $columnName . " " . $value;
            return $this;
        }

        public function insert(string $table, array $columns): QueryBuilder 
        {
            $this->reset(); 
            $this->data = $columns;
            $this->query->base = "INSERT INTO " . DBPREFIXE . $table . " (" . implode(",", array_keys($this->data)) . ") VALUES (:" . implode(",:", array_keys($this->data)) . ")";
            return $this;
        }

        public function delete(string $table, array $columns): QueryBuilder 
        {
            $this->reset(); 
            $this->data = $columns;
            foreach ($this->data as $key => $whereValue) {
                if (!is_null($whereValue)) {
                    $delete[] = $key . " = :" . $key;
                }
            }
            $this->query->base = "DELETE FROM " . DBPREFIXE . $table . " WHERE " . implode(" AND ", $delete);
            return $this;
        }

        public function update(string $table, array $columns): QueryBuilder
        {
            $this->reset(); 
            $this->data = $columns;
            $update = [];
            $updateValues = [];

            foreach ($this->data as $key => $whereValue) {
                if (!is_null($whereValue)) {
                    $update[] = $key . " = :" . $key;
                }
            }

            foreach ($this->data as $key => $whereValue) {
                if (!is_null($whereValue)) {
                    $updateValues[$key] = $whereValue;
                }
            }
           
            $this->query->base = "UPDATE " . DBPREFIXE . $table . " SET " . implode(", ", $update);
            return $this;

        }

        public function getQuery()
        {
            $query = $this->query;
            $data = $this->data;

            $sql = $query->base;

            if (!empty($query->where)) {
                $sql .= " WHERE "  . implode(' AND ', $query->where);
            }

            if (isset($query->order)) {
                $sql .= $query->order;
            }
            
            if (isset($query->limit)) {
                $sql .= $query->limit;
            }

            $sql .= ";";

            $this->query->sql = $sql;
        }

        public function fetch()
        {
            $this->getQuery();
            $pdo = Pdo::getInstance();
            $result = $pdo->fetch($this->query->sql, $this->fetchClass, $this->data);
            return $result;
        }

        public function fetchAll()
        {
            $this->getQuery();
            $pdo = Pdo::getInstance();
            $result = $pdo->fetchAll($this->query->sql, $this->fetchClass, $this->data);
            return $result;
        }

        public function fetchClass(string $class): QueryBuilder
        {
            $this->fetchClass = ucfirst($class);
            return $this;
        }

        public function execute(): void
        {
            $this->getQuery();
            $pdo = Pdo::getInstance();
            $pdo->execute($this->query->sql, $this->data);
        }
    }


    class PostgreBuilder extends MysqlBuilder
    {   
        
        public function limit(int $from, int $offset = 1): QueryBuilder
        {
            // $this->query->limit = " LIMIT " . $from . " OFFSET " . $offset;
            $this->query->limit = " LIMIT " . $from;
            return $this;
        }

    }

?>