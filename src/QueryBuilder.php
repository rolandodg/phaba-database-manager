<?php

declare(strict_types=1);

namespace Phaba\DatabaseManager;

/**
 * For implementing classes in charge of build queries for several database engines
 *
 * For example, You can implement the MysqlQueryBuilder class for building Mysql queries
 *
 * @package Phaba\DatabaseManager
 */
abstract class QueryBuilder
{
    /**
     * Builds and returns corresponding query
     *
     * @return string
     */
    abstract public function getQuery():string;
}
