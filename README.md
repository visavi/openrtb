# OpenRTB
iab, RTB Project, OpenRTB Specification 2.5

## Example
```php
$imp = new Imp();
$imp->setId('1');

$video = new Video();
$video->setMimes([
        'video/mp4',
        'application/x-shockwave-flash',
        'application/javascript',
        'video/webm',
        'video/mpg',
    ])
    ->setMinduration(1)
    ->setMaxduration(120)
    ->setProtocols([2, 3, 5, 6, 7, 8])
    ->setW(576)
    ->setH(320)
    ->setLinearity(2)
    ->setSkip(1)
    ->setSkipmin(10)
    ->setSkipafter(10)
    ->setSequence(1)
    ->setMaxextended(-1)
    ->setApi([1,2])
    ->setPlacement(3);

$imp->setVideo($video)
    ->setBidfloor(100)
    ->setBidfloorcur('RUB')
    ->setSecure(1);

$site = new Site();
$site->setId('1234')
    ->setDomain('test.ru')
    ->setCat([
        'IAB0',
        'IAB0-0',
    ])
    ->setPublisher((new Publisher())->setId('test'))
    ->setPage('https://test.ru');

$geo = new Geo();
$geo->setLat(47.2361)
    ->setLon(39.7189)
    ->setType(2)
    ->setCountry('RUS')
    ->setRegion('RU-ROS')
    ->setCity('Rostov-on-Don')
    ->setZip('344000');

$device = new Device();
$device->setUa('Mozilla/5.0 (Windows NT 6.2; Win64; x64; rv:69.0) Gecko/20100101 Firefox/69.0')
    ->setGeo($geo)
    ->setIp('127.0.0.1')
    ->setDevicetype(2)
    ->setMake('unknown')
    ->setModel('unknown')
    ->setOs('Windows')
    ->setLanguage('ru');

$user = new User();
$user->setId('test1')
    ->setBuyerid('xxxxxxxxx');

$bidRequest = new BidRequest();
$bidRequest
    ->setId('test-3')
    ->addImp($imp)
    ->setSite($site)
    ->setDevice($device)
    ->setUser($user)
    ->setAt(2)
    ->setTmax(300)
    ->setCur(['RUB']);

$request = $bidRequest->getBidRequest();
```

## Install
`composer require visavi/openrtb`
