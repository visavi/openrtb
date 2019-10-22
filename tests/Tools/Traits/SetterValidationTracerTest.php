<?php

namespace OpenRtb\Tests\Tools\Traits;

use PHPUnit\Framework\TestCase;
use OpenRtb\BidRequest\BidRequest;

class SetterValidationTracerTest extends TestCase
{
    public function testTracer()
    {
        try {
            $bidRequest = new BidRequest();
            $bidRequest->addCur(1);
        } catch (\Exception $e) {
            $this->assertStringContainsString(
                'OpenRtb\BidRequest\BidRequest::addCur::474[validateString]',
                $e->getMessage()
            );
        }
    }
}
