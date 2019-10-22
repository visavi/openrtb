<?php

namespace OpenRtb\BidRequest\Specification;

use OpenRtb\Tools\Traits\GetConstants;

/**
 * http://www.iab.net/media/file/OpenRTB-API-Specification-Version-2-3.pdf - 5.13
 * Class ContentDeliveryMethods
 * @package OpenRtb\BidRequest\Specification
 */
class ContentDeliveryMethods
{
    use GetConstants;

    const STREAMING = 1;
    const PROGRESSIVE = 2;
}
