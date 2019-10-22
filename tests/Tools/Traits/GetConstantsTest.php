<?php

namespace OpenRtb\Tests\Tools\Traits;

use PHPUnit\Framework\TestCase;
use OpenRtb\Tools\Traits\GetConstants;

class TraitImplementation
{
    use GetConstants;

    const TEST = 1;
    const STRING_TEST = 'test';
}

class GetConstantsTest extends TestCase
{
    public function testGetAll()
    {
        $result = TraitImplementation::getAll();
        $expected = [
            'TEST' => 1,
            'STRING_TEST' => 'test'
        ];
        $this->assertEquals($expected, $result);
    }
}
