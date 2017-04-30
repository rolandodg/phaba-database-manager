<?php

declare(strict_types=1);

namespace Phaba\DatabaseManager;

/**
 * For extending classes in charge of process query results from several databases engines.
 *
 * For example, You can extend this abstract class for creating a class (MysqlQueryResultImp)
 * in charge of process results from a MySql database
 *
 * @package Phaba\DatabaseManager
 */
abstract class QueryResult
{
    /**
     * @var array
     */
    protected $result = [];

    abstract public function __construct($result);

    /**
     * Get results array
     *
     * @return array
     */
    public function getResult(): array
    {
        return $this->result;
    }
}
