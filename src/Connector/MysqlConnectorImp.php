<?php

declare(strict_types=1);

namespace Phaba\DatabaseManager\Connector;

use mysqli;

/**
 * MySql database connector
 *
 * @package Phaba\DatabaseManager\Connector
 */
class MysqlConnectorImp implements Connector
{
    private $conn;

    public function __construct(string $host, int $port, string $name, string $user, string $password)
    {
        $this->conn = new mysqli($host, $user, $password, $name, $port);
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function close()
    {
        mysqli_close($this->conn);
    }
}
