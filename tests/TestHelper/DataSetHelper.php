<?php

declare(strict_types=1);

namespace Phaba\DatabaseManager\Test\TestHelper;

use PHPUnit\DbUnit\DataSet\AbstractTable;
use PHPUnit\DbUnit\DataSet\AbstractDataSet;
use PHPUnit\DbUnit\DataSet\QueryDataSet;

/**
 * Helper class for DBUnit DataSet (used for database integration tests)
 *
 * @package Phaba\DatabaseManager\Test\TestHelper
 */
class DataSetHelper
{
    /**
     * Convert a DBUnit DataSet Table to pair field=>value array
     *
     * @param AbstractTable $dataSet DBUnit DataSet Default Table for converting to array
     * @return array
     */
    public static function dataSetTableToAssociativeArray(AbstractTable $dataSet): array
    {
        $results = [];
        for ($i = 0; $i < $dataSet->getRowCount(); $i++) {
            $results[] = $dataSet->getRow($i);
        }

        return $results;
    }

    public function createQueryDataSet(
        $conn,
        string $table,
        array $fields = [],
        string $where = '',
        array $group = [],
        array $order = [],
        int $limit = -1,
        int $offset = -1
    ): AbstractDataSet {
        $queryHelper = new QueryHelper();
        $dataSet = new QueryDataSet($conn);
        $dataSet->addTable(
            $table,
            $queryHelper->buildSelectQueryString($table, $fields, $where, $group, $order, $limit, $offset)
        );
        return $dataSet;
    }
}
