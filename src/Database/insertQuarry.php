<?php
    declare(strict_types=1);
    namespace Josef\Hotel\Database;

use PDO;

class insertQuarry {
    private string $query;
    private array $param = [];

    public function __construct(
        private PDO $database
    ) {
    }

    public function insertInTo(Table $table, array $data = ['*']): static
    {
        # Get the Column Name & Column Value
        $columnName = implode(', ', array_keys($data));
        $value = implode(', ', array_values($data));

        $this->query = sprintf('INSERT INTO %s (%s) VALUES(%s)', $table, $columnName, $value);

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
    
    public function params(array $param)
    {
        $this->param = $param;
        return $this;
    }
}
?>
