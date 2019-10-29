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

$deals = new Deal();
$deals->setId('id')
    ->setBidfloor(120)
    ->setBidfloorcur('RUB')
    ->setAt(3);

$pmp = new Pmp();
$pmp->setPrivate_auction(0)
    ->addDeals($deals);

$imp->setVideo($video)
    ->setBidfloor(100)
    ->setBidfloorcur('RUB')
    ->setSecure(1)
    ->setPmp($pmp);

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
    ->setBuyeruid('xxxxxxxxx');

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
#### Response
```php
$object = new BidResponse();

foreach ($responses as $response) {
    /** @var BidResponse $result */
    $result = Hydrator::hydrate(json_decode($response, true), $object);

    /** @var Seatbid $bid */
    $seatBid = $result->getSeatbid()->first();

    /** @var Bid $bid */
    $bid = $seatBid->getBid()->first();

    $nurls[] = $bid->getNurl();
}

// or
$result = json_decode($response, true);
$nurl = $result['seatbid'][0]['bid'][0]['nurl'] ?? null;
```

### Async request
```php
$bidders = [
    'segmento' => 'https://bider1',
    'weborama' => 'https://bider2',
    'otm'      => 'https://bider3',
];

$promises = (function () use ($bidders) {
    foreach ($bidders as $service => $bidder) {
        $buyer   = $this->getBuyer($service);
        $request = $this->buildRequest($buyer);

        if (!$request) {
            continue;
        }

        yield $this->client->requestAsync('POST', $bidder, ['body' => $request]);
    }
})();

$responses = [];

if (!$promises) {
    return '';
}

$each = new EachPromise($promises, [
    'concurrency' => 4,
    'fulfilled' => static function (ResponseInterface $response) use (&$responses) {

        $content = (string) $response->getBody();

        if ($content && 200 === $response->getStatusCode()) {
            $responses[] = $content;
        }
    },
]);

$each->promise()->wait();

var_dump($responses);
```

## Install
`composer require visavi/openrtb`
