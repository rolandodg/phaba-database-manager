<?php

declare(strict_types=1);

namespace Phaba\DatabaseManager\Test\TestHelper;

class QueryHelper
{
    public function buildSelectQueryString(
        string $table,
        array $fields = [],
        string $where = '',
        array $group = [],
        array $order = [],
        int $limit = -1,
        int $offset = -1
    ): string {
        return $this->createSelectClause($fields).
            $this->createFromClause($table).
            $this->createWhereClause($where).
            $this->createGroupClause($group).
            $this->createOrderByClause($order).
            $this->createLimitClause($limit, $offset);
    }

    private function createSelectClause(array $fields): string
    {
        return 'select '.((count($fields))?implode(',', $fields):'*');
    }

    private function createFromClause(string $table): string
    {
        return " from $table";
    }

    private function createWhereClause(string $where): string
    {
        return ((!empty($where)) ? " where $where" : '');
    }

    private function createGroupClause(array $group): string
    {
        return ((count($group)) ? " group by ".implode(',', $group) : '');
    }

    private function createOrderByClause(array $order): string
    {
        if (count($order)) {
            $orderByClause = ' order by ';

            foreach ($order as $key => $value) {
                if (is_numeric($key)) {
                    $orderByClause .= $value.' ASC,';
                } else {
                    $orderByClause .= "$key ".strtoupper($value).',';
                }
            }
            return rtrim($orderByClause, ',');
        }
        return '';
    }

    private function createLimitClause(int $limit, int $offSet): string
    {
        $limitClause = '';
        if ($limit > -1) {
            $limitClause = " limit $limit";
            if ($offSet > -1) {
                $limitClause .= " offset $offSet";
            }
        }
        return $limitClause;
    }
}
