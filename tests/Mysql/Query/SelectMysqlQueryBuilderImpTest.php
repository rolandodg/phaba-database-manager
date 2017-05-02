<?php

declare(strict_types=1);

namespace Phaba\DatabaseManager\Test\Mysql\Query;

use Phaba\DatabaseManager\Mysql\Query\SelectMysqlQueryBuilderImp;
use Phaba\DatabaseManager\Test\TestHelper\QueryHelper;
use PHPUnit\Framework\TestCase;

class SelectMysqlQueryBuilderImpTest extends TestCase
{
    /**
     * @var QueryHelper
     */
    private $queryHelper;

    public function setUp()
    {
        $this->queryHelper = new QueryHelper();
    }

    public function testCanBuildSelectQueryWithoutFields()
    {
        $table = 'testTable';
        $queryBuilder = new SelectMysqlQueryBuilderImp($table);
        $this->assertEquals(
            $this->queryHelper->buildQueryString($table),
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
            $this->queryHelper->buildQueryString($table, $fields),
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
            $this->queryHelper->buildQueryString($table, $fields, $where),
            $queryBuilder->getQuery()
        );
    }

    /**
     * @dataProvider groupByProvider
     */
    public function testCanBuildSelectQueryWithGroupByClause(string $where, array $groupBy)
    {
        $table = 'testTable';
        $fields = [];
        $queryBuilder = new SelectMysqlQueryBuilderImp($table, $fields, $where, $groupBy);

        $this->assertEquals(
            $this->queryHelper->buildQueryString($table, $fields, $where, $groupBy),
            $queryBuilder->getQuery()
        );
    }

    public function groupByProvider(): array
    {
        return [
            ['', ['testField']],
            ['1=1', ['testField1', 'testField2']]
        ];
    }

    /**
     * @dataProvider orderByClauseProvider
     */
    public function testCanBuildSelectQueryWithOrderByClause(array $group, array $order)
    {
        $table = 'testTable';
        $fields = [];
        $where = '';

        $queryBuilder = new SelectMysqlQueryBuilderImp($table, $fields, $where, $group, $order);

        $this->assertEquals(
            $this->queryHelper->buildQueryString($table, $fields, $where, $group, $order),
            $queryBuilder->getQuery()
        );
    }

    public function orderByClauseProvider(): array
    {
        return [
            [[], ['testField1']],
            [['testField1'], ['testField1', 'testField2' => 'asc']],
            [['testField1'], ['testField1' => 'desc', 'testField2' => 'asc']]
        ];
    }

    /**
     * @dataProvider limitProvider
     */
    public function testCanBuildSelectQueryWithLimitClause(array $order, int $limit, int $offSet)
    {
        $table = 'testTable';
        $fields = $group = [];
        $where = '';

        $queryBuilder = new SelectMysqlQueryBuilderImp($table, $fields, $where, $group, $order, $limit, $offSet);

        $this->assertEquals(
            $this->queryHelper->buildQueryString($table, $fields, $where, $group, $order, $limit, $offSet),
            $queryBuilder->getQuery()
        );
    }

    public function limitProvider(): array
    {
        return [
            [[], 1, -1],
            [['testField1'], 1, 2],
            [['testField1'], -1, 3],
        ];
    }
}
