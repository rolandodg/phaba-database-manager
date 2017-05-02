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
     * @param string $where Where clause for filtering query results
     * @param array $group GroupBy clause for grouping query results
     * @param array $order OrderBy clause for sorting query results
     * @param int $limit Limit clause for limiting query results rows number
     * @param int $offSet Offset clause for restricting query results
     */
    public function __construct(
        string $table,
        array $fields = [],
        string $where = '',
        array $group = [],
        array $order = [],
        int $limit = -1,
        int $offSet = -1
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
            $this->getSelectClause().' '.
            $this->getFromClause().' '.
            $this->getWhereClause().' '.
            $this->getGroupByClause().' '.
            $this->getOrderByClause().' '.
            $this->getLimitClause()
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
        return 'from '.$this->table;
    }

    /**
     * Build WHERE clause
     *
     * @return string
     */
    private function getWhereClause(): string
    {
        return (!empty($this->where)) ? 'where '.$this->where : '';
    }

    /**
     * Build GROUPBY clause
     *
     * @return string
     */
    private function getGroupByClause(): string
    {
        return (count($this->group))? 'group by '.implode(',', $this->group) : '';
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
            $clause = 'order by ';
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
        $limit = '';

        if ($this->limit > -1) {
            $limit = "limit $this->limit ";
            if ($this->offSet > -1) {
                $limit .= "offset $this->offSet";
            }
        }
        return $limit;
    }
}
