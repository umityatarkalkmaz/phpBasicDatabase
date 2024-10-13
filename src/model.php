<?php

namespace Umityatarkalkmaz;
use Exception;
use PDO;
class Model extends Database
{
    protected string $sql;
    protected array $params = [];

    protected function table($table): static
    {
        $this->sql = 'SELECT * FROM ' . $table;
        return $this;
    }

    protected function where($column, $value, $logic = '='): static
    {
        $this->sql .= ' WHERE ' . $column . ' ' . $logic . ' :' . $column;
        $this->params[$column] = $value;
        return $this;
    }

    protected function all()
    {
        $stmt = $this->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function first()
    {
        $stmt = $this->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function sqlString(): string
    {
        return $this->sql;
    }

    protected function delete($table): static
    {
        // DELETE FROM "user" WHERE user.name = 1;
        $this->sql = 'DELETE FROM ' . $table;
        return $this;
    }

    /**
     * @throws Exception
     */
    protected function execute($force = false): false|\PDOStatement
    {

        if (preg_match('/^(UPDATE|DELETE)/i', $this->sql) && !str_contains($this->sql, 'WHERE') && !$force) {
            throw new Exception("UPDATE or DELETE queries must include a WHERE condition.");
        }
        $stmt = $this->db->prepare($this->sql);
        $stmt->execute($this->params);
        $this->params = [];
        return $stmt;
    }

    protected function limit($limit): static
    {
        $this->sql .= ' LIMIT ' . $limit;
        return $this;
    }

    protected function orderBy($column, $sort = 'ASC'): static
    {
        $this->sql .= ' ORDER BY ' . $column . ' ' . strtoupper($sort);
        return $this;
    }


    protected function insert($table, array $data): static
    {

        $columns = array_keys($data);
        $columnString = implode(', ', $columns);

        $valueString = implode(', ', array_map(function ($column) {
            return ':' . $column;
        }, $columns));

        $this->params = $data;
        $this->sql = 'INSERT INTO ' . $table . '(' . $columnString . ')' . 'VALUES' . '(' . $valueString . ')';
        return $this;
        //INSERT INTO table_name (column1, column2, column3, ...) VALUES (value1, value2, value3, ...);
    }

    protected function update($table, array $data): static
    {
        foreach ($data as $key => $value) {
            $setString[] = $key . ' = ' . ':' . $key;
        }

        $this->params = $data;
        $this->sql = 'UPDATE ' . $table . ' SET ' . implode(', ', $setString);
        return $this;
        //UPDATE table_name SET column1 = val1, column2 = val2... WHERE id = 1;
    }
}
