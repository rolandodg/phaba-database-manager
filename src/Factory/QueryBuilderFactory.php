<?php

declare(strict_types=1);

namespace Phaba\DatabaseManager\Factory;

use Phaba\DatabaseManager\QueryBuilder;

abstract class QueryBuilderFactory
{
    abstract public function createSelectQueryBuilder(): QueryBuilder;
}
