<?php

namespace OpenRtb\Tests\BidRequest;

use PHPUnit\Framework\TestCase;
use OpenRtb\BidRequest\BidRequest;
use OpenRtb\BidRequest\Imp;

class BidRequestTest extends TestCase
{
    public function test()
    {
        $imp = new Imp();
        $imp->setId('bbb');

        $bidRequest = new BidRequest();
        $bidRequest
            ->setId('aaa')
            ->addImp($imp)
        ;

        $this->assertTrue(is_array($bidRequest->toArray()));
    }
}
