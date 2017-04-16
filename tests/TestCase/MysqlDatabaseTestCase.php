<?php

declare(strict_types=1);

namespace Phaba\DatabaseManager\Test\TestCase;

use Phaba\Configuration\YamlConfigurationImp;
use PHPUnit\ExampleExtension\TestCaseTrait;
use PHPUnit\Framework\TestCase;

abstract class MysqlDatabaseTestCase extends TestCase
{
    use TestCaseTrait;

    static private $pdo = null;

    private $conn = null;

    final public function getConnection()
    {
        $config = new YamlConfigurationImp('tests/app/config');

        if ($this->conn === null) {
            if (self::$pdo == null) {
                self::$pdo = new PDO('mysql::...', $config->getElement('user'), $config->getElement('password'));
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo, $config->getElement('name'));
        }
        return $this->conn;
    }
}
