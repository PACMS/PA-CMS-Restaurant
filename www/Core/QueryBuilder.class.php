<?php

namespace App\Core;

class QueryBuilder extends Sql {

    private $select;
    private $from;
    private $where;
    private $group;
    private $order;
    private $limit;
    private $queryPrepared;

    public function __construct() {
        parent::__construct();
    }

    public function select(string ...$fields): self
    {
        $this->select = $fields;
        return $this;
    }

    public function from(string $table, ?string $alias = null): self
    {
        $this->from = DBPREFIXE . $table . ($alias ? " AS " . $alias : "");
        return $this;
    }

    public function where(string ...$conditions): self
    {
        $this->where = $conditions;
        return $this;
    }

    public function setParameters(array $parameters): self
    {
        $this->parameters = $parameters;
        return $this;
    }

    // public function showPDO()
    // {
    //     dd($this->pdo, $this->table);
    // }

    // public function execute()
    // {
    //     $query = $this->pdo->prepare($this->__toString());
    //     $this->queryPrepared = $query->execute($this->parameters);
    //     return $this;
    // }

    // public function fetchAll()
    // {
    //     return $this->queryPrepared->fetchAll(\PDO::FETCH_ASSOC);
    // }

    public function getDQL(): string
    {
        return $this->__toString();
    }

    public function count(?string $sql = null): int
    {
        $this->select('COUNT(*)');
        return parent::count($this->__toString());
    }

    public function __toString()
    {
        $parts = ['SELECT'];
        if ($this->select) {
            $parts[] = implode(', ', $this->select);
        } else {
            $parts[] = '*';
        }
        $parts[] = 'FROM';
        $parts[] = $this->from;
        if ($this->where) {
            $parts[] = 'WHERE';
            $parts[] = '(' . implode(') AND (', $this->where) . ')';
        }
        return implode(' ', $parts);
    }
}