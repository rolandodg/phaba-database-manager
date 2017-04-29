<?php

declare(strict_types=1);

namespace Phaba\DatabaseManager\Mysql\Query;

use Phaba\DatabaseManager\Mysql\MysqlQueryBuilder;

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

    public function getQuery(): string
    {
        return trim(
            $this->getSelectClause().
            $this->getFromClause().
            $this->getWhereClause().
            $this->getGroupByClause().
            $this->getOrderByClause().
            $this->getLimitClause()
        );
    }

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

    private function getFromClause(): string
    {
        return ' from '.$this->table;
    }

    private function getWhereClause(): string
    {
        return (null==!$this->where)?' where '.$this->where:'';
    }

    private function getGroupByClause(): string
    {
        return (count($this->group))? ' groupBy '.implode(',', $this->group) : '';
    }

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

    private function getLimitClause(): string
    {
        return (null !== $this->limit)? ' limit '.$this->limit : '';
    }
}
