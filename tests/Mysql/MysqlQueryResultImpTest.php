<?php

declare(strict_types=1);

namespace Phaba\DatabaseManager\Test\Mysql;

use Phaba\Configuration\YamlConfigurationImp;
use Phaba\DatabaseManager\Test\TestCase\MysqlDatabaseTestCase;
use mysqli;
use PHPUnit\DbUnit\DataSet\YamlDataSet;
use Phaba\DatabaseManager\Test\TestHelper\DataSetHelper;
use Phaba\DatabaseManager\Mysql\MysqlQueryResultImp;

class MysqlQueryResultImpTest extends MysqlDatabaseTestCase
{
    /**
     * @var string
     */
    private $table;

    private $mysql_result;

    public function setUp()
    {
        $this->table = 'user';

        $config = new YamlConfigurationImp('tests/app/config');
        $mysqli = new mysqli(
            $config->getElement('database')['host'],
            $config->getElement('database')['user'],
            $config->getElement('database')['password'],
            $config->getElement('database')['name']
        );
        $this->mysql_result = $mysqli->query("SELECT * FROM $this->table");

        parent::setUp();
    }

    protected function getDataSet()
    {
        return new YamlDataSet("tests/app/data/$this->table.yml");
    }

    public function testCanGetSelectResultAsArray(): void
    {
        $queryResult = new MysqlQueryResultImp($this->mysql_result);
        $queryResultArray = $queryResult->getResult();

        $this->assertEquals(
            DataSetHelper::dataSetTableToAssociativeArray($this->getDataSet()->getTable($this->table)),
            $queryResultArray
        );
    }
}
