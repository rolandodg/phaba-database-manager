<?php

declare(strict_types=1);

namespace Phaba\DatabaseManager\Mysql;

use Phaba\DatabaseManager\QueryBuilder;

/**
 * Class for implementing several Mysql query builders.
 *
 * It's necessary to extend this abstract class for building MySql engine queries.
 * For example, You can create the SelectMysqlQueryBuilderImp for creating the class in charge of
 * build Mysql SELECT queries
 *
 * @package Phaba\DatabaseManager\Mysql
 */
abstract class MysqlQueryBuilder extends QueryBuilder
{
    private $driver = 'mysqli';
}
