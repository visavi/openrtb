<?php

namespace OpenRtb\BidRequest\Specification;

use OpenRtb\Tools\Traits\GetConstants;

/**
 * Class LocationService
 * @package OpenRtb\BidRequest\Specification
 */
class LocationService
{
    use GetConstants;

    const IP2LOCATION = 1;
    const NEUSTAR = 2;
    const MAXMIND = 3;
    const NETAQUITY = 4;
}
