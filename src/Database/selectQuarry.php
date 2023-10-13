<?php
    declare(strict_types=1);
    namespace Josef\Hotel\Database;

use PDO;

class selectQuarry {
    private string $query;
    private array $param = [];

    public function __construct(
        private PDO $database
    ) {
    }

    public function select(array $columns = ['*']): static
    {
        $this->query = sprintf('SELECT %s', implode(', ', $columns));

        return $this;
    }

    public function from(Table $table): static
    {
        $this->query = sprintf('%s FROM %s', $this->query, $table->value);

        return $this;
    }

    public function limit(int $offset, int $row_count) {
        $this->query = sprintf("%s LIMIT %s, %s", $this->query, $offset, $row_count);

        return $this;
    }

    public function where(string $tableName, string $operator, string $equalTo) {

        $this->query = sprintf("%s where %s %s %s", $this->query, $tableName, $operator, $equalTo);

        return $this;
    }

    public function AND(string $tableName, string $operator, string $equalTo) {
        $this->query = sprintf("%s AND %s %s %s", $this->query, $tableName, $operator, $equalTo);

        return $this;
    }
    public function OR(string $tableName, string $operator, string $equalTo) {
        $this->query = sprintf("%s OR %s %s %s", $this->query, $tableName, $operator, $equalTo);

        return $this;
    }

    public function orderBy(string $column, string $direction) {
        $this->query = sprintf("%s ORDER BY %s %s", $this->query, $column, $direction);

        return $this;
    }
    public function groupBy(array $column) {
        $grops = implode(', ', $column);
        $this->query = sprintf("%s groupBy %s", $this->query, $grops);

        return $this;
    }

    public function params(array $param)
    {
        $this->param = $param;
        return $this;
    }

    public function get(): array
    {
        $statement = $this->database->prepare($this->query);

        $statement->execute($this->param);

        if ($result = $statement->fetchAll(PDO::FETCH_CLASS)) {
            return $result;
        }

        return [];
    }
    public function first(): object
    {
        $statement = $this->database->prepare($this->query);

        $statement->execute($this->param);

        if ($result = $statement->fetch(PDO::FETCH_OBJ)) {
            return $result;
        }

        return [];
    }
}
?>
