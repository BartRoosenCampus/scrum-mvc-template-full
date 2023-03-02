<?php

namespace App\Data;

use App\Services\YamlService;
use PDO;

abstract class AbstractDataHandler
{
    private ?PDO $dbh = null;

    private function connect()
    {
        $dbConfig  = YamlService::parseFile('database');
        $this->dbh = new PDO($dbConfig['connectionString'], $dbConfig['userName'], $dbConfig['pass']);
    }

    private function disconnect()
    {
        $this->dbh = null;
    }

    protected function read(string $sql, array $bindings = [], bool $multipleRows = true): bool|array
    {
        self::connect();
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute($bindings);

        if ($multipleRows) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        self::disconnect();

        return $result;
    }

    protected function create(string $sql, array $bindings = []): bool|int
    {
        self::connect();
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute($bindings);
        $id       = $this->dbh->lastInsertId();
        $affected = $stmt->rowCount();
        self::disconnect();

        return 1 === $affected ? $id : false;
    }

    protected function update(string $sql, array $bindings = []): int
    {
        self::connect();
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute($bindings);
        self::disconnect();

        return $stmt->rowCount();
    }

    protected function delete(string $sql, array $bindings = []): int
    {
        self::connect();
        $stmt  = $this->dbh->prepare($sql);
        $start = $stmt->rowCount();
        $stmt->execute($bindings);
        self::disconnect();

        $stop = $stmt->rowCount();

        return $start - $stop;
    }
}
