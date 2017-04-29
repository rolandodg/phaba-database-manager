<?php

declare(strict_types=1);

namespace Phaba\DatabaseManager\Test\Connector;

use Phaba\DatabaseManager\Connector\MysqlConnectorImp;
use PHPUnit\Framework\TestCase;
use Phaba\Configuration\YamlConfigurationImp;

class MysqlConnectorImpTest extends TestCase
{
    /**
     * @var MysqlConnectorImp
     */
    private $conn;

    public function setUp()
    {
        $config = new YamlConfigurationImp('tests/app/config');
        $this->conn = new MysqlConnectorImp(
            $config->getElement('database')['host'],
            $config->getElement('database')['port'],
            $config->getElement('database')['name'],
            $config->getElement('database')['user'],
            $config->getElement('database')['password']
        );
    }

    public function testCanConnectWithMysqlDatabase(): void
    {
        $this->assertNotNull($this->conn->getConnection());
        $this->conn->getConnection()->close();
    }
}
