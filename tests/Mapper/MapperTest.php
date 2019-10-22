<?php

namespace OpenRtb\Tests\Mapper;

use PHPUnit\Framework\TestCase;
use OpenRtb\BidRequest\BidRequest;
use OpenRtb\BidRequest\Imp;
use OpenRtb\Hydrator;
use OpenRtb\Mapper\MapFactory;
use OpenRtb\Mapper\Mapper;

class MapperTest extends TestCase
{
    public function testMapFromValues()
    {
        $demoMap = [
            'BidRequest.Imp[].Native.Request:@required' => 'native',
            'BidRequest.Imp[].Id' => 'id'
        ];

        $map = MapFactory::create($demoMap);

        $mapper = new Mapper();
        $arrayMapped = $mapper->mapFromValues($map, new BidRequest());

        $myObject = new BidRequest();
        Hydrator::hydrate($arrayMapped, $myObject);

        $this->assertEquals(1, $myObject->getImp()->count());
        $this->assertEquals('id', $myObject->getImp()->current()->getId());
        $this->assertEquals('native', $myObject->getImp()->current()->getNative()->getRequest());
    }

    public function testMapFromArray()
    {
        $demoMap = [
            'BidRequest.Imp[].Native.Request:@required' => 'request',
            'BidRequest.Imp[].Id' => 'id'
        ];
        $map = MapFactory::create($demoMap);

        $source = [
            'request' => 'native',
            'id' => '123'
        ];

        $mapper = new Mapper();
        $arrayMapped = $mapper->mapFromArray($map, $source);

        $myObject = new BidRequest();
        Hydrator::hydrate($arrayMapped, $myObject);

        $this->assertEquals(1, $myObject->getImp()->count());
        $this->assertEquals('123', $myObject->getImp()->current()->getId());
        $this->assertEquals('native', $myObject->getImp()->current()->getNative()->getRequest());
    }

    public function testMapFromObject()
    {
        $demoMap = [
            'Native.Request' => 'Id',
            'Id' => 'Imp[].Id'
        ];
        $map = MapFactory::create($demoMap);

        $imp = new Imp();
        $imp->setId('impId');

        $bidRequest = new BidRequest();
        $bidRequest
            ->setId('bidRequestId')
            ->addImp($imp)
        ;

        $mapper = new Mapper();
        $arrayMapped = $mapper->mapFromObject($map, $bidRequest);

        $this->assertTrue(is_array($arrayMapped));
        $this->assertEquals('bidRequestId', $arrayMapped['native']['request']);
        $this->assertEquals('impId', $arrayMapped['id']);
    }
}
