<?php

declare(strict_types=1);

namespace Phaba\DatabaseManager\Query;

use Phaba\DatabaseManager\Query\QueryResult;

interface Query
{
    /**
     * Execute teh specified query
     *
     * @param string $query Query for executing
     * @return \Phaba\DatabaseManager\Query\QueryResult
     */
    public function execute(string $query): QueryResult;

    /**
     * Execute a select query
     *
     * @param array $fields Fields for getting in select query
     * @param string $table Table where getting data
     * @param string $where Where clause for filtering results
     * @param string $order OrderBy clause for ordering query results
     * @param string $group GroupBy clause for grouping query results
     * @param int $limit Number of rows gotten by query
     * @param int $offSet Number of rows excluded from query results
     * @return \Phaba\DatabaseManager\Query\QueryResult
     */
    public function select(
        array $fields,
        string $table,
        string $where,
        string $order,
        string $group,
        int $limit,
        int $offSet
    ): QueryResult;

    /**
     * Insert new row
     *
     * @param string $table Table where insert the new row
     * @param array $fields Table fields for inserting with value
     * @param array $values Table fields values for inserting
     * @return \Phaba\DatabaseManager\Query\QueryResult
     */
    public function insert(string $table, array $fields, array $values): QueryResult;

    /**
     * Update an existing row
     *
     * @param string $table Table for updating
     * @param array $fields Fields which will be updated
     * @param array $values New values for specified fields
     * @param string $where Where clause for filtering rows which will be updated
     * @return \Phaba\DatabaseManager\Query\QueryResult
     */
    public function update(string $table, array $fields, array $values, string $where): QueryResult;

    /**
     * Delete existings rows
     *
     * @param string $table Table whose rows will be deleted
     * @param string $where Where clause for filtering rows which will be deleted
     * @return \Phaba\DatabaseManager\Query\QueryResult
     */
    public function delete(string $table, string $where): QueryResult;
}
