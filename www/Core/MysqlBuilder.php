<?php
    namespace App\Core;
    
    use App\Core\Sql;

    interface QueryBuilder
    {
        public function select(string $table, array $columns): QueryBuilder;

        public function where(string $column, string $value, string $operator = "="): QueryBuilder;
        
        public function limit(int $from, int $offset = 1): QueryBuilder;

        public function order(string $columnName, string $value): QueryBuilder;

        public function executeQuery(): ?array;

        public function insert(string $table, array $columns): QueryBuilder;

        public function update(string $table, array $columns): QueryBuilder;
    }

    class MysqlBuilder extends Sql implements QueryBuilder
    {
        private $query;
        private $data = null;

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
            $this->query->where[] = $column . $operator . "'" . $value . "'";
            return $this;
        }

        public function limit(int $from, int $offset = 1): QueryBuilder
        {
            $this->query->limit = " LIMIT " . $from . ", " . $offset;
            return $this;
        }

        public function order(string $columnName, string $value): QueryBuilder
        {
            $this->query->order = " ORDER BY " . $columnName . " " . $value;
            return $this;
        }

        public function executeQuery(): ?array
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

            if (is_null($data)) {
                return parent::selectQuery($sql); 
            } else {
                return parent::upsertQuery($sql, $data);
            }
           
        }

        public function insert(string $table, array $columns): QueryBuilder 
        {
            $this->reset(); 
            $this->data = $columns;
            $this->query->base = "INSERT INTO " . DBPREFIXE . $table . " (" . implode(",", array_keys($this->data)) . ") VALUES (:" . implode(",:", array_keys($this->data)) . ")";
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
    }


    class PostgreBuilder extends MysqlBuilder
    {   
        
        public function limit(int $from, int $offset = 1): QueryBuilder
        {
            $this->query->limit = " LIMIT " . $from . " OFFSET " . $offset;
            return $this;
        }

    }

?>