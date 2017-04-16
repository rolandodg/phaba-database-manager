<?php

declare(strict_types=1);

namespace Phaba\DatabaseManager\Query;

class QueryResult
{
    /**
     * @var array
     */
    private $results;

    public function __construct(array $data)
    {
        $this->results = $data;
    }

    public function getResults(): array
    {
        return $this->results;
    }
}
