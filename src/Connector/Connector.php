<?php

declare(strict_types=1);

namespace Phaba\DatabaseManager\Connector;

/**
 * Interface for implementing database connectors from distinct drivers
 *
 * For example, for implementing a connector to SQL Server we can create
 * SQLServerConnectorImp concrete which should implement this (connector) interface
 *
 * @package Phaba\DatabaseManager\Connector
 */
interface Connector
{
    /**
     * Construct database connector for connecting with database specified by parameters
     *
     * @param string $host Host name for connecting to database
     * @param int $port Port for connecting to database
     * @param string $name Database name with which to connect
     * @param string $user Username for connecting with database
     * @param string $password Password for connecting with database
     */
    public function __construct(
        string $host,
        int $port,
        string $name,
        string $user,
        string $password
    );

    /**
     * Get specific connection
     *
     * @return mixed
     */
    public function getConnection();

    /**
     * Close an opened database connection
     */
    public function close();
}
