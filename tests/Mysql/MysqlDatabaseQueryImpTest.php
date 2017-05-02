<?php

declare(strict_types=1);

namespace Phaba\DatabaseManager\Tests\Mysql;

use Phaba\Configuration\YamlConfigurationImp;
use Phaba\DatabaseManager\Mysql\MysqlDatabaseQueryImp;
use Phaba\DatabaseManager\Test\TestCase\MysqlDatabaseTestCase;
use Phaba\DatabaseManager\Test\TestHelper\DataSetHelper;
use PHPUnit\DbUnit\DataSet\YamlDataSet;

class MysqlDatabaseQueryImpTest extends MysqlDatabaseTestCase
{
    /**
     * @var MysqlDatabaseQueryImp
     */
    private $databaseQuery;

    /**
     * @var string
     */
    private $table = 'user';

    /**
     * @var DataSetHelper
     */
    private $dataSetHelper;

    public function setUp()
    {
        parent::setUp();
        $config = new YamlConfigurationImp('tests/app/config');
        $this->databaseQuery = new MysqlDatabaseQueryImp(
            $config->getElement('database')['host'],
            $config->getElement('database')['port'],
            $config->getElement('database')['name'],
            $config->getElement('database')['user'],
            $config->getElement('database')['password']
        );
        $this->dataSetHelper = new DataSetHelper();
    }

    protected function getDataSet()
    {
        return new YamlDataSet("tests/app/data/$this->table.yml");
    }

    public function testCanSelectAllData(): void
    {
        $this->assertEquals(
            DataSetHelper::dataSetTableToAssociativeArray($this->getDataSet()->getTable($this->table)),
            $this->databaseQuery->select($this->table)->getResult()
        );
    }

    /**
     * @dataProvider fieldsProvider
     */
    public function testCanSelectDataForSpecifiedFields(array $fields): void
    {

        $this->assertEquals(
            DataSetHelper::dataSetTableToAssociativeArray(
                $this->dataSetHelper->createQueryDataSet($this->getConnection(), $this->table, $fields)
                    ->getTable($this->table)
            ),
            $this->databaseQuery->select($this->table, $fields)->getResult()
        );
    }

    public function fieldsProvider(): array
    {
        return[
            [['firstName']],
            [['id', 'firstName', 'lastName']]
        ];
    }

    public function testCanSelectFilteredDataWithWhereClause(): void
    {
        $fields = [];
        $where = 'residence like "Traveller"';

        $this->assertEquals(
            DataSetHelper::dataSetTableToAssociativeArray(
                $this->dataSetHelper->createQueryDataSet($this->getConnection(), $this->table, [], $where)
                    ->getTable($this->table)
            ),
            $this->databaseQuery->select($this->table, $fields, $where)->getResult()
        );
    }

    /**
     * @dataProvider groupProvider
     */
    public function testCanSelectGroupingData($fields, $where, $group): void
    {
        $this->assertEquals(
            DataSetHelper::dataSetTableToAssociativeArray(
                $this->dataSetHelper->createQueryDataSet($this->getConnection(), $this->table, $fields, $where, $group)
                    ->getTable($this->table)
            ),
            $this->databaseQuery->select($this->table, $fields, $where, $group)->getResult()
        );
    }

    public function groupProvider(): array
    {
        return [
            [['residence', 'count(money)'], '', ['residence']],
            [['residence', 'job', 'count(money)'], '1=1', ['residence', 'job']]
        ];
    }

    /**
     * @dataProvider orderProvider
     */
    public function testCanSelectSortingData($fields, $where, $group, $order): void
    {
        $this->assertEquals(
            DataSetHelper::dataSetTableToAssociativeArray(
                $this->dataSetHelper->createQueryDataSet(
                    $this->getConnection(),
                    $this->table,
                    $fields,
                    $where,
                    $group,
                    $order
                )->getTable($this->table)
            ),
            $this->databaseQuery->select($this->table, $fields, $where, $group, $order)->getResult()
        );
    }

    public function orderProvider(): array
    {
        return [
            [[], '', [], ['firstName']],
            [['residence', 'count(money)'], '1=1', ['residence'], ['residence' => 'desc']],
            [['residence', 'job', 'count(money)'], '1=1', ['residence', 'job'], ['job','residence' => 'desc']]
        ];
    }

    /**
     * @dataProvider limitProvider
     */
    public function testCanLimitData($fields, $where, $group, $order, $limit, $offSet): void
    {
        $this->assertEquals(
            DataSetHelper::dataSetTableToAssociativeArray(
                $this->dataSetHelper->createQueryDataSet(
                    $this->getConnection(),
                    $this->table,
                    $fields,
                    $where,
                    $group,
                    $order,
                    $limit,
                    $offSet
                )->getTable($this->table)
            ),
            $this->databaseQuery->select($this->table, $fields, $where, $group, $order, $limit, $offSet)->getResult()
        );
    }

    public function limitProvider(): array
    {
        return [
            [[], '', [], [], 1, -1],    //Without OFFSET
            [[], '', [], ['id'], 2, 2], //With LIMIT & OFFSET
            [[], '', [], ['id'], -1, 2] //Without LIMIT but with OFFSET
        ];
    }
}
