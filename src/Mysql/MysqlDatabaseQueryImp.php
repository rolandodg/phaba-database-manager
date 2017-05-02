<?php

declare(strict_types=1);

namespace Phaba\DatabaseManager\Mysql;

use Phaba\DatabaseManager\DatabaseQuery;
use mysqli;
use Phaba\DatabaseManager\Factory\Mysql\MysqlQueryBuilderFactoryImp;
use Phaba\DatabaseManager\QueryResult;

class MysqlDatabaseQueryImp implements DatabaseQuery
{
    private $conn;

    public function __construct(string $host, int $port, string $name, string $user, string $password)
    {
        $this->conn = new mysqli($host, $user, $password, $name, $port);
    }

    public function select(
        string $table,
        array $fields = [],
        string $where = '',
        array $group = [],
        array $order = [],
        int $limit = -1,
        int $offSet = -1
    ): QueryResult {
        $queryBuilderFactory = new MysqlQueryBuilderFactoryImp();
        $queryBuilder = $queryBuilderFactory->createSelectQueryBuilder(
            $table,
            $fields,
            $where,
            $group,
            $order,
            $limit,
            $offSet
        );

        $results = $this->conn->query($queryBuilder->getQuery());
        return new MysqlQueryResultImp($results);
    }

    public function insert(string $table, array $data): QueryResult
    {
        // TODO: Implement insert() method.
    }

    public function update(
        string $table,
        array $data,
        string $where = null,
        array $order = [],
        int $limit = -1
    ): QueryResult {
        // TODO: Implement update() method.
    }

    public function delete(string $table, string $where = null, array $order = [], int $limit = -1): QueryResult
    {
        // TODO: Implement delete() method.
    }
    public function execute(string $query): QueryResult
    {
        // TODO: Implement execute() method.
    }
}
