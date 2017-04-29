<?php

declare(strict_types=1);

namespace Phaba\DatabaseManager\Test\Mysql\Query;

use Phaba\DatabaseManager\Mysql\Query\SelectMysqlQueryBuilderImp;
use PHPUnit\Framework\TestCase;

class SelectMysqlQueryBuilderImpTest extends TestCase
{
    public function testCanBuildSelectQueryWithoutFields()
    {
        $table = 'testTable';
        $queryBuilder = new SelectMysqlQueryBuilderImp($table);
        $this->assertEquals(
            'select * from '.$table,
            $queryBuilder->getQuery()
        );
    }

    /**
     * @dataProvider selectQueryProvider
     */
    public function testCanBuildSelectQuery(string $table, array $fields)
    {
        $queryBuilder = new SelectMysqlQueryBuilderImp($table, $fields);
        $this->assertEquals(
            'select '.implode(',', $fields).' from '.$table,
            $queryBuilder->getQuery()
        );
    }

    public function selectQueryProvider(): array
    {
        return [
            ['testTable', ['testField1']],
            ['testTable', ['testField1', 'testField2', 'testField3']]
        ];
    }

    public function testCanBuildSelectQueryWithWhereClause()
    {
        $table = 'testTable';
        $fields = ['testField'];
        $where = '1 = 1';
        $queryBuilder = new SelectMysqlQueryBuilderImp($table, $fields, $where);

        $this->assertEquals(
            'select '.implode(',', $fields).' from '.$table.' where '.$where,
            $queryBuilder->getQuery()
        );
    }

    /**
     * @dataProvider groupByProvider
     */
    public function testCanBuildSelectQueryWithGroupByClause(array $groupBy)
    {
        $table = 'testTable';
        $queryBuilder = new SelectMysqlQueryBuilderImp($table, [], null, $groupBy);

        $this->assertEquals(
            'select * from '.$table.' groupBy '.implode(',', $groupBy),
            $queryBuilder->getQuery()
        );
    }

    public function groupByProvider(): array
    {
        return [
            [['testField']],
            [['testField1', 'testField2']]
        ];
    }

    /**
     * @dataProvider orderByClauseProvider
     */
    public function testCanBuildSelectQueryWithOrderByClause(array $orderBy)
    {
        $table = 'testTable';
        $queryBuilder = new SelectMysqlQueryBuilderImp($table, [], null, [], $orderBy);

        $expect = 'select * from '.$table.' orderby ';
        foreach ($orderBy as $field => $order) {
            $expect .= (is_numeric($field) ? $order : $field.' '.strtoupper($order)).',';
        }

        $this->assertEquals(rtrim($expect, ','), $queryBuilder->getQuery());
    }

    public function orderByClauseProvider(): array
    {
        return [
            [['testField1']],
            [['testField1', 'testField2' => 'asc']],
            [['testField1' => 'desc', 'testField2' => 'asc']]
        ];
    }

    public function testCanBuildSelectQueryWithLimitClause()
    {
        $table = 'testTable';
        $limit = 123;
        $queryBuilder = new SelectMysqlQueryBuilderImp($table, [], null, [], [], $limit);

        $this->assertEquals(
            'select * from '.$table.' limit '.$limit,
            $queryBuilder->getQuery()
        );
    }
}
