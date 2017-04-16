<?php

declare(strict_types=1);

namespace Phaba\DatabaseManager\Test\Query;

use PHPUnit\Framework\TestCase;
use Phaba\DatabaseManager\Query\QueryResult;

class QueryResultTest extends TestCase
{
    /**
     * @var array
     */
    private $fakeData;

    /**
     * @var QueryResult
     */
    private $queryResults;

    public function setUp()
    {
        $this->fakeData = array(
            array('firstName'=>'Carla', 'LastName'=>'Sword Master'),
            array('firstName'=>'Captain', 'LastName'=>'Smirk')
        );
        $this->queryResults = new QueryResult($this->fakeData);
    }

    public function testCanReturnArrayResults(): void
    {
        $results = $this->queryResults->getResults();
        foreach ($this->fakeData as $key => $data) {
            $this->assertEquals($data['firstName'], $results[$key]['firstName']);
        }


    }
}
