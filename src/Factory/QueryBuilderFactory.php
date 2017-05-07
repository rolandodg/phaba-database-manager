<?php

declare(strict_types=1);

namespace Phaba\DatabaseManager\Factory;

use Phaba\DatabaseManager\QueryBuilder;

/**
 * For extending factories in charge of create differents query builders for several database engines
 *
 * For example you can create a factory (MysqlQueryBuilderFactoryImp) for creating Query Builders for Mysql database
 *
 * @package Phaba\DatabaseManager\Factory
 */
abstract class QueryBuilderFactory
{
    abstract public function createSelectQueryBuilder(
        string $table,
        array $fields = [],
        string $where = '',
        array $group = [],
        array $order = [],
        int $limit = -1,
        int $offSet = -1
    ): QueryBuilder;
}
