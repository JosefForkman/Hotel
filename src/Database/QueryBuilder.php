<?php
    declare(strict_types=1);
    namespace Josef\Hotel\Database;

use PDO;

class QueryBuilder {
    private string $query;

    public function __construct(
        private PDO $database
    ) {
    }

    public function select(array $columns = ['*']): static
    {
        $this->query = sprintf('SELECT %s', implode(', ', $columns));

        return $this;
    }

    public function from(string $table): static
    {
        $this->query = sprintf('%s FROM %s', $this->query, $table);

        return $this;
    }

    public function limit(int $offset, int $row_count)
    {
        $this->query = sprintf("%s LIMIT %s, %s", $this->query, $offset, $row_count);

        return $this;
    }
    public function where(string $table_name, string $condition, string $equal_to)
    {
        $this->query = sprintf("%s WHERE %s %s %s", $this->query, $table_name, $condition, $equal_to);

        return $this;
    }

    public function orderBy(string $column, string $direction)
    {
        $this->query = sprintf("%s ORDER BY %s %s", $this->query, $column, $direction);

        return $this;
    }
    public function groupBy(array $column)
    {
        $grops = implode(', ', $column);
        $this->query = sprintf("%s groupBy %s", $this->query, $grops);

        return $this;
    }

    public function get(): array
    {
        $statement = $this->database->prepare($this->query);

        $statement->execute();

        if ($result = $statement->fetchAll(PDO::FETCH_CLASS)) {
            return $result;
        }

        return [];
    }
    public function first(): object
    {
        $statement = $this->database->prepare($this->query);

        $statement->execute();

        if ($result = $statement->fetch(PDO::FETCH_OBJ)) {
            return $result;
        }

        return [];
    }
}
?>
