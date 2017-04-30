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
     * @param string|null $where Where clause for filtering results
     * @param array $group Fields by which results will be grouped
     * @param array $order Fields by which results will be sorted
     * @param int|null $limit Max number of rows contained in results
     * @param int|null $offSet Number of firsts rows to exclude from results
     * @return QueryResult
     */
    public function select(
        string $table,
        array $fields = [],
        string $where = null,
        array $group = [],
        array $order = [],
        int $limit = null,
        int $offSet = null
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
     * @param string|null $where Where clause for filtering rows to update
     * @return QueryResult
     */
    public function update(string $table, array $data, string $where = null): QueryResult;

    /**
     * Delete database existing rows
     *
     * @param string $table Table where delete rows
     * @param string|null $where Where clause for filtering rows to delete
     * @return QueryResult
     */
    public function delete(string $table, string $where = null): QueryResult;

    /**
     * Execute an free database query
     *
     * @param string $query Query to execute
     * @return QueryResult
     */
    public function execute(string $query): QueryResult;
}
