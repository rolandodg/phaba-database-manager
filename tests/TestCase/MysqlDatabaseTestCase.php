<?php

declare(strict_types=1);

namespace Phaba\DatabaseManager\Test\TestCase;

use Phaba\Configuration\YamlConfigurationReaderImp;
use PHPUnit\DbUnit\TestCaseTrait;
use PHPUnit\Framework\TestCase;

abstract class MysqlDatabaseTestCase extends TestCase
{
    use TestCaseTrait;

    static private $pdo = null;

    private $conn = null;

    final public function getConnection()
    {
        $config = YamlConfigurationReaderImp::getInstance('tests/app/config');

        if ($this->conn === null) {
            if (self::$pdo == null) {
                self::$pdo = new \PDO(
                    'mysql::host='.$config->getElement('database')['host'].
                        ';dbname='.$config->getElement('database')['name'],
                    $config->getElement('database')['user'],
                    $config->getElement('database')['password']
                );
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo, $config->getElement('database')['name']);
        }

        YamlConfigurationReaderImp::reset();
        return $this->conn;
    }
}
