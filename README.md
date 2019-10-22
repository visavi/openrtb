# OpenRTB
iab, RTB Project, OpenRTB Specification 2.5

## Example
```php
$imp = new Imp();
$imp->setId('1');

$video = new Video();
$video->setMimes(
    [
        'video/mp4',
        'application/x-shockwave-flash',
        'application/javascript',
        'video/webm',
        'video/mpg'
    ]
)
    ->setMinduration(1);
    ->setMaxduration(120);
    ->setProtocols([2, 3, 5, 6, 7, 8]);
    ->setW(576);
    ->setH(320);
    ->setLinearity(2);
    ->setSkip(1);

$imp->setVideo($video);

$bidRequest = new BidRequest();
$bidRequest
    ->setId('test-id')
    ->addImp($imp);


$request = json_encode($bidRequest->toArray());
```
