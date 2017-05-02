<?php

declare(strict_types=1);

namespace Phaba\DatabaseManager\Factory;

use Phaba\DatabaseManager\QueryBuilder;

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
