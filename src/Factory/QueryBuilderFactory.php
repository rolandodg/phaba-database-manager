<?php

declare(strict_types=1);

namespace Phaba\DatabaseManager\Factory;

use Phaba\DatabaseManager\QueryBuilder;

abstract class QueryBuilderFactory
{
    abstract public function createSelectQueryBuilder(
        string $table,
        array $fields = [],
        string $where = null,
        array $group = [],
        array $order = [],
        int $limit = null,
        int $offSet = null
    ): QueryBuilder;
}
