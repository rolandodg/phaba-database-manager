<?php

declare(strict_types=1);

namespace Phaba\DatabaseManager\Mysql\Query;

use Phaba\DatabaseManager\Mysql\MysqlQueryBuilder;

/**
 * For building MySql SELECT queries
 *
 * @package Phaba\DatabaseManager\Mysql\Query
 */
class SelectMysqlQueryBuilderImp extends MysqlQueryBuilder
{
    /**
     * @var string
     */
    private $table;

    /**
     * @var array
     */
    private $fields;

    /**
     * @var string
     */
    private $where;

    /**
     * @var array
     */
    private $order;

    /**
     * @var array
     */
    private $group;

    /**
     * @var int
     */
    private $limit;

    /**
     * @var int
     */
    private $offSet;

    /**
     * SelectMysqlQueryBuilderImp constructor.
     *
     * @param string $table Table whose data will be read
     * @param array $fields Fields that will be read
     * @param string|null $where Where clause for filtering query results
     * @param array $group GroupBy clause for grouping query results
     * @param array $order OrderBy clause for sorting query results
     * @param int|null $limit Limit clause for limiting query results rows number
     * @param int|null $offSet Offset clause for restricting query results
     */
    public function __construct(
        string $table,
        array $fields = [],
        string $where = null,
        array $group = [],
        array $order = [],
        int $limit = null,
        int $offSet = null
    ) {
        $this->table = $table;
        $this->fields = $fields;
        $this->where = $where;
        $this->group = $group;
        $this->order = $order;
        $this->limit = $limit;
        $this->offSet = $offSet;
    }

    /**
     * Build the SELECT query
     *
     * @return string
     */
    public function getQuery(): string
    {
        return trim(
            $this->getSelectClause().
            $this->getFromClause().
            $this->getWhereClause().
            $this->getGroupByClause().
            $this->getOrderByClause().
            $this->getLimitClause().
            $this->getOffSetClause()
        );
    }

    /**
     * Build SELECT clause
     *
     * @return string
     */
    private function getSelectClause(): string
    {
        $clause = 'select ';

        if (count($this->fields)) {
            $clause .= implode(',', $this->fields);
        } else {
            $clause .= '*';
        }

        return $clause;
    }

    /**
     * Build FROM clause
     *
     * @return string
     */
    private function getFromClause(): string
    {
        return ' from '.$this->table;
    }

    /**
     * Build WHERE clause
     *
     * @return string
     */
    private function getWhereClause(): string
    {
        return (null==!$this->where)?' where '.$this->where:'';
    }

    /**
     * Build GROUPBY clause
     *
     * @return string
     */
    private function getGroupByClause(): string
    {
        return (count($this->group))? ' groupBy '.implode(',', $this->group) : '';
    }

    /**
     * Build ORDERBY clause
     *
     * @return string
     */
    private function getOrderByClause(): string
    {
        $clause = '';

        if (count($this->order)) {
            $clause = ' orderby ';
            foreach ($this->order as $field => $order) {
                $clause .= (is_numeric($field) ? $order : $field . ' ' . strtoupper($order)) . ',';
            }
        }

        return rtrim($clause, ',');
    }

    /**
     * Build LIMIT clause
     *
     * @return string
     */
    private function getLimitClause(): string
    {
        return (null !== $this->limit)? ' limit '.$this->limit : '';
    }

    /**
     * Build OFFSET clause
     *
     * @return string
     */
    private function getOffSetClause(): string
    {
        return (null !== $this->offSet)? ' offset '.$this->offSet : '';
    }
}
