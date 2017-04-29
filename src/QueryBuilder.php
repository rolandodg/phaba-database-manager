<?php

declare(strict_types=1);

namespace Phaba\DatabaseManager;

abstract class QueryBuilder
{
    abstract public function getQuery():string;
}
