<?php

declare(strict_types=1);

namespace Phaba\DatabaseManager;

/**
 * For extending classes in charge of execute queries to several databases engines
 *
 * @package Phaba\DatabaseManager
 */
interface DatabaseQuery
{
    public function __construct(string $host, int $port, string $name, string $user, string $password);

    /**
     * Execute a database SELECT query
     *
     * @param string $table Table from where get data
     * @param array $fields Fields contained in results
     * @param string $where Where clause for filtering results
     * @param array $group Fields by which results will be grouped
     * @param array $order Fields by which results will be sorted
     * @param int $limit Max number of rows contained in results
     * @param int $offSet Number of firsts rows to exclude from results
     * @return QueryResult
     */
    public function select(
        string $table,
        array $fields = [],
        string $where = '',
        array $group = [],
        array $order = [],
        int $limit = -1,
        int $offSet = -1
    ): QueryResult;

    /**
     * Insert a new row within database
     *
     * @param string $table Table where insert data
     * @param array $data Data for inserting
     * @return QueryResult
     */
    public function insert(string $table, array $data): QueryResult;

    /**
     * Update data of an existing rows within database
     *
     * @param string $table Table where update row
     * @param array $data Pair field=>value array with fields and values to update
     * @param string $where Where clause for filtering rows to update
     * @param array $order Fields by which rows will be sorted
     * @param int $limit Max number of affected rows
     * @return QueryResult
     */
    public function update(
        string $table,
        array $data,
        string $where = '',
        array $order = [],
        int $limit = -1
    ): QueryResult;

    /**
     * Delete database existing rows
     *
     * @param string $table Table where delete rows
     * @param string $where Where clause for filtering rows to delete
     * @param array $order Fields by which rows will be sorted
     * @param int $limit Max number of affected rows
     * @return QueryResult
     */
    public function delete(string $table, string $where = '', array $order = [], int $limit = -1): QueryResult;

    /**
     * Execute an free database query
     *
     * @param string $query Query to execute
     * @return QueryResult
     */
    public function execute(string $query): QueryResult;
}
