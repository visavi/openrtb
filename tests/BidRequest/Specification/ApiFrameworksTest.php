<?php

namespace OpenRtb\Tests\BidRequest\Specification;

use PHPUnit\Framework\TestCase;
use OpenRtb\BidRequest\Specification\ApiFrameworks;

class ApiFrameworksTest extends TestCase
{
    public function testGetAll()
    {
        $result = ApiFrameworks::getAll();
        $this->assertTrue(is_array($result));
    }
}
