<?php

declare(strict_types=1);

namespace Phaba\DatabaseManager\Mysql;

use Phaba\DatabaseManager\QueryResult;

class MysqlQueryResultImp extends QueryResult
{

    public function __construct($result)
    {
        while ($row = mysqli_fetch_assoc($result)) {
            $this->result[] = $row;
        }
    }
}
