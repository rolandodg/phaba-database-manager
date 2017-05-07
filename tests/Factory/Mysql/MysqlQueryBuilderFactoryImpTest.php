<?php

declare(strict_types=1);

namespace Phaba\DatabaseManager\Test\Factory\Mysql;

use Phaba\DatabaseManager\Factory\Mysql\MysqlQueryBuilderFactoryImp;
use Phaba\DatabaseManager\Mysql\Query\SelectMysqlQueryBuilderImp;
use PHPUnit\Framework\TestCase;

class MysqlQueryBuilderFactoryImpTest extends TestCase
{
    /**
     * @var MysqlQueryBuilderFactoryImp
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new MysqlQueryBuilderFactoryImp();
    }

    /**
     * @group unit
     */
    public function testCanCreateMysqlSelectQueryBuilder(): void
    {
        $selectBuilder = $this->factory->createSelectQueryBuilder('tableTest', array('tableField'));
        $this->assertInstanceOf(SelectMysqlQueryBuilderImp::class, $selectBuilder);
    }
}
