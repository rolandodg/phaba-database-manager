<?php

declare(strict_types=1);

namespace Phaba\DatabaseManager\Factory\Mysql;

use Phaba\DatabaseManager\Factory\QueryBuilderFactory;
use Phaba\DatabaseManager\Mysql\Query\SelectMysqlQueryBuilderImp;
use Phaba\DatabaseManager\QueryBuilder;

class MysqlQueryBuilderFactoryImp extends QueryBuilderFactory
{
    public function createSelectQueryBuilder(
        string $table,
        array $fields = [],
        string $where = '',
        array $group = [],
        array $order = [],
        int $limit = -1,
        int $offSet = -1
    ): QueryBuilder {
        return new SelectMysqlQueryBuilderImp($table, $fields, $where, $group, $order, $limit, $offSet);
    }
}
