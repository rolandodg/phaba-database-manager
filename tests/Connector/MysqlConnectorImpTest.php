<?php

declare(strict_types=1);

namespace Phaba\DatabaseManager\Test\Connector;

use Phaba\DatabaseManager\Connector\MysqlConnectorImp;
use PHPUnit\Framework\TestCase;
use Phaba\Configuration\YamlConfigurationImp;

class MysqlConnectorImpTest extends TestCase
{
    public function testCanConnectWithMysqlDatabase(): void
    {
        $config = new YamlConfigurationImp('tests/app/config');

        $conn = new MysqlConnectorImp(
            $config->getElement('database')['host'],
            $config->getElement('database')['port'],
            $config->getElement('database')['name'],
            $config->getElement('database')['user'],
            $config->getElement('database')['password']
        );

        $this->assertEmpty($conn->getError());
    }
}
