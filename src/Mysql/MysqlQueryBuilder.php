<?php

declare(strict_types=1);

namespace Phaba\DatabaseManager\Mysql;

use Phaba\DatabaseManager\QueryBuilder;

abstract class MysqlQueryBuilder extends QueryBuilder
{
    private $driver = 'mysqli';
}
